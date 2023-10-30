<?php 
//David Buesa

session_start();

if(!isset($_SESSION['username'])){
    require "Model/articles.php";

    $articlesPerPagina = intval(articles());

    $pagina = 1;

    if (isset($_GET["pagina"])) {
        $pagina = intval($_GET["pagina"]);
    }

    $pagines = contarPagines($articlesPerPagina);

    $limit = $articlesPerPagina;
    $offset = ($pagina - 1) * $articlesPerPagina;

    $articles = llistarArticles($limit, $offset);



    $list = "<ul>";

    foreach ($articles as $article) {
        $list .= "<li>{$article->article_id} - {$article->descripcio}</li>";
    }
    $list .= "</ul>";

    
    include 'Vista/index.vista.php';

}else{
    require "Model/articlesUsuari.php";

    $articlesPerPagina = intval(articles());

    $pagina = 1;

    if (isset($_GET["pagina"])) {
        $pagina = intval($_GET["pagina"]);
    }

    $pagines = contarPagines($articlesPerPagina);

    $limit = $articlesPerPagina;
    $offset = ($pagina - 1) * $articlesPerPagina;

    $articles = llistarArticlesUsuari($limit, $offset);


    $list = "<ul>";

    foreach ($articles as $article) {
        $list .= "<li>{$article->article_id} - {$article->descripcio}</li>";
    }
    $list .= "</ul>";

    
    include 'Vista/vistaUsuari.php';
}
    

?>