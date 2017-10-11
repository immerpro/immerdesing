<?php

class Proveedor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Proveedor_model');
    }

    // metodo que ejecuta la vista principal
    public function NuevoProveedor() {
        if ($this->session->userdata('rol') == NULL || $this->session->userdata('rol') != 1) {
            redirect(base_url() . 'iniciar');
        }
        $t = ['titulo' => " Nuevo Porveedor", 'es_usuario_normal' => FALSE, 'perfil' => $this->usuario_model->consultarPerfil($this->session->userdata('idUsuario'))];
//        $data['subcategorias'] = $this->subcategoria_model->obtenerSubCategorias();
        //clase para validar en codeigneiter
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txtNProveedor', 'Nombre', 'required|is_unique[proveedor.NombreProveedor]');
        $this->form_validation->set_rules('txtNit', 'nit', 'required|is_unique[proveedor.nit]');
        $this->form_validation->set_rules('txtcorreo', 'Email', 'required|valid_email|is_unique[proveedor.CorreoElectronicoProveedor]');
        $this->form_validation->set_rules('txtdireccion', 'Direccion', 'required');
        $this->form_validation->set_rules('txtcontacto', 'Contacto', 'required');
        $this->form_validation->set_rules('txttelefono', 'Telefono', 'required|numeric');
        $this->form_validation->set_message('valid_email', 'Ingrese un correo valido');
        $this->form_validation->set_message('is_unique', ' el %s ya existe');
        $this->form_validation->set_message('numeric', 'Los Datos de %s deben ser numericos');
        $this->form_validation->set_message('alpha_numeric', 'El campo %s debe tener letras y numero');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $t);
            $this->load->view('templates/menu', $t);
            $this->load->view('Proveedor/NuevoProveedor');
            $this->load->view('templates/footer');
        } else {
            // llamo al metodo para agregar productos
            $this->load->helper('url');
            // ingresamos los datos
            $data = array(
                'TelefonoProveedor' => $this->input->post('txttelefono'),
                'NombreProveedor' => $this->input->post('txtNProveedor'),
                'NombreContacto' => $this->input->post('txtcontacto'),
                'DireccionProveedor' => $this->input->post('txtdireccion'),
                'CorreoElectronicoProveedor' => $this->input->post('txtcorreo'),
                'nit' => $this->input->post('txtNit'),
                'Estados_idEstados' => 1,
            );
            $registro = $this->Proveedor_model->RegistrarProveedor($data);

            if ($registro) {
                //Sesion de una sola ejecución
                $this->session->set_flashdata('correcto', ' creado correctamente');
            } else {
                $this->session->set_flashdata('incorrecto', ' se produjo un error al registrar ');
            }
            // cargar la vista
            $this->load->view('templates/header', $t);
            $this->load->view('templates/menu', $t);
            $this->load->view('Proveedor/NuevoProveedor');
            $this->load->view('templates/footer');
        }
    }

    public function index($numPag = 0) {
        $buscarProveedor = $this->input->post('txtbuscar');

        if ($buscarProveedor == "") {
            ob_start();
            $this->pagina(0);
            $initial_content = ob_get_contents();
            ob_end_clean();
        } else {
            ob_start();
            $this->paginaProveedor(0);
            $initial_content = ob_get_contents();
            ob_end_clean();
        }

        $info = array(
            'titulo' => "Consultar Proveedor",
            'es_usuario_normal' => FALSE,
            'div1' => " <div id='pagina'>",
            'table' => $initial_content,
            'perfil' => $this->usuario_model->consultarPerfil($this->session->userdata('idUsuario'))
        );
        $this->load->view('templates/header', $info);
        $this->load->view('templates/menu', $info);
        $this->load->view('Proveedor/ConsultarProveedor', $info);
        $this->load->view('templates/footer');
    }

    public function pagina($numPag = 0) {
        $config['base_url'] = base_url('Proveedor/pagina/');
        $config['div'] = '#pagina'; //asignamos un id al contenedor general
        $config['anchor_class'] = 'btn btn-dark-green btn-rounded'; //asignamos una clase a los links para maquetar
        $config['show_count'] = FALSE; //en true queremos ver Viendo 1 a 10 de 52
        $config['total_rows'] = $this->Proveedor_model->cantidad_filas();
        $config['per_page'] = 5; //-->número de productos por página
        $config['num_links'] = 1; //-->número de links visibles
        $config['first_link'] = '&lsaquo; Primera'; //->configuramos
        $config['last_link'] = 'Última &rsaquo;'; //--->y siguiente
        $config['full_tag_open'] = '<nav aria-label="Page navigation" class="flex-center"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
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
        //$proveedor
        $proveedor = $this->Proveedor_model->paginarProveedor($config['per_page'], $numPag);
        if ($proveedor) {
            $this->table->set_template($template);
            $this->table->set_heading('Nit', 'Proveedor', 'Telefono', 'Direcciòn ', 'Correo electronico ', 'Persona de contacto', 'Acciones');
            foreach ($proveedor as $proveedor_item) {
                $this->table->add_row(
                        $proveedor_item['nit'], $proveedor_item['NombreProveedor'], $proveedor_item['TelefonoProveedor'], $proveedor_item['DireccionProveedor'], $proveedor_item['CorreoElectronicoProveedor'], $proveedor_item['NombreContacto'], 'Modificar <a class="teal-text" href=' . base_url() . 'proveedor/EditarProveedor/' . $proveedor_item['idProveedor'] . '><i class="fa fa-pencil "></i></a>'
                        . nbs(3) . 'Inactivar <a class="red-text" href=' . base_url() . 'Proveedor/modal/' . $proveedor_item['idProveedor'] . '><i class="fa fa-times" ></i></a>');
            }

            $this->jquery_pagination->initialize($config);

            //cargamos la paginación con los links
            $html = $this->table->generate() .
                    $this->jquery_pagination->create_links();

            echo $html;
        } else {
            echo "<div class='flex-center'><p class='lead'>No hay Proveedores </p></div>";
        }
    }

    public function paginaProveedor($numPag = 0) {
        $buscar_x_campo = $this->input->post('txtbuscar');
        $filtro = $this->input->post('ddlfiltro');
        $config['base_url'] = base_url('Proveedor/paginaProveedor/');
        $config['div'] = '#pagina'; //asignamos un id al contenedor general
        $config['anchor_class'] = 'btn btn-dark-green btn-rounded'; //asignamos una clase a los links para maquetar
        $config['show_count'] = FALSE; //en true queremos ver Viendo 1 a 10 de 52
        $config['total_rows'] = $this->Proveedor_model->cantidad_filasFiltrado($buscar_x_campo, $filtro);
        $config['per_page'] = 5; //-->número de por página
        $config['num_links'] = 2; //-->número de links visibles
        $config['first_link'] = '&lsaquo; Primera'; //->configuramos
        $config['last_link'] = 'Última &rsaquo;'; //--->y siguiente
        $config['full_tag_open'] = '<nav aria-label="Page navigation" class="flex-center"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
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
        $proveedor = $this->Proveedor_model->paginarProveedorFiltrado($config['per_page'], $numPag, $buscar_x_campo, $filtro);
        if ($proveedor) {
            $this->table->set_template($template);
            $this->table->set_heading('Nit', 'Proveedor', 'Telefono', 'Direcciòn ', 'Correo electronico ', 'Persona de contacto', 'Acciones');
            foreach ($proveedor as $proveedor_item) {
                $this->table->add_row(
                        $proveedor_item['nit'], $proveedor_item['NombreProveedor'], $proveedor_item['TelefonoProveedor'], $proveedor_item['DireccionProveedor'], $proveedor_item['CorreoElectronicoProveedor'], $proveedor_item['NombreContacto'], 'Modificar <a class="teal-text" href=' . base_url() . 'proveedor/EditarProveedor/' . $proveedor_item['idProveedor'] . '><i class="fa fa-pencil "></i></a>'
                        . nbs(3) . 'Inactivar <a class="red-text" href=' . base_url() . 'Proveedor/modal/' . $proveedor_item['idProveedor'] . '><i class="fa fa-times" ></i></a>');
            }
            $this->jquery_pagination->initialize($config);

            //cargamos la paginación con los links
            $html = $this->table->generate() .
                    $this->jquery_pagination->create_links();

            echo $html;
        } else {
            echo "<div class='flex-center'><p class='lead'>No hay Proveedor</p>";
        }
    }

    public function editarproveedor() {
        $dato = ['titulo' => " Editar Proveedor", 'es_usuario_normal' => FALSE,  'perfil' => $this->usuario_model->consultarPerfil($this->session->userdata('idUsuario'))];
        $idProveedor = $this->uri->segment(3);
        $obtenerProveedor = $this->Proveedor_model->Proveedor_Modificar($idProveedor);

        // cargar el helper de manejo de formularios
        $this->load->helper('form');
        // cargar libreria para validar formularios

        if ($obtenerProveedor != FALSE) {
            foreach ($obtenerProveedor->result() as $fila) {

                $nit = $fila->nit;
                $NombreProveedor = $fila->NombreProveedor;
                $TelefonoProveedor = $fila->TelefonoProveedor;
                $DireccionProveedor = $fila->DireccionProveedor;
                $CorreoElectronicoProveedor = $fila->CorreoElectronicoProveedor;
                $NombreContacto = $fila->NombreContacto;
            }
            $data = array(
                'id' => $idProveedor,
                'nitp' => $nit,
                'NombrePr' => $NombreProveedor,
                'telefono' => $TelefonoProveedor,
                'direccion' => $DireccionProveedor,
                'correo' => $CorreoElectronicoProveedor,
                'nombrecotacto' => $NombreContacto,
            );
        } else {
            $data = '';
            return FALSE;
        }
        $this->load->view('templates/header', $dato);
        $this->load->view('templates/menu', $dato);
        $this->load->view('Proveedor/EditarProveedor', $data);
        $this->load->view('templates/footer');
    }

    // metodo para actualizar un producto
    public function ProveedorActualizado() {
        $id = $this->uri->segment(3);
        $proveedorActualizar = array(
            'nit' => $this->input->post('txtNit'),
            'NombreProveedor' => $this->input->post('txtNProveedor'),
            'TelefonoProveedor' => $this->input->post('txttelefono'),
            'DireccionProveedor' => $this->input->post('txtdireccion'),
            'CorreoElectronicoProveedor' => $this->input->post('txtcorreo'),
            'NombreContacto' => $this->input->post('txtcontacto'),
        );
        $this->Proveedor_model->EditarProveedor($id, $proveedorActualizar);
        redirect('proveedor');
    }

    public function modal() {
        $idProveedor = $this->uri->segment(3);
        $mostrarNombre = $this->Proveedor_model->obtener_nombre_proveedor($idProveedor);

        $info_modal = array(
            'id' => $idProveedor,
            'titulo_h1' => "Proveedor a inactivar",
            'titulo' => "modal",
            'nombrePro' => $mostrarNombre
        );

        $this->load->view('templates/header', $info_modal);
        $this->load->view('Proveedor/modal', $info_modal);
     
    }

    public function inactivar($id) {

        $inactivoProveedor = $this->Proveedor_model->inactivarProveedor($id);
        if ($inactivoProveedor) {
            echo "<script type='text/javascript'>"
            . "alert('Proveedor inactivado correctamente ');"
            . "location.href ='" . base_url() . "proveedor';"
            . "</script>";
        }
    }

}
