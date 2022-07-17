 $(document).ready(function(){
	$(document).on('click', '#checkAll', function() {          	
		$(".itemRow").prop("checked", this.checked);
	});	
	$(document).on('click', '.itemRow', function() {  	
		if ($('.itemRow:checked').length == $('.itemRow').length) {
			$('#checkAll').prop('checked', true);
		} else {
			$('#checkAll').prop('checked', false);
		}
	});  
	var count = $(".itemRow").length;
	$(document).on('click', '#addRows', function() { 
		count++;
		var htmlRows = '';
		htmlRows += '<tr>';
		htmlRows += '<td><div class="custom-control custom-checkbox"> <input type="checkbox" class="custom-control-input itemRow" id="itemRow_'+count+'"> <label class="custom-control-label" for="itemRow_'+count+'"></label> </div></td>';          
		htmlRows += '<td><input type="text" name="productCode[]" id="productCode_'+count+'" class="form-control" autocomplete="off"></td>';          
		 htmlRows += '<td><input type="number" name="quantity[]" id="quantity_'+count+'" class="form-control quantity" autocomplete="off"></td>';   		
		htmlRows += '<td><input type="number" name="price[]" id="price_'+count+'" class="form-control price" autocomplete="off"></td>';		 
		htmlRows += '<td><input type="number" name="total[]" id="total_'+count+'" class="form-control total" autocomplete="off"></td>';          
		htmlRows += '</tr>';
		$('#fuelItem').append(htmlRows);
	}); 
	$(document).on('click', '#removeRows', function(){
		$(".itemRow:checked").each(function() {
			$(this).closest('tr').remove();
		});
		$('#checkAll').prop('checked', false);
		calculateTotal();
	});		
	$(document).on('blur', "[id^=quantity_]", function(){
		calculateTotal();
	});	
	$(document).on('blur', "[id^=price_]", function(){
		calculateTotal();
	});	
	$(document).on('change', "#taxRate", function(){		
		calculateTotal();
	});	
	$(document).on('blur', "#amountPaid", function(){
		var amountPaid = $(this).val();
		var totalAftertax = $('#totalAftertax').val();	
		if(amountPaid && totalAftertax) {
			totalAftertax = totalAftertax-amountPaid;			
			$('#amountDue').val(totalAftertax);
		} else {
			$('#amountDue').val(totalAftertax);
		}
		 
	});	
	$('#fuel_type').on('change',function(){
		$('#fuel_btn').removeAttr('disabled');
		var fuel_type = $('#fuel_type').find(":selected").text();
		$(".fuel_typea").html(fuel_type);
		 
	})
	$('#monthly').on('change',function(){
		$('#fuel_type').removeAttr('disabled');
		 
	})
	 
});	
function calculateTotal(){
	 
	var totalAmount = 0; 
	var quantity;
	var totalquantity=0;
	$("[id^='price_']").each(function() {
		var id = $(this).attr('id');
		id = id.replace("price_",'');
		var price = $('#price_'+id).val();
		 quantity  = $('#quantity_'+id).val();
		if(!quantity) {
			quantity = 1;
		}
		var total = price*quantity;
		$('#total_'+id).val(parseFloat(total));
		totalAmount += total;	
		totalquantity += parseInt(quantity);			
	});
	$('#subTotal').val(parseFloat(totalAmount));	
	var taxRate = $("#taxRate").val();
	var subTotal = $('#subTotal').val();
	var fuel_type = $('#fuel_type').find(":selected").text();
	var fuel_avg=(subTotal/totalquantity).toFixed(2)
	$("#total_amt").html(subTotal);	
	$(".fuel_typea").html(fuel_type);
	$("#liters").html(totalquantity)
	$(".fuel_avg").html(fuel_avg)

	
	if(subTotal>0){
		$('#fuel_btn').removeAttr('disabled');
	}else{
		$('#fuel_btn').attr('disabled','disabled');
	}

	
}


 