<?php
//David Buesa

$errors = array();

	if(!empty($_POST)){
		$captcha = $_POST['g-recaptcha-response'];
		$secret = "6Lf0j-0oAAAAAEGfjbhqAuyKuWN6UYyFqx5THsqu";
		require_once '../Model/utils.php';
		$user = netejarData($_POST["user"]);
		$contrasenya = netejarData($_POST["password"]);

		if(!verificarUsuari($user)){
			$errors[] = "L'usuari no existeix";
		}
		
		if(!$captcha){
			$errors[] = "Verifica el captcha!";
			} else {
			$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");
			$arr = json_decode($response, TRUE);
			if($arr['success']){
				if(!verificarContrasenya($user, $contrasenya)){
					$errors[] = "La contrasenya no es correcte";
				}else{
					require '../Model/loginCaptcha.php';
					loginCaptcha($user);
				}
			}
		}
	}
    include_once '../Vista/captcha.Vista.php';

	
	/**
 * verificarContrasenya - Funció que comprova si la contrasenya és correcta per a un usuari donat 
 *
 * @param  mixed $user  
 * @param  mixed $contr
 * @return boolean true si la contrasenya és correcta, false si no ho és
 */
function verificarContrasenya($user, $contr){
    require '../Model/connexio.php';
    try{
        $stmt = $conn->prepare("SELECT * FROM usuaris WHERE username = ?");
        $stmt->bindParam(1, $user);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            if (password_verify($contr, $result['password'])) {
                return true;
            } else {
                return false;
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

/**
 * verificarUsuari - Funció que comprova si l'usuari existeix a la base de dades 
 *
 * @param  mixed $user 
 * @return boolean  true si l'usuari existeix, false si no existeix
 */
function verificarUsuari($user){
    require '../Model/connexio.php';
    try{
        $stmt = $conn->prepare("SELECT * FROM usuaris WHERE username = ?");
        $stmt->bindParam(1, $user);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>