<div class="modal fade select2-modal" id="editFramework{{$framework->id}}" tabindex="-1" role="dialog" aria-labelledby="addRoomData" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-branch">
                <h5 class="modal-title">Edit Framework</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editFrameworkForm" method="POST" action="{{url('update_framework/'.$framework->id)}}" onsubmit="show()" enctype="multipart/form-data">
                @csrf   
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Code&nbsp;<span class="text-danger">*</span></label>
                                <input type="text" name="code" class="form-control" placeholder="Enter code" required value="{{$framework->code}}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description&nbsp;<span class="text-danger">*</span></label>
                            <textarea name="description" class="form-control" placeholder="Enter Description" required>{{ $framework->description }}</textarea>
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