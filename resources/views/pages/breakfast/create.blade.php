@extends('layouts.app')

@section('content')
    <div class="main-content position-relative max-height-vh-100 h-100">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-12">
                    <form id="breakfastForm" action="{{ route('breakfast.store') }}" method="POST" enctype="multipart/form-data">
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
                                        <label for="example-text-input" class="form-control-label">Name</label>
                                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}">
                                        @error('name')
                                            <p><small class="text-danger">{{ $message }}</small></p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Total Price</label>
                                        <input class="form-control @error('total_price') is-invalid @enderror" type="number" name="total_price" value="{{ old('total_price') }}">
                                        @error('total_price')
                                            <p><small class="text-danger">{{ $message }}</small></p>
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

    <!-- SweetAlert Validation Script -->
    <script>
        document.getElementById('breakfastForm').addEventListener('submit', function(event) {
            var name = document.getElementsByName('name')[0].value;
            var totalPrice = document.getElementsByName('total_price')[0].value;
            
            if (!name || !totalPrice) {
                event.preventDefault();
                
                Swal.fire({
                    title: 'Error!',
                    text: 'Please fill out all required fields.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });

                if (!name) {
                    document.getElementsByName('name')[0].classList.add('is-invalid');
                }
                if (!totalPrice) {
                    document.getElementsByName('total_price')[0].classList.add('is-invalid');
                }
            }
        });
    </script>
@endsection
