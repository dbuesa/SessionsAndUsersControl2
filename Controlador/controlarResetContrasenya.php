<?php

//David Buesa

session_start();
$errors = array();

if(!isset($_SESSION['token'])){
    $_SESSION['token'] = $_GET['token'];
}
$token = $_SESSION['token'];
$token2= date("Y-m-d H:i:s");

/**
 * comprovarToken - Funció que comprova si el token ha expirat o no 
 *
 * @param  mixed $tokenExpires minuts que han passat des que s'ha creat el token fins que s'ha intentat canviar la contrasenya 
 * @return boolean true si el token no ha expirat, false si ha expirat
 */
function comprovarToken($tokenExpires){
    if($tokenExpires > 240){
        return false;
    }else{
        return true;
    }
}

/**
 * comprovarContrasenya - Funció que comprova si les contrasenyes coincideixen
 *
 * @param  mixed $contr1 
 * @param  mixed $contr2
 * @return boolean true si les contrassenyes coincideixen, false si no
 */
function comprovarContrasenya($contr1, $contr2){
    if($contr1 == $contr2){
        return true;
    }else{
        
        return false;
    }
}
/**
 * validarContrasenya - Funció que comprova si la contrasenya és vàlida
 *
 * @param  mixed $contr1
 * @return boolean true si la contrassenya és vàlida, false si no
 */
function validarContrasenya($contr1){
    $reg = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";
    if (preg_match($reg, $contr1)) {
        return true;
    }else{
        return false;
    }
}

if(!empty($_POST["contr1"]) && !empty($_POST["contr2"])){
    require_once '../Model/utils.php';
    $contr1 = netejarData($_POST["contr1"]);
    $contr2 = netejarData($_POST["contr2"]);
    require '../Model/novaContrasenya.php';
    insertarTokenExpires($token2, $token);
    $tokenExpires = calcularMinutsToken($token);
}

if(isset($_POST['contrasenya'])){
    if(!comprovarToken($tokenExpires)){
        echo '<script>alert("El token ha expirat, si us plau, torna a enviar la petició per a canviar la contrasenya");</script>';
        header("refresh:0.01, url=../Controlador/controlarRecuperacioContrasenya.php");
    }
    if(!comprovarContrasenya($contr1, $contr2)){
        $errors[] = "Les contrasenyes no coincideixen";
    }
    if(!validarContrasenya($contr1)){
        $errors[] = "La contrasenya ha de tenir almenys 8 caràcters, una majúscula, una minúscula, un número i un caràcter especial";
    }
    if(empty($errors)){
        require_once '../Model/novaContrasenya.php';
        $contr = password_hash($contr1, PASSWORD_DEFAULT);
        canviarContrasenya($contr, $token);
        echo '<script>alert("Contrasenya actualitzada! Ja pots iniciar sessió");</script>';
        header("refresh:0.01, url=../Model/login.php");
        session_destroy();

    }
}

include_once '../Vista/novaContr.vista.php';

?>