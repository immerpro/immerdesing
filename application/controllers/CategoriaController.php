<?php
class CategoriaController extends CI_Controller {
    public function __construct() {
        parent::__construct();
       
    }
    public function index($numPag = 0) {
        if ($this->session->userdata('rol') == NULL || $this->session->userdata('rol') != 1) {
            redirect(base_url() . 'iniciar');
        }
        //CONFIGURACION DE LA PAGINACION 
        //creamos la salida del html a la vista con ob_get_contents
        //que lo que hace es imprimir el html
        $buscarCategoria = $this->input->post('txtbuscar');
        if ($buscarCategoria == "") {
            ob_start();
            $this->pagina(0);
            $initial_content = ob_get_contents();
            ob_end_clean();
        } else {
            ob_start();
            $this->paginacategoria(0);
            $initial_content = ob_get_contents();
            ob_end_clean();
        }
        //asignamos $initial_content al array data para pasarlo a la vista
        //y así poder mostrar tanto los links como la tabla
        // datos para inactivar un producto
//        $idProducto = $this->uri->segment(3);
        $data = array(
            'div1' => " <div id='pagina'>",
            'table' => $initial_content,
            'titulo' => "Categoria",
            'es_usuario_normal' => FALSE,
            'perfil' => $this->usuario_model->consultarPerfil($this->session->userdata('idUsuario'))
        );
        // cargar la vista
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('Categoria/index', $data);
        $this->load->view('templates/footer');
    }
    public function pagina($numPag = 0) {
        $config['base_url'] = base_url('CategoriaController/pagina/');
        $config['div'] = '#pagina'; //asignamos un id al contenedor general
        $config['anchor_class'] = 'btn btn-dark-green btn-rounded'; //asignamos una clase a los links para maquetar
        $config['show_count'] = FALSE; //en true queremos ver Viendo 1 a 10 de 52
        $config['total_rows'] = $this->categoria_model->cantidad_filas();
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
        $listadoCategoria = $this->categoria_model->paginarCategoria($config['per_page'], $numPag);
        if ($listadoCategoria) {
            $this->table->set_template($template);
            $this->table->set_heading('Nombre Categoria', 'Detalles', 'Acciones Subcategoria', 'Acciones Categoria');
            foreach ($listadoCategoria as $categoria_item) {
                $this->table->add_row(
                        $categoria_item->NombreCategoria,
                         $categoria_item->detalles, 
                         'Mira <a class="orange-text" href=' . base_url() . 'CategoriaController/Ver/' . $categoria_item->idCategoria . ' ><i class="fa fa-eye" onmouseover="Subcategoria"></i></a>' .
                        ' Agrega <a class="blue-text"  href=' . base_url() . 'CategoriaController/Agregar/' . $categoria_item->idCategoria . '><i class="fa fa-plus"></i></a>', 'Modificar <a class="teal-text" href=' . base_url() . 'Categoria/editar/' . $categoria_item->idCategoria . '><i class="fa fa-pencil "></i></a>'
                        . nbs(3) . 'Inactivar <a class="red-text" href=' . base_url() . 'CategoriaController/modal/' . $categoria_item->idCategoria . '><i class="fa fa-times" ></i></a>');

            }
            $this->jquery_pagination->initialize($config);
            //cargamos la paginación con los links
            $html = $this->table->generate() .
                    $this->jquery_pagination->create_links();
            echo $html;
        } else {
            echo "<p class='lead'>No hay Categorias creadas</p>";
        }
       
    }

