<?php
//David Buesa

/**
 * crearArticle - Crea un article a la base de dades
 *
 * @param  mixed $descripcion
 * @param  mixed $usuari_id
 * @return void
 */
function crearArticle($descripcion, $usuari_id){
    require "connexio.php";
  

    $stmt = $conn->prepare("INSERT INTO articles (descripcio, usuari_id) VALUES (?, ?)");
    $stmt->execute([$descripcion, $usuari_id]);

    echo '<script>alert("Article desat!");</script>';
    header("refresh:0.01, url=../index.php");
}

/**
 * eliminarArticle - Elimina un article de la base de dades 
 *
 * @param  mixed $article_id 
 * @param  mixed $usuari_id
 * @return boolean true si s'ha eliminat l'article, false si no
 */
function eliminarArticle($article_id, $usuari_id){
    require "connexio.php";
    $result;

    $stmt = $conn->prepare("DELETE FROM articles WHERE article_id = ? AND usuari_id = ?");
    $stmt->execute([$article_id, $usuari_id]);
    $result = $stmt->rowCount();

    if($result > 0){
        return true;
    } else {
        return false;
    }
}


/**
 * mostrarArticle - Mostra un article de la base de dades 
 *
 * @param  mixed $article_id
 * @param  mixed $usuari_id
 * @return $result retorna el resultat de la consulta
 */
function mostrarArticle($article_id, $usuari_id, ){
    require "connexio.php";

    $stmt = $conn->prepare("SELECT descripcio FROM articles WHERE article_id = ? AND usuari_id = ?");
    $stmt->execute([$article_id, $usuari_id]);
    $result = $stmt->fetch();
    
    return $result;
}

/**
 * editarArticle - Edita un article de la base de dades 
 *
 * @param  mixed $article_id
 * @param  mixed $usuari_id
 * @param  mixed $descripcio
 * @return void
 */
function editarArticle($article_id, $usuari_id, $descripcio){
    require "connexio.php";

    $stmt = $conn->prepare("UPDATE articles SET descripcio = ? WHERE article_id = ? AND usuari_id = ?");
    $stmt->execute([$descripcio, $article_id, $usuari_id]);

    echo '<script>alert("Article editat!");</script>';
    header("refresh:0.01, url=../index.php");


}

/**
 * prompt - Funció que crea un prompt per a demanar dades a l'usuari i retorna la resposta del prompt.
 *
 * @param  mixed $prompt_msg
 * @return $answer retorna la resposta del prompt
 */
function prompt($prompt_msg){
    echo("<script type='text/javascript'> var answer = prompt('".$prompt_msg."'); </script>");

    $answer = "<script type='text/javascript'> document.write(answer); </script>";
    return($answer);
}
?>