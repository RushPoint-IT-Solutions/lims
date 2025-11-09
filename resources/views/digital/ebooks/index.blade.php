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
    }
    
    .header-actions {
        display: flex;
        gap: 15px;
        align-items: center;
        flex-wrap: nowrap;
    }
    
    .add-book-btn {
        background: #d07e0a;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 14px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
        flex-shrink: 0;
    }
    
    .add-book-btn:hover {
        background: #b86d08;
        color: white;
    }
    
    .search-input {
        padding: 8px 15px;
        border: 1px solid #dee2e6;
        border-radius: 20px;
        font-size: 14px;
        width: 250px;
        flex-shrink: 0;
    }
    
    .search-input:focus {
        outline: none;
        border-color: #d07e0a;
        box-shadow: 0 0 0 0.2rem rgba(208, 126, 10, 0.25);
    }
    
    .books-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 25px;
        margin-bottom: 30px;
    }
    
    .book-item-card {
        display: flex;
        gap: 15px;
        padding: 20px;
        border: 1px solid #e9ecef;
        border-radius: 5px;
        background: white;
        transition: all 0.3s;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    
    .book-item-card:hover {
        border-color: #d07e0a;
        box-shadow: 0 4px 12px rgba(208, 126, 10, 0.15);
        transform: translateY(-2px);
    }
    
    .book-item-card img {
        width: 90px;
        height: 130px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        flex-shrink: 0;
    }
    
    .book-item-info {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 8px;
        min-width: 0;
    }
    
    .book-item-title {
        font-size: 16px;
        font-weight: 600;
        color: #2c3e50;
        margin: 0;
        line-height: 1.4;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
    
    .book-item-author {
        font-size: 13px;
        color: #6c757d;
        margin: 0;
    }
    
    .book-item-details {
        font-size: 12px;
        color: #95a5a6;
        margin-top: auto;
    }
    
    .book-item-details div {
        margin-bottom: 3px;
    }
    
    .book-actions {
        display: flex;
        gap: 8px;
        margin-top: 10px;
        flex-wrap: wrap;
    }
    
    .read-btn {
        background: #d07e0a;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 5px;
        font-size: 12px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.3s;
    }
    
    .read-btn:hover {
        background: #b86d08;
    }
    
    
    
    .delete-btn:hover {
        background: #dc3545;
        color: white;
        border-color: #dc3545;
    }
    
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
    
    .book-container {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        perspective: 2500px;
        overflow: hidden;
    }
    
    .book-wrapper {
        position: relative;
        width: 900px;
        height: 600px;
        max-width: 90vw;
        max-height: 70vh;
    }
    
    .book {
        width: 100%;
        height: 100%;
        position: relative;
        transform-style: preserve-3d;
        display: flex;
    }
    
    .page-container {
        position: absolute;
        width: 50%;
        height: 100%;
        transform-style: preserve-3d;
        transition: transform 0.8s cubic-bezier(0.645, 0.045, 0.355, 1);
        z-index: 10;
    }

    .page-container.right {
        right: 0;
        transform-origin: left center;
    }

    .page-container.right.flipping {
        transform: rotateY(-180deg);
        z-index: 20 !important;
    }

    #flipContainer {
        right: 0;
        transform-origin: left center;
        z-index: 10;
    }

    #flipContainer.flipping {
        transform: rotateY(-180deg);
        z-index: 20 !important;
    }

    .book-page {
        position: absolute;
        width: 100%;
        height: 100%;
        background: #f8f4e6;
        border: 2px solid #d4c5a9;
        backface-visibility: hidden;
        box-shadow: 0 5px 30px rgba(0, 0, 0, 0.3);
    }

    .book-page.front {
        transform: rotateY(0deg);
    }

    .book-page.back {
        transform: rotateY(180deg);
    }

    .static-page {
        position: absolute;
        width: 50%;
        height: 100%;
        background: #f8f4e6;
        border: 2px solid #d4c5a9;
        box-shadow: 0 5px 30px rgba(0, 0, 0, 0.3);
        z-index: 1;
    }

    .static-page.left {
        left: 0;
        border-right: 1px solid #c4b599;
    }

    .static-page.right {
        right: 0;
        border-left: 1px solid #c4b599;
    }
    
    .page-content {
        padding: 40px;
        height: calc(100% - 50px);
        overflow-y: auto;
        font-size: 14px;
        line-height: 1.8;
        color: #333;
    }
    
    .page-content h2 {
        color: #d07e0a;
        margin-bottom: 20px;
        font-size: 20px;
    }
    
    .page-content p {
        margin-bottom: 5px;
        text-align: justify;
    }
    
    .page-content::-webkit-scrollbar {
        width: 6px;
    }
    
    .page-content::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.05);
    }
    
    .page-content::-webkit-scrollbar-thumb {
        background: #d07e0a;
        border-radius: 3px;
    }
    
    .page-number {
        position: absolute;
        bottom: 20px;
        font-size: 12px;
        color: #666;
        width: 100%;
        text-align: center;
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
        transform: none;
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
    
    .modal-content {
        border-radius: 10px;
    }

    .modal-title{
        color: white;
    }
    
    .modal-header {
        background: #8B0000;
        color: white;
        border-radius: 10px 10px 0 0;
    }
    
    .modal-header .btn-close {
        filter: brightness(0) invert(1);
    }
    
    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }
    
    .form-control:focus {
        border-color: #d07e0a;
        box-shadow: 0 0 0 0.2rem rgba(208, 126, 10, 0.25);
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

    #flipContainer {
        transition: transform 0.6s ease-in-out;
        transform-origin: left center;
    }

    #flipContainer.flipping {
        transform: rotateY(-180deg);
    }

    #flipContainer.reverse-flip {
        transform: rotateY(0deg);
    }

    @media (max-width: 768px) {
        .books-grid {
            grid-template-columns: 1fr;
        }
        
        .book-wrapper {
            width: 95vw;
            height: 60vh;
        }
        
        .page-content {
            padding: 20px;
            font-size: 12px;
        }
        
        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
        
        .header-actions {
            width: 100%;
            flex-direction: row;
        }
        
        .search-input {
            flex: 1;
            min-width: 0;
        }
    }
