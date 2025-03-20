let currentPage = 1;
let totalPages = 5;

function fetchJobs(page = 1) {
    const search = document.getElementById('search-input').value;
    const jobType = document.getElementById('job-type').value;

    if (page < 1) return;

    const url = `../controllers/fetch_jobs.php?page=${page}&search=${encodeURIComponent(search)}&job_type=${encodeURIComponent(jobType)}`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (!data || !data.data || !data.totalPages) {
                console.error("Invalid response format", data);
                return;
            }
            totalPages = data.totalPages;
            currentPage = page;

            document.getElementById('page-number').textContent = `Page ${currentPage} of ${totalPages}`;
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
        Description: ${job.status}.
        Requirements: ${getRequirementsText(job.requirements)}.
    `;
    
    // Create speech utterance
    const speech = new SpeechSynthesisUtterance(textToSpeak);
    speech.lang = 'en-US';
    speech.rate = 1;  // Normal speed
    speech.pitch = 2; // Normal pitch
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

function renderJobCards(jobs) {
    const jobCardsContainer = document.getElementById('job-cards-container');
    jobCardsContainer.innerHTML = ''; 
    const openJobs = jobs.filter(job => job.status.toLowerCase() === "open");

    if (!jobs.length) {
        jobCardsContainer.innerHTML = '<p>No jobs available.</p>';
        return;
    }

    jobs.forEach((job, index) => {
        const jobCard = document.createElement('div');
        jobCard.classList.add('job-card');

        let statusIcon = job.status.toLowerCase() === "open"
            ? '<i class="fas fa-check-circle" style="color: green;"></i>'
            : '<i class="fas fa-times-circle" style="color: red;"></i>';

        jobCard.innerHTML = `
            <div class="job-header">
                <img src="${job.company_logo || '../images/default-company.png'}" alt="Company Logo" class="company-logo">
                <div class="job-title-container">
                    <h3>${job.title}</h3>
                    <p class="company-name">${job.company_name}</p>
                </div>
            </div>
            <div class="job-content">
                <p>${job.description.substring(0, 150)}${job.description.length > 150 ? '...' : ''}</p>
                <div class="tags">
                    <span class="tag"><i class="fas fa-briefcase"></i> ${job.job_type}</span>
                    <span class="tag"><i class="fas fa-map-marker-alt"></i> ${job.location}</span>
                    <span class="tag">${statusIcon} ${job.status}</span>
                </div>
                <div class="job-footer">
                    <span class="job-date"><i class="fas fa-calendar-alt"></i> Posted ${formatDate(job.posted_date)}</span>
                    <button class="btn-view-details" data-job-index="${index}">View Details</button>
                </div>
            </div>
        `;

        jobCardsContainer.appendChild(jobCard);
    });

    document.querySelectorAll('.btn-view-details').forEach(button => {
        button.addEventListener('click', function () {
            openModal(jobs[this.dataset.jobIndex]);
        });
    });

    addTextToSpeech(jobs);
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
                Status: ${job.status}.
                Posted on: ${formatDate(job.posted_date)}.
                For more info, click the view details.
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

document.addEventListener('DOMContentLoaded', () => {

    // Function to handle font size changes
    function handleFontSizeChange(increaseButton, decreaseButton, fontSizeValue, step = 10) {
        let fontSize = 100;

        increaseButton.addEventListener('click', function () {
            if (fontSize < 150) {
                fontSize += step;
                fontSizeValue.textContent = fontSize + '%';
                document.documentElement.style.fontSize = fontSize + '%';
            }
        });

        decreaseButton.addEventListener('click', function () {
            if (fontSize > 70) {
                fontSize -= step;
                fontSizeValue.textContent = fontSize + '%';
                document.documentElement.style.fontSize = fontSize + '%';
            }
        });
    }

    // Function to handle mode changes
    function handleModeChange(normalModeButton, darkModeButton, highContrastButton) {
        normalModeButton.addEventListener('click', function () {
            document.body.classList.remove('dark-mode', 'high-contrast');
            setActiveButton(this);
        });

        darkModeButton.addEventListener('click', function () {
            document.body.classList.remove('high-contrast');
            document.body.classList.add('dark-mode');
            setActiveButton(this);
        });

        highContrastButton.addEventListener('click', function () {
            document.body.classList.remove('dark-mode');
            document.body.classList.add('high-contrast');
            setActiveButton(this);
        });
    }

    // Function to reset all settings
    function handleReset(resetButton, fontSizeValue, normalModeButton) {
        resetButton.addEventListener('click', function () {
            document.body.classList.remove('dark-mode', 'high-contrast');
            fontSize = 100;
            fontSizeValue.textContent = fontSize + '%';
            document.documentElement.style.fontSize = fontSize + '%';
            setActiveButton(normalModeButton);
        });
    }

    // Function to set the active button
    function setActiveButton(button) {
        document.querySelectorAll('.toggle-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        button.classList.add('active');
    }

    // Initialize controls for the modal
    handleFontSizeChange(
        document.getElementById('increase-font-panel'),
        document.getElementById('decrease-font-panel'),
        document.getElementById('font-size-value-panel')
    );

    handleModeChange(
        document.getElementById('normal-mode-panel'),
        document.getElementById('dark-mode-panel'),
        document.getElementById('high-contrast-panel')
    );

    handleReset(
        document.getElementById('reset-all-panel'),
        document.getElementById('font-size-value-panel'),
        document.getElementById('normal-mode-panel')
    );

    // Toggle TTS functionality
    let ttsEnabled = false;

    document.getElementById('tts-toggle-panel').addEventListener('click', function () {
        ttsEnabled = !ttsEnabled;
        this.textContent = ttsEnabled ? 'Disable TTS on Hover' : 'Enable TTS on Hover';
        if (!ttsEnabled) {
            window.speechSynthesis.cancel(); // Stop any ongoing speech
        }
    });

    // Use event delegation to handle all elements dynamically
    document.body.addEventListener('mouseover', handleTTSOnHover);

    function handleTTSOnHover(event) {
        if (!ttsEnabled) return; // Exit if TTS is disabled

        const element = event.target;
        const textToSpeak = element.innerText.trim() || element.textContent.trim();

        if (!textToSpeak) return; // Skip empty elements

        // Stop any ongoing speech
        window.speechSynthesis.cancel();

        // Create a new speech utterance
        const speech = new SpeechSynthesisUtterance(textToSpeak);
        speech.lang = 'en-US';
        speech.rate = 1; // Normal speed
        speech.pitch = 1; // Normal pitch
        speech.volume = 1; // Full volume

        // Start speaking
        window.speechSynthesis.speak(speech);

        // Stop speech when the mouse leaves the element
        element.addEventListener('mouseleave', () => {
            window.speechSynthesis.cancel();
        }, { once: true });
    }
});


