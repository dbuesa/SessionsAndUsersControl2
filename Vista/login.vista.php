<!doctype html>
<html lang="es">
    
    <head>
        
        <meta charset="utf-8">        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
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
                        Benvingut
                    </div>
                    <form id="loginform" method="POST" action="../Model/login.php">
                        <input type="text" name="user" placeholder="Usuario" value="<?php echo isset($_POST['user']) ? $_POST['user'] : ''; ?>" required/>
                        
                        <input type="password" placeholder="Contraseña" name="password" required>
                        
                        <button type="submit" title="Entrar" name="Entrar">Entra</button>
                        <div>  
                            <?php
                                if (!empty($errors)) {
                                    echo '<ul>';
                                    foreach ($errors as $error) {
                                        echo '<li>' .  $error . "</li>";
                                    }
                                    echo '</ul>';
                                }
                            ?>
                        </div>
                    </form>
                    <div class="pie-form">
                        <a href="../Controlador/controlarRegistre.php">¿No tens compte? Registrat</a>
                    </div>
                </div>
                <div class="inferior">
                    <a href="../index.php">Tornar</a>
                </div>
            </div>
        </div>
    </body>
</html>