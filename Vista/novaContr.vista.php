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
                        Recuperació contrasenya
                    </div>
                    <form id="loginform" method="POST" action="../Controlador/controlarResetContrasenya.php">
                        <p style="color: beige;">Insereix la nova contrasenya:</p>
                        <input type="password" name="contr1" placeholder="Nova contrasenya" required/>
                        <input type="password" name="contr2" placeholder="Repeteix la contrasenya" required/>
                        <button type="submit" title="contrasenya" name="contrasenya">Desa</button>
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
                </div>
                <div class="inferior">
                    <a href="../index.php">Inici</a>
                </div>
            </div>
        </div>
    </body>
</html>