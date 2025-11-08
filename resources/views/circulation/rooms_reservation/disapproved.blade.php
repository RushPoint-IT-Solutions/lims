<div class="modal fade select2-modal" id="disapprovedReservation{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="addDisapproved" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-branch">
                <h5 class="modal-title">Disapproved Reservation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{url('room_reservation_disapproved/'.$data->id)}}" onsubmit="show()" enctype="multipart/form-data">
                @csrf   
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group">
                            <label>Remarks&nbsp;<span class="text-danger">*</span></label>
                            <textarea name="remarks" class="form-control" placeholder="Enter Remarks" required></textarea>
                        </div>
                    </div>  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>