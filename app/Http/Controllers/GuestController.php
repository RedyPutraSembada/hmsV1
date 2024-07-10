<?php

namespace App\Http\Controllers;

use App\Models\Accupation;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Storage;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Guest";
        $guests = Guest::with('Accupation')->get();
        return view('pages.guest.index', ["title" => $title, "guests" => $guests]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create Guest";
        $occupations = Accupation::all();
        return view('pages.guest.create', ['title' => $title, 'occupations' => $occupations]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required',
            'email' => 'required|email|unique:guests,email',
            'phone' => 'required|unique:guests,phone',
            'identity_card_type' => 'required',
            'identity_card_number' => 'required',
            'exp_identity_card' => $request->has('exp_identity_card_forever') ? '' : 'required', // Buat 'exp_identity_card' opsional jika 'berlaku selamanya' dicentang
            'nationality' => 'required',
            'state' => 'required',
            'address' => 'required',
            'city' => 'required',
            'postal' => 'required',
            'country' => 'required',
            'birth_date' => 'required',
            'city_birth' => 'required',
            'state_birth' => 'required',
            'country_birth' => 'required',
            'gender' => 'required',
            'guest_type' => 'required',
            'id_occupation' => 'required',
        ]);

        if ($request->has('exp_identity_card_forever')) { // Periksa apakah kotak centang 'berlaku selamanya' dicentang
            $data['exp_identity_card'] = null;
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images/guest', 'public');
        }

        $data['role_id'] = 2; //! 2 itu guest
        Guest::create($data);
        return redirect(route('guest.index'));
    }



    /**
     * Display the specified resource.
     */
    public function show(Guest $guest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guest $guest)
    {
        $title = "Edit Guest";
        $occupations = Accupation::all();
        return view('pages.guest.edit', ['title' => $title, 'occupations' => $occupations, 'guest' => $guest]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guest $guest)
    {
        $guest = Guest::findOrFail($guest->id);
        $data = $request->validate([
            'full_name' => 'required',
            'email' => 'required|email|unique:guests,email,' . $guest->id, // Mengecualikan email yang sedang diedit
            'phone' => 'required|unique:guests,phone,' . $guest->id, // Mengecualikan nomor telepon yang sedang diedit
            'identity_card_type' => 'required',
            'identity_card_number' => 'required',
            'exp_identity_card' => $request->has('exp_identity_card_forever') ? '' : 'required', // Buat 'exp_identity_card' opsional jika 'berlaku selamanya' dicentang
            'nationality' => 'required',
            'state' => 'required',
            'address' => 'required',
            'city' => 'required',
            'postal' => 'required',
            'country' => 'required',
            'birth_date' => 'required',
            'city_birth' => 'required',
            'state_birth' => 'required',
            'country_birth' => 'required',
            'gender' => 'required',
            'guest_type' => 'required',
            'id_occupation' => 'required',
        ]);

        if ($request->has('exp_identity_card_forever')) { // Periksa apakah kotak centang 'berlaku selamanya' dicentang
            $data['exp_identity_card'] = null;
        }

         // Menghapus gambar lama jika ada gambar baru yang diunggah
        if ($request->hasFile('image')) {
            // Periksa apakah ada gambar lama sebelum menghapusnya
            if ($guest->image) {
                Storage::delete($guest->image);
            }

            // Simpan gambar baru
            $data['image'] = $request->file('image')->store('images/guest', 'public');
        } else {
            // Gunakan gambar lama jika tidak ada gambar baru yang diunggah
            $data['image'] = $guest->image;
        }
        $data['role_id'] = 2; //! 2 itu guest

        $guest->update($data);
        return redirect(route('guest.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guest $guest)
    {
        $guest = Guest::findOrFail($guest->id);
        if ($guest->image != null) {
            Storage::delete($guest->image);
        }
        Guest::destroy($guest->id);
        return redirect(route('guest.index'));
    }
}
