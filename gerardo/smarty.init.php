<?php 
## 
# Smarty @ por dany.gonzalez.87@gmail.com 
## 

// Incluimos el siguiente archivo, que basicamente carga toda la libreria. 
require('smarty/libs/Smarty.class.php'); 

// Creamos un objeto Smarty, que llamaremos template. 
$template = new Smarty; 

// Y lo siguiente sera configurar los directorios previamente creados. 
// La ruta a estos directorios puede ser o bien relativa, o bien absoluta. 
$template->template_dir = 'templates/'; 
$template->compile_dir = 'templates_c/'; 
$template->config_dir = 'configs/'; 
$template->cache_dir = 'cache/'; 
?>