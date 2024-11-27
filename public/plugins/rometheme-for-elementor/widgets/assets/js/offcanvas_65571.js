
function show_offcanvas(id) {
    const offcanvas = document.getElementById('offcanvas' + id);
    var position = offcanvas.dataset.offcanvasPosition;
    const display = getComputedStyle(offcanvas).getPropertyValue(position);
    if (offcanvas.style.getPropertyValue('display') === 'none' ) {
        offcanvas.style.display ='flex';
    }
    if (parseInt(display) < 0) {
        offcanvas.style.setProperty(position, '0');
        offcanvas.style.opacity = 1 ;
        offcanvas.style.transition = '1s';
    } else {
        offcanvas.style.setProperty(position, '-150%');
        offcanvas.transition = '1s';
        offcanvas.style.opacity = 0 ;
    }
}