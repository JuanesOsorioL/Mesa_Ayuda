$("#Primero").click(function () {
  Action = "Primero";
  let ruta = "Action=" + Action;
  $.ajax({
    url: "../script/view/VistaInforme.php",
    type: "POST",
    data: ruta,
  })
    .done(function (res) {
      // console.log(res);
      $(".contenedor_primero").html(res);
    })
    .fail(function () {
      console.log("error");
    })
    .always(function () {
      console.log("complete");
    });
});

$("#Segundo").click(function () {
  Action = "Segundo";
  let ruta = "Action=" + Action;
  $.ajax({
    url: "../script/view/VistaInforme.php",
    type: "POST",
    data: ruta,
  })
    .done(function (res) {
      $(".contenedor_Segundo").html(res);
    })
    .fail(function () {
      console.log("error");
    })
    .always(function () {
      console.log("complete");
    });
});
