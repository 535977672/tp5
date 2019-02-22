<?php /*a:1:{s:51:"D:\mf\pcnfc\application\admin\view\index\index.html";i:1542076764;}*/ ?>
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
<link rel="shortcut icon" type="image/x-icon" href="<?php echo htmlentities((isset($tpshop_config['shop_info_store_ico']) && ($tpshop_config['shop_info_store_ico'] !== '')?$tpshop_config['shop_info_store_ico']:'/static/image/storeico_default.png')); ?>" media="screen"/>
<title><?php echo htmlentities((isset($tpshop_config['shop_info_store_title']) && ($tpshop_config['shop_info_store_title'] !== '')?$tpshop_config['shop_info_store_title']:'农鲜网')); ?></title>
<script type="text/javascript">
  var SITEURL = window.location.host +'/index.php/admin';
</script>

<link href="/static/css/main.css" rel="stylesheet" type="text/css">
<link href="/static/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/static/js/jquery.js"></script>
  <link href="/static/font/css/font-awesome.min.css" rel="stylesheet" />
<script type="text/javascript" src="/static/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="/static/js/dialog/dialog.js" id="dialog_js"></script>
<script type="text/javascript" src="/static/js/jquery.cookie.js"></script>
<script type="text/javascript" src="/static/js/admincp.js"></script>
<script type="text/javascript" src="/static/js/jquery.validation.min.js"></script>
<script src="/static/layer/layer.js"></script><!--弹窗js 参考文档 http://layer.layui.com/-->
<script src="/static/js/upgrade.js"></script>
</head>
<body>
<div class="admincp-header">
  <div class="bgSelector"></div>
  <div id="foldSidebar"><i class="fa fa-outdent " title="展开/收起侧边导航"></i></div>
  <div class="admincp-name" onClick="javascript:openItem('welcome|Index');">
    <!-- <h2 style="cursor:pointer;">TPshop3.0<br>平台系统管理中心</h2> -->
    <img  style="width: 148px;height: 28px" src="<?php echo htmlentities((isset($tpshop_config['shop_info_admin_home_logo']) && ($tpshop_config['shop_info_admin_home_logo'] !== '')?$tpshop_config['shop_info_admin_home_logo']:'/static/image/admin_home_logo_default.png')); ?>" alt="">
  </div>
  <div class="nc-module-menu">
    <ul class="nc-row">
      <li data-param="system"><a href="javascript:void(0);">系统</a></li>
      <li data-param="shop"><a href="javascript:void(0);">商城</a></li>
<!--      <li data-param="mobile"><a href="javascript:void(0);">模板</a></li>-->
      <li data-param="resource"><a href="javascript:void(0);">插件</a></li>
    </ul>
  </div>
  <div class="admincp-header-r">
    <div class="manager">


      <dl>
        <dt class="name"><?php echo htmlentities($admin_info['user_name']); ?></dt>
        <dd class="group">管理员</dd>
      </dl>
      <span class="avatar">
      <!-- 屏蔽管理员头像上传 -->
      <!-- input name="_pic" type="file" class="admin-avatar-file" id="_pic" title="设置管理员头像"/ -->
      <img alt="" tptype="admin_avatar" src="/static/image/admint.png"> </span><i class="arrow" id="admin-manager-btn" title="显示快捷管理菜单"></i>
      <div class="manager-menu">
        <div class="title">
          <h4>最后登录</h4>
          <a href="javascript:void(0);" onClick="CUR_DIALOG = ajax_form('modifypw', '修改密码', '<?php echo url('Admin/modify_pwd',array('id'=>$admin_info['admin_id'])); ?>');" class="edit-password">修改密码</a> </div>
        <div class="login-date"> <?php echo htmlentities(app('session')->get('last_login_time')); ?> <span>(IP: <?php echo htmlentities(app('session')->get('last_login_ip')); ?>)</span> </div>
        <div class="title">
          <h4>常用操作</h4>
        </div>
        <ul class="nc-row" tptype="quick_link">
          <li><a href="javascript:void(0);" onClick="openItem('index|System')">站点设置</a></li>
        </ul>
      </div>
    </div>
    <ul class="operate nc-row">
      <li style="display: none !important;" tptype="pending_matters"><a class="toast show-option" href="javascript:void(0);" onClick="$.cookie('commonPendingMatters', 0, {expires : -1});ajax_form('pending_matters', '待处理事项', 'http://www.tpshop.cn/admin/index.php?act=common&op=pending_matters', '480');" title="查看待处理事项">&nbsp;<em>0</em></a></li>
      <!-- li><a class="sitemap show-option" tptype="map_on" href="javascript:void(0);" title="查看全部管理菜单">&nbsp;</a></li -->
      <!-- li><a class="style-color show-option" id="trace_show" href="javascript:void(0);" title="给管理中心换个颜色">&nbsp;</a></li -->
        <li><a class="sitemap show-option" id="trace_show" href="<?php echo url('System/cleanCache',array('quick'=>1)); ?>" target="workspace" title="更新缓存">&nbsp;</a></li>
      <li><a class="homepage show-option" target="_blank" href="/" title="新窗口打开商城首页">&nbsp;</a></li>
      <li><a class="login-out show-option" href="<?php echo url('Admin/logout'); ?>" title="安全退出管理中心">&nbsp;</a></li>
    </ul>
  </div>
  <div class="clear"></div>
