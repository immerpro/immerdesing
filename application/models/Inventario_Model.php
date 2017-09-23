<?php

class Inventario_Model extends CI_Model {

    Public function __construct() {
        parent::__construct();
    }

    //    NOTIFICACIONES
    // saber cuantos productos estan  agotados
    public function cantidadAgotados() {
        $cuantoAgotado = $this->db->query("select count(pv.estado) agotados from productosview pv where existencia = 0");
        return $cuantoAgotado->row();
    }

    // saber cuantos productos estan vencidos   SELECT minimoStock FROM producto
    public function cantidadVencidos() {
        $cuantovencido = $this->db->query("SELECT COUNT(producto) AS cantVencido FROM vencidosview WHERE dvencimiento <= 0");
        return $cuantovencido->row();
    }

    public function saberDiasVencidos() {
        $cuantovencidodia = $this->db->query("SELECT * FROM vencidosview WHERE dvencimiento <= 3");
        return $cuantovencidodia->row();
    }

    public function consultarMinStock() {
        $cuantovencido = $this->db->query("SELECT minimoStock FROM producto");
        return $cuantovencido->row();
    }

// CUANTOS PRODUCTOS ESTAN POR AGOTARSE
    public function cantidadXAgotarse() {
        $agotarse = $this->db->query(" SELECT COUNT(vp.codProducto) AS cuantoAgotarse FROM productosview  vp WHERE existencia <= 12");
        return $agotarse->row();
    }

    public function cantidadXVencerse() {
        $agotarse = $this->db->query(" SELECT COUNT(dvencimiento) AS cuantovencerse FROM vencidosview where dvencimiento < 0  ");
        return $agotarse->row();
    }

// CUANTAS EXISTENCIAS HAY EN EL INVENTARIO
    public function cantidadExistencia() {
        $cantExist = $this->db->query(" select count(existencia) as ExistenciaTotal from productosview ");
        return $cantExist->row();
    }

// MOSTRAR LOS PRODUCTOS VENCIDOS
    public function obtenerVencidos() {
        //
        $query = $this->db->query("SELECT * FROM vencidosview WHERE dvencimiento <= 0 ");
        return $query->result_array();
    }

    public function mostrarXVencer() {
        //
        $query = $this->db->query("SELECT * FROM vencidosview ORDER BY dvencimiento  ASC limit 10 ");
        return $query->result_array();
    }

// MOSTRAR PRODUCTOS AGOTADOS
    public function obtenerProductosAgotados() {
        $this->db->where('existencia =', 0);
        $query = $this->db->get('productosview',10);
        return $query->result_array();
    }

//MOSTRAR PRODUCTOS POR AGOTARSE
    public function obtenerProductosXAgotarse() {
        $infoxagotarse = $this->db->query("SELECT *  FROM productosview  vp WHERE existencia <= 12 ORDER BY  existencia ASC limit 10");
        return $infoxagotarse->result_array();
    }

    // oreden de salida
    // procedimiento almacenado
    public function registrarOrdenSalida($motivo, $Precio, $Cantidad, $nombre) {

        $ingreso_orden_salida = $this->db->query("CALL SPRegistrarOrdenSalida(
                '$motivo',"
                . "'$Precio',"
                . "'$Cantidad',"
                . "'$nombre')");

        return $ingreso_orden_salida;
    }

    // CONSULTA SALIDA

    public function ConsultarSalida() {
        $query = $this->db->get('salidaview');
        return $query->result_array();
    }

//PAGINACION  ORDEN DE ENTRADA
    public function paginarentrada($limite, $numPag) {
        $this->db->order_by('fecha', 'DESC');
        $consulta = $this->db->get('entradaview', $limite, $numPag);
        if ($consulta->num_rows() > 0) {

            return $consulta->result();
        }
    }

    public function cantidad_filas() {
        $consulta = $this->db->get('entradaview');
        return $consulta->num_rows();
    }

    public function cantidad_filasFiltrado($buscar_x_campo, $filtro) {
        $this->db->order_by('fecha', 'DESC');
        $this->db->like($filtro, $buscar_x_campo);
        $consulta = $this->db->get('entradaview', 5);
        return $consulta->num_rows();
    }

    public function paginarFiltrado($limite, $numPag, $buscar_x_campo, $filtro) {
        $this->db->order_by('fecha', 'DESC');
        $this->db->like($filtro, $buscar_x_campo);
        $consulta = $this->db->get('entradaview', $limite, $numPag);
        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        }
    }

    // PAGINACION ORDEN SALIDA
    public function cantidad_filasSalida() {
        $this->db->order_by('fechaSal', 'DESC');
        $consulta = $this->db->get('salidaview');
        return $consulta->num_rows();
    }

    public function paginarsalida($limite, $numPag) {
        $this->db->order_by('fechaSal', 'DESC');
        $consulta = $this->db->get('salidaview', $limite, $numPag);
        if ($consulta->num_rows() > 0) {

            return $consulta->result();
        }
    }

    public function cantidad_filasFiltradoSalida($buscar_x_campo, $filtro) {
        $this->db->like($filtro, $buscar_x_campo);
        $consulta = $this->db->get('salidaview', 5);
        return $consulta->num_rows();
    }

    public function paginarFiltradoSalida($limite, $numPag, $buscar_x_campo, $filtro) {

        $this->db->order_by('fechaSal', 'DESC');
        $this->db->like($filtro, $buscar_x_campo);
        $consulta = $this->db->get('salidaview', $limite, $numPag);
        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        }
    }

    public function ObtenerCorreoAdmin() {
        $this->db->select("email");
        $this->db->from("usuario");
        $this->db->where("idUsuario", "1");
        $consulta = $this->db->get();
        return $consulta->row();

    }

}
