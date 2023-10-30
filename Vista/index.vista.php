<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">  
	<link rel="stylesheet" href="Estils/estils.css"> <!-- feu referència al vostre fitxer d'estils -->
	<title>Paginació</title>
</head>
<body>

	<header>
		<div>
			<form action="Model/login.php">
				<input type="submit"  value="Iniciar sessió">
			</form>
			<form action="Controlador/controlarRegistre.php">
                <input type="submit" name="signup_login" value="Registrar-se">
            </form>
		</div>
	</header>


	<div class="contenidor">
		<h1>Articles</h1>
		<section class="articles"> <!--aqui guardem els articles-->
			<?php echo $list ?>
		</section>


		<form method="get" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
			<select name="opcions" id="opcions" onchange="this.form.submit()">
				<option value="5" <?php if ($articlesPerPagina == 5) echo "selected"; ?>></option>
				<option value="5" <?php if ($articlesPerPagina == 5) echo "selected"; ?>>5</option>
				<option value="8" <?php if ($articlesPerPagina == 8) echo "selected"; ?>>8</option>
				<option value="10" <?php if ($articlesPerPagina == 10) echo "selected"; ?>>10</option>
				<option value="15" <?php if ($articlesPerPagina == 15) echo "selected"; ?>>15</option>
			</select>
		</form>


		
		<section class="paginacio">
			<ul>
				<?php if ($pagina > 1) : ?>
					<li><a href="?pagina=<?= $pagina - 1 ?>">&laquo;</a></li> 
				<?php endif; ?>
				<?php for ($i = 1; $i <= $pagines; $i++) : ?>
					<li class="<?= ($pagina == $i) ? 'active' : ''; ?>"><a href="?pagina=<?= $i ?>"><?= $i ?></a></li>
				<?php endfor; ?>
				<?php if ($pagina < $pagines) : ?>
					<li><a href="?pagina=<?= $pagina + 1 ?>">&raquo;</a></li>
				<?php endif; ?>
			</ul>
		</section>




	</div>
</body>
</html>