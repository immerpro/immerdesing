
<h1 class="h1-responsive text-center orange-text">Bienvenido Administrador(a)  <?php echo $perfil->nombreCompleto; ?> </h1>
 <div style="height: 3vh"></div>
<!-- ****** Team Section****** -->
<div class="container">
    <section class="section">


       <!--Carousel Wrapper-->
<div id="multi-item-example" class="carousel slide carousel-multi-item" data-ride="carousel">

    <!--Controls-->
    <div class="controls-top">
        <a class="btn-floating" href="#multi-item-example" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
        <a class="btn-floating" href="#multi-item-example" data-slide="next"><i class="fa fa-chevron-right"></i></a>
    </div>
    <!--/.Controls-->

    <!--Indicators-->
    <ol class="carousel-indicators">
        <li data-target="#multi-item-example" data-slide-to="0" class="active"></li>
        <li data-target="#multi-item-example" data-slide-to="1"></li>
        <li data-target="#multi-item-example" data-slide-to="2"></li>
    </ol>
    <!--/.Indicators-->

    <!--Slides-->
    <div class="carousel-inner" role="listbox">

        <!--First slide-->
        <div class="carousel-item active">

            <div class="col-md-4">
                <div class="card">
                    <img class="img-fluid" src="<?PHP echo base_url(); ?>/public/img/market1.jpg" alt="Card image cap" height="" width="">
                    <div class="card-body">
                        <h4 class="card-title">SubCategorìa</h4>
                        <p class="card-text"><i class="fa fa-quote-left"></i>En este modulo se gestiona la parte de categorias de productos en donde el administrador podra crear, modificar, consultar.</p>

                    </div>
                </div>
            </div>

            <div class="col-md-4 clearfix d-none d-md-block">
                <div class="card">
                    <img class="img-fluid" src="<?PHP echo base_url(); ?>/public/img/market1.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">Categorìa</h4>
                        <p class="card-text"> <i class="fa fa-quote-left"></i> En este modulo se gestiona la parte de categorias de productos en donde el administrador podra crear, modificar, consultar</p>

                    </div>
                </div>
            </div>

            <div class="col-md-4 clearfix d-none d-md-block">
                <div class="card">
                    <img class="img-fluid" src="<?PHP echo base_url(); ?>/public/img/market1.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">Orden Entrada</h4>
                        <p class="card-text"><i class="fa fa-quote-left"></i> En este modulo se gestiona la parte de ordenes de entrada en donde el administrador podra crear y consultar</p>

                    </div>
                </div>
            </div>

        </div>
        <!--/.First slide-->

        <!--Second slide-->
        <div class="carousel-item">

            <div class="col-md-4">
                <div class="card">
                    <img class="img-fluid" src="<?PHP echo base_url(); ?>/public/img/market1.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">Orden Salida</h4>
                        <p class="card-text"><i class="fa fa-quote-left"></i> En este modulo se gestiona las ordenes de salida en donde el administrador podra crear y  consultar</p>

                    </div>
                </div>
            </div>

            <div class="col-md-4 clearfix d-none d-md-block">
                <div class="card">
                    <img class="img-fluid" src="<?PHP echo base_url(); ?>/public/img/market1.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">Producto</h4>
                        <p class="card-text"><i class="fa fa-quote-left"></i> En este modulo se gestiona la parte de  productos en donde el administrador podra crear, modificar,inactivar y  consultar </p>

                    </div>
                </div>
            </div>

            <div class="col-md-4 clearfix d-none d-md-block">
                <div class="card">
                    <img class="img-fluid" src="<?PHP echo base_url(); ?>/public/img/market1.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">Proveedores</h4>
                        <p class="card-text"><i class="fa fa-quote-left"></i> En este modulo se gestiona la parte de proveedores en donde el administrador podra crear, modificar, inactivar y  consultar</p>

                    </div>
                </div>
            </div>

        </div>
        <!--/.Second slide-->

        <!--Third slide-->
        <div class="carousel-item">

            <div class="col-md-4">
                <div class="card">
                    <img class="img-fluid" src="<?PHP echo base_url(); ?>/public/img/market1.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">Reporte</h4>
                        <p class="card-text"> <i class="fa fa-quote-left"></i> En este modulo se gestiona los reportes de productos vencidos,productos vendidos,productos agotados y por agotarse y se podra exportar a excel o a pdf</p>

                    </div>
                </div>
            </div>

            <div class="col-md-4 clearfix d-none d-md-block">
                <div class="card">
                    <img class="img-fluid" src="<?PHP echo base_url(); ?>/public/img/market1.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">Notificaciones</h4>
                        <p class="card-text"><i class="fa fa-quote-left"></i> En este modulo el administrador recibira notificaciones de productos vencidos,productos agotados,productos por agotarse y podra recibir en su correo electronico las respectivas notificaciones </p>

                    </div>
                </div>
            </div>

            <div class="col-md-4 clearfix d-none d-md-block">
                <div class="card">
                    <img class="img-fluid" src="<?PHP echo base_url(); ?>/public/img/market1.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">Restauraciòn</h4>
                        <p class="card-text"><i class="fa fa-quote-left"></i>el administrador podra volver a recuperar los datos que elimino o inactivo de subcategorias , categorias, productos,proveedores  y colaboradores</p>

                    </div>
                </div>
            </div>

        </div>
        <!--/.Third slide-->

    </div>
    <!--/.Slides-->

</div>
        <div style="height: 5vh"></div>
<!--/.Carousel Wrapper-->
<script type="text/javascript">
$('.carousel').carousel({
  interval: 2000
})
</script>

    </section>

</div>
