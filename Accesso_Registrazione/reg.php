<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrazione</title>

    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <link rel="stylesheet" href="css/style.css">
    <style>
    .alert {
        padding: 6px;
        background-color: gray;
        color: white;
        border-radius: 10px;
        margin-left: 10px;
        margin-right: 10px;
}

.closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
}

    </style>
</head>

<body>

<?php

session_start();

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

    <div class="main">

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Registrati</h2>
                        <form method="POST" class="register-form" id="register-form"  action="../Script/script_registrazione.php">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="nome" id="nome" required placeholder="Nome"/>
                            </div>
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="cognome" id="cognome"  required placeholder="Cognome"/>
                            </div>
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="email" name="mail" id="mail"  required placeholder="Indirizzo Mail"/>
                            </div>
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="number" name="telefono" id="telefono"  required placeholder="Telefono (+39)"/>
                            </div>
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="cf" id="cf"  required placeholder="Codice Fiscale"/>
                            </div>
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="residenza" id="residenza"  required placeholder="Indirizzo di residenza"/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="username"12 placeholder="Password"/>
                            </div>
                            
                                <input type="hidden" id="tipo" name="tipo" value="1">
                                <input type="hidden" id="data" name="data" value="<?php echo $dataCorrente ?>">
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>Accetto tutte le dichiarazioni nei  <a href="#" class="term-service">Termini di servizio</a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Registrati"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="accesso.php" class="signup-image-link">Sono giá membro.</a>
                    </div>
                </div>
            </div>
        </section>

        

    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</html>