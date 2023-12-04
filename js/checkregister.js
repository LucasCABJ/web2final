$(() => {
  let usernameValid = false;
  let passwordValid = false;
  let confirmPasswordValid = false;
  let firstNameValid = false;
  let lastNameValid = false;
  let dniValid = false;

  let checkSubmit = () => {
    if (
      usernameValid &&
      dniValid &&
      passwordValid &&
      confirmPasswordValid &&
      firstNameValid &&
      lastNameValid
    ) {
      $("#registersubmitbtn").prop("disabled", false);
    } else {
      $("#registersubmitbtn").prop("disabled", true);
    }
  };

  $("#rusername").on("input", () => {
    if ($("#rusername").val() == "") {
      $("#usernameHelp1").css("color", "rgba(173, 181, 189, 0.75)");
    } else if (!/[\W]/.test($("#rusername").val())) {
      $("#usernameHelp1").css("color", "#0f6d00");
    } else {
      $("#usernameHelp1").css("color", "#b31717");
    }

    if ($("#rusername").val() == "") {
      $("#usernameHelp2").css("color", "rgba(173, 181, 189, 0.75)");
    } else if ($("#rusername").val().length >= 8) {
      $("#usernameHelp2").css("color", "#0f6d00");
    } else {
      $("#usernameHelp2").css("color", "#b31717");
    }

    if (
      !/\s/.test($("#rusername").val()) &&
      $("#rusername").val().length >= 8 &&
      !/[\W]/.test($("#rusername").val())
    ) {
      usernameValid = true;
    } else {
      usernameValid = false;
    }

    checkSubmit();
  });

  $("#rpassword").on("input", () => {
    if ($("#rpassword").val() == "") {
      $("#passwordHelp1").css("color", "rgba(173, 181, 189, 0.75)");
    } else if (!/ /.test($("#rpassword").val())) {
      $("#passwordHelp1").css("color", "#0f6d00");
    } else {
      $("#passwordHelp1").css("color", "#b31717");
    }

    if ($("#rpassword").val() == "") {
      $("#passwordHelp2").css("color", "rgba(173, 181, 189, 0.75)");
    } else if (/[^a-zA-Z0-9 ]/.test($("#rpassword").val())) {
      $("#passwordHelp2").css("color", "#0f6d00");
    } else {
      $("#passwordHelp2").css("color", "#b31717");
    }

    if ($("#rpassword").val() == "") {
      $("#passwordHelp3").css("color", "rgba(173, 181, 189, 0.75)");
    } else if (/[a-z]/.test($("#rpassword").val())) {
      $("#passwordHelp3").css("color", "#0f6d00");
    } else {
      $("#passwordHelp3").css("color", "#b31717");
    }

    if ($("#rpassword").val() == "") {
      $("#passwordHelp4").css("color", "rgba(173, 181, 189, 0.75)");
    } else if (/[A-Z]/.test($("#rpassword").val())) {
      $("#passwordHelp4").css("color", "#0f6d00");
    } else {
      $("#passwordHelp4").css("color", "#b31717");
    }

    if ($("#rpassword").val() == "") {
      $("#passwordHelp5").css("color", "rgba(173, 181, 189, 0.75)");
    } else if (/[0-9]/.test($("#rpassword").val())) {
      $("#passwordHelp5").css("color", "#0f6d00");
    } else {
      $("#passwordHelp5").css("color", "#b31717");
    }

    if (
      /(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^a-zA-Z0-9 ])(?!.* ).*/.test(
        $("#rpassword").val()
      )
    ) {
      passwordValid = true;
    } else {
      passwordValid = false;
    }

    if ($("#rconfirmpassword").val() == "") {
      $("#rconfirmpasswordHelp1").text("Vuelva a ingresar la contraseña.");
      $("#rconfirmpasswordHelp1").css("color", "rgba(173, 181, 189, 0.75)");
      confirmPasswordValid = false;
    } else if (
      $("#rconfirmpassword").val() == $("#rpassword").val() &&
      passwordValid
    ) {
      $("#rconfirmpasswordHelp1").text("Las contraseñas coinciden.");
      $("#rconfirmpasswordHelp1").css("color", "#0f6d00");
      confirmPasswordValid = true;
    } else {
      $("#rconfirmpasswordHelp1").css("color", "#b31717");
      $("#rconfirmpasswordHelp1").text("Las contraseñas no coinciden.");
      confirmPasswordValid = false;
    }

    checkSubmit();
  });

  $("#rconfirmpassword").on("input", () => {
    if ($("#rconfirmpassword").val() == "") {
      $("#rconfirmpasswordHelp1").css("color", "rgba(173, 181, 189, 0.75)");
      $("#rconfirmpasswordHelp1").text("Vuelva a ingresar la contraseña.");
      confirmPasswordValid = false;
    } else if (
      $("#rconfirmpassword").val() == $("#rpassword").val() &&
      passwordValid
    ) {
      $("#rconfirmpasswordHelp1").css("color", "#0f6d00");
      $("#rconfirmpasswordHelp1").text("Las contraseñas coinciden.");
      confirmPasswordValid = true;
    } else {

      $("#rconfirmpasswordHelp1").text("Las contraseñas no coinciden.");
      $("#rconfirmpasswordHelp1").css("color", "#b31717");
      confirmPasswordValid = false;
    }

    checkSubmit();
  });

  $("#firstName").on("input", () => {
    if ($("#firstName").val() == "") {
      $("#firstNameHelp").css("color", "rgba(173, 181, 189, 0.75)");
      firstNameValid = false;
    } else if (/^[a-zA-Z ]*$/.test($("#firstName").val())) {
      $("#firstNameHelp").css("color", "#0f6d00");
      firstNameValid = true;
    } else {
      $("#firstNameHelp").css("color", "#b31717");
      firstNameValid = false;
    }
  });

  $("#lastName").on("input", () => {
    if ($("#lastName").val() == "") {
      $("#lastNameHelp").css("color", "rgba(173, 181, 189, 0.75)");
      lastNameValid = false;
    } else if (/^[a-zA-Z ]*$/.test($("#lastName").val())) {
      $("#lastNameHelp").css("color", "#0f6d00");
      lastNameValid = true;
    } else {
      $("#lastNameHelp").css("color", "#b31717");
      lastNameValid = false;
    }
  });

  $("#dni").on("input", () => {
    if ($("#dni").val() == "") {
      $("#dniHelp1").css("color", "rgba(173, 181, 189, 0.75)");
      dniValid = false;
    } else if (
      !/[\WA-Za-z]+/.test($("#dni").val()) &&
      /[0-9]{7,11}/.test($("#dni").val())
    ) {
      $("#dniHelp1").css("color", "#0f6d00");
      dniValid = true;
    } else {
      $("#dniHelp1").css("color", "#b31717");
      dniValid = false;
    }

    checkSubmit();
  });
});
