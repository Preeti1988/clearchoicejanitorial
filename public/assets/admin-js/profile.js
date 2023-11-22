// -----------upload logo image----------------
const realFileBtn = document.getElementById("real-file");
const customBtn = document.getElementById("custom-button");
const customTxt = document.getElementById("custom-text");

customBtn.addEventListener("click", function() {
  realFileBtn.click();
});

realFileBtn.addEventListener("change", function() {
  if (realFileBtn.value) {
    customTxt.innerHTML = realFileBtn.value.match(
      /[\/\\]([\w\d\s\.\-\(\)]+)$/
    )[1];
  } else {
    customTxt.innerHTML = "No file chosen, yet.";
  }
});


// -----------show hide password----------------
$(document).ready(function() {
    $(".showPass").click(function() {
        var targetId = $(this).data("target");
        var passwordInput = $("#" + targetId);
        
        if (passwordInput.attr("type") == "password") {
            passwordInput.attr("type", "text");
        } else {
            passwordInput.attr("type", "password");
        }

        $(this).find("i").toggle();
    });
});