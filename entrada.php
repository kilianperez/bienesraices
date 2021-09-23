<?php 
require 'includes/funciones.php';
incluirTemplate('header');
?>

		<main class="contenedor seccion contenido-centrado">
			<h1>Guía para la decoración de tu hogar</h1>
			<picture>
                <source srcset="build/img/destacada2.webp" type="image/webp" />
				<source srcset="build/img/destacada2.jpg" type="image/jpeg" />
				<img loading="lazy" src="build/img/destacada2.jpg" alt="imagen de la propiedad" />
			</picture>
            <p class="informacion-meta">Publicado el: <span>20/10/2021</span> por <span>Admin</span></p>
			<div class="resumen-propiedad">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A unde nobis, fugit asperiores ipsa quod fuga eaque maiores alias. Delectus nobis aut, voluptatem aperiam ipsum tempore rerum modi optio exercitationem.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A unde nobis, fugit asperiores ipsa quod fuga eaque maiores alias. Delectus nobis aut, voluptatem aperiam ipsum tempore rerum modi optio exercitationem.</p>
			</div>
		</main>
<?php incluirTemplate('footer'); ?>