@extends('layouts.header')

@section('css')
<link href="{{asset('/assets/css/fullcalendar.min.css')}}" rel="stylesheet" type="text/css" />
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
    .fc .fc-button-group>:first-child
    {
        background: #520000;
        color: #FFF;
    }
    .fc .fc-button-group>* {
        color: #FFF;
        background: #520000;
    }
</style>
@endsection

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="mb-0">Room Reservation</h4>
            <p class="text-muted mb-0">Reserve rooms online and manage your requests</p>
        </div>
    </div>
    <div class="row g-3 mb-4">
        <div class="col-4">
            <div class="book-search-card">
                <h4 class="card-title">Available Room Today</h4>
                <hr>
                <div class="row">
                    <div class="col-sm-8">
                        <small>Room Name</small>
                        <span></span>
                        <br>
                        <small>Floor</small>
                        <span></span>
                    </div>
                    <div class="col-sm-4">
                        <span class="availability-badge avail-available">5 Available</span>
                    </div>
                </div>
                <hr>
            </div>
        </div>
        <div class="col-8">
            <div class="book-search-card">
                <div class="calendar"></div>  
            </div>
        </div>
    </div>
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{asset('/assets/js/moment.min.js')}}"></script>
    <script src="{{asset('/assets/js/fullcalendar.min.js')}}"></script>

    <script>
        $('.calendar').fullCalendar({
            header:
            {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultView: 'month',
            navLinks: true, // can click day/week names to navigate views
            editable: true,
            eventLimit: true,
            displayEventTime: false
        });
    </script>
@endsection