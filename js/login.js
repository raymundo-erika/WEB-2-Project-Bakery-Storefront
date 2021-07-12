function login() {
    un = document.getElementById("login-un").value;
    pass = document.getElementById("login-pass").value;

    if (un == "" || pass == "") {

        swal("Please enter your credentials.", "Please enter username and/or password", "info");

    } else {

        xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {

                console.log("repsonse = " + xhr.responseText);

                if (xhr.responseText == "1") {
                    location.replace("index.php");
                } else {
                    swal("Wrong credentials.", "The username or password you entered might be invalid.","error");
                }
            }
        }

        xhr.open("POST", "php/login.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("username=" + un + "&password=" + pass);
    }
}
