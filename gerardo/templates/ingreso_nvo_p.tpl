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
    {include file= "navegacion.tpl"}
	
	
	<div class="container">
		{if $msg != ''}
			<div class="container">
				<button type="button" class="{$clase}" >{$msg} </button>
			<div>
			<p></p>
		{/if}
		<form method="POST" name="ingreso_nvo" id="ingreso_nvo"  action="ingreso_dml_p.php?op=I" enctype="multipart/form-data">
			<div style="padding: 5%;background:#D8D8D8">
                <div style="float:left">
                <label> Empresa:  </label> <input id="empresa" name="empresa"> </input>
                </div>
                <div style="float:right">
                <label> RUT:  </label> <input id="rut" name="rut"> </input>
                </div>
                <br></br>
                <div style="float:left">
                <label> Nombre:  </label><input id="nombre" name="nombre"> </input>
                </div>
                <div style="float:right">
                <label> Apellido:  </label><input id="apellido" name="apellido"> </input>
                </div>
                <br></br>
                <div style="float:left">
                <label> Dirección:  </label><input id="direccion" name="direccion"> </input>
                </div>
                <div style="float:right">
                <label> Telefono Oficina:  </label><input id="tel_of" name="tel_of"> </input>
                </div>
                <br></br>
                <div style="float:left">
                <label> Teléfono Contacto:  </label><input id="tel_cont" name="tel_cont"> </input>
                </div>
                <div style="float:right">
                <label> Celular:  </label><input id="celular" name="celular"> </input>
                </div>
                <br></br>
                <div style="float:left">
                <label> Correo:  </label><input id="correo" name="correo"> </input>
                </div>
                <div style="float:right">
                <label> Página Web:  </label><input id="web" name="web"> </input>
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
</html>	