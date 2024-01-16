<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminación Reservas</title>
</head>
<body style="display: grid; justify-content: center; align-items: center; background-color:  #D4EFDF">
    
    <?php 

    $id= $_GET['id'];

    include('../Model/ModelCRUDReservaCabin.php');
    $objReserva = new ModelCRUDReservaCabin();

    $reserva = $objReserva->SearchReserva($id);
   

    ?>


    <h1><p align="center">Eliminar Reserva</p></h1>
    <h3><p align="center">Lamentamos que debas Cancelar tu reserva.</p></h3>
    <h4><p align="center">Al Eliminarla, estarás borrando de forma definitiva la reserva.</p></h4>
    <h4><p align="center">dando la oportunidad a otros de poder reservar la cabaña.</p></h4>
        <table>
            <tbody>
                <tr>
                    
                    <td><br></td>
                    <td><a href="<?php echo "http://localhost/cabinCIISA/Controller/ControllerDeleteReservaCabin.php?id=" . $reserva['RUT_SOLICITANTE']?>">ESTOY SEGURO</a></td>
                    <td><div align='center'><button style='background-color: #A9DFBF' onclick='return window.history.back();'>"NO! VOLVER</button></div></td>
                </tr>
            </tbody>
        </table>
        <br>
    </body>
</html>