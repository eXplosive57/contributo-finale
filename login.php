<?php

require_once('config.php');
$con = new mysqli($host,$userName,$password,$dbName);

$mail = $con->real_escape_string($_POST['mail']);
$password = $con->real_escape_string($_POST['password']);
session_start();


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $sql_select = "SELECT * FROM Utenti WHERE mail = '$mail'";
    if ($result = $con->query($sql_select)) {
        if ($result->num_rows == 1) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if (password_verify($password, $row['password'])) {
                

                $_SESSION['loggato'] = true;
                $_SESSION['log'] = 'Benvenuto al portale!';


                $sql = "SELECT id FROM utenti WHERE mail = '$mail'";
                $result = $con->query($sql);
                $row = mysqli_fetch_array($result);
                $_SESSION['id'] = $row['id'];

                $sql2 = "SELECT Tipo FROM utenti WHERE mail = '$mail' ";
                $result2 = $con->query($sql2);
                $row2 = mysqli_fetch_array($result2);
                $_SESSION['tipo'] = $row2['Tipo'];

                $sql3 = "SELECT nome FROM utenti WHERE mail = '$mail'";
                $result3 = $con->query($sql3);
                $row3 = mysqli_fetch_array($result3);
                $_SESSION['nome'] = $row3['nome'];

                $sql4 = "SELECT cognome FROM utenti WHERE mail = '$mail'";
                $result4 = $con->query($sql4);
                $row4 = mysqli_fetch_array($result4);
                $_SESSION['cognome'] = $row4['cognome'];

                

 
                
                header("location: index.php");
                
                
            } else {
                $_SESSION['pass'] = 'Password errata!';
                header("location: accesso.php");
                

            }
        } else {
            $_SESSION['ko'] = "Attenzione! Username non presente.";
            header("location: accesso.php");
        }
    } else {
        echo "Errore login.";

    }


    $con->close();
}

?>