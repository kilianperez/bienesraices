<?php 
    // importar la conexion bbdd
    require __DIR__.'/../config/database.php';
    $db = conectarDB();
    // consultar 
    $query = "SELECT * FROM propiedades LIMIT ${limite}";
    // obtener el resultado 
    $resultado = mysqli_query($db,$query);

    
?>


<?php 

while ($propiedad = mysqli_fetch_assoc($resultado)):?>
<div class="anuncio">
    <img loading="lazy" src="/imagenes/<?= $propiedad['imagen'] ?>" alt="anuncio" />
    <div class="contenido-anuncio">
        <h3><?= $propiedad['titulo'] ?></h3>
        <p><?php
        if(!empty($textoCorto)) {
            echo substr($propiedad['descripcion'],0, 100) . '...';
        }else{
            echo $propiedad['descripcion'];
        }
         ?></p>
        <p class="precio"><?= $propiedad['precio'] ?>€</p>
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" src="build/img/icono_wc.svg" alt="icono wc" />
                <p><?= $propiedad['wc'] ?></p>        
            </li>
            <li>
                <img class="icono" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento" />
                <p><?= $propiedad['estacionamiento'] ?></p>
            </li>
            <li>
                <img class="icono" src="build/img/icono_dormitorio.svg" alt="icono habitaciones" />
                <p><?= $propiedad['habitaciones'] ?></p>
            </li>
        </ul>
        <a href="anuncio.php?id=<?=$propiedad['id']?>" class="boton boton-amarillo-block">Ver Propiedad</a>
    </div>
</div>
<?php endwhile; ?>
<?php
// cerrar la conexión 
    mysqli_close($db);
?>