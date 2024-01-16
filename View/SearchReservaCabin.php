<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado Reservas</title>
</head>
<body style="display: grid; justify-content: center; align-items: center; background-color: azure">
        <h1>Listado actual de Reservas</h1>
        <h3>Indique el tipo de Cabaña que desea listar</h3>
        <form action="" method="GET">
            <table>
                <tbody>
                    <tr>
                        <td><label for="small">Todas</label></td>
                        <td><input type="radio" name="type" id="all" value="all" checked></td>
                    </tr>
                    <tr>
                        <td><label class="pl-4" for="small">Pequeña</label></td>
                        <td><input type="radio" name="type" id="small" value="S" ></td>
                    </tr>
                    <tr>
                        <td><label class="pl-4" for="medium">Mediana</label></td>
                        <td><input type="radio" name="type" id="medium" value="M"></td>
                    </tr>
                    <tr>
                        <td><label class="pl-4" for="large">Grande</label></td>
                        <td><input type="radio" name="type" id="large" value="L"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><br><button style="background-color: buttonface" type="submit">BUSCAR</button></td>
                    </tr>
                </tbody>
            </table>
            <br>
        </form>


        <?php
            $type = "";
            $reservas = array();

            if(!empty($_GET['type'])){
                include('../Model/ModelCRUDReservaCabin.php');
                $objReserva = new ModelCRUDReservaCabin();
                $type = $_GET['type'];
                $reservas = $objReserva->SearchReservas($type);
            }
        
        ?>
        
        <table>
            <thead>
                <th>RUT</th>
                <th>Y DIGITO |</th>
                <th>NOMBRE</th>
                <th>APELLIDO</th>
                <th>| ACOMPAÑANTES</th>
                <th>| DIAS</th>
                <th>| FECHA INICIO</th>
                <th>| CABAÑA</th>
            </thead>
            <tbody>
                <?php foreach($reservas as $reserva){ ?>
                <tr>
                    <td><?php echo $reserva['RUT_SOLICITANTE'] ?></td>
                    <td><?php echo $reserva['VCH_DV_SOLICITANTE'] ?></td>
                    <td><?php echo $reserva['VCH_NOMBRES_SOLICITANTE'] ?></td>
                    <td><?php echo $reserva['VCH_APELLIDOS_SOLICITANTE'] ?></td>
                    <td><?php echo $reserva['INT_CANT_ACOM_SOLICITANTE'] ?></td>
                    <td><?php echo $reserva['INT_CANT_DIAS_SOLICITANTE'] ?></td>
                    <td><?php echo $reserva['DATE_FECHA_INICIO_SOLICITANTE'] ?></td>
                    <td><?php echo $reserva['VCH_CABAÑA_SOLICITANTE'] ?></td>
                    <td><a href="<?php echo "http://localhost/cabinCIISA/View/UpdateReservaCabin.php?id=" . $reserva['RUT_SOLICITANTE']?>">EDITAR</a></td>
                    <td><a href="<?php echo "http://localhost/cabinCIISA/View/DeleteReservaCabin.php?id=" . $reserva['RUT_SOLICITANTE']?>">ELIMINAR</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>



    </body>
</html>
