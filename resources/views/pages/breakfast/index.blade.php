@extends('layouts.app')

@section('content')
<main class="main-content position-relative border-radius-lg ">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <h6>Master Data <i class="bi bi-chevron-right"></i> {{ $title }}</h6>
                        <a href="{{ route('breakfast.create') }}" class="btn btn-primary btn-sm ms-auto">Create</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Price</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($breakfasts as $breakfast)
                        <tr>
                            <td>
                                <p class="align-middle text-center text-sm mt-0 mb-0">{{ $breakfast->name}}</p>
                            </td>
                            <td>
                                <p class="align-middle text-center text-sm mt-0 mb-0">{{ number_format($breakfast->total_price, 0, ',', '.') }}</p>
                            </td>
                            <td class="align-middle text-center mt-0 mb-0">
                                <div class="row justify-content-center">
                                    <div class="col-md-4">
                                        <div class="button-container">
                                            <a href="{{ route('breakfast.edit', $breakfast->id) }}" class="custom-button mt-2">
                                                Edit
                                            </a>
                                        </div>
                                        <div class="button-container">
                                            <form onsubmit="return confirm('Apakah yakin untuk menghapus data tersebut??');" action="{{ route('breakfast.destroy', $breakfast->id) }}" method="POST">
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
</main>
@endsection
