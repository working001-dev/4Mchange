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
          _menu.forEach( m => { _l.find("ul.submenu").append(setMenu(m, m.groupMenuId == ActivedMenu?.groupMenuId ? "active" : "")); });
      }
  });
}

window.onload = GenarateMenu();



function utf8_to_b64( str ) {
  return window.btoa(unescape(encodeURIComponent( str )));
}

function b64_to_utf8( str ) {
  return decodeURIComponent(escape(window.atob( str )));
}