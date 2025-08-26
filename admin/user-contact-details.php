<?php
require_once '../config.php';
requireAdmin();

// Handle reply submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reply'])) {
    $contactId = (int)$_POST['contact_id'];
    $reply = trim($_POST['reply_message']);
    
    if (!empty($reply)) {
        $stmt = $pdo->prepare("UPDATE contacts SET admin_reply = ?, is_read = TRUE WHERE id = ?");
        $stmt->execute([$reply, $contactId]);
    }
}

// Mark as read
if (isset($_GET['mark_read'])) {
    $contactId = (int)$_GET['mark_read'];
    $stmt = $pdo->prepare("UPDATE contacts SET is_read = TRUE WHERE id = ?");
    $stmt->execute([$contactId]);
    header("Location: user-contact-details.php");
    exit();
}

// Get all contacts
$contacts = $pdo->query("
    SELECT c.*, u.username 
    FROM contacts c
    JOIN users u ON c.user_id = u.id
    ORDER BY c.is_read ASC, c.created_at DESC
")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Contact Messages</title>
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
        .unread {
            background-color: #fff8e1;
        }
        .message-card {
            border-left: 4px solid #dc3545;
            margin-bottom: 20px;
        }
        .reply-card {
            border-left: 4px solid #0d6efd;
            margin-top: 15px;
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
                    <h1 class="h2">User Contact Messages</h1>
                </div>
                
                <div class="card shadow">
                    <div class="card-body">
                        <?php if (empty($contacts)): ?>
                            <div class="alert alert-info">No contact messages found.</div>
                        <?php else: ?>
                            <?php foreach ($contacts as $contact): ?>
                                <div class="card message-card mb-3 <?php echo !$contact['is_read'] ? 'unread' : ''; ?>">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h5><?php echo htmlspecialchars($contact['subject']); ?></h5>
                                            <small class="text-muted"><?php echo date('M j, Y g:i A', strtotime($contact['created_at'])); ?></small>
                                        </div>
                                        <p class="mb-1"><strong>From:</strong> <?php echo htmlspecialchars($contact['username']); ?></p>
                                        <p class="mt-3"><?php echo nl2br(htmlspecialchars($contact['message'])); ?></p>
                                        
                                        <?php if (!$contact['is_read']): ?>
                                            <a href="?mark_read=<?php echo $contact['id']; ?>" class="btn btn-sm btn-outline-success">Mark as Read</a>
                                        <?php endif; ?>
                                        
                                        <?php if ($contact['admin_reply']): ?>
                                            <div class="card reply-card mt-3">
                                                <div class="card-body">
                                                    <h6>Admin Reply</h6>
                                                    <p><?php echo nl2br(htmlspecialchars($contact['admin_reply'])); ?></p>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <form method="POST" class="mt-3">
                                                <input type="hidden" name="contact_id" value="<?php echo $contact['id']; ?>">
                                                <div class="mb-2">
                                                    <label for="reply_message" class="form-label">Reply</label>
                                                    <textarea class="form-control" id="reply_message" name="reply_message" rows="3" required></textarea>
                                                </div>
                                                <button type="submit" name="reply" class="btn btn-sm btn-danger">Send Reply</button>
                                            </form>
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
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>