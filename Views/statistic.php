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
    <link rel="stylesheet" href="../public/style1.css" type="text/css">
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
</head>