!function(){"use strict";var e=tinymce.util.Tools.resolve("tinymce.PluginManager");let t=0;const o=e=>{const o=(new Date).getTime(),n=Math.floor(window.crypto.getRandomValues(new Uint32Array(1))[0]/4294967295*1e9);return t++,e+"_"+n+t+String(o)},n=e=>t=>typeof t===e,r=(e=>t=>(e=>{const t=typeof e;return null===e?"null":"object"===t&&Array.isArray(e)?"array":"object"===t&&(o=r=e,n=(s=String).prototype,n.isPrototypeOf(o)||(null===(i=r.constructor)||void 0===i?void 0:i.name)===s.name)?"string":t;var o,n;var r,s,i})(t)===e)("string"),s=n("boolean"),i=e=>null==e,a=e=>!i(e),d=n("function"),l=n("number"),c=e=>()=>e,m=(e,t)=>e===t,u=c(!1);class g{constructor(e,t){this.tag=e,this.value=t}static some(e){return new g(!0,e)}static none(){return g.singletonNone}fold(e,t){return this.tag?t(this.value):e()}isSome(){return this.tag}isNone(){return!this.tag}map(e){return this.tag?g.some(e(this.value)):g.none()}bind(e){return this.tag?e(this.value):g.none()}exists(e){return this.tag&&e(this.value)}forall(e){return!this.tag||e(this.value)}filter(e){return!this.tag||e(this.value)?this:g.none()}getOr(e){return this.tag?this.value:e}or(e){return this.tag?this:e}getOrThunk(e){return this.tag?this.value:e()}orThunk(e){return this.tag?this:e()}getOrDie(e){if(this.tag)return this.value;throw new Error(null!=e?e:"Called getOrDie on None")}static from(e){return a(e)?g.some(e):g.none()}getOrNull(){return this.tag?this.value:null}getOrUndefined(){return this.value}each(e){this.tag&&e(this.value)}toArray(){return this.tag?[this.value]:[]}toString(){return this.tag?`some(${this.value})`:"none()"}}g.singletonNone=new g(!1);const p=Array.prototype.indexOf,h=(e,t)=>{return o=e,n=t,p.call(o,n)>-1;var o,n},f=(e,t)=>{const o=e.length,n=new Array(o);for(let r=0;r<o;r++){const o=e[r];n[r]=t(o,r)}return n},y=(e,t)=>{for(let o=0,n=e.length;o<n;o++){t(e[o],o)}},v=Object.keys;"undefined"!=typeof window?window:Function("return this;")();const w=e=>e.dom.nodeName.toLowerCase(),b=e=>e.dom.nodeType,N=e=>t=>b(t)===e,T=e=>8===b(e)||"#comment"===w(e),A=N(1),C=N(3),S=N(9),x=N(11),D=(e,t,o)=>{if(!(r(o)||s(o)||l(o)))throw console.error("Invalid call to Attribute.set. Key ",t,":: Value ",o,":: Element ",e),new Error("Attribute value was not simple");e.setAttribute(t,o+"")},E=(e,t,o)=>{D(e.dom,t,o)},O=(e,t)=>{const o=e.dom;((e,t)=>{const o=v(e);for(let n=0,r=o.length;n<r;n++){const r=o[n];t(e[r],r)}})(t,((e,t)=>{D(o,t,e)}))},M=(e,t)=>{const o=e.dom.getAttribute(t);return null===o?void 0:o},P=(e,t)=>g.from(M(e,t)),R=(e,t)=>{e.dom.removeAttribute(t)},k=e=>{return t=e.dom.attributes,o=(e,t)=>(e[t.name]=t.value,e),n={},y(t,((e,t)=>{n=o(n,e,t)})),n;var t,o,n},B=e=>{if(null==e)throw new Error("Node cannot be null or undefined");return{dom:e}},L={fromHtml:(e,t)=>{const o=(t||document).createElement("div");if(o.innerHTML=e,!o.hasChildNodes()||o.childNodes.length>1){const t="HTML does not have a single root node";throw console.error(t,e),new Error(t)}return B(o.childNodes[0])},fromTag:(e,t)=>{const o=(t||document).createElement(e);return B(o)},fromText:(e,t)=>{const o=(t||document).createTextNode(e);return B(o)},fromDom:B,fromPoint:(e,t,o)=>g.from(e.dom.elementFromPoint(t,o)).map(B)},$=(e,t)=>{const o=e.dom;if(1!==o.nodeType)return!1;{const e=o;if(void 0!==e.matches)return e.matches(t);if(void 0!==e.msMatchesSelector)return e.msMatchesSelector(t);if(void 0!==e.webkitMatchesSelector)return e.webkitMatchesSelector(t);if(void 0!==e.mozMatchesSelector)return e.mozMatchesSelector(t);throw new Error("Browser lacks native selectors")}},V=e=>1!==e.nodeType&&9!==e.nodeType&&11!==e.nodeType||0===e.childElementCount,I=(e,t)=>e.dom===t.dom,j=$,q=(F=/^\s+|\s+$/g,e=>e.replace(F,""));var F;const H=e=>void 0!==e.style&&d(e.style.getPropertyValue),z=e=>{return S(e)?e:(t=e,L.fromDom(t.dom.ownerDocument));var t},K=e=>g.from(e.dom.parentNode).map(L.fromDom),U=(e,t)=>{const o=d(t)?t:u;let n=e.dom;const r=[];for(;null!==n.parentNode&&void 0!==n.parentNode;){const e=n.parentNode,t=L.fromDom(e);if(r.push(t),!0===o(t))break;n=e}return r},Y=e=>g.from(e.dom.previousSibling).map(L.fromDom),_=e=>g.from(e.dom.nextSibling).map(L.fromDom),G=e=>f(e.dom.childNodes,L.fromDom),J=e=>((e,t)=>{const o=e.dom.childNodes;return g.from(o[t]).map(L.fromDom)})(e,0),Q=e=>{const t=(e=>L.fromDom(e.dom.getRootNode()))(e);return x(o=t)&&a(o.dom.host)?g.some(t):g.none();var o},W=e=>L.fromDom(e.dom.host),X=e=>{const t=C(e)?e.dom.parentNode:e.dom;if(null==t||null===t.ownerDocument)return!1;const o=t.ownerDocument;return Q(L.fromDom(t)).fold((()=>o.body.contains(t)),(n=X,r=W,e=>n(r(e))));var n,r},Z=(e,t,o)=>{((e,t,o)=>{if(!r(o))throw console.error("Invalid call to CSS.set. Property ",t,":: Value ",o,":: Element ",e),new Error("CSS value must be a string: "+o);H(e)&&e.style.setProperty(t,o)})(e.dom,t,o)},ee=(e,t)=>{const o=e.dom,n=window.getComputedStyle(o).getPropertyValue(t);return""!==n||X(e)?n:te(o,t)},te=(e,t)=>H(e)?e.style.getPropertyValue(t):"",oe=(e,t)=>{const o=e.dom,n=te(o,t);return g.from(n).filter((e=>e.length>0))},ne=(e,t)=>{((e,t)=>{H(e)&&e.style.removeProperty(t)})(e.dom,t),((e,t,o=m)=>e.exists((e=>o(e,t))))(P(e,"style").map(q),"")&&R(e,"style")},re=(e,t)=>{K(e).each((o=>{o.dom.insertBefore(t.dom,e.dom)}))},se=(e,t)=>{_(e).fold((()=>{K(e).each((e=>{ae(e,t)}))}),(e=>{re(e,t)}))},ie=(e,t)=>{J(e).fold((()=>{ae(e,t)}),(o=>{e.dom.insertBefore(t.dom,o.dom)}))},ae=(e,t)=>{e.dom.appendChild(t.dom)},de=(e,t)=>{re(e,t),ae(t,e)},le=(e,t)=>{y(t,((o,n)=>{const r=0===n?e:t[n-1];se(r,o)}))},ce=(e,t)=>{y(t,(t=>{ae(e,t)}))},me=(e,t)=>{let o=[];return y(G(e),(e=>{t(e)&&(o=o.concat([e])),o=o.concat(me(e,t))})),o};const ue=(e,t,o)=>{let n=e.dom;const r=d(o)?o:u;for(;n.parentNode;){n=n.parentNode;const e=L.fromDom(n);if(t(e))return g.some(e);if(r(e))break}return g.none()},ge=e=>{const t=e.dom;null!==t.parentNode&&t.parentNode.removeChild(t)},pe=e=>{const t=G(e);t.length>0&&le(e,t),ge(e)},he=(e,t)=>((e,t)=>{const o=void 0===t?document:t.dom;return V(o)?[]:f(o.querySelectorAll(e),L.fromDom)})(t,e),fe=(e,t,o)=>ue(e,(e=>$(e,t)),o),ye=(e,t)=>((e,t)=>{const o=void 0===t?document:t.dom;return V(o)?g.none():g.from(o.querySelector(e)).map(L.fromDom)})(t,e),ve=(e,t,o)=>((e,t,o,n,r)=>e(o,n)?g.some(o):d(r)&&r(o)?g.none():t(o,n,r))(((e,t)=>$(e,t)),fe,e,t,o),we=((e,t)=>{const o=t=>e(t)?g.from(t.dom.nodeValue):g.none();return{get:n=>{if(!e(n))throw new Error("Can only get "+t+" value of a "+t+" node");return o(n).getOr("")},getOption:o,set:(o,n)=>{if(!e(o))throw new Error("Can only set raw "+t+" value of a "+t+" node");o.dom.nodeValue=n}}})(C,"text"),be=e=>we.get(e),Ne=(e,t)=>we.set(e,t);var Te=["body","p","div","article","aside","figcaption","figure","footer","header","nav","section","ol","ul","li","table","thead","tbody","tfoot","caption","tr","td","th","h1","h2","h3","h4","h5","h6","blockquote","pre","address"];const Ae=(e,t)=>({element:e,offset:t}),Ce=(e,t,o)=>e.property().isText(t)&&0===e.property().getText(t).trim().length||e.property().isComment(t)?o(t).bind((t=>Ce(e,t,o).orThunk((()=>g.some(t))))):g.none(),Se=(e,t)=>{if(e.property().isText(t))return e.property().getText(t).length;return e.property().children(t).length},xe=(e,t)=>{const o=Ce(e,t,e.query().prevSibling).getOr(t);if(e.property().isText(o))return Ae(o,Se(e,o));const n=e.property().children(o);return n.length>0?xe(e,n[n.length-1]):Ae(o,Se(e,o))},De=xe,Ee={up:c({selector:fe,closest:ve,predicate:ue,all:U}),down:c({selector:he,predicate:me}),styles:c({get:ee,getRaw:oe,set:Z,remove:ne}),attrs:c({get:M,set:E,remove:R,copyTo:(e,t)=>{const o=k(e);O(t,o)}}),insert:c({before:re,after:se,afterAll:le,append:ae,appendAll:ce,prepend:ie,wrap:de}),remove:c({unwrap:pe,remove:ge}),create:c({nu:L.fromTag,clone:e=>L.fromDom(e.dom.cloneNode(!1)),text:L.fromText}),query:c({comparePosition:(e,t)=>e.dom.compareDocumentPosition(t.dom),prevSibling:Y,nextSibling:_}),property:c({children:G,name:w,parent:K,document:e=>z(e).dom,isText:C,isComment:T,isElement:A,isSpecial:e=>{const t=w(e);return h(["script","noscript","iframe","noframes","noembed","title","style","textarea","xmp"],t)},getLanguage:e=>A(e)?P(e,"lang"):g.none(),getText:be,setText:Ne,isBoundary:e=>!!A(e)&&("body"===w(e)||h(Te,w(e))),isEmptyTag:e=>!!A(e)&&h(["br","img","hr","input"],w(e)),isNonEditable:e=>A(e)&&"false"===M(e,"contenteditable")}),eq:I,is:j},Oe="details",Me="mce-accordion",Pe="mce-accordion-summary",Re="mce-accordion-body",ke="div";var Be=tinymce.util.Tools.resolve("tinymce.util.Tools");const Le=e=>"SUMMARY"===(null==e?void 0:e.nodeName),$e=e=>"DETAILS"===(null==e?void 0:e.nodeName),Ve=e=>e.hasAttribute("open"),Ie=e=>{const t=e.selection.getNode();return Le(t)||Boolean(e.dom.getParent(t,Le))},je=e=>!Ie(e)&&e.dom.isEditable(e.selection.getNode())&&!e.mode.isReadOnly(),qe=e=>g.from(e.dom.getParent(e.selection.getNode(),$e)),Fe=e=>(e.innerHTML='<br data-mce-bogus="1" />',e),He=e=>Fe(e.dom.create("p")),ze=(e,t)=>{if(!Le(null==t?void 0:t.firstChild)){const o=(e=>Fe(e.dom.create("summary")))(e);t.prepend(o),e.selection.setCursorLocation(o,0)}},Ke=e=>t=>{((e,t)=>{if(Le(null==t?void 0:t.lastChild)){const o=He(e);t.appendChild(o),e.selection.setCursorLocation(o,0)}})(e,t),ze(e,t)},Ue=e=>{if(!je(e))return;const t=L.fromDom(e.getBody()),n=o("acc"),r=e.dom.encode(e.selection.getRng().toString()||e.translate("Accordion summary...")),s=e.dom.encode(e.translate("Accordion body...")),i=`<summary class="${Pe}">${r}</summary>`,a=`<${ke} class="${Re}"><p>${s}</p></${ke}>`;e.undoManager.transact((()=>{e.insertContent([`<details data-mce-id="${n}" class="${Me}" open="open">`,i,a,"</details>"].join("")),ye(t,`[data-mce-id="${n}"]`).each((t=>{R(t,"data-mce-id"),ye(t,"summary").each((t=>{const o=e.dom.createRng(),n=De(Ee,t);o.setStart(n.element.dom,n.offset),o.setEnd(n.element.dom,n.offset),e.selection.setRng(o)}))}))}))},Ye=(e,t)=>{const o=null!=t?t:!Ve(e);return o?e.setAttribute("open","open"):e.removeAttribute("open"),o},_e=e=>{e.mode.isReadOnly()||qe(e).each((t=>{const{nextSibling:o}=t;o?(e.selection.select(o,!0),e.selection.collapse(!0)):((e,t)=>{const o=He(e);t.insertAdjacentElement("afterend",o),e.selection.setCursorLocation(o,0)})(e,t),t.remove()}))},Ge=e=>{e.addCommand("InsertAccordion",(()=>Ue(e))),e.addCommand("ToggleAccordion",((t,o)=>((e,t)=>{qe(e).each((o=>{((e,t,o)=>{e.dispatch("ToggledAccordion",{element:t,state:o})})(e,o,Ye(o,t))}))})(e,o))),e.addCommand("ToggleAllAccordions",((t,o)=>((e,t)=>{const o=Array.from(e.getBody().querySelectorAll("details"));0!==o.length&&(y(o,(e=>Ye(e,null!=t?t:!Ve(e)))),((e,t,o)=>{e.dispatch("ToggledAllAccordions",{elements:t,state:o})})(e,o,t))})(e,o))),e.addCommand("RemoveAccordion",(()=>_e(e)))};var Je=tinymce.util.Tools.resolve("tinymce.html.Node");const Qe=e=>{var t,o;return null!==(o=null===(t=e.attr("class"))||void 0===t?void 0:t.split(" "))&&void 0!==o?o:[]},We=(e,t)=>{const o=new Set([...Qe(e),...t]),n=Array.from(o);n.length>0&&e.attr("class",n.join(" "))},Xe=(e,t)=>{const o=((e,t)=>{const o=[];for(let n=0,r=e.length;n<r;n++){const r=e[n];t(r,n)&&o.push(r)}return o})(Qe(e),(e=>!t.has(e)));e.attr("class",o.length>0?o.join(" "):null)},Ze=e=>e.name===Oe&&h(Qe(e),Me),et=e=>{const t=e.children();let o,n;const r=[];for(let e=0;e<t.length;e++){const a=t[e];"summary"===a.name&&i(o)?o=a:(s=a).name===ke&&h(Qe(s),Re)&&i(n)?n=a:r.push(a)}var s;return{summaryNode:o,wrapperNode:n,otherNodes:r}},tt=e=>{const t=new Je("br",1);t.attr("data-mce-bogus","1"),e.empty(),e.append(t)};var ot=tinymce.util.Tools.resolve("tinymce.util.VK");const nt=e=>{e.on("keydown",(t=>{(!t.shiftKey&&t.keyCode===ot.ENTER&&Ie(e)||(e=>{const t=e.selection.getRng();return $e(t.startContainer)&&t.collapsed&&0===t.startOffset})(e))&&(t.preventDefault(),e.execCommand("ToggleAccordion"))}))},rt=e=>{nt(e),e.on("ExecCommand",(t=>{const o=t.command.toLowerCase();"delete"!==o&&"forwarddelete"!==o||!(e=>qe(e).isSome())(e)||(e=>{Be.each(Be.grep(e.dom.select("details",e.getBody())),Ke(e))})(e)}))};var st=tinymce.util.Tools.resolve("tinymce.Env");const it=e=>t=>{const o=()=>t.setEnabled(je(e));return e.on("NodeChange",o),()=>e.off("NodeChange",o)};e.add("accordion",(e=>{(e=>{const t=()=>e.execCommand("InsertAccordion");e.ui.registry.addButton("accordion",{icon:"accordion",tooltip:"Insert accordion",onSetup:it(e),onAction:t}),e.ui.registry.addMenuItem("accordion",{icon:"accordion",text:"Accordion",onSetup:it(e),onAction:t}),e.ui.registry.addToggleButton("accordiontoggle",{icon:"accordion-toggle",tooltip:"Toggle accordion",onAction:()=>e.execCommand("ToggleAccordion")}),e.ui.registry.addToggleButton("accordionremove",{icon:"remove",tooltip:"Delete accordion",onAction:()=>e.execCommand("RemoveAccordion")}),e.ui.registry.addContextToolbar("accordion",{predicate:t=>e.dom.is(t,"details")&&e.getBody().contains(t)&&e.dom.isEditable(t.parentNode),items:"accordiontoggle accordionremove",scope:"node",position:"node"})})(e),Ge(e),rt(e),(e=>{e.on("PreInit",(()=>{const{serializer:t,parser:o}=e;o.addNodeFilter(Oe,(e=>{for(let t=0;t<e.length;t++){const o=e[t];if(Ze(o)){const e=o,{summaryNode:t,wrapperNode:n,otherNodes:r}=et(e),s=a(t),d=s?t:new Je("summary",1);i(d.firstChild)&&tt(d),We(d,[Pe]),s||(a(e.firstChild)?e.insert(d,e.firstChild,!0):e.append(d));const l=a(n),c=l?n:new Je(ke,1);if(c.attr("data-mce-bogus","1"),We(c,[Re]),r.length>0)for(let e=0;e<r.length;e++){const t=r[e];c.append(t)}if(i(c.firstChild)){const e=new Je("p",1);tt(e),c.append(e)}l||e.append(c)}}})),t.addNodeFilter(Oe,(e=>{const t=new Set([Pe]);for(let o=0;o<e.length;o++){const n=e[o];if(Ze(n)){const e=n,{summaryNode:o,wrapperNode:r}=et(e);a(o)&&Xe(o,t),a(r)&&r.unwrap()}}}))}))})(e),(e=>{st.browser.isSafari()&&e.on("click",(t=>{if(Le(t.target)){const o=t.target,n=e.selection.getRng();n.collapsed&&n.startContainer===o.parentNode&&0===n.startOffset&&e.selection.setCursorLocation(o,0)}}))})(e)}))}();