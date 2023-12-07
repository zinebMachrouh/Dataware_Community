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
        <h1 class="text-xl font-bold">All Questions</h1>
        <div class="flex gap-2 my-4">
            <div class="filters flex flex-row gap-3">
                <select name="project" id="project" class="px-2 py-1 rounded-lg" style="width: 150px;">
                    <option value="" hidden> Projects <i class="fa-solid fa-filter" style="color: #00a8e8;"></i></option>
                    <?php
                    $email = $_SESSION['email'];
                    $query = "SELECT projects.*
                            FROM projects
                            INNER JOIN teams ON projects.id = teams.projectId
                            INNER JOIN team_user ON teams.id = team_user.team_id
                            INNER JOIN users ON team_user.user_id = users.id
                            WHERE users.email = ':email';
                        ";
                    $stmt = $conn->prepare($query);
                    ?>
                </select>
                <a href="" class="flex flex-row border justify-center items-center border-gray-300 px-2 py-1 rounded-lg" style="width: 150px;">
                    Tags
                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512">
                        <path fill="#ffffff" d="M3.9 54.9C10.5 40.9 24.5 32 40 32H472c15.5 0 29.5 8.9 36.1 22.9s4.6 30.5-5.2 42.5L320 320.9V448c0 12.1-6.8 23.2-17.7 28.6s-23.8 4.3-33.5-3l-64-48c-8.1-6-12.8-15.5-12.8-25.6V320.9L9 97.3C-.7 85.4-2.8 68.8 3.9 54.9z" />
                    </svg>
                </a>
            </div>
            <div class="flex-1 relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg dark:border-gray-600 dark:placeholder-gray-400   dark:focus:border-blue-500" placeholder="Search title..." required />
                <button type="submit" class=" absolute end-2.5 bottom-2.5 bg-blue-700  focus:ring-4  focus:ring-blue-300  rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:focus:ring-blue-800 bg-blue-primary">
                    Search
                </button>
            </div>
        </div>
        <div>
            <?php
            $query = "SELECT * from questions INNER JOIN projects WHERE questions.project_id = projects.id ORDER BY created_at ASC;";

            $stmt = $conn->prepare($query);
            $stmt->execute();
            $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($questions as $question) {
            ?>
                <div class="pb-4 flex items-center my-4 rounded-lg px-3 question">
                    <div class="flex-col">
                        <div class="gap-10 ">
                            <div class="grid justify-items-center">
                                <p>0</p>
                                <svg xmlns="http://www.w3.org/2000/svg" height="28" width="20" viewBox="0 0 512 512">
                                    <path fill="#ffffff" d="M323.8 34.8c-38.2-10.9-78.1 11.2-89 49.4l-5.7 20c-3.7 13-10.4 25-19.5 35l-51.3 56.4c-8.9 9.8-8.2 25 1.6 33.9s25 8.2 33.9-1.6l51.3-56.4c14.1-15.5 24.4-34 30.1-54.1l5.7-20c3.6-12.7 16.9-20.1 29.7-16.5s20.1 16.9 16.5 29.7l-5.7 20c-5.7 19.9-14.7 38.7-26.6 55.5c-5.2 7.3-5.8 16.9-1.7 24.9s12.3 13 21.3 13L448 224c8.8 0 16 7.2 16 16c0 6.8-4.3 12.7-10.4 15c-7.4 2.8-13 9-14.9 16.7s.1 15.8 5.3 21.7c2.5 2.8 4 6.5 4 10.6c0 7.8-5.6 14.3-13 15.7c-8.2 1.6-15.1 7.3-18 15.2s-1.6 16.7 3.6 23.3c2.1 2.7 3.4 6.1 3.4 9.9c0 6.7-4.2 12.6-10.2 14.9c-11.5 4.5-17.7 16.9-14.4 28.8c.4 1.3 .6 2.8 .6 4.3c0 8.8-7.2 16-16 16H286.5c-12.6 0-25-3.7-35.5-10.7l-61.7-41.1c-11-7.4-25.9-4.4-33.3 6.7s-4.4 25.9 6.7 33.3l61.7 41.1c18.4 12.3 40 18.8 62.1 18.8H384c34.7 0 62.9-27.6 64-62c14.6-11.7 24-29.7 24-50c0-4.5-.5-8.8-1.3-13c15.4-11.7 25.3-30.2 25.3-51c0-6.5-1-12.8-2.8-18.7C504.8 273.7 512 257.7 512 240c0-35.3-28.6-64-64-64l-92.3 0c4.7-10.4 8.7-21.2 11.8-32.2l5.7-20c10.9-38.2-11.2-78.1-49.4-89zM32 192c-17.7 0-32 14.3-32 32V448c0 17.7 14.3 32 32 32H96c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32H32z" />
                                </svg>
                            </div>
                            <div class="grid justify-items-center">
                                <p>0</p>
                                <svg xmlns="http://www.w3.org/2000/svg" height="28" width="20" viewBox="0 0 512 512">
                                    <path fill="#ffffff" d="M323.8 477.2c-38.2 10.9-78.1-11.2-89-49.4l-5.7-20c-3.7-13-10.4-25-19.5-35l-51.3-56.4c-8.9-9.8-8.2-25 1.6-33.9s25-8.2 33.9 1.6l51.3 56.4c14.1 15.5 24.4 34 30.1 54.1l5.7 20c3.6 12.7 16.9 20.1 29.7 16.5s20.1-16.9 16.5-29.7l-5.7-20c-5.7-19.9-14.7-38.7-26.6-55.5c-5.2-7.3-5.8-16.9-1.7-24.9s12.3-13 21.3-13L448 288c8.8 0 16-7.2 16-16c0-6.8-4.3-12.7-10.4-15c-7.4-2.8-13-9-14.9-16.7s.1-15.8 5.3-21.7c2.5-2.8 4-6.5 4-10.6c0-7.8-5.6-14.3-13-15.7c-8.2-1.6-15.1-7.3-18-15.2s-1.6-16.7 3.6-23.3c2.1-2.7 3.4-6.1 3.4-9.9c0-6.7-4.2-12.6-10.2-14.9c-11.5-4.5-17.7-16.9-14.4-28.8c.4-1.3 .6-2.8 .6-4.3c0-8.8-7.2-16-16-16H286.5c-12.6 0-25 3.7-35.5 10.7l-61.7 41.1c-11 7.4-25.9 4.4-33.3-6.7s-4.4-25.9 6.7-33.3l61.7-41.1c18.4-12.3 40-18.8 62.1-18.8H384c34.7 0 62.9 27.6 64 62c14.6 11.7 24 29.7 24 50c0 4.5-.5 8.8-1.3 13c15.4 11.7 25.3 30.2 25.3 51c0 6.5-1 12.8-2.8 18.7C504.8 238.3 512 254.3 512 272c0 35.3-28.6 64-64 64l-92.3 0c4.7 10.4 8.7 21.2 11.8 32.2l5.7 20c10.9 38.2-11.2 78.1-49.4 89zM32 384c-17.7 0-32-14.3-32-32V128c0-17.7 14.3-32 32-32H96c17.7 0 32 14.3 32 32V352c0 17.7-14.3 32-32 32H32z" />
                                </svg>
                            </div>
                            <div class="grid justify-items-center">
                                <p>0</p>
                                <svg xmlns="http://www.w3.org/2000/svg" height="28" width="20" viewBox="0 0 512 512">
                                    <path fill="#ffffff" d="M123.6 391.3c12.9-9.4 29.6-11.8 44.6-6.4c26.5 9.6 56.2 15.1 87.8 15.1c124.7 0 208-80.5 208-160s-83.3-160-208-160S48 160.5 48 240c0 32 12.4 62.8 35.7 89.2c8.6 9.7 12.8 22.5 11.8 35.5c-1.4 18.1-5.7 34.7-11.3 49.4c17-7.9 31.1-16.7 39.4-22.7zM21.2 431.9c1.8-2.7 3.5-5.4 5.1-8.1c10-16.6 19.5-38.4 21.4-62.9C17.7 326.8 0 285.1 0 240C0 125.1 114.6 32 256 32s256 93.1 256 208s-114.6 208-256 208c-37.1 0-72.3-6.4-104.1-17.9c-11.9 8.7-31.3 20.6-54.3 30.6c-15.1 6.6-32.3 12.6-50.1 16.1c-.8 .2-1.6 .3-2.4 .5c-4.4 .8-8.7 1.5-13.2 1.9c-.2 0-.5 .1-.7 .1c-5.1 .5-10.2 .8-15.3 .8c-6.5 0-12.3-3.9-14.8-9.9c-2.5-6-1.1-12.8 3.4-17.4c4.1-4.2 7.8-8.7 11.3-13.5c1.7-2.3 3.3-4.6 4.8-6.9c.1-.2 .2-.3 .3-.5z" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex-row">
                            <div class="pt-4 text-xl font-extrabold	">
                                <h2><?php echo $question['title']; ?></h2>
                            </div>
                            <div class="text-xs font-light">
                                <h2>Nom projet: <?php echo $question['name']; ?></h2>
                            </div>
                            <div class="flex items-center justify-between">
                                <h3 class="pt-4 text-lg font-light"><?php echo $question['content']; ?></h2>
                            </div>
                            <div class="py-4 flex items-center gap-10 mt-2">
                                <a href="" class="flex items-center border border-gray-300 px-2 py-1 rounded-lg">
                                    <svg class="pr-1" xmlns="http://www.w3.org/2000/svg" height="28" width="28" viewBox="0 0 448 512">
                                        <path fill="#ffffff" d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
                                    </svg>
                                    Add an answer
                                </a>
                                <?php
                                $query = "SELECT * FROM `tags`;";

                                $stmt = $conn->prepare($query);
                                $stmt->execute();
                                $tags = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($tags as $tag) {
                                ?>
                                    <p class="border border-gray-300 px-2 rounded-full"><?php echo $tag['name']; ?></p>
                                <?php
                                }

                                ?>
                            </div>
                        </div>
                    </div>

                </div>
            <?php
            }

            ?>
        </div>
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
    </script>

</body>

</html>