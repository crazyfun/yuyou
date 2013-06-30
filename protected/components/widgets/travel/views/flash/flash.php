<?php $content=json_encode($content);?>
<script language="javascript">
jQuery(function(){
var content=<?= $content ?>;
var content_length=content.length;
var imag=new Array();
var link=new Array();
var text=new Array();
for(var ii=0;ii<content_length;ii++){
	imag[ii+1]=content[ii].flash_img;
	link[ii+1]=content[ii].img_href;
	text[ii+1]=content[ii].describe;
}
var pic_width=990;
var pic_height=250;
var button_pos=4;
var stop_time=5000;
var show_text=0;
var txtcolor="000000";
var bgcolor="DDDDDD";

var swf_height=show_text==1?pic_height+20:pic_height;
var pics="", links="", texts="";
for(var i=1; i<imag.length; i++){
	pics=pics+("|"+imag[i]);
	texts=texts+("|"+text[i]);
	links=links+("|"+link[i]);
}
pics=pics.substring(1);

texts=texts.substring(1);
var str="";
str+='<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/images/swflash.cabversion=6,0,0,0" width="'+ pic_width +'" height="'+ swf_height +'">';
str+='<param name="movie" value="/protected/components/widgets/default/views/flash/focus.swf">';
str+='<param name="quality" value="high"><param name="wmode" value="opaque">';
str+='<param name="FlashVars" value="pics='+pics+'&links='+links+'&texts='+texts+'&pic_width='+pic_width+'&pic_height='+pic_height+'&show_text='+show_text+'&txtcolor='+txtcolor+'&bgcolor='+bgcolor+'&button_pos='+button_pos+'&stop_time='+stop_time+'">';
str+='<embed src="/protected/components/widgets/default/views/flash/focus.swf" FlashVars="pics='+pics+'&links='+links+'&texts='+texts+'&pic_width='+pic_width+'&pic_height='+pic_height+'&show_text='+show_text+'&txtcolor='+txtcolor+'&bgcolor='+bgcolor+'&button_pos='+button_pos+'&stop_time='+stop_time+'" quality="high" width="'+ pic_width +'" height="'+ swf_height +'" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />';
str+='</object>';
jQuery("#banner").html(str);
});
</script>