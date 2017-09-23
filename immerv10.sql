-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-09-2017 a las 18:48:44
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `immerv10`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPIngresoDetalProducto` (IN `descrip` VARCHAR(300), IN `prod` VARCHAR(50), IN `cbarras` VARCHAR(13), IN `minStock` INT, IN `maxStock` INT, IN `exist` INT, IN `codSubcategoria` INT, IN `cantPro` INT, IN `lote` VARCHAR(45), IN `fechavenc` DATE)  BEGIN
  INSERT INTO producto(
    DescripcionProducto,
    NombreProducto,
    CodigoDeBarras,
    minimoStock,
    MaximoStock,
    Existencias,
    Subcategoria_idSubcategoria,
    Estados_idEstados)
    VALUES(
  descrip,
  prod,
  cbarras,
    minStock,
    maxStock,
    exist,
    codSubcategoria,
    1
        );
  INSERT INTO detalleproducto(
    CantidadProducto,
    lote,
    Producto_idProducto,  
    fechavenc,
    diaVencimiento
    )
    VALUES(
    cantPro,
    lote,
    (SELECT MAX(idProducto) FROM producto),
    fechavenc,
    DATEDIFF(fechavenc,CURDATE())
  );
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPObtenerCategoriaXSubcategoria` ()  BEGIN
SELECT DISTINCT c.idCategoria as codCategoria,c.NombreCategoria as categoria  FROM categoria c 
INNER JOIN subcategoria s ON c.idCategoria=s.Categoria_idCategoria;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPObtenerNombreCategoria` (IN `codSubcategoria` INT)  BEGIN
SELECT c.NombreCategoria as categoriaN FROM categoria c 
WHERE c.idCategoria = (SELECT s.Categoria_idCategoria FROM subcategoria s WHERE s.idSubcategoria=codSubcategoria);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPRegistrarOrdenSalida` (IN `motivo` VARCHAR(20), IN `Precio` FLOAT, IN `Cantidad` INT, IN `nombre` VARCHAR(50))  BEGIN
  insert INTO ordensalida(FechaDeSalida,motivoSalida) VALUES(CURDATE(),motivo);
  INSERT INTO detallesalida(PrecioOrdenSalida,CantidadOrdenSalida,DetalleProducto_idDetalleProducto,OrdenSalida_idOrdenSalida)
  VALUES(Precio,Cantidad,(SELECT det.idDetalleProducto FROM producto P INNER JOIN detalleproducto det ON P.idProducto=det.Producto_idProducto WHERE P.NombreProducto=nombre),
  (SELECT MAX(sal.idOrdenSalida) FROM ordensalida sal));
  
  UPDATE producto SET Existencias=(Existencias-Cantidad) WHERE NombreProducto = nombre;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPRegistroOrdenEntrada` (IN `codUsuario` INT, IN `codProveedor` INT, IN `precioEntrada` FLOAT, IN `cantEntrada` INT, IN `nombre` VARCHAR(50))  BEGIN
INSERT INTO ordenentrada(FechaEntrada,Usuario_idUsuario,Proveedor_idProveedor)VALUES(CURDATE(),codUsuario,codProveedor);
INSERT INTO detalleentrada(PrecioOrdenEntrada,CantidadOrdenEntrada,Producto_idProducto,OrdenEntrada_idOrdenEntrada)
VALUES(precioEntrada,cantEntrada,(select po.idProducto from producto po where po.NombreProducto=nombre),(select MAX(idOrdenEntrada) from ordenentrada ));
 UPDATE producto SET Existencias=Existencias+cantEntrada WHERE NombreProducto=nombre;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SPTraerRol` (IN `codrol` INT)  BEGIN
