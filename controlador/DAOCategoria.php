<?php
require_once ("../conexion/DB_mysql.php");
require_once ("../modelo/ClaseCategoria.php");
class DAOCategoria{
    var $Conexion_ID;
    var $Errno=0;
    var $Error="";

    function __construct(){
    $this->Conexion_ID=new DB_mysql();
    $this->Conexion_ID=$this->Conexion_ID->getConexion();

    }

    function consulta(){
       # if ($sql=="") {
            # code...
       # $this->Error="No ha especificado una consulta";
      #      return 0;
       # }

        $result=$this->Conexion_ID->query("SELECT * FROM `tb_categoria`");
        $lista=array();

        if ($result) {
            # code...
            while ($fila=$result->fetch_object()) {
                # code...
                $lista[]=new ClaseCategoria($fila->id_categoria,$fila->nombre,$fila->descripcion);
            }
        }
        if (!$result) {
            # code...
            $this->Errno=mysqli_connect_errno();
            $this->Error=mysqli_connect_error();
        }
        return $lista;
    }

    function insertar(ClaseCategoria $obj){
        if (!($obj instanceof ClaseCategoria)) {
            # code...
            $this->Error="Error de instaciado";
            return 0;
        }
        $this->Conexion_ID->autocommit(false);
        $result=$this->Conexion_ID->query("insert into tb_categoria 
        values ('".$obj->getId_cat()."','".$obj->getNombre()."','".$obj->getDescripcion()."')");

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

    function actualizar(ClaseCategoria $obj){
        if (!($obj instanceof ClaseCategoria)) {
            # code...
            $this->Error="Error de instaciado";
            return 0;
        }
        $this->Conexion_ID->autocommit(false);
        $result=$this->Conexion_ID->query("update tb_categoria set 
        nombre='".$obj->getNombre()."', descripcion='".$obj->getDescripcion()."' where id_categoria='".$obj->getId_cat()."'");

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

    function eliminar($id){
        $this->Conexion_ID->autocommit(false);
        $result=$this->Conexion_ID->query("delete from tb_categoria where id_categoria='".$id."'");

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
    
    function consultaIndividual($id){
        if ($id=="") {
            # code...
        $this->Error="No ha especificado una consulta SQL";
            return 0;
        }

        $result=$this->Conexion_ID->query("SELECT *FROM tb_categoria where id_categoria='$id'");

        $ObjE=null;

        if ($result) {
            # code...
            while ($fila=$result->fetch_object()) {
                # code...
                $ObjE=new ClaseCategoria($fila->id_categoria,$fila->nombre,$fila->descripcion);
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

    
}

?>