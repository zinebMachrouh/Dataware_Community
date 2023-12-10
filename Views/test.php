<?php
include "../SQL/connect.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="shortcut icon" href="../public/brand.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/6e1faf1eda.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../public/style1.css" type="text/css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<?php

if (isset($_POST['input'])) {
    $input = $_POST['input'];
    $query = "SELECT q.id, q.title, q.content, p.name
    FROM questions q
    INNER JOIN projects p ON q.project_id = p.id
    WHERE q.title LIKE :inputPrefix";
    // $query = "SELECT * from questions INNER JOIN projects WHERE title LIKE :inputPrefix";

    $stmt = $conn->prepare($query);
    $stmt->bindValue(':inputPrefix', $input . '%', PDO::PARAM_STR);

    if ($stmt->execute()) {
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result) {
            foreach ($result as $row) {

                echo '
                <div class="overflow-hidden flex flex-col my-4 rounded-lg question"  >
                <div class="flex flex-row items-center">
                <div class="flex flex-col h-full p-4  gap-5" style="background-color: #fafafa; color:#00a8e8;">';
                echo "<a href='./likeQuestion.php?question_id=" . $row['id'] . "' class='grid justify-items-center'>";
                $dislikeQuery = "SELECT COUNT(reaction) AS NumberOfDislikes FROM reactions WHERE reaction = 1 AND question_id = :question_id GROUP BY question_id";
                $stmt1 = $conn->prepare($dislikeQuery);
                $stmt1->bindParam(':question_id', $row['id'], PDO::PARAM_INT);
                $stmt1->execute();
                $result = $stmt1->fetch(PDO::FETCH_ASSOC);
                $numberOfLlikes = ($result) ? $result['NumberOfDislikes'] : 0;

                echo '<p>' . $numberOfLlikes . '</p>';

                echo '<svg xmlns="http://www.w3.org/2000/svg" height="28" width="20" viewBox="0 0 512 512">
                            <path fill="#00a8e8" d="M323.8 34.8c-38.2-10.9-78.1 11.2-89 49.4l-5.7 20c-3.7 13-10.4 25-19.5 35l-51.3 56.4c-8.9 9.8-8.2 25 1.6 33.9s25 8.2 33.9-1.6l51.3-56.4c14.1-15.5 24.4-34 30.1-54.1l5.7-20c3.6-12.7 16.9-20.1 29.7-16.5s20.1 16.9 16.5 29.7l-5.7 20c-5.7 19.9-14.7 38.7-26.6 55.5c-5.2 7.3-5.8 16.9-1.7 24.9s12.3 13 21.3 13L448 224c8.8 0 16 7.2 16 16c0 6.8-4.3 12.7-10.4 15c-7.4 2.8-13 9-14.9 16.7s.1 15.8 5.3 21.7c2.5 2.8 4 6.5 4 10.6c0 7.8-5.6 14.3-13 15.7c-8.2 1.6-15.1 7.3-18 15.2s-1.6 16.7 3.6 23.3c2.1 2.7 3.4 6.1 3.4 9.9c0 6.7-4.2 12.6-10.2 14.9c-11.5 4.5-17.7 16.9-14.4 28.8c.4 1.3 .6 2.8 .6 4.3c0 8.8-7.2 16-16 16H286.5c-12.6 0-25-3.7-35.5-10.7l-61.7-41.1c-11-7.4-25.9-4.4-33.3 6.7s-4.4 25.9 6.7 33.3l61.7 41.1c18.4 12.3 40 18.8 62.1 18.8H384c34.7 0 62.9-27.6 64-62c14.6-11.7 24-29.7 24-50c0-4.5-.5-8.8-1.3-13c15.4-11.7 25.3-30.2 25.3-51c0-6.5-1-12.8-2.8-18.7C504.8 273.7 512 257.7 512 240c0-35.3-28.6-64-64-64l-92.3 0c4.7-10.4 8.7-21.2 11.8-32.2l5.7-20c10.9-38.2-11.2-78.1-49.4-89zM32 192c-17.7 0-32 14.3-32 32V448c0 17.7 14.3 32 32 32H96c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32H32z" />
                        </svg>
                    </a>';
                $question_id = $row['id'];
                echo "<a href='./dislikeQuestion.php?question_id=" . $row['id'] . "' class='grid justify-items-center'>";

                $dislikeQuery = "SELECT COUNT(reaction) AS NumberOfDislikes FROM reactions WHERE reaction = 0 AND question_id = :question_id GROUP BY question_id";
                $stmt = $conn->prepare($dislikeQuery);
                $stmt->bindParam(':question_id', $row['id'], PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $numberOfDislikes = ($result) ? $result['NumberOfDislikes'] : 0;

                echo '<p>' . $numberOfDislikes . '</p>
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
                    <a href="#" class="grid">
                        <svg xmlns="http://www.w3.org/2000/svg" height="28" width="20" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                            <path fill="#8F51E1" d="M121 32C91.6 32 66 52 58.9 80.5L1.9 308.4C.6 313.5 0 318.7 0 323.9V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V323.9c0-5.2-.6-10.4-1.9-15.5l-57-227.9C446 52 420.4 32 391 32H121zm0 64H391l48 192H387.8c-12.1 0-23.2 6.8-28.6 17.7l-14.3 28.6c-5.4 10.8-16.5 17.7-28.6 17.7H195.8c-12.1 0-23.2-6.8-28.6-17.7l-14.3-28.6c-5.4-10.8-16.5-17.7-28.6-17.7H73L121 96z" />
                        </svg>
                    </a>
                </div>
                <div class="flex flex-col justify-between mx-3 h-full">
                    <div>
                        <div class="pt-4 text-xl font-extrabold	">
                            <h2>' . $row['title'] . '</h2>
                        </div>
                        <div class="text-xs font-light">
                            <h2>Project:' . $row['name'] . '</h2>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <h3 class="pt-4 text-lg font-light">' . $row['content'] . '</h2>
                    </div>
                    <div class="py-4 flex items-center gap-10 mt-2">
                        <a href="" class="flex items-center border border-gray-300 px-2 py-1 rounded-lg">
                            <svg class="pr-1" xmlns="http://www.w3.org/2000/svg" height="28" width="28" viewBox="0 0 448 512">
                                <path fill="#ffffff" d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
                            </svg>
                            Add an answer
                        </a>';


                $query = "SELECT tags.name
                                    FROM tags
                                    INNER JOIN tag_question ON tags.id = tag_question.tag_id
                                    WHERE tag_question.question_id = :question_id";

                $stmt = $conn->prepare($query);
                $stmt->bindParam(':question_id', $row['id'], PDO::PARAM_INT);
                $stmt->execute();
                $tags = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($tags as $tag) {

                    echo '<p class="border border-gray-300 px-2 rounded-full">' . $tag['name'] . '</p>';
                }


                echo '   </div>
                </div>
            </div>
            </div>';
            }
        } else {
            echo "NO DATA FOUND";
        }
    } else {
        echo 'Error executing the main query: ' . implode(" ", $stmt->errorInfo());
    }
}
?>

</html>