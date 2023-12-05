<?php
ob_start();
session_start();
include "../SQL/connect.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="shortcut icon" href="../public/brand.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/6e1faf1eda.js" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins';
        }

        header {
            width: 100%;
            height: 9vh;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0px 50px;
            position: fixed;
            top: 0;
            background-color: #fafafa;
            z-index: 2;
            box-shadow: #0000002e 5px 0px 10px 0px;
        }

        header h2 {
            display: flex;
            align-items: center;
            color: #1e1e1e;
            font-size: 30px;

        }

        header nav {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        header nav a {
            color: #008fd4;
            text-decoration: none;
            border-bottom: 2px #fafafa solid;
            padding: 7px 15px;
            /* border-radius: 10px; */
            display: flex;
            align-items: center;
            gap: 10px;
            border-radius: 10px 10px 0px 0px;
        }

        header nav a:hover {
            border-bottom: 2px #008fd4 solid;
            background-color: #def3ff;
            transition: all ease-in-out .5s;
        }

        main {
            margin-top: 9vh;
            background: url(../public/bg.png) no-repeat;
            background-position: center;
            background-size: cover;
            height: fit-content;
            width: 100%;
            padding: 20px 50px;
        }

        div.cards {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            align-items: center;
            background-color: #fafafa;
            padding: 0px;
            gap: 90px;
            background-color: transparent;
        }

        .title {
            color: #fafafa;
            font-size: 28px;
        }

        .sub-title {
            color: #def3ff;
            font-size: 24px;
            margin-bottom: 15px;
            margin-top: 25px;

        }

        .card {
            background-color: #fafafa;
            width: 370px;
            /* height: 370px; */
            border-radius: 10px;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .card-top {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            padding: 15px 15px 5px;
        }

        .card-top h4 {
            background-color: #008fd4;
            font-size: 30px;
            width: 65px;
            height: 65px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 200px;
            letter-spacing: 1px;
            color: #fafafa;
        }

        .card-top h2 {
            font-size: 28px;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            padding: 10px 15px 5px;

        }

        .card-body p {
            font-size: 18px;
        }

        .card-body p:nth-child(2) {
            color: #308BE6;
        }

        .card-btm {
            display: flex;
            align-items: center;
            flex-direction: column;
            gap: 10px;
        }

        .card-btm a:nth-child(1) {
            text-align: center;
            color: #8d99ae;
            width: 100%;
            text-decoration: none;
            font-size: 16px;
        }

        .card-btm a:nth-child(2) {
            background-color: #00a6e83f;
            padding: 15px 15px;
            text-align: center;
            font-weight: 600;
            color: #308BE6;
            width: 100%;
            text-decoration: none;
            transition: all ease 3s;
            font-size: 20px;
            margin-top: 20px;
            display: flex;
            align-items: center;
            gap: 5px;
            justify-content: center;
            padding-left: 45px;
        }

        .card-btm a:nth-child(2) i {
            color: rgba(48, 139, 230, 0.7);
            opacity: 0;
        }

        .card-btm a:nth-child(2):hover {
            padding-left: 0px;
            transition: all ease-in-out .5s;
        }

        .card-btm a:nth-child(2):hover i {
            opacity: 1;
            transition: all ease-in-out .5s;

        }

        .popup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            display: none;
        }

        .popup-content {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            width: 400px;
        }

        .close {
            cursor: pointer;
            font-size: 18px;
        }

        .popup-header {
            background: #008fd4;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .popup-body {
            padding: 20px;
        }

        .popup-body form {
            display: flex;
            flex-direction: column;
        }

        .popup-body form input,
        .popup-body form select {
            width: 100%;
            padding: 10px 7px;
            font-size: 16px;
            border-radius: 5px;
            outline: none;
            border: #1e1e1e4c 1px solid;
            margin-bottom: 15px;
        }

        .popup-body form label {
            color: #008fd4;
            font-size: 16px;
            font-weight: 600;
        }

        .popup-footer {
            text-align: right;
            padding: 10px 0px;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            gap: 10px;
            justify-content: flex-end;
        }

        .popup-footer button {
            background-color: #008fd4;
            color: #fafafa;
            padding: 7px 10px;
            border: none;
            outline: none;
            font-size: 16px;
            border-radius: 7px;
        }


        .pro {
            margin-top: 30px;
        }

        .popup-body p {
            margin: 5px 0px;
        }

        .popup-footer a {
            background-color: #008fd4;
            color: #fafafa;
            padding: 7px 10px;
            border: none;
            outline: none;
            font-size: 16px;
            border-radius: 7px;
            text-decoration: none;
        }

        .delete {
            background-color: #E33535 !important;
        }

        .fullPage {
            height: 79.8vh;
            overflow: hidden;
        }

        .fullPage h4 {
            color: #def3ff;

        }

        .side {
            height: 160px;
            width: 10px;
            background-color: #008fd4;
            border-radius: 15px;
            margin-right: 10px;
        }

        .team {
            padding: 10px;
            display: flex;
            background-color: #fafafa;
            border-radius: 10px;
            height: fit-content;
            width: 300px;
        }

        .card-main h4 {
            margin-bottom: 15px;
        }

        .teamTable {
            background-color: #fafafa;
            border: 2px solid #008fd4;
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border-bottom: 2px solid #008fd4;
            padding: 15px;
            text-align: left;
            width: 200px;
            color: #1e1e1e;
        }

        th {
            background-color: #def3ff;
        }

        td a {
            text-decoration: none;
            margin-right: 20px;
            transition: all ease-in-out .3s;
        }

        td a:nth-child(1) {
            color: #008fd4;
        }

        td a:nth-child(2) {
            color: #E33535;
        }

        td p {
            padding: 7px 10px;
            font-weight: 600;
            width: 100px;
            text-align: center;
            border-radius: 25px;
        }

        .done {
            background-color: #3ebf9d68;
            color: #3ebf9d;
        }

        .active {
            background-color: #00a6e83f;
            color: #008fd4;

        }

        .add {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .add a {
            padding: 10px 15px;
            background: rgba(222, 243, 255, 0.31);
            border-radius: 10px;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
            backdrop-filter: blur(9.2px);
            color: #def3ff;
            font-weight: 500;
            letter-spacing: 1px;
            text-decoration: none;
            transition: all ease-in-out .3s;
            -webkit-backdrop-filter: blur(9.2px);
        }

        .add a:hover {
            transform: scale(1.1);
            color: #fff;
        }
    </style>
</head>

<body>
    <header>
        <h2>Data<img src=../public/brand.png alt=brand />are</h2>
        <nav>
            <a href="#"><i class="fa-solid fa-house"></i> Home</a>
            <?php
            $email = $_SESSION['email'];

            $query = "SELECT * FROM users WHERE email = :email";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                if ($user['role'] === 0) {
                    echo '<a href="#myTeams"><i class="fa-solid fa-user-group"></i>Teams</a><a href="#myProjects"><i class="fa-solid fa-bars-progress"></i>Projects</a>';
                } else if ($user['role'] === 3) {
                    echo '<a href="./projects.php"><i class="fa-solid fa-bars-progress"></i>Projects</a>';
                } else {
                    echo '';
                }
            } else {
                echo 'User not found';
            }

            ?>
            <a href="#" onclick="openMyPopup()"><i class="fa-solid fa-user"></i> Profile</a>
            <a href="./community.php"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="20" viewBox="0 0 640 512"><path fill="#008fd4" d="M208 352c114.9 0 208-78.8 208-176S322.9 0 208 0S0 78.8 0 176c0 38.6 14.7 74.3 39.6 103.4c-3.5 9.4-8.7 17.7-14.2 24.7c-4.8 6.2-9.7 11-13.3 14.3c-1.8 1.6-3.3 2.9-4.3 3.7c-.5 .4-.9 .7-1.1 .8l-.2 .2 0 0 0 0C1 327.2-1.4 334.4 .8 340.9S9.1 352 16 352c21.8 0 43.8-5.6 62.1-12.5c9.2-3.5 17.8-7.4 25.3-11.4C134.1 343.3 169.8 352 208 352zM448 176c0 112.3-99.1 196.9-216.5 207C255.8 457.4 336.4 512 432 512c38.2 0 73.9-8.7 104.7-23.9c7.5 4 16 7.9 25.2 11.4c18.3 6.9 40.3 12.5 62.1 12.5c6.9 0 13.1-4.5 15.2-11.1c2.1-6.6-.2-13.8-5.8-17.9l0 0 0 0-.2-.2c-.2-.2-.6-.4-1.1-.8c-1-.8-2.5-2-4.3-3.7c-3.6-3.3-8.5-8.1-13.3-14.3c-5.5-7-10.7-15.4-14.2-24.7c24.9-29 39.6-64.7 39.6-103.4c0-92.8-84.9-168.9-192.6-175.5c.4 5.1 .6 10.3 .6 15.5z"/></svg>Community</a>
            <a href="./logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> LogOut</a>
        </nav>
    </header>
    <div id="myPopup" class="popup">
        <div class="popup-content">
            <div class="popup-header">
                <?php
                echo "
                        <h2>{$user['fname']} {$user['lname']}</h2>";
                ?>
                <span class="close" onclick="closeMyPopup()">&times;</span>
            </div>
            <div class="popup-body">
                <?php
                echo "
                    <h3>Personal information:</h3> <p>Birthdate : ";
                echo ($user['birthdate'] === NULL) ? 'empty' : '' . $user['birthdate'] . '';
                echo "</p><p>Phone Number : {$user['tel']}</p>
                    <p>Adress : ";
                echo ($user['adress'] === NULL) ? 'empty' : '' . $user['adress'] . '';
                echo "
                    </p><h3 class=pro>Professional information:</h3>
                    <p>Email : {$user['email']}</p>
                    <p>Service : {$user['service']}</p>
                    <p>Role : 
                ";
                echo ($user['role'] === 0) ? "Member" : (($user['role'] === 1) ? "Product Owner" : (($user['role'] === 2) ? "Scrum Master" : "Admin"));
                echo "</p>";
                ?>
                <div class="popup-footer">
                    <a class="delete" href="./deleteUser.php?deleteOne=<?php echo $user['id']; ?>">Delete</a>
                    <a href="./modify.php?modifyOne=<?php echo $user['id']; ?>">Modify</a>
                </div>
            </div>
        </div>
    </div>

    <main>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userID = $_POST['userID'];
            $newRole = $_POST['newRole'];
            $stmt = $conn->prepare("UPDATE users SET role = :newRole WHERE id = :userID");
            $stmt->bindParam(':newRole', $newRole);
            $stmt->bindParam(':userID', $userID);
            $stmt->execute();
            header('Location: dashboard.php?success=true');
            exit();
        }
        ?>
        <div class="hero">
            <?php
            echo '<h2 class=title>Hello ' . ucfirst($user['fname']) . ' ' . ucfirst($user['lname']) . '</h2>';

            if ($user['role'] === 3) {
                echo '<h4 class=sub-title>All Users : </h4>';
                echo '<div class=cards>';

                $query = "SELECT * from users WHERE users.role != 3";

                $stmt = $conn->prepare($query);
                $stmt->execute();
                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($users as $user) {
                    echo "<div class=card>
                                <div class=card-top>
                                    <h4>" . substr($user['fname'], 0, 1) . "" . substr($user['lname'], 0, 1) . "</h4>
                                    <h2>" . $user['fname'] . " " . $user['lname'] . "</h2>
                                </div>
                                <div class=card-body>
                                    <p>" . $user['email'] . "</p>
                                    <p>Tel: " . $user['tel'] . "</p>
                                </div>
                                <div class=card-btm>
                                    <a href=#><i class='fa-solid fa-location-dot' style='margin-right:5px;'></i>" . $user['service'] . "</a>";
                    echo ($user['role'] === 0) ? "<a onclick='openPopup(" . $user["id"] . ")'>Member <i class='fa-solid fa-pencil'></i></a>" : (($user['role'] === 1) ? "<a onclick='openPopup(" . $user["id"] . ")'>Product Owner <i class='fa-solid fa-pencil'></i></a>" : (($user['role'] === 2) ? "<a onclick='openPopup(" . $user["id"] . ")'>Scrum Master <i class='fa-solid fa-pencil'></i></a>" : ""));
                    echo "</div>
                            </div>";
                }
                echo '</div>';
            } else if ($user['role'] === 1) {
                echo '<div class="add">
                    <h4 class=sub-title>All Projects : </h4>
                    <a href="./addProject.php?productOwner=' . $user['id'] . '">+ New Project</a>
                </div>';

                $query = "SELECT * from projects WHERE productOwner = :id";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':id', $user['id'], PDO::PARAM_STR);
                $stmt->execute();
                $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo "<div class=fullPage><table class='teamTable'>
                        <tr>
                            <th>Project Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>";
                foreach ($projects as $project) {
                    echo "
                        <tr>
                            <td>{$project['name']}</td>
                            <td>{$project['date_start']}</td>
                            <td>{$project['date_end']}</td>
                            <td>{$project['description']}</td>
                            <td>";
                    echo ($project['status'] === 0) ? '<p  class=active>● Active</p>' : '<p class=done>✔ Done</p></td>';
                    echo "<td class='actions'><a href='./modifyProject.php?projectId=" . $project['id'] . "'>Modify</a> <a href='./deleteProject.php?deleteOne=" . $project['id'] . "'>Delete</a></td>";
                }

                echo "</table><h4 class=sub-title id=myTeams>Teams</h4> <div class='fullPage'>
                <table class='teamTable'>
                    <tr>
                        <th>Team Name</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th>Project Name</th>
                        <th>Action</th>
                    </tr>";
                $query1 = "SELECT * from teams WHERE scrumMaster IS NULL";
                $stmt1 = $conn->prepare($query1);
                $stmt1->execute();
                $teams = $stmt1->fetchAll(PDO::FETCH_ASSOC);
                foreach ($teams as $team) {
                    $query2 = "SELECT * from projects WHERE id = :id";
                    $stmt2 = $conn->prepare($query2);
                    $stmt2->bindParam(':id', $team['projectId'], PDO::PARAM_STR);

                    $stmt2->execute();
                    $teamP = $stmt2->fetch(PDO::FETCH_ASSOC);

                    echo "
                        <tr>
                            <td>{$team['name']}</td>
                            <td>{$team['description']}</td>
                            <td>{$team['created_at']}</td>
                            <td>{$teamP['name']}</td>
                            <td><a href=# onclick='openSMPopup(" . $team["id"] . ")'>Set Scrum Master</a></td>
                        </tr>";
                }
            } else if ($user['role'] === 2) {
                echo '<a href="#"><i class="fa-solid fa-plus"></i>Create Team</a>';
            } else {

                $query = "SELECT users.*, team_user.team_id AS teamId, teams.name AS team_name, teams.description AS team_description FROM users JOIN team_user ON users.id = team_user.user_id JOIN teams ON team_user.team_id = teams.id WHERE users.email = :email";

                $stmt = $conn->prepare($query);
                $stmt->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);


                if (empty($user)) {
                    echo '<div class=fullPage><h4>No Teams <br>No Projects</h4></div>';
                } else {
                    echo "<h4 class=sub-title id=myTeams>Teams</h4> <div class='fullPage'>";
                    echo "<table class='teamTable'>
                    <tr>
                        <th>Team Name</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th>Project Name</th>
                        <th>Scrum Master</th>
                    </tr>";

                    $userId = $user['id'];

                    $queryUserTeam = "SELECT team_id FROM team_user WHERE user_id = :userId";
                    $stmtUserTeam = $conn->prepare($queryUserTeam);
                    $stmtUserTeam->bindParam(':userId', $userId, PDO::PARAM_INT);
                    $stmtUserTeam->execute();
                    $userTeams = $stmtUserTeam->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($userTeams as $userTeam) {
                        $teamId = $userTeam['team_id'];

                        $queryTeam = "SELECT * FROM teams WHERE id = :teamId";
                        $stmtTeam = $conn->prepare($queryTeam);
                        $stmtTeam->bindParam(':teamId', $teamId, PDO::PARAM_INT);
                        $stmtTeam->execute();
                        $team = $stmtTeam->fetch(PDO::FETCH_ASSOC);

                        $teamProjectId = $team['projectId'];
                        $queryProject = "SELECT * FROM projects WHERE id = :projectId";
                        $stmtProject = $conn->prepare($queryProject);
                        $stmtProject->bindParam(':projectId', $teamProjectId, PDO::PARAM_INT);
                        $stmtProject->execute();
                        $project = $stmtProject->fetch(PDO::FETCH_ASSOC);

                        $querySM = "SELECT * FROM users WHERE id = :smId";
                        $stmtSM = $conn->prepare($querySM);
                        $stmtSM->bindParam(':smId', $team['scrumMaster'], PDO::PARAM_INT);
                        $stmtSM->execute();
                        $sm = $stmtSM->fetch(PDO::FETCH_ASSOC);

                        echo "
                        <tr>
                            <td>{$team['name']}</td>
                            <td>{$team['description']}</td>
                            <td>{$team['created_at']}</td>
                            <td>{$project['name']}</td>
                            <td>{$sm['fname']} {$sm['lname']}</td>
                        </tr>";
                    }

                    echo "</table>
                    <h4 class=sub-title id=myProjects>Projects</h4>
                    <table class='teamTable'>
                    <tr>
                        <th>Project Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Product Owner</th>
                    </tr>";
                    $query = "SELECT projects.*
                        FROM users
                        JOIN team_user ON users.id = team_user.user_id
                        JOIN teams ON team_user.team_id = teams.id
                        JOIN projects ON teams.projectId = projects.id
                        WHERE users.id = :userId";

                    $stmt = $conn->prepare($query);
                    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
                    $stmt->execute();

                    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($projects as $project) {
                        echo "
                        <tr>
                            <td>{$project['name']}</td>
                            <td>{$project['date_start']}</td>
                            <td>{$project['date_end']}</td>
                            <td>{$project['description']}</td>
                            <td>";
                        echo ($project['status'] === 0) ? '<p  class=active>● Active</p>' : '<p class=done>✔ Done</p></td>';
                        $queryPO = "SELECT * FROM users WHERE id = :poId";
                        $stmtPO = $conn->prepare($queryPO);
                        $stmtPO->bindParam(':poId', $project['productOwner'], PDO::PARAM_INT);
                        $stmtPO->execute();
                        $po = $stmtPO->fetch(PDO::FETCH_ASSOC);

                        echo "
                            <td>{$po['fname']} {$po['lname']}</td>
                        </tr>";
                    }
                    echo "</div>";
                }
            }
            ?>
        </div>
        <div id="popup" class="popup">
            <div class="popup-content">
                <div class="popup-header">
                    <h2>Modify User Role</h2>
                    <span class="close" onclick="closePopup()">&times;</span>
                </div>
                <div class="popup-body">
                    <form action="" method="post">
                        <label for="userID">User ID:</label>
                        <input type="text" id="userID" name="userID" id="userId" required>
                        <label for="newRole">New Role:</label>
                        <select name="newRole" id="newRole" required>
                            <option value="0">Member</option>
                            <option value="1">Product Owner</option>
                            <option value="2">Scrum Master</option>
                        </select>
                        <div class="popup-footer">
                            <button type="submit" class="btn btn-primary">Modify Role</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="SMpopup" class="popup">
            <div class="popup-content">
                <div class="popup-header">
                    <h2>Set Scrum Master</h2>
                    <span class="close" onclick="closeSMPopup()">&times;</span>
                </div>
                <div class="popup-body">
                    <form action="" method="post">
                        <label for="teamId">Team ID:</label>
                        <input type="text" id="teamId" name="teamId" required> <br>
                        <label for="newSM">New Scrum Master:</label>
                        <select name="newSM" id="newSM" required>
                            <option value="" hidden>Select Scrum Master</option>
                            <?php
                            $query = "SELECT * FROM users WHERE role = 2";
                            $stmt = $conn->prepare($query);
                            $stmt->execute();

                            $sms = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($sms as $sm) {
                                echo "<option value={$sm['id']}>{$sm['fname']} {$sm['lname']}</option>";
                            }
                            ?>
                        </select>
                        <div class="popup-footer">
                            <button type="submit" class="btn btn-primary" name="setSM">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $teamId = $_POST['teamId'];
                    $newSM = $_POST['newSM'];
                    $stmt = $conn->prepare("UPDATE teams SET scrumMaster = :newSM WHERE id = :teamId");
                    $stmt->bindParam(':newSM', $newSM, PDO::PARAM_INT);
                    $stmt->bindParam(':teamId', $teamId, PDO::PARAM_INT);
                    $stmt->execute();
                    header('Location: dashboard.php?success=true');
                    exit();
                }
            ?>
        </div>
    </main>


    <script>
        function openPopup(userID) {
            document.getElementById('userID').value = userID;
            document.getElementById('popup').style.display = 'flex';
        }

        function closePopup() {
            document.getElementById('popup').style.display = 'none';
        }

        function openMyPopup() {
            document.getElementById('myPopup').style.display = 'flex';
        }

        function closeMyPopup() {
            document.getElementById('myPopup').style.display = 'none';
        }

        function openSMPopup(teamId) {
            document.getElementById('teamId').value = teamId;

            document.getElementById('SMpopup').style.display = 'flex';
        }

        function closeSMPopup() {
            document.getElementById('SMpopup').style.display = 'none';
        }
    </script>

</body>

</html>