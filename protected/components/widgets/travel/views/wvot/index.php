							<input type="button" class="bnt_up" id="bnt_up" value="顶一下"/>
            	<!--顶-->
              <input type="button" class="bnt_down" id="bnt_down" value="踩一下"/>
              <!--踩-->
<script language="javascript">

jQuery(function(){
	     var pattern="<?= $pattern ?>";
			 var id="<?= $id ?>";
       //jQuery.jBox.tip("正在删除数据...", 'loading');
       jQuery.ajax({
			  async:true,
        type: "GET",
        cache:true,
        beforeSend:function(){},
        url: "/api/vot/action/fetch",
        dataType:"json",
        data: "pattern="+pattern+"&id="+id,
        success: function(msg){
         if(msg.flag=='1'){
           var datas=msg.datas;
           jQuery("#bnt_up").val("顶一下("+datas.goods+")");
           jQuery("#bnt_down").val("踩一下("+datas.bads+")");
         }
        }
      }); 
      jQuery("#bnt_up").bind("click",function(){
      	jQuery.ajax({
			  async:true,
        type: "GET",
        cache:true,
        beforeSend:function(){},
        url: "/api/vot/action/goods",
        dataType:"json",
        data: "pattern="+pattern+"&id="+id,
        success: function(msg){
         if(msg.flag=='1'){
           var datas=msg.datas;
           jQuery("#bnt_up").val("顶一下("+datas.goods+")");
           
           
         }
        }
      });
      	
      }); 
      
      jQuery("#bnt_down").bind("click",function(){
      	jQuery.ajax({
			  async:true,
        type: "GET",
        cache:true,
        beforeSend:function(){},
        url: "/api/vot/action/bads",
        dataType:"json",
        data: "pattern="+pattern+"&id="+id,
        success: function(msg){
         if(msg.flag=='1'){
           var datas=msg.datas;
           jQuery("#bnt_down").val("踩一下("+datas.bads+")");
           
         }
        }
      });
      	
      });           	 	
})
</script>