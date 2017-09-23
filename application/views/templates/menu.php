<style  type="text/css">
    .tamanoimg{
        width: 500px;
        height: 150px;
        
    }  
</style>
<body >
    <div class="flex-center flex-column">
        <?php
        $propiedad_img = array(
            'src' => 'public/img/immerproLogo.png',
            'alt' => 'immerpro',
            'class' => 'animated fadeIn mb-2 img-fluid tamanoimg',
            'title' => 'logo',
        );

        echo img($propiedad_img);
        ?>
    </div>
    <?php if ($es_usuario_normal): ?>
        <div class="flex-center">
            <h1 class="h3-responsive green-text" ><strong><?= $slogan ?></strong></h1>
        </div>
    <?php else: ?>
        <div class="flex-center">
            <h1 class="h1 green-text" >te asesorarè muy bien</h1>
        </div>
    <?php endif; ?>
    <div style="height: 5vh"></div>
    <!-----------------MENU DE LA ADMINISTRACION ----------->
    <nav class="navbar navbar-expand-lg navbar-dark blue" role="navigation">
        <?php $atributo = array('class' => 'navbar-brand'); ?>
        <?= anchor('iniciar', 'Immerpro', $atributo) ?>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">

            <ul class="navbar-nav">
                <?php if ($es_usuario_normal): ?>
                    <!-----------------MENU USUARIO TE ASESORARÈ MUY BIEN!----------->
                     <li class="nav-item active">
                        <a class="nav-link" href="<?php echo site_url('bienvenido') ?>#acerca"><i class=" fa fa-users"></i> Acerca <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('bienvenido') ?>#contacto"><i class="fa fa-phone" aria-hidden="true"></i> Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('iniciar') ?>"><i class="fa fa-user-secret" aria-hidden="true"></i> Login</a>
                    </li>
                <?php else: ?>
                    <!-----------------MENU USUARIO TE ASESORARÈ MUY BIEN!----------->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" id="inv" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                            <i class="fa fa-user"></i> <?php echo $perfil->NombreUsuario; ?><span class="sr-only">(current)</span>
                        </a>
                        <div class="dropdown-menu" >
                            <?php if ($this->session->userdata('rol') == 1): ?> 
                            <a class="dropdown-item " href="<?= site_url('perfiladmin') ?>"><p class="black-text"> <i class="fa fa-user" aria-hidden="true"></i> Perfil Admin</p></a>
                            <a class="dropdown-item " href="<?= site_url('habilita') ?>"><p class="black-text"> <i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i> Habilitar Colaborador</p></a>
                            <?php endif; ?>
                            <?php if ($this->session->userdata('rol') == 2): ?>  
                                <a class="dropdown-item " href="<?= site_url('perfilcolabora') ?>"><p class="black-text"> <i class="fa fa-user" aria-hidden="true"></i> Perfil Colaborador</p></a>
                            <?php endif; ?>
                                <?php if ($this->session->userdata('rol') == 1): ?> 
                            <a class="dropdown-item" href="<?= site_url('registro') ?>"><p class="black-text"><i class="fa fa-user-plus" aria-hidden="true"></i> Registrar Colaborador</p></a>
                            <?php endif; ?>
                            <a class="dropdown-item " href="<?= site_url('salir') ?>"><p class="black-text"><i class="fa fa-sign-out" aria-hidden="true"></i> Cerrar Sesiòn</p></a>

                        </div>
                    </li>




                    <?php if ($this->session->userdata('rol') == 1): ?>     
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">
                               <i class=" fa fa-play"></i> Categoría 
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="<?php echo site_url('categoria/crear'); ?>"><p class="black-text"> <i class=" fa fa-suitcase"></i> Nueva Categorìa</p></a>
                                <a class="dropdown-item" href="<?php echo site_url('categoria'); ?>"><p class="black-text"> <i class=" fa fa-list-ol"></i> Listar Categorìa</p></a>

                            </div>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                             <i class=" fa fa-certificate"></i> Producto
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="<?php echo site_url('nuevoProducto'); ?>"><p class="black-text"><i class=" fa fa-hand-pointer-o"></i> Nuevo Producto</p></a>
                            <a class="dropdown-item" href="<?php echo site_url('producto'); ?>"><p class="black-text"><i class=" fa fa-list-ol"></i> Consultar Producto</p></a>

                   
                        </div>
                    </li>
                    <?php if ($this->session->userdata('rol') == 1): ?>   
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                          <i class=" fa fa-cube"></i>  Proveedor
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                             <a class="dropdown-item" href="<?php echo site_url('proveedor/NuevoProveedor'); ?>"><p class="black-text"><i class=" fa fa-user"></i> Crear Proveedor</p></a>
                            <a class="dropdown-item" href="<?php echo site_url('proveedor'); ?>"><p class="black-text"><i class=" fa fa-list-ol"></i> Consultar Proveedor</p></a>

                        </div>
                    </li>
                    <?php endif; ?>
                     
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" id="inv" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                            <i class=" fa fa-bullseye"></i> Inventario
                        </a>
                        <div class="dropdown-menu" >
                            <?php if ($this->session->userdata('rol') == 1): ?> 
                            <a class="dropdown-item " href="<?php echo site_url('Entrada'); ?>"><p class="black-text"><i class=" fa fa-hand-pointer-o"></i> Orden Entrada</p></a>
                            <a class="dropdown-item " href="<?php echo site_url('Consultar'); ?>"><p class="black-text"><i class=" fa fa-list-ol"></i> Consultar Orden Entrada</p></a>
                            <?php endif; ?>
                            <a class="dropdown-item" href="<?php echo site_url('nuevaSalida'); ?>"><p class="black-text"><i class=" fa fa-arrow-left"></i> Orden Salida</p></a>
                            <a class="dropdown-item" href="<?php echo site_url('BuscadorController/index'); ?>"><p class="black-text"><i class=" fa fa-list-ol"></i> Consultar Orden Salida</p></a>
                            <?php if ($this->session->userdata('rol') == 1): ?> 
                            <a class="dropdown-item" href="<?php echo site_url('inventario'); ?>"><p class="black-text"><i class=" fa fa-bell"></i> Notificaciones</p></a>
                            <a class="dropdown-item" href="<?php echo site_url('ReporteController/mostrarreporte'); ?>"><p class="black-text"><i class=" fa fa-play"></i> Reporte</p></a>
                            <?php endif; ?>

                        </div>
                    </li>
                    <?php if ($this->session->userdata('rol') == 1): ?> 
                    <li class="nav-item">
                        
                        <a class="nav-link" href="<?php echo site_url('recuperadato'); ?>"><i class="fa fa-compass"></i>Restauraciòn Datos</a>
                        <?php endif; ?>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <!-------------FIN NAVEGACION---------------->
    ​