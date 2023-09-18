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
(window.wpackiodpIntroToursmainJsonp=window.wpackiodpIntroToursmainJsonp||[]).push([[6,4],{11:function(e,t,n){"use strict";n.d(t,"a",(function(){return a}));var o=n(14);var r=n(21);function a(e){return function(e){if(Array.isArray(e))return Object(o.a)(e)}(e)||function(e){if("undefined"!=typeof Symbol&&null!=e[Symbol.iterator]||null!=e["@@iterator"])return Array.from(e)}(e)||Object(r.a)(e)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}},14:function(e,t,n){"use strict";function o(e,t){(null==t||t>e.length)&&(t=e.length);for(var n=0,o=new Array(t);n<t;n++)o[n]=e[n];return o}n.d(t,"a",(function(){return o}))},16:function(e,t,n){"use strict";n.d(t,"a",(function(){return u}));var o=n(11),r=n(3),a=n(2),i=n(0),c=n(10),s=n.n(c),u=function(){function e(t){Object(r.a)(this,e),t.dpDebugEn&&console.log("DPColors")}return Object(a.a)(e,null,[{key:"getContrastColor",value:function(e){var t=!(arguments.length>1&&void 0!==arguments[1])||arguments[1],n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:["#fff","#484848"],o=arguments.length>3&&void 0!==arguments[3]?arguments[3]:3,r=arguments.length>4&&void 0!==arguments[4]?arguments[4]:["#292929"],a=[];return n.forEach((function(t){var n=s()(t);a.push({color:n,contrast:s()(e).contrast(n)})})),a.length?(a[0].contrast*=t?2.2:1.5,a.sort((function(e,t){return t.contrast-e.contrast})),a[0].contrast<o&&(r.forEach((function(t){var n=s()(t);a.push({color:n,contrast:s()(e).contrast(n)})})),a.sort((function(e,t){return t.contrast-e.contrast}))),a[0].color):n[0]?s()(n[0]):r[0]?s()(r[0]):s()("#fff")}},{key:"getMostColor",value:function(t,n){var r=null;if(t){var a=Object(o.a)(t);a.sort((function(t,o){return e.compareColorsByRgbHue(n,t,o)})),r=a[0]}return r}}]),e}();Object(i.a)(u,"getRgbHueFeature",(function(e,t){switch(e){case"r":return t.red()+(t.red()-t.green())+(t.red()-t.blue());case"g":return t.green()+(t.green()-t.red())+(t.green()-t.blue());case"b":return t.blue()+(t.blue()-t.red())+(t.blue()-t.green())}})),Object(i.a)(u,"getRgbHueAdjustedColor",(function(e,t){switch(e){case"r":return s.a.rgb(Math.min(t.red()+100,255),Math.max(t.green()-100,0),Math.max(t.blue()-100,0));case"g":return s.a.rgb(Math.max(t.red()-100,0),Math.min(t.green()+100,255),Math.max(t.blue()-100,0));case"b":return s.a.rgb(Math.max(t.red()-100,0),Math.max(t.green()-100,0),Math.min(t.blue()+100,255))}})),Object(i.a)(u,"compareColorsByRgbHue",(function(e,t,n){return u.getRgbHueFeature(e,n)-u.getRgbHueFeature(e,t)}))},175:function(e,t,n){"use strict";n.r(t);var o=n(2),r=n(3),a=n(0),i=n(26),c=n.n(i),s=n(28),u=n.n(s),l=n(12),d=n.n(l),f=n(37),g=n.n(f);c.a.defaults.headers.post["Content-Type"]="application/json";var p=Object(o.a)((function e(t){var n=this;Object(r.a)(this,e),Object(a.a)(this,"closeNoticeAndSaveCookieFlag",(function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"1",n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:30,o=$(e).closest(".dpit-notice");if(o&&o.length){var r=o.attr("id");o.remove(),r&&g.a.set(r,t,{expires:n})}})),Object(a.a)(this,"updateUserSetting",(function(e,t){c.a.post("/set-user-data",{key:e,value:t},n.wpDpApiCfg).catch((function(e){console.log(new u.a(e))}))})),Object(a.a)(this,"sendFeedbackToDeepPresentationCom",(function(e){c.a.post(d()(n.config.ratingFeedbackLink,e)).then((function(){})).catch((function(e){console.log(new u.a(e))}))})),Object(a.a)(this,"activateA4R",(function(){$("#a4r-link-already-did").on("click",(function(e){e.preventDefault(),e.stopPropagation(),n.closeNoticeAndSaveCookieFlag(e.target,"1",30),n.sendFeedbackToDeepPresentationCom("already-did")})),$("#a4r-link-no-good").on("click",(function(e){e.preventDefault(),e.stopPropagation(),n.closeNoticeAndSaveCookieFlag(e.target,"1",15),n.sendFeedbackToDeepPresentationCom("no-good")})),$("#a4r-link-OK").on("click",(function(e){n.closeNoticeAndSaveCookieFlag(e.target,"1",50),n.sendFeedbackToDeepPresentationCom("ok")}))})),t.dpDebugEn&&console.log("DPNotices"),this.config=t,c.a.defaults.baseURL=this.config.siteUrl,this.activateA4R()})),b=Object(o.a)((function e(t){var n=this;Object(r.a)(this,e),t.dpDebugEn&&console.log("DPProOnlyOption"),this.config=t,$(".dpit-pro-only").closest("tr").find("th").addClass("dpit-pro-only"),$('.dpit-pro-only, .acf-field-group[data-name="intro_url_variables"] .acf-fields').on("click",(function(e){return!!$(e.target).closest(".dp-info-icon").length||(e.preventDefault(),e.stopPropagation(),n.config.proFeaturesLink&&confirm(n.config.i18n.feature_pro_only)&&window.open(n.config.proFeaturesLink,"_blank"),!1)}))})),m=n(30);jQuery(document).ready((function(e){window.$=e,window.dp_main_admin_config.dpDebugEn&&console.log("Admin config:",window.dp_main_admin_config),new p(window.dp_main_admin_config),new b(window.dp_main_admin_config),new m.default(window.dp_main_admin_config)}))},21:function(e,t,n){"use strict";n.d(t,"a",(function(){return r}));var o=n(14);function r(e,t){if(e){if("string"==typeof e)return Object(o.a)(e,t);var n=Object.prototype.toString.call(e).slice(8,-1);return"Object"===n&&e.constructor&&(n=e.constructor.name),"Map"===n||"Set"===n?Array.from(e):"Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)?Object(o.a)(e,t):void 0}}},30:function(e,t,n){"use strict";n.r(t),n.d(t,"default",(function(){return s}));var o=n(2),r=n(3),a=n(10),i=n.n(a),c=n(16),s=Object(o.a)((function e(t){if(Object(r.a)(this,e),t.dpDebugEn&&console.log("AdminThemeColors"),t.adminColors&&t.adminColors.rootSelector&&t.adminColors.colors&&t.adminColors.colors.length>=3){var n=jQuery(t.adminColors.rootSelector);if(n&&n.length){for(var o=[],a=0;a<4;a++){var s=a+1;if(t.adminColors.colors[a]){var u=i.a.rgb(t.adminColors.colors[a]);if(u){if(o.push(u),n[0].style.setProperty("--dpu-color-".concat(s),"".concat(u.red(),", ").concat(u.green(),", ").concat(u.blue())),1===s){var l=u.lightness(95);n[0].style.setProperty("--dpu-color-".concat(s,"-light"),"".concat(l.red(),", ").concat(l.green(),", ").concat(l.blue()))}var d=c.a.getContrastColor(t.adminColors.colors[a]);n[0].style.setProperty("--dpu-color-".concat(s,"-text"),"".concat(d.red(),", ").concat(d.green(),", ").concat(d.blue()))}}}o&&t.adminColors.addRgbVars&&["r","b","g"].forEach((function(e){var r=c.a.getMostColor(o,e);t.adminColors.rgbFeatureThresh&&t.adminColors.rgbDefaults&&t.adminColors.rgbDefaults[e]&&(c.a.getRgbHueFeature(e,r)<t.adminColors.rgbFeatureThresh&&(r=i()(t.adminColors.rgbDefaults[e])));n[0].style.setProperty("--dpu-color-".concat(e),"".concat(r.red(),", ").concat(r.green(),", ").concat(r.blue()));var a=c.a.getContrastColor(r);n[0].style.setProperty("--dpu-color-".concat(e,"-text"),"".concat(a.red(),", ").concat(a.green(),", ").concat(a.blue()));var s=o.indexOf(r);-1!==s&&o.splice(s,1)}))}}}))},37:function(e,t,n){var o,r,a=n(13);!function(i){var c;if(void 0===(r="function"==typeof(o=i)?o.call(t,n,t,e):o)||(e.exports=r),c=!0,"object"===a(t)&&(e.exports=i(),c=!0),!c){var s=window.Cookies,u=window.Cookies=i();u.noConflict=function(){return window.Cookies=s,u}}}((function(){function e(){for(var e=0,t={};e<arguments.length;e++){var n=arguments[e];for(var o in n)t[o]=n[o]}return t}function t(e){return e.replace(/(%[0-9A-Z]{2})+/g,decodeURIComponent)}return function n(o){function r(){}function a(t,n,a){if("undefined"!=typeof document){"number"==typeof(a=e({path:"/"},r.defaults,a)).expires&&(a.expires=new Date(1*new Date+864e5*a.expires)),a.expires=a.expires?a.expires.toUTCString():"";try{var i=JSON.stringify(n);/^[\{\[]/.test(i)&&(n=i)}catch(e){}n=o.write?o.write(n,t):encodeURIComponent(String(n)).replace(/%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g,decodeURIComponent),t=encodeURIComponent(String(t)).replace(/%(23|24|26|2B|5E|60|7C)/g,decodeURIComponent).replace(/[\(\)]/g,escape);var c="";for(var s in a)a[s]&&(c+="; "+s,!0!==a[s]&&(c+="="+a[s].split(";")[0]));return document.cookie=t+"="+n+c}}function i(e,n){if("undefined"!=typeof document){for(var r={},a=document.cookie?document.cookie.split("; "):[],i=0;i<a.length;i++){var c=a[i].split("="),s=c.slice(1).join("=");n||'"'!==s.charAt(0)||(s=s.slice(1,-1));try{var u=t(c[0]);if(s=(o.read||o)(s,u)||t(s),n)try{s=JSON.parse(s)}catch(e){}if(r[u]=s,e===u)break}catch(e){}}return e?r[e]:r}}return r.set=a,r.get=function(e){return i(e,!1)},r.getJSON=function(e){return i(e,!0)},r.remove=function(t,n){a(t,"",e(n,{expires:-1}))},r.defaults={},r.withConverter=n,r}((function(){}))}))},98:function(e,t,n){n(15),e.exports=n(175)}},[[98,0,1,2]]]);
//# sourceMappingURL=dpit-admin-5b43abe2.js.map