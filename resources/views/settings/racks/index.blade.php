@extends('layouts.header')

@section('css')
<style>
    .btn-md {
        border: none !important;
    }

    /* Pagination Styles */
    .pagination-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        padding-top: 15px;
        border-top: 1px solid #e9ecef;
    }

    .pagination-info {
        color: #6c757d;
        font-size: 14px;
    }

    .pagination {
        margin: 0;
        display: flex;
        list-style: none;
        padding: 0;
    }

    .pagination .page-item {
        margin: 0 2px;
    }

    .pagination .page-link {
        color: #5a6c7d;
        border: 1px solid #dee2e6;
        padding: 6px 12px;
        border-radius: 4px;
        text-decoration: none;
        display: block;
    }

    .pagination .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: white;
    }

    .pagination .page-link:hover {
        background-color: #e9ecef;
        color: #0d6efd;
    }

    .pagination .page-item.disabled .page-link {
        color: #6c757d;
        background-color: #fff;
        border-color: #dee2e6;
        cursor: not-allowed;
    }
</style>
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title d-flex justify-content-between mb-3">
                Racks List
                <button type="button" class="btn btn-md btn-primary" data-bs-toggle="modal" data-bs-target="#formRacks">
                    Add Rack
                </button>
            </h4>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center gap-2">
                    <span>Show</span>
                    <select class="form-select form-select-sm" style="width: auto;">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span>entries</span>
                </div>
                <div class="col-md-4">
                    <form method="GET" action="{{ route('racks') }}" class="custom_form" enctype="multipart/form-data" onsubmit="show()">
                        <div class="search">
                            <input type="text" class="form-control" placeholder="Search Racks" name="search" value="{{ request('search') }}"> 
                            <button class="btn btn-sm btn-primary">Search</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="12%">Action</th>
                            <th width="25%">Name</th>
                            <th width="23%">Date Created</th>
                            <th width="20%">Created By</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($racks as $rack)
                            <tr>
                                <td>
                                    <button class="btn btn-outline-info btn-sm" title="Edit Rack" data-bs-toggle="modal" data-bs-target="#editRack{{$rack->id}}">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>
                                    <form method="POST" class="d-inline-block" action="{{url('delete_rack/'.$rack->id)}}" onsubmit="show()" enctype="multipart/form-data">
                                        @csrf
                                        <button type="button" class="btn btn-sm btn-outline-danger deleteBtn">
                                            <i class="mdi mdi-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>{{ $rack->name }}</td>
                                <td>{{ $rack->created_at }}</td>
                                <td>{{ $rack->createdBy->name }}</td>
                            </tr>
                            @include('settings.racks.edit')
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <i class="ri-inbox-line" style="font-size: 48px; color: #ccc;"></i>
                                    <p class="text-muted mt-2">No Racks Found</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination-wrapper">
                <div class="pagination-info">
                    Showing {{ $racks->firstItem() ?? 0 }} to {{ $racks->lastItem() ?? 0 }} of {{ $racks->total() }} entries
                </div>
                <div>
                    {{ $racks->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="formRacks" tabindex="-1" role="dialog" aria-labelledby="addRackData" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Rack</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addRackForm" method="POST" action="{{ url('/new_rack') }}" onsubmit="show()" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 form-group mb-2">
                            <label>Name&nbsp;<span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Name" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submitRack()">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function submitRack() {
        const form = document.getElementById('addRackForm');
        if (form.checkValidity()) {
            form.submit();
        } else {
            form.reportValidity();
        }
    }

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