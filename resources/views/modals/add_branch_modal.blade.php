<style>
    .modal-header-branch {
        background: #8B0000;
        color: white;
        border-bottom: none;
    }
    
    .modal-header-branch .btn-close {
        filter: brightness(0) invert(1);
    }
    
    .modal-header-branch .modal-title {
        font-weight: 600;
        color: #FFF;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
        font-size: 14px;
        display: block;
    }
    
    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        font-size: 14px;
    }
    
    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #8B0000;
        box-shadow: 0 0 0 0.2rem rgba(139, 0, 0, 0.15);
    }
    
    .form-group textarea {
        resize: vertical;
        min-height: 80px;
    }
    
    .btn-submit {
        background: #3cb002 !important;
        color: white !important;
        border: none;
        padding: 10px 30px;
        border-radius: 5px;
        font-size: 14px;
    }
    
    .btn-submit:hover {
        background: #6B0000;
        color: white;
    }
</style>

<!-- Add Branch Modal -->
<div class="modal fade" id="addBranchModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-branch">
                <h5 class="modal-title">Add New Branch</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addBranchForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Branch Name <span class="text-danger">*</span></label>
                                <input type="text" name="branch_name" class="form-control" placeholder="Enter branch name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Contact Number <span class="text-danger">*</span></label>
                                <input type="text" name="contact_no" class="form-control" placeholder="Enter contact number" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter email address">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Location <span class="text-danger">*</span></label>
                                <input type="text" name="location" class="form-control" placeholder="Enter location" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="address" class="form-control" placeholder="Enter full address"></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Branch Manager</label>
                                <input type="text" name="manager" class="form-control" placeholder="Enter manager name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Opening Date</label>
                                <input type="date" name="opening_date" class="form-control">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-submit" onclick="submitBranch()">Add Branch</button>
            </div>
        </div>
    </div>
</div>

<script>
    function submitBranch() {
        const form = document.getElementById('addBranchForm');
        if (form.checkValidity()) {
            // Add your form submission logic here
            alert('Branch added successfully!');
            // You can use AJAX to submit the form data
            // $('#addBranchModal').modal('hide');
        } else {
            form.reportValidity();
        }
    }
</script>