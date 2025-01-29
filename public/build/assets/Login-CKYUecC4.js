import{h as k,i as v,v as _,o as m,c as d,C as h,a,u as t,w as n,F as V,d as C,P as p,t as B,g as f,e as l,j as $,b as g,n as L,f as P}from"./app-BntOCUSP.js";import{G as F,A as N}from"./ApplicationLogo-b122F7Hb.js";import{_ as w,a as x,b as y}from"./TextInput-BhEvPjMG.js";import{_ as U}from"./PrimaryButton-CL-wZN6_.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const j=["value"],q={__name:"Checkbox",props:{checked:{type:[Array,Boolean],default:!1},value:{default:null}},emits:["update:checked"],setup(r,{emit:s}){const i=s,u=r,e=k({get(){return u.checked},set(o){i("update:checked",o)}});return(o,c)=>v((m(),d("input",{type:"checkbox",value:r.value,"onUpdate:modelValue":c[0]||(c[0]=b=>e.value=b),class:"text-indigo-600"},null,8,j)),[[_,e.value]])}},A={key:0,class:"mb-4 text-sm font-medium text-green-600"},R={class:"mt-3"},S={class:"mt-4 flex justify-between"},D={class:"inline-flex items-center"},E={class:"mt-6"},I={__name:"Login",props:{canResetPassword:{type:Boolean},status:{type:String}},setup(r){const s=h({email:"",password:"",remember:!1}),i=()=>{s.post(route("login"),{onFinish:()=>s.reset("password")})};return(u,e)=>(m(),d(V,null,[a(t(C),{title:"Log in"}),a(F,null,{default:n(()=>[a(t(p),{href:"/",class:"flex items-center justify-center"},{default:n(()=>[a(N,{class:"h-20 w-20 fill-current text-gray-500"})]),_:1}),r.status?(m(),d("div",A,B(r.status),1)):f("",!0),l("form",{onSubmit:P(i,["prevent"])},[l("div",null,[a(w,{for:"email",value:"Email"}),a(x,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:t(s).email,"onUpdate:modelValue":e[0]||(e[0]=o=>t(s).email=o),required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),a(y,{class:"mt-2",message:t(s).errors.email},null,8,["message"])]),l("div",R,[a(w,{for:"password",value:"Password"}),a(x,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:t(s).password,"onUpdate:modelValue":e[1]||(e[1]=o=>t(s).password=o),required:"",autocomplete:"current-password"},null,8,["modelValue"]),a(y,{class:"mt-2",message:t(s).errors.password},null,8,["message"])]),l("div",S,[l("label",D,[a(q,{name:"remember",checked:t(s).remember,"onUpdate:checked":e[2]||(e[2]=o=>t(s).remember=o)},null,8,["checked"]),e[3]||(e[3]=l("span",{class:"mx-2 text-sm text-gray-600"},"Remember me",-1))]),r.canResetPassword?(m(),$(t(p),{key:0,href:u.route("password.request"),class:"text-sm text-gray-600 underline hover:text-gray-900"},{default:n(()=>e[4]||(e[4]=[g(" Forgot your password? ")])),_:1},8,["href"])):f("",!0)]),l("div",E,[a(U,{class:L(["w-full",{"opacity-25":t(s).processing}]),disabled:t(s).processing},{default:n(()=>e[5]||(e[5]=[g(" Log in ")])),_:1},8,["class","disabled"])])],32)]),_:1})],64))}};export{I as default};
