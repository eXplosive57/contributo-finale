<?php
include('config.php');
$con = new mysqli($host,$userName,$password,$dbName);

session_start();
$qnt = floatval($_POST['qnt']);
$nome = $con->real_escape_string($_POST['nome']);

if(isset($_SESSION['id']) && isset($_POST['svuota']))

{
   
            $sql = "UPDATE utenti
                    SET crediti = crediti - '$qnt'
                    WHERE nome = '$nome'";
            $con->query($sql);
    unset($_SESSION['carrello']);

    $_SESSION['acq'] = "ACQUISTO EFFETTUATO!";
    header("location: carrello.php");

}

?>