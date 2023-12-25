<?php

include('config.php');
$con = new mysqli($host,$userName,$password,$dbName);


session_start();


$nome_domanda_da_inserire = $con->real_escape_string($_POST['nome_domanda']);
$nome_da_inserire = $con->real_escape_string($_POST['nome']);
$data_da_inserire = $con->real_escape_string($_POST['data']);
$risposta_da_inserire = $con->real_escape_string($_POST['risposta']);
 
$xmlFile = "../XML/faqs.xml";
$xmlstring = "";

foreach(file($xmlFile) as $nodo){   //Leggo il contenuto del file XML

    $xmlstring.= trim($nodo); 
}

$xmlDoc = new DOMDocument();
$xmlDoc->loadXML($xmlstring);


$question = $xmlDoc->getElementsByTagName("faqs")->item(0);

//le seguenti righe mi servono per contare quanti id ho in modo che la prossima richiesta di crediti
//abbia id sequenziale
$ultimarichiestaid = 0;
$richiestaelem = $xmlDoc->getElementsByTagName("faq");
//se c'é almeno una domanda
if ($richiestaelem->length > 0) {
    foreach ($richiestaelem as $richiesta) {
        $currentId = $richiesta->getElementsByTagName("id")->item(0)->textContent;
        $ultimarichiestaid = max($ultimarichiestaid, $currentId);
    }
}

$idaggiornato = $ultimarichiestaid + 1;

$domanda = $xmlDoc->createElement("faq");

$id = $xmlDoc->createElement("id", $idaggiornato);
$domanda_da_inserire = $xmlDoc->createElement("domanda", $nome_domanda_da_inserire);
$nom_da_inserire = $xmlDoc->createElement("creata_da", $nome_da_inserire);
$dat_da_inserire = $xmlDoc->createElement("data", $data_da_inserire);
$rispo_da_inserire = $xmlDoc->createElement("risposta", $risposta_da_inserire);

$domanda->appendChild($id);
$domanda->appendChild($domanda_da_inserire);
$domanda->appendChild($rispo_da_inserire);
$domanda->appendChild($nom_da_inserire);
$domanda->appendChild($dat_da_inserire);

$question->appendChild($domanda);
$xmlDoc->formatOutput = true;
$xml = $xmlDoc->saveXML();
file_put_contents($xmlFile, $xml);  //sovrascrive il contenuto del vecchio file XML con quello nuovo

$xmlFile2 = "../XML/domande_da_valutare.xml";
$xmlstring = "";

foreach(file($xmlFile2) as $nodo){   //Leggo il contenuto del file XML

    $xmlstring.= trim($nodo); 
}

$xmlDoc2 = new DOMDocument();
$xmlDoc2->loadXML($xmlstring);

// Trova tutti gli elementi "domanda"
$domande = $xmlDoc2->getElementsByTagName('domanda');


// Cerca la domanda da eliminare basandoti sul nome
foreach ($domande as $domanda) {
    $nomeElemento = $domanda->getElementsByTagName('nome')->item(0)->nodeValue;

    if ($nomeElemento === $nome_domanda_da_inserire) {
        // Rimuovi l'elemento
        
        $domanda->parentNode->removeChild($domanda);
    }
}

// Salva le modifiche nel file
$xmlDoc2->formatOutput = true;
$xml2 = $xmlDoc2->saveXML();
file_put_contents($xmlFile2, $xml2);
 


header("location: ../faq.php");