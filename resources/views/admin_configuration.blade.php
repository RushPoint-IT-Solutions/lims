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
        height: 100%;
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
    
    .action-btn {
        padding: 6px 12px;
        border-radius: 4px;
        border: none;
        background: #f8f9fa;
        color: #6c757d;
        cursor: pointer;
        font-size: 13px;
    }
    
    .action-btn:hover {
        background: #e9ecef;
        color: #495057;
    }
    
    .action-btn.primary {
        background: #4a90e2;
        color: white;
    }
    
    .action-btn.primary:hover {
        background: #357abd;
    }
    
    .action-btn.danger {
        background: #dc3545;
        color: white;
    }
    
    .action-btn.danger:hover {
        background: #c82333;
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
            <div class="previlages table-responsive">
                <div class="section-header">
                    <h5>User Roles & Privileges</h5>
                    <a href="#" class="add-new-btn" data-bs-toggle="modal" data-bs-target="#addRoleModal">
                        <i class="ri-add-line"></i> ADD NEW ROLE
                    </a>
                </div>
                <table class="table table-hover">
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
                                <div>
                                    <span class="role-badge role-admin">Admin</span>
                                </div>
                            </td>
                            <td><strong>3</strong></td>
                            <td><small class="text-muted">Full Access</small></td>
                            <td><span class="status-active">Active</span></td>
                            <td>
                                <button class="action-btn" title="Edit Permissions"><i class="ri-edit-line"></i></button>
                                <button class="action-btn" title="View Users"><i class="ri-group-line"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div>
                                    <span class="role-badge role-librarian">Librarian</span>
                                </div>
                            </td>
                            <td><strong>8</strong></td>
                            <td><small class="text-muted">Catalog, Circulation, Reports</small></td>
                            <td><span class="status-active">Active</span></td>
                            <td>
                                <button class="action-btn" title="Edit Permissions"><i class="ri-edit-line"></i></button>
                                <button class="action-btn" title="View Users"><i class="ri-group-line"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div>
                                    <span class="role-badge role-faculty">Faculty</span>
                                </div>
                            </td>
                            <td><strong>245</strong></td>
                            <td><small class="text-muted">Borrow, Reserve, View Catalog</small></td>
                            <td><span class="status-active">Active</span></td>
                            <td>
                                <button class="action-btn" title="Edit Permissions"><i class="ri-edit-line"></i></button>
                                <button class="action-btn" title="View Users"><i class="ri-group-line"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div>
                                    <span class="role-badge role-student">Student</span>
                                </div>
                            </td>
                            <td><strong>2,591</strong></td>
                            <td><small class="text-muted">Borrow, Reserve, View Catalog</small></td>
                            <td><span class="status-active">Active</span></td>
                            <td>
                                <button class="action-btn" title="Edit Permissions"><i class="ri-edit-line"></i></button>
                                <button class="action-btn" title="View Users"><i class="ri-group-line"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
            <div class="config-card backup-history-wrapper">
                <div class="section-header">
                    <h5>Backup History</h5>
                    <button class="action-btn primary">
                        <i class="ri-play-line"></i> Run Backup Now
                    </button>
                </div>

                <div class="backup-list">
                    <div class="backup-item">
                        <div class="backup-info">
                            <div class="backup-name">backup_2025_11_01_02_00.sql</div>
                            <div class="backup-details">Nov 01, 2025 - 2:00 AM • Size: 45.3 MB • Automatic</div>
                        </div>
                        <div class="backup-actions">
                            <button class="action-btn primary" title="Restore"><i class="ri-upload-line"></i> Restore</button>
                            <button class="action-btn" title="Download"><i class="ri-download-line"></i></button>
                            <button class="action-btn danger" title="Delete"><i class="ri-delete-bin-line"></i></button>
                        </div>
                    </div>

                    <div class="backup-item">
                        <div class="backup-info">
                            <div class="backup-name">backup_2025_10_31_02_00.sql</div>
                            <div class="backup-details">Oct 31, 2025 - 2:00 AM • Size: 44.8 MB • Automatic</div>
                        </div>
                        <div class="backup-actions">
                            <button class="action-btn primary" title="Restore"><i class="ri-upload-line"></i> Restore</button>
                            <button class="action-btn" title="Download"><i class="ri-download-line"></i></button>
                            <button class="action-btn danger" title="Delete"><i class="ri-delete-bin-line"></i></button>
                        </div>
                    </div>

                    <div class="backup-item">
                        <div class="backup-info">
                            <div class="backup-name">backup_2025_10_30_02_00.sql</div>
                            <div class="backup-details">Oct 30, 2025 - 2:00 AM • Size: 44.5 MB • Automatic</div>
                        </div>
                        <div class="backup-actions">
                            <button class="action-btn primary" title="Restore"><i class="ri-upload-line"></i> Restore</button>
                            <button class="action-btn" title="Download"><i class="ri-download-line"></i></button>
                            <button class="action-btn danger" title="Delete"><i class="ri-delete-bin-line"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-5">
            <div class="config-card">
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
                <div class="permission-toggle">
                    <span class="permission-label">Email Notification</span>
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
                <button class="save-btn w-100">
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