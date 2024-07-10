@extends('layouts.app')

@section('content')
    <div class="main-content position-relative max-height-vh-100 h-100">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-12">
                    <form id="edit_floor" action="{{ route('floor.update', $floor->id) }}" method="POST" enctype="multipart/form-data">
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
                                        <label for="example-text-input" class="form-control-label">Name</label>
                                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name', $floor->name) }}">
                                        @error('name')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Alias</label>
                                        <input class="form-control @error('alias') is-invalid @enderror" type="text" name="alias" value="{{ old('alias', $floor->alias) }}">
                                        @error('alias')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address" class="form-label">Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="3" name="description">{{ old('description', $floor->description) }}</textarea>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('edit_floor');
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                const name = document.querySelector('input[name="name"]').value.trim();
                const alias = document.querySelector('input[name="alias"]').value.trim();
                const description = document.querySelector('textarea[name="description"]').value.trim();
                
                let errorMessages = '';
                
                if (name === '') {
                    errorMessages += 'Name is required.\n';
                    document.getElementsByName('name')[0].classList.add('is-invalid');
                }
                if (alias === '') {
                    errorMessages += 'Alias is required.\n';
                    document.getElementsByName('alias')[0].classList.add('is-invalid');
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
