function login() {
    un = $("#login-un").val();
    pass = $("#login-pass").val();

    if (un == "" || pass == "") {

        //sweet alerts
        swal("Please fill up all the fields.", "Username and password must be filled up.");

        // (un == "") ? displayStatus("login-un-status", "Please enter a username."): removeStatus("login-un-status");
        // (pass == "") ? displayStatus("login-pass-status", "Please enter a password."): removeStatus("login-pass-status");

    } else {

        xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {

                if (xhr.responseText == "1") {
                    location.replace("index.php");
                } else {
                    swal("Wrong credentials", "Invalid username or password", "error");
                }
            }
        }

        xhr.open("POST", "php/login.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("username=" + un + "&password=" + pass);
    }
}


function register() {

    //Trim Added
    un = $("#reg-un").val().trim();
    pass = $("#reg-pass").val();
    fn = $("#reg-fn").val().trim();
    ln = $("#reg-ln").val().trim();

    if (un == "" || pass == "" || fn == "" || ln == "") {
        swal("Please fill up all the fields.", "Provide your valid information.");
    } else {
        xhr = new XMLHttpRequest();

        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                if (xhr.responseText == "1") {
                    swal("Wrong credentials", "Invalid username or password", "error");
                } else {
                    actionRegister();
                }
            }
        }

        xhr.open("POST", "php/checkForDuplicateUsername.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("username=" + un);
    }

}


//contains the main registration code, we separated it for better readability
function actionRegister() {
    xhr = new XMLHttpRequest();

    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            //flip
        }
    }

    xhr.open("POST", "php/register.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("username=" + un + "&password=" + pass + "&firstName=" + fn + "&lastName=" + ln);
}

//for error status display
function displayStatus(id, message) {
    $(id).innerHTML = "Error: " + message;
}

function removeStatus(id) {
    $(id).innerHTML = "";
}

