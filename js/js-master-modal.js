$(document).ready(function() {
    $('#master-useracc').click(function() {
        $('#cover').css('display','block');
        $('#modal').css('display','block');
    });
    $('#btn-exit').click(function() {
        $('#modal').css('display','none');
        $('#cover').css('display','none');
        
        var fields = document.getElementsByClassName('modal-input');

        fields[1].value = "";
        fields[2].value = "";
        fields[3].value = "";

        var loc = decodeURIComponent(window.location.search.substring(1));

        if(loc == "change_username_pass=success") {
            window.location = "dashboard.php";
        }
    });
});