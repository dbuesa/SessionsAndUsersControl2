<?php
$errors = array();

if(!empty($_POST['mail'])){
    require_once '../Model/utils.php';
    require_once '../Model/recuperacioContrasenya.php';
   $mail = netejarData($_POST['mail']);
   if(!comprovarMailExisteix($mail)){
       $errors[] = "El correu no existeix";
   }
}

if(isset($_POST['recuperar'])){
    require_once '../Model/recuperacioContrasenya.php';
    if(empty($errors)){
        enviarMail($mail);
    }
    
}


include_once '../Vista/recuperarContr.vista.php'

?>