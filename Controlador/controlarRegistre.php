<?php 
//David Buesa

$errors = array();

if(!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["password2"])){
    require_once '../Model/utils.php';
    $user = netejarData($_POST["username"]);
    $contr1 = netejarData($_POST["password"]);
    $contr2 = netejarData($_POST["password2"]);
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


/**
 * comprovarUsuari - Funció que comprova si l'usuari és vàlid
 *
 * @param  mixed $user
 * @return boolean true si l'usuari és vàlid, false si no
 */
function comprovarUsuari($user){
    if (strlen($user) < 5) {
        
        return false;
    }else{
        return true;
    }
}


/**
 * existeixUsuari - Funció que comprova si l'usuari ja existeix
 *
 * @param  mixed $user
 * @return boolean true si l'usuari no existeix, false si existeix
 */
function existeixUsuari($user){
    require_once '../Model/connexio.php';
    $stmt = $conn->prepare("SELECT * FROM usuaris WHERE username = ?");
    $stmt->bindParam(1, $user);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result){
        return false;
    }else{
        return true;
    }
}

if (isset($_POST['signup_submit'])) {
    if (!comprovarContrasenya($contr1, $contr2)) {
        $errors[] = "Les contrasenyes no coincideixen";
    }
    if (!validarContrasenya($contr1)) {
        $errors[] = "La contrasenya ha de tenir almenys 8 caràcters, una majúscula, una minúscula, un número i un caràcter especial";
    }
    if (!comprovarUsuari($user)) {
        $errors[] = "L'usuari ha de tenir més de 5 caràcters";
    }
    if (!existeixUsuari($user)) {
        $errors[] = "L'usuari ja existeix";
    }

    if (empty($errors)) {
        require_once '../Model/register.php';
        $contasenya = password_hash($contr1, PASSWORD_DEFAULT);
        afegirUsuari($user, $contasenya);
        echo '<script>alert("Usuari registrat! Ja pots iniciar sessió!");</script>';
        header("refresh:0.01, url=../Model/login.php");
    }}


include "../Vista/register.vista.php";
?>