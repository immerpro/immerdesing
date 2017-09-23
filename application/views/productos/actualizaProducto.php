<div class="container">
    <section class="section"data-parsley-validate>
        <p class="display-4 orange-text flex-center">Producto a Actualizar</p>
        <div style="height: 4vh"></div>
        <?php echo form_open('ProductoController/ProductoActualizado/' . $id); ?>
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
                    <input type="text" id="prod" class="form-control" name="txtNombProd" data-parsley-trigger="keyup" data-parsley-required-message="el campo no debe estar vacio" value="<?= $producto ?>">
                    <label for="prod">Producto</label>
                </div> 
            </div>
            <div class="col-6">
                <div class="md-form">
                    <i class="fa fa-pencil prefix"></i>
                    <textarea type="text" id="descrip" class="md-textarea" name="txtDescripcion"
                              data-parsley-required="true" 
                              data-parsley-trigger="keyup" 
                              data-parsley-required-message="el campo no debe estar vacio">

                        <?= $descripcion ?>
                    </textarea>
                    <label for="descrip">Descripciòn</label>
                </div>
            </div>
            <div class="col-6">
                <div class="md-form">
                   <i class="fa fa-battery-1 prefix"></i>
                    <label for="minimo" >minimoStock</label>
                    <input type="text" name="txtMinimo"  id="minimo" class="form-control"  required data-parsley-type="number"  data-parsley-trigger="keyup" data-parsley-required-message="el campo no debe estar vacio" value="<?= $minStock ?>" /><br />

                </div> 
            </div>
            <div class="col-6">
                <div class="md-form">
                    <i class="fa fa-battery-full fa-plus prefix"></i>
                    <label for="Maximo" >MaximoStock</label>
                    <input type="text" name="txtMaximo" id="Maximo" class="form-control" required data-parsley-type="number" data-parsley-trigger="keyup" data-parsley-required-message="el campo no debe estar vacio"  data-parsley-gt="#minimo" data-parsley-gt-message="debe ser mayor que el minimo" value="<?= $maxStock ?>"/><br />

                </div> 
            </div>

            <div class="col-6">
                <div class="md-form">
                  <i class="fa fa-battery-3 prefix"></i>
                    <label for="exist" >Existencias</label>
                    <input type="text" name="txtExits"  id="exist" class="form-control" required data-parsley-type="number" data-parsley-trigger="keyup" data-parsley-required-message="el campo no debe estar vacio" data-parsley-integer-message="debe ingresar numeros" value="<?= $exist ?>"/><br />
                </div>
            </div>
            <div class="col-6"></div>
            <div class="col-8">
                <p class=" h5 teal-text">Si desea cambiar la subcategorìa del producto por favor seleccione una categorìa de lo contrario dar click en el boton actualizar producto</p><br>

            </div>

            <div class="col-6">
                <label for="categoria" > <i class="fa fa-briefcase fa-2x prefix"></i> Categorìa <span class="badge badge-mdb-color h6"><?= $nombreCategoria->categoriaN ?></span></label>
                <select name="categoria" class="form-control md-form"  id="categoria" required data-parsley-trigger="keyup">
                    <option value="99">-seleccione una categoria-</option>

                    <?php foreach ($categorias_select as $itemCategoria): ?>

                        <?php if ($nombreCategoria->categoriaN == $itemCategoria['categoria']): ?>
                            <option value="<?= $itemCategoria['codCategoria'] ?>"><?= $itemCategoria['categoria'] ?></option>

                        <?php else: ?>
                            <option value="<?= $itemCategoria['codCategoria'] ?>"><?= $itemCategoria['categoria'] ?></option>

                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-6">
                <label for="subcategoria" > <i class="fa fa-folder-o fa-2x prefix "></i> Subcategorìa <span class="badge badge-mdb-color h6"><?= $nombreSub->NombreSubcategoria ?></span></label>
                <select name="subcategoria" id="subcatego" class="form-control" required data-parsley-trigger="keyup"  >
                    <?php if ($this->input->post('categoria') == 99): ?>
                        <option value="4">Lacteos</option>

                    <?php else: ?>
                        <option value="<?= $idsub ?>"><?= $nombreSub->NombreSubcategoria ?></option>

                    <?php endif; ?>
                </select> 
            </div>
        </div>
        <div class="row">
            <div class="col-11">
                <div class="flex-center">

                    <button type="submit" class="btn btn-orange waves-effect orange" name="btnEditaProducto"><i class='fa fa-edit'> Actualizar Producto</i></button>

                </div>
            </div>
        </div>
        <?php echo form_close(); ?>

    </section>

</div>
