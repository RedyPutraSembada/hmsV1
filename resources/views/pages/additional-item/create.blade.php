@extends('layouts.app')

@section('content')
    <div class="main-content position-relative max-height-vh-100 h-100">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-12">
                    <form id="additional_items" action="{{ route('additional-item.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="d-flex align-items-center">
                                    <p class="mb-0">Master Data <i class="bi bi-chevron-right"></i>{{ $title }}</p>
                                    <button class="btn btn-primary btn-sm ms-auto" type="submit">Save</button>
                                </div>
                            </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Name Item</label>
                                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}">
                                        @error('name')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
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
                                        <label for="example-text-input" class="form-control-label">Qty</label>
                                        <input class="form-control @error('qty') is-invalid @enderror" type="number" name="qty" value="{{ old('qty') }}">
                                        @error('qty')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Alias</label>
                                        <input class="form-control @error('alias') is-invalid @enderror" type="text" name="alias" value="{{ old('alias') }}">
                                        @error('alias')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Type Item</label>
                                        <select class="form-select" aria-label="Default select example" name="type">
                                            <option value="">Open this select type item</option>
                                            <option value="Room">Room</option>
                                            <option value="Transaction">Transaction</option>
                                        </select>
                                        @error('type')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address" class="form-label">Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="3" name="description">{{ old('description') }}</textarea>
                                        @error('description')
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
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('additional_items');
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            const name = document.querySelector('input[name="name"]').value.trim();
            const price = document.querySelector('input[name="price"]').value.trim();
            const qty = document.querySelector('input[name="qty"]').value.trim();
            const alias = document.querySelector('input[name="alias"]').value.trim();
            const type = document.querySelector('select[name="type"]').value.trim();
            const description = document.querySelector('textarea[name="description"]').value.trim();
            
            let errorMessages = '';
            
            if (name === '') {
                errorMessages += 'Name is required.\n';
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
            if (alias === '') {
                errorMessages += 'Alias is required.\n';
                document.getElementsByName('alias')[0].classList.add('is-invalid');
            }
            if (type === '') {
                errorMessages += 'Type is required.\n';
                document.getElementsByName('type')[0].classList.add('is-invalid');
            }
            if (description === '') {
                errorMessages += 'Description is required.\n';
                document.getElementsByName('description')[0].classList.add('is-invalid');
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
</script>

@endsection
