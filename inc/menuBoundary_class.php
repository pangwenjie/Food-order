<?php
class menuBoundary extends menuController{
    public function requestMenu(){
        // Retrieve menu information from entity class through controller class.
        $controller = $this->retrieveAndFilterMenu();

        // HTML Form
        echo "<form action='/food-menu/reviewOrder.php' method='GET'>";

        // Initialize parameters used to define form layout.
        $currentMenuId = 0;
        $counter = 0;

        // For-loop to print menu interface.
        for ($i = 0; $i < count($controller); $i++){
            if ($currentMenuId != $controller[$i]['menuId']){
                // Assign variables.
                $currentMenuId = $controller[$i]['menuId'];
                $id = $controller[$i]['id'];
                $images = $controller[$i]['image'];
                $image_path = "images/food/";
                $image = $image_path.=$images;
                $description = $controller[$i]['description'];
                
                // Set counter to 1.
                $counter = 1;

                // Start a new row.
                echo "<div>
                        <hr><center><h3>" . $controller[$i]['title'] . "</h3></center><br><hr>
                      </div>";
                echo "<div class='row'>";

                // Establish div.
                echo "<div class='col px-md-5'><div class='p-3'><center>";

                // Insert image of the item.
                echo "<img src='$image' style='width:180px;height:180px;'><br><br>";
                
                // Print out item_name and price.
                echo "<b>" . $controller[$i]['item_name'] . "</b><br>";
                echo "<i>" . $controller[$i]['description'] . "</i><br>";
                echo "$" . $controller[$i]['price'] . "<br>";
               

                // If coming from reviewOrder.php, retain order information.
                if (array_key_exists($id, $_GET)){
                    foreach($_GET as $key=>$val){
                        if ($id == $key){
                            echo "<select name=$id>";
                            for ($j = 0; $j <= 10; $j++){
                                if ($j == $val){
                                    echo "<option value=$j selected>$j</option>";
                                } else {
                                    echo "<option value=$j>$j</option>";
                                }
                            }
                            echo "</select><br><br>";      
                        }
                    }
                } else {
                    echo "<select name=$id id=$id>";
                    for ($j = 0; $j <= 10; $j++){
                        echo "<option value=$j>$j</option>";
                    }
                    echo "</select><br><br>";
                }
                echo "<center><br><br></div></div>";

                
            } else {
                // Assign variables.
                $currentMenuId = $controller[$i]['menuId'];
                $id = $controller[$i]['id'];
                $images = $controller[$i]['image'];
                $image_path = "images/food/";
                $image = $image_path.=$images;

                // Increase counter by 1.
                $counter = $counter + 1;

                // Establish div.
                echo "<div class='col px-md-5'><div class='p-3'><center>";

                // Insert image of the item.
                echo "<img src='$image' style='width:180px;height:180px;'><br><br>";

                // Print out item_name and price
                echo "<b>" . $controller[$i]['item_name'] . "</b><br>";
                echo "<i>" . $controller[$i]['description'] . "</i><br>";
                echo "$" . $controller[$i]['price'] . "<br>";

                // If coming from reviewOrder.php, retain order information.
                if (array_key_exists($id, $_GET)){
                    foreach($_GET as $key=>$val){
                        if ($id == $key){
                            echo "<select name=$id>";
                            for ($j = 0; $j <= 10; $j++){
                                if ($j == $val){
                                    echo "<option value=$j selected>$j</option>";
                                } else {
                                    echo "<option value=$j>$j</option>";
                                }
                            }
                            echo "</select><br><br>";      
                        }
                    }
                } else {
                    echo "<select name=$id id=$id>";
                    for ($j = 0; $j <= 10; $j++){
                        echo "<option value=$j>$j</option>";
                    }
                    echo "</select><br><br>";
                }
                
                echo "</center><br><br></div></div>";

                // Print only 2 items per row. 
                //if ($counter%2==0){
                //  echo "</div>";
                //    echo "<div class='row'>";
                // }

                // Check if reach end-of-array or next item has a different menuId.
                if ($i == count($controller)-1 || $currentMenuId != $controller[$i+1]['menuId']){         
                    // If counter is not even, initialize empty column to maintain form layout.     
                    if ($counter%2 != 0) {
                        echo "<div class='col px-md-5'><div class='p-5'><center>";
                        echo "</center></div></div>";
                    }
                    echo "</div><br>";
                }
            }
        }
        // Save promo code, comments, and table number if editing order.
        if (isset($_GET['promo'])){
            $promo = $_GET['promo'];
            echo "<input type='hidden' name='promo' value='$promo'>";
        }

        if (isset($_GET['comment'])){
            $comment = $_GET['comment'];
            echo "<input type='hidden' name='comment' value='$comment'>";
        }

        if (isset($_GET['table_code'])){
            $table_code = $_GET['table_code'];
            echo "<input type='hidden' name='table_code' value='$table_code'>";
        }

        // Submit button.
        echo "<center><input type='submit' class='btn btn-outline-primary' value='Review Order'></center><br>";       

        // End of form
        echo "</form>";
    }

