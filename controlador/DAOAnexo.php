<?php
require_once ("../conexion/DB_mysql2.php");
require_once ("../modelo/ClaseAnexo.php");
class DAOAnexo{
    var $Conexion_ID;
    var $Errno=0;
    var $Error="";

    function __construct(){
    $this->Conexion_ID=new DB_mysql2();
    $this->Conexion_ID=$this->Conexion_ID->getConexion();

    }

    function consultaAnexos(){
       # if ($sql=="") {
            # code...
       # $this->Error="No ha especificado una consulta";
      #      return 0;
       # }
        $result=$this->Conexion_ID->query("SELECT *from `tb_anexos` ");
        $lista=array();


        if ($result) {
            # code...
            while ($fila=$result->fetch_object()) {
                # code...

                $lista[]=new ClaseAnexo($fila->id_anexo,$fila->n_acta,$fila->n_folio,$fila->nombre_alcalde, 
                    $fila->nombre_secretario,$fila->particula,$fila->regimen_patrimonial,$fila->fecha_matimonio, 
                    $fila->contrayente_uno,$fila->contrayente_dos,$fila->testigo_uno,$fila->testigo_dos);
            }
        }
        if (!$result) {
            # code...
            $this->Errno=mysqli_connect_errno();
            $this->Error=mysqli_connect_error();
        }
        return $lista;
    }

    function consultaIndividualporDui($id){
        if ($id=="") {
            # code...
        $this->Error="No ha especificado una consulta SQL";
            return 0;
        }

        $result=$this->Conexion_ID->query("SELECT *FROM tb_anexos where contrayente_uno='$id'");

        $ObjE=null;

        if ($result) {
            # code...
            while ($fila=$result->fetch_object()) {
                # code...
                $ObjE=new ClaseAnexo($fila->id_anexo,$fila->n_acta,$fila->n_folio,$fila->nombre_alcalde, 
                    $fila->nombre_secretario,$fila->particula,$fila->regimen_patrimonial,$fila->fecha_matimonio, 
                    $fila->contrayente_uno,$fila->contrayente_dos,$fila->testigo_uno,$fila->testigo_dos);
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


    function eliminarAnexo($id){
        if ($id=="") {
            # code...
        $this->Error="No ha especificado una consulta SQL";
            return 0;
        }

        $result=$this->Conexion_ID->query("SELECT *FROM tb_anexos where id_anexo='$id'");

        $ObjE=null;

        if ($result) {
            # code...
            while ($fila=$result->fetch_object()) {
                # code...
                $ObjE=new ClaseAnexo($fila->id_anexo,$fila->n_acta,$fila->n_folio,$fila->nombre_alcalde, 
                    $fila->nombre_secretario,$fila->particula,$fila->regimen_patrimonial,$fila->fecha_matimonio, 
                    $fila->contrayente_uno,$fila->contrayente_dos,$fila->testigo_uno,$fila->testigo_dos);
            }
        }



        $this->Conexion_ID->autocommit(false);
        $result=$this->Conexion_ID->query("delete from tb_anexos where id_anexo='".$id."'");

        $result=$this->Conexion_ID->query("delete from tb_contrayente where dui_persona='".$ObjE->getContrayente1()."'");
        $result=$this->Conexion_ID->query("delete from tb_contrayente where dui_persona='".$ObjE->getContrayente2()."'");
        $result=$this->Conexion_ID->query("delete from tb_testigo where dui_testigo='".$ObjE->getTestigo1()."'");
        $result=$this->Conexion_ID->query("delete from tb_testigo where dui_testigo='".$ObjE->getTestigo2()."'");
        

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


     function insertarAnexo(ClaseAnexo $obj){
        if (!($obj instanceof ClaseAnexo)) {
            # code...
            $this->Error="Error de instaciado";
            return 0;
        }


        $this->Conexion_ID->autocommit(false);
        $result=$this->Conexion_ID->query("insert into tb_anexos values ('".$obj->getId_anexo()."',".$obj->getN_Acta().",".$obj->getN_Folio().",'".$obj->getNombre_alcalde()."','".$obj->getNombre_secretario()."','".$obj->getParticula()."','".$obj->getRegimen()."','".$obj->getFecha_matrimonio()."','".$obj->getContrayente1()."','".$obj->getContrayente2()."','".$obj->getTestigo1()."','".$obj->getTestigo2()."')");

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