var btn = "";
$("#buscar").click(function () {
  if (document.getElementById("Observaciones") !== null) {
    document.getElementById("Observaciones").innerHTML = "";
  }
  if (document.getElementById("MSJ") !== null) {
    document.getElementById("MSJ").innerHTML = "";
  }

  btn = "Buscar";
  var selectarea = document.getElementById("SelectArea").value;
  var ruta = "Accion=" + btn + "&SelectArea=" + selectarea;

  $.ajax({
    url: "../script/view/VistaConsulta.php",
    type: "POST",
    data: ruta,
  })
    .done(function (res) {
      $("#RequerimientoSinAsignar").html(res);

      if (document.getElementById("SelectReque") !== null) {
        $("#Seleccionar").click(function () {
          if (document.getElementById("MSJ") !== null) {
            document.getElementById("MSJ").innerHTML = "";
          }

          btn = "Seleccionar";
          var selectarea = document.getElementById("SelectArea").value;
          var selectreque = document.getElementById("SelectReque").value;
          var ruta =
            "Accion=" +
            btn +
            "&SelectArea=" +
            selectarea +
            "&SelectReque=" +
            selectreque;

          $.ajax({
            url: "../script/view/VistaConsulta.php",
            type: "POST",
            data: ruta,
          })
            .done(function (respu) {
              $("#Observaciones").html(respu);

              ////tercero
              if (document.getElementById("message") !== null) {
                //////evento del radio
                document
                  .getElementById("cancelar")
                  .addEventListener("click", () => {
                    document.getElementById("SelectEmpleado").disabled = true;
                    document.getElementById("SelectEmpleado").selectedIndex =
                      "0";
                  });

                document
                  .getElementById("asignar")
                  .addEventListener("click", () => {
                    document.getElementById("SelectEmpleado").disabled = false;
                  });

                /////

                $("#Guardar").click(function () {
                  btn = "Guardar";
                  var control = false;
                  var message = $("#message").val();
                  var SelectEmpleado =
                    document.getElementById("SelectEmpleado").value;
                  var SelectReque =
                    document.getElementById("SelectReque").value;

                  if (message == "") {
                    $("#MSJ").html("<h4> porfavor ingrese un comentario</h4>");
                  } else {
                    if (document.getElementById("asignar").checked) {
                      if (SelectEmpleado === "0") {
                        $("#MSJ").html(
                          "<h4> porfavor seleccione a quien asignar</h4>"
                        );
                      } else {
                        control = true;
                      }
                    } else {
                      control = true;
                    }
                  }

                  if (control) {
                    var ruta =
                      "Accion=" +
                      btn +
                      "&SelectReque=" +
                      SelectReque +
                      "&SelectEmpleado=" +
                      SelectEmpleado +
                      "&message=" +
                      message;

                    $.ajax({
                      url: "../script/view/VistaConsulta.php",
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
            })
            ////tercero
            .fail(function () {
              console.log("error");
            })
            .always(function () {
              console.log("complete");
            });
        });
      }
      /////segundo
    })
    .fail(function () {
      console.log("error");
    })
    .always(function () {
      console.log("complete");
    });
});
////////////
