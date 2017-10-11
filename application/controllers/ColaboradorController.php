<?php
class ColaboradorController extends CI_Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('usuario_model');
    }
    public function index() {
        if ($this->session->userdata('rol') == NULL || $this->session->userdata('rol') != 2) {
            redirect(base_url() . 'iniciar');
        }
        $data = ['titulo' => 'Colaborador', 'es_usuario_normal' => FALSE,
        'perfil' => $this->usuario_model->consultarPerfil($this->session->userdata('idUsuario'))];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('Colaborador/index');
        $this->load->view('templates/footer');
    }
    public function mostrarPerfilColaborador() {
         if ($this->session->userdata('rol') == NULL || $this->session->userdata('rol') != 2) {
            redirect(base_url() . 'iniciar');
        }
        $data = ['titulo' => 'perfil Colaborador',
            'es_usuario_normal' => FALSE,
            'perfil' => $this->usuario_model->consultarPerfil($this->session->userdata('idUsuario')),
            'mrol' => $this->usuario_model->mostrarRol($this->session->userdata('rol')),
            
            ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('Colaborador/perfilColaborador');
        $this->load->view('templates/footer');
    }

    public function actualizarPerfilCola() {
 if ($this->session->userdata('rol') == NULL || $this->session->userdata('rol') != 2) {
            redirect(base_url() . 'iniciar');
        }

         $this->form_validation->set_rules('txtemail', 'correo', 'required|valid_email|is_unique[usuario.email]');
        $this->form_validation->set_rules('txtusuarioco', 'usuario', 'required|is_unique[usuario.NombreUsuario]');
        $this->form_validation->set_message('is_unique', 'El  campo %s ya existe en el sistema ');
        
         if ($this->form_validation->run() === FALSE) {
             $this->mostrarPerfilColaborador();
         }else{
        $actualizarco = array(
            'nombreCompleto' => $this->input->post('txtNombCompl'),
            'NombreUsuario'=> $this->input->post('txtusuarioco'),
            'email' => $this->input->post('txtemail'),
        );
        $idUsuario = $this->input->post('idUsuario');
        $this->usuario_model->atualizarperfil($idUsuario, $actualizarco);
        redirect('colaborador');
    }
}
}
