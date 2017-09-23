<div class="container" >
    <section class="section" data-parsley-validate>
        <div style="height: 5vh"></div> 
        <p class="display-4 orange-text flex-center">Listado de Productos</p>
        <p class="lead">indicador de inventario</p>

        <div class="row">
            <div class="col-5">
                <span class="badge badge-danger"><div style="width:5vh;"></div></span>
                <div class="tooltip" ></div>
                inventario por agotarse <i class="fa fa-info-circle fa-2x red-text" title="las existencias son menores que el minimo stock"></i>
            </div>
        </div>
        <div class="row">
            <div class="col-5">
                <span class="badge badge-warning"><div style="width:5vh;"></div></span>
                exceso de inventario<i class="fa fa-info-circle fa-2x orange-text" title="las existencias son mayores que el maximo stock"></i>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <span class="badge badge-info"><div style="width:5vh;"></div></span>
                inventario estable<i class="fa fa-info-circle fa-2x blue-text" title="las existencias son iguales que el maximo stock"></i>
            </div>
        </div>
        <?php if ($this->session->flashdata('sinInactivar')): ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $this->session->flashdata('sinInactivar'); ?> 
            </div>

        <?php endif; ?>
        <?php if ($this->session->flashdata('Inactivar')): ?>
            <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $this->session->flashdata('Inactivar'); ?> 
            </div>

        <?php endif; ?>
        <?php echo form_open('producto'); ?>
        <span ><?php echo validation_errors(); ?></span>
        <div class="form-inline flex-center">
            <div class="row">

                <div class="md-form form-group">
                    <input type="search" name="txtbuscar" id="buscar" required="required" class="form-control" data-parsley-required="true">
                    <label for="buscar" class="badge badge-warning"> <i class="fa fa-search"></i> busqueda</label>
                </div>  

                <div class="form-group">
                    <select name="ddlfiltro" class="form-control" data-parsley-required="true">
                        <option value="NombreProducto">Producto</option>   
                        <option value="NombreSubCategoria">Subcategoria</option>   
                    </select> 
                    <button class="btn btn-orange " type="submit"> <i class="fa fa-search"></i>  Buscar</button>
                </div>

            </div>
        </div>
        <?php echo $div1 . $table; ?>

        <?php echo form_close(); ?>
    </section>
</div>
