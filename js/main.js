var muSite = document.getElementById('mu-footer');

muSite.addEventListener('click', function() {
    window.open("http://my.mu.edu.ph");
});

var btnMname = document.getElementById('btn-mname');

btnMname.addEventListener('click', function() {
    var mname = prompt("Edit your middle name: ");

    if(mname == null){
        return;
    } else {
        window.location = "php/member-edit-mname.php?mname=" + mname;
    }
});

var oldPass = document.getElementsByName('old-pass');
var newPass = document.getElementsByName('new-pass');
var retype = document.getElementsByName('new-pass-retype');
var email = document.getElementsByName('email');
var btnReset = document.getElementById('change-reset');

btnReset.addEventListener('click', function() {
    oldPass[0].value = "";
    newPass[0].value = "";
    retype[0].value = "";
});

var btnSubmit = document.getElementById('change-submit');

btnSubmit.addEventListener('click', function() {
    if(newPass[0].value == retype[0].value) {
        window.location = "php/member-change-pass.php?old-pass="+oldPass[0].value+"&new-pass="+newPass[0].value+"&new-pass-retype="+retype[0].value+"&email="+email[0].value;
    } else {
        alert("Your new password doesn't match the retyped password.");
    }
});




