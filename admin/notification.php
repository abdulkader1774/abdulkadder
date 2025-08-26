<?php
require_once '../config.php';
requireAdmin();

$error = '';
$success = '';

// Handle notice submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $message = trim($_POST['message']);
    $recipient_id = isset($_POST['recipient_id']) && $_POST['recipient_id'] !== '' ? (int)$_POST['recipient_id'] : null;
    
    if (empty($title) || empty($message)) {
        $error = 'Please fill in all required fields.';
    } else {
        $stmt = $pdo->prepare("INSERT INTO notices (title, message, recipient_id, created_by) VALUES (?, ?, ?, ?)");
        
        if ($stmt->execute([$title, $message, $recipient_id, $_SESSION['user_id']])) {
            $success = 'Notice sent successfully!';
        } else {
            $error = 'Failed to send notice. Please try again.';
        }
    }
}

// Get all users for dropdown
$stmt = $pdo->prepare("SELECT id, username FROM users WHERE id != ? ORDER BY username");
$stmt->execute([$_SESSION['user_id']]);
$users = $stmt->fetchAll();

// Get all notices
$noticesQuery = "SELECT n.*, u.username as sender_username 
                FROM notices n 
                JOIN users u ON n.created_by = u.id 
                ORDER BY n.created_at DESC";
$notices = $pdo->query($noticesQuery)->fetchAll();

// Check if a specific user is selected from userlist
$selectedUserId = isset($_GET['user_id']) ? (int)$_GET['user_id'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Notifications</title>
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
            background-color: #dc3545;
            color: white;
        }
        .main-content {
            padding: 20px;
        }
        .notice-card {
            border-left: 4px solid #dc3545;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h5>Admin Panel</h5>
                        <p class="text-muted">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></p>
                    </div>
                    
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="change-password.php">
                                Change Password
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="userlist.php">
                                User List
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="notification.php">
                                Notifications
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin-contest-create.php">
                                Create Contest
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin-leaderboard.php">
                                Leaderboards
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="user-contact-details.php">
                                User Contacts
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
                
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <?php if ($success): ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php endif; ?>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="card shadow mb-4">
                            <div class="card-header bg-danger text-white">
                                <h5 class="mb-0">Send Notice</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="message" class="form-label">Message</label>
                                        <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="recipient_id" class="form-label">Recipient (Leave blank for all users)</label>
                                        <select class="form-select" id="recipient_id" name="recipient_id">
                                            <option value="">All Users</option>
                                            <?php foreach ($users as $user): ?>
                                                <option value="<?php echo $user['id']; ?>" <?php echo $selectedUserId === $user['id'] ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($user['username']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-danger">Send Notice</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card shadow">
                            <div class="card-header bg-danger text-white">
                                <h5 class="mb-0">Sent Notices</h5>
                            </div>
                            <div class="card-body">
                                <?php if (empty($notices)): ?>
                                    <p class="text-muted">No notices sent yet.</p>
                                <?php else: ?>
                                    <?php foreach ($notices as $notice): ?>
                                        <div class="card notice-card mb-2">
                                            <div class="card-body">
                                                <h6 class="card-title"><?php echo htmlspecialchars($notice['title']); ?></h6>
                                                <p class="card-text"><?php echo nl2br(htmlspecialchars($notice['message'])); ?></p>
                                                <small class="text-muted">
                                                    Sent by <?php echo htmlspecialchars($notice['sender_username']); ?> 
                                                    to <?php echo $notice['recipient_id'] ? 'a specific user' : 'all users'; ?>
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
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>