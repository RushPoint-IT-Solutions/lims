@extends('layouts.header')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title d-flex justify-content-between mb-3">
                Item Types List
                <button type="button" class="btn btn-md btn-primary" data-bs-toggle="modal" data-bs-target="#addTypeModal">
                    Add Item Type
                </button>
            </h4>
            <div class="col-md-6 offset-md-6">
                <form method="GET" action="{{ route('types') }}" class="custom_form mb-3" enctype="multipart/form-data" onsubmit="show()">
                    <div class="row height d-flex justify-content-end align-items-end">
                        <div class="col-md-9">
                            <div class="search">
                                <input type="text" class="form-control" placeholder="Search Item Types" name="search" value="{{ request('search') }}"> 
                                <button class="btn btn-sm btn-search btn-primary">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th width="12%">Action</th>
                        <th width="15%">Code</th>
                        <th width="25%">Description</th>
                        <th width="15%">Not for Loan</th>
                        <th width="15%">Charges</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($types as $type)
                        <tr>
                            <td>
                                <button class="btn btn-outline-info btn-sm" title="Edit Type" data-bs-toggle="modal" data-bs-target="#editType{{$type->id}}">
                                    <i class="mdi mdi-pencil"></i>
                                </button>
                                <form method="POST" class="d-inline-block" action="{{url('delete_type/'.$type->id)}}" onsubmit="show()" enctype="multipart/form-data">
                                    @csrf
                                    <button type="button" class="btn btn-sm btn-outline-danger deleteBtn">
                                        <i class="mdi mdi-trash-can"></i>
                                    </button>
                                </form>
                            </td>
                            <td>{{ $type->code }}</td>
                            <td>{{ $type->description }}</td>
                            <td>
                                @if($type->loan == 'Yes')
                                    Yes
                                @else
                                    No
                                @endif
                            </td>
                            <td>{{ $type->charge ?? '0.00' }}</td>
                        </tr>
                        @include('settings.types.edit')
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No Item Types Found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $types->appends(request()->query())->links() }}
        </div>
    </div>
</div>

<div class="modal fade" id="addTypeModal" tabindex="-1" role="dialog" aria-labelledby="addTypeData" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Item Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ url('/new_type') }}" onsubmit="show()" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 form-group mb-2">
                            <label>Code&nbsp;<span class="text-danger">*</span></label>
                            <input type="text" name="code" class="form-control" placeholder="Enter code" required>
                        </div>
                        <div class="col-md-6 form-group mb-2">
                            <label>Description&nbsp;<span class="text-danger">*</span></label>
                            <input type="text" name="description" class="form-control" placeholder="Enter description" required>
                        </div>
                        <div class="col-md-6 form-group mb-2">
                            <label>Charge</label>
                            <input type="text" name="charge" class="form-control" placeholder="0.00">
                        </div>
                        <div class="col-md-6 form-group mb-2">
                            <div class="form-check">
                                <input type="hidden" name="loan" value="No">
                                <input class="form-check-input" type="checkbox" name="loan" id="formCheckboxRight1" value="Yes">
                                <label class="form-check-label" for="formCheckboxRight1">
                                    Not for Loan
                                </label>
                            </div>
                            <small class="text-muted">If checked, no item of this type can be issued. If not checked, every item of this type can be issued unless notforloan is set for a specific item</small>
                        </div>
                        <div class="col-md-12 form-group mb-2">
                            <label>Summary</label>
                            <textarea name="summary" class="form-control" placeholder="Enter summary"></textarea>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $(".deleteBtn").on('click', function() {
            var form = $(this).closest('form')

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit()
                }
            });
        })
    });
</script>
@endsection