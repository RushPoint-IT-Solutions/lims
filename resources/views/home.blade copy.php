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
    
    .view-all-btn {
        color: #d07e0a;
        text-decoration: none;
        font-size: 14px;
    }
    
    .view-all-btn:hover {
        text-decoration: underline;
    }
    
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
    }
    
    .table-responsive {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .book-table th,
    .book-table td {
        text-align: left;
        vertical-align: middle;
    }

    .book-table tbody tr {
        height: 55px;
        background-color: #fff;
        border-radius: 10px;
    }

    
    .status-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }
    
    .status-overdue {
        background: #ffe5e5;
        color: #ff6b6b;
    }

    .view-details {
        background: #a3b8ff;
        color: #ffffff;
    }
    .status-returned {
        background: #e5f9e5;
        color: #28a745;
    }
    
    .chart-container {
        position: relative;
        background: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        width: 100%;
        height: 412px;
        overflow: hidden;
    }

    .chart-container canvas {
        width: 100% !important;
        height: 90% !important;
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
        background: #c17409;
        color: white;
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
    <div class="row g-3 mb-4">
        <div class="col-xl-12">
            <div class="table-responsive">
                <div class="section-header">
                    <h5>Overdue Book List</h5>
                </div>
                <table class="table table-hover">
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
                <div class="text-center mt-3">
                    <nav>
                        <ul class="pagination justify-content-end">
                            <li class="page-item disabled"><a class="page-link" href="#">‹</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                            <li class="page-item"><a class="page-link" href="#">›</a></li>
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