var curPage = 1;
var totalPage = 0;
var content;
var rowHTML;

$(document).ready(function () {
    content = $('.article');
    rowHTML = content.html();
    totalPage = $("page").text();
    $("page").remove();
    for (let i = 1; i <= totalPage; i++){
        var node=$("<a></a>").text(i);
        node.attr("id","page-"+i);
        node.addClass("page");
        $(".next").before(node);
    }
    $(".page").click(function (){
        page=$(this).attr('id').slice(5);
        loadPage(page);
    });
});

function loadPage(page) {
    if (page > totalPage || page < 1)
        return;
    content.empty();
    $.ajax({
        url: 'index.php',
        type: 'POST',
        data: {
            page: page
        },
        success: function (data) {
            curPage = page;
            data = JSON.parse(data);
            var newrow;
            data.forEach(item => {
                content.append(rowHTML);
                newrow = content.children().last();
                newrow.children().first().html(item.title);
                newrow.children().last().html(item.text);
            });
        }
    });
};

$(document).ready(function () {
    loadPage(curPage);
});