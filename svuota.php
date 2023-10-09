<?php
include('config.php');
$con = new mysqli($host,$userName,$password,$dbName);

session_start();


if(isset($_SESSION['id']) && isset($_POST['svuota']))

{
    unset($_SESSION['carrello']);

    $_SESSION['acq'] = "ACQUISTO EFFETTUATO!";
    header("location: carrello.php");

}

?>