<?php

class CommentController extends Controller
{
	public $tag="comment";
	public $breadcrumbs=array();

  public function actionComments(){
   if(Yii::app()->request->isAjaxRequest){
		Util::reset_vars();
  	require_once('config.inc.php');
  	require_once('uc_client/client.php');;
    $action=$_REQUEST['action'];
    $model_id=$_REQUEST['model_id'];
    $content_id=$_REQUEST['content_id'];
    $content=$_REQUEST['content'];
    $level=$_REQUEST['level'];
    $user_flag=$_REQUEST['user_flag'];
    $comments=new Comments();
    switch($action){
    	case 'comment':
    	  $comments->model_id=$model_id;
    	  $comments->parent_id='';
    	  $comments->relation_id=$content_id;
    	  $comments->comment=nl2br($content);
    	  if($comments->validate()){
			    $result=$comments->insert_datas();
			  }
			  //在这里设置不同模型需要的不同的操作
			  switch($model_id){
			  	
			  	 default:
			  	  
			  	   break;
			  }
    	  break;
    	case 'reply':
    	  $parent_id=$_REQUEST['parent_id'];
    	  $comments->model_id=$model_id;
    	  $comments->parent_id=$parent_id;
    	  $comments->relation_id=$content_id;
    	  $comments->comment=nl2br($content);
    	  if($comments->validate()){
    	  	$result=$comments->insert_datas();
    	  }
    	  break;
    	case 'viewreply':
    	  $parent_id=$_REQUEST['parent_id'];
    	  break;
    	default:
    	  break;
    }
   
    $page_params['model_id']=$model_id;
    $page_params['content_id']=$content_id;
    $page_params['level']=$level;
    if($action=="comment"||$action==""){
		$dataProvider = new CActiveDataProvider($comments,array(
		  'criteria'=>array(
			    'condition'=>'t.model_id=:model_id AND t.relation_id=:relation_id AND t.parent_id=:parent_id',
			    'params'=>array(':model_id'=>$model_id,':relation_id'=>$content_id,':parent_id'=>''),
			    'order'=>'t.create_time desc',
			    'with'=>array('User','Comments'),
			),
			'pagination'=>array(
          'pageSize'=>'20',
          'params'=>$page_params
          
      ),
		));
		$enablePagination=true;
		$comment_item="comment_item";
	 }
	 if($action=="reply"||$action=="viewreply"){
	 	 $dataProvider = new CActiveDataProvider($comments,array(
		  'criteria'=>array(
			    'condition'=>'t.model_id=:model_id AND t.relation_id=:relation_id AND t.parent_id=:parent_id',
			    'params'=>array(':model_id'=>$model_id,':relation_id'=>$content_id,':parent_id'=>$parent_id),
			    'order'=>'t.create_time desc',
			    'with'=>array('User','Comments'),
			),
			'pagination'=>array(
          'pageSize'=>'',
          'params'=>$page_params
          
      ),
     ));
     $enablePagination=false;
		 $comment_item="child_comment_item";
	  }
	 
		$this->render("comments",array('dataProvider'=>$dataProvider,'comment_item'=>$comment_item,'level'=>$level,'user_flag'=>$user_flag,'enablePagination'=>$enablePagination));
		
	 }
  }

	public function f($msg_code){ 
     if($msg_code == CV::SUCCESS){
       $this->set_flash("操作成功",$msg_code);
     }
     if($msg_code == CV::FAIL){
     	 $this->set_flash("操作失败",$msg_code);
     }
   }
   public function get_level_flag($comment_id,$level){
   	  $comments=Comments::model();
   
   	    $comment_level=$comments->get_comment_level($comment_id);

   	  if(empty($level)){
   	  	return true;
   	  }else{
   	  	if($comment_level < $level){
   	  		return true;
   	  	}else{
   	  		return false;
   	  	}
   	  }
   }

}