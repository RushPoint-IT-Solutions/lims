<div class="modal fade" id="editBranch{{$branch->id}}" tabindex="-1" role="dialog" aria-labelledby="addBranchData" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-branch">
                <h5 class="modal-title">Edit Branch</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editBranchForm" method="POST" action="{{url('update_branch/'.$branch->id)}}" onsubmit="show()" enctype="multipart/form-data">
                @csrf   
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Branch Name&nbsp;<span class="text-danger">*</span></label>
                                <input type="text" name="branch_name" class="form-control" placeholder="Enter Branch Name" value="{{$branch->branch_name}}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Contact Number&nbsp;<span class="text-danger">*</span></label>
                                <input type="text" name="contact_no" class="form-control" placeholder="Enter Branch Name" value="{{$branch->contact_no}}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Location <span class="text-danger">*</span></label>
                                <input type="text" name="location" class="form-control" placeholder="Enter Branch Name" value="{{$branch->location}}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Contact Person</label>
                                <input type="text" name="contact_person" class="form-control" placeholder="Enter Branch Name" value="{{$branch->contact_person}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address" class="form-control" placeholder="Enter Full Address">{{$branch->address}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-submit" onclick="submitBranch()">Add Branch</button> -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>