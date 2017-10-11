<style>
    .imagencard{
        width: 350px;
        height: 200px;
    }
</style>
<h1 class="h1-responsive text-center orange-text">Perfil Colaborador </h1>
<!-- ****** Team Section****** -->
<div class="container">
    <section class="section">
        
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-md-7">
                <!--Card-->
               
                <div class="card testimonial-card">

                    <!--Bacground color-->
                    <div class="card-up indigo lighten-1">
                    </div>

                    <!--Avatar-->
                    <div class="avatar"><img src="<?PHP echo base_url(); ?>/public/img/woman-1594711_1920.jpg" class="mx-auto d-block imagencard " alt="img">
                    </div>

                    <div class="card-body">
                        <!--Name-->
                        <h4 class="card-title"></h4>
                        <hr>
                        <!--Quotation-->

                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-6">
                                <?php echo form_open('ColaboradorController/actualizarPerfilCola'); ?>
                                <input type="hidden" name="idUsuario" value="<?= $this->session->userdata('idUsuario') ?>">
                                <p class="badge badge-orange">Rol</p><p><?= $mrol->tipoRol ?><br><br>
                                <p class="badge badge-green">Nombre Completo</p><p><input type="text" class="form-control" name="txtNombCompl" value="<?php echo $perfil->nombreCompleto; ?>" data-parsley-required="true" data-parsley-trigger="keyup" data-parsley-length="[6, 10]" ></p><br><br>
                                <p class="badge badge-green">Nombre de Usuario</p><p><input type="text" class="form-control" name="txtusuarioco" value="<?php echo $perfil->NombreUsuario; ?>"  data-parsley-required="true" data-parsley-trigger="keyup"></p><br><br>
                                <p class="badge badge-green">Correo Electronico</p><p><input type="email" class="form-control" name="txtemail" value="<?php echo $perfil->email; ?>" data-parsley-required="true" data-parsley-trigger="keyup" data-parsley-type="email"></p><br><br>
                            </div>

                        </div>
                        <div class="flex-center">
                            <button type="submit" class="btn btn-orange waves-effect orange" name="btnEditarPerfilColabora"><i class='fa fa-edit'> Actualizar Perfil Colaborador</i></button>
                        </div>

                    </div>
                    <?php echo form_close(); ?>
                </div>
                <!--/.Card-->
            </div>
        </div>
    </section>
   
      
    
</div>
  <div class="row flex-center">
            <div class="col-8">
                <?php if (validation_errors()): ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo validation_errors(); ?> 

                    </div>
                <?php endif; ?>
                


        </div>
  </div>