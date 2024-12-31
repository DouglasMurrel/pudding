!function(){"use strict";var t=tinymce.util.Tools.resolve("tinymce.PluginManager");const e=t=>e=>typeof e===t,o=(t=>e=>(t=>{const e=typeof t;return null===t?"null":"object"===e&&Array.isArray(t)?"array":"object"===e&&(o=n=t,r=(i=String).prototype,r.isPrototypeOf(o)||(null===(s=n.constructor)||void 0===s?void 0:s.name)===i.name)?"string":e;var o,r;var n,i,s})(e)===t)("string"),r=e("boolean"),n=t=>!(t=>null==t)(t),i=e("function"),s=e("number"),l=(a=!1,()=>a);var a;class u{constructor(t,e){this.tag=t,this.value=e}static some(t){return new u(!0,t)}static none(){return u.singletonNone}fold(t,e){return this.tag?e(this.value):t()}isSome(){return this.tag}isNone(){return!this.tag}map(t){return this.tag?u.some(t(this.value)):u.none()}bind(t){return this.tag?t(this.value):u.none()}exists(t){return this.tag&&t(this.value)}forall(t){return!this.tag||t(this.value)}filter(t){return!this.tag||t(this.value)?this:u.none()}getOr(t){return this.tag?this.value:t}or(t){return this.tag?this:t}getOrThunk(t){return this.tag?this.value:t()}orThunk(t){return this.tag?this:t()}getOrDie(t){if(this.tag)return this.value;throw new Error(null!=t?t:"Called getOrDie on None")}static from(t){return n(t)?u.some(t):u.none()}getOrNull(){return this.tag?this.value:null}getOrUndefined(){return this.value}each(t){this.tag&&t(this.value)}toArray(){return this.tag?[this.value]:[]}toString(){return this.tag?`some(${this.value})`:"none()"}}u.singletonNone=new u(!1);const c=(t,e)=>{for(let o=0,r=t.length;o<r;o++){e(t[o],o)}},d=t=>{if(null==t)throw new Error("Node cannot be null or undefined");return{dom:t}},m={fromHtml:(t,e)=>{const o=(e||document).createElement("div");if(o.innerHTML=t,!o.hasChildNodes()||o.childNodes.length>1){const e="HTML does not have a single root node";throw console.error(e,t),new Error(e)}return d(o.childNodes[0])},fromTag:(t,e)=>{const o=(e||document).createElement(t);return d(o)},fromText:(t,e)=>{const o=(e||document).createTextNode(t);return d(o)},fromDom:d,fromPoint:(t,e,o)=>u.from(t.dom.elementFromPoint(e,o)).map(d)},h=(t,e)=>{const o=t.dom;if(1!==o.nodeType)return!1;{const t=o;if(void 0!==t.matches)return t.matches(e);if(void 0!==t.msMatchesSelector)return t.msMatchesSelector(e);if(void 0!==t.webkitMatchesSelector)return t.webkitMatchesSelector(e);if(void 0!==t.mozMatchesSelector)return t.mozMatchesSelector(e);throw new Error("Browser lacks native selectors")}};"undefined"!=typeof window?window:Function("return this;")();const g=t=>e=>(t=>t.dom.nodeType)(e)===t,f=g(1),v=g(3),y=g(11),w=t=>((t,e)=>{const o=t.length,r=new Array(o);for(let n=0;n<o;n++){const o=t[n];r[n]=e(o,n)}return r})(t.dom.childNodes,m.fromDom),p=(t,e,n)=>{((t,e,n)=>{if(!(o(n)||r(n)||s(n)))throw console.error("Invalid call to Attribute.set. Key ",e,":: Value ",n,":: Element ",t),new Error("Attribute value was not simple");t.setAttribute(e,n+"")})(t.dom,e,n)},b=(t,e)=>{t.dom.removeAttribute(e)},N=t=>{const e=(t=>m.fromDom(t.dom.getRootNode()))(t);return y(o=e)&&n(o.dom.host)?u.some(e):u.none();var o},D=t=>m.fromDom(t.dom.host),S=t=>{const e=v(t)?t.dom.parentNode:t.dom;if(null==e||null===e.ownerDocument)return!1;const o=e.ownerDocument;return N(m.fromDom(e)).fold((()=>o.body.contains(e)),(r=S,n=D,t=>r(n(t))));var r,n},T=(t,e,o)=>((t,e,o)=>{let r=t.dom;const n=i(o)?o:l;for(;r.parentNode;){r=r.parentNode;const t=m.fromDom(r);if(e(t))return u.some(t);if(n(t))break}return u.none()})(t,(t=>h(t,e)),o),E=(t,e)=>(t=>void 0!==t.style&&i(t.style.getPropertyValue))(t)?t.style.getPropertyValue(e):"",A=t=>"rtl"===((t,e)=>{const o=t.dom,r=window.getComputedStyle(o).getPropertyValue(e);return""!==r||S(t)?r:E(o,e)})(t,"direction")?"rtl":"ltr",C=(t,e)=>((t,e)=>((t,e)=>{const o=[];for(let r=0,n=t.length;r<n;r++){const n=t[r];e(n,r)&&o.push(n)}return o})(w(t),e))(t,(t=>h(t,e))),M=t=>(t=>u.from(t.dom.parentNode).map(m.fromDom))(t).filter(f),L=(O="li",t=>f(t)&&t.dom.nodeName.toLowerCase()===O);var O;const k=(t,e,o)=>{c(e,(e=>{const r=m.fromDom(e),n=L(r),i=((t,e)=>(e?T(t,"ol,ul"):u.some(t)).getOr(t))(r,n);M(i).each((e=>{t.setStyle(i.dom,"direction",null);if(A(e)===o?b(i,"dir"):p(i,"dir",o),A(i)!==o&&t.setStyle(i.dom,"direction",o),n){const e=C(i,"li[dir],li[style]");c(e,(e=>{b(e,"dir"),t.setStyle(e.dom,"direction",null)}))}}))}))},P=(t,e)=>{t.selection.isEditable()&&(k(t.dom,t.selection.getSelectedBlocks(),e),t.nodeChanged())},R=(t,e)=>o=>{const r=r=>{const n=m.fromDom(r.element);o.setActive(A(n)===e),o.setEnabled(t.selection.isEditable())};return t.on("NodeChange",r),o.setEnabled(t.selection.isEditable()),()=>t.off("NodeChange",r)};t.add("directionality",(t=>{(t=>{t.addCommand("mceDirectionLTR",(()=>{P(t,"ltr")})),t.addCommand("mceDirectionRTL",(()=>{P(t,"rtl")}))})(t),(t=>{t.ui.registry.addToggleButton("ltr",{tooltip:"Left to right",icon:"ltr",onAction:()=>t.execCommand("mceDirectionLTR"),onSetup:R(t,"ltr")}),t.ui.registry.addToggleButton("rtl",{tooltip:"Right to left",icon:"rtl",onAction:()=>t.execCommand("mceDirectionRTL"),onSetup:R(t,"rtl")})})(t)}))}();