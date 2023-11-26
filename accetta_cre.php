<?php 

include('config.php');
$con = new mysqli($host,$userName,$password,$dbName);
session_start();

$qnt = $con->real_escape_string($_POST['qnt']);
$nome = $con->real_escape_string($_POST['nome']);
$id_da_aggiornare = $con->real_escape_string($_POST['id']);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['form_name']) && $_POST['form_name'] === 'form1') {
        $sql = "UPDATE utenti
                SET crediti = crediti + '$qnt'
                WHERE nome = '$nome'";

        if ($con->query($sql) === TRUE) {

            $_SESSION['cre'] = "CREDITI CARICATI!";

            $xmlDoc = new DOMDocument();
            $xmlDoc->load("storico_cre.xml");

            $richieste = $xmlDoc->getElementsByTagName("richiesta");
            foreach ($richieste as $richiesta) {
                $id = $richiesta->getElementsByTagName("id")->item(0)->textContent;

                if($id == $id_da_aggiornare ){
                    $campo_da_aggiornare = $richiesta->getElementsByTagName("esito")->item(0);
                    $campo_da_aggiornare->nodeValue = "0";
                }


            $xmlDoc->save("storico_cre.xml");

            

            header("location: loadrichieste.php");
            
        }
    }
}
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['form_name']) && $_POST['form_name'] === 'form2') {


            $xmlDoc = new DOMDocument();
            $xmlDoc->load("storico_cre.xml");

            $richieste = $xmlDoc->getElementsByTagName("richiesta");
            foreach ($richieste as $richiesta) {
                $id = $richiesta->getElementsByTagName("id")->item(0)->textContent;

                if($id == $id_da_aggiornare ){
                    $campo_da_aggiornare = $richiesta->getElementsByTagName("esito")->item(0);
                    //esito = 2 indica che la richiestra é stata rifiutata
                    $campo_da_aggiornare->nodeValue = "2";
                }
            $xmlDoc->save("storico_cre.xml");

            

            header("location: loadrichieste.php");
            
        }
    }
}

?>