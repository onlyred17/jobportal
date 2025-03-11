<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PWD Job Portal</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../css/landing_page.css">
    <style>
        
    </style>
</head>
<body id="body-element">
    <!-- Header -->
    <header>
        <div class="header-container">
            <h1>PWD Job Portal</h1>
            <nav>
                <a href="#home">Home</a>
                <a href="#about">About Us</a>
                <a href="#jobs">Jobs</a>
                <a href="../views/pwd_registration.php">Registration</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <div id="home" class="hero-section">
        <div class="hero-content">
            <h1>Welcome to the PWD Job Portal</h1>
            <p>Find job opportunities tailored for Persons with Disabilities (PWD). Let's make a difference together.</p>
            <a href="#jobs" class="btn-primary">View Job Listings</a>
        </div>
    </div>

    <!-- About Us Section -->
    <section id="about">
        <div class="about-container">
            <h2>About Us</h2>
            <p>We are dedicated to providing job opportunities for Persons with Disabilities (PWD), connecting employers with candidates who have unique abilities. Our mission is to create an inclusive environment for all individuals seeking meaningful employment.</p>
        </div>
    </section>

    <!-- Jobs Section -->
    <section id="jobs">
        <div class="jobs-container">
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

    <!-- Enhanced Footer Section -->
<footer class="footer">
    <div class="footer-container">
        <div class="footer-content">
            <div class="footer-section">
                <h3>PWD Job Portal</h3>
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
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#jobs">Job Listings</a></li>
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
            <p>&copy; 2025 PWD Job Portal. All rights reserved.</p>
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
                    <p><strong>Company:</strong> <span id="modal-company"></span></p>
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
            <button id="modal-listen" class="btn-listen-modal">
                <i class="fas fa-volume-up"></i> Listen
            </button>
        </div>
    </div>
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

    // Function to add TTS to each job listing
function addTextToSpeech() {
    document.querySelectorAll('.btn-listen').forEach(button => {
        button.addEventListener('click', function() {
            const jobCard = this.closest('.job-card');
            if (!jobCard) return;

            const jobTitle = jobCard.querySelector('.job-header h3').innerText;
            const jobDescription = jobCard.querySelector('.job-content p').innerText;
            const jobType = jobCard.querySelector('.tag:first-child').innerText;
            const jobLocation = jobCard.querySelector('.tag:last-child').innerText;

            const textToSpeak = `Job Title: ${jobTitle}. Description: ${jobDescription}. Job Type: ${jobType}. Location: ${jobLocation}.`;

            const speech = new SpeechSynthesisUtterance(textToSpeak);
            speech.lang = 'en-US';
            speech.rate = 1;  // Normal speed
            speech.pitch = 1; // Normal pitch
            speech.volume = 1; // Full volume

            window.speechSynthesis.speak(speech);
        });
    });
}
// Function to open job details modal with updated UI
function openModal(job) {
    // Parse the job data if it's a string
    if (typeof job === 'string') {
        try {
            job = JSON.parse(job);
        } catch (e) {
            console.error('Error parsing job data:', e);
            return;
        }
    }
    
    // Populate modal content
    document.getElementById('modal-title').innerText = job.title;
    document.getElementById('modal-company').innerText = job.company_name;
    document.getElementById('modal-job-type').innerText = job.job_type;
    document.getElementById('modal-location').innerText = job.location;
    document.getElementById('modal-description').innerText = job.description;
    
    // Set company logo if available
    const logoElement = document.getElementById('modal-company-logo');
    if (job.company_logo) {
        logoElement.src = job.company_logo;
        logoElement.style.display = 'block';
    } else {
        logoElement.style.display = 'none';
    }
    
    // Clear and populate requirements list
    let requirementsList = document.getElementById('modal-requirements');
    requirementsList.innerHTML = '';
    
    // Check if requirements exist and is an array
    if (job.requirements && Array.isArray(job.requirements)) {
        job.requirements.forEach(req => {
            let li = document.createElement('li');
            li.innerText = req;
            requirementsList.appendChild(li);
        });
    } else if (job.requirements && typeof job.requirements === 'string') {
        // If requirements is a string, add it as a single item
        let li = document.createElement('li');
        li.innerText = job.requirements;
        requirementsList.appendChild(li);
    } else {
        // If no requirements provided
        let li = document.createElement('li');
        li.innerText = "Please contact the company for specific requirements.";
        requirementsList.appendChild(li);
    }

    // Make sure the modal is visible with animation
    const modal = document.getElementById('job-modal');
    modal.style.display = 'block';
    
    // Use setTimeout to ensure the display change has taken effect before adding the class
    setTimeout(() => {
        modal.classList.add('show');
    }, 10);
    
    // Add Text-to-Speech functionality for the modal
    document.getElementById('modal-listen').addEventListener('click', function() {
        speakJobDetails(job);
    });
    
    // Add Apply button functionality
    document.getElementById('modal-apply').addEventListener('click', function() {
        // You can implement application logic here
        alert(`You are about to apply for the position of ${job.title} at ${job.company}. This feature will be implemented soon.`);
    });
}

