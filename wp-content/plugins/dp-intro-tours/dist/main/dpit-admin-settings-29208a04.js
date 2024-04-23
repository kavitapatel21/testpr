/*!
 * 
 * Intro Tour Tutorial
 * 
 * @author [object Object]
 * @version 5.4.1
 * @link http://www.gnu.org/licenses/gpl-2.0.txt
 * @license GPL-2.0+
 * 
 * Copyright (c) 2023 [object Object]
 * 
 * This plugin is released under GPL-2.0+ license to be included in wordpres.org plugin repository
 * 
 * Compiled with the help of https://wpack.io
 * A zero setup Webpack Bundler Script for WordPress
 */
(window.wpackiodpIntroToursmainJsonp=window.wpackiodpIntroToursmainJsonp||[]).push([[10],{165:function(t,e,n){n(15),t.exports=n(174)},174:function(t,e,n){"use strict";n.r(e);var i=n(2),a=n(3),o=n(0),r=n(25),c=n(12),l=n.n(c),s=(n(32),n(33),n(34),n(5)),u=n.n(s),d=n(8),v=Object(i.a)((function t(e){var n=this;Object(a.a)(this,t),Object(o.a)(this,"init",(function(){$(".dpit-settings__el__hint").each((function(t,e){var i=$(e),a=i.closest("td"),c=a.find(".dpit-settings__el").hasClass("dpit-pro-only"),s=i.closest("tr").find("th").text(),v=i.html()||"";if(v.length){var h,f=u()((h={},Object(o.a)(h,"dp-info-icon",!0),Object(o.a)(h,"dp-info-icon--inline",!0),Object(o.a)(h,"dp-info-icon--bigger",!0),Object(o.a)(h,"dp-info-icon--pro-only",c),h));a.addClass("dpit-settings--with-info-icon").append(d.a.getInfoIconHtml(f,v,s)),i.fadeOut(300,(function(){$(".dp-info-icon").each((function(t,e){Object(r.b)(e,{content:function(t){return t.getAttribute("data-info-text")},animation:"scale",theme:"material",allowHTML:!0,interactive:!0})})),$(".dp-info-icon").load(l()(n.config.assetsUrl,"../../includes/assets/icons/info-circle-solid.svg"),(function(){$(".dp-info-icon").fadeIn(700)}))}))}}))})),e.dpDebugEn&&console.log("AdminSetupTippy"),this.config=e,this.init()})),h=Object(i.a)((function t(e){Object(a.a)(this,t),e.dpDebugEn&&console.log("ColorPicker"),$(".dp-color-picker-field").wpColorPicker()})),f=n(26),p=n.n(f),g=n(28),_=n.n(g),m=n(20),b=function(){function t(e){var n=this;Object(a.a)(this,t),Object(o.a)(this,"processAction",(function(t,e){var i=$("#"+t),a={actionName:e};n.bulletsAnimation[t].createAndRun(),i.addClass("in-process"),p.a.post(l()(n.config.siteUrl,"/wp-json/dpintrotours/v1/trigger-action"),a,{headers:{"X-WP-Nonce":n.config.nonces.wp_rest}}).then((function(){i.removeClass("in-process");var e=i.data("msg-success");e&&i.children(".dpit-admin-btn__text").text(e),i.addClass("dpit-admin-btn--success"),n.bulletsAnimation[t].destroy(),setTimeout((function(){i.children(".dpit-admin-btn__text").text(i.data("orig-title")),i.removeClass("dpit-admin-btn--success")}),3e3)})).catch((function(e){console.log(new _.a(e)),i.removeClass("in-process"),n.bulletsAnimation[t].destroy();var a=i.data("msg-failed");i.addClass("dpit-admin-btn--error"),a&&i.children(".dpit-admin-btn__text").text(a),setTimeout((function(){i.children(".dpit-admin-btn__text").text(i.data("orig-title")),i.removeClass("dpit-admin-btn--error")}),3e3)}))})),e.dpDebugEn&&console.log("DPSettingsActions"),this.config=e,this.bulletsAnimation=[],this.registerActions(["clear_visit_count"])}return Object(i.a)(t,[{key:"registerActions",value:function(t){var e=this;t.forEach((function(t){var n="dpit_action_".concat(t);e.bulletsAnimation[n]=new m.a("#"+n,n+"_animation",["dpit-admin-btn__bullets"],8,100),$("#"+n).on("click",(function(){return e.processAction(n,t)}))}))}}]),t}();jQuery(document).ready((function(t){window.$=t,window.dp_main_admin_settings_config.dpDebugEn&&console.log("Admin Settings config:",window.dp_main_admin_settings_config),new v(window.dp_main_admin_settings_config),new h(window.dp_main_admin_settings_config),new b(window.dp_main_admin_settings_config)}))},20:function(t,e,n){"use strict";n.d(e,"a",(function(){return o}));var i=n(3),a=n(2),o=function(){function t(e,n,a){var o=arguments.length>3&&void 0!==arguments[3]?arguments[3]:10,r=arguments.length>4&&void 0!==arguments[4]?arguments[4]:100;Object(i.a)(this,t),this.containerSelector=e,this.bulletsClasses=a,this.id=n,this.count=o,this.clockPeriodMs=r}return Object(a.a)(t,[{key:"createAndRun",value:function(){var t=arguments.length>0&&void 0!==arguments[0]&&arguments[0],e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null;this.backward=t;var n=$(e||this.containerSelector);if(n&&n.length){var i=n.find("#".concat(this.id));if(i&&i.length)i.removeClass("inactive");else{var a=this.createBullets(this.count);n[0].appendChild(a)}t?this.startReloadingSpinnerBack():this.startReloadingSpinner()}}},{key:"createBullets",value:function(t){var e=document.createElement("div");$(e).addClass(this.bulletsClasses.join(" ")),$(e).attr("aria-hidden","true"),e.id=this.id,e.style.opacity=0,e.style.display="block";for(var n=document.createElement("ul"),i=0;i<t;i++){var a=document.createElement("li");n.appendChild(a)}return e.appendChild(n),e.style.opacity=1,e}},{key:"activateBullet",value:function(t){$("#".concat(this.id," li")).removeClass("active"),$("#".concat(this.id," li")).removeClass("semi-active"),$("#".concat(this.id," li")).removeClass("semi-active--2"),this.backward?(t>=0&&t<this.count&&$("#".concat(this.id," li:nth-child(").concat(t+1,")")).addClass("semi-active semi-active--2"),t-1>=0&&t-1<this.count&&$("#".concat(this.id," li:nth-child(").concat(t,")")).addClass("semi-active"),t-2>=0&&t-2<this.count&&$("#".concat(this.id," li:nth-child(").concat(t-1,")")).addClass("active")):(t>=0&&t<this.count&&$("#".concat(this.id," li:nth-child(").concat(t+1,")")).addClass("active"),t-1>=0&&t-1<this.count&&$("#".concat(this.id," li:nth-child(").concat(t,")")).addClass("semi-active"),t-2>=0&&t-2<this.count&&$("#".concat(this.id," li:nth-child(").concat(t-1,")")).addClass("semi-active semi-active--2"))}},{key:"destroy",value:function(){$("#".concat(this.id)).addClass("inactive"),$("#".concat(this.id," li")).removeClass("active"),$("#".concat(this.id," li")).removeClass("semi-active"),this.stopReloadSpinner()}},{key:"stopReloadSpinner",value:function(){this.spinnerInterval&&clearInterval(this.spinnerInterval),this.spinnerInterval=null}},{key:"startReloadingSpinner",value:function(){var t=this,e=0;this.spinnerInterval&&clearInterval(this.spinnerInterval),this.bulletHideTimeout&&clearTimeout(this.bulletHideTimeout),this.spinnerInterval=setInterval((function(){t.activateBullet(e),++e>Math.round(2.2*t.count)&&(e=0)}),this.clockPeriodMs)}},{key:"startReloadingSpinnerBack",value:function(){var t=this;this.spinnerInterval&&clearInterval(this.spinnerInterval),this.bulletHideTimeout&&clearTimeout(this.bulletHideTimeout);var e=this.count+2;this.spinnerInterval=setInterval((function(){t.activateBullet(e),--e<0&&(e=Math.round(2.2*t.count))}),this.clockPeriodMs)}}]),t}()},8:function(t,e,n){"use strict";n.d(e,"a",(function(){return v}));var i=n(3),a=n(2),o=n(0),r=n(18),c=n.n(r),l=n(12),s=n.n(l);function u(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(t);e&&(i=i.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,i)}return n}function d(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?u(Object(n),!0).forEach((function(e){Object(o.a)(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):u(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}var v=function(){function t(e){Object(i.a)(this,t),e.dpDebugEn&&console.log("DPIncUtils")}return Object(a.a)(t,null,[{key:"isVariableUrl",value:function(t){var e=t.indexOf("{"),n=t.indexOf("}");return e>=0&&n>e}},{key:"fillUrlVariables",value:function(t,e){return t&&e&&Object.keys(t).forEach((function(n){e=c()(e,"{".concat(n,"}"),t[n])})),e}},{key:"simpleObjectToStr",value:function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"|",n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"=",i="";return t&&Object.keys(t).forEach((function(a,o){0!=o&&(i+=e),i+="".concat(a).concat(n).concat(t[a])})),i}},{key:"strToSimpleObject",value:function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"|",n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"=",i={};if(t){var a=t.split(e);a&&a.forEach((function(t){var e=t.split(n);e&&e.length>=2&&(i[e[0]]=e[1])}))}return i}},{key:"getInfoIconHtml",value:function(t,e){var n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"";return n&&(e='<strong class="info-tip-title">'.concat(n,"</strong>").concat(e)),$('<div class="'.concat(t,'"></div>')).attr("data-info-text",e)}},{key:"strLastPart",value:function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:".",n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"",i=t.split(e);return i&&i.length>0?i[i.length-1]:n}},{key:"strFirstPart",value:function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:".",n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"",i=t.split(e);return i&&i.length>0?i[0]:n}},{key:"rightTrimByString",value:function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:".",n=t.indexOf(e);return n>=0?t.substring(0,n):t}},{key:"filterQMarkWithNoSlash",value:function(t){var e=t.indexOf("?");return e>=0&&(0!==e&&"/"==t[e-1]||(t="".concat(t.substring(0,e),"/").concat(t.substring(e)))),t}},{key:"forceQMarkWithoutSlash",value:function(t){var e=t.indexOf("?");return e>0&&"/"==t[e-1]&&(t=t.substring(0,e-1)+t.substring(e)),t}},{key:"sanitizePossibleRelativeUrl",value:function(e,n){var i=arguments.length>2&&void 0!==arguments[2]&&arguments[2];return e.startsWith("/")&&(e=s()(n,e),i&&(e=t.filterQMarkWithNoSlash(e))),e}},{key:"absToRelativeUrl",value:function(t,e){return e&&t.startsWith(e)&&((t=t.substring(e.length)).startsWith("/")||(t="/".concat(t))),t}},{key:"removeURLParameter",value:function(t,e){var n=t.split("?");if(n.length>=2){for(var i="".concat(encodeURIComponent(e),"="),a=n[1].split(/[&;]/g),o=a.length;o-- >0;)-1!==a[o].lastIndexOf(i,0)&&a.splice(o,1);return n[0]+(a.length>0?"?".concat(a.join("&")):"")}return t}},{key:"removeURLParameters",value:function(e,n){var i=n;return Array.isArray(n)||(i=Object.keys(n)),i.forEach((function(i){e=t.removeURLParameter(e,t.getDpUrlParamName(i,n))})),e}},{key:"unifyUrl",value:function(e){var n=!(arguments.length>1&&void 0!==arguments[1])||arguments[1],i=arguments.length>2&&void 0!==arguments[2]&&arguments[2],a=!(arguments.length>3&&void 0!==arguments[3])||arguments[3],o=!(arguments.length>4&&void 0!==arguments[4])||arguments[4],r=arguments.length>5&&void 0!==arguments[5]&&arguments[5];if(e){if((e=t.strLastPart(e,"://",e))&&e.startsWith("www.")&&(e=e.substring(4)),e&&a&&(e=t.strFirstPart(e,"#",e)),e&&n?e=t.strFirstPart(e,"?",e):i&&(e=t.filterQMarkWithNoSlash(e)),e){var l=/\/+$/;o||(l=/^\/+/g),e=e.replace(l,"")}e&&r&&(e="/".concat(e))}return e?e.endsWith("/index.php")?e=t.rightTrimByString(e,"/index.php"):n||(e=c()(e,"/index.php/?","/"),i||(e=c()(e,"/index.php?","/"))):e="/",e}},{key:"getDpUrlParamName",value:function(t,e){var n=t;return e&&(n=e[t]),n}},{key:"getDpUrlParam",value:function(e,n){var i=arguments.length>2&&void 0!==arguments[2]?arguments[2]:null,a=arguments.length>3&&void 0!==arguments[3]?arguments[3]:null,o=a,r=t.getDpUrlParamName(e,n);return r&&(i||(i=new URL(window.location)),o=i.searchParams.get(r)),o}},{key:"setDpUrlParam",value:function(e,n,i){var a=!(arguments.length>3&&void 0!==arguments[3])||arguments[3],o="",r=t.getDpUrlParamName(e,n);return r&&(o=r+"="+i,a&&(o+="&")),o}},{key:"buildDpQueryString",value:function(e,n){var i=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"?",a=arguments.length>3&&void 0!==arguments[3]?arguments[3]:null,o=i;if(a){var r=Object.keys(a);r.forEach((function(t){null!==a[t]&&void 0!==a[t]&&""!==a[t]&&(o+=t+"="+a[t]+"&")}))}if(e){var c=Object.keys(e);c.forEach((function(i){null!==e[i]&&void 0!==e[i]&&""!==e[i]&&(o+=t.setDpUrlParam(i,n,e[i]))}))}return o&&"&"==o[o.length-1]&&(o=o.substr(0,o.length-1)),o==i&&(o=""),o}},{key:"decodeStepParamAdvancedVal",value:function(t,e,n){var i=!(arguments.length>3&&void 0!==arguments[3])||arguments[3],a=arguments.length>4&&void 0!==arguments[4]&&arguments[4],o=null==n?void 0:n[e],r=null==o?void 0:o.ext,c={val:null!=t?t:null==o?void 0:o.defMain,ext:{}};if(null!=t&&t.startsWith("base64__")||r){var l=null;if(null!=t&&t.startsWith("base64__")){var s,u,v=atob(t.substr(8));l=v?JSON.parse(v):null,c.val=null!==(s=null===(u=l)||void 0===u?void 0:u.val)&&void 0!==s?s:null==o?void 0:o.defMain}r&&Object.keys(r).forEach((function(t){var e,n,i,o,s,u,v,h;a?c.ext[t]=null!==(e=null===(n=l)||void 0===n||null===(i=n.ext)||void 0===i?void 0:i[t])&&void 0!==e?e:null===(o=r[t])||void 0===o?void 0:o.def:c.ext[t]=d(d({},r[t]),{},{val:null!==(s=null===(u=l)||void 0===u||null===(v=u.ext)||void 0===v?void 0:v[t])&&void 0!==s?s:null===(h=r[t])||void 0===h?void 0:h.def})}))}else i&&(c=t);return c}},{key:"encodeStepParamAdvancedVal",value:function(t,e,n){var i;return(null==n||null===(i=n[e])||void 0===i?void 0:i.ext)?"base64__"+btoa(JSON.stringify(t)):t}},{key:"initStepParams",value:function(t){var e={};return Object.keys(t).forEach((function(n){var i="";if(t[n]&&(i=t[n].def||"",t[n].ext)){var a={};Object.keys(t[n].ext).forEach((function(e){a[e]=t[n].ext[e].def})),i={val:i,ext:a}}e[n]=i})),e}},{key:"getNthStr",value:function(t){var e=arguments.length>1&&void 0!==arguments[1]&&arguments[1];if(!1!==t&&!isNaN(t)){var n="",i="";e&&(n="<sup>",i="</sup>");var a="";switch(t){case 1:a="1".concat(n,"st").concat(i);break;case 2:a="2".concat(n,"nd").concat(i);break;case 3:a="3".concat(n,"rd").concat(i);break;default:a="".concat(t).concat(n,"th").concat(i)}return a}return""}},{key:"textStylesIsHOrPOption",value:function(t){return t.length>=3&&("p"===t[0]&&"_"===t[1]||"h"===t[0]&&"_"===t[2])}},{key:"textStylesIsFontFamilyVal",value:function(t){return["p_font","h_font","btn_font"].includes(t)}},{key:"setMobileSizeCoef",value:function(t,e){var n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:-1;if(e){var i=n>0&&($(window).width()<=n||$(window).height()<=n)?e.mobile_size_coef/100:1;t.style.setProperty("--font-size-coef",i*e.all_in_1_size_coef/100)}}},{key:"setTextStyles",value:function(e,n){var i=this,a=arguments.length>2&&void 0!==arguments[2]?arguments[2]:-1;if(n&&e){var o;t.setMobileSizeCoef(e,n,a);var r=d({},n),c=null!==(o=r.font_size_unit)&&void 0!==o?o:"em",l=[];if(Object.keys(r).forEach((function(t){i.textStylesIsFontFamilyVal(t)&&(l["--".concat(t)]=r[t]||"0"==r[t]?r[t]:"inherit")})),(r.p_font_size||"0"===r.p_font_size)&&(l["--p_font_size"]="calc("+r.p_font_size+c+"*var(--font-size-coef))",(r.p_mb||"0"===r.p_mb)&&(l["--p_mb"]="calc("+r.p_mb/100+"*"+l["--p_font_size"]+")")),r.h2_font_size||0==r.h2_font_size&&r.h5_font_size||0==r.h5_font_size)for(var s=(r.h2_font_size-r.h5_font_size)/4,u=1;u<=6;u++){var v=u-2;l["--h".concat(u,"_font_size")]="calc("+(r.h2_font_size-v*s)+c+"*var(--font-size-coef))"}if(r.h2_mb||0==r.h2_mb&&r.h5_mb||0==r.h5_mb)for(var h=(r.h2_mb-r.h5_mb)/4,f=1;f<=6;f++){var p=f-2,g=Math.round(10*(r.h2_mb-p*h))/10;l["--h".concat(f,"_mb")]="calc("+g/100+"*"+l["--h".concat(f,"_font_size")]+")",2===f&&(l["--dp_unit"]="calc("+1.3*g/1e3+"*"+l["--h".concat(f,"_font_size")]+")")}Object.keys(l).forEach((function(t){e.style.setProperty(t,l[t])}))}}}]),t}();Object(o.a)(v,"loadBuilder",(function(t,e){t.dpDebugEn&&console.log("builder config:",t);var n=new URL(window.location),i=t.queryParamsDefs,a=v.getDpUrlParam("dp_qp_tour_id",i,n),o=v.getDpUrlParam("dp_qpb_create_new",i,n),r=v.getDpUrlParam("dp_qpb_builder_mode",i,n);if(t.tours&&t.tours.length||"3"===r){var c=d({},t);delete c.tours,c.builderOrigin=v.getDpUrlParam("dp_qpb_builder_origin",i,n),c.builderMode=r,c.originHashId=v.getDpUrlParam("dp_qpb_origin_el_id",i,n),c.triggerId=v.getDpUrlParam("dp_qp_trigger_id",i,n)||0,c.initState=v.getDpUrlParam("dp_qpb_init_state",i,n),c.inNewWindow="1"===v.getDpUrlParam("dp_qpb_in_new_window",i,n),c.mobileAltStepMode=v.getDpUrlParam("dp_qpb_mobile_alt_step_mode",i,n);var l="mobile_menu"===c.mobileAltStepMode?500:0;setTimeout((function(){"3"===r?e(c,null):t.tours.forEach((function(t){(o&&t.createNew||t.tourId==a)&&e(c,t)}))}),l)}}))}},[[165,0,2,3]]]);
//# sourceMappingURL=dpit-admin-settings-29208a04.js.map