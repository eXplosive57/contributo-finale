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


$sql = "SELECT nome, cognome 
        FROM utenti 
        WHERE nome <> 'Admin'";
$result = $con->query($sql);
if ($result->num_rows > 0) {
  ?>
  <div class='centro_tab'>
    <main class='table'>
      <section class='table_header'>
        <h1>UTENTI</h1>
      </section>
          <section class="table__body">
                      <table>
                          <thead>
                              <tr>
                                  <th> NOME <span class="icon-arrow">&UpArrow;</span></th>
                                  <th> COGNOME <span class="icon-arrow">&UpArrow;</span></th>
                                  <th></th>
                              </tr>
                          </thead>
                          </tbody>
                      
            </section>
<?php
  // Itera attraverso i risultati della query e stampa le righe
  while ($row = mysqli_fetch_array($result)) {
    ?>
      


    
    <tr>
      <td><?php echo $row["nome"] ?></td>
      <td><?php echo $row["cognome"] ?></td>
      <td>
          <button class="blu" type="submit"><a href='form_modifica_profilo.php'>MODIFICA</a></button></button>
      </td>
    </tr>
<?php }}?>
</div>
</table>



</body>