@extends('layouts.header')

@section('css')
<style>
    .breadcrumb-container {
        background: white;
        padding: 15px 0;
        margin-bottom: 30px;
    }

    .breadcrumb {
        margin: 0;
        padding: 0;
        background: transparent;
    }

    .breadcrumb-item {
        font-size: 14px;
        color: #6c757d;
    }

    .breadcrumb-item a {
        color: #d07e0a;
        text-decoration: none;
    }

    .breadcrumb-item a:hover {
        text-decoration: underline;
    }

    .breadcrumb-item.active {
        color: #2c3e50;
        font-weight: 500;
    }

    .book-detail-container {
        background: white;
        border-radius: 8px;
        padding: 35px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.08);
    }

    .book-main-section {
        display: flex;
        gap: 40px;
        margin-bottom: 40px;
    }

    .book-cover-large {
        flex-shrink: 0;
        width: 300px;
    }

    .book-cover-display {
        width: 100%;
        height: 420px;
        border-radius: 2px;
        box-shadow: 0 10px 24px rgba(0, 0, 0, 0.357);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
        text-align: center;
        padding: 30px;
        overflow: hidden;
        position: relative;
    }

    .book-cover-display img {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
    }

    .book-cover-text {
        position: relative;
        z-index: 1;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }

    .book-info {
        flex: 1;
    }

    .book-title-main {
        font-size: 32px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 10px;
        line-height: 1.3;
    }

    .book-author {
        font-size: 18px;
        color: #6c757d;
        margin-bottom: 25px;
    }

    .book-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 25px;
        margin-bottom: 30px;
        padding: 20px 0;
        border-top: 1px solid #e9ecef;
        border-bottom: 1px solid #e9ecef;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
        color: #495057;
    }

    .meta-item i {
        color: #d07e0a;
        font-size: 20px;
    }

    .meta-item strong {
        color: #2c3e50;
    }

    .book-description {
        margin-bottom: 30px;
    }

    .book-description h6 {
        font-weight: 600;
        margin-bottom: 15px;
        color: #2c3e50;
        font-size: 16px;
    }

    .book-description p {
        color: #495057;
        line-height: 1.8;
        margin: 0;
    }

    .action-buttons {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .btn-action {
        padding: 12px 24px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s;
        text-decoration: none;
    }

    .btn-read {
        background: #d07e0a;
        color: white;
    }

    .btn-read:hover {
        background: #b86f09;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(208, 126, 10, 0.3);
        color: white;
    }

    .btn-borrow {
        background: #27ae60;
        color: white;
    }

    .btn-borrow:hover {
        background: #229954;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(39, 174, 96, 0.3);
    }

    .btn-reserve {
        background: #f39c12;
        color: white;
    }

    .btn-reserve:hover {
        background: #e67e22;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(243, 156, 18, 0.3);
    }

    .btn-download {
        background: #8e44ad;
        color: white;
    }

    .btn-download:hover {
        background: #7d3c98;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(142, 68, 173, 0.3);
        color: white;
    }

    .book-details-section {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 25px;
    }

    .details-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px;
        color: #2c3e50;
    }

    .details-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }

    .detail-item {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .detail-label {
        font-size: 11px;
        font-weight: 600;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .detail-value {
        font-size: 15px;
        color: #2c3e50;
        font-weight: 500;
    }

    .badge-category {
        display: inline-block;
        padding: 5px 15px;
        background: #e7f3ff;
        color: #0066cc;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        margin-right: 8px;
    }

    .availability-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
    }

    .availability-badge.available {
        background: #d1e7dd;
        color: #0f5132;
    }

    .availability-badge.unavailable {
        background: #f8d7da;
        color: #842029;
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
        flex-shrink: 0;
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

    /* Flipbook Container */
    .flipbook-viewer {
        flex: 1;
        perspective: 2500px;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 40px 20px;
        min-height: 0;
        overflow: auto;
        background: #2a2a2a;
    }

    .book-wrapper {
        position: relative;
        transform-style: preserve-3d;
    }

    .book {
        position: relative;
        width: 850px;
        height: 750px;
        transform-style: preserve-3d;
        max-width: 95vw;
        max-height: 70vh;
    }

    .page-spread {
        position: absolute;
        width: 100%;
        height: 100%;
        display: flex;
    }

    .page {
        position: relative;
        width: 50%;
        height: 100%;
        background: white;
        overflow: hidden;
    }

    .page-left {
        border-right: 2px solid #ddd;
        box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    }

    .page-right {
        box-shadow: -2px 0 10px rgba(0,0,0,0.1);
    }

    .page canvas {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .flip-container {
        position: absolute;
        top: 0;
        width: 50%;
        height: 100%;
        transform-style: preserve-3d;
        pointer-events: none;
        z-index: 10;
    }

    .flip-container.flip-right {
        left: 50%;
        transform-origin: left center;
    }

    .flip-container.flip-left {
        left: 0;
        transform-origin: right center;
    }

    .flip-page {
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
        background: white;
        box-shadow: 0 10px 40px rgba(0,0,0,0.3);
    }

    .flip-page canvas {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .flip-page-back {
        transform: rotateY(180deg);
    }

    .flipping-forward {
        animation: flipPageForward 0.7s cubic-bezier(0.25, 0.1, 0.25, 1);
    }

    .flipping-backward {
        animation: flipPageBackward 0.7s cubic-bezier(0.25, 0.1, 0.25, 1);
    }

    @keyframes flipPageForward {
        0% {
            transform: rotateY(0deg);
        }
        100% {
            transform: rotateY(-180deg);
        }
    }

    @keyframes flipPageBackward {
        0% {
            transform: rotateY(0deg);
        }
        100% {
            transform: rotateY(180deg);
        }
    }

    .reader-controls {
        background: rgba(30, 30, 30, 0.95);
        padding: 20px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        flex-wrap: wrap;
        gap: 15px;
        flex-shrink: 0;
    }

    .control-group {
        display: flex;
        gap: 15px;
        align-items: center;
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
        font-weight: 600;
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
        min-width: 150px;
        text-align: center;
    }

    .zoom-display {
        min-width: 60px;
        text-align: center;
        color: white;
        font-size: 14px;
        font-weight: 600;
        padding: 8px 12px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 8px;
    }

    .flip-page.loading {
        background: linear-gradient(135deg, #f5f5f5 0%, #e0e0e0 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .flip-page.loading::after {
        content: '';
        width: 40px;
        height: 40px;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #d07e0a;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    @media (max-width: 768px) {
        .book-main-section {
            flex-direction: column;
        }

        .book-cover-large {
            width: 100%;
            max-width: 300px;
            margin: 0 auto;
        }

        .book-title-main {
            font-size: 24px;
        }

        .book-detail-container {
            padding: 20px;
        }

        .book {
            width: 100%;
            height: auto;
            aspect-ratio: 12/7;
        }

        .reader-controls {
            padding: 15px;
        }

        .control-btn {
            padding: 10px 16px;
            font-size: 12px;
        }
    }
</style>
@endsection

@section('content')
    <div class="breadcrumb-container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('e_books') }}">E-Books</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $ebook->book_title }}</li>
            </ol>
        </nav>
    </div>

    <div class="book-detail-container mb-5">
        <div class="book-main-section">
            <div class="book-cover-large">
                <div class="book-cover-display" style="background: linear-gradient(135deg, {{ '#' . substr(md5($ebook->id), 0, 6) }} 0%, {{ '#' . substr(md5($ebook->id * 2), 0, 6) }} 100%);">
                    @if($ebook->cover_image_path)
                        <img src="{{ asset($ebook->cover_image_path) }}" alt="{{ $ebook->book_title }}">
                    @else
                        <div class="book-cover-text">{{ strtoupper($ebook->book_title) }}</div>
                    @endif
                </div>
            </div>

            <div class="book-info">
                <h1 class="book-title-main">{{ $ebook->book_title }}</h1>
                <div class="book-author">by {{ $ebook->author_name }}</div>

                <div class="book-meta">
                    <div class="meta-item">
                        <i class="ri-star-fill" style="color: #f39c12;"></i>
                        <span><strong>4.5</strong> (234 reviews)</span>
                    </div>
                    <div class="meta-item">
                        <i class="ri-book-open-line"></i>
                        <span><strong>{{ $ebook->page_count }}</strong> pages</span>
                    </div>
                    <div class="meta-item">
                        <i class="ri-calendar-line"></i>
                        <span>Published <strong>{{ $ebook->publication_year ?? '2024' }}</strong></span>
                    </div>
                    <div class="meta-item">
                        <i class="ri-global-line"></i>
                        <span><strong>English</strong></span>
                    </div>
                </div>

                <div class="book-description">
                    <h6>About This Book</h6>
                    <p>
                        A comprehensive guide to {{ strtolower($ebook->book_title) }}. This book provides valuable insights 
                        and practical knowledge for readers interested in this subject. Perfect for students, professionals, 
                        and anyone looking to expand their understanding of the topic.
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button class="btn-action btn-read" id="openBookReader">
                        <i class="ri-book-open-line"></i> Read Now
                    </button>
                    <button class="btn-action btn-borrow">
                        <i class="ri-shopping-cart-line"></i> Borrow
                    </button>
                    <button class="btn-action btn-reserve">
                        <i class="ri-bookmark-line"></i> Reserve
                    </button>
                    <a href="{{ asset($ebook->file_path) }}" download class="btn-action btn-download">
                        <i class="ri-download-line"></i> Download
                    </a>
                </div>
            </div>
        </div>

        <div class="book-details-section">
            <h5 class="details-title">Book Information</h5>
            <div class="details-grid">
                <div class="detail-item">
                    <span class="detail-label">ISBN</span>
                    <span class="detail-value">{{ $ebook->isbn }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Publisher</span>
                    <span class="detail-value">{{ $ebook->publisher ?? 'Academic Press Inc.' }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Edition</span>
                    <span class="detail-value">1st Edition</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Format</span>
                    <span class="detail-value">Digital (PDF, EPUB)</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Category</span>
                    <span class="detail-value">
                        <span class="badge-category">Academic</span>
                        <span class="badge-category">Reference</span>
                    </span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Call Number</span>
                    <span class="detail-value">{{ substr($ebook->isbn, -3) }}.{{ substr($ebook->author_name, 0, 3) }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Availability</span>
                    <span class="detail-value">
                        <span class="availability-badge available">
                            <i class="ri-check-line"></i> Available
                        </span>
                    </span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Copies</span>
                    <span class="detail-value">3 available / 5 total</span>
                </div>
            </div>
        </div>
    </div>

    <div id="bookReader" class="book-reader-modal">
        <div class="reader-header">
            <h2 id="readerBookTitle" class="reader-title">{{ $ebook->book_title }}</h2>
            <button class="close-reader" onclick="closeBookReader()">×</button>
        </div>
        
        <div class="flipbook-viewer">
            <div class="book-wrapper">
                <div class="book" id="book">
                    <div class="page-spread">
                        <div class="page page-left">
                            <canvas id="canvasLeft"></canvas>
                        </div>
                        <div class="page page-right">
                            <canvas id="canvasRight"></canvas>
                        </div>
                    </div>
                    <div class="flip-container" id="flipContainer" style="display: none;">
                        <div class="flip-page">
                            <canvas id="flipCanvas"></canvas>
                        </div>
                        <div class="flip-page flip-page-back">
                            <canvas id="flipCanvasBack"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="reader-controls">
            <div class="control-group">
                <button class="control-btn" id="prevBtn">
                    <i class="ri-arrow-left-line"></i> Previous
                </button>
                <span id="pageInfo" class="page-indicator">Page 1 (Cover)</span>
                <button class="control-btn" id="nextBtn">
                    Next <i class="ri-arrow-right-line"></i>
                </button>
            </div>

            <div class="control-group">
                <button class="control-btn" id="zoomOut">-</button>
                <div class="zoom-display" id="zoomDisplay">100%</div>
                <button class="control-btn" id="zoomIn">+</button>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>

<script>
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

    let pdfDoc = null;
    let currentSpread = 0;
    let zoom = 1;
    let isFlipping = false;
    let pageCache = [];
    const pdfFilePath = "{{ asset($ebook->file_path) }}";

    const bookReader = document.getElementById('bookReader');
    const canvasLeft = document.getElementById('canvasLeft');
    const canvasRight = document.getElementById('canvasRight');
    const flipContainer = document.getElementById('flipContainer');
    const flipCanvas = document.getElementById('flipCanvas');
    const flipCanvasBack = document.getElementById('flipCanvasBack');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const pageInfo = document.getElementById('pageInfo');
    const zoomIn = document.getElementById('zoomIn');
    const zoomOut = document.getElementById('zoomOut');
    const zoomDisplay = document.getElementById('zoomDisplay');

    document.getElementById('openBookReader').addEventListener('click', async function() {
        bookReader.classList.add('active');
        document.body.style.overflow = 'hidden';
        await loadPDF(pdfFilePath);
    });

    function closeBookReader() {
        bookReader.classList.remove('active');
        document.body.style.overflow = '';
    }

    prevBtn.addEventListener('click', flipBackward);
    nextBtn.addEventListener('click', flipForward);
    zoomIn.addEventListener('click', () => changeZoom(0.1));
    zoomOut.addEventListener('click', () => changeZoom(-0.1));

    async function loadPDF(url) {
        try {
            const loadingTask = pdfjsLib.getDocument(url);
            pdfDoc = await loadingTask.promise;
            currentSpread = 0;
            zoom = 1;
            pageCache = [];
            await loadAllPages();
            await renderSpread();
        } catch (err) {
            console.error('Error loading PDF:', err);
            alert('Error loading PDF: ' + err.message);
        }
    }

    async function loadAllPages() {
        const numPages = pdfDoc.numPages;
        
        const pageEl = document.querySelector('.page');
        const targetCssWidth = Math.max(1, Math.floor(pageEl.clientWidth));
        const targetCssHeight = Math.max(1, Math.floor(pageEl.clientHeight));

        pageCache = [];
        for (let i = 1; i <= numPages; i++) {
            const renderedCanvas = await renderPageToImage(i, targetCssWidth, targetCssHeight);
            pageCache[i - 1] = renderedCanvas;
        }
    }

    async function renderPageToImage(pageNum, targetCssWidth, targetCssHeight) {
        const page = await pdfDoc.getPage(pageNum);

        const outputScale = window.devicePixelRatio || 1;

        const baseViewport = page.getViewport({ scale: 1 });
        const pdfPageWidth = baseViewport.width;
        const pdfPageHeight = baseViewport.height;

        const scaleX = (targetCssWidth * outputScale) / pdfPageWidth;
        const scaleY = (targetCssHeight * outputScale) / pdfPageHeight;

        const chosenScale = Math.max(scaleX, scaleY);

        const viewport = page.getViewport({ scale: chosenScale });

        const canvas = document.createElement('canvas');
        canvas.width = Math.floor(viewport.width);
        canvas.height = Math.floor(viewport.height);

        const ctx = canvas.getContext('2d');
        const renderContext = {
            canvasContext: ctx,
            viewport: viewport
        };

        await page.render(renderContext).promise;

        return canvas;
    }

    function drawImageToCanvas(renderedCanvas, targetCanvas) {
        const cssWidth = targetCanvas.clientWidth || parseInt(getComputedStyle(targetCanvas).width);
        const cssHeight = targetCanvas.clientHeight || parseInt(getComputedStyle(targetCanvas).height);
        const outputScale = window.devicePixelRatio || 1;

        if (!renderedCanvas) {
            targetCanvas.width = Math.max(1, Math.floor(cssWidth * outputScale));
            targetCanvas.height = Math.max(1, Math.floor(cssHeight * outputScale));
            
            targetCanvas.style.width = cssWidth + 'px';
            targetCanvas.style.height = cssHeight + 'px';

            const ctx = targetCanvas.getContext('2d');
            ctx.fillStyle = 'white';
            ctx.fillRect(0, 0, targetCanvas.width, targetCanvas.height);
            return;
        }

        targetCanvas.width = Math.max(1, Math.floor(cssWidth * outputScale));
        targetCanvas.height = Math.max(1, Math.floor(cssHeight * outputScale));
        
        targetCanvas.style.width = cssWidth + 'px';
        targetCanvas.style.height = cssHeight + 'px';

        const ctx = targetCanvas.getContext('2d');

        ctx.clearRect(0, 0, targetCanvas.width, targetCanvas.height);

        ctx.drawImage(
            renderedCanvas,
            0, 0, renderedCanvas.width, renderedCanvas.height,
            0, 0, targetCanvas.width, targetCanvas.height
        );
    }

    async function renderSpread() {
        if (!pdfDoc || pageCache.length === 0) return;

        let leftPageIndex, rightPageIndex;
        
        if (currentSpread === 0) {
            leftPageIndex = null;
            rightPageIndex = 0;
        } else {
            leftPageIndex = currentSpread * 2 - 1;
            rightPageIndex = currentSpread * 2;
        }

        drawImageToCanvas(leftPageIndex !== null ? pageCache[leftPageIndex] : null, canvasLeft);
        drawImageToCanvas(pageCache[rightPageIndex], canvasRight);

        updateControls();
    }

    function updateControls() {
        const totalPages = pdfDoc.numPages;
        
        if (currentSpread === 0) {
            pageInfo.textContent = `Page 1 (Cover) of ${totalPages}`;
            prevBtn.disabled = true;
        } else {
            const leftPageNum = currentSpread * 2;
            const rightPageNum = currentSpread * 2 + 1;
            
            if (rightPageNum <= totalPages) {
                pageInfo.textContent = `Pages ${leftPageNum}-${rightPageNum} of ${totalPages}`;
            } else {
                pageInfo.textContent = `Page ${leftPageNum} of ${totalPages}`;
            }
            
            prevBtn.disabled = false;
        }
        
        const lastPageShown = currentSpread === 0 ? 1 : currentSpread * 2 + 1;
        nextBtn.disabled = lastPageShown >= totalPages;
        
        zoomDisplay.textContent = Math.round(zoom * 100) + '%';
    }

    async function flipForward() {
        if (isFlipping || !pdfDoc) return;
        
        const totalPages = pdfDoc.numPages;
        const lastPageShown = currentSpread === 0 ? 1 : currentSpread * 2 + 1;
        if (lastPageShown >= totalPages) return;

        isFlipping = true;
        
        nextBtn.disabled = true;
        prevBtn.disabled = true;

        currentSpread++;
        
        const newRightPageIndex = currentSpread * 2;
        if (newRightPageIndex < pageCache.length) {
            drawImageToCanvas(pageCache[newRightPageIndex], canvasRight);
        }
        
        updateControls();

        flipContainer.className = 'flip-container flip-right';
        flipContainer.style.display = 'block';

        const flipPageBack = document.querySelector('.flip-page-back');
        flipPageBack.classList.add('loading');
        
        const ctxBack = flipCanvasBack.getContext('2d');
        ctxBack.clearRect(0, 0, flipCanvasBack.width, flipCanvasBack.height);

        const oldRightPage = currentSpread === 1 ? 0 : (currentSpread - 1) * 2;
        if (oldRightPage < pageCache.length) {
            drawImageToCanvas(pageCache[oldRightPage], flipCanvas);
        }

        flipContainer.classList.add('flipping-forward');

        setTimeout(async () => {
            const newLeftPage = currentSpread * 2 - 1;
            if (newLeftPage < pageCache.length) {
                drawImageToCanvas(pageCache[newLeftPage], flipCanvasBack);
            }
            
            flipPageBack.classList.remove('loading');
        }, 200);

        setTimeout(async () => {
            flipContainer.classList.remove('flipping-forward');
            flipContainer.style.display = 'none';
            
            const newLeftPageIndex = currentSpread * 2 - 1;
            if (newLeftPageIndex < pageCache.length) {
                drawImageToCanvas(pageCache[newLeftPageIndex], canvasLeft);
            }
            
            isFlipping = false;
        }, 700);
    }

    async function flipBackward() {
        if (isFlipping || !pdfDoc || currentSpread === 0) return;

        isFlipping = true;
        
        nextBtn.disabled = true;
        prevBtn.disabled = true;

        currentSpread--;
        
        if (currentSpread === 0) {
            drawImageToCanvas(null, canvasLeft);
        } else {
            const newLeftPageIndex = currentSpread * 2 - 1;
            if (newLeftPageIndex < pageCache.length) {
                drawImageToCanvas(pageCache[newLeftPageIndex], canvasLeft);
            }
        }
        
        updateControls();

        flipContainer.className = 'flip-container flip-left';
        flipContainer.style.display = 'block';

        const flipPageBack = document.querySelector('.flip-page-back');
        flipPageBack.classList.add('loading');
        
        const ctxBack = flipCanvasBack.getContext('2d');
        ctxBack.clearRect(0, 0, flipCanvasBack.width, flipCanvasBack.height);

        const oldLeftPage = (currentSpread + 1) * 2 - 1;
        if (oldLeftPage < pageCache.length) {
            drawImageToCanvas(pageCache[oldLeftPage], flipCanvas);
        }

        flipContainer.classList.add('flipping-backward');

        setTimeout(async () => {
            const newRightPage = currentSpread === 0 ? 0 : currentSpread * 2;
            if (newRightPage < pageCache.length) {
                drawImageToCanvas(pageCache[newRightPage], flipCanvasBack);
            }
            
            flipPageBack.classList.remove('loading');
        }, 200);

        setTimeout(async () => {
            flipContainer.classList.remove('flipping-backward');
            flipContainer.style.display = 'none';
            
            const newRightPageIndex = currentSpread === 0 ? 0 : currentSpread * 2;
            if (newRightPageIndex < pageCache.length) {
                drawImageToCanvas(pageCache[newRightPageIndex], canvasRight);
            }
            
            isFlipping = false;
        }, 700);
    }

    async function changeZoom(delta) {
        const newZoom = Math.max(0.5, Math.min(2, zoom + delta));
        if (newZoom === zoom) return;
        
        zoom = newZoom;
        pageCache = [];
        await loadAllPages();
        await renderSpread();
    }

    document.addEventListener('keydown', function(e) {
        if (!bookReader.classList.contains('active')) return;
        
        if (e.key === 'Escape') {
            closeBookReader();
        } else if (e.key === 'ArrowRight') {
            flipForward();
        } else if (e.key === 'ArrowLeft') {
            flipBackward();
        }
    });
</script>
@endsection