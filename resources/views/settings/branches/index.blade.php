@extends('layouts.header')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title d-flex justify-content-between mb-3">
                Branches List
                <button type="button" class="btn btn-md btn-primary" id="addBranchBtn" data-bs-toggle="modal" data-bs-target="#addBranchModal">
                    Add Branch
                </button>
            </h4>
            <div class="col-md-6 offset-md-6">
                <form method="GET" action="{{ route('branches') }}" class="custom_form mb-3" enctype="multipart/form-data" onsubmit="show()">
                    <div class="row height d-flex justify-content-end align-items-end">
                        <div class="col-md-9">
                            <div class="search">
                                <input type="text" class="form-control" placeholder="Search Branches" name="search" value="{{ request('search') }}"> 
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
                        <th width="20%">Name</th>
                        <th width="15%">Contact No</th>
                        <th width="18%">Contact Person</th>
                        <th width="35%">Location</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($branches as $branch)
                        <tr>
                            <td>
                                <button class="btn btn-outline-info btn-sm" title="Edit Branch" data-bs-toggle="modal" data-bs-target="#editBranch{{$branch->id}}">
                                    <i class="mdi mdi-pencil"></i>
                                </button>
                                <form method="POST" class="d-inline-block" action="{{url('delete_branch/'.$branch->id)}}" onsubmit="show()" enctype="multipart/form-data">
                                    @csrf
                                    <button type="button" class="btn btn-sm btn-outline-danger deleteBtn">
                                        <i class="mdi mdi-trash-can"></i>
                                    </button>
                                </form>
                            </td>
                            <td>{{ $branch->branch_name }}</td>
                            <td>{{ $branch->contact_no }}</td>
                            <td>{{ $branch->contact_person }}</td>
                            <td>{{ $branch->location }}</td>
                        </tr>
                        @include('settings.branches.edit')
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No Branches Found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $branches->appends(request()->query())->links() }}
        </div>
    </div>
</div>

<div class="modal fade" id="addBranchModal" tabindex="-1" role="dialog" aria-labelledby="addBranchData" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Branch</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ url('/new_branch') }}" onsubmit="show()" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 form-group mb-2">
                            <label>Branch Name&nbsp;<span class="text-danger">*</span></label>
                            <input type="text" name="branch_name" class="form-control" placeholder="Enter branch name" required>
                        </div>
                        <div class="col-md-6 form-group mb-2">
                            <label>Contact Number&nbsp;<span class="text-danger">*</span></label>
                            <input type="text" name="contact_no" class="form-control" placeholder="Enter contact number" required>
                        </div>
                        <div class="col-md-6 form-group mb-2">
                            <label>Location&nbsp;<span class="text-danger">*</span></label>
                            <input type="text" name="location" class="form-control" placeholder="Enter location" required>
                        </div>
                        <div class="col-md-6 form-group mb-2">
                            <label>Contact Person</label>
                            <input type="text" name="contact_person" class="form-control" placeholder="Enter contact person">
                        </div>
                        <div class="col-md-12 form-group mb-2">
                            <label>Address</label>
                            <textarea name="address" class="form-control" placeholder="Enter full address"></textarea>
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