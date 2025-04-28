<?php

include '../controllers/super_admin_dashboard.php';
include '../controllers/fetch_all_activities.php';

// Ensure the session is started

// Check if the user is logged in as super admin
if (!isset($_SESSION['super_admin_id'])) {
    header('Location: ../views/view_super_admin_login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Dashboard - Job Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="../css/sidebar.css" rel="stylesheet">
    <link href="../css/navbar.css" rel="stylesheet">
    <link href="../css/admin_dashboard.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <!-- Sidebar -->
    <?php include '../include/sidebar.php'; ?>

    <!-- Navbar -->
    <?php include '../include/navbar_user.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="dashboard-container">
            <!-- Left Content (Metrics & Graphs) -->
            <div class="dashboard-main">
                <h2>Super Admin Dashboard</h2>

                <!-- Key Metrics -->
                <div class="metrics">
                    <div class="metric-card">
                        <div class="text">
                            <h3>Total PESO</h3>
                            <p><?php echo $super_admin_stats['total_staff']; ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                    </div>
                    <div class="metric-card">
                        <div class="text">
                            <h3>Total PDAO</h3>
                            <p><?php echo $super_admin_stats['total_admins']; ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-shield"></i>
                        </div>
                    </div>
                    <div class="metric-card">
                        <div class="text">
                            <h3>Total Job Postings</h3>
                            <p><?php echo $super_admin_stats['total_jobs']; ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                    </div>
                    <div class="metric-card">
                        <div class="text">
                            <h3>Total Companies</h3>
                            <p><?php echo $super_admin_stats['total_companies']; ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-building"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Additional Metrics for Job Status -->
                <div class="metrics">
                    <div class="metric-card">
                        <div class="text">
                            <h3>Open Jobs</h3>
                            <p><?php echo $super_admin_stats['open_jobs']; ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-door-open"></i>
                        </div>
                    </div>
                    <div class="metric-card">
                        <div class="text">
                            <h3>Closed Jobs</h3>
                            <p><?php echo $super_admin_stats['closed_jobs']; ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-door-closed"></i>
                        </div>
                    </div>
                </div>

                <!-- Graphs -->
                <div class="graphs">
                    <div class="graph-container">
                        <h3>Admin vs Staff Distribution</h3>
                        <canvas id="adminStaffChart"></canvas>
                    </div>
                    <div class="graph-container">
                        <h3>Job Status Distribution</h3>
                        <canvas id="jobStatusChart"></canvas>
                    </div>
                    <div class="graph-container">
                        <h3>Job Postings Timeline</h3>
                        <canvas id="jobPostingsChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar (Recent Activities) -->
            <div class="dashboard-sidebar">
                <div class="recent-posts-container">
                    <h3><i class="fas fa-history"></i> Recent Activities</h3>
                    
                    <?php if (!empty($recent_activities)): ?>
                        <div class="recent-posts-list">
                            <?php foreach ($recent_activities as $activity): ?>
                                <div class="recent-post-item">
                                    <h4><?php echo htmlspecialchars($activity['full_name']); ?> - <?php echo htmlspecialchars($activity['action']); ?></h4>
                                    <div class="post-meta">
                                        <span><i class="far fa-calendar"></i> <?php echo htmlspecialchars($activity['date']); ?></span>
                                        <span><i class="far fa-clock"></i> <?php echo htmlspecialchars($activity['time']); ?></span>
                                    </div>
                                    <div class="post-status <?php echo htmlspecialchars($activity['usertype']); ?>">
                                        <i class="fas fa-circle"></i> <?php echo ucfirst(htmlspecialchars($activity['usertype'])); ?>
                                    </div>
                                    <p class="post-excerpt"><?php echo htmlspecialchars($activity['description']); ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="no-posts">
                            <i class="fas fa-info-circle"></i>
                            <p>No recent activities.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Admin vs Staff Chart
        new Chart(document.getElementById('adminStaffChart'), {
            type: 'pie',
            data: {
                labels: ['Admins', 'Staff'],
                datasets: [{
                    data: [
                        <?php echo $super_admin_stats['total_admins']; ?>, 
                        <?php echo $super_admin_stats['total_staff']; ?>
                    ],
                    backgroundColor: ['#3B82F6', '#F59E0B']
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });

        // Job Status Chart
        new Chart(document.getElementById('jobStatusChart'), {
            type: 'pie',
            data: {
                labels: ['Open Jobs', 'Closed Jobs'],
                datasets: [{
                    data: [
                        <?php echo $super_admin_stats['open_jobs']; ?>, 
                        <?php echo $super_admin_stats['closed_jobs']; ?>
                    ],
                    backgroundColor: ['#10B981', '#EF4444']
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });

        // Job Postings Trend Chart
        new Chart(document.getElementById('jobPostingsChart'), {
            type: 'bar',
            data: {
                labels: ['Daily', 'Weekly', 'Monthly'],
                datasets: [{
                    label: 'Job Postings',
                    data: [
                        <?php echo $super_admin_stats['job_postings']['daily']; ?>,
                        <?php echo $super_admin_stats['job_postings']['weekly']; ?>,
                        <?php echo $super_admin_stats['job_postings']['monthly']; ?>
                    ],
                    backgroundColor: '#10B981',
                    borderRadius: 4
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true } } }
        });
    });
    </script>
</body>
</html>