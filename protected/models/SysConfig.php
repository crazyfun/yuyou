<?php

/**
 * This is the model class for table "{{sys_config}}".
 *
 * The followings are the available columns in table '{{sys_config}}':
 * @property string $id
 * @property string $sci_name
 * @property string $sci_value
 */
class SysConfig extends BaseActive
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return SysConfig the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{sys_config}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sci_name', 'length', 'max'=>32),
			array('sci_value', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sci_name', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sci_name' => '配置项名称',
			'sci_value' => '配置项值',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('sci_name',$this->sci_name,true);
		$criteria->compare('sci_value',$this->sci_value,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	//获取全部的配置项
  public function get_all_syscfg(){
  	 $cfgarr = array();
  	 $value=Yii::app()->cache2->get("AllSyscfg");
			if($value===false)
			{
        $alldat = $this->get_table_datas( NULL, array('condition'=>"",'params'=>array()) );
		    if(!empty($alldat)){
		  		foreach( $alldat as $datcolt){
		  			$scin = $datcolt->sci_name;
		  			$sciv = $datcolt->sci_value;
		  			$cfgarr[$scin] = $sciv;
		  		}	
		    }
		    $value=$cfgarr;
		    Yii::app()->cache2->set("AllSyscfg",$value);
		  }
      return $value;
  }
  
  public function get_admin_all_sysconfig(){
  	    $cfgarr = array();
        $alldat = $this->get_table_datas( NULL, array('condition'=>"",'params'=>array()) );
		    if(!empty($alldat)){
		  		foreach( $alldat as $datcolt){
		  			$scin = $datcolt->sci_name;
		  			$sciv = $datcolt->sci_value;
		  			$cfgarr[$scin] = $sciv;
		  		}	
		    }
         return $cfgarr;
  }
  
  
  //获取一个配置项
  public function get_syscfg_val($syscfg_name){
  	  if(empty($syscfg_name)){
  	  	return NULL;
  	  }
  	  $cfgarr = array();
  	  
		  $alldat = $this->get_table_datas( NULL, array('condition'=>"1=1 AND sci_name=:sci_name",'params'=>array(':sci_name'=>$syscfg_name)) );
		  if( !empty($alldat) ){
		  	foreach( $alldat as $datcolt){
		  		$scin = $datcolt->sci_name;
		  		$sciv = $datcolt->sci_value;
		  		$cfgarr[$scin] = $sciv;
		  	}
		  	return $cfgarr;
		  }else{
		  	return array();
		  }
  }
}