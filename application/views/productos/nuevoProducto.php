<div class="container">
    <section class="section" data-parsley-validate>
        <p class="display-4 orange-text flex-center">Nuevo Producto</p>
        <div style="height: 4vh"></div>
        <?php echo form_open('ProductoController/nuevoProducto'); ?>
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
                    <input type="text" id="prod"  class="form-control" name="txtNombProd" data-parsley-trigger="keyup" data-parsley-required-message="el campo no debe estar vacio" data-parsley-required="true">
                    <label for="prod">Producto</label>
                </div> 
            </div>
            <div class="col-6">
                <div class="md-form">
                    <i class="fa fa-book fa-pencil prefix"></i>
                    <textarea type="text" id="descrip" class="md-textarea" name="txtDescripcion"
                              data-parsley-required="true" 
                              data-parsley-trigger="keyup" 
                              data-parsley-required-message="el campo no debe estar vacio">
                                  
                    </textarea>
                    <label for="descrip">Descripciòn</label>
                </div>
            </div>
            <div class="col-6">
                <div class="md-form">
                    <i class="fa fa-battery-1 prefix"></i>
                    <label for="minimo" >minimoStock</label>
                    <input type="text" name="txtMinimo"  id="minimo" class="form-control"  required data-parsley-type="number"  data-parsley-trigger="keyup" data-parsley-required-message="el campo no debe estar vacio" value="<?= set_value('txtMinimo') ?>" /><br />

                </div> 
            </div>
            <div class="col-6">
                <div class="md-form">
                    <i class="fa fa-battery-full fa-plus prefix"></i>
                    <label for="Maximo" >MaximoStock</label>
                    <input type="text" name="txtMaximo" id="Maximo" class="form-control" required data-parsley-type="number" data-parsley-trigger="keyup" data-parsley-required-message="el campo no debe estar vacio" value="<?= set_value('txtMaximo') ?>" data-parsley-gt="#minimo" data-parsley-gt-message="debe ser mayor que el minimo"/><br />

                </div> 
            </div>
            <div class="col-6">
                <div class="md-form">
                    <i class="fa fa-plus-circle prefix"></i>
                    <label for="cantidad" >Cantidad del Producto</label>
                    <input type="text" name="nbCantidadPro" class="form-control"  id="cantidad" required data-parsley-type="number" data-parsley-trigger="keyup" data-parsley-required-message="el campo no debe estar vacio" data-parsley-number-message="debe ingresar numeros" value="<?= set_value('nbCantidadPro') ?>"/><br /> 

                </div>
            </div>
            <div class="col-6">
                <div class="md-form">
                    <i class="fa fa-battery-3 prefix"></i>
                    <label for="exist" >Existencias</label>
                    <input type="text" name="txtExits"  id="exist" class="form-control" required data-parsley-type="number" data-parsley-trigger="keyup" data-parsley-required-message="el campo no debe estar vacio" data-parsley-integer-message="debe ingresar numeros" value="<?= set_value('txtExits') ?>"/><br />
                </div>
            </div>
           <div class="col-6">
                <div class="md-form">
                    <i class="fa fa-barcode prefix"></i>
                    <input type="text"
                           name="txtCodBarras"
                           id="CodigoDeBarras"
                           class="form-control"
                           required
                           data-parsley-type="number"
                           data-parsley-trigger="keyup"
                           data-parsley-minlength="13"
                           data-parsley-maxlength="13"
                           data-parsley-required-message="el campo no debe estar vacio"

                           /><br />
                    <label for="CodigoDeBarras" >Codigo de barras</label>
                </div>
            </div>
            <div class="col-6">
                <div class="md-form">
                    <i class="fa fa-product-hunt prefix"></i>
                    <label for="txtLote" >Lote</label>
                    <input type="text" name="txtLote" class="form-control " data-parsley-required="true" data-parsley-trigger="keyup" data-parsley-required-message="el campo no debe estar vacio" value="<?= set_value('txtLote') ?>"/><br /> 

                </div>  
            </div>
            <div class="col-6">
                <i class="fa fa-briefcase fa-2x prefix"></i> 
                <label for="categoria" >Categorìa</label>
                <select name="categoria" class="form-control md-form"  id="categoria" required data-parsley-trigger="keyup">
                    <option value="">seleccione una categorìa</option>
                    <?php foreach ($categorias_select as $itemCategoria): ?>
                        <option value="<?= $itemCategoria['codCategoria'] ?>"><?= $itemCategoria['categoria'] ?></option>
                    <?php endforeach; ?>    
                </select>
            </div>
            <div class="col-6">
                <i class="fa fa-folder-o fa-2x prefix "></i>
                <label for="subcategoria" > Subcategorìa</label>
                <select name="subcategoria" id="subcatego" class="form-control" required data-parsley-trigger="keyup"  >

                    <option value="">selecciona la subcategoria</option>

                </select> 

            </div>
            <div style="height: 3vh"></div>
            <div class="col-6">
                <i class="fa fa-calendar-o  fa-2x prefix"></i>
                <label for="date-picker-example" >Fecha de vencimiento</label>
                <input type="text" id="date-picker-example" name="fvencimiento" class="form-control datepicker" data-parsley-required="true" data-parsley-trigger="keyup" data-parsley-required-message="el campo no debe estar vacio" value="<?= set_value('fvencimiento') ?>"/><br /> 

            </div>
            <script type="text/javascript">
                $(function () {
                    $("#date-picker-example").datepicker({
                        changeMonth: true,
                        changeYear: true
                    });
                });
            </script>

            <script>
                $(document).ready(function () {
                    $('form').parsley();
                });
            </script>

        </div>
        <div class="row">
            <div class="col-11">
                <div class="flex-center">
                    <button type="submit" class="btn btn-orange waves-effect orange" name="btnNuevoProducto" data-toggle="modal" data-target="#envio" ><i class='fa fa-send'> Crear Producto</i></button>

                </div>
            </div>
        </div>




        <?php echo form_close(); ?>

    </section>

</div>