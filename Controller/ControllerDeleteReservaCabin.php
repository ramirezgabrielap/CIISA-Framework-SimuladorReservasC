<?php

include('../Model/ModelCRUDReservaCabin.php');
 
$rut= $_GET['id'];
$objreserva = new ModelCRUDReservaCabin();

$respuesta = $objreserva->DeleteReserva($rut);

echo "<br><div align='center'>" .$respuesta . "<br>";

 
echo "<br><form action='../index.php' method='POST'><button style='background-color: #A9DFBF' type='submit'>VOLVER AL HOME</button></form></div>";

?>