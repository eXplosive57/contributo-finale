<?php

include('config.php');
$con = new mysqli($host,$userName,$password,$dbName);


session_start();



$cre = $con->real_escape_string($_POST['cre']);

$xmlFile = "storico_cre.xml";
$xmlstring = "";

foreach(file($xmlFile) as $nodo){   //Leggo il contenuto del file XML

    $xmlstring.= trim($nodo); 
}

$xmlDoc = new DOMDocument();
$xmlDoc->loadXML($xmlstring);


$storicoCre = $xmlDoc->getElementsByTagName("storico_cre")->item(0);

//le seguenti righe mi servono per contare quanti id ho in modo che la prossima richiesta di crediti
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
$nome = $xmlDoc->createElement("nome", $_SESSION['nome']);
$cognome = $xmlDoc->createElement("cognome", $_SESSION['cognome']);
$qnt = $xmlDoc->createElement("qnt", $cre);
$esito = $xmlDoc->createElement("esito", 1);

$richiesta->appendChild($id);
$richiesta->appendChild($idUtente);
$richiesta->appendChild($nome);
$richiesta->appendChild($cognome);
$richiesta->appendChild($qnt);
$richiesta->appendChild($esito);

$storicoCre->appendChild($richiesta);
$xmlDoc->formatOutput = true;
$xml = $xmlDoc->saveXML();
file_put_contents($xmlFile, $xml);  //sovrascrive il contenuto del vecchio file XML con quello nuovo

header("location: richiesta_cre.php");