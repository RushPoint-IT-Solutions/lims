@extends('layouts.header')

@section('css')
<style>
    .btn-md {
        border: none !important;
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
    
    .fine-badge {
        padding: 3px 10px;
        border-radius: 15px;
        font-size: 11px;
        font-weight: 600;
        background: #ffe5e5;
        color: #c92a2a;
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
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title d-flex justify-content-between mb-3">
                    Active Transactions
                    <div>
                        <button type="button" class="btn btn-md btn-primary" data-bs-toggle="modal" data-bs-target="#borrowModal">
                            <i class="ri-add-line"></i> New Borrow
                        </button>
                        <button type="button" class="btn btn-md btn-success ms-2" data-bs-toggle="modal" data-bs-target="#returnModal">
                            <i class="ri-arrow-go-back-line"></i> Return Item
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
                                <input type="text" class="form-control" placeholder="Search by patron, book title..." name="search" value="{{ request('search') }}"> 
                                <button class="btn btn-sm btn-primary">Search</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Actions</th>
                                <th>Transaction ID</th>
                                <th>Patron</th>
                                <th>Book Title</th>
                                <th>Borrow Date</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th>Fine</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <button class="btn btn-outline-info btn-sm" title="Renew">
                                        <i class="mdi mdi-refresh"></i>
                                    </button>
                                    <button class="btn btn-outline-success btn-sm" title="Return">
                                        <i class="mdi mdi-keyboard-return"></i>
                                    </button>
                                </td>
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
                            </tr>
                            <tr style="background: #fff5f5;">
                                <td>
                                    <button class="btn btn-outline-danger btn-sm" title="Return with Fine">
                                        <i class="mdi mdi-keyboard-return"></i>
                                    </button>
                                    <button class="btn btn-outline-secondary btn-sm" title="Send Notice">
                                        <i class="mdi mdi-email"></i>
                                    </button>
                                </td>
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
                            </tr>
                            <tr>
                                <td>
                                    <button class="btn btn-outline-info btn-sm" title="Renew">
                                        <i class="mdi mdi-refresh"></i>
                                    </button>
                                    <button class="btn btn-outline-success btn-sm" title="Return">
                                        <i class="mdi mdi-keyboard-return"></i>
                                    </button>
                                </td>
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
                            </tr>
                            <tr>
                                <td>
                                    <button class="btn btn-outline-primary btn-sm" title="Process">
                                        <i class="mdi mdi-check"></i>
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm" title="Cancel">
                                        <i class="mdi mdi-close"></i>
                                    </button>
                                </td>
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
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper">
                    <div class="pagination-info">
                        Showing 1 to 4 of 156 entries
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
                                <a class="page-link" href="#">5</a>
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

{{-- @include('modals/borrow_modal')
@include('modals/return_modal') --}}

@endsection