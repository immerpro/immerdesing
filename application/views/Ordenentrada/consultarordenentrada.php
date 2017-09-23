<div class="container" >
    <section class="section" data-parsley-validate>
        <div style="height: 5vh"></div> 
        <p class="display-4 orange-text flex-center">Consulta de Orden Entrada</p>
        <?php echo form_open('inventario/consultarordenentrada'); ?>
        <span ><?php echo validation_errors(); ?></span>
        <div class="form-inline flex-center">
            <div class="row">

                <div class="md-form form-group">
                    <input type="text" id="form1" class="form-control" name="txtbuscar">
                    <label for="form1" class="">entrada</label>
                </div>  

                <div class="form-group">
                    <select name="filtro" class="form-control" data-parsley-required="true">
                        <option value="producto">Producto</option>   
                        <option value="proveedor">Proveedor</option>   
                    </select>
                    <button class="btn btn-orange " type="submit"> <i class="fa fa-search"></i>  Buscar</button>
                </div>

            </div>
        </div>
        <?php echo $div1 . $table; ?>

        <?php echo form_close(); ?>
    </section>
</div>
