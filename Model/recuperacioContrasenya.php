<?php

function comprovarMailExisteix($mail) {
    require_once 'connexio.php';
    try{
    $stmt = $conn->prepare("SELECT * FROM usuaris WHERE mail = $mail");
    $stmt->bindParam(1, $mail);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        return true;
    } else {
        return false;
    }
    } catch (Exception $e) {
        
    }
    
}


?>