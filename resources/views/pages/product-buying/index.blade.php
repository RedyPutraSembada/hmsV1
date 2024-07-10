@extends('layouts.app')

@section('content')
<main class="main-content position-relative border-radius-lg">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card w-100 vh-100 mt-2">
                        <div class="row">
                            <div class="col-md-4 vh-100" style="background-color: rgb(230, 230, 230); border-radius: 10px; overflow: hidden; position: relative;">
                                <div class="row">
                                    <div class="col-sm-3" style="background-color: darkgray; height: 70px;">
                                        <h6>Order # </h6>
                                    </div>
                                    <br>
                                    {{--  @foreach ($guests as $guest)  --}}
                                        {{--  @dd($guest['name_room'])  --}}
                                        {{--  @foreach ( $guest['name_room'] as $room)
                                                        @dd($room)
                                        @endforeach  --}}
                                    {{--  @endforeach  --}}
                                    <div class="col-sm-9" style="background-color: rgb(233, 232, 232); height: 70px;">
                                        <div class="form-group">
                                            <label for="" class="fs-6">Select Guest :</label>
                                            <select class="form-select" id="dropdown-search" aria-label="Default select example" name="id_guest">
                                                <option value="" selected>Select Guest</option>
                                                @foreach ($guests as $guest)
                                                {{--  @dd($guest['name_room'])  --}}
                                                    <option value="{{ $guest['id_guest'] }}" data-id-transaction="{{ $guest['id_transaction'] }}" data-status-breakfast="{{ $guest['status_breakfast'] }}" data-room-discount="{{ $guest['deposit'] }}">
                                                        {{ $guest['name_guest'] }} | {{ $guest['name_room'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="transaction"></div>
                                <div class="row" style="position: absolute; bottom: 35px; width: 100%; background-color: rgb(215, 215, 215); border-radius: 10px;">
                                    <div class="col-sm-6 mb-2" style="height: 100px; padding: 0 15px; border: 1px solid; border-radius: 10px;">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <p class="fs-5">Deposit :</p>
                                            <p class="fs-5" id="discount">0</p>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <p class="fs-5">Sub Total :</p>
                                            <p class="fs-5" id="subtotal">0</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 d-flex flex-column justify-content-between align-items-end" style="height: 100px; padding-right: 15px; border: 1px solid; border-radius: 10px;">
                                        <div class="fs-5">Total : </div>
                                        <div class="fs-5" id="total">0</div>
                                    </div>
                                </div>
                                <!-- Tombol Send -->
                                <div class="row" style="position: absolute; bottom: 0; width: 100%;">
                                    <button class="btn btn-primary mt-1" style="margin: 0 auto;">Send</button>
                                </div>
                            </div>
                            <div class="col-md-8 vh-100" style="background-color: rgb(230, 230, 230); border-radius: 10px; border-left: 1px solid;">
                                {{--  <div id="menu"></div>  --}}
                                <div style="max-height: 80%; overflow-y: auto;" class="mt-3">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        @foreach ($datas as $key => $data)
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link {{ $key == 0 ? 'active' : '' }}" id="{{ $data->name }}-tab" data-bs-toggle="tab" data-bs-target="#{{ $data->name }}-tab-pane" type="button" role="tab" aria-controls="{{ $data->name }}-tab-pane" aria-selected="{{ $key == 0 ? true : false }}">{{ $data->name }}</button>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        @foreach ($datas as $key => $data )
                                            <div class="tab-pane fade show {{ $key == 0 ? 'active' : '' }}" id="{{ $data->name }}-tab-pane" role="tabpanel" aria-labelledby="{{ $data->name }}-tab" tabindex="0">
                                                <div class="d-flex flex-wrap">
                                                    @foreach ($data->product as $ky => $value)
                                                        <div class="card image-container" style='width: 200px; height: 200px; margin: 5px; position: relative;'>
                                                            @if ($value->type == 'product' && $value->qty == 0)
                                                                <h5 class="text-center" style="margin-bottom: -30px; z-index: 3;">Habis</h5>
                                                            @else
                                                                <button type="button" onclick="Add({{ $value->id }}, `{{ $value->name }}`, `{{ $value->image}}`, {{ $value->price }})" style="position: absolute; top: 5px; right: 5px; border-radius: 50%; border: 0; padding: 5px 10px; background-color: rgb(243, 22, 22); color: white;"><i class="fas fa-plus"></i></button>
                                                            @endif
                                                            <img class="card-img-top" src="{{ asset('storage/' . $value->image) }}" alt=''>
                                                            <h6 class="text-center m-auto">{{ $value->name }}</h6>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dropdown-search').select2();
        });
    </script>
    <script>
        let productAdd = [];
        let TransactionProduct = [];

        function Add(id, name, image, price) {
            let newData = {
                id: id,
                name: name,
                image: image,
                price: price,
            }
            productAdd.push(newData);
            addProduct(newData);
        }

        function addProduct(newData) {
    // Format harga ke dalam format mata uang Indonesia (Rupiah)
    const formattedPrice = newData.price.toLocaleString('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0 // Menentukan jumlah digit minimum untuk fraksi
    });

    $('#transaction').append(`
        <div class="row product-row" id="product-${newData.id}" style="border-bottom: 1px dashed">
            <div class="col-sm-2 d-flex align-items-center justify-content-center" style="height: 70px;">
                <div class="bg-white py-1 px-3 rounded">*</div>
            </div>
            <div class="col-sm-10 d-flex flex-column justify-content-center" style="height: 70px;">
                <div class="row">
                    <div class="col-md-6 d-flex align-items-center">
                        <p class="m-0 text-md">${newData.name}</p>
                    </div>
                    <div class="col-md-6 d-flex align-items-center justify-content-between">
                        <input type="hidden" class="price" name="price[]" value="${newData.price}">
                        <p class="m-0 text-md mb-0">${formattedPrice}</p>
                        <input type="number" name="qty[]" class="form-control form-control-sm text-center qtyInput" style="width: 50px" placeholder="Qty" aria-label="Qty" aria-describedby="button-addon2" value="1">
                        <button onclick="removeProduct(this)" class="btn btn-danger rounded-circle ml-1 mt-3 mr-2" style="padding: 0; width: 30px; height: 30px;">
                            <i class="fas fa-times" style="font-size: 16px;"></i>
                        </button>
                        <!-- Tambahkan elemen dengan atribut data-product-id -->
                        <input type="hidden" class="product-id" value="${newData.id}">
                    </div>
                </div>
            </div>
        </div>
    `);
    $('.product-row').each(function() {
        let qty = $(this).find('.qtyInput');
        console.log(qty);
        {{--  let price = $(this).find('.price').val();
        total += qty * price;  --}}
    });
    {{--  // Perbarui elemen total
    $('#subtotal').text(total);  --}}
}


        function removeProduct(button) {
            // Dapatkan elemen row yang ingin dihapus
            let rowToRemove = $(button).closest('.product-row');
            // Hapus elemen dari DOM
            rowToRemove.remove();

            // Dapatkan indeks baris yang akan dihapus
            let index = $('.product-row').index(rowToRemove);
            // Hapus item dari array productAdd berdasarkan indeks
            productAdd.splice(index, 1);
            // Perbarui total setelah menghapus produk
            updateTotal();
        }

        $(document).on('input', 'input[name="qty[]"]', function() {
            // Dapatkan ID produk terkait
            let productId = $(this).closest('.product-row').attr('id').split('-')[1];
            // Dapatkan nilai qty yang diinputkan
            let qty = $(this).val();
            // Dapatkan harga produk dari input terkait
            let price = $(this).closest('.col-md-5').find('.price').val();
            // Hitung total
            let total = qty * price;
            // Perbarui elemen total untuk produk yang sesuai
            $(`#product-${productId} #total`).text(total);
            // Perbarui total keseluruhan
            updateTotal();
        });

    function updateTotal() {
        let total = 0;
        // Iterasi melalui setiap produk
        $('.product-row').each(function() {
            let qty = $(this).find('.qtyInput').val();
            let price = $(this).find('.price').val();
            total += qty * price;
        });
        // Perbarui elemen total
        $('#subtotal').text(total);
    }

    // Transaction
    document.addEventListener('DOMContentLoaded', function() {
        // Select tombol "Send"
        var sendButton = document.querySelector('.btn-primary');

        // Tambahkan event listener untuk menangani klik pada tombol "Send"
        sendButton.addEventListener('click', function() {
            // Ambil semua elemen input dengan class "product-row"
            var productRows = document.querySelectorAll('.product-row');

            // Buat array untuk menyimpan data produk
            var productsData = [];

            // Loop melalui setiap baris produk
            productRows.forEach(function(row) {
                // Ambil ID, price, dan quantity dari setiap baris produk
                var productId = row.querySelector('.product-id').value;
                var price = row.querySelector('.price').value;
                var quantity = row.querySelector('.qtyInput').value;

                // Tambahkan data produk ke dalam array productsData
                productsData.push({
                    id: productId,
                    price: price,
                    quantity: quantity
                });
            });

            // Ambil nilai sub total, discount, dan total
            var subTotal = parseInt(document.getElementById('subtotal').textContent.replace(/[^\d.-]/g, '')) || 0;
            var discount = parseInt(document.getElementById('discount').textContent.replace(/[^\d.-]/g, '')) || 0;
            var total = parseInt(document.getElementById('total').textContent.replace(/[^\d.-]/g, '')) || 0;


            // Ambil user ID yang dipilih dari dropdown
            var selectedOption = document.getElementById('dropdown-search').options[document.getElementById('dropdown-search').selectedIndex];
            var userId = selectedOption.getAttribute('value');


            // Ambil data tambahan dari atribut data pada opsi yang dipilih
            var transactionId = selectedOption.getAttribute('data-id-transaction');
            var statusBreakfast = selectedOption.getAttribute('data-status-breakfast');
            var roomDiscount = selectedOption.getAttribute('data-room-discount');

            // Buat objek transaction
            var transaction = {
                user_id: userId,
                transaction_id: transactionId,
                status_breakfast: statusBreakfast,
                sub_total: subTotal,
                discount: discount,
                total: total,
                products: productsData,
                total_payment: 0, // Tambah properti total_payment
                payment_method: '', // Tambah properti payment_method
                number_credit_card: '',
                payment_status: '',
            };
            // Simpan objek transaction
            TransactionProduct = transaction;
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            var cek_diskon = subTotal - discount;
            if (cek_diskon < 0) {
                cek_diskon = Math.abs(cek_diskon); // Mengubah nilai negatif menjadi positif
                TransactionProduct.total_payment = 0;
                TransactionProduct.payment_method = 'cash';
                TransactionProduct.number_credit_card = '-';
                    // Status Payment 1 Lunas 0 Belum Lunas
                    var paymentStatus = 1;
                    TransactionProduct.payment_status = paymentStatus;
                    jQuery.ajax({
                        url: "/transaction",
                        type: "POST",
                        data: JSON.stringify(TransactionProduct),
                        contentType: "application/json",
                        headers: {
                            'X-CSRF-TOKEN': csrfToken // Sertakan token CSRF dalam header permintaan
                        },
                        success: function(result) {
                            if(result.message === 'success') {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: `Metode pembayaran: Diskon`,
                                    icon: 'success',
                                    timer: 5000, // Menampilkan swal selama 3 detik
                                    showConfirmButton: false // Menyembunyikan tombol konfirmasi
                                }).then(() => {
                                    // Setelah 3 detik, lakukan reload halaman
                                    window.location.reload();
                                });
                            }
                        }
                    });
            } else if (cek_diskon === 0) {
                // Biarkan nilai tetap 0
                TransactionProduct.total_payment = 0;
                TransactionProduct.payment_method = 'cash';
                TransactionProduct.number_credit_card = '-';
                    // Status Payment 1 Lunas 0 Belum Lunas
                    var paymentStatus = 1;
                    TransactionProduct.payment_status = paymentStatus;
                    console.log(TransactionProduct);
                    jQuery.ajax({
                        url: "/transaction",
                        type: "POST",
                        data: JSON.stringify(TransactionProduct),
                        contentType: "application/json",
                        headers: {
                            'X-CSRF-TOKEN': csrfToken // Sertakan token CSRF dalam header permintaan
                        },
                        success: function(result) {
                            if(result.message === 'success') {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: `Metode pembayaran: Diskon Habis`,
                                    icon: 'success',
                                    timer: 5000, // Menampilkan swal selama 3 detik
                                    showConfirmButton: false // Menyembunyikan tombol konfirmasi
                                }).then(() => {
                                    // Setelah 3 detik, lakukan reload halaman
                                    window.location.reload();
                                });
                            }
                        }
                    });
            } else {
                Swal.fire({
                    title: 'Lanjutkan Pembayaran?',
                    text: 'Anda akan dialihkan ke halaman checkout untuk menyelesaikan pembayaran.',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Continue',
                    cancelButtonText: 'Here',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect ke halaman checkout atau lakukan tindakan lanjutan
                        TransactionProduct.total_payment = 0;
                        TransactionProduct.payment_method = 'checkout';
                        TransactionProduct.number_credit_card = '-';
                        // Status Payment 1 Lunas 0 Belum Lunas
                        var paymentStatus = 0;
                        TransactionProduct.payment_status = paymentStatus;
                        console.log(TransactionProduct);
                        jQuery.ajax({
                            url: "/transaction",
                            type: "POST",
                            data: JSON.stringify(TransactionProduct),
                            contentType: "application/json",
                            headers: {
                                'X-CSRF-TOKEN': csrfToken // Sertakan token CSRF dalam header permintaan
                            },
                            success: function(result) {
                                if(result.message === 'success') {
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: `Metode pembayaran: Checkout`,
                                        icon: 'success',
                                        timer: 5000, // Menampilkan swal selama 3 detik
                                        showConfirmButton: false // Menyembunyikan tombol konfirmasi
                                    }).then(() => {
                                        // Setelah 3 detik, lakukan reload halaman
                                        window.location.reload();
                                    });
                                }
                            }
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        // Jika pengguna memilih untuk menutup SweetAlert, tampilkan modal tambahan untuk pengisian total harga yang dibayar
                        Swal.fire({
                            title: 'Masukkan Total Harga Bayar dan Pilih Metode Pembayaran',
                            html:
                                '<input type="number" id="totalPayment" class="swal2-input" placeholder="Total harga bayar">' +
                                '<select id="paymentMethod" class="swal2-select">' +
                                    '<option value="credit_card">Creadit Dard</option>' +
                                    '<option value="cash">Cash</option>' +
                                '</select>'+
                                '<input type="number" id="number_credit_card" class="swal2-input" placeholder="Number Credit Card opsional">'
                                ,
                            focusConfirm: false,
                            preConfirm: () => {
                                const totalPayment = Swal.getPopup().querySelector('#totalPayment').value;
                                const paymentMethod = Swal.getPopup().querySelector('#paymentMethod').value;
                                const number_credit_card = Swal.getPopup().querySelector('#number_credit_card').value;

                                // Lakukan validasi jika diperlukan
                                if (!totalPayment || !paymentMethod) {
                                    Swal.showValidationMessage('Total harga bayar dan metode pembayaran harus diisi');
                                }

                                // Lakukan proses dengan data yang diambil dari input
                                return { totalPayment: totalPayment, paymentMethod: paymentMethod, 'number_credit_card': number_credit_card };
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Lakukan sesuatu dengan data yang diperoleh dari input
                                const totalPayment = result.value.totalPayment;
                                const paymentMethod = result.value.paymentMethod;
                                const number_credit_card = result.value.number_credit_card === '' ? '-' : result.value.number_credit_card;
                                TransactionProduct.total_payment = parseInt(totalPayment);
                                TransactionProduct.payment_method = paymentMethod;
                                TransactionProduct.number_credit_card = number_credit_card;
                                // Status Payment 1 Lunas 0 Belum Lunas
                                var paymentStatus = totalPayment >= total ? 1 : 0;
                                    // Masukkan data input ke dalam TransactionProduct
                                    TransactionProduct.payment_status = paymentStatus;

                                    jQuery.ajax({
                                        url: "/transaction",
                                        type: "POST",
                                        data: JSON.stringify(TransactionProduct),
                                        contentType: "application/json",
                                        headers: {
                                            'X-CSRF-TOKEN': csrfToken // Sertakan token CSRF dalam header permintaan
                                        },
                                        success: function(result) {
                                            if(result.message === 'success') {
                                                Swal.fire({
                                                    title: 'Berhasil!',
                                                    text: `Total harga bayar: ${totalPayment}, Metode pembayaran: ${paymentMethod}`,
                                                    icon: 'success',
                                                    timer: 5000, // Menampilkan swal selama 3 detik
                                                    showConfirmButton: false // Menyembunyikan tombol konfirmasi
                                                }).then(() => {
                                                    // Setelah 3 detik, lakukan reload halaman
                                                    window.location.reload();
                                                });
                                            }
                                        }
                                    });
                            }
                        });
                    }
                });
            }
        });
    });


    $(document).ready(function() {
        // Tambahkan event listener untuk menangani perubahan nilai pada dropdown
        $('#dropdown-search').change(function() {
            // Ambil nilai diskon kamar dari atribut data pada opsi yang dipilih
            var roomDiscount = $(this).find('option:selected').data('room-discount');
            // var statusBreakfast = $(this).find('option:selected').data('status-breakfast');
            //console.log(statusBreakfast);
            // Periksa apakah nilai diskon kamar null
            if (!roomDiscount) {
                $('#discount').text("0");
            } else {
                var discountValue = Math.floor(roomDiscount); // Membulatkan ke bawah
                $('#discount').text(discountValue);
            }

            // Tampilkan data diskon kamar pada elemen HTML yang sesuai
        });
    });

    $(document).ready(function() {
        // Fungsi untuk memperbarui total
        function updateTotal() {
            // Ambil nilai subtotal dan diskon
            var subtotal = parseInt($('#subtotal').text()) || 0;
            var discount = parseInt($('#discount').text()) || 0;

            // Hitung total berdasarkan subtotal dikurangi diskon
            var total = subtotal - discount;

            // Pastikan total tidak negatif
            if (total < 0) {
                total = 0;
            }

            // Format total ke dalam format mata uang Indonesia (Rupiah) tanpa desimal
            var formattedTotal = total.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            });

            // Tampilkan total yang telah dihitung
            $('#total').text(formattedTotal);
        }


        // Buat MutationObserver untuk memantau perubahan pada elemen subtotal dan diskon
        var observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                // Panggil fungsi updateTotal() setiap kali ada perubahan pada elemen subtotal atau diskon
                updateTotal();
            });
        });

        // Konfigurasi MutationObserver
        var config = { attributes: false, childList: true, subtree: false };

        // Awasi perubahan pada elemen subtotal dan diskon
        observer.observe($('#subtotal')[0], config);
        observer.observe($('#discount')[0], config);

        // Panggil fungsi updateTotal() untuk menginisialisasi total pada awalnya
        updateTotal();
    });
    </script>
</main>

@endsection
