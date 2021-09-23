<?php 
require 'includes/funciones.php';
incluirTemplate('header');
?>

		<main class="contenedor">
			<h1>Contacto</h1>
			<picture>
				<source srcset="build/img/destacada3.webp" type="image/webp" />
				<source srcset="build/img/destacada3.jpg" type="image/jpeg" />
				<img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen Contacto" />
			</picture>
			<h2>Complete el formulario de Contacto</h2>
			<form action="" class="formulario">
				<fieldset>
					<legend>Información Personal</legend>

					<label for="nombre">Nombre</label>
					<input type="text" name="nombre" id="nombre" placeholder="Tu Nombre" />

					<label for="email">Email</label>
					<input type="email" name="email" id="email" placeholder="Tu Email" />

					<label for="telefono">Teléfono</label>
					<input type="tel" name="telefono" id="telefono" placeholder="Tu Teléfono" />

					<label for="mensaje">Mensaje</label>
					<textarea name="mensaje" id="mensaje" placeholder="Tu mensaje"></textarea>
				</fieldset>
				<fieldset>
					<legend>Informacion sobre la propiedad</legend>
					<label for="opciones">Vende o Compra:</label>
					<select name="opciones" id="opciones">
						<option value="" disabled selected>-- Seleccione --</option>
						<option value="Compra">Compra</option>
						<option value="Vende">Vende</option>
					</select>

					<label for="presupuesto">Precio o Presupuesto</label>
					<input
						type="number"
						name="presupuesto"
						id="presupuesto"
						placeholder="Tu Precio o Presupuesto"
					/>
				</fieldset>
				<fieldset>
					<legend>Contacto</legend>
					<p>¿Cómo desea ser contactado</p>
					<div class="forma-contacto">
						<label for="contactar-telefono">Teléfono</label>
						<input type="radio" name="contacto" value="telefono" id="contactar-telefono" />

						<label for="contactar-email">Email</label>
						<input type="radio" name="contacto" value="email" id="contactar-email" />
					</div>

					<p>Si eligió teléfono escoja fecha y hora</p>

					<label for="fecha">Fecha</label>
					<input type="date" name="fecha" id="fecha"/>

					<label for="hora">Hora</label>
					<input type="time" name="hora" id="hora" min="09:00" max="18:00"/>
				</fieldset>

				<input type="submit" value="Enviar" class="boton-verde">
			</form>
		</main>
<?php incluirTemplate('footer'); ?>