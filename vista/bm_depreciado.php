<?php

    if (isset($_REQUEST['id'])) {/* comprobamos si la variable que viene en la url si existe */
        # code...
        require ("../controlador/DAOTipoBien.php");
        require ("../controlador/DAOComprobante.php");
        require ("../controlador/DAODepreciacion.php");
        $daoDe=new DAODepreciacion();
        $daoE=new DAOTipoBien();
        $daoCo=new DAOComprobante();
        $id=base64_decode($_REQUEST['id']);
        $objE=null;
        $objCo=null;
        $objDe=null;
        $objE=$daoE->consultaIndividual($id);
        $objDe= $daoDe->consultaIndividualD($objE->getTdepreciacion());
        $objCo=$daoCo->consultaIndividualporBienMueble($id);
        /*value="<?php echo $idespecifico = ($idespecifico=='') ? '' : $idespecifico ; ?>" para los inputs*/
    }
    
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Villa el Carmen | Bien Mueble</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link href="assets/sweetalert/sweetalert.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   <script language="javascript">
    function validacion() {
        if (document.getElementById('codigo').value == "" 
          || document.getElementById('articulo').value == ""
          || document.getElementById('marca').value == ""
          || document.getElementById('modelo').value == ""
          || document.getElementById('color').value == ""
          || document.getElementById('responsable').value == ""
          || document.getElementById('estado').value == "0"
          || document.getElementById('unidad').value == "0"
          || document.getElementById('division_bm').value == "0"
          || document.getElementById('depreciacion').value == "0"
          || document.getElementById('costo').value == ""
          || document.getElementById('proveedor').value == "") {
            //alert("Complete los campos antes de guardar");
            mostrarMensaje("SysVM", "Complete los campos antes de guardar", "error","bien_mueble.php",1000);
        }else{
            if (document.getElementById('baccion').value!="") {
                document.getElementById('bandera').value="edicion";
            } else {
                document.getElementById('bandera').value = "add";
            }
            document.asociaciones.submit();
        }
    }

    function regresar(id) {
        location.href = "tabla_bienes_muebles.php";
    }

    function mostrarMensaje(titulo, texto, tipo, pagina,tiempo) {
        swal(titulo, texto, tipo,pagina,tiempo);
        if (tipo!="error") {
            setTimeout("location.href='"+pagina+"'",tiempo);
        }
    }
    /*
     *función para limpiar los campos del formulario
     */
    function limpiar(){
        $('#codigo').val('');
        $('#marca').val('');
        $('#modelo').val('');
        $('#color').val('');
        $('#responsable').val('');
        $('#costo').val('');
        $('#proveedor').val('');
        $('#carnet').val('');
        location.href="general.php";
    }

    function onLoadImage(files){
  console.log(files)
  if (files && files[0]) {
    document
      .getElementById('imgName')
      .innerHTML = files[0].name
  }
}
    </script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php include("../layouts/toolbar.php"); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php 
  require_once ("aside.php");
   ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cálculo de depreciación de bien mueble</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"></a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title" > Activo a depreciar</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post" class="form-group" enctype="multipart/form-data" id="asociaciones" name="asociaciones">
                <input type="hidden" name="bandera" id="bandera">
                    <input type="hidden" name="baccion" id="baccion" value="<?php if(isset($objE)) echo $objE->getCodigo(); ?>">
                <section class="content">
      <div class="container-fluid">
                <div class="row">

                    <div class="col-1"></div>
                    <div class="col-md-3">
                    <label>Codigo</label>
                    <input type="text" min="12" max="12" class="form-control"  id="codigo" name="codigo" placeholder="0000-0000-0000" 
                    <?php
                            if (isset($objE)) {
                  echo "readonly='readonly' ";
                  }
                  ?>
                    value="<?php if(isset($objE)) echo $objE->getCodigo(); ?>">
                  </div>


                   <div class="col-md-3">
                    <label for="exampleInputPassword1">Cuenta contable de depreciacion</label>
                    <input type="text" class="form-control" id="responsable" name="responsable" placeholder="Tony Sánchez"
                    value="<?php if(isset($objE)) echo $objDe->getNombre_bien(); ?>">
                  </div>

                  <div class="col-md-2">
                    <label for="exampleInputPassword1">Factor Anual</label>
                    <input type="text" class="form-control" id="responsable" name="responsable" placeholder="0.25"
                    value="<?php if(isset($objE)) echo $objDe->getFactor_anual(); ?>">
                  </div>

                  <div class="col-md-2">
                    <label for="">Valor Presente</label>
                    <input type="text" class="form-control" id="valor_presente" name="valor_presente" placeholder="$500.69"
                    value="<?php if(isset($objE)){

                      $originalDate = $objE->getFecha_aquisicion(); 
                      //original date is in format YYYY-mm-dd
                      $DateTime = DateTime::createFromFormat('Y-m-d', $originalDate);
                      $newDate = $DateTime->format('Y');

                      $originalDat = $objE->getFecha_aquisicion(); 
                      //original date is in format YYYY-mm-dd
                      $DateTim = DateTime::createFromFormat('Y-m-d', $originalDat);
                      $newDat = $DateTim->format('z');


                      $fecha_depreciada=date('d-m-Y',strtotime($objE->getFecha_aquisicion().'+ '.intval($objDe->getPlazo_anual()).' years'));
                      $fecha_depreciada2=date('Y-m-d',strtotime($objE->getFecha_aquisicion().'+ '.intval($objDe->getPlazo_anual()).' years'));

                      if(date('Y-m-d')<=$fecha_depreciada2){
                        $valor_depreciacion_diaria=((($objE->getCosto()-($objE->getCosto()*0.1))/$objDe->getPlazo_anual())/365);
                        $valor_depreciacion_anual=(($objE->getCosto()-($objE->getCosto()*0.1))/$objDe->getPlazo_anual());
                        $valor_del_anio_compra=($valor_depreciacion_diaria*(365-intval($newDat)));
                        $anios_restantes=$objDe->getPlazo_anual()-2;

                        if(intval(date('Y'))==intval($newDate)){
                            $valor_press=(((intval(date("z")))-$newDat)*$valor_depreciacion_diaria);
                          echo "$ ".number_format(($objE->getCosto()-$valor_press),2);
                          }else if((intval(date("Y")==$newDate+1))){
                        $valor_press=$valor_del_anio_compra+((intval(date("z")))*$valor_depreciacion_diaria);
                          echo "$ ".number_format(($objE->getCosto()-$valor_press),2);
                      }else {
                        $valor_press=$valor_del_anio_compra+((intval(date("z"))-1)*$valor_depreciacion_diaria)+((intval(date("Y"))-($newDate+1))*$valor_depreciacion_anual);
                        echo "$ ".number_format(($objE->getCosto()-$valor_press),2);
                      }
                      }else{
                        echo "100% Depreciado";
                      }

                      

                    }

                   ?>">
                  </div>


                  <div class="col-1"></div>
                  <div class="col-1"></div>
                  <div class="col-3">
                    <label>Costo en Dolares</label>
                    <input type="text" min="1" max="999999"  class="form-control" id="costo" name="costo" placeholder="$900.00"
                    value="<?php if(isset($objE)) echo '$ '.number_format($objE->getCosto(),2); ?>">
                  </div>

                  <div class="col-md-3">
                    <label>Año de Adquisicion</label>
                    <input type="text" class="form-control" id="fecha" name="fecha" placeholder="dd/mm/aaaa"
                    value="<?php if(isset($objE)){

                      $originalDate = $objE->getFecha_aquisicion(); 
                      //original date is in format YYYY-mm-dd
                      $DateTime = DateTime::createFromFormat('Y-m-d', $originalDate);
                      $newDate = $DateTime->format('Y');
                      echo "".intval($newDate);

                    }

                   ?>">
                    
                  </div>

                    <div class="col-md-4">
                    <label for="exampleInputPassword1">Proveedor</label>
                    <input type="text" class="form-control" id="proveedor" name="proveedor" placeholder="Industrias La Nueva Era"
                    value="<?php if(isset($objE)) setlocale(LC_ALL,'es_ES'); echo $objE->getProveedor(); ?>">
                  </div>

                  <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th style='text-align: center'>Años</th>
                  <th style='text-align: center'>Año de compra</th>
                  <th style='text-align: center'>Gasto depreciacion</th>
                  <th style='text-align: center'>Dep. acumulada</th>
                  <th style='text-align: center'>Valor en libros</th>
                </tr>
                </thead>
                <tbody>
               
                <?php
                 $contador=0;

               /*   echo "<td style='text-align: center'>0</td>";
                  echo "<td style='text-align: center'></td>";
                  echo "<td style='text-align: center'></td>";
                  echo "<td style='text-align: center'></td>";
                  echo "<td style='text-align: center'>".$objE->getCosto()."</td>";
                  */

                 for ($i = 1; $i <= $objDe->getPlazo_anual(); $i++) {
                    $originalDate = $objE->getFecha_aquisicion(); 
                      //original date is in format YYYY-mm-dd
                      $DateTime = DateTime::createFromFormat('Y-m-d', $originalDate);
                      $newDate = $DateTime->format('Y');
                      $anual=(($objE->getCosto()-($objE->getCosto()*0.1))/$objDe->getPlazo_anual());
                     echo "<tr>";
                         echo "<td style='text-align: center'>".($contador+1)."</td>";
                         echo "<td style='text-align: center'>".intval($newDate)+($contador)."</td>";
                         echo "<td style='text-align: center'>".'$ '.number_format($anual,2)."</td>";
                         echo "<td style='text-align: center'>".'$ '.number_format(($anual*($contador+1)),2)."</td>";
                         echo "<td style='text-align: center'>".'$ '.number_format(($objE->getCosto()-($anual*($contador+1))),2)."</td>";
                   echo "</tr>";
                 $contador++;
               }

           ?>
                </tbody>
                <tfoot>
                <tr>
                  <th style='text-align: center'>Años</th>
                  <th style='text-align: center'>Año de compra</th>
                  <th style='text-align: center'>Gasto depreciacion</th>
                  <th style='text-align: center'>Dep. acumulada</th>
                  <th style='text-align: center'>Valor en libros</th>
                </tr>
                </tfoot>
              </table>

                  
                   
                </div>
              </div>
            </section>
                <!-- /.card-body -->

                <div class="card-footer" style="width: 50%; margin-left: 65%; transform: translateX(-80%);">
                  <button type="button" style="background-color:#007bff; border-color:white; color:white; width: 100%;" class="btn btn-success swalDefaultSuccess" onclick="regresar()">Regresar</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            <!-- /.card -->

            <!-- Input addon -->
          <!--/.col (left) -->
          <!-- right column -->

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php 
  require_once ("../layouts/footer.php");
   ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>


