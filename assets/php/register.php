<?php
require_once('../class/User.php');
require_once('../../pdo.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST"){
  if(!empty($_POST["pseudo"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty(["repeat_password"]) && !empty($_POST["first_name"]) && !empty($_POST["last_name"]) && !empty($_POST["role"])){
      if($_POST["password"] === $_POST["repeat_password"]){
          $pseudo = $_POST['pseudo'];
          $email = $_POST['email'];
          $query_ifExist = "SELECT * FROM USERS WHERE `pseudo_user` = '$pseudo'"; 
          try {
            $stmt_ifExist = $dbh->query($query_ifExist)->rowCount();
            if ($stmt_ifExist > 0){
              $_GET['msg'] = urlencode("User with such username already exists.");
            }
            // $ifExistMsg = urlencode("Pseudo already taken, choose another one!");
            // header('Location: register.php?msg='.$ifExistMsg);
          }
          catch (PDOException $e) {
              echo "Request failed: " . $e->getMessage();
          }
          $query_ifExist2 = "SELECT * FROM USERS WHERE `email_user` = '$email'";
          try {
            $stmt_ifExist2 = $dbh->query($query_ifExist2)->rowCount();
            if ($stmt_ifExist2 > 0){
              $_GET['msg'] = urlencode("User with such email already exists.");
            }
            // $ifExistMsg = urlencode("Pseudo already taken, choose another one!");
            // header('Location: register.php?msg='.$ifExistMsg);
          }
          catch (PDOException $e) {
              echo "Request failed: " . $e->getMessage();
          }

          if ($stmt_ifExist == 0 && $stmt_ifExist2 == 0) {
            $hashedpass = password_hash($_POST['password'],PASSWORD_BCRYPT); 
            $firstname = $_POST['first_name'];
            $lastname = $_POST['last_name'];
            $role = $_POST['role'];
            
            $newuser = new User($firstname, $lastname,$pseudo,$email, $role,$hashedpass);
            $newuser->saveUser();
          } 
        } else {
          $msg = urlencode("The passwords do not match.");
          // header('Location: register.php?msg='.$msg);
          $_GET['msg'] = $msg;
          }   
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
    <title>Registration</title>
</head>
<body>
<!-- ########## HEADER - NAVBAR ######### -->
<header>
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
              <a class="md:p-4 py-2 block hover:text-blue-400" href="#"
                >Posts</a
              >
            </li>
            <li>
              <a
                class="md:p-4 py-2 block hover:text-blue-400 text-blue-500"
                href="http://localhost:8006/assets/php/login.php"
                >Sign in</a
              >
            </li>
              <a
                class="md:p-4 py-2 block hover:text-blue-400 text-blue-500"
                href="http://localhost:8006/assets/php/register.php"
                >Register</a
              >
            </li>
          </ul>
        </div>
    </nav>
  </header>

<div class="container mx-auto px-4 md:max-w-xl">
<h1 class="mt-6 text-center text-3xl font-extrabold text-gray-900 font-serif">
					Create an account
</h1>
<form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
  <div class="relative z-0 mb-6 w-full group">
      <input type="text" name="pseudo" id="pseudo" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-900 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required="" value="Thea">
      <label for="pseudo" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Username</label>
  </div>
  <div class="relative z-0 mb-6 w-full group">
      <input type="email" name="email" id="email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-900 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required="">
      <label for="email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email address</label>
  </div>
  <div class="relative z-0 mb-6 w-full group">
      <input type="password" name="password" id="password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-900 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required="">
      <label for="password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
  </div>
  <div class="relative z-0 mb-6 w-full group">
      <input type="password" name="repeat_password" id="repeat_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-900 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required="">
      <label for="repeat_password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Confirm password</label>
  </div>
  <div class="grid md:grid-cols-2 md:gap-6">
    <div class="relative z-0 mb-6 w-full group">
        <input type="text" name="first_name" id="first_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-900 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required="">
        <label for="first_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">First name</label>
    </div>
    <div class="relative z-0 mb-6 w-full group">
        <input type="text" name="last_name" id="last_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-900 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required="">
        <label for="last_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Last name</label>
    </div>
    <input type="hidden" name="role" id="role" value="User">
  </div>
  <div class="text-center lg:text-center">
  <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
  <p class="text-sm font-semibold mt-2 pt-1 mb-0">
              Already have an account?
              <a
                href="login.php"
                class="text-green-600 hover:text-green-700 focus:text-green-700 transition duration-200 ease-in-out"
                >Login here
              </a>
            </p>
<p class="mt-6 text-center text-1xl font-extrabold text-green-500">
    <?php
    // print_r($_SESSION['user']);
    if (isset($_GET['msgCreate'])) {
        echo urldecode($_GET['msgCreate']);
    }
    if (isset($_GET['msg'])) {
        echo "<span class='mt-6 text-center text-red-500 text-1xl font-extrabold'>" . urldecode($_GET['msg']). "</span>";
    }
    ?>
</p>  
</div>
</form>

</div>
<script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
</body>
</html>