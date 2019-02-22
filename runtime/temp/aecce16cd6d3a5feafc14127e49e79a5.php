<?php /*a:2:{s:59:"D:\mf\pcnfc\application\admin\view\admin\supplier_info.html";i:1542274665;s:53:"D:\mf\pcnfc\application\admin\view\public\layout.html";i:1542359974;}*/ ?>
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
<body style="background-color: #FFF; overflow: auto;">
<div id="toolTipLayer" style="position: absolute; z-index: 9999; display: none; visibility: visible; left: 95px; top: 573px;"></div>
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page">
    <div class="fixed-bar">
        <div class="item-title"><a class="back" href="javascript:history.back();" title="返回列表"><i class="fa fa-arrow-circle-o-left"></i></a>
            <div class="subject">
                <h3>供应商管理 - 编辑供应商</h3>
                <h5>网站系统供应商管理</h5>
            </div>
        </div>
    </div>
    <form class="form-horizontal" id="suppliersHandle" action="<?php echo url('Admin/supplierHandle'); ?>" method="post">
        <input type="hidden" name="act" value="<?php echo htmlentities($act); ?>">
        <input type="hidden" name="suppliers_id" value="<?php echo htmlentities((isset($info['suppliers_id']) && ($info['suppliers_id'] !== '')?$info['suppliers_id']: '')); ?>">
        <div class="ncap-form-default">
            <dl class="row">
                <dt class="tit">
                    <label for="suppliers_name"><em>*</em>供应商名称</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="suppliers_name" value="<?php echo htmlentities((isset($info['suppliers_name']) && ($info['suppliers_name'] !== '')?$info['suppliers_name']: '')); ?>" id="suppliers_name" class="input-txt">
                    <span class="err"></span>
                    <p class="notic">供应商名称</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="suppliers_desc"><em>*</em>供应商描述</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="suppliers_desc" value="<?php echo htmlentities((isset($info['suppliers_desc']) && ($info['suppliers_desc'] !== '')?$info['suppliers_desc']: '')); ?>" id="suppliers_desc" class="input-txt">
                    <span class="err"></span>
                    <p class="notic">供应商描述</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="suppliers_contacts"><em>*</em>供应商联系人</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="suppliers_contacts" value="<?php echo htmlentities((isset($info['suppliers_contacts']) && ($info['suppliers_contacts'] !== '')?$info['suppliers_contacts']: '')); ?>" id="suppliers_contacts" class="input-txt">
                    <span class="err"></span>
                    <p class="notic">供应商联系人</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="suppliers_phone"><em>*</em>供应商电话</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="suppliers_phone" value="<?php echo htmlentities((isset($info['suppliers_phone']) && ($info['suppliers_phone'] !== '')?$info['suppliers_phone']: '')); ?>" id="suppliers_phone" class="input-txt">
                    <span class="err"></span>
                    <p class="notic">供应商电话</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="admin_id"><em>*</em>分配管理员账号</label>
                </dt>
                <dd class="opt">
                    <select name="admin_id" id="admin_id">
                        <option value="">选择管理员</option>
                        <?php if(is_array($admin) || $admin instanceof \think\Collection || $admin instanceof \think\Paginator): $i = 0; $__LIST__ = $admin;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo htmlentities($item['admin_id']); ?>" <?php if($info != ''): if($item['admin_id'] == $info['admin']['admin_id']): ?> selected="selected"<?php endif; endif; ?>><?php echo htmlentities($item['user_name']); ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <span class="err"></span>
                    <p class="notic">所属管理员</p>
                </dd>
            </dl>
            <div class="bot"><a href="JavaScript:void(0);" onclick="adsubmit();" class="ncap-btn-big ncap-btn-green" id="submitBtn">确认提交</a></div>
        </div>
    </form>
</div>
<script type="text/javascript">
    function adsubmit(){
        if($('input[name=suppliers_name]').val() == ''){
            layer.msg('供应商名称不能为空！', {icon: 2,time: 1000});   //alert('少年，用户名不能为空！');
            return false;
        }
        if($('input[name=suppliers_desc]').val() == ''){
            layer.msg('供应商描述不能为空！', {icon: 2,time: 1000});
            return false;
        }
        if($('input[name=suppliers_contacts]').val() == ''){
            layer.msg('供应商联系人不能为空！', {icon: 2,time: 1000});
            return false;
        }
        if($('input[name=suppliers_phone]').val() == ''){
            layer.msg('供应商电话不能为空！', {icon: 2,time: 1000});
            return false;
        }
        var phone = $('input[name=suppliers_phone]').val();
        var str = /^((0\d{2,3}-\d{7,8}))|([1](([3][0-9])|([4][5,7,9])|([5][^4])|([6][6])|([7][3,5,6,7,8])|([8][0-9])|([9][8,9]))[0-9]{8})$/;
        if (!str.test(phone)) {
            layer.msg('供应商电话格式错误！', {icon: 2,time: 1000});
            $('input[name=suppliers_phone]').focus();
            return false;
        }
        $('#suppliersHandle').submit();
    }
</script>
</body>
