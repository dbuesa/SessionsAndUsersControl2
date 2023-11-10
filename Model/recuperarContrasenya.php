<?php
//David Buesa

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/**
 * nomUsuari retorna el nom d'usuari a partir del mail de l'usuari 
 *
 * @param  mixed $mail mail de l'usuari
 * @return void
 */
function nomUsuari($mail){
    require 'connexio.php';
    try{
    $stmt = $conn->prepare("SELECT username FROM usuaris WHERE mail = ?");
    $stmt->bindParam(1, $mail);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['username'];
    }catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    }
}

/**
 * comprovarMailExisteix comprova si el mail existeix a la base de dades
 *
 * @param  mixed $mail mail a comprovar
 * @return boolean retorna true si existeix i false si no
 */
function comprovarMailExisteix($mail) {
  require_once 'connexio.php';
  try{
  $stmt = $conn->prepare("SELECT * FROM usuaris WHERE mail = ?");
  $stmt->bindParam(1, $mail);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  if($result){
      return false;
  }else{
      return true;
  }
  }catch(PDOException $e){
  echo "Error: " . $e->getMessage();
  }
} 


/**
 * guardarToken guarda el token a la base de dades per a poder recuperar la contrasenya més endavant 
 *
 * @param  mixed $token token a guardar
 * @param  mixed $mail mail de l'usuari
 * @return void 
 */
function guardarToken($token, $time, $mail){
  require 'connexio.php';
  try{
  $stmt = $conn->prepare("UPDATE usuaris SET token = ?, token_start = ? WHERE mail = ?");
  $stmt->bindParam(1, $token);
  $stmt->bindParam(2, $time);
  $stmt->bindParam(3, $mail);
  $stmt->execute();
  }catch(PDOException $e){
    echo "Error: " . $e->getMessage();
  }
}

/**
 * enviarMail envia un mail a l'usuari amb un enllaç per a recuperar la contrasenya i guarda el token a la base de dades 
 *
 * @param  mixed $email mail de l'usuari
 * @return void
 */
function enviarMail($email){
  
  $token = bin2hex(random_bytes(16));
  $currentTime = date("Y-m-d H:i:s");
  $user = nomUsuari($email);
  guardarToken($token, $currentTime, $email);
  
  require '../PHPMailer-master/src/Exception.php';             
  require '../PHPMailer-master/src/PHPMailer.php';
  require '../PHPMailer-master/src/SMTP.php';
  
  $mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                                       //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'd.buesa@sapalomera.cat';               //SMTP username
    $mail->Password   = '03121998';                             //SMTP password
    $mail->SMTPSecure = 'ssl';                                  //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('d.buesa@sapalomera.cat', 'David Buesa');
    $mail->addAddress($email);                                   //Add a recipient

    //Content 
    $mail->isHTML(true);                                         //Set email format to HTML
    $mail->Subject = 'Recuperació de contrasenya';
    $mail->Body    = "Hola, $user, <br><br> Hem rebut una petició per recuperar la contrasenya del teu compte. <br> Clica al següent enllaç per a recuperar-la: <br> <a href='http://localhost/Pr%C3%A0ctiques%20BackEnd/UF2/Pr%C3%A0ctica5/Controlador/controlarResetContrasenya.php?token=$token'>Recuperar contrasenya</a> <br><br> Si no has estat tu, si us plau, ignora aquest missatge. <br><br> Salutacions, <br> Equip de David Buesa.";

    $mail->send();
} catch (Exception $e) {
  echo "Missatge no enviat. Error : {$mail->ErrorInfo}";
  }
}

?>