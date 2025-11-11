@extends('layouts.header')

@section('css')
 <link href="{{asset('/assets/css/show_book.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="book-store">
    <div class="top-header">
        <div class="browse-category">
            <select class="category-select">
            <option>Browse Category</option>
            <option>Fiction</option>
            <option>Non-Fiction</option>
            <option>Science</option>
            <option>Business</option>
            <option>Biography</option>
            </select>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Search Book">
        </div>
        <div class="header-right">
            <a href="#" class="add-book-btn" data-bs-toggle="modal" data-bs-target="#addEBookModal">
            <i class="ri-add-circle-line"></i> Add E Book
            </a>
        </div>
    </div>
 <div class="book-slide">
  <div class="book js-flickity" data-flickity-options='{ "wrapAround": true }'>
   @php
    $featuredBooks = $ebooks->take(5);
    $colorClasses = ['', 'blue', 'purple', 'yellow', 'dark-purp'];
    $buttonClasses = ['', 'book-blue', 'book-pink', 'book-yellow', 'book-purple'];
   @endphp
   
   @foreach($featuredBooks as $index => $ebook)
    <div class="book-cell">
        <div class="book-img">
            @if($ebook->cover_image_path)
            <img src="{{ asset($ebook->cover_image_path) }}" alt="{{ $ebook->book_title }}" class="book-photo">
            @else
            <img src="https://via.placeholder.com/180x240/{{ substr(md5($ebook->id), 0, 6) }}/ffffff?text={{ urlencode(Str_limit($ebook->book_title, 15)) }}" alt="{{ $ebook->book_title }}" class="book-photo">
            @endif
        </div>
        <div class="book-content">
            <div class="book-title">{{ $ebook->book_title }}</div>
            <div class="book-author">by {{ $ebook->author_name }}</div>
            <div class="rate">
                <fieldset class="rating {{ $colorClasses[$index] }}">
                    <input type="checkbox" id="star{{ $index * 5 + 5 }}" name="rating" value="5" />
                    <label class="full" for="star{{ $index * 5 + 5 }}"></label>
                    <input type="checkbox" id="star{{ $index * 5 + 4 }}" name="rating" value="4" />
                    <label class="full" for="star{{ $index * 5 + 4 }}"></label>
                    <input type="checkbox" id="star{{ $index * 5 + 3 }}" name="rating" value="3" />
                    <label class="full" for="star{{ $index * 5 + 3 }}"></label>
                    <input type="checkbox" id="star{{ $index * 5 + 2 }}" name="rating" value="2" />
                    <label class="full" for="star{{ $index * 5 + 2 }}"></label>
                    <input type="checkbox" id="star{{ $index * 5 + 1 }}" name="rating" value="1" />
                    <label class="full" for="star{{ $index * 5 + 1 }}"></label>
                </fieldset>
                <span class="book-voters">{{ $ebook->page_count }} pages</span>
            </div>
            <div class="book-sum">Readers of all ages and walks of life have drawn inspiration and empowerment from Elizabeth Gilbert's books for years. </div>
            <div class="book-see {{ $buttonClasses[$index] }}" onclick="window.location.href='{{ url('e_books/' . $ebook->id) }}'">See The Book</div>
            </div>
        </div>
        @endforeach
    </div>
 </div>
 <div class="main-wrapper">
  <div class="books-of">
   <div class="week">
    <div class="author-title">Author of the week</div>
    @php
     $authors = $ebooks->unique('author_name')->take(6);
    @endphp
    @foreach($authors as $author)
    <div class="author">
     <img src="https://ui-avatars.com/api/?name={{ urlencode($author->author_name) }}&size=30&background=random" alt="{{ $author->author_name }}" class="author-img">
     <div class="author-name">{{ $author->author_name }}</div>
    </div>
    @endforeach
   </div>
   <div class="week year">
    <div class="author-title">Books of the year</div>
    @foreach($ebooks->sortByDesc('created_at')->take(5) as $recent)
    <div class="year-book" onclick="window.location.href='{{ url('e_books/' . $recent->id) }}'">
        @if($recent->cover_image_path)
            <img src="{{ asset($recent->cover_image_path) }}" alt="{{ $recent->book_title }}" class="year-book-img">
        @else
            <img src="https://via.placeholder.com/45x60/{{ substr(md5($recent->id), 0, 6) }}/ffffff?text=Book" alt="{{ $recent->book_title }}" class="year-book-img">
        @endif
        <div class="year-book-content">
            <div class="year-book-name">{{ Str_limit($recent->book_title, 30) }}</div>
            <div class="year-book-author">by {{ $recent->author_name }}</div>
        </div>
    </div>
    @endforeach
   </div>
   <div class="overlay"></div>
  </div>
  <div class="popular-books">
   <div class="main-menu">
    <div class="genre">Popular by Genre</div>
    <div class="book-types">
     <a href="#" class="book-type active"> All Genres</a>
     <a href="#" class="book-type"> Business</a>
     <a href="#" class="book-type"> Science</a>
     <a href="#" class="book-type"> Fiction</a>
     <a href="#" class="book-type"> Philosophy</a>
     <a href="#" class="book-type"> Biography</a>
    </div>
   </div>
   <div class="book-cards">
    @foreach($ebooks as $ebook)
        <div class="book-card" data-book-id="{{ $ebook->id }}" onclick="window.location.href='{{ url('e_books/' . $ebook->id) }}'">
            <div class="content-wrapper">
            @if($ebook->cover_image_path)
                <img src="{{ asset($ebook->cover_image_path) }}" alt="{{ $ebook->book_title }}" class="book-card-img">
            @else
                <img src="https://via.placeholder.com/110x140/{{ substr(md5($ebook->id), 0, 6) }}/ffffff?text={{ urlencode(Str_limit($ebook->book_title, 10)) }}" alt="{{ $ebook->book_title }}" class="book-card-img">
            @endif
            <div class="card-content">
                <div class="book-name">{{ Str_limit($ebook->book_title, 25) }}</div>
                <div class="book-by">by {{ $ebook->author_name }}</div>
                <div class="rate">
                    <fieldset class="rating book-rate">
                    <input type="checkbox" id="star-c{{ $ebook->id }}-1" name="rating" value="5">
                    <label class="full" for="star-c{{ $ebook->id }}-1"></label>
                    <input type="checkbox" id="star-c{{ $ebook->id }}-2" name="rating" value="4">
                    <label class="full" for="star-c{{ $ebook->id }}-2"></label>
                    <input type="checkbox" id="star-c{{ $ebook->id }}-3" name="rating" value="3">
                    <label class="full" for="star-c{{ $ebook->id }}-3"></label>
                    <input type="checkbox" id="star-c{{ $ebook->id }}-4" name="rating" value="2">
                    <label class="full" for="star-c{{ $ebook->id }}-4"></label>
                    <input type="checkbox" id="star-c{{ $ebook->id }}-5" name="rating" value="1">
                    <label class="full" for="star-c{{ $ebook->id }}-5"></label>
                    </fieldset>
                    <span class="book-voters card-vote">{{ $ebook->page_count }} pages</span>
                </div>
                <div class="book-sum card-sum">Readers of all ages and walks of life have drawn inspiration and empowerment from Elizabeth Gilbert’s books for years. </div>
                </div>
                </div>
                <div class="likes">
                <div class="like-profile"></div>
                <div class="like-profile"></div>
                <div class="like-profile"></div>
            </div>
        </div>
    @endforeach
   </div>
  </div>
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
      <div class="col-md-6">
       <div class="form-group">
        <label>Type <span class="text-danger">*</span></label>
        <select name="type" id="type" class="form-control select2" required>
         <option value="">-- Select Type --</option>
         <option value="New">New</option>
         <option value="Existing">Existing</option>
        </select>
       </div>
      </div>
      <div class="col-md-6">
       <div class="form-group">
        <label>Book Title <span class="text-danger">*</span></label>
        <div id="new_book_container">
         <input type="text" name="new_book_title" class="form-control" placeholder="Enter Book Title">
        </div>
        <div id="existing_book_container" style="display: none;">
         <select name="existing_book_title" id="existing_book" class="form-control select2">
          <option value="">-- Select Book --</option>
          @foreach($ebooks->unique('book_title') as $book)
           <option value="{{ $book->book_title }}">{{ $book->book_title }}</option>
          @endforeach
         </select>
        </div>
       </div>
      </div>
     </div>
     
     <div class="row">
      <div class="col-md-6">
       <div class="form-group">
        <label>ISBN <span class="text-danger">*</span></label>
        <input type="text" name="isbn" class="form-control" placeholder="978-XXXXXXXXXX" required>
       </div>
      </div>
      <div class="col-md-6">
       <div class="form-group">
        <label>Author <span class="text-danger">*</span></label>
        <input type="text" name="author_name" class="form-control" placeholder="Enter Author Name" required>
       </div>
      </div>
     </div>
     
     <div class="row">
      <div class="col-md-6">
       <div class="form-group">
        <label>Publisher</label>
        <input type="text" name="publisher" class="form-control" placeholder="Enter Publisher Name">
       </div>
      </div>
      <div class="col-md-6">
       <div class="form-group">
        <label>Publication Year</label>
        <input type="number" name="publication_year" class="form-control" placeholder="2025" min="1900" max="2500">
       </div>
      </div>
     </div>
     
     <div class="row">
      <div class="col-md-6">
       <div class="form-group">
        <label>Pages <span class="text-danger">*</span></label>
        <input type="number" name="page_count" class="form-control" placeholder="500" min="1" required>
       </div>
      </div>
      <div class="col-md-6">
       <div class="form-group">
        <label>Cover Image</label>
        <input type="file" class="form-control" accept="image/*" id="coverUpload" name="cover_image_path">
       </div>
      </div>
     </div>
     
     <div class="form-group">
      <label>Upload PDF <span class="text-danger">*</span></label>
      <div class="upload-area" onclick="document.getElementById('pdfUpload').click()">
       <i class="ri-file-pdf-line"></i>
       <h5>Click to upload PDF</h5>
       <p class="text-muted mb-0">or drag and drop</p>
       <small class="text-muted" id="fileName"></small>
      </div>
      <input type="file" name="file_path" id="pdfUpload" accept=".pdf" style="display: none;" required>
     </div>
    </div>
    <div class="modal-footer">
     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
     <button type="button" class="btn btn-primary" onclick="submitEbook()">Add E Book</button>
    </div>
   </form>
  </div>
 </div>
