let Action;

$(document).ready(main);

function main() {
  Action = "LoadPage";
  let ruta = "Action=" + Action;
  $.ajax({
    url: "./Vista/VistaAlertas.php",
    type: "POST",
    data: ruta,
  })
    .done(function (respu) {
      $(".main--alertas").html(respu);
    })
    .fail(function () {
      console.log("error");
    })
    .always(function () {
      console.log("complete");
    });
}

function area() {
  window.location.href = "./GestionArea.php";
}
