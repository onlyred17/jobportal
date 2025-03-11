<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PWD Job Portal</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* Global Styles */
        html {
            font-size: 100%;
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
            transition: all 0.3s ease;
            line-height: 1.6;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
        }

        a {
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header Styles */
        header {
            background: #6200EA;
            color: white;
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        header h1 {
            margin: 0;
            font-size: 1.8rem;
            letter-spacing: 1px;
        }

        header nav {
            display: flex;
            gap: 25px;
        }

        header nav a {
            color: white;
            position: relative;
            font-weight: 500;
            padding: 5px 0;
        }

        header nav a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: white;
            transition: width 0.3s ease;
        }

        header nav a:hover::after {
            width: 100%;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #6200EA, #B388FF);
            color: white;
            padding: 100px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
            padding: 0 20px;
        }

        .hero-section h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            animation: fadeInUp 1s ease;
        }

        .hero-section p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            animation: fadeInUp 1s ease 0.2s;
            animation-fill-mode: both;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            z-index: 1;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: -100px;
            left: -100px;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            z-index: 1;
        }

        .btn-primary {
            background-color: #fff;
            color: #6200EA;
            padding: 12px 30px;
            border-radius: 30px;
            font-weight: 600;
            display: inline-block;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            animation: fadeInUp 1s ease 0.4s;
            animation-fill-mode: both;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        /* About Us Section */
        #about {
            padding: 100px 0;
            background-color: #fff;
        }

        .about-container {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
            padding: 0 20px;
        }

        #about h2 {
            font-size: 2.5rem;
            color: #6200EA;
            margin-bottom: 30px;
            position: relative;
            display: inline-block;
        }

        #about h2::after {
            content: '';
            position: absolute;
            width: 50px;
            height: 3px;
            background-color: #6200EA;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
        }

        #about p {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #555;
        }

        /* Jobs Section */
        #jobs {
            padding: 100px 0;
            background-color: #f8f9fa;
        }

        .jobs-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        #jobs h2 {
            font-size: 2.5rem;
            color: #6200EA;
            text-align: center;
            margin-bottom: 50px;
            position: relative;
            display: inline-block;
            left: 50%;
            transform: translateX(-50%);
        }

        #jobs h2::after {
            content: '';
            position: absolute;
            width: 50px;
            height: 3px;
            background-color: #6200EA;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
        }

        /* Search and Filter Container */
        .search-filter-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            margin-bottom: 50px;
            gap: 20px;
            width: 100%;
        }

        /* Search Bar */
        .search-bar {
            flex: 1;
            max-width: 500px;
            min-width: 300px;
        }

        .search-bar input {
            width: 100%;
            padding: 15px 20px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .search-bar input:focus {
            outline: none;
            border-color: #6200EA;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Filter Bar */
        .filter-bar {
            flex: 0 0 200px;
        }

        .filter-bar select {
            width: 100%;
            padding: 15px 20px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 15px;
            transition: all 0.3s ease;
        }

        .filter-bar select:focus {
            outline: none;
            border-color: #6200EA;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Job Cards */
        .job-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
        }

        .job-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .job-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .job-header {
            display: flex;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid #f0f0f0;
        }

        .company-logo {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            object-fit: cover;
            margin-right: 15px;
            border: 1px solid #f0f0f0;
        }

        .job-content {
            padding: 20px;
        }

        .job-card h3 {
            font-size: 1.2rem;
            color: #333;
            margin: 0 0 5px 0;
            transition: color 0.3s ease;
        }

        .job-card h3:hover {
            color: #6200EA;
        }

        .job-card p {
            font-size: 0.9rem;
            color: #666;
            line-height: 1.6;
            margin: 10px 0 15px;
            max-height: 85px;
            overflow: hidden;
        }

        .tags {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }

        .tag {
            background-color: #f0f0f0;
            color: #666;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .tag:nth-child(1) {
            background-color: #E3F2FD;
            color: #1976D2;
        }

        .tag:nth-child(2) {
            background-color: #E8F5E9;
            color: #388E3C;
        }

        .job-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid #f0f0f0;
        }

        .job-date {
            font-size: 0.85rem;
            color: #888;
        }

        .btn-apply {
            background-color: #6200EA;
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-apply:hover {
            background-color: #5000C2;
            transform: translateY(-2px);
        }

        /* Pagination */
        #pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 30px;
        }

        #pagination button {
            background-color: #6200EA;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        #pagination button:hover {
            background-color: #5000C2;
        }

        #pagination span {
            display: flex;
            align-items: center;
            font-weight: 600;
            color: #666;
        }

        /* Footer */
        .footer {
            background: #6200EA;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Accessibility Controls (keeping original) */
        .accessibility-toggle {
            background-color: #4A90E2;
            color: white;
            border: none;
            border-radius: 50%;
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 20px;
            cursor: pointer;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        .accessibility-toggle:hover {
            background-color: #357ABD;
        }

        .accessibility-toggle i {
            font-size: 24px;
        }

        .accessibility-controls {
            background: #ffffff;
            color: #000000;
            border: 2px solid #FFFFFF;
            position: fixed;
            bottom: 90px;
            right: 20px;
            padding: 10px;
            display: none;
            z-index: 999;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            font-size: x-large;
        }

        .accessibility-controls.active {
            display: block;
        }

        .font-size-controls, .brightness-controls {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .font-size-controls button, .brightness-controls button {
            margin: 0 5px;
            padding: 5px 10px;
            background: #4A90E2;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .font-size-controls span, .brightness-controls span {
            margin: 0 10px;
            min-width: 20px;
            text-align: center;
        }

        .toggle-btn {
            margin-right: 10px;
            padding: 15px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: medium;
            font-weight: bold;
        }

        .toggle-btn.active {
            background: #4A90E2;
            color: white;
        }

       /* Enhanced Dark Mode */
body.dark-mode {
    background: #121212;
    color: #f5f7fa;
}

body.dark-mode header {
    background: #1f1f1f;
    color: white;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
}

body.dark-mode .hero-section {
    background: linear-gradient(135deg, #3a0080, #6200EA);
}

body.dark-mode #about {
    background-color: #1f1f1f;
}

body.dark-mode #about h2 {
    color: #B388FF;
}

body.dark-mode #about h2::after {
    background-color: #B388FF;
}

body.dark-mode #about p {
    color: #e0e0e0;
}

