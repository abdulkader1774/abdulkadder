<?php
require_once 'config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $loginId = trim($_POST['username']); // This field now accepts either username or email
    $password = trim($_POST['password']);
    $remember = isset($_POST['remember']);
    
    if (empty($loginId) || empty($password)) {
        $error = 'Please enter both username/email and password.';
    } else {
        // Check if the input is an email or username
        $isEmail = filter_var($loginId, FILTER_VALIDATE_EMAIL);
        
        if ($isEmail) {
            // Login with email
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND role = 'user'");
        } else {
            // Login with username
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND role = 'user'");
        }
        
        $stmt->execute([$loginId]);
        
        if ($user = $stmt->fetch()) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                
                if ($remember) {
                    setRememberMeCookie($user['id']);
                }
                
                header("Location: user/profile.php");
                exit();
            } else {
                $error = 'Invalid password.';
            }
        } else {
            $error = 'User not found.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .password-toggle {
            cursor: pointer;
            position: absolute;
            right: 15px;
            top: 38px;
            color: #6c757d;
        }
        .input-group {
            position: relative;
        }
    </style>
</head>
<body>
     <?php include 'nav.php'; ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">User Login</h4>
                    </div>
                    <div class="card-body">
                        <?php if ($error): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username or E-mail</label>
                                <input type="text" class="form-control" id="username" name="username" required 
                                       placeholder="Enter your username or email address">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" 
                                           minlength="6" maxlength="16" required placeholder="Enter your password">
                                    <span class="password-toggle" id="togglePassword">
                                        <i class="far fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                        
                        <div class="mt-3 text-center">
                            <p>Don't have an account? <a href="registration.php">Register here</a></p>
                            <p>Admin? <a href="admin-login.php">Login here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <script>
        // Password visibility toggling
        document.getElementById('togglePassword').addEventListener('click', function() {
            const password = document.getElementById('password');
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>