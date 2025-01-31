<?php
require_once ("../conexion/DB_mysql.php");
require_once ("../modelo/ClaseProveedor.php");
class DAOProveedor{
    var $Conexion_ID;
    var $Errno=0;
    var $Error="";

    function __construct(){
    $this->Conexion_ID=new DB_mysql();
    $this->Conexion_ID=$this->Conexion_ID->getConexion();

    }

    function consultaProveedores(){
       # if ($sql=="") {
            # code...
       # $this->Error="No ha especificado una consulta";
      #      return 0;
       # }
        $result=$this->Conexion_ID->query("SELECT *from `tb_proveedor`");
        $lista=array();


        if ($result) {
            # code...
            while ($fila=$result->fetch_object()) {
                # code...
                $lista[]=new ClaseProveedor($fila->id_proveedor,$fila->nombre_comp,$fila->empresa,$fila->telefono);
            }
        }
        if (!$result) {
            # code...
            $this->Errno=mysqli_connect_errno();
            $this->Error=mysqli_connect_error();
        }
        return $lista;
    }
     function consultaIndividualP($id){
        if ($id=="") {
            # code...
        $this->Error="No ha especificado una consulta SQL";
            return 0;
        }

        $result=$this->Conexion_ID->query("SELECT *FROM tb_proveedor where id_proveedor=$id");

        $ObjE=null;

        if ($result) {
            # code...
            while ($fila=$result->fetch_object()) {
                # code...
                $ObjE=new ClaseProveedor($fila->id_proveedor,$fila->nombre_comp,$fila->empresa,$fila->telefono);
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


    function insertarProveedor(ClaseProveedor $obj){
        if (!($obj instanceof ClaseProveedor)) {
            # code...
            $this->Error="Error de instaciado";
            return 0;
        }

        $this->Conexion_ID->autocommit(false);
        $result=$this->Conexion_ID->query("insert into tb_proveedor values ('".$obj->getId_proveedor()."','".$obj->getNombre()."','".$obj->getEmpresa()."','".$obj->getTelefono()."')");

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


    function actualizarProveedor(ClaseProveedor $obj){
        if (!($obj instanceof ClaseProveedor)) {
            # code...
            $this->Error="Error de instaciado";
            return 0;
        }

        $this->Conexion_ID->autocommit(false);
        $result=$this->Conexion_ID->query("update tb_proveedor set 
        nombre_comp='".$obj->getNombre()."',
        empresa='".$obj->getEmpresa()."',
        telefono='".$obj->getTelefono()."'
        where id_proveedor=".$obj->getId_proveedor()."");

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

    function eliminarProveedor($id){
        $this->Conexion_ID->autocommit(false);
        $result=$this->Conexion_ID->query("delete from tb_proveedor where id_proveedor=".$id."");

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