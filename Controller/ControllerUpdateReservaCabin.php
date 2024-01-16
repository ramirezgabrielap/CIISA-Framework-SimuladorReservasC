<?php 

include('../Model/ModelCRUDReservaCabin.php');

$MAX_CABIN_SMALL = 4; 
$MAX_CABIN_MEDIUM = 8;
$MAX_CABIN_LARGE = 12;

if(empty($_POST['rut']) || empty($_POST['dv']) || empty($_POST['name']) || empty($_POST['lastname']) || empty($_POST['acom']) || empty($_POST['days']) || empty($_POST['date']) || empty($_POST['type'])){
    echo "<div align='center'>FALTAN DATOS POR INGRESAR. <br>" . "<br><b> Por favor, ingrese todos los campos solicitados. </b><br>" . "<br>"."<button style='background-color: #A9DFBF' onclick='return window.history.back();'>VOLVER</button></div>" . "<br>";
    return false;
} 

$rut = $_POST['rut'];
$dv = $_POST['dv'];
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$acom = $_POST['acom'];
$days = $_POST['days'];
$date = $_POST['date'];
$type = $_POST['type'];

$total_personas = (int)$acom +1;


if ($type=="S" && $total_personas > $MAX_CABIN_SMALL) {   // PEQUEÑA max 4
    echo "<div align='center'><br><b>ERROR! </b><br><br>"."<br> NO PUEDEN INGRESAR MÁS PERSONAS QUE LA CAPACIDAD DE LA CABAÑA <b>PEQUEÑA</b> <br>" . "<br>(MÁXIMO 4 PERSONAS)<br>" . "<br> Por favor, ingrese un numero en base a la capacidad máxima de cada cabaña.<br>". "<br>" . "<button style='background-color: #A9DFBF' onclick='return window.history.back();'>VOLVER A INTENTAR</button></div>" . "<br>";
    return false;    
} 
if ($type=="M" && $total_personas > $MAX_CABIN_MEDIUM) {    // MEDIANA max 8
    echo "<div align='center'><br><b>ERROR! </b><br><br>"."<br> NO PUEDEN INGRESAR MÁS PERSONAS QUE LA CAPACIDAD DE LA CABAÑA <b>MEDIANA</b> <br>" . "<br>(MÁXIMO 8 PERSONAS)<br>" . "<br> Por favor, ingrese un numero en base a la capacidad máxima de cada cabaña.<br>" . "<br>" . "<button style='background-color: #A9DFBF' onclick='return window.history.back();'>VOLVER A INTENTAR</button></div>" . "<br>";
    return false;
} 
if ($type=="L" && $total_personas > $MAX_CABIN_LARGE) {    // GRANDE max 12
    echo "<div align='center'><br><b>ERROR! </b><br><br>"."<br> NO PUEDEN INGRESAR MÁS PERSONAS QUE LA CAPACIDAD DE LA CABAÑA <b>GRANDE</b> <br>" . "<br>(MÁXIMO 12 PERSONAS)<br>" . "<br> Por favor, ingrese un numero en base a la capacidad máxima de cada cabaña.<br>" . "<br>" . "<button style='background-color: #A9DFBF' onclick='return window.history.back();'>VOLVER A INTENTAR</button></div>" . "<br>";
    return false;
}


$objreserva = new ModelCRUDReservaCabin();

// valida rango fecha
$days_range = array();
$days_int = (int) $days -1;

for( $i = 0; $i <= $days_int; $i++ ){
    $d = date('Y-m-d', strtotime($date. ' + '.$i.' days'));
    $days_range[] = date('Y-m-d', strtotime($date. ' + '.$i.' days'));
}


foreach($days_range as $day){
    $validafecha = $objreserva->ValidarFechaMismoRut($day, $type, $rut);
    if($validafecha->num_rows > 0){
        echo "<div align='center'> Lo sentimos. <br> No tenemos disponibilidad de Cabañas para la fecha solicictada. <br>Por favor, intente con otro rango de fechas.<br>" . "<br>" . "<button style='background-color: #A9DFBF' onclick='return window.history.back();'>VOLVER A PROBAR SUERTE</button></div>" . "<br>";
        return false;
    } 
}


$respuesta = $objreserva->UpdateReserva($rut, $dv, $name, $lastname, $acom, $days, $date, $type);
echo "<br>" .$respuesta;
echo "<br><div style='display: grid; justify-content: center; align-items: center; background-color:  #D4EFDF'><b> RESUMEN DE SU NUEVA RESERVA </b><br>" . "<br> Solicitante: " . $name . " " . $lastname . "<br> Rut Solicitante: " . $rut . "-" . $dv . "<br> Cantidad de Acompañantes: " . $acom . "<br> Días de Estadía: " . $days . "<br> A partir del: " . $date . "<br> En la Cabaña: " . $type . ", para " . $total_personas. " personas en total. </div>";

$formatdate = new DateTime($date);
$formatdate->modify('+' . $days . 'day');
$fechita = $formatdate->format('Y-m-d');
echo "<br><p align='center'> * Recuerde: hasta el " . $fechita . " </p>";
    
echo "<br><div align='center'><form action='../index.php' method='POST'><button style='background-color: #A9DFBF' type='submit'>VOLVER AL HOME</button></form></div>";

?>