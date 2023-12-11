<?php
include '../SQL/connect.php';
ob_start();
session_start();
$question_id = $_GET["archiveId"];
    $stmt = $conn->prepare("UPDATE questions SET archive = 1 WHERE id = :question_id");
    $stmt->bindParam(':question_id', $question_id, PDO::PARAM_INT);
    $stmt->execute();

header("Location: ./community.php");
exit();
?>