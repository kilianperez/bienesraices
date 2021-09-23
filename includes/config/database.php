<?php

function conectarDB(){
    $db = mysqli_connect('localhost', 'root', '', 'bienes_raices' );
    $db->set_charset('utf8');
    if (!$db) {
        echo 'error conexión bbdd';
        exit;
    }
    
    return $db;
}