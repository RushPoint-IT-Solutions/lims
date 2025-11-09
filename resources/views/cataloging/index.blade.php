@extends('layouts.header')

@section('css')
<style>
    .btn-md {
        border: none !important;
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

    /* Pagination Styles */
    .pagination-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        padding-top: 15px;
        border-top: 1px solid #e9ecef;
    }

    .pagination-info {
        color: #6c757d;
        font-size: 14px;
    }

    .pagination {
        margin: 0;
        display: flex;
        list-style: none;
        padding: 0;
    }

    .pagination .page-item {
        margin: 0 2px;
    }

    .pagination .page-link {
        color: #5a6c7d;
        border: 1px solid #dee2e6;
        padding: 6px 12px;
        border-radius: 4px;
        text-decoration: none;
        display: block;
    }

    .pagination .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: white;
    }

    .pagination .page-link:hover {
        background-color: #e9ecef;
        color: #0d6efd;
    }

    .pagination .page-item.disabled .page-link {
        color: #6c757d;
        background-color: #fff;
        border-color: #dee2e6;
        cursor: not-allowed;
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
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title d-flex justify-content-between mb-3">
                    Cataloging Records
                    <div>
                        <button type="button" class="btn btn-md btn-primary" data-bs-toggle="modal" data-bs-target="#newCatalogModal">
                            <i class="ri-add-line"></i>&nbsp;New Catalog Entry
                        </button>
                        <button type="button" class="btn btn-md btn-success ms-2" data-bs-toggle="modal" data-bs-target="#barcodeModal">
                            <i class="ri-barcode-line"></i> Assign Barcode
                        </button>
                    </div>
                </h4>
                
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <span>Show</span>
                        <select class="form-select form-select-sm" style="width: auto;">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <span>entries</span>
                    </div>
                    <div class="col-md-4">
                        <form method="GET" action="#" class="custom_form" enctype="multipart/form-data">
                            <div class="search">
                                <input type="text" class="form-control" placeholder="Search by title, ISBN, author..." name="search" value="{{ request('search') }}"> 
                                <button class="btn btn-sm btn-primary">Search</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Actions</th>
                                <th>Barcode</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>DDC/Call Number</th>
                                <th>Type</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <button class="btn btn-outline-info btn-sm" title="Edit">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>
                                    <button class="btn btn-outline-secondary btn-sm" title="View MARC">
                                        <i class="mdi mdi-file-document"></i>
                                    </button>
                                </td>
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
                            </tr>
                            <tr>
                                <td>
                                    <button class="btn btn-outline-info btn-sm" title="Edit">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>
                                    <button class="btn btn-outline-secondary btn-sm" title="View MARC">
                                        <i class="mdi mdi-file-document"></i>
                                    </button>
                                </td>
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
                            </tr>
                            <tr>
                                <td>
                                    <button class="btn btn-outline-info btn-sm" title="Edit">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>
                                    <button class="btn btn-outline-secondary btn-sm" title="View MARC">
                                        <i class="mdi mdi-file-document"></i>
                                    </button>
                                </td>
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
                            </tr>
                            <tr>
                                <td>
                                    <button class="btn btn-outline-info btn-sm" title="Edit">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>
                                    <button class="btn btn-outline-warning btn-sm" title="Assign Barcode">
                                        <i class="mdi mdi-barcode"></i>
                                    </button>
                                </td>
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
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper">
                    <div class="pagination-info">
                        Showing 1 to 4 of 1,247 entries
                    </div>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">4</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">5</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade select2-modal" id="newCatalogModal" tabindex="-1" role="dialog" aria-labelledby="addCatalogData" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Catalog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addCatalogForm" method="POST" action="{{ url('/new_catalog') }}" onsubmit="show()" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 form-group mb-2">
                                <label>Framework&nbsp;<span class="text-danger">*</span></label>
                                <select name="framework_id" id="framework_id" class="form-control select2" required>
                                    <option value="">-- Select Framework --</option>
                                    @foreach ($frameworks as $framework)
										<option value='{{ $framework->id}}'>{{ $framework->description }}</option>
									@endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group mb-2">
                                <label>Item Type&nbsp;<span class="text-danger">*</span></label>
                                <select name="type_id" id="type_id" class="form-control select2" required>
                                    <option value="">-- Select Item Type --</option>
                                    @foreach ($types as $type)
										<option value='{{ $type->id}}'>{{ $type->name }}</option>
									@endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group mb-2">
                                <label>Book Title&nbsp;<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Book Title" required>
                            </div>
                            <div class="col-md-6 form-group mb-2">
                                <label>Author&nbsp;<span class="text-danger">*</span></label>
                                <select name="author_id" id="author_id" class="form-control select2" multiple required>
                                    <option value="">-- Select Author --</option>
                                    @foreach ($authors as $author)
										<option value='{{ $author->id}}'>{{ $author->name }}</option>
									@endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group mb-2">
                                <label>ISBN&nbsp;<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="isbn" placeholder="Enter ISBN" required>
                            </div>
                            <div class="col-md-6 form-group mb-2">
                                <label>Publisher</label>
                                <input type="text" class="form-control" name="publisher" placeholder="Enter Publisher">
                            </div>
                            <div class="col-md-6 form-group mb-2">
                                <label>Publication Year</label>
                                <input type="text" class="form-control" name="publication_year" placeholder="Enter Publication Year">
                            </div>
                            <div class="col-md-6 form-group mb-2">
                                <label>Edition</label>
                                <input type="text" class="form-control" name="edition" placeholder="Enter Edition">
                            </div>
                            <div class="col-md-6 form-group mb-2">
                                <label>DDC/ Call Number</label>
                                <input type="text" class="form-control" name="ddc" placeholder="Enter DDC/ Call Number">
                            </div>
                            <div class="col-md-6 form-group mb-2">
                                <label>Rack</label>
                                <select name="rack_id" id="rack_id" class="form-control select2">
                                    <option value="">-- Select Rack --</option>
                                    @foreach ($racks as $rack)
										<option value='{{ $rack->id}}'>{{ $rack->name }}</option>
									@endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group mb-2">
                                <label>Branch&nbsp;<span class="text-danger">*</span></label>
                                <select name="branch_id" id="branch_id" class="form-control select2" required>
                                    <option value="">-- Select Branch --</option>
                                    @foreach ($branches as $branch)
										<option value='{{ $branch->id}}'>{{ $branch->branch_name }}</option>
									@endforeach
                                </select>
                            </div>
                            <div class="col-md-12 form-group mb-2">
                                <label>Description</label>
                                <textarea name="description" class="form-control" placeholder="Enter Description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="submitCatalog()">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function submitCatalog() {
        const form = document.getElementById('addCatalogForm');
        if (form.checkValidity()) {
            form.submit();
        } else {
            form.reportValidity();
        }
    }

    $(document).on('shown.bs.modal', '.select2-modal', function () {
        const $modal = $(this);
        $modal.find('.select2').select2({
            dropdownParent: $modal
        });
    });
</script>
@endsection