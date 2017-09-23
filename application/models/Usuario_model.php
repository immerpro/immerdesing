<?php

class Usuario_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

// insertar usuarios en la bd
    public function registrarusuario($registroU) {
        return $this->db->insert('usuario', $registroU);
    }

    public function iniciarSesion($usuario, $password) {
        $this->db->where('NombreUsuario', $usuario);
        $this->db->where('ClaveUsuario', sha1($password));
        $this->db->where('Estado_EstadoId', 1);
        $consulta = $this->db->get('usuario');
        if ($consulta->num_rows() > 0) {
            return $consulta->row();
        } else {
            $this->session->set_flashdata('usuario_mal', 'datos ingresados incorrectos o no tiene autorizaciòn para ingresar');
            redirect(base_url() . 'iniciar', 'refresh');
        }
    }

    // mostrar colaboradores sin autorizar
    public function mostrarColaboradorSinAutorizar() {
        $this->db->where('RolUsuario_idRolUsuario', 2);
        $this->db->where('Estado_EstadoId', 2);
        $query = $this->db->get('usuario');
        return $query->result_array();
    }

    // muestra los colaboradores activos de la aplicacion 
    public function mostrarColaboradorActivo() {
        $this->db->where('RolUsuario_idRolUsuario', 2);
        $this->db->where('Estado_EstadoId', 1);
        $query = $this->db->get('usuario');
        return $query->result_array();
    }

// cambiar la autorizacion de la aplicacion 
    public function cambiarAutorizacion($idUsColabora) {
        $this->db->set('Estado_EstadoId', 1);
        $this->db->where('idUsuario', $idUsColabora);
        $cambio = $this->db->update('usuario');
        return $cambio;
    }

    public function inactivarColaborador($idUsColabora) {
        // el usuario con estado 4(Baja) ya no trabaja en el supermercado pero se encuentra en la base de datos 
        $this->db->set('Estado_EstadoId', 4);
        $this->db->where('idUsuario', $idUsColabora);
        $cambio = $this->db->update('usuario');
        return $cambio;
    }

    //Andrey Ramirez 
    public function mostrarRol($codrol) {
        $colaborador = $this->db->query("CALL SPTraerRol('$codrol')");
        return $colaborador->row();
    }

    public function atualizarperfil($idUsuario, $data) {
        $this->db->where('idUsuario', $idUsuario);
        $this->db->update('usuario', $data);
    }

//    public function mostrarEmail($Cemail) {
//        $this->db->select('email');
//        $this->db->where('NombreUsuario', $Cemail);
//        $consulta = $this->db->get('usuario');
//        return $consulta->row();
//    }
//
//    public function mostrarNombre($Cuser) {
//        $this->db->select('nombreCompleto');
//        $this->db->where('NombreUsuario', $Cuser);
//        $consulta = $this->db->get('usuario');
//        return $consulta->row();
//    }
    // cerberian 
    public function consultarPerfil($codUsuario) {
        $this->db->select('nombreCompleto,NombreUsuario,email');
        $this->db->where('idUsuario', $codUsuario);
        $consulta = $this->db->get('usuario');
        return $consulta->row();
    }

    // consultar perfil del usuario
//    public function traerusuario($Cuserc) {
//        $this->db->select('NombreUsuario');
//        $this->db->from('usuario');
//        $this->db->where('idUsuario', $Cuserc);
//        $consulta = $this->db->get();
//        return $consulta->row();
//    }

    /* ++++++++++++++++RECUPERACION CONTRASEÑA++++++++++++++++++++++++++++++++ */

    // Recuperacion Contraseña
    /* @desc - comprueba si existe el email
     * @param - $email string con el email del formulario
     * @return - boolean
     */
    public function verifica_email($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('usuario');
        if ($query->num_rows() === 1) {
            return TRUE;
        }
    }

    /**
     * @desc - obtiene los datos de un usuario por su email
     * @param - $email string con el email del formulario
     * @return - mixed
     */
    public function obtenerInfoUsuario($email) {
        $query = $this->db->get_where('usuario', array('email' => $email));
        if ($query->num_rows() === 1) {
//actualizamos el campo request_token del usuario y 
//le damos 5 minutos para recuperar el password
            if ($this->tiempoLimiteRecuperacion($query->row()->idUsuario)) {
                return $query->row();
            }
        }
    }

    /**
     * @desc - actualiza el campo request_token del usuario para dar 5 minutos
     * @param - $user_id int con el id del usuario
     * @return - bool
     */
    private function tiempoLimiteRecuperacion($user_id) {
       date_default_timezone_set('America/Bogota');
//damos 5 minutos al usuario para recuperar su password
        $expire_stamp = date('Y-m-d H:i:s', strtotime("+8 min"));
        $data = array("request_token" => $expire_stamp);
        $this->db->where("idUsuario", $user_id);
        if ($this->db->update("usuario", $data)) {
            return TRUE;
        }
    }

    /**
     * @desc - comprueba si el campo request_token es menor que la fecha actual
     * @param $token - string unico por usuario
     * @return - bool
     */
    public function comprobarToken($token) {
        date_default_timezone_set('America/Bogota');
        $current_stamp = date('Y-m-d H:i:s');
        $query = $this->db->select("idUsuario")
                ->from("usuario")
                ->where("token", $token)
                ->where("request_token >", $current_stamp)
                ->get();

        if ($query->num_rows() === 1) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    /**
     * @desc - hacemos el update del password del usuario
     * @param $data - array con datos para actualizar
     * @return - bool
     */
    public function cambiarClave($data = array()) {
        date_default_timezone_set('America/Bogota');
        $this->db->where("idUsuario", $data["user_id"]);
        unset($data['user_id']); //eliminamos la clave user_id del array
        if ($this->db->update("usuario", $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
