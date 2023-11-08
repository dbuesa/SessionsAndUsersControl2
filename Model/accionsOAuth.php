<?php
session_start();
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