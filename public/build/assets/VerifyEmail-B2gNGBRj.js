import{C as g,h as y,c as r,a as t,u as s,w as i,F as v,o as n,d as x,P as l,e as o,g as b,n as h,b as d,f as _}from"./app-BntOCUSP.js";import{G as k,A as w}from"./ApplicationLogo-b122F7Hb.js";import{_ as V}from"./PrimaryButton-CL-wZN6_.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const B={key:0,class:"mb-4 text-sm font-medium text-green-600"},C={class:"mt-4 flex items-center justify-between"},A={__name:"VerifyEmail",props:{status:{type:String}},setup(u){const m=u,a=g(),f=()=>{a.post(route("verification.send"))},c=y(()=>m.status==="verification-link-sent");return(p,e)=>(n(),r(v,null,[t(s(x),{title:"Email Verification"}),t(k,null,{default:i(()=>[t(s(l),{href:"/",class:"mb-4 flex items-center justify-center"},{default:i(()=>[t(w,{class:"h-20 w-20 fill-current text-gray-500"})]),_:1}),e[2]||(e[2]=o("div",{class:"mb-4 text-sm text-gray-600"}," Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another. ",-1)),c.value?(n(),r("div",B," A new verification link has been sent to the email address you provided during registration. ")):b("",!0),o("form",{onSubmit:_(f,["prevent"])},[o("div",C,[t(V,{class:h({"opacity-25":s(a).processing}),disabled:s(a).processing},{default:i(()=>e[0]||(e[0]=[d(" Resend Verification Email ")])),_:1},8,["class","disabled"]),t(s(l),{href:p.route("logout"),method:"post",as:"button",class:"text-sm text-gray-600 underline hover:text-gray-900"},{default:i(()=>e[1]||(e[1]=[d(" Log Out ")])),_:1},8,["href"])])],32)]),_:1})],64))}};export{A as default};
