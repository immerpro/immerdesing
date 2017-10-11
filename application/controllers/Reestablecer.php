<?php
class Reestablecer extends CI_Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('restauracion_model');
    }
    public function index() {

        if ($this->session->userdata('rol') == NULL || $this->session->userdata('rol') != 1) {
            redirect(base_url() . 'iniciar');
        }
        $data = [
            'titulo' => 'Restauracion',
            'listadoCategoriaDel' => $this->restauracion_model->mostrarRestauracion('Estado_estadoId', 'categoria'),
            'listadoproveedores' => $this->restauracion_model->mostrarRestauracion('Estados_idEstados', 'proveedor'),
            'listadosubcategoria' => $this->restauracion_model->mostrarRestauracion('Estado_estadoId', 'subcategoria'),
            'listadoproducto' => $this->restauracion_model->mostrarRestauracion('Estados_idEstados', 'producto'),
            'listadocolaborador' => $this->restauracion_model->mostrarRestauracionColaborador('Estado_EstadoId', 'usuario'),
            'listadoactivos' => $this->usuario_model->mostrarColaboradorActivo(),
            'es_usuario_normal' => FALSE,
            'perfil' => $this->usuario_model->consultarPerfil($this->session->userdata('idUsuario'))
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('restauracion/index', $data);
        $this->load->view('templates/footer');
    }
    public function activoCategoria($codCategoria) {
         if ($this->session->userdata('rol') == NULL || $this->session->userdata('rol') != 1) {
            redirect(base_url() . 'iniciar');
        }
        /*
          $colEstado =>columna estado,
         * $tabla=> nombre tabla,
         * $idTabla=> codigo de la tabla,
         * $valId=> valor de la tabla
         *          */
        $activoCat = $this->restauracion_model->activarRestauracion('Estado_estadoId', 'categoria', 'idCategoria', $codCategoria);
        if ($activoCat) {
            echo "<script type='text/javascript'>"
            . "alert('la categorìa fue activada correctamente y se podra ver en el listado de categorias');"
            . "location.href ='" . base_url() . "categoria';"
            . "</script>";
        }
    }

    public function activoProveedor($codProveedor) {
         if ($this->session->userdata('rol') == NULL || $this->session->userdata('rol') != 1) {
            redirect(base_url() . 'iniciar');
        }
        $activoProvee = $this->restauracion_model->activarRestauracion('Estados_idEstados', 'proveedor', 'idProveedor', $codProveedor);
        if ($activoProvee) {
            echo "<script type='text/javascript'>"
            . "alert('El Proveedor fue Activado correctamente y se podra ver en el listado de Proveedores');"
            . "location.href ='" . base_url() . "proveedor';"
            . "</script>";
        }
    }

    public function activarsubcategoria($codsubcategoria) {
         if ($this->session->userdata('rol') == NULL || $this->session->userdata('rol') != 1) {
            redirect(base_url() . 'iniciar');
        }
        $activosub = $this->restauracion_model->activarRestauracion('Estado_estadoId', 'subcategoria', 'idSubcategoria', $codsubcategoria);
        if ($activosub) {
            echo "<script type='text/javascript'>"
            . "alert('La subcategoria fue Activada correctamente y se podra ver en el listado de Subcategorias');"
            . "location.href = '" . base_url() . "categoria';"
            . "</script>";
        }
    }

    public function activarproducto($codproducto) {
         if ($this->session->userdata('rol') == NULL || $this->session->userdata('rol') != 1) {
            redirect(base_url() . 'iniciar');
        }
        $activopro = $this->restauracion_model->activarRestauracion('Estados_idEstados', 'producto', 'idProducto', $codproducto);
        if ($activopro) {
            echo "<script type='text/javascript'>"
            . "alert('El producto fue activada correctamente y se podra ver en el listado de Productos');"
            . "location.href = '" . base_url() . "producto';"
            . "</script>";
        }
    }
//inactivarColaborador
    public function activoColaborador($codigoUser) {
         if ($this->session->userdata('rol') == NULL || $this->session->userdata('rol') != 1) {
            redirect(base_url() . 'iniciar');
        }
        $activopro = $this->restauracion_model->pasarAHabilitar('Estado_EstadoId', 'usuario', 'idUsuario', $codigoUser);
        if ($activopro) {
          $this->load->view('mensaje/mensajeHabilitarColaborador');

        }
    }
     public function inactivoColaborador($codigoUser) {
          if ($this->session->userdata('rol') == NULL || $this->session->userdata('rol') != 1) {
            redirect(base_url() . 'iniciar');
        }
        $activopro = $this->usuario_model->inactivarColaborador($codigoUser);
        if ($activopro) {
            echo "<script type='text/javascript'>"
            . "alert('El Colaborador fue inactivado correctamente');"
            . "location.href = '" . base_url() . "admin';"
            . "</script>";
        }
    }

}
