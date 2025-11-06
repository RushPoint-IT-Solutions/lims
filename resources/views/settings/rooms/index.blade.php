@extends('layouts.header')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title d-flex justify-content-between mb-3">
                Rooms List
                <button type="button" class="btn btn-md btn-primary" data-bs-toggle="modal" data-bs-target="#addRoomModal">
                    Add Room
                </button>
            </h4>
            <div class="col-md-6 offset-md-6">
                <form method="GET" action="{{ route('frameworks') }}" class="custom_form mb-3" enctype="multipart/form-data" onsubmit="show()">
                    <div class="row height d-flex justify-content-end align-items-end">
                        <div class="col-md-9">
                            <div class="search">
                                <input type="text" class="form-control" placeholder="Search Rooms" name="search" value="{{ request('search') }}"> 
                                <button class="btn btn-sm btn-search btn-primary">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th width="12%">Action</th>
                        <th width="25%">Name</th>
                        <th width="40%">Description</th>
                        <th width="23%">Floor</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rooms as $room)
                        <tr>
                            <td>
                                <button class="btn btn-outline-info btn-sm" title="Edit Room" data-bs-toggle="modal" data-bs-target="#editRoom{{$room->id}}">
                                    <i class="mdi mdi-pencil"></i>
                                </button>
                                <form method="POST" class="d-inline-block" action="{{url('delete_room/'.$room->id)}}" onsubmit="show()" enctype="multipart/form-data">
                                    @csrf
                                    <button type="button" class="btn btn-sm btn-outline-danger deleteBtn">
                                        <i class="mdi mdi-trash-can"></i>
                                    </button>
                                </form>
                            </td>
                            <td>{{ $room->name }}</td>
                            <td>{{ $room->description }}</td>
                            <td>{{ $room->floor }}</td>
                        </tr>
                        @include('settings.rooms.edit')
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No Rooms Found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $rooms->appends(request()->query())->links() }}
        </div>
    </div>
</div>

<div class="modal fade select2-modal" id="addRoomModal" tabindex="-1" role="dialog" aria-labelledby="addRoomData" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Room</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ url('/new_room') }}" onsubmit="show()" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 form-group mb-2">
                            <label>Name&nbsp;<span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Enter room name" required>
                        </div>
                        <div class="col-md-6 form-group mb-2">
                            <label>Floor&nbsp;<span class="text-danger">*</span></label>
                            <select name="floor" id="floor" class="form-control select2" required>
                                <option value="">-- Select Floor --</option>
                                <option value="1st Floor">1st Floor</option>
                                <option value="2nd Floor">2nd Floor</option>
                                <option value="3rd Floor">3rd Floor</option>
                            </select>
                        </div>
                        <div class="col-md-12 form-group mb-2">
                            <label>Description</label>
                            <textarea name="description" class="form-control" placeholder="Enter description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).on('shown.bs.modal', '.select2-modal', function () {
        const $modal = $(this);
        $modal.find('.select2').select2({
            dropdownParent: $modal
        });
    });

    $(document).ready(function() {
        $(".deleteBtn").on('click', function() {
            var form = $(this).closest('form')

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit()
                }
            });
        })
    });
</script>
@endsection