<?php
/**
 *  Clase que construye un QBE
 *
 *	@class qbe
 *	@file qbe.class.php
 *	@version 1.1
 *
 *	operadores de busqueda:
 *		=				igual
 *		!=				distinto
 *		<>				distinto
 *		>				mayor
 *		>=				mayor o igual
 *		<				menor
 *		<=				menor o igual
 *		like			contiene
 *		contains		contiene
 *		startsWith		Empieza con
 *		endsWith		Empieza con
 *		between			entre ... y ...
 *		in				incluido en
 *		not in			no incluido en
 *		is null			es nulo
 *		is not null		no es nulo
 */
require_once dirname(__FILE__).'/xeniusHTML.class.php';

	/**
	 * definiciOn de constantes de comillado
	 */
	define ('K_DQUOTE', '"');
	define ('K_SQUOTE', "'");
	define ('K_DEFAULT_INPUT_SIZE', 10);
	define ('K_DEFAULT_DATE_TYPE_INPUT_SIZE', 10);

class qbe {
	/**
	 * argumentos
	 */
	var $args = array();
	/**
	 * operadores
	 */
	#var $ops = array();
	/**
	 * etiqueta del botOn de bUsqueda
	 */
	var $btBuscarLabel = "Buscar";
	/**
	 * para establecer si debe aparecer el botOn "Restablecer"
	 * en el formulario de bUsqueda
	 */
	var $btReset = false;
	/**
	 * etiqueta del botOn reset
	 */
	var $btResetLabel = "Restablecer";
	/**
	 * carácter de comillado
	 */
	var $charQuote = K_DQUOTE;
	/**
	 * Acá se salvan los datos de los
	 * argumentos que se seleccionaron
	 */
	var $condSelDato = array();
	var $condSelValor = array();
	var $condSelValor1 = array();
	/**
	 * para especificar si deben escaparse
	 * los caracteres de comillado
	 */
	var $bAddSlashes = false;
	/**
	 * para especificar una funciOn de transformaciOn
	 * de los argumentos de tipo string
	 *
	 * @example LOWER, UPPER, CAPITALIZE...
	 */
	#var $argFunction = array();
	/**
	 * rOtulos
	 */
	var $lbl = array();

	/**
	 * nombre del array de sesión usado para salvar la condición
	 */
	var $sessArrName;

	/**
	 *	Constructor
	 *
	 *	@class	qbe
	 *	@author	Roselli, Diego <diego@rosellimailhe.net>
	 *	@param string $sessArrName
	 */
	function qbe($sessArrName="xenius") {

		$this->lbl['betweenLabel'] = "entre";
		$this->lbl['andLabel'] = "y";

		$this->sessArrName = $sessArrName;

	}

	/**
	 *	iniciaArreglo
	 *
	 *	@class	qbe
	 *	@author	Coalla, Sebastián
	 *	@param int $cant  Cantidad de valores en el arreglo
	 *	@param array $arreglo  Arreglo a completar opcional
	 *	@param array $arregloInterno  Arreglo interno de la clase que se va a inicializar de la misma forma
	 */
	function iniciaArreglo($cant,$arreglo='',$arregloInterno='') {

		$arrAux = array();
		if(is_array($arreglo)){
			for ($i = 0; $i < $cant; $i++){
				if(isset($arreglo[$i])){
					$arrAux[$i] = $arreglo[$i];
				}else{
					$arrAux[$i]='';
				}
			}
		}else{
			for ($i = 0; $i < $cant; $i++){
				$arrAux[$i]='';
			}
		}

		if ($arregloInterno != ''){
			$this->$arregloInterno = $arrAux;
		}

		return $arrAux;
	}

	/**
	 *	iniciaArregloDatos
	 *	Inicia el arreglo interno de datos.
	 *
	 *	@class	qbe
	 *	@author	Coalla, Sebastián
	 *	@param int $cant  Cantidad de valores en el arreglo
	 *	@param array $arreglo  Arreglo a completar opcional
	 */
	function iniciaArregloDatos($cant,$arreglo='') {

		$arrAux = $this->iniciaArreglo($cant,$arreglo,'condSelDato');

		return $arrAux;
	}

	/**
	 *	iniciaArregloValor
	 *	Inicia el arreglo interno de valores.
	 *
	 *	@class	qbe
	 *	@author	Coalla, Sebastián
	 *	@param int $cant  Cantidad de valores en el arreglo
	 *	@param array $arreglo  Arreglo a completar opcional
	 */
	function iniciaArregloValor($cant,$arreglo='') {

		$arrAux = $this->iniciaArreglo($cant,$arreglo,'condSelValor');

		return $arrAux;
	}

	/**
	 *	iniciaArregloValor1
	 *	Sólo es necesario cuando alguno de los parámetros es un rango de valores
	 *
	 *	@class	qbe
	 *	@author	Coalla, Sebastián
	 *	@param int $cant  Cantidad de valores en el arreglo
	 *	@param array $arreglo  Arreglo a completar opcional
	 */
	function iniciaArregloValor1($cant,$arreglo='') {

		$arrAux = $this->iniciaArreglo($cant,$arreglo,'condSelValor1');

		return $arrAux;
	}

