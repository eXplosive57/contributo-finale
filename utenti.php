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
    <b style='margin-left:-600px' class='green'>GREEN HOUSE</b>
  
      <nav class='navbar'>
        <a href="form_inserimento_pianta.php">INSERISCI PIANTA</a>
        <a href="loadrichieste.php">RICHIESTE</a>
        
        <a href="utenti.php">LISTA UTENTI</a>
        <a href="index.php">CATEGORIE</a>
        <a href="faq.php">FAQ</a>
        <a href="logout.php">LOGOUT</a>
      </nav>
    </div>

<?php 


$sql = "SELECT nome, cognome 
        FROM utenti 
        WHERE nome <> 'Admin' AND nome <> 'Gestore'";
$result = $con->query($sql);
if ($result->num_rows > 0) {
  ?>
  <div class='centro_tab'>
    <main class='table'>
      <section class='table_header'>
        <h1>GESTIONE UTENTI</h1>
      </section>
          <section class="table__body">
                      <table>
                          <thead>
                              <tr>
                                  <th>NOME</th>
                                  <th>COGNOME</th>
                                  <th></th>
                                  <th></th>
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
      <td style='width:200px;'><?php echo $row["nome"] ?></td>
      <td style='width:200px;'><?php echo $row["cognome"] ?></td>
      <td>
        <form action='form_modifica_profilo.php' method='post'>
        <input type="hidden" id="nome" name="nome" value="<?php echo $row['nome']; ?>">
        <input type="hidden" id="cognome" name="cognome" value="<?php echo $row['cognome']; ?>">
          <button class="blu" type="submit">MODIFICA</button>
        </form>
      </td>
      <td>
        <form action='movimenti.php' method='post'>
        <input type="hidden" id="nome" name="nome" value="<?php echo $row['nome']; ?>">
        <input type="hidden" id="cognome" name="cognome" value="<?php echo $row['cognome']; ?>">
          <a href='movimenti.php'><button class="blu" type="submit">MOVIMENTI</button></a>
          </form>
      </td>
    </tr>
<?php }}?>
</div>
</table>



</body>