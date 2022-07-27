<?php 
require_once('../../pdo.php');
require_once('../class/User.php');
session_start();
// Check if the user is logged in, if not then redirect him to login page 
if(!isset($_SESSION['user'])){
    header("location: login.php"); 
    exit;
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
    <h1 class="text-3xl font-bold underline">All BOOKMARKS GO HERE!</h1>

<script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
</body>
</html>