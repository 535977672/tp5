$(document).ready(function () {

    /*左侧菜单栏*/
    $(".menu_list ul li .div1").show();
    //绑定元素点击事件
    $(".menu_list ul li:nth-child(2)").click(function () {
        //判断对象是显示还是隐藏
        if ($(this).children(".div1").is(":hidden")) {
            //表示隐藏
            if (!$(this).children(".div1").is(":animated")) {
                $(this).children(".xiala").css({'transform': 'rotate(180deg)'});
                //如果当前没有进行动画，则添加新动画
                $(this).children(".div1").animate({
                    height: 'show'
                }, 500)
                //siblings遍历div1的元素
                    .end().siblings().find(".div1").hide(500);
            }
        } else {
            //表示显示
            if (!$(this).children(".div1").is(":animated")) {
                $(this).children(".xiala").css({'transform': 'rotate(360deg)'});
                $(this).children(".div1").animate({
                    height: 'hide'
                }, 500)
                    .end().siblings().find(".div1").hide(500);
            }
        }
    });

    //阻止事件冒泡，子元素不再继承父元素的点击事件
    $('.div1').click(function (e) {
        e.stopPropagation();
    });

    //点击子菜单为子菜单添加样式，并移除所有其他子菜单样式
    $(".menu_list ul li .div1 .zcd").click(function () {
        //设置当前菜单为选中状态的样式，并移除同类同级别的其他元素的样式
        $(this).addClass("removes").siblings().removeClass("removes");
        //遍历获取所有父菜单元素
        $(".div1").each(function () {
            //判断当前的父菜单是否是隐藏状态
            if ($(this).is(":hidden")) {
                //如果是隐藏状态则移除其样式
                $(this).children(".zcd").removeClass("removes");
            }
        });
    });

    /*主页*/
    $(".right-cont .home .home-btn-wrapper .home-btn").mouseenter(function () {
        $(".home-btn ul").animate({height: "80px"}, 200)
    })
    $(".right-cont .home .home-btn-wrapper .home-btn").mouseleave(function () {
        $(".home-btn ul").animate({height: "0"}, 200)
    })
    var leftHeight = $(".right-cont").height();
    $(".leftMenu").height(leftHeight);
});

/*添加商品*/
function chooseThis(obj) {
    var chooseList = $(obj).parent();
    var chooseAlready = $(".choose-already");
    chooseList.appendTo(chooseAlready);
    chooseList.addClass("card-list").removeClass("list-group-item");
    chooseList.children(".choose-add").hide();
    chooseList.find(".choose-list-img").hide();
    chooseList.append("<div class='close-card glyphicon glyphicon-remove' onclick='closeCard(this)'></div>")
    chooseList.css("display","none");
    chooseList.fadeIn(1000);
}
function closeCard(e) {
    var cardList = $(e).parent();
    var chooseListGroup = $(".choose-list-group");
    cardList.appendTo(chooseListGroup);
    cardList.addClass("list-group-item").removeClass("card-list");
    cardList.children(".choose-add").show();
    cardList.find(".choose-list-img").show();
    cardList.find(".close-card").remove();
    cardList.css("display","none");
    cardList.fadeIn(1000);
}
function chooseSub() {
    var chooseAlready = $(".choose-already").children();
    var chooseProList = $(".choose-pro-list");
    chooseAlready.appendTo(chooseProList);
    chooseAlready.addClass("list-group-item").removeClass("card-list");
    chooseAlready.find(".choose-list-img").show();
    chooseAlready.css("display","none");
    chooseAlready.fadeIn(1000);
    chooseAlready.children(".close-card").removeAttr("onclick").attr("onclick","closeProList(this);");
}
function closeProList(a){
    $(a).parent().remove();
}

/**
 * 搜索商品
 */
function chooseSearch(){
    var key = $('#goodsSearch').val(),
    page = 1;
    chooseSearchDo(key, page);
    $('#goodsSearch').attr('data-key', key);
}

/**
 * 搜索商品文档创建
 */
function chooseSearchHtml(data){
    var html = '';
    if(data){
        $.each(data, function(k, v){
            html += '<li class="choose-list list-group-item">'
                        +'<a href="javascript:;"  target="_blank" class="chooseCard">'
                            +'<img src="'+v.original_img+'" alt="" class="choose-list-img">'
                            +'<p>'+v.goods_name+'</p>'
                            +'<input type="hidden" class="chooseGoodsId" value="'+v.goods_id+'">'
                            +'<div class="clearfix"></div>'
                        +'</a>'
                        +'<div class="choose-add glyphicon glyphicon-plus" onclick="chooseThis(this)"></div>'
                        +'<div class="clearfix"></div>'
                    +'</li>';
        });
    }
    return html;
}

/**
 * 搜索商品分页点击事件
 */
