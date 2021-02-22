<?php
//PARA COMPARTIR
if(isset($datos['producto_det'])){
	$share_idpro   = $datos['producto_det']['idproducto'];
	$share_nom     = $datos['producto_det']['nombre'];
	$share_desc    = $datos['producto_det']['descripcion'];
	$share_img     = $datos['producto_det']['imagen'];
	$share_img_sm  = $datos['producto_det']['imagen_small'];
	$share_cod     = $datos['producto_det']['codigo'];
	$share_cate    = $datos['producto_det']['categoria'];
	$share_ruta    = BASE_URL."/public/img/products/$share_idpro/$share_img";
	$share_ruta_sm = BASE_URL."/public/img/products/$share_idpro/$share_img_sm";
	$share_logo    = BASE_URL."/public/img/logo/logo-m-y-f-200.jpg";
	$share_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
}else{
	$share_idpro   = "";
	$share_nom     = "Detalles M y F";
	$share_desc    = "Encuentra los más bonitos detalles para cumpleaños, fiestas, aniversarios, etc. Siempre los mejores detalles lo encontrarás aquí.";
	$share_img     = "";
	$share_img_sm  = "";
	$share_cod     = "";
	$share_cate    = "";
	$share_ruta    = BASE_URL."/public/img/logo/logo-m-y-f-200.jpg";
	$share_ruta_sm = BASE_URL."/public/img/logo/logo-m-y-f-200.jpg";;
	$share_logo    = BASE_URL."/public/img/logo/logo-m-y-f-200.jpg";;
	$share_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $datos['title']?></title>
    <!--=====================================
	Marcado HTML
	======================================-->
    <meta name="title" content="M y F">
	<meta name="description" content="Detalles que eneamoran">
	<meta name="keyword" content="regalos, detalles, amor, enamoran, amor, m y f">
    <!--=====================================
	Marcado de Open Graph FACEBOOK
	======================================-->
	<meta property="og:title"   content="<?php echo $share_nom?>">
	<meta property="og:url" content="<?php echo $share_url?>">
	<meta property="og:description" content="<?php echo $share_desc?>">
	<meta property="og:image"  content="<?php echo $share_ruta?>">
	<meta property="og:type"  content="website">	
	<meta property="og:site_name" content="Detalles M y F">
	<meta property="og:locale" content="es_PE">
    <!--=====================================
	Marcado para DATOS ESTRUCTURADOS GOOGLE
	======================================-->	
	<meta itemprop="name" content="<?php echo $share_nom?>">
	<meta itemprop="url" content="<?php echo $share_url?>">
	<meta itemprop="description" content="<?php echo $share_desc?>">
	<meta itemprop="image" content="<?php echo $share_ruta?>">
	<!--=====================================
	Marcado de TWITTER
	======================================-->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="<?php echo $share_nom?>">
	<meta name="twitter:url" content="<?php echo $share_url?>">
	<meta name="twitter:description" content="<?php echo $share_desc?>">
	<meta name="twitter:image" content="<?php echo $share_ruta?>">
	<meta name="twitter:site" content="@tu-usuario">

	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo BASE_URL?>/public/img/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo BASE_URL?>/public/img/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASE_URL?>/public/img/favicon/favicon-16x16.png">
	<link rel="manifest" href="<?php echo BASE_URL?>/public/img/favicon/site.webmanifest">
	
	<link rel="stylesheet" href="<?php echo BASE_URL?>/public/libs/bootstarp5.0.0-beta2/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo BASE_URL?>/public/css/styles.css">
	<!-- iconos font -->
	<script src="https://kit.fontawesome.com/6bea3db884.js" crossorigin="anonymous"></script>

	<script src="<?php echo BASE_URL?>/public/js/jquery-3.5.1.js"></script>

</head>
<body>
    <div class="contenedor">
		<header class="header">
			<div class="container">
				<div class="row top">
					<div class="col-sm-6 d-flex align-items-center redes">
						<a href="#">
							<i class="fa fa-facebook"></i>
						</a>
						<a href="#">
							<i class="fa fa-twitter"></i>
						</a>
						<!-- <a href="#">
							<i class="fa fa-youtube"></i>
						</a> -->
						<a href="#">
							<i class="fa fa-instagram"></i>
						</a>
					</div>
					<div class="col-sm-6 d-flex align-items-center justify-content-end inout">
						<!-- <a href="#">
							Ingresar
						</a> | 
						<a href="#">
							Crear Cuenta
						</a> -->
					</div>
				</div>
			</div>
		</header>
		<nav class="navbar navbar-expand-md navbar-light bg-white">
			<div class="container">
			  <a class="navbar-brand" href="<?php echo BASE_URL?>"><img src="<?php echo BASE_URL?>/public/img/logo/logo-m-y-f-200.jpg" alt="mi-logo" class="logo img-fluid"></a>
			  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			  </button>
			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				  <li class="nav-item">
					<a class="nav-link" aria-current="page" href="<?php echo BASE_URL?>"><i class="fas fa-home"></i> Inicio</a>
				  </li>
				  <li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					  <i class="fas fa-clipboard-list"></i> Categorías
					</a>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php 
                        foreach($datos['categorias'] as $cat){
                            $idcategoria = $cat['idcategoria'];
                            $categoria   = $cat['categoria'];
							
							$url_cate      = $this->helperProducto->_reemplazaCaracterUrl($categoria)."-$idcategoria";
							$url_busq_cate = BASE_URL."/busqueda/$url_cate";
                            echo "<li class='dropdown-item'><a class='text-primary' href='$url_busq_cate'>$categoria</a></li>";
                        }
                        ?>
					</ul>
				  </li>
				</ul>
				<form action="<?php echo BASE_URL?>/busqueda" method="GET" class="d-flex">
				  <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search" name='buscar' id="buscar" autocomplete="off">
				  <button class="btn" type="submit">Buscar</button>
				</form>
			  </div>
			</div>
		  </nav>