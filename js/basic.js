
//页面加载
jQuery(document).ready(function(){
	
	if(ua.ie()){
		  
      DD_belatedPNG.fix('div, ul, img, li, input , a');
  }
  
   jQuery('#goTopBtn').bind("click",function(event){
    	jQuery('html, body').stop(true).animate({scrollTop:0},1000,function(){});
    	event.stopPropagation(); 
    });
    
    jQuery(window).scroll(function(){  //监听滚动条
    	  
        var $scrollTop = jQuery(this).scrollTop();
        if($scrollTop>0){
        	jQuery('#goTopBtn').show();
        }else{
        	jQuery('#goTopBtn').hide();
        }

    }); 
});
function extend(subClass,superClass){
     var F = function(){};
     F.prototype = superClass.prototype;
     subClass.prototype = new F();
     subClass.prototype.constructor = subClass;
     subClass.superclass = superClass.prototype;
     if(superClass.prototype.constructor == Object.prototype.constructor){
       superClass.prototype.constructor = superClass;
     }
}
//得到页面的宽和高
 function getPageSize(){
	var de = document.documentElement;
	var w = window.innerWidth || self.innerWidth || (de&&de.clientWidth) || document.body.clientWidth;
	var h = window.innerHeight || self.innerHeight || (de&&de.clientHeight) || document.body.clientHeight;
	arrayPageSize = [w,h];
	return arrayPageSize;
}
//判断是否为空
function empty(obj){
	 if(obj){
	  if(obj instanceof Array){return obj.length==0;}
	  else if(obj instanceof Object){
		  for(var i in obj){return false;}
		  return true;
	  }else{return !obj;}
	 }else{
	 	   return false;
	 }
}
function isNumber(obj){
	   if(isNaN(obj.value))
	       obj.value="";
}
 //加入收藏和设为首页
function addCookie(url,name) {　
　　　　　　　if (document.all) {
　　　　　　　　　　　　　　window.external.addFavorite(url, name);
　　　　　　　}
　　　　　　　else if (window.sidebar) {
　　　　　　　　　 window.sidebar.addPanel(name, url, "");
　　　　　　　}
}
function setHomepage(url) {　
　　　　　　　if (document.all) {
　　　　　　　　　　　　　　　 document.body.style.behavior = 'url(#default#homepage)';
　　　　　　　　　　　　　　　 document.body.setHomePage(url);

　　　　　　　}
　　　　　　　else if (window.sidebar) {
　　　　　　　　　if (window.netscape) {
　　　　　　　　　　　try {
　　　　　　　　　　　　　netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
　　　　　　　　　　　}
　　　　　　　　　　　catch (e) {
　　　　　　　　　　　　　　　alert("该操作被浏览器拒绝，如果想启用该功能，请在地址栏内输入 about:config,然后将项 signed.applets.codebase_principal_support 值该为true");
　　　　　　　　　　　}
　　　　　　　　　}
　　　　　　　　　var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);
　　　　　　　　　 prefs.setCharPref('browser.startup.homepage', url);
　　　　　　　}
} 

function toHome(){ 
	if(!isIFrameSelf()){
		 window.location.href="http://www.lyyhome.com/";
	}
}
//选择所有
function check_all(all_id,check_class){
	jQuery("#"+all_id).bind('click',function(){
		var checked=jQuery(this).attr("checked");
		if(checked){
			jQuery("."+check_class).attr("checked",true);
		}else{
			jQuery("."+check_class).attr("checked",false);
		}
	})
}

    //验证用户email
function is_email(user_email){
    	  var user_email_flag=user_email.match(/^([a-z0-9+_]|\-|\.)+@(([a-z0-9_]|\-)+\.)+[a-z]{2,6}$/i);
    	  if(user_email_flag)
    	     return true;
    	  else
    	  	 return false;
}    





//取得DOM中,ID=b的节点; c=是否不扩展
var ge=window.ge||function(b,c){
	var a;
	if('string'!=typeof(b)){a=b;}
	else a=document.getElementById(b);
	!c&&window.NodeAugment&&NodeAugment.extend(a);
	return a;
};


var basic={
  $:window.$||ge
};

//随机数
function rand32(){
	return Math.floor(Math.random()*4294967295);
}
/* 返回当前时间 */
function getTime(date)
{
 if(date == null)
 {
  date = new Date();
 }
 var y = date.getFullYear();
 var M = date.getMonth() + 1;
 var d = date.getDate();
 var h = date.getHours();
 var m = date.getMinutes();
 var s = date.getSeconds();
 //var S = date.getTime()%1000;

 var html = y + "-";

 if(M < 10)
 {
  html += "0";
 }
 html += M + "-";

 if(d < 10)
 {
  html += "0";
 }
 html += d + " ";

 if(h < 10)
 {
  html += "0";
 }
 html += h + ":";

 if(m < 10)
 {
  html += "0";
 }
 html += m + ":";

 if(s < 10)
 {
  html += "0";
 }
 html += s;
 
 html += " ";
/*
 if(S < 100)
 {
  html += "0";
 }

 if(S < 10)
 {
  html += "0";
 }

 html += S;
*/
 return html;
}
 /*
 * 获得时间差,时间格式为 年-月-日 小时:分钟:秒 或者 年/月/日 小时：分钟：秒
 * 其中，年月日为全格式，例如 ： 2010-10-12 01:00:00
 * 返回精度为：秒，分，小时，天
*/
function GetDateDiff(startTime, endTime, diffType) {
	            //将xxxx-xx-xx的时间格式，转换为 xxxx/xx/xx的格式
	            startTime = startTime.replace(/\-/g, "/");
	            endTime = endTime.replace(/\-/g, "/");
	            //将计算间隔类性字符转换为小写
	            diffType = diffType.toLowerCase();
	            var sTime = new Date(startTime);      //开始时间
	            var eTime = new Date(endTime);  //结束时间
	            //作为除数的数字
	            var divNum = 1;
	            switch (diffType) {
	                case "second":
	                    divNum = 1000;
	                    return parseInt((eTime.getTime() - sTime.getTime()) / parseInt(divNum));
	                    break;
	                case "minute":
	                    divNum = 1000 * 60;
	                    return parseInt((eTime.getTime() - sTime.getTime()) / parseInt(divNum));
	                    break;
	                case "hour":
	                    divNum = 1000 * 3600;
	                    return parseInt((eTime.getTime() - sTime.getTime()) / parseInt(divNum));
	                    break;
	                case "day":
	                    divNum = 1000 * 3600 * 24;
	                    return parseInt((eTime.getTime() - sTime.getTime()) / parseInt(divNum));
	                    break;
	                
	                default:
	                    
	            				var day=(parseInt((eTime.getTime() - sTime.getTime()) / parseInt(1000 * 3600 * 24))>=0)?(parseInt((eTime.getTime() - sTime.getTime()) / parseInt(1000 * 3600 * 24))):0;
	            				var hour=(parseInt((eTime.getTime() - sTime.getTime()) / parseInt(1000 * 3600))%24>=0)?(parseInt((eTime.getTime() - sTime.getTime()) / parseInt(1000 * 3600))%24):0;
	            				var minute=((parseInt((eTime.getTime() - sTime.getTime()) / parseInt(1000 * 60))%(24*60))-(hour*60)>=0)?((parseInt((eTime.getTime() - sTime.getTime()) / parseInt(1000 * 60))%(24*60))-(hour*60)):0;
	            				var second=((parseInt((eTime.getTime() - sTime.getTime()) / parseInt(1000))%(24*60*60))-(hour*3600+minute*60)>=0)?((parseInt((eTime.getTime() - sTime.getTime()) / parseInt(1000))%(24*60*60))-(hour*3600+minute*60)):0;
	            				return new Array(second,minute,hour,day);
	                    break;
	            }
	            
 }

