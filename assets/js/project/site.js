const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 6000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
var _UrlProject = typeof __u ? `${window.location.origin}/${window.location.pathname.slice(1).split("/")[0]}/` : b64_to_utf8(__u);

var MemberInfo = JSON.parse(localStorage?.info || "{}");
var GroupMenu = JSON.parse(localStorage?.groupMenu || "{}");
var Menu = JSON.parse(localStorage?.menu || "{}");
var ActivedMenu = JSON.parse(localStorage?.actived || "{}");
var LoadingPage = $(".main-content-load"); 
var setGroupMenu = (g, active) => (
  `<li class="${active}" id="g___${g.groupMenuId}">
    <a href="#" class="dropdown-toggle">
        <i class="menu-icon ${g?.icon}"></i>
        <span class="menu-text">${g.groupMenuName?.toUpperCase()}</span>
        <b class="arrow fa fa-angle-down"></b>
    </a>
    <b class="arrow"></b>
  </li>`  
);

var setMenu = (m, active) => (
  `<li class="${active}" groupMenuId=${m.groupMenuId} roleMenuId=${m.roleMenuId} >
      <a href="${_UrlProject}${m.menuLink}">
          <i class="menu-icon fa fa-caret-right"></i>
          ${m.menuName}
      </a> 
      <b class="arrow"></b>
  </li>`
); 

var GeneateNavUserInfo = () => {
  $(".user-info").html(`<small>Welcome,</small>${MemberInfo[0]?.firstName}`);
  $(".nav-user-photo").attr("src", `${_UrlProject}assets/images/avatars/${MemberInfo[0]?.userImg}.png`);
}; 
var GenarateMenu = () => {
  try{
    let $_sidebar = $("#sidebar-4m .nav.nav-list");
    $_sidebar.html('');
    GroupMenu.forEach( g => {
        $_sidebar.append(setGroupMenu(g, g.groupMenuId == ActivedMenu?.groupMenuId ? "open active" : "" ));
        let _menu = Menu.filter( f => f.groupMenuId == g.groupMenuId );
        if( _menu[0] ){
            let _l = $(`#g___${g.groupMenuId}`);
            _l.append(`<ul class="submenu"></ul>`);
            _menu.forEach( m => { _l.find("ul.submenu").append(setMenu(m, m.roleMenuId == ActivedMenu?.roleMenuId ? "active" : "")); });
        }
    });    
  }catch{
    throw "Generate error"
  }

};
var GenarateHeadTitle = (t) => {
  try{
    let headTitle = $("#breadcrumbs ul.breadcrumb");
    headTitle.html(
      `<li><i class="ace-icon ${t.icon} home-icon"></i><a href="#">${t.groupMenuName?.toUpperCase()}</a></li>
      <li class="active">${t.menuName}</li>`
    );
  }catch{
    throw "Generate error"
  }
};
var GenarateHeadPage = (t) => {
  try{
    let headTitle = $(".page-content .page-header");
    headTitle.html(`<h1>${t.menuName}<small><i class="ace-icon fa fa-angle-double-right"></i> ${t.menuDescription}</small></h1>`);
  }catch{
    throw "Generate error"
  }
};
var GenarateBodypage = async (u) =>{
  try{
    let _b = await PostRequest(`${_UrlProject}${u.menuLink}`, {content:"body"});
    let _s = await PostRequest(`${_UrlProject}${u.menuLink}`, {content:"script"});
    let _c = await PostRequest(`${_UrlProject}${u.menuLink}`, {content:"style"});
    $("#main-container .main-content .main-content-inner").html(_b); 
    for( f of $("link[style-section]~style").toArray() ){ f.remove() } ;
    for( f of $("link[style-section]~link").toArray() ){ f.remove() } ;
    for( f of $("script[script-section]~script").toArray() ){ f.remove() } ;
  
    $("body").append(_s);
    $("head").append(_c);
  }catch{
    throw "Generate error"
  }
};
var PostRequest = async (u, s) => {
  return await $.post( u, s )
  .fail(function() {
    Toast.fire({ icon: 'error', title: 'Error request please contact admin.' }); 
    LoadingPage.find(".wait-load-page").addClass("page-error");
  });
};



$(document).on("click", "#sidebar-4m .nav.nav-list a", async function(event){
  event.preventDefault();
  // debugger;
  let alink = $(this);

  try{
    let parentList = $(this).closest('li');
    if( !(ActivedMenu?.roleMenuId == parentList.attr('roleMenuId')) ){
      LoadingPage.show(10, ()=>{LoadingPage.find(".wait-load-page").removeClass("page-error")});
      $("#sidebar-4m li").removeClass("active");
      if(parentList.attr('groupMenuId') != ActivedMenu?.groupMenuId ) $(`#g___${ActivedMenu?.groupMenuId}>a`).click();
      $(`#g___${parentList.attr('groupMenuId')}`).addClass("open active");
      parentList.addClass("active");

      let _menuClick = Menu.filter( f => f.roleMenuId == parentList.attr('roleMenuId') );
      localStorage.setItem("actived", JSON.stringify(_menuClick[0]));
      ActivedMenu  = JSON.parse(localStorage?.actived || "{}");
      await GenarateBodypage(ActivedMenu);
      //GeneateNavUserInfo();
      GenarateHeadTitle(ActivedMenu);
      GenarateHeadPage(ActivedMenu); 
      
      setTimeout( ()=>LoadingPage.hide(280), 800);
      //location.reload();
      eval($("script[local-section=reeval]").html());
      window.history.replaceState("object or string", "Title", `${_UrlProject}#/${alink.text()}`);
    }else return false;    
  }catch{
    await Toast.fire({ icon: 'error', title: 'Error generate page please contact admin.' }); 
    //setTimeout( () => { location.href = `${_UrlProject}home/logout` }, 3000 );
  }

})
window.onload = async function(){
  try{
    GenarateMenu();
    await GenarateBodypage(ActivedMenu);
    GeneateNavUserInfo();
    GenarateHeadTitle(ActivedMenu);
    GenarateHeadPage(ActivedMenu); 
    setTimeout( ()=>LoadingPage.hide(280), 1000);
    //$(".nav.ace-nav").slideDown("slow");
    $(".nav.ace-nav").show("slide", { direction: "right" }, 200);
  }catch{
    await Toast.fire({ icon: 'error', title: 'Error generate page please contact admin.' }); 
    //setTimeout( () => { location.href = `${_UrlProject}home/logout` }, 3000 );
  }
    
}


function shotcutMenu(sel){ 
  var _a = $(sel).closest("li[id^='g__']")[0];
  if( !$(_a).hasClass("open active")) $(_a).find("a.dropdown-toggle").click(); 
  setTimeout( ()=>{ $(sel).click() }, 400);    
}

function utf8_to_b64( str ) {
  return window.btoa(unescape(encodeURIComponent( str )));
}

function b64_to_utf8( str ) {
  return decodeURIComponent(escape(window.atob( str )));
}