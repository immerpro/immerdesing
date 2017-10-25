<br>
<br>
<br>

<div style="height: 11vh"></div>
<p class="h1 orange-text text-center">Recuperar Clave</p>
<div style="height: 30vh"></div>
<div class="container">
    <section >
        <div>
            <?php echo form_open('recupera'); ?>
            <div class="row">
                <?PHP
                messages_flash('red', validation_errors(), 'Errores del formulario', true);

                //si hay error enviando el email
                messages_flash('red', 'not_email_send', 'Error enviando el email');

                //si se ha enviando el email correctamente
                messages_flash('success-color', 'mail_send', 'Email enviado correctamente');

                //si hay error enviando el email
                messages_flash('deep-orange', 'expired_request', 'Error recuperación password');

                //si hay error modificando el password lo mostramos
                messages_flash('red', 'error_password_changed', 'Error modificando el password');

                //si se ha modificado el password correctamente
                messages_flash('success-color', 'password_changed', 'Password modificado correctamente');
                ?>
            </div>
            <center>

                <div class="col-xs-6 col-sm-6 col-md-6 panel panel-primary" style="margin-left: 280px; margin-top: -40px;">
                    <div class="form-group ">
                        <i class="fa fa-envelope-square fa-2x prefix" aria-hidden="true" ></i>    <label for="userMail" >Email</label>

                        
                        <input type="email" id="userMail" class="form-control" name="txtusuarioEmail" data-parsley-required="true" data-parsley-type="email"
                               data-parsley-trigger="keyup" >
                    </div>


                </div>  
        </div>

<br>
<br>



        <div style="height: 1.5vh"></div>

        <button style="margin-left: -400px;" type="submit" class="btn btn-orange waves-effect orange" name="btnRecuperaClave" > <i class='fa fa-lock'> </i> Recuperar Contraseña</button>



</div></center>
</div>
</section>

</div>

<script>
    $(document).ready(function () {
        $('form').parsley();
    });
</script>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php echo form_close(); ?>
