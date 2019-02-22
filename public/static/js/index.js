//用户名下拉
$(document).ready(function () {
    $(".header-dropdown").click(function () {
        $(".dropdownList").fadeIn(250);
    })
    $(document).click(function () {
        $(".dropdownList").fadeOut(250);
    })
    $(".header-dropdown").click(function (event) {
        event.stopPropagation();
    });

});

/**
 * 用户退出
 */

function loginOut() {
    $.ajax({
        type: "POST",
        url: "/open/member/loginOut",
//            contentType: "/son", //如果提交的是json数据类型，则必须有此参数,表示提交的数据类型
        dataType: "json", //表示返回值类型，不必须

        success: function (res) {

        },
        error: function (data) {
            console.log("系统错误")
        }
    });

}


//登录注册切换
$(document).ready(function () {
    $(".login .login_title h1 span").click(function () {
        $(this).addClass("addcolor");
        $(this).siblings().removeClass("addcolor")
    });
    $(".login_title_f").click(function () {
        $("#login").show();
        $("#register").hide();
        $("#mes-login").hide();
        $(".pswd-login").hide();
    });
    $(".login_title_s").click(function () {
        $("#register").show();
        $("#login").hide();
        $("#mes-login").hide();
    });
    $(".mes-login").click(function () {
        $("#login").hide();
        $("#mes-login").show();
        $(".pswd-login").show();
        $(".mes-login").hide();
    });
    $(".pswd-login").click(function () {
        $("#login").show();
        $("#mes-login").hide();
        $(".pswd-login").hide();
        $(".mes-login").show();
    });
    $(".lostpassword").click(function () {
        $("#lostpassword").show();
        $(".login_bg").hide();
    })


//     //验证input信息
//     $("#username,#password").keyup(function (e) {
//         var typ = e.target.id;
//         var username = document.getElementById('username').value
//         var password = document.getElementById('password').value
//         var randcode = document.getElementById('randcode').value
//         $.ajax({
//             type: "POST",
//             url: "/open/member/login",
// //            contentType: "/son", //如果提交的是json数据类型，则必须有此参数,表示提交的数据类型
//             dataType: "json", //表示返回值类型，不必须
//             data: {'username': username, 'password': password, 'randcode': randcode, 'action': 'login'},
//             success: function (res) {
//                 $("#" + typ).siblings("." + typ).html(res.msg)
//             },
//             error: function (data) {
//                 console.log("error")
//             }
//         });
//     })

// //验证input信息
//     $("#randcode").keyup(function (e) {
//         var typ = e.target.id;
//         var randcode = document.getElementById('randcode').value
//         $.ajax({
//             type: "POST",
//             url: "/open/member/login",
// //            contentType: "/son", //如果提交的是json数据类型，则必须有此参数,表示提交的数据类型
//             dataType: "json", //表示返回值类型，不必须
//             data: {'randcode': randcode, 'action': 'randcode'},
//             success: function (res) {
//                 $("#" + typ).siblings("font").html(res.msg)
//                 console.log(res)
//             },
//             error: function (data) {
//                 console.log("error")
//             }
//         });
//     })


// //验证注册input信息
//     $("#regphone,#reg_randcode,#phone_randcode").keyup(function (e) {
//         var typ = e.target.id;
//         var phone = ''
//         var reg_randcode = ''
//         var phone_randcode = ''
//         if (typ == 'regphone') {
//             phone = document.getElementById('regphone').value
//         } else if (typ == 'reg_randcode') {
//             reg_randcode = document.getElementById('reg_randcode').value
//         } else if (typ == 'phone_randcode') {
//             phone_randcode = document.getElementById('phone_randcode').value
//         }
//
//         $.ajax({
//             type: "POST",
//             url: "/open/member/register",
// //            contentType: "/son", //如果提交的是json数据类型，则必须有此参数,表示提交的数据类型
//             dataType: "json", //表示返回值类型，不必须
//             data: {
//                 'phone': phone,
//                 'reg_randcode': reg_randcode,
//                 'phone_randcode': phone_randcode,
//             },
//             success: function (res) {
//                 $("#" + typ).siblings("." + typ).html(res.msg)
//             },
//         });
//     })

    if (typeof(FileReader) === 'undefined') {
        alert('抱歉，你的浏览器不支持 FileReader，请使用现代浏览器操作！');
        $("#inputfile,#id-up,#info-up,#ins-up,#lic-up,#aut-up").setAttribute('disabled', 'disabled');
    } else {
        $("#inputfile,#id-up,#info-up,#ins-up,#lic-up,#aut-up").change(function () {
            var that = $(this);
            var file = this.files[0];
            var maxSize = 2;
            if (!/image\/\w+/.test(file.type)) {
                alert("请选择图片文件");
                return false;
            }

            var reader = new FileReader();
            reader.readAsDataURL(file);
            if (file.size / 1024 / 1024 > maxSize) {
                reader.onload = function () {
                    var image = new Image();
                    image.src = this.result;
                    image.onload = function () {
                        var width = image.width; //原图宽
                        dealImage(image.src, {width: width / 2, quality: 0.9}, function (base) {
                            that.siblings('.result').html(base);
                        });
                    };
                }
            } else {
                reader.onload = function () {
                    that.siblings('.result').html(this.result);
                }
            }
        });
    }
})

