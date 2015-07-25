<?php /* Smarty version Smarty-3.1.19, created on 2015-03-09 17:27:39
         compiled from "templates/parte_diario.tpl" */ ?>
<?php /*%%SmartyHeaderCode:95683774954f89c847b9523-48917297%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b9cd30a56cfd8fa29ea3c2693b54c50cffa046da' => 
    array (
      0 => 'templates/parte_diario.tpl',
      1 => 1425932853,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '95683774954f89c847b9523-48917297',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_54f89c847d2941_27175701',
  'variables' => 
  array (
    'nombre' => 0,
    'msg' => 0,
    'clase' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54f89c847d2941_27175701')) {function content_54f89c847d2941_27175701($_smarty_tpl) {?>﻿
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

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Sistema</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Inicio</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Ingresar <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="docente_nvo.php">Docente</a></li>
                <li><a href="parte_diario.php">Faltas</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Informe <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="informe_docente.php">Por docente</a></li>
                <li><a href="informe_total.php">Total</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="#"><?php echo $_smarty_tpl->tpl_vars['nombre']->value;?>
</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	<div class="container">
		<?php if ($_smarty_tpl->tpl_vars['msg']->value!='') {?>
			<div class="container">
				<button type="button" class="<?php echo $_smarty_tpl->tpl_vars['clase']->value;?>
" ><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
 </button>
			<div>
			<p></p>
		<?php }?>
		
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
			<table id="myTable" class="table">
				<table class="table">
					<thead>
						<tr>
						<th><label>Docente: </label></th>
						<th><label>Desde: </label></th>
						<th><label>Hasta: </label></th>
						<th><label>Escuela: </label></th>
						</tr>
					</thead>
					</tbody>			
						<tr>
                                                    <td><input type="text" name="docente1"></td>
                                                    <td><input type="text" name="desde"></td>
                                                    <td><input type="text" name="hasta"></td>
                                                    <td><input type="text" name="escuela"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="docente2"></td>
                                                    <td><input type="text" name="desde"></td>
                                                    <td><input type="text" name="hasta"></td>
                                                    <td><input type="text" name="escuela"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="docente3"></td>
                                                    <td><input type="text" name="desde"></td>
                                                    <td><input type="text" name="hasta"></td>
                                                    <td><input type="text" name="escuela"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="docente4"></td>
                                                    <td><input type="text" name="desde"></td>
                                                    <td><input type="text" name="hasta"></td>
                                                    <td><input type="text" name="escuela"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" name="docente5"></td>
                                                    <td><input type="text" name="desde"></td>
                                                    <td><input type="text" name="hasta"></td>
                                                    <td><input type="text" name="escuela"></td>
                                                </tr>
                                        </tbody>
				</table>
			</div>
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
</html>	<?php }} ?>
