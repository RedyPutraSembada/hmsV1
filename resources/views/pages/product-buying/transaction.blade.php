<div class="row">
    <div class="col-sm-2" style="background-color: darkgray; height: 70px;">
        <h6>Order # </h6>
    </div>
    <br>
    <div class="col-sm-10" style="background-color: rgb(233, 232, 232); height: 70px;">
        <div class="form-group">
            <label for="" class="fs-6">Select Guest :</label>
            <select class="form-select" id="dropdown-search" aria-label="Default select example" name="id_guest">
                <option value="" selected>Select Guest</option>
                @foreach ($guests as $guest)
                    <option value="{{ $guest->id }}">{{ $guest->full_name }} | {{ $guest->address }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
@foreach ($products as $key => $item)
    <div class="row" style="border-bottom: 1px dashed">
        <div class="col-sm-2 d-flex align-items-center justify-content-center" style="height: 70px;">
            <div class="bg-white py-1 px-3 rounded">{{ $key+1 }}</div>
        </div>
        <div class="col-sm-10 d-flex flex-column justify-content-center" style="height: 70px;">
            <div class="row">
                <div class="col-md-7 d-flex align-items-center">
                    <p class="m-0 text-md">name</p>
                </div>
                <div class="col-md-5 d-flex align-items-center justify-content-between">
                    <input type="hidden" class="price" name="price[]" value="{{ $item->price }}">
                    <p class="m-0 text-md mb-0">Rp.{{ $item->price }}</p>
                    <input type="text" name="qty[]" class="form-control form-control-sm text-center qtyInput" style="width: 50px" placeholder="Qty" aria-label="Qty" aria-describedby="button-addon2">
                    <button onclick="Remove({{ $item->id }})" class="btn btn-danger rounded-circle ml-1 mt-3 mr-2" style="padding: 0; width: 30px; height: 30px;">
                        <i class="fas fa-times" style="font-size: 16px;"></i>
                    </button>
                    <!-- Tambahkan elemen dengan atribut data-product-id -->
                    <input type="hidden" class="product-id" value="{{ $item->id }}">
                </div>
            </div>
        </div>
    </div>
@endforeach

<div class="row" style="position: absolute; bottom: 35px; width: 100%; background-color: rgb(215, 215, 215); border-radius: 10px;">
    <div class="col-sm-6 mb-2" style="height: 100px; padding: 0 15px; border: 1px solid; border-radius: 10px;">
        <div class="d-flex align-items-center justify-content-between">
            <p class="fs-5">Discount :</p>
            <p class="fs-5">10.000</p>
        </div>
        <div class="d-flex align-items-center justify-content-between">
            <p class="fs-5">Sub Total :</p>
            <p class="fs-5">10.000</p>
        </div>
    </div>
    <div class="col-sm-6 d-flex flex-column justify-content-between align-items-end" style="height: 100px; padding-right: 15px; border: 1px solid; border-radius: 10px;">
        <div class="fs-5">Total : </div>
        <div class="fs-5" id="total">Rp. 0</div>
    </div>
</div>
<!-- Tombol Send -->
<div class="row" style="position: absolute; bottom: 0; width: 100%;">
    <button class="btn btn-primary mt-1" style="margin: 0 auto;">Send</button>
</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dropdown-search').select2();
        });

        let productData = [];

        $('.qtyInput').on('change', function() {
            // Ambil nilai qty, harga, dan ID produk terkait
            let qty = $(this).val();
            let price = $(this).siblings('.price').val();
            let productId = $(this).closest('.row').find('.product-id').val();

            // Periksa apakah produk sudah ada dalam array productData
            let existingProductIndex = productData.findIndex(product => product.productId == productId);

            if (existingProductIndex !== -1) {
                // Jika produk sudah ada, update nilai qty-nya
                productData[existingProductIndex].qty = qty;
            } else {
                // Jika produk belum ada, tambahkan produk baru ke dalam array productData
                productData.push({
                    productId: productId,
                    qty: qty,
                    price: price
                });
            }

            // Lakukan operasi atau manipulasi yang diperlukan di sini
            console.log('Product Data:', productData);
        });
    </script>
