<div class="modal fade" id="editType{{$type->id}}" tabindex="-1" role="dialog" aria-labelledby="addBranchData" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-branch">
                <h5 class="modal-title">Edit Item Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editBranchForm" method="POST" action="{{url('update_type/'.$type->id)}}" onsubmit="show()" enctype="multipart/form-data">
                @csrf   
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Code&nbsp;<span class="text-danger">*</span></label>
                                <input type="text" name="code" class="form-control" placeholder="Enter Code" required value="{{$type->code}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Description&nbsp;<span class="text-danger">*</span></label>
                                <input type="text" name="description" class="form-control" placeholder="Enter Description" required value="{{$type->description}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Charge</label>
                                <input type="text" name="charge" class="form-control" placeholder="0.00" value="{{$type->charge}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check mb-2">
                                <input type="hidden" name="loan" value="No">

                                <input class="form-check-input"
                                    type="checkbox"
                                    name="loan"
                                    id="formCheckboxRight1"
                                    value="Yes"
                                    {{ $type->loan == 'Yes' ? 'checked' : '' }}>
                                    
                                <label class="form-check-label" for="formCheckboxRight1">
                                    Not for Loan
                                </label><br>
                                <span>(If checked, no item of this type can be issued. If not checked, every item of this type can be issued unless notforloan is set for a specific item.)</span>   
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Summary</label>
                            <textarea name="summary" class="form-control" placeholder="Enter Summary">{{ $type->summary }}</textarea>
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