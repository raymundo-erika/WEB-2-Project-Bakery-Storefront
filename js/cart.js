$("document").ready(function(){
    loadCart();
});


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
            loadCart();
        }
    }

    xhr.open("POST", "php/addToCart.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("productID="+productID+"&qty="+qty);
}

function loadCart() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4 && xhr.status == 200) {
            $(".cart-body").html(xhr.responseText);
            displayTotal();
        }
    }

    xhr.open("POST", "php/loadCart.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();
}

function displayTotal() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4 && xhr.status == 200) {
            $(".cart-total").html(xhr.responseText);
        }
    }

    xhr.open("POST", "php/displayCartTotal.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();
}

function deleteCartItem(cartItemID) {

    alert("woyo>>>!  " + cartItemID);

    var xhr1 = new XMLHttpRequest();
    xhr1.onreadystatechange = () => {
        if(xhr1.readyState == 4 && xhr1.status == 200) {
            alert("woyo2!"  + xhr1.responseText);
            loadCart();
        }
    }

    xhr1.open("POST", "php/deleteCartItem.php", true);
    xhr1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr1.send("cartItemID="+cartItemID);
}