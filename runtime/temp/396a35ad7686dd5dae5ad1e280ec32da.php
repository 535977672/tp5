<?php /*a:1:{s:55:"D:\mf\pcnfctest\application\admin\view\admin\login.html";i:1542274665;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>管理中心登录</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link href="/static/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="/static/bootstrap/css/adminlte.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="/static/icheck/skins/flat/_all.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo htmlentities((isset($shop_config['shop_info_store_ico']) && ($shop_config['shop_info_store_ico'] !== '')?$shop_config['shop_info_store_ico']:'/static/image/storeico_default.png')); ?>" media="screen"/>
    <style>#imgVerify{width: 120px;height:35px;margin: 0 auto; text-align: center;display: block;}	</style>
    <script>
        function detectBrowser()
        {
            var browser = navigator.appName;
            if(navigator.userAgent.indexOf("MSIE")>0){
                var b_version = navigator.appVersion
                var version = b_version.split(";");
                var trim_Version = version[1].replace(/[ ]/g,"");
                if ((browser=="Netscape"||browser=="Microsoft Internet Explorer"))
                {
                    if(trim_Version == 'MSIE8.0' || trim_Version == 'MSIE7.0' || trim_Version == 'MSIE6.0'){
                        alert('请使用IE9.0版本以上进行访问');
                        return;
                    }
                }
            }
        }
        detectBrowser();
    </script>
    <meta name="__hash__" content="35a35d71936253d091570f5dcdf3efda_339f4b21819f95c9aa09ae2c46f4101b" /></head>
<body class="login-page">
<div class="login-box">
    <div class="login-logo">
        <img src="<?php echo htmlentities((isset($shop_config['shop_info_admin_login_logo']) && ($shop_config['shop_info_admin_login_logo'] !== '')?$shop_config['shop_info_admin_login_logo']:'/static/image/admin_login_logo_default.png')); ?>">
    </div>
    <div class="login-box-body">
        <h4 class="login-box-msg">管理中心</h4>
        <div class="form-group has-feedback">
            <input type="text" name="username" id="username" value="<?php if($admin): ?><?php echo htmlentities($admin['username']); endif; ?>" class="form-control" placeholder="账号" />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" id="password" value="<?php if($admin): ?><?php echo htmlentities($admin['password']); endif; ?>" placeholder="密码" />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <opinioncontrol realtime="true" opinion_name="vertify_code" default="true">
                <div class="row" style="padding-right: 65px;">
                    <div class="col-xs-8">
                        <input style="width: 135px" type="text" name="verify" class="form-control" placeholder="验证码"/>
                    </div>
                    <div class="col-xs-4">
                        <img id="imgVerify" style="cursor:pointer;" src="<?php echo url('admin/Admin/verify'); ?>" onclick="fleshVerify();"/>
                    </div>
                </div>
            </opinioncontrol>
        </div>
        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox icheck">
                    <label><input type="checkbox" <?php if(app('cookie')->get('rember')): ?>checked="checked"<?php endif; ?> id="rember" name="rember"> 记住密码  </label>
                </div>
            </div>
            <div class="col-xs-4">
                <div class="checkbox icheck">
                    <label><a href="#">找回密码</a></label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-primary btn-block btn-flat" onclick="checkLogin()">立即登陆 </button>
        </div>
    </div>

</div><!-- /.login-box -->
<!-- jQuery 3.3.1 -->
<script src="/static/bootstrap/js/jquery-3.3.1.min.js" type="text/javascript"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="/static/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- iCheck -->
<script src="/static/icheck/icheck.js" type="text/javascript"></script>
<script src="/static/layer/layer.js"></script>
<script>

    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_flat-aero',
            radioClass: 'iradio_flat-aero',
            increaseArea: '20%' // optional
        });
    });


    function fleshVerify(){
        //重载验证码
        $('#imgVerify').attr('src',"<?php echo url('admin/Admin/verify'); ?>?time="+Math.random());
    }


    jQuery.fn.center = function () {
        this.css("position", "absolute");
        this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) +
            $(window).scrollTop()) - 30 + "px");
        this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) +
            $(window).scrollLeft()) + "px");
        return this;
    };

    layer.config({
        title: '登录提示',
        skin: 'layui-layer-lan',
        anim: 6,
        move:false
    });

    function checkLogin(){
        var username = $('#username').val();
        var password = $('#password').val();
        var verify = $('input[name="verify"]').val();
        var rember = $('input[name="rember"]:checked').val();
        if( username == '' || password ==''){
            layer.msg('用户名或密码不能为空', {icon: 2,time: 1000}); //alert('用户名或密码不能为空');
            return false;
        }
        if(verify ==''){
            layer.msg('验证码不能为空', {icon: 2,time: 1000});
            return false;
        }
        if(verify.length !=4){
            layer.msg('验证码错误', {icon: 2,time: 1000});
            fleshVerify();
            $('input[name="verify"]').val('');
            return false;
        }

        $.ajax({
            url:"<?php echo url('admin/Admin/login'); ?>?t="+Math.random(),
            type:'post',
            dataType:'json',
            data:{username:username,password:password,verify:verify,rember:rember},
            success:function(res){
                if(res.status == 1){
                    top.location.href = "<?php echo url('admin/Index/index'); ?>";
                }else{
                    layer.msg(res.msg, {icon: 2,time: 1000});
                    fleshVerify();
                    $('input[name="verify"]').val('');
                }
            },
            error : function(XMLHttpRequest, textStatus, errorThrown) {
                layer.msg('网络失败，请刷新页面后重试', {icon: 2,time: 1000});
            }
        })
    }

    $(document).keyup(function (event) {
        if (event.keyCode == 13){
            checkLogin();
        }
    })

</script>
</body>
</html>