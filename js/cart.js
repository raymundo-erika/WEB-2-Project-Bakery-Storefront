$("document").ready(function(){
    loadCart();
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
    // $(".product .action-buttons").hide();
    $(element).children(".action-buttons").show();
}

function hideActionButtons(element) {
    $(".product .action-buttons").hide();
    // $(element).children(".action-buttons").show();
}

function addToCart(productID, sizeID, qty) {
    // alert("hello!");
    // openCart();
    //add to cart

    console.log("from add to cart");

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4 && xhr.status == 200) {
            // alert();

            console.log("1111111from add to cart");
            var title = "Patisserie's Sweet Reminder";
            var alert = "";            

            switch(xhr.responseText) {

                case "0":
                    loadCart();
                    openCart();
                    console.log("56 from add to cart");
                    break;

                case "1":
                    alert="You can only buy 10 of that item with that particular size for your cart.";
                    swal(title, alert);
                    console.log("55from add to cart");
                    break;

                case "2":
                    alert = "This product has no stocks left, why don't you try other our other products?";
                    swal(title, alert);
                    console.log("44from add to cart");
                    break;

                    
                default:
                    alert="There are only ("+xhr.responseText+") stocks left for that product size.";
                    swal(title, alert);
                    console.log("33from add to cart");
                    break;

            }

            console.log("2222222222222from add to cart");

            // loadCart();
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

    // alert("woyo>>>!  " + cartItemID);

    var xhr1 = new XMLHttpRequest();
    xhr1.onreadystatechange = () => {
        if(xhr1.readyState == 4 && xhr1.status == 200) {
            // alert("woyo2!"  + xhr1.responseText);
            loadCart();
        }
    }

    xhr1.open("POST", "php/deleteCartItem.php", true);
    xhr1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr1.send("cartItemID="+cartItemID);
}

function editQtyAddCartItem(cartItemID, qty) {

    // alert("hi!");

    var xhr1 = new XMLHttpRequest();
    xhr1.onreadystatechange = () => {
        if(xhr1.readyState == 4 && xhr1.status == 200) {

            var title = "Patisserie's Sweet Reminder";
            var message = "";            
            // alert("my alert= "+xhr1.responseText);
            // alert("he!"+xhr1.responseText);

            // alert("loool " + xhr1.responseText);

            switch(xhr1.responseText) {

                case "0":
                    loadCart();
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
 
    // alert("yow!");
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

            // alert("alert for minus is " + xhr1.responseText);
        
            var title = "Patisserie's Sweet Reminder";
            var message = "";            
            switch(xhr1.responseText) {
                case "0":
                    // message="success";
                    // swal(title, message);
                    loadCart();
                    break;

                case "1":
                    message = "Oh no, you need to atleast have one quantity.";
                    swal(title, message);
                    loadCart();
                    break;
            }
        }
    }
 
    // alert("yow!");
    xhr1.open("POST", "php/editQtyMinusCartItem.php", true);
    xhr1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr1.send("cartItemID="+cartItemID+"&qty="+qty);
}