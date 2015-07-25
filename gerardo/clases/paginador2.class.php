<?php
/**
 *  Paginador
 *  Paginación de resultados de consultas MySql
 *
 *  Nombre de archivo   :
 *      paginador2.class.php
 *  Autor   :
 *      Jorge Pinedo Rosas (jpinedo)    <jpinedo@ing.udep.edu.pe>
 *      Con la colaboración de los usuarios del foro de PHP de www.forosdelweb.com
 *      Especialmente de dooky que posteO el cOdigo en el que se basa este script.
 *
 *  Versión 1.0    30/11/2003  :   -Versión inicial.
 *  Versión 1.1    12/01/2003  :   -Se agrega la propagación de las variables que llegan al script vía url ($_GET)
 *                               en los enlaces de navegaciOn por las pAginas.
 *                              -Se optimiza el conteo del total de registros utilizando el COUNT(*) de MySql.
 *
 *  DescripciOn :
 *      Devuelve el resultado de una consulta sql por pAginas, asI como los enlaces de navegaciOn respectivos.
 *      Este script ha sido pensado con fines didActicos, por eso la gran cantidad de comentarios.
 *
 *  Licencia :
 *      GPL con las siguientes extensiones:
 *          *Uselo con el fin que quiera (personal o lucrativo).
 *          *Si encuentra el cOdigo de utilidad y lo usa, mandeme un mail si lo desea.
 *          *Si mejora el cOdigo o encuentra errores, hAgamelo saber al mail indicado.
 *
 *  Documentación y ejemplo de uso:
 *      http://jpinedo.webcindario.com
 */

class paginador {
	var $regPorPag=20;
	var $cantPag=20;
	var $sentSqlConLimites;
	var $nav;
	var $pagInicial;
	var $totalReg;
	var $paramEnlace;
	var $modifRegPorPag;
	var $rot = array();
	var $largosPag = "10, 15, 20, 25, 30, 35, 50, 75, 100";

	/**
	 *  constructor
	 *
	 *	@param integer $totalReg cantidad de registros totales de la consulta
	 *	@param integer $regPorPag cantidad de registros que contendrA la pAgina
	 *	@param string $paramEnlace argumentos adicionales en la URL
	 *	@return none
	 */
    #function paginador($totalReg, $regPorPag=20, $paramEnlace="", $lang="spa") {
    function paginador($totalReg, $regPorPag=20, $paramEnlace="", $modifRegPorPag=true) {
		$this->totalReg = $totalReg;
		if ($regPorPag) $this->regPorPag = $regPorPag;
		$this->paramEnlace = $paramEnlace;
		$this->modifRegPorPag = $modifRegPorPag;
		#$this->lang = $lang;
		/*
		 * rOtulos
		 * estos valores pueden ser modificados por setRotulos()
		 */
		$this->rot['anterior'] = "Anterior";
		$this->rot['siguiente'] = "Siguiente";
		$this->rot['registros'] = "registros";
		$this->rot['mostrar'] = "Mostrar";
	}

	/**
	 *  fijaciOn de valores a los rOtulos
	 *
	 *	@class paginador
	 *	@param string $rotNombre  nombre del rOtulo
	 *	@param string $rotValor  valor del rOtulo
	 *	@return none
	 */
	function setRotulos($rotNombre, $rotValor) {

		$this->rot[$rotNombre]  = $rotValor;

	}

