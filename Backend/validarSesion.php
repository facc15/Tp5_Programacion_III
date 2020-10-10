<?php 

//require_once 'verificarUsuario.php';
require_once './Entidades/fabrica.php';
session_start();

if (isset($_SESSION["DniEmpleado"]))
{
    $dniSesion=$_SESSION["DniEmpleado"];
    $fabrica=new Fabrica("utn",7);
    $fabrica->TraerDeArchivo("./Archivos/empleados.txt");
    $empleados=$fabrica->GetEmpleados();
    foreach($empleados as $empleado)
    {
        if($empleado->GetDni()==$dniSesion)
        {
            echo "<h4>".$empleado->GetApellido() .", ".$empleado->GetNombre()."<h4>";
        }
    }
    
}else
{
    sleep(1);
    header("Location: ./login.html");

}


?>