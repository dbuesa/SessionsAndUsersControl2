<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulari de registre</title>
    <link rel="stylesheet" href="../Estils/estilsRegistre.css">
</head>
<body>  
    <form action="../Controlador/controlarRegistre.php" method="POST">
        <div id="login-box">
        <div class="left">
            <h1>Registre</h1>
            <br>
            <input type="text" name="username" placeholder="Usuari" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" required/>
            <input type="password" name="password" placeholder="Contrasenya" required/>
            <input type="password" name="password2" placeholder="Repeteix la contrasenya" required />
            
    
            <input type="submit" name="signup_submit" value="Registrar-se" />   
            <br><br>

            <div class="inferior">
                <a href="../Model/login.php">Tens compte? Entra</a>
            </div>
        </div>
        <div>
    </div>
    </form> 
    <div class="right">
        <a href="../index.php">Tornar</a>

        <span class="loginwith"><br /></span>
        <button class="social-signin facebook">Registrar-se via facebook</button>
        <button class="social-signin twitter">Registrar-se via twitter</button>
        <button class="social-signin google">Registrar-se via Google+</button>
    </div>
    <div class="or">O</div>
    </div>
    <div class="error-box">
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
</body>
</html>