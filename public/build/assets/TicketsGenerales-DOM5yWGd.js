import{_ as u}from"./AuthenticatedLayout-hhq0HCAA.js";import{_ as h}from"./Pagination-BLeFNnWs.js";import{l as w,c as r,a as c,u as f,w as x,F as b,o,d as m,e,b as _,q as k,t as a,g as v}from"./app-BntOCUSP.js";const F={class:"flex space-x-6 mb-4 m-5"},C={class:"overflow-x-auto"},E={class:"min-w-full whitespace-no-wrap"},j={class:"border-b border-gray-200 bg-white px-5 py-5 text-sm"},B={class:"text-gray-900 whitespace-no-wrap"},D={class:"border-b border-gray-200 bg-white px-5 py-5 text-sm"},z={class:"text-gray-900 whitespace-no-wrap"},N={class:"border-b border-gray-200 bg-white px-5 py-5 text-sm"},T={class:"text-gray-900 whitespace-no-wrap"},$={class:"border-b border-gray-200 bg-white px-5 py-5 text-sm"},L={class:"text-gray-900 whitespace-no-wrap"},M={class:"border-b border-gray-200 bg-white px-5 py-5 text-sm"},P={class:"text-gray-900 whitespace-no-wrap"},S={class:"border-b border-gray-200 bg-white px-5 py-5 text-sm"},V={class:"text-gray-900 whitespace-no-wrap"},A={class:"border-b border-gray-200 bg-white px-5 py-5 text-sm"},Z={key:0,class:"bg-green-500 text-white py-1 px-3 rounded-full text-xs"},q={key:1,class:"bg-orange-500 text-white py-1 px-3 rounded-full text-xs"},G={key:2,class:"bg-red-500 text-white py-1 px-3 rounded-full text-xs"},H={key:3,class:"bg-gray-300 text-white py-1 px-3 rounded-full text-xs"},I={class:"border-b border-gray-200 bg-white px-5 py-5 text-sm"},O={class:"flex justify-center space-x-3"},U=["href"],J={class:"flex flex-col items-center border-t bg-white px-5 py-5 xs:flex-row xs:justify-between"},W={__name:"TicketsGenerales",props:{incidencias:Object},setup(p){const d=p,i=w(d.incidencias.data),g=n=>{const t={day:"2-digit",month:"2-digit",year:"numeric"};return new Date(n).toLocaleDateString("es-ES",t)},l=n=>{i.value=d.incidencias.data.filter(t=>t.estado===n)},y=()=>{i.value=d.incidencias.data};return(n,t)=>(o(),r(b,null,[c(f(m),{title:"Users"}),c(u,null,{header:x(()=>t[3]||(t[3]=[e("div",{class:"text-center w-full mb-4"},[e("h1",{class:"font-semibold mb-5"},"Lista de incidencias"),e("hr",{class:"my-2 border-t-1 border-gray-900 w-full mx-auto"})],-1)])),default:x(()=>[t[6]||(t[6]=e("div",{class:"rounded-t mb-0 px-6 py-2"},[e("div",{class:"text-center flex justify-between"},[e("a",{href:"ticketcreate",class:"bg-emerald-500 text-white active:bg-emerald-600 font-bold uppercase text-m px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150 flex items-center"},[e("svg",{class:"w-4 h-4 mr-2","aria-hidden":"true",xmlns:"http://www.w3.org/2000/svg",width:"24",height:"24",fill:"none",viewBox:"0 0 24 24"},[e("path",{stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"})]),_(" Agregar ")])])],-1)),e("div",F,[e("button",{class:"bg-blue-500 text-white px-4 py-2 rounded focus:outline-none",onClick:t[0]||(t[0]=s=>l("Pendiente"))}," Pendiente "),e("button",{class:"bg-orange-500 text-white px-4 py-2 rounded focus:outline-none",onClick:t[1]||(t[1]=s=>l("En proceso"))}," En curso "),e("button",{class:"bg-green-500 text-white px-4 py-2 rounded focus:outline-none",onClick:t[2]||(t[2]=s=>l("Finalizada"))}," Finalizado "),e("button",{class:"bg-gray-500 text-white px-4 py-2 rounded focus:outline-none",onClick:y}," Todos ")]),e("div",C,[e("table",E,[t[5]||(t[5]=e("thead",null,[e("tr",{class:"border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500"},[e("th",{class:"border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"}," Fecha de creación "),e("th",{class:"border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"}," Titulo "),e("th",{class:"border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"}," Descripción "),e("th",{class:"border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"}," Dependencia solicitante "),e("th",{class:"border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"}," Tipo de incidencia "),e("th",{class:"border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"}," Nivel de prioridad "),e("th",{class:"border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"}," Estado "),e("th",{class:"border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"}," Acciones ")])],-1)),e("tbody",null,[(o(!0),r(b,null,k(i.value,s=>(o(),r("tr",{key:s.id,class:"text-gray-700"},[e("td",j,[e("p",B,a(g(s.created_at)),1)]),e("td",D,[e("p",z,a(s.titulo),1)]),e("td",N,[e("p",T,a(s.descripcion),1)]),e("td",$,[e("p",L,a(s.dependencia),1)]),e("td",M,[e("p",P,a(s.tipo_incidencia),1)]),e("td",S,[e("p",V,a(s.criticidad),1)]),e("td",A,[s.estado==="Finalizada"?(o(),r("span",Z," Finalizado ")):s.estado==="En proceso"?(o(),r("span",q," En curso ")):s.estado==="Pendiente"?(o(),r("span",G," Pendiente ")):(o(),r("span",H,a(s.estado),1))]),e("td",I,[e("div",O,[s.estado!=="Finalizada"?(o(),r("a",{key:0,href:n.route("ticket.show",{incidencia:s.id}),class:"text-blue-500 hover:text-blue-700"},t[4]||(t[4]=[e("svg",{class:"w-6 h-6 text-gray-800 dark:text-white","aria-hidden":"true",xmlns:"http://www.w3.org/2000/svg",width:"24",height:"24",fill:"none",viewBox:"0 0 24 24"},[e("path",{stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"})],-1)]),8,U)):v("",!0)])])]))),128))])])]),e("div",J,[c(h,{links:p.incidencias.links},null,8,["links"])])]),_:1})],64))}};export{W as default};
