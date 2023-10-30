<?php 
//David Buesa

/**
 * afegirUsuari - Funció que afegeix un usuari a la base de dades
 * @param  mixed $usuari
 * @param  mixed $contrasenya
 * @return void
 */
function afegirUsuari($usuari, $contrasenya){
    require 'connexio.php';

    try{
    $stmt = $conn->prepare("INSERT INTO usuaris (username, password) VALUES (?, ?)");
  
    $stmt->bindParam(1, $usuari);
    $stmt->bindParam(2, $contrasenya);
    
    $stmt->execute();
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
}


?>