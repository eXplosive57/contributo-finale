<?php
include('Script/config.php');
$con = new mysqli($host,$userName,$password,$dbName);
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
}?><?php if($_SESSION['tipo'] == 1){
?><div class='header'>
<a href="index.php">
<img src="foto/leaf.png" alt="Logo" class="logo" >
</a>
<b style='margin-left:-100px;' class='green'>GREEN HOUSE</b>
<?php
}else if($_SESSION['tipo'] == 0 OR $_SESSION['tipo'] == 2){
  ?><div class='header'>
<a href="index.php">
<img src="foto/leaf.png" alt="Logo" class="logo" >
</a>
<b style='margin-left:-1340px' class='green'>GREEN HOUSE</b>
<?php }
    
     if($_SESSION['tipo'] == 1){
      $nome_= $_SESSION['nome'];
      $sql5 = "SELECT crediti FROM utenti WHERE nome = '$nome_'";
      $result5 = $con->query($sql5);
      $row5 = mysqli_fetch_array($result5);
      $_SESSION['crediti'] = $row5['crediti'];
      ?>
    <b style='margin-left:350px;'>CREDITI <?php echo $_SESSION['crediti']?></b>
    <?php }?>
  
      <nav class='navbar'>
        <?php
          if ($_SESSION['tipo'] == 1) {
          ?>
                <div class="dropdown">
      <button class="dropbtn">SERVIZI</button>
      <div class="dropdown-content">
        <p style='text-align:center;' href="richiesta_cre.php">RICHIEDI CREDITI</p>
        <p style='text-align:center;' href="recensioni.php">RECENSIONI</p>
        <p style='text-align:center;' href="faq.php">FAQ</p>
        <p style='text-align:center;' href="stato_richieste.php">Stato richieste</p>
      </div>
    </div>
                <a href="#catalogo">CATALOGO</a>

            <?php } ?>
    

    <?php
            
            if ($_SESSION['tipo'] == 0 OR $_SESSION['tipo'] == 2 ) {
    
    ?>
<div class="dropdown">
      <button class="dropbtn">SERVIZI</button>
      <div class="dropdown-content">
       <a href="form_inserimento_pianta.php">INSERISCI PIANTA</a>
       <a href="loadrichieste.php">RICHIESTE CREDITI</a>
       <a href="utenti.php">LISTA UTENTI</a>
       <a href="faq.php">FAQ</a>
       <a href="domande_da_valutare.php">DOMANDE IN PENDING</a>
            </div>
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
  }
  
  $frasi = array(
    "Porta la natura a casa tua con le nostre meravigliose piante!",
    "Scopri il verde che fa la differenza nel nostro negozio online di piante.",
    "Crea un angolo di serenità con le nostre piante da interno.",
    "Le nostre piante sono la chiave per una casa più fresca e vibrante.",
    "Aggiungi un tocco verde al tuo spazio vitale con le nostre piante selezionate.",
    "Esplora il nostro vasto assortimento di piante e trasforma il tuo ambiente.",
    "Regala vita con le nostre piante, il regalo perfetto per ogni occasione.",
    "La bellezza della natura consegnata direttamente a casa tua.",
    "Dai un'occhiata alle nostre offerte speciali e rendi la tua casa più verde oggi!",
  );
  
  
  $fraseCasuale = $frasi[array_rand($frasi)];?>
  <div class='centro'>

  <div class="headline">
    <h1>LA TUA OASI VERDE CON UN CLICK</h1>
    <p style='color:black;'><?php echo $fraseCasuale; ?></p>
  </div>
  <?php
$xmlDoc = new DOMDocument();
$xmlDoc->load("XML/catalogo.xml");

$categorie = $xmlDoc->getElementsByTagName("categoria");
?>



<div id='catalogo'class='secondo'>
    <div class="container">
    <?php
  foreach ($categorie as $categoria) {
    $nome = $categoria->getElementsByTagName("nome")->item(0)->nodeValue;
    $foto = $categoria->getElementsByTagName("foto")->item(0)->nodeValue;
    $desc = $categoria->getElementsByTagName("descrizione")->item(0)->textContent;
    ?>
    <div class="card" >
        <img src="<?php echo $foto ?>" alt="">
        <div class="card-body">
            <h1><?php echo $nome ?></h1>
            <p><?php echo $desc ?></p>
            <form style='text-align:center;style="position: absolute; bottom: 70px;' action="catalogo.php" method="post">
              <button ' class="verde" name='valore' value='<?php echo$nome?>'>Esplora<span>&#10230;</span></button>
              <input type="hidden" id="desc" name="desc" value='<?php echo$desc ?>'>
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