</style>
@endsection

@section('content')
    <div class="page-header mt-5">
        <h4>E Books</h4>
        <div class="header-actions">
            <a href="#" class="add-book-btn" data-bs-toggle="modal" data-bs-target="#addEBookModal">
                <i class="ri-add-circle-line"></i> Add E Book
            </a>
            <input type="text" class="search-input" placeholder="Search by title or author" id="searchInput">
        </div>
    </div>

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

    <div class="books-grid" id="booksGrid">
        @foreach ($ebooks as $ebook)
        <div class="book-item-card">
            <img src="{{ asset($ebook->cover_image_path ?? 'assets/images/lrc_logo.png') }}" alt="Book Cover">
            <div class="book-item-info">
                <h3 class="book-item-title">{{ $ebook->book_title }}</h3>
                <p class="book-item-author">by {{ $ebook->author_name }}</p>
                <div class="book-item-details">
                    <div>Publisher: {{ $ebook->publsiher }} </div>
                    <div>ISBN: {{ $ebook->isbn }} </div>
                    <div>Pages: {{ $ebook->page_count }} • Year: {{ $ebook->publication_year }}</div>
                </div>
                <div class="book-actions">
                    <button class="read-btn" onclick="openBookReader('{{ $ebook->book_title }}', '{{ $ebook->author_name }}', {{ $ebook->page_count }}, '{{ asset($ebook->file_path) }}')">
                        <i class="ri-book-open-line"></i>&nbsp;Read
                    </button>
                    <button class="btn btn-outline-info" title="Edit Ebook" data-bs-toggle="modal" data-bs-target="#editEbook{{$ebook->id}}">
                        <i class="ri-edit-line"></i>&nbsp;Edit
                    </button>
                    <form method="POST" class="d-inline-block" action="{{url('delete_ebook/'.$ebook->id)}}" onsubmit="show()" enctype="multipart/form-data">
                        @csrf
                        <button type="button" class="btn btn-outline-danger deleteBtn">
                            <i class="mdi mdi-trash-can"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @include('digital.ebooks.edit')
        @endforeach
    </div>
    <div id="bookReader" class="book-reader-modal">
        <div class="reader-header">
            <h2 id="readerBookTitle"></h2>
            <button onclick="closeBookReader()">×</button>
        </div>
        <div id="pdfViewerContainer" style="width:100%; height:80vh; overflow:auto; background:#f4f4f4; text-align:center;">
            <canvas id="pdfCanvas"></canvas>
        </div>

        <div class="reader-controls">
            <button onclick="prevPDFPage()">Previous</button>
            <span id="pageNumDisplay"></span>
            <button onclick="nextPDFPage()">Next</button>
        </div>
    </div>

    
    <!-- <div class="book-reader-modal" id="bookReader">
        <div class="reader-header">
            <h2 class="reader-title" id="readerBookTitle">Book Title</h2>
            <button class="close-reader" onclick="closeBookReader()" aria-label="Close reader">×</button>
        </div>
        
        <div class="book-container">
            <div class="book-wrapper">
                <div class="book" id="bookElement">
                    <div class="static-page left" id="leftStaticPage">
                        <div class="page-content" id="leftStaticContent"></div>
                        <div class="page-number" id="leftStaticNum"></div>
                    </div>
                    
                    <div class="static-page right" id="rightStaticPage">
                        <div class="page-content" id="rightStaticContent"></div>
                        <div class="page-number" id="rightStaticNum"></div>
                    </div>
                    
                    <div class="page-container right" id="flipContainer">
                        <div class="book-page front">
                            <div class="page-content" id="frontContent"></div>
                            <div class="page-number" id="frontNum"></div>
                        </div>
                        <div class="book-page back">
                            <div class="page-content" id="backContent"></div>
                            <div class="page-number" id="backNum"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="reader-controls">
            <button class="control-btn" id="prevBtn" onclick="previousPage()">
                <i class="ri-arrow-left-line"></i> Previous
            </button>
            <div class="page-indicator">
                <span id="currentPageDisplay">1-2</span> / <span id="totalPagesDisplay">0</span>
            </div>
            <button class="control-btn" id="nextBtn" onclick="nextPage()">
                Next <i class="ri-arrow-right-line"></i>
            </button>
        </div>
    </div> -->

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


    // let currentPage = 1;
    // let totalPages = 0;
    // let currentBook = {};
    // let isFlipping = false;

    // const sampleContent = {
    //     chapters: [
    //         {
    //             title: "Introduction",
    //             content: "Welcome to this comprehensive guide. This book aims to provide you with deep insights and practical knowledge that you can apply in your field. Throughout these pages, you'll discover concepts, techniques, and best practices that have been refined over years of experience."
    //         },
    //         {
    //             title: "Core Concepts",
    //             content: "Understanding the fundamentals is crucial for building a strong foundation. In this chapter, we explore the essential principles that underpin everything else. These concepts form the bedrock upon which all advanced topics are built."
    //         },
    //         {
    //             title: "Practical Applications",
    //             content: "Theory meets practice in this section. Here we examine real-world scenarios and case studies that demonstrate how to apply what you've learned. Each example is carefully chosen to illustrate key points and provide actionable insights."
    //         },
    //         {
    //             title: "Advanced Topics",
    //             content: "Now that we've covered the basics, let's dive deeper into more complex subjects. This chapter challenges you to think critically and expand your understanding beyond conventional boundaries. We explore cutting-edge developments and emerging trends."
    //         },
    //         {
    //             title: "Conclusion",
    //             content: "As we reach the end of this journey, let's reflect on what we've learned and look ahead to future possibilities. The knowledge you've gained here is just the beginning. Continue to explore, question, and grow in your understanding."
    //         }
    //     ]
    // };

