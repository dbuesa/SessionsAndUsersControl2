<?php
//David Buesa

require '../github.php';
require '../Model/utils.php';
require '../Model/accionsOAuth.php';

$name = netejarData($name);
$tokenName = bin2hex(random_bytes(6));
$name .= $tokenName;
$email = netejarData($email);
$email .= ".github"; //per diferenciar els usuaris de github dels que no ho son

if(comprovarMail($email)){
    $user = getUser($email);
    $user = json_decode(json_encode($user), true); //convertir objecte a array associatiu per poder accedir a les dades amb clau valor (en comptes de objecte) 
    $user = implode($user); // convertir array associatiu a array normal per poder accedir a les dades amb indexos numerics (en comptes de clau valor) 

    login($user);
}else if(!comprovarMail($email)){
    afegirUsuari($name, $email);
    login($name);
    }

?>