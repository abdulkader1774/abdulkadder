<?php
require_once '../config.php';
requireLogin();

$attemptId = isset($_GET['attempt_id']) ? (int)$_GET['attempt_id'] : 0;

// Get attempt details
$stmt = $pdo->prepare("
    SELECT ua.*, c.title AS contest_title, 
           (SELECT COUNT(*) FROM questions WHERE contest_id = c.id) AS total_questions
    FROM user_attempts ua
    JOIN contests c ON ua.contest_id = c.id
    WHERE ua.id = ? AND ua.user_id = ?
");
$stmt->execute([$attemptId, $_SESSION['user_id']]);
$attempt = $stmt->fetch();

if (!$attempt) {
    header("Location: user-contest.php");
    exit();
}

// Get user answers
$answers = $pdo->prepare("
    SELECT q.question_text, q.option1, q.option2, q.option3, q.option4, 
           q.correct_option, ua.selected_option, ua.is_correct
    FROM user_answers ua
    JOIN questions q ON ua.question_id = q.id
    WHERE ua.attempt_id = ?
    ORDER BY q.id
");
$answers->execute([$attemptId]);
$answers = $answers->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contest Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .correct-answer {
            background-color: #d4edda;
        }
        .wrong-answer {
            background-color: #f8d7da;
        }
        .result-summary {
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <?php include '../nav.php'; ?>
    
    <div class="container py-4">
        <div class="text-center mb-4">
            <h1><?php echo htmlspecialchars($attempt['contest_title']); ?></h1>
            <div class="result-summary">
                <p>You scored <strong><?php echo $attempt['score']; ?> out of <?php echo $attempt['total_questions']; ?></strong></p>
                <p>Time taken: <strong><?php echo gmdate("H:i:s", $attempt['time_taken_seconds']); ?></strong></p>
            </div>
            <a href="user-leaderboard.php?contest_id=<?php echo $attempt['contest_id']; ?>" class="btn btn-primary">
                View Leaderboard
            </a>
            <a href="user-contest.php" class="btn btn-secondary">
                Back to Contests
            </a>
        </div>
        
        <div class="accordion" id="answersAccordion">
            <?php foreach ($answers as $index => $answer): ?>
                <div class="accordion-item <?php echo $answer['is_correct'] ? 'correct-answer' : 'wrong-answer'; ?>">
                    <h2 class="accordion-header" id="heading<?php echo $index; ?>">
                        <button class="accordion-button <?php echo $answer['is_correct'] ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $index; ?>" aria-expanded="<?php echo $answer['is_correct'] ? 'true' : 'false'; ?>" aria-controls="collapse<?php echo $index; ?>">
                            Question <?php echo $index + 1; ?>: <?php echo $answer['is_correct'] ? 'Correct' : 'Incorrect'; ?>
                        </button>
                    </h2>
                    <div id="collapse<?php echo $index; ?>" class="accordion-collapse collapse <?php echo $answer['is_correct'] ? 'show' : ''; ?>" aria-labelledby="heading<?php echo $index; ?>" data-bs-parent="#answersAccordion">
                        <div class="accordion-body">
                            <p><strong>Question:</strong> <?php echo htmlspecialchars($answer['question_text']); ?></p>
                            <p><strong>Your answer:</strong> <?php echo htmlspecialchars($answer['selected_option'] == 1 ? $answer['option1'] : 
                                                              ($answer['selected_option'] == 2 ? $answer['option2'] : 
                                                              ($answer['selected_option'] == 3 ? $answer['option3'] : $answer['option4']))); ?></p>
                            <p><strong>Correct answer:</strong> <?php echo htmlspecialchars($answer['correct_option'] == 1 ? $answer['option1'] : 
                                                              ($answer['correct_option'] == 2 ? $answer['option2'] : 
                                                              ($answer['correct_option'] == 3 ? $answer['option3'] : $answer['option4']))); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php include '../footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>