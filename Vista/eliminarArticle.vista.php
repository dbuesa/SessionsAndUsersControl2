<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">  
	<link rel="stylesheet" href="../Estils/estils.css"> <!-- feu referència al vostre fitxer d'estils -->
	<title>Eliminar article</title>
</head>
<body>
	<header>
		<div>
			<form action="../Model/tancarConn.php" >
				<input type="submit" value="Tancar sessió">

			</form>
		</div>
	</header>

	<div class="contenidor">
		<h1>Elimina un article</h1>
            <div class="button-container">
                <a href="../index.php">Tornar</a>
            </div>
			<div>
				
			</div>
	</div>
    <br>
    <div class="button-container">
		<form action="../Controlador/controlarAccionsUsuaris.php" method="POST">
			<div>
				<p style="color:red;">Introdueix l'ID de l'article que desitjes eliminar: </p><br>
			</div>
			<div class="txa">
				<input type="number" id="id" name="id" min="1" >
			</div>
			<br>
			<?php
				if (!empty($errors)) {
					echo '<ul>';
					foreach ($errors as $error) {
						echo '<li>' .  $error . "</li>";
					}
					echo '</ul>';
				}
			?>
			<br>
			<input class="green-button" type="submit" name="eliminarArticle" value="Eliminar article">
		</form>
	</div>
</body>
</html>