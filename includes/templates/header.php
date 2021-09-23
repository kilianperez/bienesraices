<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Bienes Raíces</title>
		<link rel="stylesheet" href="/build/css/app.css" />
		<script src="/build/js/bundle.min.js"></script>
	</head>
	<body>
        <header class="header <?= $inicio ? 'inicio' : ''; ?>">
            <div class="contenedor contenido-header">
                <div class="barra">
                    <a href="/">
                        <img src="/build/img/logo.svg" alt="Logotipo Bienes Raíces" />
                    </a>
                    <div class="mobile-menu">
                        <img src="/build/img/barras.svg" alt="icono menu responsive" />
                    </div>
                    <div class="derecha">
                        <nav class="navegacion">
                            <a href="/nosotros.php">Nosotros</a>
                            <a href="/anuncios.php">Anuncios</a>
                            <a href="/blog.php">Blog</a>
                            <a href="/contacto.php">Contacto</a>
                        </nav>
                        <img
                            src="/build/img/dark-mode.svg"
                            alt="icono modo oscuro"
                            class="dark-mode-boton"
                        />
                    </div>
                </div>
                <?= $inicio ? '<h1>Venta de Casas y Pisos Exclusivos de Lujo</h1>' : ''; ?>
            </div>
        </header>