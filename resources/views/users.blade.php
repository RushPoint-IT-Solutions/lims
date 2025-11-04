@extends('layouts.header')

@section('css')
<style>
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
    
    .table-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .entries-control {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
    }
    
    .entries-control select {
        padding: 5px 10px;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        font-size: 14px;
    }
    
    .search-control {
        position: relative;
    }
    
    .search-control input {
        padding: 5px 35px 5px 15px;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        font-size: 14px;
        width: 250px;
    }
    
    .search-control i {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
    }
    
    .table-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .pagination-info {
        color: #6c757d;
        font-size: 14px;
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
    <div class="row g-3 mb-4">
        <div class="col-12">
            <div class="table-responsive">
                <div class="section-header">
                    <h5>Member Records</h5>
                    <div>
                        {{-- <a href="#" class="add-new-btn" data-bs-toggle="modal" data-bs-target="#registerModal">
                            <i class="ri-user-add-line"></i> REGISTER MEMBER
                        </a> --}}
                        {{-- It's for synchronizing member data between the campus system and the library system. 
                        for example it pulls updated information from the campus SSO (like new students, faculty changes, department updates) --}}
                        <a href="#" class="add-new-btn ms-2" style="background: #27ae60;" data-bs-toggle="modal" data-bs-target="#ssoSyncModal">
                            <i class="ri-refresh-line"></i> SYNC SSO
                        </a>
                    </div>
                </div>
                
                <div class="table-controls">
                    <div class="entries-control">
                        <span>Show</span>
                        <select>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <span>entries</span>
                    </div>
                    <div class="search-control">
                        <input type="text" placeholder="Search by name, ID, email...">
                        <i class="ri-search-line"></i>
                    </div>
                </div>
                
                <table class="table table-hover">
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
                                <button class="action-btn" title="Edit"><i class="ri-edit-line"></i></button>
                                <button class="action-btn" title="Permissions"><i class="ri-key-line"></i></button>
                                <button class="action-btn" title="View Profile"><i class="ri-user-line"></i></button>
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
                                <button class="action-btn" title="Edit"><i class="ri-edit-line"></i></button>
                                <button class="action-btn" title="Permissions"><i class="ri-key-line"></i></button>
                                <button class="action-btn" title="View Profile"><i class="ri-user-line"></i></button>
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
                                <button class="action-btn" title="Edit"><i class="ri-edit-line"></i></button>
                                <button class="action-btn" title="Permissions"><i class="ri-key-line"></i></button>
                                <button class="action-btn" title="View Profile"><i class="ri-user-line"></i></button>
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
                                <button class="action-btn" title="Verify"><i class="ri-check-line"></i></button>
                                <button class="action-btn" title="Reject"><i class="ri-close-line"></i></button>
                                <button class="action-btn" title="View Details"><i class="ri-eye-line"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <div class="table-footer">
                    <div class="pagination-info">
                        Showing 1 to 4 of 2,847 entries
                    </div>
                    <nav>
                        <ul class="pagination mb-0">
                            <li class="page-item disabled"><a class="page-link" href="#">‹</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="#">712</a></li>
                            <li class="page-item"><a class="page-link" href="#">›</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

{{-- @include('modals/register_modal')
@include('modals/sso_sync_modal') --}}

@endsection