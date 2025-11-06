@extends('layouts.header')

@section('css')
<style>
    .btn-md {
        border: none !important;
    }
    
    .config-card {
        background: white;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 20px;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .config-card .form-group:last-of-type {
        margin-bottom: 20px;
    }
    
    .table-responsive {
        background: white;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        height: 63%;
        display: flex;
        flex-direction: column;
    }
    
    .table-responsive table {
        margin-bottom: 0;
    }

    .previlages {
        height: 96.2% !important;
    } 
    
    .role-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }
    
    .role-admin {
        background: #ffe5e5;
        color: #c92a2a;
    }
    
    .role-librarian {
        background: #e7f3ff;
        color: #0066cc;
    }
    
    .role-faculty {
        background: #f0e7ff;
        color: #6610f2;
    }
    
    .role-student {
        background: #d1f4e0;
        color: #0f5132;
    }
    
    .permission-toggle {
        display: flex;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .permission-toggle:last-child {
        border-bottom: none;
    }
    
    .permission-label {
        flex: 1;
        font-size: 14px;
        color: #2c3e50;
    }
    
    .toggle-switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 24px;
    }
    
    .toggle-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }
    
    .toggle-slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 24px;
    }
    
    .toggle-slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }
    
    input:checked + .toggle-slider {
        background-color: #4a90e2;
    }
    
    input:checked + .toggle-slider:before {
        transform: translateX(26px);
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 8px;
    }
    
    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        font-size: 14px;
    }
    
    .form-group textarea {
        resize: vertical;
        min-height: 100px;
    }
    
    .save-btn {
        background: #27ae60;
        color: white;
        border: none;
        padding: 10px 24px;
        border-radius: 5px;
        font-size: 14px;
        cursor: pointer;
        margin-top: auto;
    }
    
    .save-btn:hover {
        background: #229954;
    }
    
    .backup-item {
        display: flex;
        align-items: center;
        padding: 15px;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        margin-bottom: 10px;
    }
    
    .backup-info {
        flex: 1;
    }
    
    .backup-name {
        font-size: 14px;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 5px;
    }
    
    .backup-details {
        font-size: 12px;
        color: #6c757d;
    }
    
    .backup-actions {
        display: flex;
        gap: 8px;
    }
    
    .status-active {
        background: #d1e7dd;
        color: #0f5132;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }
    
    .status-scheduled {
        background: #cfe2ff;
        color: #084298;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

    /* Balance row heights */
    .row.g-3 {
        display: flex;
        flex-wrap: wrap;
    }

    .row.g-3 > [class*='col-'] {
        display: flex;
        flex-direction: column;
    }

    .backup-history-wrapper {
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .backup-list {
        flex: 1;
        overflow-y: auto;
        max-height: 400px;
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
            <h4 class="mb-0">Admin Configuration</h4>
            <p class="text-muted mb-0">Manage system settings, user roles, and backup schedules</p>
        </div>
    </div>

    <!-- Dashboard Cards -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="icon-circle">
                    <i class="ri-shield-user-line"></i>
                </div>
                <h2>5</h2>
                <p>Active User Roles</p>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="icon-circle">
                    <i class="ri-database-2-line"></i>
                </div>
                <h2>12</h2>
                <p>Total Backups</p>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="icon-circle">
                    <i class="ri-time-line"></i>
                </div>
                <h2>Daily</h2>
                <p>Backup Schedule</p>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="icon-circle">
                    <i class="ri-git-branch-line"></i>
                </div>
                <h2>3</h2>
                <p>Active Integrations</p>
            </div>
        </div>
    </div>

    <!-- User Roles & Privileges -->
    <div class="row g-3 mb-4">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title d-flex justify-content-between mb-3">
                        User Roles & Privileges
                        <button type="button" class="btn btn-md btn-primary" data-bs-toggle="modal" data-bs-target="#addRoleModal">
                            <i class="ri-add-line"></i> Add New Role
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
                            <form method="GET" action="#" class="custom_form" enctype="multipart/form-data">
                                <div class="search">
                                    <input type="text" class="form-control" placeholder="Search roles..." name="search" value="{{ request('search') }}"> 
                                    <button class="btn btn-sm btn-primary">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Role Name</th>
                                    <th>Users Count</th>
                                    <th>Permissions</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <span class="role-badge role-admin">Admin</span>
                                    </td>
                                    <td><strong>3</strong></td>
                                    <td><small class="text-muted">Full Access</small></td>
                                    <td><span class="status-active">Active</span></td>
                                    <td>
                                        <button class="btn btn-outline-info btn-sm" title="Edit Permissions">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>
                                        <button class="btn btn-outline-primary btn-sm" title="View Users">
                                            <i class="mdi mdi-account-group"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="role-badge role-librarian">Librarian</span>
                                    </td>
                                    <td><strong>8</strong></td>
                                    <td><small class="text-muted">Catalog, Circulation, Reports</small></td>
                                    <td><span class="status-active">Active</span></td>
                                    <td>
                                        <button class="btn btn-outline-info btn-sm" title="Edit Permissions">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>
                                        <button class="btn btn-outline-primary btn-sm" title="View Users">
                                            <i class="mdi mdi-account-group"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="role-badge role-faculty">Faculty</span>
                                    </td>
                                    <td><strong>245</strong></td>
                                    <td><small class="text-muted">Borrow, Reserve, View Catalog</small></td>
                                    <td><span class="status-active">Active</span></td>
                                    <td>
                                        <button class="btn btn-outline-info btn-sm" title="Edit Permissions">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>
                                        <button class="btn btn-outline-primary btn-sm" title="View Users">
                                            <i class="mdi mdi-account-group"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="role-badge role-student">Student</span>
                                    </td>
                                    <td><strong>2,591</strong></td>
                                    <td><small class="text-muted">Borrow, Reserve, View Catalog</small></td>
                                    <td><span class="status-active">Active</span></td>
                                    <td>
                                        <button class="btn btn-outline-info btn-sm" title="Edit Permissions">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>
                                        <button class="btn btn-outline-primary btn-sm" title="View Users">
                                            <i class="mdi mdi-account-group"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-wrapper">
                        <div class="pagination-info">
                            Showing 1 to 4 of 4 entries
                        </div>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item disabled">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="config-card">
                <div class="section-header">
                    <h5>Role Permissions</h5>
                </div>
                <p class="text-muted small mb-3">Select a role to configure permissions</p>
                
                <div class="form-group">
                    <label>Select Role</label>
                    <select>
                        <option>Admin</option>
                        <option selected>Librarian</option>
                        <option>Faculty</option>
                        <option>Student</option>
                    </select>
                </div>

                <div class="permission-toggle">
                    <span class="permission-label">Catalog Management</span>
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
                <div class="permission-toggle">
                    <span class="permission-label">Circulation Control</span>
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
                <div class="permission-toggle">
                    <span class="permission-label">User Management</span>
                    <label class="toggle-switch">
                        <input type="checkbox">
                        <span class="toggle-slider"></span>
                    </label>
                </div>
                <div class="permission-toggle">
                    <span class="permission-label">Reports & Analytics</span>
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
                <div class="permission-toggle">
                    <span class="permission-label">System Configuration</span>
                    <label class="toggle-switch">
                        <input type="checkbox">
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                <button class="save-btn w-100">
                    <i class="ri-save-line"></i> Save Permissions
                </button>
            </div>
        </div>
    </div>

    <!-- System Settings -->
    <div class="row g-3 mb-4">
        <div class="col-xl-6">
            <div class="config-card">
                <div class="section-header">
                    <h5>Library Information</h5>
                </div>
                <div class="form-group">
                    <label>Library Name</label>
                    <input type="text" value="Campus Central Library" placeholder="Enter library name">
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <textarea placeholder="Enter library address">123 University Avenue, Campus Building A</textarea>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Contact Number</label>
                            <input type="text" value="+63 123 456 7890" placeholder="Enter contact number">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" value="library@campus.edu" placeholder="Enter email">
                        </div>
                    </div>
                </div>
                <button class="save-btn">
                    <i class="ri-save-line"></i> Save Changes
                </button>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="config-card">
                <div class="section-header">
                    <h5>Borrowing Policies</h5>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Borrowing Duration (Days)</label>
                            <input type="number" value="14" placeholder="Days">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Grace Period (Days)</label>
                            <input type="number" value="3" placeholder="Days">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Fine Rate (per day)</label>
                            <input type="number" value="10" placeholder="Amount">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Maximum Fine Cap</label>
                            <input type="number" value="500" placeholder="Amount">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Maximum Books per User</label>
                    <input type="number" value="5" placeholder="Number of books">
                </div>
                <button class="save-btn">
                    <i class="ri-save-line"></i> Save Policies
                </button>
            </div>
        </div>
    </div>

    <!-- Backup & Security -->
    <div class="row g-3 mb-4">
        <div class="col-xl-7">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title d-flex justify-content-between mb-3">
                        Backup History
                        <button type="button" class="btn btn-md btn-success">
                            <i class="ri-play-line"></i> Run Backup Now
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
                            <form method="GET" action="#" class="custom_form" enctype="multipart/form-data">
                                <div class="search">
                                    <input type="text" class="form-control" placeholder="Search backups..." name="search" value="{{ request('search') }}"> 
                                    <button class="btn btn-sm btn-primary">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="backup-list">
                        <div class="backup-item">
                            <div class="backup-info">
                                <div class="backup-name">backup_2025_11_01_02_00.sql</div>
                                <div class="backup-details">Nov 01, 2025 - 2:00 AM • Size: 45.3 MB • Automatic</div>
                            </div>
                            <div class="backup-actions">
                                <button class="btn btn-outline-success btn-sm" title="Restore">
                                    <i class="mdi mdi-upload"></i>
                                </button>
                                <button class="btn btn-outline-info btn-sm" title="Download">
                                    <i class="mdi mdi-download"></i>
                                </button>
                                <button class="btn btn-outline-danger btn-sm" title="Delete">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </div>
                        </div>

                        <div class="backup-item">
                            <div class="backup-info">
                                <div class="backup-name">backup_2025_10_31_02_00.sql</div>
                                <div class="backup-details">Oct 31, 2025 - 2:00 AM • Size: 44.8 MB • Automatic</div>
                            </div>
                            <div class="backup-actions">
                                <button class="btn btn-outline-success btn-sm" title="Restore">
                                    <i class="mdi mdi-upload"></i>
                                </button>
                                <button class="btn btn-outline-info btn-sm" title="Download">
                                    <i class="mdi mdi-download"></i>
                                </button>
                                <button class="btn btn-outline-danger btn-sm" title="Delete">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </div>
                        </div>

                        <div class="backup-item">
                            <div class="backup-info">
                                <div class="backup-name">backup_2025_10_30_02_00.sql</div>
                                <div class="backup-details">Oct 30, 2025 - 2:00 AM • Size: 44.5 MB • Automatic</div>
                            </div>
                            <div class="backup-actions">
                                <button class="btn btn-outline-success btn-sm" title="Restore">
                                    <i class="mdi mdi-upload"></i>
                                </button>
                                <button class="btn btn-outline-info btn-sm" title="Download">
                                    <i class="mdi mdi-download"></i>
                                </button>
                                <button class="btn btn-outline-danger btn-sm" title="Delete">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-wrapper">
                        <div class="pagination-info">
                            Showing 1 to 3 of 12 entries
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
                                    <a class="page-link" href="#">4</a>
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

        <div class="col-xl-5">
            <div class="config-card backup">
                <div class="section-header">
                    <h5>Backup Schedule</h5>
                </div>
                <div class="form-group">
                    <label>Backup Frequency</label>
                    <select>
                        <option selected>Daily</option>
                        <option>Weekly</option>
                        <option>Monthly</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Backup Time</label>
                    <input type="time" value="02:00">
                </div>
                <div class="form-group">
                    <label>Retention Period (Days)</label>
                    <input type="number" value="30" placeholder="Keep backups for">
                </div>
                <div class="permission-toggle mb-1">
                    <span class="permission-label">Email Notification</span>
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
                <button class="save-btn w-100 mt-2">
                    <i class="ri-save-line"></i> Save Schedule
                </button>
            </div>

            <div class="config-card">
                <div class="section-header">
                    <h5>SSO Integration</h5>
                </div>
                <div class="permission-toggle">
                    <span class="permission-label">Campus SSO Enabled</span>
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
                <div class="form-group mt-3">
                    <label>SSO Endpoint URL</label>
                    <input type="text" value="https://sso.campus.edu/auth" placeholder="Enter SSO URL">
                </div>
                <div class="form-group">
                    <label>API Key</label>
                    <input type="password" value="••••••••••••••••" placeholder="Enter API key">
                </div>
                <button class="save-btn w-100">
                    <i class="ri-save-line"></i> Update Integration
                </button>
            </div>
        </div>
    </div>

@endsection