<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">  
	<link rel="stylesheet" href="../Estils/estils.css"> <!-- feu referència al vostre fitxer d'estils -->
	<title>Editar article</title>
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
		<h1>Modifica un article</h1>
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
				<p style="color:red;">Introdueix l'ID de l'article que desitjes modificar (s'ha de mostrar abans): </p><br>
			</div>
			<div class="txa">
				<input type="number" id="id" name="id" min="1" value="<?php echo isset($_POST['id']) ? $_POST['id'] : ''; ?>" required/><br><br>
				<?php
					if (!empty($errors)) {
						echo '<ul>';
						foreach ($errors as $error) {
							echo '<li>' .  $error . "</li>";
						}
						echo '</ul>';
						echo '<br>';
					}
				?>
				<input class="green-button" type="submit" name="mostrarArticle" value="Mostrar article">
			</div>
			<br>
			<?php
				if (!empty($article)) {
					echo '<h3>Article original:</h3> ';
					echo '<ul>';
					foreach ($article as $arti) {
						echo '<li>' .  $arti . "</li>";
					}
					echo '</ul>';
				}
			?>
			<br>
			<textarea style="width: 50%;" name="modificacio" id="modificacio" cols="30" rows="10" placeholder="BackEnd es una..."></textarea><br>
			<?php
					if (!empty($errors2)) {
						echo '<ul>';
						foreach ($errors2 as $error) {
							echo '<li>' .  $error . "</li>";
						}
						echo '</ul>';
						echo '<br>';
					}
				?>
			<input class="green-button" type="submit" name="editarArticle" value="Modificar article">
		</form>
	</div>
</body>
</html>