<?php
class CropAction extends  BaseAction{
    public function beforeAction(){
    	  $this->controller->init_page();
        return true;
    }
    protected function do_action(){
	    $image_name=$_REQUEST['image_name'];
	    $crop_size=$_REQUEST['crop_size'];
	    $crop_aspect=$_REQUEST['crop_aspect'];
	    if(isset($_POST['crop'])){
	      $crop_x=$_POST['crop_x'];
	      $crop_y=$_POST['crop_y'];
	      $crop_w=$_POST['crop_w'];
	      $crop_h=$_POST['crop_h'];
	      $image = Yii::app()->image->load($image_name);
		    $image->crop($crop_w,$crop_h,$crop_y,$crop_x);
		    $image->save($image_name); 
		    $image_path_array=explode("/",$image_name);
		    $tem_image_name=array_pop($image_path_array);
		    $tem_image_path=implode("/",$image_path_array);
		    if(!empty($crop_size)){
		    	$crop_size_array=explode(",",$crop_size);
		    	foreach($crop_size_array as $key => $value){
		    		$tem_size=explode("*",$value);
		    		$width=$tem_size[0];
		    		$height=$tem_size[1];
		    		$image = Yii::app()->image->load($image_name);
		        $image->resize($width,$height);
		        $image->save(Util::rename_thumb_file($width,$height,$tem_image_path,$tem_image_name)); 
		    	}
		    }
		    $success_message=true;
	    }
	   $image_size=getimagesize($image_name);
	   $image_width=$image_size[0];
	   $image_height=$image_size[1];
     $this->display('crop',array('image_name'=>$image_name,'crop_size'=>$crop_size,'crop_aspect'=>$crop_aspect,'success_message'=>$success_message,'image_width'=>$image_width,'image_height'=>$image_height));
  } 
}
?>
