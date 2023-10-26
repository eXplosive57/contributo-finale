<?php

include('config.php');
$con = new mysqli($host,$userName,$password,$dbName);
session_start();
if(!isset($_SESSION['loggato']) || $_SESSION['loggato'] !== true){
  header('location:accesso.php');
}

$nome = $con->real_escape_string($_POST['nome']);
$cognome = $con->real_escape_string($_POST['cognome']);

$sql = "SELECT mail FROM Utenti WHERE nome = '$nome' AND cognome = '$cognome'";
$result = $con->query($sql);
$row = mysqli_fetch_array($result);
$_SESSION['mail'] = $row['mail'];

$sql2 = "SELECT telefono FROM Utenti WHERE nome = '$nome' AND cognome = '$cognome'";
$result2 = $con->query($sql2);
$row2 = mysqli_fetch_array($result2);
$_SESSION['telefono'] = $row2['telefono'];

$sql3 = "SELECT indirizzo FROM Utenti WHERE nome = '$nome' AND cognome = '$cognome'";
$result3 = $con->query($sql3);
$row3 = mysqli_fetch_array($result3);
$_SESSION['ind'] = $row3['indirizzo'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MODIFICA DATI UTENTE</title>
    <link rel="stylesheet" href="stile_mod_utente.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
      .header{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    padding: auto;
    margin-top: 10px;
    background: transparent;
    display: flex;
    justify-content: space-between;
    align-items: center;
    z-index: 100;
  }

  b.green{
    font-size: 18px;
    font-family: 'Archivo Black', cursive;
    text-shadow: 3px 3px 3px solid black;
    
  }
  .logo{
  width: 80px; /* Imposta la larghezza del logo */
  height: auto; /* Imposta l'altezza in modo che l'immagine mantenga le proporzioni originali */
  margin-left: 30px;
  }

  .navbar a{
    font-size: 18px;
    position: relative;
    color: #fff;
    font-weight: 500;
    text-decoration: none;
    margin-left: 40px;
    margin-right: 25px;
  }
  
  .navbar a::before{
    content: '';
    position: absolute;
    top: 100%;
    left: 0;
    width: 0%;
    height: 2px;
    background: #fff;
    transition: .3s;
  }

  .navbar a:hover::before{
    width: 100%;
  }

  

</style>
</head>

<body>
<div class='header'>
  <a href="index.php">
    <img src="foto/leaf.png" alt="Logo" class="logo" >
  </a>
    <b style='margin-left:-640px' class='green'>GREEN HOUSE</b>
  
      <nav class='navbar'>
        <a href="form_inserimento_pianta.php">INSERISCI PIANTA</a>
        <a href="loadrichieste.php">VISUALIZZA RICHIESTE</a>
        
        <a href="utenti.php">LISTA UTENTI</a>
        <a href="index.php">CATEGORIE</a>
        <a href="logout.php">LOGOUT</a>
      </nav>
    </div>
    <div class="container light-style flex-grow-1 container-p-y">
        <h4 style='margin-top:100px' class="font-weight-bold py-3 mb-4">
            Impostazioni Account
        </h4>
        <div style='margin-top:-15px'class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="list"
                            href="#account-general">Generali</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list"
                            href="#account-change-password">Password</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="account-general">
                            <div class="card-body media align-items-center">
                                <img src="foto/user.png" alt
                                    class="d-block ui-w-80">
                            </div>
                            <hr class="border-light m-0">
                            <div class="card-body">
                                <form action='script_mod_profilo.php' method='POST' name="form1">
                                <input type="hidden" name="form_name" value="form1">
                                <div class="form-group">
                                    <label class="form-label">Nome</label>
                                    <input type="text" class="form-control mb-1" name='nome' placeholder='<?php echo $nome;?>' >
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Cognome</label>
                                    <input type="text" class="form-control" name='cognome' placeholder="<?php echo $cognome;?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">E-mail</label>
                                    <input type="text" class="form-control mb-1" name='mail' placeholder="<?php echo $_SESSION['mail'];?>">
                                    
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Cellulare</label>
                                    <input type="text" class="form-control" name='cellulare' placeholder="<?php echo $_SESSION['telefono'];?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Indirizzo</label>
                                    <input type="text" class="form-control" name='indirizzo' placeholder="<?php echo $_SESSION['ind'];?>">
                                </div>
                                <div class="text-right mt-3">
                                    <button type="submit" class="btn btn-primary">Salva</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                                </div>
                                <input type="hidden" id="nome" name="nome_sessione" value="<?php echo $nome;?>">
                                <input type="hidden" id="cognome" name="cognome_sessione" value="<?php echo $cognome;?>">
                            </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="account-change-password">
                            <div class="card-body pb-2">
                                <form action='script_mod_profilo.php' method='POST' name="form2">
                                <input type="hidden" name="form_name" value="form2">
                                
                                <div class="form-group">
                                    <label class="form-label">Nuova Password</label>
                                    <input type="password" class="form-control" name='pass' placeholder='Inserisci password' >
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Ripeti Password</label>
                                    <input type="password" class="form-control" placeholder='Ripeti password'>
                                </div>
                                <input type="hidden" id="nome" name="nome_sessione" value="<?php echo $nome;?>">
                                <input type="hidden" id="cognome" name="cognome_sessione" value="<?php echo $cognome;?>">
                                <div class="text-right mt-3">
                                    <button type="submit" class="btn btn-primary">Salva</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                                </div>
                            </div>
                        </div>
                        </form>
                            
        
        
        
    </div>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>