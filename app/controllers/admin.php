<?php
session_start();

class Admin extends Controlador{
    public function __construct(){
        $this->modeloUsuario   = $this->model('UsuarioModel');
        $this->modeloCategoria = $this->model('CategoriaModel');
        $this->modeloProducto  = $this->model('ProductoModel');
        $this->modeloSlider    = $this->model('SliderModel');
    }

    public function index(){
        if( $_POST ){
            $email    = strtoupper(trim($_POST['email']));
            $password = trim($_POST['password']);
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                $passcrypt = crypt($password, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                $result = $this->modeloUsuario->validaUsuario($email);
                if( $result && strtolower($result['email']) == strtolower($email) && $result['password'] == $passcrypt ){
                    $idusuario     = $result['idusuario'];
                    $email         = $result['email'];
                    $idtipousuario = $result['idtipousuario'];
                    $nombres       = $result['nombres'];

					$_SESSION['idusuario']     = $idusuario;
					$_SESSION['email']         = $email;
					$_SESSION['idtipousuario'] = $idtipousuario;
					$_SESSION['nombres']       = $nombres;
                }else{
                    echo "PASSWORD y/o EMAIL INVALIDOS";
                }
            }else{
                echo "NO ES UN EMAIL VALIDO";
            }
        }
        $this->view('paginas/backend/index');
    }

    public function inicio(){
        $datos['title']     = 'Inicio';
        $datos['contenido'] = 'inicio';
        $this->view('paginas/backend/plantilla', $datos);
    }

    public function categorias(){
        $categorias = $this->modeloCategoria->getCategorias();

        $datos['categorias']        = $categorias;
        $datos['title']             = 'Categorias';
        $datos['active_categorias'] = 'active';
        $datos['contenido']         = 'categorias';

        $this->view('paginas/backend/plantilla', $datos);
    }

    public function productos(){
        $productos  = $this->modeloProducto->getProductos();
        $categorias = $this->modeloCategoria->getCategorias();

        $datos['productos']        = $productos;
        $datos['categorias']       = $categorias;
        $datos['title']            = 'Productos';
        $datos['active_productos'] = 'active';
        $datos['contenido']        = 'productos';
        $this->view('paginas/backend/plantilla', $datos);
    }

    public function generateRandomString($length = 4) { 
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, $length);
    }

    public function slider(){
        $datos['sliders']        = $this->modeloSlider->getSlider();
        $datos['title']          = 'Slider';
        $datos['active_sliders'] = 'active';
        $datos['contenido']      = 'sliders';
        $this->view('paginas/backend/plantilla', $datos);
    }

    public function usuarios(){
        $datos['title']           = 'Usuarios';
        $datos['active_usuarios'] = 'active';
        $datos['contenido']       = 'usuarios';
        $this->view('paginas/backend/plantilla', $datos);
    }

    public function salir(){
        session_destroy();
        header('location:'.BASE_URL.'/admin');
    }
}