$document.ready(function(){
    
});


function openCart() {
    $(".cart-container").fadeIn();


    $(".cart").animate({
        right: "0px"
    });
}

function closeCart() {
    $(".cart").animate({
        right: "-400px",
    });
        
    $(".cart-container").fadeOut();
}