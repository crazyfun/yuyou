<?php
class SchedulerAction extends  BaseAction{
    public function beforeAction(){
    	  if(Yii::app()->request->isAjaxRequest){
    		  Util::reset_vars();
          return true;
        }else{
        	return false;
        }
    }
    protected function do_action(){
	    $user_id=Yii::app()->user->id;
   	  $action=$_REQUEST['action'];
   	  switch($action){
   	  case 'add':
   	    $id=$_REQUEST['id'];
   	    $text=$_REQUEST['text'];
   	    $start_date=$_REQUEST['start_date'];
   	    $end_date=$_REQUEST['end_date'];
   	    $details=$_REQUEST['details'];
   	    $model=new Events();
   	    $model->event_id=$id;
   	    $model->user_id=$user_id;
   	    $model->event_name=$text;
   	    $model->start_date=$start_date;
   	    $model->end_date=$end_date;
   	    $model->details=$details;
        $result=$model->insert();
        if($result){
        	echo Util::combo_ajax_message('y',array('id'=>$model->event_id),'');
        }
   	    break;	
   	  case 'edit':
   	    $id=$_REQUEST['id'];
   	    $text=$_REQUEST['text'];
   	    $start_date=$_REQUEST['start_date'];
   	    $end_date=$_REQUEST['end_date'];
   	    $details=$_REQUEST['details'];
   	    $model=new Events();
   	    $model=$model->findByPk($id);
   	    $model->user_id=$user_id;
   	    $model->event_name=$text;
   	    $model->start_date=$start_date;
   	    $model->end_date=$end_date;
   	    $model->details=$details;
        $result=$model->insert_datas();
        if($result){
        	echo Util::combo_ajax_message('y',array('id'=>$model->event_id),'');
        }
   	    break;
   	  case 'delete':
   	    $id=$_REQUEST['id'];
   	    $model=new Events();
   	    $result=$model->deleteAll('event_id=:event_id',array(':event_id'=>$id));
   	    if($result){
   	    	echo Util::combo_ajax_message('y',array('id'=>$id),'');
   	    }
   	    break;
   	  default:	
   	 	 	$from=$_REQUEST['from'];
   	  	$to=$_REQUEST['to'];
      	$model=Events::model();
      	$events_datas=$model->findAll("user_id=:user_id AND start_date>=:from AND end_date<=:to",array(':user_id'=>$user_id,':from'=>$from,':to'=>$to));
      	$return_datas="<?xml version='1.0' encoding='utf-8' ?><data>";
      	foreach($events_datas as $key => $value){
      		$return_datas.='<event id="'.$value->event_id.'">
        		<start_date>'.$value->start_date.'</start_date>
        		<end_date>'.$value->end_date.'</end_date>
        		<text><![CDATA['.$value->event_name.']]></text>
        		<details><![CDATA['.$value->details.']]></details>
        	</event>';
      	}
      	$return_datas.="</data>";
      	header("Content-type: text/xml");
       	echo $return_datas;
     }
  } 
}
?>
