<?php
session_start();
include('header.php');
include 'fuel.php';
$fuel = new Fuel();
$fuel->checkLoggedIn();
if (!empty($_POST['fuelId']) && $_POST['fuelId']) {
	$fuel->updatefuel($_POST);
	header("Location:fuel_list.php");
}
if (!empty($_GET['update_id']) && $_GET['update_id']) {
	$fuelValues = $fuel->getfuel($_GET['update_id']);
	$fuelItems = $fuel->getfuelItems($_GET['update_id']);
	$month_of_order = $fuelValues['month_of_order'];
	$type_of_fuel_listings = $fuelValues['type_of_fuel'];
}
?>
<title>fuel System</title>
<script src="js/fuel.js"></script>
<link href="css/style.css" rel="stylesheet">
<?php include('container.php'); ?>
<div class="container content-fuel">
	<div class="cards">
		<div class="card-bodys">
			<form action="" id="fuel-form" method="post" class="fuel-form" role="form" novalidate="">
				<div class="load-animate animated fadeInUp">
					<div class="row">
						<div class="col-xs-12">
							<h1 class="title">Fuel System</h1>
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
												<option value="JAN" <?php if ($month_of_order == 'JAN') { echo "selected"; } ?>>January</option>
												<option value="FEB" <?php if ($month_of_order == 'FEB') { echo "selected"; } ?>>February</option>
												<option value="MAR" <?php if ($month_of_order == 'MAR') { echo "selected"; } ?>>March</option>
												<option value="APR" <?php if ($month_of_order == 'APR') { echo "selected"; } ?>>April</option>
												<option value="MAY" <?php if ($month_of_order == 'MAY') { echo "selected"; } ?>>May</option>
												<option value="JUN" <?php if ($month_of_order == 'JUN') { echo "selected"; } ?>>June</option>
												<option value="JUL" <?php if ($month_of_order == 'JUL') { echo "selected"; } ?>>July</option>
												<option value="AUG" <?php if ($month_of_order == 'AUG') { echo "selected"; } ?>>August</option>
												<option value="SEP" <?php if ($month_of_order == 'SEP') { echo "selected"; } ?>>September</option>
												<option value="OCT" <?php if ($month_of_order == 'OCT') { echo "selected"; } ?>>October</option>
												<option value="NOV" <?php if ($month_of_order == 'NOV') { echo "selected"; } ?>>November</option>
												<option value="DEC" <?php if ($month_of_order == 'DEC') { echo "selected"; } ?>>December</option>
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
												<option value="1" <?php if ($type_of_fuel_listings == 1) { $type_of_fuels='Diesel';
																		echo "selected";
																	} ?>>Diesel</option>
												<option value="2" <?php if ($type_of_fuel_listings == 2) {
																		$type_of_fuels='Super E10'; echo "selected";
																	} ?>>Super E10</option>
												<option value="3" <?php if ($type_of_fuel_listings == 3) {
																		$type_of_fuels='Super '; echo "selected";
																	} ?>>Super</option>
												<option value="4" <?php if ($type_of_fuel_listings == 4) {
																		$type_of_fuels='Super + '; echo "selected";
																	} ?>>Super+</option>
											</select>
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
									<?php
									$count = 0;
									$total_quantity=0;
									$total_price=0;
									foreach ($fuelItems as $fuelItem) {
										$count++;
										$total_quantity+=$fuelItem["order_item_quantity"];
										$fuelItem["order_item_price"];
									  	$total_price+=$fuelItem["order_item_final_amount"];
									?>
										<tr>
											<td>
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input itemRow" id="itemRow_<?php echo $count;?>">
													<label class="custom-control-label" for="itemRow_<?php echo $count;?>"></label>
												</div>
											</td>
											<td><input type="text" value="<?php echo $fuelItem["item_code"]; ?>" name="productCode[]" id="productCode_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>
											<td><input type="number" value="<?php echo $fuelItem["order_item_quantity"]; ?>" name="quantity[]" id="quantity_<?php echo $count; ?>" class="form-control quantity" autocomplete="off"></td>
											<td><input type="number" value="<?php echo $fuelItem["order_item_price"]; ?>" name="price[]" id="price_<?php echo $count; ?>" class="form-control price" autocomplete="off"></td>
											<td><input type="number" value="<?php echo $fuelItem["order_item_final_amount"]; ?>" name="total[]" id="total_<?php echo $count; ?>" class="form-control total" autocomplete="off"></td>
											<input type="hidden" value="<?php echo $fuelItem['order_id']; ?>" class="form-control" name="itemId[]">
										</tr>
									<?php } $average_fuel_rate=$total_price/$total_quantity ?>
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
										<input value="<?php echo $fuelValues['order_amount_paid']; ?>" type="number" class="form-control" name="subTotal" id="subTotal" placeholder="Total">
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
								<div class="form-group mt-12 mb-0 ">
									<div class="input-group mb-2">

										Your monthly fuel costs for &nbsp; <span id="liters"><?php echo $total_quantity;?></span> &nbsp; liters of &nbsp; <span class="fuel_typea"><?php echo $type_of_fuels;?></span> &nbsp; are &nbsp; <span id="total_amt"><?php echo $fuelValues['order_amount_paid']; ?></span> €.
										&nbsp;The average price for &nbsp; <span class="fuel_typea"> <?php echo $type_of_fuels;?></span> &nbsp; is &nbsp; <span class="fuel_avg"> <?php echo $average_fuel_rate; ?> </span> &nbsp;  €/liter

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
							<input type="hidden" value="<?php echo $_SESSION['userid']; ?>" class="form-control" name="userId">
							<input type="hidden" value="<?php echo $fuelValues['order_id']; ?>" class="form-control" name="fuelId" id="fuelId">

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