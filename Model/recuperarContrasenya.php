<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function enviarMail($email){
  
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
    $mail->Body    = "que pasa marica";

    $mail->send();
} catch (Exception $e) {
  echo "Missatge no enviat. Error : {$mail->ErrorInfo}";
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
  $stmt = $conn->prepare("SELECT * FROM usuaris WHERE mail = ?");
  $stmt->bindParam(1, $mail);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  if($result){
      return false;
  }else{
      return true;
  }
}
?>