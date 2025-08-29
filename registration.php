<?php
require_once 'config.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);
    $full_name = trim($_POST['full_name']);
    
    // Validate input
    if (empty($username) || empty($password) || empty($email)) {
        $error = 'Please fill in all required fields.';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters long.';
    } else {
        // Check if username or email already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        
        if ($stmt->fetch()) {
            $error = 'Username or email already exists.';
        } else {
            // Hash password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            // Insert new user
            $stmt = $pdo->prepare("INSERT INTO users (username, password, email, full_name) VALUES (?, ?, ?, ?)");
            if ($stmt->execute([$username, $hashedPassword, $email, $full_name])) {
                $success = 'Registration successful! You can now login.';
            } else {
                $error = 'Registration failed. Please try again.';
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
    <title>User Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include "nav.php" ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">User Registration</h4>
                    </div>
                    <div class="card-body">
                        <?php if ($error): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <?php if ($success): ?>
                            <div class="alert alert-success"><?php echo $success; ?></div>
                        <?php endif; ?>
                        
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class=" d-flex">
                                <div class="name english">
                                    <label for="name-english" class="form-label">Name(English)</label>
                                    <input type="text" class="form-control" id="nameenglish" name="nameenglish" required>
                                </div>
                                    <div class="name bangla">
                                    <label for="name-bangla" class="form-label">Name(Bangla)</label>
                                    <input type="text" class="form-control" id="namebangla" name="namebangla" required>
                                </div>
                            </div>

                            <div class=" d-flex">
                                <div class="email">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" required>
                                </div>
                                    <div class="phone">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" required>
                                </div>
                            </div>

                            <div class=" d-flex">
                                <div class="gender">
                                    <label for="gender" class="form-label">Gender</label>
                                    <input type="text" class="form-control" id="gender" name="gender" required>
                                </div>
                                    <div class="dateofbirth">
                                    <label for="dateofbirth" class="form-label">Date of Birth</label>
                                    <input type="text" class="form-control" id="dateofbirth" name="dateofbirth" required>
                                </div>
                            </div>

                            <div class=" d-flex">
                                <div class="institute-english">
                                    <label for="institute-english" class="form-label">Institute(English)</label>
                                    <input type="text" class="form-control" id="institute-english" name="institute-english" required>
                                </div>
                                    <div class="institute-bangla">
                                    <label for="institute-bangla" class="form-label">Institute(Bangla)</label>
                                    <input type="text" class="form-control" id="institute-bangla" name="institute-bangla" required>
                                </div>
                            </div>

                            
                            <div class=" d-flex">
                                <div class="medium">
                                    <label for="medium" class="form-label">Medium</label>
                                    <input type="text" class="form-control" id="medium" name="medium" required>
                                </div>

                                <div class="class">
                                    <label for="class" class="form-label">Class</label>
                                    <input type="text" class="form-control" id="class" name="class" required>
                                </div>

                                <div class="catagori">
                                    <label for="catagori" class="form-label">Catagori</label>
                                    <input type="select" class="form-control" id="catagori" name="catagori" required>
                                    <select name="data" id="">
                                        <option value="1">hello</option>
                                    </select>
                                </div>
                            </div>

                            <div class=" d-flex">

                            
                                <div class="division">
                                    <label for="division" class="form-label">Division</label>
                                    <input type="text" class="form-control" id="division" name="division" required>
                                </div>

                                <div class="district">
                                    <label for="district" class="form-label">District</label>
                                    <input type="text" class="form-control" id="district" name="district" required>
                                </div>


                                <div class="upozila">
                                    <label for="upozila" class="form-label">Upozila</label>
                                    <input type="text" class="form-control" id="upozila" name="upozila" required>
                                </div>
                            </div>

                            <div class=" d-flex">
                                <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <div class="mb-3">
                                <label for="confiram-password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confiram-password" name="confiram-password" required>
                            </div>
                            </div>

                            <!-- <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div> -->

                            <!-- <div class="mb-3">
                                <label for="full_name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="full_name" name="full_name">
                            </div> -->

                            <button type="submit" class="btn btn-primary w-100">Register</button>
                        </form>
                        
                        <div class="mt-3 text-center">
                            <p>Already have an account? <a href="user-login.php">Login here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "footer.php" ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>