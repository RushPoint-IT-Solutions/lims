@extends('layouts.header')

@section('css')
<style>
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
            <h4 class="mb-0">Hello, <span class="text-danger">{{current(explode(' ',auth()->user()->name))}}!</span></h4>
            <p class="text-muted mb-0">{{ now()->format('M d, Y | l, h:i A') }}</p>
        </div>
    </div>

    <!-- Dashboard Cards -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="icon-circle">
                    <i class="ri-user-line"></i>
                </div>
                <h2>250</h2>
                <p>Total Visitors</p>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="icon-circle">
                    <i class="ri-book-line"></i>
                </div>
                <h2>100</h2>
                <p>Borrowed Books</p>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="icon-circle">
                    <i class="ri-alarm-warning-line"></i>
                </div>
                <h2>11</h2>
                <p>Overdue Books</p>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="icon-circle">
                    <i class="ri-user-add-line"></i>
                </div>
                <h2>20</h2>
                <p>New Members</p>
            </div>
        </div>
    </div>

    <!-- Users List and Books List -->
    <div class="row g-3 mb-4">
        <div class="col-xl-6">
            <div class="table-responsive">
                <div class="section-header">
                    <h5>Users List</h5>
                    <a href="#" class="add-new-btn">ADD NEW USER</a>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>User Name</th>
                            <th>Book Issued</th>
                            <th>Department</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>10031</td>
                            <td><img src="{{asset('assets/images/users/avatar-1.jpg')}}" class="rounded-circle me-2" width="30" height="30">Alex Roy</td>
                            <td>12</td>
                            <td>Civil Engg</td>
                            <td><i class="ri-more-2-fill"></i></td>
                        </tr>
                        <tr>
                            <td>10042</td>
                            <td><img src="{{asset('assets/images/users/avatar-2.jpg')}}" class="rounded-circle me-2" width="30" height="30">Jenny</td>
                            <td>25</td>
                            <td>IT Assets</td>
                            <td><i class="ri-more-2-fill"></i></td>
                        </tr>
                        <tr>
                            <td>20001</td>
                            <td><img src="{{asset('assets/images/users/avatar-3.jpg')}}" class="rounded-circle me-2" width="30" height="30">Jesus</td>
                            <td>11</td>
                            <td>Computer Science</td>
                            <td><i class="ri-more-2-fill"></i></td>
                        </tr>
                        <tr>
                            <td>10073</td>
                            <td><img src="{{asset('assets/images/users/avatar-4.jpg')}}" class="rounded-circle me-2" width="30" height="30">Rena</td>
                            <td>05</td>
                            <td>Pharmacy</td>
                            <td><i class="ri-more-2-fill"></i></td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-end">
                    <a href="#" class="view-all-btn">View All →</a>
                </div>
            </div>
        </div>
        
        <div class="col-xl-6">
            <div class="table-responsive">
                <div class="section-header">
                    <h5>Books List</h5>
                    <a href="#" class="add-new-btn">ADD NEW BOOK</a>
                </div>
                <table class="table table-hover book-table">
                    <thead>
                        <tr>
                            <th>Book ID</th>
                            <th>Title</th>
                            <th>Shelf No</th>
                            <th>Available</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>BB-3125-13</td>
                            <td>Attorney Toolkit</td>
                            <td>Wood Haven</td>
                            <td>32</td>
                            <td><i class="ri-more-2-fill"></i></td>
                        </tr>
                        <tr>
                            <td>BB-1245-14</td>
                            <td>Life is Beautiful</td>
                            <td>Yellow Book</td>
                            <td>43</td>
                            <td><i class="ri-more-2-fill"></i></td>
                        </tr>
                        <tr>
                            <td>BB-0192-11</td>
                            <td>Brooke</td>
                            <td>Annaba Portch</td>
                            <td>60</td>
                            <td><i class="ri-more-2-fill"></i></td>
                        </tr>
                        <tr>
                            <td>BB-17520-21</td>
                            <td>The Newer Syllabus</td>
                            <td>Yumonic D. Burnham</td>
                            <td>01</td>
                            <td><i class="ri-more-2-fill"></i></td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-end">
                    <a href="#" class="view-all-btn">View All →</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Choices -->
    <div class="row mb-1">
        <div class="col-12">
            <div class="section-header">
                <h5>Top Choices</h5>
            </div>
        </div>
    </div>
    <div class="row g-3 mb-4">
        <div class="col-lg-2 col-md-4 col-6">
            <div class="book-card">
                <img src="{{asset('assets/images/book1.jpg')}}" alt="Book Cover">
                <div class="book-info">
                    <div class="book-title">The Cellar of Pure Reason</div>
                    <div class="book-author">George Atwood</div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-6">
            <div class="book-card">
                <img src="{{asset('assets/images/book2.jpg')}}" alt="Book Cover">
                <div class="book-info">
                    <div class="book-title">Scream</div>
                    <div class="book-author">Robert Gaston</div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-6">
            <div class="book-card">
                <img src="{{asset('assets/images/book3.jpg')}}" alt="Book Cover">
                <div class="book-info">
                    <div class="book-title">The Design of Everyday Things</div>
                    <div class="book-author">Don Norman</div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-6">
            <div class="book-card">
                <img src="{{asset('assets/images/book4.jpg')}}" alt="Book Cover">
                <div class="book-info">
                    <div class="book-title">Lean UX</div>
                    <div class="book-author">Jeff Gothelf</div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-6">
            <div class="book-card">
                <img src="{{asset('assets/images/book5.jpg')}}" alt="Book Cover">
                <div class="book-info">
                    <div class="book-title">The Republic</div>
                    <div class="book-author">Plato</div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-6">
            <div class="book-card">
                <img src="{{asset('assets/images/book6.jpg')}}" alt="Book Cover">
                <div class="book-info">
                    <div class="book-title">Ancestor Trouble</div>
                    <div class="book-author">Maud Newton</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Books Issued -->
    <div class="row g-3 mb-4">
        <div class="col-xl-7">
            <div class="table-responsive">
                <div class="section-header">
                    <h5>Books Issued</h5>
                    <a href="#" class="add-new-btn">ISSUE BOOK</a>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Book</th>
                            <th>Issue Date</th>
                            <th>Return Date</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>10021</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{asset('assets/images/book1.jpg')}}" width="30" height="35" class="me-2">
                                    <div>
                                        <div class="fw-bold">Attorney Toolkit</div>
                                        <small class="text-muted">Robert Gaston</small>
                                    </div>
                                </div>
                            </td>
                            <td>29 Sep, 2023</td>
                            <td>8 Oct, 2023</td>
                            <td><span class="status-badge view-details">View Details</span></td>
                        </tr>
                        <tr>
                            <td>10034</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{asset('assets/images/book2.jpg')}}" width="30" height="35" class="me-2">
                                    <div>
                                        <div class="fw-bold">49 to Consummate</div>
                                        <small class="text-muted">by Don William</small>
                                    </div>
                                </div>
                            </td>
                            <td>21 Dec, 2023</td>
                            <td>31 Dec, 2023</td>
                            <td><span class="status-badge view-details">View Details</span></td>
                        </tr>
                        <tr>
                            <td>20047</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{asset('assets/images/book3.jpg')}}" width="30" height="35" class="me-2">
                                    <div>
                                        <div class="fw-bold">Scream</div>
                                        <small class="text-muted">by George William</small>
                                    </div>
                                </div>
                            </td>
                            <td>12 Dec, 2022</td>
                            <td>30 Dec, 2022</td>
                            <td><span class="status-badge view-details">View Details</span></td>
                        </tr>
                        <tr>
                            <td>10021</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{asset('assets/images/book4.jpg')}}" width="30" height="35" class="me-2">
                                    <div>
                                        <div class="fw-bold">The Secret Missions</div>
                                        <small class="text-muted">by Don William</small>
                                    </div>
                                </div>
                            </td>
                            <td>11 Sep, 2022</td>
                            <td>3 Jan, 2023</td>
                            <td><span class="status-badge view-details">View Details</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-xl-5">
            <div class="chart-container">
                <div class="section-header mb-3">
                    <h5>Visitors & Borrowers Statistics</h5>
                </div>
                <canvas id="visitorsChart"></canvas>
            </div>
        </div>
    </div>


    <!-- Overdue Book List and Visitors Statistics -->
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-3">Overdue Book List</h4>
                
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
                                <input type="text" class="form-control" placeholder="Search overdue books..." name="search" value="{{ request('search') }}"> 
                                <button class="btn btn-sm btn-primary">Search</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>User Name</th>
                                <th>Book ID</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Schedule</th>
                                <th>Status</th>
                                <th>Fine</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>10031</td>
                                <td><img src="{{asset('assets/images/users/avatar-1.jpg')}}" class="rounded-circle me-2" width="30" height="30">Alex Roy</td>
                                <td>BB-3125-13</td>
                                <td>Anabolic Tinder</td>
                                <td>about blasters</td>
                                <td>9 days</td>
                                <td><span class="status-badge status-overdue">Returned Later</span></td>
                                <td class="text-danger">₱25.00</td>
                            </tr>
                            <tr>
                                <td>10034</td>
                                <td><img src="{{asset('assets/images/users/avatar-2.jpg')}}" class="rounded-circle me-2" width="30" height="30">Sophia</td>
                                <td>BB-2313-9</td>
                                <td>49 ENTREPRENEURS</td>
                                <td>Dave Kidl</td>
                                <td>1 day</td>
                                <td><span class="status-badge status-overdue">Delay</span></td>
                                <td class="text-danger">₱21.00</td>
                            </tr>
                            <tr>
                                <td>20047</td>
                                <td><img src="{{asset('assets/images/users/avatar-3.jpg')}}" class="rounded-circle me-2" width="30" height="30">John</td>
                                <td>BB-2852-25</td>
                                <td>Kokab</td>
                                <td>Amanda Perks</td>
                                <td>5 days</td>
                                <td><span class="status-badge status-returned">Returned</span></td>
                                <td class="text-danger">₱23.211</td>
                            </tr>
                            <tr>
                                <td>10021</td>
                                <td><img src="{{asset('assets/images/users/avatar-4.jpg')}}" class="rounded-circle me-2" width="30" height="30">Rose</td>
                                <td>BB-7192-87</td>
                                <td>The Secret Missions</td>
                                <td>Tyrence D. Burnham</td>
                                <td>3 days</td>
                                <td><span class="status-badge status-returned">Returned</span></td>
                                <td>-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper">
                    <div class="pagination-info">
                        Showing 1 to 4 of 11 entries
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
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('visitorsChart').getContext('2d');
    const visitorsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Visitors',
                data: [45, 52, 38, 65, 48, 55, 42, 70, 58, 48, 45, 62],
                backgroundColor: '#d07e0a',
                borderRadius: 5
            }, {
                label: 'Borrowers',
                data: [35, 42, 28, 55, 38, 45, 32, 60, 48, 38, 35, 52],
                backgroundColor: '#95a5a6',
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 80
                }
            }
        }
    });
</script>
@endsection