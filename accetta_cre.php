<?php 

include('config.php');
$con = new mysqli($host,$userName,$password,$dbName);
session_start();

$qnt = $con->real_escape_string($_POST['qnt']);
$nome = $con->real_escape_string($_POST['nome']);
$id = $con->real_escape_string($_POST['id']);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['form_name']) && $_POST['form_name'] === 'form1') {
        $sql = "UPDATE utenti
                SET crediti = crediti + '$qnt'
                WHERE nome = '$nome'";

        if ($con->query($sql) === TRUE) {

            $_SESSION['cre'] = "CREDITI CARICATI!";

            $xmlDoc = new DOMDocument();
            $xmlDoc->load("storico_cre.xml");

            $xpath = new DOMXPath($xmlDoc);
            $nodesToRemove = $xpath->query("//richiesta[id = '$id']");

            foreach ($nodesToRemove as $node) {
                $node->parentNode->removeChild($node);
            }
            $xmlDoc->save("storico_cre.xml");

            

            header("location: loadrichieste.php");
            
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['form_name']) && $_POST['form_name'] === 'form2') {


            $xmlDoc = new DOMDocument();
            $xmlDoc->load("storico_cre.xml");

            $xpath = new DOMXPath($xmlDoc);
            $nodesToRemove = $xpath->query("//richiesta[id = '$id']");

            foreach ($nodesToRemove as $node) {
                $node->parentNode->removeChild($node);
            }
            $xmlDoc->save("storico_cre.xml");

            

            header("location: loadrichieste.php");
            
        }
    }




























?>