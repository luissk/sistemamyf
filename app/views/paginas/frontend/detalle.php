
<?php
$idproducto   = $datos['producto_det']['idproducto'];
$nombre       = $datos['producto_det']['nombre'];
$descripcion  = $datos['producto_det']['descripcion'];
$imagen       = $datos['producto_det']['imagen'];
$imagen_small = $datos['producto_det']['imagen_small'];
$precio_venta = $datos['producto_det']['precio_venta'];
$idcategoria  = $datos['producto_det']['idcategoria'];
$codigo       = $datos['producto_det']['codigo'];
$categoria    = $datos['producto_det']['categoria'];

$ruta       = BASE_URL."/public/img/products/$idproducto/$imagen";
$ruta_small = BASE_URL."/public/img/products/$idproducto/$imagen_small";

$url_cate      = $this->helperProducto->_reemplazaCaracterUrl($categoria)."-$idcategoria";
$url_busq_cate = BASE_URL."/busqueda/$url_cate";
?>

<div class="container detail-content">
	<div class="row">
		<div class="col-sm-12 border-top border-bottom text-secondary pt-3 pb-2">
			<h1 class="title-detail"><i class="fa fa-chevron-circle-right"></i> <?php echo $nombre?></h1>
		</div>
	</div>
	<div class="row mt-2">
		<div class="col-sm-5 overflow-hidden">
			<div class="content-img d-flex justify-content-center">
				<div data-src="<?php echo $ruta?>" id="image-wrap">
					<img src="<?php echo $ruta_small?>" alt="<?php echo $nombre?>" id="img">
				</div>							
			</div>
			<div class="thumbs">
				<div>
					<img src="<?php echo $ruta_small?>" alt="<?php echo $nombre?>" data-src="<?php echo $ruta?>">
				</div>
			</div>
		</div>
		<div class="col-sm-7">
			<h2 class="mt-3"><?php echo $nombre?></h2>
			<p class="text-muted">Categoria: <a href='<?php echo $url_busq_cate?>'><?php echo $categoria?></a></p>
			<h4 class="text-muted"><?php echo "S/ ".$precio_venta?></h4>
			<p class="pt-2"><?php echo nl2br($descripcion)?></p>
			<div class="mt-4 alert alert-success" role="alert">
				CODIGO: <?php echo $codigo?>
			</div>
			<div class="d-flex justify-content-between">
				<div>
					<h4>
						<a href="https://api.whatsapp.com/send?phone=51952997659&text=Hola%20me%20interesa%20el%20producto%20con codigo%20<?php echo $codigo?>" target="_blank" title="Mensaje a whatsapp">
							<i class="fa fa-whatsapp text-success"></i>
						</a>
					</h4>
				</div>
				<div>
					Comparte &nbsp;
					<a href="https://www.facebook.com/sharer.php?u=<?php echo $share_url?>" class="fz-1-5 text-primary" target="_blank">
						<i class="fa fa-facebook-square"></i>
					</a>

					<a href="" class="fz-1-5 text-info">
						<i class="fa fa-twitter"></i>
					</a>
				</div>
			</div>
			<div class="card bg-light mt-4 mb-3">
				<div class="card-header">Realiza tu pedido</div>
				<div class="card-body">
					<h5 class="card-title">Contáctanos</h5>
					<p class="card-text">Bríndanos el código del producto y enseguida lo preparamos.</p>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo BASE_URL?>/public/js/f/img-zoom-lc.js"></script>