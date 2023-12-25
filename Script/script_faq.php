<?php

include('config.php');
$con = new mysqli($host,$userName,$password,$dbName);


session_start();


$domanda_form = $con->real_escape_string($_POST['domanda']);
$nome_form = $con->real_escape_string($_POST['nome']);
$cognome_form = $con->real_escape_string($_POST['cognome']);
$data_form = $con->real_escape_string($_POST['data']);

$nome_completo = $nome_form . ' ' . $cognome_form;
 
$xmlFile = "../XML/domande_da_valutare.xml";
$xmlstring = "";

foreach(file($xmlFile) as $nodo){   //Leggo il contenuto del file XML

    $xmlstring.= trim($nodo); 
}

$xmlDoc = new DOMDocument();
$xmlDoc->loadXML($xmlstring);


$Domande = $xmlDoc->getElementsByTagName("domande")->item(0);

//le seguenti righe mi servono per contare quanti id ho in modo che la prossima richiesta di crediti
//abbia id sequenziale
$ultimarichiestaid = 0;
$richiestaelem = $xmlDoc->getElementsByTagName("domanda");
//se c'é almeno una domanda
if ($richiestaelem->length > 0) {
    foreach ($richiestaelem as $richiesta) {
        $currentId = $richiesta->getElementsByTagName("id")->item(0)->textContent;
        $ultimarichiestaid = max($ultimarichiestaid, $currentId);
    }
}

$idaggiornato = $ultimarichiestaid + 1;

$domanda = $xmlDoc->createElement("domanda");

$id = $xmlDoc->createElement("id", $idaggiornato);
$domanda_da_inserire = $xmlDoc->createElement("nome", $domanda_form);
$nome_da_inserire = $xmlDoc->createElement("creata_da", $nome_completo);
$data_da_inserire = $xmlDoc->createElement("data", $data_form);

$domanda->appendChild($id);
$domanda->appendChild($domanda_da_inserire);
$domanda->appendChild($nome_da_inserire);
$domanda->appendChild($data_da_inserire);

$Domande->appendChild($domanda);


// Salva le modifiche nel file
$xmlDoc->formatOutput = true;
$xmlDoc->save($xmlFile);

header("location: ../faq.php");