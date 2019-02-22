<?php /*a:1:{s:53:"D:\mf\pcnfc\application\admin\view\index\welcome.html";i:1542244715;}*/ ?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="/static/css/index.css" rel="stylesheet" type="text/css">
    <link href="/static/css/perfect-scrollbar.min.css" rel="stylesheet" type="text/css">
    <link href="/static/css/purebox.css" rel="stylesheet" type="text/css">
    <link href="/static/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/static/js/jquery.js"></script>
    <script type="text/javascript" src="/static/js/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/static/js/jquery.cookie.js"></script>
</head>
<style>
    .contentWarp_item .section_select .item_comment{
        padding: 83px 0 31px 38px;
    }
    .contentWarp_item .section_select .item {
        padding: 83px 0 38px 38px;
    }
    .contentWarp_item .section_order_select li{
        width: 23%;
    }
    .contentWarp_item .section_select .item_comment{
        padding: 83px 0 31px 38px;
    }
    .contentWarp_item .section_select .item {
        padding: 83px 0 38px 38px;
    }
    @media only screen and (min-width: 900px) and (max-width: 1761px) {
        .contentWarp_item{
            margin-right: 1%;
        }
        .contentWarp_item .section_select .icon img{
            max-width: 74px;
            max-height: 74px;
        }
        .contentWarp_item:nth-child(1){
            margin-bottom: 10px;
        }
    }
    @media only screen and (min-width: 900px) and (max-width: 1312px) {
        .contentWarp_item .section_select .item{
            width: 35%;
            margin-bottom: 10px;
        }

    }
    .icons{
        transition: all 0.3s;
        -webkit-transition: all 0.3s;
        -o-transition: all 0.3s;
        -moz-transition: all 0.3s;
    }
    .icons:hover{
        transform: scale(1.1) rotate(360deg);
        -webkit-transform: scale(1.1) rotate(360deg);
        -o-transform: scale(1.1) rotate(360deg);
        -moz-transform: scale(1.1) rotate(360deg);
    }
</style>
<body class="iframe_body">
<div class="warpper">
    <div class="title">管理中心</div>
    <div class="content start_content">
        <div class="contentWarp">
            <div class="contentWarp_item clearfix">
                <div class="section_select">
                    <div class="item item_price">
                        <i class="icon icons"><img src="/static/image/1.png" width="71" height="74"></i>
                        <div class="desc">
                            <div class="tit"><?php echo htmlentities($count['new_order']); ?></div>
                            <span>今日订单总数</span>
                        </div>
                    </div>
                    <div class="item item_order">
                        <i class="icon icons"><img src="/static/image/2.png"></i>
                        <div class="desc">
                            <div class="tit"><?php echo htmlentities($count['new_users']); ?></div>
                            <span>今日会员总数</span>
                        </div>
                        <i class="icon"></i>
                    </div>
                    <div class="item item_flow">
                        <i class="icon icons"><img src="/static/image/4.png" width="86"></i>
                        <div class="desc">
                            <div class="tit"><?php echo htmlentities($count['today_login']); ?></div>
                            <span>今日访问量</span>
                        </div>
                        <i class="icon"></i>
                    </div>
                </div>
            </div>
            <div class="contentWarp_item clearfix">
                <div class="section_order_select">
                    <ul>
                        <li>
                            <a href="<?php echo url('Admin/Order/index',array('order_status'=>0)); ?>">
                                <i class="ice ice_w icons"></i>
                                <div class="t">待处理订单</div>
                                <span class="number"><?php echo htmlentities($count['handle_order']); ?></span>
                            </a>
                        </li>
                        <li>
                            <a  href="<?php echo url('Admin/Goods/goodsList'); ?>">
                                <i class="ice ice_y icons"></i>
                                <div class="t">商品数量</div>
                                <span class="number"><?php echo htmlentities($count['goods']); ?></span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo url('Admin/Article/articleList'); ?>">
                                <i class="ice ice_f icons"></i>
                                <div class="t">文章数量</div>
                                <span class="number"><?php echo htmlentities($count['article']); ?></span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo url('Admin/User/index'); ?>">
                                <i class="ice ice_n icons"></i>
                                <div class="t">会员总数</div>
                                <span class="number"><?php echo htmlentities($count['users']); ?></span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="contentWarp">
            <div class="section system_section" style="float: none;width: inherit;">
                <div class="system_section_con">
                    <div class="sc_title" style="padding: 26px 0 14px;border-bottom: 1px solid #e4eaec;">
                        <i class="sc_icon"></i>
                        <h3>系统信息</h3>
                        <!--<span class="stop stop_jia" id="system_section" title="展开详情"></span>-->
                    </div>
                    <div class="sc_warp" id="system_warp" style="display: block;padding-bottom: 30px;">
                        <table cellpadding="0" cellspacing="0" class="system_table">
                            <tbody><tr>
                                <td class="gray_bg">服务器操作系统:</td>
                                <td><?php echo htmlentities($sys_info['os']); ?></td>
                                <td class="gray_bg">服务器域名/IP:</td>
                                <td><?php echo htmlentities($sys_info['domain']); ?> [ <?php echo htmlentities($sys_info['ip']); ?> ]</td>
                            </tr>
                            <tr>
                                <td class="gray_bg">服务器环境:</td>
                                <td><?php echo htmlentities($sys_info['web_server']); ?></td>
                                <td class="gray_bg">PHP 版本:</td>
                                <td><?php echo htmlentities($sys_info['phpv']); ?></td>
                            </tr>
                            <tr>
                                <td class="gray_bg">Mysql 版本:</td>
                                <td><?php echo htmlentities($sys_info['mysql_version']); ?></td>
                                <td class="gray_bg">GD 版本:</td>
                                <td><?php echo htmlentities($sys_info['gdinfo']); ?></td>
                            </tr>
                            <tr>
                                <td class="gray_bg">文件上传限制:</td>
                                <td><?php echo htmlentities($sys_info['fileupload']); ?></td>
                                <td class="gray_bg">最大占用内存:</td>
                                <td><?php echo htmlentities($sys_info['memory_limit']); ?></td>
                            </tr>
                            <tr>
                                <td class="gray_bg">最大执行时间:</td>
                                <td><?php echo htmlentities($sys_info['max_ex_time']); ?></td>
                                <td class="gray_bg">安全模式:</td>
                                <td><?php echo htmlentities($sys_info['safe_mode']); ?></td>
                            </tr>
                            <tr>
                                <td class="gray_bg">Zlib支持:</td>
                                <td><?php echo htmlentities($sys_info['zlib']); ?></td>
                                <td class="gray_bg">Curl支持:</td>
                                <td><?php echo htmlentities($sys_info['curl']); ?></td>
                            </tr>
                            </tbody></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="footer" style="position: static; bottom: 0px; font-size:14px;">
    <p><b>版权所有 © 2018-2028 <?php echo htmlentities((isset($tpshop_config['shop_info_store_name']) && ($tpshop_config['shop_info_store_name'] !== '')?$tpshop_config['shop_info_store_name']:'环球商城')); ?>，并保留所有权利</b></p>
