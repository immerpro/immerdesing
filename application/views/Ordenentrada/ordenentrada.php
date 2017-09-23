<div class="container">
    <section class="section" data-parsley-validate>
        <h1  class="h1-responsive orange-text text-center">Orden de Entrada</h1>
        <div style="height: 4vh"></div>
        <?php echo form_open('IngreseEntrada'); ?>
        <div class="row">
            <div class="col-8">
                <?php if (validation_errors()): ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo validation_errors(); ?> 

                    </div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('correcto')): ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo $this->session->flashdata('correcto'); ?> 
                    </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('incorrecto')): ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo $this->session->flashdata('incorrecto'); ?> 
                    </div>

                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="md-form">
                    <i class="fa fa-cart-plus prefix"></i>
                    <input type="text" name="txtProducto" id="producto" class="form-control">
                    <label for="producto" data-error="wrong" data-success="right">Nombre del producto</label>
                    <div style="height: 5vh"></div>
                </div> 
            </div>
            <script>
                $(function () {
                    $("#producto").autocomplete({
                        source: "<?php base_url() ?>inventario/get_producto" // 
                    });
                });
            </script>

            <div class="col-6">
                <div class="md-form">
                    <i class="fa fa-cubes prefix"></i>
                    <input type="text" id="cantentrada" class="form-control" name="txtCantentra">
                    <label for="cantentrada" data-error="wrong" data-success="right">Cantidad Entrada:</label>
                </div>
            </div>
            <div class="col-6">
                <div class="md-form">
                    <i class="fa fa-money prefix"></i>
                    <input type="text" name="txtPreentra" id="form1" class="form-control">
                    <label for="snombP" data-error="wrong" data-success="right"> Precio Entrada</label>
                </div>  
            </div>

            <div class="col-6">
                <div >
                    <label for="proveedor" data-error="wrong" data-success="right"> <i class="fa fa-photo fa-2x"></i> Proveedor</label>
                    <select name="txtCodProv" class="form-control md-form"  id="txtCodProv" required data-parsley-trigger="keyup">
                        <option value="">seleccione un Proveedor</option>
                        <?php foreach ($proveedor_select as $proveedor_item): ?>
                            <option value="<?= $proveedor_item['idProveedor'] ?>"><?= $proveedor_item['NombreProveedor'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>  
            </div>

        </div>
        <div class="row">
            <div class="col-11">
                <div class="flex-center">

                    <button type="submit" class="btn btn-orange waves-effect orange" name="btnNuevaEntrada"  ><i class='fa fa-send'> Registrar Orden Entrada</i></button>

                </div>
            </div>
        </div>

        <?php echo form_close(); ?>

    </section>

</div> 
