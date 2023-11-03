<?php
// David Buesa

session_start(); 

$errors = array();

if (isset($_POST["Entrar"])) {
    include_once 'utils.php';
    $user = netejarData($_POST["user"]);
    $contrassenya = netejarData($_POST["password"]);
    loginUsuari($user, $contrassenya);
}

/**
 * loginUsuari - Funció que comprova si l'usuari existeix a la base de dades i si la contrassenya és correcta
 * @param  user $user 
 * @param  contrasenya $contrassenya
 * @return void
 */
function loginUsuari($user, $contrasenya)
{
    require_once 'connexio.php';

    try {
        $stmt = $conn->prepare("SELECT * FROM usuaris WHERE username = ?");
        $stmt->bindParam(1, $user);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            if (password_verify($contrasenya, $result['password'])) {
                ini_set('session.gc_maxlifetime', 1500);
                $_SESSION['username'] = $user;
                header("Location: ../index.php");
            } else {
                $_SESSION['login_attempts'] = ($_SESSION['login_attempts'] ?? 0) + 1; 
                $errors[] = "La contrasenya no es correcte";
                print_r($_SESSION['login_attempts']);
                checkLoginAttempts(); 
            }
        } else {
            $_SESSION['login_attempts'] = ($_SESSION['login_attempts'] ?? 0) + 1; 
            $errors[] = "L'usuari no existeix";
            checkLoginAttempts(); 
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    include_once '../Vista/login.vista.php';
}

function checkLoginAttempts()
{
    if ($_SESSION['login_attempts'] >= 3) {
        header("Location: ../Controlador/controlarCaptcha.php");
        session_destroy();
    }
}

include '../Vista/login.vista.php';
?>
