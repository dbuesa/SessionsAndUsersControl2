<?php
//David Buesa

session_start();
session_destroy();

echo '<script>alert("Fins aviat!");</script>';

header("refresh:0.01, url=../index.php");

?>