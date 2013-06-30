<?php
class CellphoneAction extends  BaseAction{
    public function beforeAction(){
    	  if(Yii::app()->request->isAjaxRequest){
    		  Util::reset_vars();
          return true;
        }else{
        	return false;
        }
    }
    protected function do_action(){
    	 $cellphone=$_REQUEST['cellphone'];
    	 $user_id=Yii::app()->user->id;
    	 $send_phone_nums=SendPhoneNums::model();
    	 $send_phone_nums_datas=$send_phone_nums->find("t.user_id=:user_id AND send_time=:send_time",array(':user_id'=>$user_id,':send_time'=>date('Y-m-d')));
    	 if(empty($send_phone_nums_datas)){
    	 	  $send_phone_nums->user_id=$user_id;
    	 	  $send_phone_nums->send_numbers=0;
    	 	  $send_phone_nums->save();
    	 	  $send_phone_nums_datas=$send_phone_nums;
    	}
    	$send_numbers=$send_phone_nums_datas->send_numbers;
    	if($send_numbers<3){
    	 if(is_phone($cellphone,"cell"){
    	  $send_message=SendMessage::model();
    	  $code=Util::randStr(6,"NUMBER");
    	  $result=$send_message->send_message(20,$cellphone,array('code'=>$code));
    	  if($result){
    	  	Yii::app()->session->add("phone_code",$code);
    	  	$result=Util::combo_ajax_message('1',array(),"发送成功请输入验证码");
    	  	$send_phone_nums_datas->send_numbers=$send_phone_nums_datas->send_numbers+1;
    	  	$send_phone_nums_datas->save();
    	  }else{
    	  	$result=Util::combo_ajax_message('2',array(),"发送失败请重新验证");
    	  }
    	}else{
    		$result=Util::combo_ajax_message('2',array(),"手机号码格式不正确，请重新输入");
    	}
    }else{
    	$result=Util::combo_ajax_message('2',array(),"验证次数超过了今天限制次数，请稍后再验证");
    }
      echo $result;
    } 
}
?>
