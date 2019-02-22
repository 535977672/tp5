<?php /*a:5:{s:59:"D:\mf\pcnfc\application\open\view\manager\user_account.html";i:1543196952;s:45:"D:\mf\pcnfc\application\open\view\layout.html";i:1541756597;s:52:"D:\mf\pcnfc\application\open\view\public\header.html";i:1542781910;s:54:"D:\mf\pcnfc\application\open\view\manager\leftnav.html";i:1543196952;s:52:"D:\mf\pcnfc\application\open\view\public\footer.html";i:1542781618;}*/ ?>
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
<link href="/static/css/manager.css" rel="stylesheet" type="text/css"/>
<style>
    .login .w {
        width: 1180px;
    }
</style>
<div class="main-box">
    <div class="midle row">
        <div class="leftMenu col-sm-2">
            <div class="menu_list">
                <ul>
                    <?php if($status != 1): ?>
                    <li class="">
                        <a href="<?php echo url('/open/manager/index'); ?>" class="fuMenu glyphicon glyphicon-home">主页</a>
                    </li>
                    <li class="">
                        <p class="fuMenu glyphicon glyphicon-edit">发表</p>
                        <i class="xiala glyphicon glyphicon-chevron-down"></i>
                        <div class="div1">
                            <a href="<?php echo url('/open/manager/picPublic'); ?>" class="zcd" id="zcd9">图文资讯</a>
                            <a href="<?php echo url('/open/manager/videoPublic'); ?>" class="zcd" id="zcd10">视频资讯</a>
                        </div>
                    </li>
                    <li class="">
                        <a href="<?php echo url('/open/manager/infoMana'); ?>"
                           class="fuMenu 	glyphicon glyphicon-list-alt">资讯管理</a>
                    </li>
                    <li class="">
                        <a href="<?php echo url('/open/manager/commentMana'); ?>"
                           class="fuMenu glyphicon glyphicon-envelope">评论管理</a>
                    </li>
                    <?php endif; ?>
                    <li class="">
                        <a href="<?php echo url('/open/manager/userAccount'); ?>" class="fuMenu glyphicon glyphicon-cog">账号设置</a>
                    </li>
                </ul>
            </div>
        </div>
<style>
    .menu_list ul li:nth-child(5) .fuMenu{
        background: #55bb4e;
        color: #fff;
    }
    .menu_list ul li:nth-child(5) .fuMenu:before{
        color: #fff;
    }
