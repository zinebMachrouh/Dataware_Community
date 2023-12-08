<?php
include './connect.php';

function archiveQuestion($question_id)
{
    global $conn;
    $stmt = $conn->prepare("UPDATE questions SET archive = 1 WHERE id = :question_id");
    $stmt->bindParam(':question_id', $question_id, PDO::PARAM_INT);
    $stmt->execute();
}

function archiveAnswer($answer_id)
{
    global $conn;
    $stmt = $conn->prepare("UPDATE answers SET archive = 1 WHERE id = :answer_id");
    $stmt->bindParam(':answer_id', $answer_id, PDO::PARAM_INT);
    $stmt->execute();
}

function likeQuestion($question_id, $user_id)
{
    global $conn;
    $checkStmt = $conn->prepare("SELECT * FROM reactions WHERE user_id = :user_id AND question_id = :question_id");
    $checkStmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $checkStmt->bindParam(':question_id', $question_id, PDO::PARAM_INT);
    $checkStmt->execute();
    $existingLike = $checkStmt->fetch(PDO::FETCH_ASSOC);

    if ($existingLike) {
        $updateStmt = $conn->prepare("UPDATE reactions SET reaction = NULL WHERE user_id = :user_id AND question_id = :question_id");
        $updateStmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $updateStmt->bindParam(':question_id', $question_id, PDO::PARAM_INT);
        $updateStmt->execute();
    } else {
        $insertStmt = $conn->prepare("INSERT INTO reactions (user_id, reaction, question_id) VALUES (:user_id, 1, :question_id)");
        $insertStmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $insertStmt->bindParam(':question_id', $question_id, PDO::PARAM_INT);
        $insertStmt->execute();
    }
}

function dislikeQuestion($question_id)
{
    global $conn;
    $user_id = $_SESSION['user_id'];

    $checkStmt = $conn->prepare("SELECT * FROM reactions WHERE user_id = :user_id AND question_id = :question_id AND reaction = 0");
    $checkStmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $checkStmt->bindParam(':question_id', $question_id, PDO::PARAM_INT);
    $checkStmt->execute();

    if ($checkStmt->rowCount() > 0) {
        $updateStmt = $conn->prepare("UPDATE reactions SET reaction = NULL WHERE user_id = :user_id AND question_id = :question_id AND reaction = 0");
        $updateStmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $updateStmt->bindParam(':question_id', $question_id, PDO::PARAM_INT);
        $updateStmt->execute();
    } else {
        $insertStmt = $conn->prepare("INSERT INTO reactions (user_id, reaction, question_id) VALUES (:user_id, 0, :question_id)");
        $insertStmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $insertStmt->bindParam(':question_id', $question_id, PDO::PARAM_INT);
        $insertStmt->execute();
    }
}

function likeAnswer($answer_id)
{
    global $conn;
    $user_id = $_SESSION['user_id'];
    $stmtCheck = $conn->prepare("SELECT reaction FROM reactions WHERE user_id = :user_id AND answer_id = :answer_id");
    $stmtCheck->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmtCheck->bindParam(':answer_id', $answer_id, PDO::PARAM_INT);
    $stmtCheck->execute();

    if ($stmtCheck->rowCount() > 0) {
        $stmtUpdate = $conn->prepare("UPDATE reactions SET reaction = NULL WHERE user_id = :user_id AND answer_id = :answer_id");
        $stmtUpdate->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmtUpdate->bindParam(':answer_id', $answer_id, PDO::PARAM_INT);
        $stmtUpdate->execute();
    } else {
        $stmtInsert = $conn->prepare("INSERT INTO reactions (user_id, reaction, answer_id) VALUES (:user_id, 1, :answer_id)");
        $stmtInsert->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmtInsert->bindParam(':answer_id', $answer_id, PDO::PARAM_INT);
        $stmtInsert->execute();
    }
}

function dislikeAnswer($answer_id)
{
    global $conn;
    $user_id = $_SESSION['user_id'];

    $existingStmt = $conn->prepare("SELECT * FROM reactions WHERE user_id = :user_id AND answer_id = :answer_id");
    $existingStmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $existingStmt->bindParam(':answer_id', $answer_id, PDO::PARAM_INT);
    $existingStmt->execute();

    if ($existingStmt->rowCount() > 0) {
        $updateStmt = $conn->prepare("UPDATE reactions SET reaction = NULL WHERE user_id = :user_id AND answer_id = :answer_id");
        $updateStmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $updateStmt->bindParam(':answer_id', $answer_id, PDO::PARAM_INT);
        $updateStmt->execute();
    } else {
        $insertStmt = $conn->prepare("INSERT INTO reactions (user_id, reaction, answer_id) VALUES (:user_id, 0, :answer_id)");
        $insertStmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $insertStmt->bindParam(':answer_id', $answer_id, PDO::PARAM_INT);
        $insertStmt->execute();
    }
}
function NumberlikeQuestion($question_id)
{
    global $conn;
    $user_id = $_SESSION['user_id'];
    $like="SELECT COUNT(reaction) AS NumberOfLike FROM reactions where reaction=1 and question_id=$question_id";
    $stmt = $conn->prepare($like);
    $stmt->execute();
}
function NumberDislikeQuestion($question_id)
{
    global $conn;
    $user_id = $_SESSION['user_id'];
    $like = "SELECT COUNT(reaction) AS NumberOfLike FROM reactions where reaction=0 question_id=$question_id";
    $stmt = $conn->prepare($like);
    $stmt->execute();
}
function NumberlikeAnswer($answer_id)
{
    global $conn;
    $user_id = $_SESSION['user_id'];
    $like = "SELECT COUNT(reaction) AS NumberOfLike FROM reactions where reaction=1 and answer_id=$answer_id";
    $stmt = $conn->prepare($like);
    $stmt->execute();
}
function NumberDislikeAnswer($answer_id)
{
    global $conn;
    $user_id = $_SESSION['user_id'];
    $like = "SELECT COUNT(reaction) AS NumberOfLike FROM reactions where reaction=0 and answer_id=$answer_id ";
    $stmt = $conn->prepare($like);
    $stmt->execute();
}
