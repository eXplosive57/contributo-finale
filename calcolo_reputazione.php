<?php



include('config.php');
$con = new mysqli($host,$userName,$password,$dbName);

$sql = "UPDATE utenti
SET reputazione = '$reputazione'
WHERE nome='$nome_form' AND cognome='$cognome_form'";

if ($con->query($sql) === TRUE) {
$_SESSION['Aggiornato'] = 'Campi aggiornati!';
} else {
echo "Errore nell'aggiornamento del database: " . $con->error;
}





$piante = $xmlDoc->getElementsByTagName('pianta');
        $reputazione = 0;
        foreach ($piante as $pianta) {
            $recensioni= $pianta->getElementsByTagName("recensione");
                foreach($recensioni as $recensione){
                    $autore = $recensione->getElementsByTagName("autore")->item(0)->nodeValue;
                    if($autore == $nome_completo){
                        
                        
                        $utili = $recensione->getElementsByTagName('utilita')->item(0)->nodeValue;
                        $supp = $recensione->getElementsByTagName('supporto')->item(0)->nodeValue;
                        

                        $reputazione = $reputazione + ($utili + $supp)/2;


                        

                    }
                }
            }


?>