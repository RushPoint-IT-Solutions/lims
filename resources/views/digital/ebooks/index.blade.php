@extends('layouts.header')

@section('css')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding: 0 15px;
    }

    .page-header h4 {
        font-size: 24px;
        font-weight: 600;
        margin: 0;
        color: #2c3e50;
    }

    .header-actions {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .add-book-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        background-color: #800000;
        color: white;
        border-radius: 5px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: background-color 0.3s;
        white-space: nowrap;
    }

    .add-book-btn:hover {
        background-color: #600000;
        color: white;
    }

    .add-book-btn i {
        font-size: 18px;
    }

    .search-input {
        width: 300px;
        padding: 10px 15px;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        font-size: 14px;
        transition: border-color 0.3s;
    }

    .search-input:focus {
        outline: none;
        border-color: #d07e0a;
    }

    .section-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px;
        color: #2c3e50;
    }

    .carousel-section {
        background: white;
        border-radius: 8px;
        padding: 25px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.08);
        margin-bottom: 25px;
    }

    .books-carousel {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
        gap: 20px;
    }

    .book-card {
        cursor: pointer;
        transition: transform 0.3s ease;
        position: relative;
    }

    .book-card:hover {
        transform: translateY(-8px);
    }

    .book-cover {
        width: 100%;
        height: 220px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
        padding: 20px;
        transition: box-shadow 0.3s ease;
        overflow: hidden;
        position: relative;
    }

    .book-cover img {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
    }

    .book-card:hover .book-cover {
        box-shadow: 0 8px 24px rgba(0,0,0,0.25);
    }

    .book-cover-content {
        width: 100%;
        position: relative;
        z-index: 1;
    }

    .book-cover-title {
        font-size: 16px;
        font-weight: 600;
        line-height: 1.4;
        margin-bottom: 8px;
    }

    .book-cover-author {
        font-size: 11px;
        opacity: 0.85;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .book-title-bottom {
        margin-top: 12px;
        font-size: 14px;
        font-weight: 500;
        text-align: center;
        color: #495057;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        min-height: 40px;
    }

    .book-actions {
        display: flex;
        gap: 8px;
        margin-top: 10px;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .book-card:hover .book-actions {
        opacity: 1;
    }

    .action-btn {
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 12px;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
    }

    .read-btn {
        background: #d07e0a;
        color: white;
    }

    .read-btn:hover {
        background: #b86d08;
    }

    .edit-btn {
        background: #17a2b8;
        color: white;
    }

    .edit-btn:hover {
        background: #138496;
    }

    .delete-btn {
        background: #dc3545;
        color: white;
    }

    .delete-btn:hover {
        background: #c82333;
    }

    /* Modal Styles */
    .modal-header {
        background: #8B0000;
        color: white;
        border-radius: 10px 10px 0 0;
    }

    .modal-title {
        color: white;
    }

    .modal-header .btn-close {
        filter: brightness(0) invert(1);
    }

    .upload-area {
        border: 2px dashed #dee2e6;
        border-radius: 8px;
        padding: 30px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
    }

    .upload-area:hover {
        border-color: #d07e0a;
        background: #f8f9fa;
    }

    .upload-area i {
        font-size: 48px;
        color: #d07e0a;
        margin-bottom: 15px;
        display: block;
    }

    .btn-primary {
        background: #8B0000;
    }

    .btn-primary:hover {
        background: #740202;
    }

    /* PDF Reader Modal */
    .book-reader-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.95);
        z-index: 9999;
        overflow: hidden;
    }

    .book-reader-modal.active {
        display: flex;
        flex-direction: column;
    }

    .reader-header {
        background: rgba(30, 30, 30, 0.95);
        padding: 15px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .reader-title {
        color: white;
        font-size: 18px;
        font-weight: 600;
        margin: 0;
    }

    .close-reader {
        background: transparent;
        border: none;
        color: white;
        font-size: 28px;
        cursor: pointer;
        padding: 0;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.3s;
    }

    .close-reader:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    .reader-controls {
        background: rgba(30, 30, 30, 0.95);
        padding: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        flex-wrap: wrap;
    }

    .control-btn {
        background: rgba(208, 126, 10, 0.9);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 14px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s;
    }

    .control-btn:hover:not(:disabled) {
        background: #d07e0a;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(208, 126, 10, 0.3);
    }

    .control-btn:disabled {
        background: rgba(100, 100, 100, 0.5);
        cursor: not-allowed;
        opacity: 0.5;
    }

    .page-indicator {
        color: white;
        font-size: 14px;
        padding: 8px 16px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .header-actions {
            width: 100%;
            flex-direction: column;
            gap: 10px;
        }

        .search-input {
            width: 100%;
        }

        .add-book-btn {
            width: 100%;
            justify-content: center;
        }

        .books-carousel {
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 15px;
        }

        .book-cover {
            height: 200px;
        }
    }
</style>
@endsection

@section('content')
    <div class="page-header mt-2">
        <h4>E Books</h4>
        <div class="header-actions">
            <a href="#" class="add-book-btn" data-bs-toggle="modal" data-bs-target="#addEBookModal">
                <i class="ri-add-circle-line"></i> Add E Book
            </a>
            <input type="text" class="search-input" placeholder="Search by title or author" id="searchInput">
        </div>
    </div>

    <!-- Add E-Book Modal -->
    <div class="modal fade select2-modal" id="addEBookModal" tabindex="-1" role="dialog" aria-labelledby="addEBookData" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New E Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addEBookForm" method="POST" action="{{ url('/new_ebook') }}" onsubmit="show()" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 form-group mb-2">
                                <label>Type&nbsp;<span class="text-danger">*</span></label>
                                <select name="type" id="type" class="form-control select2" required>
                                    <option value="">-- Select Type --</option>
                                    <option value="New">New</option>
                                    <option value="Existing">Existing</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group mb-2">
                                <label>Book Title&nbsp;<span class="text-danger">*</span></label>
                                <div id="new_book_container">
                                    <input type="text" name="new_book_title" class="form-control" placeholder="Enter Book Title">
                                </div>
                                <div id="existing_book_container">
                                    <select name="existing_book_title" id="existing_book" class="form-control select2">
                                        <option value="">-- Select Book --</option>
                                        <option value="Book1">Book 1</option>
                                        <option value="Book2">Book 2</option>
                                        <option value="Book3">Book 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 form-group mb-2">
                                <label>ISBN&nbsp;<span class="text-danger">*</span></label>
                                <input type="text" name="isbn" class="form-control" placeholder="978-XXXXXXXXXX" required>
                            </div>
                            <div class="col-md-6 form-group mb-2">
                                <label>Author&nbsp;<span class="text-danger">*</span></label>
                                <input type="text" name="author_name" class="form-control" placeholder="Enter Author Name" required>
                            </div>
                            <div class="col-md-6 form-group mb-2">
                                <label>Publisher</label>
                                <input type="text" name="publisher" class="form-control" placeholder="Enter Publisher Name">
                            </div>
                            <div class="col-md-6 form-group mb-2">
                                <label>Publication Year</label>
                                <input type="number" name="publication_year" class="form-control" placeholder="2025" min="1900" max="2500">
                            </div>
                            <div class="col-md-6 form-group mb-2">
                                <label>Pages&nbsp;<span class="text-danger">*</span></label>
                                <input type="number" name="page_count" class="form-control" placeholder="500" min="1" required>
                            </div>
                            <div class="col-md-12 form-group mb-2">
                                <label>Cover Image</label>
                                <input type="file" class="form-control" accept="image/*" id="coverUpload" name="cover_image_path">
                            </div>
                            <div class="col-md-12 form-group mb-2">
                                <label>Upload PDF&nbsp;<span class="text-danger">*</span></label>
                                <div class="upload-area" onclick="document.getElementById('pdfUpload').click()">
                                    <i class="ri-file-pdf-line"></i>
                                    <h5>Click to upload PDF</h5>
                                    <p class="text-muted mb-0 text-center">or drag and drop</p>
                                    <small class="text-muted" id="fileName"></small>
                                </div>
                                <input type="file" name="file_path" id="pdfUpload" accept=".pdf" style="display: none;" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="submitEbook()">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- All Books Section -->
    <div class="carousel-section">
        <div class="section-title">All E-Books</div>
        <div class="books-carousel">
            @foreach ($ebooks as $ebook)
            <div class="book-card" onclick="window.location.href='{{ url('e_books/' . $ebook->id) }}'">
                <div class="book-cover" style="background: linear-gradient(135deg, {{ '#' . substr(md5($ebook->id), 0, 6) }} 0%, {{ '#' . substr(md5($ebook->id * 2), 0, 6) }} 100%);">
                    @if($ebook->cover_image_path)
                        <img src="{{ asset($ebook->cover_image_path) }}" alt="{{ $ebook->book_title }}">
                    @else
                        <div class="book-cover-content">
                            <div class="book-cover-title">{{ Str::limit($ebook->book_title, 40) }}</div>
                            <div class="book-cover-author">{{ $ebook->author_name }}</div>
                        </div>
                    @endif
                </div>
                <div class="book-title-bottom">{{ $ebook->book_title }}</div>
                {{-- <div class="book-actions">
                    <button class="action-btn read-btn" onclick="openBookReader('{{ $ebook->book_title }}', '{{ $ebook->author_name }}', {{ $ebook->page_count }}, '{{ asset($ebook->file_path) }}')">
                        <i class="ri-book-open-line"></i>
                    </button>
                    <button class="action-btn edit-btn" data-bs-toggle="modal" data-bs-target="#editEbook{{$ebook->id}}">
                        <i class="ri-edit-line"></i>
                    </button>
                    <form method="POST" class="d-inline-block" action="{{url('delete_ebook/'.$ebook->id)}}" onsubmit="show()" enctype="multipart/form-data">
                        @csrf
                        <button type="button" class="action-btn delete-btn deleteBtn">
                            <i class="mdi mdi-trash-can"></i>
                        </button>
                    </form>
                </div> --}}
            </div>
            @include('digital.ebooks.edit')
            @endforeach
        </div>
    </div>

    <!-- PDF Reader Modal -->
    <div id="bookReader" class="book-reader-modal">
        <div class="reader-header">
            <h2 id="readerBookTitle" class="reader-title"></h2>
            <button class="close-reader" onclick="closeBookReader()">×</button>
        </div>
        <div id="pdfViewerContainer" style="width:100%; height:80vh; overflow:auto; background:#f4f4f4; text-align:center;">
            <canvas id="pdfCanvas"></canvas>
        </div>
        <div class="reader-controls">
            <button class="control-btn" onclick="prevPDFPage()">
                <i class="ri-arrow-left-line"></i> Previous
            </button>
            <span id="pageNumDisplay" class="page-indicator">1 / 1</span>
            <button class="control-btn" onclick="nextPDFPage()">
                Next <i class="ri-arrow-right-line"></i>
            </button>
        </div>
    </div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function submitEbook() {
        const form = document.getElementById('addEBookForm');
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

    $(document).ready(function () {
        $('#existing_book').select2();

        $('#type').on('change', function () {
            const type = $(this).val();

            if (type === 'Existing') {
                $('#existing_book_container').show();
                $('#new_book_container').hide();
            } else if (type === 'New') {
                $('#new_book_container').show();
                $('#existing_book_container').hide();
            } else {
                $('#new_book_container, #existing_book_container').hide();
            }
        });

        $('#type').trigger('change');

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

    // PDF Reader Functionality
    let pdfDoc = null;
    let currentPage = 1;
    let pdfFilePath = '';

    async function openBookReader(title, author, pages, filePath) {
        document.getElementById('readerBookTitle').textContent = title;
        document.getElementById('bookReader').classList.add('active');
        document.body.style.overflow = 'hidden';

        pdfFilePath = filePath;
        await loadPDF(pdfFilePath);
    }

    function closeBookReader() {
        document.getElementById('bookReader').classList.remove('active');
        document.body.style.overflow = '';
    }

    async function loadPDF(url) {
        try {
            const loadingTask = pdfjsLib.getDocument(url);
            pdfDoc = await loadingTask.promise;
            currentPage = 1;
            renderPage(currentPage);
            document.getElementById('pageNumDisplay').textContent = `${currentPage} / ${pdfDoc.numPages}`;
        } catch (err) {
            alert('Error loading PDF: ' + err.message);
        }
    }

    async function renderPage(num) {
        const page = await pdfDoc.getPage(num);
        const viewport = page.getViewport({ scale: 1.5 });
        const canvas = document.getElementById('pdfCanvas');
        const context = canvas.getContext('2d');
        canvas.height = viewport.height;
        canvas.width = viewport.width;

        const renderContext = {
            canvasContext: context,
            viewport: viewport
        };
        await page.render(renderContext);
    }

    async function nextPDFPage() {
        if (currentPage < pdfDoc.numPages) {
            currentPage++;
            renderPage(currentPage);
            document.getElementById('pageNumDisplay').textContent = `${currentPage} / ${pdfDoc.numPages}`;
        }
    }

    async function prevPDFPage() {
        if (currentPage > 1) {
            currentPage--;
            renderPage(currentPage);
            document.getElementById('pageNumDisplay').textContent = `${currentPage} / ${pdfDoc.numPages}`;
        }
    }

    // File upload handling
    document.getElementById('pdfUpload').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name || '';
        document.getElementById('fileName').textContent = fileName ? `Selected: ${fileName}` : '';
    });

    const uploadArea = document.querySelector('.upload-area');

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        uploadArea.addEventListener(eventName, () => {
            uploadArea.style.borderColor = '#d07e0a';
            uploadArea.style.background = '#f8f9fa';
        });
    });

    ['dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, () => {
            uploadArea.style.borderColor = '#dee2e6';
            uploadArea.style.background = 'transparent';
        });
    });

    uploadArea.addEventListener('drop', function(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        
        if (files.length > 0 && files[0].type === 'application/pdf') {
            document.getElementById('pdfUpload').files = files;
            document.getElementById('fileName').textContent = `Selected: ${files[0].name}`;
        }
    });

    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();
        const bookCards = document.querySelectorAll('.book-card');
        
        bookCards.forEach(card => {
            const title = card.querySelector('.book-title-bottom').textContent.toLowerCase();
            if (title.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
</script>
@endsection