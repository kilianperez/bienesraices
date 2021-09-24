<?php
    session_start();

    // session_destroy(); // esta es una de las formas usadas, pero mejor reset a las session

    $_SESSION = [];
    
    header('Location: /');