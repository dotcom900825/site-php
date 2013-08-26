// Timestamp: [[ 2013-01-16 09:04:27 +0000 by Mike Yrabedra (mikeyrab) ]]

var backsnap = {};

// A closure is defined and assigned to the stack's object.  The object
// is also passed in as 'stack' which gives you a shorthand for referring
// to this object from elsewhere.
backsnap = (function() {


// Yabdab function used with taco
$.fn.replaceAndFadeIn = function(newContentElements) { 
    return this.each(function() { 
        // for each matching element, remove the current contents, hide the element, 
        // append the new contents and then fadeIn the element 
        $(this).empty().hide().append(newContentElements).fadeIn('slow'); 
    }); 
};


  
/*!
 * jQuery blockUI plugin
 * Version 2.54 (17-DEC-2012)
 * @requires jQuery v1.3 or later
 *
 * Examples at: http://malsup.com/jquery/block/
 * Copyright (c) 2007-2012 M. Alsup
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 * Thanks to Amir-Hossein Sobhi for some excellent contributions!
 */

(function(){function n(b){function n(d,a){var e,g,j=d==window,f=a&&void 0!==a.message?a.message:void 0;a=b.extend({},b.blockUI.defaults,a||{});if(!a.ignoreIfBlocked||!b(d).data("blockUI.isBlocked")){a.overlayCSS=b.extend({},b.blockUI.defaults.overlayCSS,a.overlayCSS||{});e=b.extend({},b.blockUI.defaults.css,a.css||{});a.onOverlayClick&&(a.overlayCSS.cursor="pointer");g=b.extend({},b.blockUI.defaults.themedCSS,a.themedCSS||{});f=void 0===f?a.message:f;j&&l&&r(window,{fadeOut:0});if(f&&"string"!=typeof f&&
(f.parentNode||f.jquery)){var h=f.jquery?f[0]:f,c={};b(d).data("blockUI.history",c);c.el=h;c.parent=h.parentNode;c.display=h.style.display;c.position=h.style.position;c.parent&&c.parent.removeChild(h)}b(d).data("blockUI.onUnblock",a.onUnblock);var c=a.baseZ,k;k=s||a.forceIframe?b('<iframe class="blockUI" style="z-index:'+c++ +';display:none;border:none;margin:0;padding:0;position:absolute;width:100%;height:100%;top:0;left:0" src="'+a.iframeSrc+'"></iframe>'):b('<div class="blockUI" style="display:none"></div>');
h=a.theme?b('<div class="blockUI blockOverlay ui-widget-overlay" style="z-index:'+c++ +';display:none"></div>'):b('<div class="blockUI blockOverlay" style="z-index:'+c++ +';display:none;border:none;margin:0;padding:0;width:100%;height:100%;top:0;left:0"></div>');a.theme&&j?(c='<div class="blockUI '+a.blockMsgClass+' blockPage ui-dialog ui-widget ui-corner-all" style="z-index:'+(c+10)+';display:none;position:fixed">',a.title&&(c+='<div class="ui-widget-header ui-dialog-titlebar ui-corner-all blockTitle">'+
(a.title||"&nbsp;")+"</div>"),c+='<div class="ui-widget-content ui-dialog-content"></div></div>'):a.theme?(c='<div class="blockUI '+a.blockMsgClass+' blockElement ui-dialog ui-widget ui-corner-all" style="z-index:'+(c+10)+';display:none;position:absolute">',a.title&&(c+='<div class="ui-widget-header ui-dialog-titlebar ui-corner-all blockTitle">'+(a.title||"&nbsp;")+"</div>"),c+='<div class="ui-widget-content ui-dialog-content"></div>',c+="</div>"):c=j?'<div class="blockUI '+a.blockMsgClass+' blockPage" style="z-index:'+
(c+10)+';display:none;position:fixed"></div>':'<div class="blockUI '+a.blockMsgClass+' blockElement" style="z-index:'+(c+10)+';display:none;position:absolute"></div>';c=b(c);f&&(a.theme?(c.css(g),c.addClass("ui-widget-content")):c.css(e));a.theme||h.css(a.overlayCSS);h.css("position",j?"fixed":"absolute");(s||a.forceIframe)&&k.css("opacity",0);e=[k,h,c];var q=j?b("body"):b(d);b.each(e,function(){this.appendTo(q)});a.theme&&(a.draggable&&b.fn.draggable)&&c.draggable({handle:".ui-dialog-titlebar",cancel:"li"});
g=z&&(!b.support.boxModel||0<b("object,embed",j?null:d).length);if(u||g){j&&(a.allowBodyStretch&&b.support.boxModel)&&b("html,body").css("height","100%");if((u||!b.support.boxModel)&&!j){g=parseInt(b.css(d,"borderTopWidth"),10)||0;var p=parseInt(b.css(d,"borderLeftWidth"),10)||0,v=g?"(0 - "+g+")":0,w=p?"(0 - "+p+")":0}b.each(e,function(b,d){var c=d[0].style;c.position="absolute";if(2>b)j?c.setExpression("height","Math.max(document.body.scrollHeight, document.body.offsetHeight) - (jQuery.support.boxModel?0:"+
a.quirksmodeOffsetHack+') + "px"'):c.setExpression("height",'this.parentNode.offsetHeight + "px"'),j?c.setExpression("width",'jQuery.support.boxModel && document.documentElement.clientWidth || document.body.clientWidth + "px"'):c.setExpression("width",'this.parentNode.offsetWidth + "px"'),w&&c.setExpression("left",w),v&&c.setExpression("top",v);else if(a.centerY)j&&c.setExpression("top",'(document.documentElement.clientHeight || document.body.clientHeight) / 2 - (this.offsetHeight / 2) + (blah = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + "px"'),
c.marginTop=0;else if(!a.centerY&&j){var e="((document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + "+(a.css&&a.css.top?parseInt(a.css.top,10):0)+') + "px"';c.setExpression("top",e)}})}f&&(a.theme?c.find(".ui-widget-content").append(f):c.append(f),(f.jquery||f.nodeType)&&b(f).show());(s||a.forceIframe)&&a.showOverlay&&k.show();if(a.fadeIn)e=a.onBlock?a.onBlock:t,k=a.showOverlay&&!f?e:t,e=f?e:t,a.showOverlay&&h._fadeIn(a.fadeIn,k),f&&c._fadeIn(a.fadeIn,
e);else if(a.showOverlay&&h.show(),f&&c.show(),a.onBlock)a.onBlock();x(1,d,a);j?(l=c[0],m=b(":input:enabled:visible",l),a.focusInput&&setTimeout(y,20)):(e=c[0],f=a.centerX,h=a.centerY,g=e.parentNode,c=e.style,k=(g.offsetWidth-e.offsetWidth)/2-(parseInt(b.css(g,"borderLeftWidth"),10)||0),e=(g.offsetHeight-e.offsetHeight)/2-(parseInt(b.css(g,"borderTopWidth"),10)||0),f&&(c.left=0<k?k+"px":"0"),h&&(c.top=0<e?e+"px":"0"));a.timeout&&(f=setTimeout(function(){j?b.unblockUI(a):b(d).unblock(a)},a.timeout),
b(d).data("blockUI.timeout",f))}}function r(d,a){var e=d==window,g=b(d),j=g.data("blockUI.history"),f=g.data("blockUI.timeout");f&&(clearTimeout(f),g.removeData("blockUI.timeout"));a=b.extend({},b.blockUI.defaults,a||{});x(0,d,a);null===a.onUnblock&&(a.onUnblock=g.data("blockUI.onUnblock"),g.removeData("blockUI.onUnblock"));var h;h=e?b("body").children().filter(".blockUI").add("body > .blockUI"):g.find(">.blockUI");a.cursorReset&&(1<h.length&&(h[1].style.cursor=a.cursorReset),2<h.length&&(h[2].style.cursor=
a.cursorReset));e&&(l=m=null);a.fadeOut?(h.fadeOut(a.fadeOut),setTimeout(function(){q(h,j,a,d)},a.fadeOut)):q(h,j,a,d)}function q(d,a,e,g){d.each(function(){this.parentNode&&this.parentNode.removeChild(this)});a&&a.el&&(a.el.style.display=a.display,a.el.style.position=a.position,a.parent&&a.parent.appendChild(a.el),b(g).removeData("blockUI.history"));if("function"==typeof e.onUnblock)e.onUnblock(g,e);d=b(document.body);a=d.width();e=d[0].style.width;d.width(a-1).width(a);d[0].style.width=e}function x(d,
a,e){var g=a==window;a=b(a);if(d||!(g&&!l||!g&&!a.data("blockUI.isBlocked")))a.data("blockUI.isBlocked",d),e.bindEvents&&(!d||e.showOverlay)&&(d?b(document).bind("mousedown mouseup keydown keypress keyup touchstart touchend touchmove",e,p):b(document).unbind("mousedown mouseup keydown keypress keyup touchstart touchend touchmove",p))}function p(d){if(d.keyCode&&9==d.keyCode&&l&&d.data.constrainTabKey){var a=m,e=d.shiftKey&&d.target===a[0];if(!d.shiftKey&&d.target===a[a.length-1]||e)return setTimeout(function(){y(e)},
10),!1}a=d.data;d=b(d.target);if(d.hasClass("blockOverlay")&&a.onOverlayClick)a.onOverlayClick();return 0<d.parents("div."+a.blockMsgClass).length?!0:0===d.parents().children().filter("div.blockUI").length}function y(b){m&&(b=m[!0===b?m.length-1:0])&&b.focus()}if(/^1\.(0|1|2)/.test(b.fn.jquery))alert("blockUI requires jQuery v1.3 or later!  You are using v"+b.fn.jquery);else{b.fn._fadeIn=b.fn.fadeIn;var t=b.noop||function(){},s=/MSIE/.test(navigator.userAgent),u=/MSIE 6.0/.test(navigator.userAgent),
z=b.isFunction(document.createElement("div").style.setExpression);b.blockUI=function(b){n(window,b)};b.unblockUI=function(b){r(window,b)};b.growlUI=function(d,a,e,g){var j=b('<div class="growlUI"></div>');d&&j.append("<h1>"+d+"</h1>");a&&j.append("<h2>"+a+"</h2>");void 0===e&&(e=3E3);b.blockUI({message:j,fadeIn:700,fadeOut:1E3,centerY:!1,timeout:e,showOverlay:!1,onUnblock:g,css:b.blockUI.defaults.growlCSS})};b.fn.block=function(d){var a=b.extend({},b.blockUI.defaults,d||{});this.each(function(){var d=
b(this);(!a.ignoreIfBlocked||!d.data("blockUI.isBlocked"))&&d.unblock({fadeOut:0})});return this.each(function(){"static"==b.css(this,"position")&&(this.style.position="relative");this.style.zoom=1;n(this,d)})};b.fn.unblock=function(b){return this.each(function(){r(this,b)})};b.blockUI.version=2.54;b.blockUI.defaults={message:"<h1>Please wait...</h1>",title:null,draggable:!0,theme:!1,css:{padding:0,margin:0,width:"30%",top:"40%",left:"35%",textAlign:"center",color:"#000",border:"3px solid #aaa",backgroundColor:"#fff",
cursor:"wait"},themedCSS:{width:"30%",top:"40%",left:"35%"},overlayCSS:{backgroundColor:"#000",opacity:0.6,cursor:"wait"},cursorReset:"default",growlCSS:{width:"350px",top:"10px",left:"",right:"10px",border:"none",padding:"5px",opacity:0.6,cursor:"default",color:"#fff",backgroundColor:"#000","-webkit-border-radius":"10px","-moz-border-radius":"10px","border-radius":"10px"},iframeSrc:/^https/i.test(window.location.href||"")?"javascript:false":"about:blank",forceIframe:!1,baseZ:1E3,centerX:!0,centerY:!0,
allowBodyStretch:!0,bindEvents:!0,constrainTabKey:!0,fadeIn:200,fadeOut:400,timeout:0,showOverlay:!0,focusInput:!0,onBlock:null,onUnblock:null,onOverlayClick:null,quirksmodeOffsetHack:4,blockMsgClass:"blockMsg",ignoreIfBlocked:!1};var l=null,m=[]}}"function"===typeof define&&define.amd&&define.amd.jQuery?define(["jquery"],n):n(jQuery)})();


/*!
 * jQuery Form Plugin
 * version: 3.24 (26-DEC-2012)
 * @requires jQuery v1.5 or later
 *
 * Examples and documentation at: http://malsup.com/jquery/form/
 * Project repository: https://github.com/malsup/form
 * Dual licensed under the MIT and GPL licenses:
 *    http://malsup.github.com/mit-license.txt
 *    http://malsup.github.com/gpl-license-v2.txt
 */
 (function(c){function v(a){var e=a.data;a.isDefaultPrevented()||(a.preventDefault(),c(this).ajaxSubmit(e))}function u(a){var e=a.target,f=c(e);if(!f.is("[type=submit],[type=image]")){e=f.closest("[type=submit]");if(0===e.length)return;e=e[0]}var b=this;b.clk=e;"image"==e.type&&(void 0!==a.offsetX?(b.clk_x=a.offsetX,b.clk_y=a.offsetY):"function"==typeof c.fn.offset?(f=f.offset(),b.clk_x=a.pageX-f.left,b.clk_y=a.pageY-f.top):(b.clk_x=a.pageX-e.offsetLeft,b.clk_y=a.pageY-e.offsetTop));setTimeout(function(){b.clk=
b.clk_x=b.clk_y=null},100)}function q(){if(c.fn.ajaxSubmit.debug){var a="[jquery.form] "+Array.prototype.join.call(arguments,"");window.console&&window.console.log?window.console.log(a):window.opera&&window.opera.postError&&window.opera.postError(a)}}var B,C;B=void 0!==c("<input type='file'/>").get(0).files;C=void 0!==window.FormData;c.fn.ajaxSubmit=function(a){function e(b){function e(){function a(){try{var c=(r.contentWindow?r.contentWindow.document:r.contentDocument?r.contentDocument:r.document).readyState;
q("state = "+c);c&&"uninitialized"==c.toLowerCase()&&setTimeout(a,50)}catch(b){q("Server abort: ",b," (",b.name,")"),k(y),u&&clearTimeout(u),u=void 0}}var b=l.attr("target"),h=l.attr("action");g.setAttribute("target",n);f||g.setAttribute("method","POST");h!=d.url&&g.setAttribute("action",d.url);!d.skipEncodingOverride&&(!f||/post/i.test(f))&&l.attr({encoding:"multipart/form-data",enctype:"multipart/form-data"});d.timeout&&(u=setTimeout(function(){v=!0;k(z)},d.timeout));var m=[];try{if(d.extraData)for(var j in d.extraData)d.extraData.hasOwnProperty(j)&&
(c.isPlainObject(d.extraData[j])&&d.extraData[j].hasOwnProperty("name")&&d.extraData[j].hasOwnProperty("value")?m.push(c('<input type="hidden" name="'+d.extraData[j].name+'">').val(d.extraData[j].value).appendTo(g)[0]):m.push(c('<input type="hidden" name="'+j+'">').val(d.extraData[j]).appendTo(g)[0]));d.iframeTarget||(x.appendTo("body"),r.attachEvent?r.attachEvent("onload",k):r.addEventListener("load",k,!1));setTimeout(a,15);g.submit()}finally{g.setAttribute("action",h),b?g.setAttribute("target",
b):l.removeAttr("target"),c(m).remove()}}function k(a){if(!h.aborted&&!C){try{s=r.contentWindow?r.contentWindow.document:r.contentDocument?r.contentDocument:r.document}catch(b){q("cannot access response document: ",b),a=y}if(a===z&&h)h.abort("timeout"),w.reject(h,"timeout");else if(a==y&&h)h.abort("server abort"),w.reject(h,"error","server abort");else if(s&&s.location.href!=d.iframeSrc||v){r.detachEvent?r.detachEvent("onload",k):r.removeEventListener("load",k,!1);a="success";var e;try{if(v)throw"timeout";
var f="xml"==d.dataType||s.XMLDocument||c.isXMLDoc(s);q("isXml="+f);if(!f&&(window.opera&&(null===s.body||!s.body.innerHTML))&&--B){q("requeing onLoad callback, DOM not available");setTimeout(k,250);return}var g=s.body?s.body:s.documentElement;h.responseText=g?g.innerHTML:null;h.responseXML=s.XMLDocument?s.XMLDocument:s;f&&(d.dataType="xml");h.getResponseHeader=function(a){return{"content-type":d.dataType}[a]};g&&(h.status=Number(g.getAttribute("status"))||h.status,h.statusText=g.getAttribute("statusText")||
h.statusText);var j=(d.dataType||"").toLowerCase(),l=/(json|script|text)/.test(j);if(l||d.textarea){var n=s.getElementsByTagName("textarea")[0];if(n)h.responseText=n.value,h.status=Number(n.getAttribute("status"))||h.status,h.statusText=n.getAttribute("statusText")||h.statusText;else if(l){var p=s.getElementsByTagName("pre")[0],D=s.getElementsByTagName("body")[0];p?h.responseText=p.textContent?p.textContent:p.innerText:D&&(h.responseText=D.textContent?D.textContent:D.innerText)}}else"xml"==j&&(!h.responseXML&&
h.responseText)&&(h.responseXML=F(h.responseText));try{var f=h,g=d,t=f.getResponseHeader("content-type")||"",G="xml"===j||!j&&0<=t.indexOf("xml"),A=G?f.responseXML:f.responseText;G&&"parsererror"===A.documentElement.nodeName&&c.error&&c.error("parsererror");g&&g.dataFilter&&(A=g.dataFilter(A,j));"string"===typeof A&&("json"===j||!j&&0<=t.indexOf("json")?A=I(A):("script"===j||!j&&0<=t.indexOf("javascript"))&&c.globalEval(A));E=A}catch(J){a="parsererror",h.error=e=J||a}}catch(H){q("error caught: ",
H),a="error",h.error=e=H||a}h.aborted&&(q("upload aborted"),a=null);h.status&&(a=200<=h.status&&300>h.status||304===h.status?"success":"error");"success"===a?(d.success&&d.success.call(d.context,E,"success",h),w.resolve(h.responseText,"success",h),m&&c.event.trigger("ajaxSuccess",[h,d])):a&&(void 0===e&&(e=h.statusText),d.error&&d.error.call(d.context,h,a,e),w.reject(h,"error",e),m&&c.event.trigger("ajaxError",[h,d,e]));m&&c.event.trigger("ajaxComplete",[h,d]);m&&!--c.active&&c.event.trigger("ajaxStop");
d.complete&&d.complete.call(d.context,h,a);C=!0;d.timeout&&clearTimeout(u);setTimeout(function(){d.iframeTarget||x.remove();h.responseXML=null},100)}}}var g=l[0],j,d,m,n,x,r,h,t,v,u;t=!!c.fn.prop;var w=c.Deferred();if(c("[name=submit],[id=submit]",g).length)return alert('Error: Form elements must not have name or id of "submit".'),w.reject(),w;if(b)for(j=0;j<p.length;j++)b=c(p[j]),t?b.prop("disabled",!1):b.removeAttr("disabled");d=c.extend(!0,{},c.ajaxSettings,a);d.context=d.context||d;n="jqFormIO"+
(new Date).getTime();d.iframeTarget?(x=c(d.iframeTarget),(b=x.attr("name"))?n=b:x.attr("name",n)):(x=c('<iframe name="'+n+'" src="'+d.iframeSrc+'" />'),x.css({position:"absolute",top:"-1000px",left:"-1000px"}));r=x[0];h={aborted:0,responseText:null,responseXML:null,status:0,statusText:"n/a",getAllResponseHeaders:function(){},getResponseHeader:function(){},setRequestHeader:function(){},abort:function(a){var b="timeout"===a?"timeout":"aborted";q("aborting upload... "+b);this.aborted=1;try{r.contentWindow.document.execCommand&&
r.contentWindow.document.execCommand("Stop")}catch(e){}x.attr("src",d.iframeSrc);h.error=b;d.error&&d.error.call(d.context,h,b,a);m&&c.event.trigger("ajaxError",[h,d,b]);d.complete&&d.complete.call(d.context,h,b)}};(m=d.global)&&0===c.active++&&c.event.trigger("ajaxStart");m&&c.event.trigger("ajaxSend",[h,d]);if(d.beforeSend&&!1===d.beforeSend.call(d.context,h,d))return d.global&&c.active--,w.reject(),w;if(h.aborted)return w.reject(),w;if(t=g.clk)if((b=t.name)&&!t.disabled)d.extraData=d.extraData||
{},d.extraData[b]=t.value,"image"==t.type&&(d.extraData[b+".x"]=g.clk_x,d.extraData[b+".y"]=g.clk_y);var z=1,y=2;t=c("meta[name=csrf-token]").attr("content");if((b=c("meta[name=csrf-param]").attr("content"))&&t)d.extraData=d.extraData||{},d.extraData[b]=t;d.forceSync?e():setTimeout(e,10);var E,s,B=50,C,F=c.parseXML||function(a,b){window.ActiveXObject?(b=new ActiveXObject("Microsoft.XMLDOM"),b.async="false",b.loadXML(a)):b=(new DOMParser).parseFromString(a,"text/xml");return b&&b.documentElement&&
"parsererror"!=b.documentElement.nodeName?b:null},I=c.parseJSON||function(a){return window.eval("("+a+")")};return w}if(!this.length)return q("ajaxSubmit: skipping submit process - no element selected"),this;var f,b,l=this;"function"==typeof a&&(a={success:a});f=this.attr("method");b=this.attr("action");(b=(b="string"===typeof b?c.trim(b):"")||window.location.href||"")&&(b=(b.match(/^([^#]+)/)||[])[1]);a=c.extend(!0,{url:b,success:c.ajaxSettings.success,type:f||"GET",iframeSrc:/^https/i.test(window.location.href||
"")?"javascript:false":"about:blank"},a);b={};this.trigger("form-pre-serialize",[this,a,b]);if(b.veto)return q("ajaxSubmit: submit vetoed via form-pre-serialize trigger"),this;if(a.beforeSerialize&&!1===a.beforeSerialize(this,a))return q("ajaxSubmit: submit aborted via beforeSerialize callback"),this;var g=a.traditional;void 0===g&&(g=c.ajaxSettings.traditional);var p=[],k,m=this.formToArray(a.semantic,p);a.data&&(a.extraData=a.data,k=c.param(a.data,g));if(a.beforeSubmit&&!1===a.beforeSubmit(m,this,
a))return q("ajaxSubmit: submit aborted via beforeSubmit callback"),this;this.trigger("form-submit-validate",[m,this,a,b]);if(b.veto)return q("ajaxSubmit: submit vetoed via form-submit-validate trigger"),this;b=c.param(m,g);k&&(b=b?b+"&"+k:k);"GET"==a.type.toUpperCase()?(a.url+=(0<=a.url.indexOf("?")?"&":"?")+b,a.data=null):a.data=b;var j=[];a.resetForm&&j.push(function(){l.resetForm()});a.clearForm&&j.push(function(){l.clearForm(a.includeHidden)});if(!a.dataType&&a.target){var E=a.success||function(){};
j.push(function(b){var e=a.replaceTarget?"replaceWith":"html";c(a.target)[e](b).each(E,arguments)})}else a.success&&j.push(a.success);a.success=function(b,c,e){for(var g=a.context||this,f=0,d=j.length;f<d;f++)j[f].apply(g,[b,c,e||l,l])};k=0<c('input[type=file]:enabled[value!=""]',this).length;b="multipart/form-data"==l.attr("enctype")||"multipart/form-data"==l.attr("encoding");g=B&&C;q("fileAPI :"+g);var y;if(!1!==a.iframe&&(a.iframe||(k||b)&&!g))a.closeKeepAlive?c.get(a.closeKeepAlive,function(){y=
e(m)}):y=e(m);else if((k||b)&&g){var v=new FormData;for(k=0;k<m.length;k++)v.append(m[k].name,m[k].value);if(a.extraData){k=c.param(a.extraData).split("&");b=k.length;var g={},z,u;for(z=0;z<b;z++)k[z]=k[z].replace(/\+/g," "),u=k[z].split("="),g[decodeURIComponent(u[0])]=decodeURIComponent(u[1]);for(var n in g)g.hasOwnProperty(n)&&v.append(n,g[n])}a.data=null;n=c.extend(!0,{},c.ajaxSettings,a,{contentType:!1,processData:!1,cache:!1,type:f||"POST"});a.uploadProgress&&(n.xhr=function(){var b=jQuery.ajaxSettings.xhr();
b.upload&&(b.upload.onprogress=function(b){var c=0,e=b.loaded||b.position,f=b.total;b.lengthComputable&&(c=Math.ceil(100*(e/f)));a.uploadProgress(b,e,f,c)});return b});n.data=null;var F=n.beforeSend;n.beforeSend=function(a,b){b.data=v;F&&F.call(this,a,b)};y=c.ajax(n)}else y=c.ajax(a);l.removeData("jqxhr").data("jqxhr",y);for(n=0;n<p.length;n++)p[n]=null;this.trigger("form-submit-notify",[this,a]);return this};c.fn.ajaxForm=function(a){a=a||{};a.delegation=a.delegation&&c.isFunction(c.fn.on);if(!a.delegation&&
0===this.length){var e=this.selector,f=this.context;if(!c.isReady&&e)return q("DOM not ready, queuing ajaxForm"),c(function(){c(e,f).ajaxForm(a)}),this;q("terminating; zero elements found by selector"+(c.isReady?"":" (DOM not ready)"));return this}return a.delegation?(c(document).off("submit.form-plugin",this.selector,v).off("click.form-plugin",this.selector,u).on("submit.form-plugin",this.selector,a,v).on("click.form-plugin",this.selector,a,u),this):this.ajaxFormUnbind().bind("submit.form-plugin",
a,v).bind("click.form-plugin",a,u)};c.fn.ajaxFormUnbind=function(){return this.unbind("submit.form-plugin click.form-plugin")};c.fn.formToArray=function(a,e){var f=[];if(0===this.length)return f;var b=this[0],l=a?b.getElementsByTagName("*"):b.elements;if(!l)return f;var g,p,k,m,j,q;g=0;for(q=l.length;g<q;g++)if(j=l[g],k=j.name)if(a&&b.clk&&"image"==j.type)!j.disabled&&b.clk==j&&(f.push({name:k,value:c(j).val(),type:j.type}),f.push({name:k+".x",value:b.clk_x},{name:k+".y",value:b.clk_y}));else if((m=
c.fieldValue(j,!0))&&m.constructor==Array){e&&e.push(j);p=0;for(j=m.length;p<j;p++)f.push({name:k,value:m[p]})}else if(B&&"file"==j.type&&!j.disabled)if(e&&e.push(j),m=j.files,m.length)for(p=0;p<m.length;p++)f.push({name:k,value:m[p],type:j.type});else f.push({name:k,value:"",type:j.type});else null!==m&&"undefined"!=typeof m&&(e&&e.push(j),f.push({name:k,value:m,type:j.type,required:j.required}));if(!a&&b.clk&&(l=c(b.clk),g=l[0],(k=g.name)&&!g.disabled&&"image"==g.type))f.push({name:k,value:l.val()}),
f.push({name:k+".x",value:b.clk_x},{name:k+".y",value:b.clk_y});return f};c.fn.formSerialize=function(a){return c.param(this.formToArray(a))};c.fn.fieldSerialize=function(a){var e=[];this.each(function(){var f=this.name;if(f){var b=c.fieldValue(this,a);if(b&&b.constructor==Array)for(var l=0,g=b.length;l<g;l++)e.push({name:f,value:b[l]});else null!==b&&"undefined"!=typeof b&&e.push({name:this.name,value:b})}});return c.param(e)};c.fn.fieldValue=function(a){for(var e=[],f=0,b=this.length;f<b;f++){var l=
c.fieldValue(this[f],a);null===l||("undefined"==typeof l||l.constructor==Array&&!l.length)||(l.constructor==Array?c.merge(e,l):e.push(l))}return e};c.fieldValue=function(a,e){var f=a.name,b=a.type,l=a.tagName.toLowerCase();void 0===e&&(e=!0);if(e&&(!f||a.disabled||"reset"==b||"button"==b||("checkbox"==b||"radio"==b)&&!a.checked||("submit"==b||"image"==b)&&a.form&&a.form.clk!=a||"select"==l&&-1==a.selectedIndex))return null;if("select"==l){var g=a.selectedIndex;if(0>g)return null;for(var f=[],l=a.options,
p=(b="select-one"==b)?g+1:l.length,g=b?g:0;g<p;g++){var k=l[g];if(k.selected){var m=k.value;m||(m=k.attributes&&k.attributes.value&&!k.attributes.value.specified?k.text:k.value);if(b)return m;f.push(m)}}return f}return c(a).val()};c.fn.clearForm=function(a){return this.each(function(){c("input,select,textarea",this).clearFields(a)})};c.fn.clearFields=c.fn.clearInputs=function(a){var e=/^(?:color|date|datetime|email|month|number|password|range|search|tel|text|time|url|week)$/i;return this.each(function(){var f=
this.type,b=this.tagName.toLowerCase();if(e.test(f)||"textarea"==b)this.value="";else if("checkbox"==f||"radio"==f)this.checked=!1;else if("select"==b)this.selectedIndex=-1;else if("file"==f)c.browser.msie?c(this).replaceWith(c(this).clone()):c(this).val("");else if(a&&(!0===a&&/hidden/.test(f)||"string"==typeof a&&c(this).is(a)))this.value=""})};c.fn.resetForm=function(){return this.each(function(){("function"==typeof this.reset||"object"==typeof this.reset&&!this.reset.nodeType)&&this.reset()})};
c.fn.enable=function(a){void 0===a&&(a=!0);return this.each(function(){this.disabled=!a})};c.fn.selected=function(a){void 0===a&&(a=!0);return this.each(function(){var e=this.type;"checkbox"==e||"radio"==e?this.checked=a:"option"==this.tagName.toLowerCase()&&(e=c(this).parent("select"),a&&(e[0]&&"select-one"==e[0].type)&&e.find("option").selected(!1),this.selected=a)})};c.fn.ajaxSubmit.debug=!1})(jQuery);

/*!
 * jQuery Taconite plugin - A port of the Taconite framework by Ryan Asleson and
 *     Nathaniel T. Schutta: http://taconite.sourceforge.net/
 *
 * Examples and documentation at: http://malsup.com/jquery/taconite/
 * Copyright (c) 2007-2011 M. Alsup
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 * Thanks to Kenton Simpson for contributing many good ideas!
 *
 * @version: 3.64  16-JUN-2011
 * @requires jQuery v1.3.2 or later
 */

(function($) {
var version = '3.64';

$.taconite = function(xml) {
    processDoc(xml);
};

$.taconite.debug = 0;  // set to true to enable debug logging to window.console.log
$.taconite.autodetect = true;
$.taconite.defaults = {
    cdataWrap: 'div'
};

// add 'replace' and 'replaceContent' plugins (conditionally)
$.fn.replace = $.fn.replace || function(a) {
    this.after(a);
    this.remove();
};
$.fn.replaceContent = $.fn.replaceContent || function(a) {
    return this.empty().append(a);
};

$.expr[':'].taconiteTag = function(a) {
    return a.taconiteTag === 1;
};

// allow auto-detection to be enabled/disabled on-demand
$.taconite.enableAutoDetection = function(b) {
    $.taconite.autodetect = b;
    if (origHttpData)
        $.httpData = b ? origHttpData : detect;
};

var logCount = 0;
function log() {
    if (!$.taconite.debug || !window.console || !window.console.log) return;
    !logCount++ && log('Plugin Version: ' + version);
    window.console.log('[taconite] ' + [].join.call(arguments,''));
}

var parseJSON = $.parseJSON || function(s) {
    return window['eval']('(' + s + ')');
};

function httpData( xhr, type, s ) {
    var ct = xhr.getResponseHeader('content-type') || '',
        xml = type === 'xml' || !type && ct.indexOf('xml') >= 0,
        data = xml ? xhr.responseXML : xhr.responseText;

    if (xml && data.documentElement.nodeName === 'parsererror') {
        $.error && $.error('parsererror');
    }
    if (s && s.dataFilter) {
        data = s.dataFilter(data, type);
    }
    if (typeof data === 'string') {
        if (type === 'json' || !type && ct.indexOf('json') >= 0) {
            data = parseJSON(data);
        } else if (type === "script" || !type && ct.indexOf("javascript") >= 0) {
            $.globalEval(data);
        }
    }
    return data;
}

function getResponse(xhr, type, s) {
    if (origHttpData)
        return origHttpData(xhr, type, s);
    return xhr.responseXML || xhr.responseText;
}

function detect(xhr, type, s) {
    var ct = xhr.getResponseHeader('content-type');
    if ($.taconite.debug) {
        log('[AJAX response] content-type: ', ct, ';  status: ', xhr.status, ' ', xhr.statusText, ';  has responseXML: ', xhr.responseXML != null);
        log('type arg: ' + type);
//        log('responseXML: ' + xhr.responseXML);  // IE9 doesn't like xhr.toString()
    }
    var data = getResponse(xhr, type, s);
    if (data && data.documentElement && data.documentElement.nodeName != 'parsererror') {
        $.taconite(data);
    }
    else if (typeof data == 'string') {
        // issue #4 (don't try to parse plain text or html responses
        if ( /taconite/.test(data) )
            $.taconite(data);
    }
    else {
        log('jQuery core httpData returned: ' + data);
        log('httpData: response is not XML (or not "valid" XML)');
    }
    return data;
}

// 1.5+ hook
$.ajaxPrefilter && $.ajaxPrefilter(function( options, originalOptions, jqXHR ) {
    jqXHR.success(function( data, status, jqXHR ) {
        if ($.taconite.autodetect)
            detect(jqXHR, options.dataType, options);
    });
});

// < 1.5 hook
var origHttpData = $.httpData;
if ($.httpData)
    $.httpData = detect;  // replace jQuery's httpData method

// custom data parsers
var parsers = { 'json': jsonParser }, rawData, rawDataIndic;

$.taconite.registerParser = function(type, fn) {
    parsers[type] = fn;
};

function parseRawData(type, data) {
    var d = data, parser = parsers[type];
    if ($.isFunction(parser))
        return parser(data);
    else
        throw 'No parser registered for rawData of type "' + type + '"';
}

function jsonParser(json) {
    return parseJSON(json);
}


function processDoc(xml) {
    var status = true, ex;
    try {
        if (typeof xml == 'string')
            xml = convert(xml);
        if (! ( xml && xml.documentElement) ) {
            log('$.taconite invoked without valid document; nothing to process');
            return false;
        }

        var root = xml.documentElement.tagName;
        log('XML document root: ', root);

        var taconiteDoc = $('taconite', xml)[0];

        if (!taconiteDoc) {
            log('document does not contain <taconite> element; nothing to process');
            return false;
        }

        $.event.trigger('taconite-begin-notify', [taconiteDoc]);
        status = go(taconiteDoc);
    } catch(e) {
        status = ex = e;
    }
    rawDataIndic && $.event.trigger('taconite-rawdata-notify', [rawData]);
    $.event.trigger('taconite-complete-notify', [xml, !!status, status === true ? null : status]);
    if (ex)
        throw ex;
}

// convert string to xml document
function convert(s) {
    var doc;
    log('attempting string to document conversion');
    try {
        if (window.DOMParser) {
            var parser = new DOMParser();
            doc = parser.parseFromString(s, 'text/xml');
        }
        else {
            doc = $("<xml>")[0];
            doc.async = 'false';
            doc.loadXML(s);
        }
    }
    catch(e) {
        if (window.console && window.console.error)
            window.console.error('[taconite] ERROR parsing XML string for conversion: ' + e);
        throw e;
    }
    var ok = doc && doc.documentElement && doc.documentElement.tagName != 'parsererror';
    log('conversion ', ok ? 'successful!' : 'FAILED');
    return doc;
}

function go(xml) {
    try {
        var t = new Date().getTime();
        // process the document
        process(xml.childNodes);
        $.taconite.lastTime = (new Date().getTime()) - t;
        log('time to process response: ' + $.taconite.lastTime + 'ms');
    } catch(e) {
        if (window.console && window.console.error)
            window.console.error('[taconite] ERROR processing document: ' + e);
        throw e;
    }
    return true;
}

// process the taconite commands
function process(commands) {
    rawData = {};
    rawDataIndic = false;
    var trimHash = { wrap: 1 };
    var doPostProcess = 0;
    var a, n, v, i, j, js, els, raw, type, q, jq, cdataWrap;

    for(i=0; i < commands.length; i++) {
        if (commands[i].nodeType != 1)
            continue; // commands are elements
        var cmdNode = commands[i], cmd = cmdNode.tagName;
        if (cmd == 'eval') {
            js = (cmdNode.firstChild ? cmdNode.firstChild.nodeValue : null);
            log('invoking "eval" command: ', js);
            if (js)
                $.globalEval(js);
            continue;
        }
        if (cmd == 'rawData') {
            raw = (cmdNode.firstChild ? cmdNode.firstChild.nodeValue : null);
            type = cmdNode.getAttribute('type');
            log('rawData ('+type+'): ', raw);

            var namespace = cmdNode.getAttribute('namespace') || 'none';

            !rawData[namespace] && (rawData[namespace] = []);

            rawData[namespace].push({
                data: parseRawData(type, raw),
                type: type,
                name: cmdNode.getAttribute('name') || null,
                raw: raw
            });
            !rawDataIndic && (rawDataIndic = true);
            continue;
        }
        q = cmdNode.getAttribute('select');
        jq = $(q);
        if (!jq[0]) {
            log('No matching targets for selector: ', q);
            continue;
        }
        cdataWrap = cmdNode.getAttribute('cdataWrap') || $.taconite.defaults.cdataWrap;

        a = [];
        if (cmdNode.childNodes.length > 0) {
            doPostProcess = 1;
            for (j=0,els=[]; j < cmdNode.childNodes.length; j++)
                els[j] = createNode(cmdNode.childNodes[j], cdataWrap);
            a.push(trimHash[cmd] ? cleanse(els) : els);
        }

        // remain backward compat with pre 2.0.9 versions
        n = cmdNode.getAttribute('name');
        v = cmdNode.getAttribute('value');
        if (n !== null) a.push(n);
        if (v !== null) a.push(v);

        // @since: 2.0.9: support arg1, arg2, arg3...
        for (var j=1; true; j++) {
            v = cmdNode.getAttribute('arg'+j);
            if (v === null)
                break;
            // support numeric primitives
            if (v.length) {
                var n = Number(v);
                if (v == n)
                    v = n;
            }
            a.push(v);
        }

        $.taconite.debug && logCommand(q, cmd, a, els);
        jq[cmd].apply(jq,a);
    }

    // apply dynamic fixes
    doPostProcess && postProcess();
}

function logCommand(q, cmd, a, els) {
    var args = '...';
    if (!els) {
        args = '';
        for (var k=0, val=a[0]; k < a.length, val=a[k]; k++) {
            k > 0 && (args += ',');
            typeof val == 'string' ? (args += ("'" + val + "'")) : (args += val);
        }
    }
    log("invoking command: $('", q, "').", cmd, '('+ args +')');
}

function postProcess() {
    if ($.browser.mozilla) return;
    // post processing fixes go here; currently there is only one:
    // fix1: opera, IE6, Safari/Win don't maintain selected options in all cases (thanks to Karel FuÄÃ­k for this!)
    $('select:taconiteTag').each(function() {
        var sel = this;
        $('option:taconiteTag', this).each(function() {
            this.setAttribute('selected','selected');
            this.taconiteTag = null;
            if (sel.type == 'select-one') {
                var idx = $('option',sel).index(this);
                sel.selectedIndex = idx;
            }
        });
        this.taconiteTag = null;
    });
}

function cleanse(els) {
    for (var i=0, a=[]; i < els.length; i++)
        if (els[i].nodeType == 1) a.push(els[i]);
    return a;
}

function createNode(node, cdataWrap) {
    var type = node.nodeType;
    if (type == 1) return createElement(node, cdataWrap);
    if (type == 3) return fixTextNode(node.nodeValue);
    if (type == 4) return handleCDATA(node.nodeValue, cdataWrap);
    return null;
}

function handleCDATA(s, cdataWrap) {
    var el = document.createElement(cdataWrap);
    var $el = $(el)[cdataWrap == 'script' ? 'text' : 'html'](s);
    var $ch = $el.children();

    // remove wrapper node if possible
    if ($ch.size() == 1)
        return $ch[0];
    return el;
}

function fixTextNode(s) {
    if ($.browser.msie) s = s.replace(/\n/g, '\r').replace(/\s+/g, ' ');
    return document.createTextNode(s);
}

function createElement(node, cdataWrap) {
    var e, tag = node.tagName.toLowerCase();
    // some elements in IE need to be created with attrs inline
    if ($.browser.msie && $.browser.version < 9) {
        var type = node.getAttribute('type');
        if (tag == 'table' || type == 'radio' || type == 'checkbox' || tag == 'button' ||
            (tag == 'select' && node.getAttribute('multiple'))) {
            e = document.createElement('<' + tag + ' ' + copyAttrs(null, node, true) + '>');
        }
    }
    if (!e) {
        e = document.createElement(tag);
        // copyAttrs(e, node, tag == 'option' && $.browser.safari);
        copyAttrs(e, node);
    }

    // IE fix; colspan must be explicitly set
    if ($.browser.msie && tag == 'td') {
        var colspan = node.getAttribute('colspan');
        if (colspan) e.colSpan = parseInt(colspan);
    }

    // IE fix; script tag not allowed to have children
    if($.browser.msie && !e.canHaveChildren) {
        if(node.childNodes.length > 0)
            e.text = node.text;
    }
    else {
        for(var i=0, max=node.childNodes.length; i < max; i++) {
            var child = createNode (node.childNodes[i], cdataWrap);
            if(child) e.appendChild(child);
        }
    }
    if (! $.browser.mozilla) {
        if (tag == 'select' || (tag == 'option' && node.getAttribute('selected')))
            e.taconiteTag = 1;
    }
    return e;
}

function copyAttrs(dest, src, inline) {
    for (var i=0, attr=''; i < src.attributes.length; i++) {
        var a = src.attributes[i], n = $.trim(a.name), v = $.trim(a.value);
        if (inline) attr += (n + '="' + v + '" ');
        else if (n == 'style') { // IE workaround
            dest.style.cssText = v;
            dest.setAttribute(n, v);
        }
        else $.attr(dest, n, v);
    }
    return attr;
}

})(jQuery);

/* reverseOrder : jQuery order reverser plugin
 * Written by Corey H Maass for Arc90
 * (c) Arc90, Inc.
 * 
 * Licensed under:Creative Commons Attribution-Share Alike 3.0 http://creativecommons.org/licenses/by-sa/3.0/us/
 */

(function($){$.fn.reverseOrder=function(){return this.each(function(){$(this).prependTo($(this).parent())})}})(jQuery);

    
/*!
 * Handlebars.js (MIT license).
 * version: 1.0.beta.6
 * Copyright (C) 2011 by Yehuda Katz
 * https://github.com/wycats/handlebars.js/
 */
var Handlebars={VERSION:"1.0.beta.6",helpers:{},partials:{},registerHelper:function(c,b,a){a&&(b.not=a);this.helpers[c]=b},registerPartial:function(c,b){this.partials[c]=b}};Handlebars.registerHelper("helperMissing",function(c){if(2!==arguments.length)throw Error("Could not find property '"+c+"'");});var toString=Object.prototype.toString,functionType="[object Function]";
Handlebars.registerHelper("blockHelperMissing",function(c,b){var a=b.inverse||function(){},f=b.fn,g="",e=toString.call(c);e===functionType&&(c=c.call(this));if(!0===c)return f(this);if(!1===c||null==c)return a(this);if("[object Array]"===e){if(0<c.length){a=0;for(e=c.length;a<e;a++)g+=f(c[a])}else g=a(this);return g}return f(c)});Handlebars.registerHelper("each",function(c,b){var a=b.fn,f=b.inverse,g="";if(c&&0<c.length)for(var f=0,e=c.length;f<e;f++)g+=a(c[f]);else g=f(this);return g});
Handlebars.registerHelper("if",function(c,b){toString.call(c)===functionType&&(c=c.call(this));return!c||Handlebars.Utils.isEmpty(c)?b.inverse(this):b.fn(this)});Handlebars.registerHelper("unless",function(c,b){var a=b.fn;b.fn=b.inverse;b.inverse=a;return Handlebars.helpers["if"].call(this,c,b)});Handlebars.registerHelper("with",function(c,b){return b.fn(c)});Handlebars.registerHelper("log",function(c){Handlebars.log(c)});
var handlebars=function(){var c={trace:function(){},yy:{},symbols_:{error:2,root:3,program:4,EOF:5,statements:6,simpleInverse:7,statement:8,openInverse:9,closeBlock:10,openBlock:11,mustache:12,partial:13,CONTENT:14,COMMENT:15,OPEN_BLOCK:16,inMustache:17,CLOSE:18,OPEN_INVERSE:19,OPEN_ENDBLOCK:20,path:21,OPEN:22,OPEN_UNESCAPED:23,OPEN_PARTIAL:24,params:25,hash:26,param:27,STRING:28,INTEGER:29,BOOLEAN:30,hashSegments:31,hashSegment:32,ID:33,EQUALS:34,pathSegments:35,SEP:36,$accept:0,$end:1},terminals_:{2:"error",
5:"EOF",14:"CONTENT",15:"COMMENT",16:"OPEN_BLOCK",18:"CLOSE",19:"OPEN_INVERSE",20:"OPEN_ENDBLOCK",22:"OPEN",23:"OPEN_UNESCAPED",24:"OPEN_PARTIAL",28:"STRING",29:"INTEGER",30:"BOOLEAN",33:"ID",34:"EQUALS",36:"SEP"},productions_:[0,[3,2],[4,3],[4,1],[4,0],[6,1],[6,2],[8,3],[8,3],[8,1],[8,1],[8,1],[8,1],[11,3],[9,3],[10,3],[12,3],[12,3],[13,3],[13,4],[7,2],[17,3],[17,2],[17,2],[17,1],[25,2],[25,1],[27,1],[27,1],[27,1],[27,1],[26,1],[31,2],[31,1],[32,3],[32,3],[32,3],[32,3],[21,1],[35,3],[35,1]],performAction:function(a,
b,c,e,i,d){a=d.length-1;switch(i){case 1:return d[a-1];case 2:this.$=new e.ProgramNode(d[a-2],d[a]);break;case 3:this.$=new e.ProgramNode(d[a]);break;case 4:this.$=new e.ProgramNode([]);break;case 5:this.$=[d[a]];break;case 6:d[a-1].push(d[a]);this.$=d[a-1];break;case 7:this.$=new e.InverseNode(d[a-2],d[a-1],d[a]);break;case 8:this.$=new e.BlockNode(d[a-2],d[a-1],d[a]);break;case 9:this.$=d[a];break;case 10:this.$=d[a];break;case 11:this.$=new e.ContentNode(d[a]);break;case 12:this.$=new e.CommentNode(d[a]);
break;case 13:this.$=new e.MustacheNode(d[a-1][0],d[a-1][1]);break;case 14:this.$=new e.MustacheNode(d[a-1][0],d[a-1][1]);break;case 15:this.$=d[a-1];break;case 16:this.$=new e.MustacheNode(d[a-1][0],d[a-1][1]);break;case 17:this.$=new e.MustacheNode(d[a-1][0],d[a-1][1],!0);break;case 18:this.$=new e.PartialNode(d[a-1]);break;case 19:this.$=new e.PartialNode(d[a-2],d[a-1]);break;case 21:this.$=[[d[a-2]].concat(d[a-1]),d[a]];break;case 22:this.$=[[d[a-1]].concat(d[a]),null];break;case 23:this.$=[[d[a-
1]],d[a]];break;case 24:this.$=[[d[a]],null];break;case 25:d[a-1].push(d[a]);this.$=d[a-1];break;case 26:this.$=[d[a]];break;case 27:this.$=d[a];break;case 28:this.$=new e.StringNode(d[a]);break;case 29:this.$=new e.IntegerNode(d[a]);break;case 30:this.$=new e.BooleanNode(d[a]);break;case 31:this.$=new e.HashNode(d[a]);break;case 32:d[a-1].push(d[a]);this.$=d[a-1];break;case 33:this.$=[d[a]];break;case 34:this.$=[d[a-2],d[a]];break;case 35:this.$=[d[a-2],new e.StringNode(d[a])];break;case 36:this.$=
[d[a-2],new e.IntegerNode(d[a])];break;case 37:this.$=[d[a-2],new e.BooleanNode(d[a])];break;case 38:this.$=new e.IdNode(d[a]);break;case 39:d[a-2].push(d[a]);this.$=d[a-2];break;case 40:this.$=[d[a]]}},table:[{3:1,4:2,5:[2,4],6:3,8:4,9:5,11:6,12:7,13:8,14:[1,9],15:[1,10],16:[1,12],19:[1,11],22:[1,13],23:[1,14],24:[1,15]},{1:[3]},{5:[1,16]},{5:[2,3],7:17,8:18,9:5,11:6,12:7,13:8,14:[1,9],15:[1,10],16:[1,12],19:[1,19],20:[2,3],22:[1,13],23:[1,14],24:[1,15]},{5:[2,5],14:[2,5],15:[2,5],16:[2,5],19:[2,
5],20:[2,5],22:[2,5],23:[2,5],24:[2,5]},{4:20,6:3,8:4,9:5,11:6,12:7,13:8,14:[1,9],15:[1,10],16:[1,12],19:[1,11],20:[2,4],22:[1,13],23:[1,14],24:[1,15]},{4:21,6:3,8:4,9:5,11:6,12:7,13:8,14:[1,9],15:[1,10],16:[1,12],19:[1,11],20:[2,4],22:[1,13],23:[1,14],24:[1,15]},{5:[2,9],14:[2,9],15:[2,9],16:[2,9],19:[2,9],20:[2,9],22:[2,9],23:[2,9],24:[2,9]},{5:[2,10],14:[2,10],15:[2,10],16:[2,10],19:[2,10],20:[2,10],22:[2,10],23:[2,10],24:[2,10]},{5:[2,11],14:[2,11],15:[2,11],16:[2,11],19:[2,11],20:[2,11],22:[2,
11],23:[2,11],24:[2,11]},{5:[2,12],14:[2,12],15:[2,12],16:[2,12],19:[2,12],20:[2,12],22:[2,12],23:[2,12],24:[2,12]},{17:22,21:23,33:[1,25],35:24},{17:26,21:23,33:[1,25],35:24},{17:27,21:23,33:[1,25],35:24},{17:28,21:23,33:[1,25],35:24},{21:29,33:[1,25],35:24},{1:[2,1]},{6:30,8:4,9:5,11:6,12:7,13:8,14:[1,9],15:[1,10],16:[1,12],19:[1,11],22:[1,13],23:[1,14],24:[1,15]},{5:[2,6],14:[2,6],15:[2,6],16:[2,6],19:[2,6],20:[2,6],22:[2,6],23:[2,6],24:[2,6]},{17:22,18:[1,31],21:23,33:[1,25],35:24},{10:32,20:[1,
33]},{10:34,20:[1,33]},{18:[1,35]},{18:[2,24],21:40,25:36,26:37,27:38,28:[1,41],29:[1,42],30:[1,43],31:39,32:44,33:[1,45],35:24},{18:[2,38],28:[2,38],29:[2,38],30:[2,38],33:[2,38],36:[1,46]},{18:[2,40],28:[2,40],29:[2,40],30:[2,40],33:[2,40],36:[2,40]},{18:[1,47]},{18:[1,48]},{18:[1,49]},{18:[1,50],21:51,33:[1,25],35:24},{5:[2,2],8:18,9:5,11:6,12:7,13:8,14:[1,9],15:[1,10],16:[1,12],19:[1,11],20:[2,2],22:[1,13],23:[1,14],24:[1,15]},{14:[2,20],15:[2,20],16:[2,20],19:[2,20],22:[2,20],23:[2,20],24:[2,
20]},{5:[2,7],14:[2,7],15:[2,7],16:[2,7],19:[2,7],20:[2,7],22:[2,7],23:[2,7],24:[2,7]},{21:52,33:[1,25],35:24},{5:[2,8],14:[2,8],15:[2,8],16:[2,8],19:[2,8],20:[2,8],22:[2,8],23:[2,8],24:[2,8]},{14:[2,14],15:[2,14],16:[2,14],19:[2,14],20:[2,14],22:[2,14],23:[2,14],24:[2,14]},{18:[2,22],21:40,26:53,27:54,28:[1,41],29:[1,42],30:[1,43],31:39,32:44,33:[1,45],35:24},{18:[2,23]},{18:[2,26],28:[2,26],29:[2,26],30:[2,26],33:[2,26]},{18:[2,31],32:55,33:[1,56]},{18:[2,27],28:[2,27],29:[2,27],30:[2,27],33:[2,
27]},{18:[2,28],28:[2,28],29:[2,28],30:[2,28],33:[2,28]},{18:[2,29],28:[2,29],29:[2,29],30:[2,29],33:[2,29]},{18:[2,30],28:[2,30],29:[2,30],30:[2,30],33:[2,30]},{18:[2,33],33:[2,33]},{18:[2,40],28:[2,40],29:[2,40],30:[2,40],33:[2,40],34:[1,57],36:[2,40]},{33:[1,58]},{14:[2,13],15:[2,13],16:[2,13],19:[2,13],20:[2,13],22:[2,13],23:[2,13],24:[2,13]},{5:[2,16],14:[2,16],15:[2,16],16:[2,16],19:[2,16],20:[2,16],22:[2,16],23:[2,16],24:[2,16]},{5:[2,17],14:[2,17],15:[2,17],16:[2,17],19:[2,17],20:[2,17],22:[2,
17],23:[2,17],24:[2,17]},{5:[2,18],14:[2,18],15:[2,18],16:[2,18],19:[2,18],20:[2,18],22:[2,18],23:[2,18],24:[2,18]},{18:[1,59]},{18:[1,60]},{18:[2,21]},{18:[2,25],28:[2,25],29:[2,25],30:[2,25],33:[2,25]},{18:[2,32],33:[2,32]},{34:[1,57]},{21:61,28:[1,62],29:[1,63],30:[1,64],33:[1,25],35:24},{18:[2,39],28:[2,39],29:[2,39],30:[2,39],33:[2,39],36:[2,39]},{5:[2,19],14:[2,19],15:[2,19],16:[2,19],19:[2,19],20:[2,19],22:[2,19],23:[2,19],24:[2,19]},{5:[2,15],14:[2,15],15:[2,15],16:[2,15],19:[2,15],20:[2,
15],22:[2,15],23:[2,15],24:[2,15]},{18:[2,34],33:[2,34]},{18:[2,35],33:[2,35]},{18:[2,36],33:[2,36]},{18:[2,37],33:[2,37]}],defaultActions:{16:[2,1],37:[2,23],53:[2,21]},parseError:function(a){throw Error(a);},parse:function(a){var b=[0],c=[null],e=[],i=this.table,d="",o=0,r=0,q=0;this.lexer.setInput(a);this.lexer.yy=this.yy;this.yy.lexer=this.lexer;"undefined"==typeof this.lexer.yylloc&&(this.lexer.yylloc={});a=this.lexer.yylloc;e.push(a);"function"===typeof this.yy.parseError&&(this.parseError=
this.yy.parseError);for(var h,n,k,j,m={},p,l;;){k=b[b.length-1];this.defaultActions[k]?j=this.defaultActions[k]:(null==h&&(h=void 0,h=this.lexer.lex()||1,"number"!==typeof h&&(h=this.symbols_[h]||h)),j=i[k]&&i[k][h]);if(("undefined"===typeof j||!j.length||!j[0])&&!q){l=[];for(p in i[k])this.terminals_[p]&&2<p&&l.push("'"+this.terminals_[p]+"'");var s="",s=this.lexer.showPosition?"Parse error on line "+(o+1)+":\n"+this.lexer.showPosition()+"\nExpecting "+l.join(", ")+", got '"+this.terminals_[h]+"'":
"Parse error on line "+(o+1)+": Unexpected "+(1==h?"end of input":"'"+(this.terminals_[h]||h)+"'");this.parseError(s,{text:this.lexer.match,token:this.terminals_[h]||h,line:this.lexer.yylineno,loc:a,expected:l})}if(j[0]instanceof Array&&1<j.length)throw Error("Parse Error: multiple actions possible at state: "+k+", token: "+h);switch(j[0]){case 1:b.push(h);c.push(this.lexer.yytext);e.push(this.lexer.yylloc);b.push(j[1]);h=null;n?(h=n,n=null):(r=this.lexer.yyleng,d=this.lexer.yytext,o=this.lexer.yylineno,
a=this.lexer.yylloc,0<q&&q--);break;case 2:l=this.productions_[j[1]][1];m.$=c[c.length-l];m._$={first_line:e[e.length-(l||1)].first_line,last_line:e[e.length-1].last_line,first_column:e[e.length-(l||1)].first_column,last_column:e[e.length-1].last_column};k=this.performAction.call(m,d,r,o,this.yy,j[1],c,e);if("undefined"!==typeof k)return k;l&&(b=b.slice(0,-2*l),c=c.slice(0,-1*l),e=e.slice(0,-1*l));b.push(this.productions_[j[1]][0]);c.push(m.$);e.push(m._$);j=i[b[b.length-2]][b[b.length-1]];b.push(j);
break;case 3:return!0}}return!0}},b=function(){return{EOF:1,parseError:function(a,b){if(this.yy.parseError)this.yy.parseError(a,b);else throw Error(a);},setInput:function(a){this._input=a;this._more=this._less=this.done=!1;this.yylineno=this.yyleng=0;this.yytext=this.matched=this.match="";this.conditionStack=["INITIAL"];this.yylloc={first_line:1,first_column:0,last_line:1,last_column:0};return this},input:function(){var a=this._input[0];this.yytext+=a;this.yyleng++;this.match+=a;this.matched+=a;a.match(/\n/)&&
this.yylineno++;this._input=this._input.slice(1);return a},unput:function(a){this._input=a+this._input;return this},more:function(){this._more=!0;return this},pastInput:function(){var a=this.matched.substr(0,this.matched.length-this.match.length);return(20<a.length?"...":"")+a.substr(-20).replace(/\n/g,"")},upcomingInput:function(){var a=this.match;20>a.length&&(a+=this._input.substr(0,20-a.length));return(a.substr(0,20)+(20<a.length?"...":"")).replace(/\n/g,"")},showPosition:function(){var a=this.pastInput(),
b=Array(a.length+1).join("-");return a+this.upcomingInput()+"\n"+b+"^"},next:function(){if(this.done)return this.EOF;this._input||(this.done=!0);var a,b;this._more||(this.match=this.yytext="");for(var c=this._currentRules(),e=0;e<c.length;e++)if(a=this._input.match(this.rules[c[e]])){if(b=a[0].match(/\n.*/g))this.yylineno+=b.length;this.yylloc={first_line:this.yylloc.last_line,last_line:this.yylineno+1,first_column:this.yylloc.last_column,last_column:b?b[b.length-1].length-1:this.yylloc.last_column+
a[0].length};this.yytext+=a[0];this.match+=a[0];this.matches=a;this.yyleng=this.yytext.length;this._more=!1;this._input=this._input.slice(a[0].length);this.matched+=a[0];if(a=this.performAction.call(this,this.yy,this,c[e],this.conditionStack[this.conditionStack.length-1]))return a;return}if(""===this._input)return this.EOF;this.parseError("Lexical error on line "+(this.yylineno+1)+". Unrecognized text.\n"+this.showPosition(),{text:"",token:null,line:this.yylineno})},lex:function(){var a=this.next();
return"undefined"!==typeof a?a:this.lex()},begin:function(a){this.conditionStack.push(a)},popState:function(){return this.conditionStack.pop()},_currentRules:function(){return this.conditions[this.conditionStack[this.conditionStack.length-1]].rules},topState:function(){return this.conditionStack[this.conditionStack.length-2]},pushState:function(a){this.begin(a)},performAction:function(a,b,c){switch(c){case 0:"\\"!==b.yytext.slice(-1)&&this.begin("mu");"\\"===b.yytext.slice(-1)&&(b.yytext=b.yytext.substr(0,
b.yyleng-1),this.begin("emu"));if(b.yytext)return 14;break;case 1:return 14;case 2:return this.popState(),14;case 3:return 24;case 4:return 16;case 5:return 20;case 6:return 19;case 7:return 19;case 8:return 23;case 9:return 23;case 10:return b.yytext=b.yytext.substr(3,b.yyleng-5),this.popState(),15;case 11:return 22;case 12:return 34;case 13:return 33;case 14:return 33;case 15:return 36;case 17:return this.popState(),18;case 18:return this.popState(),18;case 19:return b.yytext=b.yytext.substr(1,
b.yyleng-2).replace(/\\"/g,'"'),28;case 20:return 30;case 21:return 30;case 22:return 29;case 23:return 33;case 24:return b.yytext=b.yytext.substr(1,b.yyleng-2),33;case 25:return"INVALID";case 26:return 5}},rules:[/^[^\x00]*?(?=(\{\{))/,/^[^\x00]+/,/^[^\x00]{2,}?(?=(\{\{))/,/^\{\{>/,/^\{\{#/,/^\{\{\//,/^\{\{\^/,/^\{\{\s*else\b/,/^\{\{\{/,/^\{\{&/,/^\{\{![\s\S]*?\}\}/,/^\{\{/,/^=/,/^\.(?=[} ])/,/^\.\./,/^[\/.]/,/^\s+/,/^\}\}\}/,/^\}\}/,/^"(\\["]|[^"])*"/,/^true(?=[}\s])/,/^false(?=[}\s])/,/^[0-9]+(?=[}\s])/,
/^[a-zA-Z0-9_$-]+(?=[=}\s\/.])/,/^\[[^\]]*\]/,/^./,/^$/],conditions:{mu:{rules:[3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26],inclusive:!1},emu:{rules:[2],inclusive:!1},INITIAL:{rules:[0,1,26],inclusive:!0}}}}();c.lexer=b;return c}();
"undefined"!==typeof require&&"undefined"!==typeof exports&&(exports.parser=handlebars,exports.parse=function(){return handlebars.parse.apply(handlebars,arguments)},exports.main=function(c){if(!c[1])throw Error("Usage: "+c[0]+" FILE");c="undefined"!==typeof process?require("fs").readFileSync(require("path").join(process.cwd(),c[1]),"utf8"):require("file").path(require("file").cwd()).join(c[1]).read({charset:"utf-8"});return exports.parser.parse(c)},"undefined"!==typeof module&&require.main===module&&
exports.main("undefined"!==typeof process?process.argv.slice(1):require("system").args));Handlebars.Parser=handlebars;Handlebars.parse=function(c){Handlebars.Parser.yy=Handlebars.AST;return Handlebars.Parser.parse(c)};Handlebars.print=function(c){return(new Handlebars.PrintVisitor).accept(c)};Handlebars.logger={DEBUG:0,INFO:1,WARN:2,ERROR:3,level:3,log:function(){}};Handlebars.log=function(c,b){Handlebars.logger.log(c,b)};
(function(){Handlebars.AST={};Handlebars.AST.ProgramNode=function(b,a){this.type="program";this.statements=b;if(a)this.inverse=new Handlebars.AST.ProgramNode(a)};Handlebars.AST.MustacheNode=function(b,a,c){this.type="mustache";this.id=b[0];this.params=b.slice(1);this.hash=a;this.escaped=!c};Handlebars.AST.PartialNode=function(b,a){this.type="partial";this.id=b;this.context=a};var c=function(b,a){if(b.original!==a.original)throw new Handlebars.Exception(b.original+" doesn't match "+a.original);};Handlebars.AST.BlockNode=
function(b,a,f){c(b.id,f);this.type="block";this.mustache=b;this.program=a};Handlebars.AST.InverseNode=function(b,a,f){c(b.id,f);this.type="inverse";this.mustache=b;this.program=a};Handlebars.AST.ContentNode=function(b){this.type="content";this.string=b};Handlebars.AST.HashNode=function(b){this.type="hash";this.pairs=b};Handlebars.AST.IdNode=function(b){this.type="ID";this.original=b.join(".");for(var a=[],c=0,g=0,e=b.length;g<e;g++){var i=b[g];i===".."?c++:i==="."||i==="this"?this.isScoped=true:
a.push(i)}this.parts=a;this.string=a.join(".");this.depth=c;this.isSimple=a.length===1&&c===0};Handlebars.AST.StringNode=function(b){this.type="STRING";this.string=b};Handlebars.AST.IntegerNode=function(b){this.type="INTEGER";this.integer=b};Handlebars.AST.BooleanNode=function(b){this.type="BOOLEAN";this.bool=b};Handlebars.AST.CommentNode=function(b){this.type="comment";this.comment=b}})();
Handlebars.Exception=function(c){var b=Error.prototype.constructor.apply(this,arguments),a;for(a in b)b.hasOwnProperty(a)&&(this[a]=b[a]);this.message=b.message};Handlebars.Exception.prototype=Error();Handlebars.SafeString=function(c){this.string=c};Handlebars.SafeString.prototype.toString=function(){return this.string.toString()};
(function(){var c={"<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#x27;","`":"&#x60;"},b=/&(?!\w+;)|[<>"'`]/g,a=/[&<>"'`]/,f=function(a){return c[a]||"&amp;"};Handlebars.Utils={escapeExpression:function(c){return c instanceof Handlebars.SafeString?c.toString():c==null||c===false?"":!a.test(c)?c:c.replace(b,f)},isEmpty:function(a){return typeof a==="undefined"?true:a===null?true:a===false?true:Object.prototype.toString.call(a)==="[object Array]"&&a.length===0?true:false}}})();Handlebars.Compiler=function(){};
Handlebars.JavaScriptCompiler=function(){};
(function(c,b){c.OPCODE_MAP={appendContent:1,getContext:2,lookupWithHelpers:3,lookup:4,append:5,invokeMustache:6,appendEscaped:7,pushString:8,truthyOrFallback:9,functionOrFallback:10,invokeProgram:11,invokePartial:12,push:13,assignToHash:15,pushStringParam:16};c.MULTI_PARAM_OPCODES={appendContent:1,getContext:1,lookupWithHelpers:2,lookup:1,invokeMustache:3,pushString:1,truthyOrFallback:1,functionOrFallback:1,invokeProgram:3,invokePartial:1,push:1,assignToHash:1,pushStringParam:1};c.DISASSEMBLE_MAP=
{};for(var a in c.OPCODE_MAP)c.DISASSEMBLE_MAP[c.OPCODE_MAP[a]]=a;c.multiParamSize=function(i){return c.MULTI_PARAM_OPCODES[c.DISASSEMBLE_MAP[i]]};c.prototype={compiler:c,disassemble:function(){for(var i=this.opcodes,a,b=[],e,f=0,h=i.length;f<h;f++){a=i[f];if(a==="DECLARE"){e=i[++f];a=i[++f];b.push("DECLARE "+e+" = "+a)}else{e=c.DISASSEMBLE_MAP[a];for(var g=c.multiParamSize(a),k=[],j=0;j<g;j++){a=i[++f];typeof a==="string"&&(a='"'+a.replace("\n","\\n")+'"');k.push(a)}e=e+" "+k.join(" ");b.push(e)}}return b.join("\n")},
guid:0,compile:function(a,d){this.children=[];this.depths={list:[]};this.options=d;var b=this.options.knownHelpers;this.options.knownHelpers={helperMissing:true,blockHelperMissing:true,each:true,"if":true,unless:true,"with":true,log:true};if(b)for(var c in b)this.options.knownHelpers[c]=b[c];return this.program(a)},accept:function(a){return this[a.type](a)},program:function(a){var a=a.statements,d;this.opcodes=[];for(var b=0,c=a.length;b<c;b++){d=a[b];this[d.type](d)}this.isSimple=c===1;this.depths.list=
this.depths.list.sort(function(a,i){return a-i});return this},compileProgram:function(a){var a=(new this.compiler).compile(a,this.options),d=this.guid++;this.usePartial=this.usePartial||a.usePartial;this.children[d]=a;for(var b=0,c=a.depths.list.length;b<c;b++){depth=a.depths.list[b];depth<2||this.addDepth(depth-1)}return d},block:function(a){var d=a.mustache,b=this.setupStackForMustache(d),c=this.compileProgram(a.program);if(a.program.inverse){a=this.compileProgram(a.program.inverse);this.declare("inverse",
a)}this.opcode("invokeProgram",c,b.length,!!d.hash);this.declare("inverse",null);this.opcode("append")},inverse:function(a){var d=this.setupStackForMustache(a.mustache);this.declare("inverse",this.compileProgram(a.program));this.opcode("invokeProgram",null,d.length,!!a.mustache.hash);this.declare("inverse",null);this.opcode("append")},hash:function(a){var a=a.pairs,d,b;this.opcode("push","{}");for(var c=0,e=a.length;c<e;c++){d=a[c];b=d[1];this.accept(b);this.opcode("assignToHash",d[0])}},partial:function(a){var d=
a.id;this.usePartial=true;a.context?this.ID(a.context):this.opcode("push","depth0");this.opcode("invokePartial",d.original);this.opcode("append")},content:function(a){this.opcode("appendContent",a.string)},mustache:function(a){this.opcode("invokeMustache",this.setupStackForMustache(a).length,a.id.original,!!a.hash);a.escaped&&!this.options.noEscape?this.opcode("appendEscaped"):this.opcode("append")},ID:function(a){this.addDepth(a.depth);this.opcode("getContext",a.depth);this.opcode("lookupWithHelpers",
a.parts[0]||null,a.isScoped||false);for(var d=1,b=a.parts.length;d<b;d++)this.opcode("lookup",a.parts[d])},STRING:function(a){this.opcode("pushString",a.string)},INTEGER:function(a){this.opcode("push",a.integer)},BOOLEAN:function(a){this.opcode("push",a.bool)},comment:function(){},pushParams:function(a){for(var d=a.length,b;d--;){b=a[d];if(this.options.stringParams){b.depth&&this.addDepth(b.depth);this.opcode("getContext",b.depth||0);this.opcode("pushStringParam",b.string)}else this[b.type](b)}},
opcode:function(a,d,b,e){this.opcodes.push(c.OPCODE_MAP[a]);d!==void 0&&this.opcodes.push(d);b!==void 0&&this.opcodes.push(b);e!==void 0&&this.opcodes.push(e)},declare:function(a,d){this.opcodes.push("DECLARE");this.opcodes.push(a);this.opcodes.push(d)},addDepth:function(a){if(a!==0&&!this.depths[a]){this.depths[a]=true;this.depths.list.push(a)}},setupStackForMustache:function(a){var d=a.params;this.pushParams(d);a.hash&&this.hash(a.hash);this.ID(a.id);return d}};b.prototype={nameLookup:function(a,
d){return/^[0-9]+$/.test(d)?a+"["+d+"]":b.isValidJavaScriptVariableName(d)?a+"."+d:a+"['"+d+"']"},appendToBuffer:function(a){return this.environment.isSimple?"return "+a+";":"buffer += "+a+";"},initializeBuffer:function(){return this.quotedString("")},namespace:"Handlebars",compile:function(a,d,b,c){this.environment=a;this.options=d||{};this.name=this.environment.name;this.isChild=!!b;this.context=b||{programs:[],aliases:{self:"this"},registers:{list:[]}};this.preamble();this.stackSlot=0;this.stackVars=
[];this.compileChildren(a,d);a=a.opcodes;this.i=0;for(e=a.length;this.i<e;this.i++){a=this.nextOpcode(0);if(a[0]==="DECLARE"){this.i=this.i+2;this[a[1]]=a[2]}else{this.i=this.i+a[1].length;this[a[0]].apply(this,a[1])}}return this.createFunctionContext(c)},nextOpcode:function(a){var d=this.environment.opcodes,b=d[this.i+a],e,f;if(b==="DECLARE"){e=d[this.i+1];a=d[this.i+2];return["DECLARE",e,a]}e=c.DISASSEMBLE_MAP[b];b=c.multiParamSize(b);f=[];for(var h=0;h<b;h++)f.push(d[this.i+h+1+a]);return[e,f]},
eat:function(a){this.i=this.i+a.length},preamble:function(){var a=[];this.useRegister("foundHelper");if(this.isChild)a.push("");else{var b=this.namespace,c="helpers = helpers || "+b+".helpers;";this.environment.usePartial&&(c=c+" partials = partials || "+b+".partials;");a.push(c)}this.environment.isSimple?a.push(""):a.push(", buffer = "+this.initializeBuffer());this.lastContext=0;this.source=a},createFunctionContext:function(a){var b=this.stackVars;this.isChild||(b=b.concat(this.context.registers.list));
b.length>0&&(this.source[1]=this.source[1]+", "+b.join(", "));if(!this.isChild)for(var c in this.context.aliases)this.source[1]=this.source[1]+", "+c+"="+this.context.aliases[c];this.source[1]&&(this.source[1]="var "+this.source[1].substring(2)+";");this.isChild||(this.source[1]=this.source[1]+("\n"+this.context.programs.join("\n")+"\n"));this.environment.isSimple||this.source.push("return buffer;");b=this.isChild?["depth0","data"]:["Handlebars","depth0","helpers","partials","data"];c=0;for(var e=
this.environment.depths.list.length;c<e;c++)b.push("depth"+this.environment.depths.list[c]);if(a){b.push(this.source.join("\n  "));return Function.apply(this,b)}a="function "+(this.name||"")+"("+b.join(",")+") {\n  "+this.source.join("\n  ")+"}";Handlebars.log(Handlebars.logger.DEBUG,a+"\n\n");return a},appendContent:function(a){this.source.push(this.appendToBuffer(this.quotedString(a)))},append:function(){var a=this.popStack();this.source.push("if("+a+" || "+a+" === 0) { "+this.appendToBuffer(a)+
" }");this.environment.isSimple&&this.source.push("else { "+this.appendToBuffer("''")+" }")},appendEscaped:function(){var a=this.nextOpcode(1),b="";this.context.aliases.escapeExpression="this.escapeExpression";if(a[0]==="appendContent"){b=" + "+this.quotedString(a[1][0]);this.eat(a)}this.source.push(this.appendToBuffer("escapeExpression("+this.popStack()+")"+b))},getContext:function(a){if(this.lastContext!==a)this.lastContext=a},lookupWithHelpers:function(a,b){if(a){var c=this.nextStack();this.usingKnownHelper=
false;if(!b&&this.options.knownHelpers[a]){c=c+" = "+this.nameLookup("helpers",a,"helper");this.usingKnownHelper=true}else if(b||this.options.knownHelpersOnly)c=c+" = "+this.nameLookup("depth"+this.lastContext,a,"context");else{this.register("foundHelper",this.nameLookup("helpers",a,"helper"));c=c+" = foundHelper || "+this.nameLookup("depth"+this.lastContext,a,"context")}this.source.push(c+";")}else this.pushStack("depth"+this.lastContext)},lookup:function(a){var b=this.topStack();this.source.push(b+
" = ("+b+" === null || "+b+" === undefined || "+b+" === false ? "+b+" : "+this.nameLookup(b,a,"context")+");")},pushStringParam:function(a){this.pushStack("depth"+this.lastContext);this.pushString(a)},pushString:function(a){this.pushStack(this.quotedString(a))},push:function(a){this.pushStack(a)},invokeMustache:function(a,b,c){this.populateParams(a,this.quotedString(b),"{}",null,c,function(a,b,c){if(!this.usingKnownHelper){this.context.aliases.helperMissing="helpers.helperMissing";this.context.aliases.undef=
"void 0";this.source.push("else if("+c+"=== undef) { "+a+" = helperMissing.call("+b+"); }");a!==c&&this.source.push("else { "+a+" = "+c+"; }")}})},invokeProgram:function(a,b,c){var e=this.programExpression(this.inverse),a=this.programExpression(a);this.populateParams(b,null,a,e,c,function(a,b){if(!this.usingKnownHelper){this.context.aliases.blockHelperMissing="helpers.blockHelperMissing";this.source.push("else { "+a+" = blockHelperMissing.call("+b+"); }")}})},populateParams:function(a,b,c,e,f,h){var g=
f||this.options.stringParams||e||this.options.data,k=this.popStack(),j=[],m;if(g){this.register("tmp1",c);m="tmp1"}else m="{ hash: {} }";g&&this.source.push("tmp1.hash = "+(f?this.popStack():"{}")+";");this.options.stringParams&&this.source.push("tmp1.contexts = [];");for(g=0;g<a;g++){f=this.popStack();j.push(f);this.options.stringParams&&this.source.push("tmp1.contexts.push("+this.popStack()+");")}if(e){this.source.push("tmp1.fn = tmp1;");this.source.push("tmp1.inverse = "+e+";")}this.options.data&&
this.source.push("tmp1.data = data;");j.push(m);this.populateCall(j,k,b||k,h,c!=="{}")},populateCall:function(a,b,c,e,f){var g=["depth0"].concat(a).join(", "),a=["depth0"].concat(c).concat(a).join(", "),c=this.nextStack();if(this.usingKnownHelper)this.source.push(c+" = "+b+".call("+g+");");else{this.context.aliases.functionType='"function"';this.source.push("if("+(f?"foundHelper && ":"")+"typeof "+b+" === functionType) { "+c+" = "+b+".call("+g+"); }")}e.call(this,c,a,b);this.usingKnownHelper=false},
invokePartial:function(a){params=[this.nameLookup("partials",a,"partial"),"'"+a+"'",this.popStack(),"helpers","partials"];this.options.data&&params.push("data");this.pushStack("self.invokePartial("+params.join(", ")+");")},assignToHash:function(a){var b=this.popStack();this.source.push(this.topStack()+"['"+a+"'] = "+b+";")},compiler:b,compileChildren:function(a,b){for(var c=a.children,e,f,g=0,n=c.length;g<n;g++){e=c[g];f=new this.compiler;this.context.programs.push("");var k=this.context.programs.length;
e.index=k;e.name="program"+k;this.context.programs[k]=f.compile(e,b,this.context)}},programExpression:function(a){if(a==null)return"self.noop";for(var b=this.environment.children[a],a=b.depths.list,b=[b.index,b.name,"data"],c=0,e=a.length;c<e;c++){depth=a[c];depth===1?b.push("depth0"):b.push("depth"+(depth-1))}if(a.length===0)return"self.program("+b.join(", ")+")";b.shift();return"self.programWithDepth("+b.join(", ")+")"},register:function(a,b){this.useRegister(a);this.source.push(a+" = "+b+";")},
useRegister:function(a){if(!this.context.registers[a]){this.context.registers[a]=true;this.context.registers.list.push(a)}},pushStack:function(a){this.source.push(this.nextStack()+" = "+a+";");return"stack"+this.stackSlot},nextStack:function(){this.stackSlot++;this.stackSlot>this.stackVars.length&&this.stackVars.push("stack"+this.stackSlot);return"stack"+this.stackSlot},popStack:function(){return"stack"+this.stackSlot--},topStack:function(){return"stack"+this.stackSlot},quotedString:function(a){return'"'+
a.replace(/\\/g,"\\\\").replace(/"/g,'\\"').replace(/\n/g,"\\n").replace(/\r/g,"\\r")+'"'}};a=["break","else","new","var","case","finally","return","void","catch","for","switch","while","continue","function","this","with","default","if","throw","delete","in","try","do","instanceof","typeof","abstract","enum","int","short","boolean","export","interface","static","byte","extends","long","super","char","final","native","synchronized","class","float","package","throws","const","goto","private","transient",
"debugger","implements","protected","volatile","double","import","public","let","yield"];for(var f=b.RESERVED_WORDS={},g=0,e=a.length;g<e;g++)f[a[g]]=true;b.isValidJavaScriptVariableName=function(a){return!b.RESERVED_WORDS[a]&&/^[a-zA-Z_$][0-9a-zA-Z_$]+$/.test(a)?true:false}})(Handlebars.Compiler,Handlebars.JavaScriptCompiler);Handlebars.precompile=function(c,b){var b=b||{},a=Handlebars.parse(c),a=(new Handlebars.Compiler).compile(a,b);return(new Handlebars.JavaScriptCompiler).compile(a,b)};
Handlebars.compile=function(c,b){var b=b||{},a;return function(f,g){if(!a){var e=Handlebars.parse(c),e=(new Handlebars.Compiler).compile(e,b),e=(new Handlebars.JavaScriptCompiler).compile(e,b,void 0,true);a=Handlebars.template(e)}return a.call(this,f,g)}};
Handlebars.VM={template:function(c){var b={escapeExpression:Handlebars.Utils.escapeExpression,invokePartial:Handlebars.VM.invokePartial,programs:[],program:function(a,b,c){var e=this.programs[a];if(c)return Handlebars.VM.program(b,c);e||(e=this.programs[a]=Handlebars.VM.program(b));return e},programWithDepth:Handlebars.VM.programWithDepth,noop:Handlebars.VM.noop};return function(a,f){f=f||{};return c.call(b,Handlebars,a,f.helpers,f.partials,f.data)}},programWithDepth:function(c,b,a){var f=Array.prototype.slice.call(arguments,
2);return function(a,e){e=e||{};return c.apply(this,[a,e.data||b].concat(f))}},program:function(c,b){return function(a,f){f=f||{};return c(a,f.data||b)}},noop:function(){return""},invokePartial:function(c,b,a,f,g,e){options={helpers:f,partials:g,data:e};if(c===void 0)throw new Handlebars.Exception("The partial "+b+" could not be found");if(c instanceof Function)return c(a,options);if(Handlebars.compile){g[b]=Handlebars.compile(c);return g[b](a,options)}throw new Handlebars.Exception("The partial "+
b+" could not be compiled when running in runtime-only mode");}};Handlebars.template=Handlebars.VM.template;

window.Handlebars = Handlebars;

(function (jQuery) {
		
		var daysInWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
		var shortMonthsInYear = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
		var longMonthsInYear = ["January", "February", "March", "April", "May", "June", 
														"July", "August", "September", "October", "November", "December"];
		var shortMonthsToNumber = [];
		shortMonthsToNumber["Jan"] = "01";
		shortMonthsToNumber["Feb"] = "02";
		shortMonthsToNumber["Mar"] = "03";
		shortMonthsToNumber["Apr"] = "04";
		shortMonthsToNumber["May"] = "05";
		shortMonthsToNumber["Jun"] = "06";
		shortMonthsToNumber["Jul"] = "07";
		shortMonthsToNumber["Aug"] = "08";
		shortMonthsToNumber["Sep"] = "09";
		shortMonthsToNumber["Oct"] = "10";
		shortMonthsToNumber["Nov"] = "11";
		shortMonthsToNumber["Dec"] = "12";
	
    jQuery.format = (function () {
        function strDay(value) {
 						return daysInWeek[parseInt(value, 10)] || value;
        }

        function strMonth(value) {
						var monthArrayIndex = parseInt(value, 10) - 1;
 						return shortMonthsInYear[monthArrayIndex] || value;
        }

        function strLongMonth(value) {
					var monthArrayIndex = parseInt(value, 10) - 1;
					return longMonthsInYear[monthArrayIndex] || value;					
        }

        var parseMonth = function (value) {
					return shortMonthsToNumber[value] || value;
        };

        var parseTime = function (value) {
                var retValue = value;
                var millis = "";
                if (retValue.indexOf(".") !== -1) {
                    var delimited = retValue.split('.');
                    retValue = delimited[0];
                    millis = delimited[1];
                }

                var values3 = retValue.split(":");

                if (values3.length === 3) {
                    hour = values3[0];
                    minute = values3[1];
                    second = values3[2];

                    return {
                        time: retValue,
                        hour: hour,
                        minute: minute,
                        second: second,
                        millis: millis
                    };
                } else {
                    return {
                        time: "",
                        hour: "",
                        minute: "",
                        second: "",
                        millis: ""
                    };
                }
            };

        return {
            date: function (value, format) {
                /* 
					value = new java.util.Date()
                 	2009-12-18 10:54:50.546 
				*/
                try {
                    var date = null;
                    var year = null;
                    var month = null;
                    var dayOfMonth = null;
                    var dayOfWeek = null;
                    var time = null;
										if (typeof value == "number"){
											return this.date(new Date(value), format);
										} else if (typeof value.getFullYear == "function") {
                        year = value.getFullYear();
                        month = value.getMonth() + 1;
                        dayOfMonth = value.getDate();
                        dayOfWeek = value.getDay();
                        time = parseTime(value.toTimeString());
										} else if (value.search(/\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}\.?\d{0,3}[-+]?\d{2}:?\d{2}/) != -1) { /* 2009-04-19T16:11:05+02:00 */											
                        var values = value.split(/[T\+-]/);
                        year = values[0];
                        month = values[1];
                        dayOfMonth = values[2];
                        time = parseTime(values[3].split(".")[0]);
                        date = new Date(year, month - 1, dayOfMonth);
                        dayOfWeek = date.getDay();
                    } else {
                        var values = value.split(" ");
                        switch (values.length) {
                        case 6:
                            /* Wed Jan 13 10:43:41 CET 2010 */
                            year = values[5];
                            month = parseMonth(values[1]);
                            dayOfMonth = values[2];
                            time = parseTime(values[3]);
                            date = new Date(year, month - 1, dayOfMonth);
                            dayOfWeek = date.getDay();
                            break;
                        case 2:
                            /* 2009-12-18 10:54:50.546 */
                            var values2 = values[0].split("-");
                            year = values2[0];
                            month = values2[1];
                            dayOfMonth = values2[2];
                            time = parseTime(values[1]);
                            date = new Date(year, month - 1, dayOfMonth);
                            dayOfWeek = date.getDay();
                            break;
                        case 7:
                            /* Tue Mar 01 2011 12:01:42 GMT-0800 (PST) */
                        case 9:
                            /*added by Larry, for Fri Apr 08 2011 00:00:00 GMT+0800 (China Standard Time) */
                        case 10:
                            /* added by Larry, for Fri Apr 08 2011 00:00:00 GMT+0200 (W. Europe Daylight Time) */
                            year = values[3];
                            month = parseMonth(values[1]);
                            dayOfMonth = values[2];
                            time = parseTime(values[4]);
                            date = new Date(year, month - 1, dayOfMonth);
                            dayOfWeek = date.getDay();
                            break;
                        case 1:
                            /* added by Jonny, for 2012-02-07CET00:00:00 (Doctrine Entity -> Json Serializer) */
                            var values2 = values[0].split("");
                            year=values2[0]+values2[1]+values2[2]+values2[3];
                            month= values2[5]+values2[6];
                            dayOfMonth = values2[8]+values2[9];
                            time = parseTime(values2[13]+values2[14]+values2[15]+values2[16]+values2[17]+values2[18]+values2[19]+values2[20])
                            date = new Date(year, month - 1, dayOfMonth);
                            dayOfWeek = date.getDay();
                            break;
                        default:
                            return value;
                        }
                    }

                    var pattern = "";
                    var retValue = "";
                    var unparsedRest = "";
                    /*
						Issue 1 - variable scope issue in format.date 
                    	Thanks jakemonO
					*/
                    for (var i = 0; i < format.length; i++) {
                        var currentPattern = format.charAt(i);
                        pattern += currentPattern;
                        unparsedRest = "";
                        switch (pattern) {
                        case "ddd":
                            retValue += strDay(dayOfWeek);
                            pattern = "";
                            break;
                        case "dd":
                            if (format.charAt(i + 1) == "d") {
                                break;
                            }
                            if (String(dayOfMonth).length === 1) {
                                dayOfMonth = '0' + dayOfMonth;
                            }
                            retValue += dayOfMonth;
                            pattern = "";
                            break;
                        case "d":
                            if (format.charAt(i + 1) == "d") {
                                break;
                            }
                            retValue += parseInt(dayOfMonth, 10);
                            pattern = "";
                            break;
                        case "MMMM":
                            retValue += strLongMonth(month);
                            pattern = "";
                            break;
                        case "MMM":
                            if (format.charAt(i + 1) === "M") {
                                break;
                            }
                            retValue += strMonth(month);
                            pattern = "";
                            break;
                        case "MM":
                            if (format.charAt(i + 1) == "M") {
                                break;
                            }
                            if (String(month).length === 1) {
                                month = '0' + month;
                            }
                            retValue += month;
                            pattern = "";
                            break;
                        case "M":
                            if (format.charAt(i + 1) == "M") {
                                break;
                            }
                            retValue += parseInt(month, 10);
                            pattern = "";
                            break;
                        case "yyyy":
                            retValue += year;
                            pattern = "";
                            break;
                        case "yy":
                            if (format.charAt(i + 1) == "y" &&
                           	format.charAt(i + 2) == "y") {
                            	break;
                      	    }
                            retValue += String(year).slice(-2);
                            pattern = "";
                            break;
                        case "HH":
                            retValue += time.hour;
                            pattern = "";
                            break;
                        case "hh":
                            /* time.hour is "00" as string == is used instead of === */
                            var hour = (time.hour == 0 ? 12 : time.hour < 13 ? time.hour : time.hour - 12);
                            hour = String(hour).length == 1 ? '0' + hour : hour;
                            retValue += hour;
                            pattern = "";
                            break;
												case "h":
												    if (format.charAt(i + 1) == "h") {
												        break;
												    }
												    var hour = (time.hour == 0 ? 12 : time.hour < 13 ? time.hour : time.hour - 12);                           
												    retValue += parseInt(hour, 10);
														// Fixing issue https://github.com/phstc/jquery-dateFormat/issues/21
														// retValue = parseInt(retValue, 10);
												    pattern = "";
												    break;
                        case "mm":
                            retValue += time.minute;
                            pattern = "";
                            break;
                        case "ss":
                            /* ensure only seconds are added to the return string */
                            retValue += time.second.substring(0, 2);
                            pattern = "";
                            break;
                        case "SSS":
                            retValue += time.millis.substring(0, 3);
                            pattern = "";
                            break;
                        case "a":
                            retValue += time.hour >= 12 ? "PM" : "AM";
                            pattern = "";
                            break;
                        case " ":
                            retValue += currentPattern;
                            pattern = "";
                            break;
                        case "/":
                            retValue += currentPattern;
                            pattern = "";
                            break;
                        case ":":
                            retValue += currentPattern;
                            pattern = "";
                            break;
                        default:
                            if (pattern.length === 2 && pattern.indexOf("y") !== 0 && pattern != "SS") {
                                retValue += pattern.substring(0, 1);
                                pattern = pattern.substring(1, 2);
                            } else if ((pattern.length === 3 && pattern.indexOf("yyy") === -1)) {
                                pattern = "";
                            } else {
                            	unparsedRest = pattern;
                            }
                        }
                    }
                    retValue += unparsedRest;
                    return retValue;
                } catch (e) {
                    console.log(e);
                    return value;
                }
            }
        };
    }());
}(jQuery));

jQuery.format.date.defaultShortDateFormat = "dd/MM/yyyy";
jQuery.format.date.defaultLongDateFormat = "dd/MM/yyyy hh:mm:ss";

jQuery(document).ready(function () {
    jQuery(".shortDateFormat").each(function (idx, elem) {
        if (jQuery(elem).is(":input")) {
            jQuery(elem).val(jQuery.format.date(jQuery(elem).val(), jQuery.format.date.defaultShortDateFormat));
        } else {
            jQuery(elem).text(jQuery.format.date(jQuery(elem).text(), jQuery.format.date.defaultShortDateFormat));
        }
    });
    jQuery(".longDateFormat").each(function (idx, elem) {
        if (jQuery(elem).is(":input")) {
            jQuery(elem).val(jQuery.format.date(jQuery(elem).val(), jQuery.format.date.defaultLongDateFormat));
        } else {
            jQuery(elem).text(jQuery.format.date(jQuery(elem).text(), jQuery.format.date.defaultLongDateFormat));
        }
    });
});

  
})(backsnap);

