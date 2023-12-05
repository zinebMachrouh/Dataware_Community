<?php
session_start();
require("../SQL/connect.php");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>DataWare Website</title>
    <meta name="title" content="Team and project management for DataWare">
    <meta name="keywords" content="team, project, Members, team management, project management">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inika&family=Inter:wght@100&family=Ruda&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inika&family=Inter:wght@100&family=Ruda&display=swap"
        rel="stylesheet">


    <!-- js -->
    <script src="js/navbar.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                fontFamily: {
                    'Saira': ['Saira Condensed', 'sans-serif']

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
    <header class="">

    </header>
    <main>
        <div class="flex items-center justify-between mx-4 my-2">
            <h1 class="text-xl font-bold">Top Questions</h1>
            <a href="#" class="text-white bg-blue-primary border rounded-lg  px-4 py-2 ">Ask a Question</a>
        </div>
        <div class="mx-6">
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="default-search"
                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg dark:border-gray-600 dark:placeholder-gray-400   dark:focus:border-blue-500"
                    placeholder="Search Member..." required />
                <button type="submit"
                    class="text-white absolute end-2.5 bottom-2.5 bg-blue-700  focus:ring-4  focus:ring-blue-300  rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:focus:ring-blue-800 bg-blue-primary">
                    Search
                </button>
            </div>
        </div>
        <div class="grow border rounded-lg mx-6 mt-10 px-4 pt-2 h-screen">
            <div class="pb-4 flex items-center justify-between border-b-2 border-purp-color">
                <div class="flex-col">
                    <div class="flex items-center justify-between">
                        <h2 class="pt-4 text-sky-600 text-font-medium text-lg">What is the main objective of this project?</h2>
                    </div>
                    <div class="p-4 flex items-center gap-10 mt-2">
                        <a href="" class="flex items-center border border-gray-300 px-2 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" height="28" width="28" viewBox="0 0 448 512"><path fill="#8f51e1" d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg>
                            Add an answer
                        </a>
                        <p class="border border-gray-300 px-2 rounded-full">HTML</p>
                        <p class="border border-gray-300 px-2 rounded-full">CSS</p>
                        
                    </div>
                </div>
                <div class="flex justify-between gap-10">
                    <div class="grid justify-items-center">
                        <p>0</p>
                        <svg xmlns="http://www.w3.org/2000/svg" height="28" width="20" viewBox="0 0 320 512"><path fill="#36fa00" d="M182.6 137.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-9.2 9.2-11.9 22.9-6.9 34.9s16.6 19.8 29.6 19.8H288c12.9 0 24.6-7.8 29.6-19.8s2.2-25.7-6.9-34.9l-128-128z"/></svg>
                    </div>
                    <div class="grid justify-items-center">
                        <p>0</p>
                        <svg xmlns="http://www.w3.org/2000/svg" height="28" width="20" viewBox="0 0 320 512"><path fill="#e60000" d="M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z"/></svg>
                    </div>
                    <div class="grid justify-items-center">
                        <p>0</p>
                        <svg xmlns="http://www.w3.org/2000/svg" height="28" width="20" viewBox="0 0 512 512"><path fill="#5476e4" d="M123.6 391.3c12.9-9.4 29.6-11.8 44.6-6.4c26.5 9.6 56.2 15.1 87.8 15.1c124.7 0 208-80.5 208-160s-83.3-160-208-160S48 160.5 48 240c0 32 12.4 62.8 35.7 89.2c8.6 9.7 12.8 22.5 11.8 35.5c-1.4 18.1-5.7 34.7-11.3 49.4c17-7.9 31.1-16.7 39.4-22.7zM21.2 431.9c1.8-2.7 3.5-5.4 5.1-8.1c10-16.6 19.5-38.4 21.4-62.9C17.7 326.8 0 285.1 0 240C0 125.1 114.6 32 256 32s256 93.1 256 208s-114.6 208-256 208c-37.1 0-72.3-6.4-104.1-17.9c-11.9 8.7-31.3 20.6-54.3 30.6c-15.1 6.6-32.3 12.6-50.1 16.1c-.8 .2-1.6 .3-2.4 .5c-4.4 .8-8.7 1.5-13.2 1.9c-.2 0-.5 .1-.7 .1c-5.1 .5-10.2 .8-15.3 .8c-6.5 0-12.3-3.9-14.8-9.9c-2.5-6-1.1-12.8 3.4-17.4c4.1-4.2 7.8-8.7 11.3-13.5c1.7-2.3 3.3-4.6 4.8-6.9c.1-.2 .2-.3 .3-.5z"/></svg>
                    </div>
                </div>

            </div> 

        </div>
        </div>

    </main>
</body>

</html>