	/**
	 *	Define un argumento de búsqueda
	 *
	 *	El parámetro "cols" contiene:
	 *		string colName:		nombre de la columna; ejemplo: nro_alu
	 *		char(1) colType:	tipo de la columna; válidos: [Número], [C]aracteres, [F]echa)
	 *		string colLabel:	etiqueta visible de la columna; ejemplo: Número Alumno
	 *		string colOp:		operador, descripto en el comienzo de este texto
	 *	Si "cols" tiene más de un elemento, se creará un combo con todo el array, si no, 
	 *	se creará una etiqueta y un input oculto.
	 *	El parámetro "data" contiene:
	 *		string dataValue:	valor del dato; ejemplo: uy
	 *		string dataLabel:	rótulo del dato; ejemplo: Uruguay
	 *	Si "data" tiene más de un elemento, se creará un combo con todo el array, si no, 
	 *	se creará un input type="text".
	 *
	 *	@class	qbe
	 *	@author	Roselli, Diego <diego@rosellimailhe.net>
	 *	@param array $cols columnas posibles para el argumento de búsqueda
	 *	@param array $data valores posibles para el argumento de búsqueda
	 *	@param string $op Operador de búsqueda: like, =
	 *	@param string $defColName cuál es la columna que aparece seleccionada en el combo
	 *	@param string $defDataValue cuál es el valor que aparece seleccionado en el combo
	 *	@param string $defDataValue1 cuál es el valor que aparece seleccionado en el segundo combo 
	 */
	function addArg($cols, $data, $op="like", $defColName="", $defDataValue="", $defDataValue1="") {

		if (is_array($data) and (count($data[0]) < 1)){
			$data = '';
		}

		$this->args[] = array(
			"cols" => $cols,
			"data" => $data,
			"op" => $op,
			"defColName" => $defColName,
			"defDataValue" => $defDataValue,
			"defDataValue1" => $defDataValue1
		);

		#$this->saveArg($this->args);
	}
	/**
	 *	Armado del formulario
	 *
	 *	@class	qbe
	 *	@author	Roselli, Diego <diego@rosellimailhe.net>
	 *	@param array $args argumentos
	 *	@return string
	 */
	function getForm() {
		$ind = 0;
		$form = '';
		foreach ($this->args as $arg) {
			$html = $this->getHtmlArg($arg, $ind);
			$form.= "$html\n";
			$ind++;
		}
		$btSubmit = '<input id="btBuscar" name="btBuscar" type="submit" value="'.$this->btBuscarLabel.'" />';
		$form.= "$btSubmit\n";
		if ($this->btReset) {
			$btReset = '<input id="btReset" name="btBuscar" type="submit" value="'.$this->btResetLabel.'"';
			$btReset.= " onclick='buscador.action=\"";
			$btReset.= ereg_replace("php&.*", "php", $_SERVER["REQUEST_URI"]);
			$btReset.= "\"; submit()' />";
			$form.= "$btReset\n";
		}
		$htmlForm = new htmlTag("form", true);
		$htmlForm->addAttrib("id", "buscador");
		$htmlForm->addAttrib("name", "buscador");
		$htmlForm->addAttrib("method", "post");
		$htmlForm->addAttrib("action", ereg_replace("&pg=[^&]*", "", $_SERVER["REQUEST_URI"]));

		$elForm = $htmlForm->get("\n$form");
		/*
		 * se agrega un div para enmarcar el formulario
		 */
		$div = new htmlTag("div", true);
		$div->addAttrib("id", "qbe_form");

		#$this->saveArgs($this->args);

		return $div->get("\n$elForm");
	}
	/**
	 *	getFormBootstrap
	 *
	 *	Armado del formulario para formato Bootstrap
	 *
	 *	@class	qbe
	 *	@author	Roselli, Diego <diego@rosellimailhe.net>
	 *	@param array $args argumentos
	 *	@return string
	 */
	function getFormBootstrap() {
		$ind = 0;
		$form = '';

		$htmlForm = new htmlTag("form", true);
		$htmlForm->addAttrib("id", "buscador");
		$htmlForm->addAttrib("name", "buscador");
		$htmlForm->addAttrib("class","form-inline");
		$htmlForm->addAttrib("method", "post");
		$htmlForm->addAttrib("action", ereg_replace("&pg=[^&]*", "", $_SERVER["REQUEST_URI"]));

		foreach ($this->args as $arg) {
// 			$html = $this->getHtmlArg($arg, $ind);
			$htmlForm->addTag($this->getTagArg($arg, $ind));

// 			$form.= "$html\n";
			$ind++;
		}
		$htmlForm->setHtmlInterno($form);

// 		$btSubmit = '<input class="btn btn-default" id="btBuscar" name="btBuscar" type="submit" value="'.$this->btBuscarLabel.'" />';
// 		$form.= "$btSubmit\n";
		$inpSubmit = new htmlTag("input");
		$inpSubmit->addAttrib('id','btBuscar');
		$inpSubmit->addAttrib('class','btn-sm btn-default');
		$inpSubmit->addAttrib('name','btBuscar');
		$inpSubmit->addAttrib('type','submit');
		$inpSubmit->addAttrib('value',$this->btBuscarLabel);
		$htmlForm->addTag($inpSubmit);

		if ($this->btReset) {
			$strOnclick = "buscador.action='".ereg_replace("php&.*", "php", $_SERVER["REQUEST_URI"])."'; submit()";
			$inpReset = new htmlTag("input");
			$inpReset->addAttrib('id','btReset');
			$inpReset->addAttrib('class','btn-sm btn-default');
			$inpReset->addAttrib('name','btBuscar');
			$inpReset->addAttrib('type','submit');
			$inpReset->addAttrib('value',$this->btResetLabel);
			$inpReset->addAttrib('onclick',$strOnclick);
// 			$btReset = '<input class="btn btn-default" id="btReset" name="btBuscar" type="submit" value="'.$this->btResetLabel.'"';
// 			$btReset.= " onclick='buscador.action=\"";
// 			$btReset.= ereg_replace("php&.*", "php", $_SERVER["REQUEST_URI"]);
// 			$btReset.= "\"; submit()' />";
// 			$form.= "$btReset\n";
			$htmlForm->addTag($inpReset);
		}

		$divContenedor = new htmlTag("div", true);
		$divContenedor->addAttrib("id", "qbe_panel");
		$divContenedor->addAttrib("class","panel panel-default");

		$divPanelBody = new htmlTag("div", true);
		$divPanelBody->addAttrib("id", "qbe_contenedor");
		$divPanelBody->addAttrib("class","panel-body");

		$divInputs = new htmlTag("div", true);
		$divInputs->addAttrib("id", "lista_inputs");
		$divInputs->addAttrib("class","form-group");

		$divInputs->addTag($htmlForm);
		$divPanelBody->addTag($divInputs);
		$divContenedor->addTag($divPanelBody);

// 		$elForm = $htmlForm->get("\n$form");
		/*
		 * se agrega un div para enmarcar el formulario
		 */
// 		$div = new htmlTag("div", true);
// 		$div->addAttrib("id", "qbe_form");

		#$this->saveArgs($this->args);

// 		return $div->get("\n$elForm");
		return $divContenedor->get();
	}
	/**
	 *	Armado de la condición de búsqueda a partir de los argumentos
	 *
	 *	@class	qbe
	 *	@author	Roselli, Diego <diego@rosellimailhe.net>
	 *	@param array $args argumentos
	 *	@return string
	 */
	function cond($args) {
		foreach ($args as $clave => $arg) {
			if ($arg['valor'] != "") {
				list($dato, $tipo, $op) = explode("|", $arg['dato']);
				$op = ($op ? $op : $arg['op']);
				if(isset($arg['argFunction'])){
					$argFunction = $arg['argFunction'];
				}else{
					$argFunction = "";
				}
				/*
				 * segUn el operador...
				 */
				switch (strtolower($op)) {
					case "=" :
					case "!=" :
					case "<>" :
					case ">" :
					case ">=" :
					case "<" :
					case "<=" :
						$aCond[] = $this->buildCond($dato, $tipo, $op, $argFunction, $arg['valor'], "", "");
// 						$aCond[] = $this->buildCond($dato, $tipo, $op, $arg['argFunction'], $arg['valor'], "", "");
						break;
					case "like" :
					case "contains" :
						$aCond[] = $this->buildCond($dato, "", "like", $argFunction, $arg['valor'], "%", "%");
// 						$aCond[] = $this->buildCond($dato, "", "like", $arg['argFunction'], $arg['valor'], "%", "%");
						break;
					case "endswith" :
						$aCond[] = $this->buildCond($dato, "", "like", $argFunction, $arg['valor'], "%", "");
// 						$aCond[] = $this->buildCond($dato, "", "like", $arg['argFunction'], $arg['valor'], "%", "");
						break;
					case "startswith" :
						$aCond[] = $this->buildCond($dato, "", "like", $argFunction, $arg['valor'], "", "%");
// 						$aCond[] = $this->buildCond($dato, "", "like", $arg['argFunction'], $arg['valor'], "", "%");
						break;
					case "between" :
						$aCond[] = $this->buildCond($dato, $tipo, $op, $argFunction, $arg['valor'], "", "");
// 						$aCond[] = $this->buildCond($dato, $tipo, $op, $arg['argFunction'], $arg['valor'], "", "");
						break;
					case "in" :
					case "not in" :
						$aCond[] = $this->buildCond($dato, "N", $op, $argFunction, $arg['valor'], "(", ")");
// 						$aCond[] = $this->buildCond($dato, $tipo, $op, $arg['argFunction'], $arg['valor'], "", "");
						break;
					case "is" :
					case "is not" :
						#$aCond[] = $this->buildCond($dato, $tipo, $op, $arg['valor'], "", "");
						$aCond[] = $this->buildCond($dato, "N", $op, $argFunction, $arg['valor'], "", "");
// 						$aCond[] = $this->buildCond($dato, "N", $op, $arg['argFunction'], $arg['valor'], "", "");
						break;
				}
				/*
				 * Salvemos, para la posteridad, cuál es el dato
				 * seleccionado en cada uno de los combos 
				 * correspondientes al argumento
				 */
				$this->condSelDato[$clave] = $arg['dato'];
				$this->condSelValor[$clave] = $arg['valor'];
				if(isset($arg['valor1'])){
					$this->condSelValor1[$clave] = $arg['valor1'];
				}else{
					$this->condSelValor1[$clave] = "";
				}
			}
		}

		if(isset($aCond)){
		  $cond = implode(" AND ", $aCond);
		}else{
			$cond = "1=1";
		}

		$this->saveCond($cond);

		$_SESSION[$this->sessArrName]['condSelDato']   = $this->condSelDato;
		$_SESSION[$this->sessArrName]['condSelValor']  = $this->condSelValor;
		$_SESSION[$this->sessArrName]['condSelValor1'] = $this->condSelValor1;

		return $cond;
	}
	/**
	 *	Se genera código HTML a partir de un argumento de búsqueda
	 *
	 *	@class	qbe
	 *	@author	Roselli, Diego <diego@rosellimailhe.net>
	 *	@param array $arg argumento
	 *	@param int $i índice del argumento: arg[0], arg[1]...
	 *	@param string $op Operador de búsqueda: like, =
	 *	@return string
	 */
	function getHtmlArg($arg, $i) {
		if (count($arg['cols'])>1) {
			/*
			 * cols es un array, por lo tanto hay varios operandos a la izquierda
			 */
			$comboCols = new combo();
			$comboCols->opValue("colName");
			$comboCols->opLabel("colLabel");
			$comboCols->opSelected($arg['defColName']);
			$comboCols->selName('arg['.$i.'][dato]');
			$comboCols->selId("dato$i");
			$cols = array();
			foreach ($arg['cols'] as $col) {
				if(isset($col['colName'])){
					$nombreColumna = $col['colName'];
				}else{
					$nombreColumna = '';
				}
				if(isset($col['colType'])){
					$tipoColumna = $col['colType'];
				}else{
					$tipoColumna = '';
				}
				if(isset($col['colOp'])){
					$operadorColumna = $col['colOp'];
				}else{
					$operadorColumna = '';
				}

				if (!$col['colOp']) {
					$col['colOp'] = $arg['op'];
				}
				$cols[] = array('colName' => $nombreColumna . "|" . $tipoColumna . "|" . $operadorColumna,
								'colLabel' => $col['colLabel']);
			}
			$htmlCol = $comboCols->obt($cols);
		} else {
			$col = $arg['cols'][0];
			// crear un tag <label>
			$labelCol = new htmlTag("label", true);
			$htmlCol = $labelCol->get($col['colLabel']);

			// input oculto para el label
			$labelInp = new htmlTag("input", false);
			$labelInp->addAttrib("type", "hidden");
			$labelInp->addAttrib("name", 'arg['.$i.'][dato]');
			if(isset($col['colName'])){
				$nombreColumna = $col['colName'];
			}else{
				$nombreColumna = '';
			}
			if(isset($col['colType'])){
				$tipoColumna = $col['colType'];
			}else{
				$tipoColumna = '';
			}
			if(isset($col['colOp'])){
				$operadorColumna = $col['colOp'];
			}else{
				$operadorColumna = '';
			}
			$labelInp->addAttrib("value", "$nombreColumna|$tipoColumna|$operadorColumna");
// 			$labelInp->addAttrib("value", "{$col['colName']}|{$col['colType']}|{$col['colOp']}");
			$htmlCol.= "\n" . $labelInp->get();

		}

		#if (count($arg['data'])>1) {
		if (is_array($arg['data'])) {
			/*
			 * "data" es un array, por lo tanto hay varios operandos a la derecha
			 */
			$comboData = new combo();
			$comboData->opValue("dataValue");
			$comboData->opLabel("dataLabel");
			$comboData->opSelected($arg['defDataValue']);
			$comboData->selName("arg[$i][valor]");
			$comboData->selId("valor$i");
			$htmlData = $comboData->obt($arg['data']);
		} else {
			/*
			 * "data" no es un array, por lo tanto el operando
			 * de la derecha estará dado por un input
			 */
			$inputSize = (isset($arg['inputSize'])) ? $arg['inputSize'] : K_DEFAULT_INPUT_SIZE;
			$inpData = new htmlTag("input", false);
			$inpData->addAttrib("type", "text");
			$inpData->addAttrib("id", "valor$i");
			$inpData->addAttrib("name", 'arg['.$i.'][valor]');
			$inpData->addAttrib("value", $arg['defDataValue']);
			if ($arg['op'] == "between") {
				$inpData->addAttrib("size", K_DEFAULT_DATE_TYPE_INPUT_SIZE);
			} else {
				$inpData->addAttrib("size", $inputSize);
			}
			$htmlData = $inpData->get();
			/*
			 * si el operador es "between", agregar rOtulos y otro input 
			 */
			if ($arg['op'] == "between") {
				$htmlData = "&nbsp;" . $this->lbl['betweenLabel'] . "&nbsp;" . $htmlData;
				$inpData->addAttrib("id", "valor1$i");
				$inpData->addAttrib("name", 'arg['.$i.'][valor1]');
				$inpData->addAttrib("value", $arg['defDataValue1']);
				$inpData->addAttrib("size", K_DEFAULT_DATE_TYPE_INPUT_SIZE);
				$htmlData.= $this->lbl['andLabel'] . " " . $inpData->get();
			}
		}
		// se debe crear un INPUT oculto para el operador
		$inpOp = new htmlTag("input", false);
		$inpOp->addAttrib("type", "hidden");
		$inpOp->addAttrib("name", 'arg['.$i.'][op]');
		$inpOp->addAttrib("value", $arg['op']);
		$Inp = $inpOp->get();

		// se debe crear un INPUT oculto para la función del argumento
		if (isset($arg['argFunction'])) {
			$inpOp->addAttrib("name", 'arg['.$i.'][argFunction]');
			$inpOp->addAttrib("value", $arg['argFunction']);
			$Inp.= "\n" . $inpOp->get();
		}
		#// se debe crear un INPUT oculto para el tamaño del campo
		#if ($arg['inputSize']) {
		#	$inpOp->addAttrib("name", 'arg['.$i.'][inputSize]');
		#	$inpOp->addAttrib("value", $arg['inputSize']);
		#	$Inp.= "\n" . $inpOp->get();
		#}

		// juntar todo
		$html = "$htmlCol\n" . $Inp . "\n$htmlData\n";
		return $html;
	}

