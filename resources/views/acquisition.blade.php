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
        background: #d07e0a;
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 5px;
        font-size: 14px;
        text-decoration: none;
        display: inline-block;
    }
    
    .add-new-btn:hover {
        background: #ff5252;
        color: white;
    }
    
    .table-responsive {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .budget {
        height: 100%;
    }
    
    .status-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }
    
    .status-pending {
        background: #fff3cd;
        color: #856404;
    }
    
    .status-approved {
        background: #d1e7dd;
        color: #0f5132;
    }
    
    .status-received {
        background: #cfe2ff;
        color: #084298;
    }
    
    .view-all-btn {
        color: #d07e0a;
        text-decoration: none;
        font-size: 14px;
    }
    
    .view-all-btn:hover {
        text-decoration: underline;
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
    
    .search-control,
    .search-controls {
        position: relative;
    }
    
    .search-control input,
    .search-controls input {
        padding: 5px 35px 5px 15px;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        font-size: 14px;
        width: 250px;
    }
    
    .search-control i,
    .search-controls i {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
    }

    .search-controls input {
        padding: 5px 35px 5px 15px;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        font-size: 14px;
        width: 150px;
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
</style>
@endsection

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="mb-0">Acquisition Management</h4>
            <p class="text-muted mb-0">Manage library material selection, ordering, and receipt</p>
        </div>
    </div>

    <!-- Dashboard Cards -->
    <div class="row g-3 mb-4">
        <div class="col-xl-4 col-md-4">
            <div class="dashboard-card">
                <div class="icon-circle">
                    <i class="ri-file-list-line"></i>
                </div>
                <h2>24</h2>
                <p>Pending Requests</p>
            </div>
        </div>
        <div class="col-xl-4 col-md-4">
            <div class="dashboard-card">
                <div class="icon-circle">
                    <i class="ri-shopping-cart-line"></i>
                </div>
                <h2>15</h2>
                <p>Active Orders</p>
            </div>
        </div>
        <div class="col-xl-4 col-md-4">
            <div class="dashboard-card">
                <div class="icon-circle">
                    <i class="ri-money-dollar-circle-line"></i>
                </div>
                <h2>₱157,150</h2>
                <p>Budget Remaining</p>
            </div>
        </div>
    </div>

    <!-- Material Requests and Suppliers -->
    <div class="row g-3 mb-4">
        <div class="col-xl-8">
            <div class="table-responsive">
                <div class="section-header">
                    <h5>Material Requests</h5>
                    <a href="#" class="add-new-btn" data-bs-toggle="modal" data-bs-target="#newRequestModal">NEW REQUEST</a>
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
                        <input type="text" placeholder="Search...">
                        <i class="ri-search-line"></i>
                    </div>
                </div>
                
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Request ID</th>
                            <th>Title</th>
                            <th>Requested By</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>REQ-001</td>
                            <td>
                                <div>
                                    <div class="fw-bold">Introduction to Python</div>
                                    <small class="text-muted">Mark Lutz</small>
                                </div>
                            </td>
                            <td>Alex Roy</td>
                            <td>Oct 28, 2025</td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                            <td><i class="ri-more-2-fill"></i></td>
                        </tr>
                        <tr>
                            <td>REQ-002</td>
                            <td>
                                <div>
                                    <div class="fw-bold">Data Science Handbook</div>
                                    <small class="text-muted">Jake VanderPlas</small>
                                </div>
                            </td>
                            <td>Jenny</td>
                            <td>Oct 25, 2025</td>
                            <td><span class="status-badge status-approved">Approved</span></td>
                            <td><i class="ri-more-2-fill"></i></td>
                        </tr>
                        <tr>
                            <td>REQ-003</td>
                            <td>
                                <div>
                                    <div class="fw-bold">Clean Code</div>
                                    <small class="text-muted">Robert C. Martin</small>
                                </div>
                            </td>
                            <td>Jesus</td>
                            <td>Oct 24, 2025</td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                            <td><i class="ri-more-2-fill"></i></td>
                        </tr>
                        <tr>
                            <td>REQ-004</td>
                            <td>
                                <div>
                                    <div class="fw-bold">Pharmacy Practice</div>
                                    <small class="text-muted">Sarah Wilson</small>
                                </div>
                            </td>
                            <td>Rena</td>
                            <td>Oct 20, 2025</td>
                            <td><span class="status-badge status-approved">Approved</span></td>
                            <td><i class="ri-more-2-fill"></i></td>
                        </tr>
                    </tbody>
                </table>
                
                <div class="table-footer">
                    <div class="pagination-info">
                        Showing 1 to 4 of 24 entries
                    </div>
                    <nav>
                        <ul class="pagination mb-0">
                            <li class="page-item disabled"><a class="page-link" href="#">‹</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">›</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="table-responsive">
                <div class="section-header">
                    <h5>Suppliers</h5>
                    <a href="#" class="add-new-btn">ADD SUPPLIER</a>
                </div>
                
                <div class="table-controls">
                    <div class="entries-control">
                        <span>Show</span>
                        <select>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                        <span>entries</span>
                    </div>
                    <div class="search-controls">
                        <input type="text" placeholder="Search...">
                        <i class="ri-search-line"></i>
                    </div>
                </div>
                
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Supplier</th>
                            <th>Contact</th>
                            <th>Orders</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="fw-bold">National Bookstore</div>
                                <small class="text-muted">orders@nbs.com</small>
                            </td>
                            <td>(02) 8888-7777</td>
                            <td>45</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="fw-bold">Rex Bookstore</div>
                                <small class="text-muted">sales@rex.com</small>
                            </td>
                            <td>(02) 8732-4567</td>
                            <td>32</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="fw-bold">Fully Booked</div>
                                <small class="text-muted">info@fb.com.ph</small>
                            </td>
                            <td>(02) 8856-1234</td>
                            <td>28</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="fw-bold">Bestsellers</div>
                                <small class="text-muted">orders@best.com</small>
                            </td>
                            <td>(02) 8765-4321</td>
                            <td>21</td>
                        </tr>
                    </tbody>
                </table>
                
                <div class="table-footer">
                    <div class="pagination-info">
                        Showing 1 to 4 of 12 entries
                    </div>
                    <nav>
                        <ul class="pagination mb-0">
                            <li class="page-item disabled"><a class="page-link" href="#">‹</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">›</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Orders and Budget Tracking -->
    <div class="row g-3 mb-4">
        <div class="col-xl-7">
            <div class="orders table-responsive">
                <div class="section-header">
                    <h5>Orders & Receipt Validation</h5>
                    <a href="#" class="add-new-btn">CREATE ORDER</a>
                </div>
                
                <div class="table-controls">
                    <div class="entries-control">
                        <span>Show</span>
                        <select>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                        <span>entries</span>
                    </div>
                    <div class="search-control">
                        <input type="text" placeholder="Search...">
                        <i class="ri-search-line"></i>
                    </div>
                </div>
                
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Supplier</th>
                            <th>Items</th>
                            <th>Amount</th>
                            <th>Order Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>ORD-001</td>
                            <td>National Bookstore</td>
                            <td>12</td>
                            <td>₱24,500</td>
                            <td>Oct 29, 2025</td>
                            <td><span class="status-badge status-pending">Processing</span></td>
                        </tr>
                        <tr>
                            <td>ORD-002</td>
                            <td>Rex Bookstore</td>
                            <td>8</td>
                            <td>₱18,200</td>
                            <td>Oct 27, 2025</td>
                            <td><span class="status-badge status-pending">Ordered</span></td>
                        </tr>
                        <tr>
                            <td>ORD-003</td>
                            <td>Fully Booked</td>
                            <td>15</td>
                            <td>₱32,800</td>
                            <td>Oct 25, 2025</td>
                            <td><span class="status-badge status-received">Received</span></td>
                        </tr>
                        <tr>
                            <td>ORD-004</td>
                            <td>Bestsellers</td>
                            <td>6</td>
                            <td>₱14,100</td>
                            <td>Oct 22, 2025</td>
                            <td><span class="status-badge status-received">Received</span></td>
                        </tr>
                        <tr>
                            <td>ORD-005</td>
                            <td>Bestsellers</td>
                            <td>6</td>
                            <td>₱14,100</td>
                            <td>Oct 22, 2025</td>
                            <td><span class="status-badge status-received">Received</span></td>
                        </tr>
                    </tbody>
                </table>
                
                <div class="table-footer">
                    <div class="pagination-info">
                        Showing 1 to 5 of 15 entries
                    </div>
                    <nav>
                        <ul class="pagination mb-0">
                            <li class="page-item disabled"><a class="page-link" href="#">‹</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">›</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="col-xl-5">
            <div class="budget table-responsive">
                <div class="section-header">
                    <h5>Budget Tracking - FY 2025</h5>
                </div>
                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span><strong>Total Budget:</strong></span>
                        <span>₱500,000.00</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span><strong>Spent:</strong></span>
                        <span class="text-danger">₱342,850.00</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span><strong>Remaining:</strong></span>
                        <span class="text-success">₱157,150.00</span>
                    </div>
                    <div class="progress" style="height: 20px;">
                        <div class="progress-bar" role="progressbar" style="width: 68.57%; background-color: #d07e0a;">68.57%</div>
                    </div>
                </div>

                <h6 class="mb-3">Recent Expenses</h6>
                <table class="table table-sm mb-4">
                    <tbody>
                        <tr>
                            <td>ORD-003</td>
                            <td>Fully Booked</td>
                            <td class="text-end">₱32,800</td>
                        </tr>
                        <tr>
                            <td>ORD-001</td>
                            <td>National Bookstore</td>
                            <td class="text-end">₱24,500</td>
                        </tr>
                        <tr>
                            <td>ORD-002</td>
                            <td>Rex Bookstore</td>
                            <td class="text-end">₱18,200</td>
                        </tr>
                        <tr>
                            <td>ORD-004</td>
                            <td>Bestsellers</td>
                            <td class="text-end">₱14,100</td>
                        </tr>
                        <tr>
                            <td>ORD-004</td>
                            <td>Bestsellers</td>
                            <td class="text-end">₱14,100</td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-end mt-2">
                    <a href="#" class="view-all-btn">View All Receipts →</a>
                </div>
            </div>
        </div>
    </div>
    
@include('modals/request_acquisition_modal')

@endsection
