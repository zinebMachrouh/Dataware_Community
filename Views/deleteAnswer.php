<?php
include '../SQL/connect.php';
session_start();
ob_start();

$id = $_GET['deleteOne'];
$stmt1 = $conn->prepare("SELECT * FROM users where email = :email");
$stmt1->bindParam(':email', $_SESSION['email']); // Assuming you have a user session, change it accordingly
$stmt1->execute();
$user = $stmt1->fetch(PDO::FETCH_ASSOC);


// Assuming 'email' is a column in the 'users' table related to the 'questions' table
$stmt = $conn->prepare("DELETE FROM answers WHERE answers.user_id = :user_id AND answers.id = :id");
$stmt->bindParam(':user_id', $user['id']); // Assuming you have a user session, change it accordingly
$stmt->bindParam(':id', $id);
$stmt->execute();

header("Location: ./community.php");
exit();
?>
