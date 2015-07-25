<?php
/**
 *  Data Object para tabla proveedores
 *  Generado con genDBO v7.1 del jue feb 17 19:02:17 UYST 2011
 *
 *	@class	dbo_proveedores
 */
require_once 'MDB2.php';
class dbo_proveedores {
	var $idconn;
	var $obtSQL;
	var $obtSelect;
	var $obtFrom;
	var $tablasRef = array();
	/**
	 *	constructor
	 *
	 *  @param int $conexion id de conexión a la BD
	 */
	public function __construct($conexion) {
		$this -> idconn = $conexion;
		$this -> idconn->setOption('portability', MDB2_PORTABILITY_ALL); // Máxima portabilidad
		$this -> idconn->setFetchMode(MDB2_FETCHMODE_ASSOC); // Predeterminado: Las consultas devuelven arrays asociativos
		/*
		 *	Sentencia SQL de recuperación de datos.
		 *	Es común a los métodos "obt()" y "obt_todo()"
		 */
		$this->obtSelect = "SELECT proveedores.*";
		$this->obtFrom   = " FROM proveedores";
		$this->obtSQL = $this->obtSelect . $this->obtFrom;
	}

	/**
	 *  existe
	 *
	 *  @param string(50) $rut
	 *  @return boolean
	 */
	function existe($rut) {
		$res = $this->obt($rut);
		return (is_object($res));
	}

	/**
	 *  Verificación de integridad de referencia
	 *
	 *  @param string(50) $rut
	 *  @return boolean
	 */
	function fks($rut) {
		$bExisteRef = false;
		for ($i=0; ($i<count($this->tablasRef)) and (!$bExisteRef); $i++) {
			$tabla = $this->tablasRef[$i];
			$qry = "SELECT count(*) cantidad from $tabla";
			$qry.= " WHERE rut = \"$rut\"";

			$res = $this->idconn->query($qry);
 			if (PEAR::isError($res)){
				die("Error en " . __METHOD__ . ": <br /><strong>" . $res->getDebugInfo() . "</strong>");
			}
			$oRow = $res->fetchRow();
			if (is_array($oRow)) {
				$bExisteRef = ($oRow['cantidad']!=0);
			}
		}
		return $bExisteRef;
	}

	/**
	 *  Obtener un registro
	 *
	 *  @param string(50) $rut
	 *  @return object | boolean
	 */
	function obt($rut) {

		$qry = $this->obtSQL;
		$qry.= " WHERE proveedores.rut = \"$rut\"";

		$res = $this->idconn->query($qry);
		if (PEAR::isError($res)) {
			if ($this->idconn->inTransaction()) {
				// estamos en el medio de una transacción; volvemos con el resultado		
				return $res;
			} else {
				die("Error en ". __METHOD__ .":<br /><strong>" . $res->getDebugInfo()."</strong>");
			}
		} else {
			$oRow = $res->fetchRow();
			$res->free();

			if (is_array($oRow)) {
				return (object) $oRow; // Cast a objeto
			} else {
				return false;
			}
		}
	}

	/**
	 *  Obtener toda la tabla en un array
	 *
	 *  @param string $cond condición
	 *  @param string $orden cláusula ORDER BY
	 *  @param int    $fil   fila desde donde recuperar
	 *  @param int    $cnt   cantidad de filas a recuperar, 30 por omisión
	 *  @return array | bolean | object
	 */
	function obt_todo($cond="1=1", $orden="1", $fil=0, $cnt=0) {
		$this->obtCols = preg_replace("/SELECT/i", "", $this->obtSelect);
		return ($this->obtQuery($this->obtCols, $cond, $orden, '', '', $fil, $cnt));

	}

	/**
	 *	Eliminación
	 *
	 *  @param string(50) $rut
	 *  @return boolean
	 */
	function del($rut) {
		$qry = "DELETE FROM proveedores";
   		$qry.= " WHERE rut = \"$rut\"";

		$res = $this->idconn->query($qry);
		$exito = PEAR::isError($res) == 0;

		return ($exito);
	}

	/**
	 *  Inserción
	 *
	 *  @param obj $proveedores
	 *  @return boolean
	 */
	function ins($proveedores) {
		$qry = "INSERT INTO proveedores (";
		$qry.= "rut,";
		$qry.= "empresa,";
		$qry.= "nombre,";
		$qry.= "apellido,";
		$qry.= "direccion,";
		$qry.= "tel_of,";
		$qry.= "tel_cont,";
		$qry.= "celular,";
		$qry.= "correo,";
		$qry.= "web)";
		$qry.= " VALUES (";
		$qry.= "\"$proveedores->rut\",";
		$qry.= "\"$proveedores->empresa\",";
		$qry.= "\"$proveedores->nombre\",";
		$qry.= "\"$proveedores->apellido\",";
		$qry.= "\"$proveedores->direccion\",";
		$qry.= "\"$proveedores->tel_of\",";
		$qry.= "\"$proveedores->tel_cont\",";
		$qry.= "\"$proveedores->celular\",";
		$qry.= "\"$proveedores->correo\",";
		$qry.= "\"$proveedores->web\")";

		$res = $this->idconn->query($qry);
		$exito = PEAR::isError($res) == 0;

		return ($exito);
	}

