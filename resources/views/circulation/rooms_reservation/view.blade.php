<div class="modal fade" id="viewReservation{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="addRackData" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Room Reservation Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" onsubmit="show()" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Reservation Id</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" value="{{ $data->reservation_id }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Room</label>
                            <div class="col-sm-4">
                                <input type="text" readonly class="form-control-plaintext" value="{{ $data->room_name }}">
                            </div>
                            <label class="col-sm-2 col-form-label">Purpose</label>
                            <div class="col-sm-4">
                                <input type="text" readonly class="form-control-plaintext" value="{{ $data->purpose == 'Others' ? $data->purpose . ' - ' . $data->other_remarks : $data->purpose }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Reserved From</label>
                            <div class="col-sm-4">
                                <input type="text" readonly class="form-control-plaintext" value="{{ date('Y-m-d h:i:s', strtotime($data->reserved_from)) }}">
                            </div>
                            <label class="col-sm-2 col-form-label">Reserved To</label>
                            <div class="col-sm-4">
                                <input type="text" readonly class="form-control-plaintext" value="{{ date('Y-m-d h:i:s', strtotime($data->reserved_to)) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-4">
                                <input type="text" readonly class="form-control-plaintext" value="{{ $data->status }}">
                            </div>
                            <label class="col-sm-2 col-form-label">Remarks</label>
                            <div class="col-sm-4">
                                <input type="text" readonly class="form-control-plaintext" value="{{ $data->remarks }}">
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div> 
            </form>
        </div>
    </div>
</div>