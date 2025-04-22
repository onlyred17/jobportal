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

        <div class="recent-jobs-container" >
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

<!-- About Us Section -->
  <section id="about" class="page-section">  <div class="about-container">
    <div class="about-text">
      <h2>About Us</h2>
      <p>
        DisabilityToAbility is a local job portal focused on providing equal job opportunities for Persons with Disabilities (PWD). We connect skilled individuals with inclusive employers in our community.
      </p>
      <p>
        We aim to remove barriers in employment by offering a platform that supports accessible job matching, training, and long-term career growth for PWD individuals.
      </p>
      <p>
        Together with our partner employers, we’re working towards a more inclusive and diverse workforce where everyone can thrive.
      </p>
    </div>

    <div class="about-image">
      <img src="../images/work.jpg" alt="Inclusive Workplace">
    </div>

    <div class="quick-facts">
      <div class="fact">
        <h3>250+</h3>
        <p>Jobs Listed</p>
      </div>
      <div class="fact">
        <h3>100+</h3>
        <p>PWDs Employed</p>
      </div>
      <div class="fact">
        <h3>80+</h3>
        <p>Local Employers</p>
      </div>
    </div>

    <div class="testimonial">
      <h3>Employer Feedback</h3>
      <blockquote>
        “We’ve found dedicated and skilled workers through DisabilityToAbility. It’s a great step toward building a more inclusive team.”
      </blockquote>
      <cite>- Local Business Partner</cite>
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
            <button id="high-contrast-panel" class="toggle-btn hidden">High Contrast</button>
        </div>
    </div>
    <style>
        .hidden{
            display: none;
        }
    </style>
    <div class="controls-section">
        <div class="language-selection">
            <h6><i class="fas fa-language"></i> Language</h6>
            <button id="english-mode" class="toggle-btn active">English</button>
            <button id="tagalog-mode" class="toggle-btn">Tagalog</button>
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
                    <button id="high-contrast-modal" class="toggle-btn hidden">High Contrast</button>
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



