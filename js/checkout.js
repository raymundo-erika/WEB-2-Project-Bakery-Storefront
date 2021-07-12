$(document).ready(function () {
    getUserDetails();
    getProductDetailsForCart();
});

function getUserDetails(){
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
           $("#tbl-account-info tr:eq(0)").html(xhr.responseText);
        }
    }

    xhr.open("GET", "php/getUserDetails4Checkout.php", true);
    xhr.send();
}

function getProductDetailsForCart(){
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
           $("#right-cart").html(xhr.responseText);
        }
    }

    xhr.open("GET", "php/getProductDetailsForCart.php", true);
    xhr.send();
}