// Function to close the modal with animation
function closeModal() {
    const modal = document.getElementById('job-modal');
    modal.classList.remove('show');
    
    // Wait for the animation to complete before hiding the modal
    setTimeout(() => {
        modal.style.display = 'none';
    }, 300);
    
    // Remove event listeners to prevent duplicates on reopen
    document.getElementById('modal-listen').removeEventListener('click', function() {});
    document.getElementById('modal-apply').removeEventListener('click', function() {});
}

// Function to handle Text-to-Speech for job details in the modal
function speakJobDetails(job) {
    // Stop any current speech
    window.speechSynthesis.cancel();
    
    // Prepare the text to speak with proper pauses - removed the Apply Now button mention
    const textToSpeak = `
        Job Title: ${job.title}. 
        Company: ${job.company_name}.
        Job Type: ${job.job_type}.
        Location: ${job.location}.
        Description: ${job.description}.
        
        Requirements: ${getRequirementsText(job.requirements)}.
    `;
    
    // Create speech utterance
    const speech = new SpeechSynthesisUtterance(textToSpeak);
    speech.lang = 'en-US';
    speech.rate = 1;  // Normal speed
    speech.pitch = 1; // Normal pitch
    speech.volume = 1; // Full volume
    
    // Add visual indicator that speaking is in progress
    const listenButton = document.getElementById('modal-listen');
    const originalText = listenButton.innerHTML;
    listenButton.innerHTML = '<i class="fas fa-pause"></i> Stop Reading';
    
    // Add event to track when speech has ended
    speech.onend = function() {
        listenButton.innerHTML = originalText;
    };
    
    // Allow stopping the speech when button is clicked again
    listenButton.onclick = function() {
        if (window.speechSynthesis.speaking) {
            window.speechSynthesis.cancel();
            listenButton.innerHTML = originalText;
            
            // Reset the click handler
            setTimeout(() => {
                listenButton.onclick = function() {
                    speakJobDetails(job);
                };
            }, 100);
        }
    };
    
    // Start speaking
    window.speechSynthesis.speak(speech);
}

// Helper function to format requirements for speech
function getRequirementsText(requirements) {
    if (!requirements) {
        return "Please contact the company for specific requirements";
    }
    
    if (typeof requirements === 'string') {
        return requirements;
    }
    
    if (Array.isArray(requirements)) {
        return requirements.join('. ');
    }
    
    return "Please contact the company for specific requirements";
}

