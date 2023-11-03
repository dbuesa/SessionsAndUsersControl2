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
        <title>Recuperació contrasenya</title>
        
    </head>
    
    <body>
        
        <div id="contenedor">
            <div id="central">
                <div id="login">
                    <div class="titulo">
                        Recuperar contrasenya
                    </div>
                    <p style="color:beige;">Insereix el correu amb el que et vas registrar:</p>
                    <form id="loginform" method="POST" action="../Controlador/controlarRecuperacioContrasenya.php">
                        
                        <input type="text" name="mail" placeholder="Correu electrònic" value="<?php echo isset($_POST['mail']) ? $_POST['mail'] : ''; ?>" required/>
                        
                        <button type="submit" title="recuperar" name="recuperar">Recuperar contrasenya</button>
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
                        <div class="pie-form">
                        <a href="../Model/login.php">Login</a>
                    </div>
                    </form> 
                </div>
                <div class="inferior">
                    <a href="../index.php">Tornar</a>
                </div>
            </div>
        </div>
    </body>
</html>