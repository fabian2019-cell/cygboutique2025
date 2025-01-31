<?php

    if (isset($_REQUEST['id'])) {/* comprobamos si la variable que viene en la url si existe */
        # code...
        require ("../controlador/DAOCategoria.php");
        $daoE=new DAOCategoria();
        $id=base64_decode($_REQUEST['id']);
        $objE=null;
        $objE=$daoE->consultaIndividual($id);
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
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link href="assets/sweetalert/sweetalert.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   <script language="javascript">
    function validacion() {
        if (document.getElementById('nombre').value == ""
          || document.getElementById('descripcion').value == "") {
            //alert("Complete los campos antes de guardar");
            mostrarMensaje("SYS BOUTIQUE", "Complete los campos antes de guardar", "error","categorias.php",1000);
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

    function imprimir(id) {
        location.href = "categorias.php?id="+id;
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
            document.getElementById('bandera1').value='delete';
            document.getElementById('baccion1').value=id;
            document.users.submit();
        });
    }
    /*
     *función para limpiar los campos del formulario
     */

    function limpiar(){
        $('#nombre').val('');
        $('#descripcion').val('');
        location.href="categorias.php";
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
            <h1>Categoria de Productos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#" onclick="abrir('http://localhost/SIRA/vista/ayudas/adm_users.pdf')">Ayuda</a></li>
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
                    <input type="hidden" name="baccion" id="baccion" value="<?php if(isset($objE)) echo $objE->getId_cat(); ?>">
                <section class="content">
                <div class="container-fluid">
                <div class="row">
                    <div class="col-1"></div>
                  
                  <div class="col-md-5">
                    <label >Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" 
                    placeholder="Vestidos, blusas, jeans..."
                    value="<?php if(isset($objE)) echo $objE->getNombre(); ?>">
                  </div>  
                  <div class="col-md-5">
                    <label >Descripción</label>
                    <textarea class="form-control" rows="2" maxlength="60" id="descripcion" name="descripcion" placeholder="Enter ..."
                    value="<?php if(isset($objE)) echo $objE->getDescripcion(); ?>"><?php if(isset($objE)) echo $objE->getDescripcion(); ?></textarea>
                  </div>
                  <div class="col-1"></div>  
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
            <form action="" method="post" class="form-group" id="users" name="users">
                <input type="hidden" name="bandera1" id="bandera1">
                    <input type="hidden" name="baccion1" id="baccion1" value="<?php if(isset($objE)) echo $objE->getId_cat(); ?>">
            <?php  
                  if(isset($objE)){


                  }else{
             ?>
                <section class="content">
            <div class="row">
              <div class="col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                <thead>
                <tr role="row">
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 304.125px;">Categoria</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 555.555px;">Descripción</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 146.139px;">Acciones</th>
                </tr>
                </thead>
                <tbody>
                  <?php
               require_once "../controlador/DAOCategoria.php";
               $daoE=new DAOCategoria();
                 $fila=$daoE->consulta();
                 $objC=null;
                 $objE=null;

                 foreach ($fila as $key=> $value) {
                     echo "<tr>";
                         echo "<td>".$value->getNombre()."</td>";
                         echo "<td>".$value->getDescripcion()."</td>";
                         echo " <td> <div class='dropdown m-b-10'>
                                    <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                        Seleccione
                                    </button>
                                    <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                        <a class='dropdown-item btn_eliminar' data-id='' href='javascript:void(0)'
                                        onclick=showConfirmMessage('".$value->getId_cat()."')>Eliminar</a>
                                        <a class='dropdown-item btn_editar' data-id='' href='javascript:void(0)' 
                                        onclick= imprimir('".base64_encode($value->getId_cat())."')>Actualizar</a>
                                    </div>
                                </div>";


                   echo "</td></tr>";
               }
           ?>
              
               
               
                    

                </tbody>
                <tfoot>
                <tr>
                  <th rowspan="1" colspan="1">Categoria</th>
                  <th rowspan="1" colspan="1">Descripción</th>
                  <th rowspan="1" colspan="1">Acciones</th>
                </tr>
                </tfoot>
              </table>
            </div>
            </div>
          </section>
          <?php 
            } 
           ?>
        </form>
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
<script type="text/javascript" src="../public/plugins/parsleyjs/parsley.min.js"></script>
<script src="../public/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
<script>
            $("#recuperar_form").parsley();
            $("#dui").inputmask({mask: "99999999-9"});  //static mask
        </script> 
</body>
</html>
<?php

    $baccion=(isset($_REQUEST["baccion"]))?$_REQUEST["baccion"]:"";
    $bandera=(isset($_REQUEST["bandera"]))?$_REQUEST["bandera"]:"";   
    $baccion1=(isset($_REQUEST["baccion1"]))?$_REQUEST["baccion1"]:"";
    $bandera1=(isset($_REQUEST["bandera1"]))?$_REQUEST["bandera1"]:"";  
    $nombre=(isset($_REQUEST["nombre"]))?$_REQUEST["nombre"]:"";
    $descripcion=(isset($_REQUEST["descripcion"]))?$_REQUEST["descripcion"]:"";


    if($bandera=="add"){
        require_once "../controlador/DAOCategoria.php";  
        $daoE=new DAOCategoria();
        if ($daoE-> insertar(new ClaseCategoria('tb_categoria',$nombre,$descripcion))==1) {   
            msg("Sys-BOUTIQUE", "Datos almacenados (- o)", "success","categorias.php",1000);
        } else {
            msg("Sys-BOUTIQUE", "Error de guardado!", "danger","categorias.php",1000);
        }
    }else if($bandera=="edicion"){
        require_once "../controlador/DAOCategoria.php"; 
        $daoE=new DAOCategoria();
       if ($daoE->actualizar(new ClaseCategoria($baccion,$nombre,$descripcion))==1) {
            # code...
            msg("Sys-BOUTIQUE", "Datos actualizados (- o)", "success","categorias.php",1000);
        } else {
            # code...
            msg("Sys-BOUTIQUE", "Error de actualización!", "danger","categorias.php",1000);
        }
        
    }

    if ($bandera1=="delete") {
        # code...
        require_once "../controlador/DAOCategoria.php";
        $daoE=new DAOCategoria();
        if ($daoE->eliminar($baccion1)==1) {
            msg("Sys-BOUTIQUE", "Registro Eliminado (- o)", "success","categorias.php",1000);
            # code...
        } else {
            msg("Sys-BOUTIQUE", "Registro no eliminado (- o)", "success","categorias.php",1000);
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