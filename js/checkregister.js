$(() => {
  let usernameValid = false;
  let passwordValid = false;
  let fisrtNameValid = false;
  let dniValid = false;

  let checkSubmit = () => {
    if (usernameValid && dniValid) {
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

  $("#dni").on("input", () => {

    if ($("#dni").val() == "") {
      $("#dniHelp1").css("color", "rgba(173, 181, 189, 0.75)");
      dniValid = false;
    } else if (!/[\WA-Za-z]+/.test($("#dni").val()) && /[0-9]{7,11}/.test($('#dni').val())) {
      $("#dniHelp1").css("color", "#0f6d00");
      dniValid = true;
    } else {
      $("#dniHelp1").css("color", "#b31717");
      dniValid = false;
    }

    checkSubmit();

  });
});
