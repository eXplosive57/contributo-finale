<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Accesso</title>

    
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
    if (isset($_SESSION['pass'])) {
        
        ?>
    
        <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <h3>
                <?php echo $_SESSION['pass']?>
            </h3>
        </div>
        <?php
    
        unset($_SESSION['pass']);
    }
    ?>
    
    <?php
    
    
    if (isset($_SESSION['ko'])) {
    
        ?>
    
        <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <h3>
                <?php echo $_SESSION['ko']?>
            </h3>
        </div>
        <?php
    
        unset($_SESSION['ko']);
    }

    if (isset($_SESSION['reg'])) {

        ?>
    
        <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <h3>
                <?php echo $_SESSION['reg']?>
            </h3>
        </div>
        <?php
    
        unset($_SESSION['reg']);
    }
    ?>
    

    
    
    

    <div class="main">


        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Accedi</h2>
                        <form method="POST" class="register-form" id="register-form"name="form1" action="../Script/login.php">
                            <input type="hidden" name="form_name" value="form1">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="mail" id="mail" placeholder="Indirizzo Mail" required/>
                            </div>
                            
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="username" placeholder="Password" required/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Login"/>
                            </div>
                            <div class="form-group form-button">
                            <a href="accesso_admin.php"><input type="button" name="signup" id="signup" class="form-submit" value="Admin/Gestore"></a>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="reg.php" class="signup-image-link">Non sei ancora registrato?</a>
                    </div>
                </div>
            </div>
        </section>



    </div>


    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</html>