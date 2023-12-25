<?php

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
        $nome_form = $_POST['nome'];
        $cognome_form = $_POST['cognome'];

        $nome_completo = $nome_form . " " . $cognome_form;

        
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

       
         header("Location: ../recensioni.php");
    }

?>
