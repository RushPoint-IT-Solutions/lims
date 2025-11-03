@extends('layouts.header')

@section('css')
<style>
    .dashboard-card {
        border-radius: 10px;
        padding: 20px;
        background: white;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        position: relative;
        overflow: hidden;
    }
    
    .dashboard-card .icon-circle {
        position: absolute;
        right: 20px;
        top: 20px;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #d07e0a;
    }
    
    .dashboard-card .icon-circle i {
        color: white;
        font-size: 20px;
    }
    
    .dashboard-card h2 {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 5px;
    }
    
    .dashboard-card p {
        color: #6c757d;
        margin: 0;
        font-size: 14px;
    }
    
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    
    .section-header h5 {
        font-size: 18px;
        font-weight: 600;
        margin: 0;
    }
    
    .table-responsive {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .filter-control {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
    }
    
    .filter-control select,
    .filter-control input {
        padding: 5px 10px;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        font-size: 14px;
    }

    .filter-control input {
        min-width: 200px;
    }
    
    .resource-card {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 15px;
        transition: all 0.3s ease;
    }

    .resource-card:hover {
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        transform: translateY(-2px);
    }

    .resource-header {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        margin-bottom: 15px;
    }

    .resource-icon {
        width: 50px;
        height: 50px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
        flex-shrink: 0;
        background: #667eea;
    }

    .resource-info {
        flex: 1;
    }

    .resource-category {
        display: inline-block;
        padding: 3px 10px;
        background: #f0f3ff;
        color: #667eea;
        border-radius: 15px;
        font-size: 11px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .resource-title {
        font-size: 16px;
        font-weight: 700;
        color: #2c3e50;
        margin: 0 0 5px 0;
    }

    .resource-description {
        color: #6c757d;
        font-size: 13px;
        line-height: 1.5;
        margin: 0;
    }

    .resource-meta {
        display: flex;
        gap: 20px;
        margin-bottom: 15px;
        flex-wrap: wrap;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 12px;
        color: #6c757d;
    }

    .meta-item i {
        font-size: 14px;
        color: #667eea;
    }

    .resource-actions {
        display: flex;
        gap: 10px;
    }

    .btn-access {
        flex: 1;
        background: #667eea;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 5px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        transition: all 0.3s;
    }

    .btn-access:hover {
        background: #5570d8;
    }

    .btn-info {
        background: white;
        color: #667eea;
        border: 2px solid #667eea;
        padding: 8px 16px;
        border-radius: 5px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-info:hover {
        background: #f0f3ff;
    }

    .access-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        padding: 4px 12px;
        border-radius: 15px;
        font-size: 11px;
        font-weight: 600;
    }

    .badge-available {
        background: #d1f4e0;
        color: #0f5132;
    }

    .badge-subscription {
        background: #cfe2ff;
        color: #084298;
    }

    .badge-restricted {
        background: #fff3cd;
        color: #997404;
    }

    .tabs-nav {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        border-bottom: 2px solid #e9ecef;
    }

    .tab-btn {
        padding: 12px 24px;
        background: none;
        border: none;
        color: #6c757d;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        position: relative;
        transition: all 0.3s;
        border-bottom: 3px solid transparent;
    }

    .tab-btn:hover {
        color: #667eea;
    }

    .tab-btn.active {
        color: #667eea;
        border-bottom-color: #667eea;
    }

    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
    }

    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        backdrop-filter: blur(4px);
        animation: fadeIn 0.3s ease;
    }

    .modal-overlay.active {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .modal-content {
        background: white;
        border-radius: 10px;
        max-width: 500px;
        width: 90%;
        max-height: 85vh;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        border-bottom: 1px solid #e9ecef;
    }

    .modal-header h5 {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: #2c3e50;
    }

    .modal-close {
        background: #f8f9fa;
        border: none;
        color: #6c757d;
        font-size: 24px;
        cursor: pointer;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
    }

    .modal-close:hover {
        background: #e9ecef;
    }

    .modal-body {
        padding: 20px;
        overflow-y: auto;
        max-height: calc(85vh - 80px);
    }

    .auth-form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .form-group label {
        font-size: 13px;
        font-weight: 600;
        color: #2c3e50;
    }

    .form-group input {
        padding: 10px 12px;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        font-size: 14px;
    }

    .form-group input:focus {
        outline: none;
        border-color: #667eea;
    }

    .btn-submit {
        background: #667eea;
        color: white;
        border: none;
        padding: 12px;
        border-radius: 5px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-submit:hover {
        background: #5570d8;
    }

    .access-log-table {
        width: 100%;
        border-collapse: collapse;
    }

    .access-log-table thead th {
        background: #f8f9fa;
        padding: 12px;
        text-align: left;
        font-size: 13px;
        font-weight: 600;
        color: #2c3e50;
        border-bottom: 2px solid #dee2e6;
    }

    .access-log-table tbody td {
        padding: 12px;
        border-bottom: 1px solid #e9ecef;
        font-size: 13px;
        color: #495057;
    }

    .access-log-table tbody tr:hover {
        background: #f8f9fa;
    }

    .status-badge {
        padding: 3px 10px;
        border-radius: 15px;
        font-size: 11px;
        font-weight: 600;
    }

    .status-success {
        background: #d1f4e0;
        color: #0f5132;
    }

    .status-failed {
        background: #f8d7da;
        color: #842029;
    }

    .resource-detail {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .detail-item {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #e9ecef;
    }

    .detail-item:last-child {
        border-bottom: none;
    }

    .detail-label {
        font-weight: 600;
        color: #2c3e50;
        font-size: 13px;
    }

    .detail-value {
        color: #6c757d;
        text-align: right;
        font-size: 13px;
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 48px;
        color: #dee2e6;
        margin-bottom: 15px;
    }

    .empty-state h5 {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 8px;
        color: #495057;
    }

    .empty-state p {
        font-size: 13px;
        margin: 0;
    }
</style>
@endsection

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="mb-0">E-Resources Access</h4>
            <p class="text-muted mb-0">Access digital books, journals, databases, and online resources</p>
        </div>
    </div>

    <!-- Dashboard Cards -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="icon-circle">
                    <i class="ri-book-2-line"></i>
                </div>
                <h2>245</h2>
                <p>Available E-Books</p>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="icon-circle">
                    <i class="ri-database-line"></i>
                </div>
                <h2>38</h2>
                <p>Active Databases</p>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="icon-circle">
                    <i class="ri-article-line"></i>
                </div>
                <h2>1,523</h2>
                <p>E-Journals</p>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="icon-circle">
                    <i class="ri-user-line"></i>
                </div>
                <h2>892</h2>
                <p>Active Users</p>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="table-responsive mb-4">
        <div class="section-header">
            <h5>Filter Resources</h5>
        </div>
        <div class="row g-3">
            <div class="col-md-4">
                <div class="filter-control">
                    <input type="text" class="form-control" placeholder="Search by title, author, or keyword...">
                </div>
            </div>
            <div class="col-md-3">
                <div class="filter-control">
                    <select class="form-control">
                        <option>All Categories</option>
                        <option>E-Books</option>
                        <option>Journals</option>
                        <option>Databases</option>
                        <option>Videos</option>
                        <option>Audio Books</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="filter-control">
                    <select class="form-control">
                        <option>All Access</option>
                        <option>Open Access</option>
                        <option>Subscription</option>
                        <option>Restricted</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary w-100">
                    <i class="ri-search-line"></i> Search
                </button>
            </div>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <div class="tabs-nav">
        <button class="tab-btn active" onclick="switchTab('resources')">
            <i class="ri-book-open-line"></i> Browse Resources
        </button>
        <button class="tab-btn" onclick="switchTab('mylibrary')">
            <i class="ri-bookmark-line"></i> My Library
        </button>
        <button class="tab-btn" onclick="switchTab('accesslog')">
            <i class="ri-history-line"></i> Access Log
        </button>
    </div>

    <!-- Browse Resources Tab -->
    <div class="tab-content active" id="resources">
        <div class="row g-3">
            <div class="col-lg-6">
                <div class="resource-card">
                    <span class="access-badge badge-available">Open Access</span>
                    <div class="resource-header">
                        <div class="resource-icon" style="background: #667eea;">
                            <i class="ri-book-2-line"></i>
                        </div>
                        <div class="resource-info">
                            <span class="resource-category">E-Book</span>
                            <h3 class="resource-title">Introduction to Algorithms</h3>
                            <p class="resource-description">Comprehensive introduction to algorithms and data structures for computer science students.</p>
                        </div>
                    </div>
                    <div class="resource-meta">
                        <div class="meta-item">
                            <i class="ri-user-line"></i>
                            <span>Thomas H. Cormen</span>
                        </div>
                        <div class="meta-item">
                            <i class="ri-calendar-line"></i>
                            <span>2023 Edition</span>
                        </div>
                        <div class="meta-item">
                            <i class="ri-eye-line"></i>
                            <span>1,245 views</span>
                        </div>
                    </div>
                    <div class="resource-actions">
                        <button class="btn-access" onclick="authenticateAccess('Introduction to Algorithms')">
                            <i class="ri-lock-unlock-line"></i> Access Now
                        </button>
                        <button class="btn-info" onclick="showResourceInfo('ebook1')">
                            <i class="ri-information-line"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="resource-card">
                    <span class="access-badge badge-subscription">Subscription Required</span>
                    <div class="resource-header">
                        <div class="resource-icon" style="background: #f093fb;">
                            <i class="ri-database-line"></i>
                        </div>
                        <div class="resource-info">
                            <span class="resource-category">Database</span>
                            <h3 class="resource-title">IEEE Xplore Digital Library</h3>
                            <p class="resource-description">Access millions of technical and engineering articles, conference papers, and standards.</p>
                        </div>
                    </div>
                    <div class="resource-meta">
                        <div class="meta-item">
                            <i class="ri-building-line"></i>
                            <span>IEEE</span>
                        </div>
                        <div class="meta-item">
                            <i class="ri-article-line"></i>
                            <span>5M+ Documents</span>
                        </div>
                        <div class="meta-item">
                            <i class="ri-eye-line"></i>
                            <span>856 views</span>
                        </div>
                    </div>
                    <div class="resource-actions">
                        <button class="btn-access" onclick="authenticateAccess('IEEE Xplore')">
                            <i class="ri-lock-unlock-line"></i> Access Now
                        </button>
                        <button class="btn-info" onclick="showResourceInfo('db1')">
                            <i class="ri-information-line"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="resource-card">
                    <span class="access-badge badge-subscription">Subscription Required</span>
                    <div class="resource-header">
                        <div class="resource-icon" style="background: #4facfe;">
                            <i class="ri-article-line"></i>
                        </div>
                        <div class="resource-info">
                            <span class="resource-category">Journal</span>
                            <h3 class="resource-title">Nature Scientific Reports</h3>
                            <p class="resource-description">Open access journal publishing original research from all scientific disciplines.</p>
                        </div>
                    </div>
                    <div class="resource-meta">
                        <div class="meta-item">
                            <i class="ri-building-line"></i>
                            <span>Nature Publishing</span>
                        </div>
                        <div class="meta-item">
                            <i class="ri-calendar-line"></i>
                            <span>Updated Daily</span>
                        </div>
                        <div class="meta-item">
                            <i class="ri-eye-line"></i>
                            <span>2,341 views</span>
                        </div>
                    </div>
                    <div class="resource-actions">
                        <button class="btn-access" onclick="authenticateAccess('Nature Scientific Reports')">
                            <i class="ri-lock-unlock-line"></i> Access Now
                        </button>
                        <button class="btn-info" onclick="showResourceInfo('journal1')">
                            <i class="ri-information-line"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="resource-card">
                    <span class="access-badge badge-available">Open Access</span>
                    <div class="resource-header">
                        <div class="resource-icon" style="background: #fa709a;">
                            <i class="ri-video-line"></i>
                        </div>
                        <div class="resource-info">
                            <span class="resource-category">Video</span>
                            <h3 class="resource-title">MIT OpenCourseWare</h3>
                            <p class="resource-description">Free lecture videos, notes, and exams from MIT courses covering all disciplines.</p>
                        </div>
                    </div>
                    <div class="resource-meta">
                        <div class="meta-item">
                            <i class="ri-building-line"></i>
                            <span>MIT</span>
                        </div>
                        <div class="meta-item">
                            <i class="ri-play-circle-line"></i>
                            <span>2,400+ Courses</span>
                        </div>
                        <div class="meta-item">
                            <i class="ri-eye-line"></i>
                            <span>5,678 views</span>
                        </div>
                    </div>
                    <div class="resource-actions">
                        <button class="btn-access" onclick="authenticateAccess('MIT OpenCourseWare')">
                            <i class="ri-lock-unlock-line"></i> Access Now
                        </button>
                        <button class="btn-info" onclick="showResourceInfo('video1')">
                            <i class="ri-information-line"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="resource-card">
                    <span class="access-badge badge-restricted">Restricted</span>
                    <div class="resource-header">
                        <div class="resource-icon" style="background: #a8edea;">
                            <i class="ri-book-3-line"></i>
                        </div>
                        <div class="resource-info">
                            <span class="resource-category">E-Book</span>
                            <h3 class="resource-title">The Art of Computer Programming</h3>
                            <p class="resource-description">Donald Knuth's classic multi-volume work on computer science and programming.</p>
                        </div>
                    </div>
                    <div class="resource-meta">
                        <div class="meta-item">
                            <i class="ri-user-line"></i>
                            <span>Donald Knuth</span>
                        </div>
                        <div class="meta-item">
                            <i class="ri-calendar-line"></i>
                            <span>2022 Edition</span>
                        </div>
                        <div class="meta-item">
                            <i class="ri-eye-line"></i>
                            <span>945 views</span>
                        </div>
                    </div>
                    <div class="resource-actions">
                        <button class="btn-access" onclick="authenticateAccess('The Art of Computer Programming')">
                            <i class="ri-lock-unlock-line"></i> Request Access
                        </button>
                        <button class="btn-info" onclick="showResourceInfo('ebook2')">
                            <i class="ri-information-line"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="resource-card">
                    <span class="access-badge badge-subscription">Subscription Required</span>
                    <div class="resource-header">
                        <div class="resource-icon" style="background: #ffecd2;">
                            <i class="ri-database-2-line"></i>
                        </div>
                        <div class="resource-info">
                            <span class="resource-category">Database</span>
                            <h3 class="resource-title">JSTOR Digital Library</h3>
                            <p class="resource-description">Academic journals, books, and primary sources in 75 disciplines.</p>
                        </div>
                    </div>
                    <div class="resource-meta">
                        <div class="meta-item">
                            <i class="ri-building-line"></i>
                            <span>JSTOR</span>
                        </div>
                        <div class="meta-item">
                            <i class="ri-article-line"></i>
                            <span>12M+ Articles</span>
                        </div>
                        <div class="meta-item">
                            <i class="ri-eye-line"></i>
                            <span>3,421 views</span>
                        </div>
                    </div>
                    <div class="resource-actions">
                        <button class="btn-access" onclick="authenticateAccess('JSTOR')">
                            <i class="ri-lock-unlock-line"></i> Access Now
                        </button>
                        <button class="btn-info" onclick="showResourceInfo('db2')">
                            <i class="ri-information-line"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- My Library Tab -->
    <div class="tab-content" id="mylibrary">
        <div class="row g-3">
            <div class="col-lg-6">
                <div class="resource-card">
                    <span class="access-badge badge-available">Currently Reading</span>
                    <div class="resource-header">
                        <div class="resource-icon" style="background: #667eea;">
                            <i class="ri-book-open-line"></i>
                        </div>
                        <div class="resource-info">
                            <span class="resource-category">E-Book</span>
                            <h3 class="resource-title">Clean Code</h3>
                            <p class="resource-description">A Handbook of Agile Software Craftsmanship by Robert C. Martin</p>
                        </div>
                    </div>
                    <div class="resource-meta">
                        <div class="meta-item">
                            <i class="ri-time-line"></i>
                            <span>Last accessed: 2 hours ago</span>
                        </div>
                        <div class="meta-item">
                            <i class="ri-bookmark-line"></i>
                            <span>Chapter 5, Page 87</span>
                        </div>
                    </div>
                    <div class="resource-actions">
                        <button class="btn-access" onclick="continueReading('Clean Code')">
                            <i class="ri-play-line"></i> Continue Reading
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="resource-card">
                    <span class="access-badge badge-available">Bookmarked</span>
                    <div class="resource-header">
                        <div class="resource-icon" style="background: #4facfe;">
                            <i class="ri-article-line"></i>
                        </div>
                        <div class="resource-info">
                            <span class="resource-category">Journal</span>
                            <h3 class="resource-title">Advanced Machine Learning</h3>
                            <p class="resource-description">Recent developments in neural networks and deep learning.</p>
                        </div>
                    </div>
                    <div class="resource-meta">
                        <div class="meta-item">
                            <i class="ri-time-line"></i>
                            <span>Added: 3 days ago</span>
                        </div>
                        <div class="meta-item">
                            <i class="ri-bookmark-line"></i>
                            <span>5 articles saved</span>
                        </div>
                    </div>
                    <div class="resource-actions">
                        <button class="btn-access" onclick="continueReading('ML Journal')">
                            <i class="ri-play-line"></i> View Articles
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="empty-state" style="margin-top: 40px;">
            <i class="ri-bookmark-line"></i>
            <h5>Your library is growing!</h5>
            <p>Access e-resources to build your personal digital library</p>
        </div>
    </div>

    <!-- Access Log Tab -->
    <div class="tab-content" id="accesslog">
        <div class="table-responsive">
            <table class="access-log-table">
                <thead>
                    <tr>
                        <th>Resource Name</th>
                        <th>Type</th>
                        <th>Access Time</th>
                        <th>Duration</th>
                        <th>Status</th>
                        <th>Device</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <strong>Introduction to Algorithms</strong><br>
                            <small style="color: #6c757d;">E-Book</small>
                        </td>
                        <td><span class="resource-category">E-Book</span></td>
                        <td>Nov 01, 2025 10:30 AM</td>
                        <td>45 minutes</td>
                        <td><span class="status-badge status-success">Success</span></td>
                        <td><i class="ri-computer-line"></i> Desktop</td>
                    </tr>
                    <tr>
                        <td>
                            <strong>IEEE Xplore Digital Library</strong><br>
                            <small style="color: #6c757d;">Database</small>
                        </td>
                        <td><span class="resource-category">Database</span></td>
                        <td>Nov 01, 2025 09:15 AM</td>
                        <td>1 hour 20 mins</td>
                        <td><span class="status-badge status-success">Success</span></td>
                        <td><i class="ri-smartphone-line"></i> Mobile</td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Nature Scientific Reports</strong><br>
                            <small style="color: #6c757d;">Journal</small>
                        </td>
                        <td><span class="resource-category">Journal</span></td>
                        <td>Oct 31, 2025 03:45 PM</td>
                        <td>30 minutes</td>
                        <td><span class="status-badge status-success">Success</span></td>
                        <td><i class="ri-tablet-line"></i> Tablet</td>
                    </tr>
                    <tr>
                        <td>
                            <strong>The Art of Computer Programming</strong><br>
                            <small style="color: #6c757d;">E-Book</small>
                        </td>
                        <td><span class="resource-category">E-Book</span></td>
                        <td>Oct 31, 2025 11:20 AM</td>
                        <td>-</td>
                        <td><span class="status-badge status-failed">Failed</span></td>
                        <td><i class="ri-computer-line"></i> Desktop</td>
                    </tr>
                    <tr>
                        <td>
                            <strong>MIT OpenCourseWare</strong><br>
                            <small style="color: #6c757d;">Video</small>
                        </td>
                        <td><span class="resource-category">Video</span></td>
                        <td>Oct 30, 2025 02:00 PM</td>
                        <td>2 hours 15 mins</td>
                        <td><span class="status-badge status-success">Success</span></td>
                        <td><i class="ri-computer-line"></i> Desktop</td>
                    </tr>
                    <tr>
                        <td>
                            <strong>JSTOR Digital Library</strong><br>
                            <small style="color: #6c757d;">Database</small>
                        </td>
                        <td><span class="resource-category">Database</span></td>
                        <td>Oct 30, 2025 10:30 AM</td>
                        <td>55 minutes</td>
                        <td><span class="status-badge status-success">Success</span></td>
                        <td><i class="ri-smartphone-line"></i> Mobile</td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Clean Code</strong><br>
                            <small style="color: #6c757d;">E-Book</small>
                        </td>
                        <td><span class="resource-category">E-Book</span></td>
                        <td>Oct 29, 2025 04:15 PM</td>
                        <td>1 hour 35 mins</td>
                        <td><span class="status-badge status-success">Success</span></td>
                        <td><i class="ri-computer-line"></i> Desktop</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Authentication Modal -->
    <div id="authModal" class="modal-overlay" onclick="closeModal('authModal')">
        <div class="modal-content" onclick="event.stopPropagation()">
            <div class="modal-header">
                <h5><i class="ri-lock-unlock-line"></i> Authenticate Access</h5>
                <button class="modal-close" onclick="closeModal('authModal')">&times;</button>
            </div>
            <div class="modal-body">
                <div style="text-align: center; margin-bottom: 20px;">
                    <h4 id="authResourceName" style="margin: 0 0 8px 0; color: #2c3e50; font-size: 18px;">Introduction to Algorithms</h4>
                    <p style="color: #6c757d; margin: 0; font-size: 13px;">Please verify your credentials to access this resource</p>
                </div>

                <form class="auth-form" onsubmit="submitAuthentication(event)">
                    <div class="form-group">
                        <label>Library ID / Student ID</label>
                        <input type="text" placeholder="Enter your ID" required>
                    </div>
                    <div class="form-group">
                        <label>Password / PIN</label>
                        <input type="password" placeholder="Enter your password" required>
                    </div>
                    <div class="form-group">
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-weight: normal;">
                            <input type="checkbox" style="width: auto;">
                            <span style="font-size: 13px;">Remember my credentials for 30 days</span>
                        </label>
                    </div>
                    <button type="submit" class="btn-submit">
                        <i class="ri-login-circle-line"></i> Authenticate & Access
                    </button>
                </form>

                <div style="text-align: center; margin-top: 15px; padding-top: 15px; border-top: 1px solid #e9ecef;">
                    <p style="color: #6c757d; font-size: 12px; margin: 0;">
                        <i class="ri-information-line"></i> Having trouble? Contact the library help desk
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Resource Info Modal -->
    <div id="infoModal" class="modal-overlay" onclick="closeModal('infoModal')">
        <div class="modal-content" onclick="event.stopPropagation()">
            <div class="modal-header">
                <h5><i class="ri-information-line"></i> Resource Information</h5>
                <button class="modal-close" onclick="closeModal('infoModal')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="resource-detail">
                    <div class="detail-item">
                        <span class="detail-label">Resource Type</span>
                        <span class="detail-value">E-Book</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Title</span>
                        <span class="detail-value">Introduction to Algorithms</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Author(s)</span>
                        <span class="detail-value">Thomas H. Cormen, Charles E. Leiserson</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Publisher</span>
                        <span class="detail-value">MIT Press</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Edition</span>
                        <span class="detail-value">4th Edition (2023)</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">ISBN</span>
                        <span class="detail-value">978-0262046305</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Access Type</span>
                        <span class="detail-value">Open Access</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Format</span>
                        <span class="detail-value">PDF, EPUB</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">File Size</span>
                        <span class="detail-value">25.4 MB</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Language</span>
                        <span class="detail-value">English</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Total Views</span>
                        <span class="detail-value">1,245 views</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Average Rating</span>
                        <span class="detail-value">⭐⭐⭐⭐⭐ (4.8/5.0)</span>
                    </div>
                </div>

                <div style="margin-top: 20px; padding: 15px; background: #f8f9fa; border-radius: 5px;">
                    <h6 style="margin: 0 0 8px 0; font-weight: 600; color: #2c3e50; font-size: 14px;">Description</h6>
                    <p style="margin: 0; color: #6c757d; font-size: 13px; line-height: 1.6;">
                        This textbook provides a comprehensive introduction to the modern study of computer algorithms. 
                        It presents many algorithms and covers them in considerable depth, yet makes their design and 
                        analysis accessible to all levels of readers.
                    </p>
                </div>

                <button class="btn-submit" style="margin-top: 15px; width: 100%;" onclick="closeModal('infoModal'); authenticateAccess('Introduction to Algorithms');">
                    <i class="ri-lock-unlock-line"></i> Access This Resource
                </button>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="modal-overlay" onclick="closeModal('successModal')">
        <div class="modal-content" onclick="event.stopPropagation()">
            <div class="modal-header">
                <h5><i class="ri-check-line"></i> Access Granted</h5>
                <button class="modal-close" onclick="closeModal('successModal')">&times;</button>
            </div>
            <div class="modal-body">
                <div style="text-align: center;">
                    <div style="width: 80px; height: 80px; margin: 0 auto 15px; background: #43e97b; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="ri-check-line" style="font-size: 40px; color: white;"></i>
                    </div>
                    <h4 style="margin: 0 0 8px 0; color: #2c3e50; font-size: 18px;">Authentication Successful!</h4>
                    <p style="color: #6c757d; margin: 0 0 20px 0; font-size: 13px;">You now have access to <strong id="successResourceName">Introduction to Algorithms</strong></p>
                    
                    <div style="background: #f8f9fa; padding: 15px; border-radius: 5px; margin-bottom: 15px;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 13px;">
                            <span style="color: #6c757d;">Session ID:</span>
                            <strong>#SES-2025-001234</strong>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 13px;">
                            <span style="color: #6c757d;">Access Time:</span>
                            <strong>Nov 01, 2025 10:30 AM</strong>
                        </div>
                        <div style="display: flex; justify-content: space-between; font-size: 13px;">
                            <span style="color: #6c757d;">Valid Until:</span>
                            <strong>Nov 01, 2025 11:30 PM</strong>
                        </div>
                    </div>

                    <button class="btn-submit" style="width: 100%;" onclick="redirectToResource()">
                        <i class="ri-external-link-line"></i> Open Resource
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
<script>
    // Tab switching
    function switchTab(tabName) {
        document.querySelectorAll('.tab-btn').forEach(tab => tab.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
        
        event.target.classList.add('active');
        document.getElementById(tabName).classList.add('active');
    }

    // Modal functions
    function openModal(modalId) {
        document.getElementById(modalId).classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('active');
        document.body.style.overflow = '';
    }

    // Authenticate access
    function authenticateAccess(resourceName) {
        document.getElementById('authResourceName').textContent = resourceName;
        openModal('authModal');
    }

    // Show resource info
    function showResourceInfo(resourceId) {
        openModal('infoModal');
    }

    // Continue reading
    function continueReading(resourceName) {
        alert('Opening ' + resourceName + '...');
    }

    // Submit authentication
    function submitAuthentication(event) {
        event.preventDefault();
        
        closeModal('authModal');
        
        setTimeout(() => {
            const resourceName = document.getElementById('authResourceName').textContent;
            document.getElementById('successResourceName').textContent = resourceName;
            openModal('successModal');
            
            logAccess(resourceName);
        }, 500);
    }

    // Redirect to resource
    function redirectToResource() {
        closeModal('successModal');
        alert('Redirecting to resource viewer...');
    }

    // Log access attempt
    function logAccess(resourceName) {
        const now = new Date();
        const logEntry = {
            resource: resourceName,
            timestamp: now.toLocaleString(),
            status: 'Success',
            device: 'Desktop'
        };
        console.log('Access logged:', logEntry);
    }

    // Close modal on ESC key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            document.querySelectorAll('.modal-overlay.active').forEach(modal => {
                modal.classList.remove('active');
            });
            document.body.style.overflow = '';
        }
    });
</script>
@endsection