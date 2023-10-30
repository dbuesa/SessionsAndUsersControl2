<?php
//David Buesa

$errors = array();

if(isset($_POST["Entrar"])){
    include_once 'utils.php';
    $user = netejarData($_POST["user"]);
    $contrassenya = netejarData($_POST["password"]);
    loginUsuari($user, $contrassenya);
}

/**
 * loginUsuari - Funció que comprova si l'usuari existeix i si la contrassenya és correcta
 * @param  mixed $user 
 * @param  mixed $contrassenya
 * @return void
 */
function loginUsuari($user, $contrassenya){
require_once 'connexio.php';
try{
    $stmt = $conn->prepare("SELECT * FROM usuaris WHERE username = ?");
    $stmt->bindParam(1, $user);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result){
        if(password_verify($contrassenya, $result['password'])){
            session_start();
            $_SESSION['username'] = $user;
            header("Location: ../index.php");
        }else{
            $errors[] = "La contrasenya no és correcta";
        }
    }else{
        $errors[] = "L'usuari no existeix";
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
}
include_once '../Vista/login.vista.php';
}



include '../Vista/login.vista.php';

?>