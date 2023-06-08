$(document).ready(function () {
  var checks = {
    length: false,
    small: false,
    capital: false,
    number: false,
  };

  function checkPassword(password) {
    if (password.length >= 8) checks.length = true;
    else checks.length = false;

    if (!/[0-9]/.test(password)) {
      checks.number = false;
    } else checks.number = true;

    if (!/[A-Z]/.test(password)) {
      checks.capital = false;
    } else checks.capital = true;

    if (!/[a-z]/.test(password)) {
      checks.small = false;
    } else checks.small = true;
  }
  // Function to compare passwords
  function comparePasswords() {
    var password = $("#passwordInput").val().trim();
    var passwordAgain = $("#passwordAgainInput").val().trim();

    checkPassword(password);
    Object.entries(checks).map(([key, val]) => {
      if (val) $("#" + key).hide();
      else $("#" + key).show();
    });

    if (!password) return false;

    if (password !== passwordAgain) {
      $("#passwordError").show();
      $("#passwordInput, #passwordAgainInput").addClass("is-invalid");
      return false;
    } else {
      $("#passwordError").hide();
      $("#passwordInput, #passwordAgainInput").removeClass("is-invalid");
      return true;
    }
  }
  function checkfuncs() {
    var name = $("#inputName").val();
    var last_name = $("#inputSurname").val();
    var email = $("#inputEmail").val();

    if (comparePasswords() && name !== "" && last_name !== "" && email !== "") {
      $("#regbtn").attr("disabled", false);
    } else $("#regbtn").attr("disabled", true);
  }
  // Trigger the comparison when either password field changes

  $(
    "#inputName, #inputSurname, #inputEmail, #passwordInput, #passwordAgainInput"
  ).on("keyup", "", checkfuncs);
});
