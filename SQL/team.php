<?php

function updateTeam($teamId, $name, $description, $projectId, $scrumMaster) {
    global $conn;

    $query = "UPDATE teams 
            SET name = :name, description = :description, 
            projectId = :projectId, scrumMaster = :scrumMaster 
            WHERE id = :id";
    
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':projectId', $projectId);
    $stmt->bindParam(':scrumMaster', $scrumMaster);
    $stmt->bindParam(':id', $teamId);

    return $stmt->execute();
}

function deleteTeam($teamId)
{
    global $conn;

    $query = "DELETE FROM teams WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $teamId);

    return $stmt->execute();
}
?>