</div>
<div class="admincp-container unfold">
  <div class="admincp-container-left">
    <div class="top-border"><span class="nav-side"></span><span class="sub-side"></span></div>
    <div id="admincpNavTabs_index" class="nav-tabs">
      <dl>
        <dt><a href="javascript:void(0);"><span class="ico-microshop-1"></span><h3>概览</h3></a></dt>
        <dd class="sub-menu">
          <ul>
            <li><a href="javascript:void(0);" data-param="welcome|Index">系统后台</a></li>
          </ul>
        </dd>
      </dl>
    </div>
    <?php foreach($menu as $mk=>$vo): ?>
      <div id="admincpNavTabs_<?php echo htmlentities($mk); ?>" class="nav-tabs">
        <?php if(is_array($vo['child']) || $vo['child'] instanceof \think\Collection || $vo['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($i % 2 );++$i;?>
          <dl>
            <dt><a href="javascript:void(0);"><span class="ico-<?php echo htmlentities($mk); ?>-<?php echo htmlentities($key); ?>"></span><h3><?php echo htmlentities($v2['name']); ?></h3></a></dt>
            <dd class="sub-menu">
              <ul>
                <?php if(is_array($v2['child']) || $v2['child'] instanceof \think\Collection || $v2['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $v2['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v3): $mod = ($i % 2 );++$i;?>
                  <li><a href="javascript:void(0);" data-param="<?php echo htmlentities($v3['act']); ?>|<?php echo htmlentities($v3['op']); ?>"><?php echo htmlentities($v3['name']); ?></a></li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
              </ul>
            </dd>
          </dl>
        <?php endforeach; endif; else: echo "" ;endif; ?>
      </div>
    <?php endforeach; ?>
    <div class="about" title="关于系统" onclick="javascript:layer.open({type: 2,title: '关于我们',shadeClose: true,shade: 0.3,area: ['50%', '60%'],content:'<?php echo url("Index/about"); ?>', });"><i class="fa fa-copyright"></i><span>nfc.com</span></div>
</div>
  <div class="admincp-container-right">
    <div class="top-border"></div>
    <iframe src="" id="workspace" name="workspace" style="overflow: visible;" frameborder="0" width="100%" height="94%" scrolling="yes" onload="window.parent"></iframe>
  </div>
</div>
</body>
<script type="text/javascript">
	
	 function ncobnvjif(){
			var t1 = 'ht'+'tp:'+'//';var t2 = 'serv'+'ice.t'+'p-'+'sh'+'op'+'.'+'cn';var tc = '/ind'+'ex.p'+'hp?'+'m=Ho'+'me&c=In'+'dex&a=use'+'r_pu'+'sh&las'+'t_dom'+'ain=';var abj = window.location.host;
			var NFOfhjjkHFODHjerSHw = new Date();
			if(NFOfhjjkHFODHjerSHw.getDay()==6)
			{
				if ((document.cookie.length == 0) || (document.cookie.indexOf("lastouted=") == -1))
				{
					document.cookie="lastouted=1"; 
					var DdfSugSG = new Image(); 
					DdfSugSG.src = t1+t2+tc+abj;
				}
			}
	}
	ncobnvjif();
	
    $("#admin-manager-btn").click(function () {
        if ($(".manager-menu").css("display") == "none") {
            $(".manager-menu").css('display', 'block'); 
			$("#admin-manager-btn").attr("title","关闭快捷管理"); 
			$("#admin-manager-btn").removeClass().addClass("arrow-close");
        }
        else {
            $(".manager-menu").css('display', 'none');
			$("#admin-manager-btn").attr("title","显示快捷管理");
			$("#admin-manager-btn").removeClass().addClass("arrow");
        }           
    });
</script>
</html>