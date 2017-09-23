<body style="background-image: url(<?php echo base_url().'/public/img/market3.jpg';?>)">
<?php  if ($this->session->flashdata('inactivo')): ?>
            <div class=" alert alert-danger" aria-label="Close"><?php echo $this->session->flashdata('inactivo'); ?> </div>
<?php endif; ?>
<?php  if ($this->session->flashdata('activo')): ?>
            <div class=" alert alert-success" aria-label="Close"><?php echo $this->session->flashdata('activo'); ?> </div> 
        <?php endif; ?>
 <?php echo form_open('subcategoria/InactivarSub/'.$id); ?>
            <div style="height: 21vh"></div>
            <div class="mx-4 hm-green-light">
    <div class="modal-dialog modal-notify modal-success" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title w-100" id="myModalLabel"><?=$titulo_h1?></h4>
            </div>
            <!--Body-->
            <div class="modal-body">

                <p class="orange-text">la subcategoria <span class="badge badge-danger"><?=$nombresubcat?></span>no se mostrara en el listado de subcategoria</p>
                <p class="orange-text">¿ Desea continuar ?</p> 
            </div>
            <!--Footer-->
            <div class="modal-footer">
                <a href="<?php  echo base_url()?>categoria"><button type="button" class="btn btn-secondary" >Cancelar</button></a>
                <button type="submit" class="btn btn-blue-grey">Inactivar</button>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>  
 <?php echo form_close(); ?>
<script type="text/javascript" src="<?PHP echo base_url() ?>public/js/jquery-3.1.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="<?PHP echo base_url() ?>public/js/tether.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="<?PHP echo base_url() ?>public/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="<?PHP echo base_url() ?>public/js/mdb.min.js"></script>
</body>