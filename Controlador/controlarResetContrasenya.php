<?php

$errors = array();
$token = $_GET['token'];
$tokenExpires= date("Y-m-d H:i:s");


function dataActual($tokenExpires, $token){
    require '../Model/connexio.php';
    try{
        $stmt = $conn->prepare("UPDATE usuaris SET token_expires = ? WHERE token = ?");
        $stmt->bindParam(1, $tokenExpires);
        $stmt->bindParam(2, $token);
        $stmt->execute();
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
}

dataActual($tokenExpires, $token);


include_once '../Vista/novaContr.vista.php';

?>