<?php
/**
 *	Clase que construye un tag HTML cualquiera
 *
 *	@class	htmlTag
 *	@file	xeniusHTML.class.php
 *	@author	Roselli, Diego <diego@rosellimailhe.net>
 */
class htmlTag {
	var $tag = "";
	var $mustClose = true;
	var $attribs = "";
	var $htmlInterno = "";
	var $tagsComponentes = array();
	/**
	 *	Constructor
	 *
	 *	@author	Roselli, Diego <diego@rosellimailhe.net>
	 *	@param string $tag 
	 *	@param boolean $mustClose establece si debe existir un tag de cierre.
	 */
	function htmlTag($tag="", $mustClose=true) {
		$this->tag = $tag;
		$this->mustClose = $mustClose;
	}
	/**
	 *	Agregado de atributo
	 *
	 *	@author	Roselli, Diego <diego@rosellimailhe.net>
	 *	@param string $attrib atributo
	 *	@param string $value valor del atributo
	 */
	function addAttrib($attrib, $value) {
		$this->attribs[$attrib] = $value;
	}

	/**
	 *	Agregado de atributo
	 *
	 *	@author	Coalla, Sebastián <coalla@gmail.com>
	 *	@param array $atributos Arreglo (atributo=> [nombre_del_atributo] , valor=> [valor_del_atributo])
	 */
	function addAttributes($atributos) {

		if (is_array($atributos)){
			foreach($atributos as $clave => $atributo) {
				$this->addAttrib($atributo['atributo'], $atributo['valor']);
			}
		}
	}

	/**
	 *	Agregado el texto interno del tag
	 *
	 *	@author	Coalla, Sebastián <scoalla@seminario.edu.uy>
	 *	@param string $texto Texto interno del tag. Pueden ser tags HTMl
	 */
	function setHtmlInterno($texto) {
		$this->htmlInterno = $texto;
	}
	/**
	 *	Agregado de tag hijo
	 *
	 *	@author	Coalla, Sebastián <scoalla@seminario.edu.uy>
	 *	@param object 	$tagHijo objeto htmlTag que se agrega como hijo del objeto
	 *	@param integer 	$posicion posición en el arreglo de hijos, si no le paso nada agrega al final
	 */
	function addTag($tagHijo,$posicion = 'auto') {
		if ($posicion == 'auto') {
			$this->tagsComponentes[] = $tagHijo;
		} else {
			$this->tagsComponentes[$posicion] = $tagHijo;
		}
	}
	/**
	 *	Obtener tag
	 *
	 *	Se construye un tag HMTL. Si debe haber un tag de cierre $mustClose debe ser TRUE
	 *	$mustClose = true --> <label>...</label>
	 *	$mustClose = false --> <input type="text" ... />
	 *
	 *	@author	Roselli, Diego <diego@rosellimailhe.net>
	 *	@param string $txt 
	 *	@return string
	 */
	function get($txt="") {

		if($txt != ''){
			$this->htmlInterno = $txt;
		}

		$html = '<' . $this->tag;
		if (is_array($this->attribs)) {
			foreach ($this->attribs as $attrib => $value) {
				$html.= " $attrib=\"$value\"";
			}
		}
		if ($this->mustClose) {
			//Si tiene tags hijos los procesa
			if (count($this->tagsComponentes) >= 1) {
				foreach($this->tagsComponentes as $posicion => $tagHijo) {
					$this->htmlInterno = $this->htmlInterno.$tagHijo->get();
				}
				
			}
			$html.= ">" . $this->htmlInterno . '</' . $this->tag . ">\n";
		} else {
			$html.= " />\n";
		}

		return $html;
	}
}
/**
 *	Clase que construye un <SELECT>
 *
 *	@class	combo
 *	@file	xeniusHTML.class.php
 */
class combo extends htmlTag {
	var $opValue = "";
	var $opInicio = false;
	var $opIniCod = "";
	var $opIniMostrar = "";
	var $opcion = "";
	var $opciones = array();
	var $opSelected = "";
	var $selId = "";
	var $selName = "";
	var $estilo = "";

	/**
	 *	Constructor
	 *
	 *	@param	string $class Clase de estilos CSS que usa el combo
	 *	@param	string $id Id del combo
	 *	@param	string $name nombre del combo
	 *	@class	combo
	 */
	function combo($class='',$id='',$name='') {
		if ($class != '') {
			$this->addAttrib('class',$class);
		}
		if ($id != '') {
			$this->addAttrib('id',$id);
		}
		if ($name != '') {
			$this->addAttrib('name',$name);
		}
	}
	/**
	 *	Clave del array que representa la opción
	 *
	 *	La clave del array
	 *	Ejemplo: $array (id_pais => "uy", nom_pais => "Uruguay"...
	 *		En este caso, el valor de $val es id_pais
	 *
	 *	@class	combo
	 *	@author	Roselli, Diego <diego@rosellimailhe.net>
	 *	@param string $val clave de array que corresponde a "value"
	 */
	function opValue($val) {
		$this->opValue = $val;
	}
	/**
	 *	Opción inicial que se muestra en el Combo
	 *
	 *	Opción "falsa" que se muestra primero: por ejemplo:
	 *	"Seleccione País"
	 *
	 *	@class	combo
	 *	@author	Roselli, Diego <diego@rosellimailhe.net>
	 *	@param string $cod el código de la opción inicial
	 *	@param string $mostrar el texto que se muestra
	 */
	function opInicio($cod, $mostrar) {
		$this->opIniCod = $cod;
		$this->opIniMostrar = $mostrar;
		$this->opInicio = true;
	}
	/**
	 *	Dato del array que representa el rótulo de la opción
	 *
	 *	Ejemplo: $array (id_pais => "uy", nom_pais => "Uruguay"...
	 *		En este caso, el valor de $opcion es nom_pais
	 *
	 *	@class	combo
	 *	@author	Roselli, Diego <diego@rosellimailhe.net>
	 *	@param string $opcion elemento del array que corresponde al rótulo de la opción
	 */
	function opLabel($opcion) {
		$this->opcion = $opcion;
	}
	function opSelected($selected) {
		$this->opSelected = $selected;
	}
	function selId($id) {
		$this->selId = $id;
	}
	function selName($name) {
		$this->selName = $name;
	}
	function estilo($estilo) {
		$this->estilo = $estilo;
	}
	/**
	 *	Agrega con un arreglo la lista de datos del combo
	 *
	 *	@class	combo
	 *	@author	Coalla, Sebastián <coalla@gmail.com>
	 *	@param array $aDatos opciones del combo
	 */
	function setOpciones($aDatos) {
		$this->opciones = $aDatos;
	}

