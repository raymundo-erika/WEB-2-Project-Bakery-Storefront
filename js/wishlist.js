$("document").ready(function(){
    displayWishlist();
});

function addToWishlist(productID, sizeID) {

    console.log("from add to wishlist");

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4 && xhr.status == 200) {
         
            var title = "Patisserie's Sweet Reminder";
            var alert = "";            

            switch(xhr.responseText) {

                case "duplicated":
                    swal(title, "Already added on wishlist!");
                    break;

                case "ok":
                    swal({
                        title: "Wish successfully added!",
                        text: "Treat yourself and do not forget to buy it!",
                        icon: "success",
                      });
                    break;

                default:
                    console.log("xhr response " + xhr.responseText);
                    break;

            }
        }
    }

    xhr.open("POST", "php/addToWishlist.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("productID="+productID+"&size="+sizeID);
}

function displayWishlist() {

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4 && xhr.status == 200) {
            $("#wishlist").html(xhr.responseText);
        }
    }

    xhr.open("POST", "php/displayWishlist.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();
}

function deleteFromWishlist(wishID) {


    var xhr1 = new XMLHttpRequest();
    xhr1.onreadystatechange = () => {
        if(xhr1.readyState == 4 && xhr1.status == 200) {
            console.log("response = " + xhr1.responseText);
            displayWishlist();
        }
    }

    xhr1.open("POST", "php/deleteFromWishlist.php", true);
    xhr1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr1.send("wish_id="+wishID);
}
