function Guardar() {
  let Action = "Radicar";
  let Area = document.getElementById("selectArea").value;
  let Titulo = document.getElementById("titulo").value;
  let message = document.getElementById("message").value;

  let ruta =
    "Action=" +
    Action +
    "&selectArea=" +
    Area +
    "&titulo=" +
    Titulo +
    "&message=" +
    message;
  $.ajax({
    url: "../script/view/VistaRequerimiento.php",
    type: "POST",
    data: ruta,
  })
    .done(function (respu) {
      console.log(respu);
      $(".main--respuestarequerimiento").html(respu);
    })
    .fail(function () {
      console.log("error");
    })
    .always(function () {
      console.log("complete");
    });
}
function Menu() {
  window.location.href = "./Menu.php";
}
