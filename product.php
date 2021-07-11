<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/homepage.css">
    <link rel="stylesheet" href="css/product_page.css">
    <link rel="stylesheet" href="css/product.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/chat.css">
    <link rel="stylesheet" href="fontawesome-free-5.15.3-web\css\all.css">
</head>
<body>
    
    <nav>
        <!-- <div id="banner"><button id="nav-create-cake">Create your own cake</button></div> -->
        <ul class="horizontal">
            <a href="index.html"><li id="nav-logo"></li></a>
            <li class="category">
                <a href="index.html">Home</a>
            </li>
            <li class="category"><a href="menu.php?category=cake">Cakes</a></li>
            <li class="category"><a href="menu.php?category=cupcake">Cupcakes</a></li>
            <li class="category"><a href="menu.php?category=cheese_cake">Cheese cakes</a></li>
            <li class="category"><a href="menu.php?category=croissant">Croissants</a></li>
            <li class="category"><a href="menu.php?category=donut">Donuts</a></li>
            <li>
                <input type="text" id="nav-search" placeholder="Search" onenter="">
            </li>
            <li><a href="wishlist.php"><i class="icon far fa-heart"></i></a></li>
            <li id="nav-cart">
                <span>10</span>
                <i class="icon fas fa-shopping-cart" onclick="openCart()"></i>   
            </li>
            <li>
                <i class="icon far fa-user-circle"></i>
                <ul class="dropdown">
                    <li><a href="">Account Settings</a></li>
                    <li><a href="">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div class="product-top">
    <div class="product-category" id="productCategory"></div>
    <h1 class="title" id="productName"></h1>
    </div>

    <div class="product-left">

        <div class="image">
            <img id="productImage">
        </div>
    </div>

    <div class="product-right">
        <div class="product-desc">
            <label class="product-label">Product Description</label>
            <p id="productDesc"></p>
        </div>
        <div class="product-size">
            <label class="product-label">Sizes</label>
            <div class="product-size-form" id="productSizes">
                <!-- <label class="container" id="s1"><b>&#8369;750.00</b> - Small (16" x 12")
                    <input type="radio" checked="checked" name="size_price">
                    <span class="checkmark"></span>
                </label> -->
            </div>
        </div>
        <div class="product-qty-price">
            <div class="product-qty">
                <label class="product-label">Quantity</label>
                <div class="qty-buttons">
                    <button class="qty-plus">+</button>
                    <input type="text" value=1 readonly>
                    <button class="qty-minus">-</button>
                </div>
            </div>
            <div class="product-total">
                <label class="product-label">Total</label>
                <div class="product-total-amount">P750.00</label>
            </div>
        </div>  
    </div>
    
    <div class="product-action-buttons">
            <button class='btn-addToCart' onclick='addToCart(".$id.", 1)'><i class='icon fas fa-shopping-cart'></i>&nbsp;&nbsp;Add to cart</button>
            <button class='btn-wishList'><i class='far fa-heart'></i>&nbsp;&nbsp;Add to wishlist</button>
        </div>
</div>

<script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous">
    </script>

    <script src="js/productPage.js"></script>

</body>
</html>