/**
 * 图片压缩，默认同比例压缩
 * @param {Object} path
 * pc端传入的路径可以为相对路径，但是在移动端上必须传入的路径是照相图片储存的绝对路径
 * @param {Object} obj
 * obj 对象 有 width， height， quality(0-1)
 * @param {Object} callback
 * 回调函数有一个参数，base64的字符串数据
 */
function dealImage(path, obj, callback) {
    var img = new Image();
    img.src = path;
    img.onload = function () {
        var that = this;
        // 默认按比例压缩
        var w = that.width,
            h = that.height,
            scale = w / h;
        w = obj.width || w;
        h = obj.height || (w / scale);
        var quality = 0.8; // 默认图片质量为0.8
        //生成canvas
        var canvas = document.createElement('canvas');
        var ctx = canvas.getContext('2d');
        // 创建属性节点
        var anw = document.createAttribute("width");
        anw.nodeValue = w;
        var anh = document.createAttribute("height");
        anh.nodeValue = h;
        canvas.setAttributeNode(anw);
        canvas.setAttributeNode(anh);
        ctx.drawImage(that, 0, 0, w, h);
        // 图像质量
        if (obj.quality && obj.quality <= 1 && obj.quality > 0) {
            quality = obj.quality;
        }
        // quality值越小，所绘制出的图像越模糊
        var base64 = canvas.toDataURL('image/jpeg', quality);
        // 回调函数返回base64的值
        callback(base64);
    }
}

//发送验证码
//计时器
var wait = 5; //停留时间
var clicks = 0;

function updateinfo() {
    if (wait == 0) {
        $('#verifyYz1').html("发送验证码");
        $('#verifyYz1').removeAttr("disabled");
        wait = 5 //还原重发时的初始值
        clicks = 0;
    }
    else {
        $('#verifyYz1').attr("disabled", true); //防止关闭层后，又激活了
        $('#verifyYz1').html("等待 " + wait + " 秒");
        wait--;
        setTimeout("updateinfo()", 1000);
    }
}

//注册发送手机验证码
function timeshow($type) {

    var mobile = $('#phone').val();//获取手机号码

    if (clicks == 0) {
        updateinfo();//调用计时器
        clicks = 1;
        $.ajax({
            type: "POST",
            url: "/common/sms/send",
            dataType: "json", //表示返回值类型，不必须
            data: {'phone': mobile, 'type': $type},
            success: function (res) {
                alert(res.msg);
            }
        });
    }
    $('#verifyYz1').attr("disabled", true); //防止关闭层后，又激活了
}


