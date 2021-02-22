<?php
require_once 'config/configurar.php';

/* require_once 'libraries/Base.php';
require_once 'libraries/Controlador.php';
require_once 'libraries/Core.php'; */
//Autoload php
spl_autoload_register(function($nombreClase){
    require_once 'libraries/'.$nombreClase.'.php';
});
?>