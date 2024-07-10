@extends('layouts.app')

@section('content')
    <div class="main-content position-relative max-height-vh-100 h-100">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('role.update', $role->id) }}" method="POST" enctype="multipart/form-data">
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
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Name Role</label>
                                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name', $role->name) }}">
                                        @error('name')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                @php
                                    $premission = json_decode($role->premission);
                                @endphp
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Front Desk</label>
                                        <div class="form-check">
                                            @if (array("1", $premission))
                                                <input class="form-check-input" type="checkbox" name="premission[]" value="1" id="flexCheckDefault1" checked>
                                            @else
                                                <input class="form-check-input" type="checkbox" name="premission[]" value="1" id="flexCheckDefault1">
                                            @endif
                                            <label class="form-check-label" for="flexCheckDefault1">
                                                Room View
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            @if (array("2", $premission))
                                            <input class="form-check-input" type="checkbox" name="premission[]" value="2" id="flexCheckDefault2" checked>
                                            @else
                                            <input class="form-check-input" type="checkbox" name="premission[]" value="2" id="flexCheckDefault2">
                                            @endif
                                            <label class="form-check-label" for="flexCheckDefault2">
                                                Stay View
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            @if (array("3", $premission))
                                            <input class="form-check-input" type="checkbox" name="premission[]" value="3" id="flexCheckDefault3" checked>
                                            @else
                                            <input class="form-check-input" type="checkbox" name="premission[]" value="3" id="flexCheckDefault3">
                                            @endif
                                            <label class="form-check-label" for="flexCheckDefault3">
                                                Reservation
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            @if (array("4", $premission))
                                            <input class="form-check-input" type="checkbox" name="premission[]" value="4" id="flexCheckDefault4" checked>
                                            @else
                                            <input class="form-check-input" type="checkbox" name="premission[]" value="4" id="flexCheckDefault4">
                                            @endif
                                            <label class="form-check-label" for="flexCheckDefault4">
                                                Transaction
                                            </label>
                                        </div>
                                        <hr>
                                        <div class="form-check">
                                            <label for="example-text-input" class="form-control-label">POS</label>
                                            <input class="form-check-input" type="checkbox" name="premission[]" value="5" id="flexCheckDefault5">
                                        </div>
                                        <div class="form-check">
                                            <label for="example-text-input" class="form-control-label">Accounting</label>
                                            <input class="form-check-input" type="checkbox" name="premission[]" value="6" id="flexCheckDefault6">
                                        </div>
                                        <div class="form-check">
                                            <label for="example-text-input" class="form-control-label">Report</label>
                                            <input class="form-check-input" type="checkbox" name="premission[]" value="7" id="flexCheckDefault7">
                                        </div>
                                        <div class="form-check">
                                            <label for="example-text-input" class="form-control-label">Inventory</label>
                                            <input class="form-check-input" type="checkbox" name="premission[]" value="21" id="flexCheckDefault7">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Master Data</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="premission[]" value="8" id="flexCheckDefault8">
                                            <label class="form-check-label" for="flexCheckDefault8">
                                                Breakfast
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="premission[]" value="9" id="flexCheckDefault9">
                                            <label class="form-check-label" for="flexCheckDefault9">
                                                User Role
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="premission[]" value="10" id="flexCheckDefault10">
                                            <label class="form-check-label" for="flexCheckDefault10">
                                                Status Room
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="premission[]" value="11" id="flexCheckDefault11">
                                            <label class="form-check-label" for="flexCheckDefault11">
                                                Floor
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="premission[]" value="12" id="flexCheckDefault12">
                                            <label class="form-check-label" for="flexCheckDefault12">
                                                Type Room
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="premission[]" value="13" id="flexCheckDefault13">
                                            <label class="form-check-label" for="flexCheckDefault13">
                                                Price Rate Type
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="premission[]" value="14" id="flexCheckDefault14">
                                            <label class="form-check-label" for="flexCheckDefault14">
                                                Travel Agent
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="premission[]" value="15" id="flexCheckDefault15">
                                            <label class="form-check-label" for="flexCheckDefault15">
                                                Source Travel Agent
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="premission[]" value="16" id="flexCheckDefault16">
                                            <label class="form-check-label" for="flexCheckDefault16">
                                                Addtional Item
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="premission[]" value="17" id="flexCheckDefault17">
                                            <label class="form-check-label" for="flexCheckDefault17">
                                                Room
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="premission[]" value="18" id="flexCheckDefault18">
                                            <label class="form-check-label" for="flexCheckDefault18">
                                                Occupation
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="premission[]" value="19" id="flexCheckDefault19">
                                            <label class="form-check-label" for="flexCheckDefault19">
                                                Guest
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="premission[]" value="20" id="flexCheckDefault19">
                                            <label class="form-check-label" for="flexCheckDefault19">
                                                Users
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
