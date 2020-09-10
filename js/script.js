$(document).ready(function(argument) {
	
	$('.btn-hide-show').click(function(argument) {
		
		let typeInputSaatIni = $('input-password').attr('type');
		console.log(typeInputSaatIni);

		if (typeInputSaatIni == "password") {
			$('.input-password').attr('type', 'text');
			$(this).removeClass('fa-eye-slash');
			$(this).addClass('fa-eye');
			$(this).attr('title', 'hide password');
		}
		else if (typeInputSaatIni == "text") {
			$('.input-password').attr('type', 'password');
			$(this).removeClass('fa-eye');
			$(this).addClass('fa-eye-slash');
			$(this).attr('title', 'show password');
		}

	});

});