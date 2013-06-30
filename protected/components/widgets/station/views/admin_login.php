<?php 
  $cssPath=$this->controller->get_css_path();
?>
<!--HOLD旅游登录界面 五-->
<body class="login_body">
	
	
<div class="b_top_bg">
<div class="b_top">
    <div class="b_logo">&nbsp;</div>
    <div class="b_text"><a class="mf_zc" href="/registe/company">免费注册</a>
    	   <span><img border="0" src="http://wpa.qq.com/pa?p=2:2294251214:41" alt="点击这里给我发消息" title="点击这里给我发消息"></a></span>
         <span><img border="0" src="http://wpa.qq.com/pa?p=2:290030958:41" alt="点击这里给我发消息" title="点击这里给我发消息"></a></span>
         <span><img border="0" src="http://wpa.qq.com/pa?p=2:306816844:41" alt="点击这里给我发消息" title="点击这里给我发消息"></a></span>
    </div>
</div>
</div><!--//头部-->
<div class="b_con_bg">
  <div class="b_con_box">
          <div class="b_con_loginbox"><!--登录框-->
             <div class="b_con_login">
               <h2><span><a href="/login/index">会员登录</a></span><span><a href="javascript:void(0);" class="b_ona">商户登录</a></span></h2>
               <div class="b_login_li"> 
               	<?php $form=$this->beginWidget('CActiveForm', array(
        					'id'=>'login-form',
        					'enableAjaxValidation'=>true,
        				)); ?>
                 <ul>
                   <li><span class="d_left">账号：</span><span class="d_right"><?php echo $form->textField($model,"user_email",array("class"=>"w_mz"));?></span><span class="msg_er"><?php echo $form->error($model,"user_email");?></span></li>
                   <li><span class="d_left">密码：</span><span class="d_right"><?php echo $form->passwordField($model,"user_password",array("class"=>"w_mz"));?></span><span class="msg_er"><?php echo $form->error($model,"user_password");?></span></li>
                   <li><span class="d_left">验证码：</span><span class="d_right"><?php echo $form->textField($model,"imagecode",array("class"=>"w_mz"));?></span><span class="d_right"><a onclick="document.getElementById('__code__').src = 'http://shop.lypub.com/imagesecurity/code.php?id=' + ++ts; return false"><img id="__code__" src="<?php echo 'http://shop.lypub.com/imagesecurity/code.php?id='.$ts;?>" /></a></span><span class="msg_er"><?php echo $form->error($model,"imagecode");?></span></li>
                   <li><span class="d_left">&nbsp;</span><span class="d_right">两周内不再登录<?php echo $form->checkBox($model,'rememberme',array('class'=>'content_checkbox'));?></span><span class="msg_er"></span></li>
                 </ul>
                 <?php echo CHtml::submitButton("登录",array('class'=>"d_bnt"));?>
                 <?php $this->endWidget(); ?>
               </div>
               <!--//b_login_li-->
            </div>
          </div>
          <div class="b_con_list"><!--列表信息-->
             <div class="b_con_lbox"><!--最新产品-->
                 <h2 class="b_con_title">最新产品</h2>
                 <div class="b_lbox_li">
                   <ul onmouseout="iScrollAmount=1" onmouseover="iScrollAmount=0" id="travel_mq" style="height:300px;overflow:hidden;">
                     <?php foreach($travel_datas as $key => $value){?>
                     	  <li><a href="/travel/show/id/<?php echo $value->id;?>" title="<?php echo $value->title;?>"><?php echo $value->title;?>【<?php echo $value->StartRegion->region_name;?> -> <?php echo $value->EndRegion->region_name;?>】</a></li>
                     <?php } ?>
                   
                   </ul>
                 </div>
             </div><!--最新产品-->
             <div class="b_con_lbox mleft"><!--即时预订-->
                 <h2 class="b_con_title">即时预订</h2>
                 <div class="b_lbox_li">
                   <ul onmouseout="iScrollAmount=1" onmouseover="iScrollAmount=0" id="order_mq" style="height:300px;overflow:hidden;">
                     <?php foreach($travel_order_datas as $key => $value){ ?>
                     	
                     	<li><a href="/travel/show/id/<?php echo $value->Travel->id;?>" title="<?php echo $value->Travel->title;?>"><?php echo $value->Travel->title;?></a></li>
                     	
                    <?php } ?>

                   </ul>
                 </div>
             </div><!--//即时预订-->
          </div>
           <div style="clear:both"></div>
          <div class="b_footer"><!--底部-->
             <a href="/" title="网站首页">网站首页</a>|<a href="#">联系我们</a>
          </div>
  </div>
 <div style="clear:both"></div>
</div>
</body>
<script language="javascript">
	ts = "<?= $ts ?>";
	var travel_oMarquee = document.getElementById("travel_mq"); //滚动对象
  var order_oMarquee = document.getElementById("order_mq"); //滚动对象
var iLineHeight = 30; //单行高度，像素
var iLineCount = 10; //实际行数
var iScrollAmount = 1; //每次滚动高度，像素
function travel_run() {
travel_oMarquee.scrollTop += iScrollAmount;
if ( travel_oMarquee.scrollTop == iLineCount * iLineHeight )
travel_oMarquee.scrollTop = 0;
if ( travel_oMarquee.scrollTop % iLineHeight == 0 ) {
window.setTimeout( "travel_run()", 2000 );
} else {
window.setTimeout( "travel_run()", 50 );
}
}
travel_oMarquee.innerHTML += travel_oMarquee.innerHTML;
window.setTimeout( "travel_run()", 2000 ); 




function order_run() {
order_oMarquee.scrollTop += iScrollAmount;
if ( order_oMarquee.scrollTop == iLineCount * iLineHeight )
order_oMarquee.scrollTop = 0;
if ( order_oMarquee.scrollTop % iLineHeight == 0 ) {
window.setTimeout( "order_run()", 2000 );
} else {
window.setTimeout( "order_run()", 50 );
}
}
order_oMarquee.innerHTML += order_oMarquee.innerHTML;
window.setTimeout( "order_run()", 2000 ); 



</script>


