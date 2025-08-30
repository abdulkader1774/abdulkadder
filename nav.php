<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Quiz System'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .navbar-brand img {
            height: 40px;
            transition: transform 0.3s;
        }
        .navbar-brand:hover img {
            transform: scale(1.05);
        }
        .navbar-nav .nav-link {
            font-weight: 500;
            padding: 0.5rem 1rem;
            position: relative;
        }
        .navbar-nav .nav-link:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: #0d6efd;
            transition: width 0.3s;
        }
        .navbar-nav .nav-link:hover:after {
            width: 100%;
        }
        .profile-dropdown {
            cursor: pointer;
        }
        .profile-img {
            width: 36px;
            height: 36px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #fff;
            transition: transform 0.3s, border-color 0.3s;
        }
        .profile-img:hover {
            transform: scale(1.1);
            border-color: #0d6efd;
        }
        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .dropdown-item {
            padding: 0.5rem 1.5rem;
        }
        .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #0d6efd;
        }
        .dropdown-divider {
            margin: 0.3rem 0;
        }
        .navbar-toggler {
            border: none;
            padding: 0.5rem;
        }
        .navbar-toggler:focus {
            box-shadow: none;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <!-- Logo on the left -->
            <a class="navbar-brand d-flex" href="index.php">
                <img src="../logo.png" alt="Quiz System Logo">
                <p class = "mt-1 ms-2">BdIQPC</p>
            </a>
            
            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Main Navigation -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user-contest.php">Contests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="practice-contest.php">Practice</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user-leaderboard.php">Leaderboards</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact-with-admin.php">Contact</a>
                    </li>
                </ul>
                
                <!-- Right Side - Login/Profile -->
                <div class="d-flex align-items-center">
                    <?php if (isLoggedIn()): ?>
                        <div class="dropdown">
                            <div class="profile-dropdown" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="user/image/default-profile.jpg" alt="Profile" class="profile-img">
                            </div>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                                <?php if (isAdmin()): ?>
                                    <li><a class="dropdown-item" href="admin/change-password.php"><i class="bi bi-speedometer2 me-2"></i>Admin Dashboard</a></li>
                                <?php else: ?>
                                    <li><a class="dropdown-item" href="user/profile.php"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
                                <?php endif; ?>
                                <li><a class="dropdown-item" href="user/profile.php"><i class="bi bi-person me-2"></i>Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <div class="d-flex">
                            <a href="user-login.php" class="btn btn-outline-primary me-2">Login</a>
                            <a href="registration.php" class="btn btn-primary">Register</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
    
    <main class="flex-shrink-0">
        