	/**
	 *	getTagArg
	 *	Se genera un objeto de tipo Tag del argumento correspondiente
	 *
	 *	@class	qbe
	 *	@author	Roselli, Diego <diego@rosellimailhe.net>
	 *	@param array $arg argumento
	 *	@param int $i índice del argumento: arg[0], arg[1]...
	 *	@param string $op Operador de búsqueda: like, =
	 *	@return string
	 */
	function getTagArg($arg, $i) {

		$div = new htmlTag("span", true);
// 		$div->addAttrib("class", "input-group");

		if (count($arg['cols'])>1) {
			/*
			 * cols es un array, por lo tanto hay varios operandos a la izquierda
			 */
			$comboCols = new combo();
			$comboCols->opValue("colName");
			$comboCols->opLabel("colLabel");
			$comboCols->opSelected($arg['defColName']);
			$comboCols->selName('arg['.$i.'][dato]');
			$comboCols->selId("dato$i");
			$comboCols->estilo("form-control input-sm");

			$cols = array();
			foreach ($arg['cols'] as $col) {
				if(isset($col['colName'])){
					$nombreColumna = $col['colName'];
				}else{
					$nombreColumna = '';
				}
				if(isset($col['colType'])){
					$tipoColumna = $col['colType'];
				}else{
					$tipoColumna = '';
				}
				if(isset($col['colOp'])){
					$operadorColumna = $col['colOp'];
				}else{
					$operadorColumna = '';
				}

				if (!$col['colOp']) {
					$col['colOp'] = $arg['op'];
				}
				$cols[] = array('colName' => $nombreColumna . "|" . $tipoColumna . "|" . $operadorColumna,
								'colLabel' => $col['colLabel']);
			}
// 			$htmlCol = $comboCols->obt($cols);
			$comboCols->setOpciones($cols);

			$div->addTag($comboCols);
		} else {
			$col = $arg['cols'][0];
			// crear un tag <label>
			$labelCol = new htmlTag("label", true);
			$labelCol->addAttrib("class", "control-label-sm");
			$labelCol->setHtmlInterno($col['colLabel']);
// 			$htmlCol = $labelCol->get($col['colLabel']);
			$div->addTag($labelCol);

			// input oculto para el label
			$labelInp = new htmlTag("input", false);
			$labelInp->addAttrib("type", "hidden");
			$labelInp->addAttrib("name", 'arg['.$i.'][dato]');
			if(isset($col['colName'])){
				$nombreColumna = $col['colName'];
			}else{
				$nombreColumna = '';
			}
			if(isset($col['colType'])){
				$tipoColumna = $col['colType'];
			}else{
				$tipoColumna = '';
			}
			if(isset($col['colOp'])){
				$operadorColumna = $col['colOp'];
			}else{
				$operadorColumna = '';
			}
			$labelInp->addAttrib("value", "$nombreColumna|$tipoColumna|$operadorColumna");
// 			$labelInp->addAttrib("value", "{$col['colName']}|{$col['colType']}|{$col['colOp']}");
// 			$htmlCol.= "\n" . $labelInp->get();
			$div->addTag($labelInp);

		}

		#if (count($arg['data'])>1) {
		if (is_array($arg['data'])) {
			/*
			 * "data" es un array, por lo tanto hay varios operandos a la derecha
			 */
			$comboData = new combo();
			$comboData->opValue("dataValue");
			$comboData->opLabel("dataLabel");
			$comboData->opSelected($arg['defDataValue']);
			$comboData->selName("arg[$i][valor]");
			$comboData->selId("valor$i");
			$comboData->estilo("form-control input-sm");
			$comboData->setOpciones($arg['data']);

// 			$htmlData = $comboData->obt($arg['data']);
			$div->addTag($comboData);
		} else {
			/*
			 * "data" no es un array, por lo tanto el operando
			 * de la derecha estará dado por un input
			 */
			$inputSize = (isset($arg['inputSize'])) ? $arg['inputSize'] : K_DEFAULT_INPUT_SIZE;
			$inpData = new htmlTag("input", false);
			$inpData->addAttrib("type", "text");
			$inpData->addAttrib("id", "valor$i");
			$inpData->addAttrib("class", "form-control input-sm");
			$inpData->addAttrib("name", 'arg['.$i.'][valor]');
			$inpData->addAttrib("value", $arg['defDataValue']);
			if ($arg['op'] == "between") {
				$inpData->addAttrib("size", K_DEFAULT_DATE_TYPE_INPUT_SIZE);
			} else {
				$inpData->addAttrib("size", $inputSize);
			}
// 			$htmlData = $inpData->get();
			/*
			 * si el operador es "between", agregar rOtulos y otro input 
			 */
			if ($arg['op'] == "between") {
				//Etiqueta entre
				$spanEntre = new htmlTag("span", false);
				$spanEntre->setHtmlInterno("&nbsp;" . $this->lbl['betweenLabel'] . "&nbsp;");
				$div->addTag($spanEntre);
// 				$htmlData = "&nbsp;" . $this->lbl['betweenLabel'] . "&nbsp;" . $htmlData;
				$inpData1 = new htmlTag("input", false);
				$inpData1->addAttrib("id", "valor1$i");
				$inpData1->addAttrib("class", "form-control input-sm");
				$inpData1->addAttrib("name", 'arg['.$i.'][valor1]');
				$inpData1->addAttrib("value", $arg['defDataValue1']);
				$inpData1->addAttrib("size", K_DEFAULT_DATE_TYPE_INPUT_SIZE);

				//Primer input
				$div->addTag($inpData);
				$spanEntre = new htmlTag("span", false);
				$spanEntre->setHtmlInterno("&nbsp;" . $this->lbl['betweenLabel'] . "&nbsp;");
				$div->addTag($spanEntre);

				$spanY = new htmlTag("span", false);
				$spanY->setHtmlInterno($this->lbl['andLabel'] . "&nbsp;");
				$div->addTag($spanY);
// 				$htmlData.= $this->lbl['andLabel'] . " " . $inpData1->get();

				$div->addTag($inpData1);
			} else {
				$div->addTag($inpData);
			}
		}
		// se debe crear un INPUT oculto para el operador
		$inpOp = new htmlTag("input", false);
		$inpOp->addAttrib("type", "hidden");
		$inpOp->addAttrib("name", 'arg['.$i.'][op]');
		$inpOp->addAttrib("value", $arg['op']);
// 		$Inp = $inpOp->get();
		$div->addTag($inpOp);

		// se debe crear un INPUT oculto para la función del argumento
		if (isset($arg['argFunction'])) {
			$inpOpOculto = new htmlTag("input", false);
			$inpOpOculto->addAttrib("type", "hidden");
			$inpOpOculto->addAttrib("name", 'arg['.$i.'][argFunction]');
			$inpOpOculto->addAttrib("value", $arg['argFunction']);
// 			$Inp.= "\n" . $inpOp->get();
			$div->addTag($inpOp);
		}
		#// se debe crear un INPUT oculto para el tamaño del campo
		#if ($arg['inputSize']) {
		#	$inpOp->addAttrib("name", 'arg['.$i.'][inputSize]');
		#	$inpOp->addAttrib("value", $arg['inputSize']);
		#	$Inp.= "\n" . $inpOp->get();
		#}

		// juntar todo
// 		$html = "$htmlCol\n" . $Inp . "\n$htmlData\n";
// 		return $html;
		return $div;
	}