body.dark-mode #jobs {
    background-color: #121212;
}

body.dark-mode #jobs h2 {
    color: #B388FF;
}

body.dark-mode #jobs h2::after {
    background-color: #B388FF;
}

body.dark-mode .search-bar input {
    background-color: #2d2d2d;
    color: white;
    border: 1px solid #444;
}

body.dark-mode .filter-bar select {
    background-color: #2d2d2d;
    color: white;
    border: 1px solid #444;
}

body.dark-mode .job-card {
    background: #2d2d2d;
    border: 1px solid #444;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

body.dark-mode .job-card h3 {
    color: #f5f7fa;
}

body.dark-mode .job-card p {
    color: #bbb;
}

body.dark-mode .job-header {
    border-bottom: 1px solid #444;
}

body.dark-mode .company-logo {
    border: 1px solid #444;
}

body.dark-mode .tag {
    background-color: #444;
    color: #ddd;
}

body.dark-mode .tag:nth-child(1) {
    background-color: #1565C0;
    color: #e3f2fd;
}

body.dark-mode .tag:nth-child(2) {
    background-color: #2E7D32;
    color: #e8f5e9;
}

body.dark-mode .job-footer {
    border-top: 1px solid #444;
}

body.dark-mode .job-date {
    color: #aaa;
}

body.dark-mode #pagination button {
    background-color: #6200EA;
}

body.dark-mode #pagination span {
    color: #ddd;
}

body.dark-mode .accessibility-controls {
    background: #2d2d2d;
    color: white;
    border: 2px solid #444;
}

body.dark-mode .toggle-btn {
    background: #444;
    color: white;
}

body.dark-mode .toggle-btn.active {
    background: #6200EA;
}

