var counter = 1;
var limit = 5;
var contador = 1;
function addInput(divName)
{
    if (counter == limit)  
	{
        alert("You have reached the limit of adding " + counter + " inputs");
    }
    else 
	{
        var newdiv = document.createElement('div');
        newdiv.innerHTML = "<div class='table-responsive'><table class='table'><table class='table'><thead><tr><th><label>Docente: </label></th><th><label>Desde: </label></th><th><label>Hasta: </label></th><th><label>Escuela: </label></th></tr></thead></tbody><tr><td><input type='text' name='docente'></td><td><input type='text' name='desde'></td><td><input type='text' name='hasta'></td><td><input type='text' name='escuela'></td></tbody></table></div>";		
        document.getElementById(divName).appendChild(newdiv);
        counter++;
	contador++;
    }
}