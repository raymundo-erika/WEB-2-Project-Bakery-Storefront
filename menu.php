<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: loginRegister.html");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/chat.css">
    <link rel="stylesheet" href="css/search.css">
    <link rel="stylesheet" href="css/product.css">
    <link rel="stylesheet" href="css/menu.css">
    <script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
    <script src="js/nav.js"></script>
</head>
<body>

    <!--navbar-->
    <nav>
        <ul class="horizontal">
            <a href="index.php">
                <li id="nav-logo"></li>
            </a>
            <li class="category">
                <a href="index.php">Home</a>
            </li>

            <section class="category-container" style="display: inline-block"></section>
            
            <li>
                <input type="text" id="nav-search" placeholder="Search" onkeyup="search(this.value)" autocomplete="off">
            </li>
            <li><a href="wishlist.html"><i class="icon far fa-heart"></i></a></li>
            <li id="nav-cart">
                <span id="cartItems"></span>
                <i class="icon fas fa-shopping-cart" onclick="openCart()"></i>
            </li>
            <li>
                <i class="icon far fa-user-circle"></i>
                <ul class="dropdown">
                    <li><a href="">Account Settings</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div class="searchSuggestionContainer">
        <ul id="suggestionList">
        </ul>
    </div>

    <!--menu-->
    
    <div id="menu">
        <div id="categoryDetails">
        </div>

        <div id="products"></div>

        <div class="pagination"></div>

    </div>
    

    <!--cart container-->

    <div class="cart-container">
        <div class="cart">
            <div class="cart-header">
                <i class="icon fas fa-shopping-cart"></i>
                <label>Cart</label>
                <span class="icon close" onclick="closeCart()">&times;</span>
            </div>

            <div class="cart-body">
            </div>

            <div class="cart-footer">
                <div class="cart-total">Total: <b>&#8369;750.00</b></div>
                <div class="btn-checkout"><i class="icon fas fa-shopping-cart"></i>Checkout</div>
            </div>
        </div>
        <div class="cart-overlay" onclick="closeCart()"></div>
    </div>

    <script src="https://kit.fontawesome.com/6a07858133.js" crossorigin="anonymous"></script>
    <script src="js/pagination.js"></script>
    <script src="js/menu.js"></script>
    <script src="js/wishlist.js"></script>
    <script src="js/cart.js"></script>
    <script src="js/messageFunctionalities.js"></script>
    <script src="js/search.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
</html>