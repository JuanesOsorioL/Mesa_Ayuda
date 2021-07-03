if (window.location.pathname === "/Mesa_Ayuda/index.php") {
  $(document).ready(iniciarindex);

  function iniciarindex() {
    Action = "Cargar";
    Inicio = "Inicio";
    var ruta = "Action=" + Action + "&Inicio=" + Inicio;
    $.ajax({
      url: "./assets/script/view/VistaMenu.php",
      type: "POST",
      data: ruta,
    })
      .done(function (respu) {
        $(".header--loguin").html(respu);
      })
      .fail(function () {
        console.log("error");
      })
      .always(function () {
        console.log("complete");
      });
  }

  function Logoutinicio() {
    Action = "Borrar";
    var ruta = "Action=" + Action;
    $.ajax({
      url: "./assets/script/view/VistaMenu.php",
      type: "POST",
      data: ruta,
    })
      .done(function () {
        window.location.href = "index.php";
      })
      .fail(function () {
        console.log("error");
      })
      .always(function () {
        console.log("complete");
      });
  }
} else {
  $(document).ready(iniciar);

  function Logout() {
    Action = "Borrar";
    var ruta = "Action=" + Action;
    $.ajax({
      url: "../script/view/VistaMenu.php",
      type: "POST",
      data: ruta,
    })
      .done(function () {
        window.location.href = "../../index.php";
      })
      .fail(function () {
        console.log("error");
      })
      .always(function () {
        console.log("complete");
      });
  }

  function iniciar() {
    Action = "Cargar";
    var ruta = "Action=" + Action;
    $.ajax({
      url: "../script/view/VistaMenu.php",
      type: "POST",
      data: ruta,
    })
      .done(function (respu) {
        $(".header--loguin").html(respu);
      })
      .fail(function () {
        console.log("error");
      })
      .always(function () {
        console.log("complete");
      });
  }
}
