<div style="height: 5vh"></div>
<p class="h1 orange-text text-center">Iniciar sesión</p>
<div style="height: 4vh"></div>
<div class="container">
    <section class="section">

        <?php echo form_open('ingresar'); ?>
        <div class="flex-center">
            <div class="alert-danger"><?php echo validation_errors(); ?></div> 
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
            <input type="hidden" name="token" value="<?= $token ?>">
            <input type="text" id="user" class="form-control" name="txtusuario" required="required">

            <label for="user" >Usuario</label>
        </div>
        <div style="height: 2vh"></div>
        <div class="md-form">
            <i class="fa fa-lock fa-3x prefix" aria-hidden="true"></i>
            <input type="password" id="pass" class="form-control" name="txtpassword" required="required">
            <label for="pass" >Contraseña</label>
        </div>
        <button type="submit" class="btn btn-orange waves-effect orange" name="btnLogin" ><i class='fa fa-send'> Ingresar</i></button>
        <a class=" lead teal-text" href="<?php echo base_url() ?>olvido">Olvido su contraseña</a> 

    </div> 
</div>

</section>

</div>

<?php echo form_close(); ?>
