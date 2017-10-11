<?php

class Reporte_Model extends CI_Model {

    Public function __construct() {
        parent::__construct();
    }

    //obtener todos los productos


    public function obtenerProductosVencidosXFechas($finicial, $ffinal) {
        $infoxagotarse = $this->db->query("SELECT pro.`NombreProducto` AS producto,
                                        pro.`CodigoDeBarras` AS codBarras,
                                        pro.`minimoStock` AS minimo,
                                         pro.`MaximoStock` AS maximo,
                                         pro.`Existencias` AS existencia,
                                         dep.`fechavenc` AS fechaVencimiento,
                                         dep.`lote` AS lote,
                                         DATEDIFF(dep.`fechavenc`,CURDATE()) AS cuantovencerse
                                        FROM `producto` pro INNER JOIN `detalleproducto` dep ON pro.`idProducto` = dep.`Producto_idProducto`
                                        WHERE dep.`fechavenc` BETWEEN '$finicial' AND '$ffinal'");
        return $infoxagotarse->result_array();
    }

    public function todosVencidos() {
        $infoxagotarse = $this->db->query("SELECT pro.`NombreProducto` AS producto,
                                        pro.`CodigoDeBarras` AS codBarras,
                                        pro.`minimoStock` AS minimo,
                                         pro.`MaximoStock` AS maximo,
                                         pro.`Existencias` AS existencia,
                                         dep.`fechavenc` AS fechaVencimiento,
                                         dep.`lote` AS lote,
                                         DATEDIFF(dep.`fechavenc`,CURDATE()) AS cuantovencerse,
                                         dep.`diaVencimiento` AS diaVencer
                                        FROM `producto` pro INNER JOIN `detalleproducto` dep ON pro.`idProducto` = dep.`Producto_idProducto`");
        return $infoxagotarse->result_array();
    }

    // muestra el reporte de venta
//    public function mostrarVenta($fecha_inicio,$fecha_final) {
//        $mostrar_producto_venta = $this->db->query("CALL SPReporteVenta(
//                '$fecha_inicio',"
//                . "'$fecha_final')");
//        return $mostrar_producto_venta->result_array();
//     
//    }
    public function mostrarVenta($fecha_inicio, $fecha_final) {
        $mostrar_producto_venta = $this->db->query("select  `p`.`NombreProducto` AS `productovendido`,
SUM(`desal`.`CantidadOrdenSalida`*`desal`.`PrecioOrdenSalida`) AS totalVenta,
SUM(`desal`.`CantidadOrdenSalida`) as CantidadTotal
from (((`ordensalida` `sal` join `detallesalida` `desal` on((`sal`.`idOrdenSalida` = `desal`.`OrdenSalida_idOrdenSalida`))) join `detalleproducto` `dpro` on((`dpro`.`idDetalleProducto` = `desal`.`DetalleProducto_idDetalleProducto`))) join `producto` `p` on((`p`.`idProducto` = `dpro`.`Producto_idProducto`))) 
where sal.motivoSalida='venta' and  `sal`.`FechaDeSalida` BETWEEN '" . $fecha_inicio . "' AND '" . $fecha_final . "'
GROUP BY `p`.`NombreProducto`");
        return $mostrar_producto_venta->result_array();
    }

}
