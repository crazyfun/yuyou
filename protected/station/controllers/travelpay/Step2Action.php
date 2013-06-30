<?php
class Step2Action extends BaseAction{
	protected function beforeAction(){
        $this->controller->init_page();
        
        return true;
    }
   protected function do_action(){
   	    $cssPath=$this->controller->get_css_path();
      $jsPath=$this->controller->get_js_path(); 
   			$order_id=$_REQUEST['order_id'];
   	    $model=new TemOrderContacter("Order");
   	    $model_name="Contacter";
   	    $main_model=new TemOrderContacter("Main");
   	    $main_model_name="Main";
   	    $order=TempOrder::model();
   	    $order_data=$order->with("Travel")->findByPk($order_id);
   	    $people_nums=$order_data->adult_nums+$order_data->child_nums;
   	    $contacter_number=count($_POST[$model_name]['contacter']);
   	    if(empty($order_id)){
   	    	$this->controller->redirect("error/error404");
   	    }
   	    $action=$_REQUEST['action'];
   	    if($action=="order"){
   	     if($people_nums==$contacter_number){
   	    	if($_POST[$main_model_name]){
								$main_model=!empty($_POST[$main_model_name]['id'])?$model->get_table_datas($_POST[$main_model_name]['id']):$main_model;
								$main_model->setScenario("Main");
      					$main_model->attributes=$_POST[$main_model_name];
      					$main_model->order_id=$order_id;
      					$main_model->main='1';
								if($main_model->validate()){
		    					$result=$main_model->insert_datas();
		    		if($_POST[$model_name]){
							$contacter_post_datas=$_POST[$model_name]['contacter'];
							$code_type_post_datas=$_POST[$model_name]['code_type'];
							$code_value_post_datas=$_POST[$model_name]['code_value'];
							$contacter_phone_post_datas=$_POST[$model_name]['contacter_phone'];
							$contacter_address_post_datas=$_POST[$model_name]['travel_address'];
							$is_child_post_datas=$_POST[$model_name]['is_child'];
							$save_post_datas=$_POST[$model_name]['save'];
							$contacter=new Contacter();
							$redirect_flag=true;
							foreach($contacter_post_datas as $key => $value){
								$model->id=null;
								$model->setIsNewRecord(true);
								$model->order_id=$order_id;
								$model->contacter=$value;
								$model->code_type=$code_type_post_datas[$key];
								$model->code_value=$code_value_post_datas[$key];
								$model->contacter_phone=$contacter_phone_post_datas[$key];
								$model->address_id=$contacter_address_post_datas[$key];
								$model->is_child=$is_child_post_datas[$key];
								if($model->validate()){
		    					$result=$model->insert_datas();
								if($result&&$save_post_datas[$key]&&!Yii::app()->user->isGuest){
									    
										  $contacter->id=null;
								      $contacter->setIsNewRecord(true);
		    							$contacter->user_id=Yii::app()->User->id;
		    							$contacter_model_data=$contacter->find("contacter=:contacter AND user_id=:user_id",array(':contacter'=>$value,':user_id'=>Yii::app()->User->id));
		    							if(!empty($contacter_model_data)){
		    								$contacter=$contacter_model_data;
		    							}else{
		    								$contacter->setIsNewRecord(true);
		    							}
		    							$contacter->contacter=$value;
		    							$contacter->contacter_phone=$contacter_phone_post_datas[$key];
		    							$contacter->code_type=$code_type_post_datas[$key];
		    							$contacter->code_value=$code_value_post_datas[$key];
		    							$contacter->is_child=($is_child_post_datas[$key]!='1')?"0":"1";
		    							if($contacter->validate()){
		    								$result=$contacter->insert_datas();
		    							}
								}
							}else{
								$redirect_flag=false;
							}
							}
							if($redirect_flag){
								$comment=$_REQUEST['comment'];
								if(!empty($comment)){
									$order->updateByPk($order_id,array('comment'=>$comment));
								}
								$this->controller->redirect($this->controller->createUrl("travelpay/step3",array('order_id'=>$order_id)));
							}else{
								$this->controller->set_flash("请填写正确的游客信息",CV::FAILED_ADMIN_OPERATE);
							}
						}else{
							$this->controller->set_flash("请填写游客信息",CV::FAILED_ADMIN_OPERATE);
						}
				  }
				 }else{
				 	  $this->controller->set_flash("请填写联系人信息",CV::FAILED_ADMIN_OPERATE);
				 }
				}else{
					$this->controller->set_flash("游客信息数量不正确",CV::FAILED_ADMIN_OPERATE);
				}
   	    }else{
   	    	$model->order_id=$order_id;
   	    	$main_model->order_id=$order_id;
   	    	  	
   	    }
   	    $order_travel_id=$order_data->travel_id;
   	    $travel_address=TravelAddress::model();
        $address_select=$travel_address->get_address_select($order_travel_id);
        $address_select_html='<select id="Contacter[travel_address][]" name="Contacter[travel_address][]" class="travel_address_select">';
       
        foreach((array)$address_select as $key => $value){
        	$address_select_html.='<option value="'.$key.'">'.$value.'</option>';
        }
        $address_select_html.='</select>';    
				$this->display("step2",array('model'=>$model,'main_model'=>$main_model,'Contacter'=>$_POST[$model_name],'contacter_number'=>$contacter_number,'people_nums'=>$people_nums,'order_data'=>$order_data,'address_select_html'=>$address_select_html,'address_select'=>$address_select,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
   }
}
?>