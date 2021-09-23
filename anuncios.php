<?php 
require 'includes/funciones.php';
incluirTemplate('header');
?>

	<main class="contenedor">
		<h2>Casas y Pisos en Venta</h2>
		<div class="contenedor-anuncios">
		<?php 
			$limite 	= 10;
			$textoCorto = true;
			include 'includes/templates/anuncios.php' 
		?>
		</div>
	</main>
<?php incluirTemplate('footer'); ?>