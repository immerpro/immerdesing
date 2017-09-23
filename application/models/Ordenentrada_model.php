<?php

class Ordenentrada_model extends CI_Model {

    public function obtenerordenentrada() {
//        $this->db->where('');
        $query = $this->db->get('ordenentrada');
        return $query->result_array();
    }

    public function registrarordenentrada($codUsuario, $codProveedor, $precioEntrada, $cantEntrada, $codProducto) {

        $ingreso_orden_entrada = $this->db->query("CALL SPRegistroOrdenEntrada(
                '$codUsuario',"
                . "'$codProveedor',"
                . "'$precioEntrada',"
                . "'$cantEntrada',"
                . "'$codProducto')");

        return $ingreso_orden_entrada;
    }

    public function obtenerentrada() {
        $this->db->order_by('fecha', 'DESC');

        $query = $this->db->get('entradaview');
        return $query->result_array();
    }
    // codigo para el autocompletado
    public function autoproducto($q){
    $this->db->select('NombreProducto');
    $this->db->like('NombreProducto', $q);
    $query = $this->db->get('producto');
    if($query->num_rows() > 0){
      foreach ($query->result_array() as $row){
        $row_set[] = htmlentities(stripslashes($row['NombreProducto'])); //build an array
      }
      echo json_encode($row_set); //format the array into json data
    }
  }

}
