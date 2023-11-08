<?php
//David Buesa

session_start();

$errors = array();
$errors2 = array();


if (isset($_POST['crear'])){ //si s'ha clicat el botó de crear article
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
        $usuari_id = obtenirUsuariId($usuari_id)->usuari_id; //obtenir id de l'usuari que ha iniciat sessió (per poder crear l'article)
        
        require_once "../Model/accionsUsuaris.php";
        crearArticle($descripcio, $usuari_id);
    }
}






if (isset($_POST['editar'])) {  //si s'ha clicat el botó de editar article
    include "../Vista/editarArticle.vista.php";
} else if (isset($_POST['mostrarArticle'])) { //si s'ha clicat el botó de mostrar article 
    if (empty($_POST["id"])) {
        $errors[] = "Has d'introduir l'ID de l'article que vols editar!";
        include "../Vista/editarArticle.vista.php";
    } else if (!empty($_POST["id"])) { 
        include "../Model/utils.php";
        include "../Model/articlesUsuari.php";

        $article_id = netejarData($_POST['id']);
        $usuari_id = $_SESSION['username'];
        $usuari_id = obtenirUsuariId($usuari_id)->usuari_id; //obtenir id de l'usuari que ha iniciat sessió (per poder editar l'article) 

        require_once "../Model/accionsUsuaris.php";
        $article = mostrarArticle($article_id, $usuari_id); //mostrar article que s'ha introduit a l'input de l'ID (si existeix i és de l'usuari que ha iniciat sessió)
        if ($article) {
            include "../Vista/editarArticle.vista.php";
        } else {
            $errors[] = "Has d'introduir l'ID d'un article que sigui teu!";
            include "../Vista/editarArticle.vista.php";
        }
    }
} else if (isset($_POST['editarArticle']) && !empty($_POST['id'])) { //si s'ha clicat el botó de editar article i s'ha introduit un id
    if (empty($_POST['modificacio'])) {
        $errors2[] = "No pots afegir un article buit!"; //si no s'ha introduit cap descripció
        include "../Vista/editarArticle.vista.php"; 
    } else if (!empty($_POST['modificacio'])) { //si s'ha introduit una descripció vàlida 
        include "../Model/utils.php";
        include "../Model/articlesUsuari.php";

        $article_id = netejarData($_POST['id']); 
        $usuari_id = $_SESSION['username'];
        $usuari_id = obtenirUsuariId($usuari_id)->usuari_id;
        $descripcio = netejarData($_POST['modificacio']);

        require_once "../Model/accionsUsuaris.php";
        editarArticle($article_id, $usuari_id, $descripcio);
    } else if (empty($_POST['id'])) { //si no s'ha introduit cap id
        $errors2[] = "Has d'introduir l'ID d'un article que sigui teu!"; 
        include "../Vista/editarArticle.vista.php";
    }
}




    
if (isset($_POST['eliminar'])) { //si s'ha clicat el botó de eliminar article
    include "../Vista/eliminarArticle.vista.php"; 
} else if (isset($_POST['eliminarArticle'])) { //si s'ha clicat el botó de eliminar article i s'ha introduit un id 
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