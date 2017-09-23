<?php
defined("BASEPATH") or die("Acceso prohibido");

if (!function_exists('messages_flash')) {

    /**
     * @desc - muestra mensajes al usuario
     * @param $type - string con el tipo de panel de bootstrap
     * @param $flash - string mensaje a mostrar al usuario
     * @param $headMessage - string con el texto de la cabeceral del panel
     * @param $validation - bool, si es true son errores de form_validation, por defecto false
     * @return panel bootstrap con el contenido del mensaje
     */
    function messages_flash($type, $flash, $headMessage, $validation = false) {
        $ci = & get_instance();
        if ($validation == true && validation_errors()) {
            ?>
            <div class="card">
                <h3 class="card-header <?php echo $type ?> white-text">Mensaje</h3>
                <div class="card-body">
                    <h4 class="card-title"><?php echo $headMessage ?></h4>
                    <p class="card-text"> <?php echo $flash ?></p>

                </div>
            </div>

            <?php
        } else if ($ci->session->flashdata($flash)) {
            ?>
            <div class="card">
                <h3 class="card-header <?php echo $type ?> white-text">Mensaje</h3>
                <div class="card-body">
                    <h4 class="card-title"><?php echo $headMessage ?></h4>
                    <p class="card-text">  <?php echo $ci->session->flashdata($flash) ?></p>

                </div>
            </div>
            
            <?php
        }
    }

}