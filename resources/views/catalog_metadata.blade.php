@extends('layouts.header')

@section('css')
<style>
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
    
    .table-responsive {
        background: white;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .status-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }
    
    .status-cataloged {
        background: #d1e7dd;
        color: #0f5132;
    }
    
    .status-pending {
        background: #fff3cd;
        color: #856404;
    }
    
    .resource-type-badge {
        padding: 3px 10px;
        border-radius: 15px;
        font-size: 11px;
        font-weight: 600;
    }
    
    .type-physical {
        background: #e7f3ff;
        color: #0066cc;
    }
    
    .type-digital {
        background: #f0e7ff;
        color: #6610f2;
    }
    
    .table-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .entries-control {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
    }
    
    .entries-control select {
        padding: 5px 10px;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        font-size: 14px;
    }
    
    .search-control {
        position: relative;
    }
    
    .search-control input {
        padding: 5px 35px 5px 15px;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        font-size: 14px;
        width: 250px;
    }
    
    .search-control i {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
    }
    
    .table-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .pagination-info {
        color: #6c757d;
        font-size: 14px;
    }
    
    .action-btn {
        padding: 4px 8px;
        border-radius: 4px;
        border: none;
        background: #f8f9fa;
        color: #6c757d;
        cursor: pointer;
        font-size: 14px;
        margin-right: 5px;
    }
    
    .action-btn:hover {
        background: #e9ecef;
        color: #495057;
    }
</style>
@endsection

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="mb-0">Cataloging & Metadata Management</h4>
            <p class="text-muted mb-0">MARC21 cataloging, DDC classification, and resource indexing</p>
        </div>
    </div>

    <!-- Dashboard Cards -->
    <div class="row g-3 mb-4">
        <div class="col-xl-4 col-md-6">
            <div class="dashboard-card">
                <div class="icon-circle">
                    <i class="ri-book-line"></i>
                </div>
                <h2>1,247</h2>
                <p>Total Cataloged Items</p>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="dashboard-card">
                <div class="icon-circle">
                    <i class="ri-draft-line"></i>
                </div>
                <h2>18</h2>
                <p>Pending Cataloging</p>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="dashboard-card">
                <div class="icon-circle">
                    <i class="ri-barcode-line"></i>
                </div>
                <h2>32</h2>
                <p>Today's Barcodes</p>
            </div>
        </div>
    </div>

    <!-- Main Cataloging Section -->
    <div class="row g-3 mb-4">
        <div class="col-12">
            <div class="table-responsive">
                <div class="section-header">
                    <h5>Cataloging Records</h5>
                    <div>
                        <a href="#" class="add-new-btn" data-bs-toggle="modal" data-bs-target="#newCatalogModal">
                            <i class="ri-add-line"></i> NEW CATALOG ENTRY
                        </a>
                        <a href="#" class="add-new-btn ms-2" style="background: #27ae60;" data-bs-toggle="modal" data-bs-target="#barcodeModal">
                            <i class="ri-barcode-line"></i> ASSIGN BARCODE
                        </a>
                    </div>
                </div>
                
                <div class="table-controls">
                    <div class="entries-control">
                        <span>Show</span>
                        <select>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <span>entries</span>
                    </div>
                    <div class="search-control">
                        <input type="text" placeholder="Search by title, ISBN, author...">
                        <i class="ri-search-line"></i>
                    </div>
                </div>
                
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Barcode</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>DDC/Call Number</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>BC-2025-001247</strong></td>
                            <td>
                                <div>
                                    <div class="fw-bold">Clean Code: A Handbook</div>
                                    <small class="text-muted">ISBN: 978-0132350884</small>
                                </div>
                            </td>
                            <td>Robert C. Martin</td>
                            <td><span class="badge bg-secondary">005.1 MAR</span></td>
                            <td><span class="resource-type-badge type-physical">Physical</span></td>
                            <td><span class="status-badge status-cataloged">Cataloged</span></td>
                            <td>
                                <button class="action-btn" title="Edit"><i class="ri-edit-line"></i></button>
                                <button class="action-btn" title="View MARC"><i class="ri-file-list-3-line"></i></button>
                                <button class="action-btn" title="Print Barcode"><i class="ri-printer-line"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>BC-2025-001246</strong></td>
                            <td>
                                <div>
                                    <div class="fw-bold">Introduction to Algorithms</div>
                                    <small class="text-muted">ISBN: 978-0262033848</small>
                                </div>
                            </td>
                            <td>Cormen, Leiserson</td>
                            <td><span class="badge bg-secondary">005.1 COR</span></td>
                            <td><span class="resource-type-badge type-physical">Physical</span></td>
                            <td><span class="status-badge status-cataloged">Cataloged</span></td>
                            <td>
                                <button class="action-btn" title="Edit"><i class="ri-edit-line"></i></button>
                                <button class="action-btn" title="View MARC"><i class="ri-file-list-3-line"></i></button>
                                <button class="action-btn" title="Print Barcode"><i class="ri-printer-line"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>BC-2025-001245</strong></td>
                            <td>
                                <div>
                                    <div class="fw-bold">Digital Library Resources Collection</div>
                                    <small class="text-muted">DOI: 10.1234/dlrc.2025</small>
                                </div>
                            </td>
                            <td>Various Authors</td>
                            <td><span class="badge bg-secondary">020 DIG</span></td>
                            <td><span class="resource-type-badge type-digital">Digital</span></td>
                            <td><span class="status-badge status-cataloged">Cataloged</span></td>
                            <td>
                                <button class="action-btn" title="Edit"><i class="ri-edit-line"></i></button>
                                <button class="action-btn" title="View MARC"><i class="ri-file-list-3-line"></i></button>
                                <button class="action-btn" title="Metadata"><i class="ri-file-code-line"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><em class="text-muted">Pending</em></td>
                            <td>
                                <div>
                                    <div class="fw-bold">Database Systems Concepts</div>
                                    <small class="text-muted">ISBN: 978-0073523323</small>
                                </div>
                            </td>
                            <td>Silberschatz, Korth</td>
                            <td><em class="text-muted">Not assigned</em></td>
                            <td><span class="resource-type-badge type-physical">Physical</span></td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                            <td>
                                <button class="action-btn" title="Edit"><i class="ri-edit-line"></i></button>
                                <button class="action-btn" title="Assign DDC"><i class="ri-number-1"></i></button>
                                <button class="action-btn" title="Assign Barcode"><i class="ri-barcode-line"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <div class="table-footer">
                    <div class="pagination-info">
                        Showing 1 to 4 of 1,247 entries
                    </div>
                    <nav>
                        <ul class="pagination mb-0">
                            <li class="page-item disabled"><a class="page-link" href="#">‹</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="#">250</a></li>
                            <li class="page-item"><a class="page-link" href="#">›</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

{{-- @include('modals/catalog_modal')
@include('modals/barcode_modal') --}}

@endsection