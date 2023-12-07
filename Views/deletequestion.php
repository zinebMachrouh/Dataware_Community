<?php
include '../SQL/connect.php';
ob_start();

$id = $_GET['deleteOne'];
$query = "UPDATE questions 
            SET project_id = NULL
            WHERE project_id = :id";
$stmt1 = $conn->prepare($query);
$stmt1->bindParam(':id', $id);
$stmt1->execute();

// $query2 = "UPDATE questions 
//             SET projectId = NULL
//             WHERE projectId = :id";
// $stmt2 = $conn->prepare($query);
// $stmt2->bindParam(':id', $id);
// $stmt2->execute();

$stmt = $conn->prepare("DELETE questions FROM questions INNER JOIN users ON questions.user_id = users.id WHERE users.email = 'zineb.m@gmail.com' AND questions.id = 5 id = :projectId");
$stmt->bindParam(':projectId', $id, PDO::PARAM_INT);
$stmt->execute();
header("Location: ./dashboard.php");
exit();
