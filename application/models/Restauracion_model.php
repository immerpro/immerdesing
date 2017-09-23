<?php

class Restauracion_Model extends CI_Model {

    Public function __construct() {
        parent::__construct();
    }

    public function mostrarRestauracion($colEstado, $tabla) {
        $this->db->where($colEstado, 2);
        $query = $this->db->get($tabla);
        return $query->result_array();
    }
    public function mostrarRestauracionColaborador($colEstado, $tabla) {
        $this->db->where($colEstado, 3);
        $query = $this->db->get($tabla);
        return $query->result_array();
    }

    public function activarRestauracion($colEstado, $tabla, $idTabla, $valId) {
        $this->db->set($colEstado, 1, FALSE);
        $this->db->where($idTabla, $valId);
        $activaRestauracion = $this->db->update($tabla);
        return $activaRestauracion;
    }
    public function pasarAHabilitar($colEstado, $tabla, $idTabla, $valId) {
        $this->db->set($colEstado, 2, FALSE);
        $this->db->where($idTabla, $valId);
        $activaRestauracion = $this->db->update($tabla);
        return $activaRestauracion;
    }

    }
