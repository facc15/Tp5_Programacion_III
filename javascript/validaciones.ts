function AdministrarModificar(dni:number)
{
        alert(dni);

        (<HTMLInputElement>document.getElementById("idHidden")).value=dni.toString();

        
}


function AdministrarValidacionesLogin()
{
    
    let idCampos:Array<string>=["txtDni","txtApellido"];
    let dni:string= (<HTMLInputElement>document.getElementById("txtDni")).value;
    let apellido:string=(<HTMLInputElement>document.getElementById("txtApellido")).value;

    let minDni:number=parseInt((<HTMLInputElement>document.getElementById("txtDni")).min);
    let maxDni:number=parseInt((<HTMLInputElement>document.getElementById("txtDni")).max);

    for (let i = 0; i < idCampos.length; i++) 
    {
        
        if(ValidarCamposVacios(idCampos[i]))
        {
            AdministrarSpanError(idCampos[i]+"Span",true);
            if(ValidarRangoNumerico(parseInt(dni),minDni,maxDni))
            {
                AdministrarSpanError("txtDniSpan",true);
                

            }else
            {
                
                AdministrarSpanError("txtDniSpan",false);
    
            }

        }else
        {
            AdministrarSpanError(idCampos[i]+"Span",false);
        }       
        
    } 

        if(VerificarValidacionesLogin())
        {      
            return true;   
        }

    

    return false;

}



function AdministrarValidaciones(): boolean
{
    let idCampos:Array<string>=["txtDni","txtApellido","txtNombre","txtLegajo","txtSueldo","fileArchivo"];
    let dni:string = (<HTMLInputElement>document.getElementById("txtDni")).value;
    let nombre:string= (<HTMLInputElement>document.getElementById("txtNombre")).value;
    let apellido:string= (<HTMLInputElement>document.getElementById("txtApellido")).value;
    let legajo:string= (<HTMLInputElement>document.getElementById("txtLegajo")).value;
    let sueldo:string = (<HTMLInputElement>document.getElementById("txtSueldo")).value;
    let sexo:string= (<HTMLInputElement>document.getElementById("cboSexo")).value;
    
    let turno:string= ObtenerTurnoSeleccionado();

    let minSueldo:number= parseInt((<HTMLInputElement>document.getElementById("txtSueldo")).min);
    let maxSueldo:number = ObtenerSueldoMaximo(turno);
    (<HTMLInputElement>document.getElementById("txtSueldo")).max= maxSueldo.toString();


    let minDni:number=parseInt((<HTMLInputElement>document.getElementById("txtDni")).min);
    let maxDni:number=parseInt((<HTMLInputElement>document.getElementById("txtDni")).max);

    let minLegajo:number=parseInt((<HTMLInputElement>document.getElementById("txtLegajo")).min);
    let maxLegajo:number=parseInt((<HTMLInputElement>document.getElementById("txtLegajo")).max);
 
    let seleccione:string="---";

    for (let i = 0; i < idCampos.length; i++) 
    {
        if(ValidarCamposVacios(idCampos[i]))
        {
            AdministrarSpanError(idCampos[i]+"Span",true);          

        }else
        {
            AdministrarSpanError(idCampos[i]+"Span",false);
        }   
    }

    if(ValidarRangoNumerico(parseInt(dni),minDni,maxDni))
          {
              AdministrarSpanError("txtDniSpan",true);
          }
          else
          {
            AdministrarSpanError("txtDniSpan",false);
          }

         if(ValidarRangoNumerico(parseInt(legajo),minLegajo,maxLegajo))
         {
            AdministrarSpanError("txtLegajoSpan",true);
         }
         else
         {
            AdministrarSpanError("txtLegajoSpan",false);
         }

         if(ValidarRangoNumerico(parseInt(sueldo),minSueldo,maxSueldo))
         {
            AdministrarSpanError("txtSueldoSpan",true);
                    
         }else
         {
            AdministrarSpanError("txtSueldoSpan",false);
          }

         if(ValidarCombo(sexo,seleccione))
          {
            AdministrarSpanError("cboSexoSpan",true);

           }else
           {
            AdministrarSpanError("cboSexoSpan",false);
           }

            if(VerificarValidacionesLogin())
            {
                let cadena:string="Legajo: " + legajo;
                cadena+="\nNombre: " + nombre;
                cadena+="\nApellido: " + apellido;
                cadena+="\nDni: " + dni;
                cadena+="\nSexo: " + sexo;
                cadena+="\nSueldo: " + sueldo;
                cadena+="\nTurno: " + turno;

                console.log(cadena);

                  return true;

            }

            return false;

} 


function ValidarCamposVacios(elem:string):boolean
{
    let item= (<HTMLInputElement>document.getElementById(elem)).value;

    if(item!="")
    {
        return true;
    }

    return false;
}

function ValidarRangoNumerico(value:number,min:number,max:number):boolean
{
    if(value<=max && value>=min)
    {
        return true;
    }
    return false;
}

function ValidarCombo(value:string,notValue:string):boolean
{
    if(value !=notValue)
    {
        return true;
    }
    return false;
}

function ObtenerTurnoSeleccionado():string
{
    let radios = document.getElementsByTagName("input");
    let turnito:string="";
    for (var i = 0; i < radios.length; i++) 
    {
           if (radios[i].type === "radio" && radios[i].checked) {
               turnito = radios[i].value;       
           }
    }
    return turnito;
}

function ObtenerSueldoMaximo(value:string): number
{
    if(value=="Mañana")
    {
        return 20000;
    }else if(value=="Tarde")
    {
        return 18500;
    }else
    {
        return 25000;
    }

}

function VerificarValidacionesLogin():boolean
{
    let spans= document.getElementsByTagName("span");
    let retorno=true;

    for (let i = 0; i < spans.length; i++) {
        if ((<HTMLSpanElement>spans[i]).style.display == "block") {
            retorno = false;
            break;
          }
        
    }

    return retorno;
}


function AdministrarSpanError(elem:string, bool:boolean)
{

    if(bool)
    {
        (<HTMLInputElement>document.getElementById(elem)).style.display="none";
    }else
    {
        (<HTMLInputElement>document.getElementById(elem)).style.display="block";
    }


}