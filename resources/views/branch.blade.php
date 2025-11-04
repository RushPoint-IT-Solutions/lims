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
        border-radius: 5px;
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
</style>
@endsection

@section('content')
    <div class="page-header">
        <h4>Branch Management</h4>
        <div class="header-actions">
            <a href="#" class="add-branch-btn" data-bs-toggle="modal" data-bs-target="#addBranchModal">
                <i class="ri-add-circle-line"></i> Add Branch
            </a>
            <input type="text" class="search-input" placeholder="Search by ID or Name">
        </div>
    </div>

    <div class="table-container">
        <table class="branch-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Contact No</th>
                    <th>Location</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>BookWorm Matara</td>
                    <td>0412410984</td>
                    <td>Matara</td>
                    <td>
                        <div class="action-icons">
                            <i class="ri-edit-line" title="Edit"></i>
                            <i class="ri-file-list-line" title="View Details"></i>
                            <i class="ri-delete-bin-line" title="Delete"></i>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>BookWorm Colombo</td>
                    <td>0412410985</td>
                    <td>Colombo</td>
                    <td>
                        <div class="action-icons">
                            <i class="ri-edit-line" title="Edit"></i>
                            <i class="ri-file-list-line" title="View Details"></i>
                            <i class="ri-delete-bin-line" title="Delete"></i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    @include('modals.add_branch_modal')
    
@endsection