//用户类型选择
function choicethis(val) {
    $(".ant-steps-item-process .ant-steps-item-icon").css("background", "#fff");
    $(".ant-steps-item-process .ant-steps-icon").css("color", "rgba(0,0,0,0)").addClass("anticon-check");
    $(".ant-steps-item-wait .ant-steps-item-icon").css({"background": "#55bb4e", "borderColor": "#55bb4e"});
    $(".ant-steps-item-wait .ant-steps-icon").css({"color": "#fff"});
    $(".settle-index-wrap").hide();
    $(".settle-detail").show();
    if (val == 0) {
        $('#user-type').val(1)
        $(".info-title").html("个人-信息");
        $(".ins-name,.ins-address,.ins-web,.ins-number,.lic-pic,.aup-pic,.ins-lev").hide();
    }
    else if (val == 1) {
        $('#user-type').val(2)
        $(".info-title").html("机构-信息");
        $(".hand-pic,.media-info,.info-up,.ins-lev,.lic-pic").hide();
    }
    else if (val == 2) {
        $('#user-type').val(3)
        $(".info-title").html("企业-信息");
        $(".ins-nam").html("企业名称：");
        $(".ins-ads").html("企业地址：");
        $(".info-up-help span").html("请提供“官方网站”索填写链接对应的后台管理界面截图，限2M");
        $(".hand-pic,.media-info,.ins-lev,.ins-number").hide();
    }
    else if (val == 3) {
        $('#user-type').val(4)
        $(".info-title").html("政府-信息");
        $(".hand-pic,.media-info,.info-up,.lic-pic").hide();
    }
    else if (val == 4) {
        $('#user-type').val(5)
        $(".info-title").html("组织-信息");
        $(".hand-pic,.media-info,.ins-lev,.lic-pic").hide();
    }
}

/*头像上传*/
function changepic(obj) {
    //console.log(obj.files[0]);//这里可以获取上传文件的name
    var newsrc = getObjectURL(obj.files[0]);
    $('#show').show().animate({"width": "100px"});
    document.getElementById('show').src = newsrc;
}

//建立一個可存取到該file的url
function getObjectURL(file) {
    var url = null;
    // 下面函数执行的效果是一样的，只是需要针对不同的浏览器执行不同的 js 函数而已
    if (window.createObjectURL != undefined) { // basic
        url = window.createObjectURL(file);
    } else if (window.URL != undefined) { // mozilla(firefox)
        url = window.URL.createObjectURL(file);
    } else if (window.webkitURL != undefined) { // webkit or chrome
        url = window.webkitURL.createObjectURL(file);
    }
    return url;
}

/*证件照上传*/
function uppic(obj) {
    //console.log(obj.files[0]);//这里可以获取上传文件的name
    var newsrc = getObjectURL(obj.files[0]);
    $('#id-show').show().animate({"width": "100px"});
    document.getElementById('id-show').src = newsrc;
}

//建立一個可存取到該file的url
function getObjectURL(file) {
    var url = null;
    // 下面函数执行的效果是一样的，只是需要针对不同的浏览器执行不同的 js 函数而已
    if (window.createObjectURL != undefined) { // basic
        url = window.createObjectURL(file);
    } else if (window.URL != undefined) { // mozilla(firefox)
        url = window.URL.createObjectURL(file);
    } else if (window.webkitURL != undefined) { // webkit or chrome
        url = window.webkitURL.createObjectURL(file);
    }
    return url;
}

/*用户信息验证*/

/*昵称验证*/
function namecheck(_this) {
    var firstName = $("#firstname").val()
    var reg = /^[a-zA-Z0-9\u4e00-\u9fa5]{2,30}$/;
    if (!reg.test(firstName)) {
        _this.siblings('.content-error').html('请输入昵称，2-30个字,限中文、英文、数字!');
        $('#firstname').addClass('error-control');
    } else {
        _this.siblings('.content-error').html('')
        $('#firstname').removeClass('error-control');
    }
}

/*简介验证*/
function diccheck(_this) {
    var dic = $("#dic").val()
    var reg = /^.{10,100}$/;
    if (!reg.test(dic)) {
        _this.siblings('.content-error').html('请输入简介，10-100个字!');
        $('#dic').addClass('error-control');
    } else {
        _this.siblings('.content-error').html('')
        $('#dic').removeClass('error-control');
    }
}

/*联系人验证*/
function contcheck(_this) {
    var cont = $("#contact-name").val()
    var reg = /^[\u4e00-\u9fa5]{2,5}$/;
    if (!reg.test(cont)) {
        _this.siblings('.content-error').html('请输入联系人名称，2-5个中文!');
        $('#contact-name').addClass('error-control');
    } else {
        _this.siblings('.content-error').html('')
        $('#contact-name').removeClass('error-control');
    }
}

