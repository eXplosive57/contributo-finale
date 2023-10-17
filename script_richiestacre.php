<?php

include('config.php');
$con = new mysqli($host,$userName,$password,$dbName);


session_start();



$cre = $con->real_escape_string($_POST['cre']);

$xmlDoc = new DOMDocument();
$xmlDoc->load("storico_cre.xml");


$storicoCre = $xmlDoc->getElementsByTagName("storico_cre")->item(0);

//le seguenti righe mi servono per contare quanti id ho in modo la prossima richiesta di crediti
//abbia id sequenziale
$ultimarichiestaid = 0;
$richiestaelem = $xmlDoc->getElementsByTagName("richiesta");
//se c'é almeno una richiesta
if ($richiestaelem->length > 0) {
    $ultimarichiesta = $richiestaelem->item($richiestaelem->length-1);
    $ultimarichiestaid = $ultimarichiesta->getElementsByTagName("id")->item(0)->textContent;
}

$idaggiornato = $ultimarichiestaid + 1;

$richiesta = $xmlDoc->createElement("richiesta");

$id = $xmlDoc->createElement("id", $idaggiornato);
$idUtente = $xmlDoc->createElement("id_utente", $_SESSION['id']);
$qnt = $xmlDoc->createElement("qnt", $cre);

$richiesta->appendChild($id);
$richiesta->appendChild($idUtente);
$richiesta->appendChild($qnt);

$storicoCre->appendChild($richiesta);
$xmlDoc->formatOutput = true;
$xmlDoc->save("storico_cre.xml");

echo "Nuovo elemento <richiesta> aggiunto con successo.";