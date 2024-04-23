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
(window.wpackiodpIntroToursmainJsonp=window.wpackiodpIntroToursmainJsonp||[]).push([[4],{16:function(r,o,t){"use strict";t.d(o,"a",(function(){return l}));var e=t(11),n=t(3),a=t(2),c=t(0),s=t(10),u=t.n(s),l=function(){function r(o){Object(n.a)(this,r),o.dpDebugEn&&console.log("DPColors")}return Object(a.a)(r,null,[{key:"getContrastColor",value:function(r){var o=!(arguments.length>1&&void 0!==arguments[1])||arguments[1],t=arguments.length>2&&void 0!==arguments[2]?arguments[2]:["#fff","#484848"],e=arguments.length>3&&void 0!==arguments[3]?arguments[3]:3,n=arguments.length>4&&void 0!==arguments[4]?arguments[4]:["#292929"],a=[];return t.forEach((function(o){var t=u()(o);a.push({color:t,contrast:u()(r).contrast(t)})})),a.length?(a[0].contrast*=o?2.2:1.5,a.sort((function(r,o){return o.contrast-r.contrast})),a[0].contrast<e&&(n.forEach((function(o){var t=u()(o);a.push({color:t,contrast:u()(r).contrast(t)})})),a.sort((function(r,o){return o.contrast-r.contrast}))),a[0].color):t[0]?u()(t[0]):n[0]?u()(n[0]):u()("#fff")}},{key:"getMostColor",value:function(o,t){var n=null;if(o){var a=Object(e.a)(o);a.sort((function(o,e){return r.compareColorsByRgbHue(t,o,e)})),n=a[0]}return n}}]),r}();Object(c.a)(l,"getRgbHueFeature",(function(r,o){switch(r){case"r":return o.red()+(o.red()-o.green())+(o.red()-o.blue());case"g":return o.green()+(o.green()-o.red())+(o.green()-o.blue());case"b":return o.blue()+(o.blue()-o.red())+(o.blue()-o.green())}})),Object(c.a)(l,"getRgbHueAdjustedColor",(function(r,o){switch(r){case"r":return u.a.rgb(Math.min(o.red()+100,255),Math.max(o.green()-100,0),Math.max(o.blue()-100,0));case"g":return u.a.rgb(Math.max(o.red()-100,0),Math.min(o.green()+100,255),Math.max(o.blue()-100,0));case"b":return u.a.rgb(Math.max(o.red()-100,0),Math.max(o.green()-100,0),Math.min(o.blue()+100,255))}})),Object(c.a)(l,"compareColorsByRgbHue",(function(r,o,t){return l.getRgbHueFeature(r,t)-l.getRgbHueFeature(r,o)}))},30:function(r,o,t){"use strict";t.r(o),t.d(o,"default",(function(){return u}));var e=t(2),n=t(3),a=t(10),c=t.n(a),s=t(16),u=Object(e.a)((function r(o){if(Object(n.a)(this,r),o.dpDebugEn&&console.log("AdminThemeColors"),o.adminColors&&o.adminColors.rootSelector&&o.adminColors.colors&&o.adminColors.colors.length>=3){var t=jQuery(o.adminColors.rootSelector);if(t&&t.length){for(var e=[],a=0;a<4;a++){var u=a+1;if(o.adminColors.colors[a]){var l=c.a.rgb(o.adminColors.colors[a]);if(l){if(e.push(l),t[0].style.setProperty("--dpu-color-".concat(u),"".concat(l.red(),", ").concat(l.green(),", ").concat(l.blue())),1===u){var i=l.lightness(95);t[0].style.setProperty("--dpu-color-".concat(u,"-light"),"".concat(i.red(),", ").concat(i.green(),", ").concat(i.blue()))}var g=s.a.getContrastColor(o.adminColors.colors[a]);t[0].style.setProperty("--dpu-color-".concat(u,"-text"),"".concat(g.red(),", ").concat(g.green(),", ").concat(g.blue()))}}}e&&o.adminColors.addRgbVars&&["r","b","g"].forEach((function(r){var n=s.a.getMostColor(e,r);o.adminColors.rgbFeatureThresh&&o.adminColors.rgbDefaults&&o.adminColors.rgbDefaults[r]&&(s.a.getRgbHueFeature(r,n)<o.adminColors.rgbFeatureThresh&&(n=c()(o.adminColors.rgbDefaults[r])));t[0].style.setProperty("--dpu-color-".concat(r),"".concat(n.red(),", ").concat(n.green(),", ").concat(n.blue()));var a=s.a.getContrastColor(n);t[0].style.setProperty("--dpu-color-".concat(r,"-text"),"".concat(a.red(),", ").concat(a.green(),", ").concat(a.blue()));var u=e.indexOf(n);-1!==u&&e.splice(u,1)}))}}}))}}]);
//# sourceMappingURL=AdminThemeColors-ae8aca48.js.map