<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Mensaje Activacion</title>
        <?php echo link_tag('public/css/font-awesome/css/font-awesome.min.css'); ?>
        <?php echo link_tag('public/css/bootstrap.min.css'); ?>
        <?php echo link_tag('public/css/mdb.min.css'); ?>
        <?php echo link_tag('public/css/style.css'); ?>
        <?php echo link_tag('public/alerta/themes/alertify.core.css'); ?>
        <?php echo link_tag('public/alerta/themes/alertify.default.css'); ?>
        <script type="text/javascript" src="<?PHP echo base_url() ?>public/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="<?PHP echo base_url() ?>public/alerta/lib/alertify.js"></script>
    </head>
    <body style="background-image: url(<?php echo base_url() . '/public/img/woman-1594711_1920.jpg'; ?>)">
        <script type="text/javascript">

            function alerta() {
                //un alert
                alertify.alert("administrador puede habilitar este usuario para el uso de la aplicaciòn ", function () {
                    location.href = '<?= base_url() ?>habilita';
                });
            }
            alerta();

        </script>


    </body>
</html>
