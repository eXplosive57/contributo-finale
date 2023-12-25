<?php


include('Script/config.php');
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

//ottengo i crediti spessi fino ad una certa data
$xmlFile = "storico_acq.xml";
$dataConfronto = "2023-12-24";
$dateToCompareObject = new DateTime($dataConfronto);

$xmlstring = "";
foreach (file($xmlFile) as $nodo) {
    $xmlstring .= trim($nodo);
}

$xmlDoc = new DOMDocument();
$xmlDoc->loadXML($xmlstring);

$xpath = new DOMXPath($xmlDoc);

// seleziono solamente le date che mi interessano
$query = "//acq[translate(data_acquisto, '-', '') <= '{$dateToCompareObject->format('Ymd')}' ]";

$acqNodes = $xpath->query($query);

$crediti_spesi = 0;
$_SESSION['crediti_spesi'] = $crediti_spesi;

foreach ($acqNodes as $acqNode) {
    // sommo il valore di prezzo per ogni elemento acq mathcato
    $prezzo = $acqNode->getElementsByTagName("prezzo")->item(0)->nodeValue;
    $qnt = $acqNode->getElementsByTagName("qnt")->item(0)->nodeValue;
    $crediti_spesi += $prezzo * $qnt;
    $_SESSION['crediti_spesi'] = $crediti_spesi;
    
  
}



    //OTTENGO LA REPUTAZIONE
    $sql = "SELECT reputazione
    FROM utenti
    WHERE id = '{$_SESSION['id']}' ";
    if ($result = $con->query($sql)) {
        if ($result->num_rows == 1) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $_SESSION['rep'] = $row['reputazione'];
    }}

    //OTTENGO I MESI DI IRSCIZIONE TOTALI
$sql2 = "SELECT DATEDIFF(CURDATE(), data_iscrizione) / 30 AS mesi_iscrizione
    FROM utenti
    WHERE id = '{$_SESSION['id']}' ";
    if ($result2 = $con->query($sql2)) {
        if ($result2->num_rows == 1) {
        $row2 = $result2->fetch_array(MYSQLI_ASSOC);
        $_SESSION['mesi'] = round($row2['mesi_iscrizione'], 0);
    }}

//OTTENGO I CREDITI TOTALI
$sql3 = "SELECT crediti
    FROM utenti
    WHERE id = '{$_SESSION['id']}' ";
    if ($result3 = $con->query($sql3)) {
        if ($result3->num_rows == 1) {
        $row3 = $result3->fetch_array(MYSQLI_ASSOC);
        $_SESSION['crediti_tot'] = $row3['crediti'];
    }}

//OTTENGO GLI ANNI DI IRSCIZIONE TOTALI
$sql4 = "SELECT DATEDIFF(CURDATE(), data_iscrizione) / 365 AS anni_iscrizione
        FROM utenti
        WHERE id = '{$_SESSION['id']}' ";
if ($result4 = $con->query($sql4)) {
    if ($result4->num_rows == 1) {
        $row4 = $result4->fetch_array(MYSQLI_ASSOC);
        $_SESSION['anni'] = round($row4['anni_iscrizione'], 0);
    }
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

    ?>
    <tr>
      <td><?php echo $value["Nome"] ?></td>
      <td><img src='<?php echo $value["Foto"] ?>'></td>
      <td>x<?php echo $value["Quantita"] ?></td>
      <td>

          <?php 

                  //il seguente codice gestisce l'eventuale sconto

                    $nome_pianta = $value['Nome'];
                    $numero_piante = $value['Quantita']; 
                    $dataCorrente = date("Y-m-d");

                    $xmlFile = "XML/catalogo.xml";
                    $xmlstring = "";
                    
                    foreach(file($xmlFile) as $nodo){
                    
                        $xmlstring.= trim($nodo); 
                    }
                    
                    $xmlDoc = new DOMDocument();
                    $xmlDoc->loadXML($xmlstring);
                      
                    $categorie = $xmlDoc->getElementsByTagName("categoria");

                        foreach ($categorie as $categoria) {
                            $piante = $categoria->getElementsByTagName("pianta");
                            foreach ($piante as $pianta) {
                                $nome_pianta_check = $pianta->getElementsByTagName("nome_pianta")->item(0)->nodeValue;
                                if($nome_pianta_check == $nome_pianta){
            
                                $sconto = $pianta->getElementsByTagName('sconto')->item(0);
            
                                $crediti = $sconto->getElementsByTagName('N')->item(0)->nodeValue;
                                $crediti_Data = $sconto->getElementsByTagName('M')->item(0)->nodeValue;
                                $offerta = $sconto->getElementsByTagName('O')->item(0)->nodeValue;
                                $reputazione = $sconto->getElementsByTagName('R')->item(0)->nodeValue;
                                $mesi = $sconto->getElementsByTagName('X')->item(0)->nodeValue;
                                $anni = $sconto->getElementsByTagName('Y')->item(0)->nodeValue;
                                

                                //controllo sui parametri degli sconti
                                if($_SESSION['crediti_tot'] >= $crediti && $_SESSION['rep'] >= $reputazione
                                  && $_SESSION['mesi'] >= $mesi && $_SESSION['anni'] >= $anni && $_SESSION['crediti_spesi'] >= $crediti_Data){


                                  echo round($value["Prezzo"]-($value["Prezzo"]*0.10), 2);
                                  $prezzo_scontato = $value["Prezzo"]-($value["Prezzo"]*0.10);
                                  $totale = $totale + ($prezzo_scontato * $value["Quantita"]);
                                }else{
                                  echo $value["Prezzo"];
                                  $totale = $totale + ($value["Prezzo"] * $value["Quantita"]);
                                }
            
                        }}}
          ?>

         






      </td>
      
      <td>
        <form action ='Script/gestionecarrello.php' method='POST'>
          <button class='rosso' name='rimuovi' type="submit">RIMUOVI</button>
          <input type='hidden' name='nome' value='<?php echo $value['Nome']?>'>
        </form>
      </td>
      <td>
        <?php
          if($value["Quantita"] > 0){
            ?>
          
        <form action ='Script/gestionecarrello.php' method='POST'>
          <button class='blu' name='diminuisci' type="submit"> - </button>
          <input type='hidden' name='nome' value='<?php echo $value['Nome']?>'>
        </form>
        <?php }
          ?>
      </td>

      <td>
        <?php if($_SESSION['crediti'] > $totale){?>
        <form action ='Script/gestionecarrello.php' method='POST'>
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
          <?php echo round($totale, 2) ?>$<br><br><form action ='Script/svuota.php' method='POST'>
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
                <input type='hidden' name='prezzo_pianta' value='<?php echo $value["Prezzo"]?>'>
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