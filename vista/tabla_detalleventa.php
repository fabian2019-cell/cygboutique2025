<?php  
	if (isset($_REQUEST['id'])) {/* comprobamos si la variable que viene en la url si existe */
        # code...
        require_once "../controlador/DAOVentaproducto.php";
        $daoVP=new DAOVentaproducto();
        $id=base64_decode($_REQUEST['id']);
       // $id=base64_decode($_REQUEST['id']);
        //$objT=count($daoU->consultaIndividuales($id));
        $objVP=$daoVP->consultaVentasprod($id);

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
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <link href="assets/sweetalert/sweetalert.css" rel="stylesheet" />
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <script language="javascript">
    function imprimir(id) {
        location.href = "ingreso_producto.php?id="+id;
    }

    function nuevo(id) {
        location.href = "ingreso_producto.php";
    }
    function depreciar(id) {
        location.href = "ingreso_producto.php?id="+id;    
      }

    function showConfirmMessage(id) {
        swal({
            title:"Quiere marcar como disponible?",
            text: "Podra encontrarlo en inventario",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, proceder",
            closeOnConfirm:false
        },function(){
            document.getElementById('bandera').value='delete';
            document.getElementById('baccion').value=id;
            document.asociaciones.submit();
        });
    }
    function mostrarMensaje(titulo, texto, tipo, pagina,tiempo) {
        swal(titulo, texto, tipo,pagina,tiempo);
        if (tipo!="error") {
            setTimeout("location.href='"+pagina+"'",tiempo);
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
        <div class="row mb-2" >
          <div class="col-sm-6" >
            <h1>Detalle de venta </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#" onclick="abrir('http://localhost:8012/SIRA/vista/ayudas/tabla_bm.pdf')">Ayuda</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-24">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <form action="" method="post" class="form-group" id="asociaciones" name="asociaciones">
               <input type="hidden" name="bandera" id="bandera">
                    <input type="hidden" name="baccion" id="baccion" value="<?php if(isset($objE)) echo $objE->getId_pro(); ?>">
              <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                <thead>
                <tr role="row">
                  <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 100.139px;">N°</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 354.139px;">Codigo</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 270.139px;">Nombre</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 146.139px;">Estilo</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 146.139px;">Color</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 146.139px;">Talla</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 146.139px;">Precio</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 146.139px;">Descuento</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 146.139px;">Subtotal</th>
                </tr>
                </thead>
                <tbody>
               
                <?php
                 //include "../controlador/DAOCategoria.php";
                 require ("../controlador/DAOProducto.php");
                 $daoP=new DAOProducto();
                // $daoU=new DAOCategoria();
                // $fila=$daoE->consultaProdReservados();
                 $objP=null;
                 $objC=null;
                 $contador=1;
                 $acum=0;
                 $desc=0;

                 foreach ($objVP as $key=> $value) {
                     echo "<tr>";
                         echo "<td>".$contador."</td>";
                         $objP=$daoP->consultaIndividual($value->getId_producto());
                         echo "<td>".$objP->getCodigo()."</td>";
                         echo "<td>".$objP->getNombre()."</td>";
                         echo "<td>".$objP->getEstilo()."</td>";
                         echo "<td>".$objP->getColor()."</td>";
                         echo "<td>".$objP->getTallas()."</td>";
                         echo "<td>".'$ '.number_format($value->getPrecio_venta(),2)."</td>";
                         if($value->getCantidad_des()>0){
                         echo "<td><font color='red'>".'$ '.number_format($value->getCantidad_des(),2)."</font></td>";
                         }else{
                          echo "<td>".'$ '.number_format($value->getCantidad_des(),2)."</td>";
                         }
                         echo "<td>".'$ '.number_format($value->getSubtotal(),2)."</td>";
                         

                   echo "</tr>";

                   $contador++;
                   $acum=$acum+$value->getSubtotal();
                   $desc+=$value->getCantidad_des();

               }
           ?>
              
               
               
               
             
                </tbody>
                <tfoot>
                <tr>
                  <th>N°</th>
                  <th>Codigo</th>
                  <th>Nombre</th>
                  <th>Estilo</th>
                  <th>Color</th>
                  <th>Talla</th>
                  <th>Precio</th>
                  <th>Descuento</th>
                  <th>Subtotal</th>
                </tr>
                </tfoot>
              </table>
               <div class="col-8">
                  
                  <label> <h4> <font color="red">DESCUENTO $ <?php echo"$desc"?></font></h4></label><br>
                  <label> <h2>TOTAL $ <?php echo"$acum"?> </h2></label>
                  </div>
            </form>
            </div>
            <!-- /.card-body -->
          </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
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
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="assets/sweetalert/sweetalert.min.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
</body>
</html>
<?php 
    $bandera=(isset($_REQUEST["bandera"]))?$_REQUEST["bandera"]:"";
    $baccion=(isset($_REQUEST["baccion"]))?$_REQUEST["baccion"]:"";

    if ($bandera=="delete") {
        # code...
        require_once "../controlador/DAOProducto.php";
        $daoE=new DAOProducto();
        if ($daoE->actualizarDisponible($baccion)==1) {
            msg("Sys-BOUTIQUE", "Registro habilitado (- o)", "success","tabla_productosr.php",1000);
            # code...
        } else {
            msg("Sys-BOUTIQUE", "Registro no actualizado (- o)", "success","tabla_productosr.php",1000);
            # code...
        }

    } 

    function msg($titulo, $texto, $tipo,$pagina,$tiempo)
    {
        echo "<script type='text/javascript'>";
        echo "mostrarMensaje('$titulo','$texto','$tipo','$pagina','$tiempo');";
        echo "</script>";
    }
    
?>