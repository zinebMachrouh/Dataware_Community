<?php 
include('connection.php');
if(isset($_POST['input'])){
    $input=$_POST['input'];
    echo"$input";
    $query = "SELECT q.id_question, q.tittre AS title, q.description AS question_description, q.datecreation, u.image AS user_image, u.firstName AS user_firstName, u.lastName AS user_lastName
    FROM question q
    JOIN users u ON q.ID_User = u.id_user
    WHERE q.tittre LIKE '{$input}%'"; // slelctionne tout les titres dont il commence par cette valeur et pour % represnte un ou plusieurs caractÃ¨res  
    $result= mysqli_query($conn,$query);
    if(mysqli_num_rows($result) > 0){
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $questionId = $row['id_question'];

                echo '
                
                
                
                <div class="bg-white p-6 rounded-md shadow-md mb-4">';
                echo '<h2 class="text-xl font-semibold mb-2">' . $row['title'] . '</h2>';
                echo '<p class="text-gray-600">' . $row['question_description'] . '</p>';

                echo '<div class="flex items-center mt-4">';
                echo '<div class="flex items-center">';
                echo '<img src="' . $row['user_image'] . '" alt="User Avatar" class="rounded-full w-8 h-8 mr-2">';
                echo '<span class="text-gray-700">' . $row['user_firstName'] . ' ' . $row['user_lastName'] . '</span>';
                echo '</div>';

                echo '<div class="text-gray-500 ml-4">';
                echo '<span>Created on: ' . date('M j, Y', strtotime($row['datecreation'])) . '</span>';
                echo '</div>';
                echo '</div>';

                echo '<div class="flex flex-row gap-5 justify-end items-center">';
                echo '<a href="article.php?id=' . $questionId . '" class="questionDiv p-2 px-4 bg-blue-500 rounded text-white questionDiv">Answers</a>';
                echo '</div>';

                echo '<div class="flex items-center mb-4">';
                $tagsQuery = "SELECT tag_name FROM tagquetion tq JOIN tag t ON tq.ID_Tag = t.id_tag WHERE tq.ID_Question = $questionId";
                $tagsResult = mysqli_query($conn, $tagsQuery);

                if ($tagsResult) {
                    while ($tagRow = mysqli_fetch_assoc($tagsResult)) {
                        echo '<span class="text-sm font-semibold text-blue-500 bg-blue-100 rounded-full px-3 py-1 mr-2">' . $tagRow['tag_name'] . '</span>';
                    }

                    mysqli_free_result($tagsResult);
                } else {
                    echo 'Error executing the tags query: ' . mysqli_error($conn);
                }

                echo '</div>';
                echo '</div>
                </div>
                <div>
    
                </div>
            </main>';
            }
            mysqli_free_result($result);
        } else {
            echo 'Error executing the main query: ' . mysqli_error($conn);
        }
    }else{
        echo"<h6 class='text-center mt-3'>NO DATA FOUND</h6>";
    }

};

              
          
?>