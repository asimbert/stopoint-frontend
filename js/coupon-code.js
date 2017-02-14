function applyCouponCode(index,condition){
	var coupon_code = $("#coupon_code_"+index).val();
	var model = $("#model").val();
	
	$.ajax({
		type:"GET",
		url : "/apply-coupon-code.php",
		data : "coupon_code="+coupon_code + "&model="+model + "&condition="+condition + "&index="+index,
		async: false,
		success : function(response) {
			data = response;
			return response;
		},
		error: function() {
			alert('Error occured'+response);
		}
	});
	var price = $("#old_price_"+index).val();
	var arr = data.split(";");
	var status = arr[1];
	if(status == "INVALID"){
		$(".alert_"+index).removeClass("alert-success");
		$(".alert_"+index).addClass("alert-warning display-block");
		$(".alert_"+index).html(arr[2]);
		
		$("#price_text_"+index).html("$" + price);
		$("#price_"+index).val(price);
		
	}else{
		var discount_price = arr[3];
		var after_discount = Math.round(parseFloat(price)+parseFloat(discount_price));
		$(".alert_"+index).removeClass("alert-warning");
		$(".alert_"+index).addClass("alert-success display-block");
		$(".alert_"+index).html(arr[2]);
		
		$("#price_text_"+index).html(price + "+" + discount_price + "=" + after_discount);
		$("#price_"+index).val(after_discount);
	}
}

function removeCouponCode(coupon_code, index, condition){
	var coupon_code = $("#coupon_code_"+index).val();
	var model = $("#model").val();
	
	$.ajax({
		type:"GET",
		url : "/remove-coupon-code.php",
		data : "coupon_code="+coupon_code + "&model="+model + "&condition="+condition + "&index="+index,
		async: false,
		success : function(response) {
			data = response;
			return response;
		},
		error: function() {
			alert('Error occured');
		}
	});
	var price = $("#old_price_"+index).val();
	
	$(".alert_"+index).removeClass("alert-success");
	$(".alert_"+index).addClass("alert-warning display-block");
	$(".alert_"+index).html("Coupon Code removed successfully.");
	
	$("#price_text_"+index).html("$" + price);
	$("#price_"+index).val(price);
}
  $( function() {
	  if($( "#coupon_code" ).val() != ""){
		  var ind = $( "#coupon_code_index" ).val();
		  var cond = $( "#coupon_code_condition" ).val();
		 $("#coupon_code_"+ind).val($( "#coupon_code" ).val());
	     applyCouponCode(ind,cond) 
	  }
	  
  } );