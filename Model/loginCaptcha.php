<?php
//David Buesa

session_start();

/**
 * loginCaptcha - Funció que comprova si l'usuari existeix a la base de dades i si la contrasenya és correcta i si ho és, inicia sessió, sino la destrueix
 *
 * @param  mixed $user 
 * @return void inicia sessió si l'usuari existeix i la contrasenya és correcta, sino la destrueix
 */
function loginCaptcha($user){
    require 'connexio.php';
    try{
        $stmt = $conn->prepare("SELECT * FROM usuaris WHERE username = ?");
        $stmt->bindParam(1, $user);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
                ini_set('session.gc_maxlifetime', 1500);
                $_SESSION['username'] = $user;
                header("Location: ../index.php");
            }else{
                session_destroy();
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>
