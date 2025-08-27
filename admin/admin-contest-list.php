<?php
require_once '../config.php';
requireAdmin();

// Handle contest deletion
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $contestId = (int)$_GET['delete'];
    
    $pdo->beginTransaction();
    try {
        // Delete related records first
        $stmt = $pdo->prepare("DELETE FROM user_answers WHERE attempt_id IN (SELECT id FROM user_attempts WHERE contest_id = ?)");
        $stmt->execute([$contestId]);
        
        $stmt = $pdo->prepare("DELETE FROM user_attempts WHERE contest_id = ?");
        $stmt->execute([$contestId]);
        
        $stmt = $pdo->prepare("DELETE FROM questions WHERE contest_id = ?");
        $stmt->execute([$contestId]);
        
        $stmt = $pdo->prepare("DELETE FROM contests WHERE id = ?");
        $stmt->execute([$contestId]);
        
        $pdo->commit();
        $_SESSION['success_message'] = 'Contest deleted successfully!';
    } catch (Exception $e) {
        $pdo->rollBack();
        $_SESSION['error_message'] = 'Failed to delete contest: ' . $e->getMessage();
    }
    
    header("Location: admin-contest-list.php");
    exit();
}

// Handle contest status toggle
if (isset($_GET['toggle_status']) && is_numeric($_GET['toggle_status'])) {
    $contestId = (int)$_GET['toggle_status'];
    
    $stmt = $pdo->prepare("SELECT is_active FROM contests WHERE id = ?");
    $stmt->execute([$contestId]);
    $contest = $stmt->fetch();
    
    if ($contest) {
        $newStatus = $contest['is_active'] ? 0 : 1;
        $stmt = $pdo->prepare("UPDATE contests SET is_active = ? WHERE id = ?");
        $stmt->execute([$newStatus, $contestId]);
        
        $_SESSION['success_message'] = 'Contest status updated successfully!';
    }
    
    header("Location: admin-contest-list.php");
    exit();
}

// Get all contests with question counts and attempt counts
$contests = $pdo->query("
    SELECT c.*, 
           (SELECT COUNT(*) FROM questions WHERE contest_id = c.id) AS question_count,
           (SELECT COUNT(*) FROM user_attempts WHERE contest_id = c.id) AS attempt_count,
           u.username AS created_by_name
    FROM contests c
    LEFT JOIN users u ON c.created_by = u.id
    ORDER BY c.created_at DESC
")->fetchAll();

$pageTitle = "Manage Contests";
include '../nav.php';
// include 'sidebar.php';  //add here sidebar
?>

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

<div class="main-content d-flex">
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
                            <a class="nav-link active" href="admin-contest-list.php">
                                Contest List
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin-edit-contest.php">
                                Edit Contest
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin-leaderboard.php">
                                Leaderboards
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user-contact-details.php">
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

    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Manage Contests</h1>
            <a href="admin-contest-create.php" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Create New Contest
            </a>
        </div>

        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Questions</th>
                                <th>Attempts</th>
                                <th>Duration</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($contests)): ?>
                                <tr>
                                    <td colspan="10" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="bi bi-inbox display-4 d-block mb-3"></i>
                                            No contests found. <a href="admin-contest-create.php">Create your first contest</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($contests as $contest): ?>
                                    <tr>
                                        <td><?php echo $contest['id']; ?></td>
                                        <td>
                                            <strong><?php echo htmlspecialchars($contest['title']); ?></strong>
                                            <?php if ($contest['description']): ?>
                                                <br><small class="text-muted"><?php echo htmlspecialchars(substr($contest['description'], 0, 50)); ?>...</small>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="badge bg-<?php echo $contest['contest_type'] === 'mock' ? 'primary' : 'info'; ?>">
                                                <?php echo ucfirst($contest['contest_type']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary"><?php echo $contest['question_count']; ?></span>
                                        </td>
                                        <td>
                                            <span class="badge bg-<?php echo $contest['attempt_count'] > 0 ? 'success' : 'warning'; ?>">
                                                <?php echo $contest['attempt_count']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php echo $contest['duration_minutes'] > 0 ? 
                                                $contest['duration_minutes'] . ' min' : 'No limit'; ?>
                                        </td>
                                        <td>
                                            <span class="badge bg-<?php echo $contest['is_active'] ? 'success' : 'danger'; ?>">
                                                <?php echo $contest['is_active'] ? 'Active' : 'Inactive'; ?>
                                            </span>
                                        </td>
                                        <td><?php echo htmlspecialchars($contest['created_by_name']); ?></td>
                                        <td><?php echo date('M j, Y', strtotime($contest['created_at'])); ?></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="admin-edit-contest.php?id=<?php echo $contest['id']; ?>" 
                                                   class="btn btn-sm btn-outline-primary" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <a href="?toggle_status=<?php echo $contest['id']; ?>" 
                                                   class="btn btn-sm btn-outline-<?php echo $contest['is_active'] ? 'warning' : 'success'; ?>" 
                                                   title="<?php echo $contest['is_active'] ? 'Deactivate' : 'Activate'; ?>"
                                                   onclick="return confirm('Are you sure you want to <?php echo $contest['is_active'] ? 'deactivate' : 'activate'; ?> this contest?')">
                                                    <i class="bi bi-<?php echo $contest['is_active'] ? 'pause' : 'play'; ?>"></i>
                                                </a>
                                                <a href="?delete=<?php echo $contest['id']; ?>" 
                                                   class="btn btn-sm btn-outline-danger" 
                                                   title="Delete"
                                                   onclick="return confirm('Are you sure you want to delete this contest? This action cannot be undone.')">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../footer.php'; ?>