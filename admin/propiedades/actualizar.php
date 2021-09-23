<?php 

	// validar la url 
	$id = $_GET['id'];
	$id = filter_var($id, FILTER_VALIDATE_INT);

	if (!$id) {
		header('Location: /admin');
	}

	require '../../includes/config/database.php';
	$db = conectarDB();
	



	// Obtener los datos de la propiedad 
	$consulta = "SELECT * FROM propiedades WHERE id = ${id}";
	$resultado = mysqli_query($db, $consulta);
	// retornar un array con los resultados
	// var_dump( $resultado);
	$propiedad = mysqli_fetch_assoc($resultado);

	// consultar para obtener vendedores 
	$consulta = "SELECT * FROM vendedores";
	$resultado = mysqli_query($db, $consulta);
    $titulo = $propiedad['titulo'];
    $precio = $propiedad['precio'];
    $descripcion = $propiedad['descripcion'];
    $habitaciones = $propiedad['habitaciones'];
    $wc = $propiedad['wc'];
    $estacionamiento = $propiedad['estacionamiento'];
    $vendedorId = $propiedad['vendedorId'];
    $imagenPropiedad = $propiedad['imagen'];

// Array mensajes de error 
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titulo = mysqli_real_escape_string( $db, $_POST['titulo']);
    $precio = mysqli_real_escape_string( $db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string( $db, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string( $db, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string( $db, $_POST['wc']);
    $estacionamiento = mysqli_real_escape_string( $db, $_POST['estacionamiento']);
    $vendedorId = mysqli_real_escape_string( $db, $_POST['vendedor']);
    $creado = date('Y/m/d');

    $imagen = $_FILES['imagen'];
    
    // exit; 

    if (!$titulo) {
        $errores[] = 'Debes añadir un titulo';
    }
    if (!$precio) {
        $errores[] = 'El precio es obligatorio';
    }
    if (strlen( $descripcion) < 50 )  {
        $errores[] = 'La descripción es obligatorio y debe tener al menos 50 caracteres';
    }
    if (!$habitaciones) {
        $errores[] = 'El numero de habitaciones es obligatorio';
    }
    if (!$estacionamiento) {
        $errores[] = 'El numero de aparcamientos es obligatorio';
    }
    if (!$wc) {
        $errores[] = 'El numero de baños es obligatorio';
    }
    if (!$vendedorId) {
        $errores[] = 'Elige un vendedor';
    }
    // Validar por tamaño (1mb máximo)
    $medida = 1000 * 1000;
    if($imagen['size'] > $medida ) {
        $errores[] = 'Reduce el tamaño de la imagen, máximo 1MB';
    }



    // insertar en la bbdd 
    // revisar que el array este vacio 
    if (empty($errores)) {
        // crear carpeta 

        $carpetaImagenes = '../../imagenes/';

        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
        }

        $nombreImagen = '';
        
        if ($imagen['name']) {
            // eliminar la imagen antigua
            unlink($carpetaImagenes . $propiedad['imagen']);
            echo $propiedad['imagen'];
            // exit;
            // Generar un nombre único
            $nombreImagen = md5(uniqid(rand(), true));
        
            //Obtener la extensión del archivo
            $imgType = $imagen['type'];
            $extension = explode('/', $imgType); //esto da un array 
            // con el nombre extension. Se debe acceder a la posición [1] para obtener la extensión del archivo.        
        
            // concatenar nombre y extension 
            $nombreImagen .=".".$extension[1];
        
            // Subir la imagen
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . '/' . $nombreImagen);

        }else{
            $nombreImagen = $propiedad['imagen'];
        }


        // exit;
        $query = "UPDATE propiedades SET titulo = '${titulo}', precio = '${precio}', imagen = '${nombreImagen}', descripcion = '${descripcion}', habitaciones = ${habitaciones},wc = ${wc}, estacionamiento = ${estacionamiento}, vendedorId = ${vendedorId}  WHERE id = ${id}";
        // echo $query;
        $resultado = mysqli_query($db, $query);

        // echo $query;
        // exit; 

        if ($resultado) {
            // echo 'insertado correctamente';
            
            // redireccionar al usuario
            header('Location: /admin?resultado=2');
        }
    }
}
	require '../../includes/funciones.php';
	incluirTemplate('header');
?>
<main class="contenedor">
    <h1>Actualizar Propiedad</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>
    <?php foreach ($errores as $error): ?>
    <div class="alerta error">
        <?= $error ?>
    </div>
    <?php endforeach; ?>
    <form method="POST" class="formulario" enctype="multipart/form-data">
        <fieldset>
            <legend>Información General</legend>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="titulo" value="<?= $titulo ?>" placeholder="Titulo Propiedad">


            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" value="<?= $precio ?>" placeholder="Precio Propiedad">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen" value="<?= $imagen ?>" accept="image/jpeg, image/png">
            <img src="/imagenes/<?=$imagenPropiedad ?>" class="imagen-small">
            <label for="descripcion">descripción</label>
            <textarea id="descripcion" name="descripcion"><?= $descripcion ?></textarea>

        </fieldset>
        <fieldset>
            <legend>Información Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="habitaciones" value="<?= $habitaciones ?>" placeholder="Ej: 3"
                min="1" max="15">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" name="wc" value="<?= $wc ?>" placeholder="Ej: 3" min="1" max="15">

            <label for="estacionamiento">Aparcamiento:</label>
            <input type="number" id="estacionamiento" name="estacionamiento" value="<?= $estacionamiento ?>"
                placeholder="Ej: 3" min="0" max="15">

        </fieldset>
        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedor">
                <option value="">--Seleccione--</option>

                <?php 
                // row son los vendedores, recomendable usar la palabra row 
                    while ($row = mysqli_fetch_assoc($resultado) ): ?>
                <option <?= $vendedorId === $row['id'] ? 'selected' : '' ?> value="<?= $row['id']?>">
                    <?= $row['nombre'] . " " . $row['apellido'] ?></option>
                <?php endwhile; ?>
            </select>

        </fieldset>
        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
    </form>
</main>
<?php incluirTemplate('footer'); ?>