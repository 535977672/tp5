<?php /*a:1:{s:60:"D:\mf\pcnfc\application\admin\view\goods\ajax_spec_list.html";i:1543220231;}*/ ?>
<table>
       <tbody>
			<?php if(is_array($specList) || $specList instanceof \think\Collection || $specList instanceof \think\Paginator): $i = 0; $__LIST__ = $specList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
              <tr data-id="<?php echo htmlentities($list['id']); ?>">
                <td class="sign" axis="col6" >
                  <div style="width: 24px;"><i class="ico-check"></i></div>
                </td>			 
                <td align="center" axis="col0">
                  <div style="width: 50px;"><?php echo htmlentities($list['id']); ?></div>
                </td>                
                <td align="center" axis="col0">
                  <div style="text-align: left; width: 100px;"><?php echo htmlentities($list['name']); ?></div>
                </td>
                <td align="center" axis="col0">
                  <div style="text-align: center; width: 100px;"><?php echo htmlentities($goodsTypeList[$list['type_id']]['name']); ?></div>
                </td>
                <td align="center" axis="col0">
                  <div style="text-align: left; width: 300px;"><?php echo htmlentities($list['spec_item']); ?></div>
                </td>               
                <td align="center" axis="col0">
                  <div style="text-align: center; width: 50px;">
                    <?php if($list['search_index'] == 1): ?>
                      <span class="yes" onClick="changeTableVal('spec','id','<?php echo htmlentities($list['id']); ?>','search_index',this)" ><i class="fa fa-check-circle"></i>是</span>
                      <?php else: ?>
                      <span class="no" onClick="changeTableVal('spec','id','<?php echo htmlentities($list['id']); ?>','search_index',this)" ><i class="fa fa-ban"></i>否</span>
                    <?php endif; ?>
                  </div>
                </td>                                
                <td align="center" axis="col0">                  
                <div style="text-align: center; width: 50px;">
                  <input type="text" onKeyUp="this.value=this.value.replace(/[^\d]/g,'')" onpaste="this.value=this.value.replace(/[^\d]/g,'')" onblur="changeTableVal('spec','id','<?php echo htmlentities($list['id']); ?>','order',this)" size="4" value="<?php echo htmlentities($list['order']); ?>" />
                </div>                  
                </td>  
                <td align="center" class="handle">
                  <div style="text-align: center; width: 170px; max-width:170px;">                   
                    <a class="btn red"  href="javascript:;" onclick="publicHandle(<?php echo htmlentities($list['id']); ?>)"><i class="fa fa-trash-o"></i>删除</a>
                    <a href="<?php echo url('Admin/goods/addEditSpec',array('id'=>$list['id'])); ?>" class="btn blue"><i class="fa fa-pencil-square-o"></i>编辑</a>
                  </div>
                </td>                           
                <td align="" class="" style="width: 100%;">
                  <div>&nbsp;</div>
                </td>
              </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </tbody>
        </table>
        <!--分页位置--> <?php echo $page; ?>
<script>
    // 点击分页触发的事件
    $(".pagination  a").click(function(){
        var page = $(this).data('page');
        ajax_get_table('search-form2',page);
    });

</script>        