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

function openLogout() {
    console.log("hi from open!");
    $("#dropdownAcc").toggle();

    // if($("dropdownAcc").

}

// function hideLogout() {
//     $("#dropdownAcc").hide();
// }