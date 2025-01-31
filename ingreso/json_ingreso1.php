<?php 
	@session_start();
	require_once("../conexion/Modelo_generico.php");
	$modelo = new Modelo_generico();
	if (isset($_POST['validar_dui']) && $_POST['validar_dui']=="actualizar_pass") {
		
		$array = array(
			"table"=>"tb_usuarios",
			"id"=>$_POST['el_id'],
			"contrasena"=>$modelo->encriptarlas_contrasenas($_POST['la_contra'])
		);
		$resultado = $modelo->actualizar_generica($array);
		if($resultado[0]=='1' && $resultado[4]>0){
            print json_encode(array("Exito",));
            exit();
        }else {
            print json_encode(array("Error",$_POST,$resultado));
            exit();
        }


	}else if (isset($_POST['validar_dui']) && $_POST['validar_dui']=="si_validar") {

		$resultado = $modelo->get_todos("tb_usuarios","WHERE dui = '".$_POST['el_dui']."'");
        if($resultado[0]=='1' && $resultado[4]>0){
            print json_encode(array("Exito",$resultado[2][0]['id'],$_POST,$resultado[2][0]));
            exit();

        }else {
            print json_encode(array("Error",$_POST,$resultado));
            exit();
        }

	}else if (isset($_POST['desbloquear']) && $_POST['desbloquear']=="si_con_contrasena") {
		$sql = "SELECT *FROM tb_usuarios AS tp
				WHERE tp.usuario = '$_SESSION[usuario]' ";
		$resultado = $modelo->get_query($sql);
		if ($resultado[0]==1 && $resultado[4]==1) {
			$verificacion = $modelo->desencrilas_contrasena($_POST['contrasena'],$resultado[2][0]['contrasena']);
			if ($verificacion[0]===1) {
				$array = array("Exito","Bienvenido nuevamente ".$resultado[2][0]['usuario'],$resultado);
				$_SESSION['logueado']="si";
				$_SESSION['bloquear_pantalla']="no";
				print json_encode($array);

			}else{
				$array = array("Error","La contraseña no coincide",$resultado);
				print json_encode($array);
			}
		}else{
			$array = array("Error","Datos no existen",$resultado);
			print json_encode($array);
		}


	}else if (isset($_POST['consultar_login']) && $_POST['consultar_login']=="si_consultalo") {

		$sql = "SELECT *FROM tb_usuarios AS tp
				WHERE tp.usuario = '$_POST[correo]' ";

		$resultado = $modelo->get_query($sql);
		if ($resultado[0]==1 && $resultado[4]==1) {
			$verificacion = $modelo->desencrilas_contrasena($_POST['contrasena'],$resultado[2][0]['contrasena']);
			if ($verificacion[0]===1) {
				
				$_SESSION['logueado']="si";
				$_SESSION['bloquear_pantalla']="no";
				$_SESSION['rol']=$resultado[2][0]['rol'];
			#	$_SESSION['tipo_persona']=$resultado[2][0]['tipo_persona']; 
				$_SESSION['usuario']=$resultado[2][0]['usuario'];
				#$_SESSION['correo']=$resultado[2][0]['email'];

				$array = array("Exito","Bienvenido al sistema ".$resultado[2][0]['usuario'],$resultado,$_SESSION);
				print json_encode($array);
				exit();
			}else{
				$array = array("Error","La contraseña no coincide",$resultado,$_SESSION);
				print json_encode($array);
				exit();
			}
		}else{
			$array = array("Error","Datos no existen",$resultado);
			print json_encode($array);
			exit();
		}

		 

	}



?>