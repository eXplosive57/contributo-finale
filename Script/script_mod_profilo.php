<?php

include('config.php');
$con = new mysqli($host,$userName,$password,$dbName);



  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['form_name']) && $_POST['form_name'] === 'form1') {
    

    $nome_da_modificare = $con->real_escape_string($_POST['nome_sessione']);
    $cognome_da_modificare = $con->real_escape_string($_POST['cognome_sessione']);

    //campi nuovi da aggiornare
    $nome_da_aggiornare = $con->real_escape_string($_POST['nome']);
    $cognome_da_aggiornare = $con->real_escape_string($_POST['cognome']);
    $mail_da_aggiornare = $con->real_escape_string($_POST['mail']);
    $cellulare_da_aggiornare = $con->real_escape_string($_POST['cellulare']);
    $indirizzo_da_aggiornare = $con->real_escape_string($_POST['indirizzo']);
    
    $sql = "UPDATE utenti
            SET nome = '$nome_da_aggiornare', cognome = '$cognome_da_aggiornare', mail = '$mail_da_aggiornare',
                telefono = '$cellulare_da_aggiornare', indirizzo = '$indirizzo_da_aggiornare'
            WHERE nome='$nome_da_modificare' AND cognome='$cognome_da_modificare'";

if ($con->query($sql) === TRUE) {
    $_SESSION['Aggiornato'] = 'Campi aggiornati!';
    header('location: ../utenti.php');
} else {
    echo "Errore nell'aggiornamento del database: " . $con->error;
}
    }elseif (isset($_POST['form_name']) && $_POST['form_name'] === 'form2'){
        
        $nome_da_modificare = $con->real_escape_string($_POST['nome_sessione']);
        $cognome_da_modificare = $con->real_escape_string($_POST['cognome_sessione']);
        $pass_da_aggiornare = $con->real_escape_string($_POST['pass']);
        //la passwrod va nuovamente hashata
        $hash = password_hash($pass_da_aggiornare, PASSWORD_DEFAULT); 

        $sql = "UPDATE utenti
        SET password = '$hash'
        WHERE nome='$nome_da_modificare' AND cognome='$cognome_da_modificare'";

        if ($con->query($sql) === TRUE) {
            $_SESSION['Aggiornato'] = 'Pass aggiornati!';
            echo $pass_da_aggiornare;
        } else {
            echo "Errore nell'aggiornamento del database: " . $con->error;
        }

    }
}


?>