<?php

    if (isset($_REQUEST['id'])) {/* comprobamos si la variable que viene en la url si existe */
        # code...
        require ("../controlador/DAOUsuario.php");
        $daoE=new DAOUsuario();
        $id=base64_decode($_REQUEST['id']);
        $objE=null;
        $objE=$daoE->consultaIndividualUsuario($id);
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
        if (document.getElementById('rol').value === "0" 
          || document.getElementById('usuario').value == ""
          || document.getElementById('contrasena').value == ""
          || document.getElementById('empleado').value === "0"
          || document.getElementById('estado').value === "" 
          || document.getElementById('dui').value == "") {
            //alert("Complete los campos antes de guardar");
            mostrarMensaje("SYS BOUTIQUE", "Complete los campos antes de guardar", "error","RegistraUsuarios.php",1000);
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
        location.href = "RegistraUsuarios.php?id="+id;
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
        $('#usuario').val('');
        $('#contrasena').val('');
        $('#dui').val('');
        location.href="RegistraUsuarios.php";
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
            <h1>Usuario</h1>
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
                    <input type="hidden" name="baccion" id="baccion" value="<?php if(isset($objE)) echo $objE->getId(); ?>">
                <section class="content">
                <div class="container-fluid">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-md-5">
                  <label>Rol</label>
                  <select class="form-control select2" style="width: 80%;" id="rol" name="rol">
                    <?php
                            if (isset($objE)) {
                  echo "<option selected value='" . $objE->getRol(). "'>" . $objE->getRol() . "</option>";
                  echo "<option value='administrador' >Administrador</option>";
                  echo "<option value='vendedor'>Vendedor</option>";
                                                     } else {
                                                                                             
                                       echo "<option value='0'>[Seleccione...]</option>";
                                       echo "<option value='administrador' >Administrador</option>";
                  echo "<option value='vendedor'>Vendedor/a</option>";
                                                    }
                              
                          
                     ?>
                  </select>
                   </div> 

                    <div class="col-md-5">
                    <label >Usuario</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" minlength="6" maxlength="20" required placeholder="juanbenites,maria_araujo"
                    value="<?php if(isset($objE)) echo $objE->getUsuario(); ?>">
                  </div>
                  <div class="col-1"></div>

                  <div class="col-1"></div>
                  <div class="col-md-4">
                    <label >Contraseña</label>
                    <input type="pass" class="form-control" id="contrasena" name="contrasena" minlength="8" maxlength="20" placeholder="000/@AaBD23182"
                    value="<?php if(isset($objE)) echo $objE->getContrasena(); ?>">
                  </div>
                  <div class="col-1"></div>
                  <div class="col-md-5">
                    <label >DUI</label>
                    <input type="text" class="form-control" id="dui" name="dui" 
                  <?php if (isset($objE)) echo "readonly='readonly' "; ?>  placeholder="00000000-0"
                    value="<?php if(isset($objE)) echo $objE->getDui(); ?>">
                  </div>   
                  <div class="col-1"></div> 
                  <div class="col-1"></div>
                <div class="col-md-5">
                  <label>Estado</label>
                  <select class="form-control select2" style="width: 80%;" id="estado" name="estado">
                    <?php
                            if (isset($objE)) {
                                      echo "<option selected value='" . $objE->getEstado(). "'>" . $objE->getEstado() . "</option>";
                                      echo "<option value='1' >Activo</option>";
                                      echo "<option value='0'>Inactivo</option>";
                                                     } else {
                                                                                             
                                       echo "<option value=''>[Seleccione...]</option>";
                                       echo "<option value='1' >Activo</option>";
                                       echo "<option value='0'>Inactivo</option>";
                                                    }    
                     ?>
                  </select>
                   </div>    
                      
                     
                   <div class="col-md-5">
                  <label>Empleado</label>
                  <select class="form-control select2" style="width: 100%;" id="empleado" name="empleado">
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
                    <input type="hidden" name="baccion1" id="baccion1" value="<?php if(isset($objE)) echo $objE->getId(); ?>">
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
                  <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 237.764px;">Rol</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 304.125px;">Usuario</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 555.555px;">Contraseña </th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 146.139px;">Estado </th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 146.139px;">DUI </th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 146.139px;">Acciones</th>
                </tr>
                </thead>
                <tbody>
                  <?php
               require_once "../controlador/DAOUsuario.php";
               $daoE=new DAOUsuario();
                 $fila=$daoE->consultaUsuarios();
                 $objC=null;
                 $objE=null;

                 foreach ($fila as $key=> $value) {
                     echo "<tr>";
                        echo "<td>".$value->getRol()."</td>";
                         echo "<td>".$value->getUsuario()."</td>";
                         echo "<td>".$value->getContrasena()."</td>";
                         echo "<td>".$value->getEstado()."</td>";
                         echo "<td>".$value->getDui()."</td>";
                         echo " <td> <div class='dropdown m-b-10'>
                                    <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                        Seleccione
                                    </button>
                                    <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                        <a class='dropdown-item btn_eliminar' data-id='' href='javascript:void(0)'
                                        onclick=showConfirmMessage('".$value->getId()."')>Eliminar</a>
                                        <a class='dropdown-item btn_editar' data-id='' href='javascript:void(0)' 
                                        onclick= imprimir('".base64_encode($value->getDui())."')>Actualizar</a>
                                    </div>
                                </div>";


                   echo "</td></tr>";
               }
           ?>
              
               
               
                    

                </tbody>
                <tfoot>
                <tr>
                  <th rowspan="1" colspan="1">Rol</th>
                  <th rowspan="1" colspan="1">Usuario</th>
                  <th rowspan="1" colspan="1">Contraseña</th>
                  <th rowspan="1" colspan="1">Estado</th>
                  <th rowspan="1" colspan="1">DUI</th>
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
    $rol=(isset($_REQUEST["rol"]))?$_REQUEST["rol"]:"";
    $usuario=(isset($_REQUEST["usuario"]))?$_REQUEST["usuario"]:"";
    $contrasena=(isset($_REQUEST["contrasena"]))?$_REQUEST["contrasena"]:"";
    $dui=(isset($_REQUEST["dui"]))?$_REQUEST["dui"]:""; 
    $estado=(isset($_REQUEST["estado"]))?$_REQUEST["estado"]:"";  
    $empleado=(isset($_REQUEST["empleado"]))?$_REQUEST["empleado"]:"";


    if($bandera=="add"){
        require_once "../controlador/DAOUsuario.php";  
        $daoE=new DAOUsuario();
        if ($daoE-> insertarUsuario(new ClaseUsuario('tb_usuarios',$rol,$usuario,$contrasena,$dui,$empleado,$estado))==1) {   
            msg("Sys-BOUTIQUE", "Datos almacenados (- o)", "success","RegistraUsuarios.php",1000);
        } else {
            msg("Sys-BOUTIQUE", "Error de guardado!", "danger","RegistraUsuarios.php",1000);
        }
    }else if($bandera=="edicion"){
        require_once "../controlador/DAOUsuario.php"; 
        $daoE=new DAOUsuario();
       if ($daoE->actualizarUsuario(new ClaseUsuario($baccion,$rol,$usuario,$contrasena,$dui,$empleado,$estado))==1) {
            # code...
            msg("Sys-BOUTIQUE", "Datos actualizados (- o)", "success","RegistraUsuarios.php",1000);
        } else {
            # code...
            msg("Sys-BOUTIQUE", "Error de actualización!", "danger","RegistraUsuarios.php",1000);
        }
        
    }

    if ($bandera1=="delete") {
        # code...
        require_once "../controlador/DAOUsuario.php";
        $daoE=new DAOUsuario();
        if ($daoE->eliminarUsuario($baccion1)==1) {
            msg("Sys-BOUTIQUE", "Registro Eliminado (- o)", "success","RegistraUsuarios.php",1000);
            # code...
        } else {
            msg("Sys-BOUTIQUE", "Registro no eliminado (- o)", "success","RegistraUsuarios.php",1000);
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