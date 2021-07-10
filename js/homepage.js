$(document).ready(function(){
    displayCategories();
});


function displayCategories() {
    xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById("categories").innerHTML = xhr.responseText;
        }
    }

    xhr.open("GET", "php/displayCategories.php", true);
    xhr.send();
}