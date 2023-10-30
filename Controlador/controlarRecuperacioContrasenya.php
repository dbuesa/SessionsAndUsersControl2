<?php
$errors = array();

if(!empty($_POST['mail'])){
    require_once '../Model/utils.php';
    require_once '../Model/recuperacioContrasenya.php';
   $mail = netejarData($_POST['mail']);
   if(comprovarMailExisteix($mail)){
       $errors[] = "El correu no existeix";
    }
}

if(isset($_POST['recuperar']) && empty($errors)){
    require_once '../Model/recuperarContrasenya.php';
    enviarMail($mail);
    $errors[] = "Mail enviat";
    
}


include_once '../Vista/recuperarContr.vista.php'

?>