	/**
	 *  ConstrucciOn de los enlaces de navegaciOn
	 *
	 *  Esta funciOn construye efectivamente el string que contiene los enlaces de navegaciOn
	 *
	 *	@class paginador
	 *	@param integer $totalReg cantidad de registros totales de la consulta
	 *	@param integer $regPorPag cantidad de registros que contendrA la pAgina
	 *	@param string $paramEnlace argumentos adicionales en la URL
	 *	@param string $lang idioma en que tienen que aparecer las palabras "Siguiente" y "Anterior"
	 *	@return string
	 */
	#function setPaginador($totalReg, $regPorPag=20, $paramEnlace="", $lang="spa") {
	function setPaginador($totalReg, $regPorPag=20, $paramEnlace="") {

		if (empty($_GET['pg'])) {
		    // Si no se ha hecho click a ninguna pAgina especIfica,
		    // o sea, si es la primera vez que se ejecuta el script
		    // $pagactual es la pagina actual --> serA por omisiOn la primera.
		    $pagActual = 1;
		} else {
		    // Si se "pidiO" una pAgina especIfica,
		    // la pAgina actual serA la que se pidiO.
		    $pagActual = $_GET['pg'];
		}

		//Agrego parametros extra
		$this->paramEnlace = $paramEnlace;

		// Calculamos el nUmero de pAginas (saldrA un decimal)
		// con ceil() redondeamos y $totalPags serA el nUmero total (entero) de pAginas que tendremos
		$totalPags = ceil($totalReg / $regPorPag);

		//Creamos la navegaciOn a pAginas especIficas. Una lInea tipo: <<anterior 1 2 3 4 siguiente>>

		//La idea es pasar tambiEn en los enlaces las variables hayan llegado por URL.
		$pagEnlace = $_SERVER['PHP_SELF'];
		$pagQueryString = "?";
		if (isset($_GET)) {
		    // Si ya se han pasado variables por URL, escribimos el query string concatenando
		    // los elementos del array $_GET excepto la variable $_GET['pg'] si es que existe.
			$pagVariables = $_GET;
		}

		if (isset($_POST)) {
			// Le damos prioridad a las variables en POST
			// Si ya estaban definidas por $_GET las sobreescribimos.
			foreach($_POST as $pagClave => $pagValor){
				$pagVariables[$pagClave] = $pagValor;
			}
		}

		foreach ($pagVariables as $pagClave => $pagValor){
			if ($pagClave!='pg') {
				// serializar
				if (is_array($pagValor)) { 
					$pagValor = serialize($pagValor);
				}

				$pagQueryString.= $pagClave."=".$pagValor."&";
			}
		}

		//A~adimos el query string a la URL.
		$pagEnlace.= $pagQueryString;

		//La variable $pagNavegacion contendrA los enlaces a las pAginas.
		$pagNavegacion = '';

		if ($pagActual!=1) {
		    //Si no estamos en la pAgina 1. Ponemos el enlace "anterior"
		    $pagURL = $pagActual - 1;  // serA el nUmero de pAgina al que enlazamos

		    $pagNavegacion.= "<a href='" . $pagEnlace . "pg=" . $pagURL . $this->paramEnlace . "'>&laquo;&nbsp;" . $this->rot['anterior'] . "</a>&nbsp;";
		}

		if($this->cantPag > $totalPags){
		    //Enlaces a nUmeros de pAgina:
		    for ($i=1; $i<=$totalPags; $i++) { // Desde pAgina 1 hasta Ultima pAgina ($pagtotalPags)
		        if ($i==$pagActual) {
		            //Si el nUmero de pAgina es la actual ($pagactual). Se escribe  nUmero, pero sin enlace y en negrita.
		            $pagNavegacion .= "<b>&nbsp;$i&nbsp;</b>";
		        } else {
		            //Si es cualquier otro. Se escribe el enlace a dicho nUmero de pAgina.
		            $pagNavegacion .= "<a href={$pagEnlace}pg=$i".$this->paramEnlace.">$i</a>&nbsp;";
		        }
		    }
		} else {// Son demasiadas pAginas mostraremos sOlo algunas.

		    // Calculamos la pAgina inicial
		    $pag_inicio = $pagActual - floor($this->cantPag /2);
		    if ($pag_inicio <= 1){ //Puede que estemos en la primera pAgina
		        $pag_inicio = 1;
		    }else{ //La primera pAgina no es la 1
		        $pagNavegacion .= "<a href={$pagEnlace}pg=1".$this->paramEnlace.">1</a>&nbsp;...&nbsp;";
		    }

		    $pag_fin = $pag_inicio + $this->cantPag;
		    if($pag_fin > $totalPags){
		        $pag_fin = $totalPags;
		    }

		    //Enlaces a nUmeros de pAgina:
		    for ($i=$pag_inicio; $i<=$pag_fin; $i++) { //Desde pagina 1 hasta ultima pagina ($pagtotalPags)
		        if ($i==$pagActual) {
		            //Si el numero de pagina es la actual ($pagactual). Se escribe el numero, pero sin enlace y en negrita.
		            $pagNavegacion .= "<b>&nbsp;$i&nbsp;</b>";
		        } else {
		            //Si es cualquier otro. Se escibe el enlace a dicho numero de pagina.
		            $pagNavegacion .= "<a href='{$pagEnlace}pg=$i".$this->paramEnlace."'>$i</a>&nbsp;";
		        }
		    }
		    //Colocamos enlace a pAgina final si no aparece en la
		    if ($pag_fin < $totalPags) {
		        $pagNavegacion .= "...&nbsp;<a href='{$pagEnlace}pg=$totalPags".$this->paramEnlace."'>$totalPags</a>&nbsp;";
		    }
		
		}

		if ($pagActual < $totalPags) {
			//Si no estamos en la Ultima pAgina. Ponemos el enlace "Siguiente"
			$pagURL = $pagActual+1;  //serA el nUmero de pAgina al que enlazamos
			$pagNavegacion .= sprintf("<a href='%spg=%s%s'>%s &raquo;</a>", $pagEnlace, $pagURL,$this->paramEnlace, $this->rot['siguiente']);
		}
		$pagInicial = ($pagActual-1) * $regPorPag;

		//No es necesario utilizar la consulta, sOlo devolvemos los limites
		$this->pagInicial = $pagInicial;
		$this->regPorPag = $regPorPag;

		$this->nav = $pagNavegacion;
	}

