<?php
include('config.php');
$con = new mysqli($host,$userName,$password,$dbName);
session_start();
if(!isset($_SESSION['loggato']) || $_SESSION['loggato'] !== true){
    header("location: accesso.php");
}
?>

<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

    <title>Richiesta Crediti</title>
    <link rel="stylesheet" href="index.css" />
    <style>
        body{

            background: url('foto/wallpaper2.jpg') no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>
<?php
if($_SESSION['tipo'] == 1){
$nome_= $_SESSION['nome'];
$sql5 = "SELECT crediti FROM utenti WHERE nome = '$nome_'";
$result5 = $con->query($sql5);
$row5 = mysqli_fetch_array($result5);
$_SESSION['crediti'] = $row5['crediti'];
}

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
      ?><b style='margin-left:-500px' class='green'>GREEN HOUSE</b>
      <?php
    }else{
      if($_SESSION['tipo'] == 1){
      ?><b style='margin-left:-120px;' class='green'>GREEN HOUSE</b><?php
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
    <a href="#catalogo">CATALOGO</a>
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
        }
        ?> 
      </nav>
    </div>
    <?php
}?>

   

<div class="wrapper">
<form action="script_richiestacre.php" method="post">
    <h1 class="titolo2">RICHIEDI CREDITI</h1>
    <div class="input-box">
    <label for="mail">Numero crediti richiesti</label>
    <input style='margin-top:20px' type="number" name="cre" id="cre" required>
    </div>
    <button type="submit" value="invia" >Invia</button>
    <p class='text'>Torna alla <a href="index.php"><button type="button" class='verde' formnovalidate >HOME</button></a></p>
</form>

    
</div>




</body>
<html>