String.prototype.trimn=function()
{
     return this.replace(/[\r|\n]/g,"");
}

String.prototype.ltrim=function()
{
     return this.replace(/(^\s*)/g,'');
}

String.prototype.rtrim=function()
{
     return this.replace(/(\s*$)/g,'');
}

Array.prototype.find_key=function(id){
	  var len=this.length;
	  for(var ii=0;ii<len;ii++){
	  	if(this[ii].id==id){
	  		return ii+1;
	  	}
	  }
	  return false;
}

Array.prototype.find_value=function(value){
   var len=this.length;
   for(var ii=0;ii<len;ii++){
     if(this[ii]==value){
       return ii+1;	
    }	
  }
  return false;
}
//移除数组中的一个指定索引
Array.prototype.remove=function(remove_key){
	var temp_array=new Array();
	var len=this.length;
	remove_key=parseInt(remove_key);
	for(var ii=0;ii<len;ii++){
		if(ii!=remove_key){
			temp_array.push(this[ii]);
		}
	}
	return temp_array;
}

function strLeft(s,n){
	return s.slice(0, n)
}
/**
 * 实现层的拖曳操作
 */
function drag(o){
    o.onmousedown = function(a){
        var d = document;
        if(!a) a = window.event;
        if(o.setCapture)
            o.setCapture();
        else if(window.captureEvents)
            window.captureEvents(Event.MOUSEMOVE|Event.MOUSEUP);

		var re = new RegExp("px","ig");
		//计算当前鼠标的坐标点离日期采集器层的零点坐标的Ｘ间距
        var x = (a.pageX?a.pageX:a.x) - parseInt(o.style.left.replace(re,""));
        //计算当前鼠标的坐标点离日期采集器层的零点坐标的Y间距
        var y = (a.pageY?a.pageY:a.y) - parseInt(o.style.top.replace(re,""));
        
        d.onmousemove = function(a){
            if(!a)a=window.event;
            if(!a.pageX)a.pageX=a.clientX;
            if(!a.pageY)a.pageY=a.clientY;
            var tx=a.pageX-x,ty=a.pageY-y;
            o.style.left = tx + "px";
            o.style.top = ty + "px";
        };
        
        d.onmouseup=function(){
            if(o.releaseCapture)
                o.releaseCapture();
            else if(window.captureEvents)
                window.captureEvents(Event.MOUSEMOVE|Event.MOUSEUP);
            d.onmousemove=null;
            d.onmouseup=null;
        };
    };
}


  
  

