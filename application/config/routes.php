<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	https://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There are three reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router which controller/method to use if those
  | provided in the URL cannot be matched to a valid route.
  |
  |	$route['translate_uri_dashes'] = FALSE;
  |
  | This is not exactly a route, but allows you to automatically route
  | controller and method names that contain dashes. '-' isn't a valid
  | class or method name character, so it requires translation.
  | When you set this option to TRUE, it will replace ALL dashes in the
  | controller and method URI segments.
  |
  | Examples:	my-controller/index	-> my_controller/index
  |		my-controller/my-method	-> my_controller/my_method
 */

// rutas asociadas al usuario 
$route['bienvenido'] = 'UsuarioController/index';
$route['iniciar'] = 'UsuarioController/Login';
$route['ingresar'] = 'UsuarioController/ingresoUsuario';
$route['registro'] = 'UsuarioController/RegistroUsuario';
$route['salir'] = 'UsuarioController/cerrarsesion';
$route['recupera'] = 'UsuarioController/recuperaClave';
$route['olvido'] = 'UsuarioController/olvidarClave';
$route['recupera'] = 'UsuarioController/recuperaClaveUsuario';

$route['contacto'] = 'UsuarioController/contactar';
// ruta asociada colaborador
$route['colaborador'] = 'ColaboradorController/index';
$route['perfilcolabora'] = 'ColaboradorController/mostrarPerfilColaborador';
$route['actualizarColaborador'] = 'ColaboradorController/actualizarPerfilCola';
// ruta asociada administrador
$route['admin'] = 'AdminController/index';
$route['perfiladmin'] = 'AdminController/mostrarPerfilAdmin';
$route['habilita'] = 'AdminController/habilitarColaboradores';
$route['authCol'] = 'AdminController/colaboradorAutorizado';
$route['AtualizarPerfil'] = 'AdminController/actualizarPerfilAdmin';
//fin rutas usuario
// rutas para el producto
$route['producto'] = 'ProductoController/index';
$route['buscador'] = 'BuscadorController/index';
$route['nuevoProducto'] = 'ProductoController/nuevoProducto';
$route['editaProducto/'] = 'ProductoController/editar/';
$route['inactivo/(:num)'] = 'ProductoController/modal/$1';
$route['pagina(:num)'] = 'ProductoController/pagina/$1';
//fin rutas producto
$route['subcategoria/crear'] = 'subcategoria/SubInCategoria';
$route['categoria/crear'] = 'CategoriaController/InCategoria';
$route['productos/(:any)'] = 'productos/view/$1';
$route['default_controller'] = 'UsuarioController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// rutas inventarios
$route['salida'] = 'Inventario/OrdenSalida';
$route['nuevaSalida'] = 'Inventario/CrearSalida';
$route['ingresosalida'] = 'Inventario/NuevaOrdenSalida';
$route['notificacion'] = 'Inventario/mostrarNotificacionView';
$route['nuevaEntrada'] = 'Inventario/verEntrada';
$route['recuperadato'] = 'Reestablecer/index';
// ENTRADA
$route['Entrada'] = 'Inventario/ordenentrada';
$route['Consultar'] = 'Inventario/consultarordenentrada';
$route['IngreseEntrada'] = 'Inventario/NuevaOrdenDeEntrada';
// REPORTE DE INVENTARIOS 
$route['reporte'] = 'ReporteController/index';
$route['migracion'] = 'MigracionController/index';
$route['db'] = 'MigracionController/crearbd';
// ruta  categoria
$route['categoria'] = 'CategoriaController/index';



