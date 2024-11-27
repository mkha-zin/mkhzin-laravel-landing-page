function expand(i) {
    const expand_content = document.getElementById('expand-content-' + i);
    const expand_list = document.getElementById('expand-list-' + i);
    const collapse = document.getElementById('collapse' + i);
    const icon = document.getElementById('icon' + i);
    if (collapse.dataset.expanded == 'true') {
        collapse.dataset.expanded = 'false';
        expand_content.style.maxHeight = 0;
        expand_content.style.transition = '1s';
        expand_content.style.transitionProperty = 'all';
        expand_list.style.transition = '1s'
        icon.className = icon.dataset.opened;
    } else {
        collapse.dataset.expanded = 'true';
        expand_content.style.transition = '1s';
        expand_list.style.transition = '1s';
        expand_content.style.transitionProperty = 'all';
        expand_content.style.maxHeight = expand_content.scrollHeight + 'px';
        icon.className = icon.dataset.closed;
    }

}