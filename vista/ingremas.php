<?php

    if (isset($_REQUEST['id'])) {/* comprobamos si la variable que viene en la url si existe */
        # code...
        require ("../controlador/DAOProducto.php");
        $daoE=new DAOProducto();
        $id=base64_decode($_REQUEST['id']);
        $objE=null;
        $objCo=null;
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
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link href="assets/sweetalert/sweetalert.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

   <script language="javascript">
    function validacion() {
        if (document.getElementById('nombre').value == ""
          || document.getElementById('estilo').value == "" 
          || document.getElementById('marca').value == ""
          || document.getElementById('color').value == ""
          || document.getElementById('descripcion').value == ""
          || document.getElementById('costo').value == ""
          || document.getElementById('ganancia').value == ""
          || document.getElementById('categoria').value === "0"
          || document.getElementById('proveedor').value === "0"
          || document.getElementById('talla').value === "0"
          || document.getElementById('cantidad').value == "") {
            //alert("Complete los campos antes de guardar");
            mostrarMensaje("SysVM", "Complete los campos antes de guardar", "error","ingreso_producto.php",1000);
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
        $('#nombre').val('');
        $('#estilo').val('');
        $('#marca').val('');
        $('#color').val('');
        $('#descripcion').val('');
        $('#costo').val('');
        $('#ganancia').val('');
        $('#proveedor').val('');
        location.href="ingreso_producto.php";
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
            <h1>Ingreso de Productos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#" onclick="abrir('http://localhost:8012/SIRA/vista/ayudas/ingreso_bmp.pdf')">Ayuda</a></li>
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
              <div class="card-header" >
                <h3 class="card-title">Cuadro de insercion</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post" class="form-group" enctype="multipart/form-data" id="asociaciones" name="asociaciones">
                <input type="hidden" name="bandera" id="bandera">
                <input type="hidden" name="baccion" id="baccion" value="<?php if(isset($objE)) echo $objE->getId_prod(); ?>">
                <section class="content">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-1"></div>
                    <div class="col-3">
                    <label>Codigo</label>
                    <input type="text"  class="form-control"  id="codigo" name="codigo" placeholder="000000-0-0-00-0000" data-parsley-error-message="Campo obligatorio" required  readonly="readonly"
                    <?php
                            if (isset($objE)) {
                  echo "readonly='readonly' ";
                  }
                  ?>
                    value="<?php if(isset($objE)) echo $objE->getCodigo(); ?>">
                  </div>

                  <div class="col-2">
                    <label>Estilo</label>
                    <input type="text"  class="form-control"  id="estilo" name="estilo" placeholder="000000-0-0" 
                    <?php
                            if (isset($objE)) {
                  echo "readonly='readonly' ";
                  }
                  ?>
                    value="<?php if(isset($objE)) echo $objE->getEstilo(); ?>">
                  </div>
                    
                    <div class="col-3">
                    <label for="exampleInputPassword1">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Laptop,escritorio,buro,etc" data-parsley-error-message="Campo obligatorio" required minlength="3" maxlength="45"
                    value="<?php if(isset($objE)) echo $objE->getNombre(); ?>">
                  </div>
                  <div class="col-md-2">
                    <label for="exampleInputPassword1">Marca</label>
                    <input type="text" class="form-control" id="marca" name="marca" placeholder="" minlength="3" maxlength="25"
                    value="<?php if(isset($objE)) echo $objE->getMarca(); ?>">
                  </div>
                  <div class="col-1"></div>
                  <div class="col-1"></div>
                    <div class="col-md-3">
                  <label>Proveedores</label>
                  <select class="form-control select2" style="width: 100%;" id="proveedor" name="proveedor">
                    <option value='0'>[Seleccione...]</option>
                    <?php
                        require "../controlador/DAOProveedor.php";
                        $daoP = new DAOProveedor();
                        $fila2 = $daoP->consultaProveedores();
                        foreach ($fila2 as $key => $value) {
                            if (isset($objE)) {
                                    if ($value->getEmpresa() == $objE->getProveedor()) {
                                        echo "<option selected value='" . $value->getEmpresa() . "'>" . $value->getEmpresa() . "</option>";                                    } else {
                                        echo "<option value='" . $value->getEmpresa() . "'>" . $value->getEmpresa() . "</option>";
                                    }
                                } else {
                                                                                             
                                       echo "<option value='". $value->getEmpresa() ."'>" . $value->getEmpresa() . "</option>";
                                                    }
                               
                            }
                     ?>
                  </select>
                  </div>

                    <div class="col-md-3">
                  <label>Categoria de Producto</label>
                  <select class="form-control select2" style="width: 100%;" id="categoria" name="categoria">
                    <option value='0'>[Seleccione...]</option>
                    <?php
                        require "../controlador/DAOCategoria.php";
                        $daoP = new DAOCategoria();
                        $fila = $daoP->consulta();
                        foreach ($fila as $key => $value) {
                            if (isset($objE)) {
                                    if ($value->getId_cat() == $objE->getId_cat()) {
                                        echo "<option selected value='" . $value->getId_cat() . "'>" . $value->getNombre() . "</option>";                                    } else {
                                        echo "<option value='" . $value->getId_cat() . "'>" . $value->getNombre() . "</option>";
                                    }
                                } else {
                                                                                             
                                       echo "<option value='". $value->getId_cat() ."'>" . $value->getNombre() . "</option>";
                                                    }
                               
                            }
                     ?>
                  </select>
                  </div>
                                                     
                  <div class="col-md-2">
                  <label>Talla</label>
                  <select class="form-control select2" style="width: 100%;" id="talla" name="talla">
                    <?php
                            if (isset($objE)) {
                  echo "<option selected value='" . $objE->getTallas(). "'>" . $objE->getTallas() . "</option>";
                  echo "<option value='S' >S</option>";
                  echo "<option value='M'>M</option>";
                  echo "<option value='L' >L</option>";
                  echo "<option value='XL'>XL</option>";
                  echo "<option value='XXL' >XXL</option>";
                  echo "<option value='XXXL'>XXXL</option>";
                                                     } else {
                                                                                             
                  echo "<option value='0'>[Seleccione...]</option>";
                  echo "<option value='S' >S</option>";
                  echo "<option value='M'>M</option>";
                  echo "<option value='L' >L</option>";
                  echo "<option value='XL'>XL</option>";
                  echo "<option value='XXL' >XXL</option>";
                  echo "<option value='XXXL'>XXXL</option>";
                                                    }
                              
                          
                     ?>
                  </select>
                   </div> 

                   <div class="col-md-2">
                    <label>Cantidad</label>
                    <input type="number" min="1" max="999999"  class="form-control" id="cantidad" name="cantidad" placeholder="12,24..."
                    value="">
                  </div>
         
                  <div class="col-1"></div>
                  <div class="col-1"></div>
                    <div class="col-md-3">
                    <label >Descripción</label>
                    <textarea class="form-control" rows="2" maxlength="60" id="descripcion" name="descripcion" placeholder="Enter ..."
                    value="<?php if(isset($objE)) echo $objE->getDescripcion(); ?>"><?php if(isset($objE)) echo $objE->getDescripcion(); ?></textarea>
                  </div>   

                  <div class="col-2">
                    <label for="exampleInputPassword1">Color</label>
                    <input type="text" class="form-control" id="color" name="color" placeholder="Rojo, gris, negro..." data-parsley-error-message="Campo obligatorio" required minlength="3" maxlength="20"
                    value="<?php if(isset($objE)) echo $objE->getColor(); ?>">
                  </div>


                  <div class="col-md-3">
                    <label>Costo en Dolares</label>
                    <input type="number" min="1" max="999999"  class="form-control" id="costo" name="costo" placeholder="$900.00"
                    value="<?php if(isset($objE)) echo $objE->getCosto(); ?>">
                  </div>

                  <div class="col-md-2">
                    <label>Cantidad a ganar</label>
                    <input type="number" min="1" max="999999"  class="form-control" id="ganancia" name="ganancia" placeholder="$900.00"
                    value="<?php if(isset($objE)) echo $objE->getCantidad_gan(); ?>">
                  </div>    
                  <div class="col-1"></div>
                  <div class="col-1"></div>



                  
                  <div class="col-1"></div>                
                   
                </div>
                </div><!-- /.container-fluid -->
    </section>
                <!-- /.card-body -->

                <div class="card-footer" style="width: 50%; margin-left: 50%; transform: translateX(-50%);">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="cheki" name="cheki" value="1">
                    <label class="form-check-label" for="cheki">¿Agregar el mismo estilo?</label>
                  </div>
                  <button type="button" style="background-color:#007bff; border-color:white; color:white; width: 48%;" class="btn btn-success swalDefaultSuccess" 
                   onclick="validacion()"><?php if(isset($id)) echo "Guardar"; else echo "Agregar2";?></button>
                                                <button type="button" class="btn btn-warning" style="width: 48%;" 
                                                onclick="limpiar()">Limpiar</button>
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
<script src="plugins/select2/js/select2.full.min.js"></script>
<script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<script src="plugins/moment/moment.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="assets/sweetalert/sweetalert.min.js"></script>
<script src="../controlador/funciones_mascaras.js"></script>
 <script type="text/javascript" src="../public/plugins/parsleyjs/parsley.min.js"></script>
        <!-- Bootstrap inputmask js -->
<script src="../public/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
<script>
          //  $("#recuperar_form").parsley();
           // $("#codigo").inputmask({mask: "999999-9-9-99-9999"});  //static mask

        $(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('.swalDefaultSuccess').click(function() {
      Toast.fire({
        type: 'success',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });

    $('.toastrDefaultSuccess').click(function() {
      toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
     });
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
    $cheki=(isset($_REQUEST["cheki"]))?$_REQUEST["cheki"]:"";


    if($bandera=="add"){
      require_once "../controlador/DAOProducto.php"; 
      $daoE=new DAOProducto();
      $codigo_p=null;
      $ganan=null;
      $ganan=($costo+$ganancia);
      $codigo_p='0'.$categoria.'-'.$estilo.'-00'.$ganan.'10';
      $ult_id="";
      $ult_id=($daoE->consultaUltimoproducto()); 

      for ($i = 0; $i < $cantidad; $i++) {
        
        
        $daoE-> insertar(new ClaseProducto(null,$codigo_p.'-0'.$ult_id+$i,$estilo,$nombre,$marca,$color,$talla,$descripcion,$costo, $ganancia,$categoria,$proveedor,1));
      }

      msg("Sys-BOUTIQUE", "".$cantidad. " productos almacenados ", "success","tabla_productos.php",2000);

    }else if($bandera=="edicion"){
       require_once "../controlador/DAOProducto.php"; 
      $daoE=new DAOProducto();
      $codigo_p=null;
      $ganan=null;
      $ganan=($costo+$ganancia);
      $codigo_p='0'.$categoria.'-'.$estilo.'-00'.$ganan.'10';
      $ult_id="";
      $ult_id=($daoE->consultaUltimoproducto()); 

      for ($i = 0; $i < $cantidad; $i++) {
        
        
        $daoE-> insertar(new ClaseProducto(null,$codigo_p.'-0'.$ult_id+$i,$estilo,$nombre,$marca,$color,$talla,$descripcion,$costo, $ganancia,$categoria,$proveedor,1));
      }
      $ultimo=0;
      $ultimo=$daoE->consultaUltimoproducto();
      
     if($cheki=='1'){ 
      msg("Sys-BOUTIQUE", "".$cantidad. " productos almacenados ", "success","ingremas.php?id=".base64_encode($ultimo),2000);
      }else{
          msg("Sys-BOUTIQUE", "".$cantidad. " productos almacenados ", "success","tabla_productos.php",2000);
      }
        
    }

    function msg($titulo, $texto, $tipo,$pagina,$tiempo)
    {
        echo "<script type='text/javascript'>";
        echo "mostrarMensaje('$titulo','$texto','$tipo','$pagina','$tiempo');";
        echo "</script>";
    }
?>