// Function to render job cards with proper event binding
function renderJobCards(jobs) {
    const jobCardsContainer = document.getElementById('job-cards-container');
    jobCardsContainer.innerHTML = ''; // Clear current job cards

    if (jobs.length > 0) {
        jobs.forEach((job, index) => {
            const jobCard = document.createElement('div');
            jobCard.classList.add('job-card');
            
            jobCard.innerHTML = `
                <div class="job-header">
                    <img src="${job.company_logo || '../images/default-company.png'}" alt="Company Logo" class="company-logo">
                    <h3>${job.title}</h3>
                </div>
                <div class="job-content">
                    <p>${job.description.substring(0, 150)}${job.description.length > 150 ? '...' : ''}</p>
                    <div class="tags">
                        <span class="tag">${job.job_type}</span>
                        <span class="tag">${job.location}</span>
                    </div>
                    <div class="job-footer">
                        <span class="job-date">Posted ${formatDate(job.posted_date)}</span>
                        <button class="btn-listen" aria-label="Listen to job description"><i class="fas fa-volume-up"></i></button>
                        <button class="btn-view-details" data-job-index="${index}">View Details</button>
                    </div>
                </div>
            `;
            
            jobCardsContainer.appendChild(jobCard);
        });
        
        // Now add event listeners after all cards have been added to the DOM
        document.querySelectorAll('.btn-view-details').forEach((button, index) => {
            button.addEventListener('click', function() {
                openModal(jobs[this.dataset.jobIndex]);
            });
        });

        // Add TTS functionality after rendering
        addTextToSpeech(jobs);
    } else {
        jobCardsContainer.innerHTML = '<p>No jobs available.</p>';
    }
}

// Improved Text-to-Speech function with job data reference
function addTextToSpeech(jobs) {
    document.querySelectorAll('.btn-listen').forEach((button, index) => {
        button.addEventListener('click', function(e) {
            e.stopPropagation(); // Prevent triggering other click events
            const job = jobs[index];
            
            // Stop any current speech
            window.speechSynthesis.cancel();
            
            const textToSpeak = `
                Job Title: ${job.title}. 
    Company: ${job.company_name}.
                Brief Description: ${job.description.substring(0, 150)}. 
                Job Type: ${job.job_type}. 
                Location: ${job.location}.
                Posted on: ${formatDate(job.posted_date)}.
                For more details, click View Details.
            `;

            const speech = new SpeechSynthesisUtterance(textToSpeak);
            speech.lang = 'en-US';
            speech.rate = 1;
            speech.pitch = 1;
            speech.volume = 1;

            // Visual indicator
            this.innerHTML = '<i class="fas fa-pause"></i>';
            
            speech.onend = () => {
                this.innerHTML = '<i class="fas fa-volume-up"></i>';
            };
            
            window.speechSynthesis.speak(speech);
        });
    });
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('job-modal');
    if (event.target === modal) {
        closeModal();
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

        // Accessibility Controls Toggle
        document.getElementById('accessibility-toggle').addEventListener('click', function() {
            document.getElementById('accessibility-controls').classList.toggle('active');
        });

        // Font Size Controls
        let fontSize = 100;
        document.getElementById('increase-font').addEventListener('click', function() {
            if (fontSize < 150) {
                fontSize += 10;
                document.getElementById('font-size-value').textContent = fontSize + '%';
                document.documentElement.style.fontSize = fontSize + '%';
            }
        });

        document.getElementById('decrease-font').addEventListener('click', function() {
            if (fontSize > 70) {
                fontSize -= 10;
                document.getElementById('font-size-value').textContent = fontSize + '%';
                document.documentElement.style.fontSize = fontSize + '%';
            }
        });

        // Mode Controls
        document.getElementById('normal-mode').addEventListener('click', function() {
            document.body.classList.remove('dark-mode', 'high-contrast');
            setActiveButton(this);
        });

        document.getElementById('dark-mode').addEventListener('click', function() {
            document.body.classList.remove('high-contrast');
            document.body.classList.add('dark-mode');
            setActiveButton(this);
        });

        document.getElementById('high-contrast').addEventListener('click', function() {
            document.body.classList.remove('dark-mode');
            document.body.classList.add('high-contrast');
            setActiveButton(this);
        });

        // Reset All
        document.getElementById('reset-all').addEventListener('click', function() {
            document.body.classList.remove('dark-mode', 'high-contrast');
            fontSize = 100;
            document.getElementById('font-size-value').textContent = fontSize + '%';
            document.documentElement.style.fontSize = fontSize + '%';
            setActiveButton(document.getElementById('normal-mode'));
        });

        function setActiveButton(button) {
            document.querySelectorAll('.toggle-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            button.classList.add('active');
        }
        
    </script>
</body>
</html>