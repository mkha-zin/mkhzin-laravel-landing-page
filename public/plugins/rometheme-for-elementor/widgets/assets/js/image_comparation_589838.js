
jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/rkit-imagecomparasion.default', function ($scope, $) {
        
      function initComparisons() { 
            const container = document.querySelector('.img-comp-container');
            const sliderMode = container.getAttribute('data-slider-mode');
            const showIcon = container.getAttribute('data-show-icon');
  
            var x, i;
            x = document.getElementsByClassName("img-comp-overlay");
            for (i = 0; i < x.length; i++) { 
                compareImages(x[i]);
                console.log(x);
            }
  
            function compareImages(img) {
                var slider, clicked = 0, w, h; 
                w = img.offsetWidth;
                h = img.offsetHeight; 
  
                if (sliderMode === 'vertical') {
                    img.style.height = (h / 2) + "px"; 
  
                    slider = document.createElement("DIV");
                    slider.setAttribute("class", "img-comp-slider vertical");
  
  
                    if (showIcon === 'yes') {
                    const icon = document.createElement("I");
                    icon.setAttribute("class", "icon-div fas fa-chevron-up");
                    slider.appendChild(icon);
  
                    const icone = document.createElement("I");
                    icone.setAttribute("class", "icon-div fas fa-chevron-down");
                    slider.appendChild(icone);
                    }
                    const divider = document.createElement("DIV");
                    divider.setAttribute("class", "img-comp-slider divider");
  
                    img.parentElement.insertBefore(slider, img);
   
                    slider.style.top = (h / 2) - (slider.offsetHeight / 2) + "px";
                    slider.style.left = (w / 2) - (slider.offsetWidth / 2) + "px";
                } else {
                    img.style.width = (w / 2) + "px"; 
  
                    slider = document.createElement("DIV");
                    slider.setAttribute("class", "img-comp-slider");
  
                    if (showIcon === 'yes') {
                    const icon = document.createElement("I");
                    icon.setAttribute("class", "fas fa-chevron-left");
                    slider.appendChild(icon);
  
                    const icone = document.createElement("I");
                    icone.setAttribute("class", "fas fa-chevron-right");
                    slider.appendChild(icone);
                    }
        
                    const divider = document.createElement("DIV");
                    divider.setAttribute("class", "img-comp-img divider");
  
  
                    img.parentElement.insertBefore(slider, img);
  
                    slider.style.top = (h / 2) - (slider.offsetHeight / 2) + "px";
                    slider.style.left = (w / 2) - (slider.offsetWidth / 2) + "px";
                }
  
                slider.addEventListener("mousedown", slideReady);
                window.addEventListener("mouseup", slideFinish);
                slider.addEventListener("touchstart", slideReady);
                window.addEventListener("touchend", slideFinish);
  
                function slideReady(e) {
                    e.preventDefault(); 
                    clicked = 1; 
                    window.addEventListener("mousemove", slideMove);
                    window.addEventListener("touchmove", slideMove);
                }
                function slideFinish() {
                    clicked = 0;
                    // window.removeEventListener("mousemove", slideMove);
                    // window.removeEventListener("touchmove", slideMove);
                }
                function slideMove(e) {
                    var pos;
                    
                    if (clicked == 0) return false;
                    
                    pos = sliderMode === 'vertical' ? getCursorPosVertical(e) : getCursorPosHorizontal(e);
                    
                    if (pos < 0) pos = 0;
                    if (pos > (sliderMode === 'vertical' ? h : w)) pos = (sliderMode === 'vertical' ? h : w);
  
                    slide(pos);
                }
                function getCursorPosVertical(e) {
                    var a, y = 0;
                    e = (e.changedTouches) ? e.changedTouches[0] : e; 
  
                    a = img.getBoundingClientRect();
                    
                    y = e.pageY - a.top;
  
                    y = y - window.scrollY ; 
                    return y;
                }
                function getCursorPosHorizontal(e) {
                    var a, x = 0;
                    e = (e.changedTouches) ? e.changedTouches[0] : e; 
  
                    a = img.getBoundingClientRect();
                    
                    x = e.pageX - a.left;
                    
                    x = x - window.pageXOffset;
                    return x;
                }
                function slide(pos) {
                    if (sliderMode === 'vertical') {
                        img.style.height = (pos) + "px";
                        slider.style.top = pos - (slider.offsetHeight / 2) + "px";
                    } else {
                        img.style.width = (pos) + "px";
                        slider.style.left = pos - (slider.offsetWidth / 2) + "px";
                    }
                }
            }
        }
  
  
        initComparisons(); 
    });
  });