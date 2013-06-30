function ManagePermission(){
	var options={};
}
ManagePermission.prototype={
	init:function(options){
		this.set_options(options);
	},
	set_options:function(options){
		this.options=options;
	},
	show_sub_menu:function(parent_key){
		var submenu=document.getElementById("permission_subitem_"+String(parent_key));
		var subitem_button=document.getElementById("show_sub_menu_"+String(parent_key));
		if(submenu.style.display=="block"||submenu.style.display==""){
			submenu.style.display="none";
			subitem_button.className='permissions_operate_add';
		}else{
			submenu.style.display="block";
			subitem_button.className="permissions_operate_sub";
		}
	},
	select_permission_all:function(parent_key){
		var parent_check=jQuery("#permission_item_check_"+String(parent_key));
		var subitem_check=jQuery("#permission_subitem_"+String(parent_key)).find(":checkbox");
		if(parent_check.attr("checked")){
			subitem_check.attr('checked',true);
		}else{
			subitem_check.attr('checked',false);
		}
	}
}