@extends('layouts.app')

@section('content')
    <div class="main-content position-relative max-height-vh-100 h-100">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-12">
                    <form id="room_type_form" action="{{ route('room-type.store') }}" method="POST" enctype="multipart/form-data">
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
                                        <label for="example-text-input" class="form-control-label">Name Type</label>
                                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}">
                                        @error('name')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Base Adult</label>
                                        <input class="form-control @error('base_adult') is-invalid @enderror" type="number" name="base_adult" value="{{ old('base_adult') }}">
                                        @error('base_adult')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Base Child</label>
                                        <input class="form-control @error('base_child') is-invalid @enderror" type="number" name="base_child" value="{{ old('base_child') }}">
                                        @error('base_child')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Breakfast</label>
                                        <select class="form-select" name="breakfast_id">
                                            <option value="">Open this select breakfast</option>
                                            @foreach ($breakfasts as $breakfast)
                                                @if(old('breakfast_id') == $breakfast->id)
                                                    <option value="{{ $breakfast->id }}" selected>{{ $breakfast->name }}</option>
                                                @else
                                                    <option value="{{ $breakfast->id }}">{{ $breakfast->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('breakfast_id')
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
            const form = document.getElementById('room_type_form');
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                const name = document.querySelector('input[name="name"]').value.trim();
                const base_adult = document.querySelector('input[name="base_adult"]').value.trim();
                const base_child = document.querySelector('input[name="base_child"]').value.trim();
                const breakfast_id = document.querySelector('select[name="breakfast_id"]').value.trim();
                
                let errorMessages = '';
                
                if (name === '') {
                    errorMessages += 'Name Type is required.\n';
                    document.getElementsByName('name')[0].classList.add('is-invalid');
                }
                if (base_adult === '') {
                    errorMessages += 'Base Adult is required.\n';
                    document.getElementsByName('base_adult')[0].classList.add('is-invalid');
                }
                if (base_child === '') {
                    errorMessages += 'Base Child is required.\n';
                    document.getElementsByName('base_child')[0].classList.add('is-invalid');
                }
                if (breakfast_id === '') {
                    errorMessages += 'Breakfast selection is required.\n';
                    document.getElementsByName('breakfast_id')[0].classList.add('is-invalid');
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
