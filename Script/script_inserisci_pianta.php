<?php

include('config.php');
$con = new mysqli($host,$userName,$password,$dbName);


session_start();
if($_SESSION['tipo'] == 1){
    header('location: ../accesso.php');
  }


$cat = $con->real_escape_string($_POST['cat']);
$img_cat = $con->real_escape_string($_POST['foto_cat']);
$nome = $con->real_escape_string($_POST['nome']);
$descrizione = $con->real_escape_string($_POST['desc']);
$prezzo = $con->real_escape_string($_POST['prz']);
$img_pianta = $con->real_escape_string($_POST['foto_pia']);
$qnt = $con->real_escape_string($_POST['qnt']);

$path = "foto_piante/";

$img_pianta_path = $path . $img_pianta;

$xmlFile = "../XML/catalogo.xml";
$xmlstring = "";

foreach(file($xmlFile) as $nodo){   //Leggo il contenuto del file XML

    $xmlstring.= trim($nodo); 
}

$xmlDoc = new DOMDocument();
$xmlDoc->loadXML($xmlstring);


$categorie = $xmlDoc->getElementsByTagName('categoria');

foreach ($categorie as $categoria) {
    // Trova il nome della categoria
    $nome_cat = $categoria->getElementsByTagName("nome")->item(0)->nodeValue;
    // Verifica se questa è categoria é giá esistente
    if ($nome_cat === $cat) {
        //prendo il nome della pianta
            $piante = $categoria->getElementsByTagName('pianta');
            $piantaEsistente = false;

                foreach ($piante as $pianta) {
                    //per ogni tag pianta controllo se gia esiste il nome della pianta
                    $nome_pianta_nel_catalogo = $pianta->getElementsByTagName('nome_pianta');
                        if ($nome_pianta_nel_catalogo === $nome) {

                            //se giá esiste non faccio nulla
                            $piantaEsistente = true;
                            break;
                    }}
                        if ($piantaEsistente) {
                        header("location: ../form_inserimento_pianta.php");
                    } else {
                        //altrimenti lo aggiungo
                        $pianta = $xmlDoc->createElement("pianta");

                        $nome_pianta_da_inserire = $xmlDoc->createElement("nome_pianta", $nome);
                        $descrizione_da_inserire = $xmlDoc->createElement("descrizione", $descrizione);
                        $prezzo_da_inserire = $xmlDoc->createElement("prezzo", $prezzo);
                        $img = $xmlDoc->createElement("img", $img_pianta_path);
                        $qnt_da_inserire = $xmlDoc->createElement("quantita", $qnt);
                        $sconto = $xmlDoc->createElement("sconto");
                        $N = $xmlDoc->createElement("N", 0);
                        $M = $xmlDoc->createElement("M", 0);
                        $O = $xmlDoc->createElement("O", 0);
                        $R = $xmlDoc->createElement("R", 0);
                        $X = $xmlDoc->createElement("X", 0);
                        $Y = $xmlDoc->createElement("Y", 0);

                        $pianta->appendChild($nome_pianta_da_inserire);
                        $pianta->appendChild($descrizione_da_inserire);
                        $pianta->appendChild($prezzo_da_inserire);
                        $pianta->appendChild($img);
                        $pianta->appendChild($qnt_da_inserire);
                        $categoria->appendChild($pianta);
                        $xmlDoc->formatOutput = true;
                        

                        $xmlDoc->formatOutput = true;
                        $xml = $xmlDoc->saveXML();
                        file_put_contents($xmlFile, $xml);  //sovrascrive il contenuto del vecchio file XML con quello nuovo
                    }
                }
            }
        



header("location: ../form_inserimento_pianta.php");