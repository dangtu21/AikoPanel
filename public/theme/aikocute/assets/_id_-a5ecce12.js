import{k as o,bW as c,r as g,l,j as s,bJ as i,ai as m,aK as r}from"./vendor-894d6afa.js";import{n as d,M as p,b as x}from"./index-33033ac6.js";import{E as f}from"./index.es-8e82e15c.js";const h=()=>{const{i18n:e}=o(),n=c(),t=g.useMemo(()=>!l.isEmpty(n.id)&&n.id?parseInt(n.id):null,[n.id]);return d({id:t,language:e.language},{skip:!t})},k=({postId:e})=>{const{i18n:n}=o(),{data:t,isLoading:a}=d({id:e||0,language:n.language},{skip:!e});return s(p,{title:a||!t?s(i,{variant:"text",sx:{fontSize:"1.5rem"}}):t.title,children:s(m,{spacing:1,children:a||!t?l.times(5,u=>s(i,{variant:"text",sx:{fontSize:"1rem"}},u)):s(f,{children:t.body})})})},w=()=>{const{data:e}=h();return x((e==null?void 0:e.title)||"Loading...",[e]),s(r,{container:!0,children:s(r,{item:!0,xs:12,children:s(k,{postId:(e==null?void 0:e.id)||null})})})};export{w as default};