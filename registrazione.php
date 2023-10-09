<?php

require_once('config.php');
$con = new mysqli($host,$userName,$password,$dbName);

session_start();

$nome = $con->real_escape_string($_POST['nome']);
$cognome = $con->real_escape_string($_POST['cognome']);
$mail = $con->real_escape_string($_POST['mail']);
$cf = $con->real_escape_string($_POST['cf']);
$residenza = $con->real_escape_string($_POST['residenza']);
$telefono = $con->real_escape_string($_POST['telefono']);
$password = $con->real_escape_string($_POST['password']);
$tipo = $con->real_escape_string($_POST['tipo']);
//hash della password
$hash = password_hash($password, PASSWORD_DEFAULT);

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    //controllo se già esiste l'utente
    $sql = "SELECT * FROM Utenti WHERE cf = '$cf' or mail = '$mail'";
    $result = $con->query($sql);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['errore'] = "Utente già presente!";
        header("location: index.php");


    } else {
        //inserisco l'utente se non esiste
        $sql = "INSERT INTO utenti (nome, cognome, mail, cf, telefono, 
        indirizzo, password, Tipo) 
                VALUES ('$nome','$cognome', '$mail','$cf','$telefono',
                '$residenza','$hash', '$tipo')";

        if ($con->query($sql) === TRUE) {

            $_SESSION['reg'] = "REGISTRAZIONE EFFETTUATA!";
            header("location: accesso.php");
        } else {
            echo "REGISTRAZIONE FALLITA $sql. ";
        }
    }

}

?>