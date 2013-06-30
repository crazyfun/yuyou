<?php
class TraveldateAction extends  BaseAction{
    public function beforeAction(){
    	  if(Yii::app()->request->isAjaxRequest){
    		  Util::reset_vars();
          return true;
        }else{
        	return false;
        }
    }
    protected function do_action(){
        $id=$_REQUEST['id'];
        $year=$_REQUEST['year'];
        $month=$_REQUEST['month'];
        $travel_date_model=TravelDate::model();
        $travel_date_datas=$travel_date_model->findAll("travel_id=:travel_id AND DATE_FORMAT(t.travel_date,'%Y-%m')<='".date("Y-m",mktime(0,0,0,$month,1,$year))."'",array(':travel_id'=>$id));
        $mix_date=array();
        foreach($travel_date_datas as $key => $value){
        	$id=$value->id;
        	$travel_id=$value->travel_id;
        	$return_array=array();
        	$date_type=$value->date_type;
        	$type_value1=$value->type_value1;
        	$type_value2=$value->type_value2;
        	$travel_date=$value->travel_date;
        	$seats=$value->seats;
        	$adult_price=$value->adult_price;
        	$child_price=$value->child_price;
        	switch($date_type){
        		case '1':
        		  switch($type_value1){
        		  	case '1':
        		  	   switch($type_value2){
        		  	   	 case '1':
        		  	   	   
        		  	   	   $return_array=$travel_date_model->get_month_days(mktime(0,0,0,$month,1,$year));
        		  	   	   break;
        		  	   	 default:
        		  	   	   $return_array=$travel_date_model->get_month_weekly(mktime(0,0,0,$month,1,$year),$type_value2);
        		  	   	   break;
        		  	   }
        		  	  break;
        		  	default:
        		  	if(($type_value1-1)==$month){
        		  	  switch($type_value2){
        		  	   	 case '1':
        		  	   	   $return_array=$travel_date_model->get_month_days(mktime(0,0,0,$type_value1-1,1,$year));
        		  	   	   break;
        		  	   	 default:
        		  	   	   $return_array=$travel_date_model->get_month_weekly(mktime(0,0,0,$type_value1-1,1,$year),$type_value2);
        		  	   	   break;
        		  	   }
        		  	}
        		  	  break;
        		  }
        		  break;
        		case '2':
        		  $t=date("t",mktime(0,0,0,$month,1,$year));
        		  if(strtotime($type_value2)>=mktime(0,0,0,$month,1,$year)&& strtotime($type_value1)<=mktime(0,0,0,$month,$t,$year)){
        		  	if(strtotime($type_value1)<=mktime(0,0,0,$month,1,$year)){
        		  		$type_value1=date("Y-m-d",mktime(0,0,0,$month,1,$year));
        		  	}
        		  	if(strtotime($type_value2)>=mktime(0,0,0,$month,$t,$year)){
        		  		$type_value2=date("Y-m-d",mktime(0,0,0,$month,$t,$year));
        		  	}
        		  	
        		    $return_array=$travel_date_model->get_period_date($type_value1,$type_value2);
        		  }
        		  break;
        		default:
        		  break;
        	}
        	if(!in_array($travel_date,$return_array)){
        		if(date("Y-m",strtotime($travel_date))==date("Y-m",mktime(0,0,0,$month,1,$year))){
        			$return_array[]=$travel_date;
        		}
        	}
        	foreach($return_array as $key => $value){
        		$show_array=array();
        		if(strtotime($value)>=strtotime($travel_date)){
        			$show_array['id']=$id;
        			$show_array['travel_id']=$travel_id;
        			$show_array['date']=$value;
        			if(empty($seats)){
        				$show_array['seats']="充足";
        			}else{
        				$travel_order_numbers=TravelOrderNumbers::model();
            	  $order_numbers_data=$travel_order_numbers->find("t.travel_id=:travel_id AND t.start_date=:start_date",array(':travel_id'=>$travel_id,':start_date'=>$value));
        				$show_array['seats']="余".($seats-$order_numbers_data->order_numbers);
        			}
        			$show_array['price']=intval($adult_price);
        			$show_array['child_price']=intval($child_price);
        			array_push($mix_date,$show_array);
        		}
        	}
        }
        $mix_date=$travel_date_model->date_unique($mix_date);
        usort($mix_date, "date_cmp");//对时间排序
    	  $result=Util::combo_ajax_message('1',$mix_date,"");
        echo $result;
    } 
}

function date_cmp($a, $b)
{
    if ($a['date'] == $b['date']) {
        return 0;
    }
    return ($a['date'] < $b['date']) ? -1 : 1;
}
?>
