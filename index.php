<?php 
require_once('pdo.php');
require_once('assets/class/User.php');
require_once('assets/class/Post.php');
session_start();

$read_query_mainpage = "SELECT * FROM `POSTS` ORDER BY `created_at` DESC LIMIT 5;";
try {
    $sth = $dbh->query($read_query_mainpage)->fetchAll(PDO::FETCH_ASSOC);
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
  //replace the '..' by 'assets' on my image path
  $img = $GLOBALS['allposts'][$i]->getimage_post();
  $result = str_replace('..','assets',$img);
  $GLOBALS['allposts'][$i]->setimage_post($result);
  //change date format
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
    <script src="assets/js/main.js" defer></script>
    <title>The Blog</title>
</head>
<body>
<header> 
  <!-- TODO FIX THE NAVBAR RESPONSIVE BUTTON MAAH FRIEND -->
     <nav
        class="
          flex flex-wrap
          items-center
          justify-between
          w-full
          py-4
          md:py-0
          px-4
          text-lg text-gray-700
          bg-white
        "
      >
       <a href="http://localhost:8006/" class="flex items-center">
        <img src="/assets/img/logo_blog.png" class="mr-3 h-6 sm:h-9"/>
        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-black">The Blog</span>
      </a>
         <svg
            xmlns="http://www.w3.org/2000/svg"
            id="menu-button"
            class="h-6 w-6 cursor-pointer md:hidden block"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16"
            />
          </svg>
       
       <div class="hidden w-full md:flex md:items-center md:w-auto" id="menu">
          <ul
            class="
              pt-4
              text-base text-gray-700
              md:flex
              md:justify-between 
              md:pt-0"
          >
            <li>
              <a class="md:p-4 py-2 block hover:text-blue-400" href="http://localhost:8006"
                >Home</a
              >
            </li>
            <li>
              <a class="md:p-4 py-2 block hover:text-blue-400" href="assets/php/posts.php"
                >Posts</a
              >
            </li>
            <?php
            if (isset($_SESSION['user'])){
            ?>
            <li>
              <a class="md:p-4 py-2 block hover:text-blue-400" href="assets/php/create_post.php"
                >Create Post</a
              >
            </li>
            <li>
              <a class="md:p-4 py-2 block hover:text-blue-400" href="#"
                >Bookmarks</a
              >
            </li>
            <li>
              <a
                class="md:p-4 py-2 block hover:text-blue-400 text-blue-500"
                href="http://localhost:8006/assets/php/logout.php"
                >Disconnect</a
              >
            </li>
            <?php
            } else {
            ?>
            <li>
              <a
                class="md:p-4 py-2 block hover:text-blue-400 text-blue-500"
                href="http://localhost:8006/assets/php/login.php"
                >Sign in</a
              >
            </li>
            <li>
              <a
                class="md:p-4 py-2 block hover:text-blue-400 text-blue-500"
                href="http://localhost:8006/assets/php/register.php"
                >Register</a
              >
            </li>
            <?php
            }
            ?>
          </ul>
        </div>
    </nav>
  </header>    
    <?php
    // echo "<pre>";
    // var_dump($sth);
    // echo "</pre>";
    ?>
<!-- TODO changer le chemin de l'immage remplacer .. par assets -->
<div class="pt-6 pb-12 bg-gray-300">  
    <h2 class="text-center font-serif  uppercase text-4xl xl:text-5xl">Recent Articles</h2>
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
        $GLOBALS['allposts'][$i]->showDescriptionPost($stmt_user[0]['prenom_user'],$stmt_user[0]['nom_user']);
      }
    ?>
    </div>
    </div>
<script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>

</body>
</html>
