<?php


include('config.php');
$con = new mysqli($host,$userName,$password,$dbName);





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
  session_start();
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
    <b class='green'>GREEN HOUSE</b>
  
      <nav class='navbar'>
    <a href="#catalogo">CATALOGO</a>
  
    <?php
            
            if ($_SESSION['tipo'] == 0) {
        
        ?>
        <a href="inserimento.php">INSERISCI PIANTA</a>
        <?php } ?>
        
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
$xmlDoc->load("catalogo.xml");

$categorie = $xmlDoc->getElementsByTagName("categoria");
?>



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
      
    ?>


    <div class="card">
        <img src="<?php echo $foto ?>" alt="">
        
        
            <h1><?php echo $nomePianta?></h1>
            <p class="descrizione-testo"><?php echo $descrizione?></p>
            
            <h2><?php echo $prezzo?> Cr</h2>
            <form style=text-align:center; action="gestionecarrello.php" method="POST">
              <input name="nome" hidden value = "<?php echo $nomePianta; ?>">
              <input name="foto" hidden value = "<?php echo $foto; ?>">
              <input name="prezzo" hidden value = "<?php echo $prezzo; ?>">
              <label for="qty">Quantita</label>
              <input type="number" name="qty" id="qty" required pattern="[0-99]+" title="Inserisci un quantita numerica">
            <br>
            <?php 
              if($prezzo > ($_SESSION['crediti']))
              {?>
                <button class='nascosto'style=margin-top:10px; type="submit" name="aggiungi" title="" disabled >Crediti Insufficienti</button>
                <?php
              }
              else{?>
                <button style=margin-top:10px; type="submit" name="aggiungi" title="">AGGIUNGI</button>
                <?php
              }
              ?>
              
         
          
            </form>
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