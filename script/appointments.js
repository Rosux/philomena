function makeAppointment() {
    $(".overlay").empty();
    $('.overlay').load("overlaySections/newAppointmentMenu.php" + " .new-appointment-wrapper", function(responseText, statusText, returnError) {
        if (statusText != "success") {
            $(".overlay").empty();
            $(".overlay").fadeOut(500).css("display", "none");
            return;
        }
    }).fadeIn(500).css("display", "flex");
}