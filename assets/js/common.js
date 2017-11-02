$(document).ready(function () {

	$(document).on('click','.add_to_cart',function(){	

        var productid = $(this).attr('pid');		
        var userid = $('#userid').val();
 var product_price = $('#product_price').val();
 var product_shipping = $('#product_shipping').val();

 var offer = $('#offer').val();
        var checkout = 0;
        var that = $(this);
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: baseurl+"cart/add_to_cart",
            data: {'productid': productid,userid: userid,checkout: checkout,offer: offer,product_price: product_price,product_shipping: product_shipping},
            success: function (data) {				
                if (data.status ==  '1') {
                   that.next('.response').html('<span>' + data.message + '</span>');
                   $('.cart_count').text(data.carcount);
				   
                }else{
					that.next('.response').html('<span>' + data.message + '</span>');
				}
            }
        });
        return false;
    });    

  $(document).on('click','.add_to_cart_save',function(){	

        var productid = $(this).attr('pid');		
        var userid = $('#userid').val();
 var product_price =     $(this).closest('tr').find('#product_price').val();
 var product_shipping = $(this).closest('tr').find('#product_shipping').val();

 var offer = $(this).closest('tr').find('#offer').val();
        var checkout = 0;
        var that = $(this);
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: baseurl+"cart/add_to_cart",
            data: {'productid': productid,userid: userid,checkout: checkout,offer: offer,product_price: product_price,product_shipping: product_shipping},
            success: function (data) {				
                if (data.status ==  '1') {
                   that.next('.response').html('<span>' + data.message + '</span>');
                   $('.cart_count').text(data.carcount);
				   
                }else{
					that.next('.response').html('<span>' + data.message + '</span>');
				}
            }
        });
        return false;
    });    



    $(document).on('click','.cal_tot',function(){	
		
        var cart_id = $(this).closest('tr').attr('cart_id');

        //var product_id = $(this).closest('tr').attr('product_id');

        var product_id = $(this).closest('tr').find('#product_id').val();

        var cart_qty = $(this).closest('tr').find('.quantity').val();
		if(cart_qty == '0')
                {
alert("Please enter atleast one quantity");
return false;
                 }
            $.ajax({				
            type: 'POST',
            dataType: "json",
            url: baseurl+'cart/update_quantity',
            data: {'cart_id': cart_id,cart_qty: cart_qty, product_id: product_id },
            success: function (data) {

           if(data.status == 1){
					window.location.reload();
				}else{
alert("You are purchasing more than quantity");
}

            }
        });
        return false;

    });//end cal_tot
	
	$(document).on('click','.saved_list',function(){	
		
        var productid = $(this).attr('pid');
		
		var userid = $('#userid').val();
		
            $.ajax({				
            type: 'POST',
            dataType: "json",
            url: baseurl+'savedproduct/add_saved_list',
            data: {'productid': productid,userid: userid},
            success: function (data) {
				
                if (data.message !='') {
					$(".data_list").html(data.message);
                   //that.next('.data_list').html('<span>' + data.message + '</span>');
                   $('.cart_count').text(data.carcount);
				   
                }else{
					$(".data_list").html(data.message);
					//that.next('.data_list').html('<span>' + data.message + '</span>');
				}
            }
        });
        return false;

    });//end cal_tot
	
	/*populateCountries('country','state');
	populateCountries('country');
	$("#country option").each(function () {
	   var $this = $(this);
	if($this.attr('value')==$('#country').attr('value'))
	{
	$this.attr('selected','selected');

	}
	$('#state').click(function()
	{
	if($('#country').val()=='')
	{
	alert("Please select country and its relavant state");
	}
	});
});*/

	$(document).on('click','.reset-value',function(){
$('input.form-control,textarea.form-control').removeAttr('value');
});

});
