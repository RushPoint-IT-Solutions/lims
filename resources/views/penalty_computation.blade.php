@extends('layouts.header')

@section('css')
<style>
    .dashboard-card {
        border-radius: 10px;
        padding: 20px;
        background: white;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        position: relative;
        overflow: hidden;
    }
    
    .dashboard-card .icon-circle {
        position: absolute;
        right: 20px;
        top: 20px;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #d07e0a;
    }
    
    .dashboard-card .icon-circle i {
        color: white;
        font-size: 20px;
    }
    
    .dashboard-card h2 {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 5px;
    }
    
    .dashboard-card p {
        color: #6c757d;
        margin: 0;
        font-size: 14px;
    }
    
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    
    .section-header h5 {
        font-size: 18px;
        font-weight: 600;
        margin: 0;
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
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .status-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }
    
    .status-overdue {
        background: #f8d7da;
        color: #842029;
    }
    
    .status-paid {
        background: #d1e7dd;
        color: #0f5132;
    }
    
    .status-pending {
        background: #fff3cd;
        color: #856404;
    }
    
    .status-waived {
        background: #e2e3e5;
        color: #41464b;
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
    
    .fine-amount {
        font-weight: 700;
        font-size: 14px;
    }
    
    .fine-high {
        color: #dc3545;
    }
    
    .fine-medium {
        color: #fd7e14;
    }
    
    .fine-low {
        color: #ffc107;
    }
    
    .computation-box {
        background: #f8f9fa;
        border-left: 4px solid #4a90e2;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 15px;
    }
    
    .computation-box h6 {
        font-size: 13px;
        font-weight: 600;
        color: #495057;
        margin-bottom: 8px;
    }
    
    .computation-box .formula {
        font-family: 'Courier New', monospace;
        background: white;
        padding: 10px;
        border-radius: 3px;
        font-size: 13px;
        margin-bottom: 8px;
    }
    
    .computation-box .note {
        font-size: 12px;
        color: #6c757d;
    }
</style>
@endsection

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="mb-0">Penalty Computation</h4>
            <p class="text-muted mb-0">Automated overdue fine calculation based on delay period</p>
        </div>
    </div>

    <!-- Dashboard Cards -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="icon-circle">
                    <i class="ri-money-dollar-circle-line"></i>
                </div>
                <h2>₱12,450</h2>
                <p>Total Fines (Unpaid)</p>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="icon-circle">
                    <i class="ri-check-double-line"></i>
                </div>
                <h2>₱8,230</h2>
                <p>Collected This Month</p>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="icon-circle">
                    <i class="ri-alert-line"></i>
                </div>
                <h2>47</h2>
                <p>Overdue Transactions</p>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="icon-circle">
                    <i class="ri-calculator-line"></i>
                </div>
                <h2>₱10/day</h2>
                <p>Current Fine Rate</p>
            </div>
        </div>
    </div>

    <!-- Computation Rules -->
    <div class="row g-3 mb-4">
        <div class="col-12">
            <div class="table-responsive">
                <div class="section-header">
                    <h5>Fine Computation Rules</h5>
                    <a href="#" class="add-new-btn" data-bs-toggle="modal" data-bs-target="#settingsModal">
                        <i class="ri-settings-3-line"></i> CONFIGURE RATES
                    </a>
                </div>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="computation-box">
                            <h6>Standard Computation Formula</h6>
                            <div class="formula">
                                Fine = Days Overdue × Daily Rate (₱10)
                            </div>
                            <div class="note">
                                <strong>Example:</strong> 5 days overdue = 5 × ₱10 = ₱50.00
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="computation-box" style="border-left-color: #27ae60;">
                            <h6>Grace Period</h6>
                            <div class="formula">
                                First 3 days = No penalty
                            </div>
                            <div class="note">
                                <strong>Note:</strong> Fines start calculating after the grace period expires
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="computation-box" style="border-left-color: #f39c12;">
                            <h6>Maximum Fine Cap</h6>
                            <div class="formula">
                                Maximum Fine = ₱500.00 per item
                            </div>
                            <div class="note">
                                <strong>Note:</strong> Prevents excessive charges for extended delays
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="computation-box" style="border-left-color: #e74c3c;">
                            <h6>Auto-Calculation Trigger</h6>
                            <div class="formula">
                                Calculated daily at 12:00 AM
                            </div>
                            <div class="note">
                                <strong>Note:</strong> System automatically updates all overdue fines
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Overdue & Fines Table -->
    <div class="row g-3 mb-4">
        <div class="col-12">
            <div class="table-responsive">
                <div class="section-header">
                    <h5>Overdue Items with Computed Fines</h5>
                    <div>
                        <a href="#" class="add-new-btn" style="background: #27ae60;">
                            <i class="ri-refresh-line"></i> RECALCULATE ALL
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
                        <input type="text" placeholder="Search by patron, book...">
                        <i class="ri-search-line"></i>
                    </div>
                </div>
                
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Patron</th>
                            <th>Book Title</th>
                            <th>Due Date</th>
                            <th>Days Overdue</th>
                            <th>Computed Fine</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="background: #fff5f5;">
                            <td><strong>TXN-2025-00489</strong></td>
                            <td>
                                <div>
                                    <div class="fw-bold">Maria Santos</div>
                                    <small class="text-muted">STU-2024-042</small>
                                </div>
                            </td>
                            <td>
                                <div>Introduction to Algorithms</div>
                                <small class="text-muted">BC-2025-001246</small>
                            </td>
                            <td>Oct 19, 2025</td>
                            <td><strong class="text-danger">13 days</strong></td>
                            <td><span class="fine-amount fine-high">₱130.00</span></td>
                            <td><span class="status-badge status-overdue">Unpaid</span></td>
                            <td>
                                <button class="action-btn" title="Mark Paid"><i class="ri-check-line"></i></button>
                                <button class="action-btn" title="Waive"><i class="ri-close-circle-line"></i></button>
                                <button class="action-btn" title="Details"><i class="ri-eye-line"></i></button>
                            </td>
                        </tr>
                        <tr style="background: #fffbf0;">
                            <td><strong>TXN-2025-00501</strong></td>
                            <td>
                                <div>
                                    <div class="fw-bold">John Martinez</div>
                                    <small class="text-muted">STU-2024-001</small>
                                </div>
                            </td>
                            <td>
                                <div>Clean Code: A Handbook</div>
                                <small class="text-muted">BC-2025-001247</small>
                            </td>
                            <td>Oct 25, 2025</td>
                            <td><strong class="text-warning">7 days</strong></td>
                            <td><span class="fine-amount fine-medium">₱70.00</span></td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                            <td>
                                <button class="action-btn" title="Mark Paid"><i class="ri-check-line"></i></button>
                                <button class="action-btn" title="Waive"><i class="ri-close-circle-line"></i></button>
                                <button class="action-btn" title="Details"><i class="ri-eye-line"></i></button>
                            </td>
                        </tr>
                        <tr style="background: #fffff0;">
                            <td><strong>TXN-2025-00512</strong></td>
                            <td>
                                <div>
                                    <div class="fw-bold">Carlos Rivera</div>
                                    <small class="text-muted">STU-2024-089</small>
                                </div>
                            </td>
                            <td>
                                <div>Database Systems Concepts</div>
                                <small class="text-muted">BC-2025-001244</small>
                            </td>
                            <td>Oct 28, 2025</td>
                            <td><strong style="color: #ffc107;">4 days</strong></td>
                            <td><span class="fine-amount fine-low">₱40.00</span></td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                            <td>
                                <button class="action-btn" title="Mark Paid"><i class="ri-check-line"></i></button>
                                <button class="action-btn" title="Waive"><i class="ri-close-circle-line"></i></button>
                                <button class="action-btn" title="Details"><i class="ri-eye-line"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>TXN-2025-00467</strong></td>
                            <td>
                                <div>
                                    <div class="fw-bold">Ana Lopez</div>
                                    <small class="text-muted">STU-2024-156</small>
                                </div>
                            </td>
                            <td>
                                <div>Design Patterns</div>
                                <small class="text-muted">BC-2025-001243</small>
                            </td>
                            <td>Oct 15, 2025</td>
                            <td><strong class="text-success">0 days</strong></td>
                            <td><span class="fine-amount" style="color: #6c757d;">₱0.00</span></td>
                            <td><span class="status-badge status-paid">Paid</span></td>
                            <td>
                                <button class="action-btn" title="View Receipt"><i class="ri-file-text-line"></i></button>
                                <button class="action-btn" title="Details"><i class="ri-eye-line"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <div class="table-footer">
                    <div class="pagination-info">
                        Showing 1 to 4 of 47 entries
                    </div>
                    <nav>
                        <ul class="pagination mb-0">
                            <li class="page-item disabled"><a class="page-link" href="#">‹</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="#">12</a></li>
                            <li class="page-item"><a class="page-link" href="#">›</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

{{-- @include('modals/settings_modal') --}}

@endsection