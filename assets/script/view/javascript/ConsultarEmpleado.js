let btn = "";
let objectURLFoto;
let objectURLCV;

function consulta() {
  Action = "Consultar";
  let cedula = document.getElementById("IDEmple").value;
  let ruta = "Accion=" + Action + "&txtIDEmpleado=" + cedula;
  $.ajax({
    url: "../script/view/VistaC_M_D_Empleado.php",
    type: "POST",
    data: ruta,
  })
    .done(function (res) {
      $("#resultadoconsulta").html(res);
    })
    .fail(function () {
      console.log("error");
    })
    .always(function () {
      console.log("complete");
    });
}

function file_foto(e) {
  objectURLFoto = URL.createObjectURL(e.target.files[0]);
  document.getElementById("Foto").src = objectURLFoto;
}

function file_hoja(e) {
  objectURLCV = URL.createObjectURL(e.target.files[0]);
  document.getElementById("Hoja_vida").src = objectURLCV;
}

$("#Modificar").click(function () {
  btn = "Modificar";
  let ruta = "Accion=" + btn;
  $.ajax({
    url: "../script/view/VistaC_M_D_Empleado.php",
    type: "POST",
    data: ruta,
  })
    .done(function (res) {
      $("#RequerimientoSinAsignar").html(res);
    })
    .fail(function () {
      console.log("error");
    })
    .always(function () {
      console.log("complete");
    });
});
