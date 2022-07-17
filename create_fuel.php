<?php
session_start();
include('header.php');
include 'fuel.php';
$fuel = new Fuel();
$fuel->checkLoggedIn();

if (!empty($_POST)) {
   if (empty(trim($_POST['companyName']))) {
      $_POST['companyName'] = "DEMO_" . rand(100, 3000);
      $_POST['address'] = "DEMO Address";
   }

//   echo '<pre>';print_r($_POST);exit;
   $fuel->savefuel($_POST);
   header("Location:fuel_list.php");
}
?>
<title>Fuel System</title>
<script src="js/fuel.js"></script>
<link href="css/style.css" rel="stylesheet">
<?php include('container.php'); ?>
<div class="container content-fuel">
   <div class="cards">
      <div class="card-bodys">
         <form action="" id="fuel-form" method="post" class="fuel-form" role="form" novalidate="">
            <div class="load-animate animated fadeInUp">
               <div class="row">
                  <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                     <h2 class="title">Fuel System</h2>
                     <?php include('menu.php'); ?>
                  </div>
               </div>
               <input id="currency" type="hidden" value="$">
               <div class="row">






                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                     <div class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                        <div class="form-group mt-3 mb-3 ">
                        <label>Tank Month: &nbsp;</label>
                        <div class="input-group mb-3">
                           <select class="form-select form-control" id="monthly" name="monthly">
                              <option value="JAN">January</option>
                              <option value="FEB">February</option>
                              <option value="MAR">March</option>
                              <option value="APR">April</option>
                              <option value="MAY">May</option>
                              <option value="JUN">June</option>
                              <option value="JUL">July</option>
                              <option value="AUG">August</option>
                              <option value="SEP">September</option>
                              <option value="OCT">October</option>
                              <option value="NOV">November</option>
                              <option value="DEC">December</option>
                           </select>
                        </div>
                        </div>
                        </div>

                     </div>
                     <div class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                           <div class="form-group mt-3 mb-3 ">
                              <label>Fuel type: &nbsp;</label>
                              <div class="input-group mb-3">

                                 <select class="form-select form-control" aria-label="Tax rate" id="fuel_type" name="fuel_type">
                                    <option value="1">Diesel</option>
                                    <option value="2">Super E10</option>
                                    <option value="3">Super</option>
                                    <option value="4">Super+</option>
                                 </select>
                              </div>
                           </div>
                        </div>

                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                     <table class="table table-condensed table-striped" id="fuelItem">
                        <tr>
                           <th width="2%">
                              <div class="custom-control custom-checkbox mb-3">
                                 <input type="checkbox" class="custom-control-input" id="checkAll" name="checkAll">
                                 <label class="custom-control-label" for="checkAll"></label>
                              </div>
                           </th>
                           <th width="15%">No</th>
                           <th width="38%">Tank filling</th>
                           <th width="15%">Price</th>
                           <th width="15%">Total</th>
                        </tr>
                        <tr>
                           <td>
                              <div class="custom-control custom-checkbox">
                                 <input type="checkbox" class="itemRow custom-control-input" id="itemRow_1">
                                 <label class="custom-control-label" for="itemRow_1"></label>
                              </div>
                           </td>
                           <td><input type="text" name="productCode[]" id="productCode_1" class="form-control" autocomplete="off"></td>
                            <td><input type="number" name="quantity[]" id="quantity_1" class="form-control quantity" autocomplete="off"></td>
                           <td><input type="number" name="price[]" id="price_1" class="form-control price" autocomplete="off"></td>
                           <td><input type="number" name="total[]" id="total_1" class="form-control total" autocomplete="off"></td>
                        </tr>
                     </table>
                  </div>
               </div>
               <div class="row">
                  <div class="col-xs-12">
                     <button class="btn btn-danger delete" id="removeRows" type="button">- Delete</button>
                     <button class="btn btn-success" id="addRows" type="button">+ Add More</button>
                  </div>
               </div>
               <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                     <div class="form-group mt-3 mb-3 ">
                        <label>Total &nbsp;</label>
                        <div class="input-group mb-3">
                           <div class="input-group-prepend">
                              <span class="input-group-text currency">€</span>
                           </div>
                           <input value="" type="number" class="form-control" name="subTotal" id="subTotal" placeholder="Total">
                        </div>
                     </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                     <div class="form-group mt-3 mb-3 ">
                        <div class="input-group mb-3">
                            
                           Your monthly fuel costs for    &nbsp; <span id="liters"> __</span>      &nbsp; liters of   &nbsp;    <span class="fuel_typea">_</span>   &nbsp; are   &nbsp; <span id="total_amt">0</span> €.
                           &nbsp;The average price for   &nbsp;  <span class="fuel_typea">__</span>    &nbsp; is    &nbsp; <span class="fuel_avg"></span>   &nbsp; €/liter
                           
                           <!-- <input value="" type="number" class="form-control" name="subTotal" id="subTotal" placeholder="Total"> -->
                        </div>
                     </div>
                  </div>
                  
                   
                   

                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                     <div class="form-group">
                        <input type="hidden" value="<?php echo $_SESSION['userid']; ?>" class="form-control" name="userId">
                        <input disabled data-loading-text="Saving fuel..." type="submit" id="fuel_btn" name="fuel_btn" value="Save fuel" class="btn btn-success submit_btn fuel-save-btm">
                     </div>
                  </div>
               </div>
               <div class="clearfix"></div>
            </div>
         </form>
      </div>
   </div>
</div>
</div>
<?php include('footer.php'); ?>