<?php

include('config.php');
$con = new mysqli($host,$userName,$password,$dbName);
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
    <b class='green'>GREEN HOUSE</b>
  
      <nav class='navbar'>
        <a href="inserimento.php">INSERISCI PIANTA</a>
        <a href="index.php">CATEGORIE</a>
        <a href="logout.php">LOGOUT</a>
      </nav>
    </div>

<?php 
session_start();





$xmlDoc = new DOMDocument();
$xmlDoc->load("storico_cre.xml");

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
                                  <th> NOME UTENTE <span class="icon-arrow">&UpArrow;</span></th>
                                  <th> QUANTITA <span class="icon-arrow">&UpArrow;</span></th>
                                  <th></th>
                                  <th></th>
                              </tr>
                          </thead>
                          </tbody>
                      
            </section>
<?php
foreach ($richieste as $richiesta) {
    $nome = $richiesta->getElementsByTagName("nome")->item(0)->textContent;
    $cognome = $richiesta->getElementsByTagName("cognome")->item(0)->textContent;
    $qnt = $richiesta->getElementsByTagName("qnt")->item(0)->textContent;

?>

    
    <tr>
      <td><?php echo $nome . " " .  $cognome ?></td>
      <td><?php echo $qnt ?> Crediti</td>
      <td>BOTTONE ACCETTA</td>
      <td>BOTTONE RIFIUTA</td>
    </tr>
<?php }?>
</div>
</table>

</body>