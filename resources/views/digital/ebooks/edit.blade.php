<div class="modal fade select2-modal" id="editEbook{{$ebook->id}}" tabindex="-1" role="dialog" aria-labelledby="addEBookData" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit E Book</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addEBookForm" method="POST" action="{{url('update_ebook/'.$ebook->id)}}" onsubmit="show()" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 form-group mb-2">
                            <label>Book Title&nbsp;<span class="text-danger">*</span></label>
                            <input type="text" name="book_title" class="form-control" placeholder="Enter Book Title" value="{{$ebook->book_title}}" required>
                        </div>
                        <div class="col-md-6 form-group mb-2">
                            <label>ISBN&nbsp;<span class="text-danger">*</span></label>
                            <input type="text" name="isbn" class="form-control" placeholder="978-XXXXXXXXXX" required value="{{$ebook->isbn}}">
                        </div>
                        <div class="col-md-6 form-group mb-2">
                            <label>Author&nbsp;<span class="text-danger">*</span></label>
                            <input type="text" name="author_name" class="form-control" placeholder="Enter Author Name" required value="{{$ebook->author_name}}">
                        </div>
                        <div class="col-md-6 form-group mb-2">
                            <label>Publisher</label>
                            <input type="text" name="publisher" class="form-control" placeholder="Enter Publisher Name" value="{{$ebook->publisher}}">
                        </div>
                        <div class="col-md-6 form-group mb-2">
                            <label>Publication Year</label>
                            <input type="number" name="publication_year" class="form-control" placeholder="2025" min="1900" max="2500" value="{{$ebook->publication_year}}">
                        </div>
                        <div class="col-md-6 form-group mb-2">
                            <label>Pages</label>
                            <input type="number" name="page_count" class="form-control" placeholder="500" min="1" value="{{$ebook->page_count}}">
                        </div>
                        <div class="col-md-12 form-group mb-2">
                            <label>Cover Image</label>
                            <input type="file" class="form-control" accept="image/*" id="coverUpload" name="cover_image_path">
                            @if(!empty($ebook->cover_image_path))
                                <img src="{{ asset($ebook->cover_image_path) }}" alt="Cover Image" class="mt-2 rounded" style="height: 50px;">
                            @endif
                        </div>
                        <div class="col-md-12 form-group mb-2">
                            <label>Upload PDF&nbsp;<span class="text-danger">*</span></label>
                            <div class="upload-area" onclick="document.getElementById('pdfUpload{{$ebook->id}}').click()">
                                <i class="ri-file-pdf-line"></i>
                                <h5>Click to upload PDF</h5>
                                <p class="text-muted mb-0 text-center">or drag and drop</p>
                                <small class="text-muted" id="fileName{{$ebook->id}}"></small>
                            </div>
                            <input type="file" name="file_path" id="pdfUpload{{$ebook->id}}" accept=".pdf" style="display: none;" @if(empty($ebook->file_path)) required @endif>
                            @if(!empty($ebook->file_path))
                                <div class="mt-2">
                                    <a href="{{ asset($ebook->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="ri-eye-line"></i> View Existing PDF
                                    </a>
                                </div>
                            @endif
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