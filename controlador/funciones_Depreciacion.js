$(function(){


	$('.btn_adicionar').click(function(e) {
		e.preventDefault();
		var iddeprec= $(this).attr('prueba');
		alert(iddeprec);
	})

	$(document).on("submit","#form_registro_depreciacion",function(e){
		e.preventDefault();

		mostrar_cargando("Procesando solicitud","Espere mientras se almacenan los datos");


		var datos = $("#form_registro_depreciacion").serialize();
		console.log("formulario: ",datos);
		$.ajax({
			dataType:"json",
			method:"POST",
			url:"json_depreciacion.php",
			data:datos
		}).done(function(json){
			Swal.close();
			console.log("datos consuldos: ",json);
			if (json[0]=="Exito") {
				url:"../vista/tabla_unidades.php"
			}
		}).fail(function(){
			console.log("No sirve: ",datos);
		}).always(function(){

		})

	});


});