    public function paginacategoria($numPag = 0) {
        $buscar_x_campo = $this->input->post('txtbuscar');
        $config['base_url'] = base_url('CategoriaController/paginacategoria/');
        $config['div'] = '#pagina'; //asignamos un id al contenedor general
        $config['anchor_class'] = 'btn btn-dark-green btn-rounded'; //asignamos una clase a los links para maquetar
        $config['show_count'] = FALSE; //en true queremos ver Viendo 1 a 10 de 52
        $config['total_rows'] = $this->categoria_model->cantidad_filasFiltrado($buscar_x_campo);
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
        $listadoCategoria = $this->categoria_model->paginarCategoriaFiltrado($config['per_page'], $numPag, $buscar_x_campo);
        if ($listadoCategoria) {
            $this->table->set_template($template);
            $this->table->set_heading('Nombre Categoria', 'Detalles', 'Acciones Subcategoria', 'Acciones Categoria');
            foreach ($listadoCategoria as $categoria_item) {
                $this->table->add_row(
                        strip_tags($categoria_item->NombreCategoria), 
                        $categoria_item->detalles,
                        'Mira <a class="orange-text" href=' . base_url() . 'CategoriaController/Ver/' . $categoria_item->idCategoria . ' ><i class="fa fa-eye" onmouseover="Subcategoria"></i></a>' .
                        ' Agrega <a class="blue-text"  href=' . base_url() . 'CategoriaController/Agregar/' . $categoria_item->idCategoria . '><i class="fa fa-plus"></i></a>', 'Modificar <a class="teal-text" href=' . base_url() . 'Categoria/editar/' . $categoria_item->idCategoria . '><i class="fa fa-pencil "></i></a>'
                        . nbs(3) . 'Inactivar <a class="red-text" href=' . base_url() . 'CategoriaController/modal/' . $categoria_item->idCategoria . '><i class="fa fa-times" ></i></a>');
            }
            $this->jquery_pagination->initialize($config);
            //cargamos la paginación con los links
            $html = $this->table->generate() .
                    $this->jquery_pagination->create_links();
            echo $html;
        } else {
            echo "<p class='lead'>No hay Categorias creadas</p>";
        }
      
    }
    // ingresar categorias
    public function InCategoria() {
        if ($this->session->userdata('rol') == NULL || $this->session->userdata('rol') != 1) {
            redirect(base_url() . 'iniciar');
        }
        $data['categorias'] = $this->categoria_model->traerCategorias();
        $data['titulo'] = " crear categoria";
        $data['Mensaje'] = "Categoria creada correctamente";
        $data['es_usuario_normal'] = FALSE;
        $data['perfil'] = $this->usuario_model->consultarPerfil($this->session->userdata('idUsuario'));
        $this->form_validation->set_rules('NombreCategoria', 'NombreCategoria', 'required|htmlentities|is_unique[categoria.NombreCategoria ]');
        $this->form_validation->set_rules('txtdetalle', 'detalle', 'required|trim');
        $this->form_validation->set_message('required', 'El campo %s es obligatorio');
        $this->form_validation->set_message('is_unique', 'El campo %s ya existe');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu', $data);
            $this->load->view('Categoria/INCategoria');
            $this->load->view('templates/footer');
        } else {
            $almacenar = $this->categoria_model->ingressarCategoria();
            if ($almacenar == true) {
                $this->session->set_flashdata('correcto', 'La categoria fue creada correctamente');
            } else {
                $this->session->set_flashdata('incorrecto', 'La categoria no se pudo crear correctamente');
            }
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu', $data);
            $this->load->view('Categoria/INCategoria', $data);
            $this->load->view('templates/footer');
        }
    }
    // ver las subcategorias asociadas a una categoria
    public function ver($id) {
        if ($this->session->userdata('rol') == NULL || $this->session->userdata('rol') != 1) {
            redirect(base_url() . 'iniciar');
        }
        $data['categorias'] = $this->subcategoria_model->Versub($id);
        $data['titulo'] = " ver subcategoria";
        $data['es_usuario_normal'] = FALSE;
        $data['perfil'] = $this->usuario_model->consultarPerfil($this->session->userdata('idUsuario'));
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('Categoria/Ver');
        $this->load->view('templates/footer');
    }
