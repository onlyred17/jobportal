<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DisabilityToAbility</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/landing_page.css">
    <style>
        /* Add custom styles for section visibility */
        .page-section {
            display: none; /* Hide all sections by default */
        }
        
        .page-section.active {
            display: block; /* Show only active section */
        }
        
        /* Make sure header and footer are always visible */
        header, footer {
            display: block;
        }
        
        /* Navigation active state */
        nav a.active {
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>
<body id="body-element">
    <!-- Header -->
    <header>
        <div class="header-container">
            <h1>DisabilityToAbility</h1>
            <nav>
    <a href="#home" class="nav-link" data-section="home">Home</a>
    <a href="#about" class="nav-link" data-section="about">About Us</a>
    <a href="#jobs" class="nav-link" data-section="jobs">Job Wall</a>
    <a href="../views/pwd_registration.php">PWD Registration</a>
</nav>
        </div>
    </header>

 <!-- Hero Section -->
<div id="home" class="hero-section page-section">
    <div class="hero-content">
        <h1>Welcome to the DisabilityToAbility Portal</h1>
        <p>Find job opportunities tailored for Persons with Disabilities (PWD). Let's make a difference together.</p>
        <a href="#jobs" class="btn-primary section-link" data-section="jobs">View Job Wall</a>

        <div class="recent-jobs-container">
        <h2>Recent Jobs</h2>
        
        <!-- Recent Job Cards -->
        <div class="recent-job-cards" id="recent-job-cards-container">
            <!-- Recent job cards will be dynamically populated here by JavaScript -->
        </div>
        

    </div>
    </div>
    

</div>

</div>

    </div>
   
<style>
   
</style>
    <!-- About Us Section -->
    <section id="about" class="page-section">
        <div class="about-container">
        <h2>About Us</h2>
    <p>At DisabilityToAbility, we are dedicated to creating equal employment opportunities for Persons with Disabilities (PWD). Our platform connects qualified candidates with employers who are committed to diversity and inclusion. We believe that every individual, regardless of their abilities, deserves the opportunity to thrive in the workforce.</p>
    <p>Our mission is to break barriers and provide meaningful employment for all. Join us in our journey to make a positive impact on the lives of PWD individuals by offering job opportunities and fostering an inclusive work environment.</p>
    
    <div class="about-image">
        <img src="path-to-your-image.jpg" alt="Inclusive Workplace" />
    </div>

    <p>We understand the unique challenges faced by PWD individuals in finding employment, and we are committed to providing tailored resources and support throughout their career journey. Our platform not only facilitates job matching but also offers training, mentorship, and networking opportunities to ensure long-term success.</p>
    
    <p>By partnering with employers who share our values, we aim to create a more inclusive workforce where diversity is celebrated and every individual is given the chance to reach their full potential. Together, we can break down the barriers to employment and build a more equitable future for all.</p>
    
    <div class="testimonial">
        <h3>What Our Partners Say</h3>
        <blockquote>
            "DisabilityToAbility has allowed us to find truly talented individuals who bring unique perspectives to our team. We are proud to be part of a platform that fosters diversity and inclusion in the workplace."
        </blockquote>
        <cite>- Employer Partner</cite>
    </div>

    <div class="cta">
        <p>Ready to make a difference? Whether you’re an employer or a job seeker, join us today and be part of a movement that’s changing the world for the better.</p>
        <a href="signup-link" class="btn">Join Us Now</a>
    </div>
        </div>
    </section>

    <!-- Jobs Section -->
    <section id="jobs" class="page-section">
        <div class="jobs-container">
            <h2>Job Wall</h2>

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
        </div>
    </section>
    
    <!-- Accessibility Toggle Button -->
    <button class="accessibility-toggle" id="accessibility-toggle">
        <i class="fas fa-universal-access"></i>
    </button>
    <div class="accessibility-controls" id="accessibility-controls">
        <h5><i class="fas fa-universal-access"></i> Accessibility</h5>
        <div class="controls-section">
            <div class="font-size-controls">
                <button id="decrease-font-panel" title="Decrease Font Size"><i class="fas fa-minus"></i> A</button>
                <span id="font-size-value-panel">100%</span>
                <button id="increase-font-panel" title="Increase Font Size">A <i class="fas fa-plus"></i></button>
            </div>
        </div>
        <div class="controls-section">
            <div class="brightness-mode">
                <button id="normal-mode-panel" class="toggle-btn active">Normal</button>
                <button id="dark-mode-panel" class="toggle-btn">Dark</button>
                <button id="high-contrast-panel" class="toggle-btn">High Contrast</button>
            </div>
        </div>
        <button id="tts-toggle-panel">Enable TTS on Hover</button>
        <button id="reset-all-panel">Reset All</button>
    </div>

    <!-- Enhanced Footer Section -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>DisabilityToAbility</h3>
                    <p>Creating equal employment opportunities for all.</p>
                    <div class="social-links">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="#home" class="section-link" data-section="home">Home</a></li>
                        <li><a href="#about" class="section-link" data-section="about">About Us</a></li>
                        <li><a href="#jobs" class="section-link" data-section="jobs">Job Listings</a></li>
                        <li><a href="../views/pwd_registration.php">Registration</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Contact Us</h3>
                    <ul class="contact-info">
                        <li><i class="fas fa-map-marker-alt"></i> 123 Employment Ave., Manila</li>
                        <li><i class="fas fa-phone"></i> (02) 8123-4567</li>
                        <li><i class="fas fa-envelope"></i> <a href="mailto:info@pwdjobportal.com">info@pwdjobportal.com</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2025 DisabilityToAbility. All rights reserved.</p>
                <div class="footer-links">
                    <a href="#">Terms of Service</a>
                    <a href="#">Privacy Policy</a>
                    <a href="#">Accessibility Statement</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Job Details Modal -->
    <div id="job-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modal-title"></h2>
                <span class="close" onclick="closeModal()">&times;</span>
            </div>
            
            <div class="modal-body">
                <div class="modal-company-info">
                    <img id="modal-company-logo" src="" alt="Company Logo" class="modal-logo">
                    <div class="company-details">
                        <p style="font-weight: 900;"><strong>Company: <span id="modal-company"></span></strong></p>
                        <div class="modal-tags">
                            <span class="modal-tag" id="modal-job-type"></span>
                            <span class="modal-tag" id="modal-location"></span>
                        </div>
                    </div>
                </div>
                
                <div class="modal-section">
                    <h3>Description</h3>
                    <p id="modal-description"></p>
                </div>
                
                <div class="modal-section">
                    <h3>Requirements</h3>
                    <ul id="modal-requirements"></ul>
                </div>
            </div>
            
            <div class="modal-footer">
               
            </div>
        </div>
    </div>

    <!-- Settings Modal -->
    <div id="settings-modal" class="settings-modal">
        <div class="settings-modal-content">
            <h5><i class="fas fa-universal-access"></i> Accessibility</h5>
            <div class="controls-section">
                <div class="font-size-controls">
                    <button id="decrease-font-modal" title="Decrease Font Size"><i class="fas fa-minus"></i> A</button>
                    <span id="font-size-value-modal">100%</span>
                    <button id="increase-font-modal" title="Increase Font Size">A <i class="fas fa-plus"></i></button>
                </div>
            </div>
            <div class="controls-section">
                <div class="brightness-mode">
                    <button id="normal-mode-modal" class="toggle-btn active">Normal</button>
                    <button id="dark-mode-modal" class="toggle-btn">Dark</button>
                    <button id="high-contrast-modal" class="toggle-btn">High Contrast</button>
                </div>
            </div>
            <button id="tts-toggle-modal">Enable TTS on Hover</button>
            <button id="reset-all-modal">Reset All</button>
            <button id="close-modal">Close</button>
        </div>
    </div>

    <!-- JavaScript for section display control -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to show a specific section
            function showSection(sectionId) {
                // Hide all sections
                const sections = document.querySelectorAll('.page-section');
                sections.forEach(section => {
                    section.classList.remove('active');
                });
                
                // Show requested section
                const targetSection = document.getElementById(sectionId);
                if (targetSection) {
                    targetSection.classList.add('active');
                }
                
                // Update active state in navigation
                const navLinks = document.querySelectorAll('.nav-link');
                navLinks.forEach(link => {
                    if (link.getAttribute('data-section') === sectionId) {
                        link.classList.add('active');
                    } else {
                        link.classList.remove('active');
                    }
                });
            }
            
            // Handle navigation clicks
            const navLinks = document.querySelectorAll('.nav-link, .section-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const sectionId = this.getAttribute('data-section');
                    showSection(sectionId);
                    
                    // Update URL hash
                    window.location.hash = sectionId;
                });
            });
            
            // Check for hash in URL on page load
            const hash = window.location.hash.substring(1);
            if (hash && document.getElementById(hash)) {
                showSection(hash);
            } else {
                // Default to home section if no hash or invalid hash
                showSection('home');
            }
        });
        document.addEventListener('DOMContentLoaded', () => {

// Save font size preference
function saveFontSize(fontSize) {
    localStorage.setItem('fontSize', fontSize);
}

// Save theme preference (Normal, Dark, High Contrast)
function saveTheme(theme) {
    localStorage.setItem('theme', theme);
}

// Save TTS preference (Enabled or Disabled)
function saveTTS(state) {
    localStorage.setItem('ttsEnabled', state);
}

// Font Size Change
document.getElementById('increase-font-panel').addEventListener('click', function () {
    let fontSize = parseInt(localStorage.getItem('fontSize') || '100') + 10;
    if (fontSize <= 150) {
        document.documentElement.style.fontSize = fontSize + '%';
        saveFontSize(fontSize);
    }
});

document.getElementById('decrease-font-panel').addEventListener('click', function () {
    let fontSize = parseInt(localStorage.getItem('fontSize') || '100') - 10;
    if (fontSize >= 70) {
        document.documentElement.style.fontSize = fontSize + '%';
        saveFontSize(fontSize);
    }
});

// Theme Change
document.getElementById('normal-mode-panel').addEventListener('click', function () {
    document.body.classList.remove('dark-mode', 'high-contrast');
    saveTheme('normal');
});

document.getElementById('dark-mode-panel').addEventListener('click', function () {
    document.body.classList.add('dark-mode');
    saveTheme('dark');
});

document.getElementById('high-contrast-panel').addEventListener('click', function () {
    document.body.classList.add('high-contrast');
    saveTheme('high-contrast');
});

// TTS Toggle
document.getElementById('tts-toggle-panel').addEventListener('click', function () {
    let ttsEnabled = localStorage.getItem('ttsEnabled') === 'true' ? 'false' : 'true';
    localStorage.setItem('ttsEnabled', ttsEnabled);
    this.textContent = ttsEnabled === 'true' ? 'Disable TTS on Hover' : 'Enable TTS on Hover';
});
});
document.addEventListener('DOMContentLoaded', () => {
    // Apply saved font size
    const savedFontSize = localStorage.getItem('fontSize');
    if (savedFontSize) {
        document.documentElement.style.fontSize = savedFontSize + '%';
    }

    // Apply saved theme
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        document.body.classList.add('dark-mode');
    } else if (savedTheme === 'high-contrast') {
        document.body.classList.add('high-contrast');
    }

    // Apply TTS setting
    const ttsEnabled = localStorage.getItem('ttsEnabled');
    if (ttsEnabled === 'true') {
        document.getElementById('tts-toggle-panel').textContent = 'Disable TTS on Hover';
    } else {
        document.getElementById('tts-toggle-panel').textContent = 'Enable TTS on Hover';
    }
});
// Function to fetch recent jobs
function fetchRecentJobs() {
    const url = '../controllers/fetch_jobs_filter.php';
    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (!data || !data.data) {
                console.error("Invalid response format", data);
                return;
            }
            renderRecentJobCards(data.data);
        })
        .catch(error => console.error('Error fetching recent jobs:', error));
}

