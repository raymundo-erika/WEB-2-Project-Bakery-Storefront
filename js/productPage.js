$(document).ready(function(){
    $("body").fadeIn();
    getProductImage();
    getProductName();
    getProductDescription();
    getProductCategory();
    getProductSize();
    // var firstSize = getFirstSize();
    // console.log("first size" + firstSize);
    getFirstSize();
    // checkAvailability(firstSize);

});


function getProductImage() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            $("#productImage").attr("src", xhr.responseText);
        }
    }

    var productID = location.search.split('id=')[1];
    xhr.open("GET", "php/getProductImage.php?productID="+productID, true);
    xhr.send();
}

function getProductName() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            $("#productName").html(xhr.responseText);
        }
    }

    var productID = location.search.split('id=')[1];
    xhr.open("GET", "php/getProductName.php?productID="+productID, true);
    xhr.send();
}

function getProductDescription() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            $("#productDesc").html(xhr.responseText);
        }
    }

    var productID = location.search.split('id=')[1];
    xhr.open("GET", "php/getProductDescription.php?productID="+productID, true);
    xhr.send();
}


function getProductCategory() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            $("#productCategory").html(xhr.responseText);
        }
    }

    var productID = location.search.split('id=')[1];
    var categoryID = location.search.split('category=')[1];
    xhr.open("GET", "php/getProductCategory.php?productID="+productID+"&category="+categoryID, true);
    xhr.send();
}

function getProductSize() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            $("#productSizes").html(xhr.responseText);
        }
    }

    var productID = location.search.split('id=')[1];
    xhr.open("GET", "php/getProductSize.php?productID="+productID, true);
    xhr.send();
}

function checkProductStocks(size, qty) {

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {

            var title = "Patisserie's Sweet Reminder";
            console.log()

            switch(xhr.responseText) {
                case "empty":
                    swal(title, "This product has no stocks, please try other sizes.");
                    return false;

                case "exceeded":
                    swal(title, "You can only avail for up to 10 quantity.");
                    return false;
                
                case "ok":
                    console.log("success!");
                    return true;

                default: 
                    swal(title, "This product has only (" + xhr.responseText + ") items.");
                    return false;
            }

        }
    }

    var productID = location.search.split('id=')[1];
    xhr.open("GET", "php/checkProductStocks.php?productID="+productID+"&size="+size+"&qty="+qty, true);
    xhr.send();
}

function checkAvailability(size) {
    $("#qtyInput").val(1);
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4 && xhr.status == 200) {

            console.log("size >>>" + xhr.responseText);
            if(xhr.responseText == 0) {
                $("#productQtyPrice").hide();
                $("#btnAddToCart").hide();
                // $("#notAvailable").show();
            } else {

                $("#productQtyPrice").show();
                $("#btnAddToCart").show();
                getProductItemTotal(size, 1);
                // $("#productActionButtons").html("Not available");
            }

        }
    }

    var productID = location.search.split('id=')[1];

    console.log("productID" + productID);
    console.log("size" + size);

    xhr.open("POST", "php/checkAvailability.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("productID="+productID+"&size="+size);
}

function getFirstSize() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4 && xhr.status == 200) {
            checkAvailability(xhr.responseText);
            getProductItemTotal(xhr.responseText, 1);
        }
    }

    var productID = location.search.split('id=')[1];

    xhr.open("GET", "php/getFirstSize.php?productID="+productID, true);
    xhr.send();
}

function changeQty(operation) {

    var currentQtyValue = $("#qtyInput").val();

    if (operation == 0) {
        currentQtyValue++;
    } else {
        currentQtyValue--;
    }


    // currentQtyValue = (operation == 0) ? currentQtyValue++ : currentQtyValue--;
    console.log("current qty value = " + currentQtyValue);

    var size = $('input[name="size_price"]:checked').val();

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {

            var title = "Patisserie's Sweet Reminder";
            console.log()

            switch(xhr.responseText) {
                case "empty":
                    swal(title, "This product has no stocks, please try other sizes.");
                    return false;

                case "exceeded":
                    swal(title, "You can only avail for up to 10 quantity.");
                    return false;

                case "invalid":
                    swal(title, "Please avail atleast one.");
                    return false;
                
                case "ok":
                    console.log("success!");
                    $("#qtyInput").val(currentQtyValue);
                    getProductItemTotal(size, currentQtyValue);
                   
                    return true;

                default: 
                    swal(title, "This product has only (" + xhr.responseText + ") items.");
                    return false;
            }

        }
    }

    var productID = location.search.split('id=')[1];
    xhr.open("GET", "php/checkProductStocks.php?productID="+productID+"&size="+size+"&qty="+currentQtyValue, true);
    xhr.send();
}


function getProductItemTotal(size, qty) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4 && xhr.status == 200) {
            $("#productTotalAmount").html(xhr.responseText);
        }
    }


    console.log("huy2");
    var productID = location.search.split('id=')[1];

    xhr.open("GET", "php/getProductItemTotal.php?productID="+productID+"&size="+size+"&qty="+qty, true);
    xhr.send();
}

function eventAddToCartOnClick() {
    var productID = location.search.split('id=')[1];
    var size = $('input[name="size_price"]:checked').val();
    var qty = $("#qtyInput").val();

    addToCart(productID, size, qty);
}

function eventAddToWishlistOnClick() {
    var productID = location.search.split('id=')[1];
    var size = $('input[name="size_price"]:checked').val();

    addToWishlist(productID, size);
}