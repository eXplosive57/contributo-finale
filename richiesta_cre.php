<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

    <title>LOGIN</title>
    <link rel="stylesheet" href="index.css" />
    <style>
        body{

            background: url('foto/wallpaper4.jpg') no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>

<?php
include('config.php');
$con = new mysqli($host,$userName,$password,$dbName);
session_start();
if(!isset($_SESSION['loggato']) || $_SESSION['loggato'] !== true){
    header("location: accesso.php");
}
?>   

<div class="wrapper">
<form action="insert.php" method="post">
    <h1 class="titolo2">ACCEDI</h1>
    <div class="input-box">
    <label for="mail">Mail</label>
    <input type="text" name="mail" id="mail" required>
    </div>
    <div class="input-box">
    <label for="password">Password</label>
    <input type="password" name="password" id="username" required>
    </div>
    <button type="submit" value="invia">Invia</button>
    <p class='text'>Ancora non sei registrato? <a href="reg.php">Registrati</p>

</form>
    
</div>




</body>
<html>