<?php
include '../controllers/admin_dashboard.php';
include '../controllers/fetch_all_activities.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - PWD Portal</title>
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
    <?php include '../include/navbar.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="dashboard-container">
            <!-- Left Content (Metrics & Graphs) -->
            <div class="dashboard-main">
                <h2>Dashboard Overview</h2>

               <!-- Key Metrics -->
               <div class="metrics">
    <div class="metric-card">
        <div class="text">
            <h3>Total PWD <br>Registrations</h3>
            <p><?php echo $admin_stats['total_pwd_registrations']; ?></p>
        </div>
        <div class="icon">
            <i class="fas fa-users"></i>
        </div>
    </div>
    <div class="metric-card">
        <div class="text">
            <h3>Total PESO</h3>
            <p><?php echo $admin_stats['total_staff']; ?></p>
        </div>
        <div class="icon">
            <i class="fas fa-user-tie"></i>
        </div>
    </div>
    <div class="metric-card">
        <div class="text">
            <h3>Active PESO</h3>
            <p><?php echo $admin_stats['active_staff']; ?></p>
        </div>
        <div class="icon">
            <i class="fas fa-user-check"></i>
        </div>
    </div>
    <div class="metric-card">
        <div class="text">
            <h3>Total Job Postings</h3>
            <p><?php echo $admin_stats['total_jobs']; ?></p>
        </div>
        <div class="icon">
            <i class="fas fa-briefcase"></i>
        </div>
    </div>
</div>


                <!-- Graphs -->
                <div class="graphs">
                    <div class="graph-container">
                        <h3>PWD Registrations Over Time</h3>
                        <canvas id="pwdRegistrationsChart"></canvas>
                    </div>
                    <div class="graph-container">
                        <h3>Staff Activity</h3>
                        <canvas id="staffActivityChart"></canvas>
                    </div>
                    <div class="graph-container">
                        <h3>Job Postings Trend</h3>
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
                        <p class="post-excerpt"><?php echo htmlspecialchars(string: $activity['description']); ?></p>
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
        // PWD Registrations Chart
        new Chart(document.getElementById('pwdRegistrationsChart'), {
            type: 'line',
            data: {
                labels: <?php echo json_encode(array_keys($pwdRegistrations)); ?>,
                datasets: [{
                    label: 'PWD Registrations',
                    data: <?php echo json_encode(array_values($pwdRegistrations)); ?>,
                    borderColor: '#4A90E2',
                    backgroundColor: 'rgba(74, 144, 226, 0.2)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true } } }
        });

        // Staff Activity Chart
        new Chart(document.getElementById('staffActivityChart'), {
            type: 'doughnut',
            data: {
                labels: ['Active Staff', 'Inactive Staff'],
                datasets: [{
                    data: [
                        <?php echo $admin_stats['active_staff']; ?>, 
                        <?php echo $admin_stats['total_staff'] - $admin_stats['active_staff']; ?>
                    ],
                    backgroundColor: ['#10B981', '#EF4444'],
                    borderWidth: 0,
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, cutout: '65%' }
        });

        // Job Postings Trend Chart
        new Chart(document.getElementById('jobPostingsChart'), {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(array_keys($jobPostings)); ?>,
                datasets: [{
                    label: 'Job Postings',
                    data: <?php echo json_encode(array_values($jobPostings)); ?>,
                    backgroundColor: '#F59E0B',
                    borderRadius: 4
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true } } }
        });
    });
    </script>
</body>
</html>
