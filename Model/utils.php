<?php 
//David Buesa

/**
 * netejarData - Funció que neteja les dades que li arriben per paràmetr
 * @param  mixed $data 
 * @return $data data netejada
 */
function netejarData($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>