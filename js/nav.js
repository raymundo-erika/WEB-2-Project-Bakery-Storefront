$(document).ready(function(){
    navCategories();
});

function navCategories() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            $(".category-container").html(xhr.responseText)
        }
    }

    xhr.open("GET", "php/navCategories.php", true);
    xhr.send(); 
}

