<?php
session_start();
include '../include/sidebar.php';
include '../include/navbar_user.php';
$host = 'localhost';
$dbname = 'job_portal';
$username = 'root';
$password = '';
$message = ''; // Holds success or error messages

// Connect to MySQL
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("<div class='alert alert-danger'>Database connection failed: " . $e->getMessage() . "</div>");
}

// Create backups directory if it doesn't exist
$backupDir = '../backups';
if (!is_dir($backupDir)) {
    mkdir($backupDir, 0755, true);
}

// Backup Function
if (isset($_POST['backup'])) {
    $backupFileName = "backup_" . date('Y-m-d_H-i-s') . ".sql";
    $backupFilePath = $backupDir . '/' . $backupFileName;
    $command = "C:\\xampp\\mysql\\bin\\mysqldump --host=$host --user=$username --password= $dbname > \"$backupFilePath\"";
    
    exec($command, $output, $returnVar);
    if ($returnVar === 0) {
        $message = "<div class='alert alert-success'>Backup successful! <a href='../backups/{$backupFileName}' class='btn btn-sm btn-outline-success ms-2'>Download Backup</a></div>";
    } else {
        $message = "<div class='alert alert-danger'>Backup failed!</div>";
    }
}

// Restore Function
if (isset($_POST['restore'])) {
    if ($_FILES['restore_file']['error'] == UPLOAD_ERR_OK) {
        $filePath = $_FILES['restore_file']['tmp_name'];
        $command = "C:\\xampp\\mysql\\bin\\mysql --host=$host --user=$username --password= $dbname < \"$filePath\"";
        
        exec($command, $output, $returnVar);
        if ($returnVar === 0) {
            $message = "<div class='alert alert-success'>Database restored successfully!</div>";
        } else {
            $message = "<div class='alert alert-danger'>Restore failed!</div>";
        }
    } else {
        $message = "<div class='alert alert-danger'>Error uploading file.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backup & Restore Database</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="../css/navbar.css" rel="stylesheet">
    <link href="../css/sidebar.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --success-color: #4cc9f0;
            --light-bg: #f8f9fa;
            --card-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
        }
        
        body {
            background-color: var(--light-bg);
            font-family: 'Poppins', sans-serif;
        }
        
        .main-content {
            margin-left: 260px;
            margin-top: 85px;
            padding: 2.5rem;
            transition: all 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 85px);
        }
        
        .card {
            max-width: 550px;
            width: 100%;
            padding: 30px;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            border: none;
            background: white;
            position: relative;
            overflow: hidden;
        }
        
        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 8px;
            background: linear-gradient(90deg, var(--primary-color), var(--success-color));
        }
        
        .card-title {
            color: #333;
            font-weight: 600;
            margin-bottom: 30px;
            position: relative;
            display: inline-block;
        }
        
        .card-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--primary-color);
            border-radius: 10px;
        }
        
        .backup-section, .restore-section {
            background-color: #f8f9fa;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        
        .backup-section:hover, .restore-section:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.07);
        }
        
        .section-icon {
            font-size: 36px;
            color: var(--primary-color);
            margin-bottom: 15px;
        }
        
        .section-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #333;
        }
        
        .btn-custom {
            border-radius: 8px;
            padding: 12px 20px;
            font-weight: 500;
            letter-spacing: 0.3px;
            transition: all 0.3s ease;
            border: none;
        }
        
        .btn-backup {
            background: linear-gradient(45deg, var(--primary-color), #4895ef);
            color: white;
        }
        
        .btn-restore {
            background: linear-gradient(45deg, #3a0ca3, var(--secondary-color));
            color: white;
        }
        
        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }
        
        .file-input-wrapper {
            position: relative;
            margin-bottom: 20px;
            overflow: hidden;
        }
        
        .file-input-label {
            background-color: #e9ecef;
            color: #495057;
            border: 1px dashed #ced4da;
            border-radius: 8px;
            padding: 12px;
            width: 100%;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .file-input-label:hover {
            background-color: #e2e6ea;
            border-color: #adb5bd;
        }
        
        .file-input-label i {
            margin-right: 8px;
        }
        
        .hidden-file-input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }
        
        .file-name-display {
            margin-top: 10px;
            font-size: 14px;
            color: #6c757d;
            word-break: break-all;
        }
        
        .alert {
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 25px;
        }
    </style>
</head>
<body>
    <div class="main-content">
        <div class="card">
            <h3 class="card-title">Database Management</h3>
            
            <!-- Display Messages -->
            <?php if ($message) echo $message; ?>
            
            <div class="backup-section">
                <div class="section-icon">
                    <i class="fas fa-database"></i>
                </div>
                <h4 class="section-title">Backup Your Database</h4>
                <p class="text-muted mb-4">Create a backup copy of your database for safekeeping</p>
                
                <!-- Backup Form -->
                <form method="post">
                    <button type="submit" name="backup" class="btn btn-custom btn-backup w-100">
                        <i class="fas fa-download me-2"></i> Create Backup
                    </button>
                </form>
            </div>
            
            <div class="restore-section">
                <div class="section-icon">
                    <i class="fas fa-undo-alt"></i>
                </div>
                <h4 class="section-title">Restore Database</h4>
                <p class="text-muted mb-4">Restore your database from a previous backup file</p>
                
                <!-- Restore Form -->
                <form method="post" enctype="multipart/form-data">
                    <div class="file-input-wrapper">
                        <label class="file-input-label">
                            <i class="fas fa-file-import"></i> Select SQL Backup File
                            <input type="file" name="restore_file" class="hidden-file-input" accept=".sql" required id="fileInput">
                        </label>
                        <div class="file-name-display" id="fileNameDisplay">No file selected</div>
                    </div>
                    
                    <button type="submit" name="restore" class="btn btn-custom btn-restore w-100">
                        <i class="fas fa-sync-alt me-2"></i> Restore Database
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Display selected filename
        document.getElementById('fileInput').addEventListener('change', function() {
            const fileName = this.files[0]?.name || 'No file selected';
            document.getElementById('fileNameDisplay').textContent = fileName;
        });
    </script>
</body>
</html>