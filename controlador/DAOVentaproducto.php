<?php
require_once ("../conexion/DB_mysql.php");
require_once ("../modelo/ClaseVenta_producto.php");
require_once("../conexion/Modelo_generico.php");


class DAOVentaproducto{
    var $Conexion_ID;
    var $Errno=0;
    var $Error="";

    function __construct(){
    $this->Conexion_ID=new DB_mysql();
    $this->Conexion_ID=$this->Conexion_ID->getConexion();

    }

    function consultaVentasprod($id){
       # if ($sql=="") {
            # code...
       # $this->Error="No ha especificado una consulta";
      #      return 0;
       # }
        $result=$this->Conexion_ID->query("SELECT *from `tb_venta_producto` where idencabezado_v=$id");
        $lista=array();


        if ($result) {
            # code...
            while ($fila=$result->fetch_object()) {
                # code...

                $lista[]=new ClaseVenta_producto($fila->id,$fila->idencabezado_v,$fila->producto_idproducto,$fila->precio_venta,$fila->cantidad_des,$fila->cantidad,$fila->sub_total);
            }
        }
        if (!$result) {
            # code...
            $this->Errno=mysqli_connect_errno();
            $this->Error=mysqli_connect_error();
        }
        return $lista;
    }

    function consultaVentasprod1(){
       # if ($sql=="") {
            # code...
       # $this->Error="No ha especificado una consulta";
      #      return 0;
       # }
        $result=$this->Conexion_ID->query("SELECT
            tb_venta_producto.*
            FROM
            tb_venta_producto
            INNER JOIN
            tb_venta
            ON 
            tb_venta_producto.idencabezado_v = tb_venta.id_venta where DATE(tb_venta.fecha_venta)=CURDATE()");
        $lista=array();


        if ($result) {
            # code...
            while ($fila=$result->fetch_object()) {
                # code...

                $lista[]=new ClaseVenta_producto($fila->id,$fila->idencabezado_v,$fila->producto_idproducto,$fila->precio_venta,$fila->cantidad_des,$fila->cantidad,$fila->sub_total);
            }
        }
        if (!$result) {
            # code...
            $this->Errno=mysqli_connect_errno();
            $this->Error=mysqli_connect_error();
        }
        return $lista;
    }

    function consultaVentasUltimos(){
       # if ($sql=="") {
            # code...
       # $this->Error="No ha especificado una consulta";
      #      return 0;
       # }
        $result=$this->Conexion_ID->query("SELECT
            tb_venta_producto.*
            FROM
            tb_venta_producto
            INNER JOIN
            tb_venta
            ON tb_venta_producto.idencabezado_v = tb_venta.id_venta where DATE(tb_venta.fecha_venta) BETWEEN NOW() - INTERVAL 7 DAY AND NOW()");
        $lista=array();


        if ($result) {
            # code...
            while ($fila=$result->fetch_object()) {
                # code...

                $lista[]=new ClaseVenta_producto($fila->id,$fila->idencabezado_v,$fila->producto_idproducto,$fila->precio_venta,$fila->cantidad_des,$fila->cantidad,$fila->sub_total);
            }
        }
        if (!$result) {
            # code...
            $this->Errno=mysqli_connect_errno();
            $this->Error=mysqli_connect_error();
        }
        return $lista;
    }

    function consultaVentasUltimostreinta(){
       # if ($sql=="") {
            # code...
       # $this->Error="No ha especificado una consulta";
      #      return 0;
       # }
        $result=$this->Conexion_ID->query("SELECT
            tb_venta_producto.*
            FROM
            tb_venta_producto
            INNER JOIN
            tb_venta
            ON tb_venta_producto.idencabezado_v = tb_venta.id_venta where DATE(tb_venta.fecha_venta) BETWEEN NOW() - INTERVAL 30 DAY AND NOW()");
        $lista=array();


        if ($result) {
            # code...
            while ($fila=$result->fetch_object()) {
                # code...

                $lista[]=new ClaseVenta_producto($fila->id,$fila->idencabezado_v,$fila->producto_idproducto,$fila->precio_venta,$fila->cantidad_des,$fila->cantidad,$fila->sub_total);
            }
        }
        if (!$result) {
            # code...
            $this->Errno=mysqli_connect_errno();
            $this->Error=mysqli_connect_error();
        }
        return $lista;
    }

    function consultaVentas_esteanio(){
       # if ($sql=="") {
            # code...
       # $this->Error="No ha especificado una consulta";
      #      return 0;
       # }
        $result=$this->Conexion_ID->query("SELECT
            tb_venta_producto.*
            FROM
            tb_venta_producto
            INNER JOIN
            tb_venta
            ON 
            tb_venta_producto.idencabezado_v = tb_venta.id_venta where YEAR(tb_venta.fecha_venta)=YEAR(CURRENT_DATE)");
        $lista=array();


        if ($result) {
            # code...
            while ($fila=$result->fetch_object()) {
                # code...

                $lista[]=new ClaseVenta_producto($fila->id,$fila->idencabezado_v,$fila->producto_idproducto,$fila->precio_venta,$fila->cantidad_des,$fila->cantidad,$fila->sub_total);
            }
        }
        if (!$result) {
            # code...
            $this->Errno=mysqli_connect_errno();
            $this->Error=mysqli_connect_error();
        }
        return $lista;
    }



    function consultaVentasprodfecha($id){
     if ($id=="") {
            # code...
        $this->Error="No ha especificado una consulta SQL";
        return 0;
    }
    $result=$this->Conexion_ID->query("SELECT
        tb_venta_producto.*
        FROM
        tb_venta_producto
        INNER JOIN
        tb_venta
        ON 
        tb_venta_producto.idencabezado_v = tb_venta.id_venta where DATE(tb_venta.fecha_venta)='".$id."'");
    $lista=array();


    if ($result) {
            # code...
        while ($fila=$result->fetch_object()) {
                # code...

            $lista[]=new ClaseVenta_producto($fila->id,$fila->idencabezado_v,$fila->producto_idproducto,$fila->precio_venta,$fila->cantidad_des,$fila->cantidad,$fila->sub_total);
        }
    }
    if (!$result) {
            # code...
        $this->Errno=mysqli_connect_errno();
        $this->Error=mysqli_connect_error();
    }
    return $lista;
}

    function consultaVentasporempleado($id){
       if ($id=="") {
                # code...
        $this->Error="No ha especificado una consulta SQL";
        return 0;
    }
    $result=$this->Conexion_ID->query("SELECT   *FROM
        tb_venta_producto
        INNER JOIN
        tb_venta
        ON  tb_venta_producto.idencabezado_v = tb_venta.id_venta
        INNER JOIN
        tb_empleado 
        ON tb_venta.empleado = tb_empleado.id_empleado
        where tb_empleado.id_empleado='".$id."'");
    $lista=array();


    if ($result) {
                # code...
        while ($fila=$result->fetch_object()) {
                    # code...

            $lista[]=new ClaseVenta_producto($fila->id,$fila->idencabezado_v,$fila->producto_idproducto,$fila->precio_venta,$fila->cantidad_des,$fila->cantidad,$fila->sub_total);
        }
    }
    if (!$result) {
                # code...
        $this->Errno=mysqli_connect_errno();
        $this->Error=mysqli_connect_error();
    }
    return $lista;
    }



    function consultaIndividualVentaproducto($id){
        if ($id=="") {
            # code...
        $this->Error="No ha especificado una consulta SQL";
            return 0;
        }

        $result=$this->Conexion_ID->query("SELECT *FROM tb_venta_producto where id='$id'");

        $ObjE=null;

        if ($result) {
            # code...dui_testigo
            while ($fila=$result->fetch_object()) {
                # code...
                $ObjE=new ClaseVenta_producto($fila->id,$fila->idencabezado_v,$fila->producto_idproducto,$fila->precio_venta,$fila->cantidad_des,$fila->cantidad,$sub_total);
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

    function eliminarVentaproducto($id){
        $this->Conexion_ID->autocommit(false);
        $result=$this->Conexion_ID->query("delete from tb_venta_producto where id='".$id."'");

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



     function insertarVentaproducto(ClaseVenta_producto $obj){
        if (!($obj instanceof ClaseVenta_producto)) {
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
        $result=$this->Conexion_ID->query("insert into tb_venta_producto values (NULL,'".$obj->getId_venta()."','".$obj->getId_producto()."','".$obj->getPrecio_venta()."','".$obj->getCantidad_des()."','".$obj->getCantidad()."','".$obj->getSubtotal()."')");

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

    function actualizarVenta(ClaseVenta_producto $obj){
        if (!($obj instanceof ClaseVenta_producto)) {
            # code...
            $this->Error="Error de instaciado";
            return 0;
        }

        $modelo = new Modelo_generico();
        $contra=null;
        //$contra=$modelo->encriptarlas_contrasenas(''.$obj->getContrasena());

        $this->Conexion_ID->autocommit(false);
        $result=$this->Conexion_ID->query("update tb_venta_producto set 
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



}

?>