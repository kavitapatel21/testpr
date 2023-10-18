(()=>{"use strict";var e,o={387:()=>{const e=window.wp.blocks,o=window.wp.element,l=window.wp.i18n,t=window.wp.blockEditor,r=window.wp.editor,a=window.wp.components;window.wp.compose,window.wp.data;const i=JSON.parse('{"u2":"powerfolio/image-gallery-block"}');(0,e.registerBlockType)(i.u2,{edit:function({attributes:e,setAttributes:i}){const n=(0,t.useBlockProps)(),{isProVersion:s}=powerfolioBlockData,c=Object.entries(powerfolioBlockData.columnOptions).map((([e,o])=>({value:e,label:o}))),m=Object.entries(powerfolioBlockData.columnMobileOptions).map((([e,o])=>({value:e,label:o}))),_=Object.entries(powerfolioBlockData.hoverOptions).map((([e,o])=>({value:e,label:o}))),[p,g]=(0,o.useState)(e.style),u=Object.entries(powerfolioBlockData.styleOptions).map((([e,o])=>({value:e,label:o}))),f=Object.entries(powerfolioBlockData.linkToOptions).map((([e,o])=>({value:e,label:o}))),[b,w]=(0,o.useState)();return(0,o.createElement)("div",n,(0,o.createElement)(t.InspectorControls,null,(0,o.createElement)(a.PanelBody,{title:"Image Gallery Settings"},(0,o.createElement)(t.MediaUpload,{onSelect:o=>{const l=o.map((e=>e.id)),t={...e.imageCustomUrls};Object.keys(t).forEach((e=>{l.includes(parseInt(e))||delete t[e]})),l.forEach((e=>{t.hasOwnProperty(e)||(t[e]="")})),i({imageIds:l,imageCustomUrls:t})},allowedTypes:["image"],multiple:!0,gallery:!0,value:e.imageIds,render:({open:t})=>(0,o.createElement)(a.Button,{onClick:t,isPrimary:!0},0===e.imageIds.length?(0,l.__)("Add Images","powerfolio"):(0,l.__)("Edit Gallery","powerfolio"))}),e.imageIds.map(((r,n)=>{const c=wp.media.attachment(r).get("url");return(0,o.createElement)(a.PanelBody,{key:r,title:(0,l.__)("Image","powerfolio")+" "+(n+1),initialOpen:!1},(0,o.createElement)("img",{src:c,alt:""}),(0,o.createElement)(a.TextControl,{label:(0,l.__)("Item Title","powerfolio"),value:e.listTitle[r]||"",onChange:o=>{const l={...e.listTitle,[r]:o};i({listTitle:l})}}),(0,o.createElement)(a.TextControl,{label:(0,l.__)("Item Tag (to use with filter)","powerfolio"),value:e.imageTags[r]||"",onChange:o=>{if(r){const l={...e.imageTags,[r]:o};i({imageTags:l})}}}),(0,o.createElement)(a.TextareaControl,{label:(0,l.__)("Item Description/Short Text","powerfolio"),value:e.listContent[r]||"",onChange:o=>{if(r){const l={...e.listContent,[r]:o};i({listContent:l})}}}),s?(0,o.createElement)(o.Fragment,null,(0,o.createElement)(a.SelectControl,{label:(0,l.__)("Image links to","powerfolio"),value:e.linkTo[r]||"image",options:[{value:"image",label:(0,l.__)("Image (with lightbox)","powerfolio")},{value:"link",label:(0,l.__)("Custom URL","powerfolio")}],onChange:o=>{const l={...e.linkTo,[r]:o};i({linkTo:l})}}),(0,o.createElement)(t.URLInput,{label:(0,l.__)("Item Custom Link","powerfolio"),value:e.imageCustomUrls[r]||"",onChange:o=>{const l={...e.imageCustomUrls,[r]:o};i({imageCustomUrls:l})}})):(0,o.createElement)(o.Fragment,null))})),s?(0,o.createElement)(o.Fragment,null):(0,o.createElement)(o.RawHTML,null,powerfolioBlockData.upgradeMessage)),(0,o.createElement)(a.PanelBody,{title:(0,l.__)("Layout & Customization","powerfolio"),initialOpen:!0},(0,o.createElement)(a.SelectControl,{label:(0,l.__)("Style","powerfolio"),value:e.style,options:u,onChange:e=>{i({style:e}),g(e)}}),(0,o.createElement)(a.SelectControl,{label:(0,l.__)("CSS Effect on Hover","powerfolio"),value:e.hover,options:_,onChange:e=>i({hover:e})}),(0,o.createElement)(a.SelectControl,{label:(0,l.__)("Link To","powerfolio"),value:e.linkto,options:f,onChange:e=>i({linkto:e})}),("box"===p||"masonry"===p)&&(0,o.createElement)(a.SelectControl,{label:(0,l.__)("Columns","powerfolio"),value:e.columns,options:c,onChange:e=>i({columns:e})}),("box"===p||"masonry"===p||"grid_builder"===p)&&(0,o.createElement)(a.ToggleControl,{label:(0,l.__)("Use item margin?","powerfolio"),checked:e.margin,onChange:e=>i({margin:e})}),s?(0,o.createElement)(o.Fragment,null,(0,o.createElement)(a.SelectControl,{label:(0,l.__)("Columns Mobile","powerfolio"),value:e.columns_mobile,options:m,onChange:e=>i({columns_mobile:e})}),e.margin&&(0,o.createElement)(a.RangeControl,{label:(0,l.__)("Additional Margin (px)","powerfolio"),value:e.margin_size,onChange:e=>i({margin_size:e}),min:0,max:20,step:1}),(0,o.createElement)(a.ToggleControl,{label:(0,l.__)("Zoom Effect","powerfolio"),checked:e.zoom_effect,onChange:e=>i({zoom_effect:e})}),(0,o.createElement)(a.ToggleControl,{label:(0,l.__)("Hide Item Title","powerfolio"),checked:e.item_hide_title,onChange:e=>i({item_hide_title:e})}),(0,o.createElement)(a.ToggleControl,{label:(0,l.__)("Hide Item Category","powerfolio"),checked:e.hide_item_category,onChange:e=>i({hide_item_category:e})}),("box"===p||"specialgrid5"===p||"specialgrid6"===p)&&(0,o.createElement)(a.RangeControl,{label:(0,l.__)("Box Height (px)","powerfolio"),value:e.box_height,onChange:e=>i({box_height:e}),min:10,max:800,step:10}),(0,o.createElement)(a.SelectControl,{label:(0,l.__)("Text Transform","powerfolio"),value:e.text_transform,options:[{value:"",label:(0,l.__)("None","powerfolio")},{value:"uppercase",label:(0,l.__)("UPPERCASE","powerfolio")},{value:"lowercase",label:(0,l.__)("lowercase","powerfolio")},{value:"capitalize",label:(0,l.__)("Capitalize","powerfolio")}],onChange:e=>i({text_transform:e})}),(0,o.createElement)(a.SelectControl,{label:(0,l.__)("Text Align","powerfolio"),value:e.text_align,options:[{label:(0,l.__)("Center","powerfolio"),value:"center"},{label:(0,l.__)("Left","powerfolio"),value:"left"},{label:(0,l.__)("Right","powerfolio"),value:"right"}],onChange:e=>{i({text_align:e})}}),(0,o.createElement)(a.RangeControl,{label:(0,l.__)("Border Radius","powerfolio"),value:e.borderRadius,min:0,max:100,onChange:e=>i({borderRadius:e})}),(0,o.createElement)(a.RangeControl,{label:(0,l.__)("Item: Border Size","powerfolio"),value:e.border_size,onChange:e=>i({border_size:e}),min:0,max:40})):(0,o.createElement)(o.RawHTML,null,powerfolioBlockData.upgradeMessage)),(0,o.createElement)(a.PanelBody,{title:(0,l.__)("Category Filter Options","powerfolio"),initialOpen:!1},(0,o.createElement)(a.ToggleControl,{label:(0,l.__)("Show Filter","powerfolio"),checked:e.showfilter,onChange:e=>i({showfilter:e})}),(0,o.createElement)(a.ToggleControl,{label:(0,l.__)("Show All Button","powerfolio"),checked:e.showallbtn,onChange:e=>i({showallbtn:e})}),s?(0,o.createElement)(o.Fragment,null,(0,o.createElement)(a.TextControl,{label:(0,l.__)('Customize "All" button text',"powerfolio"),value:e.tax_text,onChange:e=>i({tax_text:e})}),(0,o.createElement)(a.SelectControl,{label:(0,l.__)("Filter: Text Transform","powerfolio"),value:e.filter_text_transform,options:[{label:(0,l.__)("None","powerfolio"),value:""},{label:(0,l.__)("UPPERCASE","powerfolio"),value:"uppercase"},{label:(0,l.__)("lowercase","powerfolio"),value:"lowercase"},{label:(0,l.__)("Capitalize","powerfolio"),value:"capitalize"}],onChange:e=>i({filter_text_transform:e})}),(0,o.createElement)(a.RangeControl,{label:(0,l.__)("Filter: Border Radius","powerfolio"),value:e.filter_border_radius,onChange:e=>i({filter_border_radius:e}),min:0,max:50})):(0,o.createElement)(o.RawHTML,null,powerfolioBlockData.upgradeMessage)),(0,o.createElement)(a.PanelBody,{title:(0,l.__)("Colors","powerfolio"),initialOpen:!1},(0,o.createElement)(a.PanelBody,{title:(0,l.__)("Item: Background Color on Hover","powerfolio"),initialOpen:!1},(0,o.createElement)(a.ColorPicker,{label:(0,l.__)("Item: Background Color on Hover","powerfolio"),color:e.bgColor,onChangeComplete:e=>i({bgColor:e.hex})})),(0,o.createElement)(a.PanelBody,{title:(0,l.__)("Filter: Background Color","powerfolio"),initialOpen:!1},(0,o.createElement)(a.ColorPicker,{label:(0,l.__)("Filter: Background Color","powerfolio"),color:e.filter_bgcolor,onChangeComplete:e=>i({filter_bgcolor:e.hex})})),(0,o.createElement)(a.PanelBody,{title:(0,l.__)("Filter: Background Color (active item)","powerfolio"),initialOpen:!1},(0,o.createElement)(a.ColorPicker,{label:(0,l.__)("Filter: Background Color (active item)","powerfolio"),color:e.filter_bgcolor_active,onChangeComplete:e=>i({filter_bgcolor_active:e.hex})})),s?(0,o.createElement)(o.Fragment,null,(0,o.createElement)(a.PanelBody,{title:(0,l.__)("Item: Border Color","powerfolio"),initialOpen:!1},(0,o.createElement)(a.ColorPicker,{label:(0,l.__)("Item: Border Color","powerfolio"),color:e.item_bordercolor,onChangeComplete:e=>i({item_bordercolor:e.hex})}))):(0,o.createElement)(o.RawHTML,null,powerfolioBlockData.upgradeMessage))),(0,o.createElement)(r.ServerSideRender,{block:"powerfolio/image-gallery-block",attributes:{hover:e.hover,columns:e.columns,postsperpage:e.postsperpage,type:e.type,showfilter:e.showfilter,showallbtn:e.showallbtn,tax_text:e.tax_text,style:e.style,margin:e.margin,linkto:e.linkto,bgColor:e.bgColor,margin_size:e.margin_size,box_height:e.box_height,text_transform:e.text_transform,text_align:e.text_align,borderRadius:e.borderRadius,border_size:e.border_size,item_bordercolor:e.item_bordercolor,filter_bgcolor:e.filter_bgcolor,filter_bgcolor_active:e.filter_bgcolor_active,filter_text_transform:e.filter_text_transform,filter_border_radius:e.filter_border_radius,imageIds:e.imageIds,imageCustomUrls:e.imageCustomUrls,imageTags:e.imageTags,listTitle:e.listTitle,listContent:e.listContent,linkTo:e.linkTo}}))},save:function({attributes:e}){const{hover:l}=e;return(0,o.createElement)("div",t.useBlockProps.save(),(0,o.createElement)("p",null,'[powerfolio hover="',l,'"]'))}})}},l={};function t(e){var r=l[e];if(void 0!==r)return r.exports;var a=l[e]={exports:{}};return o[e](a,a.exports,t),a.exports}t.m=o,e=[],t.O=(o,l,r,a)=>{if(!l){var i=1/0;for(m=0;m<e.length;m++){for(var[l,r,a]=e[m],n=!0,s=0;s<l.length;s++)(!1&a||i>=a)&&Object.keys(t.O).every((e=>t.O[e](l[s])))?l.splice(s--,1):(n=!1,a<i&&(i=a));if(n){e.splice(m--,1);var c=r();void 0!==c&&(o=c)}}return o}a=a||0;for(var m=e.length;m>0&&e[m-1][2]>a;m--)e[m]=e[m-1];e[m]=[l,r,a]},t.o=(e,o)=>Object.prototype.hasOwnProperty.call(e,o),(()=>{var e={990:0,69:0};t.O.j=o=>0===e[o];var o=(o,l)=>{var r,a,[i,n,s]=l,c=0;if(i.some((o=>0!==e[o]))){for(r in n)t.o(n,r)&&(t.m[r]=n[r]);if(s)var m=s(t)}for(o&&o(l);c<i.length;c++)a=i[c],t.o(e,a)&&e[a]&&e[a][0](),e[a]=0;return t.O(m)},l=globalThis.webpackChunkmy_first_block=globalThis.webpackChunkmy_first_block||[];l.forEach(o.bind(null,0)),l.push=o.bind(null,l.push.bind(l))})();var r=t.O(void 0,[69],(()=>t(387)));r=t.O(r)})();