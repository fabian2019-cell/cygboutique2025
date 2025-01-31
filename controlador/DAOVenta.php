<?php
require_once ("../conexion/DB_mysql.php");
require_once ("../modelo/ClaseVenta.php");
require_once("../conexion/Modelo_generico.php");


class DAOVenta{
    var $Conexion_ID;
    var $Errno=0;
    var $Error="";

    function __construct(){
    $this->Conexion_ID=new DB_mysql();
    $this->Conexion_ID=$this->Conexion_ID->getConexion();

    }

    function consultaVentas(){
       # if ($sql=="") {
            # code...
       # $this->Error="No ha especificado una consulta";
      #      return 0;
       # }
        $result=$this->Conexion_ID->query("SELECT *from tb_venta ORDER by id_venta ASC");
        $lista=array();


        if ($result) {
            # code...
            while ($fila=$result->fetch_object()) {
                # code...

                $lista[]=new ClaseVenta($fila->id_venta,$fila->fecha_venta,$fila->cliente,$fila->empleado,$fila->total_venta);
            }
        }
        if (!$result) {
            # code...
            $this->Errno=mysqli_connect_errno();
            $this->Error=mysqli_connect_error();
        }
        return $lista;
    }

    function consultaVentasesteanio(){
       # if ($sql=="") {
            # code...
       # $this->Error="No ha especificado una consulta";
      #      return 0;
       # }
        $result=$this->Conexion_ID->query("SELECT *from tb_venta where YEAR(tb_venta.fecha_venta)=YEAR(CURDATE());");
        $lista=array();


        if ($result) {
            # code...
            while ($fila=$result->fetch_object()) {
                # code...

                $lista[]=new ClaseVenta($fila->id_venta,$fila->fecha_venta,$fila->cliente,$fila->empleado,$fila->total_venta);
            }
        }
        if (!$result) {
            # code...
            $this->Errno=mysqli_connect_errno();
            $this->Error=mysqli_connect_error();
        }
        return $lista;
    }

    function consultaVentasestemes(){
       # if ($sql=="") {
            # code...
       # $this->Error="No ha especificado una consulta";
      #      return 0;
       # }
        $result=$this->Conexion_ID->query("SELECT *from tb_venta where MONTH(tb_venta.fecha_venta)=MONTH(CURDATE());");
        $lista=array();


        if ($result) {
            # code...
            while ($fila=$result->fetch_object()) {
                # code...

                $lista[]=new ClaseVenta($fila->id_venta,$fila->fecha_venta,$fila->cliente,$fila->empleado,$fila->total_venta);
            }
        }
        if (!$result) {
            # code...
            $this->Errno=mysqli_connect_errno();
            $this->Error=mysqli_connect_error();
        }
        return $lista;
    }



    function consultaIndividualVenta($id){
        if ($id=="") {
            # code...
        $this->Error="No ha especificado una consulta SQL";
            return 0;
        }

        $result=$this->Conexion_ID->query("SELECT *FROM tb_venta where id_venta='$id'");

        $ObjE=null;

        if ($result) {
            # code...dui_testigo
            while ($fila=$result->fetch_object()) {
                # code...
                $ObjE=new ClaseVenta($fila->id_venta,$fila->fecha_venta,$fila->cliente,$fila->empleado,$fila->total_venta);
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

    function eliminarVenta($id){
        $this->Conexion_ID->autocommit(false);
        $result=$this->Conexion_ID->query("delete from tb_venta where id_venta='".$id."'");

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

    function consultaUltimoEncabezado(){

        $result=$this->Conexion_ID->query("
SELECT MAX(id_venta) AS id FROM tb_venta");

        if (!$result) {
            # code...
            $this->Errno=mysqli_connect_errno();
            $this->Error=mysqli_connect_error();
        }
        return ($result->fetch_object())->id;
    }


     function insertarVenta(ClaseVenta $obj){
        if (!($obj instanceof ClaseVenta)) {
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
        $result=$this->Conexion_ID->query("insert into tb_venta values (NULL,'".$obj->getFecha_venta()."','".$obj->getCliente()."','".$obj->getEmpleado()."','".$obj->getTotal_venta()."')");

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

    function actualizarVenta(ClaseEmpleado $obj){
        if (!($obj instanceof ClaseEmpleado)) {
            # code...
            $this->Error="Error de instaciado";
            return 0;
        }

        $modelo = new Modelo_generico();
        $contra=null;
        //$contra=$modelo->encriptarlas_contrasenas(''.$obj->getContrasena());

        $this->Conexion_ID->autocommit(false);
        $result=$this->Conexion_ID->query("update tb_venta set 
        fecha_venta='".$obj->getNombres()."',
        cliente='".$obj->getApellidos()."',
        empleado='".$obj->getDireccion()."'
        where id_venta='".$obj->getId_venta()."'");

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

    function actualizarTotal($tot,$id){
        $this->Conexion_ID->autocommit(false);
        $result=$this->Conexion_ID->query("update tb_venta set total_venta=".$tot." where id_venta='".$id."'");

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