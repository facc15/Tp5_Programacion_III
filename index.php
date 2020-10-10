<?php 

require_once './Backend/validarSesion.php';

require_once './Entidades/fabrica.php';

require_once "./Entidades/empleado.php";

if(isset($_POST["hiddenModificar"]))
{	
	$dni=$_POST["hiddenModificar"];
	
	$fabrica=new Fabrica("Utn",7);
	
	$fabrica->TraerDeArchivo("Archivos/empleados.txt");
	$empleados=$fabrica->GetEmpleados();
	
}



?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>HTML 5 – Formulario Alta Empleado</title>
		<script src="./javascript/validaciones.js"></script>
		<style>

		
			table {
				display: flex;
				justify-content: center;
				align-items: center;
				  }
		</style>
	</head>
	<body>
		<form action="administracion.php" method="POST" class="form-register" enctype="multipart/form-data" onsubmit="return AdministrarValidaciones()">
		<input type="hidden" id="hdnModificar" name="hdnModificar" >		
			<table>

				<!-- HEAD -->
				<thead>
					<h2 id="idTitulo">Alta de empleados</h2>
				</thead>

				<!-- BODY -->
				<tbody>
					<!-- Datos Personales -->
					<tr>
						<td>
							<h4>Datos Personales</h4>
							<hr />
						</td>
					</tr>
					<tr>
						<td>
							<label for="txtDni" >DNI:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<input id="txtDni" name="dni" type="number" min="1000000" max="55000000" />
							<span id="txtDniSpan" style="display:none">*</span>
						</td>
					</tr>
					<tr>
						<td>
							<label for="txtApellido">Apellido:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<input id="txtApellido" name="apellido" type="text" />
							<span id="txtApellidoSpan" style="display:none">*</span>
						</td>
					</tr>
					<tr>
						<td>
							<label for="txtNombre">Nombre:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<input id="txtNombre" name="nombre" type="text" />
							<span id="txtNombreSpan" style="display:none">*</span>
						</td>
					</tr>
					<tr>
						<td>
							<label for="cboSexo">Sexo:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<select name="sexo" id="cboSexo">
								<option selected value="---">Seleccione</option>
								<option value="M">Masculino</option>
								<option value="F">Femenino</option>
							</select>
							<span id="cboSexoSpan" style="display:none">*</span>
						</td>
					</tr>

					<!-- Datos laborales -->
					<tr>
						<td>
							<h4>Datos Laborales</h4>
							<hr />
						</td>
					</tr>
					<tr>
						<td>
							<label for="txtLegajo">Legajo:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<input id="txtLegajo" name="legajo" type="number" min="100" max="550" />
							<span id="txtLegajoSpan" style="display:none">*</span>
						</td>
					</tr>
					<tr>
						<td>
							<label for="txtSueldo">Sueldo:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<input id="txtSueldo" name="sueldo" type="number" min="8000" max="5000000000" step="500"; />
							<span id="txtSueldoSpan" style="display:none">*</span>
						</td>
					</tr>
					<tr>
						<td>
							<label for="rdoTurno">Turno:</label>
						</td>
					</tr>
					<tr>
						<td>
							<input checked value="Mañana" id="turnoMañana" type="radio" name="turno" />Mañana <br />
							<input value="Tarde" id="turnoTarde" type="radio" name="turno" />Tarde <br />
							<input value="Noche" id="turnoNoche" type="radio" name="turno" />Noche
						</td>
					</tr>
					<tr>
						<td>
							<input type="file" name="archivo" id="fileArchivo"/>
							<span id="fileArchivoSpan" style="display:none">*</span>

						</td>
					</tr>
					<tr>
						<td>
							<hr />
						</td>
					</tr>
					<tr>
						<td colspan="2" align="right">
							
							<input type="reset" value="Limpiar" />
							<br />						
						</td>
					</tr>
					<tr>
						<td colspan="2" align="right">
							<input type="submit" value="Enviar" onclick="AdministrarValidaciones()"/>
						</td>
					</tr>
				</tbody>
			</table>

			
		</form>
		<?php	
		
		if(isset($dni))
        {          
            foreach ($empleados as $item) 
            { 
                if ($item->GetDni() == $dni) 
                {
					
					$nombre = $item->GetNombre();
					$apellido = $item->GetApellido();
                    $sexo = $item->GetSexo();
                    $legajo = $item->GetLegajo();
                    $sueldo = $item->GetSueldo();
                    $turno = $item->GetTurno();
					echo "<script>ModificarEmpleado('$nombre','$apellido','$dni','$sexo','$legajo','$sueldo','$turno');</script>";              
                }
			}
		}	
        ?>
        <br><a href='./Backend/cerrarSesion.php'>Desloguear </a>
	</body>
</html>
