<?php 

//require_once 'verificarUsuario.php';
session_start();

if (isset($_SESSION["DniEmpleado"]))
{
    echo "Logueado";
}else
{
    sleep(1);
    header("Location: ./login.html");

}


?>