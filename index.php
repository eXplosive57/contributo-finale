<?php
session_start();
?>


<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

    <title>HOME</title>
    <link rel="stylesheet" href="index.css" />
</head>

<body>
<?php
//controllo sulla variabile 'loggato'
if(!isset($_SESSION['loggato']) || $_SESSION['loggato'] !== true){ //inverti i corpi!!!!
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
    <b class='green'>GREEN HOUSE</b>
    <?php if($_SESSION['tipo'] == 1){?>
    <a>CREDITI <?php echo $_SESSION['crediti']?></a>
    <?php }?>
  
      <nav class='navbar'>
        <?php
          if ($_SESSION['tipo'] == 1) {
          ?>
        <a href="#catalogo">CATALOGO</a>
        <a href="richiesta_cre.php">RICHIEDI CREDITI</a>

            <?php } ?>
    

    <?php
            
            if ($_SESSION['tipo'] == 0) {
    
    ?>
       <a href="inserimento.php">INSERISCI PIANTA</a>
       <a href="loadrichieste.php">VISUALIZZA RICHIESTE</a>
<?php } ?>
        
        <a href="logout.php">LOGOUT</a>
        <?php
        if ($_SESSION['tipo'] == 1) {
        ?>
            <a>Sei loggato come, <?php echo $_SESSION['nome'] . ' ' . $_SESSION['cognome'] ?></a>
            <a href="carrello.php">CARRELLO (<?php echo $count ?>)</a><?php
        }
        ?> 
      </nav>
    </div><?php
  }?>
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



<div id='catalogo'class='secondo'>
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
            <form style=text-align:center; action="catalogo.php" method="post">
              <button type="submit" name='valore' value='<?php echo$nome?>'>Esplora</button>
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