<?php /* Smarty version Smarty-3.1.19, created on 2015-06-10 10:32:17
         compiled from "templates/ingreso_nvo_c.tpl" */ ?>
<?php /*%%SmartyHeaderCode:129868864055783c6113fff2-12673448%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '688579c935320e4d882582e430d920fe179379bf' => 
    array (
      0 => 'templates/ingreso_nvo_c.tpl',
      1 => 1433783290,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '129868864055783c6113fff2-12673448',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'msg' => 0,
    'clase' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55783c61afc4f5_28032944',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55783c61afc4f5_28032944')) {function content_55783c61afc4f5_28032944($_smarty_tpl) {?>﻿
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
" ><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
 </button>
			<div>
			<p></p>
		<?php }?>
		<form method="POST" name="ingreso_nvo" id="ingreso_nvo"  action="ingreso_dml_c.php?op=I" enctype="multipart/form-data">
			<div style="padding: 5%;background:#D8D8D8">
                <div style="float:left">
                <label> Empresa:  </label> <input id="empresa" name="inst[empresa]"> </input>
                </div>
                <div style="float:right">
                <label> RUT:  </label> <input id="rut" name="inst[rut]"> </input>
                </div>
                <br></br>
                <div style="float:left">
                <label> Nombre:  </label><input id="nombre" name="inst[nombre]"> </input>
                </div>
                <div style="float:right">
                <label> Apellido:  </label><input id="apellido" name="inst[apellido]"> </input>
                </div>
                <br></br>
                <div style="float:left">
                <label> Dirección:  </label><input id="direccion" name="inst[direccion]"> </input>
                </div>
                <div style="float:right">
                <label> Telefono Oficina:  </label><input id="tel_of" name="inst[tel_of]"> </input>
                </div>
                <br></br>
                <div style="float:left">
                <label> Teléfono Contacto:  </label><input id="tel_cont" name="inst[tel_cont]"> </input>
                </div>
                <div style="float:right">
                <label> Celular:  </label><input id="celular" name="inst[celular]"> </input>
                </div>
                <br></br>
                <div style="float:left">
                <label> Correo:  </label><input id="correo" name="inst[correo]"> </input>
                </div>
                <div style="float:right">
                <label> Página Web:  </label><input id="web" name="inst[web]"> </input>
                </div>
                <br></br>
                <br></br>
                <input id="guardar" type="submit" value="Guardar"></input>
                <input id="restablecer" type="reset" value="Restablecer"></input>
                <input id="cancelar" type="submit" value="Cancelar"></input>
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
