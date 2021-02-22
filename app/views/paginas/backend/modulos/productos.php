<style>
.imagePreview{
    width: 200px;
    height: 200px;
    border: 1px solid #ddd;
    background-color: #666;
}
.imagePreview img{
    max-width: 100%;
    max-height: 100%;
}
</style>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0 text-dark">Productos</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content bg-white">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-sm-12 mb-4">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalProducto">
                    Nuevo Producto
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <?php
                /*if(!$datos['productos']){
                    echo '
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-exclamation-triangle"></i> Aviso!</h5>
                        Aún no se han registrado productos.
                    </div>
                    ';
                }*/
                //print_r($datos['productos']);
                ?>
                <table class="table table-striped table-condensed dt-responsive tablas" width="100%" id="tblProductos">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>CODIGO</th>
                        <th>NOMBRE</th>
                        <th>CATEGORIA</th>
                        <th>IMAGEN</th>
                        <th>PRECIO_VENTA</th>
                        <th>STOCK</th>
                        <th>OPCION</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php                    
                    if($datos['productos']){
                        $cont = 0;
                        foreach($datos['productos'] as $pro){$cont++;
                            $idproducto    = $pro['idproducto'];
                            $codigo        = $pro['codigo'];
                            $descripcion   = $pro['descripcion'];
                            $nombre        = $pro['nombre'];
                            $imagen        = $pro['imagen'];
                            $imagen_small  = $pro['imagen_small'];
                            $precio_compra = $pro['precio_compra'];
                            $precio_venta  = $pro['precio_venta'];
                            $stock         = $pro['stock'];
                            $categoria     = $pro['categoria'];

                            $img = '';
                            if($imagen_small != ''){
                                $src = BASE_URL."/public/img/products/$idproducto/$imagen_small";
                                $img = "<img src='$src' height='50' />";
                            }                            
                            
                            echo "<tr>
                                <td>$cont</td>
                                <td>$codigo</td>
                                <td>$nombre</td>
                                <td>$categoria</td>
                                <td>$img</td>
                                <td>$precio_venta</td>
                                <td>$stock</td>
                                <td>
                                <button title='editar' class='btn btn-success editProducto' idpro=$idproducto>
                                    <i class='fa fa-edit'></i>
                                </button>
                                <button title='eliminar' class='btn btn-danger deleteProducto' idpro=$idproducto codigo='$codigo'>
                                    <i class='fa fa-trash-alt'></i>
                                </button>
                                </td>
                            </tr>";
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>


<!-- Modal Nuevo Producto-->
<div class="modal fade" id="modalProducto" tabindex="-1" aria-labelledby="titleModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" id="frmNuevoProducto" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModal">Nuevo Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Categoría</label>
                    <div class="col-sm-6">
                        <select class="form-control" name="categoriap" required>
                            <option value="">Seleccione</option>
                            <?php
                            foreach($datos['categorias'] as $cat){
                                echo "<option value='$cat[idcategoria]'>$cat[categoria]</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input-group mb-3 col-sm-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-shopping-cart"></i></span>
                        </div>
                        <input type="number" class="form-control" placeholder="Vendidos" name="vendidosp" required maxlength="50">
                    </div>
                </div>
                <div class="form-group">              
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-box-open"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Nombre Producto" name="nombrep" required maxlength="50">
                    </div>
                </div>
                <div class="form-group">
                    <textarea name="descripcionp" rows="5" class="form-control" placeholder="Descripción..." required></textarea>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Compra" name="preciocp" required onkeypress="return filterFloat(event,this);">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Venta" name="preciovp" required onkeypress="return filterFloat(event,this);">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-cubes"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Stock" name="stockp" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Imagen</label>
                    <div class="col-sm-10">
                        <input type="file" name="imagenp" id="imagenp" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 d-flex justify-content-center align-items-center imagePreview" id="imagePreview">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button class="btn btn-primary" type="submit" id="btnNuevoProducto">
                    Guardar
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar Producto-->
<div class="modal fade" id="modalProductoE" tabindex="-1" aria-labelledby="titleModalE" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" id="frmEditarProducto" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModalE">Editar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Categoría</label>
                    <div class="col-sm-6">
                        <select class="form-control" name="categoriap" required>
                            <option value="">Seleccione</option>
                            <?php
                            foreach($datos['categorias'] as $cat){
                                echo "<option value='$cat[idcategoria]'>$cat[categoria]</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input-group mb-3 col-sm-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-shopping-cart"></i></span>
                        </div>
                        <input type="number" class="form-control" placeholder="Vendidos" name="vendidosp" required maxlength="50">
                    </div>
                </div>
                <div class="form-group">              
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-box-open"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Nombre Producto" name="nombrep" required maxlength="50">
                    </div>
                </div>
                <div class="form-group">
                    <textarea name="descripcionp" rows="5" class="form-control" placeholder="Descripción..." required></textarea>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Compra" name="preciocp" required onkeypress="return filterFloat(event,this);">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Venta" name="preciovp" required onkeypress="return filterFloat(event,this);">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-cubes"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Stock" name="stockp" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Imagen</label>
                    <div class="col-sm-10">
                        <input type="file" name="imagenpe" id="imagenpe" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 d-flex justify-content-center align-items-center imagePreview" id="imagePreviewE">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="idproducto">
                <input type="hidden" name="img_anterior">
                <input type="hidden" name="img_anteriorsmall">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button class="btn btn-primary" type="submit" id="btnEditarProducto">
                    Editar
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

<script src="<?php echo BASE_URL?>/public/js/b/producto.js"></script>