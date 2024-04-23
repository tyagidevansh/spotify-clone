<?php 
include("includes/config.php");
include("includes/classes/Artist.php");
include("includes/classes/Album.php");
include("includes/classes/Song.php");

//session_destroy(); LOGOUT MANUALLY

if (isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
    echo "<script>userLoggedIn = '$userLoggedIn' </script>";
} else {
    header("Location: register.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musify</title>
    <link rel="stylesheet" href="assets/css/styles.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src = 'assets/js/script.js'></script>
</head>

<body>

    <div id = "mainContainer">

        <div id = "topContainer">
            
            <?php include("includes/navbarContainer.php")?>

            <div id = "mainViewContainer">

                <div id = "mainContent">