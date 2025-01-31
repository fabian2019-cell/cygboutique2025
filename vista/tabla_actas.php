<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Villa El Carmen Cuscatlan | Inventario </title>
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
        location.href = "adiciona_comprobanteAM.php?id="+id;
    }

    function showConfirmMessage(id) {
        swal({
            title:"Quiere eliminar este registro?",
            text: "Recuerda que no lo podras recuperar",
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
            <h1>Listado de Actas Matrioniales</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#" onclick="abrir('http://localhost/SIRA/vista/ayudas/listado_actas.pdf')">Ayuda</a></li>
            </ol>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
      <section class="content">
      <div class="row">
        <div class="col-12">
          <!-- /.card -->
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12">

                <form action="" method="post" class="form-group" id="asociaciones" name="asociaciones">
               <input type="hidden" name="bandera" id="bandera">
                    <input type="hidden" name="baccion" id="baccion" value="<?php if(isset($objE)) echo $objE->getId_anexo(); ?>">
                <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                <thead>
                <tr role="row">
                  <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 237.764px;">N° Acta-Folio</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 304.125px;">Fecha de Matrimonio</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 270.653px;">DUI Esposo</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 270.653px;">Nombres Esposo</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 203.764px;">DUI Esposa</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 270.653px;">Nombres Esposa</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 146.139px;">Comprobante</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 146.139px;">Acciones</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                 include "../controlador/DAOAnexo.php";
                 include "../controlador/DAOComprobanteAM.php";
                 include "../controlador/DAOContrayente.php";
                 $daoA=new DAOAnexo();
                 $daoE=new DAOContrayente();
                 $daoC=new DAOComprobanteAM();
                 $fila=$daoA->consultaAnexos();
                 $objC=null;
                 $objE=null;

                 foreach ($fila as $key=> $value) {
                     echo "<tr>";
                         echo "<td>".$value->getN_Acta().' - '.$value->getN_Folio()."</td>";
                         echo "<td>".$value->getFecha_matrimonio()."</td>";
                         echo "<td>".$value->getContrayente1()."</td>";
                         $objE=$daoE->consultaIndividualContrayente($value->getContrayente1());
                         echo "<td>".$objE->getNombres().' '.$objE->getApellidos()."</td>";
                         echo "<td>".$value->getContrayente2()."</td>";
                         $objE=$daoE->consultaIndividualContrayente($value->getContrayente2());
                         echo "<td>".$objE->getNombres().' '.$objE->getApellidos()."</td>";
                         $objC=$daoC->consultaIndividualporAnexo($value->getId_anexo());
                         if(isset($objC)){
                          $aux=str_replace(' ','%20',$objC->getNombre()); 
                          echo "<td><a onclick=abrir('http://localhost:8012/SIRA/vista/archivosActas/{$aux}') href=''>".$objC->getTitulo()."</a></td>";
                        } else{ $aux='N/A';
                         echo "<td><a>".$aux."</a></td>";}
                         echo " <td> <div class='dropdown m-b-10'>
                                    <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                        Seleccione
                                    </button>
                                    <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                        <a class='dropdown-item btn_eliminar' data-id='' href='javascript:void(0)'
                                        onclick=showConfirmMessage('".$value->getId_anexo()."')>Eliminar</a>
                                        <a class='dropdown-item btn_editar' data-id='' href='javascript:void(0)' 
                                        onclick= imprimir('".base64_encode($value->getContrayente1())."')>Actualizar</a>
                                    </div>
                                </div>";


                   echo "</td></tr>";
               }
           ?>
              
               
               
                    

                </tbody>
                <tfoot>
                <tr>
                  <th rowspan="1" colspan="1">N° Acta-Folio</th>
                  <th rowspan="1" colspan="1">Fecha de Matrimonio</th>
                  <th rowspan="1" colspan="1">DUI Esposo</th>
                  <th rowspan="1" colspan="1">Nombres Esposo</th>
                  <th rowspan="1" colspan="1">DUI Esposa</th>
                  <th rowspan="1" colspan="1">Nombres Esposa</th>
                  <th rowspan="1" colspan="1">Comprobante</th>
                  <th rowspan="1" colspan="1">Acciones</th>
                </tr>
                </tfoot>
              </table>
            </form>
            </div></div></div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
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
        require_once "../controlador/DAOAnexo.php";
        $daoE=new DAOAnexo();
        if ($daoE->eliminarAnexo($baccion)==1) {
            msg("Sys-Inventario VEC", "Registro Eliminado (- o)", "success","tabla_actas.php",1000);
            # code...
        } else {
            msg("Sys-Inventario VEC", "Registro no eliminado (- o)", "success","tabla_actas.php",1000);
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