<?php
ob_start();
session_start();
include '../SQL/connect.php';
?>
<?php
if(isset($_GET['answer_id'])){
$answer_id = $_GET['answer_id'];
               $mark_solution = "UPDATE questions
                JOIN answers ON questions.id = answers.question_id
                SET questions.solution =:answer_id
                WHERE answers.id =$answer_id;";
                $sth_solution = $conn->prepare($mark_solution);
                $sth_solution->bindParam(':answer_id', $answer_id, PDO::PARAM_INT);
                $sth_solution->execute();
                // header('Location:./answers.php');
}

?>