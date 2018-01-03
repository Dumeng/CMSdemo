var curPage = 1;
var articleHTML;
var userHTML;
var noteid = 0;

$(document).ready(function () {
    articleHTML = $(".article-list").html();
    userHTML = $("tbody").html();
    var nav = $('.tab-nav li');
    nav.first().addClass('on');
    var content = $('.tab-content div');
    content.hide();
    content.first().show();

    nav.click(function () {
        nav.removeClass('on');
        $(this).addClass('on');
        content.hide();
        $("#" + $(this).attr('id').replace(/nav/, 'tab')).show();
    });

    $("#nav-article").click(function () {
        loadPage(curPage);
    });
    $("#nav-user").click(refreshUser);

    $(".text-new").click(function () {
        noteid = 0;
        $(".editor-bg").show();
    });
});

function refreshUser() {
    table = $("tbody");
    table.empty();
    $.ajax({
        url: 'user.php',
        type: 'POST',
        data: {
            method: "user",
        },
        success: function (data) {
            data = JSON.parse(data);
            if (data.error == "success") {
                var newrow;
                data.data.forEach(item => {
                    table.append(userHTML);
                    newrow = table.children().last();
                    newrow.children().eq(0).text(item.uid);
                    newrow.children().eq(1).text(item.username);
                    newrow.children().eq(2).text(item.email);
                    newrow.children().eq(3).text(item.role);
                });

                $(".pwd-modify").click(function () {
                    if (newpwd = prompt("Input New Password")) {
                        var user = $(this).parent().siblings().eq(1).text();
                        $.ajax({
                            url: 'user.php',
                            type: 'POST',
                            data: {
                                method: "password",
                                user: user,
                                password: newpwd
                            },
                            success: function (data) {
                                data = JSON.parse(data);
                                if (data.error == "success")
                                    alert("Successfully Modify.");
                                else
                                    alert("Error: " + data.error);
                            }
                        });
                    }

                });

                $(".usr-delete").click(function () {
                    var uid = $(this).parent().siblings().first().text();
                    $.ajax({
                        url: 'user.php',
                        type: 'POST',
                        data: {
                            method: "delete",
                            uid: uid
                        },
                        success: function (data) {
                            data = JSON.parse(data);
                            if (data.error == "success")
                                alert("Successfully Delete.");
                            else
                                alert("Error: " + data.error);
                        }
                    });
                    console.log('delete user: ' + uid);
                });

            } else
                alert("Error: " + data.error);
        }
    });
}

function loadPage(page) {
    var list = $(".article-list");
    list.empty();
    $.ajax({
        url: 'user.php',
        type: 'POST',
        data: {
            method: "article",
            page: page
        },
        success: function (data) {
            data = JSON.parse(data);
            if (data.error == "success") {
                var newrow;
                data.data.forEach(item => {
                    list.append(articleHTML);
                    newrow = list.children().last();
                    newrow.children().eq(0).text(item.title);
                    newrow.children().eq(1).text(item.text);
                    newrow.attr("id", "article-" + item.id);
                });

                $(".text-remove").click(function () {
                    id = $(this).parent().attr('id').slice(8);
                    $.ajax({
                        url: 'user.php',
                        type: 'POST',
                        data: {
                            method: "remove",
                            id: id
                        },
                        success: function (data) {
                            data = JSON.parse(data);
                            if (data.error == "success") {
                                alert("Successfully Removed.");
                                loadPage(curPage);
                            } else
                                alert("Error: " + data.error);
                        }
                    });
                });

                $(".text-edit").click(function () {
                    $(".editor-bg").show();
                    noteid = $(this).parent().attr('id').slice(8);
                    $(".editor-title").val($(this).siblings().eq(0).text());
                    $(".editor-text").val($(this).siblings().eq(1).text());
                });
            } else
                alert("Error: " + data.error);
        }
    })
}

function checkpwd() {
    var pwd1 = $("#pwd1").val();
    var pwd2 = $("#pwd2").val();
    if (pwd1 != pwd2) {
        document.getElementById("pwd1").setCustomValidity("Two passwords are different.");
        return false;
    } else {
        document.getElementById("pwd1").setCustomValidity("");
        return true;
    }
}

function changePwd() {
    if (!checkpwd())
        return false;
    $.ajax({
        url: 'user.php',
        type: 'POST',
        data: {
            method: "password",
            password: $("#pwd1").val()
        },
        success: function (data) {
            data = JSON.parse(data);
            if (data.error == "success")
                alert("Successfully Modify Your Password.");
            else
                alert("Error:" + data.error);
        }
    });
    return false;
}

function addUser() {
    $.ajax({
        url: 'signup.php',
        type: 'POST',
        data: {
            method: "add",
            username: $("#username").val(),
            email: $("#email").val(),
            password: $("#password").val(),
            role: $("#role").val()
        },
        success: function (data) {
            if (data == "success")
                alert("Successfully Added.");
            else
                alert("Error:" + data);
        }
    });
    refreshUser();
    return false;
}

function save() {
    $.ajax({
        url: 'user.php',
        type: 'POST',
        data: {
            method: "save",
            id: noteid,
            title: $(".editor-title").val(),
            text: $(".editor-text").val()
        },
        success: function (data) {
            data = JSON.parse(data);
            if (data.error == "success") {
                loadPage(curPage);
                alert("Successfully Saved.");
                closeEditor();
            } else
                alert("Error:" + data.error);
        }
    });
    return;
}

function closeEditor() {
    $('.editor-bg').hide();
    $('.editor-title').val('');
    $('.editor-text').val('');
    return;
}