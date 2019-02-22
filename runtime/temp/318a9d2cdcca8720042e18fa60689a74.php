<?php /*a:5:{s:52:"D:\mf\pcnfc\application\open\view\manager\index.html";i:1542936962;s:45:"D:\mf\pcnfc\application\open\view\layout.html";i:1541756597;s:52:"D:\mf\pcnfc\application\open\view\public\header.html";i:1542781910;s:54:"D:\mf\pcnfc\application\open\view\manager\leftnav.html";i:1543196952;s:52:"D:\mf\pcnfc\application\open\view\public\footer.html";i:1542781618;}*/ ?>
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
    .menu_list ul li:first-child .fuMenu{
        background: #55bb4e;
        color: #fff;
    }
    .menu_list ul li:first-child .fuMenu:before{
        color: #fff;
    }
</style>
    <div class="col-sm-10 right-cont">
        <div class="home">
            <div>
                <div class="col-sm-9 home-info-wrapper">
                    <div class="col-sm-6">
                        <p><?php echo htmlentities($userCount); ?></p>
                        <p>订阅用户</p>
                    </div>
                    <div class="col-sm-6">
                        <p><?php echo htmlentities($viewSum); ?></p>
                        <p>累计浏览量</p>
                    </div>
                </div>
                <div class="col-sm-3 home-btn-wrapper">
                    <div class="home-btn glyphicon glyphicon-edit">
                        发表
                        <ul>
                            <li><a href="/open/manager/picPublic">图文资讯</a></li>
                            <li><a href="/open/manager/videoPublic">视频资讯</a></li>
                        </ul>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            
            <?php if($adv): ?>
            <div id="myCarousel" class="carousel slide col-sm-12">
                <!-- 轮播（Carousel）指标 -->
                <ol class="carousel-indicators">
                    <?php foreach($adv as $k=>$ad): ?>
                    <li data-target="#myCarousel" data-slide-to="<?php echo htmlentities($k); ?>" <?php if($k == 0): ?>class="active"<?php endif; ?>></li>
                    <?php endforeach; ?>
                </ol>
                <!-- 轮播（Carousel）项目 -->
                <div class="carousel-inner">
                    <?php foreach($adv as $k=>$ad): ?>
                    <div class="item <?php if($k == 0): ?>active<?php endif; ?>">
                        <img src="<?php echo htmlentities($ad['ad_code']); ?>" alt="<?php echo htmlentities($ad['ad_name']); ?>">
                    </div>
                    <?php endforeach; ?>
                </div>
                <!-- 轮播（Carousel）导航 -->
                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <?php endif; ?>

            <div class="announcement col-sm-12">
                <h1>公告</h1>
                <ul>
                    <?php if($msg): foreach($msg as $m): ?>
                    <li><a href="javascript:;"><span class="spanOne">公告</span><span class="spanTwo"><?php echo htmlentities($m['message']); ?></span><span class="spanThree"><?php echo htmlentities(date('Y-m-d H:i:s',!is_numeric($m['send_time'])? strtotime($m['send_time']) : $m['send_time'])); ?></span><div class="clearfix"></div></a></li>
                    <?php endforeach; else: ?>
                    <li><a href="javascript:;"><span class="spanOne"></span>暂无公告<span class="spanThree"></span></a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <?php if($msg): ?>
            <div class="col-sm-12 text-center">
                <?php echo $msg; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
<div class="clearfix"></div>
    </div>
</div>

</body>
</html>