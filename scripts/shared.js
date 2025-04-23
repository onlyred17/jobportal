document.addEventListener('DOMContentLoaded', () => {
    const savedMode = localStorage.getItem('displayMode');

    if (savedMode === 'dark-mode') {
        document.body.classList.add('dark-mode');
        setActiveButton(document.getElementById('dark-mode-panel'));
    } else if (savedMode === 'high-contrast') {
        document.body.classList.add('high-contrast');
        setActiveButton(document.getElementById('high-contrast-panel'));
    } else {
        setActiveButton(document.getElementById('normal-mode-panel'));
    }
});

    document.addEventListener('DOMContentLoaded', () => {
// Function to handle font size changes
function handleFontSizeChange(increaseButton, decreaseButton, fontSizeValue, step = 10) {
    let fontSize = parseInt(localStorage.getItem('fontSize')) || 100;
    document.documentElement.style.fontSize = fontSize + '%';
    fontSizeValue.textContent = fontSize + '%';
    
    increaseButton.addEventListener('click', function () {
        if (fontSize < 150) {
            fontSize += step;
            localStorage.setItem('fontSize', fontSize);
            fontSizeValue.textContent = fontSize + '%';
            document.documentElement.style.fontSize = fontSize + '%';
        }
    });
    
    decreaseButton.addEventListener('click', function () {
        if (fontSize > 70) {
            fontSize -= step;
            localStorage.setItem('fontSize', fontSize);
            fontSizeValue.textContent = fontSize + '%';
            document.documentElement.style.fontSize = fontSize + '%';
        }
    });
    
}
function handleModeChange(normalModeButton, darkModeButton, highContrastButton) {
    normalModeButton.addEventListener('click', function () {
        document.body.classList.remove('dark-mode', 'high-contrast');
        localStorage.setItem('displayMode', 'normal');
        setActiveButton(this);
    });

    darkModeButton.addEventListener('click', function () {
        document.body.classList.remove('high-contrast');
        document.body.classList.add('dark-mode');
        localStorage.setItem('displayMode', 'dark-mode');
        setActiveButton(this);
    });

    highContrastButton.addEventListener('click', function () {
        document.body.classList.remove('dark-mode');
        document.body.classList.add('high-contrast');
        localStorage.setItem('displayMode', 'high-contrast');
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
        localStorage.removeItem('fontSize');
localStorage.setItem('displayMode', 'normal');

    });
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
    
    });