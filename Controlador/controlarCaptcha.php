<?php

$errors = array();

	if(!empty($_POST)){
		$captcha = $_POST['g-recaptcha-response'];
		
		$secret = "6Lf0j-0oAAAAAEGfjbhqAuyKuWN6UYyFqx5THsqu";
		
		if(!$captcha){

			$errors[] = "Verifica el captcha!";
			
			} else {
			
			$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");
			
			$arr = json_decode($response, TRUE);
			
			if($arr['success'])
			{
				echo '<h2>Thanks</h2>';
				} else {
				echo '<h3>Error al comprobar Captcha </h3>';
			}
		}
	}
    include_once '../Vista/captcha.Vista.php';
?>