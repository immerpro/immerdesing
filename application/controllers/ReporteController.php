<?php

class ReporteController extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('reporte_model');
        $this->load->library('Classes/PHPExcel.php');
        $this->load->library('html2pdf');
    }
    /* REPORTE PDF * ** */
    private function createFolder() {
        if (!is_dir("./files")) {
            mkdir("./files", 0777);
            mkdir("./files/pdfs", 0777);
        }
    }
    public function index() {
        $finicial = date("Y-m-d", strtotime($this->input->post('finicial')));
        $ffinal = date("Y-m-d", strtotime($this->input->post('ffinal')));
        //establecemos la carpeta en la que queremos guardar los pdfs,
        //si no existen las creamos y damos permisos
        $this->createFolder();
        //importante el slash del final o no funcionará correctamente
        $this->html2pdf->folder('./files/pdfs/');
        //establecemos el nombre del archivo
        $this->html2pdf->filename('test.pdf');
        //establecemos el tipo de papel
        $this->html2pdf->paper('a4', 'landscape');
        //datos que queremos enviar a la vista, lo mismo de siempre
        $data = array(
            'titulo' => 'Listado de productos vencidos',
            'productosVencidos' => $this->reporte_model->obtenerProductosVencidosXFechas($finicial, $ffinal)
        );
        //hacemos que coja la vista como datos a imprimir
        //importante utf8_decode para mostrar bien las tildes, ñ y demás
        $this->html2pdf->html(utf8_decode($this->load->view('Reporte/pdf', $data, true)));

        //si el pdf se guarda correctamente lo mostramos en pantalla
        if ($this->html2pdf->create('save')) {
            $this->mostrarpdf();
        }
    }
    //funcion que ejecuta la descarga del pdf
    public function descargaPdf() {
        //si existe el directorio
        if (is_dir("./files/pdfs")) {
            //ruta completa al archivo
            $route = base_url("files/pdfs/test.pdf");
            //nombre del archivo
            $filename = "test.pdf";
            //si existe el archivo empezamos la descarga del pdf
            if (file_exists("./files/pdfs/" . $filename)) {
                header("Cache-Control: public");
                header("Content-Description: File Transfer");
                header('Content-disposition: attachment; filename=' . basename($route));
                header("Content-Type: application/pdf");
                header("Content-Transfer-Encoding: binary");
                header('Content-Length: ' . filesize($route));
                readfile($route);
            }
        }
    }
    //esta función muestra el pdf en el navegador siempre que existan
    //tanto la carpeta como el archivo pdf
    public function mostrarpdf() {
        if (is_dir("./files/pdfs")) {
            $filename = "test.pdf";
            $route = base_url("files/pdfs/test.pdf");
            if (file_exists("./files/pdfs/" . $filename)) {
                header('Content-type: application/pdf');
                readfile($route);
            }
        }
    }
    /* FIN PDF */
    public function mostrarreporte() {
        if ($this->session->userdata('rol') == NULL || $this->session->userdata('rol') != 1) {
            redirect(base_url() . 'iniciar');
        }
        $data = [
            'titulo' => 'Admin',
            'es_usuario_normal' => FALSE,
            'perfil' => $this->usuario_model->consultarPerfil($this->session->userdata('idUsuario'))];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('Reporte/reporte');
        $this->load->view('templates/footer');
    }
    public function exportarExcel() {
        date_default_timezone_set('America/Bogota');
        $finicial = date("Y-m-d", strtotime($this->input->post('finicial')));
        $ffinal = date("Y-m-d", strtotime($this->input->post('ffinal')));
        $this->phpexcel->getProperties()->setCreator("IMMERPRO") //Autor
                ->setLastModifiedBy("IMMERPRO") //Ultimo usuario que lo modificó
                ->setTitle("Reporte Vencidos")
                ->setSubject("Reporte Vencidos")
                ->setDescription("Reporte Vencidos")
                ->setKeywords("reporte vencidos")
                ->setCategory("Reporte excel");
        $titulosColumnas = array('PRODUCTO',
            'MINIMO STOCK',
            'MAXIMO STOCK',
            'EXISTENCIAS',
            'VENCIMIENTO',
            'CUANTO PARA VENCERSE'
        );
        // $this->phpexcel->setActiveSheetIndex(0)
        // ->mergeCells('A1:Z1');
        //propiedad celdas
        $this->phpexcel->getDefaultStyle()->getFont()->setName('Arial');
        $this->phpexcel->getDefaultStyle()->getFont()->setSize(12);
        $this->phpexcel->getActiveSheet()->getRowDimension('1')->setRowHeight(25);
        $this->phpexcel->getActiveSheet()->getColumnDimension('A')->setWidth(45);
        $this->phpexcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
        $this->phpexcel->getActiveSheet()->getColumnDimension('C')->setWidth(35);
        $this->phpexcel->getActiveSheet()->getColumnDimension('D')->setWidth(35);
        $this->phpexcel->getActiveSheet()->getColumnDimension('E')->setWidth(50);
        $this->phpexcel->getActiveSheet()->getColumnDimension('F')->setWidth(38);
        // Se agregan los titulos del reporte
        $this->phpexcel->setActiveSheetIndex(0)
                ->setCellValue('A1', $titulosColumnas[0])
                ->setCellValue('B1', $titulosColumnas[1])
                ->setCellValue('C1', $titulosColumnas[2])
                ->setCellValue('D1', $titulosColumnas[3])
                ->setCellValue('E1', $titulosColumnas[4])
                ->setCellValue('F1', $titulosColumnas[5]);
        // $this->phpexcel->getActiveSheet()
        // ->getStyle('A1:Z1')
        // ->getFill()
        // ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        // ->getStartColor()->setARGB('FF8C00');
        $borders = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => 'FF000000'),
                )
            ),
        );
        $this->phpexcel->getActiveSheet()
                ->getStyle('A1:F1')
                ->applyFromArray($borders);
        $this->phpexcel->getActiveSheet()
                ->getStyle('A1:F1')
                ->applyFromArray($borders);
        $this->phpexcel->getActiveSheet()->getStyle('A1:F1')->getFill()
                ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                ->getStartColor()->setARGB('FF8C00');
        // SE AGREGA LOS DATOS DEL REPORTE
        $i = 2;
        $productosVencidosExcel = $this->reporte_model->obtenerProductosVencidosXFechas($finicial, $ffinal);
        foreach ($productosVencidosExcel as $fila) {
            $this->phpexcel->setActiveSheetIndex(0)
                    ->getStyle('A' . $i . ":F1" . $i)
                    ->applyFromArray($borders);
            $this->phpexcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $fila['producto'])
                    ->setCellValue('B' . $i, $fila['minimo'])
                    ->setCellValue('C' . $i, $fila['maximo'])
                    ->setCellValue('D' . $i, $fila['existencia'])
                    ->setCellValue('E' . $i, date("Y-m-d", strtotime($fila['fechaVencimiento'])))
                    ->setCellValue('F' . $i, $fila['cuantovencerse']);
            $i++;
        }
        $estiloTituloReporte = array(
            'font' => array(
                'name' => 'Verdana',
                'bold' => true,
                'italic' => false,
                'strike' => false,
                'size' => 15,
                'color' => array(
                    'rgb' => 'F5FFFA'
                )
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('argb' => '191970')
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_NONE
                )
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'rotation' => 0,
                'wrap' => TRUE
            )
        );
        $wich_report = "ReporteVencidos";
        // $this->phpexcel->getActiveSheet()->getStyle('A1:Z1')->applyFromArray($estiloTituloReporte);
        // Se asigna el nombre a la hoja
        $this->phpexcel->getActiveSheet()->setTitle('ReporteVencidos');
        // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
        $this->phpexcel->setActiveSheetIndex(0);
        // Inmovilizar paneles 
        //$this->phpexcel->getActiveSheet(0)->freezePane('A4');
        // $this->phpexcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,27);
        $file_name = $wich_report . "-" . date("Y-m-dH:i:s", time());
        // Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $file_name . '.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }

    public function generarReporte() {
        $modo_a_exportar = $this->input->post('ddExportar');
        $tipoReporte_a_exportar = $this->input->post('tipoReporte');

        switch ($tipoReporte_a_exportar) {
            case 'vencido':
                $this->seleccionarTipoReporte($modo_a_exportar);
                break;
            case 'venta':
                $this->seleccionarTipoReporte($modo_a_exportar);

                break;
        }
    }

    public function seleccionarTipoReporte($modo_a_exportar) {
        switch ($modo_a_exportar) {
            case 'excel':
                $this->exportarExcel();
                break;
            case 'pdf':
                $this->index();
                break;
        }
    }

}
