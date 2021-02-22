<?php
class Inicio extends Controlador{
    public function __construct(){
        $this->modeloCategoria = $this->model('CategoriaModel');
        $this->modeloProducto  = $this->model('ProductoModel');
        $this->modeloSlider    = $this->model('SliderModel');

        $this->helperProducto = $this->helper('ProductoHelper');
    }

    public function index(){
        //URL AMIGABLE PARA EL DETALLE DE PRODUCTO
        if(isset($_GET['url'])){
            $url = explode("-",$_GET['url']);
            if($url[0] == 'detalle'){
                $idproducto = $url[count($url) - 1];
                $producto  = $this->modeloProducto->getProductos($idproducto);
                if( $producto ){                    
                    $nombre = $producto['nombre'];
                    $nombreurl = "detalle-".$this->helperProducto->_reemplazaCaracterUrl($nombre)."-".$idproducto;
                    if( $nombreurl != $_GET['url'] ){
                        header('location:'.BASE_URL.'/'.$nombreurl);
                    }else{
                        $this->detalle($nombreurl);
                    }                    
                }
            }
        }
        
        $sliders    = $this->modeloSlider->getSlider();
        $categorias = $this->modeloCategoria->getCategorias();
        $productos_last  = $this->modeloProducto->getProductos(null,'DESC', '4',null);
        $productos_masv  = $this->modeloProducto->getProductos(null,null, '4','DESC');
        $datos['sliders']    = $sliders;
        $datos['productos_last']  = $productos_last;
        $datos['productos_masv']  = $productos_masv;
        $datos['categorias'] = $categorias;
        $datos['title']      = 'Inicio | M y F Detalles que enamoran';
        $datos['contenido']  = 'inicio';
        $this->view('paginas/frontend/index', $datos);
    }

    public function detalle($url){
        $url = trim($url);
        if( $url == '' ){
            header('location: '.BASE_URL.'/inicio');
        }
        $url = explode("-", $url);
        $idproducto = $url[count($url) - 1];
        
        $producto  = $this->modeloProducto->getProductos($idproducto);
        if( $producto ){
            //echo "<pre>";print_r($producto); echo "</pre>";
            $categorias   = $this->modeloCategoria->getCategorias();

            $datos['producto_det'] = $producto;
            $datos['categorias']   = $categorias;
            $datos['title']        = $producto['nombre']." | M y F Detalles que enamoran";
            $datos['contenido']    = 'detalle';
            $this->view('paginas/frontend/index', $datos);
        }else{
            header('location: '.BASE_URL.'/inicio');
        }   
    }
}