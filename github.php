<?php
//David Buesa

include 'vendor/autoload.php';

$config = [
    'callback' => "http://localhost/Pr%C3%A0ctiques%20BackEnd/UF2/Pr%C3%A0ctica5/Controlador/controlarGithub.php",
    'keys' => ['id' => 'db7bbee9c77d0725d7a5', 'secret' => '569e99ea1947d2e23cc9c0617a00b3c4082ef29e'],
];

try {
    $adapter = new Hybridauth\Provider\Github($config);

    $adapter->authenticate();

    $tokens = $adapter->getAccessToken();
    $userProfile = $adapter->getUserProfile();

    $name = $userProfile->displayName;
    $email = $userProfile->email;
    

    $adapter->disconnect();
} catch (Exception $e) {
    echo $e->getMessage();
}