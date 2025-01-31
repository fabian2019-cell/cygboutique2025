<?php
require_once ("../conexion/DB_mysql.php");
require_once ("../modelo/ClaseCliente.php");
require_once("../conexion/Modelo_generico.php");


class DAOCliente{
    var $Conexion_ID;
    var $Errno=0;
    var $Error="";

    function __construct(){
    $this->Conexion_ID=new DB_mysql();
    $this->Conexion_ID=$this->Conexion_ID->getConexion();

    }

    function consultaCliente(){
       # if ($sql=="") {
            # code...
       # $this->Error="No ha especificado una consulta";
      #      return 0;
       # }
        $result=$this->Conexion_ID->query("SELECT *from `tb_cliente`");
        $lista=array();


        if ($result) {
            # code...
            while ($fila=$result->fetch_object()) {
                # code...

                $lista[]=new ClaseCliente($fila->id_cliente,$fila->nombres,$fila->apellidos,$fila->dui,$fila->telefono,$fila->fecha_registro);
            }
        }
        if (!$result) {
            # code...
            $this->Errno=mysqli_connect_errno();
            $this->Error=mysqli_connect_error();
        }
        return $lista;
    }


    function consultaIndividualCliente($id){
        if ($id=="") {
            # code...
        $this->Error="No ha especificado una consulta SQL";
            return 0;
        }

        $result=$this->Conexion_ID->query("SELECT *FROM tb_cliente where dui='$id'");

        $ObjE=null;

        if ($result) {
            # code...dui_testigo
            while ($fila=$result->fetch_object()) {
                # code...
                $ObjE=new ClaseCliente($fila->id_cliente,$fila->nombres,$fila->apellidos,$fila->dui,$fila->telefono,$fila->fecha_registro);
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

    function consultaIndividualCliente2($id){
        if ($id=="") {
            # code...
        $this->Error="No ha especificado una consulta SQL";
            return 0;
        }

        $result=$this->Conexion_ID->query("SELECT *FROM tb_cliente where id_cliente='$id'");

        $ObjE=null;

        if ($result) {
            # code...dui_testigo
            while ($fila=$result->fetch_object()) {
                # code...
                $ObjE=new ClaseCliente($fila->id_cliente,$fila->nombres,$fila->apellidos,$fila->dui,$fila->telefono,$fila->fecha_registro);
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

    function eliminarCliente($id){
        $this->Conexion_ID->autocommit(false);
        $result=$this->Conexion_ID->query("delete from tb_cliente where id_cliente='".$id."'");

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


     function insertarCliente(ClaseCliente $obj){
        if (!($obj instanceof ClaseCliente)) {
            # code...
            $this->Error="Error de instaciado";
            return 0;
        }
        $modelo = new Modelo_generico();
        $id_insertar=null;
        $contra=null;
                //$id_insertar = $modelo->retonrar_id_insertar(''.$obj->getId_cliente());
       // $contra=$modelo->encriptarlas_contrasenas(''.$obj->getContrasena());
        $this->Conexion_ID->autocommit(false);
        $result=$this->Conexion_ID->query("insert into tb_cliente values ('','".$obj->getNombres()."','".$obj->getApellidos()."','".$obj->getDui()."','".$obj->getTelefono()."','".$obj->getFecha_registro()."')");

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

    function actualizarCliente(ClaseCliente $obj){
        if (!($obj instanceof ClaseCliente)) {
            # code...
            $this->Error="Error de instaciado";
            return 0;
        }

        $modelo = new Modelo_generico();
        $contra=null;
        //$contra=$modelo->encriptarlas_contrasenas(''.$obj->getContrasena());

        $this->Conexion_ID->autocommit(false);
        $result=$this->Conexion_ID->query("update tb_cliente set 
        nombres='".$obj->getNombres()."',
        apellidos='".$obj->getApellidos()."',
        telefono='".$obj->getTelefono()."'
        where dui='".$obj->getDui()."'");

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