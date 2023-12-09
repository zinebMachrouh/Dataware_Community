<?php
ob_start();
session_start();
include "../SQL/connect.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Community</title>
    <meta name="title" content="Team and project management for DataWare">
    <meta name="keywords" content="team, project, Members, team management, project management">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="shortcut icon" href="../public/brand.png" type="image/x-icon">
    <link rel="stylesheet" href="../public/style1.css" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    <script src="https://kit.fontawesome.com/6e1faf1eda.js" crossorigin="anonymous"></script>
    <!-- fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                fontFamily: {
                    'Poppins': ['Poppins', 'sans serif'],
                },
                extend: {
                    colors: {
                        'white-color': '#F6F6F6',
                        'purp-color': '#8F51E1',
                        'blue-color': '#5476E4',
                        'blue-primary': '#308BE6',
                        'blutext': '#00A8E8',
                        'black-color': '#1E1E1E',
                    },

                },
            },
        }
    </script>


</head>

<body class="bg-white">
    <header>
        <h2>Data<img src=../public/brand.png alt=brand />are</h2>
        <nav>
            <a href="./dashboard.php"><i class="fa-solid fa-house"></i> Home</a>
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
            <a href="./community.php"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="20" viewBox="0 0 640 512">
                    <path fill="#008fd4" d="M208 352c114.9 0 208-78.8 208-176S322.9 0 208 0S0 78.8 0 176c0 38.6 14.7 74.3 39.6 103.4c-3.5 9.4-8.7 17.7-14.2 24.7c-4.8 6.2-9.7 11-13.3 14.3c-1.8 1.6-3.3 2.9-4.3 3.7c-.5 .4-.9 .7-1.1 .8l-.2 .2 0 0 0 0C1 327.2-1.4 334.4 .8 340.9S9.1 352 16 352c21.8 0 43.8-5.6 62.1-12.5c9.2-3.5 17.8-7.4 25.3-11.4C134.1 343.3 169.8 352 208 352zM448 176c0 112.3-99.1 196.9-216.5 207C255.8 457.4 336.4 512 432 512c38.2 0 73.9-8.7 104.7-23.9c7.5 4 16 7.9 25.2 11.4c18.3 6.9 40.3 12.5 62.1 12.5c6.9 0 13.1-4.5 15.2-11.1c2.1-6.6-.2-13.8-5.8-17.9l0 0 0 0-.2-.2c-.2-.2-.6-.4-1.1-.8c-1-.8-2.5-2-4.3-3.7c-3.6-3.3-8.5-8.1-13.3-14.3c-5.5-7-10.7-15.4-14.2-24.7c24.9-29 39.6-64.7 39.6-103.4c0-92.8-84.9-168.9-192.6-175.5c.4 5.1 .6 10.3 .6 15.5z" />
                </svg>Community</a>
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
        <h1 class="text-xl font-bold">All Answers</h1>
        <div class="flex gap-2 my-4">
                    <?php
                    $email = $_SESSION['email'];
                    $query = "SELECT projects.*
                            FROM projects
                            INNER JOIN teams ON projects.team_id = teams.id
                            INNER JOIN team_user ON teams.id = team_user.team_id
                            INNER JOIN users ON team_user.user_id = users.id
                            WHERE users.email = ':email';
                        ";
                    $stmt = $conn->prepare($query);
                    ?>            
        </div>

        <div class="">
            <?php
            $query = "SELECT * from questions ORDER BY created_at ASC";

            $stmt = $conn->prepare($query);
            $stmt->execute();
            $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($questions as $question) {
            ?>
        </div>
    <?php
            }

    ?>
    </div>
    </div>



    

    <?php
foreach ($questions as $question) {
    // Fetch answers using prepared statement
    $questionId = $question['id'];
    $queryAnswers = "SELECT * FROM answers WHERE question_id = :questionId";
    $stmtAnswers = $conn->prepare($queryAnswers);
    $stmtAnswers->bindParam(':questionId', $questionId, PDO::PARAM_INT);
    $stmtAnswers->execute();
    $answers = $stmtAnswers->fetchAll(PDO::FETCH_ASSOC);

    if ($answers) {
        echo '<div class="question">';
        echo '<h3> Title: ' . $question['title'] . '</h3>';
        
        echo '<div class="answers-container">';
        foreach ($answers as $answer) {
            echo '<div class="answer">';
            echo '<p>User ID: ' . $answer['user_id'] . '</p>';
            echo '<p>Title: ' . $answer['title'] . '</p>';
            echo '<p>Archive: ' . $answer['archive'] . '</p>';
            echo '<p>Question ID: ' . $answer['question_id'] . '</p>';
            echo '</div>';
        }
        echo '</div>';
        
        echo '</div>'; // Close the question div
    }
}
?>
<a href="com.php?question_id=<?php echo $question['id']; ?>">
        <button type="button"  data-question-id="<?php echo $question['id']; ?>" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Return</button>
    </a>
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

        function openTeamPopup(userID) {
            document.getElementById('scrumMaster').value = userID;
            document.getElementById('teamPopup').style.display = 'flex';
        }

        function closeTeamPopup() {
            document.getElementById('teamPopup').style.display = 'none';
        }

        function openSMPopup(teamId) {
            document.getElementById('teamId').value = teamId;

            document.getElementById('SMpopup').style.display = 'flex';
        }

        function closeSMPopup() {
            document.getElementById('SMpopup').style.display = 'none';
        }

        document.addEventListener('DOMContentLoaded', function () {
        const openModalBtn = document.querySelector('[data-modal-toggle="default-modal"]');
        const closeModalBtn = document.querySelector('[data-modal-hide="default-modal"]');
        const modal = document.getElementById('default-modal');
        const modalContent = document.getElementById('modalContent');
        const addAnswerBtn = document.querySelector('[data-modal-hide="default-modal"]');
        const cancelBtn = document.querySelector('[data-modal-hide="default-modal"]');
        const modalTitle = document.getElementById('modalTitle');

        openModalBtn.addEventListener('click', function () {
            // Set the question in the modal
            modalTitle.textContent = 'Question:';
            modalContent.value = openModalBtn.textContent.trim();
            modal.classList.remove('hidden');
        });

        closeModalBtn.addEventListener('click', function () {
            modal.classList.add('hidden');
        });

        addAnswerBtn.addEventListener('click', function () {
            // Send textarea data via AJAX if needed
            // Example without AJAX:
            alert('Answer added: ' + modalContent.value);
            modal.classList.add('hidden');
        });

        cancelBtn.addEventListener('click', function () {
            modal.classList.add('hidden');
        });
    });

    
    </script>
</body>

</html>