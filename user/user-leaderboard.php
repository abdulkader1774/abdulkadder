<?php
require_once '../config.php';
requireLogin();

// Get all mock contests
$contests = $pdo->query("SELECT id, title FROM contests WHERE contest_type = 'mock' ORDER BY created_at DESC")->fetchAll();

// Get selected contest or default to first one
$selectedContestId = isset($_GET['contest_id']) ? (int)$_GET['contest_id'] : ($contests[0]['id'] ?? 0);

// Get leaderboard for selected contest
$leaderboard = [];
if ($selectedContestId) {
    $stmt = $pdo->prepare("
        SELECT u.username, ua.score, ua.time_taken_seconds, ua.end_time
        FROM user_attempts ua
        JOIN users u ON ua.user_id = u.id
        WHERE ua.contest_id = ?
        ORDER BY ua.score DESC, ua.time_taken_seconds ASC
    ");
    $stmt->execute([$selectedContestId]);
    $leaderboard = $stmt->fetchAll();
}

// Get user's position in leaderboard
$userPosition = null;
if ($selectedContestId && !empty($leaderboard)) {
    foreach ($leaderboard as $index => $entry) {
        if ($entry['username'] === $_SESSION['username']) {
            $userPosition = $index + 1;
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contest Leaderboards</title>
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
        .leaderboard-table {
            font-size: 0.9rem;
        }
        .leaderboard-table th {
            white-space: nowrap;
        }
        .user-row {
            background-color: #e7f5ff;
            font-weight: bold;
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
                            <a class="nav-link active" href="user-leaderboard.php">
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
                    <h1 class="h2">Contest Leaderboards</h1>
                    <?php if ($userPosition): ?>
                        <div class="alert alert-info mb-0">Your position: <?php echo $userPosition; ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <form method="GET" action="" class="mb-4">
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="contest_id" class="form-label">Select Contest</label>
                                    <select class="form-select" id="contest_id" name="contest_id" onchange="this.form.submit()">
                                        <?php foreach ($contests as $contest): ?>
                                            <option value="<?php echo $contest['id']; ?>" <?php echo $contest['id'] == $selectedContestId ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($contest['title']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </form>
                        
                        <?php if ($selectedContestId && !empty($leaderboard)): ?>
                            <div class="table-responsive">
                                <table class="table table-striped leaderboard-table">
                                    <thead>
                                        <tr>
                                            <th>Rank</th>
                                            <th>Username</th>
                                            <th>Score</th>
                                            <th>Time Taken</th>
                                            <th>Completed At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($leaderboard as $index => $entry): ?>
                                            <tr class="<?php echo $entry['username'] === $_SESSION['username'] ? 'user-row' : ''; ?>">
                                                <td><?php echo $index + 1; ?></td>
                                                <td><?php echo htmlspecialchars($entry['username']); ?></td>
                                                <td><?php echo $entry['score']; ?></td>
                                                <td><?php echo gmdate("H:i:s", $entry['time_taken_seconds']); ?></td>
                                                <td><?php echo date('M j, Y g:i A', strtotime($entry['end_time'])); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-info">No attempts found for this contest.</div>
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