/* Enhanced High Contrast Mode */
body.high-contrast {
    background: #000000;
    color: #FFFFFF;
}

body.high-contrast header {
    background: #000000;
    color: #FFFFFF;
    border-bottom: 2px solid #FFFFFF;
    box-shadow: none;
}

body.high-contrast header h1 {
    color: #FFFFFF;
}

body.high-contrast header nav a {
    color: #FFFFFF;
    font-weight: bold;
}

body.high-contrast header nav a::after {
    background-color: #FFFF00;
    height: 3px;
}

body.high-contrast .hero-section {
    background: #000000;
    color: #FFFFFF;
    border-bottom: 2px solid #FFFFFF;
}

body.high-contrast .hero-section::before,
body.high-contrast .hero-section::after {
    display: none;
}

body.high-contrast #about {
    background: #000000;
    color: #FFFFFF;
    border-bottom: 2px solid #FFFFFF;
}

body.high-contrast #about h2 {
    color: #FFFFFF;
}

body.high-contrast #about h2::after {
    background-color: #FFFF00;
}

body.high-contrast #jobs {
    background: #000000;
    color: #FFFFFF;
}

body.high-contrast #jobs h2 {
    color: #FFFFFF;
}

body.high-contrast #jobs h2::after {
    background-color: #FFFF00;
}

body.high-contrast .search-bar input {
    background: #000000;
    color: #FFFFFF;
    border: 2px solid #FFFFFF;
}

body.high-contrast .filter-bar select {
    background: #000000;
    color: #FFFFFF;
    border: 2px solid #FFFFFF;
}

body.high-contrast .search-bar input:focus,
body.high-contrast .filter-bar select:focus {
    outline: 2px solid #FFFF00;
    box-shadow: none;
}

body.high-contrast .job-card {
    background: #000000;
    color: #FFFFFF;
    border: 2px solid #FFFFFF;
    box-shadow: none;
}

body.high-contrast .job-card:hover {
    transform: translateY(-5px);
    outline: 2px solid #FFFF00;
}

body.high-contrast .job-header {
    border-bottom: 2px solid #FFFFFF;
}

body.high-contrast .company-logo {
    border: 2px solid #FFFFFF;
}

body.high-contrast .job-card h3 {
    color: #FFFFFF;
    font-weight: bold;
}

body.high-contrast .job-card h3:hover {
    color: #FFFF00;
}

body.high-contrast .job-card p {
    color: #FFFFFF;
}

body.high-contrast .tags {
    margin-bottom: 15px;
}

body.high-contrast .tag {
    background: #000000;
    color: #FFFFFF;
    border: 2px solid #FFFFFF;
    font-weight: bold;
}

body.high-contrast .tag:nth-child(1) {
    background: #000000;
    color: #FFFFFF;
    border: 2px solid #FFFF00;
}

body.high-contrast .tag:nth-child(2) {
    background: #000000;
    color: #FFFFFF;
    border: 2px solid #00FFFF;
}

body.high-contrast .job-footer {
    border-top: 2px solid #FFFFFF;
}

body.high-contrast .job-date {
    color: #FFFFFF;
    font-weight: bold;
}

body.high-contrast .btn-primary {
    background: #000000;
    color: #FFFFFF;
    border: 2px solid #FFFF00;
    font-weight: bold;
}

body.high-contrast .btn-primary:hover {
    background: #FFFF00;
    color: #000000;
    box-shadow: none;
}

body.high-contrast .btn-apply {
    background: #000000;
    color: #FFFFFF;
    border: 2px solid #FFFF00;
    font-weight: bold;
}

body.high-contrast .btn-apply:hover {
    background: #FFFF00;
    color: #000000;
}

body.high-contrast #pagination button {
    background: #000000;
    color: #FFFFFF;
    border: 2px solid #FFFFFF;
    font-weight: bold;
}

body.high-contrast #pagination button:hover {
    background: #FFFFFF;
    color: #000000;
}

body.high-contrast #pagination span {
    color: #FFFFFF;
    font-weight: bold;
}

body.high-contrast .accessibility-toggle {
    background: #000000;
    color: #FFFFFF;
    border: 2px solid #FFFFFF;
}

