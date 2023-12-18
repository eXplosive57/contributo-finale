<?php

include('config.php');
$con = new mysqli($host,$userName,$password,$dbName);


session_start();



$nome = $con->real_escape_string($_POST['nome']);
$cognome = $con->real_escape_string($_POST['cognome']);
$nome_pianta = $con->real_escape_string($_POST['pianta']);
$rec = $con->real_escape_string($_POST['rec']);


$nome_completo = $nome . " " . $cognome;

$xmlFile = "recensioni_piante.xml";
$xmlstring = "";

foreach(file($xmlFile) as $nodo){   //Leggo il contenuto del file XML

    $xmlstring.= trim($nodo); 
}

$xmlDoc = new DOMDocument();
$xmlDoc->loadXML($xmlstring);


$piante = $xmlDoc->getElementsByTagName('pianta');
$pianta_esistente = false;

foreach ($piante as $pianta) {
    $nome_pianta_corrente = $pianta->getElementsByTagName("nome")->item(0)->nodeValue;
    if ($nome_pianta_corrente == $nome_pianta) {
        $pianta_esistente = true;
        $recensioni = $pianta->getElementsByTagName("recensione");

        $nuova_recensione = $xmlDoc->createElement("recensione");
        $autore = $xmlDoc->createElement("autore", $nome_completo);
        $commento = $xmlDoc->createElement("commento", $rec);
        $uti = $xmlDoc->createElement("utilita");
        $supp = $xmlDoc->createElement("supporto");

        $nuova_recensione->appendChild($autore);
        $nuova_recensione->appendChild($commento);
        $nuova_recensione->appendChild($uti);
        $nuova_recensione->appendChild($supp);

        $pianta->getElementsByTagName("recensioni")->item(0)->appendChild($nuova_recensione);

        $xmlDoc->formatOutput = true;
        $xmlDoc->save($xmlFile);  // sovrascrive il contenuto del vecchio file XML con quello nuovo

        break; // esci dal ciclo dopo aver aggiunto la recensione
    }
}
if (!$pianta_esistente) {
    // La pianta non esiste nel file XML, la creiamo
    $nuova_pianta = $xmlDoc->createElement("pianta");
    $nome_pianta_element = $xmlDoc->createElement("nome", $nome_pianta);

    $recensioni = $xmlDoc->createElement("recensioni");
    $nuova_recensione = $xmlDoc->createElement("recensione");
    $autore = $xmlDoc->createElement("autore", $nome_completo);
    $commento = $xmlDoc->createElement("commento", $rec);
    $uti = $xmlDoc->createElement("utilita");
    $supp = $xmlDoc->createElement("supporto");

    $nuova_recensione->appendChild($autore);
    $nuova_recensione->appendChild($commento);
    $nuova_recensione->appendChild($uti);
    $nuova_recensione->appendChild($supp);

    $recensioni->appendChild($nuova_recensione);
    $nuova_pianta->appendChild($nome_pianta_element);
    $nuova_pianta->appendChild($recensioni);

    $xmlDoc->getElementsByTagName("recensioni_piante")->item(0)->appendChild($nuova_pianta);

    $xmlDoc->formatOutput = true;
    $xmlDoc->save($xmlFile);  
}



header("location: recensioni.php");
?>