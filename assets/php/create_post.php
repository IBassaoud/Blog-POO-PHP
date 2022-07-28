<?php
require_once("../../pdo.php");
require_once("../class/User.php");
session_start();

// Check if the user is logged in, if not then redirect him to login page 
if(!isset($_SESSION['user'])){
    header("location: login.php"); 
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    // echo "<pre>";
    // var_dump($_POST);
    // print_r($_FILES);
    $img_name = $_FILES['image_post']['name'];
    $img_size = $_FILES['image_post']['size'];
    $tmp_name = $_FILES['image_post']['tmp_name'];
    $imgerror = $_FILES['image_post']['error'];

    define('MB', 1048576);
    if ($imgerror === 0){
      if ($img_size > 10*MB){
          $msg = urlencode("Sorry bruh, your file is too large.");
          $_GET['msgError'] = $msg;
      } else {
          $img_extension = pathinfo($img_name, PATHINFO_EXTENSION);
          $img_extension_lc = strtolower($img_extension);

          $allowed_extensions = ['jpg','jpeg','png','webp','gif'];

          if (in_array($img_extension_lc,$allowed_extensions)){
              $new_img_name = uniqid("IMG-", true).'.'.$img_extension_lc;
              $img_upload_path = '../img/uploads/'.$new_img_name;
              move_uploaded_file($tmp_name, $img_upload_path);

          } else {
              $msg = urlencode("Sorry bruh, your cant upload files of this type.");
              $_GET['msgError'] = $msg;
          }
        }
    } else {
        $msg = urlencode("Unknown error occured, enven I don't know WTF YOU DID!.<br>");
        $_GET['msgError'] = $msg;
    }

    if(!empty($_POST["title_post"]) && !empty($_POST["body_post"])){
        $id_user = $_SESSION['user']->getId();
        $title = $_POST['title_post'];
        $description = $_POST['description_post'];
        $content = $_POST['body_post'];        
        $text = $description;
        $result = str_replace("'","&#39",$text);
        $description = $result;

        if (!isset($_GET['msgError'])){
            $insert_new_post = "INSERT INTO POSTS (`fk_id_user`,`title_post`,`image_post`,`description_post`,`body_post`) VALUES ('".$id_user."','".$title."','".$img_upload_path."','".$description."','".$content."')"; 
        try {
          $stmt_newPost = $dbh->query($insert_new_post);
          $msg = urlencode("Post submitted succesfully.");
          $_GET['msg'] = $msg;
        }
        catch (PDOException $e) {
            echo "Creation post failed: " . $e->getMessage();
        }
        }
      } else {
        $msg = urlencode("In order to submit a Post you must provide a title and a text body.");
        // header('Location: register.php?msg='.$msg);
        $_GET['msgError'] = $msg;
        }   

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
<div class="py-6 bg-gray-300">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <p class="mt-6 text-center text-1xl font-extrabold text-green-500">
                <?php
                if (isset($_GET['msg'])) {
                    echo urldecode($_GET['msg']);
                }
                if (isset($_GET['msgError'])) {
                    echo "<span class='mt-6 text-center text-red-500 text-1xl font-extrabold'>" . urldecode($_GET['msgError']). "</span>";
                }
                ?>
                <form method="POST" action="<?= $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label class="text-xl text-gray-600">Title <span class="text-red-500">*</span></label></br>
                        <input type="text" class="border-2 border-gray-300 p-2 w-full" name="title_post" id="title" required>
                    </div>
                    <div class="mb-4">
                        <label class="text-xl text-gray-600">Description</label></br>
                        <input type="text" class="border-2 border-gray-300 p-2 w-full" name="description_post" id="description" placeholder="(Optional)">
                    </div>

                    <div class="mb-4">
                        <label class="text-xl text-gray-600">Image</label></br>
                        <input type="file" class="border-2 border-gray-300 py-2 w-full pl-6" name="image_post" id="image_post" placeholder="(Optional)">
                    </div>

                    <div class="mb-8">
                        <label class="text-xl text-gray-600">Content <span class="text-red-500">*</span></label></br>
                        <textarea name="body_post" class="border-2 border-gray-500">
                            
                        </textarea>
                    </div>
                    <button type="submit" class="p-3 bg-blue-500 text-white hover:bg-blue-400">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'body_post' );
</script>
<script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
</body>
</html>