<div style="height: 5vh"></div>
<p class="h1 orange-text text-center">Recuperar Clave</p>
<div style="height: 4vh"></div>
<div class="container">
    <section class="section">

        <?php echo form_open('recupera'); ?>
        <div class="row">
            <?PHP
          messages_flash('red',validation_errors(),'Errores del formulario', true);
		
			//si hay error enviando el email
			messages_flash('red','not_email_send','Error enviando el email');

			//si se ha enviando el email correctamente
			messages_flash('success-color','mail_send','Email enviado correctamente');

			//si hay error enviando el email
			messages_flash('deep-orange','expired_request','Error recuperación password');

			//si hay error modificando el password lo mostramos
			messages_flash('red','error_password_changed','Error modificando el password');
			
			//si se ha modificado el password correctamente
			messages_flash('success-color','password_changed','Password modificado correctamente');
		?>
        </div>

        <div class="row">
            <div class="col-lg-3"></div>
            <div class=" col col-6">
                <div class="md-form">
                    <i class="fa fa-envelope-square fa-3x prefix" aria-hidden="true" ></i>
                    
                    <input type="email" id="userMail" class="form-control" name="txtusuarioEmail" data-parsley-required="true" data-parsley-type="email"
                              data-parsley-trigger="keyup" >

                    <label for="userMail" >Email</label>
                </div>
                <div style="height: 2vh"></div>
               
                <button type="submit" class="btn btn-orange waves-effect orange" name="btnRecuperaClave" > <i class='fa fa-lock'> </i> Recuperar Contraseña</button>
               

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
