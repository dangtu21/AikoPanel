System.register(["./vendor-legacy-a194f484.js","./AuthWrapper-legacy-8f02bdff.js","./formik.esm-legacy-a3c75cf9.js","./password-strength-legacy-b0b499a5.js","./index-legacy-3a6f8cc6.js","./AnimateButton-legacy-300e3bb6.js","./useQuery-legacy-3ddb01b9.js","./hey-listen.es-legacy-2cf185e9.js"],(function(e,i){"use strict";var r,t,s,n,o,a,l,d,c,m,p,u,g,h,_,v,b,w,f,y,x,S,q,C,B,j,F,W,A,k,E,I,P,z,D,K,M,O,R,V,$,H,Q,T,G;return{setters:[e=>{r=e.i,t=e.bb,s=e.aa,n=e.k,o=e.a9,a=e.r,l=e.j,d=e.F,c=e.a_,m=e.l,p=e.B,u=e.o,g=e.aK,h=e.ai,_=e.bc,v=e.ao,b=e.bd,w=e.be,f=e.bf,y=e.bg,x=e.bh,S=e.bs,q=e.T,C=e.bt,B=e.bu,j=e.aH,F=e.m,W=e.bi,A=e.ap},e=>{k=e.A},e=>{E=e.c,I=e.a,P=e.b,z=e.d,D=e.F},e=>{K=e.S,M=e.O,O=e.s,R=e.a},e=>{V=e.d,$=e.e,H=e.I,Q=e.b},e=>{T=e.A},e=>{G=e.u},null],execute:function(){const i=()=>{const e=r(),i=t(),k=s(),{t:Q}=n("common"),{enqueueSnackbar:J}=o(),L=G(),[N]=V(),{data:U}=$(),[X,Y]=a.useState(),[Z,ee]=a.useState(!1),ie=()=>{ee(!Z)},re=e=>{e.preventDefault()},te=e=>{const i=O(e);Y(R(i))};a.useEffect((()=>{te("")}),[]);const se=a.useMemo((()=>E().shape({email:I().email(Q("register.email_invalid").toString()).max(255,Q("register.email_max",{count:255}).toString()).required(Q("register.email_required").toString()),password:I().min(8,Q("register.password_min",{count:8}).toString()).max(255,Q("register.password_max",{count:255}).toString()).required(Q("register.password_required").toString()),password_confirm:I().oneOf([P("password"),null],Q("register.password_confirm_invalid").toString()).required(Q("register.password_confirm_required").toString()),invite_code:U?.is_invite_force?I().max(8,Q("register.invite_code_max").toString()).required(Q("register.invite_code_required").toString()):I().max(8,Q("register.invite_code_max").toString()),email_code:U?.is_email_verify?z().max(6,Q("register.email_code_max").toString()).required(Q("register.email_code_required").toString()):z().negative()})),[Q,U?.is_invite_force,U?.is_email_verify]);return l(d,{children:l(D,{initialValues:{email:"",password:"",password_confirm:"",invite_code:L.get("code")??"",email_code:"",agree:!1,submit:null},validationSchema:se,onSubmit:async(e,{setErrors:r,setStatus:t,setSubmitting:s})=>{if(!e.agree)return t({success:!1}),r({submit:Q("register.agree_required").toString()}),void s(!1);try{await N({email:e.email,password:e.password,invite_code:e.invite_code,email_code:U?.is_email_verify?e.email_code:""}).unwrap().then((()=>{t({success:!0}),J(Q("notice::register_success"),{variant:"success"}),k("/dashboard",{replace:!0}),c.event("register",{category:"auth",label:"register",method:"email",success:!0,email:e.email,password_strength:X?.label,invite_code:e.invite_code})}),(i=>{t({success:!1}),r(m.isEmpty(i.errors)?{submit:i.message}:i.errors),c.event("register",{category:"auth",label:"register",method:"email",success:!1,error:i.message,email:e.email,values:e})}))}catch(n){console.error(n),i.current&&(t({success:!1}),r(m.isEmpty(n.errors)?{submit:n.message}:n.errors))}finally{s(!1)}},children:({errors:i,handleBlur:r,handleChange:t,handleSubmit:s,isSubmitting:n,touched:o,values:a,setValues:c})=>l(p,{component:"form",onSubmit:s,children:u(g,{container:!0,spacing:3,children:[l(g,{item:!0,xs:12,children:u(h,{spacing:1,children:[l(_,{htmlFor:"email",children:l(v,{children:"register.email"})}),l(b,{fullWidth:!0,error:Boolean(o.email&&i.email),id:"email",type:"email",value:a.email,name:"email",onBlur:r,onChange:t,placeholder:"user@example.com",inputProps:{},endAdornment:1===U?.is_email_verify?l(K,{email:a.email}):void 0}),o.email&&i.email&&l(w,{error:!0,id:"helper-text-email-signup",children:i.email})]})}),1===U?.is_email_verify&&l(d,{children:l(g,{item:!0,xs:12,children:u(h,{spacing:1,children:[l(_,{htmlFor:"email-code-signup",children:l(v,{children:"register.email_code"})}),l(M,{value:a.email_code,onChange:e=>{c((i=>({...i,email_code:e})))},numInputs:6,containerStyle:{justifyContent:"space-between"},inputStyle:{width:"100%",margin:"8px",padding:"10px",border:`1px solid ${"dark"===e.palette.mode?e.palette.grey[200]:e.palette.grey[300]}`,borderRadius:4,":hover":{borderColor:e.palette.primary.main}},focusStyle:{outline:"none",boxShadow:e.customShadows.primary,border:`1px solid ${e.palette.primary.main}`}}),o.email_code&&i.email_code&&l(w,{error:!0,id:"helper-text-email-signup",children:i.email_code})]})})}),u(g,{item:!0,xs:12,children:[u(h,{spacing:1,children:[l(_,{htmlFor:"password-signup",children:l(v,{children:"register.password"})}),l(b,{fullWidth:!0,error:Boolean(o.password&&i.password),id:"password-signup",type:Z?"text":"password",value:a.password,name:"password",onBlur:r,onChange:e=>{t(e),te(e.target.value)},autoComplete:"new-password",endAdornment:l(f,{position:"end",children:l(H,{"aria-label":"toggle password visibility",onClick:ie,onMouseDown:re,edge:"end",color:"secondary",children:l(Z?y:x,{})})}),placeholder:"******",inputProps:{}}),o.password&&i.password&&l(w,{error:!0,id:"helper-text-password-signup",children:i.password})]}),l(S,{fullWidth:!0,sx:{mt:2},children:u(g,{container:!0,spacing:2,alignItems:"center",children:[l(g,{item:!0,children:l(p,{sx:{bgcolor:X?.color,width:85,height:8,borderRadius:"7px"}})}),l(g,{item:!0,children:l(q,{variant:"subtitle1",fontSize:"0.75rem",children:Q("register.password_strength",{context:m.lowerCase(X?.label)}).toString()})})]})})]}),l(g,{item:!0,xs:12,children:u(h,{spacing:1,children:[l(_,{htmlFor:"password-confirm",children:l(v,{children:"register.password_confirm"})}),l(b,{fullWidth:!0,error:Boolean(o.password_confirm&&i.password_confirm),id:"password-confirm",type:Z?"text":"password",value:a.password_confirm,name:"password_confirm",onBlur:r,onChange:e=>{t(e),te(e.target.value)},autoComplete:"new-password",placeholder:"******",inputProps:{}}),o.password_confirm&&i.password_confirm&&l(w,{error:!0,id:"helper-text-password-confirm",children:i.password_confirm})]})}),l(g,{item:!0,xs:12,children:u(h,{spacing:1,children:[l(_,{htmlFor:"invite-code-signup",required:1===U?.is_invite_force,children:l(v,{children:"register.invite_code"})}),l(b,{fullWidth:!0,error:Boolean(o.invite_code&&i.invite_code),id:"invite-code-signup",type:"text",value:a.invite_code,name:"invite_code",onBlur:r,onChange:t,required:1===U?.is_invite_force,placeholder:Q("register.invite_code_placeholder",{context:1===U?.is_invite_force?"required":"optional"}).toString(),inputProps:{},disabled:null!==L.get("code")}),o.invite_code&&i.invite_code&&l(w,{error:!0,id:"helper-text-email-signup",children:i.invite_code})]})}),l(g,{item:!0,xs:12,children:l(C,{value:!1,control:l(B,{}),name:"agree",id:"agree",onBlur:r,onChange:t,"aria-required":!0,sx:{alignItems:"flex-start"},label:l(q,{variant:"body2",children:u(v,{i18nKey:"register.license_agree",children:[l(j,{id:"terms-of-service",variant:"subtitle2",component:F,to:"/terms-of-service"}),l(j,{id:"privacy-policy",variant:"subtitle2",component:F,to:"/privacy-policy"})]})})})}),i.submit&&l(g,{item:!0,xs:12,children:l(w,{error:!0,children:i.submit})}),l(g,{item:!0,xs:12,children:l(T,{children:l(W,{disableElevation:!0,disabled:n,fullWidth:!0,size:"large",type:"submit",variant:"contained",color:"primary",children:n?l(A,{size:24,color:"inherit"}):l(v,{children:"register.submit"})})})})]})})})})};e("default",(()=>(Q("register"),l(k,{children:u(g,{container:!0,spacing:3,children:[l(g,{item:!0,xs:12,children:u(h,{direction:"row",justifyContent:"space-between",alignItems:"baseline",sx:{mb:{xs:-.5,sm:.5}},children:[l(q,{variant:"h3",children:l(v,{children:"register.title"})}),l(q,{component:F,to:"/login",variant:"body1",sx:{textDecoration:"none"},color:"primary",children:l(v,{children:"register.go-login"})})]})}),l(g,{item:!0,xs:12,children:l(i,{})})]})}))))}}}));