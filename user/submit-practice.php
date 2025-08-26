<?php
require_once '../config.php';
requireLogin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['attempt_id'])) {
    header("Location: practice-contest.php");
    exit();
}

$attemptId = (int)$_POST['attempt_id'];

// Get attempt details
$stmt = $pdo->prepare("
    SELECT ua.*, TIMESTAMPDIFF(SECOND, ua.start_time, NOW()) AS time_taken
    FROM user_attempts ua
    WHERE ua.id = ? AND ua.user_id = ? AND ua.end_time IS NULL
");
$stmt->execute([$attemptId, $_SESSION['user_id']]);
$attempt = $stmt->fetch();

if (!$attempt) {
    header("Location: practice-contest.php?error=Invalid attempt");
    exit();
}

// Get all questions for this contest
$questions = $pdo->prepare("
    SELECT id, correct_option 
    FROM questions 
    WHERE contest_id = ?
");
$questions->execute([$attempt['contest_id']]);
$questions = $questions->fetchAll(PDO::FETCH_KEY_PAIR); // id => correct_option

// Calculate score
$score = 0;
$answers = $_POST['answers'] ?? [];

foreach ($answers as $questionId => $selectedOption) {
    if (isset($questions[$questionId]) && $questions[$questionId] == $selectedOption) {
        $score++;
    }
}

// Save attempt results
$pdo->beginTransaction();
try {
    // Update attempt
    $stmt = $pdo->prepare("
        UPDATE user_attempts 
        SET end_time = NOW(), 
            score = ?, 
            time_taken_seconds = ?
        WHERE id = ?
    ");
    $stmt->execute([$score, $attempt['time_taken'], $attemptId]);
    
    // Save user answers
    foreach ($answers as $questionId => $selectedOption) {
        $isCorrect = isset($questions[$questionId]) && $questions[$questionId] == $selectedOption;
        $stmt = $pdo->prepare("
            INSERT INTO user_answers (attempt_id, question_id, selected_option, is_correct)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([$attemptId, $questionId, $selectedOption, $isCorrect]);
    }
    
    $pdo->commit();
} catch (Exception $e) {
    $pdo->rollBack();
    header("Location: practice-contest.php?error=Failed to submit answers");
    exit();
}

header("Location: practice-results.php?attempt_id=" . $attemptId);
exit();