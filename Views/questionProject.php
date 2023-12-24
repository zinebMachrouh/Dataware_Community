<?php
ob_start();
session_start();
include "../SQL/connect.php";

if (isset($_POST['Answer'])) {
    $title = $_POST['title'];
    $user_id = $_SESSION['user_id'];
    $question_id = $_POST['question_id'];
    // $description = $_POST['description'];

    $query = "INSERT INTO answers (title,user_id, question_id) VALUES (:title, :user_id, :question_id)";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':question_id', $question_id);

    $stmt->execute();
    header('Location: ./community.php');
    exit();
}

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
    <script src="https://kit.fontawesome.com/6e1faf1eda.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
            <a href="./dashboard.php">
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="18" viewBox="0 0 576 512">
                    <path fill="#008fd4" d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z" />
                </svg>
                Home
            </a>
            <a href="#" onclick="openMyPopup()">
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512">
                    <path fill="#008fd4" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                </svg>
                Profile
            </a>
            <a href="./community.php">
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="20" viewBox="0 0 640 512">
                    <path fill="#008fd4" d="M208 352c114.9 0 208-78.8 208-176S322.9 0 208 0S0 78.8 0 176c0 38.6 14.7 74.3 39.6 103.4c-3.5 9.4-8.7 17.7-14.2 24.7c-4.8 6.2-9.7 11-13.3 14.3c-1.8 1.6-3.3 2.9-4.3 3.7c-.5 .4-.9 .7-1.1 .8l-.2 .2 0 0 0 0C1 327.2-1.4 334.4 .8 340.9S9.1 352 16 352c21.8 0 43.8-5.6 62.1-12.5c9.2-3.5 17.8-7.4 25.3-11.4C134.1 343.3 169.8 352 208 352zM448 176c0 112.3-99.1 196.9-216.5 207C255.8 457.4 336.4 512 432 512c38.2 0 73.9-8.7 104.7-23.9c7.5 4 16 7.9 25.2 11.4c18.3 6.9 40.3 12.5 62.1 12.5c6.9 0 13.1-4.5 15.2-11.1c2.1-6.6-.2-13.8-5.8-17.9l0 0 0 0-.2-.2c-.2-.2-.6-.4-1.1-.8c-1-.8-2.5-2-4.3-3.7c-3.6-3.3-8.5-8.1-13.3-14.3c-5.5-7-10.7-15.4-14.2-24.7c24.9-29 39.6-64.7 39.6-103.4c0-92.8-84.9-168.9-192.6-175.5c.4 5.1 .6 10.3 .6 15.5z" />
                </svg>
                Community
            </a>
            <a href="./logout.php">
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512">
                    <path fill="#008fd4" d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
                </svg>
                LogOut
            </a>
        </nav>
    </header>
    <?php
    $email = $_SESSION['email'];

    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['userId'] = $user['id'];

    ?>
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
        <h1 class="text-xl font-bold">All Questions</h1>
        <div class="flex gap-2 my-4">
            <div class="filters flex flex-row gap-3">
                <select name="project" id="project" class="px-2 py-1 rounded-lg" style="width: 150px;">
                    <option value="" hidden> Projects <i class="fa-solid fa-filter" style="color: #00a8e8;"></i></option>
                    <?php
                    $email = $_SESSION['email'];
                    $queryProject = "SELECT projects.*
                            FROM projects
                            INNER JOIN teams ON projects.id = teams.projectId
                            INNER JOIN team_user ON teams.id = team_user.team_id
                            INNER JOIN users ON team_user.user_id = users.id
                            WHERE users.email = :email";
                    $stmtProject = $conn->prepare($queryProject);
                    $stmtProject->bindParam(':email', $email, PDO::PARAM_STR);
                    $stmtProject->execute();
                    $projects = $stmtProject->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($projects as $project) {
                        echo "<option value='" . $project['id'] . "'>" . $project['name'] . "</option>";
                    }

                    ?>
                </select>

            </div>
            <div class="flex-1 relative ml-3">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg dark:border-gray-600 dark:placeholder-gray-400   dark:focus:border-blue-500" placeholder="Search By Title Or Tag..." required />
                <button type="submit" class=" absolute end-2.5 bottom-2.5 bg-blue-700  focus:ring-4  focus:ring-blue-300  rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:focus:ring-blue-800 bg-blue-primary">
                    Search
                </button>
            </div>

        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                showdata(1);
            });

            function showdata(page) {
                $.ajax({
                    url: 'pagination2.php',
                    method: 'post',
                    data: {
                        page_no: page,
                        project_id : $_GET['project_id']
                    },
                    success: function(result) {
                        $("#result").html(result);
                    }
                });
            }

            $(document).on("click", ".pagination a", function(e) {
                e.preventDefault();
                var page = $(this).data('page');
                showdata(page);
            });
        </script>

        <!-- display the search result -->
        <div class="overflow-hidden flex flex-col my-4 rounded-lg question search-result-container ">

        </div>


        <!-- pagination -->
        <div class="flex flex-col gap-5 allquestions" id="result">

        </div>





    </main>

    <!-- ajax search -->
    <script type="text/javascript">
        $(document).ready(function() {
            $("#default-search").keyup(function() {
                var input = $(this).val();
                if (input != "") {
                    $.ajax({
                        url: "test.php",
                        method: "POST",
                        data: {
                            input: input
                        },
                        success: function(data) {
                            if (data.trim() === "NO DATA FOUND") {
                                $(".search-result-container").html("<h6 class='flex flex-col h-full p-4 gap-5' style='background-color: #fafafa; color:#00a8e8;'>NO DATA FOUND</h6>");
                            } else {
                                $(".search-result-container").html(data);
                            }
                            $(".myDiv").hide();
                            $(".search-result-container").show();
                        }
                    });
                } else {
                    $(".myDiv").show();
                    $(".search-result-container").hide();
                }
            });


        });
    </script>


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

        function openAnswerPopup(question_id, question_title) {
            console.log(question_title);
            console.log(question_id);
            document.getElementById('questionPopup').innerHTML = question_title;
            document.getElementById('question_id').value = question_id;

            document.getElementById('AnswerPopup').style.display = 'flex';
        }

        function closeAnswerPopup() {
            document.getElementById('AnswerPopup').style.display = 'none';
        }


        function openTeamPopup(userID) {
            document.getElementById('userID').value = userID;
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
    </script>

</body>

</html>