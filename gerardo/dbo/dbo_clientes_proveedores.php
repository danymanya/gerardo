<?php
/**
 *  Data Object para tabla clientes_proveedores
 *  Generado con genDBO v7.1 del jue feb 17 19:02:17 UYST 2011
 *
 *	@class	dbo_clientes_proveedores
 */
require_once 'MDB2.php';
class dbo_clientes_proveedores {
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
		$this->obtSelect = "SELECT clientes_proveedores.*";
		$this->obtFrom   = " FROM clientes_proveedores";
		$this->obtSQL = $this->obtSelect . $this->obtFrom;
	}

	/**
	 *  existe
	 *
	 *  @param int(11) $id
	 *  @param string(256) $nombre
	 *  @return boolean
	 */
	function existe($id, $nombre) {
		$res = $this->obt($id, $nombre);
		return (is_object($res));
	}

	/**
	 *  Verificación de integridad de referencia
	 *
	 *  @param int(11) $id
	 *  @param string(256) $nombre
	 *  @return boolean
	 */
	function fks($id, $nombre) {
		$bExisteRef = false;
		for ($i=0; ($i<count($this->tablasRef)) and (!$bExisteRef); $i++) {
			$tabla = $this->tablasRef[$i];
			$qry = "SELECT count(*) cantidad from $tabla";
			$qry.= " WHERE id = \"$id\"";
			$qry.= " AND nombre = \"$nombre\"";

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
	 *  @param int(11) $id
	 *  @param string(256) $nombre
	 *  @return object | boolean
	 */
	function obt($id, $nombre) {

		$qry = $this->obtSQL;
		$qry.= " WHERE clientes_proveedores.id = \"$id\"";
		$qry.= " AND clientes_proveedores.nombre = \"$nombre\"";

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
	 *  @param int(11) $id
	 *  @param string(256) $nombre
	 *  @return boolean
	 */
	function del($id, $nombre) {
		$qry = "DELETE FROM clientes_proveedores";
   		$qry.= " WHERE id = \"$id\"";
   		$qry.= " AND nombre = \"$nombre\"";

		$res = $this->idconn->query($qry);
		$exito = PEAR::isError($res) == 0;

		return ($exito);
	}

	/**
	 *  Inserción
	 *
	 *  @param obj $clientes_proveedores
	 *  @return boolean
	 */
	function ins($clientes_proveedores) {
		$qry = "INSERT INTO clientes_proveedores (";
		$qry.= "id,";
		$qry.= "nombre,";
		$qry.= "documento,";
		$qry.= "direccion,";
		$qry.= "telefono,";
		$qry.= "mail,";
		$qry.= "condicion)";
		$qry.= " VALUES (";
		$qry.= "\"$clientes_proveedores->id\",";
		$qry.= "\"$clientes_proveedores->nombre\",";
		$qry.= "\"$clientes_proveedores->documento\",";
		$qry.= "\"$clientes_proveedores->direccion\",";
		$qry.= "\"$clientes_proveedores->telefono\",";
		$qry.= "\"$clientes_proveedores->mail\",";
		$qry.= "\"$clientes_proveedores->condicion\")";

		$res = $this->idconn->query($qry);
		$exito = PEAR::isError($res) == 0;

		return ($exito);
	}

	/**
 	 *  Actualizar registro
	 *
	 *  @param obj $clientes_proveedores
	 *  @return boolean
	 */
	function upd($clientes_proveedores) {
		$qry = "UPDATE clientes_proveedores SET";
		$qry.= " documento = \"$clientes_proveedores->documento\",";
		$qry.= " direccion = \"$clientes_proveedores->direccion\",";
		$qry.= " telefono = \"$clientes_proveedores->telefono\",";
		$qry.= " mail = \"$clientes_proveedores->mail\",";
		$qry.= " condicion = \"$clientes_proveedores->condicion\"";
			$qry.= " WHERE id = \"$clientes_proveedores->id\"";
			$qry.= " AND nombre = \"$clientes_proveedores->nombre\"";

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
	 *  @param obj $clientes_proveedores
	 *  @param char $col la columna que se debe actualizar
	 *  @return boolean
	 */
	function updCol($clientes_proveedores, $col="") {
		if (!$col) {   // si la columna estA omitida, se actualiza todo
			$exito = $this->upd($clientes_proveedores);
		} else {
			$arr = (array)$clientes_proveedores;
			$qry = "UPDATE clientes_proveedores SET";
			$qry.= " $col = \"{$arr[$col]}\"";
			$qry.= " WHERE id = \"$clientes_proveedores->id\"";
			$qry.= " AND nombre = \"$clientes_proveedores->nombre\"";

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
