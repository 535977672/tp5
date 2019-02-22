<?php /*a:6:{s:59:"D:\mf\pcnfc\application\open\view\manager\comment_mana.html";i:1542878070;s:45:"D:\mf\pcnfc\application\open\view\layout.html";i:1541756597;s:52:"D:\mf\pcnfc\application\open\view\public\header.html";i:1542781910;s:54:"D:\mf\pcnfc\application\open\view\manager\leftnav.html";i:1543196952;s:54:"D:\mf\pcnfc\application\open\view\manager\comment.html";i:1542936962;s:52:"D:\mf\pcnfc\application\open\view\public\footer.html";i:1542781618;}*/ ?>
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
    .menu_list ul li:nth-child(4) .fuMenu{
        background: #55bb4e;
        color: #fff;
    }
    .menu_list ul li:nth-child(4) .fuMenu:before{
        color: #fff;
    }
</style>
<div class="col-sm-10 right-cont">
    <div class="picPublic">
        <h1>评论管理</h1>
        <?php if($list): if($list): foreach($list as $l): ?>
<div class="info-list-box">
    <div class="info-list-left">
        <div class="info-title"><a href="javascript:;""><?php echo htmlentities($l['title']); ?></a></div>
        <ul class="nav nav-pills info-label">
            <li><?php echo htmlentities($l['statusmsg']); ?></li>
            <li><?php echo htmlentities($l['typemsg']); ?></li>
            <li><?php echo htmlentities($l['channel']); ?></li>
            <li>阅读<span><?php echo htmlentities($l['view']); ?></span></li>
            <li>评论<span><?php echo htmlentities($l['comment']); ?></span></li>
            <li><?php echo htmlentities($l['create_time']); ?></li>
        </ul>
    </div>
    <div class="clearfix"></div>
    <?php if($l['comment']): ?>
    <h2>文章评论（共<span><?php echo htmlentities($l['comment']); ?></span>条）</h2>
    <?php foreach($l['comments'] as $c): ?>
    <div class="comment-list row">
        <div class="user-photo col-sm-1">
            <img src="<?php echo htmlentities($c['head_pic']); ?>" alt="<?php echo htmlentities($c['username']); ?>">
        </div>
        <div class="comment-cont col-sm-11">
            <p><span><?php echo htmlentities($c['nickname']); ?>：</span><?php echo htmlentities($c['content']); ?></p>
            <div class="comment-time"><?php echo htmlentities(date('Y-m-d H:i:s',!is_numeric($c['add_time'])? strtotime($c['add_time']) : $c['add_time'])); ?></div>
            <div class="reply-comment" onclick="replyMore(this)">回复</div>
            <div class="reply-more">
                <textarea class="form-control reply-text" name="" data-id="<?php echo htmlentities($c['comment_id']); ?>" data-infoid="<?php echo htmlentities($c['goods_id']); ?>" id="<?php echo htmlentities($c['comment_id']); ?>" cols="30" rows="1"></textarea>
                <button class="reply-btn btn  btn-default" onclick="infoAddComment(this)">提交</button>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="clearfix"></div>
        <?php if($c['comments']): foreach($c['comments'] as $co): ?>
            <div class="user-photo col-sm-1">
            </div>
            <div class="comment-cont col-sm-11">
                <p><span><?php echo htmlentities($co['nickname']); ?></span> 回复 <span><?php echo htmlentities($co['pnickname']); ?></span>：</span><?php echo htmlentities($co['content']); ?></p>
                <div class="comment-time"><?php echo htmlentities(date('Y-m-d H:i:s',!is_numeric($co['add_time'])? strtotime($co['add_time']) : $co['add_time'])); ?></div>
                <div class="reply-comment" onclick="replyMore(this)">回复</div>
                <div class="reply-more">
                    <textarea class="form-control reply-text" name="" data-id="<?php echo htmlentities($co['comment_id']); ?>" data-infoid="<?php echo htmlentities($co['goods_id']); ?>" id="<?php echo htmlentities($co['comment_id']); ?>" cols="30" rows="1"></textarea>
                    <button class="reply-btn btn  btn-default" onclick="infoAddComment(this)">提交</button>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="clearfix"></div>
        <?php endforeach; endif; ?>
        <div class="comment-list-more row">
            <div class="col-sm-1"></div>
            <div class="col-sm-11">
                <button class="more-reply-btn" data-page="1" data-pid="1" data-infoid="<?php echo htmlentities($l['id']); ?>" onclick="infoGetComment(this)">展开更多对话</button>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <div class="comment-list-more row">
        <div class="col-sm-12 text-center ">
            <button class="more-comment-btn" data-page="1" data-pid="0" data-infoid="<?php echo htmlentities($l['id']); ?>" onclick="infoGetComment(this)">展开更多评论</button>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php endforeach; endif; if($comments): foreach($comments as $c): if($c['comments']): ?><div class="comment-list row"><?php endif; ?>
    <div class="user-photo col-sm-1">
        <?php if($c['comments']): ?><img src="<?php echo htmlentities($c['head_pic']); ?>" alt="<?php echo htmlentities($c['username']); ?>"><?php endif; ?>
    </div>
    <div class="comment-cont col-sm-11">
        <p><span><?php echo htmlentities($c['nickname']); ?>：</span><?php echo htmlentities($c['content']); ?></p>
        <div class="comment-time"><?php echo htmlentities(date('Y-m-d H:i:s',!is_numeric($c['add_time'])? strtotime($c['add_time']) : $c['add_time'])); ?></div>
        <div class="reply-comment" onclick="replyMore(this)">回复</div>
        <div class="reply-more">
            <textarea class="form-control reply-text" name="" data-id="<?php echo htmlentities($c['comment_id']); ?>" data-infoid="<?php echo htmlentities($c['goods_id']); ?>" id="<?php echo htmlentities($c['comment_id']); ?>" cols="30" rows="1"></textarea>
            <button class="reply-btn btn  btn-default" onclick="infoAddComment(this)">提交</button>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="clearfix"></div>
    <?php if($c['comments']): foreach($c['comments'] as $co): ?>
        <div class="user-photo col-sm-1">
        </div>
        <div class="comment-cont col-sm-11">
            <p><span><?php echo htmlentities($co['nickname']); ?></span> 回复 <span><?php echo htmlentities($co['pnickname']); ?></span>：</span><?php echo htmlentities($co['content']); ?></p>
            <div class="comment-time"><?php echo htmlentities(date('Y-m-d H:i:s',!is_numeric($co['add_time'])? strtotime($co['add_time']) : $co['add_time'])); ?></div>
            <div class="reply-comment" onclick="replyMore(this)">回复</div>
            <div class="reply-more">
                <textarea class="form-control reply-text" name="" data-id="<?php echo htmlentities($co['comment_id']); ?>" data-infoid="<?php echo htmlentities($co['goods_id']); ?>" id="<?php echo htmlentities($co['comment_id']); ?>" cols="30" rows="1"></textarea>
                <button class="reply-btn btn  btn-default" onclick="infoAddComment(this)">提交</button>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="clearfix"></div>
    <?php endforeach; endif; if($c['comments']): ?></div><?php endif; endforeach; endif; ?>

        <div class="col-sm-12 text-center">
            <?php echo $list; ?>
        </div>
        <?php else: ?>
        <div class="info-list-box">
            <div class="info-list-left">
                <div class="info-title">
                    <a href="javascript:;">暂无资讯</a>
                </div>
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