<head>
    <?php echo link_tag('public/alerta/themes/alertify.core.css'); ?>
    <?php echo link_tag('public/alerta/themes/alertify.default.css'); ?>
    <script type="text/javascript" src="<?PHP echo base_url() ?>public/js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="<?PHP echo base_url() ?>public/js/parsley.min.js"></script>
    <script type="text/javascript" src="<?PHP echo base_url() ?>public/js/es.js"></script>
    <script type="text/javascript" src="<?PHP echo base_url() ?>public/alerta/lib/alertify.js"></script> 
</head>
<body style="background-image: url(<?php echo base_url().'/public/img/market1.jpg';?>)">
   
    <div class="col-lg-6">
       
            <script type="text/javascript">
               function alerta(){
				//un alert
				alertify.alert("no se pudo enviar el email", function () {
					location.href = '<?= base_url() ?>admin';
				});
			}
                        alerta();
                

            </script>


     
        <?php if ($this->session->flashdata('denegado')): ?>
            <script type="text/javascript">
                alertify.error(<?= $this->session->flashdata('denegado') ?>);
                location.href = '<?= base_url() ?>habilita';
            </script>


        <?php endif; ?>
    </div> 
</body>
