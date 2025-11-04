@extends('layouts.header')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }
    
    .page-header h4 {
        font-size: 24px;
        font-weight: 600;
        margin: 0;
    }
    
    .header-actions {
        display: flex;
        gap: 15px;
        align-items: center;
    }
    
    .add-branch-btn {
        background: #8B0000;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 14px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .add-branch-btn:hover {
        background: #6B0000;
        color: white;
    }
    
    .search-input {
        padding: 8px 15px;
        border: 1px solid #dee2e6;
        border-radius: 20px;
        font-size: 14px;
        width: 250px;
    }
    
    .search-input:focus {
        outline: none;
        border-color: #8B0000;
    }
    
    .table-container {
        background: white;
        border-radius: 10px;
        padding: 0;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        overflow: hidden;
        margin-bottom: 20px;
    }
    
    .branch-table {
        width: 100%;
        margin: 0;
    }
    
    .branch-table thead {
        background: #f8f9fa;
    }
    
    .branch-table th {
        padding: 15px 20px;
        text-align: left;
        font-weight: 600;
        color: #333;
        font-size: 14px;
        border-bottom: 2px solid #dee2e6;
    }
    
    .branch-table td {
        padding: 15px 20px;
        text-align: left;
        color: #333;
        font-size: 14px;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .branch-table tbody tr:hover {
        background: #f8f9fa;
    }
    
    .action-icons {
        display: flex;
        gap: 10px;
    }
    
    .action-icons i {
        font-size: 18px;
        cursor: pointer;
        transition: color 0.3s;
    }
    
    .action-icons .ri-edit-line:hover {
        color: #007bff;
    }
    
    .action-icons .ri-file-list-line:hover {
        color: #28a745;
    }
    
    .action-icons .ri-delete-bin-line:hover {
        color: #dc3545;
    }


    .modal-header-branch {
        background: #8B0000;
        color: white;
        border-bottom: none;
    }
    
    .modal-header-branch .btn-close {
        filter: brightness(0) invert(1);
    }
    
    .modal-header-branch .modal-title {
        font-weight: 600;
        color: #FFF;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
        font-size: 14px;
        display: block;
    }
    
    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        font-size: 14px;
    }
    
    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #8B0000;
        box-shadow: 0 0 0 0.2rem rgba(139, 0, 0, 0.15);
    }
    
    .form-group textarea {
        resize: vertical;
        min-height: 80px;
    }
    
    .btn-submit {
        background: #3cb002 !important;
        color: white !important;
        border: none;
        /* padding: 10px 30px; */
        border-radius: 5px;
        font-size: 14px;
    }
    
    .btn-submit:hover {
        background: #6B0000;
        color: white;
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <h4>Rooms</h4>
    <div class="header-actions">
        <a href="#" class="add-branch-btn" data-bs-toggle="modal" data-bs-target="#addRoomModal">
            <i class="ri-add-circle-line"></i> Add Room
        </a>
        <!-- <input type="text" class="search-input" placeholder="Search by ID or Name"> -->
        <form method="GET" action="{{ route('rooms') }}" class="custom_form mb-3" enctype="multipart/form-data" onsubmit="show()">
            <input type="text" class="search-input" placeholder="Search by ID or Name" name="search" value="{{ request('search') }}"> 
        </form>
    </div>
</div>
<div class="table-responsive">
    <table class="branch-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Floor</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rooms as $room)
                <tr>
                    <td>{{ $room->name }}</td>
                    <td>{{ $room->description }}</td>
                    <td>{{ $room->floor }}</td>
                    <td>
                        <div class="action-icons">
                            <button title="Edit Room" data-bs-toggle="modal" data-bs-target="#editRoom{{$room->id}}">
                                <i class="ri-edit-line"></i>
                            </button>
                            <form method="POST" class="d-inline-block" action="{{url('delete_room/'.$room->id)}}" onsubmit="show()" enctype="multipart/form-data">
                                @csrf
                                <button type="button" class="btn btn-sm btn-outline-danger deleteBtn">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                            </form>
                            <!-- <i class="ri-edit-line" title="Edit"></i> -->
                            <!-- <i class="ri-file-list-line" title="View Details"></i>
                            <i class="ri-delete-bin-line" title="Delete"></i> -->
                        </div>
                    </td>
                </tr>
                @include('settings.rooms.edit') 
            @empty
                <tr>
                    <td colspan="5" class="text-center">No Rooms Found.</td>
                </tr>
            @endforelse 
        </tbody>
    </table>
    {{ $rooms->appends(request()->query())->links() }} 
</div>

<div class="modal fade select2-modal" id="addRoomModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-branch">
                <h5 class="modal-title">Add Room</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addRoomForm" method="POST" action="{{ url('/new_room') }}" onsubmit="show()" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name&nbsp;<span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Room" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Floor&nbsp;<span class="text-danger">*</span></label>
                                <select name="floor" id="floor" class="form-control select2" required>
                                    <option value="">-- Select Floor --</option>
                                    <option value="1st Floor">1st Floor</option>
                                    <option value="2nd Floor">2nd Floor</option>
                                    <option value="3rd Floor">3rd Floor</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" placeholder="Enter Description"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-submit" onclick="submitBranch()">Add Room</button>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function submitBranch() {
        const form = document.getElementById('addRoomForm');
        if (form.checkValidity()) {
            form.submit();
        } else {
            form.reportValidity();
        }
    }

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