	/**
	 *	Se construye un <select> y se devuelve HTML
	 *
	 *	@class	combo
	 *	@author	Roselli, Diego <diego@rosellimailhe.net>
	 *	@param array $aDatos opciones del combo 
	 */
	function obt($aDatos) {
		$combo = "<select";
		if ($this->estilo) {
			$combo.= " class=\"{$this->estilo}\"";
		}
		if ($this->selId) {
			$combo.= " id=\"{$this->selId}\"";
		}
		if ($this->selName) {
			$combo.= " name=\"{$this->selName}\"";
		}
		if (is_array($this->attribs)) {
			foreach ($this->attribs as $attrib => $value) {
				$combo.= " $attrib=\"$value\"";
			}
		}
		$combo.= ">\n";
		if ($this->opInicio) {
			$combo.= "\t<option value=\"{$this->opIniCod}\">{$this->opIniMostrar}</option>\n";
			$combo.= "\t<option value=\"{$this->opIniCod}\">{$this->opIniMostrar}</option>\n";
			
		}
		foreach ($aDatos as $i => $opciones) {
			if ($opciones[$this->opValue]==$this->opSelected) {
				$combo.= "\t<option value=\"{$opciones[$this->opValue]}\" selected=\"selected\">{$opciones[$this->opcion]}</option>\n";
			} else {
				$combo.= "\t<option value=\"{$opciones[$this->opValue]}\">{$opciones[$this->opcion]}</option>\n";
			}
		}
		$combo.= "</select>\n";

		return $combo;
	}

	/**
	 *	Se construye un <select> y se devuelve HTML
	 *
	 *	@class	combo
	 *	@author	Coalla, Sebastián <coalla@gmail.com>
	 *	@param array $aDatos opciones del combo
	 */
	function get($txt = '') {
		$combo = "<select";
		if ($this->estilo) {
			$combo.= " class=\"{$this->estilo}\"";
		}
		if ($this->selId) {
			$combo.= " id=\"{$this->selId}\"";
		}
		if ($this->selName) {
			$combo.= " name=\"{$this->selName}\"";
		}
		if (is_array($this->attribs)) {
			foreach ($this->attribs as $attrib => $value) {
				$combo.= " $attrib=\"$value\"";
			}
		}
		$combo.= ">\n";
		if ($this->opInicio) {
			$combo.= "\t<option value=\"{$this->opIniCod}\">{$this->opIniMostrar}</option>\n";
			$combo.= "\t<option value=\"{$this->opIniCod}\">{$this->opIniMostrar}</option>\n";

		}
		foreach ($this->opciones as $i => $opciones) {
			if ($opciones[$this->opValue]==$this->opSelected) {
				$combo.= "\t<option value=\"{$opciones[$this->opValue]}\" selected=\"selected\">{$opciones[$this->opcion]}</option>\n";
			} else {
				$combo.= "\t<option value=\"{$opciones[$this->opValue]}\">{$opciones[$this->opcion]}</option>\n";
			}
		}
		$combo.= "</select>\n";

		return $combo;
	}

}
/**
 *	Clase que construye un <INPUT> de tipo text
 *
 *	@class	inputText
 *	@file	xeniusHTML.class.php
 */
class inputText extends htmlTag {

	/**
	 *	Constructor
	 *  Recibe los valores inciales y carga las variables de la clase
	 *	@class	inputText
	 *	@param	string $class Clase de estilos CSS que usa el input
	 *	@param	string $id Id del input
	 *	@param	string $name nombre del input
	 *	@param	string $value valor que tiene asignado el input
	 *	@param	array $otros_atributos otros atributos recibidos en un arreglo.
	 */
	public function inputText($class='',$id='',$name='',$value='',$otros_atributos='') {

		//Es un input de texto
		$this->tag = 'input';
		$this->mustClose = false;
		$this->addAttrib('type','text');
		if (is_array($otros_atributos)){
			$this->addAttributes($otros_atributos);
		}

		if ($class != '') {
			$this->addAttrib('class',$class);
		}
		if ($id != '') {
			$this->addAttrib('id',$id);
		}
		if ($name != '') {
			$this->addAttrib('name',$name);
		}
		if ($value != '') {
			$this->addAttrib('value',$value);
		}
	}
	/**
	 *	Se construye un <input> y se devuelve HTML
	 *
	 *	@class	combo
	 *	@author	Roselli, Diego <diego@rosellimailhe.net>
	 *	@param array $aDatos opciones del combo
	 */
	function obt() {

		return $input;
	}
}
?>