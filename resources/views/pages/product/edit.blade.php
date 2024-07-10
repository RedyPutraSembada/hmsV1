@extends('layouts.app')

@section('content')
    <div class="main-content position-relative max-height-vh-100 h-100">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-12">
                    <form id="edit_product" action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
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
                                        <select class="form-select @error('type') is-invalid @enderror" id="type_product" name="id_product_category">
                                            <option value="">select Category</option>
                                            @foreach ($categories as $category)
                                            @if(old('id_product_category', $product->id_product_category) == $category->id)
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
                                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name', $product->name) }}">
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
                                        <input class="form-control @error('price') is-invalid @enderror" type="number" name="price" value="{{ old('price', $product->price) }}">
                                        @error('price')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">QTY</label>
                                        <input class="form-control @error('qty') is-invalid @enderror" type="number" name="qty" value="{{ old('qty', $product->qty) }}">
                                        @error('qty')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Type Product</label>
                                        <select class="form-select" name="type">
                                            <option value="">Open this select room type</option>
                                            @if(old('type', $product->type) == "product")
                                                <option value="product" selected>Product</option>
                                                <option value="non-product">Non-Product</option>
                                            @elseif (old('type', $product->type) == "non-product")
                                                <option value="product">Product</option>
                                                <option value="non-product" selected>Non-Product</option>
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
        $(document).ready(function () {
            $('#type_product').change(function() {
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
