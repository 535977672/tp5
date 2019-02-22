<?php /*a:3:{s:55:"D:\mf\pcnfctest\application\index\view\index\index.html";i:1543541485;s:56:"D:\mf\pcnfctest\application\index\view\index\header.html";i:1543541485;s:56:"D:\mf\pcnfctest\application\index\view\index\footer.html";i:1543541485;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <link href="/static/bootstrap/css/adminlte.min.css" rel="stylesheet" type="text/css"/>
    <link href="/static/bootstrap/css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
    <link href="/static/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="/static/css/homepage.css" rel="stylesheet" type="text/css"/>
    <script src="/static/js/jquery-3.3.1.min.js"></script>
    <script src="/static/bootstrap/js/bootstrap.js" type="text/javascript"></script>
    <script src="/static/js/headline.js" type="text/javascript"></script>
</head>
<body>
<div class="header">
    <div class="w">
        <a href="" class="logo"><img height="100" width="100" src="/static/upload/logo/2018/11-28/9b303d797e2738dbe33b6ad5b6a877e1.jpg"/></a>
        <b class="slogan">吃出健康咨询开放平台</b>
    </div>
    <div class="topnav">
        <div class="w">
            <ul class="nav-box">
                <li class="nav-list"><a href="<?php echo url('/index/index/index'); ?>">首页</a></li>
                <li class="nav-list"><a href="<?php echo url('/index/index/headline'); ?>">健康头条</a></li>
            </ul>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(".nav-box li:first-child a").addClass("nav-active")
    })
</script>
<div class="main">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
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
                <a href="javascript:;">
                    <img src="<?php echo htmlentities($ad['ad_code']); ?>" alt="<?php echo htmlentities($ad['ad_name']); ?>" width="100%">
                </a>
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
    <div class="health-headline">
        <div class="headline-header">
            <h1><a href="<?php echo url('/index/index/index'); ?>">健康头条</a></h1>
            <ul class="headline-nav">
                <li class="headline-nav-list"><a href="<?php echo url('/index/index/headline',['channel'=>'1']); ?>">母婴</a></li>
                <li class="headline-nav-list"><a href="<?php echo url('/index/index/headline',['channel'=>'2']); ?>">健康</a></li>
                <li class="headline-nav-list"><a href="<?php echo url('/index/index/headline',['channel'=>'3']); ?>">社会</a></li>
                <li class="headline-nav-list"><a href="<?php echo url('/index/index/headline',['channel'=>'4']); ?>">娱乐</a></li>
                <li class="headline-nav-list"><a href="<?php echo url('/index/index/headline',['channel'=>'5']); ?>">养生</a></li>
                <div class="clearfix"></div>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="container headline-content-box">
            <div class="row">
                <?php foreach($list as $l): ?>
                <a class="headline-content-href" href="<?php echo url('/index/index/content',['id'=>$l['id']]); ?>">
                    <div class="col-lg-4 	 col-sm-6 	col-xs-12  headline-list">
                        <img class="col-xs-5" src="<?php echo htmlentities($l['pic']); ?>" alt="<?php echo htmlentities($l['title']); ?>">
                        <div class="col-xs-7 headline-text">
                            <h5><?php echo htmlentities($l['title']); ?></h5>
                            <img class="headline-photo" src="<?php echo htmlentities($l['head']); ?>" alt="">
                            <span class="headline-name"><?php echo htmlentities($l['username']); ?></span>
                        </div>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<div class="footer">
    <p>© 2017 版权所有 重庆盛汇葛博数据科技有限公司 网站备案号： 渝ICP备18010921号</p>
</div>
</body>
</html>