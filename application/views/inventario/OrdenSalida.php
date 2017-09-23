<div class="container">
<div class="flex-center">
    <?php echo form_open('buscador'); ?>
    <span ><?php echo validation_errors(); ?>
       <table>
        <tr>
            <td width="400" height="">
                <div class="md-form">
                    <input type="text" id="form1" class="form-control" name="txtbuscar">
                    <label for="form1" class="">salida</label>
                </div>
            </td>
            <td>
                <div class="btn-group">
                    <select class="form-control" name="ddlfiltro">
                        <option class="dropdown-item" value="productoSaliente" >Producto</option>

                        <option class="dropdown-item" value="motivoSal" >Motivo</option>

                    </select>
                </div>
                <button class="btn btn-orange " type="submit"><i class="fa fa-search"></i>Buscar</button>
            </td>
        </tr>
        <tr>
            <td></td>
        </tr>
    </table>
      
</div>
 <?php echo $div1 . $table; ?>
<?php echo form_close(); ?>
</div>


