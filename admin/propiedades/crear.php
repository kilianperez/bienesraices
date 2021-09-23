<?php 
require '../../includes/config/database.php';
$db = conectarDB();


// consultar para obtener vendedores 
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);
    $titulo = '';
    $precio = '';
    // $imagen = '';
    $descripcion = '';
    $habitaciones = '';
    $wc = '';
    $estacionamiento = '';
    $vendedorId = '';
    // echo '<pre>';
    // informacion der servidor 
    // var_dump($_SERVER);
    // echo '</pre>';

// Array mensajes de error 
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // echo '<pre>';
    // // informacion de los post
    // var_dump($_POST);
    // echo '</pre>';

    // echo '<pre>';
    // informacion de los archivos
    // var_dump($_FILES);
    // echo '</pre>';

    // exit;


    // Sanitizar 
    //  mysqli_real_escape_string evita la inyección de SQL en el formulario (cross site scripting) 


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
    // php limita el tamaño de subuda de las imagenes a 2MG, ver en $_FILES ['error]
    if (!$imagen['name'] || $imagen['error']) {
        $errores[] = 'La imagen es obligatoria';
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
        $carpetaImagenes = '../../imagenes';

        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);

        }
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

        // exit;
        $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedorId) VALUES ('$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedorId')";
        // echo $query;
        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            // echo 'insertado correctamente';
            
            // redireccionar al usuario
            header('Location: /admin?resultado=1');
        }
    }
}
require '../../includes/funciones.php';
incluirTemplate('header');
?>
<main class="contenedor">
    <h1>Crear</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>
    <?php foreach ($errores as $error): ?>
    <div class="alerta error">
        <?= $error ?>
    </div>
    <?php endforeach; ?>
    <form action="/admin/propiedades/crear.php" method="POST" class="formulario" enctype="multipart/form-data">
        <fieldset>
            <legend>Información General</legend>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="titulo" value="<?= $titulo ?>" placeholder="Titulo Propiedad">


            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" value="<?= $precio ?>" placeholder="Precio Propiedad">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen" value="<?= $imagen ?>" accept="image/jpeg, image/png">

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
        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>
<?php incluirTemplate('footer'); ?>