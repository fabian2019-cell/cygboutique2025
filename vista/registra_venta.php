<?php

    if (isset($_REQUEST['id'])) {/* comprobamos si la variable que viene en la url si existe */
        # code...
        require_once "../controlador/DAOProducto.php";
        $daoU=new DAOProducto();
        $id=$_REQUEST['id'];
       // $id=base64_decode($_REQUEST['id']);
        //$objT=count($daoU->consultaIndividuales($id));
        $objE=$daoU->consultaIndividuales($id);

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
   <link href="assets/sweetalert/sweetalert.css" rel="stylesheet" />

  <script language="javascript">
    function validacion() {
        if (document.getElementById('prods').value === "") {
            //alert("Complete los campos antes de guardar");
            mostrarMensaje("SysVM", "Complete los campos antes de guardar", "error","unidad.php",1000);
        }else{
            if (document.getElementById('baccion').value!="") {
                document.getElementById('bandera').value="edicion";
            } else {
                document.getElementById('bandera').value = "add";
            }
            document.asociaciones.submit();
        }
    }
    function validacion2() {
        if (document.getElementById('cliente').value === "0"
            ||document.getElementById('empleado').value === "0") {

             mostrarMensaje("SYS BOUTIQUE", "Complete los campos cliente y empleado antes de facturar", "error","registra_venta.php?id=".$id,1000);
           
        }else{
                 if (document.getElementById('baccion').value==="") {
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
    function imprimir(id) {
        location.href = "RegistraUsuarios.php?id="+id;
    }
    /*
     *función para limpiar los campos del formulario
     */
    function limpiar(){
        $('#prods').val('');
        location.href="registra_venta.php";
    }
    </script>
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

        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Selección de Articulos</h3>

            <form action="" method="post" class="form-group" enctype="multipart/form-data" id="asociaciones" name="asociaciones">
                <input type="hidden" name="bandera" id="bandera">
                <input type="hidden" name="baccion" id="baccion" value="">

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">

                <section class="content">
                <div class="container-fluid">
                <div class="row">
                  <?php  
                  if(isset($objE)){
                  
             ?>
                    <div class="col-1"></div>
                  <div class="col-md-4">
                  <label>Cliente</label>
                  <select class="form-control select2" style="width: 100%;" id="cliente" name="cliente">
                    <option value='0'>[Seleccione...]</option>
                    <?php

                        require_once "../controlador/DAOCliente.php";
                        $daoE=new DAOCliente();
                        $fila=$daoE->consultaCliente();
                        foreach ($fila as $key => $value) {
                                                                                             
                                       echo "<option value='". $value->getId_cliente() ."'>" .$value->getNombres()." ".$value->getApellidos(). "</option>";
                                              
                               
                            }
                     ?>
                  </select>
                 </div>   
                  <div class="col-md-4">
                  <label>Empleado</label>
                  <select class="form-control select2" style="width: 100%;" id="empleado" name="empleado">
                    <option value='0'>[Seleccione...]</option>
                    <?php

                        require "../controlador/DAOEmpleado.php";
                        $daoU = new DAOEmpleado();
                        $fila = $daoU->consultaEmpleados();
                        foreach ($fila as $key => $value) {
                                                                                             
                                       echo "<option value='". $value->getId_empleado() ."'>" .$value->getNombres(). "</option>";
                                                 
                               
                            }
                     ?>
                  </select>
                 </div>
                  <div class="col-md-2">
                    <label for="descuento">Aplicar descuento</label>
                    <input type="number" min="1" max="999"  class="form-control" id="descuento" name="descuento" placeholder="$00.00"
                    value="">
                  </div>
                  
                  <div class="col-md-2">
                      <label> </label>
                  </div>
                  <div class="col-md-1"></div>
                </div>
                </div>
              </section>
                 <?php 
                 } 
                  if(isset($objE)){
                  }else{
             ?>
                 <div class="col-md-12">
                  <label>Escanee código/seleccione</label>
                  <select class="duallistbox" multiple="multiple" id="prods" name="prods[]">
                    <?php
                        require ("../controlador/DAOProducto.php");
                 $daoP=new DAOProducto();
                 $fila=$daoP->consultaProd();
                        foreach ($fila as $key => $value) {
                            if (isset($objE)) {
                                } else {
                                                                                             
                                       echo "<option value='". $value->getId_prod() ."'>" . $value->getCodigo(). "</option>";
                                                    }
                               
                            }
                     ?>
                  </select>

                  <?php 
                  } 
                  if(isset($objE)){

                  }else{
                  ?>
                 </div> 
                  <div class="card-footer" style="width: 50%; margin-left: 50%; transform: translateX(-50%);">
                  <button type="button" style="background-color:#007bff; border-color:white; color:white; width: 48%;" class="btn btn-success swalDefaultSuccess" 
                   onclick="validacion()"><?php if(isset($id)) echo "Editar"; else echo "Siguiente";?></button>
                                                <button type="button" class="btn btn-warning" style="width: 48%;" 
                                                onclick="limpiar()">Cancelar</button>
                </div>
                 </form>
               <?php } ?>

                  <form action="" method="post" class="form-group" id="users" name="users">
                <input type="hidden" name="bandera1" id="bandera1">
                    <input type="hidden" name="baccion1" id="baccion1" value="">
            <?php  
                  
                  if(isset($objE)){
             ?>
              <section class="content">
            <div class="row">
              <div class="col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                <thead>
                <tr role="row">
                  <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 237.764px;">Codigo</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 304.125px;">Descripcion</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 555.555px;">Marca </th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 555.555px;">Talla </th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 146.139px;">Color </th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 146.139px;">Precio </th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  $acum=0;
                  $precio_v=0;
                  $ides=0;
                  $ides1=0;
                  

                 foreach ($objE as $key=> $value) {
                  $ides=$value->getId_prod();
                  $ides1=$ides1.$ides.",";
                  $precio_v=number_format($value->getCosto()+$value->getCantidad_gan(),2);

                     echo "<tr>";
                         echo "<td>".$value->getCodigo()."</td>";
                         //echo "<td>".$value->getCodigo()."</td>";

                         echo "<td>".$value->getNombre()."</td>";
                         echo "<td>".$value->getMarca()."</td>";
                         echo "<td>".$value->getTallas()."</td>";
                         echo "<td>".$value->getColor()."</td>";
                         echo "<td>".'$ '.$precio_v."</td>";


                   echo "</tr>";
                   $acum=$acum+$precio_v;
                   $precio_v=0;
                   
               }

           ?>
              
               
               
                    

                </tbody>
                <tfoot>
                <tr>
                  <th rowspan="1" colspan="1">Codigo</th>
                  <th rowspan="1" colspan="1">Descripcion</th>
                  <th rowspan="1" colspan="1">Marca</th>
                  <th rowspan="1" colspan="1">Talla</th>
                  <th rowspan="1" colspan="1">Color</th>
                  <th rowspan="1" colspan="1">Precio</th>
                </tr>
                </tfoot>
              </table>
              <div class="col-8">
                  <label> <h2>TOTAL $ <?php echo"$acum"?> </h2> <h6> <font color="red">sin descuentos</font></h6></label>
                  </div>
            </div>
            </div>
            <div class="card-footer" style="width: 50%; margin-left: 50%; transform: translateX(-50%);">
                  <button type="button" style="background-color:#007bff; border-color:white; color:white; width: 48%;" class="btn btn-success swalDefaultSuccess" 
                   onclick="validacion2()"><?php if(isset($id)) echo "Facturar"; else echo "Guardar";?></button>
                                                <button type="button" class="btn btn-warning" style="width: 48%;" 
                                                onclick="limpiar()">Cancelar</button>
                </div>
          </section>
          <?php 
            } 
           ?>
        </form>







                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
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
<script src="assets/sweetalert/sweetalert.min.js"></script>
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
    $empleado=(isset($_REQUEST["empleado"]))?$_REQUEST["empleado"]:""; 
    $cliente=(isset($_REQUEST["cliente"]))?$_REQUEST["cliente"]:""; 
    $vea=(isset($_REQUEST["prods"]))?$_REQUEST["prods"]:""; 
    $descuento=(isset($_REQUEST["descuento"]))?$_REQUEST["descuento"]:""; 


    if($bandera=="add"){
      /*require_once "../controlador/DAOProducto.php"; 
      $codigo_p=null;
      $ganan=null;
      $ganan=($costo+$ganancia);
      $codigo_p='0'.$categoria.'-'.$estilo.'-00'.$ganan.'010'; */
      $cad='';
      $cad2='';
      for ($i = 0; $i < count($vea); $i++) {
        $cad=$vea[$i];
        $cad2=$cad2.$cad.",";

      } 
      $qwer=substr($cad2, 0, -1);
     msg("Sys-BOUTIQUE","Obteniendo productos...", "success","registra_venta.php?id=".$qwer,1000);
     //registra_venta.php?id=".base64_encode(substr($cad2, 0, -1)),1000);

    }else if($bandera=="edicion"){
        require_once "../controlador/DAOProducto.php"; 
        require_once "../controlador/DAOVenta.php";
        require_once "../controlador/DAOVentaproducto.php"; 
        $daoE=new DAOProducto();
        $daoV=new DAOVenta();
        $daoVP=new DAOVentaproducto();
        $qwerty=substr($ides1, 0, -1);
        $ult_encabezado="";
        $precio_v=0;
        $finish=0;
        if($descuento>0){
            $des=$descuento/$acum;}else {$des=0.0;}
        if($daoV->insertarVenta(new ClaseVenta(null,date('Y-m-d h:i:s'),$cliente,$empleado,0))==1){
        $ult_encabezado=($daoV->consultaUltimoEncabezado());  

        for($i=0; $i<count($objE); $i++){
          $precio_v=$objE[$i]->getCosto()+$objE[$i]->getCantidad_gan();
          $desf=round($precio_v*$des,2);
          $finish+=$daoVP->insertarVentaproducto(new ClaseVenta_producto(null,$ult_encabezado,$objE[$i]->getId_prod(),$precio_v,$desf,1,number_format($precio_v-$desf,2)));

        }
       if ($daoE->actualizarVendido($qwerty)==1 && $daoV->actualizarTotal($acum-floatval($descuento),$ult_encabezado)==1) {
            # code...
            msg("Sys-BOUTIQUE", "Venta registrada con exito.", "success","tabla_ventas.php",1000);
        }/* else {
            # code...
            msg("Sys-BOUTIQUE", "Error de actualización!", "danger","registra_venta.php?id=".$qwerty,1000);
        }*/
      }else{
        msg("Sys-BOUTIQUE", "Error de ingreso de encabezado venta :(", "danger","registra_venta.php?id=".$qwerty,1000);
      }
        
    }

    function msg($titulo, $texto, $tipo,$pagina,$tiempo)
    {
        echo "<script type='text/javascript'>";
        echo "mostrarMensaje('$titulo','$texto','$tipo','$pagina','$tiempo');";
        echo "</script>";
    }
?>