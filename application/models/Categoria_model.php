<?php

class Categoria_model extends CI_Model {

    // OBTENER TODAS LAS CATEGORIAS
    public function traerCategorias() {
        $this->db->where('estado_EstadoId', 1);
        $query = $this->db->get('categoria');
        return $query->result_array();
    }

    public function traerCategoriasXSubcategoria() {
        $query = $this->db->query("SELECT DISTINCT c.idCategoria as codCategoria,c.NombreCategoria as categoria  FROM categoria c 
INNER JOIN subcategoria s ON c.idCategoria=s.Categoria_idCategoria");
        return $query->result_array();
    }

    // llenar subcategorias a partir de una categoria
    public function asociarSubcategoria($idCategoria) {
        $this->db->where('Categoria_idCategoria', $idCategoria);
        $subcategoriasAsoc = $this->db->get('subcategoria');
        if ($subcategoriasAsoc->num_rows() > 0) {
            return $subcategoriasAsoc->result();
        } else {
            echo "no tiene subcategorias asociadas";
        }
    }
    //ingresar categorias
    public function ingressarCategoria() {
        $categoria = array(
             'NombreCategoria' => strip_tags($this->input->post('NombreCategoria'),'') ,
            'detalles' => strip_tags( $this->input->post('txtdetalle')),
            'estado_EstadoId' => 1
        );

        return $this->db->insert('categoria', $categoria);
    }
    public function nombrecategoria($id) {
        $this->db->select('NombreCategoria');
        $this->db->from('categoria');
        $this->db->where('idCategoria', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }
    public function Actualizacategoria($idCategoria, $data) {
        $this->db->where('idCategoria', $idCategoria);
        $this->db->update('categoria', $data);
    }
    public function obtener_categoria_a_modificar($idCategoria) {
        $this->db->where('idCategoria', $idCategoria);
        $query = $this->db->get('categoria');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }
    public function inactivarcategoria($idCategoria) {
        $this->db->set('estado_EstadoId', 2);
        $this->db->where('idCategoria', $idCategoria);
        $inactiva = $this->db->update('categoria');
        return $inactiva;
    }

// obtiene el nombre de la categoria a apartir del id de subcategoria
    public function obtenerNombreXid($id) {
        $this->db->select('*');
        $this->db->from('subcategoria');
        $this->db->join('categoria', 'categoria.idCategoria = subcategoria.Categoria_idCategoria');
        $this->db->where('subcategoria.Categoria_idCategoria', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    // METODO PARA PAGINAR 
    public function paginarCategoria($limite, $numPag) {
        $this->db->where('estado_EstadoId', 1);
        $consulta = $this->db->get('categoria', $limite, $numPag);
        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        }
    }

    public function cantidad_filas() {
        $consulta = $this->db->get('categoria');
        return $consulta->num_rows();
    }
    // METODO PARA EL BUSCADOR
     public function paginarCategoriaFiltrado($limite, $numPag, $buscar_x_campo) {
        $this->db->like('NombreCategoria', $buscar_x_campo);
        $this->db->where('estado_EstadoId', 1);
        $consulta = $this->db->get('categoria', $limite, $numPag);
        if ($consulta->num_rows() > 0) {

            return $consulta->result();
        }
    }
    public function cantidad_filasFiltrado($buscar_x_campo) {
        $this->db->like('NombreCategoria', $buscar_x_campo);
        $consulta = $this->db->get('categoria',5);
        return $consulta->num_rows();
    }
  
}
