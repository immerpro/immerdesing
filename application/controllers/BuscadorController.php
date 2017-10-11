<?php
class BuscadorController extends CI_Controller {
    public function __construct() {
        parent::__construct();
          }
    // metodo que ejecuta la vista principal
    public function index($numPag = 0) {
        if ($this->session->userdata('rol') == NULL) {
            redirect(base_url() . 'iniciar');
        }
            ob_start();
            $this->pagina(0);
            $initial_content = ob_get_contents();
            ob_end_clean();
                $data = array(
            'div1' => " <div id='pagina'>",
            'table' => $initial_content,
            'titulo' => "OrdenSalida",
            'es_usuario_normal' => FALSE,
            'perfil' => $this->usuario_model->consultarPerfil($this->session->userdata('idUsuario'))
        );
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('inventario/OrdenSalida', $data);
        $this->load->view('templates/footer');
    }
// paginacion de la pagina
    public function pagina($numPag = 0) {
        $buscar_x_campo = $this->input->post('txtbuscar');
        $filtro = $this->input->post('ddlfiltro');
        $config['base_url'] = base_url('BuscadorController/pagina/');
        $config['div'] = '#pagina'; //asignamos un id al contenedor general
        $config['anchor_class'] = 'btn btn-dark-green btn-rounded'; //asignamos una clase a los links para maquetar
        $config['show_count'] = FALSE; //en true queremos ver Viendo 1 a 10 de 52
        if ($buscar_x_campo == "") {
            $config['total_rows'] = $this->inventario_model->cantidad_filasSalida();
        } else {
            $config['total_rows'] = $this->inventario_model->cantidad_filasFiltradoSalida($buscar_x_campo, $filtro);
        }
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
        if ($buscar_x_campo == "") {
            $lsalida = $this->inventario_model->paginarSalida($config['per_page'], $numPag);
        } else {
            $lsalida = $this->inventario_model->paginarFiltradoSalida($config['per_page'], $numPag, $buscar_x_campo, $filtro);
        }
        $this->table->set_template($template);
        if ($lsalida) {
            $this->table->set_heading('Nombre Producto', 'Precio', 'Cantidad', 'Motivo','Fecha');
            foreach ($lsalida as $listado) {
                $this->table->add_row(
                        $listado->productoSaliente, 
                        $listado->precioSal, 
                        $listado->cantidadSaliente,
                        $listado->motivoSal,
                        $listado->fechaSal);
            }
            $this->jquery_pagination->initialize($config);
            //cargamos la paginación con los links
            $html = $this->table->generate() .
                    $this->jquery_pagination->create_links();
            echo $html;
                               } else {
            echo "<p class='lead'>No hay orden de salida</p>";
        }
       
    }
}
