<?php
/* echo "<pre>";
print_r($datos['sliders']);
echo "</pre>"; */
?>
<div id="mi-carousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <?php
        $cont = 0;
        foreach($datos['sliders'] as $slide){
            /* $imagen  = $slide['imagen'];
            $caption = $slide['caption'];
            $text    = $slide['text']; */
            $act = $cont == 0 ? 'active' : '';
            echo "<button type='button' data-bs-target='#mi-carousel' data-bs-slide-to='$cont' class='$act' aria-current='true' aria-label='Slide $cont'></button>";
            $cont++;
        }
        ?>
        <!-- <button type="button" data-bs-target="#mi-carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#mi-carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#mi-carousel" data-bs-slide-to="2" aria-label="Slide 3"></button> -->
    </div>
    <div class="carousel-inner">
        <?php
        $cont = 0;
        foreach($datos['sliders'] as $slide){
            $imagen  = $slide['imagen'];
            $caption = $slide['caption'];
            $text    = $slide['text'];
            $img     = BASE_URL."/public/img/carousel/".$imagen;
            
            $act = $cont == 0 ? 'active' : '';

            echo "
            <div class='carousel-item $act'>
                <img src='$img' class='d-block w-100' alt='$caption'>
                <div class='carousel-caption d-md-block'>
                    <h5>$caption</h5>
                    <p>$text</p>
                </div>
            </div>
            ";
            $cont++;
        }
        ?>
        <!-- <div class="carousel-item active">
            <img src="<?php echo BASE_URL?>/public/img/carousel/osito.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>First slide label</h5>
                <p>Some representative placeholder content for the first slide.</p>
            </div>
        </div> -->
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#mi-carousel"  data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#mi-carousel"  data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="container last-products">
    <div class="row border-bottom">
        <div class="col-sm-6 py-4 d-flex align-items-center justify-content-start">
            <h4>ULTIMOS PRODUCTOS</h4>
        </div>
        <div class="col-sm-6 d-flex align-items-center justify-content-end">
            <button class="btn btnMore px-4">Ver más <i class="fa fa-chevron-right"></i></button>
        </div>
    </div>

    <div class="row products mt-4">
        <?php
        if($datos['productos_last']){
            //echo "<pre>"; print_r($datos['productos']); echo "</pre>";
            foreach($datos['productos_last'] as $pro){
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
</div>

<div class="container last-products mt-5">
    <div class="row border-bottom">
        <div class="col-sm-6 py-4 d-flex align-items-center justify-content-start">
            <h4>LOS MÁS VENDIDOS</h4>
        </div>
        <div class="col-sm-6 d-flex align-items-center justify-content-end">
            <button class="btn btnMore px-4">Ver más <i class="fa fa-chevron-right"></i></button>
        </div>
    </div>

    <div class="row products mt-4">
    <?php
        if($datos['productos_masv']){
            //echo "<pre>"; print_r($datos['productos']); echo "</pre>";
            foreach($datos['productos_masv'] as $pro){
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
</div>