// Function to render recent job cards
function renderRecentJobCards(jobs) {
    const recentJobsContainer = document.getElementById('recent-job-cards-container');
    recentJobsContainer.innerHTML = '';
    
    // Display only the most recent 4 jobs
    const recentJobs = jobs.slice(0, 4);
    
    if (!recentJobs.length) {
        recentJobsContainer.innerHTML = '<p>No recent jobs available.</p>';
        return;
    }
    
    recentJobs.forEach((job, index) => {
        const jobCard = document.createElement('div');
        jobCard.classList.add('recent-job-card');
        
        // Calculate days ago
        const postedDate = new Date(job.posted_date);
        const today = new Date();
        const diffTime = Math.abs(today - postedDate);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        
        jobCard.innerHTML = `
            <span class="recent-tag">New</span>
            <div class="job-header">
                <img src="${job.company_logo || '../images/default-company.png'}" alt="Company Logo" class="company-logo">
                <div class="job-title-container">
                    <h3>${job.title}</h3>
                    <p class="company-name">${job.company_name}</p>
                </div>
            </div>
            <div class="job-content">
                <p>${job.description.substring(0, 100)}${job.description.length > 100 ? '...' : ''}</p>
                <div class="tags">
                    <span class="tag"><i class="fas fa-briefcase"></i> ${job.job_type}</span>
                    <span class="tag"><i class="fas fa-map-marker-alt"></i> ${job.location}</span>
                </div>
                <div class="job-footer">
                    <span class="job-date"><i class="fas fa-calendar-alt"></i> ${diffDays} days ago</span>
                    <button class="btn-view-details" data-job-index="${index}">View Details</button>
                </div>
            </div>
        `;
        
        recentJobsContainer.appendChild(jobCard);
    });
    
    // Add event listeners to view details buttons
    document.querySelectorAll('#recent-job-cards-container .btn-view-details').forEach((button, index) => {
        button.addEventListener('click', function() {
            openModal(recentJobs[index]);
        });
    });
}

// Call the fetchRecentJobs function when the page loads
document.addEventListener('DOMContentLoaded', function() {
    // Fetch all jobs for the main job section
    fetchJobs(1);
    
    // Fetch recent jobs for the recent jobs section
    fetchRecentJobs();
});
    </script>

    <!-- Original scripts -->
    <script src="../scripts/landing_page.js"></script>
</body>
</html>