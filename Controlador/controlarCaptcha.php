<?php

$errors = array();

	if(!empty($_POST)){
		$captcha = $_POST['g-recaptcha-response'];
		$secret = "6Lf0j-0oAAAAAEGfjbhqAuyKuWN6UYyFqx5THsqu";
		require_once '../Model/utils.php';
		$user = netejarData($_POST["user"]);
		$contrasenya = netejarData($_POST["password"]);

		require '../Model/loginCaptcha.php';
		if(!verificarUsuari($user)){
			$errors[] = "L'usuari no existeix";
		}if(!verificarContrasenya($user, $contrasenya)){
			$errors[] = "La contrasenya no es correcte";
		}
		
		if(!$captcha){
			$errors[] = "Verifica el captcha!";
			} else {
			$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");
			$arr = json_decode($response, TRUE);
			if($arr['success']){
				require_once '../Model/loginCaptcha.php';
				loginCaptcha($user);
			}
		}
	}
    include_once '../Vista/captcha.Vista.php';
?>