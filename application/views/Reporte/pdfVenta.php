<html lang="es">
    <head>
        <meta charset="utf-8">
        <title><?php echo $titulo ?></title>
        <style type="text/css">
            body {
                background-color: #fff;
                margin: 40px;
                font-family: Lucida Grande, Verdana, Sans-serif;
                font-size: 14px;
                color: #4F5155;
            }

            a {
                color: #003399;
                background-color: transparent;
                font-weight: normal;
            }

            h1 {
                color: #444;
                background-color: transparent;
                border-bottom: 1px solid #D0D0D0;
                font-size: 16px;
                font-weight: bold;
                margin: 24px 0 2px 0;
                padding: 5px 0 6px 0;
            }

            h2 {
                color: #444;
                background-color: transparent;
                border-bottom: 1px solid #D0D0D0;
                font-size: 16px;
                font-weight: bold;
                margin: 24px 0 2px 0;
                padding: 5px 0 6px 0;
                text-align: center;
            }

            table{
                text-align: center;
            }

            /* estilos para el footer y el numero de pagina */
            @page { margin: 180px 50px; }
            #header { 
                position: fixed; 
                left: 0px; top: -140px; 
                right: 0px; 
                height: 150px; 
                background-color: #fff; 
                color: #fff;
                text-align: center; 
            }
            article,
            aside,
            footer,
            header,
            nav,
            section {
                display: block;
            }
            #footer { 
                position: fixed; 
                left: 0px; 
                bottom: -180px; 
                right: 0px; 
                height: 150px; 
                background-color: #333; 
                color: #fff;
            }
            #footer .page:after { 
                content: counter(page, upper-roman); 
            }
            .tamanoimg{
                width: 500px;
                height: 150px;

            } 
            .table {
                width: 95%;
                max-width: 95%;
                margin-bottom: 1rem;
                background-color: transparent; }
            .table th,
            .table td {
                padding: 0.68rem;
                vertical-align: top;
                border-top: 1px solid #e9ecef; }
            .table thead th {
                vertical-align: bottom;
                border-bottom: 2px solid #e9ecef; }
            .table tbody + tbody {
                border-top: 2px solid #e9ecef; }
            .table .table {
                background-color: #fff; }

            .table-sm th,
            .table-sm td {
                padding: 0.2rem; }

            .table-bordered {
                border: 1px solid #e9ecef; }
            .table-bordered th,
            .table-bordered td {
                border: 1px solid #e9ecef; }
            .table-bordered thead th,
            .table-bordered thead td {
                border-bottom-width: 2px; }

            .table-striped tbody tr:nth-of-type(odd) {
                background-color: rgba(0, 0, 0, 0.05); }

            .table-hover tbody tr:hover {
                background-color: rgba(0, 0, 0, 0.075); }

            .table-primary,
            .table-primary > th,
            .table-primary > td {
                background-color: #b8daff; }

            .table-hover .table-primary:hover {
                background-color: #9fcdff; }
            .table-hover .table-primary:hover > td,
            .table-hover .table-primary:hover > th {
                background-color: #9fcdff; }

            .table-secondary,
            .table-secondary > th,
            .table-secondary > td {
                background-color: #dddfe2; }

            .table-hover .table-secondary:hover {
                background-color: #cfd2d6; }
            .table-hover .table-secondary:hover > td,
            .table-hover .table-secondary:hover > th {
                background-color: #cfd2d6; }

            .table-success,
            .table-success > th,
            .table-success > td {
                background-color: #c3e6cb; }

            .table-hover .table-success:hover {
                background-color: #b1dfbb; }
            .table-hover .table-success:hover > td,
            .table-hover .table-success:hover > th {
                background-color: #b1dfbb; }

            .table-info,
            .table-info > th,
            .table-info > td {
                background-color: #bee5eb; }

            .table-hover .table-info:hover {
                background-color: #abdde5; }
            .table-hover .table-info:hover > td,
            .table-hover .table-info:hover > th {
                background-color: #abdde5; }

            .table-warning,
            .table-warning > th,
            .table-warning > td {
                background-color: #ffeeba; }

            .table-hover .table-warning:hover {
                background-color: #ffe8a1; }
            .table-hover .table-warning:hover > td,
            .table-hover .table-warning:hover > th {
                background-color: #ffe8a1; }

            .table-danger,
            .table-danger > th,
            .table-danger > td {
                background-color: #f5c6cb; }

            .table-hover .table-danger:hover {
                background-color: #f1b0b7; }
            .table-hover .table-danger:hover > td,
            .table-hover .table-danger:hover > th {
                background-color: #f1b0b7; }

            .table-light,
            .table-light > th,
            .table-light > td {
                background-color: #fdfdfe; }

            .table-hover .table-light:hover {
                background-color: #ececf6; }
            .table-hover .table-light:hover > td,
            .table-hover .table-light:hover > th {
                background-color: #ececf6; }

            .table-dark,
            .table-dark > th,
            .table-dark > td {
                background-color: #c6c8ca; }

            .table-hover .table-dark:hover {
                background-color: #b9bbbe; }
            .table-hover .table-dark:hover > td,
            .table-hover .table-dark:hover > th {
                background-color: #b9bbbe; }

            .table-active,
            .table-active > th,
            .table-active > td {
                background-color: rgba(0, 0, 0, 0.075); }

            .table-hover .table-active:hover {
                background-color: rgba(0, 0, 0, 0.075); }
            .table-hover .table-active:hover > td,
            .table-hover .table-active:hover > th {
                background-color: rgba(0, 0, 0, 0.075); }

            .thead-inverse th {
                color: #fff;
                background-color: #eb9316; font-weight: bold; text-transform: uppercase; }

            .thead-default th {
                color: #495057;
                background-color: #e9ecef;  }

            .table-inverse { color: #fff; background-color: #212529;  }
            .table-inverse th,
            .table-inverse td,
            .table-inverse thead th {
                border-color: #32383e; }
            .table-inverse.table-bordered {
                border: 0; }
            .table-inverse.table-striped tbody tr:nth-of-type(odd) {
                background-color: rgba(255, 255, 255, 0.05); }
            .table-inverse.table-hover tbody tr:hover {
                background-color: rgba(255, 255, 255, 0.075); }
            .textErr{
                font-family: cursive;
                text-align: center;
                color: #cc0000;
                font-size: 2.5em;
            }

        </style>
    </head>
    <body>

        <!--header para cada pagina-->
        <div id="header">
            <?php echo $titulo ?>
            <img src="<?php base_url() ?>public/img/immerpro.png" class="tamanoimg">

        </div>
        <!--footer para cada pagina-->
        <footer>
            <!--aqui se muestra el numero de la pagina en numeros romanos-->
            <p class="page"></p>



        </footer>
        <h2>Reporte de productos vendidos.</h2>
        <?php if ($productosVenta): ?>
            <table class="table table-hover table-bordered table-striped">
                <thead class="thead-inverse">
                    <tr>
                        <th width="100">Producto Vendido</th>
                        <th width="100">Venta total</th>
                        <th width="100">Cantidad maxima</th>
                       

                    </tr>
                </thead>


                <tbody>
                    <?php foreach ($productosVenta as $venta): ?>
                        <tr>
                            <td width="100"><?php echo $venta['productovendido']; ?></td>
                            <td width="100"><?php echo $venta['totalVenta']; ?></td>
                            <td width="100"><?php echo $venta['CantidadTotal']; ?></td>
                            
                    <?php endforeach; ?>

                </tbody>
            </table>
        <?php else: ?>
            <p class="textErr">No hay informacion que cumpla con el criterio seleccionado </p>
        <?php endif; ?> 
        <a href="<?php echo base_url() ?>admin">volver a inicio</a><br>


    </body>
</html>