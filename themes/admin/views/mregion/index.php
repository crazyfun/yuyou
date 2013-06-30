<?php
    Yii::app()->clientScript->registerCssFile('/js/treetable/css/jqtreetable.css');
    Yii::app()->clientScript->registerScriptFile('/js/treetable/jqtreetable.js');
   
 ?>
 <div id="page_content">
    <div class="show_right_content">
<div class=""><div class="user_operate_content"><a href="<?php echo $this->createUrl("mregion/add");?>">增加区域</a></div></div>
<div class="edit_content">
<table class="distinction">
        <?php if(!empty($regions)){ ?>
        
        <thead>
        <tr>
            
            <th width="50%">地区名称</th>
            <th>排序</th>
            <th class="handler">操作</th>
        </tr>
        </thead>
        
        
        <tbody id="treet1">
        	<?php foreach($regions as $key => $region){ ?>
        <tr class="">
         <td class="node" width="50%">
          <?php if($region['switchs']){ ?>
            <img src="/js/treetable/css/images/tv-expandable.gif" ectype="flex" status="open" fieldid="<?php echo $region['region_id'];?>" onclick="flex($(this))">
          <?php }else{ ?>
            <img src="/js/treetable/css/images/tv-item.gif">
          <?php } ?>
            <span class="node_name"><?php echo $region['region_name'];?></span></td>
            <td class="align_center"><span fieldname="sort_order" fieldid="<?php echo $region['region_id'];?>"><?php echo $region['sort_order'];?></span></td>
            <td class="handler">
            <span>
               <?php echo $region->get_operate();?>
             </span>
          </td>
        </tr>
       
     <?php } ?>
     </tbody>
      <?php } ?>
</table>
</div>
  </div>
</div>   
<script language="javascript">
jQuery(function()
{
    change_background();
});

function change_background()
{
    jQuery("tbody tr").hover(
    function()
    {
        jQuery(this).css({background:"#EAF8DB"});
    },
    function()
    {
        jQuery(this).css({background:"#fff"});
    });
}

function flex(obj)
{
    var status = obj.attr('status');
    var id = obj.attr('fieldid');
    var pid = obj.parent('td').parent('tr').attr("class");
    
    var src = jQuery(obj).attr('src');
    if(status == 'open')
    {
        var pr = jQuery(obj).parent('td').parent('tr');

        var td2=jQuery(obj).parent('td');
        var preimg_length=td2.find(".preimg").length;
         jQuery.get("/admin.php/mregion/children", {id: id}, function(data){
             if(data)
             {
                 var str = '';
                
                 var res = eval('(' + data + ')');
                 
                 for(var i = 0; i < res.length; i++)
                 {
                     if(res[i].switchs)
                     {
                         src =  "<img src='/js/treetable/css/images/tv-expandable.gif' ectype='flex' status='open' fieldid="+res[i].region_id+
                           " onclick='flex(jQuery(this))'><span class='node_name'>" + res[i].region_name + "</span>";
                     }
                     else
                     {
                         src = "<img src='/js/treetable/css/images/tv-item.gif'><span class='node_name'>" + res[i].region_name + "</span>";
                     }
                     var itd2 = src;
                     str+="<tr class='"+pid+" row"+id+"'>"+
                        "<td class='node' width='50%'>";
                     for(var ii=0;ii<=preimg_length;ii++){
                     	str+="<img class='preimg' src='/js/treetable/css/images/vertline.gif'/>";
                    }
                     str+=itd2 + "</td>"+
                        "<td class='align_center'><span  fieldname='sort_order' fieldid='" + res[i].region_id + "'>" + res[i].sort_order + "</span></td>"+
                        "<td class='handler'><span>";
                     str+=res[i].operate;
                     str+="</span></td></tr>";
                 }
                
                pr.after(str);
                change_background();
                
             }
         });
         obj.attr('src',src.replace("tv-expandable","tv-collapsable"));
         obj.attr('status','close');
    }
    if(status == 'close')
    {
        jQuery('.row' + id).hide();
        obj.attr('src',src.replace("tv-collapsable","tv-expandable"));
        obj.attr('status','open');
    }
}
    </script>