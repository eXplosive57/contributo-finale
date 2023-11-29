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



    $xmlDoc = new DOMDocument();
    $xmlDoc->load("domande_da_valutare.xml");

    $question = $xmlDoc->getElementsByTagName("domanda");

    ?>

    <div class='centro_tab'>
    <main class='table'>
      <section class='table_header'>
        <h1>DOMANDE DA VALUTARE</h1>
      </section>
          <section class="table__body">
                      <table>
                          <thead>
                              <tr>
                                  <th>DOMANDA</th>
                                  <th>CREATA DA</th>
                                  <th>DATA</th>
                                  <th>RISPOSTA</th>
                              </tr>
                          </thead>
                          </tbody>
                      
            </section>
<?php
foreach ($question as $domanda) {

    $domanda1 = $domanda->getElementsByTagName("nome")->item(0)->textContent;
    $nome = $domanda->getElementsByTagName("creata_da")->item(0)->textContent;
    $data = $domanda->getElementsByTagName("data")->item(0)->textContent;
    

?>

    
    <tr>
      <td style='width:400px;'><?php echo $domanda1 ?></td>
      <td style='width:400px;'><?php echo $nome ?></td>
      <td style='width:400px;'><?php echo $data ?></td>
      <td>
        <form action="script_inserimento_risposta.php" method="post">
          <div class="input-box">
          <label for="nome"></label>
          <input style='width:300px;' type="text" name="risposta" id="risposta" required>
          <input type="hidden" id="nome" name="nome" value="<?php echo $nome ?>">
          <input type="hidden" id="data" name="data" value="<?php echo $data ?>">
          <input type="hidden" id="nome_domanda" name="nome_domanda" value="<?php echo $domanda1 ?>">
          </div>

          <button type="submit" value="invia">Invia</button>

        </form>
        
      </td>
    </tr>
<?php }?>
</tbody>
                </table>
            </section>
        </main>
</div>  

</body>
</html>


</body>