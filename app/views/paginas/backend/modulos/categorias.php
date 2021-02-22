<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0 text-dark">Categorías</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content bg-white">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-sm-12 mb-4">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCategoria">
                    Nueva Categoría
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <?php
                /*if(!$datos['categorias']){
                    echo '
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-exclamation-triangle"></i> Aviso!</h5>
                        Aún no se han registrado categorías.
                    </div>
                    ';
                }*/
                ?>
                <table class="table table-striped table-condensed dt-responsive tablas" width="100%" id="tblCategorias">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>CATEGORIA</th>
                        <th>Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($datos['categorias']){
                        foreach($datos['categorias'] as $cat){
                        echo "<tr>
                            <td>$cat[idcategoria]</td>
                            <td>$cat[categoria]</td>
                            <td>
                                <button title='editar' class='btn btn-success editCategoria' idcat=$cat[idcategoria] cat='$cat[categoria]'>
                                    <i class='fa fa-edit'></i>
                                </button>
                                <button title='eliminar' class='btn btn-danger deleteCategoria' idcat=$cat[idcategoria] cat='$cat[categoria]'>
                                    <i class='fa fa-trash-alt'></i>
                                </button>
                            </td>
                        </tr>";
                        }
                    }
                    ?>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>


<!-- Modal Nueva Categoria-->
<div class="modal fade" id="modalCategoria" tabindex="-1" aria-labelledby="titleModalCategoria" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" id="frmNuevaCategoria">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModalCategoria">Nueva Categoría</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">              
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-list-ol"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Categoría" name="nCategoria" required>
                    </div>
                </div>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button class="btn btn-primary" type="submit" id="btnNuevaCategoria">
                    Guardar
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar Categoria-->
<div class="modal fade" id="modalCategoriaE" tabindex="-1" aria-labelledby="titleModalCategoria2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" id="frmEditCategoria">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModalCategoria2">Editar Categoría</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">              
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-list-ol"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Categoría" name="nCategoriaE" required>
                        <input type="hidden" name="idCategoriaE">
                    </div>
                </div>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button class="btn btn-primary" type="submit" id="btnEditCategoria">
                    Editar
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

<script src="<?php echo BASE_URL?>/public/js/b/categoria.js"></script>