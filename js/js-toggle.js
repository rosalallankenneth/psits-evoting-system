$(document).ready(function() {
    $(".fa-bars").click(function() {
        $(".sidebar").addClass("slide");
    });
    $(".sidebarxbtn").click(function() {
        $(".sidebar").removeClass("slide");
    });
    $(window).resize(function() {
        if($(window).width() < 590) {
            $("#psits").html("PSITS");
        } else {
            $("#psits").html("PHILIPPINE SOCIETY OF INFORMATION TECHNOLOGY STUDENTS");
        }
    });
    if($(window).width() < 590) {
        $("#psits").html("PSITS");
    } else {
        $("#psits").html("PHILIPPINE SOCIETY OF INFORMATION TECHNOLOGY STUDENTS");
    }
});