	/**
	 *	OpciOn seleccionada para el dato en el argumento correspondiente
	 *
	 *	@class	qbe
	 *	@author	Roselli, Diego <diego@rosellimailhe.net>
	 *	@return string
	 */
	function getSelDato() {
		return $this->condSelDato;
	}
	/**
	 *	OpciOn seleccionada para el valor en el argumento correspondiente
	 *
	 *	@class	qbe
	 *	@author	Roselli, Diego <diego@rosellimailhe.net>
	 *	@param  $n el numero correspondiente al valor (0,1)
	 *	@return string
	 */
	function getSelValor($n=0) {
		if ($n == 1)
			$ret = $this->condSelValor1;
		else
			$ret = $this->condSelValor;

		return $ret;
	}
	/**
	 *	Se especifica la etiqueta del botón "Buscar" del  buscador
	 *
	 *	@class	qbe
	 *	@author	Roselli, Diego <diego@rosellimailhe.net>
	 *	@param string $label Etiqueta del botón reset.
	 *	@return none
	 */
	function setBuscarButtonLabel($label) {
		$this->btBuscarLabel = $label;
	}
	/**
	 *	Se especifica si el buscador contará con un boton Reset o no
	 *
	 *	@class	qbe
	 *	@author	Roselli, Diego <diego@rosellimailhe.net>
	 *	@param boolean $reset 
	 *	@return none
	 */
	function setResetButton($reset=false) {
		$this->btReset = $reset;
	}
	/**
	 *	Se especifica la etiqueta del botón Reset del  buscador
	 *
	 *	@class	qbe
	 *	@author	Roselli, Diego <diego@rosellimailhe.net>
	 *	@param string $label Etiqueta del botón reset.
	 *	@return none
	 */
	function setResetButtonLabel($label) {
		$this->btResetLabel = $label;
	}
	/**
	 *	Establecer el caracter de comillado
	 *
	 *	@class	qbe
	 *	@author	Roselli, Diego <diego@rosellimailhe.net>
	 *	@param string $quote carActer de comillado
	 *	@return none
	 */
	function setCharQuote($quote) {
		$this->charQuote = $quote;
	}
	/**
	 *	Establecer si se escapan los caracteres o no
	 *
	 *	@class	qbe
	 *	@author	Roselli, Diego <diego@rosellimailhe.net>
	 *	@param boolean $bAddSlashes
	 *	@return none
	 */
	function setAddSlashes($bAddSlashes) {
		$this->bAddSlashes = $bAddSlashes;
	}
	/**
	 *	Establecer una funciOn de transformaciOn de argumentos
	 *
	 *	@class	qbe
	 *	@author	Roselli, Diego <diego@rosellimailhe.net>
	 *	@param string $nro_arg  el número del argumento
	 *	@param string $argFunction la funciOn
	 *	@return none
	 */
	function setArgFunction($nro_arg, $argFunction) {
		#$this->argFunction = $argFunction;
		$this->args[$nro_arg]['argFunction'] = $argFunction;
	}
	/**
	 *	Establecer el tamaño del input para el valor del argumento
	 *
	 *	@class	qbe
	 *	@author	Roselli, Diego <diego@rosellimailhe.net>
	 *	@param string $nro_arg  el número del argumento
	 *	@param string $inputSize el tamaño
	 *	@return none
	 */
	function setArgInputSize($nro_arg, $inputSize) {
		$this->args[$nro_arg]['inputSize'] = $inputSize;
	}
	/**
	 *	Establecer el valor de un rOtulo
	 *
	 *	@class	qbe
	 *	@author	Roselli, Diego <diego@rosellimailhe.net>
	 *	@param string $label rOtulo
	 *	@param string $value valor del rOtulo
	 *	@return none
	 */
	function setLabelValue($label, $value) {
		$this->lbl[$label] = $value;
	}
	/**
	 *	ConstrucciOn de la condiciOn con base en varios argumentos
	 *
	 *	@class	qbe
	 *	@author	Roselli, Diego <diego@rosellimailhe.net>
	 *	@param string $dato
	 *	@param string $tipo
	 *	@param string $op operaciOn
	 *	@param string $argFunction funciOn de transformaciOn del dato (UPPER, LOWER, ...)
	 *	@param string $valor valor del rOtulo
	 *	@param string $wildcard1 carActer que va al comienzo del argumento (%, *, ...)
	 *	@param string $wildcard2 carActer que va al final del argumento (%, *, ...)
	 *	@return none
	 */
	function buildCond($dato, $tipo, $op, $argFunction, $valor, $wildcard1, $wildcard2) {

		if ($tipo == "N") {
			$cond = "$dato $op $wildcard1$valor$wildcard2";
		} else {
			if ($this->bAddSlashes) {
				$valor = addslashes($valor);
			}
			if ($argFunction) {
				$cond = $argFunction . "($dato) $op ";
				$cond.= $argFunction ."(". $this->charQuote;
				$cond.= "$wildcard1$valor$wildcard2" . $this->charQuote .")";
			} else {
				$cond = "$dato $op ";
				$cond.= $this->charQuote . "$wildcard1$valor$wildcard2" . $this->charQuote;
			}
		}

		return $cond;
	}
	/**
	 *	Salvar argumentos en variable de sesión
	 *
	 *	@class	qbe
	 *	@author	Roselli, Diego <diego@rosellimailhe.net>
	 *	@param array $args argumento a salvar en variable de sesión
	 *	@return none
	 */
	#function saveArgs($args) {
	#	$_SESSION[$this->sessArrName]['args'] = $args;
	#}
	/**
	 *	Recuperación de argumentos guardados en variable de sesión
	 *
	 *	@class	qbe
	 *	@author	Roselli, Diego <diego@rosellimailhe.net>
	 *	@param
	 *	@return array
	 */
	#function retrieveArgs() {
	#	#return $_SESSION[$this->sessArrName]['args'];
	#	$this->args = $_SESSION[$this->sessArrName]['args'];
	#}
	#setDateFormat($inFormat, $outFormat)
	/**
	 *	Recuperación de argumentos guardados en variable de sesión
	 *
	 *	@class	qbe
	 *	@author	Roselli, Diego <diego@rosellimailhe.net>
	 *	@param
	 *	@return string
	 */
	function retrieveCond() {

		if (isset($_SESSION[$this->sessArrName]['cond'])) {
			$cond = $_SESSION[$this->sessArrName]['cond'];
		} else {
			$cond = '1=1';
		}

		if (isset($_SESSION[$this->sessArrName]['condSelDato'])) {
			$this->condSelDato = $_SESSION[$this->sessArrName]['condSelDato'];
		} else {
			$this->condSelDato = '';
		}
		if (isset($_SESSION[$this->sessArrName]['condSelValor'])) {
			$this->condSelValor = $_SESSION[$this->sessArrName]['condSelValor'];
		} else {
			$this->condSelValor = '';
		}
		if (isset($_SESSION[$this->sessArrName]['condSelValor1'])) {
			$this->condSelValor1 = $_SESSION[$this->sessArrName]['condSelValor1'];
		} else {
			$this->condSelValor1 = '';
		}

		return $cond;
	}
	/**
	 *	Salvado de la condición
	 *
	 *	@class	qbe
	 *	@author	Roselli, Diego <diego@rosellimailhe.net>
	 *	@param string $cond condición
	 *	@return none
	 */
	function saveCond($cond) {
		$_SESSION[$this->sessArrName]['cond'] = $cond;
	}
	/**
	 *	Reset de la condición
	 *
	 *	@class	qbe
	 *	@author	Roselli, Diego <diego@rosellimailhe.net>
	 *	@param
	 *	@return none
	 */
	function resetCond() {

		unset ($_SESSION[$this->sessArrName]['condSelDato']);
		unset ($_SESSION[$this->sessArrName]['condSelValor']);
		unset ($_SESSION[$this->sessArrName]['condSelValor1']);

		$_SESSION[$this->sessArrName]['cond'] = '1=1';

		return $_SESSION[$this->sessArrName]['cond'];
	}
	/**
	 *	Devuelve en un arrelo los valores y etiquetas seleccionados para el argumento
	 *
	 *	@class	qbe
	 *	@author	Coalla, Sebastián <scoalla@seminario.edu.uy>
	 *	@param array $nro_args Numero de argumento para el que buscamos lo seleccionado
	 *	@return array 
	 */
	function getSelectedFilter($nro_arg) {

		$selFilter['selCol'] = '';
		$selFilter['colLabel'] = '';
		$selFilter['selData'] = '';
		$selFilter['dataLabel'] = '';
		$selFilter['selData1'] = '';
		$selFilter['dataLabel1'] = '';

		$exito = false;
		if (isset($this->args[$nro_arg])){
			$argument = $this->args[$nro_arg];
			if (is_array($argument['cols'])) {
				if (isset($argument['defColName']) and (strlen($argument['defColName']) > 0)) {
					list($colName,$aux,$op) = explode('|',$argument['defColName']);
				} else {
					$colName = false; //No hya nada en colName
				}
				foreach($argument['cols'] as $idColumn => $columnData) {
					if ($columnData['colName'] == $colName) {
						$selFilter['selCol'] = $columnData['colName'];
						$selFilter['colLabel'] = $columnData['colLabel'];
					}
				}
				
			}

			if (is_array($argument['data'])) {
				foreach($argument['data'] as $idData => $dataData) {
					if ($dataData['dataValue'] == $argument['defDataValue']){
						$selFilter['selData'] = $dataData['dataValue'];
						$selFilter['dataLabel'] = $dataData['dataLabel'];
					}
				}
				
			} else {
				$selFilter['selData'] = $argument['defDataValue'];
			}
			//El segundo punto de datos nunca es un arreglo
			$selFilter['selData1'] = $argument['defDataValue1'];
		}

		return $selFilter;
	}
}
?>
