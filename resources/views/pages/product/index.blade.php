@extends('layouts.app')

@section('content')
<main class="main-content position-relative border-radius-lg ">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <h6>{{ $title_category }}</h6>
                            <a href="{{ route('product-category.create') }}" type="button" class="btn btn-primary btn-sm ms-auto" data-bs-toggle="modal" data-bs-target="#exampleModal">Create</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Name Category</th>
                                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productCategories as $category)
                                    <tr>
                                        <td>
                                            <p class="align-middle text-center text-sm">{{ $category->name}}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="row justify-content-center">
                                                <div class="col-md">
                                                    {{--  <div class="button-container">
                                                        <a href="{{ route('product-category.edit', $category->id) }}" class="custom-button mt-2">
                                                            Edit
                                                        </a>
                                                    </div>  --}}
                                                    <div class="button-container">
                                                        <form onsubmit="return confirm('Apakah yakin untuk menghapus data tersebut??');" action="{{ route('product-category.destroy', $category->id) }}" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="custom-button-delete mt-2 mb-4">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <h6>{{ $title }}</h6>
                            <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm ms-auto">Create</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Images Guest</th>
                                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Type Product</th>
                                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Name</th>
                                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Price</th>
                                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">QTY</th>
                                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                    <tr>
                                        <td>
                                            <div class="align-middle text-center text-sm px-2 py-1">
                                                <img src="{{ asset('storage/' . $product->image) }}" class="avatar avatar-xl me-3" alt="image">
                                            </div>
                                        </td>
                                        <td>
                                            <p class="align-middle text-center text-sm">{{ $product->type}}</p>
                                        </td>
                                        <td>
                                            <p class="align-middle text-center text-sm">{{ $product->name}}</p>
                                        </td>
                                        <td>
                                            <p class="align-middle text-center text-sm">{{ number_format($product->price, 0, ',', '.') }}</p>
                                        </td>
                                        <td>
                                            <p class="align-middle text-center text-sm">{{ $product->qty}}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="row justify-content-center">
                                                <div class="col-md">
                                                    <div class="button-container">
                                                        <a href="{{ route('product.edit', $product->id) }}" class="custom-button mt-2">
                                                            Edit
                                                        </a>
                                                    </div>
                                                    <div class="button-container">
                                                        <form onsubmit="return confirm('Apakah yakin untuk menghapus data tersebut??');" action="{{ route('product.destroy', $product->id) }}" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="custom-button-delete mt-2 mb-4">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Input Name Category Products</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('product-category.store') }}" method="POST">
            @csrf
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="name" id="floatingInput" placeholder="input catgeory..">
                <label for="floatingInput">Name Category</label>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
  </div>
</div>
@endsection
