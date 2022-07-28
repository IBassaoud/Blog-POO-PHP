<?php 
require_once('../../pdo.php');
require_once('../class/User.php');
require_once('../class/Post.php');
session_start();

$read_query_allposts = "SELECT * FROM `POSTS` ORDER BY `created_at` DESC;";
try {
    $sth = $dbh->query($read_query_allposts)->fetchAll(PDO::FETCH_ASSOC);
}
catch (PDOException $e) {
    echo "Read failed: " . $e->getMessage();
}
//BOUCLE qui instancie via la classe Post chaque posts retourner dans ma requête vers la BDD
for ($i=0;$i<sizeof($sth);$i++){
    $GLOBALS['allposts'][$i] = new Post($sth[$i]['id_post'],$sth[$i]['fk_id_user'],$sth[$i]['title_post'],$sth[$i]['description_post'],$sth[$i]['views_post'],$sth[$i]['image_post'],$sth[$i]['body_post'],$sth[$i]['published_post'],$sth[$i]['created_at']);
}
$length = sizeof($GLOBALS['allposts']);
for ($i=0;$i<$length;$i++){
    $date = date_create($GLOBALS['allposts'][$i]->getcreated_at());
    $GLOBALS['allposts'][$i]->setcreated_at(date_format($date, 'd-m-Y'));
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.1/dist/flowbite.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>The Blog</title>
</head>
<body>
<header> 
  <nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 rounded white:bg-gray-900">
    <div class="container flex flex-wrap justify-between items-center mx-auto">
      <a href="http://localhost:8006/" class="flex items-center">
          <img src="/assets/img/logo_blog.png" class="mr-3 h-6 sm:h-9"/>
          <span class="self-center text-xl font-semibold whitespace-nowrap white:text-black">The Blog</span>
      </a>
      <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 white:text-gray-400 white:hover:bg-gray-700 white:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
      </button>
      
      <div class="hidden w-full md:block md:w-auto" id="navbar-default">
        <ul class="flex flex-col p-4 mt-4 bg-gray-50 rounded-lg border border-gray-100 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white white:bg-gray-800 md:white:bg-gray-900 white:border-gray-700">
          <li>
            <a href="http://localhost:8006" class="block py-2 pr-4 pl-3 text-blue-700 rounded hover:bg-blue-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-blue-700 md:dark:hover:text-blue-400 dark:hover:bg-blue-700 dark:hover:text-white md:dark:hover:bg-transparent" aria-current="page">Home</a>
          </li>
          <?php
            if (isset($_SESSION['admin'])){
            ?>
            <li>
              <a href="#" class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-black dark:hover:bg-blue-700 dark:hover:text-white md:dark:hover:bg-transparent">Dashboard</a>
            </li>
            <?php
            }
            ?>
          <li>
            <a href="http://localhost:8006/assets/php/posts.php" class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-black dark:hover:bg-blue-700 dark:hover:text-white md:dark:hover:bg-transparent">Posts</a>
          </li>
          <?php
          if (isset($_SESSION['user']) || isset($_SESSION['admin'])){
          ?>
          <li>
            <a href="http://localhost:8006/assets/php/create_post.php" class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-black dark:hover:bg-blue-700 dark:hover:text-white md:dark:hover:bg-transparent">Create Post</a>
          </li>
          <li>
            <a href="http://localhost:8006/assets/php/bookmarks.php" class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-black dark:hover:bg-blue-700 dark:hover:text-white md:dark:hover:bg-transparent">Bookmarks</a>
          </li>
          <li>
            <a href="http://localhost:8006/assets/php/logout.php" class="block py-2 pr-4 pl-3 text-red-600 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-red-600 md:p-0 dark:text-red-600 md:dark:hover:text-red-700 dark:hover:bg-red-700 dark:hover:text-white md:dark:hover:bg-transparent" aria-current="page">Disconnect</a>
          </li>
            <?php
          } else {
            ?>
            <li>
            <a href="http://localhost:8006/assets/php/login.php" class="block py-2 pr-4 pl-3 text-blue-700 rounded hover:bg-blue-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-blue-700 md:dark:hover:text-blue-400 dark:hover:bg-blue-700 dark:hover:text-white md:dark:hover:bg-transparent" aria-current="page">Sign in</a>
          </li>
          <li>
            <a href="http://localhost:8006/assets/php/register.php" class="block py-2 pr-4 pl-3 text-blue-700 rounded hover:bg-blue-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-blue-700 md:dark:hover:text-blue-400 dark:hover:bg-blue-700 dark:hover:text-white md:dark:hover:bg-transparent" aria-current="page">Register</a>
          </li>
          <?php
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>
</header>  
    <!-- <h1 class="text-3xl font-bold underline">All POSTS HERE!</h1> -->
    <div class="pt-6 pb-12 bg-gray-300">  
    <h2 class="text-center font-serif  uppercase text-4xl xl:text-5xl">Articles</h2>
    
    <!-- container for all cards -->
    <div class="container w-100 lg:w-4/5 mx-auto flex flex-col">
        <?php

        for ($i=0;$i<$length;$i++){
            $myuser = $GLOBALS['allposts'][$i]->getfk_id_user();
            $query_user = "SELECT * FROM `USERS` WHERE `id_user` = '$myuser'";
            try {
                $stmt_user = $dbh->query($query_user)->fetchAll(PDO::FETCH_ASSOC);
            }
            catch (PDOException $e) {
                echo "Read failed: " . $e->getMessage();
            }
            // print_r($stmt_user);
            echo '      <!-- card -->
            <div v-for="card in cards" class="flex flex-col md:flex-row overflow-hidden bg-white rounded-lg shadow-xl  mt-4 w-100 mx-2">
            <!-- media -->
            <div class="h-64 w-auto md:w-1/2">
            <img class="inset-0 h-full w-full object-cover object-center" src="'.$GLOBALS['allposts'][$i]->getimage_post().'" />
            </div>
            <!-- content -->
            <div class="w-full py-4 px-6 text-gray-800 flex flex-col justify-between">
            <form method="post" action="detail_post.php" id="form-title-click">
            <button id="title-click" name="id_post" value="'.$GLOBALS['allposts'][$i]->getid_post().'" class="font-semibold text-lg leading-tight truncate">'.$GLOBALS['allposts'][$i]->gettitle_post().'</button>
            </form>
            <p class="mt-2">
            '.$GLOBALS['allposts'][$i]->getdescription_post().'
            </p>
            <p class="text-sm text-gray-700 uppercase tracking-wide font-semibold mt-2">
            Postée le '.$GLOBALS['allposts'][$i]->getcreated_at().' par '.$stmt_user[0]['prenom_user'].' '.$stmt_user[0]['nom_user'].'         
            </p>
            </div>
            </div>';
        }
        ?>
    </div>
    </div><!--/ flex-->
 



<script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
</body>
</html>