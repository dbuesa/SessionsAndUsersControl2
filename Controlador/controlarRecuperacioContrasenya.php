<?php
//David Buesa

$errors = array();

if(!empty($_POST['mail'])){
    require_once '../Model/utils.php';
    require_once '../Model/recuperarContrasenya.php';
    $mail = netejarData($_POST['mail']);
    if(comprovarMailExisteix($mail)){
       $errors[] = "El correu no existeix";
    }else {
        require_once '../Model/recuperarContrasenya.php';
        enviarMail($mail);
        $errors[] = "Revisa el teu correu per recuperar la contrasenya";
    }
}


include_once '../Vista/recuperarContr.vista.php'

?>