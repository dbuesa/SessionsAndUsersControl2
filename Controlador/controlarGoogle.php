<?php 
//David Buesa

require '../autenticacio.php';
require '../Model/utils.php';
require '../Model/accionsOAuth.php';

$name = netejarData($name);
$tokenName = bin2hex(random_bytes(6));
$name .= $tokenName;
$email = netejarData($email);



if(comprovarMail($email)){
    $user = getUser($email);
    $user = json_decode(json_encode($user), true);
    $user = implode($user);

    login($user);
}else if(!comprovarMail($email)){
    afegirUsuari($name, $email);
    login($name);
    }


?>
