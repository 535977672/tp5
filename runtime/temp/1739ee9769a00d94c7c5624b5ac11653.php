<?php /*a:4:{s:50:"D:\mf\pcnfc\application\open\view\users\index.html";i:1542157672;s:45:"D:\mf\pcnfc\application\open\view\layout.html";i:1541756597;s:52:"D:\mf\pcnfc\application\open\view\public\header.html";i:1542781910;s:52:"D:\mf\pcnfc\application\open\view\public\footer.html";i:1542781618;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlentities($title); ?></title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <link href="/static/bootstrap/css/adminlte.min.css" rel="stylesheet" type="text/css"/>
    <link href="/static/bootstrap/css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
    <link href="/static/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="/static/css/page.css" rel="stylesheet" type="text/css"/>
    <link href="/static/layer/theme/default/layer.css" rel="stylesheet"  type="text/css"/>
    <link href="/static/css/select2.css" rel="stylesheet"/>
    <link href="/static/css/cropper.min.css" rel="stylesheet">
    <script src="/static/js/login.js" type=text/javascript></script>
    <script type="text/javascript" src="/static/js/jquery.js"></script>
    <script type="text/javascript" src="/static/js/manager.js"></script>
    <script src="/static/js/jquery-3.3.1.min.js"></script>
    <script src="/static/bootstrap/js/bootstrap.js" type="text/javascript"></script>
    <script src="/static/js/index.js" type="text/javascript"></script>
    <script src="/static/layer/layer.js" type="text/javascript"></script>
</head>
<body class="login">
<div id="header">
    <div class="w header">
        <div class="logo ld">
            <a hidefocus="true" title="" href=""><img height="100" src=""/></a>
            <b>吃出健康咨询开放平台</b>
            <?php if($user['mobile']): ?>
            <div class="header-dropdown">
                <img class="headPic" src="<?php echo htmlentities($user['head_pic']); ?>" alt="">
                <p class="userName"><?php echo htmlentities($user['mobile']); if($user['type']): ?>
                     <span>[<?php echo htmlentities($user['type']); ?>]</span></p>
                    <?php endif; ?>
                <i class=" glyphicon glyphicon-chevron-down"></i>
                <ul class="dropdownList">
                    <li><a class=" glyphicon glyphicon-off" href="<?php echo url('/open/users/loginOut'); ?>">退出</a></li>
                </ul>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="w login_bg">
    <div class="entry">
        <div class="mc">
            <div class="adv">
                <img src="<?php echo htmlentities($login_ads['ad_code']); ?>">
            </div>
            <div class="form">
                <div class="login_title">
                    <h1>
                        <span class="login_title_f addcolor">登录</span>
                        <span class="login_title_s">注册</span>
                        <div class="clearfix"></div>
                    </h1>
                </div>
                <form id="login" name="login" action="<?php echo url('open/manager/index'); ?>" method="post">
                    <div class="item fore1">
                        <div class="item-ifo">
                            <div class="i-name ico"></div>
                            <input autocomplete="off" class="text" name="username" maxlength="11" type="text"
                                   id="username"
                                   placeholder="手机号"
                                   tabindex="1"/>
                            <font color="red" class="username"></font>
                        </div>
                    </div>
                    <div class="item fore2">
                        <div class="item-ifo">
                            <input class="text" maxlength="12" type="password" name="password" id="password"
                                   tabindex="2"
                                   placeholder="密码"/>
                            <div class="i-pass ico"></div>
                            <font color="red" class="password"></font>

                        </div>
                    </div>
                    <div class="item fore3">
                        <div class="item-ifo">
                            <input type="text" maxlength="5" class="text" name="randcode" id="randcode" tabindex="3"
                                   placeholder="验证码"/>
                            <div class="yanzheng_box">
                                <?php echo captcha_img(); ?>
                            </div>

                        </div>
                    </div>

                    <div class="item fore4">
                        <div class="item-ifo">
                            <label><a class="mes-login">短信快捷登录</a></label>
                            <label><a class="pswd-login">密码登录</a></label>
                        </div>
                    </div>

                    <div class="item login-btn">
                        <input name="action" type="hidden" value="submit"/>
                        <input name="forward" type="hidden" id="forward" value=""/>
                        <input type="button" tabindex="4" value="登录" onclick="return do_login();">
                        <font color="red" id="login-error" style="left: 0;text-align: center;width: 280px;"></font>
                    </div>

                    <div class="item fore6">
                        <div class="item-ifo">
                            <label><a class="lostpassword">忘记密码?</a></label>
                        </div>
                    </div>
                </form>


                <form id="mes-login" name="login" action="<?php echo url('open/manager/index'); ?>" method="post">
                    <div class="item fore1">
                        <div class="item-ifo">
                            <div class="i-name ico"></div>
                            <input autocomplete="off" class="text" name="phone" maxlength="11" type="text"
                                   id="phone"
                                   placeholder="手机号"
                                   tabindex="1"/>
                        </div>
                    </div>
                    <div class="item fore5">
                        <div class="item-ifo">
                            <input type="text" maxlength="6" class="text"  name="phone_randcode" id="phone_randcode_l"
                                   tabindex="4" placeholder="手机验证码"/>
                            <div class="yanzheng_box">
                                <span class="phone_randcode_btn" id="verifyYz1_l"  onclick="timeshow(8)">发送验证码</span>
                            </div>

                        </div>
                    </div>
                    <div class="item fore4">
                        <div class="item-ifo">
                            <label><a class="mes-login">短信快捷登录</a></label>
                            <label><a class="pswd-login">账号密码登录</a></label>
                        </div>
                    </div>
                    <div class="item login-btn" style="height: 80px">
                        <input name="action" type="hidden" value="submit"/>
                        <input name="forward" type="hidden" id="forward_l" value=""/>
                        <input type="button" tabindex="4" value="登录" onclick="return do_code_login();"/>
                        <font color="red" id="error" style="left: 0;text-align: center;width: 280px;"></font>
                    </div>
                </form>


                <form id="register" name="register" action="<?php echo url('open/manager/index'); ?>" method="post">
                    <div class="item fore1">
                        <div class="item-ifo">
                            <div class="i-name ico"></div>
                            <input autocomplete="off" class="text" name="phone" type="text" id="regphone"
                                   placeholder="手机号" tabindex="1"/>
                            <font color="red" class="regphone"></font>
                        </div>
                    </div>
                    <div class="item fore2">
                        <div class="item-ifo">
                            <input class="text" type="password" name="reg_password" id="reg_password" tabindex="2"
                                   placeholder="密码（6~16位数字或字母）"/>
                            <div class="i-pass ico"></div>
                            <font color="red" class="reg_password"></font>
                        </div>
                    </div>
                    <div class="item fore3">
                        <div class="item-ifo">
                            <input type="text" maxlength="5" class="text" name="reg_randcode" id="reg_randcode"
                                   tabindex="3"
                                   placeholder="验证码"/>
                            <div class="yanzheng_box">
                                <?php echo captcha_img(); ?>
                            </div>

                        </div>
                    </div>

                    <div class="item fore5">
                        <div class="item-ifo">
                            <input type="text" maxlength="6" class="text" name="phone_randcode" id="phone_randcode"
                                   tabindex="4" placeholder="手机验证码"/>
                            <div class="yanzheng_box">
                                <span class="phone_randcode_btn" id="verifyYz1" onclick="timeshow()">发送验证码</span>
                            </div>
                            <font color="red" class="phone_randcode"></font>
                        </div>
                    </div>

                    <div class="item fore5" style="height: 20px;">
                        <input type="checkbox" checked id="chebox" value="1" style="margin-top: 2px;"/>
                        <p style="line-height: 16px; float: left; margin: 0px;" class="f-ml5">我已阅读并同意网站的</p>
                        <a style="line-height: 16px; float: left; color: #55bb4e;" href="">使用条件</a>
                        <p style="line-height: 16px; float: left;">及</p>
                        <a style="line-height:16px; float: left; color:#55bb4e;" href="">隐私声明</a>
                        <p style="line-height: 16px; float: left;">。</p>
                    </div>

                    <div class="item register-btn">
                        <input name="action" type="hidden" value="submit"/>
                        <input name="forward" type="hidden" id="reg_forward" value=""/>
                        <input type="button" tabindex="4" value="注册" onclick="return do_register();">
                        <font color="red" id="register-error" style="left: 0;text-align: center;width: 280px;"></font>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>
<div class="forget-password">
    <form id="lostpassword" name="lostpassword" action="<?php echo url('open/manager/index'); ?>" method="post">
        <h3 class="find-password">找回密码</h3>
        <div class="item fore1">
            <div class="item-ifo">
                <div class="i-name ico"></div>
                <input autocomplete="off" class="text" name="phone" type="text" id="lostphone"
                       placeholder="手机号" tabindex="1"/>
                <font color="red" class="phone"></font>
            </div>
        </div>
        <div class="item fore3">
            <div class="item-ifo">
                <input type="text" maxlength="5" class="text" name="reg_randcode" id="lost_randcode"
                       tabindex="3"
                       placeholder="验证码"/>
                <div class="yanzheng_box">
                    <?php echo captcha_img(); ?>
                </div>
                <font color="red" class="reg_randcode"></font>
            </div>
        </div>

        <div class="item fore5">
            <div class="item-ifo">
                <input type="text" maxlength="6" class="text" name="phone_randcode" id="lost_phone_randcode"
                       tabindex="4" placeholder="手机验证码"/>
                <div class="yanzheng_box">
                    <span class="phone_randcode_btn" id="verifyYz1_f" onclick="timeshow()">发送验证码</span>
                </div>
                <font color="red" class="phone_randcode"></font>
            </div>
        </div>
        <div class="item fore2">
            <div class="item-ifo">
                <input class="text" type="password" name="reg_password" id="new_password" tabindex="2"
                       placeholder="密码（6~16位数字或字母）"/>
                <div class="i-pass ico"></div>
                <font color="red" class="reg_password"></font>
            </div>
        </div>
        <div class="item fore2">
            <div class="item-ifo">
                <input class="text" type="password" name="reg_password" id="renew_password" tabindex="2"
                       placeholder="再次输入密码"/>
                <div class="i-pass ico"></div>
                <font color="red" class="reg_password"></font>
            </div>
        </div>

        <div class="item register-btn">
            <input name="action" type="hidden" value="submit"/>
            <input name="forward" type="hidden" id="lost_forward" value=""/>
            <input type="button" tabindex="4" value="注册" onclick="return do_register();">
        </div>
    </form>
</div>

</body>
</html>