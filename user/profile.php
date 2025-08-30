<?php
require_once '../config.php';
requireLogin();

// Get user data
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        /* Sidebar Styles */
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
            padding: 20px 0;
            width: 280px;
            position: absolute;
            left: -280px;
            top: 0;
            z-index: 1000;
            transition: left 0.3s ease;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            /* margin-bottom: 20px; */
        }
        
        .sidebar.active {
            left: 0;
        }
        
        .sidebar-header {
            padding: 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-align: center;
        }
        
        .sidebar-profile {
            text-align: center;
            padding: 1.5rem 1rem;
        }
        
        .sidebar-profile-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #fff;
            margin-bottom: 1rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        
        .sidebar-username {
            color: #fff;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }
        
        .sidebar-role {
            color: rgba(255,255,255,0.8);
            font-size: 0.9rem;
        }
        
        .sidebar-nav {
            padding: 1rem 0;
            overflow-y: auto;
            height: calc(100vh - 280px);
        }
        
        .nav-item {
            margin: 0.25rem 0.5rem;
        }
        
        .nav-link {
            color: rgba(255,255,255,0.9) !important;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            text-decoration: none;
        }
        
        .nav-link:hover {
            background: rgba(255,255,255,0.1);
            color: #fff !important;
            transform: translateX(5px);
        }
        
        .nav-link.active {
            background: rgba(255,255,255,0.2);
            color: #fff !important;
            font-weight: 600;
        }
        
        .nav-icon {
            margin-right: 0.75rem;
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
        }
        
        .sidebar-footer {
            padding: 1rem;
            border-top: 1px solid rgba(255,255,255,0.1);
            position: absolute;
            bottom: 0;
            width: 100%;
        }
        
        .logout-btn {
            width: 100%;
            background: rgba(255,255,255,0.1);
            border: none;
            color: #fff;
            padding: 0.75rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .logout-btn:hover {
            background: rgba(255,255,255,0.2);
            transform: translateY(-2px);
        }
        
        /* Mobile Toggle Button */
        .sidebar-toggle {
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1010;
            background: #0d6efd;
            border: none;
            border-radius: 8px;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        
        .sidebar-toggle span {
            display: block;
            width: 20px;
            height: 2px;
            background: #fff;
            position: relative;
            transition: all 0.3s ease;
        }
        
        .sidebar-toggle span:before,
        .sidebar-toggle span:after {
            content: '';
            position: absolute;
            width: 20px;
            height: 2px;
            background: #fff;
            transition: all 0.3s ease;
        }
        
        .sidebar-toggle span:before {
            transform: translateY(-6px);
        }
        
        .sidebar-toggle span:after {
            transform: translateY(6px);
        }
        
        .sidebar-toggle.active span {
            background: transparent;
        }
        
        .sidebar-toggle.active span:before {
            transform: rotate(45deg);
        }
        
        .sidebar-toggle.active span:after {
            transform: rotate(-45deg);
        }
        
        /* Overlay for mobile */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 999;
            display: none;
        }
        
        /* Main content */
        .main-content {
            padding: 20px;
            transition: margin-left 0.3s ease;
        }
        
        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
        }
        
        /* Responsive */
        @media (min-width: 992px) {
            .sidebar {
                left: 0;
            }
            
            .main-content {
                margin-left: 280px;
            }
            
            .sidebar-toggle {
                display: none;
            }
            
            .sidebar-overlay {
                display: none !important;
            }
        }
        
        @media (max-width: 991.98px) {
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <?php include '../nav.php'; ?>
    
    <!-- Mobile Toggle Button -->
    <button class="sidebar-toggle mt-5" id="sidebarToggle">
        <span></span>
    </button>
    
    <!-- Overlay for mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h5 class="text-white mb-0">User Panel</h5>
        </div>
        
        <div class="sidebar-profile">
            <img src="image/default-profile.jpg" alt="Profile Image" class="sidebar-profile-img">
            <h6 class="sidebar-username"><?php echo htmlspecialchars($_SESSION['username']); ?></h6>
            <div class="sidebar-role">User</div>
        </div>
        
        <nav class="sidebar-nav">
            <div class="nav-item p-1">
                <a class="nav-link active p-1" href="profile.php">
                    <i class="nav-icon bi bi-person"></i>Profile
                </a>
            </div>
            <div class="nav-item p-1">
                <a class="nav-link p-1" href="edit-profile.php">
                    <i class="nav-icon bi bi-pencil"></i>Edit Profile
                </a>
            </div>
            <div class="nav-item p-1">
                <a class="nav-link p-1" href="notification.php">
                    <i class="nav-icon bi bi-bell"></i>Notifications
                </a>
            </div>
            <div class="nav-item p-1">
                <a class="nav-link p-1" href="user-contest.php">
                    <i class="nav-icon bi bi-trophy"></i>Mock Contests
                </a>
            </div>
            <div class="nav-item p-1">
                <a class="nav-link p-1" href="user-leaderboard.php">
                    <i class="nav-icon bi bi-bar-chart"></i>Leaderboards
                </a>
            </div>
            <div class="nav-item p-1">
                <a class="nav-link p-1" href="practice-contest.php">
                    <i class="nav-icon bi bi-book"></i>Practice
                </a>
            </div>
            <div class="nav-item p-1">
                <a class="nav-link p-1" href="practice-leaderboard.php">
                    <i class="nav-icon bi bi-graph-up"></i>Practice Results
                </a>
            </div>
            <div class="nav-item p-1">
                <a class="nav-link p-1" href="contact-with-admin.php">
                    <i class="nav-icon bi bi-envelope"></i>Contact Admin
                </a>
            </div>
            <div class="nav-item p-1">
            <a href="../logout.php" class="logout-btn d-flex align-items-center justify-content-center">
                <i class="bi bi-box-arrow-right me-1"></i>Logout
            </a>
            </div>
        </nav>
        
        <!-- <div class="sidebar-footer">
            <a href="../logout.php" class="logout-btn d-flex align-items-center justify-content-center">
                <i class="bi bi-box-arrow-right me-2"></i>Logout
            </a>
        </div> -->
    </div>
    
    <!-- Main content -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">User Profile</h1>
            </div>
            
            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img src="image/default-profile.jpg" alt="Profile Image" class="profile-img mb-3">
                        </div>
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">Username</th>
                                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                                </tr>
                                <tr>
                                    <th>Full Name</th>
                                    <td><?php echo htmlspecialchars($user['full_name'] ?: 'Not set'); ?></td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td><?php echo htmlspecialchars($user['phone'] ?: 'Not set'); ?></td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td><?php echo htmlspecialchars($user['address'] ?: 'Not set'); ?></td>
                                </tr>
                                <tr>
                                    <th>Account Created</th>
                                    <td><?php echo date('M j, Y', strtotime($user['created_at'])); ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5 pt-5"></div>
    <?php include '../footer.php'; ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            
            function toggleSidebar() {
                sidebar.classList.toggle('active');
                sidebarToggle.classList.toggle('active');
                sidebarOverlay.style.display = sidebar.classList.contains('active') ? 'block' : 'none';
            }
            
            // Toggle sidebar on button click
            sidebarToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                toggleSidebar();
            });
            
            // Close sidebar when clicking outside
            sidebarOverlay.addEventListener('click', function() {
                toggleSidebar();
            });
            
            // Close sidebar when clicking on a link (mobile)
            sidebar.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 992) {
                        toggleSidebar();
                    }
                });
            });
            
            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 992) {
                    sidebar.classList.add('active');
                    sidebarOverlay.style.display = 'none';
                } else {
                    sidebar.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>