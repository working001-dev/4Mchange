const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
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
var ActivedMenu  = JSON.parse(localStorage?.actived || "{}");
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
  `<li class="${active}" roleMenuId=${m.roleMenuId}>
      <a href="${_UrlProject}${m.menuLink}">
          <i class="menu-icon fa fa-caret-right"></i>
          ${m.menuName}
      </a> 
      <b class="arrow"></b>
  </li>`
); 
var GenarateMenu = () => {
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
};
var GenarateHeadTitle = (t) => {
  let headTitle = $("#breadcrumbs ul.breadcrumb");
  headTitle.html(
    `<li><i class="ace-icon ${t.icon} home-icon"></i><a href="#">${t.groupMenuName?.toUpperCase()}</a></li>
     <li class="active">${t.menuName}</li>`
  )
};
var GenarateHeadPage = (t) => {
  let headTitle = $(".page-content .page-header");
  headTitle.html(`<h1>${t.menuName}<small><i class="ace-icon fa fa-angle-double-right"></i> ${t.menuDescription}</small></h1>`)
};
var GenarateBodypage = async (u) =>{
  let _b = await PostRequest(`${_UrlProject}${u.menuLink}`, {content:"body"});
  let _s = await PostRequest(`${_UrlProject}${u.menuLink}`, {content:"script"});
  let _c = await PostRequest(`${_UrlProject}${u.menuLink}`, {content:"style"});
  $("#main-container .main-content").html(_b); 
  $("link[style-section]~style").toArray().forEach( f =>{ f.remove() } );
  $("link[style-section]~link").toArray().forEach( f =>{ f.remove() } );
  $("script[script-section]~script").toArray().forEach( f =>{ f.remove() } );
  $("body").append(_s);
  $("head").append(_c);
}
var PostRequest = async (u, s) => {
  return await $.post( u, s )
  .fail(function() {
    Toast.fire({ icon: 'error', title: 'Error request please contact admin.' }); 
  });
};



$(document).on("click", "#sidebar-4m .nav.nav-list a", function(event){
  event.preventDefault();
  // debugger;
  let alink = $(this);
  let parentList = $(this).closest('li');
  if( !(ActivedMenu?.roleMenuId == parentList.attr('roleMenuId')) ){
    let _menuClick = Menu.filter( f => f.roleMenuId == parentList.attr('roleMenuId') );
    localStorage.setItem("actived", JSON.stringify(_menuClick[0]));
    ActivedMenu  = JSON.parse(localStorage?.actived || "{}");
    $("#sidebar-4m li").removeClass("active");
    $(`#g___${ActivedMenu?.roleMenuId}`).removeClass("open").removeClass("active");;
    $(`#g___${parentList.attr('roleMenuId')}`).addClass("active");
    parentList.addClass("active");
    GenarateBodypage(ActivedMenu);
    GenarateHeadTitle(ActivedMenu);
    GenarateHeadPage(ActivedMenu); 
    
  }else return false;
})
window.onload = function(){
  GenarateMenu();
  GenarateBodypage(ActivedMenu);
  GenarateHeadTitle(ActivedMenu);
  GenarateHeadPage(ActivedMenu); 
  
}




function utf8_to_b64( str ) {
  return window.btoa(unescape(encodeURIComponent( str )));
}

function b64_to_utf8( str ) {
  return decodeURIComponent(escape(window.atob( str )));
}