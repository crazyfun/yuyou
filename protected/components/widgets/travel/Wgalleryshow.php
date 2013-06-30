<?php
class Wgalleryshow extends CWidget
{
    public $view="";
    public $id="";
    public function run(){
    	 $gallery_image=GalleryImages::model();
    	 $gallery=Gallery::model();
    	 $gallery_image_datas=$gallery_image->with("Gallery","Images")->findAll("t.gallery_id=:gallery_id",array(':gallery_id'=>$this->id));
    	 $current_data=$gallery->findByPk($this->id);
    	 $first_data=$gallery->find(array('condition'=>'t.id<:id AND t.status=:status','params'=>array(':id'=>$this->id,':status'=>'2'),'order'=>'t.id DESC'));
			 $next_data=$gallery->find(array('condition'=>'t.id>:id  AND t.status=:status','params'=>array(':id'=>$this->id,':status'=>'2'),'order'=>'t.id ASC'));
			 $first_href=$gallery->set_channel_link("gallery",$first_data->id);
			 $next_href=$gallery->set_channel_link("gallery",$next_data->id);

       $this->render("/galleryshow/".$this->view,array('content'=>$current_data,'first_data'=>$first_data,'next_data'=>$next_data,'gallery_image_datas'=>$gallery_image_datas,'first_href'=>$first_href,'next_href'=>$next_href,'cssPath'=>$cssPath,'jsPath'=>$jsPath));
    }    
   
}
