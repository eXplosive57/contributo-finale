<?php

include('config.php');
$con = new mysqli($host,$userName,$password,$dbName);
session_start();
if(!isset($_SESSION['loggato']) || $_SESSION['loggato'] !== true){
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

  input[type="file"]::file-selector-button {
  border: 2px solid black;
  padding: 0.2em 0.4em;
  border-radius: 10px;
  background-color: white;
  transition: 1s;
  margin-top:10px;
  margin-bottom:10px;
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
<form action="script_inserisci_pianta.php" method="post">
    <h1 class="titolo2">AGGIUNGI PIANTA</h1>
    <div class="input-box">
    <label for="nome_cat">Nome Categoria</label>
    <input type="text" name="cat" id="cat" required>
    </div>
    <div class="input-box">
    <label for="foto_cat">Immagine Categoria</label>
    <input type="text" name="foto_cat" id="foto_cat">
    </div>
    <div class="input-box">
    <label for="nome">Nome Pianta</label>
    <input type="text" name="nome" id="nome" required>
    </div>
    <div class="input-box">
    <label for="mail">Descrizione</label>
    <input type="text" name="desc" id="desc" required>
    </div>
    <div class="input-box">
    <label for="prz">Prezzo</label>
    <input type="number" name="prz" id="prz" required>
    </div>
    <div class="input-box">
    <label for="prz">Quantita</label>
    <input type="number" name="qnt" id="qnt" required>
    </div>
    <div class="input-box">
    <label for="foto_pianta">Immagine Pianta</label>
    <input type="file" name="foto_pia" id="foto_pia" required>
    
    </div>
    <button type="submit" value="invia">Invia</button>
            <form style='text-align:center;' action="index.php">
              <button class="verde">HOME</button>
            </form>

</form>
    
</div>