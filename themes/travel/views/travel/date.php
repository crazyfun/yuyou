<?php
      Yii::app()->clientScript->registerCssFile('/js/blogcalendar/calendar.css');
      Yii::app()->clientScript->registerScriptFile('/js/blogcalendar/calendar.js');	
 ?>
 <div class="pr_table"><!--出行日价格表-->
          <div class="pr_tabtop"><span id="idCalendarYear"></span>年出行日价格表</div>
          <div class="pr_tabcenter">
          	 <div class="pr_tableft">
          	 	<div class="pr_tableft_main">
                 <p class="pr_bnt1"><a href="javascript:void(0);"  id="pre_date"><img src="<?php echo $cssPath;?>/images/pr_bnt1.jpg" /></a></p>
                 <p><span id="idCalendarMonth"></span>月</p>
                 <p class="pr_bnt2"><a href="javascript:void(0);"  id="next_date"><img src="<?php echo $cssPath;?>/images/pr_bnt.jpg" /></a></p>
              </div>
             </div>
            <div class="pr_tabright">
            	<table class="date_tab" width="100%" border="0">
            		 <colgroup>
							 <col width="15%" />
							 <col width="14%" />
							 <col width="14%" />
							 <col width="14%" />
							 <col width="14%" />
							 <col width="14%" />
							 <col />
              </colgroup>
                 <thead>
                     <tr class="date_top_tr">
                     	    <td><span class="weekend">日</span></td><td>一</td><td>二</td><td>三</td><td>四</td><td>五</td><td><span class="weekend">六</span></td>
                     </tr>
                </thead>
                <tbody id="idCalendar">
                    	
               </tbody>

               </table>
            </div>
             <div class="clear_float"></div>
          </div>
          <div class="pr_tabbottom"><img src="/js/blogcalendar/images/tody_bottom.jpg" /></div>
          
          
      </div>
<script language="javascript">
	var id="<?= $id ?>";
	var cale = new Calendar("idCalendar", {

	onSelectDay: function(o){ o.className = "onSelect"; },
	onToday: function(o){ o.className = "ondate"; },
	onFinish: function(){
		 document.getElementById("idCalendarYear").innerHTML = this.Year;
     document.getElementById("idCalendarMonth").innerHTML = this.Month;

	}
});

if(cale){
	get_date_datas(id,cale.Year,cale.Month);
}
document.getElementById("pre_date").onclick = function(){ cale.PreMonth();get_date_datas(id,cale.Year,cale.Month); }
document.getElementById("next_date").onclick = function(){ cale.NextMonth();get_date_datas(id,cale.Year,cale.Month); }

</script>