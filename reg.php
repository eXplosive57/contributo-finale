<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

    <title>REGISTRAZIONE</title>
    <link rel="stylesheet" href="index.css?v=1" />
    <style>
        body{

            background: url('foto/wallpaper4.jpg') no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>

    <?php

    session_start();
    $dataCorrente = date("Y-m-d");

    if (isset($_SESSION['errore'])) {

        ?>

        <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <h3>
                <?php echo $_SESSION['errore'] ?>
            </h3>
        </div>
        <?php

        unset($_SESSION['errore']);
    }
    ?>




<div class="wrapper">
<form action="Script/script_registrazione.php" method="post">
    <h1 class='titolo2'>REGISTRATI</h1>
    <div class="input-box">
    <label for="nome">Nome</label>
    <input type="text" name="nome" id="nome" required>
    </div>

    <div class="input-box">
    <label for="cognome">Cognome</label>
    <input type="text" name="cognome" id="cognome" required>
    </div>

    <div class="input-box">
    <label for="mail">Indirizzo Mail</label>
    <input type="email" name="mail" id="mail" required>
    </div>

    <div class="input-box">
    <label for="telefono">Numero di Telefono</label>
    <input type="number" name="telefono" id="telefono" required>
    </div>

    <div class="input-box">
    <label for="cf">Codice Fiscale</label>
    <input type="text" name="cf" id="cf" required>
    </div>

    <div class="input-box">
    <label for="residenza">Indirizzo di residenza</label>
    <input type="text" name="residenza" id="residenza" required>
    </div>

    <div class="input-box">
    <label for="password">Password</label>
    <input type="password" name="password" id="username" required>
    </div>
    <input type="hidden" id="tipo" name="tipo" value="1">
    <input type="hidden" id="data" name="data" value="<?php echo $dataCorrente ?>">

    <button type="submit" value="invia">Invia</button>
    <a style='margin-left:250px;'href="accesso.php"><button type="button" class='nero' >ACCEDI</button>

</form>


</div>


</body>

<html>