body.high-contrast .accessibility-toggle:hover {
    background: #FFFFFF;
    color: #000000;
}

body.high-contrast .accessibility-controls {
    background: #000000;
    color: #FFFFFF;
    border: 2px solid #FFFFFF;
}

body.high-contrast .font-size-controls button, 
body.high-contrast .brightness-controls button,
body.high-contrast #reset-all {
    background: #000000;
    color: #FFFFFF;
    border: 2px solid #FFFFFF;
}

body.high-contrast .font-size-controls button:hover, 
body.high-contrast .brightness-controls button:hover,
body.high-contrast #reset-all:hover {
    background: #FFFFFF;
    color: #000000;
}

body.high-contrast .toggle-btn {
    background: #000000;
    color: #FFFFFF;
    border: 2px solid #FFFFFF;
}

body.high-contrast .toggle-btn.active {
    background: #FFFFFF;
    color: #000000;
    border: 2px solid #FFFF00;
}

body.high-contrast .footer {
    background: #000000;
    color: #FFFFFF;
    border-top: 2px solid #FFFFFF;
}

        /* Responsive Design */
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                gap: 15px;
            }

            header nav {
                width: 100%;
                justify-content: space-around;
            }

            .hero-section h1 {
                font-size: 2.2rem;
            }

            .hero-section p {
                font-size: 1rem;
            }

            .search-filter-container {
                flex-direction: column;
                align-items: stretch;
            }

            .search-bar, .filter-bar {
                width: 100%;
                max-width: none;
            }

            .job-cards {
                grid-template-columns: 1fr;
            }
        }
        /* Modern About Us Section Styles */
#about {
    padding: 100px 0;
    background-color: #fff;
}

.about-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

#about h2 {
    font-size: 2.5rem;
    color: #6200EA;
    margin-bottom: 40px;
    text-align: center;
    position: relative;
    display: inline-block;
    left: 50%;
    transform: translateX(-50%);
}

#about h2::after {
    content: '';
    position: absolute;
    width: 50px;
    height: 3px;
    background-color: #6200EA;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
}

.about-content {
    display: flex;
    flex-direction: column;
    gap: 40px;
}

.about-text p {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #555;
    margin-bottom: 30px;
    text-align: center;
}

.about-features {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-top: 40px;
}

.feature {
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.feature:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
}

.feature i {
    font-size: 2.5rem;
    color: #6200EA;
    margin-bottom: 20px;
}

.feature h3 {
    font-size: 1.3rem;
    color: #333;
    margin-bottom: 15px;
}

.feature p {
    font-size: 1rem;
    color: #666;
    line-height: 1.6;
}

.about-cta {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 50px;
}

.btn-secondary {
    background-color: transparent;
    color: #6200EA;
    border: 2px solid #6200EA;
    padding: 12px 30px;
    border-radius: 30px;
    font-weight: 600;
    display: inline-block;
    transition: all 0.3s ease;
}

.btn-secondary:hover {
    background-color: #6200EA;
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

/* Enhanced Footer Styles */
.footer {
    background: #6200EA;
    color: white;
    padding: 60px 0 20px;
}

.footer-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.footer-content {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 40px;
    margin-bottom: 40px;
}

.footer-section h3 {
    font-size: 1.2rem;
    margin-bottom: 20px;
    position: relative;
    padding-bottom: 10px;
}

.footer-section h3::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 40px;
    height: 2px;
    background-color: #B388FF;
}

.footer-section p {
    margin-bottom: 20px;
    line-height: 1.6;
}

.social-links {
    display: flex;
    gap: 15px;
    margin-top: 20px;
}

.social-links a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    transition: all 0.3s ease;
}

.social-links a:hover {
    background-color: rgba(255, 255, 255, 0.2);
    transform: translateY(-3px);
}

.social-links i {
    font-size: 1.2rem;
}

.footer-section ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-section ul li {
    margin-bottom: 10px;
}

.footer-section ul li a {
    color: #e0e0e0;
    transition: all 0.3s ease;
    position: relative;
    padding-left: 15px;
}

