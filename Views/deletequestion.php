<?php
include '../SQL/connect.php';
session_start();
ob_start();

$id = $_GET['deleteOne'];

$stmt = $conn->prepare("DELETE FROM questions WHERE questions.id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();

header("Location: ./community.php");
exit();
?>