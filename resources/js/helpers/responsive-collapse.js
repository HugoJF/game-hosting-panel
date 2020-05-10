// https://bootstrapstudio.io/forums/topic/how-disable-data-togglecollapse-action-in-desktop-view/
export function adjustCollapseView() {
    let desktopView = window.innerWidth;

    console.log(desktopView);

    if (desktopView >= 1052) {
        $(".collapse:not(.show)").addClass("show");
    } else {
        $('.collapse.show').removeClass('show');
    }
}
console.log('adjustCollapseView loaded');
