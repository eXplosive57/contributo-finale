
<?php


include('config.php');
$con = new mysqli($host,$userName,$password,$dbName);

session_start();
$totale= 0;
//controllo sulla variabile 'loggato'
if(!isset($_SESSION['loggato']) || $_SESSION['loggato'] !== true){
    header("location: accesso.php");
}
$count = 0;
if(isset($_SESSION['carrello']))
{
  $count=count($_SESSION['carrello']);
}


?>

<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

    <title>CARRELLO</title>
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
    <b class='green'>GREEN HOUSE</b>
  
      <nav class='navbar'>
  
    <?php
            
            if ($_SESSION['tipo'] == 0) {
        
        ?>
        <a href="inserimento.php">INSERISCI PIANTA</a>
        <?php } ?>
        <a href="index.php">CATEGORIE</a>
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
      if(isset($_SESSION['esiste'])) {
        
        ?>

      <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
        <h3><?php echo $_SESSION['esiste'] ?></h3>
        </div>  
<?php
        
        unset($_SESSION['esiste']);
      }

      
      if(isset($_SESSION['acq'])) {
        
        ?>

      <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
        <h3><?php echo $_SESSION['acq'] ?></h3>
        </div>  
<?php
        
        unset($_SESSION['acq']);
      }



//controllo sulla variabile 'loggato'
if(!isset($_SESSION['loggato']) || $_SESSION['loggato'] !== true){
    header("location: accesso.php");
}else
{
  ?>
  <div class='centro_tab'>
    <main class='table'>
      <section class='table_header'>
        <h1>PIANTE AGGIUNTE</h1>
      </section>
          <section class="table__body">
                      <table>
                          <thead>
                              <tr>
                                  <th> NOME PIANTA <span class="icon-arrow">&UpArrow;</span></th>
                                  <th> FOTO <span class="icon-arrow">&UpArrow;</span></th>
                                  <th> QUANTITA <span class="icon-arrow">&UpArrow;</span></th>
                                  <th> PREZZO <span class="icon-arrow">&UpArrow;</span></th>
                                  <th></th>
                              </tr>
                          </thead>
                          </tbody>
                      
            </section>
    <?php
    if(isset($_SESSION['carrello']))
    {
      
  foreach($_SESSION['carrello'] as $key => $value)
  {
    $totale = $totale + ($value["Prezzo"] * $value["Quantita"]);
    ?>
    <tr>
      <td><?php echo $value["Nome"] ?></td>
      <td><img src='<?php echo $value["Foto"] ?>'></td>
      <td>x<?php echo $value["Quantita"] ?></td>
      <td><?php echo $value["Prezzo"] ?>$</td>
      
      <td>
        <form action ='gestionecarrello.php' method='POST'>
          <button class='rosso' name='rimuovi' type="submit">RIMUOVI</button>
      </td>
          <input type='hidden' name='nome' value='<?php echo $value['Nome']?>'>
        </form>
    </tr>

    <?php
  }
  
        ?>
        
        <td colspan="4"></td>
        
        <td class="centrato-totale">
          <?php echo $totale ?>$<form action ='svuota.php' method='POST'>
            <?php
              if(!empty($_SESSION['carrello'])){ ?>
                <button class='blu' name='svuota' type="submit">EFFETTUA ORDINE</button></td>
            </form> 
        </td>
    
  <?php
}
}
}
?>
</div>
</table>
</body>

</html>