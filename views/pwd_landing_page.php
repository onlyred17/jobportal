<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PWD Job Portal</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/landing_page.css">
</head>
<body id="body-element">
    <!-- Header -->
    <header>
        <h1>PWD Job Portal</h1>
        <nav>
            <a href="#home">Home</a>
            <a href="#about">About Us</a>
            <a href="#jobs">Jobs</a>
            <a href="../views/pwd_registration.php">Registration</a>
        </nav>
    </header>

    <!-- Hero Section -->
    <div id="home" class="hero-section">
        <h1>Welcome to the PWD Job Portal</h1>
        <p>Find job opportunities tailored for Persons with Disabilities (PWD). Let’s make a difference together.</p>
        <a href="#jobs" class="btn-primary">View Job Listings</a>
    </div>

    <!-- About Us Section -->
    <section id="about">
        <h2>About Us</h2>
        <p>We are dedicated to providing job opportunities for Persons with Disabilities (PWD), connecting employers with candidates who have unique abilities. Our mission is to create an inclusive environment for all individuals seeking meaningful employment.</p>
    </section>

    <!-- Search and Filter Section -->
    <section id="jobs">
        <h2>Job Listings</h2>

        <!-- Search and Filter Bar -->
        <div class="search-filter-container">
            <div class="search-bar">
                <input type="text" id="search-input" placeholder="Search for jobs, location, job type..." oninput="fetchJobs(1)">
            </div>
            <div class="filter-bar">
                <select id="job-type" onchange="fetchJobs(1)">
                    <option value="">All Job Types</option>
                    <option value="Full-time">Full-time</option>
                    <option value="Part-time">Part-time</option>
                    <option value="Remote">Remote</option>
                </select>
            </div>
        </div>

        <!-- Job Cards -->
        <div class="job-cards" id="job-cards-container">
            <!-- Job cards will be dynamically populated here by JavaScript -->
        </div>

        <!-- Pagination Controls -->
        <div id="pagination">
            <button id="prev-btn" onclick="fetchJobs(currentPage - 1)">Previous</button>
            <span id="page-number">Page 1</span>
            <button id="next-btn" onclick="fetchJobs(currentPage + 1)">Next</button>
        </div>
    </section>
    
    <!-- Accessibility Toggle Button -->
    <button class="accessibility-toggle" id="accessibility-toggle">
        <i class="fas fa-universal-access"></i>
    </button>

    <!-- Accessibility Control Panel -->
    <div class="accessibility-controls" id="accessibility-controls">
        <h5><i class="fas fa-universal-access"></i> Accessibility</h5>
        <div class="controls-section">
            <div class="font-size-controls">
                <button id="decrease-font" title="Decrease Font Size"><i class="fas fa-minus"></i> A</button>
                <span id="font-size-value">100%</span>
                <button id="increase-font" title="Increase Font Size">A <i class="fas fa-plus"></i></button>
            </div>
        </div>
        <div class="controls-section">
            <div class="brightness-mode">
                <button id="normal-mode" class="toggle-btn active">Normal</button>
                <button id="dark-mode" class="toggle-btn">Dark</button>
                <button id="high-contrast" class="toggle-btn">High Contrast</button>
            </div>
        </div>
        <button id="reset-all">Reset All</button>
    </div>

    <!-- Footer Section -->
    <div class="footer">
        <p>&copy; 2025 PWD Job Portal. All rights reserved.</p>
    </div>

    <!-- Script to Fetch Jobs Data with Pagination, Search, and Filter -->
    <script>
        let currentPage = 1;
        let totalPages = 1;

        // Fetch jobs data with pagination, search, and job type filter
        function fetchJobs(page = 1) {
            const search = document.getElementById('search-input').value;
            const jobType = document.getElementById('job-type').value;

            if (page < 1 || page > totalPages) return;

            currentPage = page;
            const url = `../controllers/fetch_jobs.php?page=${currentPage}&search=${encodeURIComponent(search)}&job_type=${encodeURIComponent(jobType)}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    totalPages = data.totalPages;
                    document.getElementById('page-number').textContent = `Page ${currentPage}`;
                    renderJobCards(data.data);
                    togglePaginationButtons();
                })
                .catch(error => console.error('Error fetching jobs:', error));
        }
// Render job cards to the page
function renderJobCards(jobs) {
    const jobCardsContainer = document.getElementById('job-cards-container');
    jobCardsContainer.innerHTML = ''; // Clear current job cards

    if (jobs.length > 0) {
        jobs.forEach(job => {
            const jobCard = document.createElement('div');
            jobCard.classList.add('job-card');
            jobCard.innerHTML = `
                <img src="${job.company_logo}" alt="Company Logo" class="company-logo"> <!-- Company Logo -->
                <div class="job-content">
                    <h3>${job.title}</h3>
                    <p>${job.description}</p>
                    <div class="tags">
                        <span class="tag">${job.job_type}</span>
                        <span class="tag">${job.location}</span>
                    </div>
                    <div class="job-footer">
                <span>Posted <span class="job-date">${formatDate(job.posted_date)}</span></span>
                        <a href="${job.applyLink}" class="btn-apply">Apply Now</a>
                    </div>
                </div>
            `;
            jobCardsContainer.appendChild(jobCard);
        });
    } else {
        jobCardsContainer.innerHTML = '<p>No jobs available.</p>';
    }
}

// Function to format the date
function formatDate(dateString) {
    const date = new Date(dateString);
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return date.toLocaleDateString('en-US', options);
}
        // Toggle visibility of pagination buttons based on current page
        function togglePaginationButtons() {
            document.getElementById('prev-btn').style.display = currentPage > 1 ? 'inline-block' : 'none';
            document.getElementById('next-btn').style.display = currentPage < totalPages ? 'inline-block' : 'none';
        }

        // Initial fetch when the page loads
        document.addEventListener('DOMContentLoaded', () => {
            fetchJobs(1); // Fetch first page on load
        });
    </script>

    <script src="../scripts/accesibility.js"></script>
</body>
</html>
