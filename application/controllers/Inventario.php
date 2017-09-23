<?php

class Inventario extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
       
    }

    public function index() {
        if ($this->session->userdata('rol') == NULL || $this->session->userdata('rol') != 1) {
            redirect(base_url() . 'iniciar');
        }
        $data = [
            'titulo' => 'inventario',
            'cvencidos' => $this->inventario_model->cantidadVencidos(),
            'cantAgotados' => $this->inventario_model->cantidadAgotados(),
            'cporAgotarse' => $this->inventario_model->cantidadXAgotarse(),
            'existenciaTotal' => $this->inventario_model->cantidadExistencia(),
            'mostrarVencidos' => $this->inventario_model->obtenerVencidos(),
            'mostrarAgotado' => $this->inventario_model->obtenerProductosAgotados(),
            'listXAgotarse' => $this->inventario_model->obtenerProductosXAgotarse(),
            'diavence' => $this->inventario_model->saberDiasVencidos(),
            'vence' => $this->inventario_model->cantidadXVencerse(),
            'mostrarporVencer' => $this->inventario_model->mostrarXVencer(),
            'es_usuario_normal' => FALSE,
            'perfil' => $this->usuario_model->consultarPerfil($this->session->userdata('idUsuario'))
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('inventario/index');
        $this->load->view('templates/footer');
    }

    public function mostrarNotificacionView() {
        if ($this->session->userdata('rol') == NULL || $this->session->userdata('rol') != 1) {
            redirect(base_url() . 'iniciar');
        }
        $data = ['titulo' => 'Notificaciones', 'es_usuario_normal' => FALSE,
            'perfil' => $this->usuario_model->consultarPerfil($this->session->userdata('idUsuario'))];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('inventario/notifica');
        $this->load->view('templates/footer');
    }
    // envia un correo de forma automatica cada 20 dias 
    public function notificar() {
        date_default_timezone_set('America/Bogota');
        if ($this->session->userdata('rol') == NULL || $this->session->userdata('rol') != 1) {
            redirect(base_url() . 'iniciar');
        }
        $vencido = $this->inventario_model->cantidadVencidos();
        $agotado = $this->inventario_model->cantidadAgotados();
        $porAgotarse = $this->inventario_model->cantidadXAgotarse();
        $envio = $this->inventario_model->ObtenerCorreoAdmin()->email;
        $this->email->from('immerpro2018@gmail.com', 'ImmerPRO');
        $this->email->to($envio);
        $this->email->bcc('immerpro2018@gmail.com');
        $this->email->subject('ImmerPRO - Notificaciones-' . date("d F Y h:i a"));
        $this->email->message('  <strong> productos vencidos:</strong> ' . $vencido->cantVencido . '<br>'
                . ' <strong><font size="3" color="red"> productos Agotados:</font></strong> ' . $agotado->agotados . '<br>'
                . ' <strong><font size="3" color="orange"> Producto Proximo a  Agotarse :</font></strong> ' . $porAgotarse->cuantoAgotarse . ' se sugiere realize un pedido de los productos <br>'
                . ' <font size="3" color="green">Para ver la informacion de los  productos notificados dar click en el siguiente link: </font> <a href="' . base_url() . 'iniciar">Iniciar Sesiòn </a>');

        if ($this->email->send()) {
            return TRUE;
        } else {
            return FALSE; 
        }
    }
    public function OrdenSalida() {
        if ($this->session->userdata('rol') == NULL) {
            redirect(base_url() . 'iniciar');
        }
        $data = ['titulo' => 'Orden Salida',
            'lsalida' => $this->inventario_model->ConsultarSalida(),
            'es_usuario_normal' => FALSE,
            'perfil' => $this->usuario_model->consultarPerfil($this->session->userdata('idUsuario'))];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('inventario/OrdenSalida', $data);
        $this->load->view('templates/footer');
    }
    public function CrearSalida() {
        if ($this->session->userdata('rol') == NULL) {
            redirect(base_url() . 'iniciar');
        }
        $data = ['titulo' => 'Nueva Orden Salida',
            'lproducto' => $this->productos_model->obtenerProductos(),
            'es_usuario_normal' => FALSE,
            'perfil' => $this->usuario_model->consultarPerfil($this->session->userdata('idUsuario'))];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('inventario/NuevaSalida');
        $this->load->view('templates/footer');
    }
    public function ordenentrada() {
        if ($this->session->userdata('rol') == NULL || $this->session->userdata('rol') != 1) {
            redirect(base_url() . 'iniciar');
        }
        $data = ['titulo' => "ordenentrada", 'es_usuario_normal' => FALSE,
            'perfil' => $this->usuario_model->consultarPerfil($this->session->userdata('idUsuario'))];
        $t['proveedor_select'] = $this->Proveedor_model->TraerDatos();

        // cargar la vista
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('Ordenentrada/ordenentrada', $t);
        $this->load->view('templates/footer');
    }

    function get_producto() {
        if (empty($this->input->post('txtCodProduc'))) {
            $q = strtolower($this->input->post('txtCodProduc'));
            $this->Ordenentrada_model->autoproducto($q);
        }
    }
    public function consultarordenentrada($numPag = 0) {
        if ($this->session->userdata('rol') == NULL || $this->session->userdata('rol') != 1) {
            redirect(base_url() . 'iniciar');
        }
        $buscarCategoria = $this->input->post('txtbuscar');
        if ($buscarCategoria == "") {
            ob_start();
            $this->pagina(0);
            $initial_content = ob_get_contents();
            ob_end_clean();
        } else {
            ob_start();
            $this->paginaentrada(0);
            $initial_content = ob_get_contents();
            ob_end_clean();
        }
        $data = ['titulo' => "Listado Entradas", 'es_usuario_normal' => FALSE,
            'perfil' => $this->usuario_model->consultarPerfil($this->session->userdata('idUsuario')),
            'div1' => " <div id='pagina'>",
            'table' => $initial_content];
        // cargar la vista
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('Ordenentrada/consultarordenentrada', $data);
        $this->load->view('templates/footer');
    }
    public function pagina($numPag = 0) {
        if ($this->session->userdata('rol') == NULL || $this->session->userdata('rol') != 1) {
            redirect(base_url() . 'iniciar');
        }
        $config['base_url'] = base_url('Inventario/pagina/');
        $config['div'] = '#pagina'; //asignamos un id al contenedor general
        $config['anchor_class'] = 'btn btn-dark-green btn-rounded'; //asignamos una clase a los links para maquetar
        $config['show_count'] = FALSE; //en true queremos ver Viendo 1 a 10 de 52
        $config['total_rows'] = $this->inventario_model->cantidad_filas();
        $config['per_page'] = 5; //-->número de productos por página
        $config['num_links'] = 1; //-->número de links visibles
        $config['full_tag_open'] = '<nav aria-label="Page navigation" class="flex-center"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li class="previous">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#" class="btn btn-orange">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_link'] = '« primero';
        $config['last_link'] = '» ùltimo';
        $template = array(
            'table_open' => '<table class="table table-striped table-bordered table-hover">',
            'thead_open' => '<thead >',
            'thead_close' => '</thead>',
            'heading_row_start' => '<tr>',
            'heading_row_end' => '</tr>',
            'heading_cell_start' => '<th>',
            'heading_cell_end' => '</th>',
            'tbody_open' => '<tbody>',
            'tbody_close' => '</tbody>',
            'row_start' => '<tr>',
            'row_end' => '</tr>',
            'cell_start' => '<td>',
            'cell_end' => '</td>',
            'row_alt_start' => '<tr>',
            'row_alt_end' => '</tr>',
            'cell_alt_start' => '<td>',
            'cell_alt_end' => '</td>',
            'table_close' => '</table>'
        );
        $listadoordenentrada = $this->inventario_model->paginarentrada($config['per_page'], $numPag);
        if ($listadoordenentrada) {
            $this->table->set_template($template);
            $this->table->set_heading('Proveedor', 'Producto', 'Fecha Entrada', 'Cantidad Entrada', 'Precio');
            foreach ($listadoordenentrada as $entrada_item) {
                $this->table->add_row(
                        $entrada_item->proveedor, $entrada_item->producto, $entrada_item->fecha, $entrada_item->cantidad, $entrada_item->precio
                );
            }
            $this->jquery_pagination->initialize($config);

            //cargamos la paginación con los links
            $html = $this->table->generate() .
                    $this->jquery_pagination->create_links();
            echo $html;
        } else {
            echo "<div class='flex-center'><p class='lead'>No hay ordenes de entrada</p></div>";
        }
    }
    public function paginaentrada($numPag = 0) {
        if ($this->session->userdata('rol') == NULL || $this->session->userdata('rol') != 1) {
            redirect(base_url() . 'iniciar');
        }
        $buscar_x_campo = $this->input->post('txtbuscar');
        $buscar_y_campo = $this->input->post('filtro');
        $config['base_url'] = base_url('Inventario/paginaentrada/');
        $config['div'] = '#pagina'; //asignamos un id al contenedor general
        $config['anchor_class'] = 'btn btn-dark-green btn-rounded'; //asignamos una clase a los links para maquetar
        $config['show_count'] = FALSE; //en true queremos ver Viendo 1 a 10 de 52
        $config['total_rows'] = $this->inventario_model->cantidad_filasFiltrado($buscar_x_campo, $buscar_y_campo);
        $config['per_page'] = 5; //-->número de productos por página
        $config['num_links'] = 1; //-->número de links visibles
        $config['full_tag_open'] = '<nav aria-label="Page navigation" class="flex-center"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li class="previous">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#" class="btn btn-orange">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_link'] = '« primero';
        $config['last_link'] = '» ùltimo';
        $template = array(
            'table_open' => '<table class="table table-striped table-bordered table-hover">',
            'thead_open' => '<thead >',
            'thead_close' => '</thead>',
            'heading_row_start' => '<tr>',
            'heading_row_end' => '</tr>',
            'heading_cell_start' => '<th>',
            'heading_cell_end' => '</th>',
            'tbody_open' => '<tbody>',
            'tbody_close' => '</tbody>',
            'row_start' => '<tr>',
            'row_end' => '</tr>',
            'cell_start' => '<td>',
            'cell_end' => '</td>',
            'row_alt_start' => '<tr>',
            'row_alt_end' => '</tr>',
            'cell_alt_start' => '<td>',
            'cell_alt_end' => '</td>',
            'table_close' => '</table>'
        );
        $listadoordenentrada = $this->inventario_model->paginarFiltrado($config['per_page'], $numPag, $buscar_x_campo, $buscar_y_campo);
        if ($listadoordenentrada) {
            $this->table->set_template($template);
            $this->table->set_heading('Proveedor', 'Producto', 'Fecha Entrada', 'Cantidad Entrada', 'Precio');
            foreach ($listadoordenentrada as $entrada_item) {
                $this->table->add_row(
                        $entrada_item->proveedor, $entrada_item->producto, $entrada_item->fecha, $entrada_item->cantidad, $entrada_item->precio
                );
            }
            $this->jquery_pagination->initialize($config);
            //cargamos la paginación con los links
            $html = $this->table->generate() .
                   $this->jquery_pagination->create_links();
            echo $html;
        } else {
            echo "<div class='flex-center'><p class='lead'>No hay ordenes de entrada</p></div>";
        }
    }
    public function NuevaOrdenDeEntrada() {

        $data = ['titulo' => "nuevo orden de entrada", 'es_usuario_normal' => FALSE, 'proveedor_select' => $this->Proveedor_model->TraerDatos(),
            'perfil' => $this->usuario_model->consultarPerfil($this->session->userdata('idUsuario'))];
        $this->form_validation->set_rules('txtCodProv', 'Codigo del Proveedor', 'required');
        $this->form_validation->set_rules('txtPreentra', 'Precio entrada', 'required|numeric');
        $this->form_validation->set_rules('txtCantentra', 'cantidad Entrada', 'required|integer');
        $this->form_validation->set_rules('txtProducto', 'nombre Producto', 'required|callback_existir_producto');

// FIN VALIDACION DETALLE
        // asignar mensajes
        // %s es el nombre del campo que ha fallado
        $this->form_validation->set_message('required', 'El campo %s es obligatorio');
        $this->form_validation->set_message('numeric', 'Ingrese numeros en el campo %s ');
        $this->form_validation->set_message('integer', 'Ingrese numeros en el campo %s ');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu', $data);
            $this->load->view('Ordenentrada/ordenentrada', $data);
            $this->load->view('templates/footer');
        } else {
            // defino variables para ingresar los datos
            $codUsuario = $this->session->userdata('idUsuario');
            $codProveedor = $this->input->post('txtCodProv');
            $precioEntrada = $this->input->post('txtPreentra');
            $cantEntrada = $this->input->post('txtCantentra');
            $codProducto = $this->input->post('txtProducto');
            // llamo al metodo para agregar productos y el detalle
            $ingresoNuevaordendeentrada = $this->Ordenentrada_model->registrarordenentrada($codUsuario, $codProveedor, $precioEntrada, $cantEntrada, $codProducto);
            if ($ingresoNuevaordendeentrada) {
                //Sesion de una sola ejecución
                $this->session->set_flashdata('correcto', 'orden entrada registrada correctamente');
            } else {
                $this->session->set_flashdata('incorrecto', 'El orde de entrada no  esta  registrada');
            }
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu', $data);
            $this->load->view('Ordenentrada/ordenentrada', $data);
            $this->load->view('templates/footer');
        }
    }
    public function NuevaOrdenSalida() {
        $data = ['titulo' => "Orden Salida", 'es_usuario_normal' => FALSE,
            'perfil' => $this->usuario_model->consultarPerfil($this->session->userdata('idUsuario'))];
        $this->form_validation->set_rules('txtProducto', 'nombre del producto', 'required|callback_existir_producto');
        $this->form_validation->set_rules('txtPreSalida', 'Precio salida', 'required|numeric');
        $this->form_validation->set_rules('txtCantsalida', 'cantidad salida', 'required|integer');
        $this->form_validation->set_rules('cboMotivo', 'motivo', 'required');
// FIN VALIDACION DETALLE
        // asignar mensajes
        // %s es el nombre del campo que ha fallado
        $this->form_validation->set_message('required', 'El campo %s es obligatorio');
        $this->form_validation->set_message('numeric', 'Ingrese numeros en el campo %s ');
        $this->form_validation->set_message('integer', 'Ingrese numeros en el campo %s ');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu', $data);
            $this->load->view('inventario/NuevaSalida', $data);
            $this->load->view('templates/footer');
        } else {
            // defino variables para ingresar los datos
            $nombreproducto = $this->input->post('txtProducto');
            $precioSalida = $this->input->post('txtPreSalida');
            $cantSalida = $this->input->post('txtCantsalida');
            $motivo = $this->input->post('cboMotivo');
            // llamo al metodo para agregar productos y el detalle
            $ingresoNuevaordendeentrada = $this->inventario_model->registrarOrdenSalida($motivo, $precioSalida, $cantSalida, $nombreproducto);
            if ($ingresoNuevaordendeentrada) {
                //Sesion de una sola ejecución
                $this->session->set_flashdata('correcto', 'se registro orden de salida correctamente');
            } else {
                $this->session->set_flashdata('incorrecto', 'Error en el registro');
            }
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu', $data);
            $this->load->view('inventario/NuevaSalida', $data);
            $this->load->view('templates/footer');
        }
    }
    public function existir_producto() {
        $producto = $this->input->post('txtProducto');
        $comprobar_producto = $this->productos_model->verifica_producto($producto);
        if ($comprobar_producto !== TRUE) {
            $this->form_validation->set_message('existir_producto', 'El producto no existe en el sistema');
            return FALSE;
        } else {
            return TRUE;
        }
    }
}