	/**
 	 *  Actualizar registro
	 *
	 *  @param obj $proveedores
	 *  @return boolean
	 */
	function upd($proveedores) {
		$qry = "UPDATE proveedores SET";
		$qry.= " empresa = \"$proveedores->empresa\",";
		$qry.= " nombre = \"$proveedores->nombre\",";
		$qry.= " apellido = \"$proveedores->apellido\",";
		$qry.= " direccion = \"$proveedores->direccion\",";
		$qry.= " tel_of = \"$proveedores->tel_of\",";
		$qry.= " tel_cont = \"$proveedores->tel_cont\",";
		$qry.= " celular = \"$proveedores->celular\",";
		$qry.= " correo = \"$proveedores->correo\",";
		$qry.= " web = \"$proveedores->web\"";
			$qry.= " WHERE rut = \"$proveedores->rut\"";

		$res = $this->idconn->query($qry);
		$exito = PEAR::isError($res) == 0;

		return ($exito);
	}

	/**
	 *  Cantidad de filas en la tabla
	 *
	 *  @return int
	 */
	function cnt_filas() {
		$qry = $this->obtSQL;
		$res = $this->idconn->query($qry);
		if (PEAR::isError($res)) {
			die("Error en " . __METHOD__ . ": <br /><strong>" . $res->getDebugInfo() . "</strong>");
		}

		$num = $res->numRows();
		$res->free();

		return $num;
	}

	/**
	 *  Obtener cantidad de tuplas que cumplen con una condición
	 *
	 *  @param string $cond condición
	 *  @return int
	 */
	function cnt($cond="1=1") {
		$qry = "SELECT count(*) cant";
		$qry.= $this->obtFrom;
		$qry.= " WHERE $cond";

		$res = $this->idconn->query($qry);
		if (PEAR::isError($res)){
			die("Error en " . __METHOD__ . ": <br /><strong>" . $res->getDebugInfo() . "</strong>");
		}

		$aRow = $res->fetchRow();
		$res->free();

		if (is_array($aRow)){
			return $aRow['cant'];
		} else {
			return false;
		}
	}
	/**
	 *  Asignar las tablas para el control de integridad referencial.
	 *
	 *  @param array $tablas
	 *  @return none
	 */
	function asigTablasRef($tablas) {
		$this->tablasRef = $tablas;
	}
	/**
 	 *  Actualizar Columna
	 *
	 *  @param obj $proveedores
	 *  @param char $col la columna que se debe actualizar
	 *  @return boolean
	 */
	function updCol($proveedores, $col="") {
		if (!$col) {   // si la columna estA omitida, se actualiza todo
			$exito = $this->upd($proveedores);
		} else {
			$arr = (array)$proveedores;
			$qry = "UPDATE proveedores SET";
			$qry.= " $col = \"{$arr[$col]}\"";
			$qry.= " WHERE rut = \"$proveedores->rut\"";

			$res = $this->idconn->query($qry);
			$exito = (PEAR::isError($res)==0);
		} // end if (!$col)
		return ($exito);
	}
	/**
	 *  Obtener lo que venga...
	 *
	 *  @since jue may 20 01:15:29 UYT 2010
	 *  @author Roselli, Diego
	 *  @param string $cols  columnas de la tabla a obtener
	 *  @param string $cond condiciOn
	 *  @param string $orden clAusula ORDER BY
	 *  @param string $groupBy clAusula GROUP BY
	 *  @param string $having clAusula HAVING
	 *  @param string $fil fila de inicio para el query limitado
	 *  @param string $cnt cantidad a recuperar en el query limitado
	 *  @return array | bolean | object
	 */
	function obtQuery($cols, $cond="1=1", $orden="1", $groupBy='', $having='', $fil=0, $cnt=0) {

		$qry = "SELECT $cols ";
		$qry.= $this->obtFrom;
		$qry.= " WHERE $cond";
		if ($groupBy)
			$qry.= " GROUP BY $groupBy";
		if ($having)
			$qry.= " HAVING $having";
		$qry.= " ORDER BY $orden";

		if ($cnt) {
			$this->idconn->setLimit($cnt, $fil);
		}
 		$res = $this->idconn->query($qry);

		if (PEAR::isError($res)){
			if ($this->idconn->inTransaction()) {
				return $res;
			} else {
				die("Error en ". __METHOD__ .":<br /><strong>" . $res->getDebugInfo() . "</strong>");
			}
		} else {
			// No hay error		
			$aQuery = array();
			while ($aRow = $res->fetchRow()) {
				$aQuery[] = $aRow;
			}
			$res->free(); // se libera el resultado
			if (count($aQuery)) {
				return $aQuery;
			} else {
				return false;
			}
		}
	}
}
?>
