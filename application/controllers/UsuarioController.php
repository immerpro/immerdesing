<?php
ini_set("display_errors", FALSE);

class UsuarioController extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    //  vista pagina principal
    public function index() {

        $informacion = array('titulo' => 'immerpro',
         
            'es_usuario_normal' => TRUE);
        $this->load->view('templates/header', $informacion);
        $this->load->view('templates/menu', $informacion);
        $this->load->view('templates/Intro');
        $this->load->view('templates/Boxes');
//        $this->load->view('templates/Boxes2');
  //      $this->load->view('templates/Pricing');
  //      $this->load->view('templates/Pricing2');
   //     $this->load->view('templates/Services');
        $this->load->view('templates/Team');
 //     $this->load->view('templates/Testimonial');
   //     $this->load->view('templates/Works');
        $this->load->view('Usuario/index');
        $this->load->view('templates/footer');
    }

    // vista login y dependiendo del rol ingresa a su respectiva sesion
    public function Login() {

        switch ($this->session->userdata('rol')) {

            case '':
                $data = array('token' => $this->tokenLogin(),
                    'titulo' => 'login',
                    
                    'es_usuario_normal' => TRUE);
                $this->load->view('templates/header', $data);
                $this->load->view('templates/menu', $data);
                $this->load->view('Usuario/Login');
                $this->load->view('templates/footer');
                break;
            case 1:
                redirect(base_url() . 'admin');
                break;
            case 2:
                redirect(base_url() . 'colaborador');
                break;
            default:

                $data = array('titulo' => 'login', 
                    'es_usuario_normal' => TRUE);
                $this->load->view('templates/header', $data);
                $this->load->view('templates/menu', $data);
                $this->load->view('Usuario/Login');
                $this->load->view('templates/footer');
                break;
        }
    }

