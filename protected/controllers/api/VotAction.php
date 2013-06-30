<?php
class VotAction extends  BaseAction{
    public function beforeAction(){
    	  if(Yii::app()->request->isAjaxRequest){
    		  Util::reset_vars();
          return true;
        }else{
        	return false;
        }
    }
    protected function do_action(){
    	  $action=$_REQUEST['action'];
    	  $pattern=$_REQUEST['pattern'];
    	  $id=$_REQUEST['id'];
    	  $model_name=ucfirst($pattern);
        $model=new $model_name();
        switch($action){
        	case 'fetch':
        	    $model_data=$model->findByPk($id);
        			$goods=$model_data->goods;
        			$bads=$model_data->bads;
    	  			$result=Util::combo_ajax_message('1',array('goods'=>$goods,'bads'=>$bads),"");
        			echo $result;
        			break;
        	case 'goods':
        	     $model_data=$model->findByPk($id);
        	     $model_data->goods=$model_data->goods+1;
        	     $model_data->save();
        	     $result=Util::combo_ajax_message('1',array('goods'=>$model_data->goods),"操作成功");
        	     echo $result;
        			break;
        	case 'bads':
        	     $model_data=$model->findByPk($id);
        	     $model_data->bads=$model_data->bads+1;
        	     $model_data->save();
        	     $result=Util::combo_ajax_message('1',array('bads'=>$model_data->bads),"操作成功");
        	     echo $result;
        	   break;
          default:
           		$model_data=$model->findByPk($id);
        			$goods=$model_data->goods;
        			$bads=$model_data->bads;
    	  			$result=Util::combo_ajax_message('1',array('goods'=>$goods,'bads'=>$bads),"");
        			echo $result;
          		break;
        	
        }
        
    } 
}
?>
