<?php

    if (isset($_REQUEST['id'])) {/* comprobamos si la variable que viene en la url si existe */
        # code...
        require ("../controlador/DAOCliente.php");
        $daoE=new DAOCliente();
        $id=base64_decode($_REQUEST['id']);
        $objE=null;
        $objE=$daoE->consultaIndividualCliente($id);
        /*value="<?php echo $idespecifico = ($idespecifico=='') ? '' : $idespecifico ; ?>" para los inputs*/
    }
    
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>C Y G SHOP | Boutique </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <?php include("../layouts/toolbar.php"); ?>
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
            <h1>Registro de ventas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Advanced Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
          <!-- /.card-header -->
    
        <!-- /.card -->

        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Selección de Articulos</h3>

            <form action="" method="post" class="form-group" enctype="multipart/form-data" id="asociaciones" name="asociaciones">
                <input type="hidden" name="bandera" id="bandera">
                <input type="hidden" name="baccion" id="baccion" value="<?php if(isset($objE)) echo $objE->getId_prod(); ?>">

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label>Inventario</label>
                  <select class="duallistbox" multiple="multiple" id="prods" name="prods">
                    <option value='0'>[Seleccione...]</option>
                    <?php
                        require "../controlador/DAOEmpleado.php";
                        $daoU = new DAOEmpleado();
                        $fila = $daoU->consultaEmpleados();
                        foreach ($fila as $key => $value) {
                            if (isset($objE)) {
                                    if ($value->getId_empleado() == $objE->getEmpleado()) {
                                        echo "<option selected value='" . $value->getId_empleado() . "'>" . $value->getApellidos(). " " . $value->getNombres    ()."</option>";                                    } else {
                                        echo "<option value='" . $value->getId_empleado() . "'>" . $value->getApellidos(). " " . $value->getNombres    (). "</option>";
                                    }
                                } else {
                                                                                             
                                       echo "<option value='". $value->getId_empleado() ."'>" . $value->getApellidos(). " " . $value->getNombres    (). "</option>";
                                                    }
                               
                            }
                     ?>
                  </select>
                 </div> 
                  <div class="card-footer" style="width: 50%; margin-left: 50%; transform: translateX(-50%);">
                  <button type="button" style="background-color:#007bff; border-color:white; color:white; width: 48%;" class="btn btn-success swalDefaultSuccess" 
                   onclick="validacion()"><?php if(isset($id)) echo "Editar"; else echo "Guardar";?></button>
                                                <button type="button" class="btn btn-warning" style="width: 48%;" 
                                                onclick="limpiar()">Cancelar</button>
                </div>
                 </form>






                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
            the plugin.
          </div>
        </div>
        <!-- /.card -->
            <!-- /.card -->

            <!-- /.card -->

          </div>
          <!-- /.col (left) -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


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
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="plugins/inputmask/jquery.inputmask.bundle.js"></script>
<script src="plugins/moment/moment.min.js"></script>
<!-- date-range-picker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })
    
    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });
  })
</script>
</body>
</html>

<?php

    $baccion=(isset($_REQUEST["baccion"]))?$_REQUEST["baccion"]:"";
    $bandera=(isset($_REQUEST["bandera"]))?$_REQUEST["bandera"]:"";   
    $codigo=(isset($_REQUEST["codigo"]))?$_REQUEST["codigo"]:"";
    $estilo=(isset($_REQUEST["estilo"]))?$_REQUEST["estilo"]:"";
    $nombre=(isset($_REQUEST["nombre"]))?$_REQUEST["nombre"]:"";
    $color=(isset($_REQUEST["color"]))?$_REQUEST["color"]:"";
    $marca=(isset($_REQUEST["marca"]))?$_REQUEST["marca"]:"";
    $talla=(isset($_REQUEST["talla"]))?$_REQUEST["talla"]:"";
    $cantidad=(isset($_REQUEST["cantidad"]))?$_REQUEST["cantidad"]:"";
    $descripcion=(isset($_REQUEST["descripcion"]))?$_REQUEST["descripcion"]:"";
    $costo=(isset($_REQUEST["costo"]))?$_REQUEST["costo"]:"";
    $ganancia=(isset($_REQUEST["ganancia"]))?$_REQUEST["ganancia"]:"";
    $categoria=(isset($_REQUEST["categoria"]))?$_REQUEST["categoria"]:"";
    $proveedor=(isset($_REQUEST["proveedor"]))?$_REQUEST["proveedor"]:"";


    if($bandera=="add"){
      require_once "../controlador/DAOProducto.php"; 
      $codigo_p=null;
      $ganan=null;
      $ganan=($costo+$ganancia);
      $codigo_p='0'.$categoria.'-'.$estilo.'-00'.$ganan.'010';
      for ($i = 0; $i < $cantidad; $i++) {
        
        $daoE=new DAOProducto();
        $daoE-> insertar(new ClaseProducto(null,$codigo_p.'-0'.$i+1,$estilo,$nombre,$marca,$color,$talla,$descripcion,$costo, $ganancia,$categoria,$proveedor,$i));
      }

      msg("Sys-BOUTIQUE", "".$cantidad. " productos almacenados ", "success","tabla_productos.php",2000);

    }else if($bandera=="edicion"){
        require_once "../controlador/DAOProducto.php"; 
        $daoE=new DAOProducto();
       if ($daoE->actualizar(new ClaseProducto($baccion,$codigo,$estilo,$nombre,$marca,$color,$talla,$descripcion,$costo, $ganancia,$categoria,$proveedor,0))==1) {
            # code...
            msg("Sys-BOUTIQUE", "Datos actualizados (- o)", "success","tabla_productos.php",1000);
        } else {
            # code...
            msg("Sys-BOUTIQUE", "Error de actualización!", "danger","ingreso_producto.php",1000);
        }
        
    }

    function msg($titulo, $texto, $tipo,$pagina,$tiempo)
    {
        echo "<script type='text/javascript'>";hjhjhjhjhjjjjjjjjjjj
        echo "mostrarMensaje('$titulo','$texto','$tipo','$pagina','$tiempo');";
        echo "</script>";
    }
?>
