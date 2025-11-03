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
    
    .add-new-btn {
        background: #4a90e2;
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 5px;
        font-size: 14px;
        text-decoration: none;
        display: inline-block;
    }
    
    .add-new-btn:hover {
        background: #357abd;
        color: white;
    }
    
    .table-responsive {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .chart-container {
        position: relative;
        background: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        height: 100%;
    }

    .chart-container #borrowingTrendsChart {
        width: 100% !important;
        height: 250px !important;
    }

    .chart-container #finesChart {
        width: 100% !important;
        height: 325px !important;
    }

    .chart-container #patronDemographicsChart {
        width: 100% !important;
        height: 270px !important;
    }
    
    .table-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .filter-control {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
    }
    
    .filter-control select {
        padding: 5px 10px;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        font-size: 14px;
    }
    
    .trend-badge {
        padding: 3px 10px;
        border-radius: 15px;
        font-size: 11px;
        font-weight: 600;
    }
    
    .trend-up {
        background: #d1f4e0;
        color: #0f5132;
    }
    
    .trend-down {
        background: #ffe5e5;
        color: #c92a2a;
    }
    
    .progress-bar-custom {
        height: 8px;
        border-radius: 10px;
        background: #e9ecef;
        overflow: hidden;
    }
    
    .progress-fill {
        height: 100%;
        background: #4a90e2;
        border-radius: 10px;
    }
    
    .stat-card {
        background: white;
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 15px;
    }
    
    .stat-card h6 {
        font-size: 13px;
        color: #6c757d;
        margin-bottom: 8px;
    }
    
    .stat-card .value {
        font-size: 24px;
        font-weight: 700;
        color: #2c3e50;
    }
    
    .stat-card .subtext {
        font-size: 12px;
        color: #6c757d;
        margin-top: 5px;
    }
