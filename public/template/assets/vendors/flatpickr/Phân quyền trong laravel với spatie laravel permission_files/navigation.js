//nav resposive script
jQuery(document).ready(function($) {

    const openedMenu = document.querySelector('.opened-menu');
    const closedMenu = document.querySelector('.closed-menu');
    const navbarMenu = document.querySelector('.main-navigation');
    const menuOverlay = document.querySelector('.overlay');
    
    // Opened navbarMenu
    // Closed navbarMenu
    // Closed navbarMenu by Click Outside
    openedMenu.addEventListener('click', toggleMenu);
    closedMenu.addEventListener('click', toggleMenu);
    menuOverlay.addEventListener('click', toggleMenu);
    
    // Toggle Menu Function
    function toggleMenu() {
       navbarMenu.classList.toggle('active');
       menuOverlay.classList.toggle('active');
       openedMenu.classList.toggle('active');
       document.body.classList.toggle('scrolling');
    }

    navbarMenu.addEventListener('click', (event) => {
       if (event.target.hasAttribute('data-toggle') && window.innerWidth <= 992) {
          // Prevent Default Anchor Click Behavior
          event.preventDefault();
          const menuItemHasChildren = event.target.parentElement;
    
          // If menuItemHasChildren is Expanded, Collapse It
          if (menuItemHasChildren.classList.contains('active')) {
             collapseSubMenu();
          } else {
             // Collapse Existing Expanded menuItemHasChildren
             if (navbarMenu.querySelector('.menu-item-has-children.active')) {
                collapseSubMenu();
             }
             // Expand New menuItemHasChildren
             menuItemHasChildren.classList.add('active');
             const subMenu = menuItemHasChildren.querySelector('.sub-menu');
             subMenu.style.maxHeight = subMenu.scrollHeight + 'px';
          }
       }
    });
    
    // Collapse Sub Menu Function
    function collapseSubMenu() {
       navbarMenu.querySelector('.menu-item-has-children.active .sub-menu').removeAttribute('style');
       navbarMenu.querySelector('.menu-item-has-children.active').classList.remove('active');
    }
    
    // Fixed Resize Screen Function
    function resizeScreen() {
       // If navbarMenu is Open, Close It
       if (navbarMenu.classList.contains('active')) {
          toggleMenu();
       }
    
       // If menuItemHasChildren is Expanded, Collapse It
       if (navbarMenu.querySelector('.menu-item-has-children.active')) {
          collapseSubMenu();
       }
    }
    
    window.addEventListener('resize', function(){
       if (this.innerWidth > 992) {
          resizeScreen();
       }
    });
});


//search js
jQuery(document).ready(function($) {
	const searchIcon = document.querySelector('.search-icon');
	const searchForm = document.querySelector('.search-form');
	searchIcon.addEventListener('click', toggleSearch);
    
    // Toggle Menu Function
    function toggleSearch() {
		searchIcon.classList.toggle('active');
		searchForm.classList.toggle('active');
    }

});


//short js
 $(function() {
    // sticky sidebar
    $(".main-sidebar").each(function() {
        $(this).theiaStickySidebar({
            additionalMarginTop: 20,
            additionalMarginBottom: 20
        })
    }),
   //sticky menu
    $(".header-bottom").each(function() {
        var e = $(this);
        if (e.length > 0) {
            var t = $(document).scrollTop(),
                a = e.offset().top,
                s = e.height(),
                r = a + s + s;
            $(window).scroll(function() {
                var s = $(document).scrollTop();
                s > r ? e.addClass("is-fixed") : (s < a || s <= 0) && e.removeClass("is-fixed"), 
                s > t ? e.removeClass("show") : e.addClass("show"), t = s
            })
        }
    }),
    
    // Back to top button
    $("#back-to-top").each(function(){
        var e=$(this);
        $(window).on("scroll",function(){
            $(this).scrollTop()>=100?e.fadeIn(170):e.fadeOut(170), e.offset().top>=$(".site-footer").offset().top-34?e.addClass("on-footer"):e.removeClass("on-footer")
        }),
        e.on("click",function(){
            $("html, body").animate({scrollTop:0},500)
        })
    })

 });
 
 //lazy load
