<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Product;
use App\Models\ProductBuying;
use App\Models\ProductCategory;
use App\Models\Room;
use App\Models\TransactionPos;
use App\Models\TransactionRoom;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ProductBuyingController extends Controller
{
    private $dataAddProduct = [];

    public function __construct()
    {
        // Start session
        session_start();

        // Initialize dataAddProduct from session if available
        if (isset($_SESSION['dataAddProduct'])) {
            $this->dataAddProduct = $_SESSION['dataAddProduct'];
        }
    }

    public function index()
    {
        $title = "Buying Products";
        $guest = Guest::all();
        $guests = [];
        foreach ($guest as $key => $value) {
            // dd($value);
            $data = [];
            $transaction = TransactionRoom::with('TotalPayment')->where('status_transaction', 2)->orWhere('status_transaction', 1)->where('id_guest', $value->id)->get();

            foreach ($transaction as $key => $item) {
                $roomss = [];
                $roomIds = json_decode($item->id_room, true);
                $rooms = Room::whereIn('id', $roomIds)->get();

                foreach ($rooms as $room) {
                    $roomss[] = $room->name; // Asumsikan ada atribut 'name' di model Room
                }
                $roomList = implode(', ', $roomss);
                $guests[] = [
                    "id_guest" => $value->id,
                    "name_guest" => $value->full_name,
                    "name_room" => $roomList,
                    "deposit" => $item->TotalPayment->deposit,
                    "id_transaction" => $item->id,
                    "total_price" => $item->price_breakfast ?? null,
                    "status_breakfast" => $item->status_breakfast,
                ];
                // array_push($guests, $data);
            }
        }
        $datas = ProductCategory::with('Product')->get();
        return view('pages.product-buying.index', ['title' => $title, 'guests' => $guests, 'datas' => $datas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function menu()
    {
        $datas = ProductCategory::with('Product')->get();
        // dd($datas);
        return view('pages.product-buying.menu', ['datas' => $datas]);
    }

    //! Menambahkan Product
    public function menuAdd($id)
    {
        $product = Product::findOrFail($id);

        // Check if product is not already in the array
        if (!in_array($product, $this->dataAddProduct)) {
            // Push product to dataAddProduct
            $this->dataAddProduct[] = $product;

            // Update session data
            $_SESSION['dataAddProduct'] = $this->dataAddProduct;
        }

        // For debugging, you may want to remove this line in production
        return redirect()->route('product-for-buying.index');
    }

    //! Menghapus berdasarkan id
    public function menuRemove($id)
    {
        // Find index of product with given ID in dataAddProduct array
        $index = array_search($id, array_column($this->dataAddProduct, 'id'));

        // If product with given ID is found, remove it from dataAddProduct
        if ($index !== false) {
            unset($this->dataAddProduct[$index]);

            // Reindex the array to maintain continuity of keys
            $this->dataAddProduct = array_values($this->dataAddProduct);

            // Update session data
            $_SESSION['dataAddProduct'] = $this->dataAddProduct;
        }

        // For debugging, you may want to remove this line in production
        return redirect()->route('product-for-buying.index');
    }

    public function transaction()
    {
        // $datas = ProductCategory::with('Product')->get();
        $guests = Guest::all();
        $products = $this->dataAddProduct;
        return view('pages.product-buying.transaction', ['guests' => $guests, 'products' => $products]);
    }

    public function transactionPos(Request $request) {
        try {
            $validate = $request->validate([
                'discount' => 'numeric',
                'number_credit_card' => 'string',
                'payment_method' => 'required|string',
                'payment_status' => 'required|numeric',
                'products.*.id' => 'required|string',
                'products.*.price' => 'required|numeric',
                'products.*.quantity' => 'required|numeric',
                'status_breakfast' => 'nullable|string',
                'sub_total' => 'required|numeric',
                'total' => 'required|numeric',
                'total_payment' => 'required|numeric',
                'transaction_id' => 'required|string',
                'user_id' => 'required|string',
            ]);

            //? create Transaction Pos Sementara

            $dataTransactionPos = [
                "id_transaction" => $validate['transaction_id'],
                "id_guest" => $validate['user_id'],
                "type_transaction" => $validate['payment_method'],
                "card_number" => $validate['number_credit_card'],
                "date" => Carbon::now(),
                "discount" => $validate['discount'],
                "sub_total" => $validate['sub_total'],
                "total_transaction" => $validate['total'],
                "paid_transaction" => $validate['total_payment'],
                "status_transaction" => $validate['payment_status'],
            ];
            $transactionPos = TransactionPos::create($dataTransactionPos);

            //? create productBuying
            foreach ($validate['products'] as $key => $value) {
                $dataProductBuying = [
                    "id_product" => $value['id'],
                    "qty" => $value['quantity'],
                    "total_price" => $value['price'] * $value['quantity'],
                    "id_transaction_pos" => $transactionPos->id,
                ];
                ProductBuying::create($dataProductBuying);
            }

            $transactionRoom = TransactionRoom::with('TotalPayment')->findOrFail($validate['transaction_id']);
            $it = $transactionRoom->TotalPayment->deposit - $validate['sub_total'];
            $it = $it < 0 ? 0 : $it;
            $data = [
                'price_breakfast' => $it
            ];
            $transactionRoom->update($data);
            return response()->json([
                'message' => 'success',
                'data' => $transactionPos
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'fail',
                'data' => $th
            ]);
        }
        // Lakukan tindakan yang diperlukan dengan data yang divalidasi
        // Misalnya, simpan data ke dalam database, lakukan operasi bisnis, dll.

        // Kemudian, kembalikan respons JSON yang sesuai
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $selectedProducts = $request->input('selectedProducts', []);
        $quantities = $request->input('qty', []);

        // Inisialisasi array untuk menyimpan kuantitas produk yang dipilih
        $selectedQuantities = [];

        // Lakukan iterasi untuk memproses hanya produk yang dipilih
        foreach ($selectedProducts as $productId) {
            // Periksa apakah kuantitas tersedia untuk produk yang dipilih
            if (isset($quantities[$productId])) {
                // Simpan kuantitas yang sesuai dengan produk yang dipilih
                $selectedQuantities[$productId] = $quantities[$productId];
                // Lakukan proses penyimpanan atau manipulasi lainnya di sini
            }
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(ProductBuying $productBuying)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductBuying $productBuying)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductBuying $productBuying)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductBuying $productBuying)
    {
        //
    }
}
