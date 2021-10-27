<?php 
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);
if (!$id) {
	header('Location: /');
}

// importar la conexion bbdd
require 'includes/config/database.php';
$db = conectarDB();
// consultar 
$query = "SELECT * FROM propiedades WHERE id=${id}";
// obtener el resultado 
$resultado = mysqli_query($db,$query); 
$propiedad = mysqli_fetch_assoc($resultado);

// validar que exista el id 
if (!$resultado->num_rows) {
	header('Location: /');
}
require 'includes/funciones.php';
incluirTemplate('header');
?>

		<main class="contenedor seccion contenido-centrado">
			<h1><?= $propiedad['titulo'] ?></h1>
			<img loading="lazy" src="/imagenes/<?=$propiedad['imagen']?>" alt="imagen de la propiedad" />
			<div class="resumen-propiedad">
				<p class="precio">3.000.000 €</p>
				<ul class="iconos-caracteristicas">
					<li>
						<img  class="icono" src="build/img/icono_wc.svg" alt="icono wc" />
						<p><?=$propiedad['wc']?></p>
					</li>
					<li>
						<img  class="icono" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento" />
						<p><?=$propiedad['estacionamiento']?></p>
					</li>
					<li>
						<img  class="icono" src="build/img/icono_dormitorio.svg" alt="icono habitaciones" />
						<p><?=$propiedad['habitaciones']?></p>
					</li>
				</ul>
                <p><?=$propiedad['descripcion']?></p>
                
			</div>
		</main>
<?php 
mysqli_close($db);
incluirTemplate('footer'); 
?>
