<?php /*a:5:{s:56:"D:\mf\pcnfc\application\open\view\manager\info_mana.html";i:1542849752;s:45:"D:\mf\pcnfc\application\open\view\layout.html";i:1541756597;s:52:"D:\mf\pcnfc\application\open\view\public\header.html";i:1542781910;s:54:"D:\mf\pcnfc\application\open\view\manager\leftnav.html";i:1543196952;s:52:"D:\mf\pcnfc\application\open\view\public\footer.html";i:1542781618;}*/ ?>
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
    .menu_list ul li:nth-child(3) .fuMenu{
        background: #55bb4e;
        color: #fff;
    }
    .menu_list ul li:nth-child(3) .fuMenu:before{
        color: #fff;
    }
</style>
<div class="col-sm-10 right-cont">
    <div class="picPublic">
        <h1>资讯管理<br><span>注：审核失败的内容将在15日后自动删除，请根据失败原因调整内容重新提交审核</span></h1>
        <ul class="nav nav-pills info_state" id="info_state">
            <li class="<?php if(app('request')->get('status') !== '0' && app('request')->get('status') != 1 && app('request')->get('status') != -1 && app('request')->get('status') != -2 && app('request')->get('plus') == 0): ?>active<?php endif; ?>" data-s="1001">全部</li>
            <li class="<?php if(app('request')->get('status') === '0'): ?>active<?php endif; ?>" data-s="0">待审核</li>
            <li class="<?php if(app('request')->get('status') == 1): ?>active<?php endif; ?>" data-s="1">已通过</li>
            <li class="<?php if(app('request')->get('status') == -1): ?>active<?php endif; ?>" data-s="-1">未通过</li>
            <li class="<?php if(app('request')->get('status') == -2): ?>active<?php endif; ?>" data-s="-2">草稿</li>
            <li class="<?php if(app('request')->get('plus') != 0): ?>active<?php endif; ?>" data-s="1002">推荐</li>
        </ul>
        <div id="info-list-box">
            <?php if($list): foreach($list as $key=>$info): ?>
            <div class="info-list-box">
                <div class="info-list-left">
                    <div class="info-title"><a href="javascript:;"><?php echo htmlentities($info['title']); ?></a></div>
                    <ul class="nav nav-pills info-label">
                        <li><?php echo htmlentities($info['statusmsg']); ?></li>
                        <li><?php echo htmlentities($info['typemsg']); ?></li>
                        <li><?php echo htmlentities($info['channel']); ?></li>
                        <li>阅读<span><?php echo htmlentities($info['view']); ?></span></li>
                        <li>评论<span><?php echo htmlentities($info['comment']); ?></span></li>
                        <li><?php echo htmlentities($info['create_time']); ?></li>
                    </ul>
                    <div class="articles-card-btns" id="infoOptions" data-id="<?php echo htmlentities($info['id']); ?>">
                        <?php if($info['status'] != 1): ?>
                        <button type="button" data-type="1" data-t="<?php echo htmlentities($info['type']); ?>" class="btn btn-default glyphicon glyphicon-pencil info-mana-btn">修改</button>
                        <?php endif; ?>
                        <button type="button" data-type="2" data-t="<?php echo htmlentities($info['type']); ?>" class="btn btn-default glyphicon glyphicon-open info-mana-btn">置顶</button>
                        <button type="button" data-type="3" data-t="<?php echo htmlentities($info['type']); ?>" class="btn btn-default glyphicon glyphicon-trash info-mana-btn">删除</button>
                    </div>
                </div>
                <div class="info-list-right">
                    <img src="<?php echo htmlentities($info['pic']); ?>" alt="cover">
                </div>
                <div class="clearfix"></div>
            </div>
            <?php endforeach; endif; if($list): ?>
            <div class="col-sm-12 text-center">
                <?php echo $list; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>


<div class="clearfix"></div>
</div>
</div>
<script type="text/javascript">
    infoOptions();
</script>

</body>
</html>