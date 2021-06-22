function Menu() {
  window.location.href = "./Menu.php";
}
var btn = "";
$(document).ready(main);

function main() {
  btn = "Cargar";
  var ruta = "Accion=" + btn;
  $.ajax({
    url: "../script/view/VistaMisRequerimientos.php",
    type: "POST",
    data: ruta,
  })
    .done(function (respu) {
      $("#RequerimientoSinAsignar").html(respu);
      seleccionar();
    })
    .fail(function () {
      console.log("error");
    })
    .always(function () {
      console.log("complete");
    });
}

function seleccionar() {
  if (document.getElementById("SelectReque") !== null) {
    $("#Seleccionar").click(function () {
      if (document.getElementById("MSJ") !== null) {
        document.getElementById("MSJ").innerHTML = "";
      }

      btn = "Seleccionar";
      var selectreque = document.getElementById("SelectReque").value;
      var ruta = "Accion=" + btn + "&SelectReque=" + selectreque;

      $.ajax({
        url: "../script/view/VistaMisRequerimientos.php",
        type: "POST",
        data: ruta,
      })
        .done(function (respu) {
          $("#Observaciones").html(respu);
          guardar();
        })
        .fail(function () {
          console.log("error");
        })
        .always(function () {
          console.log("complete");
        });
    });
  }
}

function guardar() {
  if (document.getElementById("message") !== null) {
    $("#Guardar").click(function () {
      controlradio = "";
      btn = "Guardar";
      var message = $("#message").val();
      var SelectReque = document.getElementById("SelectReque").value;

      if (message == "") {
        $("#MSJ").html("<h4> porfavor ingrese un comentario</h4>");
      } else {
        if (document.getElementsByName("option")[0].checked == true) {
          controlradio = "true";
        } else {
          controlradio = "false";
        }

        var ruta =
          "Accion=" +
          btn +
          "&SelectReque=" +
          SelectReque +
          "&message=" +
          message +
          "&Stotal=" +
          controlradio;

        $.ajax({
          url: "../script/view/VistaMisRequerimientos.php",
          type: "POST",
          data: ruta,
        })
          .done(function (respu) {
            $("#MSJ").html(respu);
          })
          .fail(function () {
            console.log("error");
          })
          .always(function () {
            console.log("complete");
          });
      }
    });
  }
}
