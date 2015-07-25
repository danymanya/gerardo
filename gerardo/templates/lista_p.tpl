<!DOCTYPE html>
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
    {include file= "navegacion.tpl"}
	
	
	<div class="container">
		<span style="text-align:left;font-size:35px;">Proveedores</span>
		
		{if $msg != ''}
			<div class="container">
				<button type="button" class="{$clase}" >{$msg} </button>
			<div>
			<p></p>
		{/if}

		{$formulario}
		
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
					<span style="float:left;">{$nav}</span><span style="float:right;">{$paginado}</span>
					</td>
				</tr>
			</tfoot>
			
			<tbody>
				<tr>
					{section name=record loop=$lista} 
						<td align="center"><a href="parte_diario_fch.php" title="Ver registro"><span class="glyphicon glyphicon-th-list"></span></a></td>
						<td align="center"><a href="" title="Editar registro"><span style="color:green;" class="glyphicon glyphicon-pencil"></span></a></td>
						<td align="center"><a href="" onClick="" title="Eliminar registro"><span style="color:red;" class="glyphicon glyphicon-remove"></span></a></td>
						{foreach from=$lista[record] item=entry key=nombre} 
							<td align='center'>{$entry}</td> 
						{/foreach} 
						</tr> 
					{/section} 
				
			 
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
</html>	