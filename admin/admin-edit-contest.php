<?php
require_once '../config.php';
requireAdmin();

$contestId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$error = '';
$success = '';

// Get contest data
$contest = null;
$questions = [];

if ($contestId) {
    $stmt = $pdo->prepare("SELECT * FROM contests WHERE id = ?");
    $stmt->execute([$contestId]);
    $contest = $stmt->fetch();
    
    if ($contest) {
        $stmt = $pdo->prepare("SELECT * FROM questions WHERE contest_id = ? ORDER BY id");
        $stmt->execute([$contestId]);
        $questions = $stmt->fetchAll();
    }
}

if (!$contest) {
    header("Location: admin-contest-list.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $contest_type = $_POST['contest_type'];
    $duration = (int)$_POST['duration'];
    $is_active = isset($_POST['is_active']) ? 1 : 0;
    
    if (empty($title)) {
        $error = 'Contest title is required.';
    } else {
        $pdo->beginTransaction();
        
        try {
            // Update contest
            $stmt = $pdo->prepare("UPDATE contests SET title = ?, description = ?, contest_type = ?, duration_minutes = ?, is_active = ? WHERE id = ?");
            $stmt->execute([$title, $description, $contest_type, $duration, $is_active, $contestId]);
            
            // Update existing questions
            if (isset($_POST['existing_questions'])) {
                foreach ($_POST['existing_questions'] as $questionId => $questionData) {
                    if (!empty($questionData['text'])) {
                        $stmt = $pdo->prepare("UPDATE questions SET question_text = ?, option1 = ?, option2 = ?, option3 = ?, option4 = ?, correct_option = ? WHERE id = ?");
                        $stmt->execute([
                            $questionData['text'],
                            $questionData['option1'],
                            $questionData['option2'],
                            $questionData['option3'],
                            $questionData['option4'],
                            $questionData['correct'],
                            $questionId
                        ]);
                    } else {
                        // Delete empty questions
                        $stmt = $pdo->prepare("DELETE FROM questions WHERE id = ?");
                        $stmt->execute([$questionId]);
                    }
                }
            }
            
            // Add new questions
            if (isset($_POST['new_questions'])) {
                foreach ($_POST['new_questions'] as $question) {
                    if (!empty($question['text'])) {
                        $stmt = $pdo->prepare("INSERT INTO questions (contest_id, question_text, option1, option2, option3, option4, correct_option) VALUES (?, ?, ?, ?, ?, ?, ?)");
                        $stmt->execute([
                            $contestId,
                            $question['text'],
                            $question['option1'],
                            $question['option2'],
                            $question['option3'],
                            $question['option4'],
                            $question['correct']
                        ]);
                    }
                }
            }
            
            $pdo->commit();
            $success = 'Contest updated successfully!';
            
            // Refresh questions data
            $stmt = $pdo->prepare("SELECT * FROM questions WHERE contest_id = ? ORDER BY id");
            $stmt->execute([$contestId]);
            $questions = $stmt->fetchAll();
            
        } catch (Exception $e) {
            $pdo->rollBack();
            $error = 'Failed to update contest: ' . $e->getMessage();
        }
    }
}

$pageTitle = "Edit Contest: " . htmlspecialchars($contest['title']);
include '../nav.php';
// include 'sidebar.php';
?>

<div class="main-content d-flex">

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
                            <a class="nav-link" href="admin-contest-create.php">
                                Create Contest
                            </a>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link active" href="admin-contest-list.php">
                                Contest List
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin-edit-contest.php">
                                Edit Contest
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

    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Edit Contest</h1>
            <a href="admin-contest-list.php" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Back to List
            </a>
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="title" class="form-label">Contest Title *</label>
                                <input type="text" class="form-control" id="title" name="title" 
                                       value="<?php echo htmlspecialchars($contest['title']); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="contest_type" class="form-label">Contest Type *</label>
                                <select class="form-select" id="contest_type" name="contest_type" required>
                                    <option value="practice" <?php echo $contest['contest_type'] === 'practice' ? 'selected' : ''; ?>>Practice</option>
                                    <option value="mock" <?php echo $contest['contest_type'] === 'mock' ? 'selected' : ''; ?>>Mock Contest</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="duration" class="form-label">Duration (minutes)</label>
                                <input type="number" class="form-control" id="duration" name="duration" 
                                       value="<?php echo $contest['duration_minutes']; ?>" min="0">
                                <div class="form-text">0 for no time limit</div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"><?php echo htmlspecialchars($contest['description']); ?></textarea>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" 
                               <?php echo $contest['is_active'] ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="is_active">Active Contest</label>
                    </div>

                    <h5 class="mt-4 mb-3">Questions</h5>
                    <div id="questions-container">
                        <?php foreach ($questions as $index => $question): ?>
                            <div class="question-card card mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="mb-0">Question #<?php echo $index + 1; ?></h6>
                                        <button type="button" class="btn btn-sm btn-outline-danger remove-question">
                                            <i class="bi bi-trash"></i> Remove
                                        </button>
                                    </div>
                                    
                                    <input type="hidden" name="existing_questions[<?php echo $question['id']; ?>][id]" value="<?php echo $question['id']; ?>">
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Question Text *</label>
                                        <textarea class="form-control question-text" name="existing_questions[<?php echo $question['id']; ?>][text]" rows="2" required><?php echo htmlspecialchars($question['question_text']); ?></textarea>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label">Option 1 *</label>
                                            <input type="text" class="form-control" name="existing_questions[<?php echo $question['id']; ?>][option1]" 
                                                   value="<?php echo htmlspecialchars($question['option1']); ?>" required>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label">Option 2 *</label>
                                            <input type="text" class="form-control" name="existing_questions[<?php echo $question['id']; ?>][option2]" 
                                                   value="<?php echo htmlspecialchars($question['option2']); ?>" required>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label">Option 3 *</label>
                                            <input type="text" class="form-control" name="existing_questions[<?php echo $question['id']; ?>][option3]" 
                                                   value="<?php echo htmlspecialchars($question['option3']); ?>" required>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label">Option 4 *</label>
                                            <input type="text" class="form-control" name="existing_questions[<?php echo $question['id']; ?>][option4]" 
                                                   value="<?php echo htmlspecialchars($question['option4']); ?>" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Correct Option *</label>
                                            <select class="form-select" name="existing_questions[<?php echo $question['id']; ?>][correct]" required>
                                                <option value="1" <?php echo $question['correct_option'] == 1 ? 'selected' : ''; ?>>Option 1</option>
                                                <option value="2" <?php echo $question['correct_option'] == 2 ? 'selected' : ''; ?>>Option 2</option>
                                                <option value="3" <?php echo $question['correct_option'] == 3 ? 'selected' : ''; ?>>Option 3</option>
                                                <option value="4" <?php echo $question['correct_option'] == 4 ? 'selected' : ''; ?>>Option 4</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <button type="button" id="add-question" class="btn btn-secondary mb-4">
                        <i class="bi bi-plus-circle me-2"></i>Add New Question
                    </button>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="admin-contest-list.php" class="btn btn-secondary me-md-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Contest</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- New Question Template (hidden) -->
<div id="new-question-template" class="question-card card mb-3" style="display: none;">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="mb-0">New Question</h6>
            <button type="button" class="btn btn-sm btn-outline-danger remove-question">
                <i class="bi bi-trash"></i> Remove
            </button>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Question Text *</label>
            <textarea class="form-control question-text" name="new_questions[0][text]" rows="2" required></textarea>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-2">
                <label class="form-label">Option 1 *</label>
                <input type="text" class="form-control" name="new_questions[0][option1]" required>
            </div>
            <div class="col-md-6 mb-2">
                <label class="form-label">Option 2 *</label>
                <input type="text" class="form-control" name="new_questions[0][option2]" required>
            </div>
            <div class="col-md-6 mb-2">
                <label class="form-label">Option 3 *</label>
                <input type="text" class="form-control" name="new_questions[0][option3]" required>
            </div>
            <div class="col-md-6 mb-2">
                <label class="form-label">Option 4 *</label>
                <input type="text" class="form-control" name="new_questions[0][option4]" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Correct Option *</label>
                <select class="form-select" name="new_questions[0][correct]" required>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                    <option value="4">Option 4</option>
                </select>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const questionsContainer = document.getElementById('questions-container');
        const addQuestionBtn = document.getElementById('add-question');
        const newQuestionTemplate = document.getElementById('new-question-template');
        
        let newQuestionCount = 0;
        
        // Add new question button click handler
        addQuestionBtn.addEventListener('click', function() {
            const newQuestion = newQuestionTemplate.cloneNode(true);
            newQuestion.style.display = 'block';
            
            // Update all names to use the current new question count
            const inputs = newQuestion.querySelectorAll('[name]');
            inputs.forEach(input => {
                const name = input.getAttribute('name').replace(/new_questions\[\d+\]/, `new_questions[${newQuestionCount}]`);
                input.setAttribute('name', name);
            });
            
            questionsContainer.appendChild(newQuestion);
            newQuestionCount++;
        });
        
        // Remove question button handler (delegated)
        questionsContainer.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-question')) {
                const questionCard = e.target.closest('.question-card');
                if (questionCard) {
                    questionCard.remove();
                }
            }
        });
    });
</script>

<?php include '../footer.php'; ?>