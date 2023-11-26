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
<b style='margin-left:0px;' class='green'>GREEN HOUSE</b>
<?php
}else if($_SESSION['tipo'] == 0){
  ?><div class='header'>
<a href="index.php">
<img src="foto/leaf.png" alt="Logo" class="logo" >
</a>
<b style='margin-left:-650px' class='green'>GREEN HOUSE</b>
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
        <a class="testo" href="richiesta_cre.php">RICHIEDI CREDITI</a>
        <a class="testo" href="faq.php">FAQ</a>
        <a class="testo" href="stato_richieste.php">Stato richieste</a>
      </div>
    </div>
                <a href="#catalogo">CATALOGO</a>

            <?php } ?>
    

    <?php
            
            if ($_SESSION['tipo'] == 0) {
    
    ?>
       <a href="form_inserimento_pianta.php">INSERISCI PIANTA</a>
       <a href="loadrichieste.php">VISUALIZZA RICHIESTE</a>
       <a href="utenti.php">LISTA UTENTI</a>
       <a href="faq.php">FAQ</a>
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

<?php 






$xmlDoc = new DOMDocument();
$xmlDoc->load("storico_cre.xml");

$richieste = $xmlDoc->getElementsByTagName("richiesta");
?>

<div class='centro_tab'>
    <main class='table'>
      <section class='table_header'>
        <h1>Stato richieste</h1>
      </section>
          <section class="table__body">
                      <table>
                          <thead>
                              <tr>
                                  <th>QUANTITA</th>
                                  <th>STATO</th>
                                  <th></th>
                              </tr>
                          </thead>
                          </tbody>
                      
            </section>
<?php
foreach ($richieste as $richiesta) {
    $nome = $richiesta->getElementsByTagName("nome")->item(0)->textContent;
    $esito = $richiesta->getElementsByTagName("esito")->item(0)->textContent;
    $qnt = $richiesta->getElementsByTagName("qnt")->item(0)->textContent;

    if ($nome == $_SESSION['nome']) {
        echo '<tr>';
        echo '<td>' . $qnt . ' Crediti</td>';

        if ($esito == 0) {
            echo '<td><button class="verde">ACCETTATA</button></td>';
        } elseif ($esito == 2) {
            echo '<td><button class="rosso">RIFIUTATA</button></td>';
        }

        echo '</tr>';
    }
    }?>
</div>
</table>

</body>