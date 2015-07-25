<?php /* Smarty version Smarty-3.1.19, created on 2015-06-11 12:15:54
         compiled from "templates/lista_p.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13159472305579a62aadd6f9-28878893%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f52130cbe08cbe916b53f37d6e8ff9c6ba2ded6f' => 
    array (
      0 => 'templates/lista_p.tpl',
      1 => 1434035442,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13159472305579a62aadd6f9-28878893',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'msg' => 0,
    'clase' => 0,
    'formulario' => 0,
    'nav' => 0,
    'paginado' => 0,
    'lista' => 0,
    'entry' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5579a62ab28696_40113387',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5579a62ab28696_40113387')) {function content_5579a62ab28696_40113387($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <link type="text/css" rel="stylesheet" href="./css/estilo.css">
    <link type="text/css" rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="./bootstrap/css/bootstrap-theme.min.css">

    <title>Sistema</title>

    

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
		<span style="text-align:left;font-size:35px;">Proveedores</span>
		
		<?php if ($_smarty_tpl->tpl_vars['msg']->value!='') {?>
			<div class="container">
				<button type="button" class="<?php echo $_smarty_tpl->tpl_vars['clase']->value;?>
" ><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
 </button>
			<div>
			<p></p>
		<?php }?>

		<?php echo $_smarty_tpl->tpl_vars['formulario']->value;?>

		
		<table class="table table-condensed table-striped table-bordered" width="80%" align="left" border="5">
			<thead>
			<tr>
				<th colspan="3" align="center" style="text-align: center;">
				<form action="ingreso_nvo_p.php" method="post">
					<input class="form-control" type="submit" name="btConf" value="Agregar" />
				</form>
				</th>
				<th style="text-align: center;">RUT</th>
				<th style="text-align: center;">Empresa</th>
				<th style="text-align: center;">Nombre</th>
				<th style="text-align: center;">Apellido</th>
				<th style="text-align: center;">Direccion</th>
				<th style="text-align: center;">Tel Of</th>
				<th style="text-align: center;">Tel Cont</th>
				<th style="text-align: center;">Celular</th>
				<th style="text-align: center;">Correo</th>
				<th style="text-align: center;">Web</th>
			</tr>
			</thead>
			<tfoot>
				<tr>
					<td height="2" colspan="13" align="right">
					<span style="float:left;"><?php echo $_smarty_tpl->tpl_vars['nav']->value;?>
</span><span style="float:right;"><?php echo $_smarty_tpl->tpl_vars['paginado']->value;?>
</span>
					</td>
				</tr>
			</tfoot>
			
			<tbody>
				<tr>
					<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['record'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['record']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['record']['name'] = 'record';
$_smarty_tpl->tpl_vars['smarty']->value['section']['record']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['lista']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['record']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['record']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['record']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['record']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['record']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['record']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['record']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['record']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['record']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['record']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['record']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['record']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['record']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['record']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['record']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['record']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['record']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['record']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['record']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['record']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['record']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['record']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['record']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['record']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['record']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['record']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['record']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['record']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['record']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['record']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['record']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['record']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['record']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['record']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['record']['total']);
?> 
						<td align="center"><a href="parte_diario_fch.php" title="Ver registro"><span class="glyphicon glyphicon-th-list"></span></a></td>
						<td align="center"><a href="" title="Editar registro"><span style="color:green;" class="glyphicon glyphicon-pencil"></span></a></td>
						<td align="center"><a href="" onClick="" title="Eliminar registro"><span style="color:red;" class="glyphicon glyphicon-remove"></span></a></td>
						<?php  $_smarty_tpl->tpl_vars['entry'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entry']->_loop = false;
 $_smarty_tpl->tpl_vars['nombre'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['lista']->value[$_smarty_tpl->getVariable('smarty')->value['section']['record']['index']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entry']->key => $_smarty_tpl->tpl_vars['entry']->value) {
$_smarty_tpl->tpl_vars['entry']->_loop = true;
 $_smarty_tpl->tpl_vars['nombre']->value = $_smarty_tpl->tpl_vars['entry']->key;
?> 
							<td align='center'><?php echo $_smarty_tpl->tpl_vars['entry']->value;?>
</td> 
						<?php } ?> 
						</tr> 
					<?php endfor; endif; ?> 
				
			 
				</tr>
			</tbody>
			</table>

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