</div>

<!-- PDF Reader Modal -->
<div id="bookReader" class="book-reader-modal">
 <div class="reader-header">
  <h2 id="readerBookTitle" class="reader-title"></h2>
  <button class="close-reader" onclick="closeBookReader()">×</button>
 </div>
 <div id="pdfViewerContainer" style="width:100%; height:calc(100vh - 140px); overflow:auto; background:#f4f4f4; text-align:center;">
  <canvas id="pdfCanvas"></canvas>
 </div>
 <div class="reader-controls">
  <button class="control-btn" id="prevPageBtn" onclick="prevPDFPage()">
   <i class="ri-arrow-left-line"></i> Previous
  </button>
  <span id="pageNumDisplay" class="page-indicator">1 / 1</span>
  <button class="control-btn" id="nextPageBtn" onclick="nextPDFPage()">
   Next <i class="ri-arrow-right-line"></i>
  </button>
 </div>
</div>

@foreach($ebooks as $ebook)
 @include('digital.ebooks.edit')
@endforeach
@endsection

@section('js')
<script src='https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.pkgd.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
  // Initialize Flickity carousel
  var $carousel = $('.book').flickity({
    wrapAround: true,
    prevNextButtons: true,
    pageDots: false,
    cellAlign: 'center',
    contain: false,
    percentPosition: true,
    setGallerySize: true,
    resize: true
  });

  // Force reposition after load
  $carousel.flickity('resize');
  
  // Fix on window resize
  $(window).on('resize', function() {
    $carousel.flickity('resize');
  });

  // Initialize Select2
  $(document).on('shown.bs.modal', '.select2-modal', function () {
    const $modal = $(this);
    $modal.find('.select2').select2({
      dropdownParent: $modal
    });
  });

  // Type selection handler
  $('#type').on('change', function () {
    const type = $(this).val();
    if (type === 'Existing') {
      $('#existing_book_container').show();
      $('#new_book_container').hide();
      $('input[name="new_book_title"]').removeAttr('required');
      $('select[name="existing_book_title"]').attr('required', 'required');
    } else if (type === 'New') {
      $('#new_book_container').show();
      $('#existing_book_container').hide();
      $('input[name="new_book_title"]').attr('required', 'required');
      $('select[name="existing_book_title"]').removeAttr('required');
    } else {
      $('#new_book_container, #existing_book_container').hide();
    }
  });

  $('#type').trigger('change');

  // Delete button handler
  $(".deleteBtn").on('click', function() {
    var form = $(this).closest('form');
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
        form.submit();
      }
    });
  });
});

