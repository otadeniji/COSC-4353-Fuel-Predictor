<?php
	session_start();
		$uId = $_SESSION['id'];

	if( $uId == null || $uId == '' ){
		header("Location: ./login_view.php");
		exit();
	}
?>

<?php require_once(dirname(__FILE__) . './controllers/fuel_qoutes_history.php'); ?>
<?php include('./header.php'); ?>


    <div class="container-fluid">
        <div class="row" style="margin:100px;">
            <div class="col-md-12">
                <div class="page-header clearfix row">

					<div class="col-sm-6"> <h2 class="float-left">Fuel Qoutes History </h2> </div>
					<div class="col-sm-6"> <a href="./fuel_qoutes_view.php" class="btn btn-success float-right">Add New Fuel Qoute</a> </div>
                    
                </div>
                <?php

					
                    
                echo "<table class='table table-bordered table-striped' style='margin-top: 100px;'>";
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th>#</th>";
                            echo "<th>Gallons</th>";
                            echo "<th>Delivery Address</th>";
                            echo "<th>Delivery Date</th>";
                            echo "<th>Suggested Price Per Gallon</th>";
                            echo "<th>Total Amount Due</th>";

                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
					if($result != null){

						
						if(mysqli_num_rows($result) > 0){
	
							foreach ($result as $link => $row) {
								echo "<tr>";
									echo "<td>" . $row['id'] . "</td>";
									echo "<td>" . $row['Gallons'] . "</td>";
									echo "<td>" . $row['Delivery_Address'] . "</td>";
									echo "<td>" . $row['Delivery_Date'] . "</td>";
									echo "<td>" . $row['Suggested_Price_Per_Gallon'] . "</td>";
									echo "<td>" . $row['Total_Amount_Due'] . "</td>";
									echo "<td>" . $row['userId'] . "</td>";
								echo "</tr>";
							}
						}
					}
					else{
						echo "<tr><td>No Fuel Purchased history found. You are a new Client!!!</td></tr>";
					}
                    echo "</tbody>";                            
                echo "</table>";
                ?>
            </div>
        </div>        
    </div>

</body>

</html>