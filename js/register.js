function registerUser() {

    //Trim Added
    un = $("#reg-un").val().trim();
    pass = $("#reg-pass").val();
    email = $("#reg-email").val().trim();
    fullname = $("#reg-fullname").val().trim();
    address = $("#reg-address").val().trim();
    birthdate = $("#reg-bday").val().trim();

    if (un == "" || pass == "" || email == "" || fullname == "" || address == "" || birthdate == "") {
        swal("Please fill up all the fields.", "Provide your valid information.", "info");

    } else {
        xhr = new XMLHttpRequest();

        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                if (xhr.responseText == "0") {
                    swal("Duplicate username and email.","Maybe you want to login instead?", {
                        buttons: {
                          cancel: "Cancel",
                          "Login": true,
                        },
                      })
                      .then((value) => {
                        switch (value) {
                       
                          case "Login":
                              openLogin();
                            break;
                       
                          default:
                        }
                      });

                } else if (xhr.responseText == "1") {
                    swal("Duplicate username!", "Please create a new username", "info");
                } else if (xhr.responseText == "2") {
                    swal("Duplicate email!", "Please create a new email", "info");
                } else {
                    register();
                }
            }
        }

        xhr.open("POST", "php/checkForDuplications.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("username=" + un + "&email="+email);
    }

}

//contains the main registration code, we separated it for better readability
function register() {
    xhr = new XMLHttpRequest();

    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            swal("You are now registered!", "You can now proceed to the login.", "success", {
                button: "Login!",
              });
            openLogin();
        }
    }

    
    un = $("#reg-un").val().trim();
    pass = $("#reg-pass").val();
    email = $("#reg-email").val().trim();
    fullname = $("#reg-fullname").val().trim();
    address = $("#reg-address").val().trim();
    birthdate = $("#reg-bday").val().trim();

    xhr.open("POST", "php/register.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("username=" + un + "&password=" + pass + "&email=" + email + "&fullName=" + fullname + "&address=" + address + "&birthdate=" + birthdate);
}