function chooseSearchPage(){
    $('.list-page a').on('click', function(){
        var key = $('#goodsSearch').attr('data-key'),
        href = $(this).attr('href'),
        page = href.substr(href.indexOf('=')+1);
        chooseSearchDo(key, page); 
        return false;
    });
}

function chooseSearchDo(key, page){
    var index = layer.load();
    var list = $('.choose-list-group');
    $.get('/open/manager/getGoods',{key: key, page: page},function (re) {
        layer.close(index);
        if (re.status === 0) {
            var html = '',
            data = re.data.list.data;
            html = chooseSearchHtml(data);
            list.html(html);
            $('.list-page').html(re.data.page);
            chooseSearchPage();
        }else{
            layer.msg(re.msg, {icon: 5});
        }
    });
}




/*视频上传*/
function filechange() {
    var video = event.target.files[0];  //选择的文件
    var reader = new FileReader();
    var rs = reader.readAsDataURL(video);
    reader.onload = function (e) {
        var dataBase64 = e.target.result; //result是你读取到的文件内容，此属性读取完成才能使用
        $(".videoBase").html(dataBase64)
        //dataBase64即为图片转码后的base64数据
        if ($('.video-img').attr('src') == '/static/image/a10.png') {
            $('.video-img').attr('src', '/static/image/a9.png');
        } else {
            $('.video-img').attr('src', '/static/image/a10.png');
        }
        var str = $("#videoInput").val();
        if (str !== "") {
            var arr = str.split("\\");
            var file_name = arr[arr.length - 1];
            $(".video-name").text(file_name);
        }
    }
}


/*资讯管理*/
$(document).ready(function () {
    $(".info_state li").click(function () {
        var o = $(this),
        status = o.attr('data-s'),
        url = '/open/manager/infomana',
        data = {status: status};
        if(o.hasClass('active')){
            return false;
        }
        o.addClass("active");
        o.siblings().removeClass("active");
        if(status == 1001){
            data = {};
        }
        if(status == 1002){
            data = {plus: 1};
        }
        $.get(url,data,function (re) {
                if (re.status === 0) {
                    var html = '',
                    list = re.data.list.data,
                    page = re.data.page;
                    if(list){
                        $.each(list, function(k, info){
                            html += '<div class="info-list-box">'
                                +'<div class="info-list-left">'
                                    +'<div class="info-title"><a href="javascript:;">'+info.title+'</a></div>'
                                    +'<ul class="nav nav-pills info-label">'
                                        +'<li>'+info.statusmsg+'</li>'
                                        +'<li>'+info.typemsg+'</li>'
                                        +'<li>'+info.name+'</li>'
                                        +'<li>阅读<span>'+info.view+'</span></li>'
                                        +'<li>评论<span>'+info.comment+'</span></li>'
                                        +'<li>'+info.create_time+'</li>'
                                    +'</ul>';
                                    if(!!info.des){
                                        html += '<ul class="nav nav-pills info-label">'
                                                    +'<li>'+info.des+'</li>'
                                                +'</ul>';
                                    }
                                    html += '<div class="articles-card-btns" id="infoOptions" data-id="'+info.id+'">';
                                    if(info.status != 1){
                                        html += '<button type="button" data-type="1" data-t="'+info.type+'" class="btn btn-default glyphicon glyphicon-pencil info-mana-btn">修改</button>';
                                    }
                                    html += '<button type="button" data-type="2" data-t="'+info.type+'" class="btn btn-default glyphicon glyphicon-open info-mana-btn">置顶</button>'
                                        +'<button type="button" data-type="3" data-t="'+info.type+'" class="btn btn-default glyphicon glyphicon-trash info-mana-btn">删除</button>'
                                    +'</div>'
                                +'</div>'
                                +'<div class="info-list-right">'
                                    +'<img src="'+info.pic+'" alt="cover">'
                                +'</div>'
                                +'<div class="clearfix"></div>'
                            +'</div>';
                        });
                    }
                    if(page){
                        html += '<div class="col-sm-12 text-center">'+page+'</div>';
                    }
                    $('#info-list-box').html(html);
                    infoOptions();
                }else{
                    layer.msg(re.msg, {icon: 5});
                }
            },'json'
        );
    });
});


/*评论管理*/
function  replyMore(obj) {
    var o = $(obj).siblings(".reply-more");
    if(o.is(":hidden")){
        o.fadeIn(700);
    }else{
        o.fadeOut(700);
    }
}

/*评论删除*/
function  delComment(obj) {
    var id = $(obj).attr("data-id");
    var index = layer.load();
    $.post('/open/manager/delComment',{id:id},function (re) {
            layer.close(index);
            if (re.status === 0) {
                //删除成功
                layer.msg(re.msg, {icon: 6});
                
            }else{
                layer.msg(re.msg, {icon: 5});
            }
        }
    );
}

