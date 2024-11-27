window.onresize = resize;
window.onload = resize;

function resize() {
    jQuery(document).ready(($) => {
        var nav_container = $('.rkit-navmenu-container');
        var elementorsection = nav_container.closest('.elementor');
        var responsive_navmenu = nav_container.find('.rkit-responsive-menu');
        if (responsive_navmenu.hasClass('rkit-navmenu-fullwidth')) {
            var section_width = elementorsection.width();
            $(".rkit-navmenu-fullwidth").css("width", section_width + "px");
            var left = -1 * (Math.round(nav_container.offset().left));
            $(".rkit-navmenu-fullwidth").css("left", left + "px");
        }
    });

}

function open_dropdown(cls, id_key, responsive, cls_open) {
    const el = document.getElementById(cls + id_key);
    var data_dropdown = el.getAttribute('data-dropdown');
    const dropdown = document.getElementById(data_dropdown);
    dropdown.classList.toggle(cls_open + responsive);

    resize();

    if (cls == 'rkit-hamburger-') {

        if (dropdown.classList.contains('rkit-responsive-open-' + responsive)) {
            hamburger_icon(id_key, true);
        } else {
            hamburger_icon(id_key, false);
        }
    }
}

function dropdown_click() {
    jQuery(($) => {
        if ($(this).closest('.rkit-menu').parent().hasClass("rkit-dropdown-open")) {
            $(this).closest('.rkit-menu').parent().removeClass("rkit-dropdown-open");
        } else {
            $(".rkit-dropdown").removeClass("rkit-dropdown-open");
            $(this).closest('.rkit-menu').parent().addClass("rkit-dropdown-open");
        }
    });
}

function submenu_click() {
    jQuery(($) => {
        if ($(this).closest('.rkit-submenu').parent().hasClass("rkit-submenu-open")) {
            $(this).closest('.rkit-submenu').parent().removeClass("rkit-submenu-open");
        } else {
            $(".rkit-dropdown").removeClass("rkit-submenu-open");
            $(this).closest('.rkit-submenu').parent().addClass("rkit-submenu-open");
        }
    });
}



function hamburger_icon(id_key, bool) {
    const icon_close = document.getElementById('rkit-icon-close' + id_key);
    const icon_open = document.getElementById('rkit-icon-open' + id_key);
    if (bool) {
        icon_open.style.display = 'none';
        icon_open.style.animation = 'rotate_in 0.5s'
        icon_close.style.display = 'block';
        icon_close.style.animation = 'rotate_out 0.5s'
    } else {
        icon_open.style.display = 'block';
        icon_open.style.animation = 'rotate_out 0.5s'
        icon_close.style.display = 'none';
        icon_close.style.animation = 'rotate_in 0.5s'
    }
}