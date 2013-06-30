
var AJAXConnectionPool = function() {
// 任务队列
var taskQueue = [];
// 请求缓冲池
var requestBufferPool = [];
// 最大连接数
var maxThreadNumber = 2;
return {
/**
* 获取空闲请求
* @return {空闲请求对象}
*/
getIdleRequest : function() {
var request = null;
for (var i = 0; i < maxThreadNumber; i++) {
if (requestBufferPool[i].readyState == 0) {
request = requestBufferPool[i];
break;
}
}
return request;
},
/**
* 初始化
* @param {最大连接数} max
*/
init : function(max) {
if (max != null)
maxThreadNumber = max;
for (var k = 0; k < maxThreadNumber; k++) {
var request = null;
if (window.XMLHttpRequest) {         // 如果是 Google Chrome、 Mozilla Firefox、Netscape、Opera 8.0+、Safari、IE7+ 等浏览器
request = new XMLHttpRequest();
if (request.overrideMimeType) {  // 设置 MiME 类别
/*
* 有些版本的浏览器在处理服务器返回的未包含XML mime-type头部
* 信息的内容时会报错，因此，要确保返回的内容包含text/xml信息。
*/
request.overrideMimeType("text/xml");
}
} else if (window.ActiveXObject) {   // 如果是 Internet Explorer 6.0- 浏览器
var msXml = [
"Msxml2.XMLHTTP.6.0",
"Msxml2.XMLHTTP.5.0",
"Msxml2.XMLHTTP.4.0",
"Msxml2.XMLHTTP.3.0",
"Msxml2.XMLHTTP",
"Microsoft.XMLHTTP"];
for(var i = 0; i < msXml.length; i++) {
try{
request = new ActiveXObject(msXml[i]);
break;
}catch(e) {
request = null;
}
}
if (request == null) {
alert("Sorry! Because you are using a browser that does not support AJAX, the server can not process a request submitted!");
return;
}
}
requestBufferPool.push(request);
}
},
/**
* 获取浏览器类型
* @return {浏览器类型字串}
*/
getBrowserType : function() {
if (navigator.userAgent.indexOf("MSIE") > 0) {
return "MSIE";     // IE浏览器
} else if (navigator.userAgent.indexOf("Firefox") > 0) {
return "Firefox";  // Firefox浏览器
} else if (navigator.userAgent.indexOf("Safari") > 0) {
return "Safari";   // Safan浏览器
} else if (navigator.userAgent.indexOf("Camino") > 0) {
return "Camino";   // Camino浏览器
} else if (navigator.userAgent.indexOf("Gecko/") > 0) {
return "Gecko";    // Gecko浏览器
} else {
return "Unknown";  // 未知浏览器
}
},
/**
* 发送请求
*
* @param {请求方法 post|get} method
* @param {请求URL地址} url
* @param {数据} data
* @param {回调函数} callback
* @param {作用域} scope
* @param {是否发送异步请求，注意：Firefox浏览器的同步请求时不能执行回调方法 true|false} isAsync
*/
send : function(method, url, data, callback, scope, isAsync) {
// XML 回调句柄
var xmlCallbackHandler = function() {
if (request.readyState < 4) {
window.status = "Loading...";
} else if (request.readyState == 4) {
if (request.status == 200) {
window.status = "Finished.";
if (handler.func != null) {
handler.func.call(handler.scope != null
? handler.scope
: window, request.responseText,
request.responseXML, request.status);
}
request.abort();
if (taskQueue.length > 0) {
// 这里有多个任务处于队列中等待连接，首先执行第一个任务
var task = taskQueue.shift();
AJAXConnectionPool.send(task.method, task.url, task.data,
task.callback, task.scope, isAsync);
}
} else if (request.status == 404) {
window.status = "Requested URL is not found.";
alert ("Requested URL is not found.");
} else if (request.status == 403) {
window.status = "Access denied.";
alert("Access denied.");
} else {
window.status = "Requested status is " + request.status;
alert("Requested status is " + request.status);
}
} else {
(function() {
throw request.status;
}).call(handler.scope != null ? handler.scope : window);
}
};
// 获取空闲请求
var request = AJAXConnectionPool.getIdleRequest();
// 这是一个空闲请求
if (request != null) {
var handler = {
func : callback,
scope : scope
};
if (method.toLowerCase() == "get") {
// 添加时间戳以防止浏览器缓存页面数据
url += ((url.indexOf("?") > 0 ? "&" : "?")
+ "timestamp="
+ new Date().getTime());
}
// 发送请求
request.open(method, url, isAsync);
request.setRequestHeader(
"Content-type",
(method.toLowerCase() == "post"
? "application/x-www-form-urlencoded;"
: "text/xml")
);
if (AJAXConnectionPool.getBrowserType() != "Firefox") {
request.onreadystatechange = xmlCallbackHandler;
}
request.send(data);
if (AJAXConnectionPool.getBrowserType() == "Firefox") {
// Early call mode：request.onreadystatechange = xmlCallbackHandler();
request.onreadystatechange = xmlCallbackHandler;
}
} else {
// 所有请求都繁忙的时候，则将任务纳入等待队列中
var task = {
method : method,
url : url,
data : data,
callback : callback,
scope : scope
};
taskQueue.push(task);
}
}
};
}();


/*使用方法
// 获取空闲请求对象
2	var request = AJAXConnectionPool.getIdleRequest();
3	// 发送数据并通过异步回调处理函数
4	AJAXConnectionPool.send(method, url, null, function() {
5	// 回调函数处理逻辑
6	}, window, true);


*/