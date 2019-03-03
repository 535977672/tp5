<?php /*a:2:{s:50:"D:\mf\pcnfc\application\admin\view\info\index.html";i:1543221289;s:53:"D:\mf\pcnfc\application\admin\view\public\layout.html";i:1542359974;}*/ ?>
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
	<!-- 操作说明 -->
	<div id="explanation" class="explanation" style="color: rgb(44, 188, 163); background-color: rgb(237, 251, 248); width: 99%; height: 100%;">
		<div id="checkZoom" class="title"><i class="fa fa-lightbulb-o"></i>
			<h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
			<span title="收起提示" id="explanationZoom" style="display: block;"></span>
		</div>
		<ul>
			<li>开放平台发布资讯审核</li>
		</ul>
	</div>
	<div class="flexigrid">
		<div class="mDiv">
			<div class="ftitle">
				<h3>资讯列表</h3>
				<h5>(共<?php echo htmlentities($totalCount); ?>条记录)</h5>
			</div>
			<div title="刷新数据" class="pReload"><i class="fa fa-refresh"></i></div>
			<form class="navbar-form form-inline" action="<?php echo url('Info/index'); ?>" method="get">
				<div class="sDiv">
					<div class="sDiv2">
						<input type="text" size="30" name="keywords" class="qsbox" placeholder="搜索相关数据..."  value="<?php echo htmlentities(app('request')->get('keywords')); ?>">
						<input type="submit" class="btn" value="搜索">
					</div>
				</div>
			</form>
		</div>
		<div class="hDiv">
			<div class="hDivBox">
				<table cellspacing="0" cellpadding="0">
					<thead>
					<tr>
						<th class="sign" axis="col0">
							<div style="width: 24px;"><i class="ico-check"></i></div>
						</th>
						<th align="left" abbr="info_title" axis="col3" class="">
							<div style="text-align: left; width: 30px;" class="">ID</div>
						</th>
						<th align="left" abbr="info_name" axis="col4" class="">
							<div style="text-align: left; width: 50px;" class="">用户名</div>
						</th>
						<th align="left" abbr="info_type" axis="col4" class="">
							<div style="text-align: left; width: 50px;" class="">类型</div>
						</th>
						<th align="left" abbr="info_type" axis="col4" class="">
							<div style="text-align: left; width: 50px;" class="">状态</div>
						</th>
						<th align="left" abbr="info_type" axis="col4" class="">
							<div style="text-align: left; width: 100px;" class="">审核意见</div>
						</th>
						<th align="left" abbr="info_title" axis="col5" class="">
							<div style="text-align: left; width: 100px;" class="">标题</div>
						</th>
						<th align="left" abbr="info_content" axis="col6" class="">
							<div style="text-align: left; width: 200px;" class="">内容</div>
						</th>
						<th align="left" abbr="info_cover" axis="col6" class="">
							<div style="text-align: left; width: 50px;" class="">封面</div>
						</th>
						<th align="left" abbr="info_cover" axis="col6" class="">
							<div style="text-align: left; width: 100px;" class="">推荐商品</div>
						</th>
						<th align="left" abbr="info_cover" axis="col6" class="">
							<div style="text-align: left; width: 120px;" class="">创建时间</div>
						</th>
						<th align="center" axis="col1" class="handle">
							<div style="text-align: center; width: 50px;">操作</div>
						</th>
						<th style="width:100%" axis="col7">
							<div></div>
						</th>
					</tr>
					</thead>
				</table>
			</div>
		</div>
		<div class="tDiv">
			<div class="tDiv2">
				<div class="fbutton">
					<a href="javascript:;" data-url="<?php echo url('Info/status'); ?>" data-act="1" class="status">
						<div class="" title="审核通过">
							<span><i class="fa fa-check"></i>审核通过</span>
						</div>
					</a>
				</div>
				<div class="fbutton">
					<a href="javascript:;" data-url="<?php echo url('Info/status'); ?>"  data-act="2" class="status">
						<div class="" title="审核失败">
							<span><i class="fa fa-close"></i>审核失败</span>
						</div>
					</a>
				</div>
			</div>
			<div style="clear:both"></div>
		</div>
		<div class="bDiv" style="height: auto;">
			<div id="flexigrid" cellpadding="0" cellspacing="0" border="0">
				<table>
					<tbody>
					<?php foreach($list as $k=>$vo): ?>
						<tr>
							<td class="sign">
								<div style="width: 24px;"><i class="ico-check"></i></div>
							</td>
							<td align="left" class="">
								<div style="text-align: left; width: 30px;"><?php echo htmlentities($vo['id']); ?></div>
							</td>
							<td align="left" class="">
								<div style="text-align: left; width: 50px;"><?php echo htmlentities($vo['username']); ?></div>
							</td>
							<td align="left" class="">
								<div style="text-align: left; width: 50px;"><?php echo htmlentities($vo['typemsg']); ?></div>
							</td>
							<td align="left" class="">
								<div style="text-align: left; width: 50px;"><?php echo htmlentities($vo['statusmsg']); ?></div>
							</td>
							<td align="left" class="">
								<div style="text-align: left; width: 100px;"><?php echo htmlentities($vo['des']); ?></div>
							</td>
							<td align="left" class="">
                                <div style="text-align: left; width: 100px;"><a href="<?php echo url('Info/detail', ['id' => $vo['id']]); ?>"><?php echo htmlentities($vo['title']); ?></a></div>
							</td>
							<td align="left" class="">
								<div style="text-align: left; width: 200px;"><?php echo htmlentities($vo['content']); ?></div>
							</td>
							<td align="left" class="">
								<div style="text-align: left; width: 50px;"><img src="<?php echo htmlentities($vo['pic']); ?>" class="img-thumbnail" width="30" height="30"></div>
							</td>
							<td align="left" class="">
								<div style="text-align: left; width: 100px;"><?php echo htmlentities($vo['goods']); ?></div>
							</td>
							<td align="left" class="">
								<div style="text-align: left; width: 120px;"><?php echo htmlentities(date('Y-m-d H:i:s',!is_numeric($vo['create_time'])? strtotime($vo['create_time']) : $vo['create_time'])); ?></div>
							</td>
							<td align="center" class="handle">
								<div style="text-align: center; width: 50px; max-width:50px;">
									<a class="btn red"  href="javascript:void(0)" data-url="<?php echo url('Info/infoDel'); ?>" data-id="<?php echo htmlentities($vo['id']); ?>" onClick="delfun(this)"><i class="fa fa-trash-o"></i>删除</a>
								</div>
							</td>
							<td align="" class="" style="width: 100%;">
								<div>&nbsp;</div>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<div class="iDiv" style="display: none;"></div>
		</div>
		<!--分页位置-->
		<?php echo $list; ?> </div>
