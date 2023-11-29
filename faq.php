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
<div class='header'>
  <a href="index.php">
    <img src="foto/leaf.png" alt="Logo" class="logo" >
  </a>
    <b style='margin-left:-480px' class='green'>GREEN HOUSE</b>
  
      <nav class='navbar'>
        <a href="form_inserimento_pianta.php">INSERISCI PIANTA</a>
        <a href="loadrichieste.php">VISUALIZZA RICHIESTE</a>
        
        <a href="utenti.php">LISTA UTENTI</a>
        <a href="index.php">CATEGORIE</a>
        <a href="faq.php">FAQ</a>
        <a href="logout.php">LOGOUT</a>
      </nav>
    </div>



   <?php

    $dataCorrente = date('Y-m-d H:i:s');

    $xmlDoc = new DOMDocument();
    $xmlDoc->load("faqs.xml");

    $domande = $xmlDoc->getElementsByTagName("faq");

    ?>

    <div class='centro_tab'>
    <main class='table'>
      <section class='table_header'>
        <h1>FAQ'S</h1>
      </section>
          <section class="table__body">
                      <table>
                          <thead>
                              <tr>
                                  <th>CREATA DA</th>
                                  <th>DOMANDA</th>
                                  <th>RISPOSTA</th>
                                  <th>DATA</th>
                              </tr>
                          </thead>
                          </tbody>
                      
            </section>
<?php
foreach ($domande as $faq) {

    $risposta = $faq->getElementsByTagName("risposta")->item(0)->textContent;
    $domanda = $faq->getElementsByTagName("domanda")->item(0)->textContent;
    $creata = $faq->getElementsByTagName("creata_da")->item(0)->textContent;
    $data = $faq->getElementsByTagName("data")->item(0)->textContent;
    

?>

    
    <tr>
      <td><?php echo $creata ?></td>
      <td><?php echo $domanda ?></td>
      <td>Paolo:<br><?php echo $risposta ?></td>
      <td style='width:20%'><?php echo $data ?></td>
    </tr>
<?php }?>
</tbody>
                </table>
            </section>
        </main>
</div>


<?php 
if($_SESSION['tipo'] == 1) {
?>
<div class="wrapper">
<form action="script_faq.php" method="post">
    <h1 class='titolo2'>POSTA UNA DOMANDA</h1>
    <div class="input-box">
    <label for="nome">Domanda</label>
    <input type="text" name="domanda" id="domanda" required>
    <input type="hidden" id="nome" name="nome" value="<?php echo $_SESSION['nome'] ?>">
    <input type="hidden" id="cognome" name="cognome" value="<?php echo $_SESSION['cognome'] ?>">
    <input type="hidden" id="data" name="data" value="<?php echo $dataCorrente ?>">
    </div>

    <button type="submit" value="invia">Invia</button>

</form>
<?php } ?>

</div>    

</body>
</html>


</body>