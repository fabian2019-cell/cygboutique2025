<?php

    if (isset($_REQUEST['id'])) {/* comprobamos si la variable que viene en la url si existe */
        # code...
        require ("../controlador/DAOAnexo.php");
        $daoA=new DAOAnexo();
        $id=base64_decode($_REQUEST['id']);
        $objA=null;
        $objA=$daoA->consultaIndividualporDui($id);
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
        if (document.getElementById('acta').value == "" 
          || document.getElementById('titulo').value == "") {
            //alert("Complete los campos antes de guardar");
            mostrarMensaje("SysVM", "Complete los campos antes de guardar", "error","adiciona_comprobanteAM.php",1000);
        }else{
            if (document.getElementById('baccion').value=="") {
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

    function onLoadImage(files){
  console.log(files)
  if (files && files[0]) {
    document
      .getElementById('imgName')
      .innerHTML = files[0].name
  }
}

     function abrir(URL){
window.open(URL,"",'width=900,height=700,left=320, top=200,toolbar=0,scrollbars=0,statusbar=0,menubar =0,resizable=0');
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
            <h1>Adicionar Comprobante Legalizado</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#" onclick="abrir('http://localhost/SIRA/vista/ayudas/agrega_comprobanteAM.pdf')">Ayuda</a></li>
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
                <h3 class="card-title">Cuadro de inserción</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post" class="form-group" enctype="multipart/form-data" id="asociaciones" name="asociaciones">
                <input type="hidden" name="bandera" id="bandera">
                    <input type="hidden" name="baccion" id="baccion" value="<?php if(isset($objA)) echo $objA->getId_anexo(); ?>">
                <section class="content">
                <div class="container-fluid">
                <div class="row">

                    <div class="col-1"></div>
                    <div class="col-md-2">
                    <label for="exampleInputPassword1">Numero de Acta</label>
                    <input type="text" class="form-control" id="acta" name="acta" <?php if (isset($objA)) echo "readonly='readonly' "; ?>  placeholder=""
                    value="<?php if(isset($objA)) echo $objA->getId_anexo(); ?>">
                  </div>

                  <div class="col-md-4">
                    <label for="exampleInputPassword1">Tituto de Archivo</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" <?php if (isset($objA)) echo "readonly='readonly' "; ?>  placeholder=""
                    value="<?php $aux=date('d-m-y H:i');

                    echo $objA->getId_anexo().'_'.$aux; ?>">
                  </div> 

                  <div class="col-md-4">
                    <label for="archivo">Comprobante/PDF</label>
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="archivo" name="archivo"
                        onChange="onLoadImage(event.target.files)">
                        <label class="custom-file-label" for="archivo">
                          <span id='imgName'></span>
                          </label>
                      </div>
                  </div>                           
                            
                   
                </div>
                </div>
              </section>

                <!-- /.card-body -->

                <div class="card-footer" style="width: 50%; margin-left: 50%; transform: translateX(-50%);">
                  <button type="button" style="background-color:#007bff; border-color:white; color:white; width: 48%;" class="btn btn-success swalDefaultSuccess" onclick="validacion()">Guardar</button>
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
    $acta=(isset($_REQUEST["acta"]))?$_REQUEST["acta"]:"";
    $titulo=(isset($_REQUEST["titulo"]))?$_REQUEST["titulo"]:"";
    $archivo=(isset($_REQUEST["archivo"]))?$_REQUEST["archivo"]:""; 

    if($bandera=="add"){
        require_once "../controlador/DAOComprobanteAM.php";  
      $daoC=new DAOComprobanteAM();

      if(($_FILES['archivo']['type']=='application/pdf') && ($_FILES['archivo']['size'] < 10000000 )){
      if(!file_exists('archivo')){
        mkdir('archivosActas');
        move_uploaded_file($_FILES['archivo']['tmp_name'], "archivosActas/".$_FILES['archivo']['name']);
      }else{
        move_uploaded_file($_FILES['archivo']['tmp_name'], "archivosActas/".$_FILES['archivo']['name']);  
      }

      $nombre= $_FILES['archivo']['name'];
      $tipo= $_FILES['archivo']['type'];
      $tamanio= $_FILES['archivo']['size'];



        if ($daoC->insertarComprobanteAM(new ClaseComprobanteAM(null,$acta,$titulo,$tamanio,$tipo,$nombre))==1 ) {   
            msg("Sys-Inventario VEC", "Datos almacenados (- o)", "success","tabla_actas.php",1000);
        } else {
            msg("Sys-Inventario VEC", "Error de guardado!", "danger","adiciona_comprobanteAM.php",1000);
        }
    }else{

      msg("Debe ser formato PDF o excedio tamaño 10Mb", "Sys-Inventario VEC", "error","adiciona_comprobanteAM.php",1000);
    }

  }

    function msg($titulo, $texto, $tipo,$pagina,$tiempo)
    {
        echo "<script type='text/javascript'>";
        echo "mostrarMensaje('$titulo','$texto','$tipo','$pagina','$tiempo');";
        echo "</script>";
    }
?>