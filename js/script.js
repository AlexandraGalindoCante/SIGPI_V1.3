function nuevoProyecto(){
	//Asignar valores 
	var nombre = $("#nombre").val();
	var inicio = $("#inicio").val();
	var fin = $("#fin").val();
	var cliente = $("#cliente").val();
	var estado = $("#estado").val();
	var avance = $("#avance").val();

	//Agregar
	$.post("ajax/nuevoProyecto.php" , {
		nombre:nombre, inicio:inicio, fin:fin, cliente:cliente,
		estado:estado,avance:avance
	}, function(data,status){
		$("#registroProyecto").modal("hide");

		
		$("#nombre").val("");
		$("#inicio").val("");
		$("#fin").val("");
		$("#cliente").val("");
		$("#estado").val("");
		$("#avance").val("");


	});
	}

function leeProyecto(){
	$.get("ajax/leeProyecto.php",{},function(data,status){
		$(".records_content").html(data);
	});
}