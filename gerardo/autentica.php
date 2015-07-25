<?php
/**
 * Sistema de Gestion
 *
 * @file           autentica.php
 * @package        proyecto
 * @author         dany.gonzalez.87@gmail.com
 * @since          Lunes, 02 de Setiembre de 2013
 * @version        0.1
 */
    require_once('MDB2.php');
    require_once 'conf.php';
	include ($_SERVER['DOCUMENT_ROOT'].$dir.'smarty.init.php');
    include ($_SERVER['DOCUMENT_ROOT'].$dir.'servidor.php');
	include ($_SERVER['DOCUMENT_ROOT'].$dir.'dbo/dbo_usuarios.php');
	
	
        //obtengo usuario y contraseña de formulario
        $usuario = $_POST['user'];
	$password = $_POST['password'];
        
        //armo la conexion
        $db = MDB2::connect("$motor://$usr:$pass@$serv/$BD");
        
	$db_usu = new dbo_usuarios($db);
	
        //consulto si existe el usuario
	$usu = $db_usu->existe($usuario);
	
	//si hay un usuario
        if ($usu) {
                //verifico la contraseña
                $valido = $db_usu->validar($usuario, $password);
                //si es valido guardo lo que me interesa
                if ($valido){
			//si existe lo autorizo a pasar
			$_SESSION['autoriza'] = "SI";
                        $_SESSION['usuario'] = $usuario;
                        $_SESSION['password'] = $password;
	                $obtUsu = (array) $db_usu->obt($usuario);
                        $_SESSION['nombre']= $obtUsu['nombre'];
                        $_SESSION['apellido']= $obtUsu['apellido'];
                        $rol = $obtUsu['permisos'];
                        $_SESSION['rol'] = $rol;
                        //lo envio a la pagina de usuarios autenticados
                        header("Location: index_auth.php");
		} else {
			//sino usuario o contraseña invalidos
			$msg ="<strong>Error: Contraseña incorrecta</strong>";
			$template->assign('msg', $msg);
			$template->display('index.tpl');
		}
	} else {
		//sino usuario o contraseña invalidos
		$msg ="<strong>Error: No existe el usuario</strong>";
		$template->assign('msg', $msg);
		$template->display('index.tpl');
	}	
	
?>