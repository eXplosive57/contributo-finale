<?php

include('config.php');
$con = new mysqli($host,$userName,$password,$dbName);


session_start();

$cat = $con->real_escape_string($_POST['cat']);
$nome = $con->real_escape_string($_POST['nome']);

$cre_tot = $con->real_escape_string($_POST['cre_tot']);
$cre_data = $con->real_escape_string($_POST['cre_Data']);
$off = $con->real_escape_string($_POST['off']);
$rep = $con->real_escape_string($_POST['rep']);
$mesi = $con->real_escape_string($_POST['mesi']);
$anni = $con->real_escape_string($_POST['anni']);




$xmlFile = "catalogo.xml";
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

                foreach ($piante as $pianta) {
                    
                    $nome_pianta_nel_catalogo = $pianta->getElementsByTagName('nome_pianta')->item(0)->nodeValue;
                        if ($nome_pianta_nel_catalogo === $nome) {
                            
                            $sconto = $pianta->getElementsByTagName('sconto')->item(0);

                            $sconto->getElementsByTagName('N')->item(0)->nodeValue = $cre_tot;
                            $sconto->getElementsByTagName('M')->item(0)->nodeValue = $cre_data;
                            $sconto->getElementsByTagName('O')->item(0)->nodeValue = $off;
                            $sconto->getElementsByTagName('R')->item(0)->nodeValue = $rep;
                            $sconto->getElementsByTagName('X')->item(0)->nodeValue = $mesi;
                            $sconto->getElementsByTagName('Y')->item(0)->nodeValue = $anni;
                            

                    }

                        $xmlDoc->formatOutput = true;
                        $xml = $xmlDoc->saveXML();
                        file_put_contents($xmlFile, $xml);  //sovrascrive il contenuto del vecchio file XML con quello nuovo
                    }
                }
            }
        



header("location: form_inserimento_sconto.php");