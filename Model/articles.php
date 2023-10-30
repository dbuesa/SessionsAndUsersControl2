<?php
//David Buesa

if(isset($_SESSION['username'])){
    session_start();
}

/**
 * Funció que retorna el nombre d'articles per pàgina
 * @return articlesPerPagina nombre d'articles per pàgina
 */
function articles(){
    if (isset($_GET['opcions'])) {
        $_SESSION['articlesPerPagina'] = $_GET['opcions']; 
    } else {
       
        $_SESSION['articlesPerPagina'] = isset($_SESSION['articlesPerPagina']) ? $_SESSION['articlesPerPagina'] : 50;
    }
    return $_SESSION['articlesPerPagina'];
}

/**
 * Funció que retorna la pàgina actual
 * @param limit nombre d'articles per pàgina
 * @param offset nombre d'articles a saltar
 * @return pagina pàgina actual
 */
function llistarArticles($limit, $offset) {
    require "connexio.php";

    $stmt = $conn->prepare("SELECT * FROM articles LIMIT ? OFFSET ?");
    $stmt->execute([$limit, $offset]);
    $articles = $stmt->fetchAll(PDO::FETCH_OBJ);

    return $articles;
}

/**
 * Funció que retorna tots els articles
 * @return articles tots els articles
 */
function llistarTotsArticles(){
    require "connexio.php";

    $stmt = $conn->query("SELECT * FROM articles");
    $articles = $stmt->fetchAll(PDO::FETCH_OBJ);

    return $articles;
}

/**
 * Funció que retorna el nombre de pàgines
 * @param articlesPerPagina nombre d'articles per pàgina
 * @return pagines nombre de pàgines
 */
function contarPagines($articlesPerPagina){
    require "connexio.php";
    $stmt = $conn->query("SELECT count(*) AS count FROM articles");
    $count = $stmt->fetchObject()->count;

    $pagines = ceil($count / $articlesPerPagina);

    return $pagines;
}
?>