<?php
class Busqueda extends Controlador{
    public function __construct(){
        $this->modeloCategoria = $this->model('CategoriaModel');
        $this->modeloProducto  = $this->model('ProductoModel');
        $this->modeloSlider    = $this->model('SliderModel');

        $this->helperProducto = $this->helper('ProductoHelper');
    }

    public function index(){
        //$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $vars_from_url = []; $idcateresult = '';

        if(isset($_GET['url'])){
            $url = $_GET['url'];
            $arr_url = explode("/", $url);//separar la categoria ejm 'busqueda/peluchues-7' -> peluches-7
            //print_r($arr_url);
            if(isset($arr_url[1])){
                $cate_arr = explode("-", $arr_url[1]);//para obtener idcategoria ejm 'peluches-7' -> 7
                if(isset($cate_arr[1]) && is_numeric($cate_arr[1])){
                    $idcategoria = $cate_arr[1];
                    $category = $this->modeloCategoria->getCategorias($idcategoria);
                    if( $category ){
                        $idcateresult = $idcategoria; // para la consultad
                        $vars_from_url['categoria'] = $this->helperProducto->_reemplazaCaracterUrl($category['categoria']).'-'.$idcategoria;
                    }     
                }
            }
            if(isset($_GET['buscar']) && preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_GET['buscar'])){
                $buscar = trim($_GET['buscar']);
                $vars_from_url['buscar'] = $buscar;
            }
            if(isset($_GET['nombre']) && ($_GET['nombre'] == 'desc' || $_GET['nombre'] == 'asc')){
                $nombre = $_GET['nombre'] == 'desc' ? 'desc' : 'asc';
                $vars_from_url['nombre'] = $nombre;
            }
            if(isset($_GET['precio']) && ($_GET['precio'] == 'desc' || $_GET['precio'] == 'asc')){
                $precio = $_GET['precio'] == 'desc' ? 'desc' : 'asc';
                $vars_from_url['precio'] = $precio;
            }
            
        }

        $mostrar = 32;
        $pag     = 1;
        if(isset($_GET['pag'])){
            $pag = $_GET['pag'];
        }
        $desde = ($pag - 1) * $mostrar;

        $limit = "$desde, $mostrar";
        $datos['pag'] = $pag;

        $dbresult = '';
        $total = 0;
        if( $countR = $this->modeloProducto->countResultadoBusqueda($vars_from_url, $idcateresult) ){
            $total = $countR['TOTAL'];
            if( $total > 0 ){
                $dbresult = $this->modeloProducto->resultadoBusqueda($vars_from_url, $idcateresult, $limit);
            }
        }
        

        $datos['vars_from_url'] = $vars_from_url;
        $datos['dbresult']      = $dbresult;
        $datos['total']         = $total;

        $datos['categorias'] = $this->modeloCategoria->getCategorias();
        $datos['title']      = 'Resultado | M y F Detalles que enamoran';
        $datos['contenido']  = 'result';
        $this->view('paginas/frontend/index', $datos);
    }


}