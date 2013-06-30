(function(jQuery) {
	jQuery.fn.selectBox = function(settings) {
		settings = jQuery.extend({
			cl:0,
			select_array:new Array()
		},settings);
		var matched_obj=this;
	  _start();
	  function _start(){
	    
	  	jQuery(matched_obj).bind('click',function(){
	  		
	  		_showbox();
	  	});
	 
	  	var width=jQuery(matched_obj).width();
	  	var height=jQuery(matched_obj).height();	
	  	jQuery(matched_obj).bind("keydown",function(){
	  		jQuery("#div_recommend_"+settings.hidden).hide();
	  	});
	  	jQuery(matched_obj).autocomplete({ 
    	  serviceUrl:settings.serviceUrl,
    	  minChars:1, 
    	  delimiter: /(,|;)\s*/, 
    	  maxHeight:400,
    	  width:width,
    	  zIndex: 9999,
    	  deferRequestBy: 0, 
    	  noCache: true, 
    	  onSelect: function(value, data){
    	  	jQuery("#"+settings.hidden).val(data.id);
    	  	jQuery("#"+settings.type).val(data.type);
    	  	jQuery("#div_recommend_"+settings.hidden).hide();
    	  }
    });	
	  }
	  function _showbox(){
	  	var tabs=settings.tabs;
	  	var tabs_length=tabs.length;
	
	  	var height=jQuery(matched_obj).height();
	  	var offset=jQuery(matched_obj).offset();
	  	var show_html='<div class="div_recommend" id="div_recommend_'+settings.hidden+'" style="left:'+offset.left+'px;top:'+(offset.top+height+10)+'px;"><h4 class="departures_title"><div class="re_icon"></div>';
	  	show_html+=settings.title; 
	  	show_html+='<a class="g_icon" href="javascript:void(0);" id="recommend_close_'+settings.hidden+'">x</a></h4><div clickid="'+settings.hidden+'" class="re_main">';
	  	if(tabs_length>=2){
	  		show_html+='<div class="anothercontent"><ul>';
	  		for(var ii=0;ii<tabs_length;ii++){
	  			show_html+='<li><a href="javascript:void(0);" clickid="'+settings.hidden+'" clickid="'+settings.hidden+'" type="'+tabs[ii].type+'" url="'+tabs[ii].url+'" current="'+tabs[ii].id+'" parent="'+tabs[ii].id+'" class="selecttab';
	  			if(ii==0){
	  				show_html+=' tabactive';
	  			}
	  			show_html+='">'+tabs[ii].name+'</a></li>';
	  		}
	  		show_html+='</ul></div>';

	  	}
			show_html+='</div><div>';
			if(settings.multi){
				show_html+='<a class="q_bnt" href="javascript:void(0);" id="recommend_ok_'+settings.hidden+'">确定</a><a class="q_bnt" href="javascript:void(0);" id="recommend_clear_'+settings.hidden+'">清空</a>';
			}else{
				show_html+='<a class="q_bnt" href="javascript:void(0);" id="recommend_clear_'+settings.hidden+'">清空</a>';
			}
			show_html+='</div></div>';
			if(typeof(jQuery("#div_recommend_"+settings.hidden).get(0))=='undefined'){
			    jQuery("body").append(show_html);
			    settings.cl=0;
					_get_datas(tabs[0].url,tabs[0].id,tabs[0].type);
			}else{
				  jQuery("#div_recommend_"+settings.hidden).show();
			}
			jQuery(".selecttab[clickid='"+settings.hidden+"']").die('click').live('click',function(){
				 	jQuery("a.tabactive[clickid='"+settings.hidden+"']").removeClass("tabactive");
				 	jQuery(this).addClass("tabactive");
				 	var url=jQuery(this).attr("url");
				 	var parent=jQuery(this).attr("parent");
				 	var type=jQuery(this).attr("type");
				 	jQuery(this).parent().parent().parent().nextAll(".anothercontent").remove();
				 	settings.cl=0;
				 	_get_datas(url,parent,type);
			 });
			 
			  jQuery("#recommend_close_"+settings.hidden).die("click").live("click",function(){
			 	jQuery("#div_recommend_"+settings.hidden).hide();
			 	
			});
			
			jQuery("#recommend_clear_"+settings.hidden).die("click").live("click",function(){
			 			jQuery(matched_obj).val("");
			 			jQuery("#"+settings.hidden).val("");
			 			jQuery("#div_recommend_"+settings.hidden).hide();
			});
			 
	  }
	  function _get_datas(url,parent,type){
	  	jQuery.ajax({
	    	async:true,
        type: "Get",
        cache:true,
        beforeSend:function(){jQuery(".re_main[clickid='"+settings.hidden+"']").append("<div class='anothercontent'><div class='progress_img'><img src='/css/images/loading.gif' width='19' height='18'/></div></div>");},
        url: url,
        dataType:"json",
        data: "parent="+parent+"&rmd="+Date.parse(new Date()),
        success: function(msg){
          if(msg.flag=='1'){
          	settings.cl++; 
          	_process_datas(url,msg.datas,type);
          }
        }
      });
	  }
	  function _process_datas(url,datas,type){
	  	var datas_length=datas.length;
	  	var innerhtml='<div>';
	  	for(var jj=0;jj<datas_length;jj++){
	  		if(settings.cl>=settings.level){
	  			
	  			if(settings.multi){
	  				var check_flag="";
	  				if(settings.select_array.find_key(datas[jj].id)){
	  					check_flag=" CHECKED='CHECKED' ";
	  				}
	  				innerhtml+='<span><input check_name="'+datas[jj].name+'" type="checkbox" name="child_check" clickid="'+settings.hidden+'" class="child_check" current="'+datas[jj].id+'" id="check_'+datas[jj].id+'" '+check_flag+'><lable for="check_'+datas[jj].id+'"';
	  				innerhtml+=' type="'+type+'" level="'+settings.cl+'" parent="'+datas[jj].id+'" current="'+datas[jj].id+'">'+datas[jj].name+'</lable></span>';
	  			}else{
	  				
	  			innerhtml+='<span><a';
	  			if(settings.select_array.find_key(datas[jj].id)){
	  				innerhtml+=' class="doselect re_main_a_hover" ';
	  			}else{
	  				innerhtml+=' class="doselect" ';
	  			}
	  			innerhtml+=' type="'+type+'" level="'+settings.cl+'" parent="'+datas[jj].id+'" clickid="'+settings.hidden+'" current="'+datas[jj].id+'" href="javascript:void(0);">'+datas[jj].name+'</a></span>';
	  		 }
	  		}else{
	  		  innerhtml+='<span><a url="'+url+'" type="'+type+'"  level="'+settings.cl+'" clickid="'+settings.hidden+'" class="selectchildren" parent="'+datas[jj].id+'" current="'+datas[jj].id+'" href="javascript:void(0);">'+datas[jj].name+'</a></span>';
	  		}
	  	}
	  	innerhtml+='</div>';
	  	jQuery(".re_main[clickid='"+settings.hidden+"']").find(".anothercontent:last").html(innerhtml);
	  	jQuery(".selectchildren[clickid='"+settings.hidden+"']").die('click').live('click',function(){
				 	jQuery("a.re_main_a_hover[clickid='"+settings.hidden+"']").removeClass("re_main_a_hover");
				 	jQuery(this).addClass("re_main_a_hover");
				 	var url=jQuery(this).attr("url");
				 	var parent=jQuery(this).attr("parent");
				 	var level=jQuery(this).attr("level");
				 	var type=jQuery(this).attr("type");
				 	settings.cl=level;
				 	jQuery(this).parent().parent().parent().nextAll(".anothercontent").remove();
				 	_get_datas(url,parent,type);
			 });
			 if(settings.multi){
			 	 jQuery(".child_check[clickid='"+settings.hidden+"']").die('click').live('click',function(){
			 	 	  var checked=jQuery(this).attr("checked");
			 	 	  var current=jQuery(this).attr("current");
			 	 	  var check_name=jQuery(this).attr("check_name");
			 	 	  var index=settings.select_array.find_key(current);
			 	 	  if(checked){
			 	 	  	if(!index){
			 	 	  		var tem={id:current,name:check_name};
			 	 	  	  settings.select_array.push(tem);
			 	 	  	}
			 	 	  	
			 	 	  }else{
			 	 	  	if(index){
			 	 	  		settings.select_array=settings.select_array.remove(index-1);
			 	 	  	}
			 	 	  }
			 	 	
			 	});
			 	
			 	jQuery("#recommend_ok_"+settings.hidden).die("click").live("click",function(){
			 			jQuery("#div_recommend_"+settings.hidden).hide();
			 	    jQuery("#"+settings.type).val(type);
			 	    var select_ids=new Array();
			 	    var select_name=new Array();
			 	    var select_array_length=settings.select_array.length;
			 	    for(var jj=0;jj<select_array_length;jj++){
			 	    	select_ids.push(settings.select_array[jj].id);
			 	    	select_name.push(settings.select_array[jj].name);
			 	    }
			 	    var select_value=settings.select_array.join(",");			 	    
				 		jQuery("#"+settings.hidden).val(select_ids.join(","));
				 		jQuery(matched_obj).val(select_name.join(","));
				 		jQuery("#div_recommend_"+settings.hidden).hide();
				});
			
			
			}else{
			 jQuery(".doselect[clickid='"+settings.hidden+"']").die('click').live('click',function(){
				 	jQuery("a.re_main_a_hover[clickid='"+settings.hidden+"']").removeClass("re_main_a_hover");
				 	jQuery(this).addClass("re_main_a_hover");
				 	var current=jQuery(this).attr('current');
				 	var text=jQuery(this).html();
				 	var type=jQuery(this).attr("type");
				 	jQuery("#"+settings.type).val(type);
				 	jQuery("#"+settings.hidden).val(current);
				 	jQuery(matched_obj).val(text);
				 	jQuery("#div_recommend_"+settings.hidden).hide();
			 });
			}
			 
	  }
	};
})(jQuery);