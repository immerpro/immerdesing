<?php

ini_set("display_errors", TRUE);

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

    private function createFolderC() {
        if (!is_dir("C:/excel/")) {
            mkdir("C:/excel/", 0777);
           
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
        $this->html2pdf->filename('ReporteVencido.pdf');
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
            $route = base_url() . "files/pdfs/test.pdf";
            //nombre del archivo
            $filename = "ReporteVencido.pdf";
            //si existe el archivo empezamos la descarga del pdf
            if (file_exists("./files/pdfs/" . $filename)) {
                header("Cache-Control: public");
                header("Content-Description: File Transfer");
                header('Content-disposition: attachment;
        filename = ' . basename($route));
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
            $filename = "ReporteVencido.pdf";
            $route = base_url("files/pdfs/ReporteVencido.pdf");
            if (file_exists("./files/pdfs/" . $filename)) {
                header('Content-type: application/pdf');
                readfile($route);
            }
        }
    }
    public function generarPDFVenta() {
        $finicial = date("Y-m-d", strtotime($this->input->post('finicial')));
        $ffinal = date("Y-m-d", strtotime($this->input->post('ffinal')));
        //establecemos la carpeta en la que queremos guardar los pdfs,
        //si no existen las creamos y damos permisos
        $this->createFolder();
        //importante el slash del final o no funcionará correctamente
        $this->html2pdf->folder('./files/pdfs/');
        //establecemos el nombre del archivo
        $this->html2pdf->filename('ReporteVenta.pdf');
        //establecemos el tipo de papel
        $this->html2pdf->paper('a4', 'landscape');
        //datos que queremos enviar a la vista, lo mismo de siempre
        $data = array(
            'titulo' => 'Listado de productos vendidos',
            'productosVenta' => $this->reporte_model->mostrarVenta($finicial, $ffinal)
        );
        
        //hacemos que coja la vista como datos a imprimir
        //importante utf8_decode para mostrar bien las tildes, ñ y demás
        $this->html2pdf->html(utf8_decode($this->load->view('Reporte/pdfVenta', $data, true)));

        //si el pdf se guarda correctamente lo mostramos en pantalla
        if ($this->html2pdf->create('save')) {
            $this->mostrarpdfVenta();
        }
    }

    //funcion que ejecuta la descarga del pdf
    public function descargaPdfVenta() {
        //si existe el directorio
        if (is_dir("./files/pdfs")) {
            //ruta completa al archivo
            $route = base_url() . "files/pdfs/ReporteVenta.pdf";
            //nombre del archivo
            $filename = "ReporteVenta.pdf";
            //si existe el archivo empezamos la descarga del pdf
            if (file_exists("./files/pdfs/" . $filename)) {
                header("Cache-Control: public");
                header("Content-Description: File Transfer");
                header('Content-disposition: attachment;
        filename = ' . basename($route));
                header("Content-Type: application/pdf");
                header("Content-Transfer-Encoding: binary");
                header('Content-Length: ' . filesize($route));
                readfile($route);
            }
        }
    }

    //esta función muestra el pdf en el navegador siempre que existan
    //tanto la carpeta como el archivo pdf
    public function mostrarpdfVenta() {
        if (is_dir("./files/pdfs")) {
            $filename = "ReporteVenta.pdf";
            $route = base_url("files/pdfs/ReporteVenta.pdf");
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
        $this->createFolderC();

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
        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('Logo');
        $objDrawing->setDescription('Logo');
        $objDrawing->setPath('./public/img/immerpro.png');
        $objDrawing->setHeight(58);
        $objDrawing->setCoordinates('E2');
        $objDrawing->setOffsetX(230);
        $objDrawing->setRotation(0);
        $objDrawing->getShadow()->setVisible(true);
        $objDrawing->getShadow()->setDirection(45);
        $objDrawing->setWorksheet($this->phpexcel->getActiveSheet());

        //propiedad celdas
        $this->phpexcel->getDefaultStyle()->getFont()->setName('Arial');
        $this->phpexcel->getDefaultStyle()->getFont()->setSize(12);
        $this->phpexcel->getActiveSheet()->getRowDimension('5')->setRowHeight(35);
        $this->phpexcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $this->phpexcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $this->phpexcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $this->phpexcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $this->phpexcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $this->phpexcel->getActiveSheet()->getColumnDimension('H')->setWidth(35);

        // Se agregan los titulos del reporte
        $this->phpexcel->setActiveSheetIndex(0)
                ->setCellValue('C5', $titulosColumnas[0])
                ->setCellValue('D5', $titulosColumnas[1])
                ->setCellValue('E5', $titulosColumnas[2])
                ->setCellValue('F5', $titulosColumnas[3])
                ->setCellValue('G5', $titulosColumnas[4])
                ->setCellValue('H5', $titulosColumnas[5]);
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
                ->getStyle('C5:H5')
                ->applyFromArray($borders);
        $this->phpexcel->getActiveSheet()
                ->getStyle('C5:H5')
                ->applyFromArray($borders);
        $this->phpexcel->getActiveSheet()->getStyle('C5:H5')->getFill()
                ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                ->getStartColor()->setARGB('FF8C00');
        // SE AGREGA LOS DATOS DEL REPORTE
        $i = 6;
        $productosVencidosExcel = $this->reporte_model->obtenerProductosVencidosXFechas($finicial, $ffinal);
        foreach ($productosVencidosExcel as $fila) {
            $this->phpexcel->setActiveSheetIndex(0)
                    ->getStyle('C' . $i . ":H6" . $i)
                    ->applyFromArray($borders);
            $this->phpexcel->setActiveSheetIndex(0)
                    ->setCellValue('C' . $i, $fila['producto'])
                    ->setCellValue('D' . $i, $fila['minimo'])
                    ->setCellValue('E' . $i, $fila['maximo'])
                    ->setCellValue('F' . $i, $fila['existencia']);
            $this->phpexcel->setActiveSheetIndex(0)->setCellValue('G' . $i, date("Y-m-d", strtotime($fila['fechaVencimiento'])));

            if ($this->phpexcel->setActiveSheetIndex(0)->setCellValue('G' . $i, date("Y-m-d", strtotime($fila['fechaVencimiento']))) <= date("Y-m-d")) {
                $this->phpexcel->setActiveSheetIndex(0)->setCellValue('H' . $i, 'producto vencido');
            } else {
                $this->phpexcel->setActiveSheetIndex(0)->setCellValue('H' . $i, $fila['cuantovencerse']);
            }




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
        $file_name = $wich_report . "-" . date("Y-m-d_h_i_sa", time());
        
        $objWriter = new PHPExcel_Writer_Excel2007($this->phpexcel);
        $objWriter->save('C:/excel/' . $file_name . '.xlsx');
        $this->session->set_flashdata('excelok', ' archivo de excel creado correctamente por favor dirijase a disco local C carpeta excel');
        $this->mostrarreporte();
    }

// muestra el reporte de vendidos 
    public function generar_Excel_Vendido() {
        $this->createFolderC();

        date_default_timezone_set('America/Bogota');

        $finicial = date("Y-m-d", strtotime($this->input->post('finicial')));
        $ffinal = date("Y-m-d", strtotime($this->input->post('ffinal')));
        $this->phpexcel->getProperties()->setCreator("IMMERPRO") //Autor
                ->setLastModifiedBy("IMMERPRO") //Ultimo usuario que lo modificó
                ->setTitle("Reporte productos vendidos")
                ->setSubject("Reporte productos vendidos")
                ->setDescription("Reporte productos vendidos")
                ->setKeywords("reporte productos vendidos")
                ->setCategory("Reporte excel");
        $titulosColumnas = array('PRODUCTO VENDIDO',
            'VENTA TOTAL',
            'CANTIDAD VENDIDA'
          
        );
        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('Logo');
        $objDrawing->setDescription('Logo');
        $objDrawing->setPath('./public/img/immerpro.png');
        $objDrawing->setHeight(58);
        $objDrawing->setCoordinates('D2');
        $objDrawing->setOffsetX(30);
        $objDrawing->setRotation(0);
        $objDrawing->getShadow()->setVisible(true);
        $objDrawing->getShadow()->setDirection(45);
        $objDrawing->setWorksheet($this->phpexcel->getActiveSheet());


        // $this->phpexcel->setActiveSheetIndex(0)
        // ->mergeCells('A1:Z1');
        //propiedad celdas
        $this->phpexcel->getDefaultStyle()->getFont()->setName('Arial');
        $this->phpexcel->getDefaultStyle()->getFont()->setSize(12);
        $this->phpexcel->getActiveSheet()->getRowDimension('5')->setRowHeight(35);
        $this->phpexcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $this->phpexcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $this->phpexcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
       

        // Se agregan los titulos del reporte
        $this->phpexcel->setActiveSheetIndex(0)
                ->setCellValue('C5', $titulosColumnas[0])
                ->setCellValue('D5', $titulosColumnas[1])
                ->setCellValue('E5', $titulosColumnas[2]);
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
                ->getStyle('C5:E5')
                ->applyFromArray($borders);
        $this->phpexcel->getActiveSheet()
                ->getStyle('C5:E5')
                ->applyFromArray($borders);
        $this->phpexcel->getActiveSheet()->getStyle('C5:E5')->getFill()
                ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                ->getStartColor()->setARGB('FF8C00');
        // SE AGREGA LOS DATOS DEL REPORTE
        $i = 6;
        $productosVendidosExcel = $this->reporte_model->mostrarVenta($finicial, $ffinal);
        foreach ($productosVendidosExcel as $fila) {
            $this->phpexcel->setActiveSheetIndex(0)
                    ->getStyle('C' . $i . ":E6" . $i)
                    ->applyFromArray($borders);
            $this->phpexcel->setActiveSheetIndex(0)
                    ->setCellValue('C' . $i, $fila['productovendido'])
                    ->setCellValue('D' . $i, $fila['totalVenta'])
                    ->setCellValue('E' . $i, $fila['CantidadTotal']) ;
            
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
        $wich_report = "ReporteVenta";
        // $this->phpexcel->getActiveSheet()->getStyle('A1:Z1')->applyFromArray($estiloTituloReporte);
        // Se asigna el nombre a la hoja
        $this->phpexcel->getActiveSheet()->setTitle('ReporteVenta');
        // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
        $this->phpexcel->setActiveSheetIndex(0);
        // Inmovilizar paneles 
        //$this->phpexcel->getActiveSheet(0)->freezePane('A4');
        // $this->phpexcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,27);
        $file_name = $wich_report . "-" . date("Y-m-d_h_i_sa", time());
      
        $objWriter = new PHPExcel_Writer_Excel2007($this->phpexcel);
        $objWriter->save('C:/excel/' . $file_name . '.xlsx');
        $this->session->set_flashdata('excelok', ' archivo de excel creado correctamente por favor dirijase a disco local C carpeta excel');
        $this->mostrarreporte();
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
        $tipoReporte_a_exportar = $this->input->post('tipoReporte');
        switch ($modo_a_exportar) {
            case 'excel':
                if ($tipoReporte_a_exportar == "vencido") {
                    $this->exportarExcel();
                } else {
                    $this->generar_Excel_Vendido();
                }

                break;
            case 'pdf':
                if ($tipoReporte_a_exportar == "venta") {
                    $this->generarPDFVenta();
                } else {
                     $this->index();
                }
                
                break;
        }
    }

}
