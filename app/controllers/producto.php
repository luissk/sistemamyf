<?php
class Producto extends Controlador{
    public function __construct(){
        $this->modeloCategoria = $this->model('CategoriaModel');
        $this->modeloProducto  = $this->model('ProductoModel');

		$this->helperProducto = $this->helper('ProductoHelper');
    }

    public function saveProducto(){
        if(IS_AJAX){
            $idcategoria  = $_POST['categoriap'];
            $vendidos     = $_POST['vendidosp'];
            $nombrep      = trim($_POST['nombrep']);
            $descripcionp = trim($_POST['descripcionp']);
            $preciocp     = $_POST['preciocp'];
            $preciovp     = $_POST['preciovp'];
            $stockp       = $_POST['stockp'];

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $nombrep) && 
			    preg_match('/^[0-9]+$/', $idcategoria) && 
                preg_match('/^[0-9]+$/', $stockp) &&
			    preg_match('/^[0-9.]+$/', $preciocp) &&
			    preg_match('/^[0-9.]+$/', $preciovp)){
                								
				$data_save = array(
					'idcategoria' => $idcategoria,
					'nombre'      => $nombrep,
					'descripcion' => $descripcionp,
					'precioc'     => $preciocp,
					'preciov'     => $preciovp,
					'stock'       => $stockp,
					'vendidos'    => $vendidos
				); 

				if( $idproducto = $this->modeloProducto->insertProducto($data_save) ){
					$ruta = ""; $ruta_small = "";
					$codigo     = $this->newCodigoProducto($idproducto);
            		//echo "$idproducto - $codigo";
					//print_r($_FILES);
					if(isset($_FILES["imagenp"]["tmp_name"])){
						$medida       = 800;
						$medida_small = 400;
						
						//CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL PRODUCTO
						$directorio = "img/products/".$idproducto;
						if(!file_exists($directorio)) mkdir($directorio, 0755);
						
						//DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP					
						$nombre_img = $this->helperProducto->_reemplazaCaracterUrl($nombrep);
						if($_FILES["imagenp"]["type"] == "image/jpeg"){

							//GUARDAMOS LA IMAGEN EN EL DIRECTORIO					
							$ruta = $directorio."/".$nombre_img.".jpg";

							$imagen_optimizada = $this->redimensionar_imagen($_FILES["imagenp"]["name"],$_FILES["imagenp"]["tmp_name"],$medida,$medida);
							imagejpeg($imagen_optimizada, $ruta);

							//IMAGEN SMALL
							$ruta_small = $directorio."/".$nombre_img."-small.jpg";

							$imagen_optimizada2 = $this->redimensionar_imagen($_FILES["imagenp"]["name"],$_FILES["imagenp"]["tmp_name"],$medida_small,$medida_small);
							imagejpeg($imagen_optimizada2, $ruta_small);

						}else if($_FILES["imagenp"]["type"] == "image/png"){

							$ruta = $directorio."/".$nombre_img.".png";

							$imagen_optimizada = $this->redimensionar_imagen($_FILES["imagenp"]["name"],$_FILES["imagenp"]["tmp_name"],$medida,$medida);
							imagepng($imagen_optimizada, $ruta);

							//IMAGEN SMALL
							$ruta_small = $directorio."/".$nombre_img."-small.png";

							$imagen_optimizada2 = $this->redimensionar_imagen($_FILES["imagenp"]["name"],$_FILES["imagenp"]["tmp_name"],$medida_small,$medida_small);
							imagepng($imagen_optimizada2, $ruta_small);
						}

						$this->modeloProducto->updateImageCodigo($codigo,basename($ruta), basename($ruta_small), $idproducto);
					}
					echo "ok";
				}
            }else{
                echo "revisar";
            }
        }
    }

	public function productoParaEditar(){
		if(IS_AJAX){
			$idproducto = $_POST['idproducto'];
			$producto = $this->modeloProducto->getProductos($idproducto);
			if( $producto ){
				echo json_encode($producto);
			}
		}
	}

	public function updateProducto(){
		if(IS_AJAX){
			$idcategoria       = $_POST['categoriap'];
			$vendidos          = $_POST['vendidosp'];
			$nombre            = $_POST['nombrep'];
			$descripcion       = $_POST['descripcionp'];
			$preciocp          = $_POST['preciocp'];
			$preciovp          = $_POST['preciovp'];
			$stock             = $_POST['stockp'];
			$idproducto        = $_POST['idproducto'];
			$img_anterior      = $_POST['img_anterior'];
			$img_anteriorsmall = $_POST['img_anteriorsmall'];
			$imagen            = $_FILES['imagenpe'];

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $nombre) && 
			    preg_match('/^[0-9]+$/', $idcategoria) && 
                preg_match('/^[0-9]+$/', $stock) &&
			    preg_match('/^[0-9.]+$/', $preciocp) &&
			    preg_match('/^[0-9.]+$/', $preciovp)){
				
				$ruta       = $img_anterior;
				$ruta_small = $img_anteriorsmall;

				if($imagen['error'] == 0){
					$medida       = 800;
					$medida_small = 400;
					$ruta         = "";
					$ruta_small   = "";
					
					//CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL PRODUCTO
					$directorio = "img/products/".$idproducto;
					if(!file_exists($directorio)) mkdir($directorio, 0755);
					//eliminamos la imagen anterior
					if(file_exists("$directorio/$img_anterior") && file_exists("$directorio/$img_anteriorsmall")){
						unlink("$directorio/$img_anterior");
						unlink("$directorio/$img_anteriorsmall");
					}

					$nombre_img = $this->helperProducto->_reemplazaCaracterUrl($nombre);
					if($imagen["type"] == "image/jpeg"){

						//GUARDAMOS LA IMAGEN EN EL DIRECTORIO					
						$ruta = $directorio."/".$nombre_img.".jpg";

						$imagen_optimizada = $this->redimensionar_imagen($imagen["name"],$imagen["tmp_name"],$medida,$medida);
						imagejpeg($imagen_optimizada, $ruta);

						//IMAGEN SMALL
						$ruta_small = $directorio."/".$nombre_img."-small.jpg";

						$imagen_optimizada2 = $this->redimensionar_imagen($imagen["name"],$imagen["tmp_name"],$medida_small,$medida_small);
						imagejpeg($imagen_optimizada2, $ruta_small);

					}else if($imagen["type"] == "image/png"){

						$ruta = $directorio."/".$nombre_img.".png";

						$imagen_optimizada = $this->redimensionar_imagen($imagen["name"],$imagen["tmp_name"],$medida,$medida);
						imagepng($imagen_optimizada, $ruta);

						//IMAGEN SMALL
						$ruta_small = $directorio."/".$nombre_img."-small.png";

						$imagen_optimizada2 = $this->redimensionar_imagen($imagen["name"],$imagen["tmp_name"],$medida_small,$medida_small);
						imagepng($imagen_optimizada2, $ruta_small);
					}

				}
				
				//actualizar
				$data_update = array(
					'idcategoria' => $idcategoria,
					'nombre'      => $nombre,
					'descripcion' => $descripcion,
					'preciocp'    => $preciocp,
					'preciovp'    => $preciovp,
					'stock'       => $stock,
					'idproducto'  => $idproducto,
					'ruta'        => basename($ruta),
					'ruta_small'  => basename($ruta_small),
					'vendidos'    => $vendidos
				);

				if( $this->modeloProducto->updateProducto($data_update) ){
					echo "ok";
				}
			}else{
				echo "revisar";
			}
			//print_r($_FILES);
		}
	}

	public function deleteProducto(){
		if(IS_AJAX){
			$idproducto = $_POST['idproducto'];
			$producto = $this->modeloProducto->getProductos($idproducto);
			if( $producto ){
				//print_r($producto);
				$imagen = $producto['imagen'];
				$imagen_small = $producto['imagen_small'];
				$directorio = "img/products/".$idproducto;
				if(file_exists($directorio)){
					if(file_exists("$directorio/$imagen") && file_exists("$directorio/$imagen_small")){
						echo "eiliminar ambas";
						unlink("$directorio/$imagen");
						unlink("$directorio/$imagen_small");
					}
					rmdir($directorio);
				}
				if($this->modeloProducto->deleteProducto($idproducto))
					return true;
			}
		}
	}

	function redimensionar_imagen($nombreimg, $rutaimg, $xmax, $ymax){  
        $ext = explode(".", $nombreimg);  
        $ext = $ext[count($ext)-1];  
      
        if($ext == "jpg" || $ext == "jpeg")  
            $imagen = imagecreatefromjpeg($rutaimg);  
        elseif($ext == "png")  
            $imagen = imagecreatefrompng($rutaimg);  
        elseif($ext == "gif")  
            $imagen = imagecreatefromgif($rutaimg);  
          
        $x = imagesx($imagen);  
        $y = imagesy($imagen);
          
        if($x <= $xmax && $y <= $ymax){
            //echo "<center>Esta imagen ya esta optimizada para los maximos que deseas.<center>";
            return $imagen;  
        }
      
        if($x >= $y) {  
            $nuevax = $xmax;  
            $nuevay = $nuevax * $y / $x;  
        }  
        else {  
            $nuevay = $ymax;  
            $nuevax = $x / $y * $nuevay;  
        }  
          
        $img2 = imagescale($imagen, $nuevax, $nuevay, IMG_BILINEAR_FIXED);//imagecreatetruecolor($nuevax, $nuevay);  
        //imagecopyresized($img2, $imagen, 0, 0, 0, 0, floor($nuevax), floor($nuevay), $x, $y);  
		
        //echo "<center>La imagen se ha optimizado correctamente.</center>";
        return $img2;   
    }


    public function lastIdProducto(){
        $id = $this->modeloProducto->lastIdProducto();
        $id = $id['id'] == null ? 1 : $id['id'] + 1;        
        return $id;
    }

    public function newCodigoProducto($id){
        return 'P'.str_pad($id, 4, '0', STR_PAD_LEFT);
    }

    public function existsIdProducto($id){
        $id = $this->modeloProducto->existsIdProducto($id);
        return $id ? true : false;
    }

}