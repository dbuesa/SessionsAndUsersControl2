<?php

/**
 * comprovarMailExisteix comprova si el mail existeix a la base de dades
 *
 * @param  mixed $mail mail a comprovar
 * @return boolean retorna true si existeix i false si no
 */
function comprovarMailExisteix($mail) {
    require_once 'connexio.php';
    $stmt = $conn->prepare("SELECT * FROM usuaris WHERE mail = ?");
    $stmt->bindParam(1, $mail);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result){
        return false;
    }else{
        return true;
    }
}


?>