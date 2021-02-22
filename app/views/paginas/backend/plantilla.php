<?php
if(!isset($_SESSION['idusuario']) && $_SESSION['idusuario'] == ''){
    header('location:'.BASE_URL.'/admin');
}
//TITLE HEAD
$datos['title'] = isset($datos['title']) ? $datos['title'] : 'Panel Admin';


//$this->view('paginas/backend/inc/header', $datos);
include 'inc/header.php';
//$this->view('paginas/backend/inc/menu');
include 'inc/menu.php';
?>

<div class="content-wrapper">
    <?php
    //$this->view('paginas/backend/modulos/'.$datos['contenido']);
    include 'modulos/'.$datos['contenido'].'.php';
    ?>
</div>

<?php
//$this->view('paginas/backend/inc/footer');
include 'inc/footer.php';
?>