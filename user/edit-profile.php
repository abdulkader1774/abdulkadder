<?php
require_once '../config.php';
requireLogin();

$error = '';
$success = '';

// Get user data
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        // Check if email already exists (excluding current user)
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
        $stmt->execute([$email, $_SESSION['user_id']]);
        
        if ($stmt->fetch()) {
            $error = 'Email already exists. Please use a different email.';
        } else {
            // Update profile
            $stmt = $pdo->prepare("UPDATE users SET full_name = ?, email = ?, phone = ?, address = ? WHERE id = ?");
            
            if ($stmt->execute([$full_name, $email, $phone, $address, $_SESSION['user_id']])) {
                $success = 'Profile updated successfully!';
            } else {
                $error = 'Failed to update profile. Please try again.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
/* Sidebar Base Styles */
.sidebar {
    min-height: 100vh;
    background-color: #f8f9fa;
    padding: 20px 0;
    transition: all 0.3s ease;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    position: relative;
    left: 0;
    top: 0;
    z-index: 1000;
    overflow-y: auto;
}

.sidebar .nav-link {
    color: #333;
    border-radius: 0;
    transition: all 0.2s;
    padding: 12px 20px;
    display: flex;
    align-items: center;
}

.sidebar .nav-link:hover {
    background-color: #e9ecef;
}

.sidebar .nav-link.active {
    background-color: #0d6efd;
    color: white;
}

.sidebar .nav-link.text-danger:hover {
    background-color: #dc3545;
    color: white;
}

.profile-img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 50%;
    border: 3px solid #dee2e6;
}

/* Mobile First Approach */
.sidebar {
    width: 100%;
    transform: translateX(-100%);
}

.sidebar.show {
    transform: translateX(0);
}

/* Toggle Button */
.sidebar-toggle {
    margin-top: 22%;
    position: absolute;
    top: 20px;
    left: 20px;
    z-index: 1100;
    background: #0d6efd;
    color: white;
    border: none;
    border-radius: 4px;
    padding: 8px 12px;
    display: none;
    cursor: pointer;
}

/* Backdrop for mobile */
.sidebar-backdrop {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 999;
}

/* Responsive Design */
@media (max-width: 767.98px) {
    .sidebar-toggle {
        display: block;
    }
    
    .sidebar-backdrop.show {
        display: block;
    }
    
    .sidebar {
        width: 280px;
    }
    
    .main-content {
        margin-left: 0;
        padding: 20px 15px;
    }
}

@media (min-width: 768px) and (max-width: 991.98px) {
    .sidebar {
        width: 220px;
        transform: translateX(0);
    }
    
    .main-content {
        margin-left: 220px;
        padding: 30px;
    }
}

@media (min-width: 992px) {
    .sidebar {
        width: 250px;
        transform: translateX(0);
    }
    
    .main-content {
        margin-left: 250px;
        padding: 30px;
    }
}
        .main-content {
            padding: 20px;
        }
        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <?php include '../nav.php'; ?>
    
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
             <div class = "sidebar-toggle"></div>
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
                            <a class="nav-link active" href="edit-profile.php">
                                Edit Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="notification.php">
                                Notifications
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="user-contest.php">
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
                    <h1 class="h2">Edit Profile</h1>
                </div>
                
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <?php if ($success): ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php endif; ?>
                
                <div class="card shadow">
                    <div class="card-body">
                        <form method="POST" action="">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" value="<?php echo htmlspecialchars($user['username']); ?>" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="full_name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" name="address" rows="3"><?php echo htmlspecialchars($user['address']); ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../footer.php'; ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar on mobile
document.addEventListener('DOMContentLoaded', function() {
    // Create toggle button
    const toggleButton = document.createElement('button');
    toggleButton.classList.add('sidebar-toggle');
    toggleButton.innerHTML = '☰ Menu';
    document.body.appendChild(toggleButton);
    
    // Create backdrop
    const backdrop = document.createElement('div');
    backdrop.classList.add('sidebar-backdrop');
    document.body.appendChild(backdrop);
    
    // Get sidebar element
    const sidebar = document.querySelector('.sidebar');
    
    // Toggle sidebar function
    function toggleSidebar() {
        sidebar.classList.toggle('show');
        backdrop.classList.toggle('show');
        document.body.classList.toggle('sidebar-open');
    }
    
    // Add event listeners
    toggleButton.addEventListener('click', toggleSidebar);
    backdrop.addEventListener('click', toggleSidebar);
    
    // Close sidebar when a link is clicked (on mobile)
    const navLinks = document.querySelectorAll('.sidebar .nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (window.innerWidth < 768) {
                toggleSidebar();
            }
        });
    });
    
    // Adjust main content margin based on sidebar state
    function adjustContentMargin() {
        const mainContent = document.querySelector('.main-content');
        if (!mainContent) return;
        
        if (window.innerWidth >= 768) {
            const sidebarWidth = sidebar.offsetWidth;
            mainContent.style.marginLeft = `${sidebarWidth}px`;
        } else {
            mainContent.style.marginLeft = '0';
        }
    }
    
    // Initial adjustment
    adjustContentMargin();
    
    // Adjust on resize
    window.addEventListener('resize', function() {
        adjustContentMargin();
        
        // Auto-close sidebar when resizing to larger screens
        if (window.innerWidth >= 768) {
            sidebar.classList.remove('show');
            backdrop.classList.remove('show');
        }
    });
});
    </script>
</body>
</html>