</style>
@endsection

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="mb-0">Reporting & Analytics</h4>
            <p class="text-muted mb-0">Real-time dashboards and comprehensive data analysis</p>
        </div>
    </div>

    <!-- Dashboard Cards -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="icon-circle">
                    <i class="ri-line-chart-line"></i>
                </div>
                <h2>3,542</h2>
                <p>Total Borrowing (This Month)</p>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="icon-circle">
                    <i class="ri-stack-line"></i>
                </div>
                <h2>12,847</h2>
                <p>Total Inventory Items</p>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="icon-circle">
                    <i class="ri-money-dollar-circle-line"></i>
                </div>
                <h2>₱8,450</h2>
                <p>Fines Collected (This Month)</p>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="icon-circle">
                    <i class="ri-trophy-line"></i>
                </div>
                <h2>156</h2>
                <p>Most Popular Book (Borrows)</p>
            </div>
        </div>
    </div>

    <!-- Borrowing Statistics & Inventory Reports -->
    <div class="row g-3 mb-4">
        <div class="col-xl-8">
            <div class="chart-container">
                <div class="section-header">
                    <h5>Borrowing Statistics - Trends & Patterns</h5>
                    <div class="filter-control">
                        <select>
                            <option>Last 7 Days</option>
                            <option>Last 30 Days</option>
                            <option>Last 3 Months</option>
                            <option>Last 6 Months</option>
                            <option>This Year</option>
                        </select>
                    </div>
                </div>
                <canvas id="borrowingTrendsChart"></canvas>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="table-responsive" style="height: 350px; overflow-y: auto;">
                <div class="section-header">
                    <h5>Inventory by Category</h5>
                </div>
                <div class="stat-card">
                    <h6>Computer Science</h6>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="value">2,450</span>
                        <span class="text-muted small">19%</span>
                    </div>
                    <div class="progress-bar-custom">
                        <div class="progress-fill" style="width: 19%;"></div>
                    </div>
                </div>
                <div class="stat-card">
                    <h6>Engineering</h6>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="value">1,890</span>
                        <span class="text-muted small">14.7%</span>
                    </div>
                    <div class="progress-bar-custom">
                        <div class="progress-fill" style="width: 14.7%; background: #27ae60;"></div>
                    </div>
                </div>
                <div class="stat-card">
                    <h6>Business & Management</h6>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="value">1,623</span>
                        <span class="text-muted small">12.6%</span>
                    </div>
                    <div class="progress-bar-custom">
                        <div class="progress-fill" style="width: 12.6%; background: #f39c12;"></div>
                    </div>
                </div>
                <div class="stat-card">
                    <h6>Medicine & Health</h6>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="value">1,421</span>
                        <span class="text-muted small">11.1%</span>
                    </div>
                    <div class="progress-bar-custom">
                        <div class="progress-fill" style="width: 11.1%; background: #e74c3c;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fines Summary & Popular Books -->
    <div class="row g-3 mb-4">
        <div class="col-xl-4">
            <div class="chart-container">
                <div class="section-header">
                    <h5>Fines Collection Summary</h5>
                </div>
                <canvas id="finesChart"></canvas>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="table-responsive">
                <div class="section-header">
                    <h5>Popular Books - Most Borrowed</h5>
                    <div class="filter-control">
                        <select>
                            <option>This Month</option>
                            <option>Last 3 Months</option>
                            <option>This Year</option>
                            <option>All Time</option>
                        </select>
                    </div>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>Book Title</th>
                            <th>Author</th>
                            <th>Total Borrows</th>
                            <th>Trend</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>1</strong></td>
                            <td>
                                <div class="fw-bold">Clean Code: A Handbook</div>
                                <small class="text-muted">ISBN: 978-0132350884</small>
                            </td>
                            <td>Robert C. Martin</td>
                            <td><strong>156</strong></td>
                            <td><span class="trend-badge trend-up">↑ 12%</span></td>
                        </tr>
                        <tr>
                            <td><strong>2</strong></td>
                            <td>
                                <div class="fw-bold">Introduction to Algorithms</div>
                                <small class="text-muted">ISBN: 978-0262033848</small>
                            </td>
                            <td>Cormen, Leiserson</td>
                            <td><strong>142</strong></td>
                            <td><span class="trend-badge trend-up">↑ 8%</span></td>
                        </tr>
                        <tr>
                            <td><strong>3</strong></td>
                            <td>
                                <div class="fw-bold">Database Systems Concepts</div>
                                <small class="text-muted">ISBN: 978-0073523323</small>
                            </td>
                            <td>Silberschatz, Korth</td>
                            <td><strong>138</strong></td>
                            <td><span class="trend-badge trend-down">↓ 3%</span></td>
                        </tr>
                        <tr>
                            <td><strong>4</strong></td>
                            <td>
                                <div class="fw-bold">Design Patterns</div>
                                <small class="text-muted">ISBN: 978-0201633610</small>
                            </td>
                            <td>Gang of Four</td>
                            <td><strong>125</strong></td>
                            <td><span class="trend-badge trend-up">↑ 15%</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Author Trends & Patron Demographics -->
    <div class="row g-3 mb-4">
        <div class="col-xl-6">
            <div class="table-responsive">
                <div class="section-header">
                    <h5>Author Trends - Most Popular</h5>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Author Name</th>
                            <th>Books in Library</th>
                            <th>Total Borrows</th>
                            <th>Avg. Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Robert C. Martin</strong></td>
                            <td>8</td>
                            <td>342</td>
                            <td>
                                <span class="text-warning">★★★★★</span>
                                <small class="text-muted">4.8</small>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Thomas H. Cormen</strong></td>
                            <td>5</td>
                            <td>298</td>
                            <td>
                                <span class="text-warning">★★★★★</span>
                                <small class="text-muted">4.7</small>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Martin Fowler</strong></td>
                            <td>12</td>
                            <td>276</td>
                            <td>
                                <span class="text-warning">★★★★★</span>
                                <small class="text-muted">4.6</small>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Donald Knuth</strong></td>
                            <td>6</td>
                            <td>245</td>
                            <td>
                                <span class="text-warning">★★★★★</span>
                                <small class="text-muted">4.9</small>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Donald Knuth</strong></td>
                            <td>6</td>
                            <td>245</td>
                            <td>
                                <span class="text-warning">★★★★★</span>
                                <small class="text-muted">4.9</small>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="chart-container">
                <div class="section-header">
                    <h5>Patron Demographics by Department</h5>
                </div>
                <canvas id="patronDemographicsChart"></canvas>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Borrowing Trends Chart
    const borrowingCtx = document.getElementById('borrowingTrendsChart').getContext('2d');
    const borrowingChart = new Chart(borrowingCtx, {
        type: 'line',
        data: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5', 'Week 6', 'Week 7'],
            datasets: [{
                label: 'Borrowed',
                data: [245, 312, 278, 356, 298, 389, 412],
                borderColor: '#4a90e2',
                backgroundColor: 'rgba(74, 144, 226, 0.1)',
                tension: 0.4,
                fill: true
            }, {
                label: 'Returned',
                data: [198, 276, 245, 312, 267, 334, 378],
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
                    position: 'bottom',
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Fines Chart
    const finesCtx = document.getElementById('finesChart').getContext('2d');
    const finesChart = new Chart(finesCtx, {
        type: 'doughnut',
        data: {
            labels: ['Collected', 'Pending', 'Waived'],
            datasets: [{
                data: [8450, 2350, 890],
                backgroundColor: ['#27ae60', '#f39c12', '#95a5a6'],
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

    // Patron Demographics Chart
    const patronCtx = document.getElementById('patronDemographicsChart').getContext('2d');
    const patronChart = new Chart(patronCtx, {
        type: 'bar',
        data: {
            labels: ['Computer Science', 'Engineering', 'Business', 'Medicine', 'Arts', 'Education'],
            datasets: [{
                label: 'Active Patrons',
                data: [542, 438, 389, 312, 245, 198],
                backgroundColor: '#4a90e2',
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            indexAxis: 'y',
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection