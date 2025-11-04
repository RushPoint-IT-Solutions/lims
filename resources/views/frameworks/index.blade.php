@extends('layouts.header')

@section('css')
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
    <h4>MARC Frameworks</h4>
    <div class="header-actions">
        <a href="#" class="add-branch-btn" data-bs-toggle="modal" data-bs-target="#addFrameworkModal">
            <i class="ri-add-circle-line"></i> Add Framework
        </a>
        <!-- <input type="text" class="search-input" placeholder="Search by ID or Name"> -->
        <form method="GET" action="{{ route('frameworks') }}" class="custom_form mb-3" enctype="multipart/form-data" onsubmit="show()">
            <input type="text" class="search-input" placeholder="Search by ID or Name" name="search" value="{{ request('search') }}"> 
        </form>
    </div>
</div>
<div class="table-responsive">
    <table class="branch-table">
        <thead>
            <tr>
                <th>Code</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($frameworks as $framework)
                <tr>
                    <td>{{ $framework->code }}</td>
                    <td>{{ $framework->description }}</td>
                    <td>
                        <div class="action-icons">
                            <button title="Edit Framework" data-bs-toggle="modal" data-bs-target="#editFramework{{$framework->id}}">
                                <i class="ri-edit-line"></i>
                            </button>
                            <form method="POST" class="d-inline-block" action="{{url('delete_framework/'.$framework->id)}}" onsubmit="show()" enctype="multipart/form-data">
                                @csrf
                                <button type="button" class="btn btn-sm btn-outline-danger deleteBtn">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @include('frameworks.edit')
            @empty
                <tr>
                    <td colspan="5" class="text-center">No Frameworks Found.</td>
                </tr>
            @endforelse 
        </tbody>
    </table>
    {{ $frameworks->appends(request()->query())->links() }} 
</div>

<div class="modal fade select2-modal" id="addFrameworkModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-branch">
                <h5 class="modal-title">Add Framework</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addFrameworkForm" method="POST" action="{{ url('/new_framework') }}" onsubmit="show()" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Code&nbsp;<span class="text-danger">*</span></label>
                                <input type="text" name="code" class="form-control" placeholder="Enter code" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description&nbsp;<span class="text-danger">*</span></label>
                            <textarea name="description" class="form-control" placeholder="Enter Description" required></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-submit" onclick="submitFramework()">Add Framework</button>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function submitFramework() {
        const form = document.getElementById('addFrameworkForm');
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