<div class="modal fade select2-modal" id="editRoom{{$room->id}}" tabindex="-1" role="dialog" aria-labelledby="addRoomData" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-branch">
                <h5 class="modal-title">Edit Room</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editRoomForm" method="POST" action="{{url('update_room/'.$room->id)}}" onsubmit="show()" enctype="multipart/form-data">
                @csrf   
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name&nbsp;<span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Code" required value="{{$room->name}}">
                            </div>
                        </div> 
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Floor&nbsp;<span class="text-danger">*</span></label>
                                <select name="floor" id="floor" class="form-control select2" required>
                                    <option value="">-- Select Floor --</option>
                                    <option value="1st Floor" @if($room->floor == '1st Floor') selected @endif>1st Floor</option>
                                    <option value="2nd Floor" @if($room->floor == '2nd Floor') selected @endif>2nd Floor</option>
                                    <option value="3rd Floor" @if($room->floor == '3rd Floor') selected @endif>3rd Floor</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" placeholder="Enter Description">{{$room->description}}</textarea>
                        </div>
                    </div>  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
