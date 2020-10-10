<?php 

require_once './Entidades/persona.php';
require_once './Entidades/empleado.php';
require_once './Entidades/fabrica.php';



$nombre= $_POST["nombre"];
$apellido=$_POST["apellido"];
$dni=$_POST["dni"];
$legajo=$_POST["legajo"];
$turno=$_POST["turno"];
$sexo=$_POST["sexo"];
$sueldo=$_POST["sueldo"];
$pathFoto=$_FILES["archivo"]["name"];

$hdnModificar=$_POST["hdnModificar"];

if(isset($hdnModificar))
{
    $f=fopen("./Archivos/empleados.txt","r");

            while(!feof($f))
            {
            
                $cadena=fgets($f);
    
                $e=explode(" - ",$cadena);
    
                if($e[0]==$dni)
                {
                  
                    
                $empleado=new Empleado($e[1],$e[2],$e[0],$e[3],$e[4],$e[5],$e[6]);

                $empleado->SetPathFoto($e[7]);
                    
                $fabrica=new Fabrica("utn",7);
                $fabrica->TraerDeArchivo("./Archivos/empleados.txt");

                if($fabrica->EliminarEmpleado($empleado))
                {
                   
                    $fabrica->GuardarEnArchivo("./Archivos/empleados.txt");
                    $eliminarFoto=$empleado->GetPathFoto();
                    $eliminarFoto=trim($eliminarFoto);

                    if(!unlink("./".$eliminarFoto))
                    {
                       echo "no se pudo eliminar la foto"; 
                    }

                }
                break;
                    
                }
                    

            }
       
            fclose($f);

}

$explode= explode(".", $pathFoto);
$extension=array_pop($explode);

$fabrica=new Fabrica("Utn",7);
$path="Archivos/empleados.txt";

$destino="Fotos/". $dni."-".$apellido.".".$extension;


if(!getimagesize($_FILES["archivo"]["tmp_name"]))
{

    


}else
{
    if($extension=="jpg" || $extension=="bmp" || $extension=="gif" || $extension=="png" || $extension=="jepg")
    {
        if($_FILES["archivo"]["size"]<=1000000)
        {
            if(!file_exists($destino))  
            {
                $empleado= new Empleado($nombre,$apellido,$dni,$sexo,$legajo,$sueldo,$turno);
                $empleado->SetPathFoto($destino);
                 move_uploaded_file($_FILES["archivo"]["tmp_name"],$destino);

                $fabrica->TraerDeArchivo($path);


                if($fabrica->AgregarEmpleado($empleado))
                {

                   $fabrica->GuardarEnArchivo($path);
                    echo "<b>Se agregó el empleado</b> <br><br>";
                   echo "<a href='mostrar.php'>Mostrar lista de empleados </a>";


                }else
                {
                    echo "<b>No se pudo agregar al empleado </b> <br><br>";
                    echo "<a href='index.php'>Reintentar </a>";

                }

            }else
            {
                echo "<h3>El archivo con ese nombre ya se encuentra!!!</h3>";
                echo "<br><a href='index.php'>Volver </a>";

            }
            
    

        }else
        {
            echo "<h3>El archivo es muy grande!!!</h3>";
            echo "<br><a href='index.php'>Volver </a>";
        }
        

    }else
    {
        echo "<h3>El archivo tiene una extensión inválida!!!</h3>";
        echo "<br><a href='index.php'>Volver </a>";
    }
    

}

?>



