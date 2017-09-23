<div class="container" >

    <section class="section">
        <div class="row">
             <div class="col-6 ">
                <span class="alert-danger close"><?php echo validation_errors(); ?></span> 
            </div>

        </div>
       
<?php if ($this->session->flashdata('correcto')): ?>
    <div class=" alert alert-success" ><?php echo $this->session->flashdata('correcto'); ?> </div> 
<?php endif; ?>
<?php if ($this->session->flashdata('incorrecto')): ?>
    <div class=" alert alert-danger" ><?php echo $this->session->flashdata('incorrecto'); ?> </div> 
<?php endif; ?>


        <p class="display-4 green-text flex-center">MODIFICAR PROVEEDOR</p>
        <br><br>
        <?php echo form_open('Proveedor/ProveedorActualizado/'.$id); ?>
          <div class="row">
           <div class="col col-5">
                
        <div class="md-form">
            <br>
            <input type="text" name="txtNProveedor"  id="nproveedor" class="form-control" required="" value="<?=$NombrePr?>"/><br>
            <label for="nproveedor"><i class="fa fa-user fa-3x"></i> Nombre Proveedor</label>
        
    </div>
             <div class="md-form">
                 <br>
                 <input type="text" name="txtNit"  id="nit" class="form-control" required="" value="<?=$nitp?>"/><br>
            <label for="nit"><i class="fa fa-certificate fa-3x"></i> Nit-Proveedor</label>
        
    </div>
             <div class="md-form">
                 <br>
                 <input type="email" name="txtcorreo"  id="email" class="form-control" required="" value="<?=$correo?>"/><br>
            <label for="email" class=""><i class=" fa fa-envelope fa-3x"></i> Correo Electronico</label>
        
    </div>
    </div>
         <div class="col col-5">
        <div class="md-form">
            <br>
            <input type="text" name="txtdireccion"  id="dir" class="form-control" required="" value="<?=$direccion?>"/>
            <label for="dir"><i class="fa fa-archive fa-3x"></i>Dirección</label>
        <br>
    </div>
             <div class="md-form">
                 <br>
                 <input type="text" name="txtcontacto"  id="ctc" class="form-control" required="" value="<?=$nombrecotacto?>"/>
            <label for="ctc"><i class="fa fa-comment fa-3x"></i>Contacto Proveedor</label>
        <br>
    </div>
             <div class="md-form">
                 <br>
                 <input type="text" name="txttelefono"  id="tel" class="form-control" required="" value="<?=$telefono?>"/>
            <label for="tel"><i class="fa fa-train fa-3x "></i>Telefono</label>
        
    </div>
    </div>
            

        </div>

        <div class="flex-center">
            <button type="submit" class="btn btn-success btn-lg ">Modiificar Proveedor</button>


        </div>


        <?php echo form_close(); ?>

    </section>

</div>



