$(document).ready(function() {

	$('#carta-cond').on('submit',function(e){

		e.preventDefault();
		e.stopImmediatePropagation();
		var datos = $(this).serializeArray();

		//console.log(datos);

		//console.log('Hola');

			$.ajax({
					type: $(this).attr('method'),
					data: datos,
					url: $(this).attr('action'),
					dataType: 'json',
					success: function(data) {
					
					var resultado = data;
					console.log(resultado);
					if (resultado.respuesta == 'Success') {
						Swal.fire(
							'Correcto',
							'Los datos han sido guardados correctamente',
							'success'
						).then(function(){ 
	                        location.reload();
	                      }
	                    );
	                    
						$("#carta-cond")[0].reset();
						$('#modalwindow').modal('hide');

					} else {
						Swal.fire({
						type: 'error',
						title: 'Oops...',
						text: 'Algo ha salido mal, por favor verifique los datos'
						})
					}
				}
			});		
	});

	$('#carta-comp').on('submit',function(e){

		e.preventDefault();
		e.stopImmediatePropagation();
		var datos = $(this).serializeArray();

		$.ajax({
			type: $(this).attr('method'),
			data: datos,
			url: $(this).attr('action'),
			dataType: 'json',
			success: function(data) {
			
			var resultado = data;
			console.log(resultado);

			if (resultado.respuesta == 'Success') {

				Swal.fire(
					'Correcto',
					'Los datos han sido guardados correctamente',
					'success'
				).then(function(){ 
                    location.reload();
                  }
                ); 
				$("#carta-comp")[0].reset();
				$('#modalwindow').modal('hide');

			} else {
				Swal.fire({
				type: 'error',
				title: 'Oops...',
				text: 'Algo ha salido mal, por favor verifique los datos'
				})
			}
		}
		});
	});

	$('#justificante').on('submit',function(e){

		e.preventDefault();
		e.stopImmediatePropagation();
		var datos = $(this).serializeArray();

		//console.log(datos);

		//console.log('Hola');
		$.ajax({
			type: $(this).attr('method'),
			data: datos,
			url: $(this).attr('action'),
			dataType: 'json',
			success: function(data) {
			
				var resultado = data;
				console.log(resultado);

				if (resultado.respuesta == 'Success') {

					Swal.fire(
						'Correcto',
						'Los datos han sido guardados correctamente',
						'success'
					).then(function(){ 
                        location.reload();
                      }
                    ); 
					$("#justificante")[0].reset();
					$('#modalwindow').modal('hide');

				} else {
					Swal.fire({
					type: 'error',
					title: 'Oops...',
					text: 'Algo ha salido mal, por favor verifique los datos'
					})
				}
			}
		});
	});

	$('#citatorio').on('submit',function(e){

		e.preventDefault();
		e.stopImmediatePropagation();
		var datos = $(this).serializeArray();

		//console.log(datos);

		$.ajax({
			type: $(this).attr('method'),
			data: datos,
			url: $(this).attr('action'),
			dataType: 'json',
			success: function(data) {
			
				var resultado = data;
				console.log(resultado);

				if (resultado.respuesta == 'Success') {

					Swal.fire(
						'Correcto',
						'Los datos han sido guardados correctamente',
						'success'
					).then(function(){ 
                        location.reload();
                      }
                    ); 
					$("#citatorio")[0].reset();
					$('#modalwindow').modal('hide');

				} else {
					Swal.fire({
					type: 'error',
					title: 'Oops...',
					text: 'Algo ha salido mal, por favor verifique los datos'
					})
				}
			}
		});
	});

	$('#pase-entrada').on('submit',function(e){

		e.preventDefault();
		e.stopImmediatePropagation();
		var datos = $(this).serializeArray();

		//console.log(datos);

		//console.log('Hola');

		Swal.fire(
		  'Good job!',
		  'You clicked the button!',
		  'success'
		)
	});

	//window.location.href
	$('#agrega-alumno').on('submit', function(e){
			
			e.preventDefault();
			e.stopImmediatePropagation();

			var datos = $(this).serializeArray();

			//console.log(datos);

			$.ajax({
				type: $(this).attr('method'),
				data: datos,
				url: $(this).attr('action'),
				dataType: 'json',
				success: function(data) {
					
					resultado = data;
					console.log(resultado);

					if (resultado.respuesta == 'Success') {
						Swal.fire(
						  'Correcto',
						  'El alumno se ha registrado correctamente',
						  'success'
						)
						$("#agrega-alumno")[0].reset();
					} else {
						Swal.fire({
						  type: 'error',
						  title: 'Oops...',
						  text: 'Algo ha salido mal, por favor verifique los datos'
						})
					}
				}
			});
		});

		$('#login-form').on('submit',function(e){

			e.preventDefault();
			e.stopImmediatePropagation();
			var datos = $(this).serializeArray();
	
			//console.log(datos);
	
			$.ajax({
				type: $(this).attr('method'),
				data: datos,
				url: $(this).attr('action'),
				dataType: 'json',
				success: function(data) {
				
					var resultado = data;
					//console.log(resultado);
	
					if (resultado.respuesta == 'Success') {

						window.location="inicio.php";
	
					} else {
						Swal.fire({
						type: 'error',
						title: 'Usuario y/o contraseña incorrectos',
						text: 'Por favor verifique los datos'
						})
					}
				}
			});
		});

		$('#myDatepicker').datetimepicker( {
				format: 'DD.MM.YYYY'
			});
			
			$('#myDatepicker2').datetimepicker({
				format: 'DD.MM.YYYY'
			});
			
			$('#myDatepicker3').datetimepicker({
				format: 'HH:mm'
			});
			
			$('#myDatepicker4').datetimepicker({
				format: 'HH:mm'
			});

			$('#datetimepicker6').datetimepicker();
			
			$('#datetimepicker7').datetimepicker({
				useCurrent: false
			});
			
			$("#datetimepicker6").on("dp.change", function(e) {
				$('#datetimepicker7').data("DateTimePicker").minDate(e.date);
			});
			
			$("#datetimepicker7").on("dp.change", function(e) {
				$('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
			});
});