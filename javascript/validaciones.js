"use strict";
function AdministrarModificar(dni) {
    document.getElementById("hiddenModificar").value = dni.toString();
    document.getElementById("formModificar").submit();
}
function ModificarEmpleado(nombre, apellido, dni, sexo, legajo, sueldo, turno) {
    document.title = "HTML5 Formulario Modificar Empleado";
    document.getElementById("idTitulo").innerHTML = "Modificar Empleado";
    document.getElementById("txtNombre").value = nombre;
    document.getElementById("txtApellido").value = apellido;
    document.getElementById("txtDni").value = dni;
    document.getElementById("txtDni").readOnly = true;
    document.getElementById("cboSexo").value = sexo;
    document.getElementById("txtLegajo").value = legajo;
    document.getElementById("txtLegajo").readOnly = true;
    document.getElementById("txtSueldo").value = sueldo;
    var checkTurno = "";
    document.getElementById("txtSueldo").value = sueldo;
    if (turno == "Mañana") {
        checkTurno = "turnoMañana";
    }
    else if (turno == "Tarde") {
        checkTurno = "turnoTarde";
    }
    else {
        checkTurno = "turnoNoche";
    }
    document.getElementById(checkTurno).checked = true;
    document.getElementById("hdnModificar").value = dni;
}
function AdministrarValidacionesLogin() {
    var idCampos = ["txtDni", "txtApellido"];
    var dni = document.getElementById("txtDni").value;
    var apellido = document.getElementById("txtApellido").value;
    var minDni = parseInt(document.getElementById("txtDni").min);
    var maxDni = parseInt(document.getElementById("txtDni").max);
    for (var i = 0; i < idCampos.length; i++) {
        if (ValidarCamposVacios(idCampos[i])) {
            AdministrarSpanError(idCampos[i] + "Span", true);
            if (ValidarRangoNumerico(parseInt(dni), minDni, maxDni)) {
                AdministrarSpanError("txtDniSpan", true);
            }
            else {
                AdministrarSpanError("txtDniSpan", false);
            }
        }
        else {
            AdministrarSpanError(idCampos[i] + "Span", false);
        }
    }
    if (VerificarValidacionesLogin()) {
        return true;
    }
    return false;
}
function AdministrarValidaciones() {
    var idCampos = ["txtDni", "txtApellido", "txtNombre", "txtLegajo", "txtSueldo", "fileArchivo"];
    var dni = document.getElementById("txtDni").value;
    var nombre = document.getElementById("txtNombre").value;
    var apellido = document.getElementById("txtApellido").value;
    var legajo = document.getElementById("txtLegajo").value;
    var sueldo = document.getElementById("txtSueldo").value;
    var sexo = document.getElementById("cboSexo").value;
    var turno = ObtenerTurnoSeleccionado();
    var minSueldo = parseInt(document.getElementById("txtSueldo").min);
    var maxSueldo = ObtenerSueldoMaximo(turno);
    document.getElementById("txtSueldo").max = maxSueldo.toString();
    var minDni = parseInt(document.getElementById("txtDni").min);
    var maxDni = parseInt(document.getElementById("txtDni").max);
    var minLegajo = parseInt(document.getElementById("txtLegajo").min);
    var maxLegajo = parseInt(document.getElementById("txtLegajo").max);
    var seleccione = "---";
    for (var i = 0; i < idCampos.length; i++) {
        if (ValidarCamposVacios(idCampos[i])) {
            AdministrarSpanError(idCampos[i] + "Span", true);
        }
        else {
            AdministrarSpanError(idCampos[i] + "Span", false);
        }
    }
    if (ValidarRangoNumerico(parseInt(dni), minDni, maxDni)) {
        AdministrarSpanError("txtDniSpan", true);
    }
    else {
        AdministrarSpanError("txtDniSpan", false);
    }
    if (ValidarRangoNumerico(parseInt(legajo), minLegajo, maxLegajo)) {
        AdministrarSpanError("txtLegajoSpan", true);
    }
    else {
        AdministrarSpanError("txtLegajoSpan", false);
    }
    if (ValidarRangoNumerico(parseInt(sueldo), minSueldo, maxSueldo)) {
        AdministrarSpanError("txtSueldoSpan", true);
    }
    else {
        AdministrarSpanError("txtSueldoSpan", false);
    }
    if (ValidarCombo(sexo, seleccione)) {
        AdministrarSpanError("cboSexoSpan", true);
    }
    else {
        AdministrarSpanError("cboSexoSpan", false);
    }
    if (VerificarValidacionesLogin()) {
        var cadena = "Legajo: " + legajo;
        cadena += "\nNombre: " + nombre;
        cadena += "\nApellido: " + apellido;
        cadena += "\nDni: " + dni;
        cadena += "\nSexo: " + sexo;
        cadena += "\nSueldo: " + sueldo;
        cadena += "\nTurno: " + turno;
        console.log(cadena);
        return true;
    }
    return false;
}
function ValidarCamposVacios(elem) {
    var item = document.getElementById(elem).value;
    if (item != "") {
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
function VerificarValidacionesLogin() {
    var spans = document.getElementsByTagName("span");
    var retorno = true;
    for (var i = 0; i < spans.length; i++) {
        if (spans[i].style.display == "block") {
            retorno = false;
            break;
        }
    }
    return retorno;
}
function AdministrarSpanError(elem, bool) {
    if (bool) {
        document.getElementById(elem).style.display = "none";
    }
    else {
        document.getElementById(elem).style.display = "block";
    }
}
//# sourceMappingURL=validaciones.js.map