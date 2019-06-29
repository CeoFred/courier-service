if(!FDX){var FDX={}
}FDX.LOGINCHECK={userAuthenticated:false,loginUserCheck:function(){var a=FDX.LOGINCHECK.checkCookie("fdx_login");
var b=FDX.LOGINCHECK.checkCookie("fcl_contactname");
if(a&&b){FDX.LOGINCHECK.userAuthenticated=true;
localStorage.setItem("userAuthenticated",FDX.LOGINCHECK.userAuthenticated)
}else{FDX.LOGINCHECK.userAuthenticated=false;
localStorage.setItem("userAuthenticated",FDX.LOGINCHECK.userAuthenticated)
}},checkCookie:function(b){var e=b+"=";
var a=document.cookie.split(";");
for(var d=0;
d<a.length;
d++){var f=a[d];
while(f.charAt(0)==" "){f=f.substring(1,f.length)
}if(f.indexOf(e)==0){return f.substring(e.length,f.length)
}}return null
}};
if(typeof(FDX)!=="undefined"&&FDX.DATALAYER.page.pageInfo.securePage!==null&&FDX.DATALAYER.page.pageInfo.securePage==="true"&&localStorage.getItem("userAuthenticated")!=="true"){FDX.LOGINCHECK.loginUserCheck()
}$(document).ready(function(){});
if(!FDX){var FDX={}
}FDX.SECUREPAGECHECK={loginDropdownClass:"fxg-dropdown-js",loginOpenClass:"fxg-dropdown__item--open",homePageURL:"",getHomePage:function(){var c=window.location.origin+FDX.contextPath;
var b="/"+FDX.DATALAYER.page.pageInfo.locale.replace("_","-")+"/";
var a=c+b+"home.html";
return a
},checkCookie:function(b){var e=b+"=";
var a=document.cookie.split(";");
for(var d=0;
d<a.length;
d++){var f=a[d];
while(f.charAt(0)==" "){f=f.substring(1,f.length)
}if(f.indexOf(e)==0){return f.substring(e.length,f.length)
}}return null
},authenticatePageURL:function(){var e="";
var c=false;
var d=window.location.href;
sessionStorage.setItem("requestURL",d);
var b=window.location.origin+FDX.contextPath;
var a="/"+FDX.DATALAYER.page.pageInfo.locale.replace("_","-")+"/";
FDX.SECUREPAGECHECK.homePageURL=b+a+"home.html";
if(typeof(FDX.DATALAYER.page.pageInfo.securePage)!=="undefined"&&FDX.DATALAYER.page.pageInfo.securePage!==null&&FDX.DATALAYER.page.pageInfo.securePage==="true"&&d!==FDX.SECUREPAGECHECK.homePageURL){e=d;
sessionStorage.setItem("redirectURL",e);
if(sessionStorage.getItem("requestURL")!==null){window.open(FDX.SECUREPAGECHECK.homePageURL,"_self");
sessionStorage.setItem("securePageRequest",true)
}}},clearSessionStorage:function(){if(sessionStorage.getItem("securePageRequest")!==null){sessionStorage.removeItem("redirectURL");
sessionStorage.removeItem("securePageRequest");
sessionStorage.removeItem("requestURL");
sessionStorage.removeItem("userLoginformActive")
}},loginOpen:function(){if($(document).width()<=FDX.BREAKPOINTS.TabletMediaQuery){setTimeout(function(){$("input#NavLoginUserId.fxg-field__input-text.fxg-field__input--required").trigger("focus")
},500)
}}};
if(typeof(FDX)!=="undefined"&&FDX.SECUREPAGECHECK.checkCookie("wcmmode")===null&&window.top.location.href.indexOf("/editor.html/")==-1&&(localStorage.getItem("userAuthenticated")==null||localStorage.getItem("userAuthenticated")!=="true")){FDX.SECUREPAGECHECK.authenticatePageURL()
}$(document).ready(function(a){if(!FDX.LOGINCHECK.userAuthenticated&&sessionStorage.getItem("securePageRequest")!==null&&sessionStorage.getItem("securePageRequest")==="true"&&sessionStorage.getItem("requestURL")===FDX.SECUREPAGECHECK.homePageURL&&FDX.SECUREPAGECHECK.checkCookie("wcmmode")===null){if($(document).width()<=FDX.BREAKPOINTS.TabletMediaQuery){setTimeout(function(){$(".fxg-user-options__icon").trigger("click");
sessionStorage.setItem("userLoginformActive",true);
a(FDX.SECUREPAGECHECK.loginOpen)
},100)
}if($(document).width()>=FDX.BREAKPOINTS.TabletMediaQuery){setTimeout(function(){$("."+FDX.DROPDOWN.dropdownClass).trigger("click");
sessionStorage.setItem("userLoginformActive",true);
$("input#NavLoginUserId").focus()
},100)
}}});