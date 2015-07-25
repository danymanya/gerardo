<?php
/**
 *  Data Object para tabla producto
 *  Generado con genDBO v6.3 (del jue feb 24 21:23:08 UYST 2011)
 *  v6.2 : se elimina el método cnt_filas
 *  v6.3 : se ajusta el método obt_todo
 *  
 *	@class	dbo_producto
 *	@package
 */
 require_once 'DB.php';
class dbo_producto {
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
	function dbo_producto($conexion) {
		$this -> idconn = $conexion;
		$this -> idconn->setOption('portability', DB_PORTABILITY_ALL); //Máxima portabilidad
		$this -> idconn->setFetchMode(DB_FETCHMODE_ASSOC); //Las consultas asociativas por defecto
		/**
		 *	Sentencia SQL de recuperación de datos.
		 *	Es común a los métodos "obt()" y "obt_todo()"
		 */
		$this->obtSelect = "SELECT producto.*";
		$this->obtFrom   = " FROM producto";
		$this->obtSQL = $this->obtSelect . $this->obtFrom;
	}


	/**
	 *  existe
	 *
	 *  @param () $
	 *  @return boolean
	 */
	function existe() {
		$res = $this->obt();
		return (is_object($res));
	}

	/**
	 *  Verificación de integridad de referencia
	 *
	 *  @param () $
	 *  @return boolean
	 */
	function fks() {
		$bExisteRef = false;
		for ($i=0; ($i<count($this->tablasRef)) and (!$bExisteRef); $i++) {
			$tabla = $this->tablasRef[$i];
			$qry = "SELECT count(*) cantidad from $tabla";
			$qry.= " WHERE  = \"$\"";

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
	 *  @param () $
	 *  @return object
	 */
	function obt() {

		$qry = $this->obtSQL;
		$qry.= " WHERE producto. = \"$\"";

		$res = $this->idconn->query($qry);
		if (PEAR::isError($res)){
			die("Error en ". __METHOD__ .":<br /><strong>" . $res->getDebugInfo()."</strong>");
		}

		$oRow = $res->fetchRow();
		$res->free();
		if (is_array($oRow)) {
			return (object) $oRow; // Cast a objeto
		} else {
			return false;
		}
	}

	/**
	 *  Obtener toda la tabla en un array
	 *
	 *  @param string $cond condición
	 *  @param string $orden cláusula ORDER BY
	 *  @param int    $fil   fila desde donde recuperar
	 *  @param int    $cnt   cantidad de filas a recuperar, 30 por omisión
	 *  @return array
	 */
	function obt_todo($cond="1=1", $orden="1", $fil=0, $cnt=0) {

		$this->obtCols = preg_replace("/SELECT/i", "", $this->obtSelect);
		return ($this->obtQuery($obtCols, $cond, $orden, '', '', $fil, $cnt));

	}

	/**
	 *	Eliminación
	 *
	 *  @param () $
	 *  @return boolean
	 */
	function del() {
		$qry = "DELETE FROM producto";
   		$qry.= " WHERE  = \"$\"";

		$res = $this->idconn->query($qry);
		$exito = PEAR::isError($res) == 0;

		return ($exito);
	}

	/**
	 *  Inserción
	 *
	 *  @param obj $producto
	 *  @return boolean
	 */
	function ins($producto) {
		$qry = "INSERT INTO producto (";
		$qry.= "";
		$qry.= " VALUES (";
		$qry.= "\"$producto->\"";

		$res = $this->idconn->query($qry);
		$exito = PEAR::isError($res) == 0;

		return ($exito);
	}

	/**
 	 *  Actualizar registro
	 *
	 *  @param obj $producto
	 *  @return boolean
	 */
	function upd($producto) {
		$qry = "UPDATE producto SET";
		$qry.= "  = \"$producto->\"";
			$qry.= " WHERE  = \"$producto->\"";

		$res = $this->idconn->query($qry);
		$exito = PEAR::isError($res) == 0;

		return ($exito);
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
	 *  Obtener valores Unicos de cierta columna
	 *
	 *  @param string $cols  columnas de la tabla a obtener
	 *  @param string $cond condiciOn
	 *  @param string $orden clAusula ORDER BY
	 *  @return array
	 */
	function obtDistinct($cols, $cond="1=1", $orden="1", $fil=0, $cnt=0) {
		$qry = "SELECT DISTINCT $cols ";
		$qry.= $this->obtFrom;
		$qry.= " WHERE $cond";
		$qry.= " ORDER BY $orden";

		if ($cnt == 0) {
			$res = $this->idconn->query($qry); //Si la cantidad es 0 devolvemos todo
		} else {
			$res = $this->idconn->limitQuery($qry,$fil,$cnt); //Hacemos consulta limitada
		}

		if (PEAR::isError($res)) {
			die("Error en ". __METHOD__ .":<br /><strong>" . $res->getDebugInfo()."</strong>");
		}
		$a_itm = array();
		while ($aRow =& $res->fetchRow()) {
			$a_itm[] = $aRow;
		}
		$res->free(); // se libera el resultado
		if (count($a_itm)) {
			return $a_itm;
		} else {
			return false;
		}
	}
	/**
	 *  Obtener cantidad de valores únicos
	 *
	 *  @param string $cols  columnas de la tabla a obtener
	 *  @param string $cond condiciOn
	 *  @param string $orden clAusula ORDER BY
	 *  @return array
	 */
	function obtCntDistinct($cols, $cond="1=1") {
		$qry = "SELECT COUNT(DISTINCT $cols) cant ";
		$qry.= $this->obtFrom;
		$qry.= " WHERE $cond";

		$res = $this->idconn->query($qry); //Si la cantidad es 0 devolvemos todo

		if (PEAR::isError($res)) {
			die("Error en ". __METHOD__ .":<br /><strong>" . $res->getDebugInfo()."</strong>");
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
 	 *  Actualizar Columna
	 *
	 *  @param obj $producto
	 *  @param char $col la columna que se debe actualizar
	 *  @return boolean
	 */
	function updCol($producto, $col="") {
		if (!$col) {   // si la columna estA omitida, se actualiza todo
			$exito = $this->upd($producto);
		} else {
			$arr = (array)$producto;
			$qry = "UPDATE producto SET";
			$qry.= " $col = \"{$arr[$col]}\"";
			$qry.= " WHERE  = \"$producto->\"";

			$res = $this->idconn->query($qry);
			$exito = (PEAR::isError($res)==0);
		} // end if (!$col)
		return ($exito);
	}
	/**
	 *  Obtener lo que venga...
	 *
	 *  @since vie feb 11 12:50:21 UYST 2011
	 *  @author Roselli, Diego
	 *  @param string $cols  columnas de la tabla a obtener
	 *  @param string $cond condiciOn
	 *  @param string $orden clAusula ORDER BY
	 *  @param string $groupBy clAusula GROUP BY
	 *  @param string $having clAusula HAVING
	 *  @param string $fil fila de inicio para el query limitado
	 *  @param string $cnt cantidad a recuperar en el query limitado
	 *  @return array
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

		if ($cnt == 0) {
			$res = $this->idconn->query($qry); // Si la cantidad es 0 se devuelve todo
		} else {
			$res = $this->idconn->limitQuery($qry,$fil,$cnt); // consulta limitada
		}

		if (PEAR::isError($res)) {
			die("Error en ". __METHOD__ .":<br /><strong>" . $res->getDebugInfo()."</strong>");
		}
		$aQuery = array();
		while ($aRow =& $res->fetchRow()) {
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
?>