// function generatePageContent(pageNum) {
//     if (pageNum > totalPages || pageNum < 1) return '';
    
//     const chapterIndex = Math.floor((pageNum - 1) / 2) % sampleContent.chapters.length;
//     const chapter = sampleContent.chapters[chapterIndex];
//     const isFirstPageOfChapter = (pageNum - 1) % 2 === 0;
    
//     let content = '';
//     if (isFirstPageOfChapter) {
//         content = `<h2>${chapter.title}</h2><p>${chapter.content}</p>`;
//     } else {
//         content = `<p>${chapter.content}</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>`;
//     }
    
//     return content;
// }

// function openBookReader(title, author, pages) {
//     currentBook = { title, author, pages };
//     totalPages = Math.ceil(pages / 2) * 2;
//     currentPage = 1;
    
//     document.getElementById('readerBookTitle').textContent = title;
//     document.getElementById('totalPagesDisplay').textContent = totalPages;
//     document.getElementById('bookReader').classList.add('active');
//     document.body.style.overflow = 'hidden';
    
//     const flipContainer = document.getElementById('flipContainer');
//     flipContainer.classList.remove('flipping');
//     flipContainer.style.transform = 'rotateY(0deg)';
    
//     updatePages();
//     updateControls();
// }

// function closeBookReader() {
//     document.getElementById('bookReader').classList.remove('active');
//     document.body.style.overflow = '';
// }

// function nextPage() {
//     if (isFlipping || currentPage >= totalPages - 1) return;
    
//     isFlipping = true;
//     const flipContainer = document.getElementById('flipContainer');
    
//     flipContainer.style.zIndex = '20';
//     flipContainer.style.transition = 'transform 0.8s cubic-bezier(0.645, 0.045, 0.355, 1)';
//     flipContainer.style.transform = 'rotateY(0deg)';
//     flipContainer.classList.remove('flipping');
    
//     document.getElementById('frontContent').innerHTML = generatePageContent(currentPage + 1);
//     document.getElementById('frontNum').textContent = currentPage + 1;
    
//     document.getElementById('backContent').innerHTML = generatePageContent(currentPage + 2);
//     document.getElementById('backNum').textContent = currentPage + 2;
    
//     setTimeout(() => {
//         flipContainer.style.transform = 'rotateY(-180deg)';
//         flipContainer.classList.add('flipping');
//     }, 50);
    
