<?php
require_once 'config.php';

$error = '';
$success = '';

// Handle form submission
// Name in bangla
//Name in english
// email
// phone
//gender
// date of birth
// institute in english
// institute in bangla
// class
// category
// contest
// division
// district
// upozila
// password
// confirm password

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $nameinbangla = trim($_POST['banglaName']);
    $nameinenglish = trim($_POST['englishName']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $gender = trim($_POST['gender']);
    $dob = trim($_POST['dob']);
    $instituteinenglish = trim($_POST['englishinstitute']);
    $instituteinbangla = trim($_POST['banglainstitute']);
    $class = trim($_POST['class']);
    $category = trim($_POST['category']);
    $contest = trim($_POST['contest']);
    $division = trim($_POST['division']);
    $district = trim($_POST['district']);
    $upozila = trim($_POST['upozila']);
    $password = trim($_POST['password']);

    // $username = trim($_POST['username']);
    // $password = trim($_POST['password']);
    // $email = trim($_POST['email']);
    // $full_name = trim($_POST['full_name']);
    
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

            $address = $division."/".$district."/".$upozila;

            // Hash password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            // Insert new user
            $stmt = $pdo->prepare("INSERT INTO users (banglaname, englishname, englishinstitute, banglainstitute, class, category, contest, password, email, phone, address ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            if ($stmt->execute([$nameinbangla, $nameinenglish, $instituteinenglish, $instituteinbangla, $])) {
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
    <title>Student Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .registration-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 30px;
            margin-bottom: 30px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            color: #3f51b5;
        }
        .header h2 {
            font-weight: 700;
        }
        .form-section {
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        .form-section-title {
            color: #3f51b5;
            margin-bottom: 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
        }
        .form-section-title i {
            margin-right: 10px;
            font-size: 1.2rem;
        }
        .password-toggle {
            cursor: pointer;
            position: absolute;
            right: 15px;
            top: 38px;
            color: #6c757d;
        }
        .btn-register {
            background-color: #3f51b5;
            color: white;
            padding: 12px 30px;
            font-weight: 600;
            border: none;
            width: 100%;
            margin-top: 20px;
            transition: all 0.3s;
        }
        .btn-register:hover {
            background-color: #303f9f;
            transform: translateY(-2px);
        }
        .select-icon {
            position: relative;
        }
        .select-icon:after {
            content: "▼";
            font-size: 12px;
            position: absolute;
            right: 15px;
            top: 42px;
            color: #6c757d;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="registration-container">
                    <div class="header">
                        <h2><i class="fas fa-user-graduate"></i> Student Registration Form</h2>
                        <p class="text-muted">Please fill in all the required information</p>
                    </div>

                    <form id="registrationForm" method="POST" >

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="banglaName" class="form-label">Name in Bangla</label>
                                    <input type="text" class="form-control" id="banglaName" name="banglaName" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="englishName" class="form-label">Name in English</label>
                                    <input type="text" class="form-control" id="englishName" name="englishName" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" required>
                                </div>
                                
                                
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select" id="gender" name="gender" required>
                                        <option value="no" selected disabled>Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <!-- <option value="other">Ohter</option> -->

                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="dob" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" id="dob" name="dob" required>
                                </div>

                            </div>


                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label for="englishinstitute" class="form-label">Institute English</label>
                                    <input type="text" class="form-control" id="englishinstitute" name="englishinstitute" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="banglainstitute" class="form-label">Institute Bangla</label>
                                    <input type="text" class="form-control" id="banglainstitute" name="banglainstitute" required>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="class" class="form-label">Class</label>
                                    <select class="form-select select-icon" id="class" name="class" required>
                                        <option value="" selected disabled>Select Class</option>
                                        <option value="6">Class 6</option>
                                        <option value="7">Class 7</option>
                                        <option value="8">Class 8</option>
                                        <option value="9">Class 9</option>
                                        <option value="10">Class 10</option>
                                        <option value="11">Class 11</option>
                                        <option value="12">Class 12</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="category" class="form-label">Category</label>
                                    <input type="text" class="form-control" id="category" name="category" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="contest" class="form-label">Contest</label>
                                    <select class="form-select" id="contest" name="contest" required>
                                        <option value="" selected disabled>Select Contest</option>
                                        <option value="programming">Programming</option>
                                        <option value="quiz">Quiz</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="division" class="form-label">Division</label>
                                    <select class="form-select" id="division" name="division" required>
                                        <option value="" selected disabled>Select Division</option>
                                        <option value="dhaka">Dhaka</option>
                                        <option value="chattogram">Chattogram</option>
                                        <option value="rajshahi">Rajshahi</option>
                                        <option value="khulna">Khulna</option>
                                        <option value="barishal">Barishal</option>
                                        <option value="sylhet">Sylhet</option>
                                        <option value="rangpur">Rangpur</option>
                                        <option value="mymensingh">Mymensingh</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="district" class="form-label">District</label>
                                    <select class="form-select" id="district" name="district" required>
                                        <option value="" selected disabled>Select District</option>
                                        <!-- Districts will be populated based on division selection -->
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="upozila" class="form-label">Upozela</label>
                                    <select class="form-select" id="upozela" name="upozila" required>
                                        <option value="" selected disabled>Select Upozela</option>
                                        <!-- Upozela will be populated based on district selection -->
                                    </select>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control" id="password" name="password" required>
                                        <span class="password-toggle" id="togglePassword">
                                            <i class="far fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control" id="confirmPassword" required>
                                        <span class="password-toggle" id="toggleConfirmPassword">
                                            <i class="far fa-eye"></i>
                                        </span>
                                    </div>
                                    <div class="invalid-feedback" id="passwordError">
                                        Passwords do not match!
                                    </div>
                                </div>
                            </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-register">Register Now</button>
                        </div>
                    </form>
                                            <div class="mt-3 text-center">
                            <p>Already have an account? <a href="user-login.php">Login here</a></p>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <form method="POST" action="">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="full_name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="full_name" name="full_name">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Register</button>
    </form> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Category auto-selection based on class
            const classSelect = document.getElementById('class');
            const categoryInput = document.getElementById('category');
            
            classSelect.addEventListener('change', function() {
                const selectedClass = parseInt(this.value);
                if (selectedClass >= 6 && selectedClass <= 10) {
                    categoryInput.value = 'Junior';
                } else if (selectedClass === 11 || selectedClass === 12) {
                    categoryInput.value = 'Senior';
                } else {
                    categoryInput.value = '';
                }
            });

            // Password visibility toggling
            const togglePassword = document.getElementById('togglePassword');
            const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirmPassword');
            const passwordError = document.getElementById('passwordError');

            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });

            toggleConfirmPassword.addEventListener('click', function() {
                const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmPassword.setAttribute('type', type);
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });

            // Password matching validation
            confirmPassword.addEventListener('input', function() {
                if (password.value !== confirmPassword.value) {
                    confirmPassword.classList.add('is-invalid');
                    passwordError.style.display = 'block';
                } else {
                    confirmPassword.classList.remove('is-invalid');
                    passwordError.style.display = 'none';
                }
            });

            // Sample data for districts and upozelas (in a real app, this would come from a database)
            const divisionDistricts = {
                dhaka: ['Dhaka', 'Gazipur', 'Narayanganj', 'Tangail', 'Kishoreganj'],
                chattogram: ['Chattogram', 'Cox\'s Bazar', 'Comilla', 'Feni', 'Brahmanbaria'],
                rajshahi: ['Rajshahi', 'Bogura', 'Pabna', 'Sirajganj', 'Natore'],
                khulna: ['Khulna', 'Satkhira', 'Jessore', 'Bagerhat', 'Chuadanga'],
                barishal: ['Barishal', 'Patuakhali', 'Bhola', 'Pirojpur', 'Jhalokati'],
                sylhet: ['Sylhet', 'Moulvibazar', 'Habiganj', 'Sunamganj'],
                rangpur: ['Rangpur', 'Dinajpur', 'Gaibandha', 'Kurigram', 'Nilphamari'],
                mymensingh: ['Mymensingh', 'Netrokona', 'Jamalpur', 'Sherpur']
            };

            const districtUpozelas = {
                Dhaka: ['Dhamrai', 'Dohar', 'Keraniganj', 'Nawabganj', 'Savar'],
                Gazipur: ['Gazipur Sadar', 'Kaliakair', 'Kaliganj', 'Kapasia', 'Sreepur'],
                Narayanganj: ['Narayanganj Sadar', 'Araihazar', 'Bandar', 'Rupganj', 'Sonargaon'],
                Tangail: ['Tangail Sadar', 'Basail', 'Bhuapur', 'Delduar', 'Ghatail'],
                Kishoreganj: ['Kishoreganj Sadar', 'Austagram', 'Bajitpur', 'Bhairab', 'Hossainpur'],
                Chattogram: ['Chattogram Sadar', 'Anwara', 'Banshkhali', 'Boalkhali', 'Chandanaish'],
                'Cox\'s Bazar': ['Cox\'s Bazar Sadar', 'Chakaria', 'Kutubdia', 'Maheshkhali', 'Ramu'],
                Comilla: ['Comilla Sadar', 'Barura', 'Brahmanpara', 'Burichang', 'Chandina']
            };

            // Populate districts based on division selection
            const divisionSelect = document.getElementById('division');
            const districtSelect = document.getElementById('district');
            const upozelaSelect = document.getElementById('upozela');

            divisionSelect.addEventListener('change', function() {
                const division = this.value;
                const districts = divisionDistricts[division] || [];
                
                // Clear previous options
                districtSelect.innerHTML = '<option value="" selected disabled>Select District</option>';
                upozelaSelect.innerHTML = '<option value="" selected disabled>Select Upozela</option>';
                
                // Add new options
                districts.forEach(district => {
                    const option = document.createElement('option');
                    option.value = district.toLowerCase();
                    option.textContent = district;
                    districtSelect.appendChild(option);
                });
            });

            // Populate upozelas based on district selection
            districtSelect.addEventListener('change', function() {
                const district = this.options[this.selectedIndex].textContent;
                const upozelas = districtUpozelas[district] || [];
                
                // Clear previous options
                upozelaSelect.innerHTML = '<option value="" selected disabled>Select Upozela</option>';
                
                // Add new options
                upozelas.forEach(upozela => {
                    const option = document.createElement('option');
                    option.value = upozela.toLowerCase();
                    option.textContent = upozela;
                    upozelaSelect.appendChild(option);
                });
            });

            // Form submission
            document.getElementById('registrationForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Validate passwords match
                if (password.value !== confirmPassword.value) {
                    confirmPassword.classList.add('is-invalid');
                    passwordError.style.display = 'block';
                    return;
                }
                
                // If validation passes, show success message
                alert('Registration Successful!');
                // In a real application, you would submit the form data to a server here
            });
        });
    </script>
</body>
</html>