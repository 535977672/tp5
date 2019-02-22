<?php /*a:1:{s:71:"D:\mf\pcnfc\application\admin\view\goods\ajax_goods_attribute_list.html";i:1543196953;}*/ ?>
<table>
       <tbody>
			<?php if(is_array($goodsAttributeList) || $goodsAttributeList instanceof \think\Collection || $goodsAttributeList instanceof \think\Paginator): $i = 0; $__LIST__ = $goodsAttributeList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
              <tr data-id="<?php echo htmlentities($list['attr_id']); ?>">
                <td class="sign" axis="col6">
                  <div style="width: 24px;"><i class="ico-check"></i></div>
                </td>			 
                <td align="center" axis="col0">
                  <div style="width: 50px;"><?php echo htmlentities($list['attr_id']); ?></div>
                </td>                
                <td align="center" axis="col0">
                  <div style="text-align: left; width: 100px;"><?php echo htmlentities($list['attr_name']); ?></div>
                </td>
                <td align="center" axis="col0">
                  <div style="text-align: center; width: 100px;"><?php echo htmlentities($goodsTypeList[$list['type_id']]); ?></div>
                </td>
                <td align="center" axis="col0">
                  <div style="text-align: center; width: 100px;"><?php echo htmlentities(mb_substr($list['attr_values'],0,30,'utf-8')); ?></div>
                </td> 
                <td align="center" axis="col0">
                  <div style="text-align: center; width: 50px;">
                    <?php if($list['attr_index'] == 1): ?>
                      <span class="yes" onClick="changeTableVal('goods_attribute','attr_id','<?php echo htmlentities($list['attr_id']); ?>','attr_index',this)" ><i class="fa fa-check-circle"></i>是</span>
                      <?php else: ?>
                      <span class="no" onClick="changeTableVal('goods_attribute','attr_id','<?php echo htmlentities($list['attr_id']); ?>','attr_index',this)" ><i class="fa fa-ban"></i>否</span>
                    <?php endif; ?>
                  </div>
                </td>                                
                <td align="center" axis="col0">                  
                <div style="text-align: center; width: 50px;">
                  <input type="text" onKeyUp="this.value=this.value.replace(/[^\d]/g,'')" onpaste="this.value=this.value.replace(/[^\d]/g,'')" onblur="changeTableVal('goods_attribute','attr_id','<?php echo htmlentities($list['attr_id']); ?>','order',this)" size="4" value="<?php echo htmlentities($list['order']); ?>" />
                </div>                  
                </td>  
                <td align="center" class="handle">
                  <div style="text-align: center; width: 170px; max-width:170px;">                   
                    <a class="btn red"  href="javascript:;" onclick="publicHandle(<?php echo htmlentities($list['attr_id']); ?>)"><i class="fa fa-trash-o"></i>删除</a>
                    <a href="<?php echo url('Admin/goods/addEditGoodsAttribute',array('attr_id'=>$list['attr_id'])); ?>" class="btn blue"><i class="fa fa-pencil-square-o"></i>编辑</a> 
                  </div>
                </td>                           
                <td align="" class="" style="width: 100%;">
                  <div>&nbsp;</div>
                </td>
              </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </tbody>
        </table>
        <!--分页位置--> <?php echo $goodsAttributeList; ?>
<script>
    // 点击分页触发的事件
    $(".pagination  a").click(function(){
        cur_page = $(this).data('p');
        ajax_get_table('search-form2',cur_page);
    });
 
</script>        