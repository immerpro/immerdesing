<head>
    <?php echo link_tag('public/alerta/themes/alertify.core.css'); ?>
    <?php echo link_tag('public/alerta/themes/alertify.default.css'); ?>
    <script type="text/javascript" src="<?PHP echo base_url() ?>public/js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="<?PHP echo base_url() ?>public/js/parsley.min.js"></script>
    <script type="text/javascript" src="<?PHP echo base_url() ?>public/js/es.js"></script>
    <script type="text/javascript" src="<?PHP echo base_url() ?>public/alerta/lib/alertify.js"></script>
</head>
<body style="background-image: url(<?php echo base_url() . '/public/img/market2.jpg'; ?>)">

    <div class="col-lg-6">

        <script type="text/javascript">

               function alerta(){
				//un alert
				alertify.alert("email enviado correctamente\n\
                                               por favor verificar si el correo se encuentra  en la carpeta de SPAM", function () {
					location.href = '<?= base_url() ?>admin';
				});
			}
                        alerta();

        </script>
          </div> 
</body>
