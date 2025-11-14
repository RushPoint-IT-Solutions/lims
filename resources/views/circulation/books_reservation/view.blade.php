<style>    
    .detail-row {
        display: flex;
        padding: 12px 0;
        border-bottom: 1px solid #e9ecef;
    }
    
    .detail-row:last-child {
        border-bottom: none;
    }
    
    .detail-label {
        font-weight: 600;
        color: #6c757d;
        min-width: 150px;
        font-size: 14px;
    }
    
    .detail-value {
        color: #212529;
        font-size: 14px;
    }
    
    .status-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 4px;
        font-size: 13px;
        font-weight: 500;
    }
    
    .status-approved {
        background: #d4edda;
        color: #155724;
    }
    
    .status-disapproved {
        background: #f8d7da;
        color: #721c24;
    }
    
    .status-pending {
        background: #fff3cd;
        color: #856404;
    }
</style>

<div class="modal fade" id="viewBookReservation{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="addRackData" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Book Reservation Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" onsubmit="show()" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="detail-row">
                        <div class="detail-label">Reservation ID</div>
                        <div class="detail-value">{{ $data->reservation_id }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Book Title</div>
                        <div class="detail-value">{{ $data->books->name }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Author</div>
                        @foreach($data->authors as $author)
                            <div class="detail-value">
                                {{ $author->author_name }}
                            </div>
                        @endforeach
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Reserved Date</div>
                        <div class="detail-value">{{ $data->reserved_date }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Reserved By</div>
                        <div class="detail-value">{{ $data->users->name }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Pickup Deadline</div>
                        <div class="detail-value">{{ optional($data->pickup_date)->format('Y-m-d') ?? '-' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Status</div>
                        <div class="detail-value">
                            <span class="status-badge status-{{ strtolower($data->status) }}">
                                {{ $data->status }}
                            </span>
                        </div>
                    </div>

                    {{-- @if($data->status == 'Disapproved' && $data->remarks)
                        <div class="detail-row">
                            <div class="detail-label">Remarks</div>
                            <div class="detail-value">{{ $data->remarks }}</div>
                        </div>
                    @endif

                    @if($data->status == 'Approved')
                        <div class="detail-row">
                            <div class="detail-label">Approved By</div>
                            <div class="detail-value">{{ $data->approvedBy->name ?? '' }}</div>
                        </div>

                        <div class="detail-row">
                            <div class="detail-label">Approved Date</div>
                            <div class="detail-value">{{ date('M d, Y h:i A', strtotime($data->approved_date)) }}</div>
                        </div>
                    @endif

                    @if($data->status == 'Disapproved')
                        <div class="detail-row">
                            <div class="detail-label">Disapproved By</div>
                            <div class="detail-value">{{ $data->disapprovedBy->name ?? '' }}</div>
                        </div>

                        <div class="detail-row">
                            <div class="detail-label">Disapproved Date</div>
                            <div class="detail-value">{{ date('M d, Y h:i A', strtotime($data->disapproved_date)) }}</div>
                        </div>
                    @endif --}}
                </div> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div> 
            </form>
        </div>
    </div>
</div>