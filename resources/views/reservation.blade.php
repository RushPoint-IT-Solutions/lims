@extends('layouts.header')

@section('css')
<style>
    .book-card {
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s;
        cursor: pointer;
        background: white;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    .book-card:hover {
        transform: translateY(-5px);
    }
    .book-card img {
        width: 100%;
        height: 250px;
        object-fit: fit;
    }
    .book-card .book-info {
        padding: 15px;
        background: white;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
    }
    
    .book-card .book-title {
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 5px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    
    .book-card .book-author {
        font-size: 12px;
        color: #6c757d;
        margin-bottom: 8px;
    }
    
    .book-card .book-stats {
        font-size: 11px;
        color: #6c757d;
        margin-bottom: 10px;
    }
    
    .book-card .book-reserve-btn {
        background: #4a90e2;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 5px;
        font-size: 12px;
        cursor: pointer;
        width: 100%;
        transition: all 0.3s;
    }
    
    .book-card .book-reserve-btn:hover {
        background: #357abd;
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
        background: #cfe2ff;
        color: #084298;
    }
    
    .status-ready {
        background: #d1e7dd;
        color: #0f5132;
    }
    
    .status-expired {
        background: #e2e3e5;
        color: #41464b;
    }
    
    .status-cancelled {
        background: #f8d7da;
        color: #842029;
    }
    
    .availability-badge {
        padding: 3px 10px;
        border-radius: 15px;
        font-size: 11px;
        font-weight: 600;
    }
    
    .avail-available {
        background: #d1f4e0;
        color: #0f5132;
    }
    
    .avail-borrowed {
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
    
    .book-search-card {
        background: white;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
    
    .book-item {
        display: flex;
        gap: 15px;
        padding: 15px;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        margin-bottom: 15px;
        transition: all 0.3s;
    }
    
    .book-item:hover {
        border-color: #4a90e2;
        box-shadow: 0 2px 8px rgba(74, 144, 226, 0.1);
    }
    
    .book-item img {
        width: 80px;
        height: 110px;
        object-fit: cover;
        border-radius: 5px;
    }
    
    .book-item-info {
        flex: 1;
    }
    
    .book-item-title {
        font-size: 16px;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 5px;
    }
    
    .book-item-author {
        font-size: 14px;
        color: #6c757d;
        margin-bottom: 8px;
    }
    
    .book-item-details {
        font-size: 12px;
        color: #95a5a6;
    }
    
    .reserve-btn {
        background: #4a90e2;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 5px;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .reserve-btn:hover {
        background: #357abd;
    }
    
    .reserve-btn:disabled {
        background: #e9ecef;
        color: #6c757d;
        cursor: not-allowed;
    }
</style>
@endsection

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="mb-0">Book Reservation</h4>
            <p class="text-muted mb-0">Reserve books online and manage your hold requests</p>
        </div>
    </div>

    <!-- Dashboard Cards -->
    <div class="row g-3 mb-4">
        <div class="col-xl-4 col-md-6">
            <div class="dashboard-card">
                {{-- <div class="icon-circle" style="background: #4a90e2;"> --}}
                <div class="icon-circle">
                    <i class="ri-bookmark-line"></i>
                </div>
                <h2>3</h2>
                <p>My Active Reservations</p>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="dashboard-card">
                {{-- <div class="icon-circle" style="background: #27ae60;"> --}}
                <div class="icon-circle">
                    <i class="ri-checkbox-circle-line"></i>
                </div>
                <h2>1</h2>
                <p>Ready for Pickup</p>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="dashboard-card">
                {{-- <div class="icon-circle" style="background: #f39c12;"> --}}
                <div class="icon-circle">
                    <i class="ri-time-line"></i>    
                </div>
                <h2>2</h2>
                <p>Pending Availability</p>
            </div>
        </div>
    </div>

    <!-- Top Choices / Popular Books -->
    <div class="row mb-1">
        <div class="col-12">
            <div class="section-header">
                <h5>Popular Books This Month</h5>
                <a href="#" class="text-primary" style="font-size: 14px; text-decoration: none;">View All →</a>
            </div>
        </div>
    </div>
    <div class="row g-3 mb-4">
        <div class="col-lg-2 col-md-4 col-6">
            <div class="book-card">
                <img src="{{asset('assets/images/book1.jpg')}}" alt="Book Cover">
                <div class="book-info">
                    <div class="book-title">Clean Code</div>
                    <div class="book-author">Robert C. Martin</div>
                    <div class="book-stats">★★★★★ • 156 borrows</div>
                    <button class="book-reserve-btn"><i class="ri-bookmark-line"></i> Reserve</button>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-6">
            <div class="book-card">
                <img src="{{asset('assets/images/book2.jpg')}}" alt="Book Cover">
                <div class="book-info">
                    <div class="book-title">Intro to Algorithms</div>
                    <div class="book-author">Thomas H. Cormen</div>
                    <div class="book-stats">★★★★★ • 142 borrows</div>
                    <button class="book-reserve-btn"><i class="ri-bookmark-line"></i> Reserve</button>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-6">
            <div class="book-card">
                <img src="{{asset('assets/images/book3.jpg')}}" alt="Book Cover">
                <div class="book-info">
                    <div class="book-title">Database Systems</div>
                    <div class="book-author">Silberschatz</div>
                    <div class="book-stats">★★★★☆ • 138 borrows</div>
                    <button class="book-reserve-btn"><i class="ri-bookmark-line"></i> Reserve</button>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-6">
            <div class="book-card">
                <img src="{{asset('assets/images/book4.jpg')}}" alt="Book Cover">
                <div class="book-info">
                    <div class="book-title">Design Patterns</div>
                    <div class="book-author">Gang of Four</div>
                    <div class="book-stats">★★★★★ • 125 borrows</div>
                    <button class="book-reserve-btn"><i class="ri-bookmark-line"></i> Reserve</button>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-6">
            <div class="book-card">
                <img src="{{asset('assets/images/book5.jpg')}}" alt="Book Cover">
                <div class="book-info">
                    <div class="book-title">Refactoring</div>
                    <div class="book-author">Martin Fowler</div>
                    <div class="book-stats">★★★★★ • 118 borrows</div>
                    <button class="book-reserve-btn"><i class="ri-bookmark-line"></i> Reserve</button>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-6">
            <div class="book-card">
                <img src="{{asset('assets/images/book6.jpg')}}" alt="Book Cover">
                <div class="book-info">
                    <div class="book-title">Pragmatic Programmer</div>
                    <div class="book-author">Andy Hunt</div>
                    <div class="book-stats">★★★★★ • 112 borrows</div>
                    <button class="book-reserve-btn"><i class="ri-bookmark-line"></i> Reserve</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Search & Reserve Books -->
    <div class="row g-3 mb-4">
        <div class="col-12">
            <div class="book-search-card">
                <div class="section-header">
                    <h5>Search & Reserve Books</h5>
                </div>
                
                <div class="d-flex justify-content-end mb-3">
                    <div class="search-control">
                        <input type="text" placeholder="Search by title, author, ISBN..." style="width: 400px;">
                        <i class="ri-search-line"></i>
                    </div>
                </div>

                <!-- Available Books for Reservation -->
                <div class="book-item">
                    <img src="{{asset('assets/images/book1.jpg')}}" alt="Book Cover">
                    <div class="book-item-info">
                        <div class="book-item-title">Clean Code: A Handbook of Agile Software Craftsmanship</div>
                        <div class="book-item-author">by Robert C. Martin</div>
                        <div class="book-item-details">
                            <span>ISBN: 978-0132350884</span> | 
                            <span>Call No: 005.1 MAR</span> | 
                            <span>Location: Computer Science Section</span>
                        </div>
                        <div class="mt-2">
                            <span class="availability-badge avail-borrowed">Currently Borrowed</span>
                            <small class="text-muted ms-2">Expected return: Nov 08, 2025</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <button class="reserve-btn">
                            <i class="ri-bookmark-line"></i> Reserve
                        </button>
                    </div>
                </div>

                <div class="book-item">
                    <img src="{{asset('assets/images/book2.jpg')}}" alt="Book Cover">
                    <div class="book-item-info">
                        <div class="book-item-title">Introduction to Algorithms</div>
                        <div class="book-item-author">by Thomas H. Cormen, Charles E. Leiserson</div>
                        <div class="book-item-details">
                            <span>ISBN: 978-0262033848</span> | 
                            <span>Call No: 005.1 COR</span> | 
                            <span>Location: Computer Science Section</span>
                        </div>
                        <div class="mt-2">
                            <span class="availability-badge avail-available">Available (2 copies)</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <button class="reserve-btn">
                            <i class="ri-bookmark-line"></i> Reserve
                        </button>
                    </div>
                </div>

                <div class="book-item">
                    <img src="{{asset('assets/images/book3.jpg')}}" alt="Book Cover">
                    <div class="book-item-info">
                        <div class="book-item-title">Database System Concepts</div>
                        <div class="book-item-author">by Abraham Silberschatz, Henry F. Korth</div>
                        <div class="book-item-details">
                            <span>ISBN: 978-0073523323</span> | 
                            <span>Call No: 005.74 SIL</span> | 
                            <span>Location: Computer Science Section</span>
                        </div>
                        <div class="mt-2">
                            <span class="availability-badge avail-available">Available (1 copy)</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <button class="reserve-btn">
                            <i class="ri-bookmark-line"></i> Reserve
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- My Reservations -->
    <div class="row g-3 mb-4">
        <div class="col-12">
            <div class="table-responsive">
                <div class="section-header">
                    <h5>My Reservations</h5>
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
                        <input type="text" placeholder="Search reservations...">
                        <i class="ri-search-line"></i>
                    </div>
                </div>
                
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Reservation ID</th>
                            <th>Book Title</th>
                            <th>Reserved Date</th>
                            <th>Pickup Deadline</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="background: #f0f9ff;">
                            <td><strong>RSV-2025-00123</strong></td>
                            <td>
                                <div>
                                    <div class="fw-bold">Design Patterns</div>
                                    <small class="text-muted">by Gang of Four</small>
                                </div>
                            </td>
                            <td>Oct 28, 2025</td>
                            <td><strong class="text-primary">Nov 05, 2025</strong></td>
                            <td><span class="status-badge status-ready">Ready for Pickup</span></td>
                            <td>
                                <button class="action-btn" title="View Details"><i class="ri-eye-line"></i></button>
                                <button class="action-btn" title="Cancel"><i class="ri-close-line"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>RSV-2025-00124</strong></td>
                            <td>
                                <div>
                                    <div class="fw-bold">Clean Code: A Handbook</div>
                                    <small class="text-muted">by Robert C. Martin</small>
                                </div>
                            </td>
                            <td>Oct 30, 2025</td>
                            <td><em class="text-muted">Waiting for return</em></td>
                            <td><span class="status-badge status-active">Active - In Queue</span></td>
                            <td>
                                <button class="action-btn" title="View Details"><i class="ri-eye-line"></i></button>
                                <button class="action-btn" title="Cancel"><i class="ri-close-line"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>RSV-2025-00125</strong></td>
                            <td>
                                <div>
                                    <div class="fw-bold">Refactoring</div>
                                    <small class="text-muted">by Martin Fowler</small>
                                </div>
                            </td>
                            <td>Nov 01, 2025</td>
                            <td><em class="text-muted">Waiting for return</em></td>
                            <td><span class="status-badge status-active">Active - Position #2</span></td>
                            <td>
                                <button class="action-btn" title="View Details"><i class="ri-eye-line"></i></button>
                                <button class="action-btn" title="Cancel"><i class="ri-close-line"></i></button>
                            </td>
                        </tr>
                        <tr style="background: #f8f9fa;">
                            <td><strong>RSV-2025-00098</strong></td>
                            <td>
                                <div>
                                    <div class="fw-bold">The Pragmatic Programmer</div>
                                    <small class="text-muted">by Andy Hunt</small>
                                </div>
                            </td>
                            <td>Oct 20, 2025</td>
                            <td>Oct 27, 2025</td>
                            <td><span class="status-badge status-expired">Expired</span></td>
                            <td>
                                <button class="action-btn" title="View Details"><i class="ri-eye-line"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <div class="table-footer">
                    <div class="pagination-info">
                        Showing 1 to 4 of 4 entries
                    </div>
                    <nav>
                        <ul class="pagination mb-0">
                            <li class="page-item disabled"><a class="page-link" href="#">‹</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">›</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

@endsection