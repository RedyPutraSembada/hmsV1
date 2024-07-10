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
                        <a href="{{ route('travel-agent.create') }}" class="btn btn-primary btn-sm ms-auto">Create</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Name</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($travelAgents as $travelAgents)
                        <tr>
                            <td>
                                <p class="align-middle text-center text-sm">{{ $travelAgents->name}}</p>
                            </td>
                            <td class="align-middle text-center">
                                <div class="row justify-content-center mb-2">
                                    <div class="col-md">
                                        <div class="button-container">
                                            <a href="{{ route('travel-agent.edit', $travelAgents->id) }}" class="custom-button mt-2">
                                                Edit
                                            </a>
                                        </div>
                                        <div class="button-container">
                                            <form onsubmit="return confirm('Apakah yakin untuk menghapus data tersebut??');" action="{{ route('travel-agent.destroy', $travelAgents->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="custom-button-delete mt-2">Delete</button>
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
