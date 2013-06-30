    <div region="west" split="true" title="导航菜单" style="width:180px;" id="west">
      <div class="easyui-accordion" fit="true" border="false">
		  <!--  导航内容 -->
				
			</div>

    </div>
    
<script language="javascript">
	
	 var _menus={"menus":[]};	
   var menu_json=<?= $menu_json; ?>;
   var menu_length=menu_json.length;
   for(var ii=0;ii<menu_length;ii++){
   	 var parent_menu=menu_json[ii];
   	 var parent_menu_arr={"menuid":parent_menu.id,"icon":"icon-sys","menuname":parent_menu.name,"menus":[]};
   	 var subitems=parent_menu.subitem;
   	 var subitems_length=subitems.length;
   	 for(var jj=0;jj<subitems_length;jj++){
   	 	var subitem=subitems[jj];
   	 	var subitem_menu_arr={"menuname":subitem.name,"icon":"icon-nav","url":subitem.url};
   	 	parent_menu_arr.menus.push(subitem_menu_arr);
   	 }
   	_menus.menus.push(parent_menu_arr);
   }
   
	
</script>


