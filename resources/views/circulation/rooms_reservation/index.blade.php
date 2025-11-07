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
    /* .fc .fc-button-group>:first-child
    {
        background: #520000;
        color: #FFF;
    }
    .fc .fc-button-group>* {
        color: #FFF;
        background: #520000;
    } */
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
                @if(count($availableRooms) > 0)
                    @foreach ($availableRooms as $available)
                        <div class="row">
                            <div class="col-sm-8">
                                <b>Room Name:</b>
                                <span>{{ $available->name }}</span>
                                <br>
                                <b>Floor: </b>
                                <span>{{ $available->floor }}</span>
                            </div>
                            <div class="col-sm-4">
                                @if(!empty($available->image) && file_exists(public_path($available->image)))
                                    <img src="{{ asset($available->image) }}" alt="Room Image" width="50" height="50">
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                        <hr>
                    @endforeach
                @else
                    <div style="font-style: italic;" class="text-secondary">All rooms are occupied</div>
                @endif
            </div>
        </div>
        <div class="col-8">
            <div class="book-search-card">
                <div class="mb-2" align="right">
                    <button type="button" class="btn btn-md btn-primary" data-bs-toggle="modal" data-bs-target="#roomReservationModal">
                        <i class="ri-add-line"></i> Reserve Room
                    </button>
                </div>
                <div class="calendar"></div>  
            </div>
        </div>
    </div>

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
                                <th width="10%">Actions</th>
                                <th width="12%">Reservation ID</th>
                                <th width="17%">Room</th>
                                <th width="20%">Purpose</th>
                                <th width="15%">Reserved By</th>
                                <th width="18%">Reserved Date</th>
                                <th width="8%">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datas as $data)
                            <tr style="background: #f0f9ff;">
                                <td>
                                    <button class="btn btn-outline-info btn-sm" title="View Details">
                                        <i class="mdi mdi-eye"></i>
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm" title="Cancel">
                                        <i class="mdi mdi-close"></i>
                                    </button>
                                </td>
                                <td>{{ $data->reservation_id }}</td>
                                <td>{{ $data->room_name }}</td>
                                <td><strong>{{ $data->purpose }}</strong></td>
                                <td>{{ $data->reservedBy->name }}</td>
                                <td>
                                    <strong class="text-primary">{{ date('Y-m-d', strtotime($data->reserved_from)) }} - {{ date('Y-m-d', strtotime($data->reserved_to)) }}</strong>
                                </td>
                                <td>
                                    @if($data->status == 'Pending')
                                        <span class="status-badge status-expired">Pending</span>
                                    @elseif($data->status == 'Approved')
                                        <span class="status-badge status-ready">Approved</span>
                                    @else
                                        <span class="status-badge status-cancelled">Rejected</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper">
                    <div class="pagination-info">
                        Showing 1 to 4 of 4 entries
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
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade select2-modal" id="roomReservationModal" tabindex="-1" role="dialog" aria-labelledby="addRoomReservationData" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reserve Room</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addRoomReservationForm" method="POST" action="{{ url('/new_room_reservation') }}" onsubmit="show()" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 form-group mb-2">
                                <label>Room&nbsp;<span class="text-danger">*</span></label>
                                <select name="room_name" id="room_name" class="form-control select2" required>
                                    <option value="">-- Select Room --</option>
                                    @foreach ($rooms as $room)
										<option value='{{ $room->name}}'>{{ $room->name }}</option>
									@endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group mb-2">
                                <label>Purpose&nbsp;<span class="text-danger">*</span></label>
                                <select name="purpose" id="purpose" class="form-control select2" required>
                                    <option value="">-- Select Purpose --</option>
                                    <option value="Meeting">Meeting</option>
                                    <option value="Session">Session</option>
                                    <option value="Events">Events</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="offset-md-6 col-md-6 form-group mb-2" id="remarks-container" style="display: none;">
                                <label>Remarks</label>
                                <textarea name="other_remarks" class="form-control" placeholder="Enter Remarks"></textarea>
                            </div>
                            <div class="col-md-6 form-group mb-2">
                                <label>Date From&nbsp;<span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control" name="reserved_from" required>
                            </div>
                            <div class="col-md-6 form-group mb-2">
                                <label>Date To&nbsp;<span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control" name="reserved_to" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="submitBranch()">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{asset('/assets/js/moment.min.js')}}"></script>
    <script src="{{asset('/assets/js/fullcalendar.min.js')}}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).on('shown.bs.modal', '.select2-modal', function () {
            const $modal = $(this);
            $modal.find('.select2').select2({
                dropdownParent: $modal
            });
        });

        $(document).ready(function () {
            $('#purpose').on('change', function () {
                if ($(this).val() === 'Other') {
                    $('#remarks-container').show();
                } else {
                    $('#remarks-container').hide(); 
                    $('textarea[name="other_remarks"]').val(''); 
                }
            });
        });

        var room_reservation = {!! json_encode($room_reservations_array) !!};

        $('.calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultView: 'month',
            navLinks: true,
            editable: false,
            eventStartEditable: false,
            eventDurationEditable: false,
            eventLimit: false,
            displayEventTime: false,
            events: room_reservation,

            eventClick: function(event) {
                Swal.fire({
                    title: '<b>Room Reservation Details</b>',
                    html: `
                        <div style="text-align:left;">
                            <p><strong>Room:</strong>&nbsp;${event.title}</p>
                            <p><strong>From:</strong>&nbsp;${moment(event.start).format('MMM D, YYYY h:mm A')}</p>
                            <p><strong>To:</strong>&nbsp;${moment(event.end).format('MMM D, YYYY h:mm A')}</p>
                            ${event.reason ? `<p><strong>Purpose:</strong> ${event.reason}</p>` : ''}
                        </div>
                    `,
                    icon: 'info',
                    confirmButtonText: 'Close',
                    width: 420,
                });
            }
        });


        function submitBranch() {
            const form = document.getElementById('addRoomReservationForm');
            if (form.checkValidity()) {
                form.submit();
            } else {
                form.reportValidity();
            }
        }
    </script>
@endsection