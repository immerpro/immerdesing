
<div style="height: 5vh"></div>
<div class="container" >

    <section class="section">

        <p class="display-4 orange-text text-center h1-responsive">Notificaciones</p>
        <div style="height: 4vh"></div>
        <?php echo form_open('inventario/notificar'); ?>
        <p class="lead">
            Estimado Administrador(a) por favor seleccione una opciòn para enviarle
            una notificaciòn por correo electronico.
        </p>
        <div class="row flex-center" data-parsley-validate >

            <div class="col-6"> 
                <div>
                    <label for="noticelular" data-error="wrong" data-success="right" data-parsley-required="true" class=" badge badge-primary lead"> <i class="fa fa-bell-o prefix fa-3x" aria-hidden="true"></i> Notificar por</label>
                    <select class="form-control validate"  required name="cbomotivoNoti">
                        <option value="">seleccione una opciòn </option>
                        <option value="vencido">Producto vencido</option>
                        <option value="agotado">Producto agotado</option>
                        <option value="proximoAgotado">Producto por  agotarse</option>

                    </select>

                </div>

            </div>    

        </div>
        <!--codigo de barras 13 numeros-->


        <div class="flex-center">
            <button type="submit" class="btn btn-orange waves-effect orange" name="btnNotificacion" ><i class='fa fa-send'> Recibir Notificaciòn</i></button>

        </div>


        <?php echo form_close(); ?>

    </section>

    <script>
        $(document).ready(function () {

            $('form').parsley();
        });
    </script>
</div>

