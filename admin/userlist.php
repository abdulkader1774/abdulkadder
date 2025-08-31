<?php
require_once '../config.php';
requireAdmin();

// Handle user deletion
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $userId = $_GET['delete'];
    
    // Don't allow admin to delete themselves
    if ($userId != $_SESSION['user_id']) {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ? AND role = 'user'");
        $stmt->execute([$userId]);
        
        if ($stmt->rowCount() > 0) {
            $_SESSION['success_message'] = 'User deleted successfully.';
        } else {
            $_SESSION['error_message'] = 'Failed to delete user or user not found.';
        }
    } else {
        $_SESSION['error_message'] = 'You cannot delete yourself.';
    }
    
    header("Location: userlist.php");
    exit();
}

// Get all users except current admin
$stmt = $pdo->prepare("SELECT * FROM users WHERE id != ? ORDER BY created_at ASC");
$stmt->execute([$_SESSION['user_id']]);
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - User List</title>
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
                    <h1 class="h2">User List</h1>
                </div>
                
                <?php if (isset($_SESSION['success_message'])): ?>
                    <div class="alert alert-success"><?php echo $_SESSION['success_message']; unset($_SESSION['success_message']); ?></div>
                <?php endif; ?>
                
                <?php if (isset($_SESSION['error_message'])): ?>
                    <div class="alert alert-danger"><?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?></div>
                <?php endif; ?>
                
                <div class="card shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Full Name</th>
                                        <th>Role</th>
                                        <th>Joined</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user): ?>
                                        <tr>
                                            <td><?php echo $user['id']; ?></td>
                                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                                            <td><?php echo htmlspecialchars($user['full_name']); ?></td>
                                            <td>
                                                <span class="badge bg-<?php echo $user['role'] === 'admin' ? 'danger' : 'primary'; ?>">
                                                    <?php echo ucfirst($user['role']); ?>
                                                </span>
                                            </td>
                                            <td><?php echo date('M j, Y', strtotime($user['created_at'])); ?></td>
                                            <td>
                                                <a href="notification.php?user_id=<?php echo $user['id']; ?>" class="btn btn-sm btn-info" title="Send Notice">
                                                    <i class="bi bi-envelope"></i> Notice
                                                </a>
                                                <a href="?delete=<?php echo $user['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')" title="Delete User">
                                                    <i class="bi bi-trash"></i> Delete
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>