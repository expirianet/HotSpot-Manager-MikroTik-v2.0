
$(function() {
    "use strict";
     
	 
//sidebar menu js
$.sidebarMenu($('.sidebar-menu'));

// === toggle-menu js
$(".toggle-menu").on("click", function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });	 
	   
// === sidebar menu activation js

// $(function() {
//         for (var i = window.location, o = $(".sidebar-menu a").filter(function() {
//             return this.href == i;
//         }).addClass("active").parent().addClass("active"); ;) {
//             if (!o.is("li")) break;
//             o = o.parent().addClass("in").parent().addClass("active");
//         }
//     }), 	   
	   

/* Top Header */

$(document).ready(function(){ 
    $(window).on("scroll", function(){ 
        if ($(this).scrollTop() > 60) { 
            $('.topbar-nav .navbar').addClass('bg-dark'); 
        } else { 
            $('.topbar-nav .navbar').removeClass('bg-dark'); 
        } 
    });

 });


/* Back To Top */

$(document).ready(function(){ 
    $(window).on("scroll", function(){ 
        if ($(this).scrollTop() > 300) { 
            $('.back-to-top').fadeIn(); 
        } else { 
            $('.back-to-top').fadeOut(); 
        } 
    }); 

    $('.back-to-top').on("click", function(){ 
        $("html, body").animate({ scrollTop: 0 }, 600); 
        return false; 
    }); 
});	   
	    
   
$(function () {
  $('[data-toggle="popover"]').popover()
})


$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})


	 // theme setting
	 $(".switcher-icon").on("click", function(e) {
        e.preventDefault();
        $(".right-sidebar").toggleClass("right-toggled");
    });
	
	$('#theme1').click(theme1);
    $('#theme2').click(theme2);
    $('#theme3').click(theme3);
    $('#theme4').click(theme4);
    $('#theme5').click(theme5);
    $('#theme6').click(theme6);
    $('#theme7').click(theme7);
    $('#theme8').click(theme8);
    $('#theme9').click(theme9);
    $('#theme10').click(theme10);
    $('#theme11').click(theme11);
    $('#theme12').click(theme12);
    $('#theme13').click(theme13);
    $('#theme14').click(theme14);
    $('#theme15').click(theme15);

    function theme1() {
      $('body').attr('class', 'bg-theme bg-theme1');
      document.cookie = "theme=bg-theme1; path=/";
    }

    function theme2() {
      $('body').attr('class', 'bg-theme bg-theme2');
      document.cookie = "theme=bg-theme2; path=/";
    }

    function theme3() {
      $('body').attr('class', 'bg-theme bg-theme3');
      document.cookie = "theme=bg-theme3; path=/";
    }

    function theme4() {
      $('body').attr('class', 'bg-theme bg-theme4');
      document.cookie = "theme=bg-theme4; path=/";
    }
	
	function theme5() {
      $('body').attr('class', 'bg-theme bg-theme5');
      document.cookie = "theme=bg-theme5; path=/";
    }
	
	function theme6() {
      $('body').attr('class', 'bg-theme bg-theme6');
      document.cookie = "theme=bg-theme6; path=/";
    }

    function theme7() {
      $('body').attr('class', 'bg-theme bg-theme7');
      document.cookie = "theme=bg-theme7; path=/";
    }

    function theme8() {
      $('body').attr('class', 'bg-theme bg-theme8');
      document.cookie = "theme=bg-theme8; path=/";
    }

    function theme9() {
      $('body').attr('class', 'bg-theme bg-theme9');
      document.cookie = "theme=bg-theme9; path=/";
    }

    function theme10() {
      $('body').attr('class', 'bg-theme bg-theme10');
      document.cookie = "theme=bg-theme10; path=/";
    }

    function theme11() {
      $('body').attr('class', 'bg-theme bg-theme11');
      document.cookie = "theme=bg-theme11; path=/";
    }

    function theme12() {
      $('body').attr('class', 'bg-theme bg-theme12');
      document.cookie = "theme=bg-theme12; path=/";
    }
	
	function theme13() {
      $('body').attr('class', 'bg-theme bg-theme13');
      document.cookie = "theme=bg-theme13; path=/";
    }
	
	function theme14() {
      $('body').attr('class', 'bg-theme bg-theme14');
      document.cookie = "theme=bg-theme14; path=/";
    }
	
	function theme15() {
      $('body').attr('class', 'bg-theme bg-theme15');
      document.cookie = "theme=bg-theme15; path=/";
    }




});