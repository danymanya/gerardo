<?php /* Smarty version Smarty-3.1.19, created on 2015-06-22 14:49:56
         compiled from "templates/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1110682644553e149ca40630-13789596%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3cbc17c6c950c0539f0de54eae5ffc9051e06f39' => 
    array (
      0 => 'templates/index.tpl',
      1 => 1434995394,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1110682644553e149ca40630-13789596',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_553e149ca73027_16057070',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_553e149ca73027_16057070')) {function content_553e149ca73027_16057070($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>ACarteras</title>

    <!-- Bootstrap core CSS -->
    <link href="./clases/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/signin.css" rel="stylesheet">
    
    <script src="./clases/bootstrap/js/bootstrap.js"></script>

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="./clases/javascripts/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <a href="../autentica.php"></a>
    <![endif]-->
  </head>

  <body>

    <div class="container">
        <form class="form-signin" action="autentica.php" method="POST">
            <h2 class="form-signin-heading">Ingrese al sistema</h2>
            <input name="user" id="user" type="text"  class="form-control" placeholder="Usuario" required autofocus>
            <input name="password" type="password" id="password" class="form-control" placeholder="Contraseña" required>
            <input class="btn btn-lg btn-primary btn-block" id="blogin" type="submit" value="Ingresar" />
        </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html><?php }} ?>
