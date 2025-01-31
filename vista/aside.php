<?php  
    @session_start();
        $rol=null;
        $rol=''.$_SESSION['rol'];


?>
<script>
function abrir(URL){
window.open(URL,"",'width=900,height=700,left=320, top=200,toolbar=0,scrollbars=0,statusbar=0,menubar =0,resizable=0');
}
</script>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index1.php" class="brand-link">
      <img src="./dist/img/logo_elcarmen.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">BOUTIQUE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
     <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/ues.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">UES PARACENTRAL</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php 
            if($rol=='bodeguero'){
           ?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Inventario
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
            <a href="bien_mueble.php" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Insertar Bien Mueble</p>
                </a>
              <a href="tabla_bienes_muebles.php" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Lista de Bienes Muebles
                <i class="fas  right"></i>
              </p>
            </a>
            <a href="tabla_unidades.php" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Listados Generales 
                <i class="fas  right"></i>
              </p>
            </a>

            <a onclick="abrir('http://localhost/SIRA/controlador/pdf3.php')"  class="nav-link ">
                  <i class="nav-icon fas fa-book"></i>
                  <p> Reporte</p>
                </a>

                
              </li>
            </ul>
          </li>
           <?php } else if($rol=='secretario'){ ?>

          <li class="nav-item has-treeview menu-open">
            <a href="tabla_actas.php" class="nav-link active">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                Actas Matrimoniales
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
          <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="tabla_actas.php" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Lista de Actas
                <i class="fas  right"></i>
              </p>
            </a>
                <a href="registro_acta_matrimonio.php" class="nav-link">
                  <i class="nav-icon fas fa-book"></i>
                  <p>Crear acta de Matrimonio</p>
                </a>
          </li>
          </ul>
         </li>
       <?php } else {?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Inventario
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
            <a href="ingreso_producto.php" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ingresar nuevo producto</p>
                </a>
              <a href="tabla_productos.php" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Inventario de productos
                <i class="fas  right"></i>
              </p>
            </a>
            <a href="proveedores.php" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Proveedores
                <i class="fas  right"></i>
              </p>
            </a>
            <a href="categorias.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Categoria de productos 
                <i class="fas  right"></i>
              </p>
            </a>
            <a href="cebra.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Generar codigo de barras.
                <i class="fas  right"></i>
              </p>
            </a>

           
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview menu-open">
            <a href="registra_venta.php" class="nav-link active">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                Ventas
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
          <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="registra_venta.php" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Registrar venta
                <i class="fas  right"></i>
              </p>
            </a>
            <a href="tabla_productosr.php" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Productos reservados
                <i class="fas  right"></i>
              </p>
            </a>
            <a href="tabla_ventas.php" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Historial de ventas
                <i class="fas  right"></i>
              </p>
            </a>
          </li>
          </ul>
         </li>

          <li class="nav-item has-treeview menu-open">
            <a href="clientes.php" class="nav-link active">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                Clientes
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
          <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="clientes.php" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Lista de Clientes
                <i class="fas  right"></i>
              </p>
            </a>
          </li>
          </ul>
         </li>
         <li class="nav-item has-treeview menu-open">
            <a href="RegistraUsuarios.php" class="nav-link active">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                Usuarios
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
          <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="empleados.php" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Administrar Empleados
                <i class="fas  right"></i>
              </p>
            </a>
          </li>
          </ul>

          <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="RegistraUsuarios.php" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Administrar Usuarios
                <i class="fas  right"></i>
              </p>
            </a>
          </li>
          </ul>
         </li>
         <li class="nav-item has-treeview menu-open">
            <a href="" class="nav-link active">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                Reportes
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
          <li class="nav-item">
             <a onclick="abrir('../controlador/pdf3.php')"  class="nav-link ">
                  <i class="nav-icon fas fa-book"></i>
                  <p>Ventas de hoy</p>
                </a>
                <a href="reporte_fecha.php" class="nav-link ">
                  <i class="nav-icon fas fa-book"></i>
                  <p>Ventas por fecha</p>
                </a>
                <a href="reporte_emp.php" class="nav-link ">
                  <i class="nav-icon fas fa-book"></i>
                  <p>Ventas por empleado</p>
                </a>
                <a onclick="abrir('../controlador/pdf7.php')"  class="nav-link ">
                  <i class="nav-icon fas fa-book"></i>
                  <p>Ventas de los ultimos 7 dias</p>
                </a>
                <a onclick="abrir('../controlador/pdf30.php')"  class="nav-link ">
                  <i class="nav-icon fas fa-book"></i>
                  <p>Ventas de los ultimos 30 dias</p>
                </a>
                <a onclick="abrir('../controlador/pdf_anioactual.php')"  class="nav-link ">
                  <i class="nav-icon fas fa-book"></i>
                  <p>Ventas del año actual</p>
                </a>
          </li>
          </ul>

           
        </li>
       <?php } ?>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
  </aside>
