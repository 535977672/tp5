<?php /*a:3:{s:59:"D:\mf\pcnfctest\application\index\view\index\head_line.html";i:1543541485;s:56:"D:\mf\pcnfctest\application\index\view\index\header.html";i:1543541485;s:56:"D:\mf\pcnfctest\application\index\view\index\footer.html";i:1543541485;}*/ ?>
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
        $(".nav-box li:nth-child(2) a").addClass("nav-active")
    })
</script>
<div class="main">
    <ul class="breadcrumb bread-nav">
        <li><a href="#">首页</a></li>
        <li class="active">健康头条</li>
    </ul>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 headline-left">
                <ul class="headline-nav">
                    <li class="headline-nav-list <?php if(app('request')->param('channel') < 1): ?>active<?php endif; ?>"><a href="<?php echo url('/index/index/headline'); ?>">热门</a></li>
                    <li class="headline-nav-list <?php if(app('request')->param('channel') == 1): ?>active<?php endif; ?>"><a href="<?php echo url('/index/index/headline',['channel'=>'1']); ?>">母婴</a></li>
                    <li class="headline-nav-list <?php if(app('request')->param('channel') == 2): ?>active<?php endif; ?>"><a href="<?php echo url('/index/index/headline',['channel'=>'2']); ?>">健康</a></li>
                    <li class="headline-nav-list <?php if(app('request')->param('channel') == 3): ?>active<?php endif; ?>"><a href="<?php echo url('/index/index/headline',['channel'=>'3']); ?>">社会</a></li>
                    <li class="headline-nav-list <?php if(app('request')->param('channel') == 4): ?>active<?php endif; ?>"><a href="<?php echo url('/index/index/headline',['channel'=>'4']); ?>">娱乐</a></li>
                    <li class="headline-nav-list <?php if(app('request')->param('channel') == 5): ?>active<?php endif; ?>"><a href="<?php echo url('/index/index/headline',['channel'=>'5']); ?>">养生</a></li>
                </ul>
                <?php if($list): foreach($list as $l): ?>
                <a href="<?php echo url('/index/index/content', ['id' => $l['id']]); ?>">
                    <div class="headLineList">
                        <p class="headLineTitle"><?php echo htmlentities($l['title']); ?></p>
                        <div class="headLineImg">
                            <?php foreach($l['cover'] as $c): ?>
                            <img class="col-xs-4" src="<?php echo htmlentities($c); ?>" alt="<?php echo htmlentities($l['title']); ?>">
                            <?php endforeach; ?>
                            <div class="clearfix"></div>
                        </div>
                        <div class="headLineInfo">
                            <div class="headlineList-tags-channel">
                                <?php echo htmlentities($l['channel']); ?>
                            </div>
                            <div class="headline-item-source">
                                <img class="headline-item-source-img" src="<?php echo htmlentities($l['head']); ?>">
                                <span class="headline-item-source-span"><?php echo htmlentities($l['username']); ?></span>
                            </div>
                        </div>
                    </div>
                </a>
                <?php endforeach; endif; if($list): ?>
                <div class="col-sm-12 text-center">
                    <?php echo $list; ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-4">
                <div class="headline-new">
                    <h4 class="headline-new-title">最新资讯</h4>
                    <ul class="headline-new-list">
                        <?php if($new): foreach($new as $l): ?>
                        <li class="headline-new-list-item"><a href="<?php echo url('/index/index/content', ['id' => $l['id']]); ?>"><?php echo htmlentities($l['title']); ?></a></li>
                        <?php endforeach; endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer">
    <p>© 2017 版权所有 重庆盛汇葛博数据科技有限公司 网站备案号： 渝ICP备18010921号</p>
</div>
</body>
</html>