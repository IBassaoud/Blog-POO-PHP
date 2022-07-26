<?php 
require_once('pdo.php');

$read_query_mainpage = "SELECT * FROM `USERS` ORDER BY `created_at` DESC LIMIT 5;";

try {
    $sth = $dbh->query($read_query_mainpage)->fetchAll(PDO::FETCH_ASSOC);
}
catch (PDOException $e) {
    echo "Read failed: " . $e->getMessage();
}
// echo "Hello world!";
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
              <a class="md:p-4 py-2 block hover:text-blue-400" href="#"
                >Bookmarks</a
              >
            </li>
            <li>
              <!-- <a class="md:p-4 py-2 block hover:text-blue-400" href="#"
                >Blog</a
              >
            </li> -->
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
    <h1 class="text-3xl font-bold underline">Hello world!</h1>
    <?php
    echo "<pre>";
    var_dump($sth);
    ?>
<script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>

</body>
</html>
