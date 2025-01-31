<?php 
require_once ("../conexion/DB_mysql.php");
require_once ("../modelo/ClaseProducto.php");
class DAOProducto{
    var $Conexion_ID;
    var $Errno=0;
    var $Error="";

    function __construct(){
    $this->Conexion_ID=new DB_mysql();
    $this->Conexion_ID=$this->Conexion_ID->getConexion();

    }

     function consultaIndividual($codigo){
        if ($codigo=="") {
            # code...
        $this->Error="No ha especificado una consulta SQL";
            return 0;
        }

        $result=$this->Conexion_ID->query("SELECT *FROM tb_producto where id_producto='$codigo'"); 

        $ObjP=null;

        if ($result) {
            # code...
            while ($fila=$result->fetch_object()) {
                # code...
                $ObjP=new ClaseProducto(
                    $fila->id_producto,
                    $fila->codigo,
                    $fila->estilo,
                    $fila->nombre,
                    $fila->marca,
                    $fila->color,
                    $fila->tallas,
                    $fila->descripcion,
                    $fila->costo,
                    $fila->cantidad_gan,
                    $fila->categoria_idcat,
                    $fila->proveedor,
                    $fila->stock_minimo
                );
            }
        }
        ///////////////////////////
        if (!$result) {
            # code...
            $this->Errno=mysqli_connect_errno();
            $this->Error=mysqli_connect_error();
        }
        return $ObjP;
    }

    function consultaProd(){
       # if ($sql=="") {
            # code...
       # $this->Error="No ha especificado una consulta";
      #      return 0;
       # }

        $result=$this->Conexion_ID->query("SELECT *from `tb_producto` where stock_minimo=1;");
        $lista=array();

        if ($result) {
            # code...
            while ($fila=$result->fetch_object()) {
                # code...

                $lista[]=new ClaseProducto(
                     $fila->id_producto,
                    $fila->codigo,
                    $fila->estilo,
                    $fila->nombre,
                    $fila->marca,
                    $fila->color,
                    $fila->tallas,
                    $fila->descripcion,
                    $fila->costo,
                    $fila->cantidad_gan,
                    $fila->categoria_idcat,
                    $fila->proveedor,
                    $fila->stock_minimo
                );
            }
        }
        if (!$result) {
            # code...
            $this->Errno=mysqli_connect_errno();
            $this->Error=mysqli_connect_error();
        }
        return $lista;
    }

     function consultaProdReservados(){
       # if ($sql=="") {
            # code...
       # $this->Error="No ha especificado una consulta";
      #      return 0;
       # }

        $result=$this->Conexion_ID->query("SELECT *from `tb_producto`where stock_minimo=2;");
        $lista=array();

        if ($result) {
            # code...
            while ($fila=$result->fetch_object()) {
                # code...

                $lista[]=new ClaseProducto(
                     $fila->id_producto,
                    $fila->codigo,
                    $fila->estilo,
                    $fila->nombre,
                    $fila->marca,
                    $fila->color,
                    $fila->tallas,
                    $fila->descripcion,
                    $fila->costo,
                    $fila->cantidad_gan,
                    $fila->categoria_idcat,
                    $fila->proveedor,
                    $fila->stock_minimo
                );
            }
        }
        if (!$result) {
            # code...
            $this->Errno=mysqli_connect_errno();
            $this->Error=mysqli_connect_error();
        }
        return $lista;
    }

    function consultaIndividuales($codigo){
       # if ($sql=="") {
            # code...
       # $this->Error="No ha especificado una consulta";
      #      return 0;
       # }

        $result=$this->Conexion_ID->query("SELECT *from `tb_producto` where id_producto IN ($codigo); ");
        $lista=array();

        if ($result) {
            # code...
            while ($fila=$result->fetch_object()) {
                # code...

                $lista[]=new ClaseProducto(
                     $fila->id_producto,
                    $fila->codigo,
                    $fila->estilo,
                    $fila->nombre,
                    $fila->marca,
                    $fila->color,
                    $fila->tallas,
                    $fila->descripcion,
                    $fila->costo,
                    $fila->cantidad_gan,
                    $fila->categoria_idcat,
                    $fila->proveedor,
                    $fila->stock_minimo
                );
            }
        }
        if (!$result) {
            # code...
            $this->Errno=mysqli_connect_errno();
            $this->Error=mysqli_connect_error();
        }
        return $lista;
    }

