
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Sistema</title>

    <!-- Bootstrap core CSS -->
    <link href="./clases/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    

    <!-- Custom styles for this template -->
    <link href="./css/navbar-fixed-top.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>
	function addRowToTable()
		{
		  var tbl = document.getElementById('tblSample');
		  var lastRow = tbl.rows.length;
		  // if there's no header row in the table, then iteration = lastRow + 1
		  var iteration = lastRow;
		  var row = tbl.insertRow(lastRow);
		  
		  // select cell
		  var cellRightSel = row.insertCell(0);
		  var sel = document.createElement('select');
		  sel.name = 'selRow' + iteration;
		  sel.options[0] = new Option('text zero', 'value0');
		  sel.options[1] = new Option('text one', 'value1');
		  cellRightSel.appendChild(sel);
		  
		  // desde
		  var cellRight = row.insertCell(1);
		  var el = document.createElement('input');
		  el.type = 'text';
		  el.name = 'desdeRow' + iteration;
		  el.id = 'desdeRow' + iteration;
		  el.size = 5;
		  cellRight.appendChild(el);
		  
		  // hasta
		  var cellRight = row.insertCell(2);
		  var el = document.createElement('input');
		  el.type = 'text';
		  el.name = 'hastaRow' + iteration;
		  el.id = 'hastaRow' + iteration;
		  el.size = 5;
		  cellRight.appendChild(el);
		  
		  // escuela
		  var cellRight = row.insertCell(3);
		  var el = document.createElement('input');
		  el.type = 'text';
		  el.name = 'escuelaRow' + iteration;
		  el.id = 'escuelaRow' + iteration;
		  el.size = 40;
		  cellRight.appendChild(el);
		  
		  
		  el.onkeypress = keyPressTest;
		  cellRight.appendChild(el);
		  
		}
		function keyPressTest(e, obj)
		{
		  var validateChkb = document.getElementById('chkValidateOnKeyPress');
		  if (validateChkb.checked) {
			var displayObj = document.getElementById('spanOutput');
			var key;
			if(window.event) {
			  key = window.event.keyCode; 
			}
			else if(e.which) {
			  key = e.which;
			}
			var objId;
			if (obj != null) {
			  objId = obj.id;
			} else {
			  objId = this.id;
			}
			displayObj.innerHTML = objId + ' : ' + String.fromCharCode(key);
		  }
		}
		function removeRowFromTable()
		{
		  var tbl = document.getElementById('tblSample');
		  var lastRow = tbl.rows.length;
		  if (lastRow > 2) tbl.deleteRow(lastRow - 1);
		}
		function openInNewWindow(frm)
		{
		  // open a blank window
		  var aWindow = window.open('', 'TableAddRowNewWindow',
		   'scrollbars=yes,menubar=yes,resizable=yes,toolbar=no,width=400,height=400');
		   
		  // set the target to the blank window
		  frm.target = 'TableAddRowNewWindow';
		  
		  // submit
		  frm.submit();
		}
		function validateRow(frm)
		{
		  var chkb = document.getElementById('chkValidate');
		  if (chkb.checked) {
			var tbl = document.getElementById('tblSample');
			var lastRow = tbl.rows.length - 1;
			var i;
			for (i=1; i<=lastRow; i++) {
			  var aRow = document.getElementById('txtRow' + i);
			  if (aRow.value.length <= 0) {
				alert('Row ' + i + ' is empty');
				return;
			  }
			}
		  }
		  openInNewWindow(frm);
		}
	</script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Fixed navbar -->
	{include file= "navegacion.tpl"}
	<div class="container">
		{if $msg != ''}
			<div class="container">
				<button type="button" class="{$clase}" >{$msg} </button>
			<div>
			<p></p>
		{/if}
		
		<script src="segundaPagina.js">
		</script>
		
		<form method="POST" action="parte_diario_dml.php?op=I">
			<div class="table-responsive">
				<table class="table">
					<tr>
						<td>
							<label>Mes</label>
						</td>
						<td>
							<select name="mes">
							  <option value="3">Marzo</option>
							  <option value="4">Abril</option>
							  <option value="5">Mayo</option>
							  <option value="6">Junio</option>
							  <option value="7">Julio</option>
							  <option value="8">Agosto</option>
							  <option value="9">Setiembre</option>
							  <option value="10">Octubre</option>
							  <option value="11">Noviembre</option>
							  <option value="12">Diciembre</option>
							 </select>
						</td>
					</tr>
					<tr>
						<td>
							<label>Año </label>
						</td>
						<td>
							<input type="text" size="4" name="anio">
						</td>
					</tr>
				</table>
			</div>

			<div class="table-responsive">
			<table class="table">
				<p>
				<input type="button" value="Agregar" onclick="addRowToTable();" />
				<input type="button" value="Remover" onclick="removeRowFromTable();" />
				</p>
				<table border="1" id="tblSample">
				  <tr>
					<th colspan="4">Faltas docentes</th>
				  </tr>
				  <tr>
					<th>Docente</th>
					<th>Desde</th>
					<th>Hasta</th>
					<th>Escuela</th>
				  </tr>
				  <tr>
					<td>
					<select name="selRow0">
					<option value="value0">text zero</option>
					<option value="value1">text one</option>
					</select>
					</td>
					<td>
						<input type="text" name="txtRow1" id="desdeRow1" size="5" onkeypress="keyPressTest(event, this);" />
					</td>
					<td>
						<input type="text" name="desdeRow1" id="hastaRow1" size="5" onkeypress="keyPressTest(event, this);" />
					</td>
					<td>
						<input type="text" name="escuelaRow1" id="escuelaRow1" size="40" onkeypress="keyPressTest(event, this);" />
					</td>
					
				  </tr>
			</table>
			</div>

			<br></br>
			<input type="submit" value="Enviar datos"> 
		</form>		
					
 
			
		
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="./clases/bootstrap/js/bootstrap.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>	