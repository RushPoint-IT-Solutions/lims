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
        background: rgb(136, 0, 0);
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
        background: #842029;
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

    /* Pagination Styles from Circulation */
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
            <h4 class="mb-0">Book Reservation</h4>
            <p class="text-muted mb-0">Reserve books online and manage your hold requests</p>
        </div>
    </div>

    <!-- Dashboard Cards -->
    <div class="row g-3 mb-4">
        <div class="col-xl-4 col-md-6">
            <div class="dashboard-card">
                <div class="icon-circle">
                    <i class="ri-bookmark-line"></i>
                </div>
                <h2>3</h2>
                <p>My Active Reservations</p>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="dashboard-card">
                <div class="icon-circle">
                    <i class="ri-checkbox-circle-line"></i>
                </div>
                <h2>1</h2>
                <p>Ready for Pickup</p>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="dashboard-card">
                <div class="icon-circle">
                    <i class="ri-time-line"></i>    
                </div>
                <h2>2</h2>
                <p>Pending Availability</p>
            </div>
        </div>
    </div>

   
    <div class="row mb-1">
        <div class="col-12">
            <div class="section-header">
                <h5>Popular Books This Month</h5>
                <a href="#" class="text-primary" style="font-size: 14px; text-decoration: none;">View All →</a>
            </div>
        </div>
    </div>
    <div class="row g-3 mb-4">
        @foreach($books as $book)
            <div class="col-lg-2 col-md-4 col-6">
                <div class="book-card">
                    <!-- <img src="{{asset('assets/images/book1.jpg')}}" alt="Book Cover"> -->
                    @if($book->image_path)
                        <img src="{{ asset($book->image_path) }}" alt="{{ $book->name }}" class="book-card-img">
                    @else
                        <img src="https://www.klett-cotta.de/assets/default-image.jpg" alt="{{ $book->name }}" class="book-card-img">
                    @endif
                    <div class="book-info">
                        <div class="book-title">{{ $book->name}}</div>
                        <!-- <div class="book-author">Robert C. Martin</div> -->
                        @foreach ($book->authors as $author)
                            <div class="book-author">{{ $author->author_name }}</div>
                        @endforeach
                        <!-- <div class="book-stats">★★★★★ • 156 borrows</div> -->
                        <form method="POST" action="{{url('reserve/'.$book->id)}}" onsubmit="show()" enctype="multipart/form-data">
                            @csrf
                            <button class="book-reserve-btn"><i class="ri-bookmark-line"></i> Reserve</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Search & Reserve Books -->
    <div class="row g-3 mb-4">
        <div class="col-12">
            <div class="book-search-card">
                <h4 class="card-title mb-3">Search & Reserve Books</h4>
                
                <div class="d-flex justify-content-end mb-3">
                    <div class="col-md-4">
                        <form method="GET" action="#" class="custom_form" enctype="multipart/form-data">
                            <div class="search">
                                <input type="text" class="form-control" placeholder="Search by title, author, ISBN..." name="search" value="{{ request('search') }}"> 
                                <button class="btn btn-sm btn-primary">Search</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Available Books for Reservation -->
                @foreach($books as $book)
                    <div class="book-item">
                        @if($book->image_path)
                            <img src="{{ asset($book->image_path) }}" alt="{{ $book->name }}" class="book-card-img">
                        @else
                            <img src="https://www.klett-cotta.de/assets/default-image.jpg" alt="{{ $book->name }}" class="book-card-img">
                        @endif
                        <div class="book-item-info">
                            <div class="book-item-title">{{ $book->name}}</div>
                            @foreach ($book->authors as $author)
                                <div class="book-item-author">by {{ $author->author_name }}</div>
                            @endforeach
                            <div class="book-item-details">
                                <span>ISBN: {{ $book->isbn }}</span> | 
                                <span>Call No: {{ $book->ddc }}</span> | 
                                <span>Location: {{ $book->branches->branch_name}}</span>
                            </div>
                            <div class="mt-2">
                                <span class="availability-badge avail-available">Available (1 copy)</span>
                                <small class="text-muted ms-2">Expected return: Nov 08, 2025</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <!-- <button class="reserve-btn">
                                <i class="ri-bookmark-line"></i> Reserve
                            </button> -->
                            <form method="POST" action="{{url('reserve/'.$book->id)}}" onsubmit="show()" enctype="multipart/form-data">
                                @csrf
                                <button class="reserve-btn"><i class="ri-bookmark-line"></i> Reserve</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- My Reservations -->
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-3">My Reservations</h4>
                
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
                                <input type="text" class="form-control" placeholder="Search reservations..." name="search" value="{{ request('search') }}"> 
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
                                <th>Reservation ID</th>
                                <th>Book Title</th>
                                <th>Reserved Date</th>
                                <th>Pickup Deadline</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($book_reservations as $data)
                                <tr>
                                    <td>
                                        <button class="btn btn-outline-primary btn-sm" title="View Details" data-bs-toggle="modal" data-bs-target="#viewBookReservation{{$data->id}}">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-danger btn-sm" title="Cancel">
                                            <i class="mdi mdi-close"></i>
                                        </button>
                                    </td>
                                    <td><strong>{{ $data->reservation_id }}</strong></td>
                                    <td>
                                        <div>
                                            <div class="fw-bold">{{ $data->books->name }}</div>
                                            @foreach ($data->authors as $author)
                                                <small class="text-muted">{{ $author->author_name }}</small>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>{{ date('Y-m-d', strtotime($data->reserved_date)) }}</td>
                                    <td>{{ optional($data->pickup_date)->format('Y-m-d') ?? '-' }}</td>
                                    <td>
                                        @if($data->status == 'Active - In Queue')
                                            <span class="status-badge bg-primary text-white">Active - In Queue</span>
                                        @elseif($data->status == 'Ready for Pickup')
                                            <span class="status-badge bg-success text-white">Ready for Pickup</span>
                                        @elseif($data->status == 'Cancelled')
                                            <span class="status-badge bg-danger text-white">Cancelled</span>
                                        @else
                                            <span class="status-badge bg-light text-dark">Cancelled</span>
                                        @endif
                                    </td>
                                </tr>
                                @include('circulation.books_reservation.view')
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <i class="ri-inbox-line" style="font-size: 48px; color: #ccc;"></i>
                                        <p class="text-muted mt-2">No Book Reservation Found</p>
                                    </td>
                                </tr>
                            @endforelse
                            <!-- <tr style="background: #f0f9ff;">
                                <td>
                                    <button class="btn btn-outline-info btn-sm" title="View Details">
                                        <i class="mdi mdi-eye"></i>
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm" title="Cancel">
                                        <i class="mdi mdi-close"></i>
                                    </button>
                                </td>
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
                            </tr>
                            <tr>
                                <td>
                                    <button class="btn btn-outline-info btn-sm" title="View Details">
                                        <i class="mdi mdi-eye"></i>
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm" title="Cancel">
                                        <i class="mdi mdi-close"></i>
                                    </button>
                                </td>
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
                            </tr>
                            <tr>
                                <td>
                                    <button class="btn btn-outline-info btn-sm" title="View Details">
                                        <i class="mdi mdi-eye"></i>
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm" title="Cancel">
                                        <i class="mdi mdi-close"></i>
                                    </button>
                                </td>
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
                            </tr>
                            <tr style="background: #f8f9fa;">
                                <td>
                                    <button class="btn btn-outline-info btn-sm" title="View Details">
                                        <i class="mdi mdi-eye"></i>
                                    </button>
                                </td>
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
                            </tr> -->
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper">
                    <div class="pagination-info">
                        Showing {{ $book_reservations->firstItem() ?? 0 }} to {{ $book_reservations->lastItem() ?? 0 }} of {{ $book_reservations->total() }} entries
                    </div>
                    <div>
                        {{ $book_reservations->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection