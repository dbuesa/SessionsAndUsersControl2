<?php 
//David Buesa

session_start();

if(!isset($_SESSION['username'])){ //Si no hi ha sessió iniciada, es redirigeix a la pàgina de login per a que s'inicii sessió o es registri l'usuari 
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
    $username= $_SESSION['username']; //Si hi ha sessió iniciada, es redirigeix a la pàgina de l'usuari per a que pugui veure els articles que ha creat i pugui crear-ne de nous, modificar o eliminar els que ja té creats.

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