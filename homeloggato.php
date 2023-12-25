<?php


include('Script/config.php');
$con = new mysqli($host,$userName,$password,$dbName);

session_start();
//controllo sulla variabile 'loggato'
if(!isset($_SESSION['loggato']) || $_SESSION['loggato'] !== true){
  header("location: accesso.php");
}

$count = 0;
if(isset($_SESSION['carrello']))
{
  $count=count($_SESSION['carrello']);
}

?><?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

    <title>HOME</title>
    <link rel="stylesheet" href="index.css" />
</head>

<body>


  <div class='header'>
  <img src="foto/leaf.png" alt="Logo" class="logo" >
  <b class='green'>GREEN HOUSE</b>

    <nav class='navbar'>
  <a href="smartphone.php">CATALOGO</a>

      <?php
          
          if ($_SESSION['tipo'] == 0) {
      
      ?>
      <a href="form_inserimento_pianta.php">INSERISCI PIANTA</a>
      <?php } ?>
      
      <a href="logout.php">LOGOUT</a>
      <a>Sei loggato come, <?php echo $_SESSION['nome'] . ' ' . $_SESSION['cognome'] ?></a>
      <?php if($_SESSION['tipo'] == 1) {
        ?>
      <a href="carrello.php">CARRELLO (<?php echo $count ?>)</a><?php
      }
      ?> 
    </nav>
  </div>


<?php


if (isset($_SESSION['log'])) {

    ?>

    <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <h3>
            <?php echo $_SESSION['log']?>
        </h3>
    </div>
    <?php

    unset($_SESSION['log']);
}
?>


<div class='centro'>

    <div class="headline">
      <h1>LA TUA OASI VERDE CON UN CLICK</h1>
      <p>RIGENERA LA TUA VITA CON LA BELLEZZA DELLE PIANTE</p>
    </div>
  <?php

$xmlDoc = new DOMDocument();
$xmlDoc->load("catalogo.xml");

$categorie = $xmlDoc->getElementsByTagName("categoria");
?>



  <div class='secondo'>
    <div class="container">
    <?php
  foreach ($categorie as $categoria) {
    $nome = $categoria->getElementsByTagName("nome")->item(0)->nodeValue;
    $foto = $categoria->getElementsByTagName("foto")->item(0)->nodeValue;
    ?>
    <div class="card">
        <img src="<?php echo $foto ?>" alt="">
        <div class="card-body">
            <h1><?php echo $nome ?></h1>
            <p>descrizione!!!!</p>
            <form action="catalogo.php" method="post">
              <button type="submit" name='valore' value='<?php echo$nome?>'>Vai a</button>
            </form>
        </div>
    </div>
  <?php
    }
    
  ?>
    </div> 
  </div>
  
  </div>
 


</body>

</html>