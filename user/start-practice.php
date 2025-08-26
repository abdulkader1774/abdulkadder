<?php
require_once '../config.php';
requireLogin();

$contestId = isset($_GET['contest_id']) ? (int)$_GET['contest_id'] : 0;

// Get contest details
$stmt = $pdo->prepare("
    SELECT c.*, 
           (SELECT COUNT(*) FROM questions WHERE contest_id = c.id) AS question_count
    FROM contests c
    WHERE c.id = ? AND c.contest_type = 'practice' AND c.is_active = TRUE
");
$stmt->execute([$contestId]);
$contest = $stmt->fetch();

if (!$contest) {
    header("Location: practice-contest.php");
    exit();
}

// Start new practice attempt
$pdo->beginTransaction();
try {
    $stmt = $pdo->prepare("
        INSERT INTO user_attempts (user_id, contest_id, start_time)
        VALUES (?, ?, NOW())
    ");
    $stmt->execute([$_SESSION['user_id'], $contestId]);
    $attemptId = $pdo->lastInsertId();
    $pdo->commit();
} catch (Exception $e) {
    $pdo->rollBack();
    header("Location: practice-contest.php?error=Failed to start practice");
    exit();
}

// Get questions for the contest
$questions = $pdo->prepare("
    SELECT id, question_text, option1, option2, option3, option4
    FROM questions
    WHERE contest_id = ?
    ORDER BY id
");
$questions->execute([$contestId]);
$questions = $questions->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practice: <?php echo htmlspecialchars($contest['title']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .question-card {
            margin-bottom: 30px;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php include '../nav.php'; ?>
    
    <div class="container py-4">
        <h1 class="mb-4"><?php echo htmlspecialchars($contest['title']); ?></h1>
        
        <div class="alert alert-info">
            <strong>Practice Mode:</strong> Take your time to answer these questions. There is no time limit.
        </div>
        
        <form id="practice-form" action="submit-practice.php" method="POST">
            <input type="hidden" name="attempt_id" value="<?php echo $attemptId; ?>">
            
            <?php foreach ($questions as $index => $question): ?>
                <div class="question-card">
                    <h5>Question <?php echo $index + 1; ?></h5>
                    <p><?php echo htmlspecialchars($question['question_text']); ?></p>
                    
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="answers[<?php echo $question['id']; ?>]" id="q<?php echo $question['id']; ?>_1" value="1" required>
                        <label class="form-check-label" for="q<?php echo $question['id']; ?>_1">
                            <?php echo htmlspecialchars($question['option1']); ?>
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="answers[<?php echo $question['id']; ?>]" id="q<?php echo $question['id']; ?>_2" value="2">
                        <label class="form-check-label" for="q<?php echo $question['id']; ?>_2">
                            <?php echo htmlspecialchars($question['option2']); ?>
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="answers[<?php echo $question['id']; ?>]" id="q<?php echo $question['id']; ?>_3" value="3">
                        <label class="form-check-label" for="q<?php echo $question['id']; ?>_3">
                            <?php echo htmlspecialchars($question['option3']); ?>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answers[<?php echo $question['id']; ?>]" id="q<?php echo $question['id']; ?>_4" value="4">
                        <label class="form-check-label" for="q<?php echo $question['id']; ?>_4">
                            <?php echo htmlspecialchars($question['option4']); ?>
                        </label>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">Submit Answers</button>
            </div>
        </form>
    </div>
    <?php include '../footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>