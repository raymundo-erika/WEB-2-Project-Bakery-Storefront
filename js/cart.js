$("document").ready(function(){
    loadCart();
    getCartItemsNo();

    $(".btn-checkout").css("cursor", "pointer").click(function (e) { 
        e.preventDefault();
        window.location.href="checkoutPage.php";
    });
});

function openCart() {
    $(".cart-overlay").fadeIn();
    $("body").css("overflow", "hidden");


    $(".cart").animate({
        right: "0px"
    });

    loadCart();
}

function closeCart() {
    $(".cart").animate({
        right: "-400px",
    });
        
    $(".cart-overlay").fadeOut();
    $("body").css("overflow", "auto");
}

function displayActionButtons(element) {
    $(element).children(".action-buttons").show();
}

function hideActionButtons(element) {
    $(".product .action-buttons").hide();
}

function addToCart(productID, sizeID, qty) {


    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4 && xhr.status == 200) {

            var title = "Patisserie's Sweet Reminder";
            var message = "";            

            switch(xhr.responseText) {

                case "0":
                    getCartItemsNo();
                    loadCart();
                    openCart();
                    break;

                case "1":
                    message="You can only buy 10 of that item with that particular size for your cart.";
                    swal(title, message);
                    break;

                case "2":
                    message = "This product has no stocks left, why don't you try other our other products?";
                    swal(title, message);
                    break;

                    
                default:
                    message="There are only ("+xhr.responseText+") stocks left for that product size.";
                    swal(title, message);
                    break;

            }
        }
    }

    xhr.open("POST", "php/addToCart.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("productID="+productID+"&size="+sizeID+"&qty="+qty);
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
    var xhr1 = new XMLHttpRequest();
    xhr1.onreadystatechange = () => {
        if(xhr1.readyState == 4 && xhr1.status == 200) {
            loadCart();
            getCartItemsNo();
        }
    }

    xhr1.open("POST", "php/deleteCartItem.php", true);
    xhr1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr1.send("cartItemID="+cartItemID);
}

function editQtyAddCartItem(cartItemID, qty) {

    var xhr1 = new XMLHttpRequest();
    xhr1.onreadystatechange = () => {
        if(xhr1.readyState == 4 && xhr1.status == 200) {

            var title = "Patisserie's Sweet Reminder";
            var message = "";            

            switch(xhr1.responseText) {

                case "0":
                    loadCart();
                    getCartItemsNo();
                    break;

                case "1":
                    message="You can only buy 10 of that item with that particular size for your cart.";
                    swal(title, message);
                    break;

                case "2":
                    message = "This product has no stocks left, why don't you try other our other products?";
                    swal(title, message);
                    break;

                    case "3":
                        message = "Oh no, you need to atleast have one quantity.";
                        swal(title, message);
                        break;
                    
                default:
                    message="There are only ("+xhr1.responseText+") stocks left for that product size.";
                    swal(title, message);
                    break;
            }
        }
    }
 
    xhr1.open("POST", "php/editQtyAddCartItem.php", true);
    xhr1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr1.send("cartItemID="+cartItemID+"&qty="+qty);
}

function editQtyMinusCartItem(cartItemID, qty) {

    var xhr1 = new XMLHttpRequest();
    xhr1.onreadystatechange = () => {
        if(xhr1.readyState == 4 && xhr1.status == 200) {

            var title = "Patisserie's Sweet Reminder";
            var message = "";
        
            var title = "Patisserie's Sweet Reminder";
            var message = "";            
            switch(xhr1.responseText) {
                case "0":
                    loadCart();
                    getCartItemsNo();
                    break;

                case "1":
                    message = "Oh no, you need to atleast have one quantity.";
                    swal(title, message);
                    loadCart();
                    break;
            }
        }
    }
 
    xhr1.open("POST", "php/editQtyMinusCartItem.php", true);
    xhr1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr1.send("cartItemID="+cartItemID+"&qty="+qty);
}

function getCartItemsNo() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log("hello!");
            $("#cartItems").html(xhr.responseText)
        }
    }

    xhr.open("GET", "php/getCartItemsNo.php", true);
    xhr.send(); 
}