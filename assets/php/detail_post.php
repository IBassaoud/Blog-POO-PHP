<?php
require_once('../class/User.php');
require_once('../class/Post.php');
session_start();

use App\Autoloader;
use App\core\Db;

require_once('../../Autoloader.php');
Autoloader::register();
$db = Db::getInstance();

if (isset($_POST['id_post'])) {
  $postId = $_POST['id_post'];
  $queryPost = "SELECT * FROM `POSTS` WHERE `id_post` = '$postId';";
  try {
    $postStatement = $db->query($queryPost);
    $postData = $postStatement->fetch(PDO::FETCH_OBJ);
  } catch (PDOException $e) {
    echo "Read failed: " . $e->getMessage();
  }

  // Instantiating the class Post using the ID passed by the post method
  $post = new Post(
    $postData->id_post,
    $postData->fk_id_user,
    $postData->title_post,
    $postData->description_post,
    $postData->views_post,
    $postData->image_post,
    $postData->body_post,
    $postData->published_post,
    $postData->created_at
  );
  $date = date_create($post->getCreated_at());
  $post->setCreated_at(date_format($date, 'd-m-Y à H:i.'));

  $authorId = $post->getFk_id_user();
  $queryAuthor = "SELECT * FROM `USERS` WHERE `id_user` = '$authorId'";
  try {
    $authorStatement = $db->query($queryAuthor);
    $authorData = $authorStatement->fetch(PDO::FETCH_OBJ);
  } catch (PDOException $e) {
    echo "Read failed: " . $e->getMessage();
  }

  $author = new User(
    $authorData->prenom_user,
    $authorData->nom_user,
    $authorData->pseudo_user,
    $authorData->email_user,
    $authorData->role_user,
    $authorData->pw_user
  );
} else {
  header("location: http://localhost:8006/");
  exit;
}
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
  <?
  $post->showDetailsPost($author->getPrenom(), $author->getNom());
  ?>
  <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
</body>

</html>