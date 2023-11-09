<!doctype html>
<html lang="es">
    
    <head>
        
        <meta charset="utf-8">        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Overpass&display=swap" rel="stylesheet">
        
        <link rel="stylesheet" href="../Estils/login.css">
        <style type="text/css"></style>
        <script type="text/javascript"></script>
        <title>Formulari d'accés</title>
        
    </head>
    
    <body>
        
        <div id="contenedor">
            <div id="central">
                <div id="login">
                    <div class="titulo">
                        Registre
                    </div>
                        <form id="loginform" method="POST" action="../Controlador/controlarRegistre.php">
                        <input type="text" name="username" placeholder="Usuari" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" required/>
                        <input type="text" name="mail" placeholder="Correu electrònic" value="<?php echo isset($_POST['mail']) ? $_POST['mail'] : ''; ?>" required/>
                        <input type="password" name="password" placeholder="Contrasenya" required/>
                        <input type="password" name="password2" placeholder="Repeteix la contrasenya" required />
                        
                        <button type="submit" title="Entrar" name="signup_submit">Dona't d'alta</button>
                        <div class="google">
                            <?php require '../autenticacio.php'?>
                            <a class="google-login-link" href="<?php echo $client->createAuthUrl() ?>"><img src="../Imatges/ui.svg">Iniciar sessió amb Google</a>
                        </div>
                        <div class="google">
                            <a class="google-login-link" href="../github.php" > <img src="../Imatges/github.png" height="25px">Iniciar sessió amb Github</a>
                        </div>
                        <div>  
                            <?php
                                if (!empty($errors)) {
                                    echo '<ul>';
                                    foreach ($errors as $error) {
                                        echo '<li style="color:beige;">' .  $error . "</li>";
                                    }
                                    echo '</ul>';
                                }
                            ?>
                        </div>
                    </form>
                    <div class="pie-form">
                        <a href="../Model/login.php">Tens compte? Entra</a>
                    </div>
                </div>
                <div class="inferior">
                    <a href="../index.php">Tornar</a>
                </div>
            </div>
        </div>
    </body>
</html>