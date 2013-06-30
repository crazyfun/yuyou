<div class="web_top">
    <div class="top_link">
        <div class="wel_text">
        	<?php if(Yii::app()->user->isGuest){
        	?>
        		<span>欢迎来到誉游网！</span>
        	  <a href="<?php echo $this->createUrl("login/index");?>" class="home_login" title="登入">登入</a>
        	  <a href="<?php echo $this->createUrl("registe/index");?>" class="home_login" title="游客注册">游客注册</a>
        	  <a href="<?php echo $this->createUrl("registe/company");?>" class="home_login" title="商家注册">商家注册</a>
        	<?php
        	  }else{
        	?>
        	  	<span>欢迎<a href="<?php echo $this->createUrl("user/index");?>" class="home_user_name"><?php echo Yii::app()->user->name;?></a>来到誉游网！<a href="<?php echo $this->createUrl("login/logout");?>" class="home_login" title="安全退出">退出</a></span>
        	<?php 
        	  }
        	?>
        	 
        </div>
        <div class="right_links"><span href="javascript:void();" style="position:relative;z-index:99;" id="my_order">我的订单
        	   <ul class="my_order_ul">
                <li><a href="<?php echo $this->createUrl("user/travelorder");?>">我的线路订单</a></li>
                <li><a href="<?php echo $this->createUrl("user/hotelsorder");?>">我的酒店订单</a></li>
                <li><a href="<?php echo $this->createUrl("user/grouporder");?>">我的团购订单</a></li>
             </ul>
        	</span><span>|</span><a href="<?php echo $this->createUrl("help/index");?>">在线帮助</a><span>|</span><a href="<?php echo $this->createUrl("webmap/index");?>">网站地图</a><span>|</span><a href="javascript:setHomepage('<?php echo Yii::app()->homeUrl;?>');">设为主页</a><span>|</span><a href="javascript:addCookie('<?php echo Yii::app()->homeUrl;?>','<?php echo Yii::app()->name;?>');">收藏</a>
        		<!--<span>|</span><a href="#">关注誉游网微博</a>--></div>
    </div><!--top_link end-->
    <div class="top_sch_con">
        <div class="logo_Con"><a href="<?php echo Yii::app()->homeUrl;?>"><img src="/themes/travel/css/images/logo.jpg" /></a></div>
         <?php 
		  	 		 	    $ip_convert=IpConvert::get();
		  	 		 	    $region_session=$ip_convert->init_region();
		  	 		 	   
		  	 		 	    
		  	 ?>
        <div class="change_City">出发城市：<?php echo $region_session['name'];?><a href="<?php echo $this->createUrl("region/index");?>">【切换城市】</a></div>
                   <?php
                      Yii::app()->clientScript->registerScriptFile('/js/select.js');
		  	 	   	 	    	$form=$this->beginWidget('EActiveForm', array(
	        								'id'=>'header_search',
          								'action'=>$this->createUrl("search/index"),
	        								'enableAjaxValidation'=>false,
	        								'htmlOptions'=>array('enctype'=>'multipart/form-data'),
         								));
         							?>
        <div class="sch_box"> 
        	<div class="select_js">
        	   <p>线路</p>
        	   <ul class="search_ul">
                <li ectype="travel">线路</li>
                <li ectype="hotels">酒店</li>
             </ul>
            <input type="hidden" name="action" value="travel" />
            
          </div>
          <input type="text" name="keywords" value="" class="t_put" id="header_search_keywords"/>
          <input type="submit" class="s_put" value=""/>
        </div>
       <?php $this->endWidget(); ?>
        <!--<div class="tel_Con"><img src="/themes/travel/css/images/top_tel.jpg" /></div>-->
    </div><!--top_sch_con end--> 
</div><!--web_top end-->


<div class="nav_bg">
    <div class="nav_con">
    	
    	 <?php
         BZ::menus("view/menus/children/n");
       ?>
        <div><!--<a href="<?php echo $this->createUrl("group/list",array('channel'=>'137'));?>">团购</a><span>|</span>--><a href="/mchannels/information/channel/136.shtml">资讯</a></div>
    </div>
</div>
<!--nav_bg end-->
<div class="site_nav">
  <ul>
    <li>您当前所处的位置：</li>
    <li><?php $this->widget('zii.widgets.CBreadcrumbs', array(
								     'links'=>$this->breadcrumbs,
							    )); ?>
		</li>
    
  </ul>
</div><!--//当前位置-->

