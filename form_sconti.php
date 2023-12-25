<?php

include('Script/config.php');
$con = new mysqli($host,$userName,$password,$dbName);
session_start();
if(!isset($_SESSION['loggato']) || $_SESSION['loggato'] !== true || $_SESSION['tipo'] == 1){
  header('location:Accesso_Registrazione/accesso.php');
}
?>


<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

    <title>Inserimento Sconto</title>
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

    <div class="wrapper">
<form action="script_inserisci_sconto.php" method="post">
    <h1 class="titolo2">AGGIUNGI SCONTO</h1>
    <div class="input-box">
    <label for="nome">CATEGORIA</label>
    <input type="text" name="cat" id="cat" required>
    </div>
    <div class="input-box">
    <label for="nome">PIANTA</label>
    <input type="text" name="nome" id="nome" required>
    </div>
    <div class="input-box">
    <label for="nome_cat">CREDITI SPESI FINORA</label>
    <input type="number" name="cre_tot" id="cre_tot" required>
    </div>
    <div class="input-box">
    <label for="foto_cat">CREDITI SPESI DA UNA DATA</label>
    <input type="number" name="cre_Data" id="cre_Data">
    </div>
    <div class="input-box">
    <label for="nome">OFFERTA ACQUISTATA</label>
    <input type="text" name="off" id="noffome" required>
    </div>
    <div class="input-box">
    <label for="mail">REPUTAZIONE RICHIESTA</label>
    <input type="number" name="rep" id="rep" required>
    </div>
    <div class="input-box">
    <label for="prz">MESI DI ISCRIZIONE</label>
    <input type="number" name="mesi" id="mesi" required>
    </div>
    <div class="input-box">
    <label for="prz">ANNI DI ISCRIZIONE</label>
    <input type="number" name="anni" id="anni" required>
    </div>
    <button type="submit" value="invia">Invia</button>
            <form style='text-align:center;' action="index.php">
              <button class="verde">HOME</button>
            </form>

</form>
    
</div>