// Form submission
function submitEbook() {
  const form = document.getElementById('addEBookForm');
  if (form.checkValidity()) {
    form.submit();
  } else {
    form.reportValidity();
  }
}

// File upload handling
document.getElementById('pdfUpload').addEventListener('change', function(e) {
  const fileName = e.target.files[0]?.name || '';
  document.getElementById('fileName').textContent = fileName ? `Selected: ${fileName}` : '';
});

// Drag and drop
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
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js';
    const loadingTask = pdfjsLib.getDocument(url);
    pdfDoc = await loadingTask.promise;
    currentPage = 1;
    renderPage(currentPage);
    updatePageDisplay();
  } catch (err) {
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'Error loading PDF: ' + err.message
    });
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

function updatePageDisplay() {
  document.getElementById('pageNumDisplay').textContent = `${currentPage} / ${pdfDoc.numPages}`;
  document.getElementById('prevPageBtn').disabled = currentPage === 1;
  document.getElementById('nextPageBtn').disabled = currentPage === pdfDoc.numPages;
}

async function nextPDFPage() {
  if (currentPage < pdfDoc.numPages) {
    currentPage++;
    await renderPage(currentPage);
    updatePageDisplay();
  }
}

async function prevPDFPage() {
  if (currentPage > 1) {
    currentPage--;
    await renderPage(currentPage);
    updatePageDisplay();
  }
}
</script>
@endsection