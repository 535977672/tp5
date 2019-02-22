function do_login() {
    var username = document.getElementById('username').value
    var password = document.getElementById('password').value
    var rancode = document.getElementById('randcode').value
    if (username.length < 1) {
        alert('手机号码不能为空');
        document.getElementById('username').focus();
        return false;
    }
    if (password.length < 1) {
        alert('密码不能为空');
        document.getElementById('password').focus();
        return false;
    }
    if (rancode.length < 1) {
        alert('');
        document.getElementById('randcode').focus();
        return false;
    }

    $.ajax({
        type: "POST",
        url: "/open/users/login",
        dataType: "json", //表示返回值类型，不必须
        data: {'username': username, 'password': password, 'randcode': rancode},
        success: function (re) {
            if (re.status == 1) {
                $("#login-error").html(re.msg)
            } else {
                $("#login").submit()
            }
        }

    });
}


function do_register() {
    var phone = document.getElementById('regphone').value;
    var reg_password = document.getElementById('reg_password').value;
    var reg_randcode = document.getElementById('reg_randcode').value;
    var phone_randcode = document.getElementById('phone_randcode').value;

    if (phone.length <= 1) {
        alert('手机号不能为空');
        document.getElementById('phone').focus();
        return false;
    }
    if (reg_password.length < 1) {
        alert('密码不能为空');
        document.getElementById('reg_password').focus();
        return false;
    }
    if (reg_randcode.length < 1) {
        alert('验证码不能为空');
        document.getElementById('reg_randcode').focus();
        return false;
    }

    if (phone_randcode.length < 1) {
        alert('手机验证码不能为空');
        document.getElementById('phone_randcode').focus();
        return false;
    }
    $.ajax({
        type: "POST",
        url: "/open/users/register",
        dataType: "json", //表示返回值类型，不必须
        data: {
            'phone': phone,
            'reg_password': reg_password,
            'reg_randcode': reg_randcode,
            'phone_randcode': phone_randcode
        },
        success: function (re) {
            if (re.status == 1) {
                $("#register-error").html(re.msg)
            } else {
                $("#register").submit()
            }
        }

    });


}


/**
 * 手机验证码登录
 * @returns {boolean}
 */
function do_code_login() {
    var phone = document.getElementById('phone').value;
    var randcode = document.getElementById('phone_randcode_l').value;

    if (phone.length <= 1) {
        alert('手机号不能为空');
        document.getElementById('phone').focus();
        return false;
    }
    if (randcode.length < 1) {
        alert('验证码不能为空');
        document.getElementById('randcode').focus();
        return false;
    }

    $.ajax({
        type: "POST",
        url: "/open/users/codeLogin",
        dataType: "json", //表示返回值类型，不必须
        data: {
            'mobile': phone,
            'randcode': randcode,
        },
        success: function (re) {
            if (re.status == 1) {
                $("#error").html(re.msg)
            } else {
                $("#mes-login").submit()
            }
        }

    });


}