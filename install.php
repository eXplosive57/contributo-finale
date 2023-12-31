<?php

require_once('Script/config.php');

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
    `cognome` varchar(30) ,
    `mail` varchar(30) ,
    `reputazione` int(11) NULL,
    `cf` varchar(30) ,
    `telefono` varchar(30) ,
    `indirizzo` varchar(30) ,
    `crediti` int(255) NULL,
    `password` varchar(255),
    `data_iscrizione` date NULL,
    `Tipo` int(11) NOT NULL,
    PRIMARY KEY (id)
)";

if ($con->query($utente) === FALSE) {
    echo "Errore nella creazione della tabella utente " . $con->error;
}




$insert_utente = "INSERT INTO `Utenti` (`id`,`nome`, `cognome`,`mail`,`reputazione`,`cf`,`telefono`,`indirizzo`, `crediti`,`password`,`data_iscrizione`, `Tipo`) VALUES
('1','Admin', NULL, NULL,NULL,NULL,NULL,NULL,NULL,'" . password_hash('Admin', PASSWORD_DEFAULT) . "', NULL, 0),
('2','Gestore', NULL, NULL,NULL,NULL,NULL,NULL,NULL,'" . password_hash('Gestore', PASSWORD_DEFAULT) . "', NULL, 2),
('3','Luca', 'Verdi', 'lucaverdi@gmail.com', 2,'LRVNNA94M08F333L','392582099','Via Napoli',40,'" . password_hash('Luca', PASSWORD_DEFAULT) . "', '2021-10-21', 1),
('4','Mario', 'Rossi', 'mariorossi@gmail.com', 2,'RSSMRA91T05L211X','390562991','Via Roma',32,'" . password_hash('Mario', PASSWORD_DEFAULT) . "', '2021-03-11', 1),
('5','Fabio', 'Mollura', 'fabiomollu@gmail.com', 4,'FNCMRA88P03A202Q','333592240','Via Milano',180,'" . password_hash('Fabio', PASSWORD_DEFAULT) . "', '2022-11-21', 1)";

if ($con->query($insert_utente) === FALSE) {
    echo "Errore nell'inserimento degli utenti " . $con->error;
}


header('Location: index.php');
$con->close();

?>