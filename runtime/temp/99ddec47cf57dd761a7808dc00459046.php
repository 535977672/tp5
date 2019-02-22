<?php /*a:5:{s:57:"D:\mf\pcnfc\application\open\view\manager\pic_public.html";i:1542936962;s:45:"D:\mf\pcnfc\application\open\view\layout.html";i:1541756597;s:52:"D:\mf\pcnfc\application\open\view\public\header.html";i:1542781910;s:54:"D:\mf\pcnfc\application\open\view\manager\leftnav.html";i:1543196952;s:52:"D:\mf\pcnfc\application\open\view\public\footer.html";i:1542781618;}*/ ?>
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
<script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript" src="/ueditor/lang/zh-cn/zh-cn.js"></script>
<script>
    $(function(){
        var ueditor = UE.getEditor('content',{    //content为要编辑的textarea的id
            //initialFrameWidth: 1100,   //初始化宽度
            initialFrameHeight: 500,   //初始化高度
        });
    });
</script>
<style>
    .menu_list ul li:nth-child(2) .div1 .zcd:first-child{
        background: #55bb4e;
        color: #fff;
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
        display: inline-block;
        margin-right: 10px;
    }
    .img-preview {
        overflow: hidden;
    }
</style>
<div class="col-sm-10 right-cont">
    <div class="picPublic">
        <form class="form-horizontal" role="form">
            <input type="hidden" id='infoid' name="id" value='<?php echo htmlentities($list['id']); ?>'>
            <h1>发布图文资讯</h1>
            <div class="form-group">
                <label class="col-sm-2 control-label">标题：</label>
                <div class="col-sm-9">
                    <input type="text" name="user" id="user" class="form-control" value="<?php echo htmlentities($list['title']); ?>" placeholder="请输入15-35个字"
                           onkeyup="namecheck($(this))">
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
                                    <input type="search" class="form-control" placeholder="请输入商品名称" id="goodsSearch" data-key="">
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
                <label class="col-sm-2 control-label">简介：</label>
                <div class="col-sm-9">
                    <textarea name="content" id="content" placeholder="10-100个字，请简述个人信息及内容定位、价值"
                              onkeyup="diccheck($(this))"><?php echo htmlentities($list['content']); ?></textarea>
                    <p class="content-error"></p>
                </div>
            </div>
            <div class="form-group">
                    <label class="col-sm-2 control-label">封面图：</label>
                    <div class="img-box full col-sm-9">
                        <section class=" img-section">
                            <div class="z_photo upimg-div" >
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
                                                    <div class="img-preview" style="width: 468px;height: 234px;border: 1px solid #333;margin-top: 20px">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <label class="btn btn-danger pull-left" for="photoInput">
                                                    <input type="file" name="file" id="photoInput" class="file sr-only" value="" accept="image/*" multiple />
                                                    <span>打开图片</span>
                                                </label>
                                                <span class="btn btn-primary disabled" disabled="true" onclick="sendPhoto();">提交</span>
                                                <span class="btn btn-close" aria-hidden="true" data-dismiss="modal">取消</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if($list['cover']): foreach($list['cover'] as $c): ?>
                                <section class="up-section fl loading">
                                    <span class="up-span"></span>
                                    <img class="close-upimg" src="/static/image/a7.png">
                                    <img class="up-img up-img1" src="<?php echo htmlentities($c); ?>">
                                    <textarea class="result result1" hidden="" rows="30" cols="300"><?php echo htmlentities($c); ?></textarea>
                                </section>
                                <?php endforeach; endif; ?> 
                            </div>
                            <section class="z_file fl" <?php if($list['cover']): ?>style="display: none;"<?php endif; ?> data-target="#changeModal" data-toggle="modal">
                                <img src="/static/image/a11.png" class="add-img">
                            </section>
                            <div class="clearfix"></div>
                        </section>
                        <p class="content-error"></p>
                    </div>
                    <aside class="mask works-mask">
                        <div class="mask-content">
                            <p class="del-p ">您确定要删除作品图片吗？</p>
                            <p class="check-p"><span class="del-com wsdel-ok">确定</span><span class="wsdel-no">取消</span></p>
                        </div>
                    </aside>
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
                <input class="btn btn-public public-btn infoAddPic"  type="button" data-type="1" value="发布">
                <input class="btn btn-public save-btn infoAddPic" type="button" data-type="2" value="存草稿">
                <input class="btn btn-public cancel-btn" type="button"  onclick="javascript :history.back(-1)" value="取消">
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
                var file;
                if (!$image.data('cropper')) {
                    return;
                }
                if (files && files.length) {
                    file = files[0];
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
    var j = 0;
    if('<?php echo htmlentities($list['pic']); ?>') j=3;
    var sendPhoto = function () {
        j++
        var imgContainer = $(".z_photo");
        var $section = $("<section class='up-section fl loading'>");
        $section.appendTo(imgContainer);
        var $span = $("<span class='up-span'>");
        $span.appendTo($section);
        var $img0 = $("<img class='close-upimg'>").on("click",function(event){
            event.preventDefault();
            event.stopPropagation();
            $(".works-mask").show();
            delParent = $(this).parent();
        });
        $img0.attr("src","/static/image/a7.png").appendTo($section);
        var $img = $("<img class='up-img'>");
        $img.addClass("up-img" + j);
        $img.appendTo($section);
        var $textarea = $("<textarea class='result' hidden rows=30 cols=300></textarea>")
        $textarea.addClass("result" + j);
        $textarea.appendTo($section);
        // 得到PNG格式的dataURL
        var photo = $('#photo').cropper('getCroppedCanvas').toDataURL('image/png');
        $(".up-img" + j).attr('src', photo);
        $('#changeModal').modal('hide');
        $(".result" + j).html(photo);
        var numUp = $(".up-section").length;
        if(numUp >= 3){
            $(".z_file").hide();
        }
    };
    $(".z_photo").delegate(".close-upimg","click",function(){
        $(".works-mask").show();
        delParent = $(this).parent();
    });

    $(".wsdel-ok").click(function(){
        $(".works-mask").hide();
        var numUp = delParent.siblings().length;
        if(numUp < 4){
            $(".z_file").show();
        }
        delParent.remove();
    });

    $(".wsdel-no").click(function(){
        $(".works-mask").hide();
    });
    
    $('.infoAddPic').on('click', function(){
        var o = $(this),
        type = o.attr('data-type'),
        infoid = $('#infoid').val(),
        title = $('#user').val(),
        level = $('#level').val(),
        content = UE.getEditor('content').getContent(),
        photo = $(".result"),
        cover = [],
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
            //return false;
        }
        if(!content || content == '<p><br/></p>'){
            layer.msg('请输入内容', {icon: 5});
            //return false;
        }
        if(level == 0){
            layer.msg('请选择频道', {icon: 5});
            //return false;
        }
        $.each(photo, function(k, v){
            var src = $(v).val();
            if(src){
                cover.push(src);
            }
        });
        if(cover.length != 3){
            layer.msg('请上传3个封面图片', {icon: 5});
            //return false; 
        }
        var data = {
            title:title,
            channel:level,
            cover:cover,
            content:content,
            type:type,
            id:infoid,
            goodsids:goodsids
        };
        var index = layer.load();
        $.ajax({
            url: '/open/manager/addPicPublic',
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