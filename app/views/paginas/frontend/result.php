<style>
.filters .alert{
    padding: 5px 5px;
    font-size: 12px;
}
.filters .alert-dismissible a.btn-close{
    padding: 7px 10px;
}

.notfound{
    font-size: 3em; font-weight: bolder;
}
</style>

<?php
if(isset($datos['vars_from_url'])){
    if(count($datos['vars_from_url']) > 0){
        //print_r($datos['vars_from_url']);
        echo "
            <div class='container'>
                <div class='row filters border-top pt-2'>
                    <div class='col-sm-12'>
                        <strong>Filtros <i class='fas fa-filter'></i></strong>
                    </div>";
        foreach($datos['vars_from_url'] as $k => $v){
            if($k == 'categoria'){
                $arr_v = explode("-", $v);
                $len = strlen($arr_v[count($arr_v) - 1]) + 1;

                $onclick = "recargar('','','$v')";

                $v = substr($v, 0, -$len);
            }else{
                $onclick = "recargar('$k','','')";
            }

            if($k == 'nombre' && $v == 'asc') $v = 'A-Z'; elseif($k == 'nombre' && $v == 'desc') $v = 'Z-A';
            if($k == 'precio' && $v == 'asc') $v = 'menor a mayor'; elseif($k == 'precio' && $v == 'desc') $v = 'mayor a menor';
            echo "                
                <div class='col-sm-6 col-md-3'>
                    <div class='alert alert-info alert-dismissible fade show' role='alert'>
                        <strong>$k</strong> $v 
                        <a type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close' onclick=\"$onclick\"></a>
                    </div>
                </div>";
        }
        echo " </div>
            </div>";
    }
}
?>

<div class="container">
    <div class="row border-top pt-2 align-items-center">
        <div class="col-sm-8">
        <h6>Encontrados <span class="badge bg-secondary"><?php echo $datos['total']?></span></h6> 
        </div>
        <div class="col-sm-4">
            <select class="form-select" id="ordenar" onchange="ordenar(this)">
                <option value="">Ordenar Por</option>
                <option value="nombre-asc">Nombre, A - Z</option>
                <option value="nombre-desc">Nombre, Z - A</option>
                <option value="precio-asc">Precio, de menor a mayor</option>
                <option value="precio-desc">Precio, de mayor a menor</option>
            </select>
        </div>
    </div>
</div>

