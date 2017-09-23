<div style="height: 5vh"></div>
<?php echo form_open('Subcategoria/SubInCategoria'); ?>  
<input type="hidden" name="codigoCategoria" value="<?= $codcategoria ?>">
<h1 class="h1 orange-text text-center">subcategoria de <?= $nombrecategoria ?></h1>
<div style="height: 5vh"></div>
<div class="flex-center">
    <table>
        <tr>
            <td>

                <div class="md-form">
                    <i class="fa fa-folder-o fa-2x prefix "></i>
                    <input type="text" id="form1" class="form-control" name="NombreSubcategoria">
                    <label for="form1" class="">Subcategoria</label>
                </div>
            </td>
        </tr>

        <tr>
            <td>

                <i class="fa fa-pencil-square-o fa-2x prefix "></i>
                <label for="form1" class="">Detalle de Subcategoria</label>

                <textarea rows="10" cols="90" placeholder="Detalle Subcategoria" name="detalSubCategoria"></textarea> 

            </td>
        </tr>

        <tr><td> <button type="submit" class="btn btn-orange waves-effect orange" ><i class='fa fa-send'> Crear SubCategoria</i></button></td></tr>
    </table>
</div>
<?php echo form_close(); ?>
<div class="col-9 ">
    <span class="alert-danger close"><?php echo validation_errors(); ?></span> 
</div>