//转换字符为html用的字符串,(替换 & " ' < > 为特殊字符)
function htmlspecialchars(a){
	if(typeof(a)=='undefined'||a===null||!a.toString)return '';
	if(a===false){return '0';}
	else if(a===true)return '1';
	//替换 & " ' < > 为特殊字符
	return a.toString().replace(/&/g,'&amp;').replace(/"/g,'&quot;').replace(/'/g,'&#039;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
}
//替换换行为<br />
function htmlize(a){return htmlspecialchars(a).replace(/\n/g,'<br />');}
function escape_js_quotes(a){
	if(typeof(a)=='undefined'||!a.toString)return '';
	return a.toString().replace(/\\/g,'\\').replace(/\n/g,'\n').replace(/\r/g,'\r').replace(/"/g,'\x22').replace(/'/g,'\'').replace(/</g,'\x3c').replace(/>/g,'\x3e').replace(/&/g,'\x26');
}
//c=标签  a=属性; b=内容
function $N(c,a,b){
	if(typeof a!='object'||DOM.isNode(a)||a instanceof Array||a instanceof HTML){b=a;a=null;}
	return DOM.create(c,a,b);
}
var $$=function _$$(a){return DOM.scry.apply(null,[document].concat($A(arguments)));};


function setCookie(a,b,d,e){
	if(d){
		var f=new Date();
		var c=new Date();
		c.setTime(f.getTime()+d);
	}
	document.cookie=a+"="+encodeURIComponent(b)+"; "+(d?"expires="+c.toGMTString()+"; ":"")+"path="+(e||'\/')+"; domain="+window.location.hostname.replace(/^.*(\.facebook\..*)$/i,'$1');
}
function clearCookie(a){document.cookie=a+"=; expires=Sat, 01 Jan 2000 00:00:00 GMT; "+"path=\/; domain="+window.location.hostname.replace(/^.*(\.facebook\..*)$/i,'$1');}
function getCookie(d){var e=d+"=";var b=document.cookie.split(';');for(var c=0;c<b.length;c++){var a=b[c];while(a.charAt(0)==' ')a=a.substring(1,a.length);if(a.indexOf(e)==0)return decodeURIComponent(a.substring(e.length,a.length));}return null;}


function copy_properties(b,c){
	b=b||{};
	c=c||{};
	for(var a in c)b[a]=c[a];
	if(c.hasOwnProperty&&c.hasOwnProperty('toString')&&(typeof c.toString!='undefined')&&(b.toString!==c.toString))b.toString=c.toString;
	return b;
}
var ua={
	ie:function(){return ua._populate()||this._ie;},
	firefox:function(){return ua._populate()||this._firefox;},
	opera:function(){return ua._populate()||this._opera;},
	safari:function(){return ua._populate()||this._safari;},
	safariPreWebkit:function(){return ua._populate()||this._safari<500;},
	chrome:function(){return ua._populate()||this._chrome;},
	windows:function(){return ua._populate()||this._windows;},
	osx:function(){return ua._populate()||this._osx;},
	linux:function(){return ua._populate()||this._linux;},
	iphone:function(){return ua._populate()||this._iphone;},
	_populated:false,
	_populate:function(){
		if(ua._populated)return;
		ua._populated=true;
		var a=/(?:MSIE.(\d+\.\d+))|(?:(?:Firefox|GranParadiso|Iceweasel).(\d+\.\d+))|(?:Opera(?:.+Version.|.)(\d+\.\d+))|(?:AppleWebKit.(\d+(?:\.\d+)?))/.exec(navigator.userAgent);
		var c=/(Mac OS X)|(Windows)|(Linux)/.exec(navigator.userAgent);
		var b=/\b(iPhone|iP[ao]d)/.exec(navigator.userAgent);
		if(a){
			ua._ie=a[1]?parseFloat(a[1]):NaN;
			if(ua._ie>=8&&!window.HTMLCollection)ua._ie=7;
			ua._firefox=a[2]?parseFloat(a[2]):NaN;
			ua._opera=a[3]?parseFloat(a[3]):NaN;
			ua._safari=a[4]?parseFloat(a[4]):NaN;
			if(ua._safari){
				a=/(?:Chrome\/(\d+\.\d+))/.exec(navigator.userAgent);
				ua._chrome=a&&a[1]?parseFloat(a[1]):NaN;
			}else ua._chrome=NaN;
		}else ua._ie=ua._firefox=ua._opera=ua._chrome=ua._safari=NaN;
		if(c){ua._osx=!!c[1];ua._windows=!!c[2];ua._linux=!!c[3];}
		else ua._osx=ua._windows=ua._linux=false;
		ua._iphone=b;
	}
};


/*********************************
	URI类
*********************************/
function URI(a){
	if(a===window)return;
	//创建URI的实例
	if(this===window)	return new URI(a||window.location.href);
	this.parse(a||'');
}
copy_properties(URI,{
	//取得URI,a=false 取得当前win的URI;  =true 取得当前真实的URI(PageTransitions类)
	getRequestURI:function(a,b){
		a=a===undefined||a;
		if(a&&window.PageTransitions&&PageTransitions.isInitialized()){return PageTransitions.getCurrentURI(!!b).getQualifiedURI();}
		else return new URI(window.location.href);
	},
	getMostRecentURI:function(){
		if(window.PageTransitions&&PageTransitions.isInitialized()){return PageTransitions.getMostRecentURI().getQualifiedURI();}
		else return new URI(window.location.href);
	},
	expression:/(((\w+):\/\/)([^\/:]*)(:(\d+))?)?([^#?]*)(\?([^#]*))?(#(.*))?/,
	arrayQueryExpression:/^(\w+)((?:\[\w*\])+)=?(.*)/,
	explodeQuery:function(g){
		if(!g)return {};
		var h={};
		g=g.replace(/%5B/ig,'[').replace(/%5D/ig,']');
		g=g.split('&');
		for(var b=0,d=g.length;b<d;b++){
			var e=g[b].match(URI.arrayQueryExpression);
			if(!e){
				var j=g[b].split('=');
				h[URI.decodeComponent(j[0])]=j[1]===undefined?null:URI.decodeComponent(j[1]);
			}else{
				var c=e[2].split(/\]\[|\[|\]/).slice(0,-1);
				var f=e[1];
				var k=URI.decodeComponent(e[3]||'');
				c[0]=f;
				var i=h;
				for(var a=0;a<c.length-1;a++)
					if(c[a]){
						if(i[c[a]]===undefined)if(c[a+1]&&!c[a+1].match(/\d+$/)){i[c[a]]={};}
						else i[c[a]]=[];
						i=i[c[a]];
					}else{
						if(c[a+1]&&!c[a+1].match(/\d+$/)){i.push({});}
						else i.push([]);
						i=i[i.length-1];
					}
					if(i instanceof Array&&c[c.length-1]==''){i.push(k);}
					else i[c[c.length-1]]=k;
			}
		}
		return h;
	},
	//将query数组转变为直对的字串
	implodeQuery:function(f,e,a){
		e=e||'';
		if(a===undefined)a=true;
		var g=[];
		if(f===null||f===undefined){g.push(a?URI.encodeComponent(e):e);}
		else if(f instanceof Array){
			for(var c=0;c<f.length;++c)
				try{if(f[c]!==undefined)g.push(URI.implodeQuery(f[c],e?(e+'['+c+']'):c));}
				catch(b){}
		}else if(typeof(f)=='object'){
			if(DOM.isNode(f)){g.push('{node}');}
			else for(var d in f)
				try{if(f[d]!==undefined)g.push(URI.implodeQuery(f[d],e?(e+'['+d+']'):d));}
				catch(b){}
		}else if(a){g.push(URI.encodeComponent(e)+'='+URI.encodeComponent(f));}
		else g.push(e+'='+f);
		return g.join('&');
	},
	encodeComponent:function(d){
		var c=String(d).split(/([\[\]])/);
		for(var a=0,b=c.length;a<b;a+=2)c[a]=window.encodeURIComponent(c[a]);
		return c.join('');
	},
	decodeComponent:function(a){return window.decodeURIComponent(a.replace(/\+/g,' '));}
});

copy_properties(URI.prototype,{
	//解析URL的组成
	parse:function(b){
		var a=b.toString().match(URI.expression);
		copy_properties(this,{
			protocol:a[3]||'',	//协议
			domain:a[4]||'',		//
			port:a[6]||'',
			path:a[7]||'',
			query_s:a[9]||'',   //在?之后
			fragment:a[11]||''	//在#之后
		});
		return this;
	},
	setProtocol:function(a){this.protocol=a;return this;},
	getProtocol:function(){return this.protocol;},
	setQueryData:function(a){this.query_s=URI.implodeQuery(a);return this;},
	addQueryData:function(a){return this.setQueryData(copy_properties(this.getQueryData(),a));},
	//删除URI中query的某个值
	removeQueryData:function(b){
		if(!(b instanceof Array))b=[b];
		var d=this.getQueryData();
		for(var a=0,c=b.length;a<c;++a)delete d[b[a]];
		return this.setQueryData(d);
	},
	getQueryData:function(){return URI.explodeQuery(this.query_s);},
	setFragment:function(a){this.fragment=a;return this;},
	getFragment:function(){return this.fragment;},
	setDomain:function(a){this.domain=a;return this;},
	getDomain:function(){return this.domain;},
	setPort:function(a){this.port=a;return this;},
	getPort:function(){return this.port;},
	setPath:function(a){this.path=a;return this;},
	getPath:function(){return this.path.replace(/^\/+/,'\/');},
	toString:function(){
		var a='';
		this.protocol&&(a+=this.protocol+':\/\/');
		this.domain&&(a+=this.domain);
		this.port&&(a+=':'+this.port);
		if(this.domain&&!this.path)a+='\/';
		this.path&&(a+=this.path);
		this.query_s&&(a+='?'+this.query_s);
		this.fragment&&(a+='#'+this.fragment);
		return a;
	},
	valueOf:function(){return this.toString();},
	//判断domain,是不是Facebook的
	isFacebookURI:function(){
		if(!URI._facebookURIRegex)URI._facebookURIRegex=new RegExp('(^|\.)facebook\.('+env_get('tlds').join('|')+')([^.]*)$','i');
		return !this.domain||URI._facebookURIRegex.test(this.domain);
	},
	//判断Quickling类在活动中,且此uri是可以活动的页面
	isQuicklingEnabled:function(){return window.Quickling&&Quickling.isActive()&&Quickling.isPageActive(this);},
	getRegisteredDomain:function(){
		if(!this.domain)return '';
		if(!this.isFacebookURI())return null;
		var b=this.domain.split('.');
		var a=b.indexOf('facebook');
		return b.slice(a).join('.');
	},
	getTld:function(f){
		if(!this.domain)return '';
		var d=this.domain.split('.');
		var e=d[d.length-1];
		if(f)return e;
		var c=env_get('tlds');
		if(c.indexOf(e)==-1)
			for(var a=0;a<c.length;++a){
				var b=c[a];
				if(new RegExp(b+'$').test(this.domain)){e=b;break;}
			}
		return e;
	},
	//取得不合格的URI,仅有path後的URI /path?query#fragment
	getUnqualifiedURI:function(){
		return new URI(this).setProtocol(null).setDomain(null).setPort(null);
	},
	//取得合格的URI,Domain必须完整
	getQualifiedURI:function(){
		var b=new URI(this);
		if(!b.getDomain()){
			//补充缺少的Domain数据
			var a=URI();
			b.setProtocol(a.getProtocol()).setDomain(a.getDomain()).setPort(a.getPort());
		}
		return b;
	},
	//判断a是否与当前window的uri相同(Protocol,Domain),协议与域名是否相同
	isSameOrigin:function(a){
		var b=a||window.location.href;
		if(!(b instanceof URI))b=new URI(b.toString());
//		if(this.getProtocol()&&this.getProtocol()!=b.getProtocol())return false;
//		if(this.getDomain()&&this.getDomain()!=b.getDomain())return false;
		return true;
	},
	go:function(a){goURI(this,a);},
	setSubdomain:function(b){
		var c=new URI(this).getQualifiedURI();
		var a=c.getDomain().split('.');
		if(a.length<=2){a.unshift(b);}
		else a[0]=b;
		return c.setDomain(a.join('.'));
	},
	getSubdomain:function(){
		if(!this.getDomain())return '';
		var a=this.getDomain().split('.');
		if(a.length<=2){return '';}
		else return a[0];
	}
});
function Clock() {
	var date = new Date();
	this.year = date.getFullYear();
	this.month = date.getMonth() + 1;
	this.date = date.getDate();
	this.day = new Array("星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六")[date.getDay()];
	this.hour = date.getHours() < 10 ? "0" + date.getHours() : date.getHours();
	this.minute = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
	this.second = date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds();

	this.toString = function() {
		return "现在是:" + this.year + "年" + this.month + "月" + this.date + "日 " + this.hour + ":" + this.minute + ":" + this.second + " " + this.day; 
	};
	this.toSimpleDate = function() {
		return this.year + "-" + this.month + "-" + this.date;
	};
	
	this.toDetailDate = function() {
		return this.year + "-" + this.month + "-" + this.date + " " + this.hour + ":" + this.minute + ":" + this.second;
	};
	
	this.display = function(ele) {
		var clock = new Clock();
		ele.innerHTML = clock.toString();
		window.setTimeout(function() {clock.display(ele);}, 1000);
	};
	
}
//iepngfix
var DD_belatedPNG={ns:"DD_belatedPNG",imgSize:{},delay:10,nodesFixed:0,createVmlNameSpace:function(){document.namespaces&&!document.namespaces[this.ns]&&document.namespaces.add(this.ns,"urn:schemas-microsoft-com:vml")},createVmlStyleSheet:function(){var a;a=document.createElement("style");a.setAttribute("media","screen");document.documentElement.firstChild.insertBefore(a,document.documentElement.firstChild.firstChild);if(a.styleSheet){a=a.styleSheet;a.addRule(this.ns+"\\:*","{behavior:url(#default#VML)}");
a.addRule(this.ns+"\\:shape","position:absolute;");a.addRule("img."+this.ns+"_sizeFinder","behavior:none; border:none; position:absolute; z-index:-1; top:-10000px; visibility:hidden;");this.screenStyleSheet=a;a=document.createElement("style");a.setAttribute("media","print");document.documentElement.firstChild.insertBefore(a,document.documentElement.firstChild.firstChild);a=a.styleSheet;a.addRule(this.ns+"\\:*","{display: none !important;}");a.addRule("img."+this.ns+"_sizeFinder","{display: none !important;}")}},
readPropertyChange:function(){var a,c,b;a=event.srcElement;if(a.vmlInitiated){if(event.propertyName.search("background")!=-1||event.propertyName.search("border")!=-1)DD_belatedPNG.applyVML(a);if(event.propertyName=="style.display"){c=a.currentStyle.display=="none"?"none":"block";for(b in a.vml)if(a.vml.hasOwnProperty(b))a.vml[b].shape.style.display=c}event.propertyName.search("filter")!=-1&&DD_belatedPNG.vmlOpacity(a)}},vmlOpacity:function(a){if(a.currentStyle.filter.search("lpha")!=-1){var c=a.currentStyle.filter;
c=parseInt(c.substring(c.lastIndexOf("=")+1,c.lastIndexOf(")")),10)/100;a.vml.color.shape.style.filter=a.currentStyle.filter;a.vml.image.fill.opacity=c}},handlePseudoHover:function(a){setTimeout(function(){DD_belatedPNG.applyVML(a)},1)},fix:function(a){if(this.screenStyleSheet){var c;a=a.split(",");for(c=0;c<a.length;c++)this.screenStyleSheet.addRule(a[c],"behavior:expression(DD_belatedPNG.fixPng(this))")}},applyVML:function(a){a.runtimeStyle.cssText="";this.vmlFill(a);this.vmlOffsets(a);this.vmlOpacity(a);
a.isImg&&this.copyImageBorders(a)},attachHandlers:function(a){var c,b,e,d,f;c=this;b={resize:"vmlOffsets",move:"vmlOffsets"};if(a.nodeName=="A"){e={mouseleave:"handlePseudoHover",mouseenter:"handlePseudoHover",focus:"handlePseudoHover",blur:"handlePseudoHover"};for(d in e)if(e.hasOwnProperty(d))b[d]=e[d]}for(f in b)if(b.hasOwnProperty(f)){e=function(){c[b[f]](a)};a.attachEvent("on"+f,e)}a.attachEvent("onpropertychange",this.readPropertyChange)},giveLayout:function(a){a.style.zoom=1;if(a.currentStyle.position==
"static")a.style.position="relative"},copyImageBorders:function(a){var c,b;c={borderStyle:true,borderWidth:true,borderColor:true};for(b in c)if(c.hasOwnProperty(b))a.vml.color.shape.style[b]=a.currentStyle[b]},vmlFill:function(a){if(a.currentStyle){var c,b,e;c=a.currentStyle;for(b in a.vml)if(a.vml.hasOwnProperty(b))a.vml[b].shape.style.zIndex=c.zIndex;a.runtimeStyle.backgroundColor="";a.runtimeStyle.backgroundImage="";b=true;if(c.backgroundImage!="none"||a.isImg){if(a.isImg)a.vmlBg=a.src;else{a.vmlBg=
c.backgroundImage;a.vmlBg=a.vmlBg.substr(5,a.vmlBg.lastIndexOf('")')-5)}e=this;if(!e.imgSize[a.vmlBg]){b=document.createElement("img");e.imgSize[a.vmlBg]=b;b.className=e.ns+"_sizeFinder";b.runtimeStyle.cssText="behavior:none; position:absolute; left:-10000px; top:-10000px; border:none; margin:0; padding:0;";b.attachEvent("onload",function(){this.width=this.offsetWidth;this.height=this.offsetHeight;e.vmlOffsets(a)});b.src=a.vmlBg;b.removeAttribute("width");b.removeAttribute("height");document.body.insertBefore(b,
document.body.firstChild)}a.vml.image.fill.src=a.vmlBg;b=false}a.vml.image.fill.on=!b;a.vml.image.fill.color="none";a.vml.color.shape.style.backgroundColor=c.backgroundColor;a.runtimeStyle.backgroundImage="none";a.runtimeStyle.backgroundColor="transparent"}},vmlOffsets:function(a){var c,b,e,d,f,h;c=a.currentStyle;b={W:a.clientWidth+1,H:a.clientHeight+1,w:this.imgSize[a.vmlBg].width,h:this.imgSize[a.vmlBg].height,L:a.offsetLeft,T:a.offsetTop,bLW:a.clientLeft,bTW:a.clientTop};e=b.L+b.bLW==1?1:0;d=function(g,
l,m,i,j,k){g.coordsize=i+","+j;g.coordorigin=k+","+k;g.path="m0,0l"+i+",0l"+i+","+j+"l0,"+j+" xe";g.style.width=i+"px";g.style.height=j+"px";g.style.left=l+"px";g.style.top=m+"px"};d(a.vml.color.shape,b.L+(a.isImg?0:b.bLW),b.T+(a.isImg?0:b.bTW),b.W-1,b.H-1,0);d(a.vml.image.shape,b.L+b.bLW,b.T+b.bTW,b.W,b.H,1);d={X:0,Y:0};if(a.isImg){d.X=parseInt(c.paddingLeft,10)+1;d.Y=parseInt(c.paddingTop,10)+1}else for(f in d)d.hasOwnProperty(f)&&this.figurePercentage(d,b,f,c["backgroundPosition"+f]);a.vml.image.fill.position=
d.X/b.W+","+d.Y/b.H;f=c.backgroundRepeat;h={T:1,R:b.W+e,B:b.H,L:1+e};c={X:{b1:"L",b2:"R",d:"W"},Y:{b1:"T",b2:"B",d:"H"}};if(f!="repeat"||a.isImg){d={T:d.Y,R:d.X+b.w,B:d.Y+b.h,L:d.X};if(f.search("repeat-")!=-1){f=f.split("repeat-")[1].toUpperCase();d[c[f].b1]=1;d[c[f].b2]=b[c[f].d]}if(d.B>b.H)d.B=b.H;a.vml.image.shape.style.clip="rect("+d.T+"px "+(d.R+e)+"px "+d.B+"px "+(d.L+e)+"px)"}else a.vml.image.shape.style.clip="rect("+h.T+"px "+h.R+"px "+h.B+"px "+h.L+"px)"},figurePercentage:function(a,c,b,
e){var d,f;f=true;d=b=="X";switch(e){case "left":case "top":a[b]=0;break;case "center":a[b]=0.5;break;case "right":case "bottom":a[b]=1;break;default:if(e.search("%")!=-1)a[b]=parseInt(e,10)/100;else f=false}a[b]=Math.ceil(f?c[d?"W":"H"]*a[b]-c[d?"w":"h"]*a[b]:parseInt(e,10));a[b]%2===0&&a[b]++;return a[b]},fixPng:function(a){a.style.behavior="none";var c,b,e,d,f;if(!(a.nodeName=="BODY"||a.nodeName=="TD"||a.nodeName=="TR")){a.isImg=false;if(a.nodeName=="IMG")if(a.src.toLowerCase().search(/\.png$/)!=
-1){a.isImg=true;a.style.visibility="hidden"}else return;else if(a.currentStyle.backgroundImage.toLowerCase().search(".png")==-1)return;c=DD_belatedPNG;a.vml={color:{},image:{}};b={shape:{},fill:{}};for(d in a.vml)if(a.vml.hasOwnProperty(d)){for(f in b)if(b.hasOwnProperty(f)){e=c.ns+":"+f;a.vml[d][f]=document.createElement(e)}a.vml[d].shape.stroked=false;a.vml[d].shape.appendChild(a.vml[d].fill);a.parentNode.insertBefore(a.vml[d].shape,a)}a.vml.image.shape.fillcolor="none";a.vml.image.fill.type="tile";
a.vml.color.fill.on=false;c.attachHandlers(a);c.giveLayout(a);c.giveLayout(a.offsetParent);a.vmlInitiated=true;c.applyVML(a)}}};if(ua.ie()==6){try{document.execCommand("BackgroundImageCache",false,true)}catch(r){}DD_belatedPNG.createVmlNameSpace();DD_belatedPNG.createVmlStyleSheet()};
	

//当点击某个对象显示或隐藏某个对象
/*
source 目标源ID
target 目标ID
show_class 显示class
hide_class 隐藏class
reverse 是否是反转true反转  false 不反转 反转:默认的时候是隐藏状态  反转状态 默认的是显示状态
effect 效果 1.无效果  2.淡入淡出 3.向下或向上伸缩
effect_time 效果时间
*/
function toggle(params){
	var _source=params.source;
	var _target=params.target;
	var _show_class=params.show_class;
	var _hide_class=params.hide_class;
	var _reverse=params.reverse;
	var _effect=params.effect;
	var _effect_time=params.effect_time;
	
	if(_reverse){
		jQuery("#"+_source).toggle(
	  function(){
	  	switch(_effect){
	  		 case '1':
	  		   jQuery("#"+_target).hide();
	  		   break;
	  		 case '2':
	  		   jQuery("#"+_target).fadeOut(_effect_time);
	  		   break;
	  		 case '3':
	  		   jQuery("#"+_target).slideUp(_effect_time);
	  		   break;
	  	}
	  	
	  	jQuery(this).removeClass(_show_class).addClass(_hide_class);
		},
		function(){
		  switch(_effect){
	  		 case '1':
	  		   jQuery("#"+_target).show();
	  		   break;
	  		 case '2':
	  		   jQuery("#"+_target).fadeIn(_effect_time);
	  		   break;
	  		 case '3':
	  		   jQuery("#"+_target).slideDown(_effect_time);
	  		   break;
	  	}
	  	jQuery(this).removeClass(_hide_class).addClass(_show_class);
	  });
	}else{
		jQuery("#"+_source).toggle(
	  function(){
	  	
	  	switch(_effect){
	  		 case '1':
	  		   jQuery("#"+_target).show();
	  		   break;
	  		 case '2':
	  		   jQuery("#"+_target).fadeIn(_effect_time);
	  		   break;
	  		 case '3':
	  		   jQuery("#"+_target).slideDown(_effect_time);
	  		   break;
	  	}
	  	jQuery(this).removeClass(_hide_class).addClass(_show_class);
	  	
		},
		function(){
			switch(_effect){
	  		 case '1':
	  		   jQuery("#"+_target).hide();
	  		   break;
	  		 case '2':
	  		   jQuery("#"+_target).fadeOut(_effect_time);
	  		   break;
	  		 case '3':
	  		   jQuery("#"+_target).slideUp(_effect_time);
	  		   break;
	  	}
	  	jQuery(this).removeClass(_show_class).addClass(_hide_class);
	  });
		
	}
	
	
}



//显示或隐藏对象的menu
/*
source 原class
target 目标class
type   1.点击 2.hover
effect 效果 1.无效果  2.淡入淡出 3.向下或向上伸缩
effect_time 效果时间
*/
function togglemenu(params){
	var _source=params.source;
	var _target=params.target;
  var _type=params.type;
	var _effect=params.effect;
	var _effect_time=params.effect_time;

 if(_type=='1'){
 	jQuery("."+_source).bind('click',function(){
 		 var index=jQuery(this).attr('index');
 		 switch(_effect){
	  		 case '1':
	  		   jQuery("."+_target).hide();
	  		   jQuery("#"+_target+"_"+index).show();
	  		   jQuery("."+_source).removeClass(_source+"_active");
	  		   jQuery(this).addClass(_source+"_active");
	  		   break;
	  		 case '2':
	  		   
	  		   jQuery("."+_target).hide();
	  		   jQuery("#"+_target+"_"+index).fadeIn(_effect_time);
	  		   jQuery("."+_source).removeClass(_source+"_active");
	  		   jQuery(this).addClass(_source+"_active");
	  		   break;
	  		 case '3':
	  		   jQuery("."+_target).hide();
	  		   jQuery("#"+_target+"_"+index).slideDown(_effect_time);
	  		   jQuery("."+_source).removeClass(_source+"_active");
	  		   jQuery(this).addClass(_source+"_active");
	  		   break;
	  	}
 		
 	});
 }else{
	 jQuery("."+_source).bind('mouseover',function(){
 		 var index=jQuery(this).attr('index');
 		 switch(_effect){
	  		 case '1':
	  		   jQuery("."+_target).hide();
	  		   jQuery("#"+_target+"_"+index).show();
	  		   jQuery("."+_source).removeClass(_source+"_active");
	  		   jQuery(this).addClass(_source+"_active");
	  		   break;
	  		 case '2':
	  		   jQuery("."+_target).hide();
	  		   jQuery("#"+_target+"_"+index).fadeIn(_effect_time);
	  		   jQuery("."+_source).removeClass(_source+"_active");
	  		   jQuery(this).addClass(_source+"_active");
	  		   break;
	  		 case '3':
	  		   jQuery("."+_target).hide();
	  		   jQuery("#"+_target+"_"+index).slideDown(_effect_time);
	  		   jQuery("."+_source).removeClass(_source+"_active");
	  		   jQuery(this).addClass(_source+"_active");
	  		   break;
	  	}
 		
 	});	
 	
 }

}



//显示或隐藏对象的menu
/*
source 原class
target 目标class
type   1.点击 2.hover
effect 效果 1.无效果  2.淡入淡出 3.向下或向上伸缩
effect_time 效果时间
*/
function toggleitem(params){
	
	var _source=params.source;
	var _target=params.target;
  var _type=params.type;
	var _effect=params.effect;
	var _effect_time=params.effect_time;
	var effect_flag=false;
 if(_type=='1'){
 	jQuery("."+_source).toggle(function(){
 		 	switch(_effect){
	  		 case '1':
	  		   jQuery("."+_target).show();
	  		   jQuery("."+_source).addClass(_source+"_active");
	  		   break;
	  		 case '2':
	  		 if(!effect_flag){
	  		   jQuery("."+_target).fadeIn(_effect_time,function(){effect_flag=true;});
	  		   jQuery("."+_source).addClass(_source+"_active");
	  		 }
	  		 
	  		   break;
	  		 case '3':
	  		 if(!effect_flag){
	  		   jQuery("."+_target).slideDown(_effect_time,function(){effect_flag=true;});
	  		   jQuery("."+_source).addClass(_source+"_active");
	  		 }
	  		   break;
	  	 }
	    },
	  	function(){
	  		switch(_effect){
	  		 case '1':
	  		   jQuery("."+_target).hide();
	  		   jQuery("."+_source).removeClass(_source+"_active");
	  		   break;
	  		 case '2':
	  		 if(effect_flag){
	  		   jQuery("."+_target).fadeOut(_effect_time,function(){
	  		   	  jQuery("."+_source).removeClass(_source+"_active");
	  		   	  effect_flag=false;
	  		   	});
	  		  }
	  		   
	  		   break;
	  		 case '3':
	  		 if(effect_flag){
	  		   jQuery("."+_target).slideUp(_effect_time,function(){
	  		   	jQuery("."+_source).removeClass(_source+"_active");
	  		   	effect_flag=false;
	  		  });
	  		  }  
	  		   break;
	  	 }
	  	}
 	);
 }else{
	 jQuery("."+_source).hover(
    function(){
      	switch(_effect){
	  		 case '1':
	  		   jQuery("."+_target).show();
	  		   jQuery("."+_source).addClass(_source+"_active");
	  		   break;
	  		 case '2':
	  		 if(!effect_flag){
	  		   jQuery("."+_target).fadeIn(_effect_time,function(){effect_flag=true;});
	  		   jQuery("."+_source).addClass(_source+"_active");
	  		 }
	  		   break;
	  		 case '3':
	  		 if(!effect_flag){
	  		   jQuery("."+_target).slideDown(_effect_time,function(){effect_flag=true;});
	  		   jQuery("."+_source).addClass(_source+"_active");
	  		 }
	  		   break;
	  	 }
    },
    function(){
       switch(_effect){
	  		 case '1':
	  		   jQuery("."+_target).hide();
	  		   jQuery("."+_source).removeClass(_source+"_active");
	  		   break;
	  		 case '2':
	  		 if(effect_flag){
	  		   jQuery("."+_target).fadeOut(_effect_time,function(){
	  		   	jQuery("."+_source).removeClass(_source+"_active");
	  		   	effect_flag=false;
	  		  });
	  		 } 
	  		   break;
	  		 case '3':
	  		 
	  		 if(effect_flag){
	  		   jQuery("."+_target).slideUp(_effect_time,function(){
	  		   	jQuery("."+_source).removeClass(_source+"_active");
	  		   	effect_flag=false;
	  		  });
	  		  }
	  		   
	  		   break;
	  	 }
    }
  ); 
 }
}



function pop_login(){
		// 用iframe显示http://www.baidu.com的内容，并设置了标题、宽与高、按钮
		
jQuery.jBox("iframe:/login/paypop", {
    title: "用户登录",
    width: 800,
    height: 400,
    buttons: { '关闭': true }
});
}


function pop_no_pay_login(){
		// 用iframe显示http://www.baidu.com的内容，并设置了标题、宽与高、按钮
		
jQuery.jBox("iframe:/login/pop", {
    title: "用户登录",
    width: 800,
    height: 400,
    buttons: { '关闭': true }
});
}

function set_bmap(address){
 jQuery.jBox("iframe:/baidumaps/index/address/"+address, {
    title: "百度地图",
    width: 800,
    height: 500,
    buttons: { '关闭': true }
 });	
	
}


function show_bmap(address,is_edit){
 jQuery.jBox("iframe:/baidumaps/show/address/"+address+"/is_edit/"+is_edit, {
    title: "百度地图",
    width: 800,
    height: 500,
    buttons: { '关闭': true }
 });	
	
}


function show_keywords_describe(keyword_id,keyword_text,form_id){
	var keyword_content=jQuery("#"+keyword_id).val();
	if(keyword_content==''){
		jQuery("#"+keyword_id).val(keyword_text);
		jQuery("#"+keyword_id).css('color',"#666666");
	}
	jQuery("#"+keyword_id).bind("focus",function(){
		var keyword_content=jQuery(this).val();
		if(keyword_content==keyword_text){
		   jQuery(this).val('');
		   jQuery("#"+keyword_id).css('color',"#000000");
		}
	}).bind("blur",function(){
		var keyword_content=jQuery(this).val();
		if(keyword_content==''){
			jQuery(this).val(keyword_text);
			jQuery("#"+keyword_id).css('color',"#666666");
		}
		
	});
	
	jQuery("#"+form_id).bind('submit',function(){
		var keyword_content=jQuery("#"+keyword_id).val();
		if(keyword_content==keyword_text){
		   jQuery("#"+keyword_id).val('');
		}
		
	});
	
	
}


//返回顶部代码
function goTopEx(){
        var bt=jQuery("#goTopBtn");
        bt.bind("click",function(){
        	 window.scrollTo(0,0);
        });
        jQuery(window).scroll(function() {
								var st = jQuery(window).scrollTop();
								if(st > 30){
									if(ua.ie()==6){
									  var add_top=parseInt(document.documentElement.clientHeight-50)+parseInt(st);
									  bt.css("top",add_top);
									 }
										bt.show();
								}else{
										bt.hide();
						    }
				}); 

    }
    
//鼠标放到更多目的地时显示目的地
function show_more_region(source,target,active){
	jQuery("."+source).hover(
    		function(){
           jQuery(this).find("."+target).show();
           jQuery(this).find("."+active).addClass(active+"_active");
    		},
    		function(){
	  		   jQuery(this).find("."+target).hide();
           jQuery(this).find("."+active).removeClass(active+"_active");
	  		}
    );
}

//异步获取线路资料
function get_travel_datas(show,channel_id,end_region,attr,linetype,limit,sort,sort_type,view){
	jQuery.ajax({
	    async:true,
        type: "Get",
        cache:true,
        beforeSend:function(){jQuery("#"+show).html("<div class='progress_img'><img src='/css/images/loading.gif' width='19' height='18'/></div>");},
        url: "/api/gettravel",
        dataType:"json",
        data: "channel_id="+channel_id+"&end_region="+end_region+"&attr="+attr+"&linetype="+linetype+"&limit="+limit+"&sort="+sort+"&sort_type="+sort_type+"&view="+view+"&rmd="+Date.parse(new Date()),
        success: function(msg){
          if(msg.flag=='1'){
          	jQuery("#"+show).html(msg.message);
          }
        }
      });
}


//异步获取线路资料
function get_hotels_datas(show,category,end_region,attr,limit,sort,sort_type,view,brand_id){
	jQuery.ajax({
	    async:true,
        type: "Get",
        cache:true,
        beforeSend:function(){jQuery("#"+show).html("<div class='progress_img'><img src='/css/images/loading.gif' width='19' height='18'/></div>");},
        url: "/api/gethotels",
        dataType:"json",
        data: "category="+category+"&end_region="+end_region+"&attr="+attr+"&limit="+limit+"&sort="+sort+"&sort_type="+sort_type+"&view="+view+"&brand_id="+brand_id+"&rmd="+Date.parse(new Date()),
        success: function(msg){
          if(msg.flag=='1'){
          	jQuery("#"+show).html(msg.message);
          }
        }
      });
}



//异步获取线路的团期
function get_travel_date(travel_id){
	jQuery.jBox("iframe:/travel/date/id/"+travel_id, {
    title: "出行价格表",
    width: 750,
    height: 500,
    buttons: { '关闭': true }
 });	
}


function get_date_datas(id,year,month){
	jQuery.getJSON("/api/traveldate", { id:id,year: year, month: month }, function(json){
  			if(json.flag=='1'){
					var monthDay = new Date(year, month, 0).getDate();
					var today=getTime().substr(0,10);
					for(var i = 1, len = monthDay; i <= len; i++){
						var current_date=getTime(new Date(year, month-1, i)).substr(0,10);
						var innerhtml="";
						var date_datas=json.datas;
						var date_key=get_date_key(current_date,date_datas);
						if(date_key){
							if(Date.parse(current_date)<Date.parse(today)){
								innerhtml+="<div class='hdetail gray'>";
							}else{
								innerhtml+="<div class='hdetail'>";
							}
							  
								innerhtml+=i;
								innerhtml+="<span>"+date_datas[date_key-1].seats+"<br>￥<b>"+date_datas[date_key-1].price+"</b><s></s></span>";
								innerhtml+="</div>";
						}else{
							
							if(Date.parse(current_date)<Date.parse(today)){
								innerhtml+="<div class='hno gray'>";
							}else{
								innerhtml+="<div class='hno'>";
							}
								innerhtml+=i;
								innerhtml+="</div>";
						}
						cale.Days[i].innerHTML=innerhtml;
					}
  			}
	 }); 
}
function get_date_detail_datas(id,year,month){
	jQuery.getJSON("/api/traveldate", { id:id,year: year, month: month }, function(json){
  			if(json.flag=='1'){
					var monthDay = new Date(year, month, 0).getDate();
					var today=getTime().substr(0,10);
					for(var i = 1, len = monthDay; i <= len; i++){
						var current_date=getTime(new Date(year, month-1, i)).substr(0,10);
						var innerhtml="";
						var date_datas=json.datas;
						var date_key=get_date_key(current_date,date_datas);
						if(date_key){
							if(Date.parse(current_date)<Date.parse(today)){
								innerhtml+="<div class='hsdetail gray'>";
							}else{
								innerhtml+="<div class='hsdetail' date='"+date_datas[date_key-1].date+"'>";
							}
							  
								innerhtml+=i;
								innerhtml+="<span>"+date_datas[date_key-1].seats+"<br>￥<b>"+date_datas[date_key-1].price+"</b></span>";
								innerhtml+="</div>";
						}else{
							
							if(Date.parse(current_date)<Date.parse(today)){
								innerhtml+="<div class='hno gray'>";
							}else{
								innerhtml+="<div class='hno'>";
							}
								innerhtml+=i;
								innerhtml+="</div>";
						}
						cale.Days[i].innerHTML=innerhtml;
					}
  			}
	 }); 
}


function get_date_key(current_date,datas){
	var datas_length=datas.length;
	for(var ii=0;ii<datas_length;ii++){
		var date=datas[ii].date;
		if(date==current_date){
			return ii+1;
		}
	}

}

//设置点击按钮时对input框进行加减 type:1 加 2 减
function add_sub(type,input_id){
	var input=jQuery("#"+input_id);
	var input_value=input.val();
	switch(type){
		case 1:
		  input_value=parseInt(input_value)+1;
		  input.val(input_value);
		  break;
		case 2:
		  input_value=parseInt(input_value)-1;
		  input_value=input_value < 0?0:input_value;
		  input.val(input_value);
		  break;
	}
	
	
}
function show_pay_tip(controller_id){
	jQuery.jBox("iframe:/"+controller_id+"/paytip", {
    title: "付款提示",
    width: 500,
    height: 370,
    buttons: { '关闭': true }
 });	
}



