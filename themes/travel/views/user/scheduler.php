<script src="/js/dhtmlxscheduler/codebase/dhtmlxscheduler.js" type="text/javascript" charset="utf-8"></script>
  <script src="/js/dhtmlxscheduler/sources/locale_cn.js" charset="utf-8"></script>
	<link rel="stylesheet" href="/js/dhtmlxscheduler/codebase/dhtmlxscheduler.css" type="text/css" title="no title" charset="utf-8">

									 
                    <div class="memberbody"><!--用户内容-->
                    	<div class="my_acheduler_wapper">
  <div id="scheduler_here" class="dhx_cal_container" style='width:100%; height:100%;'>
		<div class="dhx_cal_navline">
			<div class="dhx_cal_prev_button">&nbsp;</div>
			<div class="dhx_cal_next_button">&nbsp;</div>
			<div class="dhx_cal_today_button"></div>
			<div class="dhx_cal_date"></div>
			<div class="dhx_cal_tab" name="day_tab" style="right:204px;"></div>
			<div class="dhx_cal_tab" name="week_tab" style="right:140px;"></div>
			<div class="dhx_cal_tab" name="month_tab" style="right:76px;"></div>
		</div>
		<div class="dhx_cal_header">
		</div>
		<div class="dhx_cal_data">
		</div>
	</div>
</div>
                    </div>
<script type="text/javascript" charset="utf-8">
  jQuery(function(){
  	  init();
  });
	function init(){
		scheduler.config.xml_date="%Y-%m-%d %H:%i";
		//scheduler.config.prevent_cache = true;
		scheduler.config.lightbox.sections=[	
			{name:"title", height:130, map_to:"text", type:"textarea" , focus:true},
			{name:"description", height:43, type:"textarea", map_to:"details" },
			{name:"time", height:72, type:"time", map_to:"auto"}
		]
		scheduler.config.first_hour=4;
		scheduler.locale.labels.section_location="Location";
		//scheduler.config.details_on_create=true;
		//scheduler.config.details_on_dblclick=true;
		scheduler.init('scheduler_here',new Date(),"month");
		scheduler.setLoadMode("month");
		//scheduler.load("../../events.xml");
		scheduler.load("/api/scheduler");
		var dp = new dataProcessor("/api/scheduler");
		dp.init(scheduler);
	}
	
	
	
	// 添加事件event
scheduler.attachEvent("onEventAdded", function(event_id,event_object){
    var url = "/api/scheduler";
    var id = event_object.id;
    var text = event_object.text;
    // date 需要实现格式化
    var convert = scheduler.date.date_to_str("%Y-%m-%d %H:%i:%s");
    var start_date =convert(event_object.start_date);
    var end_date = convert(event_object.end_date);
    var details = event_object.details;      
    var pars = "action=add&id=" + id +
        "&start_date=" + start_date +
        "&end_date=" + end_date +
        "&text=" + text +
        "&details=" + details;
    jQuery.ajax({
			   type: "POST",
			   beforeSend: function(){
			   },
			   url: url,
			   processData:true,
			   data: pars,
			   dataType:'json',
			   success: function(msg){
			   	  	programing = false;
			   }
	  });     
   
});

scheduler.attachEvent("onEventChanged", function(event_id, event_object){
    // 得到数据
    var url = "/api/scheduler";
    var id = event_object.id;
    var text = event_object.text;
    // date 需要实现格式化
    var convert = scheduler.date.date_to_str("%Y-%m-%d %H:%i:%s");
    var start_date =convert(event_object.start_date);
    var end_date = convert(event_object.end_date);
    var details = event_object.details;
    var pars = "action=edit&id=" + id +
        "&start_date=" + start_date +
        "&end_date=" + end_date +
        "&text=" + text +
        "&details=" + details;
               
  jQuery.ajax({
			   type: "POST",
			   beforeSend: function(){
			   },
			   url: url,
			   processData:true,
			   data: pars,
			   dataType:'json',
			   success: function(msg){
			   	  	programing = false;
			   }
	  });     
});



scheduler.attachEvent("onBeforeEventDelete", function(event_id, event_object){
    var url = "/api/scheduler";
    var id = event_object.id;
    var text = event_object.text;
    // date 需要实现格式化，这里需要和server端相互交互
    var convert = scheduler.date.date_to_str("%Y-%m-%d %H:%i:%s");
    var start_date =convert(event_object.start_date);
    var end_date = convert(event_object.end_date);
    var details = event_object.details;
    var pars = "action=delete&id=" + id +
        "&start_date=" + start_date +
        "&end_date=" + end_date +
        "&text=" + text +
        "&details=" + details;
               
   jQuery.ajax({
			   type: "POST",
			   beforeSend: function(){
			   },
			   url: url,
			   processData:true,
			   data: pars,
			   dataType:'json',
			   success: function(msg){
			   	    programing = false;
			   }
	  });
	  return true;     
  });
    
    

</script>             