/*身份证号验证*/
function idcheck(_this) {
    var id = $("#id-number").val()
    var reg = /^[1-9]\d{5}(18|19|([23]\d))\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}[0-9Xx]$/;
    if (!reg.test(id)) {
        _this.siblings('.content-error').html('17位数字+1位数字/字母!');
        $('#id-number').addClass('error-control');
    } else {
        _this.siblings('.content-error').html('')
        $('#id-number').removeClass('error-control');
    }
}

/*联系电话验证*/
function phonecheck(_this) {
    var phone = $("#phone-number").val()
    var reg = /^(13[0-9]|14[579]|15[0-3,5-9]|16[6]|17[0135678]|18[0-9]|19[89])\d{8}$/;
    if (!reg.test(phone)) {
        _this.siblings('.content-error').html('请输入正确的是手机号!');
        $('#phone-number').addClass('error-control');
    } else {
        _this.siblings('.content-error').html('')
        $('#phone-number').removeClass('error-control');
    }
}

/*邮箱验证*/
function emailcheck(_this) {
    var email = $("#e-mail").val()
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    if (!reg.test(email)) {
        _this.siblings('.content-error').html('请输入正确邮箱!');
        $('#e-mail').addClass('error-control');
    } else {
        _this.siblings('.content-error').html('')
        $('#e-mail').removeClass('error-control');
    }
}


/*提交验证*/
function addInfo() {
    var user = document.getElementById('firstname').value
    var intro = document.getElementById('dic').value
    var types = document.getElementById('user-type').value
    var field = document.getElementById('field').value
    var logo = document.getElementById('logo').value
    var name = document.getElementById('contact-name').value
    var idCard = document.getElementById('id-number').value
    var handPassPho = document.getElementById('handPassPho').value
    var phone = document.getElementById('phone-number').value
    var email = document.getElementById('e-mail').value
    var locationOper = document.getElementById('btntext').value
    var qq = document.getElementById('contact-more').value
    var gname = document.getElementById('ins-name').value
    var institutionAddress = document.getElementById('ins-address').value
    var businessLicense = document.getElementById('business_licence_scanning').value
    var webAddress = document.getElementById('ins-web').value
    var power_atto_scanning = document.getElementById('power_atto_scanning').value
    var materialCertificate = document.getElementById('materialCertificate').value
    var mediaMaterial = document.getElementById('media-info').value
    var org_code_certificate = document.getElementById('org_code_certificate').value
    var level = document.getElementById('level').value

    $.ajax({
        type: "POST",
        url: "/open/info/addProfessional",
//            contentType: "/son", //如果提交的是json数据类型，则必须有此参数,表示提交的数据类型
        dataType: "json", //表示返回值类型，不必须
        data: {
            'nickname': user,
            'type': types,
            'intro': intro,
            'field': field,
            'logo': logo,
            'name': name,
            'id_card': idCard,
            'hand_photo': handPassPho,
            'mobile': phone,
            'email':email,
            'operation_address': locationOper,
            'qq':qq,
            'gname': gname,
            'address': institutionAddress,
            'web' :webAddress,
            'media_material':mediaMaterial,
            'org_code_certificate': org_code_certificate,
            'power_atto_scanning': power_atto_scanning,
            'business_licence_scanning': businessLicense,
            'material_certificate':materialCertificate,
        },
        success: function (res) {
            if (res.status == 1) {
                $("#error").html(res.msg)
                return false;
            } else {
                $("#addInfo").submit()
            }

        },
    });


}

/*返回上一步*/
function backStep() {
    window.location.reload()
}

/*材料上传*/
function infopic(obj) {
    //console.log(obj.files[0]);//这里可以获取上传文件的name
    var newsrc = getObjectURL(obj.files[0]);
    $('#info-show').show().animate({"width": "100px"});
    document.getElementById('info-show').src = newsrc;
}

//建立一個可存取到該file的url
function getObjectURL(file) {
    var url = null;
    // 下面函数执行的效果是一样的，只是需要针对不同的浏览器执行不同的 js 函数而已
    if (window.createObjectURL != undefined) { // basic
        url = window.createObjectURL(file);
    } else if (window.URL != undefined) { // mozilla(firefox)
        url = window.URL.createObjectURL(file);
    } else if (window.webkitURL != undefined) { // webkit or chrome
        url = window.webkitURL.createObjectURL(file);
    }
    return url;
}

