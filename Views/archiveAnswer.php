<?php
include '../SQL/connect.php';
ob_start();
session_start();
$answer_id = $_GET["archiveId"];
    $stmt = $conn->prepare("UPDATE answers SET archive = 1 WHERE id = :answer_id");
    $stmt->bindParam(':answer_id', $answer_id, PDO::PARAM_INT);
    $stmt->execute();

header("Location: ./community.php");
exit();
?>