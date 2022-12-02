$(document).ready(function(){





	// add item to cart
	$(".product-form").submit(function(e){
		var form_data = $(this).serialize();
		$.ajax({
			url: "includes/func/fonk_cart.php",
			type: "POST",
			dataType:"json",
			data: form_data,
			success: function(data) {

				swal({
					title: "Başarılı!",
					text: "Ürününüz sepete eklenmiştir",
					type: "success",
					timer: '2000',
					showConfirmButton: true,
					confirmButtonText:"TAMAM",
				});

				setTimeout(function(){// wait for 5 secs(2)
					location.reload(); // then reload the page.(3)
				}, 1500);
			},

			error: function() {
				swal({
					title: 'Hata!',
					text: "Adet seçiminiz stok sayısını aşmaktadır.",
					type: 'warning',
					showCancelButton: true,
					cancelButtonText: 'Tamam',
					cancelButtonColor: '#3085d6',
					confirmButtonColor: 'green',
					confirmButtonText: "<a href='sepet' style='color:#FFF; text-decoration: none'>Sepete Git</a>"
				})

				$(".addToCartBtn").html("SEPETTE");

			}
		})

			.done(function(data){
			$("#cart-container").html(data.shopping_cart);
			button_content.html('Add to Cart');
		})
		e.preventDefault();
	});




	//Remove items from cart


	$(function(){
		$('.remove-item').click(function(){
			var elem = $(this);
			$.ajax({
				type: "GET",
				url: "includes/func/fonk_cart.php",
				data: "delete_id="+elem.attr('data-code'),
				dataType:"json",
				success: function(data) {



					setTimeout(function(){// wait for 5 secs(2)
						location.reload(); // then reload the page.(3)
					}, 100);


				}
			});
			return false;
		});
	});


	// Minus Quantity

	$(function(){
		$('.plus-quantity').click(function(){
			var elem = $(this);
			$.ajax({
				type: "GET",
				url: "includes/func/fonk_cart.php",
				data: "plus_id="+elem.attr('data-code'),
				dataType:"json",
				success: function(data) {



					setTimeout(function(){// wait for 5 secs(2)
						location.reload(); // then reload the page.(3)
					}, 100);


				}
			});
			return false;
		});
	});

	$(function(){
		$('.minus-quantity').click(function(){
			var elem = $(this);
			$.ajax({
				type: "GET",
				url: "includes/func/fonk_cart.php",
				data: "id="+elem.attr('data-code'),
				dataType:"json",
				success: function(data) {



					setTimeout(function(){// wait for 5 secs(2)
						location.reload(); // then reload the page.(3)
					}, 100);


				}
			});
			return false;
		});
	});






});


function girisyap(theForm)
{
	if (theForm.user.value ==0 )
	{
		alert(" Kullanıcı Adı boş bırakılamaz");
		theForm.user.focus();
		return (false);
	}
	if (theForm.password.value ==0 )
	{
		alert(" Şifre alanı boş bırakılamaz");
		theForm.password.focus();
		return (false);
	}

	var veriler = $('#logining').serialize();
	$.ajax
	({
		type: "POST",
		url: "support/login/loginpost.php?",
		data: veriler,
		success:function(cevap)
		{$("#sonuc").html(""+cevap); }

	})
	return (true);
};