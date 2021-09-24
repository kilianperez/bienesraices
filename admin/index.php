<?php 
    require '../includes/funciones.php';
    //iniciar session
    $auth = estaAutenticado();
    if (!$auth) {
        header('Location: /');
    }

    //Importar la conexión
    require '../includes/config/database.php';
    $db = conectarDB();

    // Escribir el query
    $query = "SELECT * FROM propiedades";

    // Consulta a la BBDD 
    $resultadoConsulta = mysqli_query($db, $query);

    // eliminar propidad de la BBDD 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if ($id) {
            //eliminar imagen 
            $query = "SELECT imagen FROM propiedades WHERE id = ${id}";
            $resultado = mysqli_query($db, $query);
            $propiedad = mysqli_fetch_assoc($resultado);
            echo $query;
            // exit;
            unlink('../imagenes/'.$propiedad['imagen']);

            // exit;
            // eliminar propiedad
            $query = "DELETE FROM propiedades WHERE id = ${id}";
            $resultado = mysqli_query($db, $query);
            if ($resultado) {
                header('Location: /admin?resultado=3');
            }
        }
    }

    // Mostrar mensaje 
    $resultado = $_GET['resultado'] ?? null;
    // Incluir el temaplate

    incluirTemplate('header');
?>
    <main class="contenedor">
        <h1>Administrador Bienes Raíces</h1>
        <?php 
        // intval nos da valor entero y no string 
        if (intval($resultado) === 1): ?>
        <p class="alerta exito">Anuncio Creado Correctamente</p>

        <?php elseif (intval($resultado) === 2): ?>
        <p class="alerta exito">Anuncio Actualizado Correctamente</p>
        <?php elseif (intval($resultado) === 3): ?>
        <p class="alerta exito">Eliminado Correctamente</p>
        <?php endif ?>
        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
    </main>
    
    <table class="propiedades contenedor">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precios</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($propiedad = mysqli_fetch_assoc($resultadoConsulta)) : ?>
            <tr>
                <td class="propiedades__id"><?=$propiedad['id']?></td>
                <td><?=$propiedad['titulo']?></td>
                <td><img src="/imagenes/<?=$propiedad['imagen']?>" class="imagen-tabla" alt=""></td>
                <td class="propiedades__precio"><?=$propiedad['precio']?> €</td>
                <td>
                    <form method="POST" class="w-100">
                        <input type="hidden" name="id" value="<?= $propiedad['id'] ?>">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    <a href="/admin/propiedades/actualizar.php?id=<?=$propiedad['id']?>" class="boton-amarillo-block">Actualizar</a>
                </td>
            </tr>
        </tbody>
            <?php  endwhile; ?>
    </table>
        
<?php

    // Cerrar la conexión a la BBDD 
    mysqli_close($db);
    incluirTemplate('footer');
?>
