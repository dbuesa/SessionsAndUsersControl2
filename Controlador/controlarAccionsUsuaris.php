<?php
//David Buesa

session_start();

$errors = array();
$errors2 = array();


if (isset($_POST['crear'])){
    include "../Vista/crearArticle.vista.php";
} else if (isset($_POST['afegirArticle'])) {

    if (empty($_POST['textarea'])) {
        $errors[] = "No pots afegir un article buit!";
        include "../Vista/crearArticle.vista.php";
    } else {
        include "../Model/utils.php";
        include "../Model/articlesUsuari.php";

        $descripcio = netejarData($_POST['textarea']);
        $usuari_id = $_SESSION['username']; 
        $usuari_id = obtenirUsuariId($usuari_id)->usuari_id;
        
        require_once "../Model/accionsUsuaris.php";
        crearArticle($descripcio, $usuari_id);
    }
}






if (isset($_POST['editar'])) {
    include "../Vista/editarArticle.vista.php";
} else if (isset($_POST['mostrarArticle'])) {
    if (empty($_POST["id"])) {
        $errors[] = "Has d'introduir l'ID de l'article que vols editar!";
        include "../Vista/editarArticle.vista.php";
    } else if (!empty($_POST["id"])) {
        include "../Model/utils.php";
        include "../Model/articlesUsuari.php";

        $article_id = netejarData($_POST['id']);
        $usuari_id = $_SESSION['username'];
        $usuari_id = obtenirUsuariId($usuari_id)->usuari_id;

        require_once "../Model/accionsUsuaris.php";
        $article = mostrarArticle($article_id, $usuari_id);
        if ($article) {
            include "../Vista/editarArticle.vista.php";
        } else {
            $errors[] = "Has d'introduir l'ID d'un article que sigui teu!";
            include "../Vista/editarArticle.vista.php";
        }
    }
} else if (isset($_POST['editarArticle']) && !empty($_POST['id'])) {
    if (empty($_POST['modificacio'])) {
        $errors2[] = "No pots afegir un article buit!";
        include "../Vista/editarArticle.vista.php";
    } else if (!empty($_POST['modificacio'])) {
        include "../Model/utils.php";
        include "../Model/articlesUsuari.php";

        $article_id = netejarData($_POST['id']);
        $usuari_id = $_SESSION['username'];
        $usuari_id = obtenirUsuariId($usuari_id)->usuari_id;
        $descripcio = netejarData($_POST['modificacio']);

        require_once "../Model/accionsUsuaris.php";
        editarArticle($article_id, $usuari_id, $descripcio);
    } else if (empty($_POST['id'])) {
        $errors2[] = "Has d'introduir l'ID d'un article que sigui teu!";
        include "../Vista/editarArticle.vista.php";
    }
}




    
if (isset($_POST['eliminar'])) {
    include "../Vista/eliminarArticle.vista.php";
} else if (isset($_POST['eliminarArticle'])) {
    if(empty($_POST['id'])){
        $errors[] = "Has d'introduir l'ID de l'article que vols eliminar!";
        include "../Vista/eliminarArticle.vista.php";
    }else {
        include "../Model/utils.php";
        include "../Model/articlesUsuari.php";

        $article_id = netejarData($_POST['id']);
        $usuari_id = $_SESSION['username'];
        $usuari_id = obtenirUsuariId($usuari_id)->usuari_id;

        
        require_once "../Model/accionsUsuaris.php";
        if(eliminarArticle($article_id, $usuari_id)){
            echo '<script>alert("Article eliminat!");</script>';
            header("refresh:0.01, url=../index.php");
        } else {
           $errors[] = "Has d'introduir l'ID d'un article que sigui teu!";
           include "../Vista/eliminarArticle.vista.php";
        }
    }
} 
?>