<?php
require_once '../config.php';
requireLogin();

// Determine if user is admin or regular user
$isAdmin = isAdmin();
$userSidebarItems = [
    [
        'title' => 'Profile',
        'icon' => 'bi-person',
        'link' => 'profile.php',
        'active' => basename($_SERVER['PHP_SELF']) == 'profile.php'
    ],
    [
        'title' => 'Edit Profile',
        'icon' => 'bi-pencil',
        'link' => 'edit-profile.php',
        'active' => basename($_SERVER['PHP_SELF']) == 'edit-profile.php'
    ],
    [
        'title' => 'Notifications',
        'icon' => 'bi-bell',
        'link' => 'notification.php',
        'active' => basename($_SERVER['PHP_SELF']) == 'notification.php'
    ],
    [
        'title' => 'Mock Contests',
        'icon' => 'bi-trophy',
        'link' => 'user-contest.php',
        'active' => basename($_SERVER['PHP_SELF']) == 'user-contest.php'
    ],
    [
        'title' => 'Leaderboards',
        'icon' => 'bi-bar-chart',
        'link' => 'user-leaderboard.php',
        'active' => basename($_SERVER['PHP_SELF']) == 'user-leaderboard.php'
    ],
    [
        'title' => 'Practice',
        'icon' => 'bi-book',
        'link' => 'practice-contest.php',
        'active' => basename($_SERVER['PHP_SELF']) == 'practice-contest.php'
    ],
    [
        'title' => 'Practice Results',
        'icon' => 'bi-graph-up',
        'link' => 'practice-leaderboard.php',
        'active' => basename($_SERVER['PHP_SELF']) == 'practice-leaderboard.php'
    ],
    [
        'title' => 'Contact Admin',
        'icon' => 'bi-envelope',
        'link' => 'contact-with-admin.php',
        'active' => basename($_SERVER['PHP_SELF']) == 'contact-with-admin.php'
    ]
];

$adminSidebarItems = [
    [
        'title' => 'Change Password',
        'icon' => 'bi-key',
        'link' => 'change-password.php',
        'active' => basename($_SERVER['PHP_SELF']) == 'change-password.php'
    ],
    [
        'title' => 'User List',
        'icon' => 'bi-people',
        'link' => 'userlist.php',
        'active' => basename($_SERVER['PHP_SELF']) == 'userlist.php'
    ],
    [
        'title' => 'Notifications',
        'icon' => 'bi-bell',
        'link' => 'notification.php',
        'active' => basename($_SERVER['PHP_SELF']) == 'notification.php'
    ],
    [
        'title' => 'Create Contest',
        'icon' => 'bi-plus-circle',
        'link' => 'admin-contest-create.php',
        'active' => basename($_SERVER['PHP_SELF']) == 'admin-contest-create.php'
    ],
    [
        'title' => 'Leaderboards',
        'icon' => 'bi-bar-chart',
        'link' => 'admin-leaderboard.php',
        'active' => basename($_SERVER['PHP_SELF']) == 'admin-leaderboard.php'
    ],
    [
        'title' => 'User Contacts',
        'icon' => 'bi-chat-dots',
        'link' => 'user-contact-details.php',
        'active' => basename($_SERVER['PHP_SELF']) == 'user-contact-details.php'
    ]
];

$sidebarItems = $isAdmin ? $adminSidebarItems : $userSidebarItems;
$userRole = $isAdmin ? 'Admin' : 'User';
?>

<style>
    /* Sidebar Styles */
    .sidebar-container {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 280px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        z-index: 1050;
        transition: transform 0.3s ease-in-out;
        box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    }
    
    .sidebar-header {
        padding: 1.5rem 1rem;
        border-bottom: 1px solid rgba(255,255,255,0.1);
        text-align: center;
    }
    
    .sidebar-profile {
        text-align: center;
        padding: 1rem;
    }
    
    .sidebar-profile-img {
        width: 80px;
        height: 80px;
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
        height: calc(100vh - 250px);
    }
    
    .sidebar-nav::-webkit-scrollbar {
        width: 4px;
    }
    
    .sidebar-nav::-webkit-scrollbar-track {
        background: rgba(255,255,255,0.1);
    }
    
    .sidebar-nav::-webkit-scrollbar-thumb {
        background: rgba(255,255,255,0.3);
        border-radius: 2px;
    }
    
    .nav-item {
        margin: 0.25rem 0.5rem;
    }
    
    .nav-link {
        color: rgba(255,255,255,0.8) !important;
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
        z-index: 1060;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 8px;
        width: 45px;
        height: 45px;
        display: none;
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
        z-index: 1040;
        display: none;
    }
    
    /* Responsive */
    @media (max-width: 991.98px) {
        .sidebar-container {
            transform: translateX(-100%);
        }
        
        .sidebar-container.active {
            transform: translateX(0);
        }
        
        .sidebar-toggle {
            display: flex;
        }
        
        .main-content {
            margin-left: 0 !important;
            padding-left: 15px !important;
        }
    }
    
    @media (min-width: 992px) {
        .main-content {
            margin-left: 280px;
            transition: margin-left 0.3s ease;
        }
        
        .sidebar-overlay {
            display: none !important;
        }
    }
</style>

<!-- Mobile Toggle Button -->
<button class="sidebar-toggle" id="sidebarToggle">
    <span></span>
</button>

<!-- Overlay for mobile -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Sidebar Container -->
<div class="sidebar-container" id="sidebar">
    <div class="sidebar-header">
        <h5 class="text-white mb-0"><?php echo $isAdmin ? 'Admin Panel' : 'User Panel'; ?></h5>
    </div>
    
    <div class="sidebar-profile">
        <img src="image/default-profile.jpg" alt="Profile" class="sidebar-profile-img">
        <h6 class="sidebar-username"><?php echo htmlspecialchars($_SESSION['username']); ?></h6>
        <div class="sidebar-role"><?php echo $userRole; ?></div>
    </div>
    
    <nav class="sidebar-nav">
        <?php foreach ($sidebarItems as $item): ?>
            <div class="nav-item">
                <a href="<?php echo $item['link']; ?>" class="nav-link <?php echo $item['active'] ? 'active' : ''; ?>">
                    <i class="nav-icon <?php echo $item['icon']; ?>"></i>
                    <?php echo $item['title']; ?>
                </a>
            </div>
        <?php endforeach; ?>
    </nav>
    
    <div class="sidebar-footer">
        <a href="../logout.php" class="logout-btn d-flex align-items-center justify-content-center">
            <i class="bi bi-box-arrow-right me-2"></i>Logout
        </a>
    </div>
</div>

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
                sidebar.classList.remove('active');
                sidebarToggle.classList.remove('active');
                sidebarOverlay.style.display = 'none';
            }
        });
    });
</script>