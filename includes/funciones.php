<?php
require 'app.php';

function incluirTemplate(string $nombre,bool $inicio = false){
    include TEMPLATES_URL . "/${nombre}.php";
}

function estaAutenticado() : bool{
    // iniciar la sesion del usuario 
    session_start();
    // echo '<pre>';
    // var_dump($_SESSION);
    // echo '</pre>';
    $auth = $_SESSION['login'];
    if ($auth) {
        return true;
    }
    return false;
}