function validate(params){
	this.params=params;
	this.init();
}
validate.prototype={
  init:function(){
  	var params_length=this.params.length;
  	for(var ii=0;ii<params_length;ii++){
  		var param=this.params[ii];
      this.validate(param);
  	}
  },
  validate:function(param){
  		var tip_id=param.tip_id;
  		var param_id=param.id;
  		var tip=param.tip;
  		var tip_message=param.tip_message;
  		var validate=param.validate;
  		var that=this;
  		var obj=jQuery("#"+param_id);
  		
  		if(tip){
  			
  			obj.bind("focus",function(){
  				 
  				 that.tip(tip_id,tip_message);
  			});
  		}
  		if(validate){
  			obj.bind("blur",function(){
  			 	 		that.excute_validate(param_id,tip_id,validate);
  			});
  		}
  },
  excute_validate:function(param_id,tip_id,validate){
  	var validate_type=validate.validate_type;
  	var validate_url=validate.validate_url;
  	var validate_message=validate.validate_message;
  	var compare_id=validate.compare_id;
  	var param_value=jQuery("#"+param_id).val();
  	var validate_flag=true;
  	switch(validate_type){
  		 case 'required': 
  		    validate_flag=this.is_required(param_value);
  		    break;
  		 case 'numberic':
  		    validate_flag=this.is_numberic(param_value);
  		 		break;
  		 case 'telephone':
  		    validate_flag=this.is_phone(validate_type,param_value);
  		 		break;
  		 case 'cellphone':
  		    validate_flag=this.is_phone(validate_type,param_value);
  		 		break;
  		 case 'tcphone':
  		    validate_flag=this.is_phone(validate_type,param_value);
  		    break;
  		 case 'phone':
  		   validate_flag=this.is_phone(validate_type,param_value);
  		   break;
  		 case 'email':
  		   validate_flag=this.is_email(param_value);
  		   break;
  		 case 'is_code':
  		   validate_flag=this.is_code(param_value);
  		 case 'ajax':
  		   validate_flag=this.is_ajax(validate_url,param_value,tip_id);
  		   break;
  		 case 'compare':
  		   compare_value=jQuery("#"+compare_id).val();
  		   validate_flag=this.is_comare(param_value,compare_value);
  		   break;
  		 default:
  		 		break;
  	}
  if(validate_type!="ajax"){
  	if(validate_flag){
  		this.show_success(jQuery("#"+tip_id),"");
  	}else{
  		this.show_failed(jQuery("#"+tip_id),validate_message);
  	}
   }
  },
  is_ajax:function(url,value,tip_id){
  	var that=this;
     jQuery.ajax({
     	  async:true,
   			url: url,
   			beforeSend:function(){jQuery("#"+tip_id).html("<div class='progress_f_img'><img src='/css/images/loading.gif' width='19' height='18'/></div>");},
   			datetype:"json",
   			data: "value="+value,
   			type:"GET",
   			success: function(msg){
   				
   				msg=eval('('+msg+')');
   				if(msg.flag=="s"){
   					  that.show_success(jQuery("#"+tip_id),msg.message);
   				}else{
   					  that.show_failed(jQuery("#"+tip_id),msg.message);
   				}
   				
   			}
 		 }); 
  },
  is_numberic:function(value){
  	if(isNaN(value))
	       return false;
	  else
	  	   return true;
  },
  is_email:function(value){
  	    var user_email_flag=value.match(/^([a-z0-9+_]|\-|\.)+@(([a-z0-9_]|\-)+\.)+[a-z]{2,6}$/i);
    	  if(user_email_flag)
    	     return true;
    	  else
    	  	 return false;
  },
  is_phone:function(type,value){
  	switch(type){
    		case 'telephone':
    		    //手机号码验证规则
    	     var tele_phone=value.match(/^(((\d{3}))|(\d{3}-))?((0\d{2,3})|0\d{2,3}-)?[1-9]\d{6,8}$/);
    	     if(tele_phone)
    	        return true;
    	     else
    	        return false;
    		   break;
    		case 'cellphone':
    		   //座机验证规则
    	    var cell_phone =value.match(/(?:13\d{1}|1[548][0173689])\d{8}$/);
    	    if(cell_phone)
    	      return true;
    	    else
    	      return false;
    		   break;
    		case 'tcphone':
    		   	//小灵通验证规则
          	var tc_phone=value.match(/^1[3,5]\d{9}$/);
          	if(tc_phone)
          	  return true;
          	else
          	  return false;
    		   break;
    		default:
    		   //手机号码验证规则
    	    var tele_phone=value.match(/^(((\d{3}))|(\d{3}-))?((0\d{2,3})|0\d{2,3}-)?[1-9]\d{6,8}$/);
        	//座机验证规则
        	var cell_phone=value.match(/(?:13\d{1}|1[548][0173689])\d{8}$/);
        	//小灵通验证规则
         	var tc_phone=value.match(/^1[3,5]\d{9}$/);
         	if((cell_phone)||(tele_phone)||(tc_phone)){
         		return true;
         	}else{
         		return false;
         	}
    		   break;
    	}
  },
  is_required:function(value){
  	if(value){
  		return true;
  	}else{
  		return false;
  	}
  },
  is_code:function(value){
  	var reg = /(^\d{15}$)|(^\d{18}$)/;
   if(reg.test(value) === false)
   {
     return false;
   }else{
     return true;	  
   }
  },
  is_comare:function(value,compare_value){
  	if(value==compare_value){
  		return true;
  	}else{
  		return false;
  	}
  },
  tip:function(tip_id,tip_message){
  	jQuery("#"+tip_id).html(tip_message);
  	this.show_tip(jQuery("#"+tip_id),tip_message);
  },
  show_tip:function(obj,message){
  	obj.removeClass("validate_success");
  	obj.removeClass("validate_error");
  	obj.addClass("validate_tip");
  	obj.html(message);
  },
  show_success:function(obj,message){
  	obj.removeClass("validate_tip");
  	obj.removeClass("validate_error");
  	obj.addClass("validate_success");
  	obj.html(message);
  },
  show_failed:function(obj,message){
  	obj.removeClass("validate_tip");
  	obj.removeClass("validate_success");
  	obj.addClass("validate_error");
  	obj.html(message);
  }
}
	




