<?php 
require 'includes/funciones.php';
incluirTemplate('header');
?>

		<main class="contenedor">
			<h1>Conoce sobre Nosotros</h1>
			<div class="contenido-nosotros">
				<div class="imagen">
					<picture>
						<source srcset="build/img/nosotros.webp" type="image/webp" />
						<source srcset="build/img/nosotros.jpg" type="image/jpeg" />
						<img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros" />
					</picture>
				</div>
				<div class="texto-nosotros">
					<blockquote>25 Años de Experiencia</blockquote>
					<p>
						Lorem ipsum dolor, sit amet consectetur adipisicing elit. Maxime praesentium est
						corporis aliquid, asperiores molestias quam! Provident, totam. Libero blanditiis
						earum nulla reprehenderit ab inventore in! Quaerat dolores laboriosam incidunt?
					</p>
					<p>
						Lorem ipsum dolor, sit amet consectetur adipisicing elit. Maxime praesentium est
						corporis aliquid, asperiores molestias quam! Provident, totam. Libero blanditiis
						earum nulla reprehenderit ab inventore in! Quaerat dolores laboriosam incidunt?
					</p>
				</div>
			</div>
		</main>
		<section class="contenedor seccion">
			<h1>Más Sobre Nosotros</h1>
			<div class="iconos-nosotros">
				<div class="icono">
					<img src="build/img/icono1.svg" alt="Icono Seguridad" loading="lazy" />
					<h3>Seguridad</h3>
					<p>
						Lorem, ipsum dolor sit amet consectetur adipisicing elit. Adipisci quae reiciendis
						architecto, placeat tenetur distinctio aspernatur dolores aut quo repellendus
						beatae vel, nostrum ducimus exercitationem. Perferendis ducimus nobis eaque
						placeat.
					</p>
				</div>
				<div class="icono">
					<img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy" />
					<h3>Precio</h3>
					<p>
						Lorem, ipsum dolor sit amet consectetur adipisicing elit. Adipisci quae reiciendis
						architecto, placeat tenetur distinctio aspernatur dolores aut quo repellendus
						beatae vel, nostrum ducimus exercitationem. Perferendis ducimus nobis eaque
						placeat.
					</p>
				</div>
				<div class="icono">
					<img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy" />
					<h3>A Tiempo</h3>
					<p>
						Lorem, ipsum dolor sit amet consectetur adipisicing elit. Adipisci quae reiciendis
						architecto, placeat tenetur distinctio aspernatur dolores aut quo repellendus
						beatae vel, nostrum ducimus exercitationem. Perferendis ducimus nobis eaque
						placeat.
					</p>
				</div>
			</div>
		</section>
<?php incluirTemplate('footer'); ?>

