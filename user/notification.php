<?php
require_once '../config.php';
requireLogin();

// Get notices for this user (both general and specific)
$stmt = $pdo->prepare("SELECT n.*, u.username as sender_username 
                       FROM notices n 
                       JOIN users u ON n.created_by = u.id 
                       WHERE n.recipient_id IS NULL OR n.recipient_id = ? 
                       ORDER BY n.created_at DESC");
$stmt->execute([$_SESSION['user_id']]);
$notices = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Notifications</title>
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
        .notice-card {
            border-left: 4px solid #0d6efd;
            margin-bottom: 15px;
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
                            <a class="nav-link active" href="notification.php">
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
                            <a class="nav-link" href="contact-with-admin.php">
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
                    <h1 class="h2">Notifications</h1>
                </div>
                
                <div class="card shadow">
                    <div class="card-body">
                        <?php if (empty($notices)): ?>
                            <p class="text-muted">No notifications available.</p>
                        <?php else: ?>
                            <?php foreach ($notices as $notice): ?>
                                <div class="card notice-card mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($notice['title']); ?></h5>
                                        <p class="card-text"><?php echo nl2br(htmlspecialchars($notice['message'])); ?></p>
                                        <small class="text-muted">
                                            Sent by <?php echo htmlspecialchars($notice['sender_username']); ?> 
                                            on <?php echo date('M j, Y g:i A', strtotime($notice['created_at'])); ?>
                                        </small>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>