<?php /* Smarty version Smarty-3.1.19, created on 2015-03-26 14:08:06
         compiled from "templates/navegacion.tpl" */ ?>
<?php /*%%SmartyHeaderCode:211996618055143cca86bfc5-88125847%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3ddae381fbc841d04d8709e8441d9b062aa6bd53' => 
    array (
      0 => 'templates/navegacion.tpl',
      1 => 1427389684,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '211996618055143cca86bfc5-88125847',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55143cca87adf3_32551053',
  'variables' => 
  array (
    'nombre' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55143cca87adf3_32551053')) {function content_55143cca87adf3_32551053($_smarty_tpl) {?><nav class="navbar navbar-inverse navbar-fixed-top">
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
	<?php }} ?>
