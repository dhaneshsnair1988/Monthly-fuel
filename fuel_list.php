<?php 
session_start();
include('header.php');
include 'fuel.php';
$fuel = new Fuel();
$fuel->checkLoggedIn();
?>
<title>Fuel App</title>
<script src="js/fuel.js"></script>
<link href="css/style.css" rel="stylesheet">
<?php include('container.php');?>
	<div class="container">		
	  <h2 class="title mt-5">  Fuel APP</h2>
	  <?php include('menu.php');?>			  
      <table id="data-table" class="table table-condensed table-hover table-striped">
        <thead>
          <tr>
            <th>fuel No.</th>
            <th>Fuel Type</th>
            <th>Month</th>
            <th>Total</th>
              <th>Edit</th>
           
          </tr>
        </thead>
        <?php		
	    	$fuelList = $fuel->getfuelList();
        
        foreach($fuelList as $fuelDetails){
          $month_of_order=$fuelDetails["month_of_order"];
          switch ($fuelDetails["type_of_fuel"]) {
            case "1":
             $type_of_fuel="Diesel";
              break;
            case "2":
              $type_of_fuel="Super E10";
              break;
            case "3":
              $type_of_fuel="Super";
              break;
            default:
            $type_of_fuel="Super +";
          }
            echo '
              <tr>
                <td>'.$fuelDetails["order_id"].'</td>
                <td>'.$type_of_fuel.'</td>
                <td>'.$month_of_order.'</td>
                <td>'.$fuelDetails["order_amount_paid"].' € </td>
                 <td><a href="edit_fuel.php?update_id='.$fuelDetails["order_id"].'"  title="Edit fuel"><button class="btn btn-success btn-sm"><i class="fa fa-edit"></i></button></a></td>
               
              </tr>
            ';
        }       
        ?>
      </table>	
</div>	
<?php include('footer.php');?>