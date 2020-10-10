<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML5 - Listado de empleados</title>
    <script src="./javascript/validaciones.js"> document.form.submit()</script>
    <style>
         table {
				display: flex;
                margin-left: 10%;

				}
                hr {
                 height: 0px;
                 width: 40%;
                 margin-left: 10%;
                 background-color: black;
                    }
    </style>
   
</head>
<body>
    <h2>Listado de Empleados</h2>
    <form  action="index.php" method="POST" name="form" id="formModificar" >
    <input type="hidden" name="hiddenModificar" id="hiddenModificar" >
    </form>
    
</body>
</html>

<?php 

    
    require_once './Entidades/persona.php';
    require_once './Entidades/empleado.php';
    require_once './Entidades/fabrica.php';
    include_once './Backend/validarSesion.php';
    

    $fabrica=new Fabrica("Utn",7);

    $fabrica->TraerDeArchivo("Archivos/empleados.txt");
    
    echo "<h4>info</h4> <br><br>";


    echo "<hr>";
    foreach ($fabrica->GetEmpleados() as $key => $empleado) 
    {  
            
            echo "<table>
                <tr>    <td>{$empleado->ToString()} </td>
                        <td><img src={$empleado->GetPathFoto()} width='90' height='90'><a href='eliminar.php?legajo={$empleado->GetLegajo()}'>Eliminar </a> </td>
                        <td><input type='button' value='Modificar' onclick='AdministrarModificar({$empleado->GetDni()})' /></td> 
                </tr> </table>";
           
    }
    echo "<hr />";

    

?>


 <br><a href='index.php'>Alta de empleados </a>
 <br>
 <br><a href='./Backend/cerrarSesion.php'>Desloguear </a>