// vista para agregar la subcategoria
    public function Agregar() {
        if ($this->session->userdata('rol') == NULL || $this->session->userdata('rol') != 1) {
            redirect(base_url() . 'iniciar');
        }
        $mostrarNombre = $this->categoria_model->nombrecategoria($this->uri->segment(3));
        foreach ($mostrarNombre->result() as $fila) {
            $nombreCategoria = $fila->NombreCategoria;
        }
        $agr = ['titulo' => 'agregarsubcategoria',
            'codcategoria' => $this->uri->segment(3),
            'nombrecategoria' => $nombreCategoria,
            'es_usuario_normal' => FALSE,
            'perfil' => $this->usuario_model->consultarPerfil($this->session->userdata('idUsuario'))];

        $this->load->view('templates/header', $agr);
        $this->load->view('templates/menu', $agr);
        $this->load->view('SubCategoria/NuevaSubcategoria', $agr);
        $this->load->view('templates/footer');
    }

    public function editar() {
        if ($this->session->userdata('rol') == NULL || $this->session->userdata('rol') != 1) {
            redirect(base_url() . 'iniciar');
        }
        $dato = ['titulo' => " Editar Categoria", 'es_usuario_normal' => FALSE];
        $dato['perfil'] = $this->usuario_model->consultarPerfil($this->session->userdata('idUsuario'));
        $idCategoria = $this->uri->segment(3);
        $obtenerCategoria = $this->categoria_model->obtener_categoria_a_modificar($idCategoria);
        if ($obtenerCategoria != FALSE) {
            foreach ($obtenerCategoria->result() as $fila) {
                $NombreCategoria = $fila->NombreCategoria;
                $detalles = $fila->detalles;
            }
            $data = array(
                'id' => $idCategoria,
                'Nombre' => strip_tags($NombreCategoria),
                'Detalles' => strip_tags($detalles),
            );
        } else {
            $data = '';
            return FALSE;
        }
        $this->load->view('templates/header', $dato);
        $this->load->view('templates/menu', $dato);
        $this->load->view('Categoria/Actualizacategoria', $data);
        $this->load->view('templates/footer');
    }
    public function CategoriaActualizada() {
        if ($this->session->userdata('rol') == NULL || $this->session->userdata('rol') != 1) {
            redirect(base_url() . 'iniciar');
        }
        $id = $this->uri->segment(3);
        $categoria_a_modificar = array(
            'idCategoria' => $id,
            'Nombrecategoria' => strip_tags($this->input->post('NombreCategoria')),
            'detalles' => strip_tags($this->input->post('txtdetalle'))
        );
        $act = $this->categoria_model->Actualizacategoria($id, $categoria_a_modificar);


        if ($act == true) {
            $this->session->set_flashdata('correcto', 'La categoria fue actualizada correctamente');
        } else {
            $this->session->set_flashdata('incorrecto', 'La categoria no se pudo actualizada correctamente');
        }


        redirect('Categoria');
    }
    public function modal() {
        if ($this->session->userdata('rol') == NULL || $this->session->userdata('rol') != 1) {
            redirect(base_url() . 'iniciar');
        }
        $idCategoria = $this->uri->segment(3);
        $mostrarNombre = $this->categoria_model->nombrecategoria($idCategoria);
        foreach ($mostrarNombre->result() as $fila) {
            $nombrecategoria = $fila->NombreCategoria;
        }
        $info_modal = array(
            'id' => $idCategoria,
            'titulo_h1' => "Categoria a inactivar",
            'titulo' => "modal",
            'nombrecat' => $nombrecategoria
        );

        $this->load->view('templates/header', $info_modal);
        $this->load->view('categoria/modal', $info_modal);
    }
// inactiva las categorias
    public function inactivar($id) {
        if ($this->session->userdata('rol') == NULL || $this->session->userdata('rol') != 1) {
            redirect(base_url() . 'iniciar');
        }
        $this->categoria_model->inactivarcategoria($id);
        redirect('categoria');
    }
}
