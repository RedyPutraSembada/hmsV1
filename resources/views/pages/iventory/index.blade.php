@extends('layouts.app')

@section('content')
<main class="main-content position-relative border-radius-lg ">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <h6>{{ $title }}</h6>
                        {{--  <a href="{{ route('rooms.create') }}" class="btn btn-primary btn-sm ms-auto">Create</a>  --}}
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Name Room</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Room Type</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Status Room</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Floor Room</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Kode Room</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Active</th>
                        <th class="text-center text-uppercase text-secondary text-x font-weight-bolder opacity-7">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rooms as $room)
                        <tr>
                            <td>
                                <p class="align-middle text-center text-sm">{{ $room->name}}</p>
                            </td>
                            <td>
                                <p class="align-middle text-center text-sm">{{ $room->RoomType->name}}</p>
                            </td>
                            <td>
                                <p class="align-middle text-center text-sm">{{ $room->StatusRoom->name}}</p>
                            </td>
                            <td>
                                <p class="align-middle text-center text-sm">{{ $room->Floor->name}}</p>
                            </td>
                            <td>
                                <p class="align-middle text-center text-sm">{{ $room->kode_room}}</p>
                            </td>
                            <td>
                                <p class="align-middle text-center text-sm">{{ $room->status_sewa == 0 ? "Non-Active" : "Active"}}</p>
                            </td>
                            <td class="align-middle text-center">
                                <div class="row justify-content-center">
                                    <div class="col-md">
                                        <div class="button-container">
                                            <a href="#" onclick="showUpdateStatusModal({{ $room->id }})" class="custom-button mt-2">
                                                Update Status
                                            </a>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function showUpdateStatusModal(roomId) {
        Swal.fire({
            title: 'Update Room Status',
            html: `
                <select id="statusSelect" class="swal2-input">
                    @foreach ($statusRooms as $statusRoom)
                        <option value="{{ $statusRoom->id }}">{{ $statusRoom->name }}</option>
                    @endforeach
                </select>
            `,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Update',
            cancelButtonText: 'Cancel',
            preConfirm: () => {
                const status = Swal.getPopup().querySelector('#statusSelect').value;
                if (!status) {
                    Swal.showValidationMessage(`Please select a status`);
                }
                return { status: status };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const status = result.value.status;

                // Kirim data ke server menggunakan AJAX
                $.ajax({
                    url: `{{ url('iventory/update') }}/${roomId}`, // Buat URL dengan parameter id
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // Pastikan untuk menyertakan CSRF token
                        status: status
                    },
                    success: function(response) {
                        Swal.fire('Success', 'Room status updated successfully', 'success')
                            .then(() => {
                                // Reload halaman setelah update sukses
                                location.reload();
                            });
                    },
                    error: function(xhr) {
                        Swal.fire('Error', 'Failed to update room status', 'error');
                    }
                });
            }
        });
    }
</script>
@endsection
