<div class="container">
    <section class="section" data-parsley-validate>
        <p class="display-4 orange-text flex-center">Orden Salida</p>
        <div style="height: 4vh"></div>
        <?php echo form_open('ingresosalida'); ?>
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
                    <input type="text" id="snombP" class="form-control validate" name="txtProducto">
                    <label for="snombP" data-error="wrong" data-success="right"></i> Nombre Producto: </label>
                    <div style="height: 5vh"></div>
                </div> 
            </div>
            <script>
                $(function () {
                    $("#snombP").autocomplete({
                        source: "<?php base_url() ?>inventario/get_producto" // path to the get_birds method
                    });
                });
            </script>
            <div class="col-6">
                <div class="md-form">
                    <i class="fa fa-cubes prefix"></i>
                    <input type="text" id="cants" class="form-control validate" name="txtCantsalida">
                    <label for="cants" data-error="wrong" data-success="right">Cantidad Salida:</label>
                </div>
            </div>
            <div class="col-6">
                <div class="md-form">
                    <i class="fa fa-money prefix"></i>
                    <input type="text" id="snombP" class="form-control validate" name="txtPreSalida">
                    <label for="snombP" data-error="wrong" data-success="right"> Precio Salida</label>
                </div>  
            </div>

            <div class="col-6">
                <div >
                    <label for="snombP" data-error="wrong" data-success="right"> <i class="fa fa-list-alt"></i> Motivo Salida</label>

                    <select class="form-control" name="cboMotivo">
                        <option value="merma">Merma</option>
                        <option value="devolucion"> devolucion proveedor</option>
                        <option value="venta">venta</option>
                      
                    </select>
                </div>  
            </div>

        </div>
        <div class="row">
            <div class="col-11">
                <div class="flex-center">

                    <button type="submit" class="btn btn-orange waves-effect orange" name="btnNuevaSalida"  ><i class='fa fa-send'> Registrar Orden Salida</i></button>

                </div>
            </div>
        </div>

        <?php echo form_close(); ?>

    </section>

</div> 
