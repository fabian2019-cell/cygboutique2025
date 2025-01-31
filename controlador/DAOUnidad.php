<?php
require_once ("../conexion/DB_mysql.php");
require_once ("../modelo/ClaseUnidad.php");
class DAOUnidad{
    var $Conexion_ID;
    var $Errno=0;
    var $Error="";

    function __construct(){
    $this->Conexion_ID=new DB_mysql();
    $this->Conexion_ID=$this->Conexion_ID->getConexion();

    }

    function consultaUnidad(){
       # if ($sql=="") {
            # code...
       # $this->Error="No ha especificado una consulta";
      #      return 0;
       # }
        $result=$this->Conexion_ID->query("SELECT *from `tb_unidades`");
        $lista=array();


        if ($result) {
            # code...
            while ($fila=$result->fetch_object()) {
                # code...
                $lista[]=new ClaseUnidad($fila->id_unidad,$fila->nombre_unidad);
            }
        }
        if (!$result) {
            # code...
            $this->Errno=mysqli_connect_errno();
            $this->Error=mysqli_connect_error();
        }
        return $lista;
    }
     function consultaIndividualU($id){
        if ($id=="") {
            # code...
        $this->Error="No ha especificado una consulta SQL";
            return 0;
        }

        $result=$this->Conexion_ID->query("SELECT *FROM tb_unidades where id_unidad=$id");

        $ObjE=null;

        if ($result) {
            # code...
            while ($fila=$result->fetch_object()) {
                # code...
                $ObjE=new ClaseUnidad($fila->id_unidad,$fila->nombre_unidad);
            }
        }
        ///////////////////////////
        if (!$result) {
            # code...
            $this->Errno=mysqli_connect_errno();
            $this->Error=mysqli_connect_error();
        }
        return $ObjE;
    }


    function insertarUnidad(ClaseUnidad $obj){
        if (!($obj instanceof ClaseUnidad)) {
            # code...
            $this->Error="Error de instaciado";
            return 0;
        }

        $this->Conexion_ID->autocommit(false);
        $result=$this->Conexion_ID->query("insert into tb_unidades values ('".$obj->getIdunidad()."','".$obj->getNombreunidad()."')");

        if (!$result) {
            # code...
            $this->Errno=mysqli_connect_errno();
            $this->Error=mysqli_connect_error();
            $this->Conexion_ID->rollback();/*si algo esta mal los datos no se insertaran */
            return 0;
        }else{
            $this->Conexion_ID->commit();/*si todo esta bien se inserta los datos */
            return 1;
        }
    }


    function actualizarUnidad(ClaseUnidad $obj){
        if (!($obj instanceof ClaseUnidad)) {
            # code...
            $this->Error="Error de instaciado";
            return 0;
        }

        $this->Conexion_ID->autocommit(false);
        $result=$this->Conexion_ID->query("update tb_unidades set 
        nombre_unidad='".$obj->getNombreunidad()."'
        where id_unidad=".$obj->getIdunidad()."");

        if (!$result) {
            # code...
            $this->Errno=mysqli_connect_errno();
            $this->Error=mysqli_connect_error();
            $this->Conexion_ID->rollback();/*si algo esta mal los datos no se insertaran */
            return 0;
        }else{
            $this->Conexion_ID->commit();/*si todo esta bien se inserta los datos */
            return 1;
        }
    }

    function eliminarUnidad($id){
        $this->Conexion_ID->autocommit(false);
        $result=$this->Conexion_ID->query("delete from tb_unidades where id_unidad=".$id."");

        if (!$result) {
            # code...
            $this->Errno=mysqli_connect_errno();
            $this->Error=mysqli_connect_error();
            $this->Conexion_ID->rollback();/*si algo esta mal los datos no se insertaran */
            return 0;
        }else{
            $this->Conexion_ID->commit();/*si todo esta bien se inserta los datos */
            return 1;
        }
    }



}

?>