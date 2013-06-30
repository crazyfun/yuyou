
<div id="page_content">
    <div class="show_right_content">
    <!--用户操作-->
    	<div class=""><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("sysconfig/index");?>">返回到系统配置管理</a></span></div></div>
    <!--用户操作end-->
    <!--编辑框-->	
    	<div class="edit_content">
    		<div class="setting_menu"><ul class="tab_menu"><li class="menu_item menu_item_active" index='1'>基本配置</li><li class="menu_item" index='2'>SEO配置</li><li class="menu_item" index='3'>邮件配置</li></ul></div>
    		<div id="menu_content_1" class="menu_content" style="display:block">
    		   <?php $form_bsc = $this->beginWidget('CActiveForm', array('id'=>'sys_bsc_cfg','action'=>"",'enableAjaxValidation'=>false,)); ?>
           <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
          
           <div class="content_inline">
           	 <div class="content_name">过滤用户名</div>
           	 <div class="content_content"><textarea name="sci[sfc_filter_username]"><?php if( $oldcfg['sfc_filter_username'] ) echo $oldcfg['sfc_filter_username']; ?></textarea></div>
           	 <div class="content_error">sfc_filter_username</div>
           </div>

           <div class="content_inline">
           	 <div class="content_name">过滤IP</div>
           	 <div class="content_content"><textarea name="sci[sfc_filter_ip]"><?php if( $oldcfg['sfc_filter_ip'] ) echo $oldcfg['sfc_filter_ip']; ?></textarea></div>
           	 <div class="content_error">sfc_filter_ip</div>
           </div>
           
           <div class="content_inline">
           	 <div class="content_name">团购结算率</div>
           	 <div class="content_content"><input type="text" name="sci[sfc_group_settle]" value="<?php if( $oldcfg['sfc_group_settle'] ) echo $oldcfg['sfc_group_settle'];?>"/></div>
           	 <div class="content_error">sfc_group_settle</div>
           </div>
           
            <div class="content_inline">
           	 <div class="content_name">版权信息</div>
           	 <div class="content_content"><input type="text" name="sci[sfc_copyright]" value="<?php if( $oldcfg['sfc_copyright'] ) echo $oldcfg['sfc_copyright'];?>"/></div>
           	 <div class="content_error">sfc_copyright</div>
           </div>
           
           
            <div class="content_inline">
           	 <div class="content_name">备案号</div>
           	 <div class="content_content"><input type="text" name="sci[sfc_icp]" value="<?php if( $oldcfg['sfc_icp'] ) echo $oldcfg['sfc_icp'];?>"/></div>
           	 <div class="content_error">sfc_icp</div>
           </div>
           

           <div class="content_inline">
           	 <div class="content_name">站长工具</div>
           	 <div class="content_content"><textarea name="sci[sfc_web_tools]"><?php if( $oldcfg['sfc_web_tools'] ) echo $oldcfg['sfc_web_tools']; ?></textarea></div>
           	 <div class="content_error">sfc_web_tools</div>
           </div>
           
           
            <div class="content_inline">
           	 <div class="content_name">开启缓存</div>
           	 <div class="content_content"><input type="radio" name="sci[sfc_cache]" <?php if($oldcfg['sfc_cache']=='Y') echo 'checked="CHECKED"'; ?>  value="Y"/>开启&nbsp;&nbsp;<input type="radio" name="sci[sfc_cache]" <?php if($oldcfg['sfc_cache']=='N') echo 'checked="CHECKED"'; ?>  value="N"/>不开启</div>
           	 <div class="content_error">sfc_cache</div>
           </div>
           
           <div class="content_inline">
           	 <div class="content_name">缓存时间</div>
           	 <div class="content_content"><input type="text" name="sci[sfc_cache_time]" value="<?php if( $oldcfg['sfc_cache_time'] ) echo $oldcfg['sfc_cache_time'];?>"/></div>
           	 <div class="content_error">sfc_cache_time</div>
           </div>
           
           <div class="content_inline">
           	 <div class="content_name">会员协议</div>
           	 <div class="content_content"><?php  EHtml::createMultitext("sci[sfc_user_agreement]",$oldcfg['sfc_user_agreement'],array());?></div>
           	 <div class="content_error">sfc_user_agreement</div>
           </div>
           
          <div class="content_inline">
           	 <div class="content_name">预定协议</div>
           	 <div class="content_content"><?php  EHtml::createMultitext("sci[sfc_pay_agreement]",$oldcfg['sfc_pay_agreement'],array());?></div>
           	 <div class="content_error">sfc_pay_agreement</div>
           </div>
           
           
           <div class="content_inline">
           	 <div class="content_name">商家注册协议</div>
           	 <div class="content_content"><?php  EHtml::createMultitext("sci[sfc_company_agreement]",$oldcfg['sfc_company_agreement'],array());?></div>
           	 <div class="content_error">sfc_company_agreement</div>
           </div>
           

	         <div class="content_button">
	         	 <input type="submit" class="input_submit" value="确定" name="button_ok"/>
	         	 <input type="reset" class="input_cancel" value="取消" name="button_reset"/>
	         </div>
	         <?php $this->endWidget();?>
	       </div>
	       
	       
	       	<div id="menu_content_2" class="menu_content" style="display:none">
    		   <?php $form_bsc = $this->beginWidget('CActiveForm', array('id'=>'sys_bsc_cfg','action'=>"",'enableAjaxValidation'=>false,)); ?>
           <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
          
           <div class="content_inline">
           	 <div class="content_name">网站名称</div>
           	 <div class="content_content"><textarea name="sci[sfc_web_name]"><?php if( $oldcfg['sfc_web_name'] ) echo $oldcfg['sfc_web_name']; ?></textarea></div>
           	 <div class="content_error">sfc_web_name</div>
           </div>
           
     
           
           <div class="content_inline">
           	 <div class="content_name">封面模版</div>
           	 <div class="content_content"><input type="text" name="sci[sfc_cover_template]" value="<?php if( $oldcfg['sfc_cover_template'] ) echo $oldcfg['sfc_cover_template'];?>"/></div>
           	 <div class="content_error">sfc_cover_template</div>
           </div>
           
           <div class="content_inline">
           	 <div class="content_name">列表模版</div>
           	 <div class="content_content"><input type="text" name="sci[sfc_lists_template]" value="<?php if( $oldcfg['sfc_lists_template'] ) echo $oldcfg['sfc_lists_template'];?>"/></div>
           	 <div class="content_error">sfc_lists_template</div>
           </div>
           
           
           <div class="content_inline">
           	 <div class="content_name">文章模版</div>
           	 <div class="content_content"><input type="text" name="sci[sfc_archive_template]" value="<?php if( $oldcfg['sfc_archive_template'] ) echo $oldcfg['sfc_archive_template'];?>"/></div>
           	 <div class="content_error">sfc_archive_template</div>
           </div>
           
          <div class="content_inline">
           	 <div class="content_name">首页SEO</div>
           	 <div class="content_content"><textarea name="sci[sfc_home_title]"><?php if( $oldcfg['sfc_home_title'] ) echo $oldcfg['sfc_home_title']; ?></textarea></div>
           	 <div class="content_error">sfc_home_title</div>
           </div>
           
             
          <div class="content_inline">
           	 <div class="content_name">SEO标题</div>
           	 <div class="content_content"><textarea name="sci[sfc_web_title]"><?php if( $oldcfg['sfc_web_title'] ) echo $oldcfg['sfc_web_title']; ?></textarea></div>
           	 <div class="content_error">sfc_web_title</div>
           </div>
           
           
           <div class="content_inline">
           	 <div class="content_name">SEO关键字</div>
           	 <div class="content_content"><textarea name="sci[sfc_web_keywords]"><?php if( $oldcfg['sfc_web_keywords'] ) echo $oldcfg['sfc_web_keywords']; ?></textarea></div>
           	 <div class="content_error">sfc_web_keywords</div>
           </div>
           
            <div class="content_inline">
           	 <div class="content_name">SEO描述</div>
           	 <div class="content_content"><textarea name="sci[sfc_web_description]"><?php if( $oldcfg['sfc_web_description'] ) echo $oldcfg['sfc_web_description']; ?></textarea></div>
           	 <div class="content_error">sfc_web_description</div>
           </div>
          
	         <div class="content_button">
	         	 <input type="submit" class="input_submit" value="确定" name="button_ok"/>
	         	 <input type="reset" class="input_cancel" value="取消" name="button_reset"/>
	         </div>
	         <?php $this->endWidget();?>
	       </div>
	       
	       
	       
	       
	       <div id="menu_content_3" class="menu_content">
	         <?php
    		     $form_mail = $this->beginWidget('CActiveForm', array('id'=>'sys_mail_cfg','action'=>"",'enableAjaxValidation'=>false,));
           ?>
             
             <div class="content_inline">
             	 <div class="content_name">服务器</div>
             	 <div class="content_content"><input name="sci[sfc_mail_host]" type="text" value="<?php if( $oldcfg['sfc_mail_host'] ) echo $oldcfg['sfc_mail_host'];?>"/></div>
             	 <div class="content_error">sfc_mail_host</div>
             </div>
             <div class="content_inline">
             	 <div class="content_name">服务器端口</div>
             	 <div class="content_content"><input name="sci[sfc_mail_port]" type="text" value="<?php if( $oldcfg['sfc_mail_port'] ) echo $oldcfg['sfc_mail_port'];?>"/></div>
             	 <div class="content_error">sfc_mail_port</div>
             </div>
             <div class="content_inline">
             	 <div class="content_name">用户名</div>
             	 <div class="content_content"><input name="sci[sfc_mail_user]" type="text" value="<?php if( $oldcfg['sfc_mail_user'] ) echo $oldcfg['sfc_mail_user'];?>"/></div>
             	 <div class="content_error">sfc_mail_user</div>
             </div>
             <div class="content_inline">
             	<div class="content_name">密码</div>
             	<div class="content_content">
             		<input name="sci[sfc_mail_psw]" type="text" value="<?php if( $oldcfg['sfc_mail_psw'] ) echo $oldcfg['sfc_mail_psw'];?>"/>
             	</div>
             	<div class="content_error">sfc_mail_psw</div>
             </div>
             <div class="content_button">
	         	   <input type="submit" class="input_submit" value="确定" name="button_ok"/>
	         	   <input type="reset" class="input_cancel" value="取消" name="button_reset"/>
	           </div>
           <?php $this->endWidget(); ?>
          </div>
          
        
	       
	       
	       
    	  </div>
    	 <!--编辑框end-->	
    </div>
</div>

<script>
	jQuery(function($) {
    togglemenu({'source':"menu_item",'target':"menu_content",'type':'1','effect':'1','effect_time':''});
  }); 

</script>
