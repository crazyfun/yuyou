<ul onmouseout="iScrollAmount=1" onmouseover="iScrollAmount=0" id="mq" style="height:300px;overflow:hidden;">
<?php foreach($contents as $key => $value){ ?>
<li><a title="<?php echo $value->Travel->title;?>" href="<?php echo $value->Travel->set_channel_link("travel",$value->travel_id);?>"><?php echo Util::cutstr($value->Travel->title,24);?></a><span><?php if(empty($value->user_id)){ echo "游客"; }else{ echo "<a href='javascript:void(0);' target='_blank'>".$value->User->user_login."</a>"; }?></span></li>
<?php
 }
?>
 </ul>
 <script language="javascript">
 	var oMarquee = document.getElementById("mq"); //滚动对象
var iLineHeight = 30; //单行高度，像素
var iLineCount = 10; //实际行数
var iScrollAmount = 1; //每次滚动高度，像素
function run() {
oMarquee.scrollTop += iScrollAmount;
if ( oMarquee.scrollTop == iLineCount * iLineHeight )
oMarquee.scrollTop = 0;
if ( oMarquee.scrollTop % iLineHeight == 0 ) {
window.setTimeout( "run()", 2000 );
} else {
window.setTimeout( "run()", 50 );
}
}
oMarquee.innerHTML += oMarquee.innerHTML;
window.setTimeout( "run()", 2000 ); 
 </script>