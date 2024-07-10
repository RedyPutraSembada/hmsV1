@extends('layouts.app')

@section('content')
    <div class="main-content position-relative max-height-vh-100 h-100">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-12">
                    <form id="user_form" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
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
                                        <label for="example-text-input" class="form-control-label">Full Name</label>
                                        <input class="form-control @error('full_name') is-invalid @enderror" type="text" name="full_name" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>User Type</label>
                                        <select class="form-select" aria-label="Default select example" name="role_id">
                                            <option value="">Role type</option>
                                            @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('role')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Email</label>
                                        <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">password</label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password"> 
                                        @error('password')
                                        <div class="invalid-feedback">
                                        {{ $message }}
                                        </div>
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
        const form = document.getElementById('user_form');
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            const fullName = document.querySelector('input[name="full_name"]').value.trim();
            const role = document.querySelector('select[name="role_id"]').value.trim();
            const email = document.querySelector('input[name="email"]').value.trim();
            const password = document.querySelector('input[name="password"]').value.trim();
            
            let errorMessages = '';
            
            if (fullName === '') {
                errorMessages += 'Full Name is required.\n';
            }
            if (role === '') {
                errorMessages += 'User Type is required.\n';
            }
            if (email === '') {
                errorMessages += 'Email is required.\n';
            }
            if (password === '') {
                errorMessages += 'Password is required.\n';
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
