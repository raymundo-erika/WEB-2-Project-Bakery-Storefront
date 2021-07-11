$(document).ready(function(){
    getProductImage();
    getProductName();
    getProductDescription();
    getProductCategory();
    getProductSize();
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