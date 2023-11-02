<?php
session_start();


/**
 * verificarContrasenya - Funció que comprova si la contrasenya és correcta per a un usuari donat 
 *
 * @param  mixed $user  
 * @param  mixed $contr
 * @return boolean true si la contrasenya és correcta, false si no ho és
 */
function verificarContrasenya($user, $contr){
    require 'connexio.php';
    try{
        $stmt = $conn->prepare("SELECT * FROM usuaris WHERE username = ?");
        $stmt->bindParam(1, $user);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            if (password_verify($contr, $result['password'])) {
                return true;
            } else {
                return false;
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

/**
 * verificarUsuari - Funció que comprova si l'usuari existeix a la base de dades 
 *
 * @param  mixed $user 
 * @return boolean  true si l'usuari existeix, false si no existeix
 */
function verificarUsuari($user){
    require 'connexio.php';
    try{
        $stmt = $conn->prepare("SELECT * FROM usuaris WHERE username = ?");
        $stmt->bindParam(1, $user);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


function loginCaptcha($user){
    require 'connexio.php';
    try{
        $stmt = $conn->prepare("SELECT * FROM usuaris WHERE username = ?");
        $stmt->bindParam(1, $user);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $_SESSION['username'] = $user;
            header("Location: ../index.php");
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>
