<?php
class GroupCCommand extends CConsoleCommand
{
	public function run($args){
		$current_date=date("Y-m-d H:00:00");
	 	$group=Group::model();
	 	$group->updateAll(array('open'=>'2'),"status=:status AND start_time<=:start_time AND open=:open",array(':status'=>'2',':start_time'=>$current_date,':open'=>'1'));
	 	$group->updateAll(array('open'=>'3'),"status=:status AND end_time<=:end_time AND open=:open",array(':status'=>'2',':end_time'=>$current_date,':open'=>'2'));
  }
}
