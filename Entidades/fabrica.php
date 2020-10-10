<?php 

require_once "empleado.php";
require_once 'interfaces.php';

class Fabrica implements IArchivo
{
    private $_cantidadMaxima;
    private $_empleados;
    private $_razonSocial;


    public function __construct($razonSocial,$cantidadMaxima)
    {
        $this->_razonSocial=$razonSocial;
        $this->_empleados=[];
        $this->_cantidadMaxima=$cantidadMaxima;
    
    }

    public function  AgregarEmpleado(Empleado $emp)
    {
        $retorno=false;
        if($emp!==null)
        {
            if(count($this->_empleados)  < $this->_cantidadMaxima)
            {
                array_push($this->_empleados,$emp);
                
                $this->EliminarEmpleadosRepetidos();
                $retorno=true;
    
            }

        }
       return $retorno;
    }   

    public function CalcularSueldos()
    {
        $sueldos=0;

        foreach ($this->_empleados as $item) 
        {
            $sueldos+=$item->GetSueldo();
        }


        return $sueldos;
    }

    public function EliminarEmpleado(Empleado $emp)
    {
       
        if($emp !==null)
        {
            if(in_array($emp,$this->_empleados))
            {
                
                foreach ($this->_empleados as $key => $value) 
                {
                    if($this->_empleados[$key] ==$emp)
                    {
                        unset($this->_empleados[$key]);
                        return true;

                      $this->_empleados= array_values($this->_empleados);
                    }
                }
            }
        }

        return false;
    }

    public function EliminarEmpleadosRepetidos()
    {
        $this->_empleados=array_unique($this->_empleados,SORT_REGULAR);
    }

    public function ToString()
    {
        $retorno="Razon social: " . $this->_razonSocial . " - ";
        $retorno.="Cantidad: " . count($this->_empleados) .  " - ";
        $retorno.="Precio total: ". $this->CalcularSueldos() . " <br>";
        foreach ($this->_empleados as $key => $value) 
        {
            $retorno.=$value->ToString();
        }

        return $retorno . "<br><br><br>";
    }

    public function GetEmpleados()
    {
        return $this->_empleados;
    }

    public function TraerDeArchivo($nombreArchivo)
    {
        

        if(file_exists("./".$nombreArchivo))
        {
            $f=fopen($nombreArchivo,"r");

            while(!feof($f))
            {
                $cadena=fgets($f);
    
                $e=explode(" - ",$cadena);
    
                if(sizeof($e)>1)
                {
                $empleado=new Empleado($e[1],$e[2],$e[0],$e[3],$e[4],$e[5],$e[6]);

                $empleado->SetPathFoto($e[7]);
    
                $this->AgregarEmpleado($empleado);
                }
                    

            }
       
            fclose($f);

        }
      
        
    }

    public function GuardarEnArchivo($nombreArchivo)
    {

        $f=fopen($nombreArchivo,"w");


        foreach ($this->_empleados as $key => $value) 
        {

           fputs($f,$value->ToString()); 
        }

        fputs($f,"\n");

        fclose($f);

        
    }
}




?>