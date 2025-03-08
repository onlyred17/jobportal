<?php include '../controllers/employer_dashboard.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employer Dashboard - PWD Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="../css/sidebar.css" rel="stylesheet">
    <link href="../css/dark_mode.css" rel="stylesheet">
    <link href="../css/employer_dashboard.css" rel="stylesheet">
    <link href="../css/navbar.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Add the updated CSS here */
    </style>
</head>
<body>
    <!-- Sidebar -->
    <?php include '../include/sidebar.php'; ?>

    <!-- Navbar -->
    <?php include '../include/navbar.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <h2>Dashboard Overview</h2>

        <!-- Key Metrics -->
        <div class="metrics">
            <div class="metric-card">
                <h3>Total Jobs Posted</h3>
                <p><?php echo isset($total_jobs) ? $total_jobs : 0; ?></p>
            </div>
            <div class="metric-card">
                <h3>Total Jobs Posted by You</h3>
                <p><?php echo isset($employer_jobs) ? $employer_jobs : 0; ?></p>
            </div>
            <div class="metric-card">
                <h3>Active Jobs</h3>
                <p><?php echo isset($active_jobs) ? $active_jobs : 0; ?></p>
            </div>
            <div class="metric-card">
                <h3>Closed Jobs</h3>
                <p><?php echo isset($closed_jobs) ? $closed_jobs : 0; ?></p>
            </div>
        </div>

        <!-- Comparison Graphs -->
        <div class="graphs">
            <div class="graph-container">
                <h3>Jobs Posted</h3>
                <canvas id="companyVsYouChart"></canvas>
            </div>
            <div class="graph-container">
                <h3>Job Status</h3>
                <canvas id="activeVsClosedChart"></canvas>
            </div>
            <div class="graph-container">
                <h3>Jobs Posted (Monthly)</h3>
                <canvas id="jobsChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Comparison: Company Jobs vs. Your Jobs
        const companyVsYouChart = new Chart(document.getElementById('companyVsYouChart'), {
            type: 'bar',
            data: {
                labels: ['Posted by Company', 'Posted by You'],
                datasets: [{
                    label: 'Jobs Posted',
                    data: [<?php echo $total_jobs; ?>, <?php echo $employer_jobs; ?>],
                    backgroundColor: ['#4A90E2', '#50C878'],
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

        // Comparison: Active Jobs vs. Closed Jobs
        const activeVsClosedChart = new Chart(document.getElementById('activeVsClosedChart'), {
            type: 'bar',
            data: {
                labels: ['Active Jobs', 'Closed Jobs'],
                datasets: [{
                    label: 'Jobs',
                    data: [<?php echo $active_jobs; ?>, <?php echo $closed_jobs; ?>],
                    backgroundColor: ['#4A90E2', '#FF6B6B'],
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

        // Monthly Jobs Chart
        const jobsChart = new Chart(document.getElementById('jobsChart'), {
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
    </script>
</body>
</html>