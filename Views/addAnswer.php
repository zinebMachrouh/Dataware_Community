<?php
$servername = "localhost";
$username = "root";
$password = '';
$dbname = "dataware_v3";

try {
    // Create connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get data from the form
        $question_id = $_POST['question_id'];
        $contenu_answer = $_POST['contenu_answer'];

        // Insert the answer into the database
        $query = "INSERT INTO answers (question_id, title, user_id) VALUES (:question_id, :contenu_answer, :user_id)";
        $stmt = $conn->prepare($query);

        // Assuming user_id needs to be set, you can replace this with the actual user ID logic
        $user_id = 1; // Replace with the actual user ID

        $stmt->bindParam(':question_id', $question_id);
        $stmt->bindParam(':contenu_answer', $contenu_answer);
        $stmt->bindParam(':user_id', $user_id);

        if ($stmt->execute()) {
            echo 'La réponse a été ajoutée avec succès.';
        } else {
            echo 'Erreur lors de l\'ajout de la réponse : ' . $stmt->errorInfo()[2];
        }
    }
} catch (PDOException $e) {
    echo 'Erreur lors de la connexion à la base de données : ' . $e->getMessage();
} finally {
    // Close the database connection
    $conn = null;
}
?>
