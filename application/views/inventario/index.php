<style>
    .img-peque{
        width:80px ;
        height:80px;
    }
</style>
<main class="col-sm-9 ml-sm-auto col-md-11 pt-3" role="main">
    <h1 class="h1-responsive text-center orange-text">Notificaciones del Inventario</h1>

    <section class="row text-center placeholders">
        <div class="col-5 col-sm-2 placeholder">

            <img src="data:image/gif;base64,R0lGODlhAQABAIABAADcgwAAACwAAAAAAQABAAACAkQBADs="  class="img-fluid rounded-circle img-peque" alt="Generic placeholder thumbnail">
            <h4>Productos Vencidos</h4>
            <div class="text-muted"><i class="fa fa-bell fa-3x"> </i>
                <?php if ($cvencidos->cantVencido == 0): ?>
                    <h2> <span class="grey-text" id="cantivencido"> no hay productos vencidos</span> </h2>

                <?php else: ?>
                    <h2> <span class="badge badge-grey" id="cantivencido"> <?= $cvencidos->cantVencido ?></span> </h2>
                    <a class="btn btn-link waves-button waves-effect bg-grey" href="" data-toggle="modal" data-target="#basicExample">Ver</a>
                <?php endif; ?>

            </div>
        </div>
        <div class="col-5 col-sm-2 placeholder">

            <img src="data:image/gif;base64,R0lGODlhAQABAIABAAJ12AAAACwAAAAAAQABAAACAkQBADs="  class="img-fluid rounded-circle img-peque bg-grey" alt="Generic placeholder thumbnail">
            <h4>Productos por vencerse</h4>
            <div class="indigo-text"><i class="fa fa-bell fa-3x"> </i>

                <h2> <span class="badge badge-indigo" id="cantivencido"> <?= $vence->cuantovencerse ?></span> </h2>
                <a class="btn btn-link waves-button waves-effect bg-indigo" href="" data-toggle="modal" data-target="#vencimiento">Ver</a>


            </div>
        </div>
        <div class="col-5 col-sm-2 placeholder">
            <img src="data:image/gif;base64,R0lGODlhAQABAIABAADcgwAAACwAAAAAAQABAAACAkQBADs=" class="img-fluid rounded-circle img-peque" alt="Generic placeholder thumbnail">
            <h4>Productos Agotados</h4>
            <?php if ($cantAgotados->agotados == 0): ?>
                <div class="text-muted"><i class="fa fa-bell-slash-o fa-3x red-text"> </i>
                    <h2> <span class="red-text" id="cantivencido"> no hay productos agotados</span> </h2>
                </div>
            <?php else: ?>
                <div class="text-muted"><i class="fa fa-bell-slash-o fa-3x red-text"> </i>
                    <h2> <span class="badge badge-red">
                            <?= $cantAgotados->agotados ?>
                        </span> </h2>
                    <a class="btn btn-link waves-button waves-effect bg-danger" data-toggle="modal" data-target="#modalagotado" href="">Ver</a>

                </div>
            <?php endif; ?>

        </div>
        <div class="col-5 col-sm-2 placeholder">
            <img src="data:image/gif;base64,R0lGODlhAQABAIABAAJ12AAAACwAAAAAAQABAAACAkQBADs="  class="img-fluid rounded-circle img-peque" alt="Generic placeholder thumbnail">
            <h4>Productos por Agotarse </h4>
            <div class="text-muted">
                <div class="text-muted"><i class="fa fa-bell-o fa-3x orange-text"> </i>

                    <?php if ($cporAgotarse->cuantoAgotarse == 0): ?>
                        <h2> <span class="orange-text">
                                no hay productos por agotarse
                            </span> </h2>
                    <?php else: ?>
                        <h2> <span class="badge badge-deep-orange">
                                <?= $cporAgotarse->cuantoAgotarse ?>
                            </span> </h2>
                        <a class="btn btn-link waves-button waves-effect bg-warning"  data-toggle="modal" data-target="#agotarse" href="">Ver</a>


                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-5 col-sm-2 placeholder">
            <img src="data:image/gif;base64,R0lGODlhAQABAIABAADcgwAAACwAAAAAAQABAAACAkQBADs="  class="img-fluid rounded-circle img-peque" alt="Generic placeholder thumbnail">
            <h4>Notificaciones</h4>
            <span class="text-muted"><i class="fa fa-server fa-3x green-text"></i></span>
            <h2><span class="badge badge-green"><i class="fa fa-bell"> </i> </span></h2>
            <a class="btn btn-link waves-button waves-effect bg-faded bg-dark-green" href="<?= site_url('inventario/notificar') ?>">Recibir Notificaciones por Correo Electrònico</a>

        </div>
    </section>
    <div style="height: 4vh"></div>
    <script>

        function notificacion() {
            alertify.log("Bienvenido(a) <?= $this->session->userdata('apellidos') ?>  al modulo de notificaciones,\n\
 podra ver las notificaciones de los inventarios.");
            return false;
        }

    </script>

    <script>

        function notificacionExistenciaTotal() {
            alertify.success(" productos en Existencias  <?= $existenciaTotal->ExistenciaTotal ?>");
            return false;

        }

    </script>




    <!-- modales con informacion -->
    <!-- Modal -->
    <div class="modal fade" id="basicExample" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header">
                    <h4 class="modal-title w-100" id="myModalLabel">Productos vencidos</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <table class="table table-bordered table-hover ">
                        <thead class="table-inverse bg-grey">
                            <tr>
                                <th>Producto</th>
                                <th>Fecha vencimiento</th>
                                <th>Dias para vencerse</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php foreach ($mostrarVencidos as $listadov): ?>
                                    <td><?= $listadov['producto'] ?></td>
                                    <td><?= $listadov['fvencimiento'] ?></td>
                                    <?php if ($listadov['fvencimiento'] <= date("Ymd")): ?>
                                        <td>0</td>
                                    <?php else: ?>
                                        <td><?= $listadov['dvencimiento'] ?></td>
                                    <?php endif; ?>


                                </tr>
                            <?php endforeach; ?>

                        </tbody>

                    </table>
                </div>
                <!--Footer-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-grey" data-dismiss="modal">Close</button>

                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <!--fdfgfgfgfdgfgfghhghfhghghggfhhhggfhg-->
    <!-- Modal -->
    <div class="modal fade" id="vencimiento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header">
                    <h4 class="modal-title w-100" id="myModalLabel">Productos  por vencerse</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <table class="table table-bordered table-hover ">
                        <thead class="table-inverse bg-indigo">
                            <tr>
                                <th>Producto</th>
                                <th>Fecha vencimiento</th>
                                <th>Dias para vencerse</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php foreach ($mostrarporVencer as $listadov): ?>

                                    <?php if ($listadov['fvencimiento'] <= date("Ymd")): ?>

                                    <?php else: ?>
                                        <td><?= $listadov['producto'] ?></td>
                                        <td><?= $listadov['fvencimiento'] ?></td>
                                        <td><?= $listadov['dvencimiento'] ?></td>
                                    <?php endif; ?>

                                </tr>
                            <?php endforeach; ?>

                        </tbody>

                    </table>
                </div>
                <!--Footer-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-grey" data-dismiss="modal">Close</button>

                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <!--gfgfdggfgfffgfgggfdgfhghhgfhggfhhghg-->
    <!-- Modal -->
    <!-- Modal PRODUCTOS AGOTADOS -->
    <div class="modal fade" id="modalagotado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header">
                    <h4 class="modal-title w-100" id="myModalLabel">Productos Agotados</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <p>se sugiere al administrador que realize un pedido de los siguientes productos por favor comunicarse con el respectivo proveedor</p>
                    <table class="table table-bordered table-hover ">
                        <thead class="table-inverse bg-red">
                            <tr>
                                <th>Producto</th>
                                <th>Estado</th>
                                <th>Existencias</th>


                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php foreach ($mostrarAgotado as $listagotados): ?>
                                    <td><?= $listagotados['producto'] ?></td>
                                    <td>
                                        <?php if ($listagotados['estado'] == 4): ?>
                                            <span class="badge badge-danger">AGOTADO</span>
                                        <?php endif; ?>

                                    </td>
                                    <td><?= $listagotados['existencia'] ?></td>


                                </tr>
                            <?php endforeach; ?>

                        </tbody>

                    </table>
                </div>
                <!--Footer-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-grey" data-dismiss="modal">Close</button>

                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <!-- Modal -->
    <!-- Modal PRODUCTOS  X AGOTARSE -->
    <div class="modal fade" id="agotarse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header">
                    <h4 class="modal-title w-100" id="myModalLabel">Productos Por Agotarse</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <p>se sugiere al administrador que realize un pedido de los siguientes productos por favor comunicarse con el respectivo proveedor</p>
                    <table class="table table-bordered table-hover ">
                        <thead class="table-inverse bg-warning">
                            <tr>
                                <th>Producto</th>
                                <th>Estado</th>
                                <th>Existencias</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php foreach ($listXAgotarse as $porAgotarse): ?>
                                    <td><?= $porAgotarse['producto'] ?></td>
                                    <td>
                                        <?php if ($porAgotarse['estado'] == 1): ?>
                                            <span class="badge badge-primary">ACTIVO</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $porAgotarse['existencia'] ?></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>

                    </table>
                </div>
                <!--Footer-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-grey" data-dismiss="modal">Close</button>

                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <!-- Modal -->
</div>
</main>
<script> notificacion();</script>
<script> notificacionExistenciaTotal();</script>
<?php if ($diavence->fvencimiento <= date("Ymd")): ?>

<?php else: ?>
    <script type="text/javascript">

        Push.create("Dias por vencerse", {
            body: "El producto <?= $diavence->producto ?> se vence en <?= $diavence->dvencimiento ?> dias ",
            icon: "<?php echo base_url() ?>public/img/medd_logo.png",
            timeout: 4000
        });
        this.close();

    </script>

<?php endif; ?>
