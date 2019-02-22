<?php /*a:2:{s:51:"D:\mf\pcnfc\application\admin\view\info\detail.html";i:1543219648;s:53:"D:\mf\pcnfc\application\admin\view\public\layout.html";i:1542359974;}*/ ?>
<!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- Apple devices fullscreen -->
<meta name="apple-mobile-web-app-capable" content="yes">
<!-- Apple devices fullscreen -->
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<link href="/static/css/main.css" rel="stylesheet" type="text/css">
<link href="/static/css/pages.css" rel="stylesheet" type="text/css">
<link href="/static/font/css/font-awesome.min.css" rel="stylesheet" />
<!--[if IE 7]>
  <link rel="stylesheet" href="/static/font/css/font-awesome-ie7.min.css">
<![endif]-->
<link href="/static/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
<link href="/static/js/perfect-scrollbar.min.css" rel="stylesheet" type="text/css"/>
<style type="text/css">html, body { overflow: visible;}</style>
<script type="text/javascript" src="/static/js/jquery.js"></script>
<script type="text/javascript" src="/static/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="/static/layer/layer.js"></script><!-- 弹窗js 参考文档 http://layer.layui.com/-->
<script type="text/javascript" src="/static/js/admin.js"></script>
<script type="text/javascript" src="/static/js/jquery.validation.min.js"></script>
<script type="text/javascript" src="/static/js/common.js"></script>
<script type="text/javascript" src="/static/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="/static/js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="/static/bootstrap/js/jquery-3.3.1.min.js"></script>
<script src="/static/js/myFormValidate.js"></script>
<script src="/static/js/myAjax2.js"></script>
<script src="/static/js/global.js"></script>
    <script type="text/javascript">
    function delfunc(obj){
    	layer.confirm('确认删除？', {
    		  btn: ['确定','取消'] //按钮
    		}, function(){
    		    // 确定
   				$.ajax({
   					type : 'post',
   					url : $(obj).attr('data-url'),
   					data : {act:'del',del_id:$(obj).attr('data-id')},
   					dataType : 'json',
   					success : function(data){
						layer.closeAll();
   						if(data.status==1){
                            layer.msg(data.msg, {icon: 1, time: 2000},function(){
                                location.href = '';
//                                $(obj).parent().parent().parent().remove();
                            });
   						}else{
   							layer.msg(data, {icon: 2,time: 2000});
   						}
   					}
   				})
    		}, function(index){
    			layer.close(index);
    			return false;// 取消
    		}
    	);
    }

    function selectAll(name,obj){
    	$('input[name*='+name+']').prop('checked', $(obj).checked);
    }

    function delAll(obj,name){
    	var a = [];
    	$('input[name*='+name+']').each(function(i,o){
    		if($(o).is(':checked')){
    			a.push($(o).val());
    		}
    	})
    	if(a.length == 0){
    		layer.alert('请选择删除项', {icon: 2});
    		return;
    	}
    	layer.confirm('确认删除？', {btn: ['确定','取消'] }, function(){
    			$.ajax({
    				type : 'get',
    				url : $(obj).attr('data-url'),
    				data : {act:'del',del_id:a},
    				dataType : 'json',
    				success : function(data){
						layer.closeAll();
    					if(data == 1){
    						layer.msg('操作成功', {icon: 1});
    						$('input[name*='+name+']').each(function(i,o){
    							if($(o).is(':checked')){
    								$(o).parent().parent().remove();
    							}
    						})
    					}else{
    						layer.msg(data, {icon: 2,time: 2000});
    					}
    				}
    			})
    		}, function(index){
    			layer.close(index);
    			return false;// 取消
    		}
    	);
    }

    /**
     * 全选
     * @param obj
     */
    function checkAllSign(obj){
        $(obj).toggleClass('trSelected');
        if($(obj).hasClass('trSelected')){
            $('#flexigrid > table>tbody >tr').addClass('trSelected');
        }else{
            $('#flexigrid > table>tbody >tr').removeClass('trSelected');
        }
    }
    /**
     * 批量公共操作（删，改）
     * @returns {boolean}
     */
    function publicHandleAll(type){
        var ids = '';
        $('#flexigrid .trSelected').each(function(i,o){
//            ids.push($(o).data('id'));
            ids += $(o).data('id')+',';
        });
        if(ids == ''){
            layer.msg('至少选择一项', {icon: 2, time: 2000});
            return false;
        }
        publicHandle(ids,type); //调用删除函数
    }
    /**
     * 公共操作（删，改）
     * @param type
     * @returns {boolean}
     */
    function publicHandle(ids,handle_type){
        layer.confirm('确认当前操作？', {
                    btn: ['确定', '取消'] //按钮
                }, function () {
                    // 确定
                    $.ajax({
                        url: $('#flexigrid').data('url'),
                        type:'post',
                        data:{ids:ids,type:handle_type},
                        dataType:'JSON',
                        success: function (data) {
                            layer.closeAll();
                            if (data.status == 1){
                                layer.msg(data.msg, {icon: 1, time: 2000},function(){
                                    location.href = data.url;
                                });
                            }else{
                                layer.msg(data.msg, {icon: 2, time: 2000});
                            }
                        }
                    });
                }, function (index) {
                    layer.close(index);
                }
        );
    }
