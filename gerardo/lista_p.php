<?php
/**
 *  Index del usuario autenticado
 *
 *  @package
 */
    include_once 'conf.php';
    include_once 'servidor.php';
	include($_SERVER['DOCUMENT_ROOT'].$dir.'smarty.init.php');
    include ($_SERVER['DOCUMENT_ROOT'].$dir.'dbo/dbo_proveedores.php');
	include ($_SERVER['DOCUMENT_ROOT'].$dir.'clases/qbe.class.php');
	
	include ($_SERVER['DOCUMENT_ROOT'].$dir.'clases/paginador2.class.php');    	
    //include_once 'menu.php';
    
    if (isset($_SESSION['autoriza'])) {
    //si la variable de sesion indica que esta logueado
        //$rol = $_SESSION['rol'];
        $nombre = $_SESSION['nombre'].' '.$_SESSION['apellido'];
		$msg = '';
        $db = MDB2::connect("$motor://$usr:$pass@$serv/$BD");
		
		/**************agregado de otro lado*****************/
		$qbe = new qbe('lista_p');
		$argsDefDato = $qbe->iniciaArreglo(2);
		$argsDefValor = $qbe->iniciaArreglo(2);


		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if ($_POST['btBuscar'] == 'Buscar') {
				// botón buscar
				$cond = $qbe->cond($_POST['arg']);
				
			} elseif ($_POST['btBuscar'] == 'Restablecer') {
				// botón restablecer
				$cond = $qbe->resetCond();
			} else {
				// del paginador
				$cond = $qbe->retrieveCond();
			}
		} else {
			// REQUEST_METHOD es 'GET'
			$cond = $qbe->retrieveCond();
		}

		if (!isset($cond)) {
			$cond = "1=1";
		}

		$argsDefDato = $qbe->iniciaArreglo(2,$argsDefDato);
		$argsDefValor = $qbe->iniciaArreglo(2,$argsDefValor);
		
		/*
		* argumentos de búsqueda
		*/

		/*
		* Fecha
		*/
		$cols = array();
		$data = '';
		$cols[] = array("colName" => "proveedores.rut", "colLabel" => "RUT"     , "colOp" => "=");
		$qbe->addArg($cols, $data, "=", $argsDefDato[0], $argsDefValor[0]);

		/*
		* Persona
		*/
		$cols = array();

		$cols[] = array("colName" => "proveedores.empresa", "colLabel" => "Empresa"     , "colOp" => "=");
		$qbe->addArg($cols, $data, "=", $argsDefDato[1], $argsDefValor[1]);

		/*
		* Agreguemos un botón reset al buscador
		*/
		$qbe->setResetButton(true);
		$formulario = $qbe->getFormBootstrap();
		
		$do_proveedores = new dbo_proveedores($db);

		$cnt = $do_proveedores->cnt($cond);
		
		/*
		* paginador
		*/
		if(isset($_REQUEST['regPorPag'])){
			$pag = new paginador($cnt, $_REQUEST['regPorPag']);
		}else{
			$pag = new paginador($cnt);
		}

		// fijar el navegador en 5 páginas
		$pag->setCantPagNav(10);
		$navegador = $pag->obtNav(); // cadena de navegaciOn

		$order = "proveedores.rut desc, proveedores.empresa desc";
		$aProveedores = $do_proveedores->obt_todo($cond,$order, $pag->obtInicio(), $pag->obtCantRes());
		
		/**************************************************/
        
		$imagenes = 'http://desarrollo/cgonzalg/gerardo/img/';
		$template->assign('directorio', $imagenes );
		$template->assign('formulario', $formulario);
		$template->assign('nav', $navegador);
		$template->assign('paginado', $pag->obtPaginado());
		$template->assign('lista', $aProveedores);
        $template->assign('msg', $msg);
		$template->assign('nombre', $nombre);
        $template->display('lista_p.tpl');
    }
    
    //si la variable indica que no esta logueado
        //mostrar mensaje de error usuario no autorizado

?>