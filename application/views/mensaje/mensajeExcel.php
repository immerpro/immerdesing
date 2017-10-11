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
<?php
$wich_report = "ReporteVencidos";
$file_name = $wich_report . "-" . date("Y-m-d", time());
?>
        <h1>Archivo excel generado correctamente</h1>
        <a class="btn btn-dark-green" href="<?= base_url() ?>files/'<?php $file_name?>" onclick="alerta();">Descargar excel</a>
        <script type="text/javascript">

               function alerta(){
				//un alert
				alertify.alert("Archivo excel generado correctamente\n\
                                               ", function () {
					location.href = '<?= base_url()?>admin';
				});
			}
                       

        </script>
          </div> 
</body>
