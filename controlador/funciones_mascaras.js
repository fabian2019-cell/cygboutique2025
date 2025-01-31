$(function(){
	//cargar_datos();
	var fecha = new Date();

	console.log("Jquery esta funcionando");
	$.mask.definitions['~']='[2,6,7]';
	$('#codigo').mask("9999-99-99-99");
	$("#asociaciones").parsley();
	
	$('#fecha').datepicker({
	    format: "dd/mm/yyyy",
	    language: "es",
	    autoclose: true,
	    endDate:fecha

	});


});