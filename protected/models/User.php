<?php
/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property string $id
 * @property string $user_email
 * @property string $user_password
 * @property string $avater
 * @property integer $genter
 * @property integer $credits
 * @property integer $conpon
 * @property string $birthday
 * @property string $code 
 * @property string $user_salt
 * @property integer $user_status
 * @property string $login_time
 * @property string $create_time
 */

class User extends BaseActive{
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
	 */
	public $imagecode;
	public $rememberme;
	public $var_user_password;
	public $agreement;
	private $_identity;
	public $new_password;
	public $con_new_password;
	public $check_password;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{members}}';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  array('user_email,user_password','required','message'=>'{attribute}不能为空','on'=>'AdminLogin'),
		  array('imagecode','required','message'=>'验证码不能为空','on'=>'AdminLogin'),
      array('user_password','admin_authenticate','on'=>'AdminLogin'),
      array('rememberme', 'boolean','on'=>'AdminLogin'),
      array('user_login,user_password','required','message'=>'{attribute}不能为空','on'=>'Login'),
			array('imagecode','required','message'=>'验证码不能为空','on'=>'Login'),
			array('user_password', 'authenticate','on'=>'Login'),
			array('user_login,user_password','required','message'=>'{attribute}不能为空','on'=>'Homelogin'),
			array('user_password', 'homeauthenticate','on'=>'Homelogin'),
      array('user_login,user_email','required','message'=>'{attribute}不能为空','on'=>'AdminRegiste'),
      array('user_login','exist_user_login','on'=>'AdminRegiste'),
      array('user_email','exist_user_email','on'=>'AdminRegiste'),
      array('user_email','email','message'=>'{attribute}格式错误','on'=>'AdminRegiste'),
      array('user_login,user_email,user_password','required','message'=>'{attribute}不能为空','on'=>'WebRegiste'),
      array('user_login','exist_user_login','on'=>'WebRegiste'),
      array('user_email','exist_user_email','on'=>'WebRegiste'),
      array('user_email','email','message'=>'{attribute}格式错误','on'=>'WebRegiste'),
      array('var_user_password', 'compare', 'compareAttribute'=>'user_password','message'=>'两次输入的密码不一致','on'=>'WebRegiste'),
	    array('agreement', 'compare', 'compareValue'=>'1','message'=>'未同意誉游网会员协议','on'=>'WebRegiste'),
      array('user_login,user_email,user_password','required','message'=>'{attribute}不能为空','on'=>'UcenterRegiste'),
      array('user_login','exist_user_login','on'=>'UcenterRegiste'),
      array('user_email','exist_user_email','on'=>'UcenterRegiste'),
      array('user_email','email','message'=>'{attribute}格式错误','on'=>'UcenterRegiste'),
      array('user_email','required','message'=>'{attribute}不能为空','on'=>'EditEmail'),
      array('user_email','exist_user_email','on'=>'EditEmail'),
      array('user_email','email','message'=>'{attribute}格式错误','on'=>'EditEmail'),
      array('check_password','required','message'=>'旧密码不能为空','on'=>'EditPassword'),
      array('new_password','required','message'=>'新密码不能为空','on'=>'EditPassword'),
      array('con_new_password','required','message'=>'确认密码不能为空','on'=>'EditPassword'),
      array('new_password', 'compare', 'compareAttribute'=>'con_new_password','message'=>'两次输入的密码不一致','on'=>'EditPassword'),
      
      array('check_password','required','message'=>'旧密码不能为空','on'=>'EditPayPassword'),
      array('new_password','required','message'=>'新密码不能为空','on'=>'EditPayPassword'),
      array('con_new_password','required','message'=>'确认密码不能为空','on'=>'EditPayPassword'),
      array('new_password', 'compare', 'compareAttribute'=>'con_new_password','message'=>'两次输入的密码不一致','on'=>'EditPayPassword'),
      
      
      array('new_password','required','message'=>'新密码不能为空','on'=>'ValidatePassword'),
      array('con_new_password','required','message'=>'确认密码不能为空','on'=>'ValidatePassword'),
      array('new_password', 'compare', 'compareAttribute'=>'con_new_password','message'=>'两次输入的密码不一致','on'=>'ValidatePassword'),
      array('user_login,user_email','required','message'=>'{attribute}不能为空','on'=>'ForgotPassword'),
      array('user_login','validate_user_login','on'=>'ForgotPassword'),
      array('new_password,con_new_password','required','message'=>'新密码不能为空','on'=>'EditAdminPassword'),
      array('con_new_password','required','message'=>'确认密码不能为空','on'=>'EditAdminPassword'),
      array('new_password', 'compare', 'compareAttribute'=>'con_new_password','message'=>'两次输入的密码不一致','on'=>'EditAdminPassword'),
      
      array('new_password,con_new_password','required','message'=>'新密码不能为空','on'=>'EditAdminPayPassword'),
      array('con_new_password','required','message'=>'确认密码不能为空','on'=>'EditAdminPayPassword'),
      array('new_password', 'compare', 'compareAttribute'=>'con_new_password','message'=>'两次输入的密码不一致','on'=>'EditAdminPayPassword'),
      
      
      array('check_password','exist_password','on'=>'EditPassword'),
      array('company_id','required','message'=>'{attribute}不能为空','on'=>'SetRegion'),
      array('user_email','length','max'=>50),
      array('user_login','length','max'=>30),
			array('admin_status,genter,founder,cell_phone_verification', 'length', 'max'=>1),
			array('user_password,pay_password,permissions,invite_code', 'length', 'max'=>100),
			array('avater','length','max'=>'200'),
			array('birthday','length','max'=>'10'),
			array('code','length','max'=>'18'),
			array('real_name,cell_phone','length','max'=>30),
			array('address','length','max'=>200),
			array('user_salt', 'length', 'max'=>6),
			array('company_id,credits,conpon','length','max'=>11),
			array('create_time,create_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,user_email,user_password,pay_password,user_salt,admin_status,real_name,address,create_id,cell_phone,cell_phone_verification,create_time,avater,genter,credits,conpon,birthday,code,invite_code,founder,company_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations(){
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		 'User'=>array(self::BELONGS_TO, 'User', 'create_id'),
		 'Company'=>array(self::BELONGS_TO,'Company','company_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels(){
		return array(
			'id' => 'ID',
			'user_login'=>'用户名',
			'avater'=>'用户头像',
			'genter'=>'性别',
			'credits'=>'积分',
			'conpon'=>'抵用卷',
			'birthday'=>'生日',
			'code'=>'身份证号码',
			'user_email' => '用户邮箱',
			'real_name'=>'真实姓名',
			'cell_phone'=>'手机号码',
			'cell_phone_verification'=>'手机验证',
			'address'=>'联系地址',
			'company_id'=>'所属公司',
			'founder'=>'创始人',
			'admin_status'=>'管理员',
			'user_password' => '用户密码',
			'pay_password'=>'支付密码',
			'user_salt' => '用户密钥',
			'permissions'=>'用户权限',
			'invite_code'=>'邀请码',
			'create_id' => '创建人',
			'create_time' => '注册时间',
		);
	}

	
	public function insert_datas(){
		if(!$this->hasErrors()){
				$datas=$this->save();
			  return $datas;
		}
	}
	
	function beforeSave(){
	  if(parent::beforeSave()){
			if($this->isNewRecord){
				$this->create_id=Yii::app()->user->id;
				$this->create_time=Util::current_time('timestamp');
			}else{
			}
			return true;
		}else{
			return false;
		}
	}
	
		
	function show_attribute($attribute_id){
	 switch($attribute_id){
	    case 'founder':
	      $founder=CV::$founder;
	    	return $founder[$this->founder];
	    	break;
		default:
		  return $this->$attribute_id;
			break;
	 }
	}
	
	function exist_password(){
		$user_salt=Util::createSalt($this->user_salt);
		if($this->user_password!=Util::hc($this->check_password,$user_salt)){
			$this->addError("check_password","密码错误");
		}
	}
	function exist_user_login(){
		$id=$this->id;
		$sys_config=new SysConfig();
	  $sys_config_datas=$sys_config->get_syscfg_val("sfc_filter_username");
	  $sfc_filter_username=$sys_config_datas['sfc_filter_username'];
	  if(!empty($sfc_filter_username)&&!empty($this->user_login)){
	  	$pos = strpos($sfc_filter_username,$this->user_login);
	  	if ($pos === false) {
			} else {
    		$this->addError("user_login","用户名已被禁止");
    		return;
			}
	  }
		if(!empty($id)){
			 $get_table_datas=$this->get_table_datas($id,array());
			 if($get_table_datas->user_login!=$this->user_login){
			 	 $find_datas=$this->find(array(
          'select'=>'user_login',
          'condition'=>'user_login=:user_login',
          'params'=>array(':user_login' => $this->user_login),
         ));
			 }
		}else{
		  
			$find_datas=$this->find(array(
         'select'=>'user_login',
         'condition'=>'user_login=:user_login',
         'params'=>array(':user_login' => $this->user_login),
       ));
		}
     if(!empty($find_datas)){
     	 $this->addError("user_login","用户名已存在");
     }
	}
	function exist_user_email(){
		$id=$this->id;
		if(!empty($id)){
			 $get_table_datas=$this->get_table_datas($id,array());
			 if($get_table_datas->user_email!=$this->user_email){
			 	 $find_datas=$this->find(array(
          'select'=>'user_email',
          'condition'=>'user_email=:user_email',
          'params'=>array(':user_email' => $this->user_email),
         ));
			 }
		}else{
			$find_datas=$this->find(array(
         'select'=>'user_email',
         'condition'=>'user_email=:user_email',
         'params'=>array(':user_email' => $this->user_email),
       ));
		}
     if(!empty($find_datas)){
     	 $this->addError("user_email","用户邮箱已存在");
     }
	}
	function validate_user_login(){
			$find_datas=$this->find(array(
         'select'=>'id',
         'condition'=>'user_login=:user_login AND user_email=:user_email',
         'params'=>array(':user_login'=>$this->user_login,':user_email' => $this->user_email),
      ));

     if(empty($find_datas)){
     	 $this->addError("user_login","用户名或邮箱不正确");
     }
	}
	function get_operate(){
		  $user=new User();
		  $user_permission_name=$user->get_permissions_name();
		  $controller_id=Yii::app()->getController()->getId();
		  $return_str="<div class='operate_button'>";
		  if(Util::is_permission($user_permission_name,"edit"))
		    $return_str.=CHtml::link('修改',array($controller_id."/edit","id"=>$this->id),array('class'=>'operate_green'));
		  /*
		  if($this->id!='1'){
		    $return_str.=CHtml::link('删除','javascript:void(0);',array('id'=>'delete_'.$this->id,'class'=>'operate_red','onclick'=>"javascript:ajax_delete('".Yii::app()->getController()->createUrl('main/delete')."','".get_class($this)."','".$this->id."');"));
		  }
		  */
		  if(Util::is_permission($user_permission_name,"setregion")){
		  	$return_str.=CHtml::link('设置分站',array($controller_id."/setregion","id"=>$this->id),array('class'=>'operate_green'));
		  }
		  if(Util::is_permission($user_permission_name,"editpassword"))
		  	$return_str.=CHtml::link('修改密码',array($controller_id."/editpassword","id"=>$this->id),array('class'=>'operate_green'));
		  	
		  if(Util::is_permission($user_permission_name,"editpaypassword"))
		  	$return_str.=CHtml::link('修改支付密码',array($controller_id."/editpaypassword","id"=>$this->id),array('class'=>'operate_green'));
		  	
		  	
		  if(Util::is_permission($user_permission_name,"editconpon"))
		  	$return_str.=CHtml::link('修改抵用劵',array($controller_id."/editconpon","id"=>$this->id),array('class'=>'operate_green'));
		  
		  $return_str.="</div>";
		  return $return_str;
	}
	function format_create_time(){
		return date("Y-m-d H:i:s",$this->create_time);
	}
	 /*
	* 显示用户的创始人信息
	* @return string 返回用户的创始人信息
	* @auther lxf
	* @version 1.0.0
	*/
	function show_admin_status(){
		$admin_status=$this->admin_status;
		$admin_status_arr=CV::$admin_status;
		return $admin_status_arr[$admin_status];
	}
	//̨û¼
	public function admin_authenticate($attribute,$params){
		if(!$this->hasErrors()){
			$img_code=$_SESSION["__img_code__"];
			if(md5(strtoupper($this->imagecode))!=$img_code){
				 $this->addError('imagecode','验证码不正确');
				 return false;
		  }else{
		  	  $ip_flag=Util::check_filter_ip();
		  	  if($ip_flag){
		  	  	$this->addError('imagecode','所在IP已被禁止');
		  	  }else{
		  	  	$this->_identity=new UserIdentity($this->user_email,$this->user_password);
				   	if(!$this->_identity->authenticate()){
				  		if($this->_identity->errorCode===UserIdentity::ERROR_OPERATE){
      	      	$this->addError('user_email',"用户不存在");
             	}else if($this->_identity->errorCode==UserIdentity::ERROR_STATUS){
             		$this->addError('imagecode',"你所在商铺未认证");
             	}else if($this->_identity->errorCode==UserIdentity::ERROR_USER_TYPE){
             		$this->addError('user_email',"用户不存在");
             	}else{
             	 	$this->addError('user_password','用户名或密码错误');
             	}             
						}
		  	  }
			 }
		}
  }
//̨û¼
	public function admin_login(){

		 if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->user_email,$this->user_password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_OPERATE){
      	$this->addError('user_email',"用户不存在");
      	return false;     
    }
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE){
			  Yii::app()->user->allowAutoLogin=true;
			  if($this->rememberme){
			  	$duration=(3600*24*14);
			  	Yii::app()->session->timeout=(3600*24*14);
			  }else{
			  	$duration=(3600*5);
			  	Yii::app()->session->timeout=(3600*5);
			  }
			 
				Yii::app()->user->login($this->_identity,$duration);
				
				$this->change_user_login_state();
				return true;
		}else
			return false;
	}
	
		
	public function change_user_login_state(){
		$user_id=Yii::app()->user->id;
		if(empty($user_id)){
			return;
		}
		$user_data=$this->findByPk($user_id);
		$ip=Util::getIp();
		$ip_convert=IpConvert::get();
		$address=$ip_convert->convertip($ip);
		$login_status=new LoginStatus();
		$login_status->login_ip=$ip;
		$login_status->login_address=$address;
    $login_status->insert_datas();
	}
		/*
	 * 获取用户的权限值
	 * @param int $user_id 用户ID
	 * @return string 返回用户的权限值
	 * @auther lxf
	 * @version 1.0.0
	 */
	public function get_user_permissions($user_id=""){
		$user_id=empty($user_id)?Yii::app()->user->id:$user_id;
		if(!$user_id){
			return;
		}else{
			$user_data=$this->get_table_datas($user_id);
			if(!empty($user_data)){
				return $user_data->permissions;
			}else{
				return;
			}
		}
	}
			/*
	 * 获取用户的权限值
	 * @param int $user_id 用户ID
	 * @return string 返回用户的权限值
	 * @auther lxf
	 * @version 1.0.0
	 */
	public function get_permissions_name($user_id=""){
		$user_id=empty($user_id)?Yii::app()->user->id:$user_id;
		if(!$user_id){
			return;
		}else{
			$user_data=$this->get_table_datas($user_id);
			if(!empty($user_data)){
				$permissions=$user_data->permissions;
				$permissions=explode(",",$permissions);
				$permission_name=array();
				$permission_obj=new Permissions();
				foreach($permissions as $key => $value){
					$permission_obj_data=$permission_obj->findByPk($value);
					array_push($permission_name,$permission_obj_data->id);
				}
				return $permission_name;
			}else{
				return;
			}
		}
	}
	public function authenticate($attribute,$params){
		session_start();
		if(!$this->hasErrors())
		{
			$img_code=$_SESSION["__img_code__"];
			if(md5(strtoupper($this->imagecode))!=$img_code){
				 $this->addError('imagecode','验证码不正确');
				 return false;
		  }else{
		  	  $ip_flag=Util::check_filter_ip();
		  	  if($ip_flag){
		  	  	$this->addError('rememberme','所在IP已被禁止');
		  	  }else{
				 		$this->_identity=new UserIdentity($this->user_login,$this->user_password);
				  	if(!$this->_identity->authenticate()){
             	$this->addError('user_password','用户名或密码不正确');
						}
				 }
		}
	}
 }
 
 	public function homeauthenticate($attribute,$params){
		
		if(!$this->hasErrors())
		{
		  	  $ip_flag=Util::check_filter_ip();
		  	  if($ip_flag){
		  	  	$this->addError('rememberme','所在IP已被禁止');
		  	  }else{
				 		$this->_identity=new UserIdentity($this->user_login,$this->user_password);
				  	if(!$this->_identity->authenticate()){
             	$this->addError('user_password','用户名或密码不正确');
						}
				 }
	}
 }
 
	//登录
	public function login(){
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->user_login,$this->user_password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			  Yii::app()->user->allowAutoLogin=true;
				if($this->rememberme){
			  	$duration=(3600*24*14);
			  	Yii::app()->session->timeout=(3600*24*14);
			  }else{
			  	$duration=(3600*5);
			  	Yii::app()->session->timeout=(3600*5);
			  }
				Yii::app()->user->login($this->_identity,$duration);
				$this->change_user_login_state();
				return true;
		}else
			return false;
	}
  /*
	* 获取用户的角色名称
	* @return string 返回用户的所有角色名称
	* @auther lxf
	* @version 1.0.0
	*/
	public function show_user_permissions(){
		$user_permission=$this->permissions;
		$permissions=new Permissions();
		$permissions_datas=$permissions->findAll(array('select'=>'permissions_name','condition'=>"FIND_IN_SET(id,'$user_permission')",'params'=>array()));
		$permissions_name="";
		foreach($permissions_datas as $key => $value){
			if(empty($permissions_name)){
				$permissions_name=$value->permissions_name;
			}else{
				$permissions_name.=",".$value->permissions_name;
			}
		}
		$user=new User();
		$user_permission_name=$user->get_permissions_name();
		if(Util::is_permission($user_permission_name,"permission"))
		    $permissions_name.="<a class=\"operate_green\" href=\"javascript:set_user_permissions('".$this->id."')\">设置角色</a>";
		return $permissions_name;
	}
 //获取分站的用户选择框
 public function get_user_select(){
   $user_select=array();
   $user_datas=$this->findAll();
   foreach($user_datas as $key => $value){
     $user_select[$value->id]=$value->real_name;	
   }
 	 return $user_select;
 }
	
}