<?php
if( $datos['total'] == 0 ){
    echo "
    <div class='container'>
        <div class='row'>
            <div class='col-sm-12 text-center'>
            <p class='notfound text-danger pt-5'><i class='fas fa-question-circle'></i><br> Producto <br> No Encontrado</p>
            <p class='text-muted'>Lo sentimos. Intente con otra búsqueda</p>
            </div>
        </div>        
    </div>
    ";
}else{
?>

    <div class="container last-products">
        <div class="row products mt-4">
            <?php
            if($datos['dbresult']){
                //echo "<pre>"; print_r($datos['dbresult']); echo "</pre>";
                foreach($datos['dbresult'] as $pro){
                    $idproducto   = $pro['idproducto'];
                    $nombre       = $pro['nombre'];
                    $precio_venta = $pro['precio_venta'];
                    $imagen_small = $pro['imagen_small'];

                    $img           = BASE_URL."/public/img/products/$idproducto/$imagen_small";
                    $nombre_helper = $this->helperProducto->_reemplazaCaracterUrl($nombre);
                    //$link_detalle  = BASE_URL."/inicio/detalle/$nombre_helper-$idproducto";
                    $link_detalle  = BASE_URL."/detalle-$nombre_helper-$idproducto";

                    echo "
                    <div class='col-sm-6 col-md-4 col-lg-3'>
                        <div class='product'>
                            <a href='$link_detalle' class='d-flex justify-content-center align-items-center'>
                                <img src='$img' alt='$nombre'>
                            </a>
                            <h4 class='mt-2'>
                                <a href='$link_detalle'>$nombre</a>
                            </h4>
                            <h2 class='d-flex justify-content-between'>
                                <a href='$link_detalle' class='text-muted'><i class='fa fa-eye'></i></a>
                                <span>S/ $precio_venta</span>
                            </h2>
                        </div>
                    </div>
                    ";
                }
            }
            ?>
        </div>

        <?php
        $RegistrosAMostrar = 32;
        $PaginasIntervalo  = 3;
        $PagAct            = $datos['pag'];

        $PagUlt = $datos['total'] / $RegistrosAMostrar;
        $Res    = $datos['total'] % $RegistrosAMostrar;
        if($Res > 0) $PagUlt = floor($PagUlt) + 1;

        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url = $this->helperProducto->helper_remove_url_query_args($url, array('pag'));
        //echo "$url<br>";
        
        if(count($_GET) > 0 && (substr($url, -1) == '?' || substr($url, -1) == '&'))
            $url = str_replace(["?", "&"],"", $url)."?";
        else if(count($_GET) == 1 && (substr($url, -1) == '?' || substr($url, -1) == '&'))   
            $url = str_replace(["?", "&"],"", $url)."?";
        else if(count($_GET) == 1 && (substr($url, -1) != '?' || substr($url, -1) != '&'))
            $url = "$url?";
        else
            $url = "$url&";
        //else if()
        ?>

        <nav class="mt-4">
            <ul class="pagination justify-content-end">
                <?php
                if($PagAct>($PaginasIntervalo + 1)){
                    echo "
                    <li class='page-item'>
                        <a class='page-link' href='".$url."pag=1'>Primero</a>
                    </li>";
                }

                for( $i = ($PagAct-$PaginasIntervalo) ; $i <= ($PagAct-1) ; $i ++){
					if($i>=1){
                        echo "<li class='page-item'><a class='page-link' href='".$url."pag=$i'>$i</a></li>";
                    }
                }

                echo "<li class='page-item active' aria-current='page'><span class='page-link'>".$PagAct."</span></li>";

                for( $i = ($PagAct+1) ; $i <= ($PagAct+$PaginasIntervalo) ; $i ++){
					if($i<=$PagUlt){
                        echo "<li class='page-item'><a class='page-link' href='".$url."pag=$i'>$i</a></li>";
                    }
                }

                if($PagAct<($PagUlt-$PaginasIntervalo)){
                    echo "<li class='page-item'>
                        <a class='page-link' href='".$url."pag=$PagUlt'>Ultimo</a>
                    </li>";
                }
                ?>
                <!-- <li class="page-item disabled">
                <span class="page-link">Previous</span>
                </li>   
                <li class="page-item"><a class="page-link" href="?pag=1">1</a></li>
                <li class="page-item active" aria-current="page">
                <span class="page-link">2</span>
                </li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                <a class="page-link" href="#">Next</a>
                </li> -->
            </ul>
        </nav>
    </div>
<?php
}
?>

<script>
//$(function(){
    let pathname = window.location.pathname,
        search = window.location.search,
        origin = window.location.origin;

    function replaceQueryParam(param, newval, search) {
        var regex = new RegExp("([?;&])" + param + "[^&;]*[;&]?");
        var query = search.replace(regex, "$1").replace(/&$/, '');

        return (query.length > 2 ? query + "&" : "?") + (newval ? param + "=" + newval : '');
    }

    function recargar(param = '', param_value = '', categoria = ''){
        search = replaceQueryParam('pag', '', search);//quitar siempre parametro 'pag'
        //let url = '';
        if(categoria != ''){
            pathname = pathname.replace('/'+categoria,'');
        }
        if(param != ''){
            search = replaceQueryParam(param, param_value, search);
        }
        //console.log(origin+pathname+search);
        window.location = origin+pathname+search;
    }

    function ordenar(_this){
        let value = _this.value;
        if(value != ''){
            value = value.split("-");
            recargar(value[0], value[1], '');
        }
    }
//}); 
</script>