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

function likeQuestion($question_id)
{
    global $conn;
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("INSERT INTO reactions (user_id, reaction, question_id) VALUES (:user_id, 1, :question_id)");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':question_id', $question_id, PDO::PARAM_INT);
    $stmt->execute();
}

function dislikeQuestion($question_id){
    global $conn;
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("INSERT INTO reactions (user_id, reaction, question_id) VALUES (:user_id, 0, :question_id)");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':question_id', $question_id, PDO::PARAM_INT);
    $stmt->execute();
}

function likeAnswer($answer_id)
{
    global $conn;
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("INSERT INTO reactions (user_id, reaction, answer_id) VALUES (:user_id, 1, :answer_id)");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':answer_id', $answer_id, PDO::PARAM_INT);
    $stmt->execute();
}

function dislikeAnswer($answer_id){
    global $conn;
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("INSERT INTO reactions (user_id, reaction, answer_id) VALUES (:user_id, 0, :answer_id)");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':answer_id', $answer_id, PDO::PARAM_INT);
    $stmt->execute();
}