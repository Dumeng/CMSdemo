$(document).ready(function(){
    var tab = $('.tab-nav h1');
    tab.first().addClass('on');
    var content = $('.tab-content form');
    content.hide();
    content.first().show();

    tab.click(function () {
        tab.removeClass('on');
        $(this).addClass('on');
        content.hide();
        $("#" + $(this).attr('id').replace(/tab/, 'form')).show();
    });
});

function login() {
    var usr = $('.login-username').val();
    var pwd = $('.login-password').val();
    $.ajax({
        type: "post",
        url: "login.php",
        data: {
            username: usr,
            password: pwd
        },
        success: function (data) {
            if (data == 'success')
                window.location.href = "index.php";
            else
                alert(data);
        }
    });
    return false;
}

function checkpwd() {
    var pwd1 = $(".sign-password1").val();
    var pwd2 = $(".sign-password2").val();
    if (pwd1 != pwd2)
        document.getElementByClassName("sign-password1").setCustomValidity("Two passwords are different.");
    else
        document.getElementByClassName("sign-password1").setCustomValidity("");
}

function sign() {
    $.ajax({
        url: 'signup.php',
        type: 'POST',
        data: {
            username: $('.sign-username').val(),
            email: $('.sign-email').val(),
            password: $('.sign-password1').val()
        },
        success: function (data) {
            if (data == "success")
                alert("Successfully Signed.");
            else
                alert("Error:" + data);
        }
    });
    return false;
}