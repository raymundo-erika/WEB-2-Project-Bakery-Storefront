$(document).ready(function () {
    getUserDetails();
    getProductDetailsForCart();
    $(".toPayment").click(function (e) { 
        e.preventDefault();
        goToPayment();
    });
    $(".paymentButton").click(function (e) { 
        e.preventDefault();
        checkoutNow();
    });
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

function goToPayment(){
    inputElements = document.querySelectorAll("#left-container input");
    if(inputElements[0].value==""||inputElements[1].value==""||inputElements[2].value==""||
    inputElements[3].value==""||inputElements[4].value==""||inputElements[5].value==""||
    inputElements[6].value==""){
        swal("Error","Enter all required fields","error");
    }else{
        window.location.href = "checkoutPage2.php?address="+inputElements[0].value+" "+inputElements[1].value+" "+inputElements[2].value+" "+inputElements[3].value+" "+
        inputElements[6].value;
    }
}

function checkoutNow(){
    inputElements = document.querySelectorAll("#left-container input");

    if(inputElements[0].value==""||inputElements[1].value==""||inputElements[2].value==""||
    inputElements[3].value==""){
        swal("Error","Enter all required fields","error");
    }else{
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                swal("Success!","Thank you for buying! You will be redirected to the homepage","success").then((value) => {
                    window.location.href="index.html";
                  });
               
            }
        }
    
        xhr.open("GET", "php/checkoutProcess.php", true);
        xhr.send();
    }
    
}