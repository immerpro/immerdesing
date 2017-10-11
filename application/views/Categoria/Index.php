<div class="container" >
    <section class="section">
        <p class="display-4 orange-text flex-center">Listado de Categorias</p>
        <div style="height: 5vh"></div> 
        <div class="form-inline flex-center">
            <div class="row">
                <?php echo form_open('CategoriaController'); ?>
                <div class="md-form form-group">
                    <input type="search" name="txtbuscar" id="buscar" required="required" class="form-control" data-parsley-required="true">
                    <label for="buscar" class="badge badge-warning"> <i class="fa fa-search"></i> busqueda</label>
                </div>  

                <div class="form-group">
                    <button class="btn btn-orange " type="submit"> <i class="fa fa-search"></i>  Buscar</button>
                </div>

            </div>
        </div>
        <div style="height: 5vh"></div>
        <?php echo $div1 . $table; ?>
        <?php echo form_close(); ?>
    </section>
</div>
