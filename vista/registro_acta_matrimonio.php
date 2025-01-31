<?php

     @session_start();
    if (isset($_SESSION['logueado']) && $_SESSION['logueado']=="si") {
        $name1=null;
        $name1=''.$_SESSION['usuario'];
       if ($_SESSION['bloquear_pantalla']=="no") {
           // code...
       }else{
            header("Location: ../ingreso/bloqueo.php");
       }
    }else{
        header("Location: ../ingreso/index.php");
    }
    
    date_default_timezone_set("America/El_Salvador");
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
<script >
  function abrir(URL){
window.open(URL,"",'width=900,height=700,left=320, top=200,toolbar=0,scrollbars=0,statusbar=0,menubar =0,resizable=0');
}
</script>
   <script language="javascript">
    function validacionRA() {
        if (document.getElementById('dui_c1').value == "" 
          || document.getElementById('dui_c2').value == ""
          || document.getElementById('dui_t1').value == ""
          || document.getElementById('dui_t2').value == ""
          || document.getElementById('nombres_c1').value == ""
          || document.getElementById('nombres_c2').value == ""
          || document.getElementById('nombres_t1').value == ""
          || document.getElementById('nombres_t2').value == ""
          || document.getElementById('apellidos_c1').value == ""
          || document.getElementById('apellidos_c2').value == ""
          || document.getElementById('apellidos_t1').value == ""
          || document.getElementById('apellidos_t2').value == ""
          || document.getElementById('estado_c1').value == ""
          || document.getElementById('estado_c2').value == ""
          || document.getElementById('oficio_c1').value == ""
          || document.getElementById('oficio_c2').value == ""
          || document.getElementById('nacionalidad_c1').value == ""
          || document.getElementById('nacionalidad_c2').value == ""
          || document.getElementById('nacionalidad_t1').value == ""
          || document.getElementById('nacionalidad_t2').value == ""
          || document.getElementById('origen_c1').value == ""
          || document.getElementById('origen_c2').value == ""
          || document.getElementById('origen_t1').value == ""
          || document.getElementById('origen_t2').value == ""
          || document.getElementById('domicilio_c1').value == ""
          || document.getElementById('domicilio_c2').value == ""
          || document.getElementById('domicilio_t1').value == ""
          || document.getElementById('domicilio_t2').value == ""
          || document.getElementById('edad_t1').value == ""
          || document.getElementById('edad_t2').value == ""
          || document.getElementById('padre_c1').value == ""
          || document.getElementById('padre_c2').value == ""
          || document.getElementById('madre_c1').value == ""
          || document.getElementById('madre_c2').value == ""
          || document.getElementById('residenciapadres_c1').value == ""
          || document.getElementById('residenciapadres_c2').value == ""
          || document.getElementById('particula').value == ""
          || document.getElementById('regimen').value == "") {
            //alert("Complete los campos antes de guardar");
            mostrarMensaje("SysVM", "Complete los campos antes de guardar", "error","registro_acta_matrimonio.php",1000);
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
        location.href = "tabla_estudiantes.php";
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
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../vista/index1.php" class="nav-link">Inicio</a>
               
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-users mr-2"></i>
          <span class="badge badge-warning navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Sesión </span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> <?php echo ''.$name1; ?>
          </a>
          <div class="dropdown-divider"></div>
          <a href="../ingreso/bloqueo.php" class="dropdown-item">
            <i class=""></i> Bloquear pantalla
          </a>
          <div class="dropdown-divider"></div>
          <a href="../vista/respaldoInventario/index.php" class="dropdown-item">
            <i class=""></i>Crear Respaldo Inventarios
          </a>
          <div class="dropdown-divider"></div>
          <a href="../vista/respaldoActas/index.php" class="dropdown-item">
            <i class=""></i>Crear Respaldo Actas
          </a>
          <div class="dropdown-divider"></div>
          <a href="" onclick="abrir('../public/assets/images/inf_sira.png')" class="dropdown-item">
            <i class=""></i>Información del Sistema
          </a>
          <div class="dropdown-divider"></div>
          <a href="../ingreso/destruir.php" class="dropdown-item">
            <i class=""></i> Salir
          </a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>

  </nav>

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
            <h1>Registro de Acta de Matrimonio</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#" onclick="abrir('http://localhost/SIRA/vista/ayudas/reg_actas.pdf')">Ayuda</a></li>
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
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post" class="form-group"  id="asociaciones" name="asociaciones">
                <input type="hidden" name="bandera" id="bandera">
                    <input type="hidden" name="baccion" id="baccion" value="">
                <div class="row">
                    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Contrayente 1 (MASCULINO)</h3>
              </div>
              <!-- /.card-header -->

              <!-- form start -->
                <div class="card-body">
                  <div class="row">
                  <div class="col-6">
                    <label for="exampleInputEmail1">DUI</label>
                    <input type="email"  id="dui_c1" name="dui_c1" class="form-control" data-parsley-error-message="El DUI es requerido" required placeholder="00000000-0">
                  </div>
                  <div class="col-6">
                    <label for="exampleInputEmail1">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="fecha_c1" name="fecha_c1" placeholder="DD-MM-YYYY">
                  </div>
                  <div class="col-12">
                    <label for="exampleInputEmail1">Nombres</label>
                    <input type="text" style="text-transform:uppercase" minlength="3" maxlength="50" class="form-control" id="nombres_c1" name="nombres_c1" placeholder="">
                  </div>
                  <div class="col-12">
                    <label for="exampleInputEmail1">Apellidos</label>
                    <input type="text" style="text-transform:uppercase" minlength="3" maxlength="50" class="form-control" id="apellidos_c1" name="apellidos_c1" placeholder="">
                  </div>
                  <div class="col-12">
                    <label for="exampleInputEmail1">Oficio/Ocupación</label>
                    <input type="text" minlength="3" maxlength="20" class="form-control" id="oficio_c1" name="oficio_c1" placeholder="">
                  </div>
                  <div class="col-6">
                    <label for="exampleInputEmail1">Estado civil</label>
                    <select class="form-control select2" style="" id="estado_c1" name="estado_c1">
                      <option value='0'>[Seleccione...]</option>
                                       <option value='Soltero' >Soltero</option>
                                       <option value='Viudo'>Viudo</option>
                                       <option value='Divorciado' >Divorciado</option>

                      </select>
                  </div>
                  <div class="col-6">
                  <label>Nacionalidad</label>
                  <select class="form-control select2" style="width: 100%;" id="nacionalidad_c1" name="nacionalidad_c1">
                    <option value='0'>[Seleccione...]</option>
                    <?php
                        require "../controlador/DAONacionalidad.php";
                        $daoU = new DAONacionalidad();
                        $fila = $daoU->consultaNacionalidades();
                        foreach ($fila as $key => $value) {
                                        echo "<option value='" . $value->getNacionalidad() . "'>" . $value->getNacionalidad() . "</option>";
                            }
                     ?>
                  </select>
                  </div>

                  <div class="col-6">
                    <label for="exampleInputEmail1">Origen</label>
                    <textarea class="form-control" rows="3" maxlength="60" id="origen_c1" name="origen_c1" placeholder="Enter ..."></textarea>
                  </div>
                  <div class="col-6">
                    <label for="exampleInputEmail1">Domicilio</label>
                    <textarea class="form-control" rows="3" maxlength="60" id="domicilio_c1" name="domicilio_c1" placeholder="Enter ..."></textarea>
                  </div>
                  <div class="col-12">
                    <label for="exampleInputEmail1">Nombre del padre</label>
                    <input type="text" style="text-transform:uppercase" class="form-control" id="padre_c1" name="padre_c1" placeholder="">
                  </div>
                  <div class="col-12">
                    <label for="exampleInputEmail1">Nombre de la madre</label>
                    <input type="text" style="text-transform:uppercase" class="form-control" id="madre_c1" name="madre_c1" placeholder="">
                  </div>
                  <div class="col-12">
                    <label for="exampleInputEmail1">Residencia padres</label>
                    <input type="text" class="form-control" id="residenciapadres_c1" name="residenciapadres_c1" placeholder="">
                  </div>
                  </div>
                </div>
            </div>
            <!-- /.card -->

            <!-- Form Element sizes -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Testigo 1</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <label for="exampleInputEmail1">DUI</label>
                    <input type="email" class="form-control" id="dui_t1" name="dui_t1" placeholder="00000000-0">
                  </div>
                  <div class="col-2">
                    <label for="exampleInputEmail1">Edad</label>
                    <input type="number" class="form-control" id="edad_t1" name="edad_t1" placeholder="">
                  </div>
                  <div class="col-12">
                    <label for="exampleInputEmail1">Nombres</label>
                    <input type="text" style="text-transform:uppercase" minlength="3" maxlength="50" class="form-control" id="nombres_t1" name="nombres_t1" placeholder="">
                  </div>
                  <div class="col-12">
                    <label for="exampleInputEmail1">Apellidos</label>
                    <input type="text" style="text-transform:uppercase" minlength="3" maxlength="50" class="form-control" id="apellidos_t1" name="apellidos_t1" placeholder="">
                  </div>
                  <div class="col-6">
                    <label for="exampleInputEmail1">Oficio/Ocupación</label>
                    <input type="text" minlength="3" maxlength="50" class="form-control" id="oficio_t1" name="oficio_t1" placeholder="">
                  </div>
                  <div class="col-6">
                  <label>Nacionalidad</label>
                  <select class="form-control select2" style="width: 100%;" id="nacionalidad_t1" name="nacionalidad_t1">
                    <option value='0'>[Seleccione...]</option>
                    <?php
                        foreach ($fila as $key => $value) {
                                        echo "<option value='" . $value->getNacionalidad() . "'>" . $value->getNacionalidad() . "</option>";
                            }
                     ?>
                  </select>
                  </div>
                  <div class="col-6">
                    <label for="exampleInputEmail1">Origen</label>
                    <textarea class="form-control" rows="3" maxlength="60" id="origen_t1" name="origen_t1" placeholder="Enter ..."></textarea>
                  </div>
                  <div class="col-6">
                    <label for="exampleInputEmail1">Domicilio</label>
                    <textarea class="form-control" rows="3" maxlength="60" id="domicilio_t1" name="domicilio_t1" placeholder="Enter ..."></textarea>
                  </div>
                  </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Autoridades</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  
                  <div class="col-12">
                    <label for="exampleInputEmail1">Nombre Alcalde</label>
                    <input type="text" style="text-transform:uppercase" maxlength="60" class="form-control" id="alcalde" name="alcalde" placeholder="">
                  </div>
                  <div class="col-12">
                    <label for="exampleInputEmail1">Nombre Secretario/a</label>
                    <input type="text" style="text-transform:uppercase" maxlength="60" class="form-control" id="secretario" name="secretario" placeholder="">
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
            <!-- /.card -->

          </div>

          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Contrayente 2 (FEMENINO)</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                  <div class="row">
                  <div class="col-6">
                    <label for="exampleInputEmail1">DUI</label>
                    <input type="email" class="form-control" id="dui_c2" name="dui_c2" placeholder="00000000-0">
                  </div>
                  <div class="col-6">
                    <label for="exampleInputEmail1">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="fecha_c2" name="fecha_c2" placeholder="DD-MM-YYYY">
                  </div>
                  <div class="col-12">
                    <label for="exampleInputEmail1">Nombres</label>
                    <input type="text" style="text-transform:uppercase" minlength="3" maxlength="50" class="form-control" id="nombres_c2" name="nombres_c2" placeholder="">
                  </div>
                  <div class="col-12">
                    <label for="exampleInputEmail1">Apellidos</label>
                    <input type="text" style="text-transform:uppercase" minlength="3" maxlength="50" class="form-control" id="apellidos_c2" name="apellidos_c2" placeholder="">
                  </div>
                  <div class="col-12">
                    <label for="exampleInputEmail1">Oficio/Ocupación</label>
                    <input type="text" minlength="3" maxlength="20" class="form-control" id="oficio_c2" name="oficio_c2" placeholder="">
                  </div>
                  <div class="col-6">
                    <label for="exampleInputEmail1">Estado civil</label>
                    <select class="form-control select2" style="" id="estado_c2" name="estado_c2">
                      <option value='0'>[Seleccione...]</option>
                                       <option value='Soltera' >Soltero</option>
                                       <option value='Viuda'>Viudo</option>
                                       <option value='Divorciada' >Divorciado</option>

                      </select>
                  </div>
                  <div class="col-6">
                  <label>Nacionalidad</label>
                  <select class="form-control select2" style="width: 100%;" id="nacionalidad_c2" name="nacionalidad_c2">
                    <option value='0'>[Seleccione...]</option>
                    <?php
                        foreach ($fila as $key => $value) {
                                        echo "<option value='" . $value->getNacionalidad() . "'>" . $value->getNacionalidad() . "</option>";
                            }
                     ?>
                  </select>
                  </div>
                  <div class="col-6">
                    <label for="exampleInputEmail1">Origen</label>
                    <textarea class="form-control" rows="3" maxlength="60" id="origen_c2" name="origen_c2" placeholder="Enter ..."></textarea>
                  </div>
                  <div class="col-6">
                    <label for="exampleInputEmail1">Domicilio</label>
                    <textarea class="form-control" rows="3" maxlength="60" id="domicilio_c2" name="domicilio_c2" placeholder="Enter ..."></textarea>
                  </div>
                  <div class="col-12">
                    <label for="exampleInputEmail1">Nombre del padre</label>
                    <input type="text" style="text-transform:uppercase" class="form-control" id="padre_c2" name="padre_c2" placeholder="">
                  </div>
                  <div class="col-12">
                    <label for="exampleInputEmail1">Nombre de la madre</label>
                    <input type="text" style="text-transform:uppercase" class="form-control" id="madre_c2" name="madre_c2" placeholder="">
                  </div>
                  <div class="col-12">
                    <label for="exampleInputEmail1">Residencia padres</label>
                    <input type="text" class="form-control" id="residenciapadres_c2" name="residenciapadres_c2" placeholder="">
                  </div>
                  </div>
                </div>
            </div>
            <!-- /.card -->

            <!-- Form Element sizes -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Testigo 2</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <label for="exampleInputEmail1">DUI</label>
                    <input type="email" class="form-control" id="dui_t2" name="dui_t2" placeholder="00000000-0">
                  </div>
                  <div class="col-2">
                    <label for="exampleInputEmail1">Edad</label>
                    <input type="number" class="form-control" id="edad_t2" name="edad_t2" placeholder="">
                  </div>
                  <div class="col-12">
                    <label for="exampleInputEmail1">Nombres</label>
                    <input type="text" style="text-transform:uppercase" minlength="3" maxlength="50" class="form-control" id="nombres_t2" name="nombres_t2" placeholder="">
                  </div>
                  <div class="col-12">
                    <label for="exampleInputEmail1">Apellidos</label>
                    <input type="text" style="text-transform:uppercase" minlength="3" maxlength="50" class="form-control" id="apellidos_t2" name="apellidos_t2" placeholder="">
                  </div>
                  <div class="col-6">
                    <label for="exampleInputEmail1">Oficio/Ocupación</label>
                    <input type="text" minlength="3" maxlength="50" class="form-control" id="oficio_t2" name="oficio_t2" placeholder="">
                  </div>
                  <div class="col-6">
                  <label>Nacionalidad</label>
                  <select class="form-control select2" style="width: 100%;" id="nacionalidad_t2" name="nacionalidad_t2">
                    <option value='0'>[Seleccione...]</option>
                    <?php
                        foreach ($fila as $key => $value) {
                                        echo "<option value='" . $value->getNacionalidad() . "'>" . $value->getNacionalidad() . "</option>";
                            }
                     ?>
                  </select>
                  </div>

                  <div class="col-6">
                    <label for="exampleInputEmail1">Origen</label>
                    <textarea class="form-control" rows="3" maxlength="60" id="origen_t2" name="origen_t2" placeholder="Enter ..."></textarea>
                  </div>
                  <div class="col-6">
                    <label for="exampleInputEmail1">Domicilio</label>
                    <textarea class="form-control" rows="3" maxlength="60" id="domicilio_t2" name="domicilio_t2" placeholder="Enter ..."></textarea>
                  </div>
                  </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Anexos</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <label for="exampleInputEmail1">Particula</label>
                    <input type="text" class="form-control" maxlength="10" id="particula" name="particula" placeholder="">
                  </div>
                  <div class="col-2">
                    <label for="exampleInputEmail1">N° Acta</label>
                    <input type="number" class="form-control" id="n_acta" name="n_acta" placeholder="">
                  </div>
                  <div class="col-6">
                    <label for="exampleInputEmail1">Regimen Patrimonial</label>
                    <input type="text" style="text-transform:uppercase" maxlength="48" class="form-control" id="regimen" name="regimen" placeholder="">
                  </div>
                  <div class="col-2">
                    <label for="exampleInputEmail1">N° Folio</label>
                    <input type="number" style="text-transform:uppercase" class="form-control" id="n_folio" name="n_folio" placeholder="">
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
                  
                   
                </div>
                <!-- /.card-body -->

                <div class="card-footer" style="width: 50%; margin-left: 65%; transform: translateX(-80%);">
                  <button type="button" style="background-color:#007bff; border-color:white; color:white; width: 100%;" class="btn btn-success swalDefaultSuccess" onclick="validacionRA()">Guardar</button>
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
<script>
  function abrir(URL){
window.open(URL,"",'width=900,height=700,left=320, top=200,toolbar=0,scrollbars=0,statusbar=0,menubar =0,resizable=0');
}
</script>
 <script type="text/javascript" src="../public/plugins/parsleyjs/parsley.min.js"></script>
        <!-- Bootstrap inputmask js -->
<script src="../public/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
<script>
            $("#recuperar_form").parsley();
            $("#dui_c1").inputmask({mask: "99999999-9"});  //static mask
             $("#dui_c2").inputmask({mask: "99999999-9"});  //static mask
              $("#dui_t1").inputmask({mask: "99999999-9"});  //static mask
               $("#dui_t2").inputmask({mask: "99999999-9"});  //static mask
        </script> 
</body>
</html>
<?php

    $baccion=(isset($_REQUEST["baccion"]))?$_REQUEST["baccion"]:"";
    $bandera=(isset($_REQUEST["bandera"]))?$_REQUEST["bandera"]:"";   
    $dui_c1=(isset($_REQUEST["dui_c1"]))?$_REQUEST["dui_c1"]:"";
    $dui_c2=(isset($_REQUEST["dui_c2"]))?$_REQUEST["dui_c2"]:"";
    $dui_t1=(isset($_REQUEST["dui_t1"]))?$_REQUEST["dui_t1"]:"";
    $dui_t2=(isset($_REQUEST["dui_t2"]))?$_REQUEST["dui_t2"]:"";   
    $nombres_c1=(isset($_REQUEST["nombres_c1"]))?$_REQUEST["nombres_c1"]:"";
    $nombres_c2=(isset($_REQUEST["nombres_c2"]))?$_REQUEST["nombres_c2"]:"";
    $nombres_t1=(isset($_REQUEST["nombres_t1"]))?$_REQUEST["nombres_t1"]:"";
    $nombres_t2=(isset($_REQUEST["nombres_t2"]))?$_REQUEST["nombres_t2"]:"";
    $apellidos_c1=(isset($_REQUEST["apellidos_c1"]))?$_REQUEST["apellidos_c1"]:"";
    $apellidos_c2=(isset($_REQUEST["apellidos_c2"]))?$_REQUEST["apellidos_c2"]:"";
    $apellidos_t1=(isset($_REQUEST["apellidos_t1"]))?$_REQUEST["apellidos_t1"]:"";   
    $apellidos_t2=(isset($_REQUEST["apellidos_t2"]))?$_REQUEST["apellidos_t2"]:"";
    $estado_c1=(isset($_REQUEST["estado_c1"]))?$_REQUEST["estado_c1"]:"";
    $estado_c2=(isset($_REQUEST["estado_c2"]))?$_REQUEST["estado_c2"]:"";
      $oficio_c1=(isset($_REQUEST["oficio_c1"]))?$_REQUEST["oficio_c1"]:"";
    $oficio_c2=(isset($_REQUEST["oficio_c2"]))?$_REQUEST["oficio_c2"]:"";
    $oficio_t1=(isset($_REQUEST["oficio_t1"]))?$_REQUEST["oficio_t1"]:"";
    $oficio_t2=(isset($_REQUEST["oficio_t2"]))?$_REQUEST["oficio_t2"]:"";
    $nacionalidad_c1=(isset($_REQUEST["nacionalidad_c1"]))?$_REQUEST["nacionalidad_c1"]:"";   
    $nacionalidad_c2=(isset($_REQUEST["nacionalidad_c2"]))?$_REQUEST["nacionalidad_c2"]:"";
      $nacionalidad_t1=(isset($_REQUEST["nacionalidad_t1"]))?$_REQUEST["nacionalidad_t1"]:"";
    $nacionalidad_t2=(isset($_REQUEST["nacionalidad_t2"]))?$_REQUEST["nacionalidad_t2"]:"";
    $origen_c1=(isset($_REQUEST["origen_c1"]))?$_REQUEST["origen_c1"]:"";   
    $origen_c2=(isset($_REQUEST["origen_c2"]))?$_REQUEST["origen_c2"]:"";
      $origen_t1=(isset($_REQUEST["origen_t1"]))?$_REQUEST["origen_t1"]:"";
    $origen_t2=(isset($_REQUEST["origen_t2"]))?$_REQUEST["origen_t2"]:"";
    $domicilio_c1=(isset($_REQUEST["domicilio_c1"]))?$_REQUEST["domicilio_c1"]:"";   
    $domicilio_c2=(isset($_REQUEST["domicilio_c2"]))?$_REQUEST["domicilio_c2"]:"";
    $domicilio_t1=(isset($_REQUEST["domicilio_t1"]))?$_REQUEST["domicilio_t1"]:"";   
    $domicilio_t2=(isset($_REQUEST["domicilio_t2"]))?$_REQUEST["domicilio_t2"]:"";
     $edad_t1=(isset($_REQUEST["edad_t1"]))?$_REQUEST["edad_t1"]:"";   
    $edad_t2=(isset($_REQUEST["edad_t2"]))?$_REQUEST["edad_t2"]:"";
    $padre_c1=(isset($_REQUEST["padre_c1"]))?$_REQUEST["padre_c1"]:"";   
    $padre_c2=(isset($_REQUEST["padre_c2"]))?$_REQUEST["padre_c2"]:"";
    $madre_c1=(isset($_REQUEST["madre_c1"]))?$_REQUEST["madre_c1"]:"";   
    $madre_c2=(isset($_REQUEST["madre_c2"]))?$_REQUEST["madre_c2"]:"";
    $residenciapadres_c1=(isset($_REQUEST["residenciapadres_c1"]))?$_REQUEST["residenciapadres_c1"]:"";   
    $residenciapadres_c2=(isset($_REQUEST["residenciapadres_c2"]))?$_REQUEST["residenciapadres_c2"]:"";
    $particula=(isset($_REQUEST["particula"]))?$_REQUEST["particula"]:"";   
    $regimen=(isset($_REQUEST["regimen"]))?$_REQUEST["regimen"]:"";
    $fecha_c1=(isset($_REQUEST["fecha_c1"]))?$_REQUEST["fecha_c1"]:"";   
    $fecha_c2=(isset($_REQUEST["fecha_c2"]))?$_REQUEST["fecha_c2"]:"";
    $alcalde=(isset($_REQUEST["alcalde"]))?$_REQUEST["alcalde"]:"";   
    $secretario=(isset($_REQUEST["secretario"]))?$_REQUEST["secretario"]:"";
    $n_acta=(isset($_REQUEST["n_acta"]))?$_REQUEST["n_acta"]:"";
    $n_folio=(isset($_REQUEST["n_folio"]))?$_REQUEST["n_folio"]:"";

    $DateTimen = DateTime::createFromFormat('Y-m-d',$fecha_c1);
    $newDate = $DateTimen->format('Y');
    $DateTime1 = DateTime::createFromFormat('Y-m-d', $fecha_c2);
    $newDate1 = $DateTime1->format('Y');

    //$DateTime2 = DateTime::createFromFormat('Y-m-d',date_timezone_get());
    //$newDate2 = $DateTime2->format('d-m-Y,h:i:s');


    if($bandera=="add"){
        require_once "../controlador/DAOContrayente.php"; 
        require_once "../controlador/DAOTestigo.php"; 
        require_once "../controlador/DAOAnexo.php"; 
        $daoC=new DAOContrayente();
        $daoT=new DAOTestigo();
        $daoA=new DAOAnexo();

        if ($daoC->insertarContrayente(new ClaseContrayente($dui_c1, strtoupper($nombres_c1),strtoupper($apellidos_c1), $estado_c1,$fecha_c1,''.(intval(''.date('Y'))-intval(''.$newDate)),$oficio_c1,$origen_c1, $domicilio_c1,strtolower($nacionalidad_c1), strtoupper($padre_c1),strtoupper($madre_c1), $residenciapadres_c1))==1 && 
          $daoC->insertarContrayente(new ClaseContrayente($dui_c2, strtoupper($nombres_c2),strtoupper($apellidos_c2), $estado_c2,$fecha_c2,''.(intval(''.date('Y'))-intval(''.$newDate1)),$oficio_c2,$origen_c2, $domicilio_c2,strtolower($nacionalidad_c2), strtoupper($padre_c2),strtoupper($madre_c2), $residenciapadres_c2))==1 && 
          $daoT->insertarTestigo(new ClaseTestigo($dui_t1, strtoupper($nombres_t1),strtoupper($apellidos_t1),$edad_t1,$oficio_t1,$origen_t1, $domicilio_t1,strtolower($nacionalidad_t1)))==1 &&
          $daoT->insertarTestigo(new ClaseTestigo($dui_t2, strtoupper($nombres_t2),strtoupper($apellidos_t2),$edad_t2,$oficio_t2,$origen_t2, $domicilio_t2,strtolower($nacionalidad_t2)))==1 && 
          $daoA->insertarAnexo(new ClaseAnexo(null,$n_acta,$n_folio,strtoupper($alcalde),strtoupper($secretario),$particula,strtoupper($regimen),date('Y-m-d h:i:s'), $dui_c1,$dui_c2,$dui_t1,$dui_t2))==1) {   
            //imprimirActa($dui_c1);
            msg("Sys-Inventario VEC", "Datos almacenados (- o)", "success","botonPDF.php?id=".base64_encode($dui_c1),1000);
            
          #  ../controlador/actapdf.php?id=".base64_encode($dui_c1)

        } else {
            msg("Sys-Inventario VEC", "Error de guardado!", "danger","depreciacion.php",1000);
        }
    }

   /* function imprimirActa($id) {
        location.href = "../controlador/actapdf.php?id="+$id;
    }*/

    function msg($titulo, $texto, $tipo,$pagina,$tiempo)
    {
        echo "<script type='text/javascript'>";
        echo "mostrarMensaje('$titulo','$texto','$tipo','$pagina','$tiempo');";
        echo "</script>";
    }

    

?>