<?php
include('config.php');
$con = new mysqli($host,$userName,$password,$dbName);

session_start();
$qnt = floatval($_POST['qnt']);
$nome = $con->real_escape_string($_POST['nome']);




if(isset($_SESSION['id']) && isset($_POST['svuota']))

{
   
            $sql = "UPDATE utenti
                    SET crediti = crediti - '$qnt'
                    WHERE nome = '$nome'";
            $con->query($sql);
        unset($_SESSION['carrello']);

        foreach ($_SESSION['piante_nel_carrello'] as $key => $value) {
                
                $nome_pianta = $value['nome'];
                $numero_piante = $value['quantita'];   
                $xmlDoc = new DOMDocument();
                $xmlDoc->load("catalogo.xml");
        
                $categorie = $xmlDoc->getElementsByTagName("categoria");
                foreach ($categorie as $categoria) {
        
                    // Trova tutte le piante all'interno di questa categoria
                    $piante = $categoria->getElementsByTagName('pianta');
        
                    // Itera su tutte le piante all'interno di questa categoria
                    foreach ($piante as $pianta) {
                        $nomePianta = $pianta->getElementsByTagName('nome_pianta')->item(0)->nodeValue;
        
                        if ($nomePianta === $nome_pianta) {
                            $quantita_element = $pianta->getElementsByTagName('quantita')->item(0);
        
                            if ($quantita_element) {
                                // Ottieni la quantità attuale come numero intero
                                $quantita_attuale = intval($quantita_element->nodeValue);
        
                                // Sottrai la quantità desiderata
                                $nuova_quantita = $quantita_attuale - $numero_piante;
        
                                // Assicurati che la quantità non diventi negativa
                                if ($nuova_quantita < 0) {
                                    $nuova_quantita = 0;
                                }
        
                                // Aggiorna il valore dell'elemento quantità nel documento XML
                                $quantita_element->nodeValue = $nuova_quantita;
                                $xmlDoc->formatOutput = true;
                                $xmlDoc->save("catalogo.xml");
                                    }
                          }
                        

    $_SESSION['acq'] = "ACQUISTO EFFETTUATO!";
    header("location: carrello.php");
    
                        }}
}}

?>