.footer-section ul li a::before {
    content: '›';
    position: absolute;
    left: 0;
    transition: transform 0.3s ease;
}

.footer-section ul li a:hover {
    color: #fff;
    padding-left: 20px;
}

.footer-section ul li a:hover::before {
    transform: translateX(5px);
}

.contact-info li {
    display: flex;
    align-items: flex-start;
    margin-bottom: 15px;
}

.contact-info li i {
    margin-right: 10px;
    color: #B388FF;
    font-size: 1.1rem;
    margin-top: 4px;
}

.footer-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    padding-top: 20px;
    flex-wrap: wrap;
    gap: 15px;
}

.footer-links {
    display: flex;
    gap: 20px;
}

.footer-links a {
    color: #e0e0e0;
    font-size: 0.9rem;
    transition: color 0.3s ease;
}

.footer-links a:hover {
    color: #fff;
}

/* Dark Mode Footer & About Us */
body.dark-mode #about {
    background-color: #1f1f1f;
}

body.dark-mode .feature {
    background-color: #2d2d2d;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

body.dark-mode .feature h3 {
    color: #f5f7fa;
}

body.dark-mode .feature p {
    color: #bbb;
}

body.dark-mode .btn-secondary {
    color: #B388FF;
    border-color: #B388FF;
}

body.dark-mode .btn-secondary:hover {
    background-color: #B388FF;
    color: #1f1f1f;
}

/* High Contrast Footer & About Us */
body.high-contrast #about {
    background: #000000;
}

body.high-contrast .feature {
    background: #000000;
    box-shadow: none;
    border: 2px solid #FFFFFF;
}

body.high-contrast .feature:hover {
    transform: translateY(-5px);
    outline: 2px solid #FFFF00;
}

body.high-contrast .feature i {
    color: #FFFFFF;
}

body.high-contrast .feature h3 {
    color: #FFFFFF;
}

body.high-contrast .feature p {
    color: #FFFFFF;
}

body.high-contrast .btn-secondary {
    background: #000000;
    color: #FFFFFF;
    border: 2px solid #FFFFFF;
}

body.high-contrast .btn-secondary:hover {
    background: #FFFFFF;
    color: #000000;
}

body.high-contrast .footer {
    background: #000000;
    border-top: 2px solid #FFFFFF;
}

body.high-contrast .footer-section h3::after {
    background-color: #FFFF00;
}

body.high-contrast .social-links a {
    background-color: #000000;
    border: 2px solid #FFFFFF;
}

body.high-contrast .social-links a:hover {
    background-color: #FFFFFF;
}

body.high-contrast .social-links a:hover i {
    color: #000000;
}

body.high-contrast .footer-section ul li a::before {
    color: #FFFF00;
}

body.high-contrast .contact-info li i {
    color: #FFFF00;
}

body.high-contrast .footer-bottom {
    border-top: 1px solid #FFFFFF;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .about-features {
        grid-template-columns: 1fr;
    }
    
    .about-cta {
        flex-direction: column;
        align-items: center;
    }
    
    .footer-content {
        grid-template-columns: 1fr;
    }
    
    .footer-bottom {
        flex-direction: column;
        text-align: center;
    }
    
    .footer-links {
        flex-wrap: wrap;
        justify-content: center;
    }
}
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
                <h3>Resources</h3>
                <ul>
                    <li><a href="#">Accessibility Guide</a></li>
                    <li><a href="#">PWD Rights</a></li>
                    <li><a href="#">Employer Resources</a></li>
                    <li><a href="#">Success Stories</a></li>
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
                        <div class="job-header">
                            <img src="${job.company_logo}" alt="Company Logo" class="company-logo">
                            <h3>${job.title}</h3>
                        </div>
                        <div class="job-content">
                            <p>${job.description}</p>
                            <div class="tags">
                                <span class="tag">${job.job_type}</span>
                                <span class="tag">${job.location}</span>
                            </div>
                            <div class="job-footer">
                                <span class="job-date">Posted ${formatDate(job.posted_date)}</span>
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