<?php
include '../controllers/staff_dashboard.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard - PWD Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="../css/sidebar.css" rel="stylesheet">
    <link href="../css/employer_dashboard.css" rel="stylesheet">
    <link href="../css/navbar.css" rel="stylesheet">
    <link href="../css/staff_dashboard.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <!-- Sidebar -->
    <?php include '../include/sidebar.php'; ?>

    <!-- Navbar -->
    <?php include '../include/navbar.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="dashboard-container">
            <!-- Left Content (Metrics and Charts) -->
            <div class="dashboard-main">
                <h2>Dashboard Overview</h2>

                <!-- Key Metrics -->
                <div class="metrics">
                    <div class="metric-card">
                        <h3>Total Jobs Posted</h3>
                        <p><?php echo isset($job_stats['total_jobs']) ? $job_stats['total_jobs'] : 0; ?></p>
                    </div>
                    <div class="metric-card">
                        <h3>Active Jobs</h3>
                        <p><?php echo isset($job_stats['active_jobs']) ? $job_stats['active_jobs'] : 0; ?></p>
                    </div>
                    <div class="metric-card">
                        <h3>Closed Jobs</h3>
                        <p><?php echo isset($job_stats['closed_jobs']) ? $job_stats['closed_jobs'] : 0; ?></p>
                    </div>
                    <div class="metric-card">
                        <h3>Jobs Posted by You</h3>
                        <p><?php echo isset($staff_jobs) ? count($staff_jobs) : 0; ?></p>
                    </div>
                </div>

                <!-- Comparison Graphs -->
                <div class="graphs">
                    <div class="graph-container">
                        <h3>Jobs Posted</h3>
                        <canvas id="jobsComparisonChart"></canvas>
                    </div>
                    <div class="graph-container">
                        <h3>Job Status</h3>
                        <canvas id="activeVsClosedChart"></canvas>
                    </div>
                    <div class="graph-container">
                        <h3>Jobs Posted (Monthly)</h3>
                        <canvas id="monthlyJobsChart"></canvas>
                    </div>
                </div>

                <!-- Additional Graphs -->
                <div class="graphs">
                    <div class="graph-container">
                        <h3>Jobs Posted (Weekly)</h3>
                        <canvas id="weeklyJobsChart"></canvas>
                    </div>
                    <div class="graph-container">
                        <h3>Jobs Posted (Daily)</h3>
                        <canvas id="dailyJobsChart"></canvas>
                    </div>
                </div>
            </div>
            
            <!-- Right Sidebar (Recent Posts) -->
            <div class="dashboard-sidebar">
                <div class="recent-posts-container">
                    <h3><i class="fas fa-clipboard-list"></i> Your Recent Job Posts</h3>
                    
                    <?php if (isset($recent_jobs) && !empty($recent_jobs)): ?>
                        <div class="recent-posts-list">
                            <?php foreach ($recent_jobs as $job): ?>
                                <div class="recent-post-item">
                                    <h4><?php echo $job['title']; ?></h4>
                                    <div class="post-meta">
                                        <span class="company"><i class="fas fa-building"></i> <?php echo $job['company_name']; ?></span>
                                        <span class="date"><i class="fas fa-calendar-alt"></i> <?php echo date('M d, Y', strtotime($job['posted_date'])); ?></span>
                                        </div>
                                    <div class="post-status <?php echo strtolower($job['status']); ?>">
                                        <i class="fas fa-circle"></i> <?php echo $job['status']; ?>
                                    </div>
                                    <p class="post-excerpt"><?php echo substr($job['description'], 0, 100) . '...'; ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="no-posts">
                            <i class="fas fa-info-circle"></i>
                            <p>No recent job posts available.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Jobs Posted Comparison Chart (Total Jobs vs Jobs Posted by You vs Jobs Posted by Others)
        const jobsComparisonChart = new Chart(document.getElementById('jobsComparisonChart'), {
            type: 'bar',
            data: {
                labels: ['Total Jobs', 'Posted by You', 'Posted by Others'],
                datasets: [{
                    label: 'Jobs',
                    data: [
                        <?php echo $job_stats['total_jobs']; ?>, 
                        <?php echo count($staff_jobs); ?>, 
                        <?php echo $jobs_posted_by_others; ?>
                    ],
                    backgroundColor: ['#4A90E2', '#50C878', '#FF6B6B'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                },
                plugins: {
                    legend: {
                        display: false,
                    }
                }
            }
        });

        // Job Status Chart (Active vs. Closed)
        const activeVsClosedChart = new Chart(document.getElementById('activeVsClosedChart'), {
            type: 'pie',
            data: {
                labels: ['Open Jobs', 'Closed Jobs'],
                datasets: [{
                    label: 'Jobs',
                    data: [<?php echo $job_stats['active_jobs']; ?>, <?php echo $job_stats['closed_jobs']; ?>],
                    backgroundColor: ['#50C878', '#FF6B6B'],
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

        // Monthly Jobs Chart
        const monthlyJobsChart = new Chart(document.getElementById('monthlyJobsChart'), {
            type: 'line',
            data: {
                labels: <?php echo json_encode($months); ?>,
                datasets: [{
                    label: 'Jobs Posted',
                    data: <?php echo json_encode(array_values($jobsPosted)); ?>,
                    borderColor: '#4A90E2',
                    fill: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                }
            }
        });

        // Weekly Jobs Chart
        const weeklyJobsChart = new Chart(document.getElementById('weeklyJobsChart'), {
            type: 'line',
            data: {
                labels: <?php echo json_encode($weeks); ?>, // Weeks
                datasets: [{
                    label: 'Jobs Posted',
                    data: <?php echo json_encode(array_values($jobsPostedWeekly)); ?>, // Job counts
                    borderColor: '#F39C12',
                    fill: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                }
            }
        });

        // Daily Jobs Chart
        const dailyJobsChart = new Chart(document.getElementById('dailyJobsChart'), {
            type: 'line',
            data: {
                labels: <?php echo json_encode($days); ?>, // Days
                datasets: [{
                    label: 'Jobs Posted',
                    data: <?php echo json_encode(array_values($jobsPostedDaily)); ?>, // Job counts
                    borderColor: '#E74C3C',
                    fill: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                }
            }
        });
    </script>
</body>
</html>