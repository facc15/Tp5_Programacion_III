<?php 



$apellido=$_POST["apellido"];
$dni=$_POST["dni"];


$f=fopen("../Archivos/empleados.txt","r");
$esta=false;


session_start();





$contamos=0;
while(!feof($f))
{
        $cadena=fgets($f);
    
        $e=explode(" - ",$cadena);

        if(sizeof($e)>1)
        {
            if($dni==$e[0] && $apellido==$e[2])
            {
                $esta=true;
                $_SESSION["DniEmpleado"]=$dni;
                break;

            }
        }
        
      

}

if(!$esta)
{
    echo "<h4>Error, no se encuentra el empleado con esos datos!!!</h4>";

    echo "<br><br><a href='../login.html'>Volver a login </a>";
}else
{
    echo "<h4>El empleado se encuentra!!</h4>";

    sleep(1);
    header("Location: ../mostrar.php");
}

            
       
fclose($f);



?>