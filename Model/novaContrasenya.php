<?php
//David Buesa

/**
 * insertarTokenExpires - Funció que inserta el token expires a la base de dades per a poder comprovar si el token ha expirat o no
 *
 * @param  mixed $token2 token expires que s'insertarà a la base de dades 
 * @param  mixed $token token que s'ha passat per la url
 * @return void
 */
function insertarTokenExpires($token2, $token){
    require 'connexio.php';
    try{
        $stmt = $conn->prepare("UPDATE usuaris SET token_expires = ? WHERE token = ?");
        $stmt->bindParam(1, $token2);
        $stmt->bindParam(2, $token);
        $stmt->execute();
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
}


/**
 * calcularHoresToken - Funció que calcula les hores que han passat des que s'ha creat el token fins que s'ha intentat canviar la contrasenya 
 *
 * @param  mixed $token token que s'ha passat per la url 
 * 
 * @return result hores que han passat des que s'ha creat el token fins que s'ha intentat canviar la contrasenya
 */
function calcularMinutsToken($token){
    require 'connexio.php';
    try{
        $stmt = $conn->prepare("SELECT TIMESTAMPDIFF(MINUTE, token_start, token_expires) FROM usuaris WHERE token = ?");
        $stmt->bindParam(1, $token);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $result = $result['TIMESTAMPDIFF(MINUTE, token_start, token_expires)'];
        return $result;
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
}

/**
 * canviarContrasenya - Funció que canvia la contrasenya de l'usuari que ha oblidat la contrasenya 
 *
 * @param  mixed $cont contrasenya que s'ha introduit al formulari
 * @param  mixed $token token que s'ha passat per la url
 * @return void
 */
function canviarContrasenya($cont, $token){
    require 'connexio.php';
    try{
        $stmt = $conn->prepare("UPDATE usuaris SET password = ? WHERE token = ?");
        $stmt->bindParam(1, $cont);
        $stmt->bindParam(2, $token);
        $stmt->execute();
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
}



?>