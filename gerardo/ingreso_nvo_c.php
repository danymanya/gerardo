<?php
/**
 *  Index del usuario autenticado
 *
 *  @package
 */
    include_once 'conf.php';
	include($_SERVER['DOCUMENT_ROOT'].$dir.'smarty.init.php');
    	
    //include_once 'menu.php';
    
    if (isset($_SESSION['autoriza'])) {
    //si la variable de sesion indica que esta logueado
        //$rol = $_SESSION['rol'];
        $nombre = $_SESSION['nombre'].' '.$_SESSION['apellido'];
		$msg = '';
        $template->assign('msg', $msg);
		$template->assign('nombre', $nombre);
        $template->display('ingreso_nvo_c.tpl');
    }
    
    //si la variable indica que no esta logueado
        //mostrar mensaje de error usuario no autorizado

?>