<style>
    /* Highly specific modal-only styles */
    #newRequestModal.modal .modal-header-custom {
        background: #fff;
        border-bottom: 2px solid #25306d;
        padding: 20px 30px;
    }
    
    #newRequestModal.modal .modal-header-custom .university-header {
        text-align: center;
        margin-bottom: 20px;
    }
    
    #newRequestModal.modal .modal-header-custom .university-logos {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
        margin-bottom: 15px;
    }
    
    #newRequestModal.modal .modal-header-custom .university-logos img {
        height: 80px;
    }

    #newRequestModal.modal .modal-header-custom .university-logos .lrc_logo {
        height: 95px;
    }
    
    #newRequestModal.modal .modal-header-custom .university-title {
        color: #333;
        margin: 0;
        font-size: 12px;
    }
    
    #newRequestModal.modal .modal-header-custom .university-name {
        color: #c41e3a;
        font-size: 20px;
        font-weight: 700;
        text-transform: uppercase;
        margin: 0;
    }
    
    #newRequestModal.modal .modal-header-custom .university-subtitle {
        color: #666;
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        margin: 0;
    }
    
    #newRequestModal.modal .modal-header-custom .form-title {
        text-align: center;
        font-size: 16px;
        font-weight: 700;
        color: #333;
        margin-top: 20px;
        margin-bottom: 0;
    }
    
    #newRequestModal.modal .form-info-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        gap: 20px;
    }
    
    #newRequestModal.modal .form-info-item {
        flex: 1;
    }
    
    #newRequestModal.modal .form-info-item label {
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
        font-size: 14px;
        display: block;
    }
    
    #newRequestModal.modal .modal-body label {
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
        font-size: 14px;
        display: block;
    }
    
    #newRequestModal.modal .form-info-item input {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #dee2e6;
        border-radius: 5px;
    }
    
    #newRequestModal.modal .table-requisition {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    
    #newRequestModal.modal .table-requisition th {
        background: #f8f9fa;
        border: 1px solid #333;
        padding: 10px 8px;
        text-align: center;
        font-weight: 700;
        font-size: 13px;
        color: #333;
    }
    
    #newRequestModal.modal .table-requisition td {
        border: 1px solid #333;
        padding: 8px;
    }
    
    #newRequestModal.modal .table-requisition input {
        width: 100%;
        border: none;
        padding: 5px;
        font-size: 13px;
    }
    
    #newRequestModal.modal .table-requisition input:focus {
        outline: none;
        background: #f8f9fa;
    }
    
    #newRequestModal.modal .btn-add-row {
        background: #28a745;
        color: white;
        border: none;
        padding: 6px 15px;
        border-radius: 5px;
        font-size: 13px;
        margin-bottom: 15px;
        right: 0;
    }
    
    #newRequestModal.modal .btn-add-row:hover {
        background: #218838;
    }
    
    #newRequestModal.modal .btn-remove-row {
        background: #dc3545;
        color: white;
        border: none;
        padding: 2px 8px;
        border-radius: 3px;
        font-size: 12px;
        cursor: pointer;
    }
    
    #newRequestModal.modal .btn-remove-row:hover {
        background: #c82333;
    }
</style>

<!-- New Request Modal -->
<div class="acquisition-modal">
    <div class="modal fade" id="newRequestModal" tabindex="-1" style="display: none;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header modal-header-custom">
                    <div class="w-100">
                        <div class="university-header">
                            <div class="university-logos mb-5">
                                <img src="{{asset('assets/images/marsu-logo.png')}}" alt="MarSU Logo">
                                <div class="text-center mt-3">
                                    <p class="university-title">Republic of the Philippines</p>
                                    <h5><span class="university-name">MAR</span>INDUQUE <span class="university-name">S</span>TATE <span class="university-name">U</span>NIVERSITY</h5>
                                    <p class="university-subtitle">Learning Resource Center</p>
                                </div>
                                <img class="lrc_logo" src="{{asset('assets/images/lrc_logo.png')}}" alt="LRC Logo">
                            </div>
                            <h6 class="form-title">Material Purchase Requisition Form</h6>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="requisitionForm">
                        <div class="row mb-3 align-items-start">
                            <div class="col-md-4">
                                <div class="mb-2">
                                    <label class="font-custom">Name of College:</label>
                                    <input type="text" class="form-control" name="college_name" required>
                                </div>
                                <div>
                                    <label class="font-custom">Requested by:</label>
                                    <input type="text" class="form-control" name="requested_by" value="{{auth()->user()->name}}" required>
                                </div>
                            </div>
                            <div class="col-md-4 ms-auto">
                                <label class="font-custom">Date:</label>
                                <input type="date" class="form-control" name="request_date" value="{{date('Y-m-d')}}" required>
                            </div>
                        </div>
                        
                        <div class="mt-5">
                            <table class="table-requisition">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;">QTY</th>
                                        <th style="width: 120px;">ISBN</th>
                                        <th style="width: 250px;">TITLE/DESCRIPTION</th>
                                        <th style="width: 120px;">COPYRIGHT</th>
                                        <th style="width: 150px;">AUTHOR</th>
                                        <th style="width: 150px;">NAME OF DEALER</th>
                                        <th style="width: 50px;"></th>
                                    </tr>
                                </thead>
                                <tbody id="requisitionTableBody">
                                    <tr>
                                        <td><input type="number" name="items[0][qty]" min="1" placeholder="1"></td>
                                        <td><input type="text" name="items[0][isbn]" placeholder="ISBN"></td>
                                        <td><input type="text" name="items[0][title]" placeholder="Title/Description"></td>
                                        <td><input type="text" name="items[0][copyright]" placeholder="Year"></td>
                                        <td><input type="text" name="items[0][author]" placeholder="Author"></td>
                                        <td><input type="text" name="items[0][dealer]" placeholder="Dealer/Supplier"></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="button" class="btn-add-row" onclick="addRow()" style="float: right; margin-top: 10px;">
                                <i class="ri-add-line"></i> Add Row
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="submitRequisition()">Submit Request</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let rowCount = 1;
    
    function addRow() {
        const tbody = document.getElementById('requisitionTableBody');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td><input type="number" name="items[${rowCount}][qty]" min="1" placeholder="1"></td>
            <td><input type="text" name="items[${rowCount}][isbn]" placeholder="ISBN"></td>
            <td><input type="text" name="items[${rowCount}][title]" placeholder="Title/Description"></td>
            <td><input type="text" name="items[${rowCount}][copyright]" placeholder="Year"></td>
            <td><input type="text" name="items[${rowCount}][author]" placeholder="Author"></td>
            <td><input type="text" name="items[${rowCount}][dealer]" placeholder="Dealer/Supplier"></td>
            <td><button type="button" class="btn-remove-row" onclick="removeRow(this)"><i class="ri-close-line"></i></button></td>
        `;
        tbody.appendChild(newRow);
        rowCount++;
    }
    
    function removeRow(btn) {
        const row = btn.closest('tr');
        row.remove();
    }
    
    function submitRequisition() {
        const form = document.getElementById('requisitionForm');
        if (form.checkValidity()) {
            // Add your form submission logic here
            alert('Form submitted successfully!');
            // You can use AJAX to submit the form data
            // $('#newRequestModal').modal('hide');
        } else {
            form.reportValidity();
        }
    }
</script>