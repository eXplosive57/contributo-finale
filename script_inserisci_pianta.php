<?php

include('config.php');
$con = new mysqli($host,$userName,$password,$dbName);


session_start();



$cat = $con->real_escape_string($_POST['cat']);
$img_cat = $con->real_escape_string($_POST['foto_cat']);
$nome = $con->real_escape_string($_POST['nome']);
$descrizione = $con->real_escape_string($_POST['desc']);
$prezzo = $con->real_escape_string($_POST['prz']);
$img_pianta = $con->real_escape_string($_POST['foto_pia']);

$path = "foto_piante/";

$img_pianta_path = $path . $img_pianta;

$xmlDoc = new DOMDocument();
$xmlDoc->load("catalogo.xml");


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
                        // La pianta esiste già, puoi gestire l'errore o fare altro
                        // Ad esempio, puoi mostrare un messaggio di errore o reindirizzare
                        // l'utente a una pagina diversa.
                        header("location: inserimento.php");
                    } else {
                        //altrimenti lo aggiungo
                        $pianta = $xmlDoc->createElement("pianta");

                        $nome_pianta_da_inserire = $xmlDoc->createElement("nome_pianta", $nome);
                        $descrizione_da_inserire = $xmlDoc->createElement("descrizione", $descrizione);
                        $prezzo_da_inserire = $xmlDoc->createElement("prezzo", $prezzo);
                        $img = $xmlDoc->createElement("img", $img_pianta_path);

                        $pianta->appendChild($nome_pianta_da_inserire);
                        $pianta->appendChild($descrizione_da_inserire);
                        $pianta->appendChild($prezzo_da_inserire);
                        $pianta->appendChild($img);
                        $categoria->appendChild($pianta);
                        $xmlDoc->formatOutput = true;
                        $xmlDoc->save("catalogo.xml");
                    }
                }
            }
        



header("location: form_inserimento_pianta.php");