    // Review Order GUI
    public function reviewOrders($input){
        // Retrieve items that customer has ordered.
        $controller = $this->retrieveOrdersInfo($input);

        // If promo code is entered, retrieve promo code table.
        if (empty($input['promo'])){
            $discount = 0;
        } else {
            $promoCode=$input['promo'];
            $discount = $this->checkPromoCode($promoCode);
        }

        // Initialize parameters that will be used later.
        $sum = 0;

        // Start of form
        echo "<form action='checkout.php' method='GET'>";
            // Start of table
            echo "<table style = 'margin-left:auto; margin-right:auto'>";  
                // Table header.
                echo "<tr>";
                    echo "<td><pre>                                </pre></td>";
                    echo "<td><h4><b>   Item   </b></h4></td>";
                    echo "<td><pre><h4><b>   Price   </b></h4></pre></td>";
                    echo "<td><h4><b>   Quantity   </b></h4></td>";
                    echo "<td><pre><h4><b>   Total   </b></h4></pre></td>";
                echo "</tr>"; 

                // Print out items that customer has ordered.
                foreach ($input as $key=>$val){            
                    // Only process if ordered quantity is more than 1
                    if ($val>0){
                        // Retrieving index from array returned from controller.    
                        $index = array_search($key, array_column($controller, 'id'));

                        // Retrieving information from the index.
                        if (is_int($key)){
                            // Set variables
                            $id = $controller[$index]['id'];  
                            $quantity = $val;
                            $images = $controller[$index]['image']; 
                            $image_path = "images/food/";
                            $image = $image_path.=$images;
                            $item_name = $controller[$index]['item_name'];
                            $price = $controller[$index]['price'];
                            $total = $price * $quantity;
                            $sum = $sum + $total;     


                           

                            // Check promo code is valid or not.
                            if ($discount != -1){
                                $discountInDollars = $sum * $discount;
                                $grand_total = $sum-$discountInDollars;                          
                            } else {
                                $discountInDollars = 0;
                                $grand_total = $sum;
                            }    
                            
                            // Establish hidden inputs for form.
                            echo "<input type='hidden' name=$id value=$quantity>"; 

                             // Insert item's information in each table row.
                            echo "<tr>";
                                echo "<td><center><img src='$image' style='width:70px;height:70px;'</center></td>";     
                                echo "<td><center>$item_name</center></td>";
                                echo "<td><center>$$price</center></td>";
                                echo "<td><center>$quantity</center></td>";
                                echo "<td><center>$$total</center></td>";
                            echo "</tr>";
                        }
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
                    echo "Total: $$sum";
                    echo "</h5></td>";
                
                    // Append $sum to $input.
                    echo "<input type='hidden' name='total' value=$sum>"; 
                echo "</tr>";

                // Display total discount.
                echo "<tr>";
                    echo "<td><pre> </pre></td>";
                    echo "<td><pre> </pre></td>";
                    echo "<td><pre> </pre></td>";
                    echo "<td><pre> </pre></td>";
                    echo "<td style='text-align:left'><h5>";
                        echo "Discount: $$discountInDollars";
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

                // Get grand total as hidden input.
                echo "<input type='hidden' name='grand_total' value='$grand_total'>";

                // End of table   
                echo "</table>";
                echo "<br><br>";

            // Promo Code
            echo "&nbsp<label for='promo' style='text-align:center;'> Promo Code: </label>";
            if ($discount>0){
                echo "<div class='input-group'>";
                    echo "&nbsp;&nbsp;<input type='text' name='promo' class='form-control' value=$promoCode readonly>";
                    echo "<pre> </pre>";
                    echo "<input type='submit' class='btn btn-outline-primary' formaction='reviewOrder.php' value='Apply' disabled>";
            echo "</div><br>";  
            } else if ($discount==-1) {
                echo "<div class='input-group'>";
                    echo "&nbsp&nbsp<input type='text' name='promo' class='form-control' placeholder='Code is invalid!'>";
                    echo "<pre> </pre>";
                    echo "<input type='submit' class='btn btn-outline-primary' formaction='reviewOrder.php' value='Apply'>";

                echo "</div><br>";  
            } else {
                echo "<div class='input-group'>";
                echo "&nbsp&nbsp<input type='text' name='promo' class='form-control'>";
                echo "<pre> </pre>";
                echo "&nbsp;&nbsp;<input type='submit' class='btn btn-outline-primary' formaction='reviewOrder.php' value='Apply'>";
            echo "</div><br>";     
            }

            // Comment Section
            if (empty($input['comment'])){
                echo "<div>";
                echo "&nbsp<label for='comment'>Comments: </label>";
                echo "<input type='text' name='comment' class='form-control' value=''>";
                echo "</div><br>"; 
            } else {
                $comment = $input['comment'];
                echo "<div>";
                echo "&nbsp<label for='comment'>Comments: </label>";
                echo "<input type='text' name='comment' class='form-control' value='$comment'>";
                echo "</div><br>"; 
            }
                
            // Table Code
            echo "<div class='input-group'>";
                echo "&nbsp<label for='table_code'>Table Number: </label>";   
                if (empty($input['table_code'])){
                    echo "<select name='table_code'>";
                        for ($i=1; $i<=10; $i++){
                            echo "<option value=$i>$i</option>";
                        }
                    echo "</select>"; 
                } else {
                    $table_code = $input['table_code'];
                    echo "<select name='table_code'>";
                        for ($i=1; $i<=10; $i++){
                            if ($table_code == $i){
                                echo "<option value=$i selected>$i</option>";
                            } else {
                                echo "<option value=$i>$i</option>";                            
                            }
                        }
                    echo "</select>";                          
                }
            echo "</div><br>";

            // Submit buttons.
            echo "<center><input type='submit' class='btn btn-outline-primary' formaction='menu.php' value='Edit Order'><br><br>";
        
            echo "<input type='submit' class='btn btn-outline-primary' value='Pay'></center><br>";

            // End of form
            echo "</form>";   
    } 
}
?>