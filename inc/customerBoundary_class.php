<?php
class customerBoundary extends customerController{
    public function displayOpenOrders(){
        // Retrieve open orders.
        $datas = $this->retrieveOpenOrders();
        
        // Display each open orders separately.
        for ($i=0; $i<count($datas); $i++){
         
                echo "<form action='completeOrder.php' method='GET'>";
                    echo "<table style = 'margin-left:auto; margin-right:auto; border:0.1px solid grey;'>";
                        echo "<tr>";
                            // Print Order ID
                            echo "<td style='width:10%'>";
                                echo "<b><center>Order ID: " . $datas[$i]['id'] . "</center></b>"; 
                            echo "</td>";

                            // Print table number
                            echo "<td style='width:23%'>";
                                echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>Table: " . $datas[$i]['table_code'] . "</b>";
                            echo "</td>";
                            echo "<td style='text-align:left;width:34%'>";
                                echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>" . $datas[$i]['Name'] . "</b>";
                            echo "</td>";
                        echo "</tr>";

                        echo "<tr><br>";
                            // Print horizontal line.
                            echo "<td colspan='3'>";
                                echo "<hr width=400px>";
                            echo "</td>";
                        echo "</tr>";

                        echo "<tr>";
                            // Print headers.
                            echo "<td>";
                                echo "<b>Item </b>";
                            echo "</td>";
                            echo "<td>";
                                echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b> Quantity </b>";
                            echo "</td>";
                            echo "<td>";
                                echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b> Price </b>";
                            echo "</td>";
                        echo "</tr>";

                        // Print order item information.
                        $foodInOrder = count($datas[$i]) - 8;

                        for ($j=0; $j<$foodInOrder; $j++){
                            // Print food name.
                            echo "<tr>";
                                echo "<td>";
                                    echo $j+1 . ". ". $datas[$i][$j]['item_name'];
                                echo "</td>";
                            
                            // Print quantity.
                                echo "<td>";
                                    echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $datas[$i][$j]['quantity'] . "";
                                echo "</td>";  
                            
                            // Print price.
                            $totalPrice = $datas[$i][$j]['quantity'] * $datas[$i][$j]['price'];
                                echo "<td>";
                                    echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp$" . number_format($totalPrice,2) . "";
                                echo "</td>";  
                            echo "</tr>";
                        }
                        
                        // Blank row for formatting
                        echo "<tr>";
                            echo "<td colspan=2> &nbsp; </td>";
                        echo "</tr>";

                        // Print total
                        echo "<tr>";
                            echo "<td>";
                                echo "<b>Total: </b>";
                            echo "</td>";
                            echo "<td style='text-align:Left'>";
                                echo "<b>$" . number_format($datas[$i]['total'],2) . "</b>";
                            echo "</td>";
                        echo "</tr>";

                        // Print discount
                        $discount = $datas[$i]['total'] - $datas[$i]['grand_total'];
                        echo "<tr>";
                            echo "<td>";
                                echo "<b>Discount</b>";
                            echo "</td>";
                            echo "<td style='text-align:Left'>";
                                echo "<b>$" . number_format($discount,2) . "</b>";
                            echo "</td>";
                        echo "</tr>";
                        
                        // Grand total
                        echo "<tr>";
                            echo "<td>";
                                echo "<b>Grand total</b>";
                            echo "</td>";
                            echo "<td style='text-align:left'>";
                                echo "<b>$" . number_format($datas[$i]['grand_total'],2) . "</b>";
                            echo "</td>";
                        echo "</tr>";
                        
                        // Print comment.
                        echo "<tr>";
                            echo "<td colspan=3><hr width=380px></td>";
                        echo "</tr>";

                        echo "<tr>";
                            echo "<td colspan=3> Comment: " . $datas[$i]['comment'] . "</td>";
                        echo "</tr>";

                        // Print created_at.
                        echo "<tr>";
                        echo "<td colspan=3> <b>Order Created On: </b>" . $datas[$i]['created_at'] . "</td>";
                        echo "</tr>";
                        
                        // Print closed at.
                        echo "<tr>";
                        echo "<td colspan=3><b>Order Closed On: </b>" . $datas[$i]['closed_at'] . "</td>";
                        echo "</tr>";
                        

                        // Button to close order.
                        echo "<tr>";
                            echo "<td colspan=3>&nbsp;</td>";
                        echo "</tr>";       
                        
                        echo "<tr>";
                            echo "<td>";
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