</script>  

</head>
<link href="/static/ueditor/third-party/video-js/video-js.min.css" rel="stylesheet" type="text/css"/>
<body style="background-color: rgb(255, 255, 255); overflow: auto; cursor: default; -moz-user-select: inherit;">
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page">
	<div class="fixed-bar">
		<div class="item-title">
			<div class="subject">
				<h3>资讯管理</h3>
				<h5>开放平台发布资讯管理</h5>
			</div>
		</div>
	</div>
	<div class="flexigrid">
		<div class="mDiv">
			<div class="ftitle">
				<h3>资讯详情</h3>
			</div>
		</div>
		<div class="bDiv" style="height: auto;">
			<div id="flexigrid" cellpadding="0" cellspacing="0" border="0">
				<table>
					<tbody>
						<tr>
							<td align="left" style="width: 33.33%;">
								<div style="text-align: left;">ID: <?php echo htmlentities($list['id']); ?></div>
							</td>
							<td align="left" style="width: 33.33%;">
								<div style="text-align: left;">用户名: <?php echo htmlentities($list['username']); ?></div>
							</td>
							<td align="left" style="width: 33.33%;">
								<div style="text-align: left;">类型: <?php echo htmlentities($list['typemsg']); ?></div>
							</td>
                        </tr>
                        <tr>
							<td align="left" style="width: 33.33%;">
								<div style="text-align: left;">状态: <?php echo htmlentities($list['statusmsg']); ?></div>
							</td>
							<td align="left" style="width: 33.33%;">
								<div style="text-align: left;">时间: <?php echo htmlentities(date('Y-m-d H:i:s',!is_numeric($list['create_time'])? strtotime($list['create_time']) : $list['create_time'])); ?></div>
							</td>
							<td align="left" style="width: 33.33%;">
								<div style="text-align: left;">审核意见: <?php echo htmlentities($list['des']); ?></div>
							</td>
                        </tr>
					</tbody>
				</table>
                <table>
					<tbody>
                        <tr>
							<td align="left" class="" style="width: 80px;">
								<div style="text-align: left;">标题:</div>
							</td>
							<td align="left" class="">
								<div style="text-align: left;"><?php echo htmlentities($list['title']); ?></div>
							</td>
                        </tr>
                        <tr style="height: auto;">
							<td align="left" class="" style="width: 80px;">
								<div style="text-align: left;">封面:</div>
							</td>
                            <td align="left" class="">
                                <?php foreach($list['cover'] as $p): ?>
                                <img src="<?php echo htmlentities($p); ?>" class="img-thumbnail" style="max-width: 300px;">
                                <?php endforeach; ?>
							</td>
                        </tr>
                        <tr>    
							<td align="left" class="" style="width: 80px;">
								<div style="text-align: left;">内容:</div>
							</td> 
							<td align="left" class="">
                                <?php if($list['type'] == 1): ?>
								<div style="max-width: 800px; height: max-content;"><?php echo $list['content']; ?></div>
                                <?php else: ?>
                                <video id="info_video" class="video-js vjs-default-skin" controls preload="none" width="640" height="264"  poster="<?php echo htmlentities($list['pic']); ?>">
                                    <source src="<?php echo htmlentities($list['video']); ?>" type="video/mp4">
                                </video>
                                <?php endif; ?>
							</td>
                        </tr>
                        <tr> 
							<td align="left" class="" style="width: 80px;">
								<div style="text-align: left;">商品:</div>
							</td>
							<td align="left" class="">
                                <table>
                                <?php if($list['goods']): foreach($list['goodss'] as $g): ?>
                                <tr style="height: 60px;"> 
                                    <a href='javascript:;'>
                                        <td align="left" style="width: 60px;"><div style="text-align: left;"><img src="<?php echo htmlentities($g['original_img']); ?>" class="img-thumbnail" width="50" height="50"></div></td>
                                        <td align="left" ><div style="text-align: left;"><?php echo htmlentities($g['goods_name']); ?></div></td>
                                    </a>
                                </tr>
                                <?php endforeach; endif; ?>
                                </table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="iDiv" style="display: none;"></div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/static/ueditor/third-party/video-js/video.js"></script>
</body>
</html>