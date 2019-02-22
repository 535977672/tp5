<?php /*a:1:{s:59:"D:\mf\pcnfc\application\admin\view\order\delivery_list.html";i:1542359974;}*/ ?>
<include file="public/layout" />
<script type="text/javascript" src="__ROOT__/public/static/js/layer/laydate/laydate.js"></script>

<body style="background-color: rgb(255, 255, 255); overflow: auto; cursor: default; -moz-user-select: inherit;">
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <div class="subject">
        <h3>发货单列表</h3>
        <h5>已发货订单列表</h5>
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
      <li>点击查看操作将显示订单（包括订单物品）的详细信息</li>
      <li>已发货订单列表</li>
    </ul>
  </div>
  <div class="flexigrid">
    <div class="mDiv">
      <div class="ftitle">
        <h3>发货单列表</h3>
        <h5>(共<?php echo htmlentities($page->totalRows); ?>条记录)</h5>
      </div>
      <div title="刷新数据" class="pReload"><i class="fa fa-refresh"></i></div>
    <form class="navbar-form form-inline"  method="post" action="<?php echo U('Order/ajax_delivery_list'); ?>"  name="search-form2" id="search-form2" onsubmit="return false">  
        <input type="hidden" name="order_by" value="order_id">
            <input type="hidden" name="sort" value="desc">
            <input type="hidden" name="user_id" value="<?php echo htmlentities(app('request')->param('user_id')); ?>">
            <!--用于查看结算统计 包含了哪些订单-->
            <input type="hidden" value="<?php echo htmlentities($_GET['order_statis_id']); ?>" name="order_statis_id" />
                                    
      <div class="sDiv">
        <div class="sDiv2">
          <input type="text" size="30" id="consignee"  name="consignee"  value="" class="qsbox"  placeholder="收货人">
        </div>
        <div class="sDiv2">
          <input type="text" size="30" id="order_sn" name="order_sn" value="" class="qsbox"  placeholder="订单编号">
        </div>
        <div class="sDiv2">  
          <select name="shipping_status" class="select" id="print_express" style="width:100px;margin-right:5px;margin-left:5px">
                    <option value="0">待发货</option>
                    <option value="1">已发货</option>
          <option value="2">部分发货</option>
            </select>
        </div>
        <div class="sDiv2">  
          <input type="button" onclick="ajax_get_table('search-form2',1)"  class="btn" value="搜索">
        </div>
      </div>
     </form>
    </div>
    <div class="hDiv">
      <div class="hDivBox" id="ajax_return">
        <table cellspacing="0" cellpadding="0">
          <thead>
            <tr>
                <th axis="col0">
                  <div style="width: 24px;"><i class="ico-check"></i></div>
                </th>
                <th align="left" abbr="order_sn" axis="col3" class="">
                  <div style="text-align: left; width: 140px;" class=""><a href="javascript:sort('order_sn');">订单编号</a></div>
                </th>
                <th align="left" abbr="add_time" axis="col4" class="">
                  <div style="text-align: left; width: 120px;" class=""><a href="javascript:sort('add_time');">下单时间</a></div>
                </th>
                <th align="left" abbr="consignee" axis="col4" class="">
                  <div style="text-align: left; width: 120px;" class="">收货人</div>
                </th>
                <th align="center" abbr="mobile" axis="col5" class="">
                  <div style="text-align: center; width: 100px;" class=""><a href="javascript:sort('mobile');">联系电话</a></div>
                </th>
                <th align="center" abbr="article_time" axis="col6" class="">
                  <div style="text-align: center; width: 60px;" class="">所选物流</div>
                </th>
                <th align="center" abbr="article_time" axis="col6" class="">
                  <div style="text-align: center; width: 60px;" class="">物流费用</div>
                </th>
                <th align="center" abbr="article_time" axis="col6" class="">
                  <div style="text-align: center; width: 120px;" class="">支付时间</div>
                </th>
                <th align="center" abbr="article_time" axis="col6" class="">
                  <div style="text-align: center; width: 80px;" class=""><a href="javascript:sort('total_amount');">订单总价</a></div>
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
      <div class="tDiv2" id="deliver">
        <div class="fbutton"> 
          <a href="javascript:void(0)" onclick="test(1);">
              <div class="add" title="选定行数据执行发货操作">
                <span><i class="fa fa-plus"></i>批量发货</span>
              </div>
            </a> 
          </div>
      </div>

      <div class="tDiv2">
        <div class="fbutton"> 
          <a href="javascript:void(0)" onclick="test(2);">
              <div class="add" title="选定行数据执行打印操作">
                <span><i class="fa fa-plus"></i>批量打印配货单</span>
              </div>
            </a> 
          </div>
      </div>

      <div class="tDiv2" id="express">
        <div class="fbutton"> 
          <a href="javascript:void(0)" onclick="test(3);">
              <div class="add" title="选定行数据执行打印操作">
                <span><i class="fa fa-plus"></i>批量打印快递单</span>
              </div>
            </a> 
          </div>
      </div>

            <div class="tDiv2">
                <div class="fbutton">
                    <a href="javascript:void(0)" onclick="test(4);">
                        <div class="add" title="选定行数据执行导出操作">
                            <span><i class="fa fa-plus"></i>批量导出发货商品列表</span>
                        </div>
                    </a>
                </div>
            </div>


      <div style="clear:both"></div>
    </div>
    <div class="bDiv" style="height: auto;">
      <div id="flexigrid" cellpadding="0" cellspacing="0" border="0">
        
      </div>
      <div class="iDiv" style="display: none;"></div>
    </div>
    <!--分页位置--> 
    </div>
