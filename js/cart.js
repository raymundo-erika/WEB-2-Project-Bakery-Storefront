function openCart() {
    $(".cart-overlay").fadeIn();
    $("body").css("overflow", "hidden");


    $(".cart").animate({
        right: "0px"
    });
}

function closeCart() {
    $(".cart").animate({
        right: "-400px",
    });
        
    $(".cart-overlay").fadeOut();
    $("body").css("overflow", "auto");
}

function displayActionButtons(element) {
    // $(".product .action-buttons").hide();
    $(element).children(".action-buttons").show();
}

function hideActionButtons(element) {
    $(".product .action-buttons").hide();
    // $(element).children(".action-buttons").show();
}

function addToCart(productID, size, qty) {
    openCart();
}

function addToCart(productID, qty) {
    openCart();
    //add to cart

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4 && xhr.status == 200) {
            alert(xhr.responseText);
        }
    }

    xhr.open("POST", "php/addToCart.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("productID="+productID+"&qty="+qty);
}