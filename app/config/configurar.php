<?php 
//configuracion de acceso de base de datos
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','bdmyf');

//ruta de la aplicacion
define('RUTA_APP', dirname(dirname(__FILE__)));

//ruta url
define('BASE_URL', 'http://'.$_SERVER['HTTP_HOST'].'/sistema-myf');

define('NOMBRE_SITIO', '_NOMBRE_SITIO');

//PARA VALIDAR SI LA PETICION VIENE POR AJAX
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');