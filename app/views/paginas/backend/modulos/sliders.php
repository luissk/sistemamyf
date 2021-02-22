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

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0 text-dark">Sliders</h1>
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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalSlider">
                    Nuevo Slider
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
                <table class="table table-striped table-condensed dt-responsive tablas" width="100%" id="tblSliders">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>IMAGEN</th>
                        <th>CAPTION</th>
                        <th>TEXT</th>
                        <th>Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($datos['sliders']){
                        foreach($datos['sliders'] as $sli){
                        echo "<tr>
                            <td>$sli[idslider]</td>
                            <td><img src='".BASE_URL."/public/img/carousel/$sli[imagen]' width='100' /></td>
                            <td>$sli[caption]</td>
                            <td>$sli[text]</td>
                            <td>
                                <button title='editar' class='btn btn-success editSlider' idsli=$sli[idslider] caption='$sli[caption]' text='$sli[text]' imagen='$sli[imagen]'>
                                    <i class='fa fa-edit'></i>
                                </button>
                                <button title='eliminar' class='btn btn-danger deleteSlider' idsli=$sli[idslider]>
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

<!-- Modal Nuevo Slider-->
<div class="modal fade" id="modalSlider" tabindex="-1" aria-labelledby="titleModalSlider" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" id="frmNuevoSlider">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModalSlider">Nuevo Slider</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">              
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-font"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Caption" name="caption" required maxlength="50">
                    </div>
                </div>
                <div class="form-group">              
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-file-alt"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Texto" name="text" required maxlength="100">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Imagen</label>
                    <div class="col-sm-10">
                        <input type="file" name="slide" id="slide" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 d-flex justify-content-center align-items-center imagePreview" id="imagePreview">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button class="btn btn-primary" type="submit" id="btnNuevoSlider">
                    Guardar
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Nuevo Slider-->
<div class="modal fade" id="modalSliderE" tabindex="-1" aria-labelledby="titleModalSlider" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" id="frmEditarSlider">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModalSlider">Editar Slider</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">              
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-font"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Caption" name="captione" required maxlength="50">
                    </div>
                </div>
                <div class="form-group">              
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-file-alt"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Texto" name="texte" required maxlength="100">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Imagen</label>
                    <div class="col-sm-10">
                        <input type="file" name="slidee" id="slidee" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 d-flex justify-content-center align-items-center imagePreview" id="imagePreviewE">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="idslider">
                <input type="hidden" name="imagen_anterior">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button class="btn btn-primary" type="submit" id="btnEditarSlider">
                    Guardar
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

<script src="<?php echo BASE_URL?>/public/js/b/slider.js"></script>