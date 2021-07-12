$(document).ready(function(){


    displayCategories();
    displayItems();
    displayPagination();
});


function displayCategories() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById("categories").innerHTML = xhr.responseText;
        }
    }

    xhr.open("GET", "php/displayCategories.php", true);
    xhr.send();
}

function displayItems() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById("products").innerHTML = xhr.responseText;
        }
    }

    xhr.open("GET", "php/displayItems.php", true);
    xhr.send();
}


function displayPagination() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementsByClassName("pagination")[0].innerHTML = xhr.responseText;
        }
    }

    xhr.open("GET", "php/displayPagination.php", true);
    xhr.send();
}