// validar el ingreso del usuario
    public function ingresoUsuario() {
       
        if ($this->input->post('token') && $this->input->post('token') == $this->session->userdata('token')) {

            $this->form_validation->set_rules('txtusuario', 'usuario', 'required');
            $this->form_validation->set_rules('txtpassword', 'contraseña', 'required|trim|min_length[5]|max_length[12]xss_clean');
            $this->form_validation->set_message('required', 'El campo %s no debe estar vacio');
            $this->form_validation->set_message('min_length', 'El campo %s  debe tener minimo 5 caracteres');
            $this->form_validation->set_message('max_length', 'El  campo %s  debe tener maximo 12 caracteres');

            if ($this->form_validation->run() === FALSE) {
                $this->Login();
            } else {

                $nombreusuario = $this->input->post('txtusuario');
                $claveusuario = $this->input->post('txtpassword');
                $logueo = $this->usuario_model->iniciarSesion($nombreusuario, $claveusuario);
                if ($logueo != FALSE) {

                    $infouser = array(
                        'esta_logueado' => true,
                        'idUsuario' => $logueo->idUsuario,
                        'rol' => $logueo->RolUsuario_idRolUsuario,
                        'usuario' => $logueo->NombreUsuario,
                        'apellidos' => $logueo->nombreCompleto,
                        'correo' => $logueo->email
                    );
                    $this->session->set_userdata($infouser);
                    $this->Login();
                }
            }
        } else {

            redirect(base_url() . 'iniciar');
        }
    }

    //el token evita los sitios cruzados 
    public function tokenLogin() {
        $token = sha1(uniqid(rand(), true));
        $this->session->set_userdata('token', $token);
        return $token;
    }

    /**
     * @desc - genera un token para cada usuario registrado
     * @return token
     */
    private function token() {
        return sha1(uniqid(rand(), true));
    }

    public function cerrarsesion() {
        $this->session->unset_userdata($this->session->userdata('rol'));
        $this->session->sess_destroy();
        redirect(base_url() . 'iniciar');
    }

    // registro de los usuarios por el admin
    public function RegistroUsuario() {
        if ($this->session->userdata('rol') == NULL || $this->session->userdata('rol') != 1) {
            redirect(base_url() . 'iniciar');
        }

        $info = array(
            'titulo' => 'Registro',
      
            'es_usuario_normal' => FALSE,
            'perfil' => $this->usuario_model->consultarPerfil($this->session->userdata('idUsuario'))
        );

        $this->form_validation->set_rules('txtnombrecompleto', 'Nombre', 'required|alpha_numeric_spaces');
        $this->form_validation->set_rules('txtcorreo', 'correo', 'required|valid_email|is_unique[usuario.email]');
        $this->form_validation->set_rules('txtusuario', 'usuario', 'required|alpha_numeric|is_unique[usuario.NombreUsuario]');
        $this->form_validation->set_rules('txtpassword', 'Contraseña', 'required|matches[txtconfir]');
        $this->form_validation->set_rules('txtconfir', 'Confirmar Password', 'required');
        // mensajes personalizados 
        $this->form_validation->set_message('required', 'El campo %s no debe estar vacio');
        $this->form_validation->set_message('valid_email', 'El campo %s  debe tener un formato correcto de correo');
        $this->form_validation->set_message('alpha_numeric', 'El  campo %s  debe estar formado por letras y numeros sin simbolos especiales');
        $this->form_validation->set_message('is_unique', 'El  campo %s ya existe en el sistema ');
        $this->form_validation->set_message('matches', 'Las contraseñas no coinciden vuelva a intentarlo ');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $info);
            $this->load->view('templates/menu', $info);
            $this->load->view('Usuario/Registro');
            $this->load->view('templates/footer');
        } else {

            // ingresamos los datos 
            $data = array(
                'ClaveUsuario' => sha1($this->input->post('txtpassword')),
                'NombreUsuario' => $this->input->post('txtusuario'),
                'RolUsuario_idRolUsuario' => 2,
                'nombreCompleto' => $this->input->post('txtnombrecompleto'),
                'email' => $this->input->post('txtcorreo'),
                'Estado_EstadoId' => 3,
                'token' => $this->token()); // el estado 3 significa registrado el usuario esta registrado pero no puede usar el programa
            $registrouser = $this->usuario_model->registrarusuario($data);
            if ($registrouser === TRUE) {
                //Sesion de una sola ejecución
                $this->session->set_flashdata('correcto', 'usuario creado correctamente');
            } else {
                $this->session->set_flashdata('incorrecto', ' se produjo un error al registrar el usuario intentalo mas tarde');
            }
            // cargar la vista
            $this->load->view('templates/header', $info);
            $this->load->view('templates/menu', $info);
            $this->load->view('Usuario/Registro');
            $this->load->view('templates/footer');
        }
    }

    public function olvidarClave() {
        $info = array(
            'titulo' => 'Olvidar Clave',
           
            'es_usuario_normal' => TRUE,
        );
        // cargar la vista
        $this->load->view('templates/header', $info);
        $this->load->view('templates/menu', $info);
        $this->load->view('Usuario/olvidoClave');
        $this->load->view('templates/footer');
    }

    public function recuperaClaveUsuario() {
        date_default_timezone_set('America/Bogota');
        $this->form_validation->set_rules(
                'txtusuarioEmail', 'correo electronico', 'required|trim|valid_email|callback_comprobar_email'
        );
        $this->form_validation->set_message('required', 'El %s es requerido');
        $this->form_validation->set_message('valid_email', 'El %s no tiene un formato correcto');
        if ($this->form_validation->run() === FALSE) {
            $this->olvidarClave();
        } else {
            $userData = $this->usuario_model->obtenerInfoUsuario($this->input->post("txtusuarioEmail"));
            $enviando_email = $this->enviarClaveXEmail($userData);
            if ($userData) {
                /* @var $enviando_email type */
                if ($enviando_email === TRUE) {
                    $this->session->set_flashdata(
                            "mail_send", "Se ha enviado un email a su correo para recuperar su contraseña, tiene 5 minutos"
                    );
                } else {
                    $this->session->set_flashdata(
                            "not_email_send", "Ha ocurrido un error enviando el email, pruebe más tarde"
                    );
                   
                }
                redirect(base_url() . "olvido", "refresh");
            }
        }
    }

    //  validacion callback  que comprueba que el email existe en la bd
    public function comprobar_email() {
        $email = $this->input->post('txtusuarioEmail');

        $comprobar_email = $this->usuario_model->verifica_email($email);
        if ($comprobar_email !== TRUE) {
            $this->form_validation->set_message('comprobar_email', 'El email introducido no existe en la base de datos');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * @desc - renderiza la vista recuperacion de clave
     */
    public function recuperacionClaveXEmail($token = "") {
        date_default_timezone_set('America/Bogota');
        //si el password ha caducado

        if ($this->comprobarToken($token) === FALSE) {
            $this->session->set_flashdata(
                    "expired_request", "Si necesita recuperar su password rellene el 
				formulario con su email y le haremos llegar un correo con instrucciones"
            );
            redirect(base_url("UsuarioController/recuperaClaveUsuario"), "refresh");
        }
        $data = array();
        $data["titulo"] = "Recupera Clave";
       
        $data ['es_usuario_normal'] = TRUE;
        $data["token"] = $token;
        $this->session->set_userdata("id_user_recovery_pass", $this->comprobarToken($token)->idUsuario);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('Usuario/recuperaClave', $data);
        $this->load->view('templates/footer');
    }

    public function actualizaClave() {
        date_default_timezone_set('America/Bogota');
        //validamos que los passwords coincidan
        $this->form_validation->set_rules(
                'txtusuarioPass', 'Contraseña', 'required|trim|min_length[5]|max_length[12]|matches[txtRespassword]'
        );

        $this->form_validation->set_rules(
                'txtRespassword', 'confirm pass', 'required|trim|min_length[5]|max_length[12]'
        );

        $this->form_validation->set_message('required', 'El %s es requerido');
        $this->form_validation->set_message('matches', 'El %s y el %s no coinciden');
        $this->form_validation->set_message('max_length', 'El %s no puede tener más de %s carácteres');
        $this->form_validation->set_message('min_length', 'El %s no puede tener menos de %s carácteres');

        //si el formulario no pasa mandamos a recovery_password con el token como parámetro
        if ($this->form_validation->run() == FALSE) {
            $this->recuperaClaveUsuario($this->input->post("token"));
        } else {

            $data = array(
                "ClaveUsuario" => sha1($this->input->post("txtusuarioPass")),
                "user_id" => $this->session->userdata("id_user_recovery_pass"),
                "request_token" => date('Y-m-d H:i:s'),
                "token" => $this->token()//ponemos otro token nuevo
            );



            //si el password se ha cambiado correctamente y actualizado los datos
            if ($this->usuario_model->cambiarClave($data) === TRUE) {
                $this->load->view('mensaje/mensajePassExito');
            }
            //en otro caso error
            else {
                $this->session->set_flashdata(
                        "error_password_changed", "Ha ocurrido un error modificando su contraseña"
                );
            }
            //redirect(base_url() . "iniciar", "refresh");
        }
    }

    /**
     * @desc - comprueba si el token ha expirado o no, el usuario tiene 5 minutos de tiempo
     * @param $token - string unico por usuario
     */
    private function comprobarToken($token) {

        return $this->usuario_model->comprobarToken($token);
    }

    /**
     * @desc - configura y envia un email con gmail
     * @param - $userdata array con los datos del usuario para enviar el email
     */
    private function enviarClaveXEmail($userdata) {
        $this->email->from('immerpro2018@gmail.com', 'ImmerPRO');
        $this->email->to($userdata->email);
        $this->email->subject('Recuperación de password en nuestra plataforma');

        $html = '<h2>Pulsa  o copia y pega el siguiente enlace  en el navegador  para recuperar la clave </h2><hr><br>';
        $html .= '<a  href="' . base_url() . 'UsuarioController/recuperacionClaveXEmail/' . $userdata->token . '">';
        $html .= base_url() . 'UsuarioController/recuperacionClaveXEmail/' . $userdata->token . '</a>';

        $this->email->message($html);

        if ($this->email->send()) {
            return TRUE;
        }
    }

    // envio de email al usuario
    public function contactar() {
        $this->form_validation->set_rules('txtnombre', 'Nombre', 'required');
        $this->form_validation->set_rules('txtemail', 'correo', 'required|valid_email');
        $this->form_validation->set_rules('txtAsunto', 'Asunto', 'required');
        $this->form_validation->set_rules('txtMensaje', 'Mensaje', 'required');
       // mensajes personalizados
        $this->form_validation->set_message('required', 'El %s es requerido');
        $this->form_validation->set_message('valid_email', 'El %s no tiene un formato correcto');
        if ($this->form_validation->run() === FALSE) {
            $this->index();
        } else {
        
        $nombre = $this->input->post("txtnombre");
        $email1 = $this->input->post("txtemail");
        $asunto = $this->input->post("txtAsunto");
        $mensaje = $this->input->post("txtMensaje");
        $this->email->from($email1, $nombre);
        $this->email->to('immerpro2018@gmail.com');
        $this->email->subject($asunto);

        $html = ' El Usuario ' . $nombre . ' dejo el siguiente mensaje <font size="2" face="Arial" color="blue">' . $mensaje . '</font>';
        $this->email->message($html);

        if ($this->email->send()) {
            $this->load->view('mensaje/mensajeEmail');
        } else {
            $this->load->view('mensaje/mensajeError');
        }
        }
    }

}
