<div class="modal fade select2-modal" id="editCatalog{{$cataloging->id}}" tabindex="-1" role="dialog" aria-labelledby="editCatalogData" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Catalog</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editCatalogForm" method="POST" action="{{url('update_catalog/'.$cataloging->id)}}" onsubmit="show()" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 form-group mb-2">
                            <label>Framework&nbsp;<span class="text-danger">*</span></label>
                            <select name="framework_id" id="framework_id" class="form-control select2" required>
                                <option value="">-- Select Framework --</option>
                                @foreach ($frameworks as $framework)
                                    <option value="{{ $framework->id }}" {{ $cataloging->framework_id == $framework->id ? 'selected' : '' }}>
                                        {{ $framework->description }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group mb-2">
                            <label>Item Type&nbsp;<span class="text-danger">*</span></label>
                            <select name="type_id" id="type_id" class="form-control select2" required>
                                <option value="">-- Select Item Type --</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}" {{ $cataloging->type_id == $type->id ? 'selected' : '' }}>
                                        {{ $type->description }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group mb-2">
                            <label>Book Title&nbsp;<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Book Title" value="{{ $cataloging->name }}" required>
                        </div>
                        <div class="col-md-6 form-group mb-2">
                            <label>Author <span class="text-danger">*</span></label>
                            @php
                                $selectedAuthors = $cataloging->authors->pluck('author_name')->toArray();
                            @endphp
                            <select name="author_name[]" id="author_name_{{ $cataloging->id }}" class="form-control select2" multiple required>
                                @foreach ($authors as $author)
                                    <option value="{{ $author->name }}" {{ in_array($author->name, $selectedAuthors) ? 'selected' : '' }}>
                                        {{ $author->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group mb-2">
                            <label>ISBN&nbsp;<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="isbn" placeholder="Enter ISBN" value="{{ $cataloging->isbn }}" required>
                        </div>
                        <div class="col-md-6 form-group mb-2">
                            <label>Publisher</label>
                            <input type="text" class="form-control" name="publisher" placeholder="Enter Publisher" value="{{ $cataloging->publisher }}">
                        </div>
                        <div class="col-md-6 form-group mb-2">
                            <label>Publication Year</label>
                            <input type="number" class="form-control" name="publication_year" placeholder="Enter Publication Year" value="{{ $cataloging->publication_year }}">
                        </div>
                        <div class="col-md-6 form-group mb-2">
                            <label>Edition</label>
                            <input type="text" class="form-control" name="edition" placeholder="Enter Edition" value="{{ $cataloging->edition }}">
                        </div>
                        <div class="col-md-6 form-group mb-2">
                            <label>DDC/ Call Number</label>
                            <input type="text" class="form-control" name="ddc" placeholder="Enter DDC/ Call Number" value="{{ $cataloging->ddc }}">
                        </div>
                        <div class="col-md-6 form-group mb-2">
                            <label>Rack</label>
                            <select name="rack_id" id="rack_id" class="form-control select2">
                                <option value="">-- Select Rack --</option>
                                @foreach ($racks as $rack)
                                    <option value="{{ $rack->id }}" {{ $cataloging->rack_id == $rack->id ? 'selected' : '' }}>
                                        {{ $rack->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group mb-2">
                            <label>Branch&nbsp;<span class="text-danger">*</span></label>
                            <select name="branch_id" id="branch_id" class="form-control select2" required>
                                <option value="">-- Select Branch --</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}" {{ $cataloging->branch_id == $branch->id ? 'selected' : '' }}>
                                        {{ $branch->branch_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 form-group mb-2">
                            <label>Description</label>
                            <textarea name="description" class="form-control" placeholder="Enter Description">{{ $cataloging->description }}</textarea>
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