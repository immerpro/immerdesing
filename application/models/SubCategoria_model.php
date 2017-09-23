
<?php

class SubCategoria_model extends CI_Model {
    //put your code here
    public function obtenerSubCategorias() {
        $query = $this->db->get('subcategoria');
        return $query->result_array();
    }
    //ingresar Subcategorias
//    public function ingressarSubCategoria() {
//        $this->load->helper('url');
//        $Subcategoria = array(
//        'NombreSubCategoria' => $this->input->post('NombreSubCategoria'),
//        'FechaSubCategoria' => date("Y-m-d H:i:s") 
//        );
//        
//        return $this->db->insert('subcategoria', $Subcategoria);
//    }
    
    public function InsertSubcategoria($NombreSubcategoria){
        
        return $this->db->insert('subcategoria', $NombreSubcategoria);  
    }


    public function Versub($id) {
        
        $this->db->select('*');
        $this->db->from('subcategoria');
        $this->db->join('categoria', 'Categoria.idCategoria = subcategoria.Categoria_idCategoria');
        $this->db->where('Categoria.idCategoria',$id );
        $this->db->where('subcategoria.Estado_estadoId', 1);
        $query = $this->db->get();
        return $query->result_array();
    }
//    public function Insertar($data) {
//        $query = $this->db->get('subcategoria');
//        //los recorremos y los guardamos en un array 
//        foreach ($query->result() as $fila) {
//            $data[] = array(
//                'idSubcategoria' => $fila->idSubcategoria,
//                'NombreSubcategoria' => $fila->NombreSubcategoriae,
//                'detallesSub' => $fila->detallesSub,
//                'Categoria_idCategoria' => $fila->Categoria_idCategoria
//            );
//        }
//        //fuera del bucle hacemos la insercción de los datos con insert_batch	
//        $this->db->insert_batch('subcategoria', $data);
//    }
    
    public function modificar_subcategoria($idsubcategoria){
        
        $this->db->where('idSubcategoria', $idsubcategoria);
        $query = $this->db->get('subcategoria');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
        
    }
    public function Actualizasubcategoria($IdSubCategoria, $datasub){
        $this->db->where('idSubcategoria', $IdSubCategoria);
        $this->db->update('subcategoria', $datasub);
        
    }
    public function inactivarSubcategoria($idSub){
        
        $this->db->set('Estado_estadoId', 2);
        $this->db->where('idSubcategoria', $idSub);

        $inactivasub = $this->db->update('subcategoria');
        return $inactivasub;
        
    }
     public function nombresubcategoria($id) {
        $this->db->select('NombreSubcategoria');
        $this->db->from('subcategoria');
        $this->db->where('idSubcategoria', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }
    
}