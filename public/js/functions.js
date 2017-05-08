function phoneValidation(element) {
    if (element.value == '') {
        element.setCustomValidity('Ingrese su telefono');
    }
    else if (element.validity.typeMismatch){
        element.setCustomValidity('Ingrese un telefono válido');
    }
    else {
       element.setCustomValidity('');
    }
    return true;
}

function emailValidation(element) {
    if (element.value == '') {
        element.setCustomValidity('Ingrese su email');
    }
    else if (element.validity.typeMismatch){
        element.setCustomValidity('Ingrese un email válido');
    }
    else {
       element.setCustomValidity('');
    }
    return true;
}

function nameValidation(element) {
    if (element.value == '') {
        element.setCustomValidity('Ingrese su nombre');
    }
    else if (element.validity.typeMismatch){
        element.setCustomValidity('Ingrese un nombre válido');
    }
    else {
       element.setCustomValidity('');
    }
    return true;
}

(function($, window, document, undefined) {
	var $win = $(window);
	var $doc = $(document);

	$doc.ready(function() {
		// Navigation Scroll Animation
		$('.nav a').on('click', function(event) {
			event.preventDefault();
			var href = $(this).attr('href');
			var offsetTop = $(href).offset().top;

			$('html, body').animate({ scrollTop : offsetTop }, {
				queue: false,
				duration: 800
			});
		});

		$('[data-fancybox]').fancybox({
			// Animation duration in ms
			speed : 100,

			// Enable infinite gallery navigation
			loop : true,

			// Should zoom animation change opacity, too
			// If opacity is 'auto', then fade-out if image and thumbnail have different aspect ratios
			//opacity : 'auto',

			// Space around image, ignored if zoomed-in or viewport smaller than 800px
			margin : [44, 0],

			// Horizontal space between slides
			gutter : 30,

			// Should display toolbars
			infobar : true,
			buttons : true,

			// What buttons should appear in the toolbar
			slideShow  : false,
			fullScreen : false,
			thumbs     : false,
			closeBtn   : true,

			iframe : {
				css : {
					width : '400px'
				}
			}
		});

		//Atrapa el evento submit para el formulario del contacto
    //Se verifica si los datos pasan o no la validacion para poder enviar el email
    $('#contactForm').submit(function(event) {
			event.preventDefault();
			event.stopPropagation();

			var datos = $('#contactForm').serialize();
			console.log(datos);
			/*$.ajax({
					url: 'send_email.php',
					type: 'POST',
					data: datos,
					success: function(resp) {
							console.log(resp);
							if (resp === 'OK') {
									$('#mensaje_contacto').css({fontSize: "18px", color: "black", background: "green"});
									$('#mensaje_contacto').html('Su correo ha sido enviado con éxito!.<br>En breve nos comunicaremos con usted');
									$('#form_contacto').get(0).reset();
									$('#refresh_captcha').click();
							} else {
									$('#mensaje_contacto').css({fontSize: "18px", color: "white", background: "red"});
									$('#mensaje_contacto').html(resp);
							}
							$('#mensaje_contacto').fadeOut(4500);
					},
					error: function() {
							console.log("Error al enviar el email");
					}
			});*/

        // if (validateMyAjaxInputs()) {
				//
        //     console.log("Enviar Correo");
        //     $('#mensaje_contacto').show();
        //     $('#mensaje_contacto').removeAttr('style');
        //     $('#mensaje_contacto').css({fontSize: "20px", color: "blue"});
        //     $('#mensaje_contacto').html("Enviando correo...");
        //     var datos = $('#form_contacto').serialize();
        //     $.ajax({
        //         url: 'send_email.php',
        //         type: 'POST',
        //         data: datos,
        //         success: function(resp) {
        //             console.log(resp);
        //             if (resp === 'OK') {
        //                 $('#mensaje_contacto').css({fontSize: "18px", color: "black", background: "green"});
        //                 $('#mensaje_contacto').html('Su correo ha sido enviado con éxito!.<br>En breve nos comunicaremos con usted');
        //                 $('#form_contacto').get(0).reset();
        //                 $('#refresh_captcha').click();
        //             } else {
        //                 $('#mensaje_contacto').css({fontSize: "18px", color: "white", background: "red"});
        //                 $('#mensaje_contacto').html(resp);
        //             }
        //             $('#mensaje_contacto').fadeOut(4500);
        //         },
        //         error: function() {
        //             console.log("Error al enviar el email");
        //         }
        //     });
				//
        // } else {
        //     console.log("NO validado para enviar correo");
        // }
        // return false;

    });


	});
})(jQuery, window, document);

// ;(function($, window, document, undefined) {
// 	var $win = $(window);
// 	var $doc = $(document);
//
// 	$doc.ready(function() {
//
// 		// Testimonial Slider
// 		$('.slider-testimoinals .slides').bxSlider({
// 			controls: false,
// 			auto: true,
// 			pause: 5000
// 		});
//
//
// 		// Navigation Scroll Animation
// 		$('.nav a').on('click', function(event) {
// 			event.preventDefault();
// 			var href = $(this).attr('href');
// 			var offsetTop = $(href).offset().top;
//
// 			$('html, body').animate({ scrollTop : offsetTop }, {
// 				queue: false,
// 				duration: 800
// 			});
// 		});
//
//
// 		// Map
// 		var geocoder;
// 		var map;
// 		var latlng;
// 		var address = $('#map').data('address');
//
// 		function initialize() {
// 			geocoder = new google.maps.Geocoder();
// 			latlng = new google.maps.LatLng(25.763665, -80.189397);
// 			var mapOptions = {
// 				zoom: 17,
// 				center: latlng,
// 				scrollwheel: false,
// 				disableDefaultUI: true
// 			};
//
// 			geocoder.geocode( { 'address': address}, function(results, status) {
// 				if (status == google.maps.GeocoderStatus.OK) {
// 					map.setCenter(results[0].geometry.location);
// 					var marker = new google.maps.Marker({
// 							map: map,
// 							position: results[0].geometry.location
// 					});
// 					latlng = new google.maps.LatLng(results[0].geometry.location.k, results[0].geometry.location.D);
// 				}
// 			});
//
// 			map = new google.maps.Map(document.getElementById('map'),
// 					mapOptions);
// 		}
//
// 		google.maps.event.addDomListener(window, 'load', initialize);
//
// 		window.addEventListener('resize', function() {
// 			map.setCenter(latlng);
// 		}, false);
//
// 		window.addEventListener('orientationchange', function() {
// 			map.setCenter(latlng);
// 		}, false);
//
// 	});
// })(jQuery, window, document);