    /**
     * Fijar valor a los argumentos extra para la URL
     *
	 * @class paginador
     * @param string $enlace
     * @return none
     */
	function setParamEnlace($enlace) {
		$this->paramEnlace = $enlace;
	}

    /**
     * Devuelve el string del navegador construido
     *
	 * @class paginador
     * @param  none
     * @return string
     */
    function obtNav() {
    	$this-> setPaginador($this->totalReg, $this->regPorPag, $this->paramEnlace);
        return $this->nav;
    }

    /**
     * Devuelve la pAgina inicial
     *
	 * @class paginador
     * @param
     * @return int Pagina inicial para enviar a consulta
     */
    function obtInicio() {
        return $this->pagInicial;
    }

    /**
     * Nos devuelve la cantidad de resultados por pAgina.
     *
	 * @class paginador
     * @param
     * @return int 
     */
    function obtCantRes() {
        return $this->regPorPag;
    }

    /**
     * Obtener la sentencia SQL con los lImites fijados
     *
	 * @class paginador
     * @param nome
     * @return string
     */
    function obtSent() {
        return $this->sentSqlConLimites;
    }

    /**
     * Fijar la cantidad de pAginas de nUmeros a mostrar en el navegador.
     *
	 * @class paginador
     * @param integer $cantPag
     * @return none
     */
    function setCantPagNav($cantPag) {
        return $this->cantPag = $cantPag;
    }

	/**
	 * Devuelve el paginado
	 *
	 * Devuelve el paginado en tErminos de:
	 *  xx - yy [zzz registros]
	 * Ejemplo:
	 *  21 - 40 [300 registros]
	 *
	 * @class paginador
	 * @param boolean $modifRegPorPag establece si el usuario podrA modificar el limite del paginado
	 * @param string $limPag los posibles lImites de paginado que el usuario podrA seleccionar
	 * @return string
	 */
	function obtPaginado($modifRegPorPag=true, $limPag="10, 15, 20, 25, 30, 35, 50, 75, 100") {

		$paginado = ($this->pagInicial+1) . "&nbsp;-&nbsp;";
		if ($this->pagInicial+$this->regPorPag < $this->totalReg) {
			$paginado.= ($this->pagInicial+$this->regPorPag);
		} else {
			$paginado.= $this->totalReg;
		}
		$paginado.= "&nbsp;[". $this->totalReg ."&nbsp;registros]";
		if ($modifRegPorPag) {
			$aLimPag = explode(",", $limPag);

			$paginado.= "&nbsp;<form style='display:inline;' method=\"post\" action=\"\"> - " . $this->rot['mostrar'];
			$paginado.= '&nbsp;<select class="" name="regPorPag" onchange="submit()">' . "\n";
			for ($i=0; $i<count($aLimPag); $i++) {
				if ($aLimPag[$i] == $this->regPorPag) {
					$paginado.= "<option selected=\"selected\">{$aLimPag[$i]}</option>\n";
				} else {
					$paginado.= "<option>{$aLimPag[$i]}</option>\n";
				}
			}
			$paginado.= "</select>\n</form>\n";
		}
		return $paginado;
    }

	/**
	 * Devuelve el string del completo: navegador y paginado
	 *
	 * @class paginador
	 * @param  none
	 * @return string
	 */
	function obtNavPaginado() {

		return sprintf("<span class=\"navegador\">%s</span><span class=\"paginado\">%s</span>\n",
			$this->obtNav(), $this->obtPaginado($this->modifRegPorPag, $this->largosPag));

	}

    /**
     * Fijar largos de pAgina posibles 
     *
	 * @class paginador
     * @param string $largosPag
     * @return none
     */
	function setLargosPag($largosPag) {

		$this->largosPag = $largosPag;

    }
}
?>
