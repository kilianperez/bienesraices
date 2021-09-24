<?php 
require 'includes/config/database.php';
$db = conectarDB();

$errores = [];

// ver los resultados del post 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	echo '<pre>';
	var_dump($_POST);
	echo '</pre>';
	// autenticar el usuario

	$email = mysqli_real_escape_string($db, filter_var( $_POST['email'],FILTER_VALIDATE_EMAIL));
	$password = mysqli_real_escape_string($db, $_POST['password']);

	if(!$email){
		$errores[] = 'El email es obligatorio o no es válido';
	}
	if(!$password){
	$errores[] = 'El password es obligatorio';
	}
	echo '<pre>';
	var_dump($errores);
	echo '</pre>';
}


// incluye el header 
require 'includes/funciones.php';
incluirTemplate('header');
?>

	<main class="contenedor seccion contenido-centrado">
		<h1>Iniciar Sesión</h1>
		<?php foreach ($errores as $error ):?>
			<div class="alerta error">
				<?= $error ?>
			</div>
		<?php endforeach ?>
		<form method="POST" class="formulario">
			<fieldset>
				<legend>Email y Password</legend>

				<label for="email">Email</label>
				<input type="email" name="email" id="email" placeholder="Tu Email" required />

				<label for="password">Password</label>
				<input type="password" name="password" id="password" placeholder="Tu Password" required/>

			</fieldset>
			<input type="submit" value="Iniciar Sesión" class="boton boton-verde">
		</form>
	</main>
<?php incluirTemplate('footer'); ?>