/**
 * 资讯回复评论
 */
function infoAddComment(obj){
    var oT = $(obj).siblings('textarea'),
    infoid = oT.attr('data-infoid'),
    commentid = oT.attr('data-id'),
    content = oT.val();
    if(!infoid || !commentid){
        layer.msg('参数错误', {icon: 5});
        return false;
    }
    if(!content){
        layer.msg('请输入评论信息', {icon: 5});
        return false;
    }
    $(obj).addClass('disabled');
    var index = layer.load();
    var data = {
        info_id: infoid,
        id: commentid,
        content: content
    };
    $.ajax({
        url: '/open/manager/addComment',
        type: 'post',
        data: data,
        dataType: 'json',
        success: function (data) {
            $(obj).removeClass('disabled');
            layer.close(index);
            if (data.status === 0) {
                layer.msg(data.msg, {icon: 6});
                var re = oT.parent('.reply-more');
                re.fadeOut(700);
                re.before('<div class="comment-cont col-sm-11"><p>'+content+'</p></div>');
            }else{
                layer.msg(data.msg, {icon: 5});
            }
        },
        error: function(data ){
            console.log(data);
        }
    });
}
  
/**
 * 资讯加载评论
 */
function infoGetComment(obj){
    var obj = $(obj),
    infoid = obj.attr('data-infoid'),
    pid = obj.attr('data-pid'),
    page =  parseInt(obj.attr('data-page'))+1;
    obj.addClass('disabled');
    var index = layer.load();
    var data = {
        infoid: infoid,
        pid: pid,
        page: page
    };
    $.ajax({
        url: '/open/manager/getComment',
        type: 'get',
        data: data,
        dataType: 'json',
        success: function (data) {
            layer.close(index);
            obj.removeClass('disabled');
            if (data.status === 0) {
                var comments = data.data.comments;
                if(comments){
                    obj.attr('data-page', page);
                    obj.parents('.comment-list-more').before(comments);
                }else{
                    layer.msg('已全部加载', {icon: 5});
                }
            }else{
                layer.msg(data.msg, {icon: 5});
            }
        }
    });
}  

/**
 * 资讯加载评论
 */
function commentMana(obj){
    var obj = $(obj),
    page =  parseInt(obj.attr('data-page'))+1;
    var data = {
        page: page
    };
    obj.addClass('disabled');
    var index = layer.load();
    $.ajax({
        url: '/open/manager/commentMana',
        type: 'get',
        data: data,
        dataType: 'json',
        success: function (data) {
            obj.removeClass('disabled');
            layer.close(index);
            if (data.status === 0) {
                var list = data.data.list;
                if(list){
                    obj.attr('data-page', page);
                    obj.parents('.comment-list-more').before(list);
                }else{
                    layer.msg('已全部加载', {icon: 5});
                }
            }else{
                layer.msg(data.msg, {icon: 5});
            }
        }
    });
}  


/**
 * 资讯的修改/置顶/删除
 */
function infoOptions(){
    $('#infoOptions button').on('click', function(){
        var o = $(this),
        id = o.parent().attr('data-id'),
        type = o.attr('data-type'),
        t = o.attr('data-t'),
        ts = 'pic',
        url = '',
        data = {id: id};
        if(!id){
            layer.msg('ID信息错误', {icon: 5});
            return false;
        }
        if(type == 1){
            if(t == 2) ts = 'video';
            if(t == 1) ts = 'pic';
            window.location.href='/open/manager/'+ts+'public?id='+id;
            return true;
        }
        if(type == 2){
            url = '/open/manager/infotop';
        }
        if(type == 3){
            url = '/open/manager/infodel';
        }
        o.addClass('disabled');
        var index = layer.load();
        $.post(url,data,function (re) {
                o.removeClass('disabled');
                layer.close(index);
                if (re.status === 0) {
                    layer.msg(re.msg, {icon: 6});
                    if(type == 2){
                        location.reload();
                    }else{
                        o.parents('.info-list-box').remove();
                    }
                }else{
                    layer.msg(re.msg, {icon: 5});
                }
            }
        );
    });
}


/**
 * 专家定制删除
 */
function cusOptions(){
    $('#cusOptions').on('click', function(){
        var o = $(this),
        id = o.attr('data-id'),
        url = '/open/manager/delCustomize',
        data = {id: id};
        if(!id){
            layer.msg('ID信息错误', {icon: 5});
            return false;
        }
        var index = layer.load();
        $.post(url,data,function (re) {
                layer.close(index);
                if (re.status === 0) {
                    layer.msg(re.msg, {icon: 6});
                    location.reload();
                }else{
                    layer.msg(re.msg, {icon: 5});
                }
            }
        );
    });
}    
/*账户信息*/
