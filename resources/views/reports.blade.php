@extends('layouts.header')

@section('css')
<style>
    .dashboard-card .trend {
        font-size: 12px;
        margin-top: 8px;
    }

    .trend.up {
        color: #27ae60;
    }

    .trend.down {
        color: #e74c3c;
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

    .report-card {
        background: white;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 20px;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .filter-section {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .filter-row {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        align-items: end;
    }

    .filter-group {
        flex: 1;
        min-width: 180px;
    }

    .filter-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 6px;
    }

    .filter-group select,
    .filter-group input {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        font-size: 14px;
        background: white;
    }

    .btn-primary {
        background: #4a90e2;
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 5px;
        font-size: 14px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-primary:hover {
        background: #357abd;
    }

    .btn-success {
        background: #27ae60;
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 5px;
        font-size: 14px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-success:hover {
        background: #229954;
    }

    .btn-secondary {
        background: #6c757d;
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 5px;
        font-size: 14px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-secondary:hover {
        background: #5a6268;
    }

    .export-buttons {
        display: flex;
        gap: 10px;
    }

    .tab-navigation {
        display: flex;
        gap: 5px;
        border-bottom: 2px solid #e9ecef;
        margin-bottom: 20px;
    }

    .tab-btn {
        padding: 10px 20px;
        background: none;
        border: none;
        color: #6c757d;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        position: relative;
        transition: all 0.3s;
    }

    .tab-btn:hover {
        color: #4a90e2;
    }

    .tab-btn.active {
        color: #4a90e2;
    }

    .tab-btn.active::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        right: 0;
        height: 2px;
        background: #4a90e2;
    }

    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
    }

    .chart-container {
        position: relative;
        height: 300px;
        margin: 20px 0;
    }

    .table-responsive {
        overflow-x: auto;
        margin-top: 20px;
    }

    .report-table {
        width: 100%;
        border-collapse: collapse;
    }

    .report-table thead th {
        background: #f8f9fa;
        padding: 12px;
        text-align: left;
        font-size: 13px;
        font-weight: 600;
        color: #2c3e50;
        border-bottom: 2px solid #dee2e6;
    }

    .report-table tbody td {
        padding: 12px;
        border-bottom: 1px solid #e9ecef;
        font-size: 14px;
        color: #495057;
    }

    .report-table tbody tr:hover {
        background: #f8f9fa;
    }

    .stat-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

    .stat-badge.high {
        background: #d1f4e0;
        color: #0f5132;
    }

    .stat-badge.medium {
        background: #fff3cd;
        color: #997404;
    }

    .stat-badge.low {
        background: #f8d7da;
        color: #842029;
    }

    .quick-stat {
        display: flex;
        justify-content: space-between;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
        margin-bottom: 10px;
    }

    .quick-stat-label {
        font-size: 13px;
        color: #6c757d;
    }

    .quick-stat-value {
        font-size: 16px;
        font-weight: 700;
        color: #2c3e50;
    }

    .row.g-3 {
        display: flex;
        flex-wrap: wrap;
    }

    .row.g-3 > [class*='col-'] {
        display: flex;
        flex-direction: column;
    }

    .summary-item {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #e9ecef;
    }

    .summary-item:last-child {
        border-bottom: none;
    }

    .summary-label {
        font-size: 14px;
        color: #6c757d;
    }

    .summary-value {
        font-size: 14px;
        font-weight: 600;
        color: #2c3e50;
    }

    .progress-bar-container {
        width: 100%;
        height: 8px;
        background: #e9ecef;
        border-radius: 4px;
        overflow: hidden;
        margin-top: 5px;
    }

    .progress-bar {
        height: 100%;
        background: #4a90e2;
        transition: width 0.3s;
    }

    .top-items-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .top-item {
        display: flex;
        align-items: center;
        padding: 12px;
        border-bottom: 1px solid #e9ecef;
    }

    .top-item:last-child {
        border-bottom: none;
    }

    .top-item-rank {
        width: 30px;
        height: 30px;
        background: #4a90e2;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 13px;
        margin-right: 15px;
        flex-shrink: 0;
    }

    .top-item-rank.gold {
        background: #f39c12;
    }

    .top-item-rank.silver {
        background: #95a5a6;
    }

    .top-item-rank.bronze {
        background: #cd7f32;
    }

    .top-item-info {
        flex: 1;
    }

    .top-item-title {
        font-size: 14px;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 3px;
    }

    .top-item-subtitle {
        font-size: 12px;
        color: #6c757d;
    }

    .top-item-value {
        font-size: 16px;
        font-weight: 700;
        color: #4a90e2;
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
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes slideUp {
        from {
            transform: translateY(50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .modal-content {
        background: white;
        border-radius: 12px;
        max-width: 900px;
        width: 90%;
        max-height: 85vh;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        animation: slideUp 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 25px;
        border-bottom: 2px solid #e9ecef;
        background: #f8f9fa;
    }

    .modal-header h5 {
        margin: 0;
        font-size: 20px;
        font-weight: 700;
        color: #2c3e50;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .modal-header h5 i {
        font-size: 24px;
        color: #4a90e2;
    }

    .modal-close {
        background: none;
        border: none;
        font-size: 32px;
        color: #6c757d;
        cursor: pointer;
        line-height: 1;
        padding: 0;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 4px;
        transition: all 0.2s;
    }

    .modal-close:hover {
        background: #e9ecef;
        color: #2c3e50;
    }

    .modal-body {
        padding: 25px;
        overflow-y: auto;
        flex: 1;
    }

    .modal-body::-webkit-scrollbar {
        width: 8px;
    }

    .modal-body::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    .modal-body::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 4px;
    }

    .modal-body::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }
</style>
@endsection

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="mb-0">Reports & Analytics</h4>
            <p class="text-muted mb-0">Generate usage, acquisition, and circulation reports</p>
        </div>
    </div>

    <!-- Dashboard Cards -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="icon-circle" style="background: #d07e0a;">
                    <i class="ri-book-open-line"></i>
                </div>
                <h2>1,245</h2>
                <p>Total Circulations</p>
                <div class="trend up">
                    <i class="ri-arrow-up-line"></i> 12% from last month
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="icon-circle" style="background: #d07e0a;">
                    <i class="ri-shopping-cart-line"></i>
                </div>
                <h2>156</h2>
                <p>New Acquisitions</p>
                <div class="trend up">
                    <i class="ri-arrow-up-line"></i> 8% from last month
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="icon-circle" style="background: #d07e0a;">
                    <i class="ri-user-line"></i>
                </div>
                <h2>892</h2>
                <p>Active Users</p>
                <div class="trend down">
                    <i class="ri-arrow-down-line"></i> 3% from last month
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="icon-circle" style="background: #d07e0a;">
                    <i class="ri-time-line"></i>
                </div>
                <h2>24</h2>
                <p>Overdue Items</p>
                <div class="trend down">
                    <i class="ri-arrow-down-line"></i> 15% from last month
                </div>
            </div>
        </div>
    </div>

    <!-- Report Filters -->
    <div class="row g-3 mb-4">
        <div class="col-12">
            <div class="report-card">
                <div class="section-header">
                    <h5>Report Filters</h5>
                    <div class="export-buttons">
                        <button class="btn-success">
                            <i class="ri-file-excel-line"></i> Export Excel
                        </button>
                        <button class="btn-secondary">
                            <i class="ri-file-pdf-line"></i> Export PDF
                        </button>
                    </div>
                </div>

                <div class="filter-section">
                    <div class="filter-row">
                        <div class="filter-group">
                            <label>Date Range</label>
                            <select>
                                <option>Last 7 Days</option>
                                <option>Last 30 Days</option>
                                <option selected>Last 3 Months</option>
                                <option>Last 6 Months</option>
                                <option>Last Year</option>
                                <option>Custom Range</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label>Start Date</label>
                            <input type="date" value="2025-08-01">
                        </div>
                        <div class="filter-group">
                            <label>End Date</label>
                            <input type="date" value="2025-11-01">
                        </div>
                        <div class="filter-group">
                            <label>Category</label>
                            <select>
                                <option selected>All Categories</option>
                                <option>Fiction</option>
                                <option>Non-Fiction</option>
                                <option>Reference</option>
                                <option>Periodicals</option>
                                <option>E-Books</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label>User Type</label>
                            <select>
                                <option selected>All Users</option>
                                <option>Students</option>
                                <option>Faculty</option>
                                <option>Staff</option>
                            </select>
                        </div>
                        <div class="filter-group" style="flex: 0 0 auto;">
                            <button class="btn-primary">
                                <i class="ri-search-line"></i> Generate Report
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Tab Navigation -->
                <div class="tab-navigation">
                    <button class="tab-btn active" onclick="switchTab('circulation')">
                        <i class="ri-refresh-line"></i> Circulation Report
                    </button>
                    <button class="tab-btn" onclick="switchTab('usage')">
                        <i class="ri-bar-chart-line"></i> Usage Statistics
                    </button>
                    <button class="tab-btn" onclick="switchTab('acquisition')">
                        <i class="ri-shopping-bag-line"></i> Acquisition Report
                    </button>
                    <button class="tab-btn" onclick="switchTab('users')">
                        <i class="ri-group-line"></i> User Analytics
                    </button>
                </div>

                <!-- Circulation Report Tab -->
                <div class="tab-content active" id="circulation">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <div class="chart-container">
                                <canvas id="circulationChart"></canvas>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6 class="mb-3" style="font-weight: 600;">Summary</h6>
                            <div class="quick-stat">
                                <span class="quick-stat-label">Total Checkouts</span>
                                <span class="quick-stat-value">1,245</span>
                            </div>
                            <div class="quick-stat">
                                <span class="quick-stat-label">Total Returns</span>
                                <span class="quick-stat-value">1,189</span>
                            </div>
                            <div class="quick-stat">
                                <span class="quick-stat-label">Currently On Loan</span>
                                <span class="quick-stat-value">56</span>
                            </div>
                            <div class="quick-stat">
                                <span class="quick-stat-label">Average Loan Duration</span>
                                <span class="quick-stat-value">12 days</span>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="report-table">
                            <thead>
                                <tr>
                                    <th>Book Title</th>
                                    <th>Author</th>
                                    <th>Times Borrowed</th>
                                    <th>Current Status</th>
                                    <th>Category</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Introduction to Algorithms</strong></td>
                                    <td>Thomas H. Cormen</td>
                                    <td>45</td>
                                    <td><span class="stat-badge high">Available</span></td>
                                    <td>Computer Science</td>
                                </tr>
                                <tr>
                                    <td><strong>Clean Code</strong></td>
                                    <td>Robert C. Martin</td>
                                    <td>38</td>
                                    <td><span class="stat-badge medium">On Loan</span></td>
                                    <td>Programming</td>
                                </tr>
                                <tr>
                                    <td><strong>The Pragmatic Programmer</strong></td>
                                    <td>Andrew Hunt</td>
                                    <td>32</td>
                                    <td><span class="stat-badge high">Available</span></td>
                                    <td>Software Engineering</td>
                                </tr>
                                <tr>
                                    <td><strong>Design Patterns</strong></td>
                                    <td>Gang of Four</td>
                                    <td>29</td>
                                    <td><span class="stat-badge high">Available</span></td>
                                    <td>Software Design</td>
                                </tr>
                                <tr>
                                    <td><strong>Artificial Intelligence: A Modern Approach</strong></td>
                                    <td>Stuart Russell</td>
                                    <td>27</td>
                                    <td><span class="stat-badge medium">On Loan</span></td>
                                    <td>AI & ML</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Usage Statistics Tab -->
                <div class="tab-content" id="usage">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <div class="chart-container">
                                <canvas id="usageChart"></canvas>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6 class="mb-3" style="font-weight: 600;">Usage Breakdown</h6>
                            <div class="summary-item">
                                <span class="summary-label">Physical Books</span>
                                <span class="summary-value">68%</span>
                            </div>
                            <div class="progress-bar-container">
                                <div class="progress-bar" style="width: 68%;"></div>
                            </div>

                            <div class="summary-item mt-3">
                                <span class="summary-label">E-Books</span>
                                <span class="summary-value">22%</span>
                            </div>
                            <div class="progress-bar-container">
                                <div class="progress-bar" style="width: 22%; background: #27ae60;"></div>
                            </div>

                            <div class="summary-item mt-3">
                                <span class="summary-label">Reference Materials</span>
                                <span class="summary-value">10%</span>
                            </div>
                            <div class="progress-bar-container">
                                <div class="progress-bar" style="width: 10%; background: #f39c12;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <h6 class="mb-3" style="font-weight: 600;">Top Categories</h6>
                            <ul class="top-items-list">
                                <li class="top-item">
                                    <div class="top-item-rank gold">1</div>
                                    <div class="top-item-info">
                                        <div class="top-item-title">Computer Science</div>
                                        <div class="top-item-subtitle">Technology & Programming</div>
                                    </div>
                                    <div class="top-item-value">342</div>
                                </li>
                                <li class="top-item">
                                    <div class="top-item-rank silver">2</div>
                                    <div class="top-item-info">
                                        <div class="top-item-title">Business & Economics</div>
                                        <div class="top-item-subtitle">Management & Finance</div>
                                    </div>
                                    <div class="top-item-value">289</div>
                                </li>
                                <li class="top-item">
                                    <div class="top-item-rank bronze">3</div>
                                    <div class="top-item-info">
                                        <div class="top-item-title">Literature</div>
                                        <div class="top-item-subtitle">Fiction & Poetry</div>
                                    </div>
                                    <div class="top-item-value">256</div>
                                </li>
                                <li class="top-item">
                                    <div class="top-item-rank">4</div>
                                    <div class="top-item-info">
                                        <div class="top-item-title">Science</div>
                                        <div class="top-item-subtitle">Physics, Chemistry, Biology</div>
                                    </div>
                                    <div class="top-item-value">198</div>
                                </li>
                                <li class="top-item">
                                    <div class="top-item-rank">5</div>
                                    <div class="top-item-info">
                                        <div class="top-item-title">History</div>
                                        <div class="top-item-subtitle">World & Local History</div>
                                    </div>
                                    <div class="top-item-value">167</div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-3" style="font-weight: 600;">Peak Usage Hours</h6>
                            <div class="chart-container" style="height: 250px;">
                                <canvas id="hourlyUsageChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Acquisition Report Tab -->
                <div class="tab-content" id="acquisition">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="chart-container">
                                <canvas id="acquisitionChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <div class="col-md-4">
                            <div class="quick-stat">
                                <span class="quick-stat-label">Total Acquisitions</span>
                                <span class="quick-stat-value">156 items</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="quick-stat">
                                <span class="quick-stat-label">Total Budget Spent</span>
                                <span class="quick-stat-value">₱284,500</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="quick-stat">
                                <span class="quick-stat-label">Average Cost per Item</span>
                                <span class="quick-stat-value">₱1,824</span>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="report-table">
                            <thead>
                                <tr>
                                    <th>Acquisition Date</th>
                                    <th>Title</th>
                                    <th>Author/Publisher</th>
                                    <th>Category</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total Cost</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Oct 28, 2025</td>
                                    <td><strong>Database Systems Concepts</strong></td>
                                    <td>McGraw-Hill Education</td>
                                    <td>Computer Science</td>
                                    <td>5</td>
                                    <td>₱2,450</td>
                                    <td>₱12,250</td>
                                </tr>
                                <tr>
                                    <td>Oct 25, 2025</td>
                                    <td><strong>Modern Physics</strong></td>
                                    <td>Pearson Education</td>
                                    <td>Science</td>
                                    <td>3</td>
                                    <td>₱1,890</td>
                                    <td>₱5,670</td>
                                </tr>
                                <tr>
                                    <td>Oct 22, 2025</td>
                                    <td><strong>Business Analytics</strong></td>
                                    <td>Wiley Publishers</td>
                                    <td>Business</td>
                                    <td>4</td>
                                    <td>₱2,150</td>
                                    <td>₱8,600</td>
                                </tr>
                                <tr>
                                    <td>Oct 20, 2025</td>
                                    <td><strong>World Literature Anthology</strong></td>
                                    <td>Oxford University Press</td>
                                    <td>Literature</td>
                                    <td>6</td>
                                    <td>₱1,650</td>
                                    <td>₱9,900</td>
                                </tr>
                                <tr>
                                    <td>Oct 18, 2025</td>
                                    <td><strong>Organic Chemistry</strong></td>
                                    <td>Cengage Learning</td>
                                    <td>Science</td>
                                    <td>4</td>
                                    <td>₱2,280</td>
                                    <td>₱9,120</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- User Analytics Tab -->
                <div class="tab-content" id="users">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <div class="chart-container">
                                <canvas id="userAnalyticsChart"></canvas>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6 class="mb-3" style="font-weight: 600;">User Statistics</h6>
                            <div class="quick-stat">
                                <span class="quick-stat-label">Total Active Users</span>
                                <span class="quick-stat-value">892</span>
                            </div>
                            <div class="quick-stat">
                                <span class="quick-stat-label">Students</span>
                                <span class="quick-stat-value">689 (77%)</span>
                            </div>
                            <div class="quick-stat">
                                <span class="quick-stat-label">Faculty</span>
                                <span class="quick-stat-value">156 (17%)</span>
                            </div>
                            <div class="quick-stat">
                                <span class="quick-stat-label">Staff</span>
                                <span class="quick-stat-value">47 (6%)</span>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <h6 class="mb-3" style="font-weight: 600;">Top Borrowers</h6>
                            <ul class="top-items-list">
                                <li class="top-item">
                                    <div class="top-item-rank gold">1</div>
                                    <div class="top-item-info">
                                        <div class="top-item-title">Maria Santos</div>
                                        <div class="top-item-subtitle">Student - Computer Science</div>
                                    </div>
                                    <div class="top-item-value">28</div>
                                </li>
                                <li class="top-item">
                                    <div class="top-item-rank silver">2</div>
                                    <div class="top-item-info">
                                        <div class="top-item-title">John Dela Cruz</div>
                                        <div class="top-item-subtitle">Faculty - Engineering</div>
                                    </div>
                                    <div class="top-item-value">24</div>
                                </li>
                                <li class="top-item">
                                    <div class="top-item-rank bronze">3</div>
                                    <div class="top-item-info">
                                        <div class="top-item-title">Anna Reyes</div>
                                        <div class="top-item-subtitle">Student - Business</div>
                                    </div>
                                    <div class="top-item-value">22</div>
                                </li>
                                <li class="top-item">
                                    <div class="top-item-rank">4</div>
                                    <div class="top-item-info">
                                        <div class="top-item-title">Pedro Garcia</div>
                                        <div class="top-item-subtitle">Student - Literature</div>
                                    </div>
                                    <div class="top-item-value">19</div>
                                </li>
                                <li class="top-item">
                                    <div class="top-item-rank">5</div>
                                    <div class="top-item-info">
                                        <div class="top-item-title">Lisa Mendoza</div>
                                        <div class="top-item-subtitle">Staff - Library</div>
                                    </div>
                                    <div class="top-item-value">17</div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-3" style="font-weight: 600;">User Engagement Metrics</h6>
                            <div class="summary-item">
                                <span class="summary-label">Average Visits per User</span>
                                <span class="summary-value">8.5 visits/month</span>
                            </div>
                            <div class="summary-item">
                                <span class="summary-label">Average Books per User</span>
                                <span class="summary-value">3.2 books/month</span>
                            </div>
                            <div class="summary-item">
                                <span class="summary-label">Return Rate</span>
                                <span class="summary-value">95.4%</span>
                            </div>
                            <div class="summary-item">
                                <span class="summary-label">On-Time Returns</span>
                                <span class="summary-value">87.8%</span>
                            </div>
                            <div class="summary-item">
                                <span class="summary-label">Member Satisfaction</span>
                                <span class="summary-value">4.6/5.0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Reports Section -->
    <div class="row g-3 mb-4">
        <div class="col-xl-6">
            <div class="report-card">
                <div class="section-header">
                    <h5>Monthly Comparison</h5>
                </div>
                <div class="chart-container" style="height: 250px;">
                    <canvas id="monthlyComparisonChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="report-card">
                <div class="section-header">
                    <h5>Collection Growth</h5>
                </div>
                <div class="chart-container" style="height: 250px;">
                    <canvas id="collectionGrowthChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Reports -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="report-card" style="cursor: pointer; transition: all 0.3s;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.15)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.1)';" onclick="openModal('overdueModal')">
                <div style="text-align: center;">
                    <i class="ri-file-chart-line" style="font-size: 32px; color: #4a90e2; margin-bottom: 10px;"></i>
                    <h6 style="font-weight: 600; margin-bottom: 5px;">Overdue Report</h6>
                    <p style="font-size: 12px; color: #6c757d; margin: 0;">View all overdue items</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="report-card" style="cursor: pointer; transition: all 0.3s;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.15)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.1)';" onclick="openModal('reservationModal')">
                <div style="text-align: center;">
                    <i class="ri-calendar-check-line" style="font-size: 32px; color: #27ae60; margin-bottom: 10px;"></i>
                    <h6 style="font-weight: 600; margin-bottom: 5px;">Reservation Report</h6>
                    <p style="font-size: 12px; color: #6c757d; margin: 0;">Active reservations</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="report-card" style="cursor: pointer; transition: all 0.3s;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.15)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.1)';" onclick="openModal('fineModal')">
                <div style="text-align: center;">
                    <i class="ri-money-dollar-circle-line" style="font-size: 32px; color: #f39c12; margin-bottom: 10px;"></i>
                    <h6 style="font-weight: 600; margin-bottom: 5px;">Fine Collection</h6>
                    <p style="font-size: 12px; color: #6c757d; margin: 0;">Revenue from fines</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="report-card" style="cursor: pointer; transition: all 0.3s;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.15)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.1)';" onclick="openModal('trendModal')">
                <div style="text-align: center;">
                    <i class="ri-line-chart-line" style="font-size: 32px; color: #8e44ad; margin-bottom: 10px;"></i>
                    <h6 style="font-weight: 600; margin-bottom: 5px;">Trend Analysis</h6>
                    <p style="font-size: 12px; color: #6c757d; margin: 0;">Usage patterns & trends</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <!-- Overdue Report Modal -->
    <div id="overdueModal" class="modal-overlay" onclick="closeModal('overdueModal')">
        <div class="modal-content" onclick="event.stopPropagation()">
            <div class="modal-header">
                <h5><i class="ri-file-chart-line"></i> Overdue Report</h5>
                <button class="modal-close" onclick="closeModal('overdueModal')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <div class="quick-stat">
                            <span class="quick-stat-label">Total Overdue Items</span>
                            <span class="quick-stat-value" style="color: #e74c3c;">24</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="quick-stat">
                            <span class="quick-stat-label">Total Fines</span>
                            <span class="quick-stat-value" style="color: #f39c12;">₱2,450</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="quick-stat">
                            <span class="quick-stat-label">Avg Days Overdue</span>
                            <span class="quick-stat-value">8 days</span>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="report-table">
                        <thead>
                            <tr>
                                <th>Borrower</th>
                                <th>Book Title</th>
                                <th>Due Date</th>
                                <th>Days Overdue</th>
                                <th>Fine Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>John Doe</strong><br><small>Student ID: 2021-00123</small></td>
                                <td>Clean Code</td>
                                <td>Oct 15, 2025</td>
                                <td><span style="color: #e74c3c; font-weight: 600;">17 days</span></td>
                                <td>₱170</td>
                                <td><span class="stat-badge low">Overdue</span></td>
                            </tr>
                            <tr>
                                <td><strong>Maria Santos</strong><br><small>Student ID: 2021-00456</small></td>
                                <td>Design Patterns</td>
                                <td>Oct 20, 2025</td>
                                <td><span style="color: #e74c3c; font-weight: 600;">12 days</span></td>
                                <td>₱120</td>
                                <td><span class="stat-badge low">Overdue</span></td>
                            </tr>
                            <tr>
                                <td><strong>Pedro Garcia</strong><br><small>Faculty ID: FAC-2019-089</small></td>
                                <td>Artificial Intelligence</td>
                                <td>Oct 22, 2025</td>
                                <td><span style="color: #e74c3c; font-weight: 600;">10 days</span></td>
                                <td>₱100</td>
                                <td><span class="stat-badge low">Overdue</span></td>
                            </tr>
                            <tr>
                                <td><strong>Anna Reyes</strong><br><small>Student ID: 2022-00234</small></td>
                                <td>Database Systems</td>
                                <td>Oct 25, 2025</td>
                                <td><span style="color: #f39c12; font-weight: 600;">7 days</span></td>
                                <td>₱70</td>
                                <td><span class="stat-badge low">Overdue</span></td>
                            </tr>
                            <tr>
                                <td><strong>Lisa Mendoza</strong><br><small>Staff ID: STF-2020-045</small></td>
                                <td>Modern Physics</td>
                                <td>Oct 28, 2025</td>
                                <td><span style="color: #f39c12; font-weight: 600;">4 days</span></td>
                                <td>₱40</td>
                                <td><span class="stat-badge low">Overdue</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Reservation Report Modal -->
    <div id="reservationModal" class="modal-overlay" onclick="closeModal('reservationModal')">
        <div class="modal-content" onclick="event.stopPropagation()">
            <div class="modal-header">
                <h5><i class="ri-calendar-check-line"></i> Reservation Report</h5>
                <button class="modal-close" onclick="closeModal('reservationModal')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <div class="quick-stat">
                            <span class="quick-stat-label">Active Reservations</span>
                            <span class="quick-stat-value" style="color: #4a90e2;">18</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="quick-stat">
                            <span class="quick-stat-label">Ready for Pickup</span>
                            <span class="quick-stat-value" style="color: #27ae60;">7</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="quick-stat">
                            <span class="quick-stat-label">Pending</span>
                            <span class="quick-stat-value" style="color: #f39c12;">11</span>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="report-table">
                        <thead>
                            <tr>
                                <th>Borrower</th>
                                <th>Book Title</th>
                                <th>Reserved Date</th>
                                <th>Expiry Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Carlos Rivera</strong><br><small>Student ID: 2021-00567</small></td>
                                <td>The Pragmatic Programmer</td>
                                <td>Oct 28, 2025</td>
                                <td>Nov 4, 2025</td>
                                <td><span class="stat-badge high">Ready</span></td>
                            </tr>
                            <tr>
                                <td><strong>Sofia Cruz</strong><br><small>Student ID: 2022-00123</small></td>
                                <td>Introduction to Algorithms</td>
                                <td>Oct 29, 2025</td>
                                <td>Nov 5, 2025</td>
                                <td><span class="stat-badge high">Ready</span></td>
                            </tr>
                            <tr>
                                <td><strong>Michael Torres</strong><br><small>Faculty ID: FAC-2020-034</small></td>
                                <td>Business Analytics</td>
                                <td>Oct 30, 2025</td>
                                <td>Nov 6, 2025</td>
                                <td><span class="stat-badge medium">Pending</span></td>
                            </tr>
                            <tr>
                                <td><strong>Elena Flores</strong><br><small>Student ID: 2021-00789</small></td>
                                <td>Organic Chemistry</td>
                                <td>Oct 30, 2025</td>
                                <td>Nov 6, 2025</td>
                                <td><span class="stat-badge medium">Pending</span></td>
                            </tr>
                            <tr>
                                <td><strong>Robert Diaz</strong><br><small>Staff ID: STF-2019-067</small></td>
                                <td>World Literature Anthology</td>
                                <td>Oct 31, 2025</td>
                                <td>Nov 7, 2025</td>
                                <td><span class="stat-badge high">Ready</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Fine Collection Modal -->
    <div id="fineModal" class="modal-overlay" onclick="closeModal('fineModal')">
        <div class="modal-content" onclick="event.stopPropagation()">
            <div class="modal-header">
                <h5><i class="ri-money-dollar-circle-line"></i> Fine Collection Report</h5>
                <button class="modal-close" onclick="closeModal('fineModal')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <div class="quick-stat">
                            <span class="quick-stat-label">Total Collected</span>
                            <span class="quick-stat-value" style="color: #27ae60;">₱8,450</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="quick-stat">
                            <span class="quick-stat-label">Pending Payments</span>
                            <span class="quick-stat-value" style="color: #e74c3c;">₱2,450</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="quick-stat">
                            <span class="quick-stat-label">This Month</span>
                            <span class="quick-stat-value" style="color: #4a90e2;">₱3,200</span>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="report-table">
                        <thead>
                            <tr>
                                <th>Borrower</th>
                                <th>Book Title</th>
                                <th>Fine Amount</th>
                                <th>Payment Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Juan Bautista</strong><br><small>Student ID: 2020-00345</small></td>
                                <td>Clean Architecture</td>
                                <td>₱150</td>
                                <td>Oct 25, 2025</td>
                                <td><span class="stat-badge high">Paid</span></td>
                            </tr>
                            <tr>
                                <td><strong>Carmen Lopez</strong><br><small>Student ID: 2021-00678</small></td>
                                <td>Data Structures</td>
                                <td>₱120</td>
                                <td>Oct 26, 2025</td>
                                <td><span class="stat-badge high">Paid</span></td>
                            </tr>
                            <tr>
                                <td><strong>Ricardo Gomez</strong><br><small>Faculty ID: FAC-2018-012</small></td>
                                <td>Software Engineering</td>
                                <td>₱80</td>
                                <td>Oct 28, 2025</td>
                                <td><span class="stat-badge high">Paid</span></td>
                            </tr>
                            <tr>
                                <td><strong>Maria Santos</strong><br><small>Student ID: 2021-00456</small></td>
                                <td>Design Patterns</td>
                                <td>₱120</td>
                                <td>-</td>
                                <td><span class="stat-badge low">Pending</span></td>
                            </tr>
                            <tr>
                                <td><strong>John Doe</strong><br><small>Student ID: 2021-00123</small></td>
                                <td>Clean Code</td>
                                <td>₱170</td>
                                <td>-</td>
                                <td><span class="stat-badge low">Pending</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Trend Analysis Modal -->
    <div id="trendModal" class="modal-overlay" onclick="closeModal('trendModal')">
        <div class="modal-content" onclick="event.stopPropagation()">
            <div class="modal-header">
                <h5><i class="ri-line-chart-line"></i> Trend Analysis</h5>
                <button class="modal-close" onclick="closeModal('trendModal')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <div class="quick-stat">
                            <span class="quick-stat-label">Circulation Activity</span>
                            <span class="quick-stat-value" style="color: #27ae60;">+12% <i class="ri-arrow-up-line"></i></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="quick-stat">
                            <span class="quick-stat-label">New Registrations</span>
                            <span class="quick-stat-value" style="color: #27ae60;">+8% <i class="ri-arrow-up-line"></i></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="quick-stat">
                            <span class="quick-stat-label">Digital Resource Usage</span>
                            <span class="quick-stat-value" style="color: #27ae60;">+18% <i class="ri-arrow-up-line"></i></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="quick-stat">
                            <span class="quick-stat-label">Return Rates</span>
                            <span class="quick-stat-value" style="color: #27ae60;">+3% <i class="ri-arrow-up-line"></i></span>
                        </div>
                    </div>
                </div>

                <h6 class="mb-3" style="font-weight: 600;">Popular Categories Trend</h6>
                <div class="summary-item">
                    <span class="summary-label">Computer Science</span>
                    <span class="summary-value">342 checkouts</span>
                </div>
                <div class="progress-bar-container">
                    <div class="progress-bar" style="width: 85%;"></div>
                </div>

                <div class="summary-item mt-3">
                    <span class="summary-label">Business & Economics</span>
                    <span class="summary-value">289 checkouts</span>
                </div>
                <div class="progress-bar-container">
                    <div class="progress-bar" style="width: 72%; background: #27ae60;"></div>
                </div>

                <div class="summary-item mt-3">
                    <span class="summary-label">Literature</span>
                    <span class="summary-value">256 checkouts</span>
                </div>
                <div class="progress-bar-container">
                    <div class="progress-bar" style="width: 64%; background: #f39c12;"></div>
                </div>

                <div class="summary-item mt-3">
                    <span class="summary-label">Science</span>
                    <span class="summary-value">198 checkouts</span>
                </div>
                <div class="progress-bar-container">
                    <div class="progress-bar" style="width: 49%; background: #8e44ad;"></div>
                </div>

                <div class="summary-item mt-3">
                    <span class="summary-label">History</span>
                    <span class="summary-value">167 checkouts</span>
                </div>
                <div class="progress-bar-container">
                    <div class="progress-bar" style="width: 42%; background: #e74c3c;"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Tab functionality
    function switchTab(tabName) {
        // Remove active class from all tabs
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
        
        // Add active class to clicked tab
        event.target.closest('.tab-btn').classList.add('active');
        document.getElementById(tabName).classList.add('active');
    }

    // Circulation Chart
    const circulationCtx = document.getElementById('circulationChart').getContext('2d');
    new Chart(circulationCtx, {
        type: 'line',
        data: {
            labels: ['Aug', 'Sep', 'Oct', 'Nov'],
            datasets: [{
                label: 'Checkouts',
                data: [980, 1120, 1050, 1245],
                borderColor: '#4a90e2',
                backgroundColor: 'rgba(74, 144, 226, 0.1)',
                tension: 0.4,
                fill: true
            }, {
                label: 'Returns',
                data: [945, 1089, 1023, 1189],
                borderColor: '#27ae60',
                backgroundColor: 'rgba(39, 174, 96, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Usage Chart (Doughnut)
    const usageCtx = document.getElementById('usageChart').getContext('2d');
    new Chart(usageCtx, {
        type: 'doughnut',
        data: {
            labels: ['Physical Books', 'E-Books', 'Reference Materials'],
            datasets: [{
                data: [68, 22, 10],
                backgroundColor: ['#4a90e2', '#27ae60', '#f39c12'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });

    // Hourly Usage Chart
    const hourlyUsageCtx = document.getElementById('hourlyUsageChart').getContext('2d');
    new Chart(hourlyUsageCtx, {
        type: 'bar',
        data: {
            labels: ['8AM', '9AM', '10AM', '11AM', '12PM', '1PM', '2PM', '3PM', '4PM', '5PM'],
            datasets: [{
                label: 'Visitors',
                data: [45, 78, 92, 105, 89, 67, 98, 112, 87, 56],
                backgroundColor: '#4a90e2',
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Acquisition Chart
    const acquisitionCtx = document.getElementById('acquisitionChart').getContext('2d');
    new Chart(acquisitionCtx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            datasets: [{
                label: 'New Acquisitions',
                data: [89, 76, 102, 95, 118, 87, 94, 108, 121, 156],
                backgroundColor: '#27ae60',
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // User Analytics Chart
    const userAnalyticsCtx = document.getElementById('userAnalyticsChart').getContext('2d');
    new Chart(userAnalyticsCtx, {
        type: 'line',
        data: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
            datasets: [{
                label: 'Students',
                data: [645, 672, 689, 689],
                borderColor: '#4a90e2',
                backgroundColor: 'rgba(74, 144, 226, 0.1)',
                tension: 0.4,
                fill: true
            }, {
                label: 'Faculty',
                data: [142, 148, 153, 156],
                borderColor: '#8e44ad',
                backgroundColor: 'rgba(142, 68, 173, 0.1)',
                tension: 0.4,
                fill: true
            }, {
                label: 'Staff',
                data: [43, 45, 46, 47],
                borderColor: '#f39c12',
                backgroundColor: 'rgba(243, 156, 18, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Monthly Comparison Chart
    const monthlyComparisonCtx = document.getElementById('monthlyComparisonChart').getContext('2d');
    new Chart(monthlyComparisonCtx, {
        type: 'bar',
        data: {
            labels: ['Aug', 'Sep', 'Oct', 'Nov'],
            datasets: [{
                label: '2024',
                data: [890, 945, 912, 0],
                backgroundColor: '#e9ecef',
                borderRadius: 4
            }, {
                label: '2025',
                data: [980, 1120, 1050, 1245],
                backgroundColor: '#4a90e2',
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Collection Growth Chart
    const collectionGrowthCtx = document.getElementById('collectionGrowthChart').getContext('2d');
    new Chart(collectionGrowthCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov'],
            datasets: [{
                label: 'Total Collection',
                data: [12450, 12539, 12641, 12736, 12854, 12941, 13035, 13143, 13264, 13420, 13576],
                borderColor: '#27ae60',
                backgroundColor: 'rgba(39, 174, 96, 0.1)',
                tension: 0.4,
                fill: true,
                pointRadius: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: false
                }
            }
        }
    });
    
    // Modal functions
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }

    // Close modal on ESC key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const activeModals = document.querySelectorAll('.modal-overlay.active');
            activeModals.forEach(modal => {
                modal.classList.remove('active');
            });
            document.body.style.overflow = '';
        }
    });
</script>
@endsection