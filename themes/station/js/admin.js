   /*
	 *发送批量删除的表单 
	 * @param string action 表单的action
	 * @return string 返回用户的权限值
	 * @auther lxf
	 * @version 1.0.0
	 */
	 function batch_operate(action){
	 	var question=confirm("确认要进行该操作吗?");
	 	if(question){  
	 	  var submit_form=document.getElementById("lists-form");
	 	  submit_form.action=action;
	 	  submit_form.submit();
	 	  return true;
	 	}else{
	 		return;
	 	}
	 	
	}
	 /*
	 *ajax 删除一笔数据
	 * @param string url ajax发送的连接
	 * @param string model model的名字
	 * @param string id  ajax附带的ID值
	 * @auther lxf
	 * @version 1.0.0
	 */
	function ajax_delete(url,model,id){
		
	 if(!url){
			url="/station.php/main/delete";
		}
		var submit = function (v, h, f) {
    if (v == 'ok') {
       jQuery.jBox.tip("正在删除数据...", 'loading');
       jQuery.ajax({
			  async:true,
        type: "POST",
        cache:true,
        beforeSend:function(){},
        url: url,
        dataType:"json",
        data: "model="+model+"&id="+id,
        success: function(msg){
          if(msg.flag=='1'){
          	var delete_obj=jQuery("#delete_"+msg.datas.id);
          	var parent_obj=delete_obj.parent().parent().parent();
          	parent_obj.remove();
          	jQuery.jBox.tip('删除成功。', 'success');
          }else if(msg.flag=='2'){
        	  jQuery.jBox.tip(msg.message, 'error');
          }else{
        	
          }
        }
      });
    }else if (v == 'cancel'){
        // 取消
    }
    return true; //close
};

jQuery.jBox.confirm("确定要删除数据吗？", "提示", submit);
}
//显示提示信息
  function show_tip_dialog(message){
  	 jQuery.jBox.tip(message);
  }

function set_user_permissions(user_id){
	
// 用iframe显示http://www.baidu.com的内容，并设置了标题、宽与高、按钮
jQuery.jBox("iframe:/station.php/user/permission?user_id="+user_id, {
    title: "用户角色",
    width: 450,
    height: 220,
    buttons: { '关闭': true }
});
}


function set_store_permissions(user_id){
	
// 用iframe显示http://www.baidu.com的内容，并设置了标题、宽与高、按钮
jQuery.jBox("iframe:/station.php/store/permission?user_id="+user_id, {
    title: "用户角色",
    width: 450,
    height: 220,
    buttons: { '关闭': true }
});
}

function frame_view(url,model,id){
jQuery.jBox("iframe:"+url+"?model="+model+"&id="+id, {
    title: "查看详细信息",
    width: 1000,
    height: 500,
    buttons: { '关闭': true }
});	
}

function frame_shenhe(url,id){
jQuery.jBox("iframe:"+url+"?&id="+id, {
    title: "审核信息",
    width: 1000,
    height: 500,
    draggable:true,
    opacity:0,
    buttons: { '关闭': true }
});	
}

function frame_channel_move(url){
jQuery.jBox("iframe:"+url, {
    title: "移动栏目",
    width: 1000,
    height: 500,
    draggable:true,
    opacity:0,
    buttons: { '关闭': true }
});	
}
function frame_travel(url,title,id){
jQuery.jBox("iframe:"+url+"?travel_id="+id, {
    title: title,
    width: 1000,
    height: 500,
    buttons: { '关闭': true }
});	
}

function frame_hotels(url,title,id){
jQuery.jBox("iframe:"+url+"?hotels_id="+id, {
    title: title,
    width: 1000,
    height: 500,
    buttons: { '关闭': true }
});	
}
function frame_download(url,title,id){
jQuery.jBox("iframe:"+url+"?downloads_id="+id, {
    title: title,
    width: 1000,
    height: 500,
    buttons: { '关闭': true }
});	
}


frame_gallery

function frame_gallery(url,title,id){
jQuery.jBox("iframe:"+url+"?gallery_id="+id, {
    title: title,
    width: 1000,
    height: 500,
    buttons: { '关闭': true }
});	
}


function clear_cache(){
       jQuery.jBox.tip("正在清除缓存...", 'loading');
       jQuery.ajax({
	    async:true,
        type: "Get",
        cache:true,
        beforeSend:function(){},
        url: "/api/clearflush",
        dataType:"json",
        data: "",
        success: function(msg){
          if(msg.flag=='1'){
          	jQuery.jBox.tip('成功清除缓存', 'success');
          }else if(msg.flag=='2'){
        	  jQuery.jBox.tip(msg.message, 'error');
          }else{
        	
          }
        }
      });
}

function show_clonedialog(id){
	jQuery.jBox("iframe:/station.php/travel/clone?id="+id, {
    title: "克隆线路",
    width: 1000,
    height: 500,
    buttons: { '关闭': true }
});	
}


function frame_tongji(url,params){
	jQuery.jBox("iframe:"+url+"?"+params, {
    title: "统计图",
    width: 1000,
    height: 500,
    buttons: { '关闭': true }
});
}