<?php /*a:5:{s:63:"D:\mf\pcnfctest\application\open\view\manager\video_public.html";i:1542936962;s:49:"D:\mf\pcnfctest\application\open\view\layout.html";i:1541756597;s:56:"D:\mf\pcnfctest\application\open\view\public\header.html";i:1542781910;s:58:"D:\mf\pcnfctest\application\open\view\manager\leftnav.html";i:1543196952;s:56:"D:\mf\pcnfctest\application\open\view\public\footer.html";i:1542781618;}*/ ?>
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
<script src="/static/js/cropper.min.js"></script>
<style>
    .menu_list ul li:nth-child(2) .div1 .zcd:nth-child(2){
        background: #55bb4e;
        color: #fff;
    }
    .add-img{
        width: 190px;
    }
    #user-photo {
        width:190px;
        align-items: center;
    }
    .modal-dialog{
        margin: 200px auto;
    }
    .modal-content{
        width:500px;
        margin:0 auto;
    }
    #photo {
        max-width:100%;
        max-height:281px;
    }
    .img-preview-box {
        text-align: center;
    }
    .img-preview-box > div {
        display: inline-block;;
        margin-right: 10px;
    }
    .img-preview {
        overflow: hidden;
    }
    .img-preview-box .img-preview-lg {
        width: 150px;
        height: 150px;
    }
    .img-preview-box .img-preview-md {
        width: 100px;
        height: 100px;
    }
    .user-photo-box{
        width: 192px;
        height: 180px;
        display: flex;
        align-items: center;
        border: dashed 1px #ccc;
        border-radius: 4px;
        background: #f5f5f5;
        position: relative;
    }
    .video-name{
        position: absolute;
        top:130px;
        left: 16px;
        width: 160px;
        text-align: center;
        font-weight: normal;
        color: #999;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }
</style>
<div class="col-sm-10 right-cont">
    <div class="picPublic">
        <form class="form-horizontal" role="form">
            <input type="hidden" id='infoid' name="id" value='<?php echo htmlentities($list['id']); ?>'>
            <h1>发布视频资讯</h1>
            <div class="form-group">
                <label class="col-sm-2 control-label">标题：</label>
                <div class="col-sm-9">
                    <input type="text" name="user" id="user" class="form-control" placeholder="请输入15-35个字"
                           onkeyup="namecheck($(this))" value="<?php echo htmlentities($list['title']); ?>">
                    <p class="content-error"></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label not-nes">推荐产品：</label>
                <div class="col-sm-9 choose-pro-list-box">
                    <section class="choose-pro"  data-target="#choosePro" data-toggle="modal">
                        添加产品
                    </section>
                    <div class="modal fade" id="choosePro" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content choose-show ">
                                <span class="close-choose-show glyphicon glyphicon-remove" data-dismiss="modal" aria-hidden="true"></span>
                                <h1>产品添加</h1>
                                <div class="input-group">
                                    <input type="search" class="form-control" placeholder="请输入商品名称">
                                    <span class="input-group-addon choose-search-btn" onclick="chooseSearch()">搜索</span>
                                </div>
                                <ul class="choose-already"></ul>
                                <ul class="list-group choose-list-group ">
                                </ul>
                                <div class="col-sm-12 text-center list-page">
                                </div>
                                <div class="choose-btn-box">
                                    <div class="choose-submit choose-buttom-btn" onclick="chooseSub()" data-dismiss="modal" aria-hidden="true">添加</div>
                                    <div class="choose-cancel choose-buttom-btn" data-dismiss="modal" aria-hidden="true">取消</div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="content-error"></p>
                    <ul class="list-group choose-pro-list">
                        <?php if($list['goodss']): foreach($list['goodss'] as $g): ?>
                        <li class="choose-list list-group-item">
                            <a href="javascript:;"  target="_blank" class="chooseCard">
                                <img src="<?php echo htmlentities($g['original_img']); ?>" alt="" class="choose-list-img">
                                <p><?php echo htmlentities($g['goods_name']); ?></p>
                                <input type="hidden" class="chooseGoodsId" value="<?php echo htmlentities($g['goods_id']); ?>">
                                <div class="clearfix"></div>
                            </a>
                            <div class="close-card glyphicon glyphicon-remove" onclick="chooseThis(this)"></div>
                            <div class="clearfix"></div>
                        </li>
                        <?php endforeach; endif; ?>
                    </ul>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">封面图：</label>
                <div class="col-sm-9">
                    <div class="user-photo-box" data-target="#changeModal" data-toggle="modal">
                            <img id="user-photo" src="<?php if($list['pic']): ?><?php echo htmlentities($list['pic']); else: ?>/static/image/a11.png<?php endif; ?>" >
                            <textarea name="" class="picBase" hidden rows=30 cols=300></textarea>
                    </div>
                    <span class="upDic">1张，每张最大500K，格式：.jpg,.jpeg,.png</span>
                    <p class="content-error"></p>
                    <div class="modal fade" id="changeModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <span type="button" class="close" data-dismiss="modal" aria-hidden="true">×</span>
                                    <h4 class="modal-title text-primary">
                                        <i class="fa fa-pencil"></i>
                                        上传封面
                                    </h4>
                                </div>
                                <div class="modal-body">
                                    <p class="tip-info text-center">
                                        未选择图片
                                    </p>
                                    <div class="img-container hidden">
                                        <img src="" alt="" id="photo">
                                    </div>
                                    <div class="img-preview-box hidden">
                                        <div class="img-preview img-preview-lg" style="width: 468px;height: 234px;border: 1px solid #333;margin-top: 20px">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <label class="btn btn-danger pull-left" for="photoInput">
                                        <input type="file" class="sr-only" id="photoInput" accept="image/*">
                                        <span>打开图片</span>
                                    </label>
                                    <span class="btn btn-primary disabled" disabled="true" onclick="sendPhoto();">提交</span>
                                    <span class="btn btn-close" aria-hidden="true" data-dismiss="modal">取消</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">视频：</label>
                <div class="col-sm-9">
                    <label for="videoInput" class="user-photo-box">
                        <img src="<?php if($list['video']): ?>/static/image/a9.png<?php else: ?>/static/image/a10.png<?php endif; ?>" class="add-img video-img">
                        <input id="videoInput" type="file" accept="video/*" onchange="filechange()">
                        <p class="video-name"><?php echo substr($list['video'],strripos($list['video'],'/')+1); ?></p>
                        <textarea name="" class="videoBase" hidden rows=30 cols=300><?php echo htmlentities($list['video']); ?></textarea>
                    </label><br>
                    <span class="upDic">支持视频格式为：.wmv,.rm,.rmvb,.mov,.mp4,.flv,.3gp,.mkv,.avi,.f4v,.webv,.mepg</span>
                    <p class="content-error"></p>
                </div>
            </div>
            <div class="form-group ins-lev">
                <label class="col-sm-2 control-label">频道：</label>
                <div class="col-sm-9">
                    <select class="form-control" name="level" id="level">
                        <option value="0">请选择</option>
                        <option value="母婴" <?php if($list['channel'] == 母婴): ?>selected<?php endif; ?>>母婴</option>
                        <option value="健康" <?php if($list['channel'] == 健康): ?>selected<?php endif; ?>>健康</option>
                        <option value="社会" <?php if($list['channel'] == 社会): ?>selected<?php endif; ?>>社会</option>
                        <option value="娱乐" <?php if($list['channel'] == 娱乐): ?>selected<?php endif; ?>>娱乐</option>
                        <option value="养生" <?php if($list['channel'] == 养生): ?>selected<?php endif; ?>>养生</option>
                    </select>
                    <p class="content-error"></p>
                </div>
            </div>
            <div class="form-group form-btn">
                <input class="btn btn-public public-btn" type="button" id="infoAdd" value="提交审核">
                <input class="btn btn-public cancel-btn" type="button" onclick="javascript :history.back(-1)" value="取消">
                <span id="error" style="color: red;position: relative"></span>
            </div>
        </form>
    </div>
</div>

<div class="clearfix"></div>
</div>
</div>

<script type="text/javascript">


    $(function(){
        initCropperInModal($('#photo'),$('#photoInput'),$('#changeModal'));
    });

    var initCropperInModal = function(img, input, modal){
        var $image = img;
        var $inputImage = input;
        var $modal = modal;
        var options = {
            aspectRatio: 16/9, // 纵横比
            viewMode: 1,
            preview: '.img-preview' // 预览图的class名
        };
        // 模态框隐藏后需要保存的数据对象
        var saveData = {};
        var URL = window.URL || window.webkitURL;
        var blobURL;
        $modal.on('show.bs.modal',function () {
            // 如果打开模态框时没有选择文件就点击“打开图片”按钮
            if(!$inputImage.val()){
                $inputImage.click();
            }
        }).on('shown.bs.modal', function () {
            // 重新创建
            $image.cropper( $.extend(options, {
                ready: function () {
                    // 当剪切界面就绪后，恢复数据
                    if(saveData.canvasData){
                        $image.cropper('setCanvasData', saveData.canvasData);
                        $image.cropper('setCropBoxData', saveData.cropBoxData);
                    }
                }
            }));
        }).on('hidden.bs.modal', function () {
            // 保存相关数据
            saveData.cropBoxData = $image.cropper('getCropBoxData');
            saveData.canvasData = $image.cropper('getCanvasData');
            // 销毁并将图片保存在img标签
            $image.cropper('destroy').attr('src',blobURL);
        });
        if (URL) {
            $inputImage.change(function() {
                var files = this.files;
                var file = files[0];
                if (!$image.data('cropper')) {
                    return;
                }
                if (files && files.length) {

                    if (/^image\/\w+$/.test(file.type)) {
                        if(blobURL) {
                            URL.revokeObjectURL(blobURL);
                        }
                        blobURL = URL.createObjectURL(file);

                        // 重置cropper，将图像替换
                        $image.cropper('reset').cropper('replace', blobURL);
                        // 选择文件后，显示和隐藏相关内容
                        $('.img-container').removeClass('hidden');
                        $('.img-preview-box').removeClass('hidden');
                        $('#changeModal .disabled').removeAttr('disabled').removeClass('disabled');
                        $('#changeModal .tip-info').addClass('hidden');

                    } else {
                        window.alert('请选择一个图像文件！');
                    }
                }
            });
        } else {
            $inputImage.prop('disabled', true).addClass('disabled');
        }
    };

    var sendPhoto = function () {
        // 得到PNG格式的dataURL
        var photo = $('#photo').cropper('getCroppedCanvas').toDataURL('image/png');
        $('#user-photo').attr('src', photo);
        $('#changeModal').modal('hide');
        $('.picBase').html(photo);
    };




    
    $('#infoAdd').on('click', function(){
        var infoid = $('#infoid').val(),
        title = $('#user').val(),
        level = $('#level').val(),
        photo = $('#user-photo').attr('src'),
        videoBase = $(".videoBase").text(),
        goods = $('.choose-pro-list input'),
        goodsids = '';
        if(goods.length){
            $.each(goods, function(k, v){
                goodsids = goodsids + ',' +$(v).val();
            });
        }
        if(goodsids){
            goodsids = goodsids.substr(1);
        }
        if(!title){
            layer.msg('请输入标题', {icon: 5});
            return false;
        }
        if(level == 0){
            layer.msg('请选择频道', {icon: 5});
            return false;
        }
        if(!photo || photo == '/static/image/a11.png'){
            layer.msg('请上传图片', {icon: 5});
            return false;
        }
        if(!videoBase && !infoid){
            layer.msg('请上传视频', {icon: 5});
            return false;
        }
        var data = {
            title:title,
            channel:level,
            cover:photo,
            video:videoBase,
            id:infoid,
            goodsids:goodsids
        };
        var index = layer.load();
        $.ajax({
            url: '/open/manager/addVideoPublic',
            type: 'post',
            data: data,
            dataType: 'json',
            success: function (data) {
                layer.close(index);
                if (data.status === 0) {
                    layer.msg(data.msg, {icon: 6});
                    window.location.href='/open/manager/infoMana';
                }else{
                    layer.msg(data.msg, {icon: 5});
                }
            },
            error: function(data ){
                console.log(data);
            }
        });
    });
</script>

</body>
</html>