<?php /* Smarty version Smarty-3.1.19, created on 2015-05-28 10:35:41
         compiled from "templates/ingreso_nvo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10471337875565c0f035abb0-60170957%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bde95e89dfd17ef72bcaf128024beabeef68eab0' => 
    array (
      0 => 'templates/ingreso_nvo.tpl',
      1 => 1432820137,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10471337875565c0f035abb0-60170957',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5565c0f03b9e50_57211417',
  'variables' => 
  array (
    'msg' => 0,
    'clase' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5565c0f03b9e50_57211417')) {function content_5565c0f03b9e50_57211417($_smarty_tpl) {?>﻿
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
		<div style="background:#B7B7B7;">
		<?php if ($_smarty_tpl->tpl_vars['msg']->value!='') {?>
			<div class="container">
				<button type="button" class="<?php echo $_smarty_tpl->tpl_vars['clase']->value;?>
" ><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
 </button>
			<div>
			<p></p>
		<?php }?>
		<form method="POST" name="docente_nvo" id="docente_nvo"  action="docente_dml.php?op=I" enctype="multipart/form-data">
		</form>
		<div>
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
