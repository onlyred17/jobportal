<?php
// Start session to access session variables
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Verify Code - PWD Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* General Styles */
        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #C6E7FF, #D4F6FF); /* New gradient background */
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            padding: 2rem;
        }

        .login-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4rem; /* Spacing between info panel and login card */
            max-width: 1200px;
            width: 100%;
        }

        /* Info Panel */
        .info-panel {
            background: #FBFBFB; /* Solid color from the palette */
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            width: 400px;
            min-height: 400px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .info-content {
            text-align: left;
        }

        .info-panel h2 {
            color: #2E3A47;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .highlight {
            color: #4A90E2;
        }

        .subtext {
            color: #6C757D;
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .benefits ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .benefits ul li {
            color: #6C757D;
            font-size: 1rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .benefits ul li i {
            color: #4A90E2;
            font-size: 1.2rem;
        }

        .support p {
            color: #6C757D;
            font-size: 1rem;
            line-height: 1.6;
        }

        .support a {
            color: #4A90E2;
            text-decoration: none;
            font-weight: 500;
        }

        .support a:hover {
            text-decoration: underline;
        }

        /* Login Card */
        .login-card {
            background-image: url('../images/bg4.jpg'); /* Solid color from the palette */
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            width: 400px;
            min-height: 400px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-card h2 {
            color:rgb(255, 255, 255);
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .form-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-control {
            background: #F8F9FA;
            border: 1px solid #E2E8F0;
            color:rgb(0, 0, 0);
            font-family: 'Roboto', sans-serif;
            font-size: 1rem;
            padding: 1rem;
            height: auto;
            width: 100%;
            border-radius: 8px;
        }

        .form-label {
            position: absolute;
            top: 50%;
            left: 1rem;
            transform: translateY(-50%);
            color:rgb(0, 8, 15);
            font-size: 0.9rem;
            transition: all 0.2s ease;
            pointer-events: none;
        }

        .form-control:focus + .form-label,
        .form-control:not(:placeholder-shown) + .form-label {
            top: 0.7rem;
            font-size: 0.8rem;
            color: #4A90E2;
        }

        .btn-primary {
            background: #4A90E2;
            border: none;
            color: #FFFFFF;
            font-family: 'Roboto', sans-serif;
            font-weight: 500;
            padding: 0.75rem;
            border-radius: 8px;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #357ABD;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .forgot-password {
            text-align: center;
            margin-top: 1rem;
        }

        .forgot-password a {
            color:rgb(0, 0, 0);
            text-decoration: none;
            font-weight: 500;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        .sign-up-link {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.95rem;
        }

        .sign-up-link a {
            color:rgb(0, 0, 0);
            text-decoration: none;
            font-weight: 500;
        }

        .sign-up-link a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                align-items: center;
                gap: 2rem; /* Smaller gap for mobile */
            }

            .info-panel, .login-card {
                width: 100%;
                margin-bottom: 2rem;
            }
        }
    </style>
</head>
<body>

<div class="container">
    
  <div class="login-container">
    <div class="info-panel">
      <div class="info-content">
        <h2><span class="highlight">Enter Code</span> sent to your email</h2>
        <p class="subtext">Check your inbox and input the code we sent.</p>
      </div>
    </div>
    <div class="login-card">
      <h2><i class="fas fa-shield-alt"></i> Verify Code</h2>

      <!-- Show error message if it exists -->
      <?php if (isset($_SESSION['error_message'])): ?>
        <!-- Modal -->
        <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Error</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <?php echo $_SESSION['error_message']; ?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <script>
          // Show the modal after page loads
          var myModal = new bootstrap.Modal(document.getElementById('errorModal'), {
            keyboard: false
          });
          myModal.show();
        </script>
        <?php unset($_SESSION['error_message']); // Clear the error message after displaying it ?>
      <?php endif; ?>

      <form action="../controllers/verify_code_admin.php" method="POST">
        <div class="form-group">
          <input type="text" class="form-control" name="code" placeholder=" " required>
          <label class="form-label">Verification Code</label>
        </div>
        <button type="submit" class="btn btn-primary">Verify</button>
      </form>
      <div class="forgot-password">
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Check if there is a success message
        <?php if (isset($_SESSION['message'])): ?>
            document.getElementById('modalBody').textContent = '<?= $_SESSION['message']; ?>';
            const successModal = new bootstrap.Modal(document.getElementById('alertModal'));
            successModal.show();
            
            // Close the modal and redirect after 3 seconds
            setTimeout(function() {
                successModal.hide(); // Close the modal
                window.location.href = '../views/view_admin_login.php'; // Redirect after closing modal
            }, 3000); // 3 seconds for the modal to be visible
        <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
    });
</script>



</body>
</html>
