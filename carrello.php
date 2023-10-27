
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
    <b style=margin-right:100px; class='green'>GREEN HOUSE</b>
    <?php
    if($_SESSION['tipo'] == 1){
      $nome_= $_SESSION['nome'];
      $sql5 = "SELECT crediti FROM utenti WHERE nome = '$nome_'";
      $result5 = $con->query($sql5);
      $row5 = mysqli_fetch_array($result5);
      $_SESSION['crediti'] = $row5['crediti'];
      ?>
    <b style='margin-left:250px;'>CREDITI <?php echo $_SESSION['crediti']?></b>
    <?php }?>
      <nav class='navbar'>
  
    <?php
            
            if ($_SESSION['tipo'] == 0) {
        
        ?>
        <a href="form_inserimento_pianta.php">INSERISCI PIANTA</a>
        <?php } ?>
        <a href="index.php">CATEGORIE</a>
        <a href="richiesta_cre.php">RICHIEDI CREDITI</a>
        <a href="faq.php">FAQ</a>
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

      $_SESSION['piante_nel_carrello'] = array();
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
                                  <th> NOME PIANTA </th>
                                  <th> FOTO </th>
                                  <th> QUANTITA </th>
                                  <th> PREZZO </th>
                                  <th></th>
                                  <th></th>
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
    //mi salvo tutte le info delle piante del carrello
    $pianta = array(
      'nome' => $value["Nome"],
      'quantita' => $value["Quantita"]
    );

    // Aggiungi questa pianta all'array delle piante nel carrello
    $_SESSION['piante_nel_carrello'][] = $pianta;
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
          <input type='hidden' name='nome' value='<?php echo $value['Nome']?>'>
        </form>
      </td>
      <td>
        <?php
          if($value["Quantita"] > 0){
            ?>
          
        <form action ='gestionecarrello.php' method='POST'>
          <button class='blu' name='diminuisci' type="submit"> - </button>
          <input type='hidden' name='nome' value='<?php echo $value['Nome']?>'>
        </form>
        <?php }
          ?>
      </td>

      <td>
        <?php if($_SESSION['crediti'] > $totale){?>
        <form action ='gestionecarrello.php' method='POST'>
          <button class='blu' name='aumenta' type="submit"> + </button>
          <input type='hidden' name='nome' value='<?php echo $value['Nome']?>'>
        </form>
        <?php }?>
      </td>
      
    </tr>

    <?php
  }
  
        ?>
        
        <td colspan="4"></td>
        <td>
          <label class='switch'>Spedizione con Corriere Express <bR><br>
            <input type='checkbox'>
            <span class='slider'></span>
          </label>
        </td>
        <td class="centrato-totale">
          <?php echo $totale ?>$<br><br><form action ='svuota.php' method='POST'>
            <?php
            if($totale>$_SESSION['crediti']){
              ?>
              <button class='blu' name='svuota' type="submit" disabled >Crediti Insufficienti</button></td>
              <?php
            }else{
              if(!empty($_SESSION['carrello'])){ ?>
                <button class='blu' name='svuota' type="submit">EFFETTUA ORDINE</button></td>
                <input type="hidden" id="qnt" name="qnt" value="<?php echo $totale ?>">
                <input type='hidden' name='nome' value='<?php echo $_SESSION['nome']?>'>
                <input type='hidden' name='nome_pianta' value='<?php echo $value["Nome"]?>'>
                <input type='hidden' name='numero_piante' value='<?php echo $value["Quantita"]?>'>
            </form> 
        </td>
        
    
  <?php
}
            }
}
}
?>
</div>
</table>
</body>

</html>