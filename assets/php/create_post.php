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