<div style="height: 5vh"></div>
<div class="container" >
    <section class="section">
        <p class="display-4 orange-text text-center">Restauraciòn Informaciòn</p>
        <div style="height: 4vh"></div>

        <p class="lead">
            en esta seccion podra ver la informacion que esta inactiva y tendra la opcion 
            de activarla nuevamente por favor dar click sobre los modulos que desee ver
            por ejemplo si quiero ver las categorias eliminadas dar click sobre 
            categorìa y se desplegara la informaciòn solicitada
        </p>
        <div class="row flex-center">

            <div class="col-8"> 
                <!--Accordion wrapper-->
                <div class="accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

                    <!-- Accordion card -->
                    <div class="card">

                        <!-- Card header -->
                        <div class="card-header" role="tab" id="headingOne">
                            <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <h5 class="mb-0">
                                    Categorìa <i class="fa fa-angle-down rotate-icon"></i>
                                </h5>
                            </a>
                        </div>
                        <!-- Card body -->
                        <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">

                            <div class="card-body">
                                <?php if ($listadoCategoriaDel): ?>
                                    <table class="table table-bordered table-hover ">
                                        <thead class="table-inverse">
                                            <tr>
                                                <th>Categorìa</th>
                                                <th>Detalle</th>
                                                <th>Activar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php foreach ($listadoCategoriaDel as $listadoCat): ?>
                                                    <td><?= $listadoCat['NombreCategoria'] ?></td>
                                                    <td><?= $listadoCat['detalles'] ?></td>
                                                    <td>
                                                        <a class="grey-text"  title="activar" href=" <?php echo base_url() . 'reestablecer/activoCategoria/' . $listadoCat['idCategoria'] ?>" ><i class="fa fa-check-circle-o fa-3x" ></i></a>

                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>

                                        </tbody>

                                    </table>
                                <?php else: ?>
                                    <p class="lead">
                                        no hay categorias eliminadas
                                    </p>   
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>

                    <!-- Accordion card -->
                    <!-- Accordion card -->
                    <div class="card">

                        <!-- Card header -->
                        <div class="card-header" role="tab" id="headingTwo">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <h5 class="mb-0">
                                    Subcategorìa <i class="fa fa-angle-down rotate-icon"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="card-body">
                                <?php if ($listadosubcategoria): ?>
                                    <table class="table table-bordered table-hover ">
                                        <thead class="table-inverse">
                                            <tr>
                                                <th>SubCategorìa</th>
                                                <th>Detalle</th>
                                                <th>Activar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php foreach ($listadosubcategoria as $listadosubcat): ?>
                                                    <td><?= $listadosubcat['NombreSubcategoria'] ?></td>
                                                    <td><?= $listadosubcat['detallesSub'] ?></td>
                                                    <td>
                                                        <a class="grey-text"  title="activar" href=" <?php echo base_url() . 'reestablecer/activarsubcategoria/' . $listadosubcat['idSubcategoria'] ?>" ><i class="fa fa-check-circle-o fa-3x" ></i></a>

                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>

                                        </tbody>

                                    </table>
                                <?php else: ?>
                                    <p class="lead">
                                        no hay subcategorias inactivas 
                                    </p>   
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Accordion card -->
                    <div class="card">

                        <!-- Card header -->
                        <div class="card-header" role="tab" id="headingTwo">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseFour" aria-expanded="false" aria-controls="collapseTwo">
                                <h5 class="mb-0">
                                    producto <i class="fa fa-angle-down rotate-icon"></i>
                                </h5>
                            </a>
                        </div>
                        <!-- Card body -->
                        <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="card-body">
                                <?php if ($listadoproducto): ?>
                                    <table class="table table-bordered table-hover ">
                                        <thead class="table-inverse">
                                            <tr>
                                                <th>Producto</th>
                                                <th>Detalle</th>
                                                <th>Activar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php foreach ($listadoproducto as $listapro): ?>
                                                    <td><?= $listapro['NombreProducto'] ?></td>
                                                    <td><?= $listapro['DescripcionProducto'] ?></td>
                                                    <td>
                                                        <a class="grey-text"  title="activar" href=" <?php echo base_url() . 'reestablecer/activarproducto/' . $listapro['idProducto'] ?>" ><i class="fa fa-check-circle-o fa-3x" ></i></a>

                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>

                                        </tbody>

                                    </table>
                                <?php else: ?>
                                    <p class="lead">
                                        no hay productos inactivos 
                                    </p>   
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card">

                        <!-- Card header -->
                        <div class="card-header" role="tab" id="headingThree">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <h5 class="mb-0">
                                    Proveedor <i class="fa fa-angle-down rotate-icon"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                            <div class="card-body">  <!--listadoproveedores-->
                                <?php if ($listadoproveedores): ?>
                                    <table class="table table-bordered table-hover ">
                                        <thead class="table-inverse">
                                            <tr>
                                                <th>Telefono</th>
                                                <th>Nombre Proveedor</th>
                                                <th>Contacto</th>
                                                <th>Direccion</th>
                                                <th>Correo</th>
                                                <th>Activar</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php foreach ($listadoproveedores as $listadoProvee): ?>
                                                    <td><?= $listadoProvee['TelefonoProveedor'] ?></td>
                                                    <td><?= $listadoProvee['NombreProveedor'] ?></td>
                                                    <td><?= $listadoProvee['NombreContacto'] ?></td>
                                                    <td><?= $listadoProvee['DireccionProveedor'] ?></td>
                                                    <td><?= $listadoProvee['CorreoElectronicoProveedor'] ?></td>
                                                    <td>
                                                        <a class="grey-text"  title="activar" href=" <?php echo base_url() . 'reestablecer/activoProveedor/' . $listadoProvee['idProveedor'] ?>" ><i class="fa fa-check-circle-o fa-3x" ></i></a>

                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>


                                        </tbody>

                                    </table>
                                <?php else: ?>
                                    <p class="lead">
                                        no hay proveedores inactivos 
                                    </p>   
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="card">

                        <!-- Card header -->
                        <div class="card-header" role="tab" id="headingThree">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseFive" aria-expanded="false" aria-controls="collapseThree">
                                <h5 class="mb-0">
                                    Colaboradores Registrados <i class="fa fa-angle-down rotate-icon"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapseFive" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                            <div class="card-body">  <!--listadoproveedores-->
                                <?php if ($listadocolaborador): ?>
                                    <table class="table table-bordered table-hover ">
                                        <thead class="table-inverse">
                                            <tr>
                                                <th>Usuario</th>
                                                <th>Nombre del Colaborador</th>
                                                <th>email</th>
                                                <th>Activar</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php foreach ($listadocolaborador as $listacolabora): ?>
                                                    <td><?= $listacolabora['NombreUsuario'] ?></td>
                                                    <td><?= $listacolabora['nombreCompleto'] ?></td>
                                                    <td><?= $listacolabora['email'] ?></td>

                                                    <td>
                                                        <a class="grey-text"  title="activar" href=" <?php echo base_url() . 'reestablecer/activoColaborador/' . $listacolabora['idUsuario'] ?>" ><i class="fa fa-check-circle-o fa-3x" ></i></a>

                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>


                                        </tbody>

                                    </table>
                                <?php else: ?>
                                    <p class="lead">
                                        no hay nuevos colaboradores registrados
                                    </p>   
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Accordion card  colaboradoes activos-->
                    <div class="card">

                        <!-- Card header -->
                        <div class="card-header" role="tab" id="headingThree">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseSix" aria-expanded="false" aria-controls="collapseThree">
                                <h5 class="mb-0">
                                    Colaboradores Activos <i class="fa fa-angle-down rotate-icon"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapseSix" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                            <div class="card-body">  <!--listadoproveedores-->
                                <?php if ($listadoactivos): ?>
                                    <table class="table table-bordered table-hover ">
                                        <thead class="table-inverse">
                                            <tr>
                                                <th>Usuario</th>
                                                <th>Nombre del Colaborador</th>
                                                <th>email</th>
                                                <th>Inactivar</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php foreach ($listadoactivos as $activo): ?>
                                                    <td><?= $activo['NombreUsuario'] ?></td>
                                                    <td><?= $activo['nombreCompleto'] ?></td>
                                                    <td><?= $activo['email'] ?></td>

                                                    <td>
                                                        <a class="badge badge-danger"  title="inactivar" href=" <?php echo base_url() . 'reestablecer/inactivoColaborador/' . $activo['idUsuario'] ?>" ><i class="fa fa-ban fa-3x" ></i></a>

                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>


                                        </tbody>

                                    </table>
                                <?php else: ?>
                                    <p class="lead">
                                        no hay colaboradores activos 
                                    </p>   
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    

                </div>
            </div>    

        </div>
    </section>
</div>


