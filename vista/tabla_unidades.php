<!DOCTYPE html>
<html style="height: auto;">
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

  <link href="plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <script language="javascript">
    function imprimir(id) {
        location.href = "depreciacion.php?id="+id;
    }

     function nuevo(id) {
        location.href = "depreciacion.php";
    }

    function imprimirD(id) {
        location.href = "divisionBM.php?id="+id;
    }

     function nuevoD(id) {
        location.href = "divisionBM.php";
    }

    function imprimirU(id) {
        location.href = "unidad.php?id="+id;
    }
    function nuevaU(id) {
        location.href = "unidad.php";
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
    function showConfirmMessageD(id) {
        swal({
            title:"Quiere eliminar este registro?",
            text: "Recuerda que no lo podras recuperar",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, proceder",
            closeOnConfirm:false
        },function(){
            document.getElementById('bandera').value='delete1';
            document.getElementById('baccion').value=id;
            document.asociaciones.submit();
        });
    }
    function showConfirmMessageU(id) {
        swal({
            title:"Quiere eliminar este registro?",
            text: "Recuerda que no lo podras recuperar",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, proceder",
            closeOnConfirm:false
        },function(){
            document.getElementById('bandera').value='delete2';
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
<body class="hold-transition sidebar-mini" style="height: auto;">
<div class="wrapper">
  <!-- Navbar -->
  <?php include("../layouts/toolbar.php"); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
 <?php 
  require_once ("aside.php");
   ?>

  <div class="content-wrapper" style="min-height: 1016.69px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Datos Generales Anexos a Inventario</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#" onclick="abrir('http://localhost/SIRA/vista/ayudas/listados_anex.pdf')">Ayuda</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

              <!-- /.card-header -->
              <form action="" method="post" class="form-group" id="asociaciones" name="asociaciones">
               <input type="hidden" name="bandera" id="bandera">
                    <input type="hidden" name="baccion" id="baccion" value="<?php if(isset($objE)) echo $objE->getId(); ?>">
        <div class="row">

          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Cuentas de Inventario</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th>Codigo Cuenta</th>
                  <th>Nombre</th>
                  <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                 include "../controlador/DAODivisionbm.php";
                 $daoE=new DAODivisionbm();
                 $fila=$daoE->consultaDivisionbm();
                 foreach ($fila as $key=> $value) {
                     echo "<tr>";
                         echo "<td>".$value->getId_division_bm()."</td>";
                         echo "<td>".$value->getNombre_bien()."</td>";
                         echo "<td>
                          <div class='dropdown m-b-10'>
                                    <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                        Seleccione
                                    </button>
                                    <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                        <a class='dropdown-item btn_eliminar' data-id='' href='javascript:void(0)'
                                        onclick=showConfirmMessageD('".$value->getId_division_bm()."')>Eliminar</a>
                                        <a class='dropdown-item btn_editar' data-id='' href='javascript:void(0)' 
                                        onclick= imprimirD('".base64_encode($value->getId_division_bm())."')>Actualizar</a>
                                        <a class='dropdown-item btn_editar' data-id='' href='javascript:void(0)' 
                                        onclick= nuevoD()>Nuevo</a>
                                    </div>
                                </div>

                        </td>";
                   echo "</tr>";
               }
           ?>
              
               
               
               
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">«</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Listado de Unidades</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th>Codigo</th>
                  <th>Nombre de Unidad</th>
                  <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                 include "../controlador/DAOUnidad.php";
                 $daoE=new DAOUnidad();
                 $fila=$daoE->consultaUnidad();
                 foreach ($fila as $key=> $value) {
                     echo "<tr>";
                         echo "<td>".$value->getIdunidad()."</td>";
                         echo "<td>".$value->getNombreunidad()."</td>";
                         echo "<td>
                         <div class='dropdown m-b-10'>
                                    <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                        Seleccione
                                    </button>
                                    <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                        <a class='dropdown-item btn_eliminar' data-id='' href='javascript:void(0)'
                                        onclick=showConfirmMessageU('".$value->getIdunidad()."')>Eliminar</a>
                                        <a class='dropdown-item btn_editar' data-id='' href='javascript:void(0)' 
                                        onclick= imprimirU('".base64_encode($value->getIdunidad())."')>Actualizar</a>
                                        <a class='dropdown-item btn_editar' data-id='' href='javascript:void(0)' 
                                        onclick= nuevaU()>Nuevo</a>
                                    </div>
                                </div>
                         </td>";
                   echo "</tr>";
               }
           ?>
              
               
               
               
                  
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">«</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
              </div>
            </div>
          </div>

           <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tipos de Depreciación</h3>
              </div>
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th>Codigo </th>
                  <th>Nombre del bien</th>
                  <th>Factor Anual </th>
                  <th>Plazo anual</th>
                  <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                 include "../controlador/DAODepreciacion.php";
                 $daoE=new DAODepreciacion();
                 $fila=$daoE->consultaDepreciacion();
                 foreach ($fila as $key=> $value) {
                     echo "<tr>";
                         echo "<td>".$value->getId_depreciacion()."</td>";
                         echo "<td>".$value->getNombre_bien()."</td>";
                         echo "<td>".$value->getFactor_anual()."</td>";
                         echo "<td>".$value->getPlazo_anual()."</td>";
                         echo "<td>
                          <div class='dropdown m-b-10'>
                                    <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                        Seleccione
                                    </button>
                                    <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                        <a class='dropdown-item btn_eliminar' data-id='' href='javascript:void(0)'
                                        onclick=showConfirmMessage('".$value->getId_depreciacion()."')>Eliminar</a>
                                        <a class='dropdown-item btn_editar' data-id='' href='javascript:void(0)' 
                                        onclick= imprimir('".base64_encode($value->getId_depreciacion())."')>Actualizar</a>
                                        <a class='dropdown-item btn_editar' data-id='' href='javascript:void(0)' 
                                        onclick= nuevo()>Nuevo</a>
                                    </div>
                                </div>
                      </td>";
                   echo "</tr>";
               }
           ?>
              
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">«</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
              </div>
            </div>
          </div>

          

          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form name="fd" id="fd" action="" method="POST" onsubmit="validacion()">
              <input type="hidden" name="bandera1" id="bandera1" value="add">
                    <input type="hidden" name="baccion1" id="baccion1" value="">
                <div class="modal-header" style="background-color: #007bff;">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: white;">Registro Nuevo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Depreciacion</h4>
                    <div class="form-group">

                      <div class="row">
                        
                      
                        <div class="col-md-6">
                              <div class="form-group">
                                <label>Codigo*</label>
                                <input type="text" autocomplete="off" name="codigo" id="codigo" data-parsley-error-message="Campo requerido" class="form-control" required placeholder="Ingrese su dui"/>
                              </div>
                            </div>

                        <div class="col-md-6">
                              <div class="form-group">
                                <label>Nombre *</label>
                                <input type="text" autocomplete="off" name="nombre" id="nombre" data-parsley-error-message="Campo requerido" class="form-control" required placeholder="Ingrese su dui"/>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Factor Anual *</label>
                                <input type="text" autocomplete="off" name="factor_anual" id="factor_anual" data-parsley-error-message="Campo requerido" class="form-control" required placeholder="Ingrese su dui"/>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Plazo Anual *</label>
                                <input type="text" autocomplete="off" name="plazo_anual" id="plazo_anual" data-parsley-error-message="Campo requerido" class="form-control" required placeholder="Ingrese su dui"/>
                              </div>
                            </div>


                            </div>


                        <small id="emailHelp" class="form-text text-muted">* Todos los capos son requeridos</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit"  class="btn btn-primary" onclick="validacion()">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>


          <!-- /.col -->
        </div>

              </form>
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
        require_once "../controlador/DAODepreciacion.php";
        $daoE=new DAODepreciacion();
        if ($daoE->eliminar($baccion)==1) {
            msg("Sys-Inventario VEC", "Registro Eliminado (- o)", "success","tabla_unidades.php",1000);
            # code...
        } else {
            msg("Sys-Inventario VEC", "Registro no eliminado (- o)", "success","tabla_unidades.php",1000);
            # code...
        }

    } else if ($bandera=="delete1") {
        require_once "../controlador/DAODivisionbm.php";
        $daoE=new DAODivisionbm();
        if ($daoE->eliminarDivision($baccion)==1) {
            msg("Sys-Inventario VEC", "Registro Eliminado (- o)", "success","tabla_unidades.php",1000);
            # code...
        } else {
            msg("Sys-Inventario VEC", "Registro no eliminado (- o)", "success","tabla_unidades.php",1000);
            # code...
        }
    }else if ($bandera=="delete2") {
      require_once "../controlador/DAOUnidad.php";
        $daoE=new DAOUnidad();
        if ($daoE->eliminarUnidad($baccion)==1) {
            msg("Sys-Inventario VEC", "Registro Eliminado (- o)", "success","tabla_unidades.php",1000);
            # code...
        } else {
            msg("Sys-Inventario VEC", "Registro no eliminado (- o)", "success","tabla_unidades.php",1000);
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