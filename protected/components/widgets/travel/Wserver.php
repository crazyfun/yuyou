<?php

class Wserver extends CWidget
{
	  public $view="";
	  public $id="";
  public function run(){
   $downloads_server=DownloadsServer::model();
   $downloads_server_datas=$downloads_server->findAll('downloads_id=:downloads_id',array(':downloads_id'=>$this->id));
   
   $this->render("/server/".$this->view,array('content'=>$downloads_server_datas));
  }
}
