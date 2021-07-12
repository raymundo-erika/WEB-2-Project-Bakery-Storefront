<?php 
    $username = "erika_raymundo"; // kunin sa session
    $xml = new DOMDocument();
    $xml->load("../xml/carts.xml");

    $xmlForProduct = new DOMDocument();
    $xmlForProduct->load("../xml/products.xml");

    $carts = $xml->getElementsByTagName("cart");
    $products = $xmlForProduct->getElementsByTagName("product");

    foreach($carts as $cart){
        if($cart->getAttribute("username")==$username&&$cart->getAttribute("status")==0){
            $cart_items= $cart->getElementsByTagName("cart_item");
            echo "<div class='purchase-items' id=''> ";
            echo "<table> <caption>Your Cart</caption>";
            foreach($cart_items as $cart_item){
                
                $prodID = $cart_item->getElementsByTagName("productID")[0]->nodeValue;
                $sizeOfProduct = $cart_item->getElementsByTagName("size")[0]->nodeValue;
                $superTotal = $cart->getElementsByTagName("total")[0]->nodeValue;
                
                foreach($products as $product){
                    if($product->getAttribute("prodID")==$prodID){
                        $prodImage = $product->getElementsByTagName("image")[0]->nodeValue;
                        $prodName = $product->getElementsByTagName("name")[0]->nodeValue;
                        $quantity = $cart_item->getElementsByTagName("qty")[0]->nodeValue;
                        $totalPrice = $cart_item->getElementsByTagName("totalPrice")[0]->nodeValue;
                        $sizes = $product->getElementsByTagName("size_price");
                        $prodSize = "";
                        $prodPrice = 0;
                        foreach($sizes as $size){
                            if($size->getAttribute("id")==$sizeOfProduct){
                                $prodSize = $size->getElementsByTagName("size")[0]->nodeValue;
                                $prodPrice = $size->getElementsByTagName("price")[0]->nodeValue;
                                break;
                            }
                        }
                        echo "<tr class='row1'>
                                <td class='image-item' rowspan='2'><img src='$prodImage'></td>
                                <td> $prodName</td>
                                <td class='qty'>$quantity</td>
                                <td class='price'>&#8369; $totalPrice </td>
                            </tr>
                            <tr class='row2'>
                                <td colspan='3'>
                                <small>
                                    Size: $prodSize<br>
                                    Unit Price: &#8369; $prodPrice
                                </small>
                                <br>
                                <br>
                                </td>
                            </tr>";
                        break;
                    }
                }
                
            }
            echo "</table> </div>";
            echo "<hr>
                    <table id='payment-info'>
                        <tr>
                        <td>Subtotal</td>
                        <td><strong>&#8369; $superTotal</strong></td>
                        </tr>
                        <tr>
                        <td>Shipping</td>
                        <td><strong>Computed at next step</strong></td>
                        </tr>
                    </table>
                
                <hr>
                
                <table id='total-area'>
                    <tr>
                    <td>Total: </td>
                    <td><strong>&#8369; $superTotal</strong></td>
                    </tr>
                    <tr>
                </table>";
          break;
        }
    }

?>
