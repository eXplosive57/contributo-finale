<?php
include('config.php');

$con = new mysqli($host,$userName,$password,$dbName);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
//tale file serve per inserire il voto e la utilita della recensione

        $xmlFile = "../XML/recensioni_piante.xml";
        $xmlstring = "";

        foreach(file($xmlFile) as $nodo){   //leggo il contenuto del file XML

        $xmlstring.= trim($nodo); 
}

$xmlDoc = new DOMDocument();
$xmlDoc->loadXML($xmlstring);

        $utilita = $_POST['utilita'];
        $supporto = $_POST['supporto'];
        $pianta_form = $_POST['pianta'];
        $rece = $_POST['rec'];
        $nome_completo = $_POST['nome_comp'];


        // Utilizza explode() per dividere la stringa in un array
        $partiNomeCognome = explode(" ", $nome_completo);

// Ora $partiNomeCognome è un array contenente il nome e il cognome
        $nome = $partiNomeCognome[0];    // "Mario"
        $cognome = $partiNomeCognome[1];

        // questo script inserisce il valore numerico dalla utilita e supporto nei campi XML
        foreach ($xmlDoc->getElementsByTagName('pianta') as $pianta) {
            $nome_pianta = $pianta->getElementsByTagName('nome')->item(0)->nodeValue;

            
            if ($nome_pianta == $pianta_form) {
                $recensioni = $pianta->getElementsByTagName('recensione');
                foreach ($recensioni as $recensione) {
                    $comm = $recensione->getElementsByTagName('commento')->item(0)->textContent;
                    if($comm == $rece){
                        
                        $utili = $recensione->getElementsByTagName('utilita')->item(0);
                        $supp = $recensione->getElementsByTagName('supporto')->item(0);
                        
                        if($utili->nodeValue == 0 && $supp->nodeValue == 0){
                            $utili->nodeValue = $utilita;
                            $supp->nodeValue = $supporto;
                        }else{
                            $nuova_utilita = ($utili->nodeValue + $utilita) / 2;
                            $nuovo_supporto = ($supp->nodeValue + $supporto) / 2;
                             
                             $utili->nodeValue = $nuova_utilita;
                             $supp->nodeValue = $nuovo_supporto;
                        }   

                        
                    }
                    
                }
            }
        }


        // salva le modifiche nel file XML
        $xmlDoc->formatOutput = true;
        $xml = $xmlDoc->saveXML();
        file_put_contents($xmlFile, $xml);
        

        //il seguente script calcola la reputazione dell'utente
        $reputazione_totale = 0;
        $recensioni_totali = 0;

    foreach ($xmlDoc->getElementsByTagName('pianta') as $pianta) {
        $recensioni = $pianta->getElementsByTagName('recensione');
        foreach ($recensioni as $recensione) {
            $autore = $recensione->getElementsByTagName('autore')->item(0)->nodeValue;
            if ($autore == $nome_completo) {
                $utilita_recensione = $recensione->getElementsByTagName('utilita')->item(0)->nodeValue;
                $supporto_recensione = $recensione->getElementsByTagName('supporto')->item(0)->nodeValue;
                $reputazione_totale += ($utilita_recensione + $supporto_recensione) / 2;
                $recensioni_totali++;
            }
        }
    }

    if ($recensioni_totali > 0) {
        $reputazione_media = $reputazione_totale / $recensioni_totali;

        $update_query = "UPDATE utenti SET reputazione = '$reputazione_media' WHERE nome='$nome' AND cognome='$cognome'";
        $con->query($update_query);
    }

    $con->close();


    
    header("Location: ../recensioni.php");
}


?>
