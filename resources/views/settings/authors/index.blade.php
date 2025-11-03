@extends('layouts.header')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title d-flex justify-content-between mb-3">
                Authors List
                <button type="button" class="btn btn-md btn-primary" id="addAuthorBtn" data-bs-toggle="modal" data-bs-target="#formAuthors">
                    Add Author
                </button>
            </h4>
            <div class="col-md-6 offset-md-6">
                <form method="GET" action="{{ route('authors') }}" class="custom_form mb-3" enctype="multipart/form-data" onsubmit="show()">
                    <div class="row height d-flex justify-content-end align-items-end">
                        <div class="col-md-9">
                            <div class="search">
                                <input type="text" class="form-control" placeholder="Search Authors" name="search" value="{{ request('search') }}"> 
                                <button class="btn btn-sm btn-primary">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th width="12%">Action</th>
                        <th width="25%">Name</th>
                        <th width="20%">Status</th>
                        <th width="23%">Date Created</th>
                        <th width="20%">Created By</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($authors as $author)
                        <tr>
                            <td>
                                @if($author->status == 'Inactive')
                                <form method="POST" class="d-inline-block" action="{{ url('active/'.$author->id) }}" onsubmit="show()" enctype="multipart/form-data">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-success">
                                        <i class="mdi mdi-check"></i>
                                    </button>
                                </form>
                                @else
                                 <form method="POST" class="d-inline-block" action="{{ url('inactive/'.$author->id) }}" onsubmit="show()" enctype="multipart/form-data">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="mdi mdi-close"></i>
                                    </button>
                                </form>
                                @endif
                            </td>
                            <td>{{ $author->name }}</td>
                            <td>{{ $author->status }}</td>
                            <td>{{ $author->created_at }}</td>
                            <td>{{ $author->createdBy->name }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No Authors Found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $authors->appends(request()->query())->links() }}
        </div>
    </div>
</div>
<div class="modal fade" id="formAuthors" tabindex="-1" role="dialog" aria-labelledby="addAuthorData" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Author</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ url('/new_author') }}" onsubmit="show()" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 form-group mb-2">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name" required>
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
@endsection