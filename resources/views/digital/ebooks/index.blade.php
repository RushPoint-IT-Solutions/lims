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
      <input type="text" placeholder="Search Book" id="bookSearchInput">
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
              <img src="https://via.placeholder.com/180x240/{{ substr(md5($ebook->id), 0, 6) }}/ffffff?text={{ urlencode(Str_limit($ebook->book_title, 15)) }}" 
                   alt="{{ $ebook->book_title }}" 
                   class="book-photo">
            @endif
          </div>

          <div class="book-content">
            <div class="book-title">{{ $ebook->book_title }}</div>
            <div class="book-author">by {{ $ebook->author_name }}</div>

            <div class="rate">
              <fieldset class="rating {{ $colorClasses[$index] }}">
                <input type="checkbox" id="star{{ $index * 5 + 5 }}" name="rating" value="5">
                <label class="full" for="star{{ $index * 5 + 5 }}"></label>

                <input type="checkbox" id="star{{ $index * 5 + 4 }}" name="rating" value="4">
                <label class="full" for="star{{ $index * 5 + 4 }}"></label>

                <input type="checkbox" id="star{{ $index * 5 + 3 }}" name="rating" value="3">
                <label class="full" for="star{{ $index * 5 + 3 }}"></label>

                <input type="checkbox" id="star{{ $index * 5 + 2 }}" name="rating" value="2">
                <label class="full" for="star{{ $index * 5 + 2 }}"></label>

                <input type="checkbox" id="star{{ $index * 5 + 1 }}" name="rating" value="1">
                <label class="full" for="star{{ $index * 5 + 1 }}"></label>
              </fieldset>
              <span class="book-voters">{{ $ebook->page_count }} pages</span>
            </div>

            <div class="book-sum">
              Readers of all ages and walks of life have drawn inspiration and empowerment from Elizabeth Gilbert's books for years.
            </div>

            <div class="book-see {{ $buttonClasses[$index] }}" data-book-url="{{ url('e_books/' . $ebook->id) }}">
              See The Book
            </div>
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
            <img src="https://ui-avatars.com/api/?name={{ urlencode($author->author_name) }}&size=30&background=random"
                 alt="{{ $author->author_name }}" class="author-img">
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
              <img src="https://via.placeholder.com/45x60/{{ substr(md5($recent->id), 0, 6) }}/ffffff?text=Book"
                   alt="{{ $recent->book_title }}" class="year-book-img">
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
          <a href="#" class="book-type active">All Genres</a>
          <a href="#" class="book-type">Business</a>
          <a href="#" class="book-type">Science</a>
          <a href="#" class="book-type">Fiction</a>
          <a href="#" class="book-type">Philosophy</a>
          <a href="#" class="book-type">Biography</a>
        </div>
      </div>

      <div class="book-cards">
        @foreach($ebooks as $ebook)
          <div class="book-card" data-book-id="{{ $ebook->id }}">
            <div class="content-wrapper">
              @if($ebook->cover_image_path)
                <img src="{{ asset($ebook->cover_image_path) }}" alt="{{ $ebook->book_title }}" class="book-card-img">
              @else
                <img src="https://via.placeholder.com/110x140/{{ substr(md5($ebook->id), 0, 6) }}/ffffff?text={{ urlencode(Str_limit($ebook->book_title, 10)) }}"
                    alt="{{ $ebook->book_title }}" class="book-card-img">
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

                <div class="book-sum card-sum">
                  Readers of all ages and walks of life have drawn inspiration and empowerment from Elizabeth Gilbert's books for years.
                </div>
              </div>
            </div>

            <div class="book-card-actions">
              <button class="card-action-btn edit-btn"
                      data-bs-toggle="modal"
                      data-bs-target="#editEbook{{ $ebook->id }}"
                      title="Edit Ebook">
                <i class="ri-edit-line"></i>
              </button>

              <form method="POST" 
                    class="d-inline-block" 
                    action="{{url('delete_ebook/'.$ebook->id)}}" 
                    onsubmit="show()" 
                    enctype="multipart/form-data">
                @csrf
                <button type="button" 
                        class="card-action-btn delete-btn deleteBtn" 
                        title="Delete Ebook">
                  <i class="mdi mdi-trash-can"></i>
                </button>
              </form>
            </div>

            <button class="see-book-btn"
                    onclick="window.location.href='{{ url('e_books/' . $ebook->id) }}'">
              <i class="ri-book-open-line"></i> See Book
            </button>
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

            <div class="col-md-6 form-group mb-2">
              <label>Book Title <span class="text-danger">*</span></label>
              <div id="new_book_container" style="display: none;">
                <input type="text" name="new_book_title" class="form-control" placeholder="Enter Book Title">
              </div>
              <div id="existing_book_container" style="display: none;">
                <select name="existing_book_title" id="existing_book" class="form-control select2">
                  <option value="">-- Select Book --</option>
                  <option value="Book1">Book 1</option>
                  <option value="Book2">Book 2</option>
                  <option value="Book3">Book 3</option>
                </select>
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


@foreach($ebooks as $ebook)
 @include('digital.ebooks.edit')
@endforeach
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.pkgd.js'></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>

