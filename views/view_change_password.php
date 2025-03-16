I'll modify the code to work with both staff_id and admin_id. Here's how we can update it:

```php
<?php
session_start();
require_once '../include/db_conn.php';

// Check if user is logged in (either staff or admin)
if (!isset($_SESSION['staff_id']) && !isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Determine user type and ID
$isAdmin = isset($_SESSION['admin_id']);
$userId = $isAdmin ? $_SESSION['admin_id'] : $_SESSION['staff_id'];
$userTable = $isAdmin ? 'admin' : 'staff';
$idField = $isAdmin ? 'admin_id' : 'staff_id';
$message = "";
$status = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $oldPassword = $_POST["old_password"];
    $newPassword = $_POST["new_password"];
    $confirmPassword = $_POST["confirm_password"];

    try {
        // Fetch current password from the appropriate table
        $stmt = $conn->prepare("SELECT password, email FROM $userTable WHERE $idField = ?");
        $stmt->execute([$userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$user) {
            $message = "User not found.";
            $status = "error";
        } 
        // Verify old password
        elseif (!password_verify($oldPassword, $user['password'])) {
            error_log("Failed password change attempt for " . ($isAdmin ? "admin" : "staff") . " ID: $userId");
            $message = "Incorrect old password.";
            $status = "error";
        } 
        elseif ($newPassword !== $confirmPassword) {
            $message = "New passwords do not match.";
            $status = "error";
        } 
        // Using specified password requirements: 1 uppercase, 1 number, at least 8 characters
        elseif (!preg_match('/^(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/', $newPassword)) {
            $message = "Password must be at least 8 characters, include 1 uppercase and 1 number.";
            $status = "error";
        } 
        else {
            // Hash new password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update password in the database with timestamp
            $updateStmt = $conn->prepare("UPDATE $userTable SET password = ? WHERE $idField = ?");
            if ($updateStmt->execute([$hashedPassword, $userId])) {
                $message = "Password changed successfully!";
                $status = "success";
            } else {
                $message = "Something went wrong. Please try again.";
                $status = "error";
            }
        }
    } catch (PDOException $e) {
        error_log("Database error in password change: " . $e->getMessage());
        $message = "An error occurred. Please try again later.";
        $status = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="../css/sidebar.css" rel="stylesheet">
    <link href="../css/navbar.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4f46e5;
            --danger-color: #ef4444;
            --success-color: #10b981;
        }
        
        body {
            background-color: #f9fafb;
        }
        
        .password-container {
            position: relative;
        }
        
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6b7280;
        }
        
        .password-strength {
            height: 5px;
            border-radius: 5px;
            margin-top: 5px;
            transition: all 0.3s;
        }
        
        .card {
            border-radius: 12px;
            border: none;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 8px;
            font-weight: 500;
            padding: 10px 20px;
            transition: all 0.2s;
        }
        
        .btn-primary:hover {
            background-color: #4338ca;
            transform: translateY(-1px);
        }
        
        .form-control {
            border-radius: 8px;
            padding: 12px;
            border: 1px solid #e5e7eb;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.2);
        }
        
        .password-requirements {
            font-size: 0.8rem;
            color: #6b7280;
            margin-top: 15px;
        }
        
        .requirement {
            margin-bottom: 5px;
            display: flex;
            align-items: center;
        }
        
        .requirement i {
            margin-right: 5px;
            width: 16px;
        }
        
        .valid {
            color: var(--success-color);
        }
        
        .invalid {
            color: #9ca3af;
        }
        
        .main-content {
            margin-left: 280px;
            margin-top: 90px;
            padding: 2rem;
            transition: margin-left 0.3s;
            min-height: 100vh;
        }
        
        .modal-success .modal-header {
            background-color: var(--success-color);
            color: white;
        }
        
        .modal-error .modal-header {
            background-color: var(--danger-color);
            color: white;
        }
        
        .modal-icon {
            font-size: 1.5rem;
            margin-right: 10px;
        }
    </style>
</head>
<body>
<?php include '../include/navbar.php'; include '../include/sidebar.php'; ?>

    <div class="main-content">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-lg p-4">
                    <div class="text-center mb-4">
                        <i class="fas fa-lock fa-3x text-primary mb-3"></i>
                        <h3>Change Your Password</h3>
                        <p class="text-muted">Ensure your account stays secure</p>
                    </div>
                    
                    <form method="POST" id="passwordForm"> 
                        <div class="mb-4">
                            <label class="form-label">Current Password</label>
                            <div class="password-container">
                                <input type="password" class="form-control" name="old_password" id="old_password" required>
                                <i class="fas fa-eye password-toggle" data-target="old_password"></i>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <div class="password-container">
                                <input type="password" class="form-control" name="new_password" id="new_password" required>
                                <i class="fas fa-eye password-toggle" data-target="new_password"></i>
                            </div>
                            <div class="password-strength" id="password-strength"></div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Confirm New Password</label>
                            <div class="password-container">
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
                                <i class="fas fa-eye password-toggle" data-target="confirm_password"></i>
                            </div>
                            <small class="text-danger" id="confirm_error"></small>
                        </div>
                        
                        <div class="password-requirements">
                            <p class="mb-2 fw-medium">Password must have:</p>
                            <div class="requirement" id="length-check">
                                <i class="fas fa-circle-notch"></i> At least 8 characters
                            </div>
                            <div class="requirement" id="uppercase-check">
                                <i class="fas fa-circle-notch"></i> At least 1 uppercase letter
                            </div>
                            <div class="requirement" id="number-check">
                                <i class="fas fa-circle-notch"></i> At least 1 number
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary py-2" id="submitBtn">
                                Update Password
                            </button>
                            <a href="../views/view_change_password.php" class="btn btn-outline-secondary py-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Modal (Success/Error) -->
    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" id="modalHeader">
                    <h5 class="modal-title" id="modalTitle">
                        <span id="modalIcon"></span>
                        <span id="modalTitleText"></span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBody"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="modalCloseBtn">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Password toggle functionality
            document.querySelectorAll('.password-toggle').forEach(icon => {
                icon.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-target');
                    const input = document.getElementById(targetId);
                    
                    if (input.type === 'password') {
                        input.type = 'text';
                        this.classList.replace('fa-eye', 'fa-eye-slash');
                    } else {
                        input.type = 'password';
                        this.classList.replace('fa-eye-slash', 'fa-eye');
                    }
                });
            });
            
            // Real-time password validation
            const newPassword = document.getElementById('new_password');
            const confirmPassword = document.getElementById('confirm_password');
            const submitBtn = document.getElementById('submitBtn');
            const confirmError = document.getElementById('confirm_error');
            const passwordStrength = document.getElementById('password-strength');
            
            // Requirements check elements
            const lengthCheck = document.getElementById('length-check').querySelector('i');
            const uppercaseCheck = document.getElementById('uppercase-check').querySelector('i');
            const numberCheck = document.getElementById('number-check').querySelector('i');
            
            function validatePassword() {
                const value = newPassword.value;
                let strength = 0;
                
                // Check length
                if(value.length >= 8) {
                    lengthCheck.className = 'fas fa-check valid';
                    document.getElementById('length-check').classList.add('valid');
                    strength += 1;
                } else {
                    lengthCheck.className = 'fas fa-circle-notch invalid';
                    document.getElementById('length-check').classList.remove('valid');
                }
                
                // Check uppercase
                if(/[A-Z]/.test(value)) {
                    uppercaseCheck.className = 'fas fa-check valid';
                    document.getElementById('uppercase-check').classList.add('valid');
                    strength += 1;
                } else {
                    uppercaseCheck.className = 'fas fa-circle-notch invalid';
                    document.getElementById('uppercase-check').classList.remove('valid');
                }
                
                // Check number
                if(/\d/.test(value)) {
                    numberCheck.className = 'fas fa-check valid';
                    document.getElementById('number-check').classList.add('valid');
                    strength += 1;
                } else {
                    numberCheck.className = 'fas fa-circle-notch invalid';
                    document.getElementById('number-check').classList.remove('valid');
                }
                
                // Update password strength indicator
                if (strength === 0) {
                    passwordStrength.style.width = '0%';
                    passwordStrength.style.backgroundColor = '#e5e7eb';
                } else if (strength === 1) {
                    passwordStrength.style.width = '33%';
                    passwordStrength.style.backgroundColor = '#ef4444';
                } else if (strength === 2) {
                    passwordStrength.style.width = '66%';
                    passwordStrength.style.backgroundColor = '#f59e0b';
                } else {
                    passwordStrength.style.width = '100%';
                    passwordStrength.style.backgroundColor = '#10b981';
                }
                
                // Check if passwords match
                if(confirmPassword.value && newPassword.value !== confirmPassword.value) {
                    confirmError.textContent = 'Passwords do not match';
                } else {
                    confirmError.textContent = '';
                }
                
                // Enable/disable submit button based on validation
                if(strength === 3 && (!confirmPassword.value || newPassword.value === confirmPassword.value)) {
                    submitBtn.disabled = false;
                } else {
                    submitBtn.disabled = true;
                }
            }
            
            newPassword.addEventListener('input', validatePassword);
            confirmPassword.addEventListener('input', validatePassword);
            
            // Display modal message if there's a server message
            <?php if (!empty($message)) : ?>
                const statusModal = new bootstrap.Modal(document.getElementById('statusModal'));
                const modalHeader = document.getElementById('modalHeader');
                const modalBody = document.getElementById('modalBody');
                const modalTitleText = document.getElementById('modalTitleText');
                const modalIcon = document.getElementById('modalIcon');
                const modalCloseBtn = document.getElementById('modalCloseBtn');
                
                if ("<?php echo $status; ?>" === "success") {
                    modalHeader.classList.add('bg-success', 'text-white');
                    modalTitleText.textContent = "Success!";
                    modalIcon.className = "fas fa-check-circle modal-icon";
                    
                    // Auto-redirect on success after modal close
                    modalCloseBtn.addEventListener('click', function() {
                        window.location.href = "../views/view_change_password.php";
                   });
                   
                   // Also set up auto-redirect when clicking outside modal or pressing ESC
                   document.getElementById('statusModal').addEventListener('hidden.bs.modal', function() {
                       window.location.href = "../views/view_change_password.php";
                   });
               } else {
                   modalHeader.classList.add('bg-danger', 'text-white');
                   modalTitleText.textContent = "Error";
                   modalIcon.className = "fas fa-exclamation-circle modal-icon";
               }
               
               modalBody.textContent = "<?php echo $message; ?>";
               statusModal.show();
           <?php endif; ?>

           // Initial validation check
           validatePassword();

           // Form submission validation
           document.getElementById('passwordForm').addEventListener('submit', function(e) {
               if (newPassword.value !== confirmPassword.value) {
                   e.preventDefault();
                   confirmError.textContent = 'Passwords do not match';
               }
           });

           // Sidebar toggle functionality
           const sidebarToggle = document.getElementById('sidebar-toggle');
           const sidebar = document.getElementById('sidebar');
           const mainContent = document.querySelector('.main-content');
           
           if (sidebarToggle) {
               sidebarToggle.addEventListener('click', function() {
                   sidebar.classList.toggle('collapsed');
                   
                   if (sidebar.classList.contains('collapsed')) {
                       mainContent.style.marginLeft = '80px';
                   } else {
                       mainContent.style.marginLeft = '280px';
                   }
               });
           }
       });
   </script>
</body>
</html>