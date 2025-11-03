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
    
    .status-borrowed {
        background: #cfe2ff;
        color: #084298;
    }
    
    .status-overdue {
        background: #f8d7da;
        color: #842029;
    }
    
    .status-reserved {
        background: #fff3cd;
        color: #856404;
    }
    
    .status-returned {
        background: #d1e7dd;
        color: #0f5132;
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
    
    .fine-badge {
        padding: 3px 10px;
        border-radius: 15px;
        font-size: 11px;
        font-weight: 600;
        background: #ffe5e5;
        color: #c92a2a;
    }
</style>
@endsection

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="mb-0">Circulation & Borrowing Management</h4>
            <p class="text-muted mb-0">Borrow, renew, return, and reserve functions with automated fine computation</p>
        </div>
    </div>

    <!-- Dashboard Cards -->
    <div class="row g-3 mb-4">
        <div class="col-xl-4 col-md-6">
            <div class="dashboard-card">
                <div class="icon-circle">
                    <i class="ri-book-open-line"></i>
                </div>
                <h2>156</h2>
                <p>Currently Borrowed</p>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="dashboard-card">
                <div class="icon-circle">
                    <i class="ri-alert-line"></i>
                </div>
                <h2>23</h2>
                <p>Overdue Items</p>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="dashboard-card">
                <div class="icon-circle">
                    <i class="ri-bookmark-line"></i>
                </div>
                <h2>12</h2>
                <p>Active Reservations</p>
            </div>
        </div>
    </div>

    <!-- Main Circulation Section -->
    <div class="row g-3 mb-4">
        <div class="col-12">
            <div class="table-responsive">
                <div class="section-header">
                    <h5>Active Transactions</h5>
                    <div>
                        <a href="#" class="add-new-btn" data-bs-toggle="modal" data-bs-target="#borrowModal">
                            <i class="ri-add-line"></i> NEW BORROW
                        </a>
                        <a href="#" class="add-new-btn ms-2" style="background: #27ae60;" data-bs-toggle="modal" data-bs-target="#returnModal">
                            <i class="ri-arrow-go-back-line"></i> RETURN ITEM
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
                        <input type="text" placeholder="Search by patron, book title...">
                        <i class="ri-search-line"></i>
                    </div>
                </div>
                
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Patron</th>
                            <th>Book Title</th>
                            <th>Borrow Date</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Fine</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>TXN-2025-00523</strong></td>
                            <td>
                                <div>
                                    <div class="fw-bold">John Martinez</div>
                                    <small class="text-muted">ID: STU-2024-001</small>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <div>Clean Code: A Handbook</div>
                                    <small class="text-muted">BC-2025-001247</small>
                                </div>
                            </td>
                            <td>Oct 18, 2025</td>
                            <td>Nov 01, 2025</td>
                            <td><span class="status-badge status-borrowed">Borrowed</span></td>
                            <td>-</td>
                            <td>
                                <button class="action-btn" title="Renew"><i class="ri-refresh-line"></i></button>
                                <button class="action-btn" title="Return"><i class="ri-arrow-go-back-line"></i></button>
                                <button class="action-btn" title="Details"><i class="ri-file-list-line"></i></button>
                            </td>
                        </tr>
                        <tr style="background: #fff5f5;">
                            <td><strong>TXN-2025-00489</strong></td>
                            <td>
                                <div>
                                    <div class="fw-bold">Maria Santos</div>
                                    <small class="text-muted">ID: STU-2024-042</small>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <div>Introduction to Algorithms</div>
                                    <small class="text-muted">BC-2025-001246</small>
                                </div>
                            </td>
                            <td>Oct 05, 2025</td>
                            <td>Oct 19, 2025</td>
                            <td><span class="status-badge status-overdue">Overdue</span></td>
                            <td><span class="fine-badge">₱130.00</span></td>
                            <td>
                                <button class="action-btn" title="Return with Fine"><i class="ri-arrow-go-back-line"></i></button>
                                <button class="action-btn" title="Send Notice"><i class="ri-mail-send-line"></i></button>
                                <button class="action-btn" title="Details"><i class="ri-file-list-line"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>TXN-2025-00510</strong></td>
                            <td>
                                <div>
                                    <div class="fw-bold">Carlos Rivera</div>
                                    <small class="text-muted">ID: STU-2024-089</small>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <div>Database Systems Concepts</div>
                                    <small class="text-muted">BC-2025-001244</small>
                                </div>
                            </td>
                            <td>Oct 25, 2025</td>
                            <td>Nov 08, 2025</td>
                            <td><span class="status-badge status-borrowed">Borrowed</span></td>
                            <td>-</td>
                            <td>
                                <button class="action-btn" title="Renew"><i class="ri-refresh-line"></i></button>
                                <button class="action-btn" title="Return"><i class="ri-arrow-go-back-line"></i></button>
                                <button class="action-btn" title="Details"><i class="ri-file-list-line"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>RSV-2025-00045</strong></td>
                            <td>
                                <div>
                                    <div class="fw-bold">Ana Lopez</div>
                                    <small class="text-muted">ID: STU-2024-156</small>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <div>Clean Code: A Handbook</div>
                                    <small class="text-muted">BC-2025-001247</small>
                                </div>
                            </td>
                            <td>-</td>
                            <td>-</td>
                            <td><span class="status-badge status-reserved">Reserved</span></td>
                            <td>-</td>
                            <td>
                                <button class="action-btn" title="Process"><i class="ri-check-line"></i></button>
                                <button class="action-btn" title="Cancel"><i class="ri-close-line"></i></button>
                                <button class="action-btn" title="Notify"><i class="ri-notification-line"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <div class="table-footer">
                    <div class="pagination-info">
                        Showing 1 to 4 of 191 entries
                    </div>
                    <nav>
                        <ul class="pagination mb-0">
                            <li class="page-item disabled"><a class="page-link" href="#">‹</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="#">48</a></li>
                            <li class="page-item"><a class="page-link" href="#">›</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

{{-- @include('modals/borrow_modal')
@include('modals/return_modal') --}}

@endsection