<!-- Select2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    $('#bookSearchInput').on('input', function() {
        const searchTerm = $(this).val().toLowerCase().trim();
        
        $('.book-card').each(function() {
            const bookTitle = $(this).find('.book-name').text().toLowerCase();
            const bookAuthor = $(this).find('.book-by').text().toLowerCase();
            
            if (bookTitle.includes(searchTerm) || bookAuthor.includes(searchTerm)) {
                $(this).fadeIn(300);
            } else {
                $(this).fadeOut(300);
            }
        });
        
        setTimeout(function() {
            const visibleCards = $('.book-card:visible').length;
            
            $('.no-results-message').remove();
            
            if (visibleCards === 0 && searchTerm !== '') {
                $('#bookCardsContainer').append(
                    '<div class="no-results-message" style="grid-column: 1/-1; text-align: center; padding: 40px; color: #666;">' +
                    '<i class="ri-search-line" style="font-size: 48px; margin-bottom: 15px; display: block;"></i>' +
                    '<h4>No books found</h4>' +
                    '<p>Try searching with different keywords</p>' +
                    '</div>'
                );
            }
        }, 350);
    });
});
</script>

<script>
$(document).ready(function() {
  if (typeof $.fn.flickity !== 'undefined') {
    var $carousel = $('.book').flickity({
      wrapAround: true,
      prevNextButtons: true,
      pageDots: false,
      cellAlign: 'center',
      contain: false,
      percentPosition: true,
      setGallerySize: true,
      resize: true,
      draggable: '>1',
      freeScroll: false
    });

    $carousel.flickity('resize');
    
    $(window).on('resize', function() {
      $carousel.flickity('resize');
    });

    var $flickityElement = $('.book');
    var flkty = $flickityElement.data('flickity');
    
    $flickityElement.on('wheel', function(event) {
      if (Math.abs(event.originalEvent.deltaY) > Math.abs(event.originalEvent.deltaX)) {
        return true;
      }
    });

    $('.book-see').on('click touchend', function(e) {
      e.stopPropagation();
      e.preventDefault();
      var url = $(this).attr('data-book-url');
      if (url) {
        window.location.href = url;
      }
      return false;
    });
  } else {
    console.error('Flickity not loaded');
  }

  $(document).on('change', '#type', function () {
    const type = $(this).val();
    console.log('Type selected:', type);

    if (type === 'Existing') {
      $('#existing_book_container').show();
      $('#new_book_container').hide();
      $('input[name="new_book_title"]').removeAttr('required');
      $('select[name="existing_book_title"]').attr('required', 'required');
      
      setTimeout(function() {
        if ($('#existing_book').hasClass('select2-hidden-accessible')) {
          $('#existing_book').select2('destroy');
        }
        $('#existing_book').select2({
          dropdownParent: $('#addEBookModal'),
          placeholder: '-- Select Book --',
          width: '100%'
        });
      }, 100);
      
    } else if (type === 'New') {
      $('#new_book_container').show();
      $('#existing_book_container').hide();
      $('input[name="new_book_title"]').attr('required', 'required');
      $('select[name="existing_book_title"]').removeAttr('required');
      
      if ($('#existing_book').hasClass('select2-hidden-accessible')) {
        $('#existing_book').select2('destroy');
      }
      
    } else {
      $('#new_book_container').hide();
      $('#existing_book_container').hide();
      $('input[name="new_book_title"]').removeAttr('required');
      $('select[name="existing_book_title"]').removeAttr('required');
    }
  });

  $('#addEBookModal').on('shown.bs.modal', function () {
    if (!$('#type').hasClass('select2-hidden-accessible')) {
      $('#type').select2({
        dropdownParent: $('#addEBookModal'),
        minimumResultsForSearch: -1,
        width: '100%'
      });
    }
  });

  $('#addEBookModal').on('hidden.bs.modal', function () {
    $('#addEBookForm')[0].reset();
    
    if ($('#type').hasClass('select2-hidden-accessible')) {
      $('#type').select2('destroy');
    }
    if ($('#existing_book').hasClass('select2-hidden-accessible')) {
      $('#existing_book').select2('destroy');
    }
    
    $('#new_book_container').hide();
    $('#existing_book_container').hide();
    $('#fileName').text('');
  });

  $(document).on('click', '.deleteBtn', function(e) {
    e.preventDefault();
    e.stopPropagation();
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

  $('#pdfUpload').on('change', function(e) {
    const fileName = e.target.files[0]?.name || '';
    $('#fileName').text(fileName ? `Selected: ${fileName}` : '');
  });

  const uploadArea = $('.upload-area')[0];
  
  if (uploadArea) {
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
      uploadArea.addEventListener(eventName, function(e) {
        e.preventDefault();
        e.stopPropagation();
      }, false);
    });

    ['dragenter', 'dragover'].forEach(eventName => {
      uploadArea.addEventListener(eventName, function() {
        $(this).css({
          'border-color': '#d07e0a',
          'background': '#f8f9fa'
        });
      });
    });

    ['dragleave', 'drop'].forEach(eventName => {
      uploadArea.addEventListener(eventName, function() {
        $(this).css({
          'border-color': '#dee2e6',
          'background': 'transparent'
        });
      });
    });

    uploadArea.addEventListener('drop', function(e) {
      const files = e.dataTransfer.files;
      
      if (files.length > 0 && files[0].type === 'application/pdf') {
        document.getElementById('pdfUpload').files = files;
        $('#fileName').text(`Selected: ${files[0].name}`);
      }
    });
  }
});

function submitEbook() {
  const form = document.getElementById('addEBookForm');
  if (form.checkValidity()) {
    form.submit();
  } else {
    form.reportValidity();
  }
}
</script>
@endsection