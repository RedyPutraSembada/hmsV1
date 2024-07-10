@extends('layouts.app')

@section('content')
    <div class="main-content position-relative max-height-vh-100 h-100">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-12">
                    <form id="source_travel" action="{{ route('source-travel-agent.store') }}" method="POST" enctype="multipart/form-data">
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
                                        <label for="example-text-input" class="form-control-label">Comission</label>
                                        <input class="form-control @error('comission') is-invalid @enderror" type="number" name="comission" value="{{ old('comission') }}">
                                        @error('comission')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Name</label>
                                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}">
                                        @error('name')
                                            <p><small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Travel Agent Type</label>
                                        <select class="form-select" name="id_travel_agent">
                                            <option value="">Open this select Travel Agent</option>
                                            @foreach ($travelAgents as $travelAgent)
                                                @if(old('id_travel_agent') == $travelAgent->id)
                                                    <option value="{{ $travelAgent->id }}" selected>{{ $travelAgent->name }}</option>
                                                @else
                                                    <option value="{{ $travelAgent->id }}">{{ $travelAgent->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('id_travel_agent')
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
        const form = document.getElementById('source_travel');
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            const comission = document.querySelector('input[name="comission"]').value.trim();
            const name = document.querySelector('input[name="name"]').value.trim();
            const travelAgent = document.querySelector('select[name="id_travel_agent"]').value.trim();
            
            let errorMessages = '';
            
            if (comission === '') {
                errorMessages += 'Commission is required.\n';
                document.getElementsByName('comission')[0].classList.add('is-invalid');
            }
            if (name === '') {
                errorMessages += 'Name is required.\n';
                document.getElementsByName('name')[0].classList.add('is-invalid');
            }
            if (travelAgent === '') {
                errorMessages += 'Travel Agent Type is required.\n';
                document.getElementsByName('id_travel_agent')[0].classList.add('is-invalid');
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
