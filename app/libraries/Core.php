<?php
/* Mapear la url ingresada en el navegador
1.- Controlador
2.- Metodo 
3.- Parametro
*/
Class Core{
    protected $controladorActual = 'inicio';
    protected $metodoActual = 'index';
    protected $parametros = [];

    public function __construct(){
        $url         = $this->getUrl();
        $controlador = isset($url[0]) ? $url[0] : '';
        $metodo      = isset($url[1]) ? $url[1] : '';
        $parametro[]   = isset($url[2]) ? $url[2] : '';

        //buscar en controlador, si existe elcontrolador
        if(file_exists('../app/controllers/'.ucwords($controlador).'.php')){
            //se pasa como controlador por defecto
            $this->controladorActual = ucwords($controlador);

            //unset indice
            unset($controlador);
        }
        //requerimos el controlador
        require_once '../app/controllers/'.$this->controladorActual.'.php';
        $this->controladorActual = new $this->controladorActual;

        //metodo
        if(trim($metodo) != ''){
            if(method_exists($this->controladorActual, $metodo)){
                $this->metodoActual = $metodo;
                //unset indice
                unset($metodo);
            }

            //echo $this->metodoActual;
        }

        //parametros
        $this->parametros = $parametro ? $parametro : [];
        //$this->parametros = $parametro ? array_values($parametro) : [];
        //print_r(array_values($parametro));

        //llamar callback con parametros array
        call_user_func_array([$this->controladorActual, $this->metodoActual], $this->parametros);
        
    }

    public function getUrl(){
        //echo $_GET['url'];
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
