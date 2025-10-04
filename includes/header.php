<?php
// includes/header.php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Blog</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="site-header">
  <div class="wrap_header">
    <!-- <img src="includes/images/blogheader.jpg" >  -->
     <div class="wrap">
    <h1><a href="index.php">Blog : Share Your Voice</a></h1>
    <nav><a class="btn" href="create.php">Create Post</a></nav>
  </div>
  </div>
</header>
<main class="wrap">
