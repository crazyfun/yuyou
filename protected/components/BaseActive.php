<?php
class BaseActive extends CActiveRecord{

	
  //得到表的数据
	public function get_table_datas($pk_id="",$conditions=array()){
		if(!empty($pk_id)){
			$datas=$this->findByPk($pk_id);
      return $datas;
		}else{
         $datas=$this->findAll($conditions);
         return $datas;
		}
	}
 //组合查询的条件 $is_total_num 是否需要返回中数量用于分页
	public function com_condititions($condition=array()){
    $return_array=array();
    $tem_params=array();
    $tem_condition="";
		foreach((array)$condition as $key => $value){
			if(!empty($value)){
				if(empty($tem_condition)){
				 $tem_condition.=$key."=:".$key;
				}else{
					
				 $tem_condition.=" AND ".$key."=:".$key;
				}
			   $tem_params[":".$key]=$value;
		 }
		}
		$return_array['condition']=$tem_condition;
		$return_array['params']=$tem_params;
		return $return_array;
	}
	
	//删除一笔数据
	public function delete_table_datas($pk_id="",$condition=array()){
		if(!empty($pk_id)){
			$datas=$this->deleteByPk($pk_id,"",array());
		}else{
       $datas=$this->deleteAll($condition);
		}
		return $datas;
	}
	
		//跟新一笔数据
	public function update_table_datas($pk_id="",$attributes,$condition=array()){
		 
		 if(!empty($pk_id)){
		   $update_datas=$this->updateByPk($pk_id,$attributes,$condition);
		 }else{
		 	 $update_datas=$this->updateAll($attributes,$condition);
		 }
     return $update_datas;
	} 
	
	
	public function afterConstruct(){
	
	}
	
}
?>
