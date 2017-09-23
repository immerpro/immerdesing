<head>
    <?php echo link_tag('public/alerta/themes/alertify.core.css'); ?>
    <?php echo link_tag('public/alerta/themes/alertify.default.css'); ?>
    <script type="text/javascript" src="<?PHP echo base_url() ?>public/js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="<?PHP echo base_url() ?>public/js/parsley.min.js"></script>
    <script type="text/javascript" src="<?PHP echo base_url() ?>public/js/es.js"></script>
    <script type="text/javascript" src="<?PHP echo base_url() ?>public/alerta/lib/alertify.js"></script> 
    <script type="text/javascript" src="<?PHP echo base_url() ?>public/js/push.min.js"></script>
</head>
<body style="background-image: url(<?php echo base_url() . '/public/img/market1.jpg'; ?>)">

    <div class="col-lg-6">

        <script type="text/javascript">

            Push.create("Colaborador Habilitado", {
                body: "El colaborador se activo correctamente",
                icon: "<?php echo base_url() ?>public/img/medd_logo.png",
                timeout: 4000,
            });
            window.location.href = "<?php echo base_url() ?>habilita";
            this.close();

        </script>



        <?php if ($this->session->flashdata('denegado')): ?>
            <script type="text/javascript">
                alertify.error(<?= $this->session->flashdata('denegado') ?>);
                location.href = '<?= base_url() ?>habilita';
            </script>


        <?php endif; ?>
    </div> 
</body>
