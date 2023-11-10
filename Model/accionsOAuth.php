<?php
//David Buesa

session_start();
/**
 * comprovarMail - Comprova si l'usuari que s'està intentant registrar ja existeix a la base de dades (mitjançant el mail) 
 *
 * @param  mixed $email - mail de l'usuari que s'està intentant registrar
 * @return boolean - retorna true si l'usuari ja existeix i false si no existeix
 */
function comprovarMail($email){
    require 'connexio.php';
    try{
        $stmt = $conn->prepare("SELECT * FROM usuaris WHERE mail = ?");
        $stmt->bindParam(1, $email);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_OBJ);
        if($resultat){
            return true;
        }else{
            return false;
        }
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
}

/**
 * getUser - Obtenir l'usuari que s'està intentant registrar (mitjançant el mail) 
 *
 * @param  mixed $email - mail de l'usuari que s'està intentant registrar 
 * @return object - retorna l'usuari que s'està intentant registrar 
 */
function getUser($email){
    require 'connexio.php';
    try{
        $stmt = $conn->prepare("SELECT username FROM usuaris WHERE mail = ?");
        $stmt->bindParam(1, $email);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_OBJ);
        if($resultat){
            return $resultat;
        }else{
            return false;
        }
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
}

/**
 * login - Iniciar sessió amb l'usuari que s'ha registrat 
 *
 * @param  mixed $user - usuari que s'ha registrat 
 * @return void
 */
function login($user){
    require 'connexio.php';
    try{
        $stmt = $conn->prepare("SELECT * FROM usuaris WHERE username = ?");
        $stmt->bindParam(1, $user);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_OBJ);
        if($resultat){
            ini_set('session.gc_maxlifetime', 1500);
            $_SESSION['username'] = $user;
            header("Location: ../index.php");
        }
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
}

/**
 * afegirUsuari - Afegir l'usuari que s'està intentant registrar a la base de dades 
 *
 * @param  mixed $user - usuari que s'està intentant registrar 
 * @param  mixed $email - mail de l'usuari que s'està intentant registrar
 * @return void
 */
function afegirUsuari($user, $email){
    require 'connexio.php';
    try{
        $stmt = $conn->prepare("INSERT INTO usuaris (username, mail) VALUES (?, ?)");
        $stmt->bindParam(1, $user);
        $stmt->bindParam(2, $email);
        $stmt->execute();
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
}
?>