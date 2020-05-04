// https://bootstrapstudio.io/forums/topic/how-disable-data-togglecollapse-action-in-desktop-view/
function adjustCollapseView(){
    let desktopView = $(document).width();
    if(desktopView >= "768"){
        $(".collapse:not(.show)").addClass("show");
    } else {
        $('.collapse.show').removeClass('show');
    }
}

$(function(){
    adjustCollapseView();
    $(window).on("resize", function(){
        adjustCollapseView();
    });
});
