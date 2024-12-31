!function(){"use strict";var e=tinymce.util.Tools.resolve("tinymce.PluginManager");let t=0;const o=e=>{const o=(new Date).getTime(),r=Math.floor(window.crypto.getRandomValues(new Uint32Array(1))[0]/4294967295*1e9);return t++,e+"_"+r+t+String(o)};var r=tinymce.util.Tools.resolve("tinymce.util.Delay");const n=e=>{e.on("PreInit",(()=>{e.queryCommandSupported("QuickbarInsertImage")||e.addCommand("QuickbarInsertImage",(()=>{(e=>new Promise((t=>{let o=!1;const n=document.createElement("input");n.type="file",n.accept="image/*",n.style.position="fixed",n.style.left="0",n.style.top="0",n.style.opacity="0.001",document.body.appendChild(n);const i=e=>{var r;o||(null===(r=n.parentNode)||void 0===r||r.removeChild(n),o=!0,t(e))},s=e=>{i(Array.prototype.slice.call(e.target.files))};n.addEventListener("input",s),n.addEventListener("change",s);const a=t=>{const n=()=>{i([])};o||("focusin"===t.type?r.setEditorTimeout(e,n,1e3):n()),e.off("focusin remove",a)};e.on("focusin remove",a),n.click()})))(e).then((t=>{if(t.length>0){const r=t[0];(e=>new Promise((t=>{const o=new FileReader;o.onloadend=()=>{t(o.result.split(",")[1])},o.readAsDataURL(e)})))(r).then((t=>{((e,t,r)=>{const n=e.editorUpload.blobCache,i=n.create(o("mceu"),r,t);n.add(i),e.insertContent(e.dom.createHTML("img",{src:i.blobUri()}))})(e,t,r)}))}}))}))}))},i=e=>t=>typeof t===e,s=(a="string",e=>(e=>{const t=typeof e;return null===e?"null":"object"===t&&Array.isArray(e)?"array":"object"===t&&(o=r=e,(n=String).prototype.isPrototypeOf(o)||(null===(i=r.constructor)||void 0===i?void 0:i.name)===n.name)?"string":t;var o,r,n,i})(e)===a);var a;const l=i("boolean"),c=i("function"),u=e=>t=>t.options.get(e),d=u("quickbars_selection_toolbar"),m=u("quickbars_insert_toolbar"),g=u("quickbars_image_toolbar"),h=(b=!1,()=>b);var b;class f{constructor(e,t){this.tag=e,this.value=t}static some(e){return new f(!0,e)}static none(){return f.singletonNone}fold(e,t){return this.tag?t(this.value):e()}isSome(){return this.tag}isNone(){return!this.tag}map(e){return this.tag?f.some(e(this.value)):f.none()}bind(e){return this.tag?e(this.value):f.none()}exists(e){return this.tag&&e(this.value)}forall(e){return!this.tag||e(this.value)}filter(e){return!this.tag||e(this.value)?this:f.none()}getOr(e){return this.tag?this.value:e}or(e){return this.tag?this:e}getOrThunk(e){return this.tag?this.value:e()}orThunk(e){return this.tag?this:e()}getOrDie(e){if(this.tag)return this.value;throw new Error(null!=e?e:"Called getOrDie on None")}static from(e){return(e=>null==e)(e)?f.none():f.some(e)}getOrNull(){return this.tag?this.value:null}getOrUndefined(){return this.value}each(e){this.tag&&e(this.value)}toArray(){return this.tag?[this.value]:[]}toString(){return this.tag?`some(${this.value})`:"none()"}}f.singletonNone=new f(!1),"undefined"!=typeof window?window:Function("return this;")();var p=(e,t,o,r,n)=>e(o,r)?f.some(o):c(n)&&n(o)?f.none():t(o,r,n);const v=e=>{if(null==e)throw new Error("Node cannot be null or undefined");return{dom:e}},y={fromHtml:(e,t)=>{const o=(t||document).createElement("div");if(o.innerHTML=e,!o.hasChildNodes()||o.childNodes.length>1){const t="HTML does not have a single root node";throw console.error(t,e),new Error(t)}return v(o.childNodes[0])},fromTag:(e,t)=>{const o=(t||document).createElement(e);return v(o)},fromText:(e,t)=>{const o=(t||document).createTextNode(e);return v(o)},fromDom:v,fromPoint:(e,t,o)=>f.from(e.dom.elementFromPoint(t,o)).map(v)},k=(e,t)=>{const o=e.dom;if(1!==o.nodeType)return!1;{const e=o;if(void 0!==e.matches)return e.matches(t);if(void 0!==e.msMatchesSelector)return e.msMatchesSelector(t);if(void 0!==e.webkitMatchesSelector)return e.webkitMatchesSelector(t);if(void 0!==e.mozMatchesSelector)return e.mozMatchesSelector(t);throw new Error("Browser lacks native selectors")}},w=(e,t,o)=>{let r=e.dom;const n=c(o)?o:h;for(;r.parentNode;){r=r.parentNode;const e=y.fromDom(r);if(t(e))return f.some(e);if(n(e))break}return f.none()},T=(e,t,o)=>((e,t,o)=>p(((e,t)=>t(e)),w,e,t,o))(e,t,o).isSome(),N=(e,t,o)=>w(e,(e=>k(e,t)),o),q=e=>{const t=m(e);t.length>0&&e.ui.registry.addContextToolbar("quickblock",{predicate:t=>{const o=y.fromDom(t),r=e.schema.getTextBlockElements(),n=t=>t.dom===e.getBody();return!((e,t)=>{const o=e.dom;return!(!o||!o.hasAttribute)&&o.hasAttribute(t)})(o,"data-mce-bogus")&&((e,t,o)=>p(((e,t)=>k(e,t)),N,e,t,o))(o,'table,[data-mce-bogus="all"]',n).fold((()=>T(o,(t=>t.dom.nodeName.toLowerCase()in r&&e.dom.isEmpty(t.dom)),n)),h)},items:t,position:"line",scope:"editor"})},C=e=>{const t=t=>e.dom.isEditable(t),o=e=>{const o="FIGURE"===e.nodeName&&/image/i.test(e.className),r="IMG"===e.nodeName||o,n=(i=y.fromDom(e),s="mce-pagebreak",(e=>void 0!==e.dom.classList)(i)&&i.dom.classList.contains(s));var i,s;return r&&t(e.parentElement)&&!n},r=g(e);r.length>0&&e.ui.registry.addContextToolbar("imageselection",{predicate:o,items:r,position:"node"});const n=d(e);n.length>0&&e.ui.registry.addContextToolbar("textselection",{predicate:r=>!o(r)&&!e.selection.isCollapsed()&&t(r),items:n,position:"selection",scope:"editor"})};e.add("quickbars",(e=>{(e=>{const t=e.options.register,o=e=>t=>{const o=l(t)||s(t);return o?l(t)?{value:t?e:"",valid:o}:{value:t.trim(),valid:o}:{valid:!1,message:"Must be a boolean or string."}},r="bold italic | quicklink h2 h3 blockquote";t("quickbars_selection_toolbar",{processor:o(r),default:r});const n="quickimage quicktable";t("quickbars_insert_toolbar",{processor:o(n),default:n});const i="alignleft aligncenter alignright";t("quickbars_image_toolbar",{processor:o(i),default:i})})(e),n(e),(e=>{e.ui.registry.addButton("quickimage",{icon:"image",tooltip:"Insert image",onAction:()=>e.execCommand("QuickbarInsertImage")}),e.ui.registry.addButton("quicktable",{icon:"table",tooltip:"Insert table",onAction:()=>{((e,t,o)=>{e.execCommand("mceInsertTable",!1,{rows:o,columns:t})})(e,2,2)}})})(e),q(e),C(e)}))}();