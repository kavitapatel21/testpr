(()=>{"use strict";const t=["yasr-rater-stars","yasr-multiset-visitors-rater"];for(let r=0;r<t.length;r++)e(t[r]);function e(t){const e=document.getElementsByClassName(t);e.length>0&&("yasr-rater-stars"===t&&function(t){for(let e=0;e<t.length;e++)if(!1===t.item(e).classList.contains("yasr-star-rating")){const r=t.item(e),s=r.id,i=r.getAttribute("data-rater-starsize");yasrSetRaterValue(i,s,r)}}(e),"yasr-multiset-visitors-rater"===t&&function(t){let e="",s=[];const i=document.getElementById("yasr-pro-multiset-review-rating");for(let r=0;r<t.length;r++)!function(r){if(!1!==t.item(r).classList.contains("yasr-star-rating"))return;let a=t.item(r),n=a.id,o=a.getAttribute("data-rater-readonly"),l=a.getAttribute("data-rater-starsize");l||(l=16),o=yasrTrueFalseStringConvertion(o);const c=function(t,r){const n=a.getAttribute("data-rater-postid"),o=a.getAttribute("data-rater-setid"),l=a.getAttribute("data-rater-set-field-id");t=t.toFixed(1);const c=parseInt(t);this.setRating(c),e={postid:n,setid:o,field:l,rating:c},s.push(e),i&&(i.value=JSON.stringify(s)),r()};yasrSetRaterValue(l,n,a,1,o,!1,c)}(r);!function(t){const e=document.getElementsByClassName("yasr-send-visitor-multiset");for(let s=0;s<e.length;s++)e[s].addEventListener("click",(function(){const e=this.getAttribute("data-postid"),s=this.getAttribute("data-setid"),i=this.getAttribute("data-nonce"),a=document.getElementById(`yasr-send-visitor-multiset-${e}-${s}`),n=document.getElementById(`yasr-loader-multiset-visitor-${e}-${s}`);a.style.display="none",n.style.display="block";const o={action:"yasr_visitor_multiset_field_vote",post_id:e,rating:JSON.stringify(t),set_id:s};!0===JSON.parse(yasrWindowVar.isUserLoggedIn)&&Object.assign(o,{nonce:i});r(new URLSearchParams(o).toString(),n)}))}(s)}(e))}function r(t,e){fetch(yasrWindowVar.ajaxurl,{method:"POST",headers:{"Content-Type":"application/x-www-form-urlencoded"},body:t}).then((t=>{if(!0===t.ok)return t.json();throw new Error("Ajax Call Failed.")})).then((t=>{if("object"!=typeof t||Array.isArray(t)||null===t)throw new Error(`The response is not an object, response is: ${t}`);if(Object.hasOwn(t,"status")){if("success"!==t.status)throw new Error(t.text);e.innerText=t.text}})).catch((t=>{e.innerText="Ajax Call Failed",console.error("Fetch network error",t)})).catch((t=>{e.innerText=t,console.error("Error with the Query",t)}))}})();