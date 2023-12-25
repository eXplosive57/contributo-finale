<?php

include('Script/config.php');
$con = new mysqli($host,$userName,$password,$dbName);
session_start();
if(!isset($_SESSION['loggato']) || $_SESSION['loggato'] !== true || $_SESSION['tipo'] == 1){
  header('location:accesso.php');
}
?>

<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

    <title>Richieste</title>
    <link rel="stylesheet" href="index.css" />
    <style>
      body {
    font-family: Arial, sans-serif;
    background-image: url('foto/wallpaper3.jpg') no-repeat;
    background-size:cover;
    
  }
    </style>
</head>

<body>
<div class='header'>
  <a href="index.php">
    <img src="foto/leaf.png" alt="Logo" class="logo" >
  </a>
    <b style='margin-left:-500px' class='green'>GREEN HOUSE</b>
  
      <nav class='navbar'>
        <a href="form_inserimento_pianta.php">INSERISCI PIANTA</a>
        <a href="loadrichieste.php">VISUALIZZA RICHIESTE</a>
        
        <a href="utenti.php">LISTA UTENTI</a>
        <a href="index.php">CATEGORIE</a>
        <a href="faq.php">FAQ</a>
        <a href="logout.php">LOGOUT</a>
      </nav>
    </div>

<?php 






$xmlDoc = new DOMDocument();
$xmlDoc->load("XML/storico_cre.xml");

$richieste = $xmlDoc->getElementsByTagName("richiesta");
?>

<div class='centro_tab'>
    <main class='table'>
      <section class='table_header'>
        <h1>RICHIESTE RICEVUTE</h1>
      </section>
          <section class="table__body">
                      <table>
                          <thead>
                              <tr>
                                  <th>NOME UTENTE</th>
                                  <th>QUANTITA</th>
                                  <th></th>
                                  <th></th>
                              </tr>
                          </thead>
                          </tbody>
                      
            </section>
<?php
foreach ($richieste as $richiesta) {

  $esito = $richiesta->getElementsByTagName("esito")->item(0)->textContent;
    if($esito == 1) {

    $nome = $richiesta->getElementsByTagName("nome")->item(0)->textContent;
    $cognome = $richiesta->getElementsByTagName("cognome")->item(0)->textContent;
    $qnt = $richiesta->getElementsByTagName("qnt")->item(0)->textContent;
    $id = $richiesta->getElementsByTagName("id")->item(0)->textContent;
    

?>

    
    <tr>
      <td style='width:200px;'><?php echo $nome . " " .  $cognome ?></td>
      <td><?php echo $qnt ?> Crediti</td>
      <td><form action="accetta_cre.php" method="POST"name="form1   ">
            <input type="hidden" name="form_name" value="form1">
            <input type="hidden" id="qnt" name="qnt" value="<?php echo $qnt; ?>">
            <input type="hidden" id="nome" name="nome" value="<?php echo $nome; ?>">
            <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
            <button class="blu" type="submit">ACCETTA</button></button></td>
          </form>
      <td><form action="accetta_cre.php" method="POST" name="form2">
            <input type="hidden" name="form_name" value="form2">
            <input type="hidden" id="qnt" name="qnt" value="<?php echo $qnt; ?>">
            <input type="hidden" id="nome" name="nome" value="<?php echo $nome; ?>">
            <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
            <button class="blu" type="submit">RIFIUTA</button></button></td>
          </form></td>
    </tr>
<?php }}?>
</div>
</table>

</body>