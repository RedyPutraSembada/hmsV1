@extends('layouts.app')

@section('content')
    <div class="main-content position-relative max-height-vh-100 h-100">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-12">
                    <form id="status_room_form" action="{{ route('status-room.store') }}" method="POST" enctype="multipart/form-data">
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
                                        <label for="example-text-input" class="form-control-label">Name Status</label>
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
                                        <label for="example-text-input" class="form-control-label">Main Status</label>
                                        <input class="form-control @error('main_status') is-invalid @enderror" type="number" name="main_status" value="{{ old('main_status') }}">
                                        @error('main_status')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Operation</label>
                                        <input class="form-control @error('operation') is-invalid @enderror" type="number" name="operation" value="{{ old('operation') }}">
                                        @error('operation')
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('status_room_form');
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                const name = document.querySelector('input[name="name"]').value.trim();
                const main_status = document.querySelector('input[name="main_status"]').value.trim();
                const operation = document.querySelector('input[name="operation"]').value.trim();

                
                let errorMessages = '';
                
                if (name === '') {
                    errorMessages += 'Name Type is required.\n';
                    document.getElementsByName('name')[0].classList.add('is-invalid');
                }
                if (main_status === '') {
                    errorMessages += 'Main status is required.\n';
                    document.getElementsByName('main_status')[0].classList.add('is-invalid');
                }
                if (operation === '') {
                    errorMessages += 'Operation is required.\n';
                    document.getElementsByName('operation')[0].classList.add('is-invalid');
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
