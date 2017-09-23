<div style="height: 5vh"></div>
<p class="h1 orange-text text-center">Recuperar Contraseña</p>
<div style="height: 4vh"></div>
<div class="container">
    <section class="section">

        <?php echo form_open('UsuarioController/actualizaClave'); ?>
        <div class="row">
            <div class="col-lg-6 ">
                <div class="alert-danger"><?php echo validation_errors(); ?></div> 
            </div>
            <div class="col-lg-6">
                <?php if ($this->session->flashdata('usuario_mal')): ?>
                    <div class="alert alert-success"><?= $this->session->flashdata('usuario_mal') ?></div> 
                <?php endif; ?>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-3"></div>
            <div class=" col col-6">
                <div class="md-form">
                    <i class="fa fa-user fa-3x prefix" aria-hidden="true" ></i>

                    <input type="password" id="userPass" class="form-control" name="txtusuarioPass" data-parsley-required="true" 
                           data-parsley-trigger="keyup" >

                    <label for="userPass" >Nueva Contraseña</label>
                </div>
                <div style="height: 2vh"></div>
                <div class="md-form">
                    <i class="fa fa-lock fa-3x prefix" aria-hidden="true"></i>
                    <input type="password" id="pass" class="form-control" name="txtRespassword" data-parsley-required="true" 
                           data-parsley-trigger="keyup" data-parsley-equalto="#userPass">
                    <label for="pass" > Confirmar Contraseña</label>
                </div>
                <input type="hidden" name="token" value="<?php echo $token ?>">
                <button type="submit" class="btn btn-orange waves-effect orange" name="btnRecuperaClave" > <i class='fa fa-send'> </i> Cambiar Contraseña</button>


            </div> 
        </div>
   
    </section>

</div>
<script>
    $(document).ready(function () {
        $('form').parsley();
    });
</script>

<?php echo form_close(); ?>
