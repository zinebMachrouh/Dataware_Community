<?php
ob_start();
session_start();
include "../SQL/connect.php";

        if (isset($_POST['Answer'])) {
            $title = $_POST['title'];
            $user_id = $_SESSION['userId'];
            $question_id = $_POST['question_id'];
            // $description = $_POST['description'];
            
            $query = "INSERT INTO answers (title,user_id, question_id) VALUES (:title, :user_id, :question_id)";

            $stmt = $conn->prepare($query);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':question_id', $question_id);

            $stmt->execute();
            header('Location: ./communitycopy.php');
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
            $query = "SELECT questions.*, projects.name as project_name from questions INNER JOIN projects WHERE questions.project_id = projects.id AND archive=0 ORDER BY created_at ASC;";

            $stmt = $conn->prepare($query);
            $stmt->execute();
            $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($questions as $question) {
            ?>

                <div class="overflow-hidden flex my-4 rounded-lg question">
                    <div class="flex flex-row items-center">
                        <div class="flex flex-col h-full p-4  gap-5" style="background-color: #fafafa; color:#00a8e8;">
                            <a href="#" class="grid justify-items-center">
                                <p>0</p>
                                <svg xmlns="http://www.w3.org/2000/svg" height="28" width="20" viewBox="0 0 512 512">
                                    <path fill="#00a8e8" d="M323.8 34.8c-38.2-10.9-78.1 11.2-89 49.4l-5.7 20c-3.7 13-10.4 25-19.5 35l-51.3 56.4c-8.9 9.8-8.2 25 1.6 33.9s25 8.2 33.9-1.6l51.3-56.4c14.1-15.5 24.4-34 30.1-54.1l5.7-20c3.6-12.7 16.9-20.1 29.7-16.5s20.1 16.9 16.5 29.7l-5.7 20c-5.7 19.9-14.7 38.7-26.6 55.5c-5.2 7.3-5.8 16.9-1.7 24.9s12.3 13 21.3 13L448 224c8.8 0 16 7.2 16 16c0 6.8-4.3 12.7-10.4 15c-7.4 2.8-13 9-14.9 16.7s.1 15.8 5.3 21.7c2.5 2.8 4 6.5 4 10.6c0 7.8-5.6 14.3-13 15.7c-8.2 1.6-15.1 7.3-18 15.2s-1.6 16.7 3.6 23.3c2.1 2.7 3.4 6.1 3.4 9.9c0 6.7-4.2 12.6-10.2 14.9c-11.5 4.5-17.7 16.9-14.4 28.8c.4 1.3 .6 2.8 .6 4.3c0 8.8-7.2 16-16 16H286.5c-12.6 0-25-3.7-35.5-10.7l-61.7-41.1c-11-7.4-25.9-4.4-33.3 6.7s-4.4 25.9 6.7 33.3l61.7 41.1c18.4 12.3 40 18.8 62.1 18.8H384c34.7 0 62.9-27.6 64-62c14.6-11.7 24-29.7 24-50c0-4.5-.5-8.8-1.3-13c15.4-11.7 25.3-30.2 25.3-51c0-6.5-1-12.8-2.8-18.7C504.8 273.7 512 257.7 512 240c0-35.3-28.6-64-64-64l-92.3 0c4.7-10.4 8.7-21.2 11.8-32.2l5.7-20c10.9-38.2-11.2-78.1-49.4-89zM32 192c-17.7 0-32 14.3-32 32V448c0 17.7 14.3 32 32 32H96c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32H32z" />
                                </svg>
                            </a>
                            <a href="#" class="grid justify-items-center">
                                <p>0</p>
                                <svg xmlns="http://www.w3.org/2000/svg" height="28" width="20" viewBox="0 0 512 512">
                                    <path fill="#00a8e8" d="M323.8 477.2c-38.2 10.9-78.1-11.2-89-49.4l-5.7-20c-3.7-13-10.4-25-19.5-35l-51.3-56.4c-8.9-9.8-8.2-25 1.6-33.9s25-8.2 33.9 1.6l51.3 56.4c14.1 15.5 24.4 34 30.1 54.1l5.7 20c3.6 12.7 16.9 20.1 29.7 16.5s20.1-16.9 16.5-29.7l-5.7-20c-5.7-19.9-14.7-38.7-26.6-55.5c-5.2-7.3-5.8-16.9-1.7-24.9s12.3-13 21.3-13L448 288c8.8 0 16-7.2 16-16c0-6.8-4.3-12.7-10.4-15c-7.4-2.8-13-9-14.9-16.7s.1-15.8 5.3-21.7c2.5-2.8 4-6.5 4-10.6c0-7.8-5.6-14.3-13-15.7c-8.2-1.6-15.1-7.3-18-15.2s-1.6-16.7 3.6-23.3c2.1-2.7 3.4-6.1 3.4-9.9c0-6.7-4.2-12.6-10.2-14.9c-11.5-4.5-17.7-16.9-14.4-28.8c.4-1.3 .6-2.8 .6-4.3c0-8.8-7.2-16-16-16H286.5c-12.6 0-25 3.7-35.5 10.7l-61.7 41.1c-11 7.4-25.9 4.4-33.3-6.7s-4.4-25.9 6.7-33.3l61.7-41.1c18.4-12.3 40-18.8 62.1-18.8H384c34.7 0 62.9 27.6 64 62c14.6 11.7 24 29.7 24 50c0 4.5-.5 8.8-1.3 13c15.4 11.7 25.3 30.2 25.3 51c0 6.5-1 12.8-2.8 18.7C504.8 238.3 512 254.3 512 272c0 35.3-28.6 64-64 64l-92.3 0c4.7 10.4 8.7 21.2 11.8 32.2l5.7 20c10.9 38.2-11.2 78.1-49.4 89zM32 384c-17.7 0-32-14.3-32-32V128c0-17.7 14.3-32 32-32H96c17.7 0 32 14.3 32 32V352c0 17.7-14.3 32-32 32H32z" />
                                </svg>
                            </a>
                            <a href="#" class="grid justify-items-center">
                                <p>0</p>
                                <svg xmlns="http://www.w3.org/2000/svg" height="28" width="20" viewBox="0 0 512 512">
                                    <path fill="#00a8e8" d="M123.6 391.3c12.9-9.4 29.6-11.8 44.6-6.4c26.5 9.6 56.2 15.1 87.8 15.1c124.7 0 208-80.5 208-160s-83.3-160-208-160S48 160.5 48 240c0 32 12.4 62.8 35.7 89.2c8.6 9.7 12.8 22.5 11.8 35.5c-1.4 18.1-5.7 34.7-11.3 49.4c17-7.9 31.1-16.7 39.4-22.7zM21.2 431.9c1.8-2.7 3.5-5.4 5.1-8.1c10-16.6 19.5-38.4 21.4-62.9C17.7 326.8 0 285.1 0 240C0 125.1 114.6 32 256 32s256 93.1 256 208s-114.6 208-256 208c-37.1 0-72.3-6.4-104.1-17.9c-11.9 8.7-31.3 20.6-54.3 30.6c-15.1 6.6-32.3 12.6-50.1 16.1c-.8 .2-1.6 .3-2.4 .5c-4.4 .8-8.7 1.5-13.2 1.9c-.2 0-.5 .1-.7 .1c-5.1 .5-10.2 .8-15.3 .8c-6.5 0-12.3-3.9-14.8-9.9c-2.5-6-1.1-12.8 3.4-17.4c4.1-4.2 7.8-8.7 11.3-13.5c1.7-2.3 3.3-4.6 4.8-6.9c.1-.2 .2-.3 .3-.5z" />
                                </svg>
                            </a>
                            <div class="flex flex-row gap-2">
                                <a href="./archive.php?archiveId=<?php echo $question['id']; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="28" width="20" viewBox="0 0 512 512">
                                        <path fill="#8F51E1" d="M121 32C91.6 32 66 52 58.9 80.5L1.9 308.4C.6 313.5 0 318.7 0 323.9V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V323.9c0-5.2-.6-10.4-1.9-15.5l-57-227.9C446 52 420.4 32 391 32H121zm0 64H391l48 192H387.8c-12.1 0-23.2 6.8-28.6 17.7l-14.3 28.6c-5.4 10.8-16.5 17.7-28.6 17.7H195.8c-12.1 0-23.2-6.8-28.6-17.7l-14.3-28.6c-5.4-10.8-16.5-17.7-28.6-17.7H73L121 96z" />
                                    </svg>
                                </a>
                                <a href="./modifyQuestion.php?modifyOne=<?php echo $question['id']; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="28" width="20" viewBox="0 0 512 512">
                                        <path fill="#8f51e1" d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z" />
                                    </svg>
                                </a>
                                <?php echo "<a href='./deleteQuestion.php?deleteOne=" . $question['id'] . "'>"; ?>
                                <svg xmlns="http://www.w3.org/2000/svg" height="28" width="20" viewBox="0 0 448 512">
                                    <path fill="#8f51e1" d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z" />
                                </svg>
                                </a>
                            </div>
                        </div>
                        <div class="flex flex-col justify-between mx-3 h-full">
                            <div>
                                <div class="pt-4 text-xl font-extrabold	">
                                    <h2><?php echo $question['title']; ?></h2>
                                </div>
                                <div class="text-xs font-light">
                                    <h2>Project: <?php echo $question['project_name']; ?></h2>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <h3 class="pt-4 text-lg font-light"><?php echo $question['content']; ?></h2>
                            </div>
                            <div class="py-4 flex items-center gap-10 mt-2">
                                <?php echo "
                                <a  href=# onclick='openAnswerPopup(" . $question["id"] . ")' class='flex items-center border border-gray-300 px-2 py-1 rounded-lg'>  ";
                                ?>
                                <svg class="pr-1" xmlns="http://www.w3.org/2000/svg" height="28" width="28" viewBox="0 0 448 512">
                                    <path fill="#ffffff" d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
                                </svg>
                                Add an answer
                            </a>
                            <?php
                                echo $question['id'];
                                $query = "SELECT tags.name
                                            FROM tags
                                            INNER JOIN tag_question ON tags.id = tag_question.tag_id
                                            WHERE tag_question.question_id = :question_id";

                                $stmt = $conn->prepare($query);
                                $stmt->bindParam(':question_id', $question['id'], PDO::PARAM_INT);
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
        <div id="AnswerPopup" class="popup">
            <div class="popup-content">
                <div class="popup-header">
                    <h2>Add answer</h2>
                    <span class="close" onclick="closeAnswerPopup()">&times;</span>
                </div>
                <div class="popup-body">
                    <form action="communitycopy.php" method="post">
                        <input type="text" name="question_id" id="question_id">
                    
                        <?php
                            echo "<input type='text' name='userId' value='".$_SESSION['userId']."'/>" ;
                            echo $question['id'];
                            // var_dump($question["id"]);
                            // $query1 = "SELECT title FROM questions where id = :id";
                            // $stmt = $conn->prepare($query1);
                            // $stmt->bindParam(':id', $question['id'], PDO::PARAM_INT);
                            // $stmt->execute();
                        ?>
                        <label for="title" style="color: #008fd4; font-size: 16px; font-weight: 600;">Content:</label><br>
                        <input type="text" id="title" name="title" placeholder="Answer content" required style="width: 100%; padding: 10px 7px; font-size: 16px; border-radius: 5px; outline: none; border: #1e1e1e4c 1px solid; margin-bottom: 15px;"> <br>
                        <div class="popup-footer">
                            <button type="submit" class="btn btn-primary" name="Answer">Submit</button>
                        </div>
                    </form>
                </div>
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

        function openAnswerPopup(question_id) {
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