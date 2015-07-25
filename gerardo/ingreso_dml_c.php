<?php
/**
 *  Inserci?, eliminaci?, modificaci? de Instanicas de trabajo
 *
 *  Recibe los datos de los formularios y determina la operaci? a realizar.
 *  Arma el objeto para insertar o modificar a partir de la informaci? que
 *  llega del formulario de captura de datos.
 *
 *  @url        parte_diario_dml.php
 *  @package    Colegio Seminario
 *	@author		Gonz?ez, Daniel <dany.gonzalez.87@gmail.com>
 *  @since      Lun 19 Ago 2013
 *  @version    1.0
 *  @param      string $op  Operaci?
 */
 
	include_once 'conf.php';
	include ($_SERVER['DOCUMENT_ROOT'].$dir.'smarty.init.php');
    include ($_SERVER['DOCUMENT_ROOT'].$dir.'servidor.php');
	include ($_SERVER['DOCUMENT_ROOT'].$dir.'dbo/dbo_clientes.php');
	require_once 'MDB2.php';
	
	if ((($_SERVER["REQUEST_METHOD"]=="POST") and ($_POST['btConf']!="Cancelar"))
		or
	  (($_SERVER['REQUEST_METHOD']=="GET") and ($_GET['conf']=="si"))) {
		if(isset($_REQUEST['op'])){
			$op = $_REQUEST['op'];
		}
		if (isset($_REQUEST['inst'])) {
			$aInst = $_REQUEST['inst'];
		}
		
					
		//conecto a la base de datos
		$db = MDB2::connect("$motor://$usr:$pass@$serv/$BD");
		$do_pd = new dbo_clientes($db);		
		
		switch ($op) {
				case "I":
					$db->query('begin work');
					//creo el objeto a insertar					
					$oCli->rut = $aInst['rut'];
					$oCli->empresa = $aInst['empresa'];
					$oCli->nombre = $aInst['nombre'];
					$oCli->apellido = $aInst['apellido'];
					$oCli->direccion = $aInst['direccion'];
					$oCli->tel_of = $aInst['tel_of'];
					$oCli->tel_cont = $aInst['tel_cont'];
					$oCli->celular = $aInst['celular'];
					$oCli->correo = $aInst['correo'];
					$oCli->web = $aInst['web'];
					//inserto el objeto
					$okDoc = $do_pd->ins($oCli);
					//verifico que se haya insertado correctamente
					if($okDoc){
					  $db->query('commit work');
					  $msg = 'Datos Insertados Correctamente';
					  $template->assign('msg', $msg);
					  $clase= 'btn btn-success';
					  $template->assign('clase', $clase);
					  $nombre = $_SESSION['nombre'].' '.$_SESSION['apellido'];
					  $template->assign('nombre', $nombre);
					  $template->display('ingreso_nvo_c.tpl');
					}else{
					  $db->query('rollback work');
					  $msg = 'Error en la inserción';
					  $template->assign('msg', $msg);
					  $clase= 'btn btn-danger';
					  $template->assign('clase', $clase);
					  $nombre = $_SESSION['nombre'].' '.$_SESSION['apellido'];
					  $template->assign('nombre', $nombre);
					  $template->display('ingreso_nvo_c.tpl');
					}
				break;

				case "U":
					//actualizar
					$db->query('begin work');					
					//Actualizo Instancia Tiempo
					$oStf = $do_pd->obt($nro_pd);
					$oStf->usuario = $aInst['usuario'];
					$oStf->fecha = str2fch($aInst['fecha']);
					$oStf->hora = $aInst['hora'];
					$oStf->texto = $aInst['texto'];
					
					//completo la auditoria
					$oAud->fecha = $oStf->fecha;
					$oAud->time = $oStf->hora;
					$oAud->texto = $oStf->texto;		
					
					//cargo archivos
					if (is_array($aArchivos)){
						if ($aArchivos['enlace']['name'] != '') {
							$clave = "pd";
							$nuevo_nombre = $directorio_archivos.'/'.$clave.'_'.$aArchivos['enlace']['name'];
							$oStf->enlace = $aArchivos['enlace']['name'];
							$oAud->enlace = $oStf->enlace;
							$okCopia = move_uploaded_file($aArchivos['enlace']['tmp_name'],$nuevo_nombre);
						}
					}
					
					$okStf = $do_pd->upd($oStf);
					//inserto en parte_diario_audit
					$okAud = $do_pd_aud->ins($oAud);

					if($okStf){//Exito guardo el trabajo
						$db->query('commit work');
						$msg = KM_REG_MODIFICADO;
					}else{
						$db->query('rollback work');
						$msg = KM_ERR_MODIF;
					}
				break;

				case "D":
					//eliminar
					$db->query('begin work');
					//Obtengo el objeto
					$existe = $do_pd->existe($nro_pd);
					if ($existe){
						$existe_fks = $do_pd->fks($nro_pd);
						if(!$existe_fks){
							$okStf = $do_pd->del($nro_pd);
						}
					}

					if($okStf){//Exito guardo el trabajo
						$db->query('commit work');
						if(!$existe_fks){
							$msg = KM_REG_ELIMINADO;
						} else {
							$msg = KM_ELIM_NO_POSIBLE;
						}
					}else{
						$db->query('rollback work');
						$msg = KM_ERR_ELIM;
					}
				break;
			}
		$db->disconnect();
	}
			

?>