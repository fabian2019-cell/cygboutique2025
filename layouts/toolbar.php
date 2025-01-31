<?php  
    @session_start();
    if (isset($_SESSION['logueado']) && $_SESSION['logueado']=="si") {
        $name1=null;
        $name1=''.$_SESSION['usuario'];
        $rol=null;
        $rol=''.$_SESSION['rol'];
       if ($_SESSION['bloquear_pantalla']=="no") {
           // code...
       }else{
            header("Location: ../ingreso/bloqueo.php");
       }
    }else{
        header("Location: ../ingreso/index.php");
    }


?>
<script>
function abrir(URL){
window.open(URL,"",'width=900,height=700,left=320, top=200,toolbar=0,scrollbars=0,statusbar=0,menubar =0,resizable=0');
}
</script>
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
            <i class="fas fa-users mr-2"></i> <?php echo ''.$name1.' ('.$rol.')'; ?>
          </a>
          <div class="dropdown-divider"></div>
          <a href="../ingreso/bloqueo.php" class="dropdown-item">
            <i class=""></i> Bloquear pantalla
          </a>
          <div class="dropdown-divider"></div>
          <a href="../vista/respaldoInventario/index.php" class="dropdown-item">
            <i class=""></i>Crear respaldo de inventario.
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