select distinct tipoRol from rolusuario r INNER JOIN usuario u on r.idRolUsuario=u.RolUsuario_idRolUsuario 
  where u.RolUsuario_idRolUsuario=codrol;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `NombreCategoria` varchar(45) NOT NULL,
  `detalles` varchar(300) NOT NULL,
  `Estado_estadoId` int(11) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=963 DEFAULT CHARSET=latin1 COMMENT='categoria de productos';

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `NombreCategoria`, `detalles`, `Estado_estadoId`) VALUES
(1, 'chocolateria', 'producto chocolate', 1),
(2, 'hogar', 'producto canasta familiar', 1),
(3, 'panaderia', 'productos fabricados a partir de pan', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleentrada`
--

CREATE TABLE `detalleentrada` (
  `idEntrada` int(11) NOT NULL,
  `PrecioOrdenEntrada` float NOT NULL,
  `CantidadOrdenEntrada` int(11) NOT NULL,
  `Producto_idProducto` int(11) NOT NULL,
  `OrdenEntrada_idOrdenEntrada` int(11) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=1638 DEFAULT CHARSET=latin1 COMMENT='detalle de orden de entrada';

--
-- Volcado de datos para la tabla `detalleentrada`
--

INSERT INTO `detalleentrada` (`idEntrada`, `PrecioOrdenEntrada`, `CantidadOrdenEntrada`, `Producto_idProducto`, `OrdenEntrada_idOrdenEntrada`) VALUES
(1, 700, 15, 4, 1),
(2, 1200, 5, 2, 2),
(3, 2100, 5, 2, 3),
(4, 2100, 3, 1, 4),
(5, 1600, 4, 2, 5),
(6, 1600, 4, 2, 6),
(7, 2000, 8, 1, 7),
(8, 23223, 20, 4, 8),
(9, 2000, 20, 4, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleproducto`
--

CREATE TABLE `detalleproducto` (
  `idDetalleProducto` int(11) NOT NULL COMMENT 'codigo del detalle',
  `CantidadProducto` int(11) NOT NULL COMMENT 'cantidad del producto',
  `lote` varchar(45) DEFAULT NULL COMMENT 'numero del lote',
  `Producto_idProducto` int(11) NOT NULL COMMENT 'codigo del producto',
  `fechavenc` date NOT NULL COMMENT 'fecha de vencimiento',
  `diaVencimiento` int(10) DEFAULT NULL COMMENT 'dias para vencerse el producto'
) ENGINE=InnoDB AVG_ROW_LENGTH=481 DEFAULT CHARSET=latin1 COMMENT='detalle del producto';

--
-- Volcado de datos para la tabla `detalleproducto`
--

INSERT INTO `detalleproducto` (`idDetalleProducto`, `CantidadProducto`, `lote`, `Producto_idProducto`, `fechavenc`, `diaVencimiento`) VALUES
(1, 89, '962', 1, '2017-09-16', 2),
(2, 89, '002220', 2, '2017-09-17', 3),
(3, 89, '002220', 3, '2019-01-19', 492),
(4, 95, '080617', 4, '2018-08-08', 328);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallesalida`
--

CREATE TABLE `detallesalida` (
  `idSalida` int(11) NOT NULL,
  `PrecioOrdenSalida` float NOT NULL,
  `CantidadOrdenSalida` int(11) NOT NULL,
  `DetalleProducto_idDetalleProducto` int(11) NOT NULL,
  `OrdenSalida_idOrdenSalida` int(11) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=2730 DEFAULT CHARSET=latin1 COMMENT='detalle de la orden de salida';

--
-- Volcado de datos para la tabla `detallesalida`
--

INSERT INTO `detallesalida` (`idSalida`, `PrecioOrdenSalida`, `CantidadOrdenSalida`, `DetalleProducto_idDetalleProducto`, `OrdenSalida_idOrdenSalida`) VALUES
(1, 1000, 12, 2, 1),
(2, 1200, 10, 1, 2),
(3, 2000, 5, 2, 3),
(4, 2300, 16, 4, 4),
(5, 2000, 19, 4, 5);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `entradaview`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `entradaview` (
`producto` varchar(50)
,`proveedor` varchar(45)
,`fecha` date
,`cantidad` int(11)
,`precio` float
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenentrada`
--

CREATE TABLE `ordenentrada` (
  `idOrdenEntrada` int(11) NOT NULL,
  `FechaEntrada` date NOT NULL,
  `Usuario_idUsuario` int(11) NOT NULL,
  `Proveedor_idProveedor` int(11) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=1638 DEFAULT CHARSET=latin1 COMMENT='recepcion de los productos del minimercado ';

--
-- Volcado de datos para la tabla `ordenentrada`
--

INSERT INTO `ordenentrada` (`idOrdenEntrada`, `FechaEntrada`, `Usuario_idUsuario`, `Proveedor_idProveedor`) VALUES
(1, '2017-09-14', 1, 1),
(2, '2017-09-15', 1, 2),
(3, '2017-09-15', 1, 2),
(4, '2017-09-15', 1, 1),
(5, '2017-09-15', 1, 2),
(6, '2017-09-15', 1, 2),
(7, '2017-09-16', 1, 2),
(8, '2017-09-18', 5, 2),
(9, '2017-09-18', 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordensalida`
--

CREATE TABLE `ordensalida` (
  `idOrdenSalida` int(11) NOT NULL,
  `FechaDeSalida` date NOT NULL,
  `motivoSalida` varchar(20) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=2340 DEFAULT CHARSET=latin1 COMMENT='despacho de productos ';

--
-- Volcado de datos para la tabla `ordensalida`
--

INSERT INTO `ordensalida` (`idOrdenSalida`, `FechaDeSalida`, `motivoSalida`) VALUES
(1, '2017-09-14', 'venta'),
(2, '2017-09-15', 'devolucion'),
(3, '2017-09-16', 'devolucion'),
(4, '2017-09-16', 'merma'),
(5, '2017-09-18', 'merma');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idProducto` int(11) NOT NULL,
  `DescripcionProducto` varchar(300) DEFAULT NULL,
  `NombreProducto` varchar(50) NOT NULL,
  `CodigoDeBarras` varchar(13) NOT NULL,
  `minimoStock` int(11) NOT NULL,
  `MaximoStock` int(11) NOT NULL,
  `Existencias` int(11) NOT NULL,
  `Subcategoria_idSubcategoria` int(11) NOT NULL,
  `Estados_idEstados` int(11) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=327 DEFAULT CHARSET=latin1 COMMENT='productos del minimercado';

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `DescripcionProducto`, `NombreProducto`, `CodigoDeBarras`, `minimoStock`, `MaximoStock`, `Existencias`, `Subcategoria_idSubcategoria`, `Estados_idEstados`) VALUES
(1, 'wafer chocolate', 'mega', '8690562009614', 12, 89, 89, 1, 1),
(2, '750 gr', 'comapan', '7702432000506', 12, 89, 11, 5, 1),
(3, 'contenido neto 1000 gramos', 'doria spaguetti', '7702085019023', 12, 89, 85, 6, 1),
(4, 'contenido 500gr', 'maiz pira', '7708227055508', 15, 100, 120, 4, 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `productosview`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `productosview` (
`codProducto` int(11)
,`producto` varchar(50)
,`existencia` int(11)
,`estado` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `productovendido_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `productovendido_view` (
`CodigoProducto` int(11)
,`productoVendido` varchar(50)
,`Existencia` int(11)
,`estadoProducto` int(11)
,`cantidadSalida` int(11)
,`ExistenciasRestantes` bigint(12)
,`Motivo` varchar(20)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idProveedor` int(11) NOT NULL,
  `TelefonoProveedor` int(11) NOT NULL,
  `NombreProveedor` varchar(45) NOT NULL,
  `NombreContacto` varchar(45) NOT NULL,
  `DireccionProveedor` varchar(45) NOT NULL,
  `CorreoElectronicoProveedor` varchar(45) NOT NULL,
  `nit` varchar(20) NOT NULL,
  `Estados_idEstados` int(11) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=5461 DEFAULT CHARSET=latin1 COMMENT='empresa o personas que se encargan de comercializar y vender los productos ';

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idProveedor`, `TelefonoProveedor`, `NombreProveedor`, `NombreContacto`, `DireccionProveedor`, `CorreoElectronicoProveedor`, `nit`, `Estados_idEstados`) VALUES
(1, 2147483647, 'GRANOS  Y ALIMENTOS DE COLOMBIA SAS', 'miguel martinez', 'av circunvalar calle 100 no 6q-522', 'mmartinez@granosdecolombia.com', '700500289', 1),
(2, 2686819, 'comapan s.a', 'Daniela Lopez', 'crr 42b no 14-25', 'dlopez@comapan.com.co', '1100383', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rolusuario`
--

CREATE TABLE `rolusuario` (
  `idRolUsuario` int(11) NOT NULL,
  `tipoRol` varchar(45) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=8192 DEFAULT CHARSET=latin1 COMMENT='diferentes cargos que tiene un usuario en la aplicacion';

--
-- Volcado de datos para la tabla `rolusuario`
--

INSERT INTO `rolusuario` (`idRolUsuario`, `tipoRol`) VALUES
(1, 'administrador'),
(2, 'colaborador');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `salidaview`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `salidaview` (
`productoSaliente` varchar(50)
,`fechaSal` date
,`motivoSal` varchar(20)
,`precioSal` float
,`cantidadSaliente` int(11)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategoria`
--

CREATE TABLE `subcategoria` (
  `idSubcategoria` int(11) NOT NULL,
  `NombreSubcategoria` varchar(45) DEFAULT NULL,
  `detallesSub` varchar(300) NOT NULL,
  `Categoria_idCategoria` int(11) NOT NULL,
  `Estado_estadoId` int(11) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=1489 DEFAULT CHARSET=latin1 COMMENT='subcategoria de productos asociadas a una categoria';

--
-- Volcado de datos para la tabla `subcategoria`
--

INSERT INTO `subcategoria` (`idSubcategoria`, `NombreSubcategoria`, `detallesSub`, `Categoria_idCategoria`, `Estado_estadoId`) VALUES
(1, 'wafer', 'galleta cubierta de chocolate', 1, 1),
(2, 'chocolatina', 'chocolate en barra', 1, 1),
(3, 'grano', 'productos en forma granulada', 2, 1),
(4, 'untar', 'productos acompañantes', 2, 1),
(5, 'pan blanco', 'extra grande', 3, 1),
(6, 'harina', 'productos hechos con harina', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `ClaveUsuario` varchar(100) NOT NULL,
  `NombreUsuario` varchar(45) NOT NULL,
  `RolUsuario_idRolUsuario` int(11) NOT NULL,
  `nombreCompleto` varchar(100) NOT NULL,
  `email` varchar(80) NOT NULL,
  `Estado_EstadoId` int(11) DEFAULT NULL,
  `token` varchar(60) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `request_token` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=1820 DEFAULT CHARSET=latin1 COMMENT='usuarios de la aplicaciòn';

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `ClaveUsuario`, `NombreUsuario`, `RolUsuario_idRolUsuario`, `nombreCompleto`, `email`, `Estado_EstadoId`, `token`, `created_at`, `request_token`) VALUES
(1, 'fc00ee00c8f8ab83f841af6678733e618b3ea9ee', 'edeveloper', 1, 'Edgar Duarte', 'edgarduarte18@misena.edu.co', 1, NULL, '2017-09-06 06:05:31', NULL),
(4, '29b418fdb7f087a581c5c87e40a24226639e56db', 'andrey11', 2, 'andrey ramirez', 'asramirez10@misena.edu.co', 1, '1a67a647ea01c5d1ace5ab679a0c899d61e38ed1', '2017-09-16 23:00:20', '2017-09-17 06:13:57'),
(5, 'fc00ee00c8f8ab83f841af6678733e618b3ea9ee', 'immer', 1, 'immerpro ', 'proyecto.medd@gmail.com', 1, '3804e6bf8f180a7de2a068133e19c0b083a1dc28', '2017-09-16 23:20:00', '2017-09-18 12:30:42'),
(6, '7c222fb2927d828af22f592134e8932480637c0d', 'andrey11', 2, 'andrey ramirez', 'asramirez1@misena.edu.co', 1, '611b1ebfd98bab70a34b786cab69d249a23be852', '2017-09-18 12:54:35', NULL);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vencidosview`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vencidosview` (
`producto` varchar(50)
,`fvencimiento` date
,`dvencimiento` int(7)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `entradaview`
--
DROP TABLE IF EXISTS `entradaview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `entradaview`  AS  select `p`.`NombreProducto` AS `producto`,`prov`.`NombreProveedor` AS `proveedor`,`oe`.`FechaEntrada` AS `fecha`,`de`.`CantidadOrdenEntrada` AS `cantidad`,`de`.`PrecioOrdenEntrada` AS `precio` from (((`ordenentrada` `oe` join `detalleentrada` `de` on((`oe`.`idOrdenEntrada` = `de`.`OrdenEntrada_idOrdenEntrada`))) join `producto` `p` on((`p`.`idProducto` = `de`.`Producto_idProducto`))) join `proveedor` `prov` on((`prov`.`idProveedor` = `oe`.`Proveedor_idProveedor`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `productosview`
--
DROP TABLE IF EXISTS `productosview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `productosview`  AS  select `p`.`idProducto` AS `codProducto`,`p`.`NombreProducto` AS `producto`,`p`.`Existencias` AS `existencia`,`p`.`Estados_idEstados` AS `estado` from `producto` `p` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `productovendido_view`
--
DROP TABLE IF EXISTS `productovendido_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `productovendido_view`  AS  select `p`.`idProducto` AS `CodigoProducto`,`p`.`NombreProducto` AS `productoVendido`,`p`.`Existencias` AS `Existencia`,`p`.`Estados_idEstados` AS `estadoProducto`,`ds`.`CantidadOrdenSalida` AS `cantidadSalida`,(`p`.`Existencias` - `ds`.`CantidadOrdenSalida`) AS `ExistenciasRestantes`,`os`.`motivoSalida` AS `Motivo` from (((`producto` `p` join `detalleproducto` `det` on((`det`.`Producto_idProducto` = `p`.`idProducto`))) join `detallesalida` `ds` on((`ds`.`DetalleProducto_idDetalleProducto` = `det`.`idDetalleProducto`))) join `ordensalida` `os` on((`os`.`idOrdenSalida` = `ds`.`OrdenSalida_idOrdenSalida`))) where (`os`.`motivoSalida` = 'venta') ;

-- --------------------------------------------------------

--
-- Estructura para la vista `salidaview`
--
DROP TABLE IF EXISTS `salidaview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `salidaview`  AS  select `p`.`NombreProducto` AS `productoSaliente`,`sal`.`FechaDeSalida` AS `fechaSal`,`sal`.`motivoSalida` AS `motivoSal`,`desal`.`PrecioOrdenSalida` AS `precioSal`,`desal`.`CantidadOrdenSalida` AS `cantidadSaliente` from (((`ordensalida` `sal` join `detallesalida` `desal` on((`sal`.`idOrdenSalida` = `desal`.`OrdenSalida_idOrdenSalida`))) join `detalleproducto` `dpro` on((`dpro`.`idDetalleProducto` = `desal`.`DetalleProducto_idDetalleProducto`))) join `producto` `p` on((`p`.`idProducto` = `dpro`.`Producto_idProducto`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vencidosview`
--
DROP TABLE IF EXISTS `vencidosview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vencidosview`  AS  select `p`.`NombreProducto` AS `producto`,`detal`.`fechavenc` AS `fvencimiento`,(to_days(`detal`.`fechavenc`) - to_days(curdate())) AS `dvencimiento` from (`producto` `p` join `detalleproducto` `detal` on((`p`.`idProducto` = `detal`.`Producto_idProducto`))) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `detalleentrada`
--
ALTER TABLE `detalleentrada`
  ADD PRIMARY KEY (`idEntrada`),
  ADD KEY `fk_ProductoOrdenEntrada_OrdenEntrada1` (`OrdenEntrada_idOrdenEntrada`),
  ADD KEY `fk_ProductoOrdenEntrada_Producto1` (`Producto_idProducto`);

--
-- Indices de la tabla `detalleproducto`
--
ALTER TABLE `detalleproducto`
  ADD PRIMARY KEY (`idDetalleProducto`),
  ADD KEY `fk_DetalleProducto_Produ` (`Producto_idProducto`);

--
-- Indices de la tabla `detallesalida`
--
ALTER TABLE `detallesalida`
  ADD PRIMARY KEY (`idSalida`),
  ADD KEY `fk_DetalleDeProductoOrdenSalida_DetalleProducto1` (`DetalleProducto_idDetalleProducto`),
  ADD KEY `fk_DetalleDeProductoOrdenSalida_OrdenSalida1` (`OrdenSalida_idOrdenSalida`);

--
-- Indices de la tabla `ordenentrada`
--
ALTER TABLE `ordenentrada`
  ADD PRIMARY KEY (`idOrdenEntrada`),
  ADD KEY `fk_OrdenEntrada_Proveedor1` (`Proveedor_idProveedor`),
  ADD KEY `fk_OrdenEntrada_Usuario1` (`Usuario_idUsuario`);

--
-- Indices de la tabla `ordensalida`
--
ALTER TABLE `ordensalida`
  ADD PRIMARY KEY (`idOrdenSalida`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idProducto`),
  ADD KEY `fk_Producto_Subcategoria1` (`Subcategoria_idSubcategoria`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idProveedor`),
  ADD KEY `fk_Proveedor_Estados1` (`Estados_idEstados`);

--
-- Indices de la tabla `rolusuario`
--
ALTER TABLE `rolusuario`
  ADD PRIMARY KEY (`idRolUsuario`);

--
-- Indices de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD PRIMARY KEY (`idSubcategoria`),
  ADD KEY `fk_Subcategoria_Categoria` (`Categoria_idCategoria`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `fk_Usuario_RolUsuario1` (`RolUsuario_idRolUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `detalleentrada`
--
ALTER TABLE `detalleentrada`
  MODIFY `idEntrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `detalleproducto`
--
ALTER TABLE `detalleproducto`
  MODIFY `idDetalleProducto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'codigo del detalle', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `detallesalida`
--
ALTER TABLE `detallesalida`
  MODIFY `idSalida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `ordenentrada`
--
ALTER TABLE `ordenentrada`
  MODIFY `idOrdenEntrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `ordensalida`
--
ALTER TABLE `ordensalida`
  MODIFY `idOrdenSalida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `rolusuario`
--
ALTER TABLE `rolusuario`
  MODIFY `idRolUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  MODIFY `idSubcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalleentrada`
--
ALTER TABLE `detalleentrada`
  ADD CONSTRAINT `fk_ProductoOrdenEntrada_OrdenEntrada1` FOREIGN KEY (`OrdenEntrada_idOrdenEntrada`) REFERENCES `ordenentrada` (`idOrdenEntrada`),
  ADD CONSTRAINT `fk_ProductoOrdenEntrada_Producto1` FOREIGN KEY (`Producto_idProducto`) REFERENCES `producto` (`idProducto`);

--
-- Filtros para la tabla `detalleproducto`
--
ALTER TABLE `detalleproducto`
  ADD CONSTRAINT `fk_DetalleProducto_Produ` FOREIGN KEY (`Producto_idProducto`) REFERENCES `producto` (`idProducto`);

--
-- Filtros para la tabla `detallesalida`
--
ALTER TABLE `detallesalida`
  ADD CONSTRAINT `fk_DetalleDeProductoOrdenSalida_DetalleProducto1` FOREIGN KEY (`DetalleProducto_idDetalleProducto`) REFERENCES `detalleproducto` (`idDetalleProducto`),
  ADD CONSTRAINT `fk_DetalleDeProductoOrdenSalida_OrdenSalida1` FOREIGN KEY (`OrdenSalida_idOrdenSalida`) REFERENCES `ordensalida` (`idOrdenSalida`);

--
-- Filtros para la tabla `ordenentrada`
--
ALTER TABLE `ordenentrada`
  ADD CONSTRAINT `fk_OrdenEntrada_Proveedor1` FOREIGN KEY (`Proveedor_idProveedor`) REFERENCES `proveedor` (`idProveedor`),
  ADD CONSTRAINT `fk_OrdenEntrada_Usuario1` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_Producto_Subcategoria1` FOREIGN KEY (`Subcategoria_idSubcategoria`) REFERENCES `subcategoria` (`idSubcategoria`);

--
-- Filtros para la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD CONSTRAINT `fk_Subcategoria_Categoria` FOREIGN KEY (`Categoria_idCategoria`) REFERENCES `categoria` (`idCategoria`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_Usuario_RolUsuario1` FOREIGN KEY (`RolUsuario_idRolUsuario`) REFERENCES `rolusuario` (`idRolUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