</div>
<div style="display:none">
  <form id="delivery_batch" action="<?php echo U('Order/delivery_batch'); ?>" method="post">
    <input type="hidden" name="ids" id="ids" value="">
  </form>

  <form id="delivery_print" action="<?php echo U('Order/delivery_print'); ?>" method="post">
    <input type="hidden" name="print_ids" id="ids2" value="">
  </form>

  <form id="delivery_express" action="<?php echo U('Order/shipping_print_batch'); ?>" method="post">
    <input type="hidden" name="ids3" id="ids3" value="">
  </form>

    <form id="delivery_export" action="<?php echo U('Order/exportDeliveryGoods'); ?>" method="post">
        <input type="hidden" name="ids4" id="ids4" value="">
    </form>

</div>
<script type="text/javascript">
    $(document).ready(function(){ 
      
    // 点击刷新数据
    $('.fa-refresh').click(function(){
      location.href = location.href;
    });
    
    ajax_get_table('search-form2',1);
    
    $('.ico-check ' , '.hDivBox').click(function(){
      $('tr' ,'.hDivBox').toggleClass('trSelected' , function(index,currentclass){
          var hasClass = $(this).hasClass('trSelected');
          $('tr' , '#flexigrid').each(function(){
            if(hasClass){
              $(this).addClass('trSelected');
            }else{
              $(this).removeClass('trSelected');
            }
          });  
        });
    });
     
  });
    
    
 // ajax 抓取页面
    function ajax_get_table(tab,page){
        if($('#print_express').val()==1){
          $('#express').show();
          $('#deliver').hide();
        }else{
          $('#express').hide();
          $('#deliver').show();
        }

        cur_page = page; //当前页面 保存为全局变量
            $.ajax({
                type : "POST",
                url:"/index.php/Admin/order/ajaxdelivery/p/"+page,//+tab,
                data : $('#'+tab).serialize(),// 你的formid
                success: function(data){
                    $("#flexigrid").html('');
                    $("#flexigrid").append(data);

                                      // 表格行点击选中切换
                  $('#flexigrid > table>tbody >tr').click(function(){
                    $(this).toggleClass('trSelected');
                });
                }
            });
    }
  
 // 点击排序
    function sort(field)
    {
        $("input[name='order_by']").val(field);
        var v = $("input[name='sort']").val() == 'desc' ? 'asc' : 'desc';
        $("input[name='sort']").val(v);
        ajax_get_table('search-form2',cur_page);
    }

    function test(type){
      var ids='';
      $("tr[class='trSelected']").each(function(){ 
        ids+=$(this).attr('data-order-id')+',';
      }) 
      if(!ids){
        layer.msg('未选择订单', {icon: 2, time: 1000});
        return false;
      }

      //批量发货
      if(type==1){
        $('#ids').val(ids);
        $('#delivery_batch').submit();
      }

      //批量打印配货单
      if(type==2){
        $('#ids2').val(ids);
        $('#delivery_print').submit();
      }

      //批量打印快递单
      if(type==3){
        $('#ids3').val(ids);
        $('#delivery_express').submit();
      }

        //批量导出发货商品列表
        if(type==4){
            $('#ids4').val(ids);
            $('#delivery_export').submit();
        }
    }
</script>
</body>
</html>