<?php

    if (isset($_REQUEST['id'])) {/* comprobamos si la variable que viene en la url si existe */
        # code...
        require ("../controlador/DAODepreciacion.php");
        $daoE=new DAODepreciacion();
        $id=base64_decode($_REQUEST['id']);
        $objE=null;
        $objE=$daoE->consultaIndividualD($id);
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
          || document.getElementById('nombre').value == ""
          || document.getElementById('factor').value == ""
          || document.getElementById('plazo').value == "") {
            //alert("Complete los campos antes de guardar");
            mostrarMensaje("SysVM", "Complete los campos antes de guardar", "error","depreciacion.php",1000);
        }else{
            if (document.getElementById('baccion').value!="") {
                document.getElementById('bandera').value="edicion";
            } else {
                document.getElementById('bandera').value = "add";
            }
            document.asociaciones.submit();
        }
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
        $('#nombre').val('');
        $('#factor').val('');
        $('#plazo').val('');
        location.href="depreciacion.php";
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
            <h1>Insercion de Tipos de Depreciacion</h1>
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
                <h3 class="card-title">Cuadro de insercion</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post" class="form-group" id="asociaciones" name="asociaciones">
                <input type="hidden" name="bandera" id="bandera">
                    <input type="hidden" name="baccion" id="baccion" value="<?php if(isset($objE)) echo $objE->getId_depreciacion(); ?>">
                <section class="content">
                <div class="container-fluid">
                <div class="row">

                    <div class="col-1"></div>
                    <div class="col-md-5">
                    <label>Codigo</label>
                    <input type="text"  maxlength="12" class="form-control"  id="codigo" name="codigo" placeholder="ABCDFG" 
                    <?php
                            if (isset($objE)) {
                  echo "readonly='readonly' ";
                  }
                  ?>
                    value="<?php if(isset($objE)) echo $objE->getId_depreciacion(); ?>">
                  </div>

                    <div class="col-md-5">
                    <label for="exampleInputPassword1">Bienes</label>
                    <input type="text" class="form-control" maxlength="45" id="nombre" name="nombre" placeholder="Maquinaria de Producción"
                    value="<?php if(isset($objE)) echo $objE->getNombre_bien(); ?>">
                  </div>
                  <div class="col-1"></div>

                  <div class="col-1"></div>
                  <div class="col-md-5">
                    <label for="exampleInputPassword1">Factor Anual</label>
                    <input type="number" class="form-control" id="factor" name="factor" placeholder="0.25,0.3,0.015"
                    value="<?php if(isset($objE)) echo $objE->getFactor_anual(); ?>">
                  </div>
                  <div class="col-md-5">
                    <label for="exampleInputPassword1">Plazo Anual</label>
                    <input type="number" class="form-control" id="plazo" name="plazo" placeholder="1,7,9"
                    value="<?php if(isset($objE)) echo $objE->getPlazo_anual(); ?>">
                  </div>                            
                            
                   
                </div>
                </div>
              </section>

                <!-- /.card-body -->

                <div class="card-footer" style="width: 50%; margin-left: 50%; transform: translateX(-50%);">
                  <button type="button" style="background-color:#007bff; border-color:white; color:white; width: 48%;" class="btn btn-success swalDefaultSuccess" onclick="validacion()"><?php if(isset($id)) echo "Editar"; else echo "Guardar";?></button>
                                                <button type="button" class="btn btn-warning" style="width: 48%;" 
                                                onclick="limpiar()">Cancelar</button>
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
    $nombre=(isset($_REQUEST["nombre"]))?$_REQUEST["nombre"]:"";
    $factor=(isset($_REQUEST["factor"]))?$_REQUEST["factor"]:"";
    $plazo=(isset($_REQUEST["plazo"]))?$_REQUEST["plazo"]:"";   


    if($bandera=="add"){
        require_once "../controlador/DAODepreciacion.php";  
        $daoE=new DAODepreciacion();
        if ($daoE-> insertarD(new ClaseDepreciacion($codigo,$nombre,$factor,$plazo))==1) {   
            msg("Sys-Inventario VEC", "Datos almacenados (- o)", "success","tabla_unidades.php",1000);
        } else {
            msg("Sys-Inventario VEC", "Error de guardado!", "danger","depreciacion.php",1000);
        }
    }else if($bandera=="edicion"){
        require_once "../controlador/DAODepreciacion.php"; 
        $daoE=new DAODepreciacion();
       if ($daoE->actualizar(new ClaseDepreciacion($baccion,$nombre,$factor,$plazo))==1) {
            # code...
            msg("Sys-Inventario VEC", "Datos actualizados (- o)", "success","tabla_unidades.php",1000);
        } else {
            # code...
            msg("Sys-Inventario VEC", "Error de actualización!", "danger","depreciacion.php",1000);
        }
        
    }

    function msg($titulo, $texto, $tipo,$pagina,$tiempo)
    {
        echo "<script type='text/javascript'>";
        echo "mostrarMensaje('$titulo','$texto','$tipo','$pagina','$tiempo');";
        echo "</script>";
    }
?>