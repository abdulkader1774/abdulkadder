<?php
require_once '../config.php';
requireAdmin();

$error = '';
$success = '';

// Handle contest creation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_contest'])) {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $contest_type = $_POST['contest_type'];
    $duration = (int)$_POST['duration'];
    
    if (empty($title)) {
        $error = 'Contest title is required.';
    } else {
        $pdo->beginTransaction();
        
        try {
            // Insert contest
            $stmt = $pdo->prepare("INSERT INTO contests (title, description, contest_type, duration_minutes, created_by) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$title, $description, $contest_type, $duration, $_SESSION['user_id']]);
            $contest_id = $pdo->lastInsertId();
            
            // Insert questions
            foreach ($_POST['questions'] as $question) {
                if (!empty($question['text'])) {
                    $stmt = $pdo->prepare("INSERT INTO questions (contest_id, question_text, option1, option2, option3, option4, correct_option) VALUES (?, ?, ?, ?, ?, ?, ?)");
                    $stmt->execute([
                        $contest_id,
                        $question['text'],
                        $question['option1'],
                        $question['option2'],
                        $question['option3'],
                        $question['option4'],
                        $question['correct']
                    ]);
                }
            }
            
            $pdo->commit();
            $success = 'Contest created successfully!';
        } catch (Exception $e) {
            $pdo->rollBack();
            $error = 'Failed to create contest: ' . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Contest</title>
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
            background-color: #dc3545;
            color: white;
        }
        .main-content {
            padding: 20px;
        }
        .question-card {
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
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
                            <a class="nav-link active" href="admin-contest-create.php">
                                Create Contest
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
            
            <!-- Main content -->
            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Create New Contest</h1>
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
                            <div class="mb-3">
                                <label for="title" class="form-label">Contest Title *</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="2"></textarea>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="contest_type" class="form-label">Contest Type *</label>
                                    <select class="form-select" id="contest_type" name="contest_type" required>
                                        <option value="practice">Practice</option>
                                        <option value="mock">Mock Contest</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="duration" class="form-label">Duration (minutes, 0 for no limit)</label>
                                    <input type="number" class="form-control" id="duration" name="duration" value="0" min="0">
                                </div>
                            </div>
                            
                            <h5 class="mt-4 mb-3">Questions</h5>
                            <div id="questions-container">
                                <!-- Questions will be added here -->
                            </div>
                            
                            <button type="button" id="add-question" class="btn btn-secondary mb-4">Add Question</button>
                            
                            <div class="d-grid">
                                <button type="submit" name="create_contest" class="btn btn-danger">Create Contest</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Question template (hidden) -->
    <div id="question-template" class="question-card" style="display: none;">
        <div class="mb-3">
            <label class="form-label">Question Text *</label>
            <textarea class="form-control question-text" name="questions[0][text]" rows="2" required></textarea>
        </div>
        <div class="row">
            <div class="col-md-6 mb-2">
                <label class="form-label">Option 1 *</label>
                <input type="text" class="form-control" name="questions[0][option1]" required>
            </div>
            <div class="col-md-6 mb-2">
                <label class="form-label">Option 2 *</label>
                <input type="text" class="form-control" name="questions[0][option2]" required>
            </div>
            <div class="col-md-6 mb-2">
                <label class="form-label">Option 3 *</label>
                <input type="text" class="form-control" name="questions[0][option3]" required>
            </div>
            <div class="col-md-6 mb-2">
                <label class="form-label">Option 4 *</label>
                <input type="text" class="form-control" name="questions[0][option4]" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Correct Option *</label>
                <select class="form-select" name="questions[0][correct]" required>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                    <option value="4">Option 4</option>
                </select>
            </div>
            <div class="col-md-6 d-flex align-items-end">
                <button type="button" class="btn btn-outline-danger remove-question">Remove Question</button>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const questionsContainer = document.getElementById('questions-container');
            const addQuestionBtn = document.getElementById('add-question');
            const questionTemplate = document.getElementById('question-template');
            
            let questionCount = 0;
            
            // Add first question by default
            addQuestion();
            
            // Add question button click handler
            addQuestionBtn.addEventListener('click', addQuestion);
            
            // Remove question button handler (delegated)
            questionsContainer.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-question')) {
                    e.target.closest('.question-card').remove();
                }
            });
            
            function addQuestion() {
                const newQuestion = questionTemplate.cloneNode(true);
                newQuestion.style.display = 'block';
                
                // Update all names and IDs to use the current question count
                const inputs = newQuestion.querySelectorAll('[name]');
                inputs.forEach(input => {
                    const name = input.getAttribute('name').replace(/questions\[\d+\]/, `questions[${questionCount}]`);
                    input.setAttribute('name', name);
                });
                
                // Update the question text label
                newQuestion.querySelector('.question-text').textContent = `Question ${questionCount + 1}`;
                
                questionsContainer.appendChild(newQuestion);
                questionCount++;
            }
        });
    </script>
</body>
</html>