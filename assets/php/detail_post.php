<?php
require_once('../../pdo.php');
require_once('../class/User.php');
require_once('../class/Post.php');
session_start();
// print_r($_POST);
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
// TODO - look for a template in order to display the full detail of the post 
// TODO - Might want to POST id_user & id_post
// TODO - Take care of the comment section dude
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
              <a class="md:p-4 py-2 block hover:text-blue-400" href="posts.php"
                >Posts</a
              >
            </li>

              <!-- <a class="md:p-4 py-2 block hover:text-blue-400" href="#"
                >Blog</a
              >
            </li> -->
            <?php
            if (isset($_SESSION['user'])){
            ?>
            <li>
              <a class="md:p-4 py-2 block hover:text-blue-400" href="create_post.php"
                >Create Post</a
              >
            </li>
            <li>
              <a class="md:p-4 py-2 block hover:text-blue-400" href="bookmarks.php"
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
    <!-- <h1 class="text-3xl font-bold underline">All POSTS HERE!</h1> -->
    <div class="pt-6 pb-12 bg-gray-300">  
    <h2 class="text-center font-serif  uppercase text-4xl xl:text-5xl">Articles</h2>
    
    <!-- container for all cards -->
    <div class="container w-100 lg:w-4/5 mx-auto flex flex-col">
        <?php
        // for ($i=0;$i<$length;$i++){
        //     $myuser = $GLOBALS['allposts'][$i]->getfk_id_user();
        //     $query_user = "SELECT * FROM `USERS` WHERE `id_user` = '$myuser'";
        //     try {
        //         $stmt_user = $dbh->query($query_user)->fetchAll(PDO::FETCH_ASSOC);
        //     }
        //     catch (PDOException $e) {
        //         echo "Read failed: " . $e->getMessage();
        //     }
        //     // print_r($stmt_user);
        //     echo '      <!-- card -->
        //     <div v-for="card in cards" class="flex flex-col md:flex-row overflow-hidden bg-white rounded-lg shadow-xl  mt-4 w-100 mx-2">
        //     <!-- media -->
        //     <div class="h-64 w-auto md:w-1/2">
        //     <img class="inset-0 h-full w-full object-cover object-center" src="'.$GLOBALS['allposts'][$i]->getimage_post().'" />
        //     </div>
        //     <!-- content -->
        //     <div class="w-full py-4 px-6 text-gray-800 flex flex-col justify-between">
        //     <form method="post" action="detail_post.php" id="form-title-click">
        //     <button id="title-click" name="id_post" value="'.$GLOBALS['allposts'][$i]->getid_post().'" class="font-semibold text-lg leading-tight truncate">'.$GLOBALS['allposts'][$i]->gettitle_post().'</button>
        //     </form>
        //     <p class="mt-2">
        //     '.$GLOBALS['allposts'][$i]->getdescription_post().'
        //     </p>
        //     <p class="text-sm text-gray-700 uppercase tracking-wide font-semibold mt-2">
        //     Postée le '.$GLOBALS['allposts'][$i]->getcreated_at().' par '.$stmt_user[0]['prenom_user'].' '.$stmt_user[0]['nom_user'].'         
        //     </p>
        //     </div>
        //     </div>';
        // }
        ?>
    </div>
    </div><!--/ flex-->
 



<script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
</body>
</html>
