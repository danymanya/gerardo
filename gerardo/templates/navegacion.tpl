<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a style="color:white;" class="navbar-brand" href="#">Sistema</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index_auth.php">Inicio</a></li>
            <li><a Style="color:white;" href="lista_c.php">Clientes</a></li>
            <li><a Style="color:white;" href="lista_p.php">Proveedores</a></li>
            <li><a Style="color:white;" href="lista_prod.php">Productos</a></li>
            <!--<li class="dropdown">
              <a Style="color:white;" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Clientes <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="ingreso_nvo_c.php">Ingresar</a></li>
                <li><a href="lista_c.php">Consultar</a></li>
              </ul>
            </li>-
            <li class="dropdown">
              <a Style="color:white;" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Proveedores <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="ingreso_nvo_p.php">Ingresar</a></li>
                <li><a href="lista_p.php">Consultar</a></li>
              </ul>
            </li>-->
			<li class="dropdown">
              <a Style="color:white;" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Contabilidad <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="informe_docente.php">Facturas</a></li>
                <li><a href="informe_total.php">Crédito</a></li>
				<li><a href="informe_total.php">Débito</a></li>
              </ul>
            </li>
			<li class="dropdown">
              <a Style="color:white;" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Informes <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="informe_docente.php">Facturación</a></li>
                <li><a href="informe_total.php">Clientes</a></li>
				<li><a href="informe_total.php">Proveedores</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="#">{$nombre}</a></li>
            <li><a Style="color:white;" href="index.php">Salir</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	