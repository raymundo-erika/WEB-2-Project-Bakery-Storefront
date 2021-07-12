$(document).ready(function(){
    viewPageByCategory(1);
    getCategoryDetails();
});

function displayCategories() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            $("#categories").html(xhr.responseText);
        }
    }

    xhr.open("GET", "php/displayCategories.php", true);
    xhr.send();
}

function getCategoryDetails() {

    console.log("hello!");

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            $("#categoryDetails").html(xhr.responseText);
            console.log("reponse!" + xhr.responseText);
            console.log("reponse!" + xhr.responseText);
        }
    }

    console.log("hi!");
    var categoryID = location.search.split('category=')[1];
    xhr.open("GET", "php/getCategoryDetails.php?category="+categoryID, true);
    xhr.send();
}
