System.register(["./vendor-legacy-a194f484.js"],(function(e,t){"use strict";var n,r,o,i,a,s,c,l,u,d,f,m,h,g,p,b,y,N;return{setters:[e=>{n=e.b$,r=e.c0,o=e.a1,i=e.r,a=e.c1,s=e.c2,c=e.c3,l=e.c4,u=e.j,d=e.o,f=e.c5,m=e.c6,h=e.c7,g=e.c8,p=e.c9,b=e.ca,y=e.cb,N=e.cc}],execute:function(){function t(e){return n("MuiMasonry",e)}r("MuiMasonry",["root"]);const x=["children","className","component","columns","spacing","defaultColumns","defaultHeight","defaultSpacing"],S=e=>Number(e.replace("px","")),v={flexBasis:"100%",width:0,margin:0,padding:0},w=o("div",{name:"MuiMasonry",slot:"Root",overridesResolver:(e,t)=>[t.root]})((({ownerState:e,theme:t})=>{let n={width:"100%",display:"flex",flexFlow:"column wrap",alignContent:"flex-start",boxSizing:"border-box","& > *":{boxSizing:"border-box"}};const r={};if(e.isSSR){const o={},i=S(t.spacing(e.defaultSpacing));for(let t=1;t<=e.defaultColumns;t+=1)o[`&:nth-of-type(${e.defaultColumns}n+${t%e.defaultColumns})`]={order:t};return r.height=e.defaultHeight,r.margin=-i/2,r["& > *"]=c({},n["& > *"],o,{margin:i/2,width:`calc(${(100/e.defaultColumns).toFixed(2)}% - ${i}px)`}),c({},n,r)}const o=h({values:e.spacing,breakpoints:t.breakpoints.values}),i=g(t);n=p(n,b({theme:t},o,(t=>{let n;if("string"==typeof t&&!Number.isNaN(Number(t))||"number"==typeof t){const e=Number(t);n=y(i,e)}else n=t;return c({margin:`calc(0px - (${n} / 2))`,"& > *":{margin:`calc(${n} / 2)`}},e.maxColumnHeight&&{height:"number"==typeof n?Math.ceil(e.maxColumnHeight+S(n)):`calc(${e.maxColumnHeight}px + ${n})`})})));const a=h({values:e.columns,breakpoints:t.breakpoints.values});return n=p(n,b({theme:t},a,(e=>({"& > *":{width:`calc(${(100/Number(e)).toFixed(2)}% - ${"string"==typeof o&&!Number.isNaN(Number(o))||"number"==typeof o?y(i,Number(o)):"0px"})`}})))),"object"==typeof o&&(n=p(n,b({theme:t},o,((e,t)=>{if(t){const n=Number(e),r=Object.keys(a).pop(),o=y(i,n);return{"& > *":{width:`calc(${(100/("object"==typeof a?a[t]||a[r]:a)).toFixed(2)}% - ${o})`}}}return null})))),n}));e("M",i.forwardRef((function(e,n){const r=a({props:e,name:"MuiMasonry"}),{children:o,className:h,component:g="div",columns:p=4,spacing:b=1,defaultColumns:y,defaultHeight:M,defaultSpacing:C}=r,$=s(r,x),R=i.useRef(),[H,k]=i.useState(),E=!H&&M&&void 0!==y&&void 0!==C,[j,O]=i.useState(E?y-1:0),z=c({},r,{spacing:b,columns:p,maxColumnHeight:H,defaultColumns:y,defaultHeight:M,defaultSpacing:C,isSSR:E}),F=(e=>{const{classes:n}=e;return m({root:["root"]},t,n)})(z),T=i.useRef("undefined"==typeof ResizeObserver?void 0:new ResizeObserver((e=>{if(!R.current||!e||0===e.length)return;const t=R.current,n=R.current.firstChild,r=t.clientWidth,o=n.clientWidth;if(0===r||0===o)return;const i=window.getComputedStyle(n),a=S(i.marginLeft),s=S(i.marginRight),c=Math.round(r/(o+a+s)),l=new Array(c).fill(0);let u=!1;t.childNodes.forEach((e=>{if(e.nodeType!==Node.ELEMENT_NODE||"line-break"===e.dataset.class||u)return;const t=window.getComputedStyle(e),n=S(t.marginTop),r=S(t.marginBottom),o=S(t.height)?Math.ceil(S(t.height))+n+r:0;if(0!==o){for(let t=0;t<e.childNodes.length;t+=1){const n=e.childNodes[t];if("IMG"===n.tagName&&0===n.clientHeight){u=!0;break}}if(!u){const t=l.indexOf(Math.min(...l));l[t]+=o;const n=t+1;e.style.order=n}}else u=!0})),u||N.flushSync((()=>{k(Math.max(...l)),O(c>0?c-1:0)}))})));i.useEffect((()=>{const e=T.current;if(void 0!==e)return R.current&&R.current.childNodes.forEach((t=>{e.observe(t)})),()=>e?e.disconnect():{}}),[p,b,o]);const A=l(n,R),B=new Array(j).fill("").map(((e,t)=>u("span",{"data-class":"line-break",style:c({},v,{order:t+1})},t)));return d(w,c({as:g,className:f(F.root,h),ref:A,ownerState:z},$,{children:[o,B]}))})))}}}));