<?php
require_once ("../conexion/DB_mysql.php");
require_once ("../modelo/ClaseEmpleado.php");
require_once("../conexion/Modelo_generico.php");


class DAOEmpleado{
    var $Conexion_ID;
    var $Errno=0;
    var $Error="";

    function __construct(){
    $this->Conexion_ID=new DB_mysql();
    $this->Conexion_ID=$this->Conexion_ID->getConexion();

    }

    function consultaEmpleados(){
       # if ($sql=="") {
            # code...
       # $this->Error="No ha especificado una consulta";
      #      return 0;
       # }
        $result=$this->Conexion_ID->query("SELECT *from `tb_empleado`");
        $lista=array();


        if ($result) {
            # code...
            while ($fila=$result->fetch_object()) {
                # code...

                $lista[]=new ClaseEmpleado($fila->id_empleado,$fila->nombres,$fila->apellidos,$fila->dui,$fila->direccion,$fila->telefono,$fila->estado,$fila->cargo_emp);
            }
        }
        if (!$result) {
            # code...
            $this->Errno=mysqli_connect_errno();
            $this->Error=mysqli_connect_error();
        }
        return $lista;
    }


    function consultaIndividualEmpleado($id){
        if ($id=="") {
            # code...
        $this->Error="No ha especificado una consulta SQL";
            return 0;
        }

        $result=$this->Conexion_ID->query("SELECT *FROM tb_empleado where id_empleado='$id'");

        $ObjE=null;

        if ($result) {
            # code...dui_testigo
            while ($fila=$result->fetch_object()) {
                # code...
                $ObjE=new ClaseEmpleado($fila->id_empleado,$fila->nombres, 
                    $fila->apellidos,$fila->dui,$fila->direccion,$fila->telefono,$fila->estado,$fila->cargo_emp);
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

    function eliminarEmpleado($id){
        $this->Conexion_ID->autocommit(false);
        $result=$this->Conexion_ID->query("delete from tb_empleado where id_empleado='".$id."'");

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


     function insertarEmpleado(ClaseEmpleado $obj){
        if (!($obj instanceof ClaseEmpleado)) {
            # code...
            $this->Error="Error de instaciado";
            return 0;
        }
        $modelo = new Modelo_generico();
        $id_insertar=null;
        $contra=null;
        //$id_insertar = $modelo->retonrar_id_insertar(''.$obj->getId_empleado());
       // $contra=$modelo->encriptarlas_contrasenas(''.$obj->getContrasena());
        $this->Conexion_ID->autocommit(false);
        $result=$this->Conexion_ID->query("insert into tb_empleado values (NULL,'".$obj->getNombres()."','".$obj->getApellidos()."','".$obj->getDui()."','".$obj->getDireccion()."','".$obj->getTelefono()."','".$obj->getEstado()."','".$obj->getCargo()."')");

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

    function actualizarEmpleado(ClaseEmpleado $obj){
        if (!($obj instanceof ClaseEmpleado)) {
            # code...
            $this->Error="Error de instaciado";
            return 0;
        }

        $modelo = new Modelo_generico();
        $contra=null;
        //$contra=$modelo->encriptarlas_contrasenas(''.$obj->getContrasena());

        $this->Conexion_ID->autocommit(false);
        $result=$this->Conexion_ID->query("update tb_empleado set 
        nombres='".$obj->getNombres()."',
        apellidos='".$obj->getApellidos()."',
        direccion='".$obj->getDireccion()."',
        telefono='".$obj->getTelefono()."',
        estado='".$obj->getEstado()."',
        cargo_emp='".$obj->getCargo()."'
        where id_empleado='".$obj->getId_empleado()."'");

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