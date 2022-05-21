<?php
class menuBoundary extends menuController{
    public function displayPrevOrders(){
        // Retrieve open orders.
        $datas = $this->retrievePrevOrders();
        
        // Display each open orders separately.
        for ($i=0; $i<count($datas); $i++){

            echo "<table style='margin-left:auto; margin-right:auto; border:0.1px solid grey;'>";
                echo "<tr>";
                    // Print Order ID
                    echo "<td style='width:40%'>";
                        echo "<b>Order ID: " . $datas[$i]['id'] . "</b>"; 
                    echo "</td>";

                    // Print table number
                    echo "<td style='width:30%'>";
                        echo "<b><center>Table: " . $datas[$i]['table_code'] . "</b></center>";
                    echo "</td>";

                    // Print customer name
                    echo "<td style='text-align:right;width:30%'>";
                        echo "<b>" . $datas[$i]['Name'] . "</b>";
                    echo "</td>";
                echo "</tr>";

                // Print horizontal line
                echo "<td colspan=3><center><hr width=380px></center></td>";

                // Print headers
                echo "<tr>";
                    echo "<td><b><center>Item</center></b></td>";
                    echo "<td><b><center>Quantity</center></b></td>";
                    echo "<td><b><center>Price</center></b></td>";
                echo "</tr>";

                // Print order item information.
                $foodInOrder = count($datas[$i]) - 8;
                for ($j=0; $j<$foodInOrder; $j++){
                    echo "<tr>";
                        // Food name
                        echo "<td>";
                            echo $datas[$i][$j]['item_name'];
                        echo "</td>";
                            
                        // Quantity
                        echo "<td>";
                            echo "<center>" . $datas[$i][$j]['quantity'] . "</center>";
                        echo "</td>";  
                            
                        // Price.
                        $totalPrice = $datas[$i][$j]['quantity'] * $datas[$i][$j]['price'];
                        echo "<td>";
                           echo "<center>$" . number_format($totalPrice,2) . "</center>";
                        echo "</td>";  
                    echo "</tr>";
                }
                        
                // Blank row for formatting
                echo "<tr colspan='3'>";
                    echo "<td><pre> </pre></td>";
                echo "</tr>";

                // Print total
                echo "<tr>";
                    echo "<td><pre> </pre></td>";
                    echo "<td style='text-align:right'>";
                        echo "<b>Total: </b>";
                    echo "</td>";
                    echo "<td style='text-align:center'>";
                        echo "<b>$" . number_format($datas[$i]['total'],2) . "</b>";
                    echo "</td>";
                echo "</tr>";

                // Print discount
                $discount = $datas[$i]['total'] - $datas[$i]['grand_total'];
                echo "<tr>";
                    echo "<td><pre> </pre></td>";
                        echo "<td style='text-align:right'>";
                        echo "<b>Discount: </b>";
                    echo "</td>";
                    echo "<td style='text-align:center'>";
                        echo "<b>$" . number_format($discount,2) . "</b>";
                    echo "</td>";
                echo "</tr>";
                        
                // Grand total
                echo "<tr>";
                    echo "<td><pre> </pre></td>";
                        echo "<td style='text-align:right'>";
                            echo "<b>Grand total: </b>";
                        echo "</td>";
                    echo "<td style='text-align:center'>";
                        echo "<b>$" . number_format($datas[$i]['grand_total'],2) . "</b>";
                    echo "</td>";
                echo "</tr>";
                        
                // Print comment.
                echo "<tr><pre> </pre></tr>";
                echo "<tr>";
                    echo "<td colspan=3><center><hr width=380px></center></td>";
                echo "</tr>";

                echo "<tr>";
                    echo "<td colspan=3> Comment: " . $datas[$i]['comment'] . "</td>";
                echo "</tr>";

                // Print created_at.
                echo "<tr>";
                    echo "<td colspan=3> <b>Order Opened On: </b>" . $datas[$i]['created_at'] . "</td>";
                echo "</tr>";
                        
                // Print closed at.
                echo "<tr>";
                    echo "<td colspan=3><b>Order Closed On: </b>" . $datas[$i]['closed_at'] . "</td>";
                echo "</tr>";      
            echo "</table>";
        }
    }    
}
?>
