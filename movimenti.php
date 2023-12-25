<?php
include('Script/config.php');
$con = new mysqli($host,$userName,$password,$dbName);
session_start();
if(!isset($_SESSION['loggato']) || $_SESSION['loggato'] !== true || $_SESSION['tipo'] == 1){
  header('location:Accesso_Registrazione/accesso.php');
}
?>


<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

    <title>Movimenti</title>
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
    <b style='margin-left:-480px' class='green'>GREEN HOUSE</b>
  
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

$nome = $con->real_escape_string($_POST['nome']);
$cognome = $con->real_escape_string($_POST['cognome']);


$nome_completo = $nome . ' ' . $cognome;


  
  ?>
  <div class='centro_tab'>
    <main class='table'>
      <section class='table_header'>
        <h1>STORICO ACQUISTI di <?php echo $nome . ' ' . $cognome?></h1>
      </section>
          <section class="table__body">
                      <table>
                          <thead>
                              <tr>
                                  <th>PRODOTTO</th>
                                  <th>QUANTITA</th>
                                  <th>DATA</th>
                              </tr>
                          </thead>
                          </tbody>
                      
            </section>
<?php
  $xmlDoc = new DOMDocument();
  $xmlDoc->load("XML/storico_acq.xml");
  
  $acquisti = $xmlDoc->getElementsByTagName("acq");

  foreach ($acquisti as $acq) {


    
    $prodotto = $acq->getElementsByTagName("nome_prodotto")->item(0)->textContent;
    $data = $acq->getElementsByTagName("data_acquisto")->item(0)->textContent;
    $nome_da_verificare = $acq->getElementsByTagName("nome")->item(0)->textContent;
    $qnt = $acq->getElementsByTagName("qnt")->item(0)->textContent;



    if($nome_completo == $nome_da_verificare){
   ?>
      <tr>
      <td><?php echo $prodotto ?></td>
      <td><?php echo $qnt ?></td>
      <td style='width:40%'><?php echo $data ?></td>
      
      
    </tr>   
</div>
  
  <?php }} ?>
</table>
</body>