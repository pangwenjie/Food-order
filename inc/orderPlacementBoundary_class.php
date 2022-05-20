<?php
class orderPlacementBoundary extends orderPlacementController{
    public function displayCheckout($input){
        // Form to validate credit card information
        echo "<div class='card'>";
            echo "<div class='card-body'";
                echo "<form>";  
                    echo "<table>";
                        // Row 1
                        echo "<tr style='height:60px'>";
                            // Credit Card Number
                            echo "<td style='width:70%'>";
                                echo "<label for='ccNo'>Credit Card Number</label><br>";
                                echo "<input type='text' name='ccNo' id='ccNo' maxlength='16'>";
                            echo "</td>";

                            // CVC
                            echo "<td style='width:30%'";
                                echo "<label for='cvc'>&nbsp;&nbsp;CVC</label><br>";
                                echo "&nbsp;&nbsp;<input type='text' name='cvc' id='cvc' maxlength='3' size='1'>";
                            echo "</td>";
                        echo "</tr>";

                        // Row 2
                        echo "<tr style='height:60px'>";
                            // Credit Card Holder's Name
                            echo "<td colspan='2'>";
                                echo "<label for='ccName'>Name </label><br>";
                                echo "<input type='text' name='name' id='name' size='28'>";
                            echo "</td>";                   
                        echo "</tr>";

                        // Row 3
                        echo "<tr style='height:60px'>";
                            // MM/YY of credit card
                            echo "<td colspan='2'>";
                                echo "Expiration Date<br>";
                                echo "<input type='text' name='mm' id='mm' size='1' maxlength='2'> /&nbsp;";
                                echo "<input type='text' name='yy' id='yy' size='1' maxlength='2'>";
                            echo "</td>";
                        echo "</tr>";

                        // Row 4 
                        echo "<tr style='height:60px;vertical-align:middle' align='center'>";
                            // Pay button
                            echo "<td colspan='2'>";
                           
                                echo "<input type='submit' onclick='editOrder();' 
                                    class='btn btn-outline-primary' value='Edit Order'>&nbsp;&nbsp;";

                                $amount = "Pay $". (string)$input['grand_total'];
                                echo "<input type='submit' onclick='validateCreditCard();' 
                                        class='btn btn-outline-primary' value='$amount'><br>";
                            echo "</td>";
                        echo "</tr>";
                    echo "</table>";

                echo "</form>";
            echo "</div>";
        echo "</div>";
    }

    public function submitOrder($input){
        // Call upon controller class to create order.
        $controller = $this->createOrder($input);
        $orderId = "orderId=$controller";
        // After insertion, redirect user to order summary page.
        header("Location:orderSuccessful.php?" . $orderId);
    }

    public function displayOrder($orderId){
        // Retrieve customer order.
        $controller = $this->retrieveOrder($orderId);
        
        // Set parameters.
        foreach ($controller as $data){
            if (array_key_exists('id', $data)){
                $orderId = $data['id'];
                $userId = $data['userId'];
                $promo = $data['promo'];
                $table_code = $data['table_code'];
                $comment = $data['comment'];
                $total = $data['total'];
                $grand_total = $data['grand_total'];
                $discount = $total - $grand_total;
            } 
        }

        // Header of the webpage.
        echo "<center><h1>Order successful! </center></h1>";
        echo "<center><h5> Your order number is $orderId. </center></h5>";
        echo "<hr width='380px'>";

        // Use form formatting.
        echo "<form>";

        // Start of table
        echo "<table>";  
            // Table header.
            echo "<tr>";
                echo "<td><pre>                                </pre></td>";
                echo "<td><h4><b>   Item   </b></h4></td>";
                echo "<td><pre><h4><b>   Price   </b></h4></pre></td>";
                echo "<td><h4><b>   Quantity   </b></h4></td>";
                echo "<td><pre><h4><b>   Total   </b></h4></pre></td>";
            echo "</tr>"; 

            // Print out items that customer has ordered.
            foreach ($controller as $data){            
                // Only process if ordered quantity is more than 1
                if (array_key_exists('item_name', $data)){             
                    // Set parameter
                    $item_name = $data['item_name'];
                    $price = $data['price'];
                    $quantity = $data['quantity'];
                    $totalCost = $price * $quantity;
                    $images = $data['image']; 
                    $image_path = "images/food/";
                    $image = $image_path.=$images;


         

                    // Insert item's information in each table row.
                    echo "<tr>";
                        echo "<td><center><img src='$image' style='width:65px;height:65px;'</center></td>";     
                        echo "<td><center>$item_name</center></td>";
                        echo "<td><center>$$price</center></td>";
                        echo "<td><center>$quantity</center></td>";
                        echo "<td><center>$$totalCost</center></td>";
                    echo "</tr>";
                }
            }
     
            // Display total price.
            echo "<tr>";
                echo "<td><pre> </pre></td>";
            echo "</tr>";
     
            echo "<tr>";
                echo "<td><pre> </pre></td>";
                echo "<td><pre> </pre></td>";
                echo "<td><pre> </pre></td>";
                echo "<td><pre> </pre></td>";
                echo "<td style='text-align:left'><h5>";
                echo "Total: $$total";
                echo "</h5></td>";
            echo "</tr>";

            // Display total discount.
            echo "<tr>";
                echo "<td><pre> </pre></td>";
                echo "<td><pre> </pre></td>";
                echo "<td><pre> </pre></td>";
                echo "<td><pre> </pre></td>";
                echo "<td style='text-align:left'><h5>";
                    echo "Discount: $$discount";
                echo "</h5></td>";
            echo "<tr>";

            // Display grand total
            echo "<tr>";
                echo "<td><pre> </pre></td>";
                echo "<td><pre> </pre></td>";
                echo "<td><pre> </pre></td>";
                echo "<td><pre> </pre></td>";
                echo "<td style='text-align:left'><h5>";
                echo "Grand Total: $$grand_total";
                echo "</h5></td>";
            echo "<tr>";            

        // End of table   
        echo "</table>";
        echo "<br><br>";
   
        // Promo Code
        echo "&nbsp<label for='promo'>Promo Code: </label>";
        if ($promo=='nopromo'){
            echo "<div>";
                echo "<input type='text' name='promo' class='form-control' value='' readonly>";
            echo "</div><br>";  
        } else {
            echo "<div>";
                echo "&nbsp<input type='text' name='promo' class='form-control' value='$promo' readonly>";
            echo "</div><br>"; 
        }   

        // Comment Section
        if ($comment==''){
            echo "<div>";
            echo "&nbsp<label for='comment'>Comments: </label>";
                echo "<input type='text' name='comment' class='form-control' value='' readonly>";
            echo "</div><br>"; 
        } else {
            echo "<div>";
            echo "<label for='comment'>Comments: </label>";
                echo "<input type='text' name='comment' class='form-control' value='$comment' readonly>";
            echo "</div><br>"; 
        }
         
        // Table Code
        echo "<div class='input-group'>";
            echo "&nbsp<label for='table_code'>Table Number: </label>";  
            echo "<select disabled name='table_code'>";
                for ($i=1; $i<=10; $i++){
                    if ($table_code == $i){
                        echo "<option value=$i selected>$i</option>";
                    } else {
                        echo "<option value=$i>$i</option>";                            
                    }
                }
        echo "</select>";                                    
        echo "</div>";

        // End form
        echo "</form><br/>";
    }
}

?>