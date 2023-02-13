<?php
session_start();

use App\Autoloader;
use App\models\UsersModel;
use App\models\PostsModel;
use App\models\CommentsModel;
use App\core\Db;

require_once('Autoloader.php');
Autoloader::register();

$db = Db::getInstance();

define('WEBROOT', str_replace('index.php', '', $_SERVER['PHP_SELF']));
// On définit une constante contenant le dossier racine du projet
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

$modelPost = new PostsModel;
$newPost = $modelPost
  ->setFk_id_user(6)
  ->setTitle_post("Alchemy of Souls")
  ->setDescription_post("Alchemy of Souls (Korean: 환혼; Hanja: 還魂; RR: Hwanhon) is an ongoing South Korean television series starring Lee Jae-wook, Jung So-min, and Hwang Min-hyun.[9] Written by the Hong sisters, it depicts the stories of young mages dealing with heaven and earth.")
  ->setViews_post(0)
  ->setImage_post("../img/uploads/alchemy_of_souls.jpg.png")
  ->setBody_post("The fate of these people become twisted due to 'hwanhonsool' (the soul of the dead return to the living).

            In the country of Daeho, Jang Uk (Lee Jae-Wook) comes from the noble Jang family. He holds an unpleasant secret about his birth, which people all around the country talk about. He is troublemaker. Jang Ukk happens to meet Mu-Deok (Jung So-Min). She is an elite warrior, but her soul is trapped in a physically weak body. She becomes Jang Wook’s servant, but she also secretly teaches him how to fight.
            
            Seo Yul (Minhyun) comes from the noble Seo family. He seems perfect with good appearance, intelligence, and strong martial arts skills. Go Won (Shin Seung-Ho) is the crown prince of Daeho. He hopes to become a generous king.")
  ->setPublished_post(0);
// echo "<pre>";
// var_dump($newPost);
// echo "</pre>";
// $modelPost->create($newPost);
$donnees = [
  "published_post" => 0,
  "views_post" => 1
];
$updatePost = $modelPost->hydrate($donnees);
$modelPost->update(12,$updatePost);
// $userData = $modelPost->findBy(["fk_id_user" => 6]); 
// $userData = $modelPost->delete(9);
// var_dump($userData);

$modelUser = new UsersModel;
// $newUser = $modelUser
//             ->setPrenom_user("Zinedine")
//             ->setNom_user("Zidane")
//             ->setPseudo_user("Zizou")
//             ->setEmail_user("zinedine@zidane.fr")
//             ->setRole_user("Moderator")
//             ->setPw_user("zizou123")
//             ->setIs_logged_user(0);
// echo "<pre>";
// var_dump($newUser);
// echo "</pre>";
// $modelUser->create($newUser);
$donneesUser = [
  "is_logged_user" => 0
];

// $myUser = $modelUser->findBy(
//   ["id_user" => 3,
//   "role_user" => "User"]
//   // ["DESC" => "`created_at`"],
//   // 5
// );

// $myUser = $modelUser->findOrderbyLimit(
//     ["ASC" => "`created_at`"],
//     2
// );
// echo "<pre>";
// var_dump($myUser);
// echo "</pre>";
// $updateUser = $modelUser->hydrate($donneesUser);
// $modelUser->update(8,$updateUser);
// exit;

// $modelUser->delete(9);
// $allUsers = $modelUser->findAll();
// echo "<pre>";
// var_dump($allUsers);
// echo "</pre>";
// exit;

$modelComment = new CommentsModel;
$newComment = $modelComment
  ->setId_comment(1)
  // ->setFk_id_user(1) // replace this with the user's id
  // ->setFk_id_post(2) // replace this with the post's id
  ->setBody_comment("This is a test comment UPDAAAAAAAATE 3.");
$idComment = $newComment->getId_comment();
// $modelComment->create($newComment);
// $modelComment->update($idComment, $newComment);

require_once('assets/class/User.php');
require_once('assets/class/Post.php');


$read_query_mainpage = "SELECT * FROM `POSTS` ORDER BY `created_at` DESC LIMIT 5";

try {
  $allposts = $db->query($read_query_mainpage)->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo "Read failed: " . $e->getMessage();
  die();
}

$posts = [];
foreach ($allposts as $post) {
  $posts[] = new Post(
    $post['id_post'],
    $post['fk_id_user'],
    $post['title_post'],
    $post['description_post'],
    $post['views_post'],
    str_replace('..', 'assets', $post['image_post']),
    $post['body_post'],
    $post['published_post'],
    date_format(date_create($post['created_at']), 'd-m-Y')
  );
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
          <img src="/assets/img/logo_blog.png" class="mr-3 h-6 sm:h-9" />
          <span class="self-center text-xl font-semibold whitespace-nowrap white:text-black">The Blog</span>
        </a>
        <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 white:text-gray-400 white:hover:bg-gray-700 white:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
          </svg>
        </button>

        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
          <ul class="flex flex-col p-4 mt-4 bg-gray-50 rounded-lg border border-gray-100 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white white:bg-gray-800 md:white:bg-gray-900 white:border-gray-700">
            <li>
              <a href="http://localhost:8006" class="block py-2 pr-4 pl-3 text-blue-700 rounded hover:bg-blue-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-blue-700 md:dark:hover:text-blue-400 dark:hover:bg-blue-700 dark:hover:text-white md:dark:hover:bg-transparent" aria-current="page">Home</a>
            </li>
            <!-- <li>
              <a href="http://localhost:8006/assets/php/dashboard.php" class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-black dark:hover:bg-blue-700 dark:hover:text-white md:dark:hover:bg-transparent">Profile</a>
            </li> -->
            <li>
              <a href="http://localhost:8006/assets/php/posts.php" class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-black dark:hover:bg-blue-700 dark:hover:text-white md:dark:hover:bg-transparent">Posts</a>
            </li>
            <?php
            if (isset($_SESSION['user']) || isset($_SESSION['admin']) || isset($_SESSION['moderator'])) {
            ?>
              <li>
                <a href="http://localhost:8006/assets/php/create_post.php" class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-black dark:hover:bg-blue-700 dark:hover:text-white md:dark:hover:bg-transparent">Create Post</a>
              </li>
              <!-- <li>
                <a href="http://localhost:8006/assets/php/bookmarks.php" class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-black dark:hover:bg-blue-700 dark:hover:text-white md:dark:hover:bg-transparent">Bookmarks</a>
              </li> -->
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
  <!-- TODO setting the correct timezone on the DB server -->
  <div class="pt-6 pb-12 bg-gray-300">
    <h2 class="text-center font-serif  uppercase text-4xl xl:text-5xl">Recent Articles</h2>
    <!-- container for all cards -->
    <div class="container w-100 lg:w-4/5 mx-auto flex flex-col">
      <?php
      if (!empty($posts)) {
        foreach ($posts as $post) {
          $userId = $post->getfk_id_user();
          $userQuery = "SELECT * FROM `USERS` WHERE `id_user` = '$userId'";

          try {
            $userResult = $db->query($userQuery)->fetchAll(PDO::FETCH_ASSOC);
            $user = reset($userResult);
          } catch (PDOException $e) {
            echo "User fetch failed: " . $e->getMessage();
          }

          $post->showDescriptionPost($user['prenom_user'], $user['nom_user']);
        }
      } else {
        echo "No posts";
      }
      ?>
    </div>
  </div>
  <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>

</body>

</html>