<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require './PHPMailer-master/src/Exception.php';             
require './PHPMailer-master/src/PHPMailer.php';
require './PHPMailer-master/src/SMTP.php';


function comprovarMailExisteix($mail) {
    require_once 'connexio.php';
    $stmt = $conn->prepare("SELECT * FROM usuaris WHERE mail = ?");
    $stmt->bindParam(1, $mail);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result){
        return false;
    }
    } catch (Exception $e) {
        
    }
}






?>