@extends('layouts.app')

@section('content')
    <div class="main-content position-relative max-height-vh-100 h-100">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-12">
                    <form id="product_buying" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="d-flex align-items-center">
                                    <p class="mb-0">Master Data <i class="bi bi-chevron-right"></i> {{ $title }}</p>
                                    <button class="btn btn-primary btn-sm ms-auto" type="submit">Save</button>
                                </div>
                            </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-select @error('type') is-invalid @enderror" id="id_product_category" name="id_product_category">
                                            <option value="">select category</option>
                                            @foreach ($categories as $category)
                                                @if(old('id_product_category') == $category->id)
                                                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                                @else
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('type')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Name Product</label>
                                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}">
                                        @error('name')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Image</label>
                                        <input class="form-control" type="file" name="image">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Price</label>
                                        <input class="form-control @error('price') is-invalid @enderror" type="number" name="price" value="{{ old('price') }}">
                                        @error('price')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">QTY</label>
                                        <input id="qty" class="form-control @error('qty') is-invalid @enderror" type="number" name="qty" value="{{ old('qty') }}">
                                        @error('qty')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Type Product</label>
                                        <select class="form-select @error('type') is-invalid @enderror" id="type" name="type">
                                            <option value="">Open this select product type</option>
                                            @if(old('type') == "product")
                                                <option value="product" selected>Product</option>
                                                <option value="non-product">Non-Product</option>
                                                @elseif (old('type') == "non-product")
                                                <option value="product">Product</option>
                                                <option value="non-product" selected>Non-Product</option>
                                            @else
                                                <option value="product">Product</option>
                                                <option value="non-product">Non-Product</option>
                                            @endif
                                        </select>
                                        @error('type')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
 
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('product_buying');
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                const category = document.querySelector('select[name="id_product_category"]').value.trim();
                const name = document.querySelector('input[name="name"]').value.trim();
                const price = document.querySelector('input[name="price"]').value.trim();
                const qty = document.querySelector('input[name="qty"]').value.trim();
                const type = document.querySelector('select[name="type"]').value.trim();
                
                let errorMessages = '';
                
                if (category === '') {
                    errorMessages += 'Category is required.\n';
                    document.getElementsByName('id_product_category')[0].classList.add('is-invalid');
                }
                if (name === '') {
                    errorMessages += 'Name Product is required.\n';
                    document.getElementsByName('name')[0].classList.add('is-invalid');
                }
                if (price === '') {
                    errorMessages += 'Price is required.\n';
                    document.getElementsByName('price')[0].classList.add('is-invalid');
                }
                if (qty === '') {
                    errorMessages += 'Quantity is required.\n';
                    document.getElementsByName('qty')[0].classList.add('is-invalid');
                }
                if (type === '') {
                    errorMessages += 'Type Product is required.\n';
                    document.getElementsByName('type')[0].classList.add('is-invalid');
                }
                
                if (errorMessages !== '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: errorMessages,
                        heightAuto: false
                    });
                } else {
                    form.submit();
                }
            });
        });
        $(document).ready(function () {
            $('#type').change(function() {
                let selectedValue = $(this).val();
                if(selectedValue === 'non-product') {
                    $('#qty').attr('readonly', true);
                } else {
                    $('#qty').attr('readonly', false);
                }
            });
        })
    </script>
    @endsection

