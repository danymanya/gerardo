﻿
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
            <li class="active"><a href="#">{$nombre}</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	<div class="container">
		{if $msg != ''}
			<div class="container">
				<button type="button" class="{$clase}" >{$msg} </button>
			<div>
			<p></p>
		{/if}
		<form method="POST" name="docente_nvo" id="docente_nvo"  action="docente_dml.php?op=I" enctype="multipart/form-data">
			<div class="panel panel-primary">
				<p>
				<div class="panel-heading">
					<h3 class="panel-title">Apellidos </h3>
				</div>
				<div class="input-group input-group">
					<input type="text" class="form-control" name="inst[apellido]" placeholder="Apellidos" aria-describedby="sizing-addon2">
				</div>
				</p>
				<p>
				<div class="panel-heading">
					<h3 class="panel-title">Nombres </h3>
				</div>
				<div class="input-group input-group">
					<input type="text" class="form-control" name="inst[nombre]" placeholder="Nombres" aria-describedby="sizing-addon2">
				</div>
				</p>
				<p>
				<div class="panel-heading">
					<h3 class="panel-title">Cédula </h3>
				</div>
				<div class="input-group input-group">
					<input type="text" class="form-control" name="inst[cedula]" placeholder="Cédula" aria-describedby="sizing-addon2">
				</div>
				</p>
			</div>
			<table>
			</table>
			<p style="text-align:left;">
				<input class="btn btn-success" type="submit" name="btConf"   value="Guardar" id="guardar" />
				<input class="btn btn-success" type="reset"  name="btReset"  value="Restablecer" id="restablecer" />
				<input class="btn btn-success" type="submit" name="btConf" value="Cancelar" id="cancelar" />
			</p>
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