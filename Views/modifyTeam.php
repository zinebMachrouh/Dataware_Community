<?php
ob_start();
session_start();
include '../SQL/connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Team</title>
    <link rel="shortcut icon" href="../public/brand.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins';
        }

        .login-body {
            width: 100%;
            height: 100vh;
            background: url(../public/bg.png) no-repeat;
            background-position: center;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .create-form {
            width: 600px;
            height: 720px;
            background-color: #fafafa;
            border-radius: 20px;
            box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;
            overflow: hidden;

        }

        .create-form h2 {
            display: flex;
            align-items: center;
            color: #1e1e1e;
            font-size: 30px;
            justify-content: center;
            padding: 20px;
        }

        .create-form form {
            padding: 0px 30px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .back {
            position: absolute;
            top: 50px;
            left: 50px;
            background-color: #fafafa;
            border-radius: 200px;
            width: 50px;
            height: 50px;
            color: #00a6e8;
            padding: 10px 12px;
            letter-spacing: 2px;
            font-size: 24px;
        }

        label h4 {
            font-size: 20px;
            color: #1e1e1e;
            margin-bottom: 5px
        }


        label input:focus,
        label select:focus {
            box-shadow: #00a6e83f 0px 2px 8px 0px;
            border: #00a6e8 1px solid;
            transition: all ease 0.3s;
        }


        input {
            padding: 12px 7px;
            width: 100%;
            border-radius: 5px;
            border: 1px solid #1e1e1e;
            outline: none;
            margin-bottom: 10px;

        }

        select {
            padding: 12px 7px;
            width: 100%;
            border-radius: 5px;
            border: 1px solid #1e1e1e;
            outline: none;
            margin-bottom: 10px;
        }

        .btns {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 10px;
        }

        .btns button {
            font-size: 18px;
            padding: 10px 15px;
            outline: none;
            border: none;
            cursor: pointer;
            font-weight: 500;
            width: 180px;
        }

        .btns button:first-child {
            border: #00a6e8 2px solid;
            background-color: transparent;
            color: #00a6e8;
            border-radius: 5px;
        }

        .btns button:last-child {
            border: #00a6e8 2px solid;
            background-color: #00a6e8;
            color: #fafafa;
            border-radius: 5px;
        }

        .btns button:first-child:hover,
        .btns button:last-child:hover {
            box-shadow: #00a6e83f 0px 2px 8px 0px;
            transition: all ease 0.3s;
        }
    </style>
</head>

<body class="login-body">
    <a href="./dashboard.php" class="bi bi-arrow-left back"></a>
    <div class="create-form">
        <h2>Data<img src="../public/brand.png" alt=brand />are</h2>

        <form action="" method="post">
            <?php
            $id = $_GET['teamId'];
            $query = "SELECT * FROM teams WHERE id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
            $team = $stmt->fetch(PDO::FETCH_ASSOC);

            echo '
                    <label for="name">
                        <h4>Team Name</h4>
                        <input type="text" name="name" id="name" required placeholder="Enter Project Name" value=' . $team['name'] . '>
                    </label>
                    <label for="created_at">
                        <h4>Created At</h4>
                        <input type="date" name="created_at" id="created_at" required value=' . $team['created_at'] . '>
                    </label>
                    <label for="description">
                        <h4>Description</h4>
                        <input type="text" name="description" id="description" placeholder="lorem ipsum doleres" value=' . $team['description'] . '>
                    </label>
                    <label for="projectId" >
                        <h4>Project Name</h4>
                        <select name="projectId" id="projectId" required>
                            <option value="" hidden>Select Project</option>';
                            $query = "SELECT * FROM projects WHERE NOT EXISTS ( SELECT * FROM teams WHERE teams.projectId = projects.id)";
                            $stmt = $conn->prepare($query);
                            $stmt->execute();

                            $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($projects as $proj) {
                                echo "<option value={$proj['id']}>{$proj['name']}</option>";
                            }

                        echo '</select>
                    </label>
                    <label>
                        <h4>Scrum Master</h4>';
                    
                    echo '<div class="btns">
                        <button type="reset">Cancel</button>
                        <button type="submit" name="sendF">Submit</button>
                    </div>
                ';
            ?>
        </form>
    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $name = $_POST['name'];
        $dateStart = $_POST['date_start'];
        $dateEnd = $_POST['date_end'];
        $status = $_POST['status'];
        $description = $_POST['description'];
        $id = $_GET['projectId'];

        $query = "UPDATE projects 
            SET name = :name, date_start = :date_start, date_end = :date_end,      
            status = :status, description = :description 
            WHERE id = :id";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':date_start', $dateStart);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':date_end', $dateEnd);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);

        $stmt->execute();

        header('Location: ./dashboard.php');
    }
    ?>
</body>

</html>