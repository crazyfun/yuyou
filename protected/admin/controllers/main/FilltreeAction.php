<?php
class FilltreeAction extends  BaseAction{
    public function beforeAction(){
    	  if(Yii::app()->request->isAjaxRequest){
    		  Util::reset_vars();
          return true;
        }else{
        	return false;
        }
    }
    protected function do_action(){
        $parentId = 'null';
        if (isset($_GET['root'])) {
            $parentId = (int) $_GET['root'];
        }
        $req = Yii::app()->db->createCommand(
            "SELECT m1.id, m1.name AS text,m1.pattern as pattern,m1.is_hidden as is_hidden,m2.id IS NOT NULL AS hasChildren "
            . "FROM tr_channels AS m1 LEFT JOIN tr_channels AS m2 ON m1.id=m2.parent_id "
            . "WHERE m1.parent_id <=> $parentId "
            . "GROUP BY m1.id ORDER BY m1.sort ASC"
        );
        $children = $req->queryAll();
        $channels=Channels::model();
        foreach($children as $key => $value){
        	if($value['is_hidden']=='2'){
        		$value['text']="<span style='color:#AAAAAA;'>".$value['text']."</span>";
        	}
        	$pattern=$value['pattern'];
        	$archives_datas=$channels->get_channel_archives($value['id'],"","","t.update_time DESC",$pattern);
          $archives_numbers=count($archives_datas);	
        	switch($pattern){
        		case 'archives':
        		   $children[$key]['text']="<span>".$value['text']."</span>[id:".$value['id']."](文档:".$archives_numbers.")<div class='tree_operate'><a href='".$this->controller->createUrl("channels/edit",array('id'=>$value['id']))."' class='operate_green'>修改</a><a href='".$this->controller->createUrl('channels/add',array('parent_id'=>$value['id']))."' class='operate_green'>增加子栏目</a><a href='".$this->controller->createUrl('archive/index',array('channel_id'=>$value['id']))."' class='operate_green'>栏目内容</a><a href=\"javascript:frame_channel_move('".$this->controller->createUrl('channels/move',array('id'=>$value['id']))."');\" class='operate_green'>移动</a>".CHtml::link('预览',"javascript:self.parent.parent.location.href='".$channels->set_admin_channel_link($value['id'])."'",array('class'=>'operate_green','target'=>'_blank'))."<a href='".$this->controller->createUrl("channels/delete",array('id'=>$value['id']))."' class='operate_red'>删除</a></div>";
        		  break;
        		case 'travel':
        		  $children[$key]['text']="<span>".$value['text']."</span>[id:".$value['id']."](线路:".$archives_numbers.")<div class='tree_operate'><a href='".$this->controller->createUrl("channels/edit",array('id'=>$value['id']))."' class='operate_green'>修改</a><a href='".$this->controller->createUrl('channels/add',array('parent_id'=>$value['id']))."' class='operate_green'>增加子栏目</a><a href='".$this->controller->createUrl('travel/index',array('channel_id'=>$value['id']))."' class='operate_green'>栏目内容</a><a href=\"javascript:frame_channel_move('".$this->controller->createUrl('channels/move',array('id'=>$value['id']))."');\" class='operate_green'>移动</a>".CHtml::link('预览',"javascript:self.parent.parent.location.href='".$channels->set_admin_channel_link($value['id'])."'",array('class'=>'operate_green','target'=>'_blank'))."<a href='".$this->controller->createUrl("channels/delete",array('id'=>$value['id']))."' class='operate_red'>删除</a></div>";
        		  break;
        		  
        		 case 'hotels':
        		  $children[$key]['text']="<span>".$value['text']."</span>[id:".$value['id']."](酒店:".$archives_numbers.")<div class='tree_operate'><a href='".$this->controller->createUrl("channels/edit",array('id'=>$value['id']))."' class='operate_green'>修改</a><a href='".$this->controller->createUrl('channels/add',array('parent_id'=>$value['id']))."' class='operate_green'>增加子栏目</a><a href='".$this->controller->createUrl('hotels/index',array('channel_id'=>$value['id']))."' class='operate_green'>栏目内容</a><a href=\"javascript:frame_channel_move('".$this->controller->createUrl('channels/move',array('id'=>$value['id']))."');\" class='operate_green'>移动</a>".CHtml::link('预览',"javascript:self.parent.parent.location.href='".$channels->set_admin_channel_link($value['id'])."'",array('class'=>'operate_green','target'=>'_blank'))."<a href='".$this->controller->createUrl("channels/delete",array('id'=>$value['id']))."' class='operate_red'>删除</a></div>";
        		  break;
        		case 'downloads':
        		  $children[$key]['text']="<span>".$value['text']."</span>[id:".$value['id']."](下载:".$archives_numbers.")<div class='tree_operate'><a href='".$this->controller->createUrl("channels/edit",array('id'=>$value['id']))."' class='operate_green'>修改</a><a href='".$this->controller->createUrl('channels/add',array('parent_id'=>$value['id']))."' class='operate_green'>增加子栏目</a><a href='".$this->controller->createUrl('downloads/index',array('channel_id'=>$value['id']))."' class='operate_green'>栏目内容</a><a href=\"javascript:frame_channel_move('".$this->controller->createUrl('channels/move',array('id'=>$value['id']))."');\" class='operate_green'>移动</a>".CHtml::link('预览',"javascript:self.parent.parent.location.href='".$channels->set_admin_channel_link($value['id'])."'",array('class'=>'operate_green','target'=>'_blank'))."<a href='".$this->controller->createUrl("channels/delete",array('id'=>$value['id']))."' class='operate_red'>删除</a></div>";
        		  break;
        		case 'gallery':
        		  $children[$key]['text']="<span>".$value['text']."</span>[id:".$value['id']."](图片:".$archives_numbers.")<div class='tree_operate'><a href='".$this->controller->createUrl("channels/edit",array('id'=>$value['id']))."' class='operate_green'>修改</a><a href='".$this->controller->createUrl('channels/add',array('parent_id'=>$value['id']))."' class='operate_green'>增加子栏目</a><a href='".$this->controller->createUrl('gallery/index',array('channel_id'=>$value['id']))."' class='operate_green'>栏目内容</a><a href=\"javascript:frame_channel_move('".$this->controller->createUrl('channels/move',array('id'=>$value['id']))."');\" class='operate_green'>移动</a>".CHtml::link('预览',"javascript:self.parent.parent.location.href='".$channels->set_admin_channel_link($value['id'])."'",array('class'=>'operate_green','target'=>'_blank'))."<a href='".$this->controller->createUrl("channels/delete",array('id'=>$value['id']))."' class='operate_red'>删除</a></div>";
        		  break;
        		case 'group':
        		  $children[$key]['text']="<span>".$value['text']."</span>[id:".$value['id']."](团购:".$archives_numbers.")<div class='tree_operate'><a href='".$this->controller->createUrl("channels/edit",array('id'=>$value['id']))."' class='operate_green'>修改</a><a href='".$this->controller->createUrl('channels/add',array('parent_id'=>$value['id']))."' class='operate_green'>增加子栏目</a><a href='".$this->controller->createUrl('group/index',array('channel_id'=>$value['id']))."' class='operate_green'>栏目内容</a><a href=\"javascript:frame_channel_move('".$this->controller->createUrl('channels/move',array('id'=>$value['id']))."');\" class='operate_green'>移动</a>".CHtml::link('预览',"javascript:self.parent.parent.location.href='".$channels->set_admin_channel_link($value['id'])."'",array('class'=>'operate_green','target'=>'_blank'))."<a href='".$this->controller->createUrl("channels/delete",array('id'=>$value['id']))."' class='operate_red'>删除</a></div>";
        		  break;
        		default:
        		   $children[$key]['text']="<span>".$value['text']."</span>[id:".$value['id']."](文档:".$archives_numbers.")<div class='tree_operate'><a href='".$this->controller->createUrl("channels/edit",array('id'=>$value['id']))."' class='operate_green'>修改</a><a href='".$this->controller->createUrl('channels/add',array('parent_id'=>$value['id']))."' class='operate_green'>增加子栏目</a><a href='".$this->controller->createUrl('archive/index',array('channel_id'=>$value['id']))."' class='operate_green'>栏目内容</a><a href=\"javascript:frame_channel_move('".$this->controller->createUrl('channels/move',array('id'=>$value['id']))."');\" class='operate_green'>移动</a>".CHtml::link('预览',"javascript:self.parent.parent.location.href='".$channels->set_admin_channel_link($value['id'])."'",array('class'=>'operate_green','target'=>'_blank'))."<a href='".$this->controller->createUrl("channels/delete",array('id'=>$value['id']))."' class='operate_red'>删除</a></div>";
        		  break;
        	}
        }
        echo str_replace(
            '"hasChildren":"0"',
            '"hasChildren":false',
            CTreeView::saveDataAsJson($children)
        );
        exit();
    } 
}
?>
