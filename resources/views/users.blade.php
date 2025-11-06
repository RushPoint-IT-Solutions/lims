@extends('layouts.header')

@section('css')
<style>
    .btn-md {
        border: none !important;
    }
    
    .add-new-btn {
        background: #4a90e2;
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 5px;
        font-size: 14px;
        text-decoration: none;
        display: inline-block;
    }
    
    .add-new-btn:hover {
        background: #357abd;
        color: white;
    }
    
    .table-responsive {
        background: white;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .status-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }
    
    .status-active {
        background: #d1e7dd;
        color: #0f5132;
    }
    
    .status-pending {
        background: #fff3cd;
        color: #856404;
    }
    
    .status-suspended {
        background: #f8d7da;
        color: #842029;
    }
    
    .status-inactive {
        background: #e2e3e5;
        color: #41464b;
    }
    
    .role-badge {
        padding: 3px 10px;
        border-radius: 15px;
        font-size: 11px;
        font-weight: 600;
    }
    
    .role-student {
        background: #e7f3ff;
        color: #0066cc;
    }
    
    .role-faculty {
        background: #f0e7ff;
        color: #6610f2;
    }
    
    .role-staff {
        background: #fff3e0;
        color: #e65100;
    }
    
    .role-librarian {
        background: #ffe5e5;
        color: #c92a2a;
    }
    
    .action-btn {
        padding: 4px 8px;
        border-radius: 4px;
        border: none;
        background: #f8f9fa;
        color: #6c757d;
        cursor: pointer;
        font-size: 14px;
        margin-right: 5px;
    }
    
    .action-btn:hover {
        background: #e9ecef;
        color: #495057;
    }
    
    .sso-badge {
        padding: 2px 8px;
        border-radius: 10px;
        font-size: 10px;
        font-weight: 600;
        background: #e3f2fd;
        color: #1976d2;
        display: inline-block;
        margin-left: 5px;
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
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="mb-0">Membership Management</h4>
            <p class="text-muted mb-0">Register and manage users with campus SSO integration</p>
        </div>
    </div>

    <!-- Dashboard Cards -->
    <div class="row g-3 mb-4">
        <div class="col-xl-4 col-md-6">
            <div class="dashboard-card">
                <div class="icon-circle">
                    <i class="ri-user-line"></i>
                </div>
                <h2>2,847</h2>
                <p>Total Members</p>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="dashboard-card">
                <div class="icon-circle">
                    <i class="ri-user-add-line"></i>
                </div>
                <h2>15</h2>
                <p>Pending Verification</p>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="dashboard-card">
                <div class="icon-circle">
                    <i class="ri-shield-user-line"></i>
                </div>
                <h2>2,789</h2>
                <p>SSO Connected</p>
            </div>
        </div>
    </div>

    <!-- Main Members Section -->
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title d-flex justify-content-between mb-3">
                    Member Records
                    <div>
                        {{-- <button type="button" class="btn btn-md btn-primary" data-bs-toggle="modal" data-bs-target="#registerModal">
                            <i class="ri-user-add-line"></i> Register Member
                        </button> --}}
                        <button type="button" class="btn btn-md btn-success ms-2" data-bs-toggle="modal" data-bs-target="#ssoSyncModal">
                            <i class="ri-refresh-line"></i> Sync SSO
                        </button>
                    </div>
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
                        <form method="GET" action="#" class="custom_form" enctype="multipart/form-data">
                            <div class="search">
                                <input type="text" class="form-control" placeholder="Search by name, ID, email..." name="search" value="{{ request('search') }}"> 
                                <button class="btn btn-sm btn-primary">Search</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Member ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Department</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>STU-2024-001</strong></td>
                                <td>
                                    <div>
                                        <div class="fw-bold">
                                            John Martinez
                                            <span class="sso-badge">SSO</span>
                                        </div>
                                        <small class="text-muted">Student</small>
                                    </div>
                                </td>
                                <td>john.martinez@campus.edu</td>
                                <td><span class="role-badge role-student">Student</span></td>
                                <td>Computer Science</td>
                                <td><span class="status-badge status-active">Active</span></td>
                                <td>
                                    <button class="btn btn-outline-info btn-sm" title="Edit">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>
                                    <button class="btn btn-outline-warning btn-sm" title="Permissions">
                                        <i class="mdi mdi-key"></i>
                                    </button>
                                    <button class="btn btn-outline-primary btn-sm" title="View Profile">
                                        <i class="mdi mdi-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>FAC-2024-042</strong></td>
                                <td>
                                    <div>
                                        <div class="fw-bold">
                                            Dr. Maria Santos
                                            <span class="sso-badge">SSO</span>
                                        </div>
                                        <small class="text-muted">Faculty Member</small>
                                    </div>
                                </td>
                                <td>maria.santos@campus.edu</td>
                                <td><span class="role-badge role-faculty">Faculty</span></td>
                                <td>Engineering</td>
                                <td><span class="status-badge status-active">Active</span></td>
                                <td>
                                    <button class="btn btn-outline-info btn-sm" title="Edit">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>
                                    <button class="btn btn-outline-warning btn-sm" title="Permissions">
                                        <i class="mdi mdi-key"></i>
                                    </button>
                                    <button class="btn btn-outline-primary btn-sm" title="View Profile">
                                        <i class="mdi mdi-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>STF-2024-089</strong></td>
                                <td>
                                    <div>
                                        <div class="fw-bold">
                                            Carlos Rivera
                                            <span class="sso-badge">SSO</span>
                                        </div>
                                        <small class="text-muted">Staff Member</small>
                                    </div>
                                </td>
                                <td>carlos.rivera@campus.edu</td>
                                <td><span class="role-badge role-staff">Staff</span></td>
                                <td>Administration</td>
                                <td><span class="status-badge status-active">Active</span></td>
                                <td>
                                    <button class="btn btn-outline-info btn-sm" title="Edit">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>
                                    <button class="btn btn-outline-warning btn-sm" title="Permissions">
                                        <i class="mdi mdi-key"></i>
                                    </button>
                                    <button class="btn btn-outline-primary btn-sm" title="View Profile">
                                        <i class="mdi mdi-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr style="background: #fffbf0;">
                                <td><strong>STU-2024-156</strong></td>
                                <td>
                                    <div>
                                        <div class="fw-bold">Ana Lopez</div>
                                        <small class="text-muted">Student</small>
                                    </div>
                                </td>
                                <td>ana.lopez@campus.edu</td>
                                <td><span class="role-badge role-student">Student</span></td>
                                <td>Business Admin</td>
                                <td><span class="status-badge status-pending">Pending Verification</span></td>
                                <td>
                                    <button class="btn btn-outline-success btn-sm" title="Verify">
                                        <i class="mdi mdi-check"></i>
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm" title="Reject">
                                        <i class="mdi mdi-close"></i>
                                    </button>
                                    <button class="btn btn-outline-primary btn-sm" title="View Details">
                                        <i class="mdi mdi-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper">
                    <div class="pagination-info">
                        Showing 1 to 4 of 2,847 entries
                    </div>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">...</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">712</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

{{-- @include('modals/register_modal')
@include('modals/sso_sync_modal') --}}

@endsection