<div style="height: 5vh"></div>
<p class="h1 orange-text text-center">Autorización</p>
<div style="height: 4vh"></div>
<div class="container">
    <section class="section data-parsley-validate">

        <?php echo form_open('AdminController/colaboradorAutorizado'); ?>

        <div class="row">
            <script type="text/javascript">
                alertify.success("bienvenido Admin <?= $this->session->userdata('usuario') ?> a la secciòn de habilitar y dar permisos a los colaboradores");

            </script>
            <div class="col-lg-3"></div>
            <div class=" col col-6">
                <?php echo form_open('authCol'); ?>
                <div >
                    <i class="fa fa-users fa-3x prefix" aria-hidden="true" ></i>
                    <label for="user" class="badge badge-green" >Colaborador</label>
                    <?php if ($colaboradores): ?>
                          <select name="cboColabora" class="form-control" required data-parsley-trigger="keyup">
                              <option value="">- seleccione un colaborador-</option>
                            <?php foreach ($colaboradores as $lcolabora): ?>
                                <option value="<?= $lcolabora['idUsuario'] ?>"><?= $lcolabora['nombreCompleto'] ?></option>
                            <?php endforeach; ?>
                              </select>
                        <?php else: ?>
                        <p class="lead">no hay colaboradores para ser habilitados</p>
                        <?php endif; ?>

                </div>
                <div style="height: 2vh"></div>
                 <?php if ($colaboradores): ?>
                <button type="submit" class="btn btn-orange waves-effect orange" name="btnHabilita" ><i class='fa fa-send'></i> Habilitar Colaborador</button>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>


<?php echo form_close(); ?>
