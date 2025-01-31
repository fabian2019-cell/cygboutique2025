<?php
require_once ("../conexion/DB_mysql.php");
require_once ("../modelo/ClaseUsuario.php");
require_once("../conexion/Modelo_generico.php");


class DAOUsuario{
    var $Conexion_ID;
    var $Errno=0;
    var $Error="";

    function __construct(){
    $this->Conexion_ID=new DB_mysql();
    $this->Conexion_ID=$this->Conexion_ID->getConexion();

    }

    function consultaUsuarios(){
       # if ($sql=="") {
            # code...
       # $this->Error="No ha especificado una consulta";
      #      return 0;
       # }
        $result=$this->Conexion_ID->query("SELECT *from `tb_usuarios`");
        $lista=array();


        if ($result) {
            # code...
            while ($fila=$result->fetch_object()) {
                # code...

                $lista[]=new ClaseUsuario($fila->id,$fila->rol, 
                    $fila->usuario,$fila->contrasena,$fila->dui,$fila->empleado,$fila->estado);
            }
        }
        if (!$result) {
            # code...
            $this->Errno=mysqli_connect_errno();
            $this->Error=mysqli_connect_error();
        }
        return $lista;
    }


    function consultaIndividualUsuario($id){
        if ($id=="") {
            # code...
        $this->Error="No ha especificado una consulta SQL";
            return 0;
        }

        $result=$this->Conexion_ID->query("SELECT *FROM tb_usuarios where dui='$id'");

        $ObjE=null;

        if ($result) {
            # code...dui_testigo
            while ($fila=$result->fetch_object()) {
                # code...
                $ObjE=new ClaseUsuario($fila->id,$fila->rol, 
                    $fila->usuario,$fila->contrasena,$fila->dui,$fila->empleado,$fila->estado);
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

    function eliminarUsuario($id){
        $this->Conexion_ID->autocommit(false);
        $result=$this->Conexion_ID->query("delete from tb_usuarios where id='".$id."'");

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


     function insertarUsuario(ClaseUsuario $obj){
        if (!($obj instanceof ClaseUsuario)) {
            # code...
            $this->Error="Error de instaciado";
            return 0;
        }
        $modelo = new Modelo_generico();
        $id_insertar=null;
        $contra=null;
        $id_insertar = $modelo->retonrar_id_insertar(''.$obj->getId());
        $contra=$modelo->encriptarlas_contrasenas(''.$obj->getContrasena());
        $this->Conexion_ID->autocommit(false);
        $result=$this->Conexion_ID->query("insert into tb_usuarios values ('".$id_insertar."','".$obj->getRol()."','".$obj->getUsuario()."','".$contra."','".$obj->getDui()."','".$obj->getEmpleado()."','".$obj->getEstado()."')");

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

    function actualizarUsuario(ClaseUsuario $obj){
        if (!($obj instanceof ClaseUsuario)) {
            # code...
            $this->Error="Error de instaciado";
            return 0;
        }

        $modelo = new Modelo_generico();
        $contra=null;
        $contra=$modelo->encriptarlas_contrasenas(''.$obj->getContrasena());

        $this->Conexion_ID->autocommit(false);
        $result=$this->Conexion_ID->query("update tb_usuarios set 
        rol='".$obj->getRol()."',
        usuario='".$obj->getUsuario()."',
        contrasena='".$contra."',
        empleado='".$obj->getEmpleado()."',
        estado='".$obj->getEstado()."'
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