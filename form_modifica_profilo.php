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
</head>

<body>
    <div class="container light-style flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">
            Impostazioni Account
        </h4>
        <div class="card overflow-hidden">
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
                                <form action='script_mod_profilo.php' method='POST'>
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
                                <input type="hidden" id="nome" name="nome_sessione" value="<?php echo $nome;?>">
                                <input type="hidden" id="cognome" name="cognome_sessione" value="<?php echo $cognome;?>">
                            </div>
                        </div>
                        <div class="tab-pane fade" id="account-change-password">
                            <div class="card-body pb-2">
                                <div class="form-group">
                                    <label class="form-label">Nuova Password</label>
                                    <input type="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Ripeti Password</label>
                                    <input type="password" class="form-control">
                                </div>
                            </div>
                        </div>
                            
        <div class="text-right mt-3">
            <button type="submit" class="btn btn-primary">Salva</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
        </div>
        </form>
    </div>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>