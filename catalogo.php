<?php


include('Script/config.php');
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
      ?><b style='margin-left:-720px' class='green'>GREEN HOUSE</b>
      <?php
    }else{
      if($_SESSION['tipo'] == 1){
      ?><b style='margin-left:-500px;' class='green'>GREEN HOUSE</b><?php
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

    <?php 
    if ($_SESSION['tipo'] == 0) { 
    
    ?>
    
    <a href="richiesta_cre.php">RICHIEDI CREDITI</a>

    <?php 
    }
    ?>
  
    <?php
            
            if ($_SESSION['tipo'] == 0) {
        
        ?>
        <a href="form_inserimento_pianta.php">INSERISCI PIANTA</a>
        <a href="loadrichieste.php">VISUALIZZA RICHIESTE</a>
        <a href="utenti.php">LISTA UTENTI</a>
        <?php } ?>
        <div class="dropdown">
      <button class="dropbtn">SERVIZI</button>
      <div class="dropdown-content">
        <a class="testo" href="richiesta_cre.php">RICHIEDI CREDITI</a>
        <a class="testo" href="recensioni.php">RECENSIONI</a>
        <a class="testo" href="faq.php">FAQ</a>
        <a class="testo" href="stato_richieste.php">Stato richieste</a>
      </div>
    </div>
        <a href="logout.php">LOGOUT</a>
        <?php if($_SESSION['tipo'] == 1) {
          ?>
        <a>Sei loggato come, <?php echo $_SESSION['nome'] . ' ' . $_SESSION['cognome'] ?></a>
        <a href="carrello.php">CARRELLO (<?php echo $count ?>)</a><?php
        }
        ?> 
      </nav>
    </div><?php
  }
//nome della categoria ottenuta dal bottone premuto in basa alla categoria scelta
$nome= $_POST['valore'];
;
$xmlDoc = new DOMDocument();
$xmlDoc->load("XML/catalogo.xml");

$categorie = $xmlDoc->getElementsByTagName("categoria");



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


$fraseCasuale = $frasi[array_rand($frasi)];
?>

<div class="headline">
    <h1 style='margin-top:100px;' class="typing"><?php echo $nome; ?></h1>
    <p style='margin-top:140px;color:black;'><?php echo $fraseCasuale; ?></p>
</div>




  <div id='catalogo' class='secondo'>
    <div class="container">
    <?php
    
    // Itera su tutte le categorie
  foreach ($categorie as $categoria) {
    // Trova il nome della categoria
    $nome_cat = $categoria->getElementsByTagName("nome")->item(0)->nodeValue;
    // Verifica se questa è la categoria desiderata
    if ($nome_cat === $nome) {
      // Trova tutte le piante all'interno di questa categoria
      $piante = $categoria->getElementsByTagName('pianta');
      
      // Itera su tutte le piante all'interno di questa categoria
      foreach ($piante as $pianta) {
          $nomePianta = $pianta->getElementsByTagName('nome_pianta')->item(0)->nodeValue;
          $descrizione = $pianta->getElementsByTagName('descrizione')->item(0)->nodeValue;
          $foto = $pianta->getElementsByTagName('img')->item(0)->nodeValue;
          $prezzo = $pianta->getElementsByTagName('prezzo')->item(0)->nodeValue;
          $qnt = $pianta->getElementsByTagName('quantita')->item(0)->nodeValue;
      
    ?>


<div class="card">
    <img src="<?php echo $foto ?>" alt="">
    <h1><?php echo $nomePianta?></h1>
    <p class="descrizione-testo"><?php echo $descrizione?></p>
    <h3>Disponibilità: <?php echo $qnt?></h3>
    <h2><?php echo $prezzo?> Cr</h2>

    <div class="card-buttons">
      <?php 

        if ($_SESSION['tipo'] == 1) {
      ?>        
                <form action='recensisci.php' method="POST">
                    <button type="submit" name="recensione" title="">Recensisci</button>
                    <input name="nome" hidden value="<?php echo $nomePianta; ?>">
                </form>
      <?php
              }
      ?>


        <form action="gestionecarrello.php" method="POST">
            <input name="nome" hidden value="<?php echo $nomePianta; ?>">
            <input name="foto" hidden value="<?php echo $foto; ?>">
            <input name="prezzo" hidden value="<?php echo $prezzo; ?>">

            <?php
            if ($_SESSION['tipo'] == 1 && $qnt > 0) {
                if ($prezzo > ($_SESSION['crediti'])) {
            ?>
                    <button type="submit" name="aggiungi" title="" disabled>Crediti Insufficienti</button>
            <?php
                } else {
            ?>
                    <button type="submit" name="aggiungi" title="">AGGIUNGI</button>
            <?php
                }
            }
            ?>
        </form>
    </div>
</div>

  <?php
    }
  }
}

  
  ?>
    </div> 
  </div>
 


</body>

</html>