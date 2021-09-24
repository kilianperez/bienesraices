<?php 
require 'includes/config/database.php';
$db = conectarDB();

$errores = [];

// ver los resultados del post 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// echo '<pre>';
	// var_dump($_POST);
	// echo '</pre>';
	// autenticar el usuario

	$email = mysqli_real_escape_string($db, filter_var( $_POST['email'],FILTER_VALIDATE_EMAIL));
	$password = mysqli_real_escape_string($db, $_POST['password']);

	if(!$email){
		$errores[] = 'El email es obligatorio o no es válido';
	}
	if(!$password){
		$errores[] = 'El password es obligatorio';
	}
	if (empty($errores)) {
		// revisar que el usuario existe en la BBDD 
		$query = "SELECT * FROM usuarios WHERE email = '${email}'";
		$resultado = mysqli_query($db, $query);
		// echo '<pre>';
		// var_dump($resultado);
		// echo '</pre>';
			// exit;
		if ($resultado->num_rows) {
			// Revisar si existe password 
			$usuario = mysqli_fetch_assoc($resultado);
			// verificar si el password es correcto o no
			$auth = password_verify($password, $usuario['password']);
			// var_dump($auth);
			if ($auth) {
				// el usuario es valido
				session_start();

				// llenar el array de la session  

				$_SESSION['usuario'] = $usuario['email'];
				$_SESSION['login'] = true;

				header('Location: /admin');

			} else {
				$errores[] = 'La password es incorrecto';
			}
			
		} else {
			$errores[]= 'El usuario no existe';
		}
	}


	
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
