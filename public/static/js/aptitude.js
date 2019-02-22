//资质相关js
$(document).ready(function () {
    $('.imgclass').click(function () {
        var thiselement = $(this);
        showImg("#outdiv", ".indiv", "#bigimg", thiselement);
    });

    jQuery.each(("blur focus focusin focusout load resize scroll unload click dblclick " +
        "mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave " +
        "change select submit keydown keypress keyup error contextmenu").split(" "), function (i, name) {

        // Handle event binding
        jQuery.fn[name] = function (data, fn) {
            return arguments.length > 0 ?
                this.on(name, null, data, fn) :
                this.trigger(name);
        };
    });
})

//审核资质
function verifyAptitude(id, status, user_id) {

    var name = document.getElementById('user_name').value;
    var mobile = document.getElementById('mobile').value;
    var intro = $("#intro").html();
    var gname = document.getElementById('gname').value;
    var email = document.getElementById('email').value;
    $.ajax({
        type: "POST",
        url: "/admin/Aptitude/verify",
        dataType: "json", //表示返回值类型，不必须
        data: {
            'id': id,
            'status': status,
            'user_id': user_id,
            'gname': gname,
            'email': email,
            'intro': intro,
            'name': name,
            'mobile': mobile
        },
        success: function (re) {
            layer.alert(re.msg);
        }
    })
}

//提交审核信息
function edit(id) {
    $.ajax({
        type: "POST",
        url: "/admin/Aptitude/look",
        dataType: "json", //表示返回值类型，不必须
        data: {
            'id': id,
        },
        success: function (re) {
            layer.alert(re.msg);
        }

    });
}

function showImg(outdiv, indiv, bigimg, thiselement) {
    var winW = $(window).width();
    var winH = $(window).height();

    var src = $(thiselement).attr('src');
    $(bigimg).attr("src", src);

    $("<img/>").attr("src", src).load(function () {
        var imgW = this.width;
        var imgH = this.height;
        console.log(imgW)
        console.log(imgH)
        var scale = imgW / imgH;
        if (imgW > winW) {
            $(bigimg).css("width", "auto").css("height", "100%");
            imgH = winW / scale;
            var h = (winH - imgH) / 10;
            $(indiv).css({"left": 0, "top": h});
        } else {
            $(bigimg).css("width", imgW / 3 + 'px').css("height", imgH / 3 + 'px');
            // var w = (winW - imgW) / 5;
            // var h = (winH - imgH) / 5;
            $(indiv).css({"left": 350, "top": 20});
        }

        $(outdiv).fadeIn("fast");
        $(outdiv).click(function () {
            $(this).fadeOut("fast");
        });
    });
}
