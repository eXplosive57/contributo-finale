<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

    <title>Richiesta Crediti</title>
    <link rel="stylesheet" href="index.css" />
    <style>
        body{

            background: url('foto/wallpaper2.jpg') no-repeat;
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
<form action="script_richiestacre.php" method="post">
    <h1 class="titolo2">RICHIEDI CREDITI</h1>
    <div class="input-box">
    <label for="mail">Numero crediti richiesti</label>
    <input type="number" name="cre" id="cre" required>
    </div>
    <button type="submit" value="invia">Invia</button>
    <p class='text'>Torna alla <a href="index.php">home</p>

</form>
    
</div>




</body>
<html>