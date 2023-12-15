<?php
ob_start();
include '../SQL/connect.php';

$errormessage = "";
// pour afficher les tags li kynin f bd bbbbbb:
$tags = "SELECT DISTINCT * FROM tags ";
$stmt = $conn->prepare($tags);
$stmt->execute();
$tags_name = $stmt->fetchAll();
// fonction pour tester tag wech kyna fi bd ou non
function  valid_tags($tag_value)
{
    global $conn;
    $tags = "SELECT * FROM tags where name='$tag_value'";
    $stmt = $conn->prepare($tags);
    $stmt->execute();
    return $stmt;
}

if (isset($_POST['addquestion'])) {
    $user_id = $_GET["user_id"];
    $project_id = $_GET["project_id"];

    $title = $_POST["title"];
    $content = $_POST["content"];
    $tags = $_POST["tags"];
    $tag_checkbox = $_POST["tag_checkbox"];

    $sql_question = "INSERT INTO questions (title, content, user_id, project_id) VALUES (:title, :content, :user_id, :project_id)";
    $sth_question = $conn->prepare($sql_question);
    $sth_question->bindParam(':title', $title);
    $sth_question->bindParam('content', $content);
    $sth_question->bindParam(':user_id', $user_id);
    $sth_question->bindParam(':project_id', $project_id);

    $sth_question->execute();

    if ($sth_question) {
        $question_id = $conn->lastInsertId();

        if (!empty($tags) && !isset($_POST['tag_checkbox'])) {

            $tagsArray = explode(",", $tags);
            array_walk($tagsArray, 'trim_value');

            foreach ($tagsArray as $tag) {
                $tag_v = valid_tags($tag);
                if ($tag_v->rowCount() > 0) {

                    $sql_tag = "INSERT INTO tags (name, user_id) VALUES (:name, :user_id)";
                    $sth_tag = $conn->prepare($sql_tag);
                    $sth_tag->execute(['name' => $tag, 'user_id' => $user_id]);
                    $tag_id = $conn->lastInsertId();

                    $sql_pivot = "INSERT INTO tag_question (question_id, tag_id) VALUES (:question_id, :tag_id)";
                    $sth_pivot = $conn->prepare($sql_pivot);
                    $sth_pivot->execute(['question_id' => $question_id, 'tag_id' => $tag_id]);
                }
            }
        } else if (empty($tags) && isset($_POST['tag_checkbox']) && is_array($_POST['tag_checkbox'])) {
            $tag_checkboxs = $_POST['tag_checkbox'];
            foreach ($tag_checkboxs as $key => $tag_name) {
                $sql_pivot = "INSERT INTO tag_question (question_id,tag_id) VALUES (:question_id,:tag_id)";
                $sth_pivot = $conn->prepare($sql_pivot);
                $sth_pivot->execute(['question_id' => $question_id, 'tag_id' => $tag_name[$key]]);
            }
        } else if (!empty($tags) && isset($_POST['tag_checkbox']) && is_array($_POST['tag_checkbox'])) {
            $tagsArray = explode(",", $tags);
            $tag_checkboxs = $_POST['tag_checkbox'];
            $array_final = array_merge($tagsArray, $tag_checkboxs);
            foreach ($array_final as $value) {
                $tag_v = valid_tags($value);
                $id;
                if ($tag_v->rowCount() === 0 && intval($value) === 0) {
                    $sql_tag = "INSERT INTO tags (name, user_id) VALUES (:name, :user_id)";
                    $sth_tag = $conn->prepare($sql_tag);
                    $sth_tag->execute(['name' => $value, 'user_id' => $user_id]);
                    $id = $conn->lastInsertId();
                } else {
                    $id = $value;
                }
                $sql_pivot = "INSERT INTO tag_question (question_id, tag_id) VALUES (:question_id, :tag_id)";
                $sth_pivot = $conn->prepare($sql_pivot);
                $sth_pivot->execute(['question_id' => $question_id, 'tag_id' => $id]);
            }
        }
    }
    // echo "$user_id";
  
        $errormessage = "Question Added Successfully!";
        header('Location: ./dashboard.php');
        exit();
    } else {
        $errormessage = "Error.";
    }

function trim_value(&$tag)
{
    $tag = trim($tag);
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Add question</title>
    <link rel="shortcut icon" href="../public/brand.png" type="image/x-icon">
    <meta name="title" content="Team and project management for DataWare">
    <meta name="keywords" content="team, project, Members, team management, project management">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inika&family=Inter:wght@100&family=Ruda&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inika&family=Inter:wght@100&family=Ruda&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- style -->
    <link rel="stylesheet" href="../public/style1.css?v=<?php echo time(); ?>" type="text/css">

    <!-- js -->
    <script src="https://cdn.tailwindcss.com"></script>
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
                        'black-color': '#1E1E1E',
                    },

                },
            },
        }
    </script>
    <style>

    </style>

</head>

<body class="login-body">
    <a href="./dashboard.php" class="bi bi-arrow-left back"></a>
    <div class="border  m-auto mt-20  w-1/2 rounded-lg border-blutext border-4 bg-white-color">
        <div class="create-form">
            <h2>Data<img src="../public/brand.png" alt=brand />are</h2>
            <form action="" method="POST" class="my-10 mx-10">
                <div class="my-6">

                    <div class="w-full ">
                        <label for="title" class="text-lg font-bold text-dark">Title:</label>
                    </div>

                    <input type="text" id="title" name="title" placeholder="Question title" class="border border-2 border-blutext w-full py-2 rounded-lg pl-2 mt-2">
                </div>
                <div>
                    <label for="Content" class="text-lg font-bold text-dark">Content:</label>
                </div>

                <input type="text" id="title" name="content" placeholder="Question content" required class="border border-2 border-blutext w-full py-2 rounded-lg pl-2 mt-2">


                <div class="my-2">
                    <label for="tags" class="text-lg font-bold text-dark">Tags:</label>
                </div>
                <div class="flex gap-8 my-4">
                    <?php if (count($tags_name) > 0) {
                        foreach ($tags_name as $tag_name) { ?>
                            <div>
                                <input type="checkbox" name="" value="$tag_name['id']">
                                <label for="" class="text-lg text-dark"><?php echo $tag_name['name'] ?></label>
                            </div>



                        <?php } ?>
                    <?php } ?>
                </div>
                <div>
                    <button class="addMoreTags text-blutext border-b border-1 border-blutext">Add more tags</button>
                </div>

                <div>
                    <input type="text" id="tags" name="tags" placeholder="Tag1, Tag2, Tag3" required class="hidden border border-2 border-blutext w-full px-4 rounded-lg py-2 mt-2">
                </div>

                <div class="w-full my-4 px-8">
                    <input type="submit" value="Submit Question" name="addquestion" class="text-white-color bg-blutext  px-2 py-2 rounded-lg w-full text-lg">
                </div>
            </form>
        </div>
    </div>
        <script>
            document.querySelector(".addMoreTags").addEventListener("click", () => {
                document.querySelector("#tags").classList.toggle("hidden")
            })
        </script>
</body>

</html>