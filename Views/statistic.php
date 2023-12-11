<?php
ob_start();
session_start();
include "../SQL/connect.php";
?>
<?php
// consulter le nombre des questions par projet:
$query = "SELECT projects.name,COUNT(questions.id) AS nombre_questions
                        FROM projects
                        LEFT JOIN questions ON projects.id = questions.project_id
                        GROUP BY projects.id, projects.name;";
$stmt = $conn->prepare($query);
$stmt->execute();
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);





// les projets avec le plus de questions:
$query1 = "SELECT projects.name, COUNT(questions.id) AS nombre_questions
                        FROM projects
                        LEFT JOIN questions ON projects.id = questions.project_id
                        GROUP BY projects.id, projects.name
                        ORDER BY nombre_questions DESC
                        LIMIT 1;";
$stmt1 = $conn->prepare($query1);
$stmt1->execute();
$questions = $stmt1->fetchAll(PDO::FETCH_ASSOC);
// le projet avec le moin des reponses:
$query2 = "SELECT projects.name, COUNT(answers.id) AS nombre_reponses FROM projects LEFT JOIN questions ON projects.id = questions.project_id LEFT JOIN answers ON questions.id = answers.id GROUP BY projects.id, projects.name ORDER BY nombre_reponses ASC LIMIT 1;";
$stmt2 = $conn->prepare($query2);
$stmt2->execute();
$reponses = $stmt2->fetchAll(PDO::FETCH_ASSOC);
// l'utilisateur avec le plus reponses:
$query3 = "SELECT users.fname,users.lname, COUNT(answers.id) AS nombre_reponses FROM users LEFT JOIN answers ON users.id = answers.user_id GROUP BY users.id, users.fname, users.lname ORDER BY nombre_reponses DESC LIMIT 1;";
$stmt3 = $conn->prepare($query3);
$stmt3->execute();
$users = $stmt3->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="shortcut icon" href="../public/brand.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/6e1faf1eda.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../public/style1.css?v=<?php echo time(); ?>" type="text/css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- jquery cdn -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="my_jquery_functions.js"></script>
    <script>
        tailwind.config = {
            theme: {
                fontFamily: {
                    'Saira': ['Saira Condensed', 'sans-serif']

                },
                extend: {
                    colors: {
                        'dark': '#1e1b4b',
                        'white-color': '#F6F6F6',
                        'purp-color': '#8F51E1',
                        'blue-color': '#5476E4',
                        'blue-primary': '#308BE6',
                        'blutext': '#00A8E8',
                        'question': '#008fd4',
                        'black-color': '# 1E1 E1E ',
                    },

                },
            },
        }
    </script>
    <style>
    </style>
</head>

<body class="login-body">
    <header class="mb-30">
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
    <main class="flex flex-col gap-10 items-center mt-40 ">
        <div class="flex flex-row gap-10 flex-wrap">
            <?php foreach ($projects as $project) { ?>
                <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2"><?= $project['name'] ?></div>
                    </div>
                    <div class="px-6 pt-4 pb-2 flex items-center justify-center">
                        <span class="inline-block bg-gray-200 rounded-lg px-4 py-4 text-sm font-semibold text-gray-700 mr-2 mb-2"><span>Nombre des Questions :</span><?= $project['nombre_questions'] ?></span>
                    </div>
                </div>
            <?php } ?>
        </div>
        <h1 class=title>projects with the most questions</h1>
        <div class="flex flex-row gap-10 flex-wrap">

            <?php foreach ($questions as $question) { ?>
                <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2"><?= $question['name'] ?></div>
                    </div>
                    <div class="px-6 pt-4 pb-2 flex items-center justify-center">
                        <span class="inline-block bg-gray-200 rounded-lg px-4 py-4 text-sm font-semibold text-gray-700 mr-2 mb-2"><span>Nombre des Questions :</span><?= $question['nombre_questions'] ?></span>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="flex flex-row gap-20 flex-wrap">
            <div class="flex flex-col gap-5">
                <h2 class=title> the project with the least of the answers</h2>
                <?php foreach ($reponses as $reponse) { ?>
                    <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white">
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2"><?= $reponse['name'] ?></div>
                        </div>
                        <div class="px-6 pt-4 pb-2 flex items-center justify-center">
                            <span class="inline-block bg-gray-200 rounded-lg px-4 py-4 text-sm font-semibold text-gray-700 mr-2 mb-2"><span>Nombre des reponses :</span><?= $reponse['nombre_reponses'] ?></span>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <div class="flex flex-col gap-5">
                <h2 class=title>the user with the most answers</h2>
                <?php foreach ($users as $user) { ?>
                    <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white">
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2"><?= $user['fname'] . ' ' . $user['lname'] ?></div>
                        </div>

                        <div class="px-6 pt-4 pb-2 flex items-center justify-center">
                            <span class="inline-block bg-gray-200 rounded-lg px-4 py-4 text-sm font-semibold text-gray-700 mr-2 mb-2"><span>Nombre des reponses :</span><?= $reponse['nombre_reponses'] ?></span>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>
</body>

</html>