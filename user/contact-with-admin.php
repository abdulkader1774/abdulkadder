<?php
require_once '../config.php';
requireLogin();

$error = '';
$success = '';

// Handle contact form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);
    
    if (empty($subject) || empty($message)) {
        $error = 'Please fill in all fields.';
    } else {
        $stmt = $pdo->prepare("INSERT INTO contacts (user_id, subject, message) VALUES (?, ?, ?)");
        
        if ($stmt->execute([$_SESSION['user_id'], $subject, $message])) {
            $success = 'Your message has been sent to the admin.';
        } else {
            $error = 'Failed to send message. Please try again.';
        }
    }
}

// Get user's previous messages
$messages = $pdo->prepare("
    SELECT subject, message, admin_reply, created_at 
    FROM contacts 
    WHERE user_id = ? 
    ORDER BY created_at DESC
");
$messages->execute([$_SESSION['user_id']]);
$messages = $messages->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #f8f9fa;
            padding: 20px 0;
        }
        .sidebar .nav-link {
            color: #333;
            border-radius: 0;
        }
        .sidebar .nav-link.active {
            background-color: #0d6efd;
            color: white;
        }
        .main-content {
            padding: 20px;
        }
        .message-card {
            border-left: 4px solid #0d6efd;
            margin-bottom: 20px;
        }
        .reply-card {
            border-left: 4px solid #dc3545;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <?php include '../nav.php'; ?>
    
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <img src="image/default-profile.jpg" alt="Profile Image" class="profile-img mb-2">
                        <h5>User Panel</h5>
                        <p class="text-muted">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></p>
                    </div>
                    
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">
                                Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="edit-profile.php">
                                Edit Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="notification.php">
                                Notifications
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user-contest.php">
                                Mock Contests
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user-leaderboard.php">
                                Leaderboards
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="practice-contest.php">
                                Practice
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="practice-leaderboard.php">
                                Practice Results
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="contact-with-admin.php">
                                Contact Admin
                            </a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link text-danger" href="../logout.php">
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Main content -->
            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Contact Admin</h1>
                </div>
                
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <?php if ($success): ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php endif; ?>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="card shadow mb-4">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Send Message</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="">
                                    <div class="mb-3">
                                        <label for="subject" class="form-label">Subject *</label>
                                        <input type="text" class="form-control" id="subject" name="subject" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="message" class="form-label">Message *</label>
                                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Send Message</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card shadow">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Previous Messages</h5>
                            </div>
                            <div class="card-body">
                                <?php if (empty($messages)): ?>
                                    <p class="text-muted">No messages sent yet.</p>
                                <?php else: ?>
                                    <?php foreach ($messages as $message): ?>
                                        <div class="card message-card mb-3">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <h6><?php echo htmlspecialchars($message['subject']); ?></h6>
                                                    <small class="text-muted"><?php echo date('M j, Y g:i A', strtotime($message['created_at'])); ?></small>
                                                </div>
                                                <p class="mt-2"><?php echo nl2br(htmlspecialchars($message['message'])); ?></p>
                                                
                                                <?php if ($message['admin_reply']): ?>
                                                    <div class="card reply-card">
                                                        <div class="card-body">
                                                            <h6>Admin Reply</h6>
                                                            <p><?php echo nl2br(htmlspecialchars($message['admin_reply'])); ?></p>
                                                        </div>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="alert alert-info mt-2 mb-0 py-2 px-3">
                                                        <small>No reply yet from admin.</small>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>