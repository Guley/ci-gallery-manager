function countChecked() {}! function(e, t) {
    var n = function(e, t, n) {};
    jQuery.fn[t] = function(e) {
        return e ? this.bind("resize", n(e)) : this.trigger(t)
    }
}(jQuery, "smartresize");
var CURRENT_URL 	= window.location.href.split("?")[0],
    $BODY 			= $("body"),
    $MENU_TOGGLE 	= $("#menu_toggle"),
    $SIDEBAR_MENU 	= $("#sidebar-menu"),
    $SIDEBAR_FOOTER = $(".sidebar-footer"),
    $LEFT_COL 		= $(".cc"),
    $RIGHT_COL 		= $(".right_col"),
    $NAV_MENU 		= $(".nav_menu"),
    $FOOTER 		= $("footer");

$(document).ready(function() {
    $SIDEBAR_MENU.find("a").on("click", function(t) {
        var n = $(this).parent();
        n.is(".active") ? (n.removeClass("active active-sm"), $("ul:first", n).slideUp(function() {})) : (n.parent().is(".child_menu") || ($SIDEBAR_MENU.find("li").removeClass("active active-sm"), $SIDEBAR_MENU.find("li ul").slideUp()), n.addClass("active"), $("ul:first", n).slideDown(function() {}))
    }), $MENU_TOGGLE.on("click", function() {
        $BODY.hasClass("nav-md") ? ($SIDEBAR_MENU.find("li.active ul").hide(), $SIDEBAR_MENU.find("li.active").addClass("active-sm").removeClass("active")) : ($SIDEBAR_MENU.find("li.active-sm ul").show(), $SIDEBAR_MENU.find("li.active-sm").addClass("active").removeClass("active-sm")), $BODY.toggleClass("nav-md nav-sm")
    }), $SIDEBAR_MENU.find('a[href="' + CURRENT_URL + '"]').parent("li").addClass("current-page"), $SIDEBAR_MENU.find("a").filter(function() {
        return this.href == CURRENT_URL
    }).parent("li").addClass("current-page").parents("ul").slideDown(function() {}).parent().addClass("active"),
	$(window).smartresize(function() {
    });
    
    // Eqaul height
    
       var left_height = $(".left_col").height();
      // alert(left_height);
     var nav_menu = $(".nav_menu").height();
     var right_col = $(".right_col").height();
     var footer = $("footer").height();
	 

      // alert( nav_menu + right_col + footer);
       var Right_height = ( nav_menu + right_col + footer);
       if(left_height > Right_height){
           $(".right_col").height(left_height - (nav_menu));
           } else{
               $(".left_col").height(Right_height);
           }

});