</style>
<div class="col-sm-10 right-cont">
    <div class="picPublic">
        <h1>账号信息</h1>
        <div class="user-account-list  row">
            <label class="col-sm-3 control-label info-name">头像：</label>
            <div class="col-sm-9" >
                <?php if($users['head_pic']): ?><img class="head-photo" src="<?php echo htmlentities($users['head_pic']); ?>" alt=""><?php endif; ?>
            </div>
        </div>
        <div class="user-account-list  row">
            <label class="col-sm-3 control-label info-name">名称：</label>
            <div class="col-sm-9" >
                <p class="account-info"><?php echo htmlentities($users['gname']); ?></p>
            </div>
        </div>
        <div class="user-account-list  row">
            <label class="col-sm-3 control-label info-name">简介：</label>
            <div class="col-sm-9" >
                <p class="account-info"><?php echo htmlentities($users['intro']); ?></p>
            </div>
        </div>
        <div class="user-account-list  row">
            <label class="col-sm-3 control-label info-name">吃健康类型：</label>
            <div class="col-sm-9" >
                <p class="account-info"><?php if($users['usertype'] == 1): ?>个人<?php elseif($users['usertype'] == 2): ?>机构<?php elseif($users['usertype'] == 3): ?>企业<?php elseif($users['usertype'] == 4): ?>政府<?php elseif($users['usertype'] == 5): ?>其他<?php else: endif; ?></p>
            </div>
        </div>
        <div class="user-account-list  row">
            <label class="col-sm-3 control-label info-name">领域：</label>
            <div class="col-sm-9" >
                <p class="account-info"><?php echo htmlentities($users['fieldname']); ?></p>
            </div>
        </div>
        <div class="user-account-list  row">
            <label class="col-sm-3 control-label info-name">运营者姓名：</label>
            <div class="col-sm-9" >
                <p class="account-info operator-name"><?php echo htmlentities($users['name']); ?></p>
            </div>
        </div>
        <div class="user-account-list  row">
            <label class="col-sm-3 control-label info-name">联系电话：</label>
            <div class="col-sm-9" >
                <p class="account-info operator-name"><?php echo htmlentities($users['mobile']); ?></p>
            </div>
        </div>
        <div class="user-account-list  row">
            <label class="col-sm-3 control-label info-name">联系邮箱：</label>
            <div class="col-sm-9" >
                <p class="account-info operator-name"><?php echo htmlentities($users['email']); ?></p>
            </div>
        </div>
        <div class="user-account-list  row">
            <label class="col-sm-3 control-label info-name">运营者证件号码：</label>
            <div class="col-sm-9" >
                <p class="account-info operator-name"><?php echo htmlentities($users['id_card']); ?></p>
            </div>
        </div>
        <?php if($type == 1): ?>
        <div class="user-account-list  row">
            <label class="col-sm-3 control-label info-name">手持证件照：</label>
            <div class="col-sm-9" >
                <?php if($users['hand_photo']): ?><img class="operator-photo" src="<?php echo htmlentities($users['hand_photo']); ?>" alt=""><?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
        <div class="user-account-list  row">
            <label class="col-sm-3 control-label info-name">运营者所在地：</label>
            <div class="col-sm-9" >
                <p class="account-info operator-name"><?php echo htmlentities($users['operation_address']); ?></p>
            </div>
        </div>
        <div class="user-account-list  row">
            <label class="col-sm-3 control-label info-name">其它联系方式：</label>
            <div class="col-sm-9" >
                <p class="account-info operator-name"></p>
            </div>
        </div>
        <div class="user-account-list  row">
            <label class="col-sm-3 control-label info-name">机构名称：</label>
            <div class="col-sm-9" >
                <p class="account-info operator-name"><?php echo htmlentities($users['gname']); ?></p>
            </div>
        </div>
        <div class="user-account-list  row">
            <label class="col-sm-3 control-label info-name">机构地址：</label>
            <div class="col-sm-9" >
                <p class="account-info operator-name"><?php echo htmlentities($users['address']); ?></p>
            </div>
        </div>
        <div class="user-account-list  row">
            <label class="col-sm-3 control-label info-name">官方网站：</label>
            <div class="col-sm-9" >
                <p class="account-info operator-name"><?php echo htmlentities($users['web']); ?></p>
            </div>
        </div>
        <?php if($type == 1 || $type == 3 || $type == 5): ?>
        <div class="user-account-list  row">
            <label class="col-sm-3 control-label info-name">媒体材料：</label>
            <div class="col-sm-9" >
                <p class="account-info operator-name"><?php echo htmlentities($users['media_material']); ?></p>
            </div>
        </div>
        <?php endif; ?>
        <div class="user-account-list  row">
            <label class="col-sm-3 control-label info-name">材料证明：</label>
            <div class="col-sm-9" >
                <?php if($users['material_certificate']): ?><img class="operator-photo" src="<?php echo htmlentities($users['material_certificate']); ?>" alt=""><?php endif; ?>
            </div>
        </div>
        <?php if($type == 2 || $type == 4 || $type == 5): ?>
        <div class="user-account-list  row">
            <label class="col-sm-3 control-label info-name">组织机构代码证：</label>
            <div class="col-sm-9" >
                <?php if($users['org_code_certificate']): ?><img class="operator-photo" src="<?php echo htmlentities($users['org_code_certificate']); ?>" alt=""><?php endif; ?>
            </div>
        </div>
        <?php endif; if($type == 3): ?>
        <div class="user-account-list  row">
            <label class="col-sm-3 control-label info-name">企业营业执照扫描件：</label>
            <div class="col-sm-9" >
                <?php if($users['business_licence_scanning']): ?><img class="operator-photo" src="<?php echo htmlentities($users['business_licence_scanning']); ?>" alt=""><?php endif; ?>
            </div>
        </div>
        <?php endif; if($type == 2 || $type == 3 || $type == 4 || $type == 5): ?>
        <div class="user-account-list  row">
            <label class="col-sm-3 control-label info-name">授权书扫描件：</label>
            <div class="col-sm-9" >
                <?php if($users['power_atto_scanning']): ?><img class="operator-photo" src="<?php echo htmlentities($users['power_atto_scanning']); ?>" alt=""><?php endif; ?>
            </div>
        </div>
        <?php endif; if($type == 4): ?>
        <div class="user-account-list  row">
            <label class="col-sm-3 control-label info-name">机构级别：</label>
            <div class="col-sm-9" >
                <p class="account-info operator-name"><?php echo htmlentities($users['level']); ?></p>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<div class="clearfix"></div>
</div>
</div>

</body>
</html>