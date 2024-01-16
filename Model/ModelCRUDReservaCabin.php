<?php
include('Conexion.php');
 

class ModelCRUDReservaCabin{
    public function InsertReserva($rut, $dv, $name, $lastname, $acom, $days, $date, $type){
        $query="INSERT INTO tbl_reserva(RUT_SOLICITANTE, VCH_DV_SOLICITANTE, VCH_NOMBRES_SOLICITANTE, VCH_APELLIDOS_SOLICITANTE, INT_CANT_ACOM_SOLICITANTE, INT_CANT_DIAS_SOLICITANTE, DATE_FECHA_INICIO_SOLICITANTE, VCH_CABAÑA_SOLICITANTE) VALUES ('$rut', '$dv', '$name', '$lastname', '$acom', '$days', '$date', '$type')";
        $stringconnection= Conexion::conectar();
        if(mysqli_query($stringconnection,$query)){
            $f= mysqli_affected_rows($stringconnection);
            if($f==1){
                $mensaje="<p align='center'>Reserva ingresada exitosamente </p>";
            } else {
                $mensaje="Lo sentimos. No se pudo realizar la reserva";
            }
        } else {
            $mensaje="Error de Conexón";
        }
        mysqli_close($stringconnection);
        return $mensaje;
    }


    public function ValidarFecha($date, $type){
        $query="SELECT * from tbl_reserva WHERE VCH_CABAÑA_SOLICITANTE = '".$type."' AND '".$date."' BETWEEN DATE_FECHA_INICIO_SOLICITANTE AND DATE_ADD(DATE_FECHA_INICIO_SOLICITANTE, INTERVAL INT_CANT_DIAS_SOLICITANTE -1 DAY)";
        $stringconnection= Conexion::conectar();
        $result = mysqli_query($stringconnection, $query);
        return $result;
    }

    public function ValidarFechaMismoRut($date, $type, $rut){
        $query="SELECT * from tbl_reserva WHERE RUT_SOLICITANTE != '".$rut."' AND VCH_CABAÑA_SOLICITANTE = '".$type."' AND '".$date."' BETWEEN DATE_FECHA_INICIO_SOLICITANTE AND DATE_ADD(DATE_FECHA_INICIO_SOLICITANTE, INTERVAL INT_CANT_DIAS_SOLICITANTE -1 DAY)";
        $stringconnection= Conexion::conectar();
        $result = mysqli_query($stringconnection, $query);
        return $result;
    }
      

    public function SearchReservas($type){
        $query="";
        if($type == "all") {
            $query="SELECT * FROM tbl_reserva";     
        } else {
            $query = "SELECT * FROM tbl_reserva WHERE VCH_CABAÑA_SOLICITANTE ='".$type ."'";
        }
        $stringconnection= Conexion::conectar();
        $resp= mysqli_query($stringconnection,$query);
        return $resp;
    }


    public function SearchReserva($rut){
        $query = "SELECT * FROM tbl_reserva WHERE RUT_SOLICITANTE ='".$rut ."' limit 1";
        $stringconnection= Conexion::conectar();
        $resp= mysqli_query($stringconnection,$query);
        $resp= mysqli_fetch_assoc($resp);  // para retornar 1 solo registro y no el array completo
        return $resp;
    }


    public function DeleteReserva($rut){
        $query="DELETE FROM tbl_reserva WHERE RUT_SOLICITANTE='$rut'";
        $stringconnection= Conexion::conectar();

        if(mysqli_query($stringconnection,$query)){
            $f= mysqli_affected_rows($stringconnection);
            if($f==1){
                $men="Reserva Eliminada con Exito";
            } else {
                $men="Lo sentimos. No se pudo eliminar la reserva";
            }
        } else {
            $men="Error de Conexón";
        }
        return $men;
    }


    public function UpdateReserva($rut, $dv, $name, $lastname, $acom, $days, $date, $type){
        $query="UPDATE tbl_reserva SET VCH_NOMBRES_SOLICITANTE = '". $name ."', VCH_APELLIDOS_SOLICITANTE = '". $lastname ."', INT_CANT_ACOM_SOLICITANTE = '". $acom ."', INT_CANT_DIAS_SOLICITANTE = '". $days ."', DATE_FECHA_INICIO_SOLICITANTE = '". $date ."', VCH_CABAÑA_SOLICITANTE = '". $type ."' WHERE RUT_SOLICITANTE = '$rut'";
        $stringconnection= Conexion::conectar();
        if(mysqli_query($stringconnection,$query)){
            $f= mysqli_affected_rows($stringconnection);
            if($f==1){
                $mensaje="<p align='center'>Modificación ingresado exitosamente </p>";
            } else {
                $mensaje="Lo sentimos. No se pudo realizar la modificación";
            }
        } else {
            $mensaje="Error de Conexón";
        }
        mysqli_close($stringconnection);
        return $mensaje;
    }

}
