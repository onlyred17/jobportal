// Accessibility Control Panel Script (Font size and modes)
let currentFontSize = 100;
const fontSizeValue = document.getElementById('font-size-value');
const decreaseFontBtn = document.getElementById('decrease-font');
const increaseFontBtn = document.getElementById('increase-font');
const bodyElement = document.getElementById('body-element');

const normalModeBtn = document.getElementById('normal-mode');
const darkModeBtn = document.getElementById('dark-mode');
const highContrastBtn = document.getElementById('high-contrast');
const resetAllBtn = document.getElementById('reset-all');

// Toggle Accessibility Controls
const accessibilityToggle = document.getElementById('accessibility-toggle');
const accessibilityControls = document.getElementById('accessibility-controls');

accessibilityToggle.addEventListener('click', () => {
    accessibilityControls.classList.toggle('active');
});

// Font size adjustment
decreaseFontBtn.addEventListener('click', () => {
    if (currentFontSize > 70) {
        currentFontSize -= 10;
        updateFontSize();
    }
});

increaseFontBtn.addEventListener('click', () => {
    if (currentFontSize < 200) {
        currentFontSize += 10;
        updateFontSize();
    }
});

function updateFontSize() {
    document.documentElement.style.fontSize = `${currentFontSize}%`;
    fontSizeValue.textContent = `${currentFontSize}%`;

    // Apply font size across the body and major elements
    bodyElement.style.fontSize = `${currentFontSize}%`;
}

// Brightness Modes
normalModeBtn.addEventListener('click', () => {
    bodyElement.classList.remove('dark-mode', 'high-contrast');
    setActiveButton(normalModeBtn);
});

darkModeBtn.addEventListener('click', () => {
    bodyElement.classList.remove('high-contrast');
    bodyElement.classList.add('dark-mode');
    setActiveButton(darkModeBtn);
});

highContrastBtn.addEventListener('click', () => {
    bodyElement.classList.remove('dark-mode');
    bodyElement.classList.add('high-contrast');
    setActiveButton(highContrastBtn);
});

// Reset all settings
resetAllBtn.addEventListener('click', () => {
    currentFontSize = 100;
    updateFontSize();
    bodyElement.classList.remove('dark-mode', 'high-contrast');
    setActiveButton(normalModeBtn);
});

function setActiveButton(activeButton) {
    const buttons = document.querySelectorAll('.toggle-btn');
    buttons.forEach(button => {
        button.classList.remove('active');
    });
    activeButton.classList.add('active');
}
