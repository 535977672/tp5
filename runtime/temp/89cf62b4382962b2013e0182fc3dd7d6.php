<?php /*a:2:{s:56:"D:\mf\pcnfctest\application\admin\view\info\index_1.html";i:1543368793;s:57:"D:\mf\pcnfctest\application\admin\view\public\layout.html";i:1542359974;}*/ ?>
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
<link href="/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<link href="/datatables/media/css/dataTables.jqueryui.min.css" rel="stylesheet" type="text/css">
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
		<table  id="exampless" class="display" style="width:100%">
           
        </table>
    </div>
</div>
<script type="text/javascript" src="/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/datatables/media/js/dataTables.jqueryui.min.js"></script>
<script type="text/javascript" src="/datatables/extensions/Select/js/dataTables.select.min.js"></script>
<script>
    var oTable;
	$(document).ready(function(){
        oTable = initTable();
        
        function initTable() {
            var table = $("#exampless").dataTable({
                "serverSide": true,
                "ajax": '/admin/info/index',
                "scrollY": "220px",//dt高度
                "lengthMenu": [
                    [4, 6, 8, -1],
                    [4, 6, 8, "All"]
                ],//每页显示条数设置
                "lengthChange": true,//是否允许用户自定义显示数量
                "bPaginate": true, //翻页功能
                "bFilter": false, //列筛序功能
                "searching": true,//本地搜索
                "ordering": true, //排序功能
                "Info": false,//页脚信息
                "autoWidth": true,//自动宽度
                "language": {
                    "lengthMenu": "_MENU_ 条记录每页",
                    "zeroRecords": "没有找到记录",
                    "info": "第 _PAGE_ 页 ( 总共 _PAGES_ 页 )",
                    "infoEmpty": "无记录",
                    "infoFiltered": "(从 _MAX_ 条记录过滤)",
                    "paginate": {
                        "first": "首页",
                        "previous": "上一页",
                        "next": "下一页",
                        "last": "尾页"
                    }
                },
                'select': true,
                columns: [
                    {"data": "id", "title": "ID", 'width':'20%'},
                    {"data": "title", "title": "标题", 'width':'20%'},
                    {"data": { _:"username", sort: "user_id"}, "title": "用户", 'width':'40%'},
                    {"data": null, "title": "内容", "orderable": false, 'width':'10%'},
                    {"data": null, "title": "表单", "orderable": false, 'width':'10%'}
                ],
                columnDefs: [
                    {
                        targets: 3,
                        data: null,
                        render: function (data, type, row) {
                            return row.content;
                        }
                    },
                    {
                        targets: 4,
                        data: null,
                        render: function (data, type, row) {
                            return '<input type="text" value="'+row.id+'" style="width:20px;">';
                        }
                    }
                ],
            });
            return table;
        }
        
	});

</script>
</body>
</html>