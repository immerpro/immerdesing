<body style="background-image: url(<?php echo base_url().'/public/img/woman-1594711_1920.jpg';?>)">
<?php echo form_open('proveedor/inactivar/' . $id); ?>
<?php if ($this->session->flashdata('inactivo')): ?>
    <div class=" alert alert-danger" aria-label="Close"><?php echo $this->session->flashdata('inactivo'); ?> </div>
<?php endif; ?>
<?php if ($this->session->flashdata('activo')): ?>
    <div class=" alert alert-success" aria-label="Close"><?php echo $this->session->flashdata('activo'); ?> </div>
<?php endif; ?>
<div id="inactivo" >
    <div class="modal-dialog modal-notify modal-danger" role="document">
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title w-100" id="myModalLabel"><?= $titulo_h1 ?></h4>
            </div>
            <!--Body-->
            <div class="modal-body">

                <p class="black-text">El Proveedor <span class="badge badge-danger h5-responsive"><?=$nombrePro-> NombreProveedor ?></span>no se mostrara en el listado de proveedores</p>

                <p class="black-text">¿ Desea continuar ?</p>
            </div>
            <!--Footer-->
            <div class="modal-footer">
                <a href="<?php echo base_url() ?>proveedor"><button type="button" class="btn btn-secondary" >Cancelar</button></a>
                <button type="submit" class="btn btn-blue-grey">Inactivar</button>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<?php echo form_close(); ?>

</body>