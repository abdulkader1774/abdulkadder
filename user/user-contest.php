<?php
require_once '../config.php';
requireLogin();

// Get all mock contests
$contests = $pdo->query("
    SELECT c.id, c.title, c.description, c.duration_minutes, 
           (SELECT COUNT(*) FROM questions WHERE contest_id = c.id) AS question_count
    FROM contests c
    WHERE c.contest_type = 'mock' AND c.is_active = TRUE
    ORDER BY c.created_at DESC
")->fetchAll();

// Check if user has already attempted each contest
foreach ($contests as &$contest) {
    $stmt = $pdo->prepare("
        SELECT COUNT(*) FROM user_attempts 
        WHERE user_id = ? AND contest_id = ?
    ");
    $stmt->execute([$_SESSION['user_id'], $contest['id']]);
    $contest['attempted'] = $stmt->fetchColumn() > 0;
}
unset($contest);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mock Contests</title>
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
        .contest-card {
            transition: transform 0.2s;
            margin-bottom: 20px;
        }
        .contest-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .attempted-badge {
            position: absolute;
            top: 10px;
            right: 10px;
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
                            <a class="nav-link active" href="user-contest.php">
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
                    <h1 class="h2">Mock Contests</h1>
                </div>
                
                <?php if (empty($contests)): ?>
                    <div class="alert alert-info">No mock contests available at the moment.</div>
                <?php else: ?>
                    <div class="row">
                        <?php foreach ($contests as $contest): ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="card contest-card h-100">
                                    <?php if ($contest['attempted']): ?>
                                        <span class="badge bg-success attempted-badge">Attempted</span>
                                    <?php endif; ?>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($contest['title']); ?></h5>
                                        <p class="card-text"><?php echo htmlspecialchars($contest['description'] ?: 'No description'); ?></p>
                                        <ul class="list-group list-group-flush mb-3">
                                            <li class="list-group-item">
                                                <strong>Questions:</strong> <?php echo $contest['question_count']; ?>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Duration:</strong> 
                                                <?php echo $contest['duration_minutes'] > 0 ? 
                                                    $contest['duration_minutes'] . ' minutes' : 'No time limit'; ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-footer bg-transparent">
                                        <a href="start-contest.php?contest_id=<?php echo $contest['id']; ?>" class="btn btn-primary w-100">
                                            <?php echo $contest['attempted'] ? 'View Results' : 'Start Contest'; ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php include '../footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>