//     setTimeout(() => {
//         currentPage += 2;
        
//         document.getElementById('leftStaticContent').innerHTML = generatePageContent(currentPage);
//         document.getElementById('leftStaticNum').textContent = currentPage;
        
//         document.getElementById('rightStaticContent').innerHTML = generatePageContent(currentPage + 1);
//         document.getElementById('rightStaticNum').textContent = currentPage + 1;
        
//         flipContainer.style.transition = 'none';
//         flipContainer.style.transform = 'rotateY(0deg)';
//         flipContainer.classList.remove('flipping');
//         flipContainer.style.zIndex = '10';
        
//         setTimeout(() => {
//             flipContainer.style.transition = 'transform 0.8s cubic-bezier(0.645, 0.045, 0.355, 1)';
            
//             document.getElementById('frontContent').innerHTML = generatePageContent(currentPage + 1);
//             document.getElementById('frontNum').textContent = currentPage + 1;
            
//             document.getElementById('backContent').innerHTML = generatePageContent(currentPage + 2);
//             document.getElementById('backNum').textContent = currentPage + 2;
            
//             updateControls();
//             updatePageDisplay();
//             isFlipping = false;
//         }, 50);
//     }, 850);
// }

// function previousPage() {
//     if (isFlipping || currentPage <= 1) return;
    
//     isFlipping = true;
//     const flipContainer = document.getElementById('flipContainer');
    
//     currentPage -= 2;
    
//     document.getElementById('leftStaticContent').innerHTML = generatePageContent(currentPage);
//     document.getElementById('leftStaticNum').textContent = currentPage;
    
//     document.getElementById('rightStaticContent').innerHTML = generatePageContent(currentPage + 1);
//     document.getElementById('rightStaticNum').textContent = currentPage + 1;
    
//     document.getElementById('frontContent').innerHTML = generatePageContent(currentPage + 1);
//     document.getElementById('frontNum').textContent = currentPage + 1;
    
//     document.getElementById('backContent').innerHTML = generatePageContent(currentPage + 2);
//     document.getElementById('backNum').textContent = currentPage + 2;
    
//     flipContainer.style.transition = 'none';
//     flipContainer.style.transform = 'rotateY(-180deg)';
    
//     setTimeout(() => {
//         flipContainer.style.transition = 'transform 0.8s cubic-bezier(0.645, 0.045, 0.355, 1)';
//         flipContainer.style.transform = 'rotateY(0deg)';
        
//         setTimeout(() => {
//             updateControls();
//             updatePageDisplay();
//             isFlipping = false;
//         }, 800);
//     }, 50);
// }

// function updatePages() {
//     document.getElementById('leftStaticContent').innerHTML = generatePageContent(currentPage);
//     document.getElementById('leftStaticNum').textContent = currentPage;
    
//     document.getElementById('rightStaticContent').innerHTML = generatePageContent(currentPage + 1);
//     document.getElementById('rightStaticNum').textContent = currentPage + 1;
    
//     document.getElementById('frontContent').innerHTML = generatePageContent(currentPage + 1);
//     document.getElementById('frontNum').textContent = currentPage + 1;
    
//     document.getElementById('backContent').innerHTML = generatePageContent(currentPage + 2);
//     document.getElementById('backNum').textContent = currentPage + 2;
    
//     updatePageDisplay();
// }

// function updatePageDisplay() {
//     document.getElementById('currentPageDisplay').textContent = `${currentPage}-${currentPage + 1}`;
// }

// function updateControls() {
//     const prevBtn = document.getElementById('prevBtn');
//     const nextBtn = document.getElementById('nextBtn');
    
//     prevBtn.disabled = currentPage <= 1;
//     nextBtn.disabled = currentPage >= totalPages - 1;
// }

// document.addEventListener('keydown', (e) => {
//     if (document.getElementById('bookReader').classList.contains('active')) {
//         if (e.key === 'ArrowRight') nextPage();
//         if (e.key === 'ArrowLeft') previousPage();
//         if (e.key === 'Escape') closeBookReader();
//     }
// });

// document.getElementById('searchInput').addEventListener('input', function(e) {
//     const searchTerm = e.target.value.toLowerCase();
//     const bookCards = document.querySelectorAll('.book-item-card');
    
//     bookCards.forEach(card => {
//         const title = card.querySelector('.book-item-title').textContent.toLowerCase();
//         const author = card.querySelector('.book-item-author').textContent.toLowerCase();
        
//         if (title.includes(searchTerm) || author.includes(searchTerm)) {
//             card.style.display = 'flex';
//         } else {
//             card.style.display = 'none';
//         }
//     });
// });

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


document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        if (confirm('Are you sure you want to delete this book?')) {
            e.target.closest('.book-item-card').remove();
        }
    });
});
</script>
@endsection

@section('js')

@endsection