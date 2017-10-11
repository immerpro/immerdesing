<?php
class AdminController extends CI_Controller {
    //metodo constructor
    public function __construct() {
        parent::__construct();
          }
    // pagina del administrador
    public function index() {
        if ($this->session->userdata('rol') == NULL || $this->session->userdata('rol') != 1) {
            redirect(base_url() . 'iniciar');
        }
        $data = [
            'titulo' => 'Admin',
            'es_usuario_normal' => FALSE,
             'perfil' => $this->usuario_model->consultarPerfil($this->session->userdata('idUsuario'))];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('Admin/index');
        $this->load->view('templates/footer');
    }
    // pagina del perfil del administrador
    public function mostrarPerfilAdmin() {
        if ($this->session->userdata('rol') == NULL || $this->session->userdata('rol') != 1) {
            redirect(base_url() . 'iniciar');
        }
        $data = ['titulo' => 'perfil Admin', 
                 'es_usuario_normal' => FALSE,
                 'perfil' => $this->usuario_model->consultarPerfil($this->session->userdata('idUsuario')),
             'mrol' => $this->usuario_model->mostrarRol($this->session->userdata('rol')),
               ];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('Admin/perfilAdmin', $data);
        $this->load->view('templates/footer');
    }
    // pagina habilitar Colaboradores
    public function habilitarColaboradores() {
        if ($this->session->userdata('rol') == NULL || $this->session->userdata('rol') != 1) {
            redirect(base_url() . 'iniciar');
        }
        $data = ['titulo' => 'Habilitar',
                 'es_usuario_normal' => FALSE,
                 'colaboradores' => $this->usuario_model->mostrarColaboradorSinAutorizar(),
                 'perfil' => $this->usuario_model->consultarPerfil($this->session->userdata('idUsuario'))];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('Admin/habilitarColaborador', $data);
        $this->load->view('templates/footer');
    }
// metodo para autorizar a colaborador
    public function colaboradorAutorizado() {
        if ($this->session->userdata('rol') == NULL || $this->session->userdata('rol') != 1) {
            redirect(base_url() . 'iniciar');
        }
        $selColabora = $this->input->post('cboColabora');
        $autorizado = $this->usuario_model->cambiarAutorizacion($selColabora);
        if ($autorizado) {
            $this->load->view('mensaje/mensaje');
        } else {
            $this->load->view('mensaje/errorColaborador');
        }
    }
// actualiza el perfil del administrador
    public function actualizarPerfilAdmin() {
        if ($this->session->userdata('rol') == NULL || $this->session->userdata('rol') != 1) {
            redirect(base_url() . 'iniciar');
        }
        $this->form_validation->set_rules('txtNombCompl', 'Nombre', 'required|alpha_numeric_spaces');
        $this->form_validation->set_rules('txtemail', 'correo', 'required|valid_email|is_unique[usuario.email]');
        $this->form_validation->set_rules('txtusuario', 'usuario', 'required|alpha_numeric|is_unique[usuario.NombreUsuario]');
         $this->form_validation->set_message('required', 'El campo %s no debe estar vacio');
        $this->form_validation->set_message('valid_email', 'El campo %s  debe tener un formato correcto de correo');
        $this->form_validation->set_message('alpha_numeric', 'El  campo %s  debe estar formado por letras y numeros sin simbolos especiales');
        $this->form_validation->set_message('is_unique', 'El  campo %s ya existe en el sistema ');
         if ($this->form_validation->run() === FALSE) {
             $this->mostrarPerfilAdmin();
         }else{
             $actualizarpe = array(
            'nombreCompleto' => $this->input->post('txtNombCompl'),
            'NombreUsuario' => $this->input->post('txtusuario'),
            'email' => $this->input->post('txtemail'),
        );
        $idUsuario = $this->input->post('idUsuario');
        $this->usuario_model->atualizarperfil($idUsuario, $actualizarpe);
        redirect('admin'); 
         }
       
    }

}
