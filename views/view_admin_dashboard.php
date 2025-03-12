<?php
include '../controllers/admin_dashboard.php';
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
    <link href="../css/admin_dashboard.css" rel="stylesheet">
    <link href="../css/navbar.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <!-- Sidebar -->
    <?php include '../include/sidebar.php'; ?>

    <!-- Navbar -->
    <?php include '../include/navbar.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <h2>Admin Dashboard Overview</h2>

        <!-- Key Metrics -->
        <div class="metrics">
            <div class="metric-card">
                <h3>Total PWD Registrations</h3>
                <p><?php echo $admin_stats['total_pwd_registrations']; ?></p>
            </div>
            <div class="metric-card">
                <h3>Total Staff</h3>
                <p><?php echo $admin_stats['total_staff']; ?></p>
            </div>
            <div class="metric-card">
                <h3>Active Staff</h3>
                <p><?php echo $admin_stats['active_staff']; ?></p>
            </div>
            <div class="metric-card">
                <h3>Total Job Postings</h3>
                <p><?php echo $admin_stats['total_jobs']; ?></p>
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
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true } } }
        });

        // Staff Activity Chart
        new Chart(document.getElementById('staffActivityChart'), {
            type: 'pie',
            data: {
                labels: ['Active Staff', 'Inactive Staff'],
                datasets: [{
                    data: [
                        <?php echo $admin_stats['active_staff']; ?>, 
                        <?php echo $admin_stats['total_staff'] - $admin_stats['active_staff']; ?>
                    ],
                    backgroundColor: ['#50C878', '#FF6B6B'],
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } }
        });

        // Job Postings Trend Chart
        new Chart(document.getElementById('jobPostingsChart'), {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(array_keys($jobPostings)); ?>,
                datasets: [{
                    label: 'Job Postings',
                    data: <?php echo json_encode(array_values($jobPostings)); ?>,
                    backgroundColor: '#F39C12',
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true } } }
        });
    });
    </script>
</body>
</html>
