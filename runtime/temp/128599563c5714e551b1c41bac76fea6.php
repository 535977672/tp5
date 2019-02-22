<?php /*a:2:{s:51:"D:\mf\pcnfc\application\admin\view\tools\index.html";i:1541756597;s:53:"D:\mf\pcnfc\application\admin\view\public\layout.html";i:1542359974;}*/ ?>
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
				<h3>数据备份</h3>
				<h5>网站系统数据备份</h5>
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
			<li>数据备份功能根据你的选择备份全部数据或指定数据，导出的数据文件可用“数据恢复”功能或 phpMyAdmin 导入</li>
			<li>建议定期备份数据库</li>
		</ul>
	</div>
	<div class="flexigrid">
		<div class="mDiv">
			<div class="ftitle">
				<h3>数据库表列表</h3>
				<h5>(共<?php echo htmlentities($tableNum); ?>张表，共计<?php echo htmlentities($total); ?>)</h5>
			</div>
			<div title="刷新数据" class="pReload"><i class="fa fa-refresh"></i></div>
		</div>
		<div class="hDiv">
			<div class="hDivBox">
				<table cellspacing="0" cellpadding="0">
					<thead>
					<tr>
						<th class="sign" axis="col0">
							<div style="width: 24px;"><input type="checkbox" onclick="javascript:$('input[name*=tables]').prop('checked',this.checked);"></div>
						</th>
						<th align="left" abbr="article_title" axis="col3" class="">
							<div style="text-align: left; width: 200px;" class="">数据库表</div>
						</th>
						<th align="center" abbr="ac_id" axis="col4" class="">
							<div style="text-align: center; width: 50px;" class="">记录条数</div>
						</th>
						<th align="center" abbr="article_show" axis="col5" class="">
							<div style="text-align: center; width: 50px;" class="">占用空间</div>
						</th>
						<th align="center" abbr="article_time" axis="col6" class="">
							<div style="text-align: center; width: 100px;" class="">编码</div>
						</th>
						<th align="center" abbr="article_time" axis="col6" class="">
							<div style="text-align: center; width: 120px;" class="">创建时间</div>
						</th>
						<th align="center" abbr="article_time" axis="col6" class="">
							<div style="text-align: center; width: 200px;" class="">备份状态</div>
						</th>
						<th align="center" axis="col1" class="handle">
							<div style="text-align: center; width: 150px;">操作</div>
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
					<a onclick="gobackup();" id="ing_btn">
						<div class="add" title="数据备份">
							<span><i class="fa fa-book"></i><span id="export">数据备份</span></span>
						</div>
					</a>
				</div>
			</div>
			<div style="clear:both"></div>
		</div>
		<div class="bDiv" style="height: auto;">
			<div id="flexigrid" cellpadding="0" cellspacing="0" border="0">
				<form  method="post" id="export-form" action="<?php echo url('export'); ?>">
					<table>
						<tbody>
						<?php foreach($list as  $k=>$vo): ?>
							<tr data-id="<?php echo htmlentities($vo['Name']); ?>">
								<td class="sign">
									<div style="width: 24px;"><input type="checkbox" name="tables[]" value="<?php echo htmlentities($vo['Name']); ?>"></div>
								</td>
								<td align="left" class="">
									<div style="text-align: left; width: 200px;"><?php echo htmlentities($vo['Name']); ?></div>
								</td>
								<td align="center" class="">
									<div style="text-align: center; width: 50px;"><?php echo htmlentities($vo['Rows']); ?></div>
								</td>
								<td align="center" class="">
									<div style="text-align: center; width: 50px;"><?php echo htmlentities(format_bytes($vo['Data_length'])); ?></div>
								</td>
								<td align="center" class="">
									<div style="text-align: center; width: 100px;"><?php echo htmlentities($vo['Collation']); ?></div>
								</td>
								<td align="center" class="">
									<div style="text-align: center; width: 120px;"><?php echo htmlentities($vo['Create_time']); ?></div>
								</td>
								<td align="center" class="">
									<div style="text-align: center; width: 200px;" class="info">未备份</div>
								</td>
								<td align="center" class="handle">
									<div style="text-align: center; width: 170px; max-width:170px;">
										<a href="<?php echo url('Tools/optimize',array('tablename'=>$vo['Name'])); ?>" class="btn blue"><i class="fa fa-magic"></i>优化</a>
										<a class="btn green" href="<?php echo url('Tools/repair',array('tablename'=>$vo['Name'])); ?>"><i class="fa fa-wrench"></i>修复</a>
									</div>
								</td>
								<td align="" class="" style="width: 100%;">
									<div>&nbsp;</div>
								</td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
				</form>
			</div>
			<div class="iDiv" style="display: none;"></div>
		</div>
	</div>
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

	});

	(function($){
		var $form = $("#export-form"), $export = $("#export"), tables
		$export.click(function(){
			if($("input[name^='tables']:checked").length == 0){
				layer.alert('请选中要备份的数据表', {icon: 2});
				return false;
			}
			$export.addClass("disabled");
			$export.html("正在发送备份请求...");
			$.post(
					$form.attr("action"),
					$form.serialize(),
					function(data){
						if(data.status){
							tables = data.tables;
							$export.html(data.info + "开始备份，请不要关闭本页面！");
							backup(data.tab);
							window.onbeforeunload = function(){ return "正在备份数据库，请不要关闭！" }
						} else {
							layer.alert(data.info, {icon: 2});
							$export.removeClass("disabled");
							$export.html("立即备份");
						}
					},
					"json"
			);
			return false;
		});

		function backup(tab, status){
			status && showmsg(tab.id, "开始备份...(0%)");
			$.get($form.attr("action"), tab, function(data){
				if(data.status){
					showmsg(tab.id, data.info);
					if(!$.isPlainObject(data.tab)){
						$export.removeClass("disabled");
						$export.html("备份完成，点击重新备份");
						window.onbeforeunload = function(){ return null }
						return;
					}
					backup(data.tab, tab.id != data.tab.id);
				} else {
					$export.removeClass("disabled");
					$export.html("立即备份");
				}
			}, "json");
		}

		function showmsg(id, msg){
			$form.find("input[value=" + tables[id] + "]").closest("tr").find(".info").html(msg);
		}
	})(jQuery);
</script>
</body>
</html>