    function consultaBMR(){
       # if ($sql=="") {
            # code...
       # $this->Error="No ha especificado una consulta";
      #      return 0;
       # }

        $result=$this->Conexion_ID->query("SELECT
                        tb_bien_mueble.id_bien_mueble,
                        tb_bien_mueble.articulo,
                        tb_bien_mueble.marca,
                        tb_bien_mueble.modelo,
                        tb_bien_mueble.color,
                        tb_bien_mueble.estado,
                        tb_bien_mueble.responsable,
                        tb_unidades.nombre_unidad as unidad_id,
                        DATE_FORMAT(tb_bien_mueble.fecha_adquisicion,'%d-%m-%Y') as fecha,
                        tb_division_bienes.nombre_bien as division_bmueble_id,
                        tb_bien_mueble.cuenta_depreciacion_id,
                        tb_bien_mueble.costo,
                        tb_bien_mueble.proveedor
                        FROM
                        tb_bien_mueble
                        INNER JOIN tb_unidades ON tb_bien_mueble.unidad_id = tb_unidades.id_unidad
                        INNER JOIN tb_division_bienes ON tb_bien_mueble.division_bmueble_id = tb_division_bienes.id_division_bm");
        $lista=array();

        if ($result) {
            # code...
            while ($fila=$result->fetch_object()) {
                # code...

                $lista[]=new ClaseTipoBien(
                    $fila->id_bien_mueble,
                    $fila->articulo,
                    $fila->marca,
                    $fila->modelo,
                    $fila->color,
                    $fila->estado,
                    $fila->responsable,
                    $fila->unidad_id,
                    $fila->fecha,
                    $fila->division_bmueble_id,
                    $fila->cuenta_depreciacion_id,
                    $fila->costo,
                    $fila->proveedor

                );
            }
        }
        if (!$result) {
            # code...
            $this->Errno=mysqli_connect_errno();
            $this->Error=mysqli_connect_error();
        }
        return $lista;
    }

    function insertar(ClaseProducto $obj){
        if (!($obj instanceof ClaseProducto)) {
            # code...
            $this->Error="Error de instaciado";
            return 0;
        }

        $this->Conexion_ID->autocommit(false);
        $result=$this->Conexion_ID->query("insert into tb_producto values (NULL,'".$obj->getCodigo()."','".$obj->getEstilo()."','".$obj->getNombre()."','".$obj->getMarca()."','".$obj->getColor()."','".$obj->getTallas()."','".$obj->getDescripcion()."','".$obj->getCosto()."','".$obj->getCantidad_gan()."','".$obj->getId_cat()."','".$obj->getProveedor()."','".$obj->getStock_min()."')");

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
        $result=$this->Conexion_ID->query("delete from tb_producto where id_producto='".$id."'");

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

    function actualizarDisponible($id){
        $this->Conexion_ID->autocommit(false);
        $result=$this->Conexion_ID->query("update tb_producto set stock_minimo=1 where id_producto='".$id."'");

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

    function actualizarReservado($id){
        $this->Conexion_ID->autocommit(false);
        $result=$this->Conexion_ID->query("update tb_producto set stock_minimo=2 where id_producto='".$id."'");

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

    function actualizarVendido($id){
        $this->Conexion_ID->autocommit(false);
        $result=$this->Conexion_ID->query("update tb_producto set stock_minimo=0 where id_producto IN (".$id.")");

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

     function actualizar(ClaseProducto $obj){
        if (!($obj instanceof ClaseProducto)) {
            # code...
            $this->Error="Error de instaciado";
            return 0;
        }
        $this->Conexion_ID->autocommit(false);
        $result=$this->Conexion_ID->query("update tb_producto set 
        codigo='".$obj->getCodigo()."',
        estilo='".$obj->getEstilo()."',
        nombre='".$obj->getNombre()."',
        marca='".$obj->getMarca()."',
        color='".$obj->getColor()."',
        tallas='".$obj->getTallas()."',
        descripcion='".$obj->getDescripcion()."', 
        costo='".$obj->getCosto()."',
        cantidad_gan='".$obj->getCantidad_gan()."',
        categoria_idcat='".$obj->getId_cat()."',
        proveedor='".$obj->getProveedor()."',
        stock_minimo='".$obj->getStock_min()."'
        where id_producto='".$obj->getId_prod()."'");

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

    function consultaUltimoproducto(){

        $result=$this->Conexion_ID->query("SELECT MAX(id_producto) AS id FROM tb_producto");

        if (!$result) {
            # code...
            $this->Errno=mysqli_connect_errno();
            $this->Error=mysqli_connect_error();
        }
        return ($result->fetch_object())->id;
    }

}


 ?>