/*组织机构代码证上传*/
function inspic(obj) {
    //console.log(obj.files[0]);//这里可以获取上传文件的names
    var newsrc = getObjectURL(obj.files[0]);
    $('#ins-show').show().animate({"width": "100px"});
    document.getElementById('ins-show').src = newsrc;
}

//建立一個可存取到該file的url
function getObjectURL(file) {
    var url = null;
    // 下面函数执行的效果是一样的，只是需要针对不同的浏览器执行不同的 js 函数而已
    if (window.createObjectURL != undefined) { // basic
        url = window.createObjectURL(file);
    } else if (window.URL != undefined) { // mozilla(firefox)
        url = window.URL.createObjectURL(file);
    } else if (window.webkitURL != undefined) { // webkit or chrome
        url = window.webkitURL.createObjectURL(file);
    }
    return url;
}

/*授权证书扫描件*/
function autpic(obj) {
    //console.log(obj.files[0]);//这里可以获取上传文件的names
    var newsrc = getObjectURL(obj.files[0]);
    $('#aut-show').show().animate({"width": "100px"});
    document.getElementById('aut-show').src = newsrc;
}

//建立一個可存取到該file的url
function getObjectURL(file) {
    var url = null;
    // 下面函数执行的效果是一样的，只是需要针对不同的浏览器执行不同的 js 函数而已
    if (window.createObjectURL != undefined) { // basic
        url = window.createObjectURL(file);
    } else if (window.URL != undefined) { // mozilla(firefox)
        url = window.URL.createObjectURL(file);
    } else if (window.webkitURL != undefined) { // webkit or chrome
        url = window.webkitURL.createObjectURL(file);
    }
    return url;
}


/*营业执照扫描件*/
function licpic(obj) {
    //console.log(obj.files[0]);//这里可以获取上传文件的names
    var newsrc = getObjectURL(obj.files[0]);
    $('#lic-show').show().animate({"width": "100px"});
    document.getElementById('lic-show').src = newsrc;
}

//建立一個可存取到該file的url
function getObjectURL(file) {
    var url = null;
    // 下面函数执行的效果是一样的，只是需要针对不同的浏览器执行不同的 js 函数而已
    if (window.createObjectURL != undefined) { // basic
        url = window.createObjectURL(file);
    } else if (window.URL != undefined) { // mozilla(firefox)
        url = window.URL.createObjectURL(file);
    } else if (window.webkitURL != undefined) { // webkit or chrome
        url = window.webkitURL.createObjectURL(file);
    }
    return url;
}


/* 为IE6 IE7 IE8增加document.getElementsByClassName函数 */
/MSIE\s*(\d+)/i.test(navigator.userAgent);
var isIE = parseInt(RegExp.$1 ? RegExp.$1 : 0);
if (isIE > 0 && isIE < 9) {
    document.getElementsByClassName = function (cls) {
        var els = this.getElementsByTagName('*');
        var ell = els.length;
        var elements = [];
        for (var n = 0; n < ell; n++) {
            var oCls = els[n].className || '';
            if (oCls.indexOf(cls) < 0) continue;
            oCls = oCls.split(/\s+/);
            var oCll = oCls.length;
            for (var j = 0; j < oCll; j++) {
                if (cls == oCls[j]) {
                    elements.push(els[n]);
                    break;
                }
            }
        }
        return elements;
    }
}


function cutImageBase64(m_this, id, wid, quality, callback) {
    var file = m_this.files;
    var URL = window.URL || window.webkitURL;
    var blob = URL.createObjectURL(file);

    var base64 = '';
    var img = new Image();
    img.src = blob;
    img.onload = function () {
        var that = this;
        //生成比例
        var w = that.width,
            h = that.height,
            scale = w / h;
        w = wid || w;
        h = w / scale;
//生成canvas
        var canvas = document.createElement('canvas');
        var ctx = canvas.getContext('2d');
        $(canvas).attr({
            width: w,
            height: h
        });
        ctx.drawImage(that, 0, 0, w, h);
        // 生成base64
        base64 = canvas.toDataURL('image/jpeg', quality || 0.8);
        callback(base64);

    };


}


function uploadCard(_obj) {
    cutImageBase64(_obj, null, 400, 0.8, function (res) {

    });
}


