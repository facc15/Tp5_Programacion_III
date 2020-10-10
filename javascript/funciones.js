function AdministrarValidaciones() {
    var dni = document.getElementById("txtDni").value;
    var nombre = document.getElementById("txtNombre").value;
    var apellido = document.getElementById("txtApellido").value;
    var legajo = document.getElementById("txtLegajo").value;
    var sueldo = document.getElementById("txtSueldo").value;
    var sexo = document.getElementById("cboSexo").value;
    var todoOk = 0;
    var turno = ObtenerTurnoSeleccionado();
    var minSueldo = parseInt(document.getElementById("txtSueldo").min);
    var maxSueldo = ObtenerSueldoMaximo(turno);
    document.getElementById("txtSueldo").max = maxSueldo.toString();
    var minDni = parseInt(document.getElementById("txtDni").min);
    var maxDni = parseInt(document.getElementById("txtDni").max);
    var minLegajo = parseInt(document.getElementById("txtLegajo").min);
    var maxLegajo = parseInt(document.getElementById("txtLegajo").max);
    var seleccione = "---";
    if (ValidarCamposVacios(dni) && ValidarCamposVacios(nombre) && ValidarCamposVacios(apellido) &&
        ValidarCamposVacios(legajo) && ValidarCamposVacios(sueldo) && ValidarCamposVacios(sexo) &&
        ValidarCamposVacios(turno)) {
        if (ValidarRangoNumerico(parseInt(dni), minDni, maxDni)) {
            todoOk++;
        }
        else {
            alert("El dni no se encuentra en el rango válido");
        }
        if (ValidarRangoNumerico(parseInt(legajo), minLegajo, maxLegajo)) {
            todoOk++;
        }
        else {
            alert("El legajo no se encuentra en el rango válido");
        }
        if (ValidarRangoNumerico(parseInt(sueldo), minSueldo, maxSueldo)) {
            todoOk++;
        }
        else {
            alert("El sueldo no se encuentra en el rango válido");
        }
        if (ValidarCombo(sexo, seleccione)) {
            todoOk++;
        }
        else {
            alert("El sexo no fue seleccionado");
        }
        if (todoOk == 4) {
            var cadena = "Legajo: " + legajo;
            cadena += "\nNombre: " + nombre;
            cadena += "\nApellido: " + apellido;
            cadena += "\nDni: " + dni;
            cadena += "\nSexo: " + sexo;
            cadena += "\nSueldo: " + sueldo;
            cadena += "\nTurno: " + turno;
            console.log(cadena);
            alert(cadena);
        }
    }
    else {
        alert("Algún campo se encuentra vacio");
    }
}
function ValidarCamposVacios(elem) {
    if (elem != "") {
        return true;
    }
    return false;
}
function ValidarRangoNumerico(value, min, max) {
    if (value <= max && value >= min) {
        return true;
    }
    return false;
}
function ValidarCombo(value, notValue) {
    if (value != notValue) {
        return true;
    }
    return false;
}
function ObtenerTurnoSeleccionado() {
    var radios = document.getElementsByTagName("input");
    var turnito = "";
    for (var i = 0; i < radios.length; i++) {
        if (radios[i].type === "radio" && radios[i].checked) {
            turnito = radios[i].value;
        }
    }
    return turnito;
}
function ObtenerSueldoMaximo(value) {
    if (value == "Mañana") {
        return 20000;
    }
    else if (value == "Tarde") {
        return 18500;
    }
    else {
        return 25000;
    }
}
