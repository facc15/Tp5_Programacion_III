<?php 

require_once './Entidades/persona.php';
require_once './Entidades/empleado.php';
require_once './Entidades/fabrica.php';

$legajo=$_GET["legajo"];

$path="Archivos/empleados.txt";

$f=fopen($path,"r");

$esta=false;

while(!feof($f))
{
    $cadena=fgets($f);

    $e=explode(" - ",$cadena);

    if(sizeof($e)>1)
    {
        if($e[4] === $legajo)
      {
        $empleado=new Empleado($e[1],$e[2],$e[0],$e[3],$e[4],$e[5],$e[6]);
        $empleado->SetPathFoto($e[7]);
        
        $esta=true;
        

        $fabrica=new Fabrica("Utn",7);

        $fabrica->TraerDeArchivo($path);
        


        if($fabrica->EliminarEmpleado($empleado))
        {
            $eliminarFoto=$empleado->GetPathFoto();
            $eliminarFoto=trim($eliminarFoto);

            unlink("./".$eliminarFoto);
            

            $fabrica->GuardarEnArchivo($path);

            echo "<br><b>Empleado eliminado: </b>";
            echo $empleado->GetLegajo(). " - ".$empleado->GetApellido(). " " .$empleado->GetNombre();
            echo "<br><br><br><a href='mostrar.php'>Mostrar lista</a>";
            echo "<br><a href='index.html'>Volver a la página principal </a>";
        }else
        {
            echo "<br><b>No se pudo eliminar al empleado</b>";
            echo "<br><a href='mostrar.php'>Mostrar lista</a>";
            echo "<br><a href='index.html'>Volver a la página principal </a>";
        }

     }

    }
    


}

if(!$esta)
{
    echo "<br><b>No hubo coincidencia</b>";
    echo "<br><a href='mostrar.php'>Mostrar </a>";
    echo "<br><a href='index.html'>Volver a la página principal </a>";

}



fclose($f);





?>