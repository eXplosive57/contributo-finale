<html>

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

    <title>HOME</title>
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
  <?php
  
  $nome_pianta = $con->real_escape_string($_POST['nome']);

//controllo sulla variabile 'loggato'
if(!isset($_SESSION['loggato']) || $_SESSION['loggato'] !== true){
  //se non sono loggato mpstro una navbar diversa
  ?>
  <div class='header'>
  <a href="index.php">
    <img src="foto/leaf.png" alt="Logo" class="logo" >
  </a>
    <b style=margin-right:1310px; class='green'>GREEN HOUSE</b>
  
      <nav class='navbar'>
    <a href="#catalogo">CATALOGO</a>
    <a href="accesso.php">ACCEDI</a>
      </nav>
    </div>
    <?php
  //caso in cui sono loggato
      }
  else{
      
    if($_SESSION['tipo'] == 1){
      $nome_= $_SESSION['nome'];
      $sql5 = "SELECT crediti FROM utenti WHERE nome = '$nome_'";
      $result5 = $con->query($sql5);
      $row5 = mysqli_fetch_array($result5);
      $_SESSION['crediti'] = $row5['crediti'];
      }
$count = 0;
if(isset($_SESSION['carrello']))
{
  $count=count($_SESSION['carrello']);
}?>
    <div class='header'>
    <a href="index.php">
    <img src="foto/leaf.png" alt="Logo" class="logo" >
  </a>
    <?php 
    if($_SESSION['tipo'] == 0){
      ?><b style='margin-left:-420px' class='green'>GREEN HOUSE</b>
      <?php
    }else{
      if($_SESSION['tipo'] == 1){
      ?><b style='margin-left:-250px;' class='green'>GREEN HOUSE</b><?php
    }}
    ?>
    
  
      <nav class='navbar'><?php
      if($_SESSION['tipo'] == 1){
      $nome_= $_SESSION['nome'];
      $sql5 = "SELECT crediti FROM utenti WHERE nome = '$nome_'";
      $result5 = $con->query($sql5);
      $row5 = mysqli_fetch_array($result5);
      $_SESSION['crediti'] = $row5['crediti'];
      ?>
    <b style='margin-left:250px;'>CREDITI <?php echo $_SESSION['crediti']?></b>
    <?php }?>
    
    <a href="richiesta_cre.php">RICHIEDI CREDITI</a>
  
    <?php
            
            if ($_SESSION['tipo'] == 0) {
        
        ?>
        <a href="form_inserimento_pianta.php">INSERISCI PIANTA</a>
        <a href="loadrichieste.php">VISUALIZZA RICHIESTE</a>
        <a href="utenti.php">LISTA UTENTI</a>
        <?php } ?>
        <a href="faq.php">FAQ</a>
        <a href="logout.php">LOGOUT</a>
        <?php if($_SESSION['tipo'] == 1) {  
          ?>
        <a>Sei loggato come, <?php echo $_SESSION['nome'] . ' ' . $_SESSION['cognome'] ?></a>
        <a href="carrello.php">CARRELLO (<?php echo $count ?>)</a><?php
        }}
        ?> 
      </nav>
    </div>
    <!-- nome della categoria ottenuta dal bottone premuto in basa alla categoria scelta -->
<div class="wrapper">
<form action="script_add_recensione.php" method="post">
    <h1 class='titolo2'><?php echo $nome_pianta ?></h1>
    <div class="input-box">
    <label for="nome">Scrivi la tua recensione</label>
    <input type="text" name="rec" id="rec" required>
    </div>

    <input type="hidden" id="nome" name="nome" value="<?php echo $_SESSION['nome']?>">
    <input type="hidden" id="cognome" name="cognome" value="<?php echo $_SESSION['cognome']?>">
    <input type="hidden" id="pianta" name="pianta" value="<?php echo $nome_pianta ?>">

    <button type="submit" value="invia">Invia</button>

</form>




</body>

</html>