<?php /* Smarty version Smarty-3.1.19, created on 2015-06-11 14:50:44
         compiled from "templates/ingreso_nvo_c.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2692309225575bcb6963671-25086873%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '722eb35e56668ad86c1deb91f77d2eb16c6ad988' => 
    array (
      0 => 'templates/ingreso_nvo_c.tpl',
      1 => 1434045041,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2692309225575bcb6963671-25086873',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5575bcb698a5c0_34966235',
  'variables' => 
  array (
    'msg' => 0,
    'clase' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5575bcb698a5c0_34966235')) {function content_5575bcb698a5c0_34966235($_smarty_tpl) {?>﻿
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

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Fixed navbar -->
    <?php echo $_smarty_tpl->getSubTemplate ("navegacion.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	
	
	<div class="container">
		<?php if ($_smarty_tpl->tpl_vars['msg']->value!='') {?>
			<div class="container">
				<button type="button" class="<?php echo $_smarty_tpl->tpl_vars['clase']->value;?>
 btn-lg" ><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
 </button>
			<div>
			<p></p>
		<?php }?>
		<form class="form-horizontal" method="POST" name="ingreso_nvo" id="ingreso_nvo"  action="ingreso_dml_c.php?op=I" enctype="multipart/form-data">
			<div class="panel panel-default">
                <div class="panel-heading">
                <strong>Ingresar Empresa</strong>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-xs-2 control-label" for="rut">RUT</label>
                        <div class="col-xs-4">
                            <input id="rut" class="form-control" type="text" name="inst[rut]"> </input>
                        </div>
                        <label class="col-xs-2 control-label" for="empresa">Empresa</label>
                        <div class="col-xs-4">
                            <input id="empresa" class="form-control" type="text" name="inst[empresa]"> </input>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-2 control-label" for="nombre">Nombre</label>
                        <div class="col-xs-4">
                            <input id="nombre" class="form-control" type="text" name="inst[nombre]"> </input>
                        </div>
                        <label class="col-xs-2 control-label" for="apellido">Apellido</label>
                        <div class="col-xs-4">
                            <input id="apellido" class="form-control" type="text" name="inst[apellido]"> </input>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-2 control-label" for="direccion">Direccion</label>
                        <div class="col-xs-4">
                            <input id="direccion" class="form-control" type="text" name="inst[direccion]"> </input>
                        </div>
                        <label class="col-xs-2 control-label" for="tel_of">Telefono Oficina</label>
                        <div class="col-xs-4">
                            <input id="tel_of" class="form-control" type="text" name="inst[tel_of]"> </input>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-2 control-label" for="tel_cont">Telefono Contacto</label>
                        <div class="col-xs-4">
                            <input id="tel_cont" class="form-control" type="text" name="inst[tel_cont]"> </input>
                        </div>
                        <label class="col-xs-2 control-label" for="celular">Celular</label>
                        <div class="col-xs-4">
                            <input id="celular" class="form-control" type="text" name="inst[celular]"> </input>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-2 control-label" for="Correo">Correo</label>
                        <div class="col-xs-4">
                            <input id="correo" class="form-control" type="text" name="inst[correo]"> </input>
                        </div>
                        <label class="col-xs-2 control-label" for="web">Web</label>
                        <div class="col-xs-4">
                            <input id="web" class="form-control" type="text" name="inst[web]"> </input>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container text-center">
                <input class="btn btn-primary btn-lg" id="guardar" type="submit" value="Guardar"></input>
                <input class="btn btn-primary btn-lg" id="restablecer" type="reset" value="Restablecer"></input>
                <input class="btn btn-primary btn-lg" id="cancelar" type="submit" value="Cancelar"></input>
            </div>
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