<script src="assets/sweetalert/sweetalert.min.js"></script>
</body>
</html>
<?php

    $baccion=(isset($_REQUEST["baccion"]))?$_REQUEST["baccion"]:"";
    $bandera=(isset($_REQUEST["bandera"]))?$_REQUEST["bandera"]:"";   
    $codigo=(isset($_REQUEST["codigo"]))?$_REQUEST["codigo"]:"";
    $articulo=(isset($_REQUEST["articulo"]))?$_REQUEST["articulo"]:"";
    $marca=(isset($_REQUEST["marca"]))?$_REQUEST["marca"]:"";
    $modelo=(isset($_REQUEST["modelo"]))?$_REQUEST["modelo"]:"";   
    $color=(isset($_REQUEST["color"]))?$_REQUEST["color"]:"";
    $fecha=(isset($_REQUEST["fecha"]))?$_REQUEST["fecha"]:"";
    $responsable=(isset($_REQUEST["responsable"]))?$_REQUEST["responsable"]:"";
    $estado=(isset($_REQUEST["estado"]))?$_REQUEST["estado"]:"";
    $unidad=(isset($_REQUEST["unidad"]))?$_REQUEST["unidad"]:"";
    $division_bm=(isset($_REQUEST["division_bm"]))?$_REQUEST["division_bm"]:"";
    $depreciacion=(isset($_REQUEST["depreciacion"]))?$_REQUEST["depreciacion"]:"";   
    $costo=(isset($_REQUEST["costo"]))?$_REQUEST["costo"]:"";
    $proveedor=(isset($_REQUEST["proveedor"]))?$_REQUEST["proveedor"]:"";
    $titulo=(isset($_REQUEST["titulo"]))?$_REQUEST["titulo"]:"";


    if($bandera=="add"){
        require_once "../controlador/DAOTipoBien.php";  
        $daoE=new DAOTipoBien();
        require_once "../controlador/DAOComprobante.php";  
      $daoC=new DAOComprobante();

      if($_FILES['archivo']['size'] > 0 ){
      if(($_FILES['archivo']['type']=='application/pdf') && ($_FILES['archivo']['size'] < 10000000 )){
      if(!file_exists('archivo')){
        mkdir('archivos');
        move_uploaded_file($_FILES['archivo']['tmp_name'], "archivos/".$_FILES['archivo']['name']);
      }else{
        move_uploaded_file($_FILES['archivo']['tmp_name'], "archivos/".$_FILES['archivo']['name']);  
      }

      $nombre= $_FILES['archivo']['name'];
      $tipo= $_FILES['archivo']['type'];
      $tamanio= $_FILES['archivo']['size'];



        if ($daoE-> insertar(new ClaseTipoBien($codigo,$articulo,$marca,$modelo,$color,$estado,$responsable,$unidad,$fecha,$division_bm,$depreciacion,$costo,$proveedor))==1 &&
          $daoC-> insertar(new ClaseComprobante(null,$codigo,$titulo,$tamanio,$tipo,$nombre))==1 ) {   
            msg("Sys-Inventario VEC", "Datos almacenados (- o)", "success","tabla_bienes_muebles.php",1000);
        } else {
            msg("Sys-Inventario VEC", "Error de guardado!", "danger","bien_mueble.php",1000);
        }
    }else{

      msg("Debe ser formato PDF o excedio tamaño 10Mb", "Sys-Inventario VEC", "error","bien_mueble.php",1000);
    }

  }else{
    if ($daoE-> insertar(new ClaseTipoBien($codigo,$articulo,$marca,$modelo,$color,$estado,$responsable,$unidad,$fecha,$division_bm,$depreciacion,$costo,$proveedor))==1) {   
            msg("Sys-Inventario VEC", "Datos almacenados (- o)", "success","tabla_bienes_muebles.php",1000);
        } else {
            msg("Sys-Inventario VEC", "Error de guardado!", "danger","bien_mueble.php",1000);
        }
  }

  }else if($bandera=="edicion"){
        require_once "../controlador/DAOTipoBien.php";  
        $daoE=new DAOTipoBien();
        require_once "../controlador/DAOComprobante.php";  
      $daoC=new DAOComprobante();

      if($_FILES['archivo']['size'] > 0 ){
      if(!file_exists('archivo')){
        mkdir('archivos');
        move_uploaded_file($_FILES['archivo']['tmp_name'], "archivos/".$_FILES['archivo']['name']);
      }else{
        move_uploaded_file($_FILES['archivo']['tmp_name'], "archivos/".$_FILES['archivo']['name']);  
      }

      $nombre= $_FILES['archivo']['name'];
      $tipo= $_FILES['archivo']['type'];
      $tamanio= $_FILES['archivo']['size'];

        if ($daoE-> actualizar(new ClaseTipoBien($baccion,$articulo,$marca,$modelo,$color,$estado,$responsable,$unidad,$fecha,$division_bm,$depreciacion,$costo,$proveedor))==1 &&
          $daoC-> actualizarComprobante(new ClaseComprobante($codigo,$codigo,$titulo,$tamanio,$tipo,$nombre))==1 ) {   
            msg("Sys-Inventario VEC", "Datos almacenados (- o)", "success","tabla_bienes_muebles.php",1000);
        } else {
            msg("Sys-Inventario VEC", "Error de guardado!", "danger","bien_mueble.php",1000);
        }
}else{

      if ($daoE-> actualizar(new ClaseTipoBien($baccion,$articulo,$marca,$modelo,$color,$estado,$responsable,$unidad,$fecha,$division_bm,$depreciacion,$costo,$proveedor))==1 ) {   
            msg("Sys-Inventario VEC", "Datos almacenados (- o)", "success","tabla_bienes_muebles.php",1000);
        } else {
            msg("Sys-Inventario VEC", "Error de guardado!", "danger","bien_mueble.php",1000);
        }
    }

}

    function msg($titulo, $texto, $tipo,$pagina,$tiempo)
    {
        echo "<script type='text/javascript'>";
        echo "mostrarMensaje('$titulo','$texto','$tipo','$pagina','$tiempo');";
        echo "</script>";
    }
?>