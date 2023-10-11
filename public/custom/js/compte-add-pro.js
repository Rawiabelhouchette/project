$(document).ready(function() {
    // Verifcation de la confirmation de mot de passe
    var password = $("#mot_de_passe");
    var confirm_password = $("#confirmer_mot_de_passe");
    var error_message = $("#error_message");

    function validatePassword() {
        if (password.val() != confirm_password.val()) {
            confirm_password[0].setCustomValidity("Mot de passe non identique");
            error_message.html("Mot de passe non identique");
        } else {
            confirm_password[0].setCustomValidity("");
            error_message.html("");
        }
    }

    password.on("change", validatePassword);
    confirm_password.on("keyup", validatePassword);
});