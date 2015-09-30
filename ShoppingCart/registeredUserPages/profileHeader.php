<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>Shopping cart</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>

<?php session_start(); ?>

<body>
<div class="navbar navbar-inverse navbar-fixed-top">
    <ul class="nav nav-tabs">

        <?php
        if(!isset($_SESSION['user'])):
        ?>

            <li role="presentation" class="active"><a href="">ABOUT US</a></li>

        <?php
        else:
        ?>

            <li role="presentation"><a href="main.php?user=<?= $_SESSION['user']; ?>"><?= $_SESSION['user']; ?></a></li>
            <li role="presentation"><a href="editProfile.php?user=<?= $_SESSION['user'] ?>">Edit profile</a></li>
            <li role="presentation"><a href="addCategory.php?user=<?= $_SESSION['user'] ?>">Add Category</a></li>

        <?php
        endif;
        ?>
        <li role="presentation"><a href="logout.php">Logout</a></li>
    </ul>
</div>
<div class="container-fluid">
    <h1>Welcome to Shopping cart - system</h1>


