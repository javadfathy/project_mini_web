<?php
include_once("db.php");
$curPageName = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
$title = explode('.', $curPageName);

session_start();
@$_SESSION["user"];
?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?= $title[0]; ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><?php if (@$_SESSION['user'] == "") {
                echo "JavadFathi";
            } else {
                echo @$_SESSION['user'];
            } ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link <?php if ($curPageName == "index.php") {
                    echo "active";
                } ?>" href="index.php">Home</a>
                <?php
                if (@$_SESSION["user"] != "") {
                    ?>
                    <a class="nav-link <?php if ($curPageName == "addProduct.php") {
                        echo "active";
                    } ?>" href="addProduct.php">Add Product</a>
                <?php }
                if (@$_SESSION["user"] == "") {
                    ?>
                    <a class="nav-link <?php if ($curPageName == "sign.php") {
                        echo "active";
                    } ?>" href="sign.php">SignIn/Signup</a>
                    <?php
                } else {
                    ?>
                    <a class="nav-link <?php if ($curPageName == "sign.php") {
                        echo "active";
                    } ?>" href="sign.php">Profile</a>
                    <?php
                }
                if (@$_SESSION["user"] != "") {
                    ?>
                    <a class="nav-link <?php if ($curPageName == "logOut.php") {
                        echo "active";
                    } ?>" href="logOut.php">LogOut</a>
                <?php } ?>
            </div>
        </div>
    </div>
</nav>
<div class="container">
    <h1><?= $title[0]; ?></h1>
    <hr>
</div>

<?php


