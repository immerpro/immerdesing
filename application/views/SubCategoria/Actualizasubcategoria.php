<div class="container">
    <section class="section">
        <div style="height: 5vh"></div>

        <div class="flex-center">
            <div style="height: 5vh"></div>
            <?php if ($this->session->flashdata('correcto')): ?>
                <div class="alert alert-success" role="alert" /> <?= $this->session->flashdata('correcto') ?> </div>  
        <?php endif; ?>
        <?php if ($this->session->flashdata('incorrecto')): ?>
            <div class="alert alert-success" role="alert" /> <?= $this->session->flashdata('incorrecto') ?> </div>  
<?php endif; ?>
</div>
<?php echo form_open('Subcategoria/actualizarsub/' . $idSub); ?>  
<input type="hidden" name="hdcodigoCategoria" value="<?= $codCategoria ?>">
<h1 class="h1 orange-text text-center">subcategoria a Actualizar</h1>
<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-6 col-md-6">
        <div class="md-form">
            <i class="fa fa-folder-o fa-2x prefix "></i>
            <input type="text" id="form1" class="form-control" name="NombreSubcategoria" value="<?php echo $NombreSub; ?>">
            <label for="form1" class="">Subcategoria</label>
        </div>
        <div style="height: 3vh"></div>
        <div class="md-textarea">
            <i class="fa fa-pencil-square-o fa-2x prefix "></i>
            <label for="form1" class="">Detalle de Subcategoria</label>
            <textarea rows="10" cols="90"  name="detalSubCategoria"><?php echo $DetallesSub; ?></textarea> 
            <div class="btn-group flex-center">
                <button type="submit" class="btn btn-orange waves-effect orange" name="btnEditaSubcategoria"><i class='fa fa-edit'> Actualizar Subcategoria</i></button>
            </div>
        </div>
    </div>
</div>
<div style="height: 5vh"></div>
<?php echo form_close(); ?>
<div class="col-9 ">
    <span class="alert-danger close"><?php echo validation_errors(); ?></span> 
</div>
</section>
</div>
