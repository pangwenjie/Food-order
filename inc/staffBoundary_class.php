<?php
class staffBoundary extends staffController{
    public function displayOpenOrders(){
        // Retrieve open orders.
        $datas = $this->retrieveOpenOrders();
        
        // Display each open orders separately.
        for ($i=0; $i<count($datas); $i++){
            echo "<div class='card'>";
            echo "<div class='card-body'>";
                echo "<form action='completeOrder.php' method='GET'>";
                    echo "<table style = 'margin-left:auto; margin-right:auto; border:0.1px solid grey;'>";
                        echo "<tr>";
                            // Print Order ID
                            echo "<td style='width:40%'>";
                                echo "<b>Order ID: " . $datas[$i]['id'] . "</b>"; 
                            echo "</td>";

                            // Print table number
                            echo "<td style='width:23%'>";
                                echo "<b><center>Table: " . $datas[$i]['table_code'] . "</b></center>";
                            echo "</td>";
                            echo "<td style='text-align:right;width:34%'>";
                                echo "<b>" . $datas[$i]['Name'] . "</b>";
                            echo "</td>";
                        echo "</tr>";

                        echo "<tr><br>";
                            // Print horizontal line.
                            echo "<td colspan='3'>";
                                echo "<hr width=700px>";
                            echo "</td>";
                        echo "</tr>";

                        echo "<tr>";
                            // Print headers.
                            echo "<td>";
                                echo "<b><center> Item </b></center>";
                            echo "</td>";
                            echo "<td>";
                                echo "<b><center> Quantity </b></center>";
                            echo "</td>";
                            echo "<td>";
                                echo "<b><center> Price </b></center>";
                            echo "</td>";
                        echo "</tr>";

                        // Print order item information.
                        $foodInOrder = count($datas[$i]) - 6;

                        for ($j=0; $j<$foodInOrder; $j++){
                            // Print food name.
                            echo "<tr>";
                                echo "<td>";
                                    echo $j+1 . ". ". $datas[$i][$j]['item_name'];
                                echo "</td>";
                            
                            // Print quantity.
                                echo "<td>";
                                    echo "<center>" . $datas[$i][$j]['quantity'] . "</center>";
                                echo "</td>";  
                            
                            // Print price.
                            $totalPrice = $datas[$i][$j]['quantity'] * $datas[$i][$j]['price'];
                                echo "<td>";
                                    echo "<center>$" . number_format($totalPrice,2) . "</center>";
                                echo "</td>";  
                            echo "</tr>";
                        }
                        
                        // Blank row for formatting
                        echo "<tr>";
                            echo "<td colspan=3> &nbsp; </td>";
                        echo "</tr>";

                        // Print total
                        echo "<tr>";
                            echo "<td>";
                                echo "<b>Total</b>";
                            echo "</td>";
                            echo "<td></td>";
                            echo "<td style='text-align:center'>";
                                echo "<b>$" . number_format($datas[$i]['total'],2) . "</b>";
                            echo "</td>";
                        echo "</tr>";

                        // Print discount
                        $discount = $datas[$i]['total'] - $datas[$i]['grand_total'];
                        echo "<tr>";
                            echo "<td>";
                                echo "<b>Discount</b>";
                            echo "</td>";
                            echo "<td></td>";
                            echo "<td style='text-align:center'>";
                                echo "<b>$" . number_format($discount,2) . "</b>";
                            echo "</td>";
                        echo "</tr>";
                        
                        // Grand total
                        echo "<tr>";
                            echo "<td>";
                                echo "<b>Grand total</b>";
                            echo "</td>";
                            echo "<td></td>";
                            echo "<td style='text-align:center'>";
                                echo "<b>$" . number_format($datas[$i]['grand_total'],2) . "</b>";
                            echo "</td>";
                        echo "</tr>";
                        
                        // Print comment.
                        echo "<tr>";
                            echo "<td colspan=3><hr width=700px></td>";
                        echo "</tr>";

                        echo "<tr>";
                            echo "<td colspan=3> Comment: " . $datas[$i]['comment'] . "</td>";
                        echo "</tr>";

                        // Button to close order.
                        echo "<tr>";
                            echo "<td colspan=3>&nbsp;</td>";
                        echo "</tr>";       
                        
                        echo "<tr>";
                            echo "<td colspan='3'>";
                                echo "<center><input type='submit' class='btn btn-outline-primary' value='Close Order'></center>";
                                echo "<br/>";
                            echo "</td>";
                        echo "</tr>";
                        
                
                        // Establish hidden input in form.
                        $id = $datas[$i]['id'];
                        echo "<input type='hidden' name='orderId' value=$id>";            
                    echo "</table>";
                echo "</form>";
            echo "</div>";
            echo "</div><br>";
        }
    }    

    public function completeOrder($input){
        // Retrieve orderId.
        $orderId = $input['orderId'];

        // Call controller class
        $controller = $this->retrieveAndCloseOrder($orderId);
        
        // Once successful, redirect user back to staffInterface.php
        header("Location:staffInterface.php");
    }
    
}
?>