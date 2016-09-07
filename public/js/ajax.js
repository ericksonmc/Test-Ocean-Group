$(document).ready(function () {
	$(".open-modal").click(function() {
		var id = $(this).val();

		$.get('/trabajador/edit/' + id, function (data) {

            $('#modal-nombre').val(data.nombre);
            $('#modal-apellido').val(data.apellido);
            $('#modal-cedula').val(data.cedula);
            $('#modal-correo').val(data.correo);
            $('#modal-cargo').val(data.cargo);
            $('#trabajador_id').val(data.id);
        }) 
	});

	$('.delete-trabajador').click(function(e){

		e.preventDefault();

	    var row = $(this).parents('tr');
	    var id = row.data('id');
	    var form = $('#form-delete');
	    var url = form.attr('action').replace(':USER_ID', id);
	    var method = $('#_method').val();
	    var token = $('#_token').val();
	    var data = '&_method='+method+'&'+'_token='+token;
	    
	    $.ajax({
	        url: url,
	        data: data,
	        success: function (result) {
	            row.fadeOut();
	            $('#msgD').css("display", '');
	            location.reload();
	        },
	        error: function (data) {
	            console.log('Error:', data);
	        }
	    }); 
	});

	$(".btn-save").click(function (e) {
		e.preventDefault(); 
		var id = $('#trabajador_id').val();
		var route = "http://localhost:8000/trabajador/editar/" ;
		var token = $("#_token").val();

		var formData = {
	            nombre : $('#modal-nombre').val(),
	            apellido : $('#modal-apellido').val(),
	            cedula : $('#modal-cedula').val(),
	            correo : $('#modal-correo').val(),
	            cargo : $('#modal-cargo').val(),
	            isActive : $('#modal-activo').val(),
	            id : $('#trabajador_id').val()
	        }

		$.ajax({
			url: route,
			headers: {'X-CSRF-TOKEN': token},
			type: 'PUT',
			dataType: 'json',
			data: {trab: formData},
			success: function (data) {
					if (data.isActive==1) {	var activo = 'Si'; }
					else{ var activo = 'No';}

	                var trabajador = '<tr id="trabajador'+ data.id +'"><td>'+ data.nombre +'</td><td>'+ data.apellido +'</td><td>'+ data.cedula +'</td><td>'+ data.correo +'</td><td>'+ data.cargo +'</td><td>'+ activo +'</td><td><button class="btn btn-warning open-modal" data-toggle="modal" data-target="#modal" value="'+data.id+'">Edit</button> <button class="btn btn-danger delete-trabajador" value="'+data.id+'">Delete</button></td></tr>';

	                $("#trabajador" + data.id).replaceWith(trabajador);
	                $('#msgS').css("display", '');
	                $("#btn-cancel").click();
	                location.reload();
	                //$('#modal').trigger("reset");

	        },
	        error: function (data) {
	            console.log('Error:', data);
	        }
		});  
	});
});