// TTS Toggle
document.getElementById('tts-toggle-panel').addEventListener('click', function () {
    let ttsEnabled = localStorage.getItem('ttsEnabled') === 'true' ? 'false' : 'true';
    localStorage.setItem('ttsEnabled', ttsEnabled);
    this.textContent = ttsEnabled === 'true' ? 'Disable TTS on Hover' : 'Enable TTS on Hover';
});
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
document.addEventListener('DOMContentLoaded', () => {
    // Get language buttons
    const englishButton = document.getElementById('english-mode');
    const tagalogButton = document.getElementById('tagalog-mode');

    // Language translations for the landing page
    const translations = {
        english: {
            // Header/Navigation
            home: "Home",
            aboutUs: "About Us",
            jobWall: "Job Wall",
            pwdRegistration: "PWD Registration",
            
            // Hero Section
            welcomeTitle: "Welcome to the DisabilityToAbility Portal",
            welcomeText: "Find job opportunities tailored for Persons with Disabilities (PWD). Let's make a difference together.",
            viewJobWall: "View Job Wall",
            recentJobs: "Recent Jobs",
            
            // About Section
            aboutTitle: "About Us",
            aboutPara1: "At DisabilityToAbility, we are dedicated to creating equal employment opportunities for Persons with Disabilities (PWD). Our platform connects qualified candidates with employers who are committed to diversity and inclusion. We believe that every individual, regardless of their abilities, deserves the opportunity to thrive in the workforce.",
            aboutPara2: "Our mission is to break barriers and provide meaningful employment for all. Join us in our journey to make a positive impact on the lives of PWD individuals by offering job opportunities and fostering an inclusive work environment.",
            aboutPara3: "We understand the unique challenges faced by PWD individuals in finding employment, and we are committed to providing tailored resources and support throughout their career journey. Our platform not only facilitates job matching but also offers training, mentorship, and networking opportunities to ensure long-term success.",
            aboutPara4: "By partnering with employers who share our values, we aim to create a more inclusive workforce where diversity is celebrated and every individual is given the chance to reach their full potential. Together, we can break down the barriers to employment and build a more equitable future for all.",
            testimonialTitle: "What Our Partners Say",
            testimonialQuote: "DisabilityToAbility has allowed us to find truly talented individuals who bring unique perspectives to our team. We are proud to be part of a platform that fosters diversity and inclusion in the workplace.",
            testimonialCite: "- Employer Partner",
            ctaText: "Ready to make a difference? Whether you're an employer or a job seeker, join us today and be part of a movement that's changing the world for the better.",
            joinUsNow: "Join Us Now",
            
            // Jobs Section
            jobWallTitle: "Job Wall",
            searchPlaceholder: "Search for jobs, location, job type...",
            allJobTypes: "All Job Types",
            fullTime: "Full-time",
            partTime: "Part-time",
            remote: "Remote",
            previous: "Previous",
            page: "Page",
            next: "Next",
            
            // Job Card Elements
            new: "New",
            viewDetails: "View Details",
            daysAgo: "days ago",
            
            // Footer
            footerTagline: "Creating equal employment opportunities for all.",
            quickLinks: "Quick Links",
            contactUs: "Contact Us",
            allRightsReserved: "All rights reserved.",
            termsOfService: "Terms of Service",
            privacyPolicy: "Privacy Policy",
            accessibilityStatement: "Accessibility Statement",
            
            // Accessibility Panel
            accessibility: "Accessibility",
            normalMode: "Normal",
            darkMode: "Dark",
            highContrastMode: "High Contrast",
            language: "Language",
            enableTTS: "Enable TTS on Hover",
            disableTTS: "Disable TTS on Hover",
            resetAll: "Reset All",
            close: "Close"
        },
        tagalog: {
            // Header/Navigation
            home: "Home",
            aboutUs: "Tungkol sa Amin",
            jobWall: "Mga Trabaho",
            pwdRegistration: "Rehistro ng PWD",
            
            // Hero Section
            welcomeTitle: "Maligayang pagdating sa DisabilityToAbility Portal",
            welcomeText: "Humanap ng mga oportunidad sa trabaho na angkop para sa mga Persons with Disability (PWD). Gumawa tayo ng pagbabago nang sama-sama.",
            viewJobWall: "Tingnan ang Job Wall",
            recentJobs: "Mga Bagong Trabaho",
            
            // About Section
            aboutTitle: "Tungkol sa Amin",
            aboutPara1: "Sa DisabilityToAbility, nakatuon kami sa paglikha ng pantay na oportunidad sa trabaho para sa mga Persons with Disabilities (PWD). Ang aming platform ay kumokonekta sa mga kwalipikadong kandidato sa mga employer na nakatuon sa diversity at inclusion. Naniniwala kami na ang bawat indibidwal, anuman ang kanilang kakayahan, ay karapat-dapat na umunlad sa trabaho.",
            aboutPara2: "Ang aming misyon ay ang sirain ang mga hadlang at magbigay ng makabuluhang trabaho para sa lahat. Sumali sa amin sa aming paglalakbay upang gumawa ng positibong epekto sa buhay ng mga indibidwal na PWD sa pamamagitan ng pag-aalok ng mga oportunidad sa trabaho at pagtataguyod ng isang inklusibong kapaligiran sa trabaho.",
            aboutPara3: "Nauunawaan namin ang mga natatanging hamon na kinakaharap ng mga indibidwal na PWD sa paghahanap ng trabaho, at nakatuon kami sa pagbibigay ng mga inangkop na mapagkukunan at suporta sa buong kanilang karera. Ang aming platform ay hindi lamang nagpapadali ng job matching kundi nag-aalok din ng pagsasanay, mentorship, at networking opportunities upang matiyak ang pangmatagalang tagumpay.",
            aboutPara4: "Sa pakikipagtulungan sa mga employer na nagbabahagi ng aming mga halaga, layunin naming lumikha ng isang mas inklusibong workforce kung saan ang diversity ay ipinagdiriwang at ang bawat indibidwal ay binibigyan ng pagkakataon na abutin ang kanilang buong potensyal. Sama-sama, masisira natin ang mga hadlang sa trabaho at makapagtayo ng isang mas patas na hinaharap para sa lahat.",
            testimonialTitle: "Ano ang Sinasabi ng Aming mga Partner",
            testimonialQuote: "Ang DisabilityToAbility ay nagbigay sa amin ng pagkakataong makahanap ng tunay na may talentong mga indibidwal na nagdadala ng natatanging pananaw sa aming koponan. Ipinagmamalaki naming maging bahagi ng isang platform na nagtataguyod ng diversity at inclusion sa workplace.",
            testimonialCite: "- Partner na Employer",
            ctaText: "Handa na bang gumawa ng pagbabago? Maging ikaw man ay isang employer o isang naghahanap ng trabaho, sumali sa amin ngayon at maging bahagi ng kilusang nagbabago sa mundo para sa ikabubuti.",
            joinUsNow: "Sumali sa Amin Ngayon",
            
            // Jobs Section
            jobWallTitle: "Job Wall",
            searchPlaceholder: "Maghanap ng trabaho, lokasyon, uri ng trabaho...",
            allJobTypes: "Lahat ng Uri ng Trabaho",
            fullTime: "Full-time",
            partTime: "Part-time",
            remote: "Remote",
            previous: "Nakaraan",
            page: "Pahina",
            next: "Susunod",
            
            // Job Card Elements
            new: "Bago",
            viewDetails: "Tingnan ang Detalye",
            daysAgo: "araw na ang nakalipas",
            
        
            
            // Accessibility Panel
            accessibility: "Accessibility",
            normalMode: "Normal",
            darkMode: "Madilim",
            highContrastMode: "Mataas na Kontrast",
            language: "Wika",
            enableTTS: "Paganahin ang TTS sa Hover",
            disableTTS: "Huwag Paganahin ang TTS sa Hover",
            resetAll: "I-reset Lahat",
            close: "Isara"
        }
    };
    
    // Current language (default to English)
    let currentLanguage =  'english';
    
    // Function to update text based on current language
    function updateLanguage(language) {
        localStorage.setItem('selectedLanguage', language);
        currentLanguage = language;
        
        // Update navigation text
        document.querySelectorAll('.nav-link[data-section="home"]').forEach(el => el.textContent = translations[language].home);
        document.querySelectorAll('.nav-link[data-section="about"]').forEach(el => el.textContent = translations[language].aboutUs);
        document.querySelectorAll('.nav-link[data-section="jobs"]').forEach(el => el.textContent = translations[language].jobWall);
        document.querySelectorAll('a[href="../views/pwd_registration.php"]').forEach(el => el.textContent = translations[language].pwdRegistration);
        
        // Update hero section text
        document.querySelector('.hero-content h1').textContent = translations[language].welcomeTitle;
        document.querySelector('.hero-content p').textContent = translations[language].welcomeText;
        document.querySelector('.hero-content .btn-primary').textContent = translations[language].viewJobWall;
        document.querySelector('.recent-jobs-container h2').textContent = translations[language].recentJobs;
        
        // Update about section text
        document.querySelector('#about h2').textContent = translations[language].aboutTitle;
        const aboutParas = document.querySelectorAll('#about p:not(.testimonial p):not(.cta p)');
        if (aboutParas.length >= 4) {
            aboutParas[0].textContent = translations[language].aboutPara1;
            aboutParas[1].textContent = translations[language].aboutPara2;
            aboutParas[2].textContent = translations[language].aboutPara3;
            aboutParas[3].textContent = translations[language].aboutPara4;
        }
        document.querySelector('.testimonial h3').textContent = translations[language].testimonialTitle;
        document.querySelector('.testimonial blockquote').textContent = translations[language].testimonialQuote;
        document.querySelector('.testimonial cite').textContent = translations[language].testimonialCite;
   
        
        // Update jobs section text
        document.querySelector('#jobs h2').textContent = translations[language].jobWallTitle;
        document.querySelector('#search-input').placeholder = translations[language].searchPlaceholder;
        
        const jobTypeOptions = document.querySelector('#job-type').options;
        jobTypeOptions[0].text = translations[language].allJobTypes;
        jobTypeOptions[1].text = translations[language].fullTime;
        jobTypeOptions[2].text = translations[language].partTime;
        jobTypeOptions[3].text = translations[language].remote;
        
        document.querySelector('#prev-btn').textContent = translations[language].previous;
        const pageNumberText = document.querySelector('#page-number').textContent;
        const pageNumber = pageNumberText.match(/\d+/)[0];
        document.querySelector('#page-number').textContent = `${translations[language].page} ${pageNumber}`;
        document.querySelector('#next-btn').textContent = translations[language].next;
        

        
 
        
       

  
        
        
        // Also update job cards if they exist
        updateJobCardTranslations(language);
    }
    
    // Function to update translations in job cards (called when language changes and when new job cards are rendered)
    function updateJobCardTranslations(language) {
        // Update "New" tags
        document.querySelectorAll('.recent-tag').forEach(tag => {
            tag.textContent = translations[language].new;
        });
        
        // Update "View Details" buttons
        document.querySelectorAll('.btn-view-details').forEach(btn => {
            btn.textContent = translations[language].viewDetails;
        });
        
        // Update "days ago" text in job dates
        document.querySelectorAll('.job-date').forEach(date => {
            const daysText = date.textContent;
            const daysMatch = daysText.match(/\d+/);
            if (daysMatch) {
                const days = daysMatch[0];
                date.innerHTML = `<i class="fas fa-calendar-alt"></i> ${days} ${translations[language].daysAgo}`;
            }
        });
    }
    
    // Function to set active language button
    function setActiveLanguageButton(button) {
        document.querySelectorAll('.language-selection .toggle-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        button.classList.add('active');
    }
    
    // Add event listeners to language buttons
    englishButton.addEventListener('click', function() {
        updateLanguage('english');
        setActiveLanguageButton(this);
    });
    
    tagalogButton.addEventListener('click', function() {
        updateLanguage('tagalog');
        setActiveLanguageButton(this);
    });
    
    // Override the fetchRecentJobs and renderRecentJobCards functions to support translation
    const originalRenderRecentJobCards = window.renderRecentJobCards;
    window.renderRecentJobCards = function(jobs) {
        // Call the original function
        originalRenderRecentJobCards(jobs);
        
        // Then update translations
        updateJobCardTranslations(currentLanguage);
    };
    
    // Override the fetchJobs function to support translation
    const originalFetchJobs = window.fetchJobs;
    if (originalFetchJobs) {
        window.fetchJobs = function(page) {
            // Call the original function
            originalFetchJobs(page);
            
            // Add a small delay to ensure the DOM has been updated
            setTimeout(() => {
                updateJobCardTranslations(currentLanguage);
                
                // Update page number text
                const pageNumberText = document.querySelector('#page-number').textContent;
                const pageNumber = pageNumberText.match(/\d+/)[0];
                document.querySelector('#page-number').textContent = `${translations[currentLanguage].page} ${pageNumber}`;
            }, 500);
        };
    }
    
    // Initialize the page with the stored or default language
    const initialLanguage = localStorage.getItem('selectedLanguage') || 'english';
    updateLanguage(initialLanguage);
    
    // Set the correct active button based on stored language
    if (initialLanguage === 'english') {
        setActiveLanguageButton(englishButton);
    } else {
        setActiveLanguageButton(tagalogButton);
    }
});

    </script>

    <!-- Original scripts -->
    <script src="../scripts/landing_page.js"></script>
</body>
</html>