</div>
<script>
	$(document).ready(function(){
		// 表格行点击选中切换
		$('#flexigrid > table>tbody >tr').click(function(){
			$(this).toggleClass('trSelected');
		});

		// 点击刷新数据
		$('.fa-refresh').click(function(){
			location.href = location.href;
		});

		// 点击刷新数据
		$('.status').click(function(){
			statusChange($(this));
		});
        
        
        //选中全部
        $('.hDivBox .sign').click(function () {
            var sign = $('#flexigrid > table>tbody>tr');
            if ($(this).parent().hasClass('trSelected')) {
                sign.each(function () {
                    $(this).removeClass('trSelected');
                });
                $(this).parent().removeClass('trSelected');
            } else {
                sign.each(function () {
                    $(this).addClass('trSelected');
                });
                $(this).parent().addClass('trSelected');
            }
        });

	});


	function delfun(obj) {
		// 删除按钮
		layer.confirm('确认删除？', {
			btn: ['确定', '取消'] //按钮
		}, function () {
			$.ajax({
				type: 'post',
				url: $(obj).attr('data-url'),
				data : {id:$(obj).attr('data-id')},
				dataType: 'json',
				success: function (data) {
					if (data.status == 1) {
						layer.msg(data.msg,{icon: 1,time: 1000},function () {
							$(obj).parent().parent().parent().remove();
						});
					} else {
						layer.msg(data.msg,{icon: 2,time: 2000});
					}
				}
			});
		});
	}
    
    function statusChange(obj) {
        var o = $('#flexigrid > table>tbody >.trSelected');
        var id = '';
        if(o.length < 1){
            layer.msg('请选择数据',{icon: 2,time: 2000});
            return false;
        }
        $.each(o, function(k,v){
            id = id+','+$(v).find('td:nth-child(2)').text();
        });
        if(id){
            id = id.substr(1);
        }
		layer.prompt({
            formType: 2,
            title: '审核意见',
            area: ['400px', '200px'] //自定义文本域宽高
        }, function (value, index, elem) {
			$.ajax({
				type: 'post',
				url: $(obj).attr('data-url'),
				data : {act: $(obj).attr('data-act'), id: id, des: value},
				dataType: 'json',
				success: function (data) {
					if (data.status == 1) {
						location.reload();
					} else {
						layer.msg(data.msg,{icon: 2,time: 2000});
					}
				}
			});
            layer.close(index);
            return true;
		});
	}
</script>
</body>
</html>