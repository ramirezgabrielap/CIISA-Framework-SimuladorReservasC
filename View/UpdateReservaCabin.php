<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva Cabañas CIISA</title>
</head>
<body style="display: grid; justify-content: center; align-items: center; background-color:  #D4EFDF">
    
    <?php 

    $id= $_GET['id'];

    include('../Model/ModelCRUDReservaCabin.php');
    $objReserva = new ModelCRUDReservaCabin();

    $reserva = $objReserva->SearchReserva($id);
   

    ?>


    <h1><p align="center">Actualiza tu Reserva</p></h1>
    <br>
    <h3><p align="center">A continuación, ingrese todos los datos del solicitante para asegurar la correcta reserva.</p></h3>
        <form action="../Controller/ControllerUpdateReservaCabin.php" method="POST">
            <table>
                <tbody>
                    <tr>
                        <td><label for="rut">Rut (sin puntos):</label></td>
                        <td><input type="number" name="rut" id="rut" value="<?php echo $reserva['RUT_SOLICITANTE'] ?>" placeholder="11333222" readonly></td>
                        <td><label for="dv">Digito Verificador:</label></td>
                        <td><input type="text" name="dv" id="dv" value="<?php echo $reserva['VCH_DV_SOLICITANTE'] ?>" placeholder="K" readonly></td>
                    </tr>
                    <tr>
                        <td><label for="name">Nombres:</label></td>
                        <td><input type="text" name="name" id="name" value="<?php echo $reserva['VCH_NOMBRES_SOLICITANTE'] ?>" placeholder="Juanito" maxlength="100"></td>
                        <td><label for="lastname">Apellidos:</label></td>
                        <td><input type="text" name="lastname" id="lastname" value="<?php echo $reserva['VCH_APELLIDOS_SOLICITANTE'] ?>" placeholder="Pérez" maxlength="100"></td>
                    </tr>                        
                    <tr>
                        <td><label for="acom">Cantidad de Acompañantes:</label></td>
                        <td><input type="number" name="acom" id="acom" value="<?php echo $reserva['INT_CANT_ACOM_SOLICITANTE'] ?>" placeholder="2" maxlength="2"></td>
                    </tr>
                    <tr>
                        <td><label for="days">Días de Estadía:</label></td>
                        <td><input type="number" name="days" id="days" value="<?php echo $reserva['INT_CANT_DIAS_SOLICITANTE'] ?>" placeholder="3" maxlength="2"></td>
                    </tr>
                    <tr>
                        <td><label for="date">Fecha Inicio:</label></td>
                        <td><input type="date" name="date" id="date" value="<?php echo $reserva['DATE_FECHA_INICIO_SOLICITANTE'] ?>"></td>
                    </tr>
                    <tr>
                        <td>Tipo de Cabaña: </td>
                        <td><label for="type1">(S) Pequeña (max. 4 personas)</label></td>
                        <td><input type="radio" name="type" id="type1" value="S" 
                            <?php if($reserva['VCH_CABAÑA_SOLICITANTE'] == "S"){ ?>
                                checked
                            <?php } ?>
                        ></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><label for="type2">(M) Mediana (max. 8 personas)</label></td>
                        <td><input type="radio" name="type" id="type2" value="M" 
                        <?php if($reserva['VCH_CABAÑA_SOLICITANTE'] == "M"){ ?>
                                checked
                            <?php } ?>>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><label for="type3">(L) Grande (max. 12 personas)</label></td>
                        <td><input type="radio" name="type" id="type3" value="L" 
                        <?php if($reserva['VCH_CABAÑA_SOLICITANTE'] == "L"){ ?>
                                checked
                        <?php } ?>
                        ></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><br></td>
                        <td><br><br><p align="right"><button style="background-color: buttonface" type="submit">ACTUALIZAR</button></p></td>
                    </tr>
                </tbody>
            </table>
            <br>
        </form>
    </body>
</html>