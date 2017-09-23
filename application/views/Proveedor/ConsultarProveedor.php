<div class="container" >

    <section class="section">
        <p class=" orange-text flex-center h1-responsive">Proveedores del minimercado</p>
        <div class="form-inline flex-center">
            <div class="row">
                <?php echo form_open('proveedor'); ?>
                <div class="md-form form-group">
                    <input type="search" name="txtbuscar" id="buscar" required="required" class="form-control" data-parsley-required="true">
                    <label for="buscar" class="badge badge-warning"> <i class="fa fa-search"></i> busqueda</label>
                </div>  
                <div class="form-group">
                    <select name="ddlfiltro" class="form-control" data-parsley-required="true">
                        <option value="NombreProveedor">Nombre Proveedor</option>   
                        <option value="nit">NIT Proveedor</option>   
                    </select> 
                    <button class="btn btn-orange " type="submit"> <i class="fa fa-search"></i>  Buscar</button>
                </div>


            </div>
        </div>
        <?php echo $div1 . $table; ?>
        <?php echo form_close(); ?>

    </section>
</div>