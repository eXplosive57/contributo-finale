<?php

require_once('config.php');

// Crea la connessione col server
$con = new mysqli($host, $userName, $password);


if ($con->connect_error) {
    die("Connessione fallita ASFAAS: " . $con->connect_error);
}

// Crea il database se non esiste già
$sql = "CREATE DATABASE IF NOT EXISTS $dbName";

if ($con->query($sql) === FALSE) {
    echo "Errore nella creazione del database " . $con->error;
}

// Seleziona il database con cui vogliamo operare
$con = new mysqli($host, $userName, $password, $dbName);

//Creo la tabella utente se non esiste

$utente = "CREATE TABLE IF NOT EXISTS `Utenti` (
    `id` int(11) NOT NULL AUTO_INCREMENT,               
    `nome` varchar(30) NOT NULL,
    `cognome` varchar(30) NOT NULL,
    `mail` varchar(30) NOT NULL,
    `cf` varchar(30) NOT NULL,
    `telefono` varchar(30) NOT NULL,
    `indirizzo` varchar(30) NOT NULL,
    `crediti` int(255) NULL,
    `password` varchar(255) NOT NULL,
    `Tipo` int(11) NOT NULL,
    PRIMARY KEY (id)
)";

if ($con->query($utente) === FALSE) {
    echo "Errore nella creazione della tabella utente " . $con->error;
}




$insert_utente = "INSERT INTO `Utenti` (`username`, `password`, `Tipo`) VALUES
('Admin', '" . password_hash('Admin', PASSWORD_DEFAULT) . "', 0)";

if ($con->query($insert_utente) === FALSE) {
    echo "Errore nell'inserimento degli utenti " . $con->error;
}


header('Location: index.php');
$con->close();

?>