</div>
<script type="text/javascript">
    $(function(){
        $("*[data-toggle='tooltip']").tooltip({
            position: {
                my: "left top+5",
                at: "left bottom"
            }
        });
    });
</script>
<script type="text/javascript" src="/static/js/jquery.purebox.js"></script>
<script type="text/javascript" src="/static/js/echart/echarts.min.js"></script>
<script type="text/javascript">

    var option = {
        title : {
            text: ''
        },
        tooltip : {
            trigger: 'axis',
            backgroundColor:"#f5fdff",
            borderColor:"#8cdbf6",
            borderRadius:"4",
            borderWidth:"1",
            padding:"10",
            textStyle:{
                color:"#272727",
            },
            axisPointer:{
                lineStyle:{
                    color:"#6cbd40",
                }
            }
        },
        toolbox: {
            show : true,
            orient:"vertical",
            x:"right",
            y:"60",
            feature : {
                magicType : {show: true, type: ['line', 'bar']},
                saveAsImage : {show: true}
            },
        },
        calculable : true,
        xAxis : [
            {
                type : 'category',
                boundaryGap : false,
                axisLine:{
                    lineStyle:{
                        color:"#ccc",
                        width:"0",
                    }
                },
                data : ['07-01','07-02','07-03','07-04','07-05','07-06','07-07']
            }
        ],
        yAxis : [
            {
                type : 'value',
                axisLine:{
                    lineStyle:{
                        color:"#ccc",
                        width:"0",
                    }
                },
                axisLabel : {
                    formatter: '{value}个',
                }
            }
        ],
        series : [
            {
                name:'订单个数',
                type:'line',
                itemStyle:{
                    normal:{
                        color:"#6cbd40",
                        lineStyle:{
                            color:"#6cbd40",
                        }
                    }
                },
                data:[0, 5, 8, 3, 10, 15, 2],
                markPoint : {
                    itemStyle:{
                        normal:{
                            color:"#6cbd40"
                        }
                    },
                    data : [
                        {type : 'max', name: '最大值'},
                        {type : 'min', name: '最小值'}
                    ]
                }
            }

        ]
    }
//    $("#system_section").click(function(){
//        $("#system_warp").slideDown();
//    });
</script>
</body>

</html>