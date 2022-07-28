<?php
require_once('../../pdo.php');
require_once('../class/User.php');
require_once('../class/Post.php');
session_start();
// print_r($_POST);
if (isset($_POST['id_post'])){
  $idpost = $_POST['id_post'];
}
$query_post = "SELECT * FROM `POSTS` WHERE `id_post` = '$idpost';";
try {
    $sth = $dbh->query($query_post)->fetchAll(PDO::FETCH_ASSOC);
}
catch (PDOException $e) {
    echo "Read failed: " . $e->getMessage();
}

//Instanciation via la classe Post à l'aide de l'ID passé par la méthode post
$GLOBALS['post'][0] = new Post(
  $sth[0]['id_post'],
  $sth[0]['fk_id_user'],
  $sth[0]['title_post'],
  $sth[0]['description_post'],
  $sth[0]['views_post'],
  $sth[0]['image_post'],
  $sth[0]['body_post'],
  $sth[0]['published_post'],
  $sth[0]['created_at']);
$date = date_create($GLOBALS['post'][0]->getcreated_at());
$GLOBALS['post'][0]->setcreated_at(date_format($date, 'd-m-Y'));
// TODO - look for a template in order to display the full detail of the post 
// TODO - Might want to POST id_user & id_post
// TODO - Take care of the comment section dude
$myuser = $GLOBALS['post'][0]->getfk_id_user();
$query_user = "SELECT * FROM `USERS` WHERE `id_user` = '$myuser'";
try {
    $stmt_user = $dbh->query($query_user)->fetchAll(PDO::FETCH_ASSOC);
}
catch (PDOException $e) {
    echo "Read failed: " . $e->getMessage();
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
    <div class="pt-6 pb-6 bg-gray-300">  
    <h2 class="text-center font-serif  uppercase text-4xl xl:text-5xl"><?= $GLOBALS['post'][0]->gettitle_post(); ?></h2>
    </div>
    <!-- container for all cards -->
    <div class="container w-100 lg:w-4/5 mx-auto flex">
      <div class="py-16 bg-white">  
        <div class="container m-auto px-6 text-gray-600 md:px-12 xl:px-6">
            <div class="space-y-6 md:space-y-0 md:flex md:gap-6 lg:items-center lg:gap-12">
              <div class="md:5/12 lg:w-5/12">
                <img src="<?= $GLOBALS['post'][0]->getimage_post(); ?>" alt="image" loading="lazy" width="" height="">
              </div>
              <div class="md:7/12 lg:w-6/12">
                <h2 class="text-1xl text-gray-900 font-bold md:text-1xl">
                  <?= 'Postée par : '.$stmt_user[0]['prenom_user'].' '.$stmt_user[0]['nom_user'];
                  echo "<br>". "Le ". $GLOBALS['post'][0]->getcreated_at();
                  ?>
                </h2>
                <p class="mt-6 text-gray-600">
                  <?= $GLOBALS['post'][0]->getdescription_post(); ?>
                </p>
                <p class="mt-4 text-gray-600">
                <?= "<u class='text-1xl font-bold'>Synopsis</u>  : <br>" .
                $GLOBALS['post'][0]->getbody_post(); 
                ?>
              </p>
              </div>
            </div>
        </div>
      </div>
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
 <!--/ flex-->
 



<script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
</body>
</html>
